<?php

namespace App;
use App\State;
use App\Country;

use Illuminate\Database\Eloquent\Model;

class city extends Model
{
     protected $fillable = [
'country_id','state_id','status','city_name'
	 ];

	   public function state(){
        return $this->belongsTo(State::class);
    }

     public function country(){
        return $this->belongsTo(Country::class);
    }


}
