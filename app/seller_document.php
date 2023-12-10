<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class seller_document extends Model
{
    protected $fillable = [
'store_id',
'user_id',
'document_name',
'document_file',
'status'
    ];
}

      // php artisan make:migration create_seller_documents_table --create=seller_documents

