<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class seller_suport_ticket extends Model
{
    protected $fillable = [
'ticket_name',
'vendor_name',
'vendor_email',
'subject',
'message',
'status',

	 ];

	 // php artisan make:migration create_seller_suport_tickets_table --create=seller_suport_tickets

}
