<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bank_detail extends Model
{
    protected $fillable = [
        'bankname', 'branchname', 'ifsc','account','acountname','status','swift_code'
    ];
}

      // php artisan make:migration create_bank_details_table --create=bank_details

