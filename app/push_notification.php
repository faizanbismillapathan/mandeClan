<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class push_notification extends Model
{
    protected $fillable = [
'subject',
'body',
'target_url',
'icon',
'image',
'show_button',
'button_text',
'button_url',
'status'

    ];



 // php artisan make:migration create_push_notifications_table --create=push_notifications


}
