<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class assign_vehicle_to_rider extends Model
{
    protected $fillable = [

'vehicle_id',
'vehicle_owner_id',
'rider_id',
'rider_availability',
'assign_rv_id',
'assign_vehicle_u_id',
'rider_plan_id',
'vehicle_plan_id',
'status',

    ];
}

      // php artisan make:migration create_assign_vehicle_to_riders_table --create=assign_vehicle_to_riders

