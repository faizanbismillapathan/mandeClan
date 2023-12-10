<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class page extends Model
{
    protected $fillable = [
        'page_name','page_slug','description','status'
    ];

   // php artisan make:migration create_pages_table --create=pages

}
