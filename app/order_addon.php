<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order_addon extends Model
{
    protected $fillable = [
        'order_id',
                'suborder_id',

'product_id', 
'item_id', 
'store_id', 
'product_name', 
'quantity', 
'addon_id', 
'addon_group_id', 
'addon_group_name',
'addon_name',
'addon_price',
    ];
}

      // php artisan make:migration create_order_addons_table --create=order_addons

