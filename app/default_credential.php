<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class default_credential extends Model
{
    protected $fillable = [
'role',
'mobile',
'otp',
'name',

    ];
}

      // php artisan make:migration create_default_credentials_table --create=default_credentials

