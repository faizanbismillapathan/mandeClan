<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class role extends Model
{
     protected $fillable = [
'role_name','status'
	 ];



  public function user()
    {
        return $this->belongsTo('App\User', 'role');
    }

}

		
// php artisan make:migration create_roles_table --create=roles
