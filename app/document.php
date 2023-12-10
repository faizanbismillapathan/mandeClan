<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class document extends Model
{
     protected $fillable = [
'document_name','status','document_for'
	 ];

}

		
// php artisan make:migration create_documents_table --create=documents
