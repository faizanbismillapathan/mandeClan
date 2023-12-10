<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class store_cart extends Model
{
    protected $fillable = [
'product_id',
'product_name',
'item_id',
'store_id',
'quantity',
'sell_price',
'cwitemid',
'user_id',
'user_unique_id',
'rowId',
'add_by',
    ];

     // php artisan make:migration create_store_carts_table --create=store_carts
}
