<?php
namespace App;

use Illuminate\Database\Eloquent\Model;


class fake extends Model
{
    protected $fillable = [

'attribute',
'key',
'name',

   ];

}
// php artisan make:migration create_fak es_table --create=fakes
