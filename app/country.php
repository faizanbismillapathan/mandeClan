<?php

namespace App;
use App\state;
use App\city;
use App\locality;

use Illuminate\Database\Eloquent\Model;


class country extends Model
{
    protected $fillable = [
'country_name','status'
	 ];

	 public function state(){
    	return $this->hasMany(state::class);
    }

     public function city(){
    	return $this->hasMany(city::class);
    }

      public function locality(){
    	return $this->hasMany(locality::class);
    }
}
