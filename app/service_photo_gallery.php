<?php
namespace App;

use Illuminate\Database\Eloquent\Model;


class service_photo_gallery extends Model
{
    protected $fillable = [

'service_id',
'service_user_id',
'gallery_img',
'status'


   ];

}
// php artisan make:migration create_service_photo_galleries_table --create=service_photo_galleries
