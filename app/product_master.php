<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product_master extends Model
{
     protected $fillable = [


'product_unique_id',
'store_category',
'product_category',
'product_subcategory',
'product_name',
'product_brand',
'product_key_features',
'product_description',
'product_wg_duration',
'product_wg_dmy',
'product_wg_type',
'product_video_url',
'product_tags',
'product_free_shipping',
'product_status',
'product_cancel_available',
'product_cod',
'product_cover_photo',
'product_link',

	 ];


public function brand(){
        return $this->belongsTo(brand::class,'product_brand');
    }

	    public function category(){
        return $this->belongsTo(product_category::class,'product_category');
    }

     public function subcategory(){
        return $this->belongsTo(product_subcategory::class,'product_subcategory');
    }

}

		
// php artisan make:migration create_product_masters_table --create=product_masters
