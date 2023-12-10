<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product_addon extends Model
{
     protected $fillable = [

'addon_group_id',
'addon_group_name',
'addon_name',
'addon_price',
'status',



      ];
}

// php artisan make:migration create_product_addons_table --create=product_addons
