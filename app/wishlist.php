<?php
namespace App;

use Illuminate\Database\Eloquent\Model;


class wishlist extends Model
{
    protected $fillable = [
'store_id',
'product_id',
'store_user_id',
'persone_name',
'persone_role',
'persone_user_id',
'status',



   ];

}
// php artisan make:migration create_wishlists_table --create=wishlists
