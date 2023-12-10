<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class service_subscription extends Model
{
       protected $fillable = [

'service_plan_name','service_plan_price',
'service_plan_id','service_plan_discount','service_plan_validity','service_product_limit','service_plan_features',
'status'

 ];

      // php artisan make:migration create_service_subscriptions_table --create=service_subscriptions

}
