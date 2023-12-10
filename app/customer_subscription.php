<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class customer_subscription extends Model
{
       protected $fillable = [

'customer_plan_name','customer_plan_price',
'customer_plan_id','customer_plan_discount','customer_plan_validity','customer_product_limit','customer_plan_features',
'status'

 ];

      // php artisan make:migration create_customer_subscriptions_table --create=customer_subscriptions

}
