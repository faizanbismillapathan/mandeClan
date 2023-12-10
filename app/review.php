<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class review extends Model
{
    protected $fillable = [
'store_name',
'store_unique_id',
'store_user_id',
'store_id',
'product_id',
'product_name',
'persone_name',
'persone_role',
'persone_user_id',
'persone_unique_id',
'reviews',
'rating',
'status',
'suborder_id',
'attachment',
	 ];

	 // php artisan make:migration create_reviews_table --create=reviews

}
