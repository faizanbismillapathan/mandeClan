<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class banner extends Model
{
     protected $fillable = [
'banner_app_img','status','banner_web_img'
	 ];



}

		
// php artisan make:migration create_banners_table --create=banners
