<?php

namespace App;
use App\unit_value;
use Illuminate\Database\Eloquent\Model;

class unit extends Model
{
    protected $fillable = [
'unit_title','status'
	 ];


    public function unit_value(){
        return $this->hasMany(unit_value::class,'unit_id');
    }


public function linkedAttributes(){
        return $this->hasMany('App\ProductAttributes','unit_id');
    }

    
      // php artisan make:migration create_units_table --create=units

}
