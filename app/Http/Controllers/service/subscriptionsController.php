<?php

namespace App\Http\Controllers\service;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Toast;
use App\service_subscription;
use App\service;
use Carbon\Carbon;
use App\service_purchase_plan;
use App\service_plan_invoice;
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



          if ( !in_array($uspermit->role, array('1','5'), false ) ) {

// dd('1');
              return redirect()->action('frontend\frontendController@index'); 

          }else{

            if($uspermit->role == '1'  && empty(session::get('service_id'))){

// dd('2');
              return redirect()->action('frontend\frontendController@index'); 

          }

      }
      if (\Auth::user()->role == "5") {
      $service_id=DB::table('services')
             ->where('user_id',\Auth::user()->id)
             ->select('id','user_id','status','kyc_status')
             ->first();

              if ($service_id->kyc_status=='deactive') {
                 
              return redirect()->action('frontend\frontendcontroller@index'); 

             }
             $this->id=$service_id->id; 
$this->user_id=$service_id->user_id;  

   }elseif (\Auth::user()->role == "1") {

                    $this->id=session::get('service_id');
 $this->user_id=session::get('service_user_id');
}


return $next($request);
  });

    }

    public function index()
    {

$service_plans=DB::table('service_subscriptions')
           ->orderByRaw("FIELD(service_plan_name,'PLATINUM' , 'GOLD', 'SILVER', 'Free') ASC")
->where('service_plan_name','<>','Free')
->get();

 $inform=DB::table('service_purchase_plans')
 ->where('service_purchase_plans.user_id',$this->user_id)
 ->select('service_purchase_plans.created_at','service_purchase_plans.service_plan_name','service_purchase_plans.plan_expiry_date','service_purchase_plans.plan_status','service_purchase_plans.id')
->where('plan_status','<>','Expired')
 ->first();


        return view('service.subscriptions.index',compact('inform','service_plans'));
    }


    public function show($id)
    {

        return view('service.subscriptions.index',compact('record'));
    }


  public function create()
    {
         $record='';

         return view('service.subscriptions.create',compact('record'));
    }

    /**
     * Service a newly created resource in storage.
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

$this->service_purchase_plan($request);


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

          $return=$this->service_purchase_plan($request);


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


   
      public function service_purchase_plan(Request $request)
      {
 

  $record = service_subscription::find($request->subscription_plan_id); 
   // dd($record);

     $service_info=service::find($this->id);
$currentDate=Carbon::now()->toDateTimeString();

$expiryDate=Carbon::now()->addDays($record->service_plan_validity)->toDateTimeString();


     $plan_data = array(

'user_id'=>$this->user_id,
'service_plan_name'=>$record->service_plan_name,
'service_plan_price'=>$record->service_plan_price,
'service_plan_id'=>$record->service_plan_id,
'service_plan_discount'=>$record->service_plan_discount,
'service_plan_validity'=>$record->service_plan_validity,
'service_product_limit'=>$record->service_product_limit,
'service_plan_features'=>$record->service_plan_features,
'status'=>$record->status,
'plan_used'=>'0',
'plan_expiry_date'=>$expiryDate,
// 'plan_transaction_id'=>'SPSP'.$service_info->service_name.date('Y'),
'plan_transaction_id'=>$request->token,
'paid_amount'=>$request->totalAmount,
'plan_status'=>'Active',


);
  $plans = new service_purchase_plan($plan_data);
         $plans->save();






$assordersss = DB::table('services')
->where('services.id',$this->id)
->update([
'service_plan_id' => $request->subscription_plan_id]);





   $admin_info=DB::table('admins')
       ->first();



  

$admin_sgst=0;

 $discount=  ($plans->service_plan_discount / 100) * $plans->service_plan_price;
   $discount_amount= $discount;

$subtotal=$plans->service_plan_price-$discount;

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
'service_invoice_id'=> 'StrPI'.$plans->id.date('Y'),
'service_email'=>$service_info->service_email,
'service_mobile'=>$service_info->service_mobile,
'service_owner_name'=>$service_info->service_owner_name,
'service_name'=>$service_info->service_name,
'admin_name'=>$admin_info->admin_name,
'admin_email'=>$admin_info->admin_email,
'admin_mobile'=>$admin_info->admin_mobile,
'admin_address'=>$admin_info->admin_address,
'transaction_date'=>Carbon::now(),
'service_total_amount'=>number_format((float)$total, 2, '.', ''),
'service_discount_amount'=>$discount_amount,
'service_gst_amount'=>$gst_amount,
'service_payment_gateway'=>$request->payment_method,
'admin_gst'=>$admin_sgst,
'service_plan_id'=>$plans->id,
'generated_by'=>'service',
'service_subtotal'=>$subtotal,
'service_country'=>$service_info->country->country_name,
'service_state'=>$service_info->state->state_name,
'service_city'=>$service_info->city->city_name,
'service_locality'=>$service_info->locality->locality_name,
'service_category'=>$service_info->category->category_name,
'service_address'=>$service_info->service_address,
'service_pincode'=>$service_info->service_pincode,                
         

);


  $service_plan_invoice = new service_plan_invoice($data);
 $service_plan_invoice->save();




    $invoicepdf = \PDF::loadView('emails.service_plan_invoice',compact('service_plan_invoice','plans','admin_info'));


  $mailstatus = $this->ServicePurchasePlans($service_plan_invoice,$plans,$invoicepdf);

// dd($mailstatus);


  $notification = array(
    'message' => 'Your plan was purchase successfully!', 
    'alert-type' => 'success'
);

 
return Redirect::to('service/plan-history')->with($notification);

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

        return view('service.subscriptions.show',compact('view'));
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
        
         return view('service.subscriptions.edit',compact('record'));

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

return Redirect::to('service/subscriptions')->with($notification);
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
 
      
               $updatevender=\DB::table('service_purchase_plans')->where('id',$request->id)
                              ->update([
                                'plan_status' => $request->status,
                                'plan_expiry_date'=>Carbon::now()->toDateTimeString(),
                                 ]);




               $updatevender=\DB::table('service_purchase_plans')->where('id',$request->id)
->first();

$enquiry1=user::find($this->user_id);

  
                    
$enquiry=[];
$enquiry['name']=$enquiry1->name;
$enquiry['email']=$enquiry1->email;
$enquiry['subject']= "Your purchase Plan  ".$updatevender->service_plan_name. " was Expired ";
$enquiry['message']="Your purchase Plan  ".$updatevender->service_plan_name. " was Expired at ".$updatevender->plan_expiry_date ."Please Update th nw plan";



  $mailstatus = $this->UserStatusUpdate($enquiry);


            // return json_encode($request->status);

           
           }


           }


