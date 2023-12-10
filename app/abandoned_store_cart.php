<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class abandoned_store_cart extends Model
{
    protected $fillable = [
'ip_address',
'token',
'product_id',
'product_name',
'item_id',
'store_id',
'quantity',
'sell_price',
'cwitemid',
'category_name',
'rowId',
'add_by',

    ];

     // php artisan make:migration create_abandoned_store_carts_table --create=abandoned_store_carts
}
