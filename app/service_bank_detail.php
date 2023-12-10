<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class service_bank_detail extends Model
{
    protected $fillable = [
        'bankname', 'branchname', 'ifsc','account','acountname','status','user_id'
	 ];

	 // php artisan make:migration create_service_bank_details_table --create=service_bank_details

}
