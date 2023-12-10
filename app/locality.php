<?php

namespace App;
use App\state;
use App\country;
use App\city;

use Illuminate\Database\Eloquent\Model;

class locality extends Model
{
     protected $fillable = [
'country_id','state_id','status','city_id','locality_name','pincode','locality_url'
	 ];

	   public function state(){
        return $this->belongsTo(state::class);
    }

     public function country(){
        return $this->belongsTo(country::class);
    }

     public function city(){
        return $this->belongsTo(city::class);
    }

// php artisan make:migration create_localities_table --create=localities

}
