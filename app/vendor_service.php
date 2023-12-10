<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vendor_service extends Model
{
     protected $fillable = [

'service_id',
'user_id',
'vendor_unique_id',
'service_unique_id',
'service_category',
'service_subcategory',
'service_name',
'service_brand',
'service_description',
'service_sku',
'service_price',
'service_payment_mode', 
'service_offer_discount',
'service_img',
'service_link',
'created_by',
'status',

	 ];


public function brand(){
        return $this->belongsTo(brand::class,'service_brand');
    }

	    public function category(){
        return $this->belongsTo(service_category::class,'service_category');
    }

     public function subcategory(){
        return $this->belongsTo(service_subcategory::class,'service_subcategory');
    }

}
		
// php artisan make:migration create_vendor_services_table --create=vendor_services
