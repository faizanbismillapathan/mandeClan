<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class service_purchase_plan extends Model
{
       protected $fillable = [
'service_plan_name','service_plan_price','user_id',
'service_plan_id','service_plan_discount','service_plan_validity','service_product_limit','service_plan_features',
'status','plan_used','plan_expiry_date','plan_transaction_id','paid_amount','plan_status','purchase_date'

 ];

      // php artisan make:migration create_service_purchase_plans_table --create=service_purchase_plans

}
