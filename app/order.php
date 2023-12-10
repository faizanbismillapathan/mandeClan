<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
     protected $fillable = [

'customer_id',
'customer_user_id',
'customer_u_id',
'order_u_id',
'payment_method',
'total_tip_price',
'tip_order_status',
'transection_id',
'order_date',
'delivery_date',
'pickup_type',
// 'pick_date',
'delivery_time',
'total_order_item',
'total_suborder',
'paid_unpaid_status',
'subtotal',
'coupan_discount',
'shipping_charges',
'grand_total',
'order_status',
'total_tax',
'tax_price',
'save_price',
     ];


}

        
// php artisan make:migration create_orders_table --create=orders,
