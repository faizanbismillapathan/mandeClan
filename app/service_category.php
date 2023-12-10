<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class service_category extends Model
{
       protected $fillable = [
'category_name','status','category_img','category_thumbnail_img' ,'category_title','category_url','sort'];

      
}
