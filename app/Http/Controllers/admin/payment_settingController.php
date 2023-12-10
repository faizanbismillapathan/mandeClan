<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;
use DotenvEditor;
use App\bank_detail;

class payment_settingController extends Controller
{
        protected $config;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    { 
        $this->middleware('auth');
       $this->middleware(function ($request, $next) {
          $uspermit = \Auth::user();
          if($uspermit->role != '1'){
              return redirect()->action('frontend\frontendController@index',['id' => 'Nagpur']);  
          }

           $this->config = config::first();
          return $next($request);
      });
    }
    
        public function index(Request $request)
    {
       
       
        $configs = config::first();

        $bank_detail = bank_detail::first();

return view('admin.payment_setting.index',compact('configs','bank_detail'));
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $record='';

         return view('admin.payment_setting.create',compact('record'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
         $data = array(
    'payment_name'=>$request->input('payment_name'),
    
);
         $payment_setting = new payment_setting($data);
         $payment_setting->save();
                 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::back()->with($notification);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
                 $view='';

        return view('admin.payment_setting.show',compact('view'));
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
        $record = payment_setting::find($id);         
        
         return view('admin.payment_setting.edit',compact('record'));

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
        
        $payment_setting = payment_setting::find($id); 

   $data = array(
    'payment_name'=>$request->input('payment_name'),
    
);
         $payment_setting->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
         $payment_setting = payment_setting::find($request->id);
          $payment_setting->delete();

          return $payment_setting;
    }

    

   

    public function updatePaytm(Request $request)
    {
        $input = $request->all();

        $env_keys_save = DotenvEditor::setKeys([
            'PAYTM_ENVIRONMENT' => $input['PAYTM_ENVIRONMENT'], 'PAYTM_MERCHANT_ID' => $input['PAYTM_MERCHANT_ID'], 'PAYTM_MERCHANT_KEY' => $input['PAYTM_MERCHANT_KEY'],
        ]);

        $env_keys_save->save();

        $this->config->paytm_enable = isset($request->paytmchk) ? 1 : 0;

        $this->config->save();

        return back()
            ->with('updated', 'Paytm settings has been updated !');
    }

    public function updaterazorpay(Request $request)
    {
        $input = $request->all();

        $env_keys_save = DotenvEditor::setKeys([
            'RAZOR_PAY_KEY' => $input['RAZOR_PAY_KEY'], 
            'RAZOR_PAY_SECRET' => $input['RAZOR_PAY_SECRET'],
        ]);

        $env_keys_save->save();

        $this->config->razorpay = isset($request->rpaycheck ) ? 1 : 0;

        $this->config->save();

        return back()
            ->with('updated', 'Razorpay settings has been updated !');

    }

    public function saveStripe(Request $request)
    {
        $input = $request->all();

        $env_keys_save = DotenvEditor::setKeys([
            'STRIPE_KEY' => $input['STRIPE_KEY'],
            'STRIPE_SECRET' => $input['STRIPE_SECRET'],
        ]);

        $env_keys_save->save();

        $this->config->stripe_enable = isset($request->strip_check) ? "1" : "0";

        $this->config->save();

        return back()->with('updated', 'Stripe settings has been updated !');
    }

    public function saveBraintree(Request $request)
    {
        $input = $request->all();

        $env_keys_save = DotenvEditor::setKeys([
            'BRAINTREE_ENV' => $input['BRAINTREE_ENV'],
            'BRAINTREE_MERCHANT_ID' => $input['BRAINTREE_MERCHANT_ID'],
            'BRAINTREE_PUBLIC_KEY' => $input['BRAINTREE_PUBLIC_KEY'],
            'BRAINTREE_PRIVATE_KEY' => $input['BRAINTREE_PRIVATE_KEY'],
            'BRAINTREE_MERCHANT_ACCOUNT_ID' => $input['BRAINTREE_MERCHANT_ACCOUNT_ID']
        ]);

        $env_keys_save->save();

        $this->config->braintree_enable = isset($request->braintree_enable) ? "1" : "0";

        $this->config->save();

        return back()->with('updated', 'Stripe settings has been updated !');
    }

    public function savePaypal(Request $request)
    {

        $input = $request->all();


        $env_keys_save = DotenvEditor::setKeys([

            'PAYPAL_CLIENT_ID' => $input['PAYPAL_CLIENT_ID'], 
            'PAYPAL_SECRET' => $input['PAYPAL_SECRET'], 
            'PAYPAL_MODE' => $input['PAYPAL_MODE'],
            'PAYPAL_SANDBOX_CLIENT_ID' => $input['PAYPAL_CLIENT_ID'],
            'PAYPAL_SANDBOX_CLIENT_SECRET'=> $input['PAYPAL_SECRET'], 

        ]);

        $env_keys_save->save();


$notification = array(
    'message' => 'Paypal settings has been updated !', 
    'alert-type' => 'success'
);
        return back()->with($notification);

    }



    public function status_setting(Request $request)
    {

// dd($request);
    
    $record=config::find(1);
      
          if($record[$request->name]=='1'){
               $updatevender=\DB::table('configs')->where('id',1)
                              ->update([
                                $request->name => 0,
                                 ]);
            return json_encode('Deactive');

           } else {
              $updateuser=\DB::table('configs')->where('id',1)
                              ->update([
                                $request->name => 1,
                                 ]);

              return json_encode('Active');

        }




        $this->config->$request->name = isset($request->name) ? 1 : 0;

        $this->config->save();

$notification = array(
    'message' => 'Paypal settings has been updated !', 
    'alert-type' => 'success'
);
        return back()->with($notification);

    }


  

    public function updateSkrill(Request $request){

        $input = $request->all();

        $this->config->skrill_enable = isset($request->skrill_enable) ? 1 : 0;

        $env_keys_save = DotenvEditor::setKeys([

            'SKRILL_MERCHANT_EMAIL' => $input['SKRILL_MERCHANT_EMAIL'],
            'SKRILL_API_PASSWORD' => $input['SKRILL_API_PASSWORD']

        ]);

        $env_keys_save->save();

        $this->config->save();
        notify()->success('Skrill payment settings has been updated !');
        return back();
    }



    public function bank_details(Request $request)
    {



 $data = array(
    'bankname'=>$request->input('bankname'),
    'branchname'=>$request->input('branchname'),
    'ifsc'=>$request->input('ifsc'),
    'account'=>$request->input('account'),
    'acountname'=>$request->input('acountname'),
);
         $bank_detail = new bank_detail($data);
         $bank_detail->save();

// dd($bank_detail);
               
$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::back()->with($notification);


    }



    public function bank_details_update(Request $request,$id)
    {

$bank_detail=bank_detail::first();
   // dd($bank_detail);


  $data = array(
    'bankname'=>$request->input('bankname'),
    'branchname'=>$request->input('branchname'),
    'ifsc'=>$request->input('ifsc'),
    'account'=>$request->input('account'),
    'acountname'=>$request->input('acountname'),
);
         $bank_detail->update($data);



$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);
           
 
return Redirect::back()->with($notification);

 }
  
}
