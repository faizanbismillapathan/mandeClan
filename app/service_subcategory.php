<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class service_subcategory extends Model
{
       protected $fillable = [
'service_category','service_subcategory','status' ];

      
} // php artisan make:migration create_service_subcategories_table --create=service_subcategories

