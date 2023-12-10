<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class term_condition extends Model
{
     protected $fillable = [

'title','description','role',

     ];



}

        
// php artisan make:migration create_term_conditions_table --create=term_conditions
