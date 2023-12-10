<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\store;


class service_plan_invoice extends Model
{
     protected $fillable = [

'user_id',
'status',
'service_invoice_id',
'service_email',
'service_mobile',
'service_owner_name',
'service_name',
'admin_name',
'admin_email',
'admin_mobile',
'admin_address',
'transaction_date',
'service_total_amount',
'service_discount_amount',
'service_gst_amount',
'service_payment_gateway',
'admin_gst',
'service_plan_id',
'generated_by',
'service_subtotal',
'service_country',
'service_state',
'service_city',
'service_locality',
'service_category',
'service_address',
'service_pincode',

	 ];




     public function store(){
        return $this->belongsTo(store::class,'service_id');
    }



}
		

 // php artisan make:migration create_service_plan_invoices_table --create=service_plan_invoices