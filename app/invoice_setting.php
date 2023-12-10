<?php

namespace App;
use App\unit_value;
use App\store_category;

use Illuminate\Database\Eloquent\Model;

class invoice_setting extends Model
{
    protected $fillable = [
       'order_id_prefix','order_id_postfix','suborder_id_prefix','suborder_id_postfix','invoice_terms','invoice_logo','invoice_signature'
    ];


  // php artisan make:migration create_invoice_settings_table --create=invoice_settings


}
