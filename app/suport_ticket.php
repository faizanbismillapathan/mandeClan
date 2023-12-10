<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class suport_ticket extends Model
{
    protected $fillable = [
'ticket_name',
'vendor_name',
'vendor_email',
'subject',
'message',
'status',
'user_id',
'message_by',
'ticket_no',



	 ];

	 // php artisan make:migration create_suport_tickets_table --create=suport_tickets

}
