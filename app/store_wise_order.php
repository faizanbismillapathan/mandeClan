<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class store_wise_order extends Model
{
     protected $fillable = [

'store_id',
'store_user_id',
'store_u_id',
'customer_id',
'customer_user_id',
'customer_u_id',
'order_u_id',
'store_wise_order_u_id',
'delivery_date',
'payment_method',
'tip_price',
'tip_payment_status',
'transection_id',
'store_wise_order_qty',
// 'total_store_wise_order',
'paid_unpaid_status',
// 'product_id',
// 'product_u_id',
// 'product_name',
// 'product_qty',
// 'product_price',
'total_tax',
'shipping_charges',
'subtotal',
'gift_packing_charges',
'dilevery_charges',
'grand_total',
// 'store_invoice_no',




     ];


}

        
// php artisan make:migration create_store_wise_orders_table --create=store_wise_orders,
