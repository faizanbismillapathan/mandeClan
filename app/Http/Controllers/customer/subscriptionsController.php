<?php

namespace App\Http\Controllers\customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\customer;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Toast;
use App\customer_subscription;
use Carbon\Carbon;
use App\customer_purchase_plan;
use App\customer_plan_invoice;
use App\Traits\MailerTraits;
use Stripe;
use Srmklive\PayPal\Services\PayPal as PayPalClient;


class subscriptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
use MailerTraits;


       public function __construct()
    { 
        $this->middleware('auth');

// dd('4');

        $this->middleware(function ($request, $next) {
          $uspermit = \Auth::user();

// dd(!in_array($uspermit->role, array(1,2)));

          if ( !in_array($uspermit->role, array('1','3'), false ) ) {

// dd('1');
              return redirect()->action('frontend\frontendController@index'); 

          }else{

            if($uspermit->role == '1' && empty(Session::get('customer_id'))){

// dd('2');
              return redirect()->action('frontend\frontendController@index'); 

          }

      }
 

        if (\auth::user()->role == "3") {
      $customer_id=db::table('customers')
             ->where('user_id',\auth::user()->id)
             ->select('id','user_id')
             ->first();

            $this->id=$customer_id->id; 
$this->user_id=$customer_id->user_id;  

   }elseif (\auth::user()->role == "1") {

                    $this->id=session::get('customer_id');
 $this->user_id=session::get('customer_user_id');
}


      return $next($request);
  });


    }

    public function index()
    {

$customer_plans=DB::table('customer_subscriptions')
           ->orderByRaw("FIELD(customer_plan_name,'PLATINUM' , 'GOLD', 'SILVER', 'Free') ASC")
->where('customer_plan_name','<>','Free')
->get();

 $inform=DB::table('customer_purchase_plans')
 ->where('customer_purchase_plans.user_id',$this->user_id)
 ->select('customer_purchase_plans.created_at','customer_purchase_plans.customer_plan_name','customer_purchase_plans.plan_expiry_date','customer_purchase_plans.plan_status','customer_purchase_plans.id')
->where('plan_status','<>','Expired')
 ->first();


        return view('customer.subscriptions.index',compact('inform','customer_plans'));
    }


    public function show($id)
    {

        return view('customer.subscriptions.index',compact('record'));
    }


  public function create()
    {
         $record='';

         return view('customer.subscriptions.create',compact('record'));
    }

    /**
     * customer a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function paypalPost(Request $request)
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
                        "value" => $payable_amount = $request->totalAmount,

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

        
// dd($request);
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

$this->customer_purchase_plan($request);


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

         $payable_amount = $request->totalAmount;


    $user = \Auth::user();
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
      'source' => $request->token,
    ]);

    $charge = \Stripe\Charge::create([
      'customer' => $customer->id,
      'currency' => 'USD',
      'amount' =>  $payable_amount,
      'description' => 'Secure Payment',
    ]);


    if($charge['status'] == 'succeeded') {

// dd($request);

          $return=$this->customer_purchase_plan($request);


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


   
      public function customer_purchase_plan(Request $request)
      {
 

  $record = customer_subscription::find($request->subscription_plan_id); 
   // dd($record);

     $customer_info=customer::find($this->id);
$currentDate=Carbon::now()->toDateTimeString();

$expiryDate=Carbon::now()->addDays($record->customer_plan_validity)->toDateTimeString();


     $plan_data = array(

'user_id'=>$this->user_id,
'customer_plan_name'=>$record->customer_plan_name,
'customer_plan_price'=>$record->customer_plan_price,
'customer_plan_id'=>$record->customer_plan_id,
'customer_plan_discount'=>$record->customer_plan_discount,
'customer_plan_validity'=>$record->customer_plan_validity,
'customer_product_limit'=>$record->customer_product_limit,
'customer_plan_features'=>$record->customer_plan_features,
'status'=>$record->status,
'plan_used'=>'0',
'plan_expiry_date'=>$expiryDate,
// 'plan_transaction_id'=>'SPSP'.$customer_info->customer_name.date('Y'),
'plan_transaction_id'=>$request->token,
'paid_amount'=>$request->totalAmount,
'plan_status'=>'Active',


);
  $plans = new customer_purchase_plan($plan_data);
         $plans->save();






$assordersss = DB::table('customers')
->where('customers.id',$this->id)
->update([
'customer_plan_id' => $request->subscription_plan_id]);





   $admin_info=DB::table('admins')
       ->first();



  

$admin_sgst=0;

 $discount=  ($plans->customer_plan_discount / 100) * $plans->customer_plan_price;
   $discount_amount= $discount;

$subtotal=$plans->customer_plan_price-$discount;

 $gst = ($admin_sgst / 100) * $subtotal; 
$gst_amount= $gst;



if($admin_info->status=='Active'){

$total=$subtotal+$gst;
$gst_amount= $gst;
$admin_sgst= $admin_sgst;


}else{
  $total=$subtotal;
  $gst_amount= 0;
$admin_sgst= '0';

}
if ($record->plan_name=='Free') {
  
  $status='Free';

}else{
  $status='Paid';
}
  $data = array(          
'user_id'=>$this->user_id,
'status'=>$status,
'customer_invoice_id'=> 'StrPI'.$plans->id.date('Y'),
'customer_email'=>$customer_info->customer_email,
'customer_mobile'=>$customer_info->customer_mobile,
'customer_owner_name'=>$customer_info->customer_owner_name,
'customer_name'=>$customer_info->customer_name,
'admin_name'=>$admin_info->admin_name,
'admin_email'=>$admin_info->admin_email,
'admin_mobile'=>$admin_info->admin_mobile,
'admin_address'=>$admin_info->admin_address,
'transaction_date'=>Carbon::now(),
'customer_total_amount'=>number_format((float)$total, 2, '.', ''),
'customer_discount_amount'=>$discount_amount,
'customer_gst_amount'=>$gst_amount,
'customer_payment_gateway'=>$request->payment_method,
'admin_gst'=>$admin_sgst,
'customer_plan_id'=>$plans->id,
'generated_by'=>'customer',
'customer_subtotal'=>$subtotal,
'customer_country'=>$customer_info->country->country_name,
'customer_state'=>$customer_info->state->state_name,
'customer_city'=>$customer_info->city->city_name,
'customer_locality'=>$customer_info->locality->locality_name,
'customer_category'=>$customer_info->category->category_name,
'customer_address'=>$customer_info->customer_address,
'customer_pincode'=>$customer_info->customer_pincode,                
         

);


  $customer_plan_invoice = new customer_plan_invoice($data);
 $customer_plan_invoice->save();




    $invoicepdf = \PDF::loadView('emails.customer_plan_invoice',compact('customer_plan_invoice','plans','admin_info'));


  $mailstatus = $this->customerPurchasePlans($customer_plan_invoice,$plans,$invoicepdf);

// dd($mailstatus);


  $notification = array(
    'message' => 'Your plan was purchase successfully!', 
    'alert-type' => 'success'
);

 
return Redirect::to('customer/plan-history')->with($notification);

}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show1($id)
    {
                 $view='';

        return view('customer.subscriptions.show',compact('view'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($id);
        $record = role::find($id);         
        
         return view('customer.subscriptions.edit',compact('record'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        
        $role = role::find($id); 

   $data = array(
    'role_name'=>$request->input('role_name'),
    
);
         $role->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('customer/subscriptions')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
         $role = role::find($request->id);
          $role->delete();

          return $role;
    }

     public function unsubscribe_plan(Request $request){
 
      
               $updatevender=\DB::table('customer_purchase_plans')->where('id',$request->id)
                              ->update([
                                'plan_status' => $request->status,
                                'plan_expiry_date'=>Carbon::now()->toDateTimeString(),
                                 ]);

               $updatevender=\DB::table('customer_purchase_plans')->where('id',$request->id)
->first();

$enquiry1=user::find($this->user_id);

  
                    
$enquiry=[];
$enquiry['name']=$enquiry1->name;
$enquiry['email']=$enquiry1->email;
$enquiry['subject']= "Your purchase Plan  ".$updatevender->customer_plan_name. " was Expired ";
$enquiry['message']="Your purchase Plan  ".$updatevender->customer_plan_name. " was Expired at ".$updatevender->plan_expiry_date ."Please Update th nw plan";



  $mailstatus = $this->UserStatusUpdate($enquiry);

            return json_encode($request->status);
           
           }


           }


