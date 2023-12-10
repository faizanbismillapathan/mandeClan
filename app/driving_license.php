<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class driving_license extends Model
{
     protected $fillable = [
'driving_license_name','status'
	 ];


}

		
// php artisan make:migration create_driving_licenses_table --create=driving_licenses
