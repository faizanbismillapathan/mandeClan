<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order_status_management extends Model
{
     protected $fillable = [
'order_id',
'suborder_id',
'status',
'status_date',
'status_resone',

     ];


}

        
// php artisan make:migration create_order_status_managements_table --create=order_status_managements,
