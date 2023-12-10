<?php

namespace App\Http\Controllers\seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\seller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Toast;
use Auth;
use Carbon\Carbon;
 use App\Traits\MailerTraits;

class change_contactnoController extends Controller
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

          if ( !in_array($uspermit->role, array('1','2'), false ) ) {

// dd('1');
              return redirect()->action('frontend\frontendController@index'); 

          }else{

            if($uspermit->role == '1'  && empty(session::get('store_id'))){

// dd('2');
              return redirect()->action('frontend\frontendController@index'); 

          }

      }if (\Auth::user()->role == "2") {
      $store_id=DB::table('stores')
             ->where('user_id',\Auth::user()->id)
             ->select('id','user_id','status','kyc_status')
             ->first();

             if ($store_id->kyc_status=='deactive') {
                 
              return redirect()->action('frontend\frontendcontroller@index'); 

             }
$this->id=$store_id->id; 
$this->user_id=$store_id->user_id;  

   }elseif (\Auth::user()->role == "1") {

                    $this->id=session::get('store_id');
 
$this->user_id=session::get('store_user_id');
}


return $next($request);
  });

    }

    public function index()
    {


$record=DB::table('users')->where('id',$this->user_id)->first();




        return view('seller.change_contactno.index',compact('record'));
    }


    public function show($id)
    {

        return view('seller.change_contactno.index',compact('record'));
    }


  public function create()
    {
         $record='';

         return view('seller.change_contactno.create',compact('record'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

      public function verify_seller_mobile(Request $request)
    {

  $otp=$request->otp;

  $oldmobile=$request->mobile;
  $new_mobile=$request->new_mobile;




if (!empty($new_mobile)) {
    
    $mobile=$new_mobile;
}else{

    $mobile=$oldmobile;

}

$authkey = "200724AR8yxdF4IH5a9a6fe2";
$otplength = "4";
$otpexpiry = "5";
$sender = "IAMFRE";
$dlt_te_id="1207164933408332267";
$template_id="6276603bcfc15f33d50cebcb";
$status="verifyotp";



       if($status=='verifyotp'){
                $sentotpotp = "https://api.msg91.com/api/v5/otp/verify?template_id=".$template_id."&authkey=".$authkey."&mobile=".$mobile."&otp=".$otp."&DLT_TE_ID=".$dlt_te_id."";
            }
            elseif($status=='sentotp'){
                $sentotpotp = "https://api.msg91.com/api/v5/otp?template_id=".$template_id."&otp_length=".$otplength."&authkey=".$authkey."&sender=".$sender."&mobile=".$mobile."&otp_expiry=".$otpexpiry."&DLT_TE_ID=".$dlt_te_id."";
            }elseif($status=='voiceotp'){
                $sentotpotp = "http://api.msg91.com/api/retryotp.php?template_id=".$template_id."&authkey=".$authkey."&mobile=".$mobile."&retrytype=voice"."&DLT_TE_ID=".$dlt_te_id."";
            }else{}


$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $sentotpotp,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "",
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);


$new_response=json_decode($response, true);

// return $new_response;

if ($new_response['message']=='OTP verified success' || $new_response['message']=='Mobile no. already verified' || $new_response['message']=='Mobile no. not found' || $new_response['message'] =='OTP expired') {


if (!empty($new_mobile)) {

$users=DB::table('users')->where('id',$this->user_id)
->update([
'mobile'=>$new_mobile,
]);


$users=DB::table('stores')->where('id',$this->id)
->update([
'store_mobile'=>$new_mobile,
]);

     \Auth::logout();

    return "success1";

}


    return "success";

}


    return "error";

}

    public function store(Request $request)
    {
        


$users=DB::table('users')->where('id',$this->user_id)->first();

  $mobile=$request->mobile;


$authkey = "200724AR8yxdF4IH5a9a6fe2";
$otplength = "4";
$otpexpiry = "5";
$sender = "IAMFRE";
$dlt_te_id="1207164933408332267";
$template_id="6276603bcfc15f33d50cebcb";
$status="sentotp";




       if($status=='verifyotp'){
                $sentotpotp = "https://api.msg91.com/api/v5/otp/verify?template_id=".$template_id."&authkey=".$authkey."&mobile=".$mobile."&otp=".$otp."&DLT_TE_ID=".$dlt_te_id."";
            }
            elseif($status=='sentotp'){
                $sentotpotp = "https://api.msg91.com/api/v5/otp?template_id=".$template_id."&otp_length=".$otplength."&authkey=".$authkey."&sender=".$sender."&mobile=".$mobile."&otp_expiry=".$otpexpiry."&DLT_TE_ID=".$dlt_te_id."";
            }elseif($status=='voiceotp'){
                $sentotpotp = "http://api.msg91.com/api/retryotp.php?template_id=".$template_id."&authkey=".$authkey."&mobile=".$mobile."&retrytype=voice"."&DLT_TE_ID=".$dlt_te_id."";
            }else{}


$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $sentotpotp,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "",
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);


$new_response=json_decode($response, true);


if ($err) {
    $data = [
        'status'=>'false',
        'error'=>'true',
        'response'=>$err
    ];
    return $data;    
} else {
    $msg = json_decode($response, true);
    $data = [
        'status'=>'true',
        'error'=>'false',
        'response'=>$new_response,
        'type'=>$msg['type']
    ];
    return $data;
}


// $otp = mt_rand(100000,999999);
// // dd($enquiry);
// $enquiry=[];
// $enquiry['name']=$users->name;
// $enquiry['mobile']=$request->mobile;
// $enquiry['otp']=$otp;


// Session::put('mobile_otp',$otp);


// $mobile=$this->sendOtpOnmobile($enquiry);

return json_encode($mobile);



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

        return view('seller.change_contactno.show',compact('view'));
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
        
         return view('seller.change_contactno.edit',compact('record'));

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

return Redirect::to('seller/change-contactno')->with($notification);
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

     public function status_update(Request $request){
 
         $record=role::find($request->user_id);
      
          if($record['status']=='Active'){
               $updatevender=\DB::table('sellers')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);
            return json_encode('Deactive');
           } else {
              $updateuser=\DB::table('sellers')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Active',
                                // 'updated_at' => date('Y-m-d H:i:s') 
                                 ]);
              return json_encode("Active");

        }
           }
           }


