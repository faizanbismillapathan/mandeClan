<?php

namespace App;
use App\unit_value;
use App\store_category;

use Illuminate\Database\Eloquent\Model;

class faq extends Model
{
    protected $fillable = [
        'question','answer','status'
    ];



          // php artisan make:migration create_faqs_table --create=faqs


}
