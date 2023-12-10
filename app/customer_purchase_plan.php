<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class customer_purchase_plan extends Model
{
       protected $fillable = [
'customer_plan_name','customer_plan_price','user_id',
'customer_plan_id','customer_plan_discount','customer_plan_validity','customer_product_limit','customer_plan_features',
'status','plan_used','plan_expiry_date','plan_transaction_id','paid_amount','plan_status','purchase_date'

 ];

      // php artisan make:migration create_customer_purchase_plans_table --create=customer_purchase_plans

}
