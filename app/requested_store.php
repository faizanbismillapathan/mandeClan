<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\city;
use App\locality;
use App\store_category;
use App\service_category;

class requested_store extends Model
{
     protected $fillable = [
'store_owner_name',
'store_owner_email',
'store_owner_mobile',
'store_owner_gendor',
'store_category',
'store_name',
'store_website',
'store_description',
'store_address',
'store_type',
'store_city',
'store_locality',
'store_pincode',

	 ];




     public function city(){
        return $this->belongsTo(city::class,'store_city');
    }

  
    public function locality(){
        return $this->hasOne(locality::class,'id','store_locality');
    }



    public function category(){
                return $this->hasOne(store_category::class,'id','store_category');

    }

      public function servicecategory(){
                return $this->hasOne(service_category::class,'id','store_category');

    }


}

		
// php artisan make:migration create_requested_stores_table --create=requested_stores
