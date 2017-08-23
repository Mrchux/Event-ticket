<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getAllTickets()
    {

        $posts = DB::table('ticket')->simplePaginate(15);
        return response()->json(['response'=>['status' => true, 'msg' => 'Success!', 'data' => $posts]]);
    }
    /**
     * Receives Json request, validate and process request.
     *
     * @return Response
     */
    public function createTicket(Request $request)
    {
        $bodyContent = $request->getContent();
        $input = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $bodyContent));

        $validator = Validator::make($input->all(), [
            'event_name' => ['required', 'regex:/^[A-Za-z0-9 ]+$/'],
            'event_type' => 'required',
            'event_description' => 'required',
            'user_email' => 'required',
            'user_name' => 'required',
        ]);

        if($validator->fails())
            return response()->json(['response'=>['status' => false, 'msg' => 'Error:', 'data' => $validator->errors()->all()]]);

        $ticket = new Ticket();
        $ticket->event_name = $input->event_name;
        $ticket->event_type = $input->event_type;
        $ticket->event_description = $input->event_description;
        $ticket->ticket_type_id = $input->ticket_type_id;
        if($ticket->save())
            return response()->json(['response'=>['status' => true, 'msg' => 'You have successfully created a ticket', 'data' => [$ticket->id]]]);
        else
            return response()->json(['response'=>['status' => false, 'msg' => 'Something went wrong, could not create ticket', 'data' => []]]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Json Request
     * @return Response
     */
    public function updateTicket(Request $request)
    {
        $bodyContent = $request->getContent();
        $input = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $bodyContent));

        $ticket = Ticket::find($input->ticket_id);
        if(!empty($ticket)){
            $ticket->ticket_name = $input->ticket_name;
            $ticket->ticket_description = $input->ticket_description;
            $ticket->ticket_type_id = $input->ticket_type_id;
            if($ticket->save())
                return response()->json(['response'=>['status' => true, 'msg' => 'You have successfully updated a ticket', 'data' => []]]);
            else
                return response()->json(['response'=>['status' => false, 'msg' => 'Something went wrong, could not update ticket', 'data' => []]]);

        } else {
            return response()->json(['response'=>['status' => false, 'msg' => 'Could not find any ticket with the sent id', 'data' => []]]);
        }

    }

    /**
     * Receives Json request, validate and process request.
     *
     * @return Response
     */
    public function createTicketType(Request $request){
        $bodyContent = $request->getContent();
        $input = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $bodyContent));

        $validator = Validator::make($input->all(), [
            'ticket_name' => ['required', 'regex:/^[A-Za-z0-9 ]+$/'],
            'ticket_description' => 'required',
        ]);

        if($validator->fails())
            return response()->json(['response'=>['status' => false, 'msg' => 'Error:', 'data' => $validator->errors()->all()]]);

        $ticket_type = new TicketTypes();
        $ticket_type->ticket_name = $input->ticket_name;
        $ticket_type->ticket_description = $input->ticket_description;
        if($ticket_type->save())
            return response()->json(['response'=>['status' => true, 'msg' => 'You have successfully created a ticket type', 'data' => [$ticket_type->id]]]);
        else
            return response()->json(['response'=>['status' => false, 'msg' => 'Something went wrong, could not create ticket type', 'data' => []]]);

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  Json Request
     * @return Response
     */
    public function updateTicketType(Request $request){

        $bodyContent = $request->getContent();
        $input = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $bodyContent));

        $ticket_type = TicketTypes::find($input->ticket_type_id);
        if(!empty($ticket_type)){
            $ticket_type->ticket_name = $input->ticket_name;
            $ticket_type->ticket_description = $input->ticket_description;
            if($ticket_type->save())
                return response()->json(['response'=>['status' => true, 'msg' => 'You have successfully updated a ticket type', 'data' => []]]);
            else
                return response()->json(['response'=>['status' => false, 'msg' => 'Something went wrong, could not update ticket type', 'data' => []]]);

        } else {
            return response()->json(['response'=>['status' => false, 'msg' => 'Could not find any ticket type with the sent id', 'data' => []]]);
        }

    }


}
