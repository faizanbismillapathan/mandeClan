<?php
namespace App;

use Illuminate\Database\Eloquent\Model;


class blog extends Model
{
    protected $fillable = [

'blog_heading',
'blog_description',
'author_name',
'about_author',
'author_designation',
'blog_image',
'status'


   ];

}
// php artisan make:migration create_blogs_table --create=blogs
