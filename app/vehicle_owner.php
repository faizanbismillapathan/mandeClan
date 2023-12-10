<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vehicle_owner extends Model
{
     protected $fillable = [
'veh_own_userid',
'veh_own_name',
'veh_own_email',
'veh_own_mobile',
'veh_own_phone',
'veh_own_img',
'user_id',
'veh_own_pincode',
'created_by',
'veh_own_dob',
'veh_own_gender',
'veh_own_login_email',
'veh_own_password',
'veh_own_country',
'veh_own_state',
'veh_own_city',
'veh_own_locality',
'veh_own_address',
'veh_own_pincode',
'status'
];


}

        
// php artisan make:migration create_vehicle_owners_table --create=vehicle_owners,
