<?php

namespace App\Http\Controllers\service;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\service;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Toast;
use App\service_purchase_plan;
use App\service_plan_invoice;
 use Carbon\Carbon;
use App\user_account_delete;

class deactivate_accountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

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

            if($uspermit->role == '1'  && empty(session::get('service_id'))){

// dd('2');
              return redirect()->action('frontend\frontendController@index'); 

          }

      }if (\Auth::user()->role == "2") {
      $service_id=DB::table('services')
             ->where('user_id',\Auth::user()->id)
             ->select('id','user_id','status','kyc_status')
             ->first();

             if ($service_id->kyc_status=='deactive') {
                 
              return redirect()->action('frontend\frontendcontroller@index'); 

             }
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


$users=DB::table('users')->where('id',$this->user_id)->first();


// dd($records);
        return view('service.deactivate_account.index',compact('users'));
    }





    /**
     * service a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function verify_and_deactivate(Request $request)
    {
        


  $otp=$request->otp;

$users=DB::table('users')->where('id',$this->user_id)->first();
  $mobile=$users->mobile;


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

// return json_encode($new_response);

if ($new_response['message']=='OTP verified success' || $new_response['message']=='Mobile no. already verified' || $new_response['message']=='Mobile no. not found' || $new_response['message'] =='OTP expired') {

 $record=service::find($this->id);
      
               $updatevender=\DB::table('services')->where('id',$this->id)
                              ->update([
                                'status' => 'Archive',
                                'status_date'=>Carbon::now()->toDateString(),
                                'status_created_by'=>'Self',
                                 ]);

$updatevender=\DB::table('users')->where('id',$record->user_id)
->update([
'status' => 'Archive',
]);


user_account_delete::Insert([
'user_id' => $this->user_id,
'status_reason' => Session::get('status_reason'),
'status_comment' => Session::get('status_comment'),
'status' => 'Archive',

]);

     \Auth::logout();


    return "success";

}

    return "error";


}


    public function store(Request $request)
    {
        



  $otp=$request->otp;

    Session::put('status_reason',$request->status_reason);
    Session::put('status_comment',$request->status_comment);




$users=DB::table('users')->where('id',$this->user_id)->first();
  $mobile=$users->mobile;


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

// $notification = array(
//     'message' => 'Your form was successfully submit!', 
//     'alert-type' => 'success'
// );

// return Redirect::to('service/deactivate-account')->with($notification);

    }

 
           }


