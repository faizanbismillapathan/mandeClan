<?php
namespace App;

use Illuminate\Database\Eloquent\Model;


class store_photo_gallery extends Model
{
    protected $fillable = [

'store_id',
'store_user_id',
'gallery_img',
'status'


   ];

}
// php artisan make:migration create_store_photo_galleries_table --create=store_photo_galleries
