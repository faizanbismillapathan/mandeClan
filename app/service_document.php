<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class service_document extends Model
{
    protected $fillable = [
'service_id',
'user_id',
'document_name',
'document_file',
'status'
    ];
}

      // php artisan make:migration create_service_documents_table --create=service_documents

