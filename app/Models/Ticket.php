<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model {

    protected $table = 'ticket';
    protected $primaryKey = 'id';

    public function ticket_types()
    {
        return $this->hasOne('App\Models\TicketTypes');
    }
}