<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class offline_payment extends Model
{
     protected $fillable = [
'payment_name','description','status','thumbnail'
     ];



  public function user()
    {
        return $this->belongsTo('App\User', 'offline_payment');
    }

}

        
// php artisan make:migration create_offline_payments_table --create=offline_payments
