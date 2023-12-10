<?php

namespace App;
use App\unit_value;
use App\store_category;

use Illuminate\Database\Eloquent\Model;

class item_attribut extends Model
{
    protected $fillable = [
        
'store_id',
'product_id',
'item_id',
'attr_name',
'attr_value',

    ];


// php artisan make:migration create_item_attributs_table --create=item_attributs


}
