<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\state;
use App\country;
use App\city;
use App\locality;
use App\User;
use App\service_category;


class service extends Model
{
     protected $fillable = [
'user_id',
'service_unique_id',
'service_owner_name',
'service_owner_email',
'service_owner_mobile',
'service_name',
'service_mobile',
'service_phone',
'service_email',
'service_gstin_no',
'service_website',
'service_facebook_url',
'service_instagram_url',
'service_you_tube_url',
'service_twitter_url',
'service_pincode',
'service_address',
'service_longitude',
'service_latitude',
'service_paypal_email',
'service_paytm_mobile',
'str_bank_account_no',
'str_bank_account_name',
'str_bank_bank_name',
'str_bank_ifsc_code',
'str_bank_branch',
'str_bank_branch_addr',
'str_bank_account_type',
'service_commission_id',
'service_email',
'service_password',
'service_category',
// 'service_product_category',
'service_subcategory',
'service_country',
'service_state',
'service_city',
'service_locality',
'service_payout_option',
'service_plan_id',
'service_email_option',
'service_sms_option',
'service_stock_management',
'service_invoice_period',
'str_verified_status',
'service_description',
'status',
'service_owner_gendor',
'service_logo',
'service_cover_photo',
'created_by',
'service_link',
'service_open_time',
'service_close_time',

'status_date',
'status_created_by',
'kyc_status',

	 ];


 public function state(){
        return $this->belongsTo(state::class,'service_state');
    }

     public function country(){
        return $this->belongsTo(country::class,'service_country');
    }

     public function city(){
        return $this->belongsTo(city::class,'service_city');
    }

  
    public function locality(){
        return $this->hasOne(locality::class,'id','service_locality');
    }
 public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }


    public function category(){
                return $this->hasOne(service_category::class,'id','service_category');

    }

}

		
// php artisan make:migration create_services_table --create=services
