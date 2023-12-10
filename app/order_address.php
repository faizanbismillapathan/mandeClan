<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order_address extends Model
{
     protected $fillable = [

'order_id',
'store_wise_order_id',
'store_id',
'store_latitude',
'store_longitude',
'customer_latitude',
'customer_longitude',

     ];


}

        
// php artisan make:migration create_order_addresses_table --create=order_addresses,
