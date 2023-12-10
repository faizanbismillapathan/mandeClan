<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class contact_us extends Model
{
     protected $fillable = [
'name',
'mobile_no',
'email',
'message',
'status',
	 ];


}

		
// php artisan make:migration create_contact_us_table --create=contact_us
