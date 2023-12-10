<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\state;
use App\country;
use App\city;
use App\locality;
use App\customer;

class customer_address_book extends Model
{
    protected $fillable = [
'user_id',
'name',
'email',
'mobile',
'phone',
'country',
'state',
'city',
'locality',
'pincode',
'address',
'address_2',
'latitude',
'longitude',
   ];



 public function states(){
        return $this->belongsTo(state::class,'state');
    }

     public function countrys(){
        return $this->belongsTo(country::class,'country');
    }

     public function citys(){
        return $this->belongsTo(city::class,'city');
    }

  
    public function localitys(){
        return $this->hasOne(locality::class,'id','locality');
    }
 public function customers(){
        return $this->hasOne(customer::class,'user_id','user_id');
    }

}
// php artisan make:migration create_customer_address_books_table --create=customer_address_books

// php artisan migrate --path=/database/migrations/2022_03_10_121053_create_customer_address_books_table.php