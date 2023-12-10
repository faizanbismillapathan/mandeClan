<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class suborder extends Model
{
     protected $fillable = [
'order_id',
'store_id',
'store_user_id',
'store_u_id',
'customer_id',
'customer_user_id',
'customer_u_id',
'order_u_id',
'suborder_u_id',
'delivery_date',
'delivery_time',
'order_date',
'payment_method',
'tip_price',
'tip_order_status',
'transection_id',
'total_item',
'paid_unpaid_status',
'subtotal',
'gift_packing_charges',
'shipping_charges',
'grand_total',
'order_status',
'pickup_type',
'total_tax',
'tax_price',
'discount_price',


// ALTER TABLE `suborders` ADD `discount_price` DOUBLE NULL DEFAULT NULL AFTER `tax_price`;



     ];


}

        
// php artisan make:migration create_suborders_table --create=suborders,
