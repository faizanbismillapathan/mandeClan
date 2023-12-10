<?php

namespace App;
use App\city;
use App\country;
use Illuminate\Database\Eloquent\Model;

class state extends Model
{
    protected $fillable = [
'country_id','state_name','status'
	 ];

	    
    public function country(){
        return $this->belongsTo(country::class);
    }

    public function city(){
        return $this->hasMany(city::class);
    }
	 // $table->foreignId('user_id')->constrained('user_tablename')->onDelete('');
}
