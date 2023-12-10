<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vehicle_master extends Model
{
     protected $fillable = [
'vehicle_unique_id',
'vehicle_userid',
'vehicle_owner_id',
'user_id',
'vehicle_type',
// 'vehicle_name',
'vehicle_no',
'vehicle_modal_no',
'vehicle_package',
'vehicle_package_for',
'vehicle_registered_no',
'vehicle_registered_year',
'vehicle_front_img',
'vehicle_back_img',
'vehicle_side_img',
'vehicle_insurance_file',
'insurance_expiry_date',
'vehicle_rc_book_img',
'vehicle_rc_no',
'vehicle_driving_location',
'status',

'vehicle_availability',
'assign_rider_id',
'assign_rv_id',
'assign_rider_u_id',


];


}

        
// php artisan make:migration create_vehicle_masters_table --create=vehicle_masters,
