<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class rv_bank_detail extends Model
{
    protected $fillable = [
        'bankname', 'branchname', 'ifsc','account','acountname','status','user_id'
	 ];

	 // php artisan make:migration create_rv_bank_details_table --create=rv_bank_details

}
