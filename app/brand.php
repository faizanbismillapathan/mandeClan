<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class brand extends Model
{
    protected $fillable = [
'brand_category','brand_name','brand_logo','status','brand_type'
	 ];

	 // php artisan make:migration create_brands_table --create=brands

}
