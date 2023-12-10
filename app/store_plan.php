<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class store_plan extends Model
{
    protected $fillable = [
'store_id',
'plan_expiry_date',
'plan_name',
'plan_price',
'plan_id',
'plan_discount',
'plan_validity',
'product_limit',
'plan_features',
'status',
    ];
}

      // php artisan make:migration create_store_plans_table --create=store_plans

