<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_account_delete extends Model
{
    protected $fillable = [
'user_id',
'status_reason',
'status_comment',
'status'
    ];
}

      // php artisan make:migration create_user_account_deletes_table --create=user_account_deletes

