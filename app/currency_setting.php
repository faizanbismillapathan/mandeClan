<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class currency_setting extends Model
{
     protected $fillable = [
'currency_code',
'currency_exchange_rate',
'currency_position',
'currency_symbol',
'status'

 ];



  
}

        
// php artisan make:migration create_currency_settings_table --create=currency_settings
