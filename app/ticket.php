<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class ticket extends Model
{
    protected $fillable = [
'ticket_role','ticket_name','status'
	 ];

	 // php artisan make:migration create_tickets_table --create=tickets

}
