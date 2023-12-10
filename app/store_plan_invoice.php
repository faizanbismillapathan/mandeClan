<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\store;


class store_plan_invoice extends Model
{
     protected $fillable = [

'user_id',
'status',
'store_invoice_id',
'store_email',
'store_mobile',
'store_owner_name',
'store_name',
'admin_name',
'admin_email',
'admin_mobile',
'admin_address',
'transaction_date',
'store_total_amount',
'store_discount_amount',
'store_gst_amount',
'store_payment_gateway',
'admin_gst',
'store_plan_id',
'generated_by',
'store_subtotal',
'store_country',
'store_state',
'store_city',
'store_locality',
'store_category',
'store_address',
'store_pincode',

	 ];




     public function store(){
        return $this->belongsTo(store::class,'store_id');
    }



}
		

 // php artisan make:migration create_store_plan_invoices_table --create=store_plan_invoices