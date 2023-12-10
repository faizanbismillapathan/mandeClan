<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rv_document extends Model
{
    protected $fillable = [
'rv_register_id',
'user_id',
'document_name',
'document_file',
'status'
    ];
}

      // php artisan make:migration create_rv_documents_table --create=rv_documents

