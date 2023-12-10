<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class store_purchase_plan extends Model
{
       protected $fillable = [
'store_plan_name','store_plan_price','user_id',
'store_plan_id','store_plan_discount','store_plan_validity','store_product_limit','store_plan_features',
'status','plan_used','plan_expiry_date','plan_transaction_id','paid_amount','plan_status','purchase_date'

 ];

      // php artisan make:migration create_store_purchase_plans_table --create=store_purchase_plans

}
