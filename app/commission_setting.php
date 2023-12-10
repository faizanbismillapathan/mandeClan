<?php

namespace App;
use App\stores;
use App\store_category;

use Illuminate\Database\Eloquent\Model;


class commission_setting extends Model
{
    protected $fillable = [
'commission_type','commission_for','commission_rate','status','commission_store_id'
	 ];

	 public function stores(){
    	return $this->belongsTo(stores::class);
    }

public function category(){
     return $this->belongsTo(store_category::class,'id','commission_store_id');
    }
 // php artisan make:migration create_commission_settings_table --create=commission_settings
}
