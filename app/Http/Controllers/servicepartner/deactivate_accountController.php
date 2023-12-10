<?php

namespace App\Http\Controllers\servicepartner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\store;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Toast;
use App\store_purchase_plan;
use App\store_plan_invoice;
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


        $this->middleware(function ($request, $next) {
          $uspermit = \Auth::user();


          if ( !in_array($uspermit->role, array('1','4'), false ) ) {


              return redirect()->action('frontend\frontendController@index'); 

          }else{



      }
 

        if (\auth::user()->role == "4") {
      $servicepartner_id=db::table('rv_user_registrations')
             ->where('user_id',\Auth::user()->id)
             ->select('id','user_id')
             ->first();

            $this->id=$servicepartner_id->id; 
$this->user_id=$servicepartner_id->user_id;  

   }elseif (\auth::user()->role == "1") {

                    $this->id=session::get('servicepartner_id');
 $this->user_id=session::get('servicepartner_user_id');
}


      return $next($request);
  });


    }


    
    public function index()
    {


$users=DB::table('users')->where('id',$this->user_id)->first();


// dd($records);
        return view('servicepartner.deactivate_account.index',compact('users'));
    }





    /**
     * Store a newly created resource in storage.
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

// return json_encode($new_response);{"message":"Mobile no. already verified","type":"error"}

if ($new_response['message']=='OTP verified success' || $new_response['message']=='Mobile no. already verified' || $new_response['message']=='Mobile no. not found' || $new_response['message'] =='OTP expired') {

 $record=rv_user_registrations::find($this->id);
      
               $updatevender=\DB::table('rv_user_registrationss')->where('id',$this->id)
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

// return Redirect::to('servicepartner/deactivate-account')->with($notification);

    }

 
           }


