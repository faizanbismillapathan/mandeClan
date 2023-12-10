<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class career extends Model
{
     protected $fillable = [
'name',
'mobile_no',
'email',
'message',
'apply_for',
'status',
	 ];


}

		
// php artisan make:migration create_careers_table --create=careers
