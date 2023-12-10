<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class suport_ticket_detail extends Model
{
    protected $fillable = [
'ticket_id',
'name',
'message',
'user_id',
'message_by',
'attachment',



	 ];

	 // php artisan make:migration create_suport_ticket_details_table --create=suport_ticket_details

}
