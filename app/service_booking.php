<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\service;
use App\customer;

class service_booking extends Model
{
        protected $fillable = ['title','start_date','end_date','status','description','service_user_id','user_id','booking_date','booked_by','booking_amount','advance_amount','payment_mode','booking_subcategory'];




     public function service(){
        return $this->belongsTo(service::class,'user_id','service_user_id');
    }


     public function customer(){
        return $this->belongsTo(customer::class,'user_id');
    }
         // php artisan make:migration create_service_bookings_table --create=service_bookings

}
