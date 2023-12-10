<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rv_user_registration extends Model
{
     protected $fillable = [
'rv_user_userid',
'rv_user_name',
'rv_user_email',
'rv_user_mobile',
'rv_user_phone',
'rv_user_img',
'user_id',
// 'rv_user_qulification',
// 'deposit_amount',
// 'rv_user_marksheet',
'rv_user_type',

// 'sims_lot_index',
// 'carrie_rname',
// 'sim_serial_number',
// 'phone_number',
// 'imei_code',

'created_by',
'rv_user_dob',
'rv_user_gender',
'rv_user_login_email',
'rv_user_password',
'rv_user_country',
'rv_user_state',
'rv_user_city',
'rv_user_locality',
'rv_user_address',
'rv_user_pincode',
'status',
'status_date',
'status_created_by',
'kyc_status',
];


}

        
// php artisan make:migration create_rv_user_registrations_table --create=rv_user_registrations,
