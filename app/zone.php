<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class zone extends Model
{
    
	protected $fillable = [
	        'zone_name','zone_country', 'zone_code','status','zone_state',
	    ];

	// protected $casts = [
 //    	'zone_state' => 'array', 
	// ];

	public function country(){
        return $this->belongsTo(country::class,'country_id');
    }

    public function state(){
        return $this->belongsTo(state::class,'state_id');
    }
      // php artisan make:migration create_zones_table --create=zones

}
