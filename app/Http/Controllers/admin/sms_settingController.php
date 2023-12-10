<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\sms_setting;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;
use App\config;
use DotenvEditor;

class sms_settingController extends Controller
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
          if($uspermit->role != '1'){
              return redirect()->action('frontend\frontendController@index',['id' => 'Nagpur']);  
          }
                     $this->config = config::first();
          return $next($request);
      });
    }
    
        public function index(Request $request)
    {
       
        // $records = msg_setting::get();
        // $config = $this->config;
        return view('admin.sms_setting.index');

 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $record='';

         return view('admin.sms_setting.create',compact('record'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function msg91_setting(Request $request)
    {
        

        $env_keys_save = DotenvEditor::setKeys([
            'MSG91_AUTH_KEY' => $request->MSG91_AUTH_KEY
        ]);

        $env_keys_save->save();

        // $this->config->msg91_enable = isset($request->msg91_enable) ? "1" : "0";
        // $this->config->save();

        // if(isset($request->keys)){
        //     foreach($request->keys as $key => $k){
          
        //         Msg91Setting::where('id','=',$key)->update([
    
        //             'message' => $k != 'orders' ? $request->message[$key] : NULL,
        //             'sender_id' => $request->sender_id[$key],
        //             'otp_length' => $k != 'orders' ? $request->otp_length[$key] : NULL,
        //             'otp_expiry' => $k != 'orders' ? $request->otp_expiry[$key] : NULL,
        //             'unicode' => isset($request->unicode[$key]) ? 1 : 0,
        //             'flow_id' => $request->flow_id[$key]
        //         ]); 
        //     }
        // }

   
$notification = array(
    'message' => 'SMS settings has been updated !', 
    'alert-type' => 'success'
);

return Redirect::back()->with($notification);


    }

    

    public function twillo_setting(Request $request)
    {
      
          $env_keys_save = DotenvEditor::setKeys([
            'TWILIO_SID' => $request->TWILIO_SID,
            'TWILIO_AUTH_TOKEN' => $request->TWILIO_AUTH_TOKEN,
            'TWILIO_NUMBER' => $request->TWILIO_NUMBER
        ]);

        $env_keys_save->save();

        
$notification = array(
    'message' => 'Twillo settings has been updated !', 
    'alert-type' => 'success'
);

return Redirect::back()->with($notification);

    }

    public function mimsms_setting(Request $request)
    {
      
         $env_keys_save = DotenvEditor::setKeys([
            'MIM_SMS_API_KEY' => $request->MIM_SMS_API_KEY,
            'MIM_SMS_SENDER_ID' => $request->MIM_SMS_SENDER_ID,
            'MIM_SMS_OTP_ENABLE' => $request->MIM_SMS_OTP_ENABLE
        ]);

        $env_keys_save->save();

   $notification = array(
    'message' => 'MiM settings has been updated !', 
    'alert-type' => 'success'
);

return Redirect::back()->with($notification);
    }

         public function default_sms_channel(Request $request){

        
            if(isset($request->channel)){
                $env_keys_save = DotenvEditor::setKeys([
                    'DEFAULT_SMS_CHANNEL' => $request->channel,
                ]);
        
                $env_keys_save->save();
        
                return response()->json('Channel changed !');
            }

            // if(isset($request->enable)){

            //     $config = Config::first();

            //     $config->sms_channel = $request->enable;

            //     $config->save();

            //     if($request->enable == '1'){
            //         return response()->json('Channel Enabled !');
            //     }else{
            //         return response()->json('Channel Disbaled !');
            //     }
        
            // }
        

    }



}
