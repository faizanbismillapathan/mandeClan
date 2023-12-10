<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\state;
use App\country;
use App\city;
use App\locality;
use App\User;
use App\store_category;


class store extends Model
{
     protected $fillable = [
'user_id',
'store_unique_id',
'store_owner_name',
'store_owner_email',
'store_owner_mobile',
'store_name',
'store_mobile',
'store_phone',
'store_email',
'store_gstin_no',
'store_website',
'store_facebook_url',
'store_instagram_url',
'store_you_tube_url',
'store_twitter_url',
'store_pincode',
'store_address',
'store_longitude',
'store_latitude',
// 'store_paypal_email',
'store_paytm_mobile',
'str_bank_account_no',
'str_bank_account_name',
'str_bank_bank_name',
'str_bank_ifsc_code',
'str_bank_branch',
'str_bank_branch_addr',
'str_bank_account_type',
'store_commission_id',
'store_login_email',
'store_password',
'store_category',
'store_product_category',
'store_country',
'store_state',
'store_city',
'store_locality',
'store_payout_option',
'store_plan_id',
'store_email_option',
'store_sms_option',
'store_stock_management',
'store_invoice_period',
'str_verified_status',
'store_description',
'status',
'store_owner_gendor',
'store_logo',
'store_cover_photo',
'created_by',
'store_link',
'store_open_time',
'store_close_time',

'status_date',
'status_created_by',
'kyc_status',

	 ];


 public function state(){
        return $this->belongsTo(state::class,'store_state');
    }

     public function country(){
        return $this->belongsTo(country::class,'store_country');
    }

     public function city(){
        return $this->belongsTo(city::class,'store_city');
    }

  
    public function locality(){
        return $this->hasOne(locality::class,'id','store_locality');
    }
 public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }


    public function category(){
                return $this->hasOne(store_category::class,'id','store_category');

    }

}

		
// php artisan make:migration create_stores_table --create=stores
