<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class service_plan extends Model
{
    protected $fillable = [
'service_id',
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

      // php artisan make:migration create_service_plans_table --create=service_plans

