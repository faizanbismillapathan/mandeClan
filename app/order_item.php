<?php

namespace App;
use App\stores;

use Illuminate\Database\Eloquent\Model;


class order_item extends Model
{
    protected $fillable = [
'order_id',
'store_id',
'suborder_id',
'product_id',
'product_u_id',
'product_name',
'item_u_id',
'item_barcode',
'item_hsn_sac_code',
'item_sku',
'base_price',
'item_price',
'item_selling_price',
'item_offer_discount',
'item_img1',
'item_img2',
'item_img3',
'item_img4',
'item_status',
'item_quantity',
'item_description',
'item_attr_key',
'item_attr_varient',
'array_combine',
'item_shipping_weight',
'item_shipping_weight_unit',
'product_item_status',
'addon_name_price',
'addon_id_groupid',
'commission_percent',
'commission_amount',
'item_shipping_charge',
'order_date',
'item_tax',
'item_tax_price',


	 ];

	
 // php artisan make:migration create_order_items_table --create=order_items
}
