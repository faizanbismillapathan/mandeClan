<?php
namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\store;
use App\locality;
use App\customer;
use App\product;
use App\wishlist;
use App\product_item;
use Auth;
use View;
use \Cart as Cart;
use App\customer_address_book;
use App\config;
use App\bank_detail;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\order;
use App\suborder;
use App\order_item;
use App\order_address;
use App\order_delivery_address;
use App\order_pickup_address;
use App\Traits\MailerTraits;
use App\order_addon;
use App\order_status_management;
use Stripe;
use Srmklive\PayPal\Services\ExpressCheckout;
use App\service_booking;



class checkoutController extends Controller
{

  use MailerTraits;

 public function __construct()
    { 
        $this->middleware('auth');
      
    }

public function checkout(Request $request)
{   


    $products=Cart::getContent();



$total_weight_gram=0;
$total_weight_kg=0;
$total_weight_lb=0;
$total_weight_oz=0;

$total_price=0;
$discount_price=0;
$total_main_price=0;
$store_ids=[];
$total_tax_price=0;


foreach($products as $index=>$data){


// $total_price+=$data->price*$data->quantity;
$total_price+=round($data->associatedModel->item_selling_price,2)*$data->quantity;

$total_main_price+=round($data->associatedModel->item_price,2)*$data->quantity;

$store_ids[]=$data->associatedModel->store_id;

$discount_price=round($total_main_price-$total_price,2);

$total_tax_price = round($total_price * (18 / 100),2);

if ($data->associatedModel->item_shipping_weight_unit=='g') {
$total_weight_gram+=$data->associatedModel->item_shipping_weight;
}

if ($data->associatedModel->item_shipping_weight_unit=='kg') {
$total_weight_kg+=$data->associatedModel->item_shipping_weight;
}


if ($data->associatedModel->item_shipping_weight_unit=='lb') {
$total_weight_lb+=$data->associatedModel->item_shipping_weight;
}


if ($data->associatedModel->item_shipping_weight_unit=='oz') {
$total_weight_oz+=$data->associatedModel->item_shipping_weight;
}


}



// dd($item_selling_price);
   
   $kg_g=$total_weight_kg*1000;

   $lb_g=$total_weight_lb*453.592;

   $oz_g=$total_weight_oz*28.3495;


$all_gram=$total_weight_gram+$kg_g+$lb_g+$oz_g;

$all_kg=round($all_gram/1000,2);

$subtotal=round($total_main_price-$discount_price+$total_tax_price,2);


$customer=customer::where('user_id',Auth::user()->id)
->first();


$addressBook=customer_address_book::where('user_id',Auth::user()->id)->get();


        $configs = config::first(); 

        $bank_detail = bank_detail::first();




    return view('frontend.checkout',compact('products','all_kg','customer','addressBook','configs','bank_detail','total_main_price','discount_price','store_ids','subtotal','total_tax_price','total_price'));

}



 

    /*
     * process transaction.
     */


