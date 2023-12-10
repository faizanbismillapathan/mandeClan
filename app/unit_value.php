<?php

namespace App;
use App\unit;
use Illuminate\Database\Eloquent\Model;

class unit_value extends Model
{
    protected $fillable = [
'unit_value','unit_short_code','unit_id','status'
     ];


    public function unit(){
        return $this->belongsTo(unit::class,'unit_id','id');
    }

      // php artisan make:migration create_unit_values_table --create=unit_values

}
