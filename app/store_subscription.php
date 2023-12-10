<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class store_subscription extends Model
{
       protected $fillable = [

'store_plan_name','store_plan_price',
'store_plan_id','store_plan_discount','store_plan_validity','store_product_limit','store_plan_features',
'status'

 ];

      // php artisan make:migration create_store_subscriptions_table --create=store_subscriptions

}
