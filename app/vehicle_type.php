<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vehicle_type extends Model
{
    protected $fillable = [
        'vehicle_name', 'vehicle_no_of_wheel', 'vehicle_unique_id','vehicle_image','vehicle_fuel','vehicle_license_name','status'
    ];
}

      // php artisan make:migration create_vehicle_types_table --create=vehicle_types

