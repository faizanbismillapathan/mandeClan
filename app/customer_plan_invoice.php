<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\store;


class customer_plan_invoice extends Model
{
     protected $fillable = [

'user_id',
'status',
'customer_invoice_id',
'customer_email',
'customer_mobile',
'customer_owner_name',
'customer_name',
'admin_name',
'admin_email',
'admin_mobile',
'admin_address',
'transaction_date',
'customer_total_amount',
'customer_discount_amount',
'customer_gst_amount',
'customer_payment_gateway',
'admin_gst',
'customer_plan_id',
'generated_by',
'customer_subtotal',
'customer_country',
'customer_state',
'customer_city',
'customer_locality',
'customer_category',
'customer_address',
'customer_pincode',

	 ];




     public function store(){
        return $this->belongsTo(store::class,'customer_id');
    }



}
		

 // php artisan make:migration create_customer_plan_invoices_table --create=customer_plan_invoices