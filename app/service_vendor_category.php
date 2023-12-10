<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\service_subcategory;


class service_vendor_category extends Model
{
       protected $fillable = [
'service_id','service_category_id','service_subcategory_id','user_id','status','service_subcategory'

 ];

      

       public function subcategory(){
        return $this->belongsTo(service_subcategory::class,'service_subcategory_id');
    }


}
 // php artisan make:migration create_service_vendor_categories_table --create=service_vendor_categories
