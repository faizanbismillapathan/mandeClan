<?php

namespace App;
use App\unit_value;
use App\store_category;

use Illuminate\Database\Eloquent\Model;

class payment_gateway extends Model
{
    protected $fillable = [
        'payment_gateway_name','status'
    ];


    public function store_category() {

     return $this->belongsTo(payment_setting::class,'payment_id','id');
     
    }


          // php artisan make:migration create_payment_gateways_table --create=payment_gateways


}
