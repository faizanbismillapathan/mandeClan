<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class config extends Model
{
    protected $fillable = [

'payu_enable',
'instamojo_enable',
'stripe_enable',
'paypal_enable',
'fb_login_enable',
'google_login_enable',
'pincode_system',
'paytm_enable',
'razorpay',
'braintree_enable',
'paystack_enable',
'amazon_enable',
'linkedin_enable',
'twitter_enable',
'payhere_enable',
'cashfree_enable',
'skrill_enable',
'rave_enable',
'moli_enable',
'omise_enable',
'iyzico_enable',
'sslcommerze_enable',
'enable_amarpay',
'msg91_enable',
'sms_channel',
'bank_enable',

    ];

}
