<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rider_master extends Model
{
     protected $fillable = [
'rider_userid',
'rider_id',
'user_id',
'driving_license_type',
'rider_driving_license_no',
'rider_driving_expiry_date',
'rider_license_front_img',
'rider_license_back_img',

'rider_availability',
'assign_vehicle_id',
'assign_vehicle_u_id',
'rider_plan_id',


];


}

        
// php artisan make:migration create_rider_masters_table --create=rider_masters,