    public function processTransaction(Request $request)
    {

        // dd($request);
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('successTransaction'),
                "cancel_url" => route('cancelTransaction'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $payable_amount = (int)Cart::getTotal(),

                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {

            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }

            return redirect()
                ->back()
                ->with('error', 'Something went wrong.');

        } else {
            return redirect()
                ->back()
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    /*
     * success transaction.
     */



    public function successTransaction(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);


$this->checkout_order($request,'Paid');


        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            return redirect()
                ->back()
                ->with('success', 'Transaction complete.');
        } else {
            return redirect()
                ->back()
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    /*
     * cancel transaction.
     */


    public function cancelTransaction(Request $request)
    {
        return redirect()
            ->back()
            ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }


  public function stripePost(Request $request)
    {


          // ...............................

         $payable_amount = (int)Cart::getTotal();


    $user = Auth::user();
    Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    $customer = \Stripe\Customer::create([
      'name' => $user->name,
      'email' => $user->email,
      'address' => [
         'line1' => '510 Townsend St',
         'postal_code' => '98140',
         'city' => 'San Francisco',
         'state' => 'CA',
         'country' => 'US',
      ],
      'source' => $request->stripeToken,
    ]);

    $charge = \Stripe\Charge::create([
      'customer' => $customer->id,
                // 'card' => $response->id, value
      'currency' => 'USD',
      'amount' =>  $payable_amount,
      'description' => 'Secure Payment',
    ]);


    if($charge['status'] == 'succeeded') {

// dd($request);

          $return=$this->checkout_order($request,'Paid');


// dd($return);

$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);


return Redirect::to('thanku')->with($notification);


    } else {

$notification = array(
    'message' => 'something went to wrong.', 
    'alert-type' => 'error'
);


return Redirect::to('thanku')->with($notification);
           
    }

    }



// ................................


     public function checkout_order(Request $request,$paid=null){


if (is_array($request->store_id)) {

       $store_ids=$request->store_id;

}else{

   $store_ids=explode(',',$request->store_id);

}

if (empty($paid)) {
    $paid='Unpaid';
}

$store_id=array_unique($store_ids);


// dd($store_id);
$users=DB::table('customers')
->where('user_id',Auth::user()->id)
->select('id','user_id','customer_userid','customer_name as name','customer_email as email','customer_mobile as mobile')
->first();



$shop=DB::table('stores')
->whereIn('id',$store_id)
->select(
'id',
'store_latitude',
'store_longitude',
'store_city',
'store_locality',
)
->first();

$invoices=DB::table('invoice_settings')
->select('order_id_prefix','order_id_postfix','suborder_id_prefix','suborder_id_postfix','invoice_terms','invoice_logo','invoice_signature')
->first();

// dd($invoices);

    $products=Cart::getContent();



$item_selling_price=[];
$sub_products=[];

$total_price=[];
$total_price1=[];

foreach($products as $index=>$data){

$item_selling_price[$data->associatedModel->store_id][]=$data->price*$data->quantity;

$sub_products[$data->associatedModel->store_id][]=$data;

$total_main_price1[$data->associatedModel->store_id][]=round($data->associatedModel->item_price,2)*$data->quantity;

$total_price1[$data->associatedModel->store_id][]=round($data->associatedModel->item_selling_price,2)*$data->quantity;


$item_selling_price1[]=$data->price*$data->quantity;

$total_main_price11[]=round($data->associatedModel->item_price,2)*$data->quantity;

$total_price11[]=round($data->associatedModel->item_selling_price,2)*$data->quantity;

}



$stores=DB::table('stores')
->join('products','products.store_id','stores.id')
->whereIn('stores.id',$store_id)
->select('stores.id',
'stores.store_latitude',
'stores.store_longitude',
'stores.store_city',
'stores.user_id',
'stores.store_unique_id',
'stores.store_state',
'stores.store_country',
'stores.store_locality',
'stores.store_pincode',
'stores.store_address',
)
->groupby('stores.id')
->get();

// dd($stores);


         $autoincid = mt_rand(10,100);
         $Y = date('Ys');
         $keydata = 'Tran'.$Y.''.$autoincid;



$subtotal = isset($item_selling_price1) ? array_sum($item_selling_price1) : 0;

$count11 = isset($total_main_price11) ? array_sum($total_main_price11) : 0;
$count22 = isset($total_price11) ? array_sum($total_price11) : 0;

$save_price=$count11-$count22;
$tax_price = $count22 * (18 / 100);

$grand_total=$count11-$save_price+$tax_price;




$data = array(
'customer_id'=>$users->id,
'customer_user_id'=>$users->user_id,
'customer_u_id'=>$users->customer_userid,
'payment_method'=>$request->payment_method,
'total_tip_price'=>'10',
'tip_order_status'=>'Paid',
'delivery_date'=>$request->delivery_date,
'delivery_time'=>$request->delivery_time,
'transection_id'=>$keydata,
'order_date'=>Carbon::now()->toDateTimeString(),
'total_order_item'=>$products->count(),
'total_suborder'=>count($store_id),
'paid_unpaid_status'=>$paid,
'coupan_discount'=>0,
'shipping_charges'=>0,
'subtotal'=>$subtotal,
'grand_total'=>$grand_total,
'order_status'=>'Pending',
'pickup_type'=>$request->pickup_type,
'total_tax'=>18,
'tax_price'=>$tax_price,
'save_price'=>$save_price,
);

      // dd($data);


         $order = new order($data);
         $order->save();
                 
  DB::table('orders')
  ->where('id',$order->id)
  ->update([

'order_u_id'=>$invoices->order_id_prefix.date("y").'c'.$order->id.$invoices->order_id_postfix,

  ]);
$order=  DB::table('orders')
  ->where('id',$order->id)->first();


$order_subtotal=[];
$order_items=[];


$store_wise_subtotal=[];
$store_wise_items=[];
$sub_product_new=[];

// dd($stores);

foreach($stores as $index=>$shop)
{


$count = isset($item_selling_price[$shop->id]) ? count($item_selling_price[$shop->id]) : 0;
$subtotal = isset($item_selling_price[$shop->id]) ? array_sum($item_selling_price[$shop->id]) : 0;


$count1 = isset($total_main_price1[$shop->id]) ? array_sum($total_main_price1[$shop->id]) : 0;
$count2 = isset($total_price1[$shop->id]) ? array_sum($total_price1[$shop->id]) : 0;

$discount_price=$count1-$count2;
$total_tax_price = round($count2 * (18 / 100),2);

$grand_total=$count1-$discount_price+$total_tax_price;

    $suborder_data = array(
'store_id'=>$shop->id,
'store_user_id'=>$shop->user_id,
'store_u_id'=>$shop->store_unique_id,
'customer_id'=>$users->id,
'customer_user_id'=>$users->user_id,
'customer_u_id'=>$users->customer_userid,
'order_id'=>$order->id,
'delivery_date'=>$request->delivery_date,
'delivery_time'=>$request->delivery_time,
'payment_method'=>$request->payment_method,
'tip_price'=>10,
'tip_order_status'=>'Paid',
'transection_id'=>$keydata,
'total_item'=>$count,
'paid_unpaid_status'=>$paid,
'gift_packing_charges'=>0,
'subtotal'=>$subtotal,
'shipping_charges'=>0,
'grand_total'=>$grand_total,
'order_status'=>'Pending',
'order_date'=>Carbon::now()->toDateTimeString(),
'pickup_type'=>$request->pickup_type,
'total_tax'=>18,
'tax_price'=>$total_tax_price,
'discount_price'=>$discount_price,
);

    // dd($suborder_data);


 $suborder = new suborder($suborder_data);
         $suborder->save();

                


  DB::table('suborders')
  ->where('id',$suborder->id)
  ->update([
 'suborder_u_id'=>$invoices->suborder_id_prefix.date("y").$suborder->id.$invoices->suborder_id_postfix,

  ]);

$suborder=  DB::table('suborders')
->select('payment_method',
    'id',
'suborder_u_id',
'grand_total',
'order_date',
'delivery_date',
'subtotal',
'shipping_charges','delivery_time','pickup_type',
'total_tax',
'tax_price',
'discount_price',
)
  ->where('id',$suborder->id)->first();

    $order_subtotal[$shop->id]=$suborder;




    $sub_product = isset($sub_products[$shop->id]) ? $sub_products[$shop->id] : [];



foreach($sub_product as $index=>$addTocart){

$addon_name_price='';
$addon_id_groupid='';


if (isset($addTocart->associatedModel->addon_list)) {
   
$addon_name_price=serialize($addTocart->associatedModel->addon_list);
$addon_id_groupid=serialize($addTocart->associatedModel->addon_id);

  }


$item=DB::table('stores')
->join('products','products.store_id','stores.id')
->join('product_items','products.id','product_items.product_id')
->select('product_items.*','products.id','products.product_name','products.product_unique_id')
->where('product_items.id',$addTocart->id)
->where('stores.id',$addTocart->associatedModel->store_id)
->first();



  $item_data = array(
'order_id'=>$order->id,
'store_id'=>$addTocart->associatedModel->store_id,
'suborder_id'=>$suborder->id,
'product_id'=>$item->id,
'product_u_id'=>$item->product_unique_id,
'product_name'=>$item->product_name,
'item_barcode'=>$item->item_barcode,
'item_hsn_sac_code'=>$item->item_hsn_sac_code,
'item_sku'=>$item->item_sku,
'item_id'=>$addTocart->id,
'base_price'=>$item->item_price,
'item_price'=>$addTocart->associatedModel->item_price,
'item_selling_price'=>$addTocart->price,
'item_offer_discount'=>$item->item_offer_discount,
'item_img1'=>$item->item_img1,
'item_img2'=>$item->item_img2,
'item_img3'=>$item->item_img3,
'item_img4'=>$item->item_img4,
'item_status'=>'Pending',
'item_quantity'=>$addTocart->quantity,
'item_description'=>$addTocart->associatedModel->item_description,
'item_attr_key'=>$item->item_attr_key,
'item_attr_varient'=>$item->item_attr_varient,
'array_combine'=>$item->array_combine,
'item_shipping_weight'=>$item->item_shipping_weight,
'item_shipping_weight_unit'=>$item->item_shipping_weight_unit,
'product_item_status'=>$item->product_item_status,
'addon_name_price'=>$addon_name_price,
'addon_id_groupid'=>$addon_id_groupid,
'commission_percent'=>$addTocart->associatedModel->commission_percent,
'commission_amount'=>$addTocart->associatedModel->commission_amount,
'item_shipping_charge'=>$addTocart->associatedModel->item_shipping_charge,
'item_tax'=>18,
'item_tax_price'=>$addTocart->associatedModel->item_selling_price * (18 / 100),

);


 $order_item = new order_item($item_data);
         $order_item->save();

DB::table('order_items')
  ->where('id',$order_item->id)
  ->update([
'item_u_id'=>$invoices->suborder_id_prefix.date("y").$order_item->id.$suborder->id.$invoices->suborder_id_postfix,

  ]);



  $order_items[]=$order_item;
    $store_wise_items[$addTocart->associatedModel->store_id][$order_item->id]=$order_item;



}





    $suborder_data = array(
'order_id'=>$order->id,
'suborder_id'=>$suborder->id,
'status'=>'Pending',
'status_date'=>Carbon::now()->toDateTimeString(),
'status_resone'=>'',
);


 $order_status_management = new order_status_management($suborder_data);
         $order_status_management->save();




// dd($sub_products);

}




// dd($sub_product_new);



$addressBook='';

    if ($request->pickup_type=="Home Delivery") {

$addressBook=customer_address_book::where('id',$request->address_book)->first();

if (!empty($addressBook)) {
   
  $delivery_data = array(

'order_id'=>$order->id,
'store_id'=>$shop->id,
'customer_id'=>$users->id,
'customer_user_id'=>$users->user_id,
'customer_u_id'=>$users->customer_userid,
'customer_name'=>$addressBook->name,
'customer_email'=>$addressBook->email,
'customer_mobile'=>$addressBook->mobile,
'customer_phone'=>$addressBook->phone,
'customer_country'=>$addressBook->country,
'customer_state'=>$addressBook->state,
'customer_city'=>$addressBook->city,
'customer_locality'=>$addressBook->locality,
'customer_pincode'=>$addressBook->pincode,
'customer_address'=>$addressBook->address,
'customer_latitude'=>$addressBook->latitude,
'customer_longitude'=>$addressBook->longitude,

    );


// dd($delivery_data);
 $order_delivery = new order_delivery_address($delivery_data);
         $order_delivery->save();
 // code...
}

}

  $pickup_data = array(

'order_id'=>$order->id,
'store_id'=>$shop->id,
'store_latitude'=>$shop->store_latitude,
'store_longitude'=>$shop->store_longitude,
'store_country'=>$shop->store_country,
'store_state'=>$shop->store_state,
'store_city'=>$shop->store_city,
'store_locality'=>$shop->store_locality,
'store_pincode'=>$shop->store_pincode,
'store_address'=>$shop->store_address,


    );

  // dd($pickup_data);


 $order_pickup = new order_pickup_address($pickup_data);
         $order_pickup->save();


// dd($order->delivery_time);

             $invoicepdf = \PDF::loadView('emails.order_invoice',compact('order_items','order','addressBook','users'));

  $mailstatus = $this->OrderCustomerEmail($addressBook,$invoicepdf,$order,$order_items,$users);


// dd($mailstatus);
foreach ($store_wise_items as $key => $order_items) {


$store=DB::table('stores')
->join('products','products.store_id','stores.id')
->where('stores.id',$key)
->select('stores.id',
'stores.store_owner_email',
'stores.store_name',
'stores.store_email'
)
->groupby('stores.id')
->first();


$order=$order_subtotal[$key];

// dd($order);
   
  $invoicepdf = \PDF::loadView('emails.order_invoice',compact('order_items','order','addressBook','users'));
  $mailstatus = $this->OrderVendorEmail($store,$addressBook,$invoicepdf,$order,$order_items,$users);
}


// dd($mailstatus);

Cart::clear();

$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);


return Redirect::to('thanku')->with($notification);
}



public function track_ordservice_bookinger(Request $request)
{   

    $header_not_display='Yes';

    // dd(Session::get('customer_user_id'));

    

    return view('frontend.track_order',compact('header_not_display'));
}



public function service_booking(Request $request)
{   

// $both=$request->booking_date;

//  if (!empty($both)) {
//    $str= explode(' - ', $both);
//    $start_date=$str[0];
//    $end_date=$str[1];

// }else{
//     $start_date='';
//     $end_date='';
// }

$users_id=$request->input('user_id');


$data = array(
  
'title'=>$request->input('title'),
'start_date'=>$request->start_date,
'end_date'=>$request->end_date,
'status'=>'Pending',
'description'=>$request->input('description'),
'service_user_id'=>$request->service_user_id,
'user_id'=>Auth::user()->id,
'booking_date'=>$request->start_date.'-'.$request->end_date,
'booked_by'=>'Customer',
'booking_amount'=>$request->input('booking_amount'),
'advance_amount'=>$request->input('advance_amount'),
'payment_mode'=>$request->input('payment_mode'),
'booking_subcategory'=>implode(',',$request->input('booking_subcategory')),

);

// dd($data);
$events = new service_booking($data);
$events->save();


     return redirect()
                ->back()
                ->with('success', 'Send enquiry successfully.');

            }



}