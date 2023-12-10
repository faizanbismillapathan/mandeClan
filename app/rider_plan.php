<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class rider_plan extends Model
{
       protected $fillable = [

'rider_plan_name','rider_plan_price',
'rider_plan_id','rider_plan_discount','rider_plan_validity','rider_product_limit','rider_plan_features',
'status'

 ];

      // php artisan make:migration create_rider_plans_table --create=rider_plans

}
