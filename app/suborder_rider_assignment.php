<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class suborder_rider_assignment extends Model
{
     protected $fillable = [

'rider_regis_id',
'suborder_id',
'rider_userid',
'status',
'rider_accept_order_status',
'rider_status_updated_by',
'rider_status_update_date'



     ];


}

        
// php artisan make:migration create_suborder_rider_assignments_table --create=suborder_rider_assignments,
