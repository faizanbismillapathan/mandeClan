<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product_item extends Model
{
     protected $fillable = [
'item_unique_id',
'store_id',
'user_id',
'product_id',
'item_category',
'item_subcategory',
'item_barcode',
'item_hsn_sac_code',
'item_sku',
'item_price',
'item_offer_discount',
'item_img1',
'item_img2',
'item_img3',
'item_img4',
'item_status',
'item_quantity',
'item_attr_key',
'item_attr_varient',
'array_combine',
'item_shipping_weight',
'item_shipping_weight_unit',
'product_item_status',

'item_description',

      ];
}


