<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vehicle_rate_chart extends Model
{
    protected $fillable = [
        'vehicle_rate_chart_id','package_name', 'vehicle_name', 'vehicle_wheel','vehicle_fuel','vehicle_time_slote','status','vehicle_hourly_price','vehicle_daily_price','vehicle_monthly_price','vehicle_weekly_price'
    ];
}

      // php artisan make:migration create_vehicle_rate_charts_table --create=vehicle_rate_charts

