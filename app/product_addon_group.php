<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product_addon_group extends Model
{
     protected $fillable = [

'store_id',
'user_id',
'product_id',
'addon_group_name',
'addon_group_type',
'status',
'addon_group_validation',


      ];
}

// php artisan make:migration create_product_addon_groups_table --create=product_addon_groups
