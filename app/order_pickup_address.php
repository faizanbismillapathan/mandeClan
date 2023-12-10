<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order_pickup_address extends Model
{
     protected $fillable = [

'order_id',
'store_id',
'store_latitude',
'store_longitude',
'store_country',
'store_state',
'store_city',
'store_locality',
'store_pincode',
'store_address',


     ];


}

        
// php artisan make:migration create_order_pickup_addresses_table --create=order_pickup_addresses,
