<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\state;
use App\country;
use App\city;
use App\locality;
use App\User;


class customer extends Model
{
     protected $fillable = [
'customer_userid',
'customer_name',
'customer_email',
'customer_mobile',
'customer_phone',
'customer_img',
'user_id',
'created_by',
'customer_dob',
'customer_gender',
'customer_login_email',
'customer_password',
'customer_country',
'customer_state',
'customer_city',
'customer_locality',
'customer_address',
'customer_pincode',
'status',
'status_date',
'status_created_by',
'customer_plan_id',
     ];


 public function state(){
        return $this->belongsTo(state::class,'customer_state');
    }

     public function country(){
        return $this->belongsTo(country::class,'customer_country');
    }

     public function city(){
        return $this->belongsTo(city::class,'customer_city');
    }

  
    public function locality(){
        return $this->hasOne(locality::class,'id','customer_locality');
    }
 public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }



}

        
// php artisan make:migration create_customers_table --create=customers,
