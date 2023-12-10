<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\state;
use App\country;
use App\city;
use App\locality;
use App\customer;
class order_delivery_address extends Model
{
     protected $fillable = [


'order_id',
'store_id',
'customer_id',
'customer_user_id',
'customer_u_id',
'customer_name',
'customer_email',
'customer_mobile',
'customer_phone',
'customer_country',
'customer_state',
'customer_city',
'customer_locality',
'customer_pincode',
'customer_address',
'customer_latitude',
'customer_longitude',


     ];



 public function states(){
        return $this->belongsTo(state::class,'state');
    }

     public function countrys(){
        return $this->belongsTo(country::class,'country');
    }

     public function citys(){
        return $this->belongsTo(city::class,'city');
    }

  
    public function localitys(){
        return $this->hasOne(locality::class,'id','locality');
    }
 public function customers(){
        return $this->hasOne(customer::class,'user_id','user_id');
    }

}

        
// php artisan make:migration create_order_delivery_addresses_table --create=order_delivery_addresses,
