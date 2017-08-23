<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/


Route::get('/get-all-tickets', 'ApiController@getAllTickets');

Route::post('/create-ticket', 'ApiController@createTicket');
Route::post('/update-ticket/', 'ApiController@updateTicket');
Route::post('/create-ticket-type', 'ApiController@createTicketsTypes');
Route::post('/update-ticket-type/', 'ApiController@updateTicketsTypes');