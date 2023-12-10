<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sim_registration extends Model
{
    protected $fillable = [

'sim_slot_index',
'sim_carrier_name',
'sim_imei_code',
'sim_serial_name',
'sim_phone_name',
'sim_mobile_name',
    'user_id',
    ];
}

      // php artisan make:migration create_sim_registrations_table --create=sim_registrations

