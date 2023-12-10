<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class product_category extends Model
{
       protected $fillable = [
'store_category','product_category','status','product_category_url','store_id' ];

      
} // php artisan make:migration create_product_categories_table --create=product_categories

