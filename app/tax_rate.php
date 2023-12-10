<?php

namespace App;
use App\state;
use App\city;
use App\locality;

use Illuminate\Database\Eloquent\Model;


class tax_rate extends Model
{
    protected $fillable = [
'tax_name',
'tax_zone',
'tax_type',
'tax_rate',
'status',

	 ];

// php artisan make:migration create_tax_rates_table --create=tax_rates

	 
}
