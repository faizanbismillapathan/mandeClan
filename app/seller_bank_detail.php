<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class seller_bank_detail extends Model
{
    protected $fillable = [
        'bankname', 'branchname', 'ifsc','account','acountname','status','user_id'
	 ];

	 // php artisan make:migration create_seller_bank_details_table --create=seller_bank_details

}
