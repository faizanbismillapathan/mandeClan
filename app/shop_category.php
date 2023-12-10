<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class shop_category extends Model
{
       protected $fillable = [
'store_id','store_category_id','product_category_id','user_id','status','product_category'

 ];

      
}
 // php artisan make:migration create_shop_categories_table --create=shop_categories
