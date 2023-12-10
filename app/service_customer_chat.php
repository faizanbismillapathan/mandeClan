<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class service_customer_chat extends Model
{
     protected $fillable = [
'message','identifier','user_id','from_id','to_id','status','enquiry_id','message_number'
	 ];



}

		
// php artisan make:migration create_service_customer_chats_table --create=service_customer_chats
