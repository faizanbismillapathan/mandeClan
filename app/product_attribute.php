<?php

namespace App;
use App\unit_value;
use App\store_category;

use Illuminate\Database\Eloquent\Model;

class product_attribute extends Model
{
    protected $fillable = [
'store_id',
'store_user_id',
'product_id',
'attribute_name',
'attribute_value',
'old_attribute',
'status'
    ];

  


}
