<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class product_subcategory extends Model
{
       protected $fillable = [
'store_category','product_category','product_subcategory','status' ];

      
} // php artisan make:migration create_product_subcategories_table --create=product_subcategories

