<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class admin extends Model
{
     protected $fillable = [
'admin_userid',
'admin_name',
'admin_email',
'admin_mobile',
'admin_phone',
'admin_img',
'user_id',
'created_by',
'admin_dob',
'admin_gender',
'admin_login_email',
'admin_password',
'admin_country',
'admin_state',
'admin_city',
'admin_locality',
'admin_address',
'admin_pincode',
'status'





     ];



 public function state(){
        return $this->belongsTo(state::class,'admin_state');
    }

     public function country(){
        return $this->belongsTo(country::class,'admin_country');
    }

     public function city(){
        return $this->belongsTo(city::class,'admin_city');
    }

  
    public function locality(){
        return $this->hasOne(locality::class,'id','admin_locality');
    }
 public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }


    public function category(){
                return $this->hasOne(admin_category::class,'id','admin_category');

    }


}

        
// php artisan make:migration create_admins_table --create=admins,
