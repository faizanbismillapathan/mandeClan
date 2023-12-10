<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class customer_bank_detail extends Model
{
    protected $fillable = [
        'bankname', 'branchname', 'ifsc','account','acountname','status','user_id'
	 ];

	 // php artisan make:migration create_customer_bank_details_table --create=customer_bank_details

}
