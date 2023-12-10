<?php
namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;

use Auth;
use View;
use \Cart as Cart;
use App\product_addon_group;
use Twilio\Rest\Client;
use Exception;
use App\rv_user_registration;
use App\suborder;
use App\wishlist;
use App\rv_bank_detail;
use App\suport_ticket_detail;
use App\vehicle_master;
use App\sim_registration;
use App\store;
use App\order_delivery_address;
use App\rv_document;
use App\suport_ticket;


class rvApiController extends Controller
{


public function testapi(Request $request)
{


return json_encode('success');

}



public function rv_dashboard(Request $request)
{


$order=suborder::where('store_user_id',Auth::user()->id)->count();
$wishlist=wishlist::where('persone_user_id',Auth::user()->id)->count();
$followed=$order;

        return compact('order','followed','wishlist');

}



public function check_rv_auth($mobile)
{
$mobile_record = User::where('mobile', $mobile)->first();
if ($mobile_record) {

if ($mobile_record->role==4) {

$statuses=$this->send_user_otp($mobile_record,'sentotp');

return $statuses;

}else{

return ['status'=>'not_permission','mobile'=>$mobile];

}

}else{

return ['status'=>'signup','mobile'=>$mobile];

}

}

public function request_for_signup_otp(Request $request)
{

$mobile=$request->mobile;


 
    $authkey = "200724AR8yxdF4IH5a9a6fe2";
            $otplength = "4";
            $otpexpiry = "5";
            $sender = "IAMFRE";
                    $dlt_te_id="1207164933408332267";
            $template_id="6276603bcfc15f33d50cebcb";
  $status='sentotp';


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

   $new_response=json_decode($response, true);
// return json_encode($new_response);
            curl_close($curl);
           
        if ($err) {
            $data = [
                'status'=>'false',
                'error'=>'true',
                'response'=>$err
                ];
          return ['status'=>$data];
        } else {
            $msg = json_decode($response, true);
            $data = [
                'status'=>'true',
                'error'=>'false',
                'response'=>"success",
                'type'=>$msg['type']
                ];
           return ['status'=>'success'];
        }



return ['status'=>json_decode($response, true)];

}


public function send_user_otp($mobile_record,$status)
{


$mobile=$mobile_record->mobile;
$user_name=$mobile_record->name;

if ($mobile) {
 
    $authkey = "200724AR8yxdF4IH5a9a6fe2";
            $otplength = "4";
            $otpexpiry = "5";
            $sender = "IAMFRE";
                    $dlt_te_id="1207164933408332267";
            $template_id="6276603bcfc15f33d50cebcb";
  $status='sentotp';


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
           
        if ($err) {
            $data = [
                'status'=>'false',
                'error'=>'true',
                'response'=>$err
                ];
          return ['status'=>$data];
        } else {
            $msg = json_decode($response, true);
            $data = [
                'status'=>'true',
                'error'=>'false',
                'response'=>"success",
                'type'=>$msg['type']
                ];
           return ['status'=>'signin'];
        }

}

// Session::put('session_users_otp',$six_digit_otp);

return ['status'=>json_decode($response, true)];


}



public function rv_sigin_otp_verify(Request $request)
{

  $mobile = $request->mobile;

    $otp=(int)$request->otp;


$mobile_users=DB::table('users')->where('mobile',$mobile)->where('role','4')->first();

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




        if ($new_response['message']=='OTP verified success' || $new_response['message']=='Mobile no. already verified' || $new_response['message']=='Mobile no. not found' || $new_response['message'] =='OTP expired') {

      if (!empty($mobile_users)) {
 
$user = User::find($mobile_users->id);
Auth::login($user);
$tokenobj = \Auth::User()->createToken('name');
$token = $tokenobj->accessToken;
 
$rv_user_registration=rv_user_registration::where('user_id',$user->id)->select('id')->first();

    $data=array();
        $data['user_id']=$user->id;
         $data['name']=$user->name;
        $data['email']=$user->email;
        $data['id']=$rv_user_registration->id;

        return ['status'=>'success','data' => $data,'token'=>$token];

}
else{

    return ['status'=>'not_in_same_role'];

}



        } else {

           $data = [
                'status'=>'false',
                'error'=>'true',
                'response'=>$err
                ];

                    return ['status'=>$new_response];
      }




}


public function rv_sigup_otp_verify(Request $request)
{

$mobile = $request->mobile;
      $otp=(int)$request->otp;

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


        if ($new_response['message']=='OTP verified success' || $new_response['message']=='Mobile no. already verified') {          


            $msg = json_decode($response, true);


$user_data = array(
  'name' => $request->input('name'),
  'email' => $request->email,
    'mobile' => $mobile,
  'password' => bcrypt($otp),
  'role' =>'4',
  'status'=>'Active'

);


$users = new user($user_data);
$users->save();


// return json_encode($users);


$data = array(
'rv_user_name'=>$request->name,
'rv_user_mobile'=>$mobile,
'rv_user_email'=>$request->email,
'rv_user_login_email'=>$request->email,
'rv_user_gender'=>$request->input('gendor'),
'password'=>$otp,
'status'=>"Active",
'user_id' =>$users->id,
'rv_user_userid'=>'RvSp'.$users->id.date('Y'),
'created_by'=>'Self',
'rv_user_city'=>$request->input('rv_user_city'),

);


$rv_user_registration = new rv_user_registration($data);
$rv_user_registration->save();


$user = User::find($users->id);
Auth::login($user);

$tokenobj = \Auth::User()->createToken('name');
$token = $tokenobj->accessToken;
 

    $data=array();
        $data['user_id']=$user->id;
         $data['name']=$user->name;
        $data['email']=$user->email;
 $data['id']=$rv_user_registration->id;


        return ['status'=>'success','data' => $data,'token'=>$token];
  


} else {
            $data = [
                'status'=>'false',
                'error'=>'true',
                'response'=>$err
                ];


// return json_encode('1');

                  return ['status'=>json_decode($response, true)];


        }

}




public function rv_profile_view(Request $request)
{

   $record = rv_user_registration::where('user_id',Auth::user()->id)->first(); ;     

           $countries = DB::table('countries')  
                    ->select('country_name','id')
                     ->where('status','Active')
            ->orderBy('country_name', 'asc')->pluck('country_name','id'); 




  $states = DB::table('states')
             ->where('states.country_id','=', $record['rv_user_country'])
              ->where("states.status",'Active')
            ->pluck('states.state_name','states.id');

// dd($states);
             $cities = DB::table('cities')
             ->where('cities.state_id','=', $record['rv_user_state'])
              ->where("cities.status",'Active')
            ->pluck('cities.city_name','cities.id');


             $localities = DB::table('localities')
             ->where('localities.city_id','=', $record['rv_user_city'])
              ->where("localities.status",'Active')
            ->pluck('localities.locality_name','localities.id');



        
         return compact('record','countries','states','cities','localities');

}


public function rv_profile_update(Request $request)
{

$rv_user_registration = rv_user_registration::where('user_id',Auth::user()->id)->first(); 


if($request->hasFile('rv_user_img'))

{       
$file = $request->file('rv_user_img');
$extension = $request->file('rv_user_img')->getClientOriginalExtension();
$rv_user_img = date('d_m_Y_h_i_s',time()) . '1.' . $extension;

 $destinationPaths = base_path().'/public/images/delivery_img';

$thumb_img =Image::make($file->getRealPath())->orientate()->resize(150, 150);

$thumb_img->save($destinationPaths.'/'.$rv_user_img,80);


}       
else{
    $rv_user_img = $rv_user_registration->rv_user_img;
}



$type='';

if (!empty($request->rv_user_type)) {
$type=implode(',',$request->rv_user_type);
}


$data = array(
'rv_user_name'=>$request->input('rv_user_name'),
'rv_user_email'=>$request->input('rv_user_email'),
'rv_user_dob'=>$request->input('rv_user_dob'),
'rv_user_gender'=>$request->input('rv_user_gender'),
'rv_user_country'=>$request->input('rv_user_country'),
'rv_user_state'=>$request->input('rv_user_state'),
'rv_user_city'=>$request->input('rv_user_city'),
'rv_user_locality'=>$request->input('rv_user_locality'),
'rv_user_address'=>$request->input('rv_user_address'),
'rv_user_pincode'=>$request->input('rv_user_pincode'),    
'rv_user_mobile'=>$request->input('rv_user_mobile'),    
'rv_user_phone'=>$request->input('rv_user_phone'),    
'rv_user_img'=>$rv_user_img,     
'rv_user_type'=>$type,    

);

// dd($data);
 $rv_user_registration->update($data);

   
      DB::table('users')
 ->where('id',$rv_user_registration->user_id)
 ->update(
['name' => $request->input('rv_user_name'),
]
 );



return json_encode(['status'=>'success']);

}



public function rv_add_bank_detail(Request $request)
{

        $bank_detail = rv_bank_detail::where('user_id',Auth::user()->id)->first();

if (empty($bank_detail)) {
   
    $data = array(
    'bankname'=>$request->input('bankname'),
    'branchname'=>$request->input('branchname'),
    'ifsc'=>$request->input('ifsc'),
    'account'=>$request->input('account'),
    'acountname'=>$request->input('acountname'),
    'user_id'=>Auth::user()->id,
    'status'=>'Active',
    
);
         $rv_bank_detail = new rv_bank_detail($data);
         $rv_bank_detail->save();


}else{


$data = array(
'bankname'=>$request->input('bankname'),
'branchname'=>$request->input('branchname'),
'ifsc'=>$request->input('ifsc'),
'account'=>$request->input('account'),
'acountname'=>$request->input('acountname'),

'status'=>$request->status

);

   // dd($data);
         $bank_detail->update($data);


}


return json_encode(['status'=>'success']);

}



public function rv_support_ticket_view(Request $request)
{


 $records=DB::table('suport_tickets')->orderBy('id','desc');

         if (!empty($request->search)) {
         $records= $records
    ->orWhere('ticket_name','like','%' . $request->search . '%')
    ->orWhere('vendor_name','like','%' . $request->search . '%')
    ->orWhere('vendor_email','like','%' . $request->search . '%')
    ->orWhere('subject','like','%' . $request->search . '%')
    ->orWhere('message','like','%' . $request->search . '%');
}

         $records= $records
                  ->where('suport_tickets.user_id',Auth::user()->id)

        ->get();

        return json_encode($records);


}



public function ticket_list(Request $request)
{

         
 $tickets = DB::table('tickets')  
                    ->select('ticket_name','id')
                     ->where('status','Active')
                     ->where('ticket_role','like','%' .'Customer' . '%')
            ->orderBy('ticket_name', 'asc')->pluck('ticket_name','ticket_name'); 

// dd($tickets);
         return json_encode($tickets);

}



public function rv_support_ticket_add(Request $request)
{

$data = array(
    'ticket_name'=>$request->input('ticket_name'),
    'vendor_name'=>Auth::user()->name,
    'vendor_email'=>Auth::user()->email,
    'subject'=>$request->input('subject'),
    'message'=>$request->input('message'),
    'user_id'=>Auth::user()->id,
    'message_by'=>'Customer',
    'ticket_no'=>uniqid(),
    
);


          // dd($data);

          
         $suport_ticket = new suport_ticket($data);
         $suport_ticket->save();
                 


    if($request->hasFile('attachment'))
  
        {       
     $file = $request->file('attachment');
     $extension = $request->file('attachment')->getClientOriginalExtension();
     $attachment = date('d_m_Y_h_i_s',time()) . '1.' . $extension;

         $destinationPaths = base_path().'/public/images/tickets';

  
        $file->move($destinationPaths, $attachment);


      }       
        else{
            $attachment = "";
        }


 $data = array(
    'ticket_id'=>$suport_ticket->id,
    'name'=>Auth::user()->name,
    'message'=>$request->input('message'),
     'user_id'=>Auth::user()->id,
    'message_by'=>'Customer',
'attachment'=>$attachment,
    
);
         $suport_ticket_detail = new suport_ticket_detail($data);
         $suport_ticket_detail->save();
                 



return json_encode(['status'=>'success']);

}



public function rv_support_ticket_msg_show($ticket_id)
{


 $records=DB::table('suport_ticket_details')
 ->whereIn('suport_ticket_details.message_by',['Customer','Admin'])
  ->where('suport_ticket_details.ticket_id',$ticket_id)

 ->get();


 $record=DB::table('suport_tickets')
 ->where('suport_tickets.user_id',Auth::user()->id)
 ->where('suport_tickets.id',$ticket_id)
 ->first();



        return compact('records','record');

}



public function rv_support_ticket_send_msg(Request $request)
{

   if($request->hasFile('attachment'))
  
        {       
     $file = $request->file('attachment');
     $extension = $request->file('attachment')->getClientOriginalExtension();
     $attachment = date('d_m_Y_h_i_s',time()) . '1.' . $extension;

         $destinationPaths = base_path().'/public/images/tickets';

  
        $file->move($destinationPaths, $attachment);


      }       
        else{
            $attachment = "";
        }


$data = array(
'ticket_id'=>$request->ticket_id,
'name'=>Auth::user()->name,
'message'=>$request->input('message'),
'user_id'=>Auth::user()->id,
'message_by'=>'Customer',
'attachment'=>$attachment,

);

 // dd($data);
         $suport_ticket_detail = new suport_ticket_detail($data);
         $suport_ticket_detail->save();
                 


           
return json_encode(['status'=>'success']);


}

 public function rv_vehicle_list(Request $request)
    {

        

        $records=DB::table('vehicle_masters')

        ->orderBy('vehicle_masters.id','desc');

        if (!empty($request->search)) {
           $records= $records
->orWhere('vehicle_masters.vehicle_userid','like','%' . $request->search . '%')
->orWhere('vehicle_masters.vehicle_type','like','%' . $request->search . '%')
->orWhere('vehicle_masters.vehicle_no','like','%' . $request->search . '%')
->orWhere('vehicle_masters.vehicle_modal_no','like','%' . $request->search . '%')
->orWhere('vehicle_masters.vehicle_unique_id','like','%' . $request->search . '%')
->orWhere('vehicle_masters.insurance_expiry_date','like','%' . $request->search . '%')
->orWhere('vehicle_masters.vehicle_package','like','%' . $request->search . '%')
->orWhere('vehicle_masters.vehicle_package_for','like','%' . $request->search . '%')
->orWhere('vehicle_masters.status','like','%' . $request->search . '%');
       }

       $records= $records
       ->where('vehicle_masters.user_id',Auth::user()->id)
       ->paginate(25);



       $use = DB::table('vehicle_masters')  
       ->select('vehicle_name','id')        

       ->orderBy('vehicle_name', 'asc')->get(); 

       $vehicle_masters = array();
       foreach($use as $user) {
        $vehicle_masters[$user->vehicle_name] = $user->vehicle_name;
    }


// dd($records);


return compact('records','vehicle_masters');


    }



	public function rv_vehicle_view(Request $request)
	{

        $record_vehicle = vehicle_master::where('user_id',Auth::user()->id)->first();     

$record='';

if (!empty($record_vehicle)) {
    $record=DB::table('rv_user_registrations')
            ->join('countries','countries.id','rv_user_registrations.rv_user_country')
            ->join('states','states.id','rv_user_registrations.rv_user_state')
            ->join('cities','cities.id','rv_user_registrations.rv_user_city')
            ->join('localities','localities.id','rv_user_registrations.rv_user_locality')
            ->where('rv_user_registrations.id',$record_vehicle->vehicle_owner_id)
            ->select('countries.country_name','cities.city_name','states.state_name','localities.locality_name','rv_user_registrations.*')
            ->where('rv_user_type','like','%' . 'Vehicle' . '%')
            ->first();
}

           

// dd($record);


 $vehicle_names = DB::table('vehicle_types')  
       ->select('vehicle_name','id')      
       ->orderBy('vehicle_name', 'asc')->pluck('vehicle_name','vehicle_name');

 $package_names = DB::table('vehicle_rate_charts')  
       ->select('package_name','id')      
       ->orderBy('package_name', 'asc')->pluck('package_name','package_name');


   $locations = DB::table('cities')  
       ->join('countries','countries.id','cities.country_id')
       ->select('cities.city_name','cities.id')   
       ->where('countries.country_name','UNITED STATES')   
       ->orderBy('cities.id', 'asc')
       // ->limit('10')
       ->where('cities.status','Active') 
          ->pluck('cities.city_name','cities.city_name');


       return compact('record','vehicle_names','package_names','locations');
	}




	public function rv_vehicle_add(Request $request)
	{
 $record= rv_user_registration::where('user_id',Auth::user()->id)->first();

// dd($record);
        $check=DB::table('vehicle_masters')
        ->where('vehicle_userid',$record->vehicle_userid)
        ->first();



 if($request->hasFile('vehicle_front_img'))

    {       
       $file = $request->file('vehicle_front_img');
       $extension = $request->file('vehicle_front_img')->getClientOriginalExtension();
       $vehicle_front_img = date('d_m_Y_h_i_s',time()) . '1.' . $extension;

       $destinationPaths = base_path().'/public/images/vehicle_image';

       $thumb_img =Image::make($file->getRealPath())->orientate()->resize(150, 150);

       $thumb_img->save($destinationPaths.'/'.$vehicle_front_img,80);


   }       
   else{
    $vehicle_front_img = "";
}


 if($request->hasFile('vehicle_back_img'))

    {       
       $file = $request->file('vehicle_back_img');
       $extension = $request->file('vehicle_back_img')->getClientOriginalExtension();
       $vehicle_back_img = date('d_m_Y_h_i_s',time()) . '2.' . $extension;

       $destinationPaths = base_path().'/public/images/vehicle_image';

       $thumb_img =Image::make($file->getRealPath())->orientate()->resize(150, 150);

       $thumb_img->save($destinationPaths.'/'.$vehicle_back_img,80);


   }       
   else{
    $vehicle_back_img = "";
}


 if($request->hasFile('vehicle_side_img'))

    {       
       $file = $request->file('vehicle_side_img');
       $extension = $request->file('vehicle_side_img')->getClientOriginalExtension();
       $vehicle_side_img = date('d_m_Y_h_i_s',time()) . '3.' . $extension;

       $destinationPaths = base_path().'/public/images/vehicle_image';

       $thumb_img =Image::make($file->getRealPath())->orientate()->resize(150, 150);

       $thumb_img->save($destinationPaths.'/'.$vehicle_side_img,80);


   }       
   else{
    $vehicle_side_img = "";
}


 if($request->hasFile('vehicle_insurance_file'))

    {       
       $file = $request->file('vehicle_insurance_file');
       $extension = $request->file('vehicle_insurance_file')->getClientOriginalExtension();
       $vehicle_insurance_file = date('d_m_Y_h_i_s',time()) . '4.' . $extension;

       $destinationPaths = base_path().'/public/images/vehicle_image';

       $thumb_img =Image::make($file->getRealPath())->orientate()->resize(150, 150);

       $thumb_img->save($destinationPaths.'/'.$vehicle_insurance_file,80);


   }       
   else{
    $vehicle_insurance_file = "";
}


 if($request->hasFile('vehicle_rc_book_img'))

    {       
       $file = $request->file('vehicle_rc_book_img');
       $extension = $request->file('vehicle_rc_book_img')->getClientOriginalExtension();
       $vehicle_rc_book_img = date('d_m_Y_h_i_s',time()) . '5.' . $extension;

       $destinationPaths = base_path().'/public/images/vehicle_image';

       $thumb_img =Image::make($file->getRealPath())->orientate()->resize(150, 150);

       $thumb_img->save($destinationPaths.'/'.$vehicle_rc_book_img,80);


   }       
   else{
    $vehicle_rc_book_img = "";
}



$data = array(
    'vehicle_owner_id'=>$record->id,   
    'vehicle_userid'=>$record->rv_user_userid,
    'user_id'=>$record->user_id,
    'vehicle_type'=>$request->vehicle_type,
    'vehicle_name'=>$request->vehicle_name,
    'vehicle_no'=>$request->vehicle_no,
    'vehicle_modal_no'=>$request->vehicle_modal_no,
    'vehicle_package'=>$request->vehicle_package,
    'vehicle_registered_no'=>$request->vehicle_registered_no,
    'vehicle_registered_year'=>$request->vehicle_registered_year,
    'vehicle_front_img'=>$vehicle_front_img,
    'vehicle_back_img'=>$vehicle_back_img,
    'vehicle_side_img'=>$vehicle_side_img,
    'vehicle_insurance_file'=>$vehicle_insurance_file,
    'vehicle_rc_book_img'=>$vehicle_rc_book_img,
    'insurance_expiry_date'=>$request->insurance_expiry_date,
    'vehicle_rc_no'=>$request->vehicle_rc_no,
    'vehicle_driving_location'=>$request->vehicle_driving_location,
        'vehicle_unique_id'=>'VehicleId'.$record->user_id.date('Y'),
    'vehicle_package_for'=>$request->vehicle_package_for,

);
$vehicle_master = new vehicle_master($data);
$vehicle_master->save();


return json_encode(['status'=>'success']);
	}


	public function rv_vehicle_update(Request $request)
	{


     
        $vehicle_master = vehicle_master::find($request->id); 


        
 if($request->hasFile('vehicle_front_img'))

    {       
       $file = $request->file('vehicle_front_img');
       $extension = $request->file('vehicle_front_img')->getClientOriginalExtension();
       $vehicle_front_img = date('d_m_Y_h_i_s',time()) . '1.' . $extension;

       $destinationPaths = base_path().'/public/images/vehicle_image';

       $thumb_img =Image::make($file->getRealPath())->orientate()->resize(150, 150);

       $thumb_img->save($destinationPaths.'/'.$vehicle_front_img,80);


   }       
   else{
    $vehicle_front_img = $vehicle_master->vehicle_front_img;
}


 if($request->hasFile('vehicle_back_img'))

    {       
       $file = $request->file('vehicle_back_img');
       $extension = $request->file('vehicle_back_img')->getClientOriginalExtension();
       $vehicle_back_img = date('d_m_Y_h_i_s',time()) . '2.' . $extension;

       $destinationPaths = base_path().'/public/images/vehicle_image';

       $thumb_img =Image::make($file->getRealPath())->orientate()->resize(150, 150);

       $thumb_img->save($destinationPaths.'/'.$vehicle_back_img,80);


   }       
   else{
    $vehicle_back_img = $vehicle_master->vehicle_back_img;
}


 if($request->hasFile('vehicle_side_img'))

    {       
       $file = $request->file('vehicle_side_img');
       $extension = $request->file('vehicle_side_img')->getClientOriginalExtension();
       $vehicle_side_img = date('d_m_Y_h_i_s',time()) . '3.' . $extension;

       $destinationPaths = base_path().'/public/images/vehicle_image';

       $thumb_img =Image::make($file->getRealPath())->orientate()->resize(150, 150);

       $thumb_img->save($destinationPaths.'/'.$vehicle_side_img,80);


   }       
   else{
    $vehicle_side_img = $vehicle_master->vehicle_side_img;
}


 if($request->hasFile('vehicle_insurance_file'))

    {       
       $file = $request->file('vehicle_insurance_file');
       $extension = $request->file('vehicle_insurance_file')->getClientOriginalExtension();
       $vehicle_insurance_file = date('d_m_Y_h_i_s',time()) . '4.' . $extension;

       $destinationPaths = base_path().'/public/images/vehicle_image';

       $thumb_img =Image::make($file->getRealPath())->orientate()->resize(150, 150);

       $thumb_img->save($destinationPaths.'/'.$vehicle_insurance_file,80);


   }       
   else{
    $vehicle_insurance_file = $vehicle_master->vehicle_insurance_file;
}


 if($request->hasFile('vehicle_rc_book_img'))

    {       
       $file = $request->file('vehicle_rc_book_img');
       $extension = $request->file('vehicle_rc_book_img')->getClientOriginalExtension();
       $vehicle_rc_book_img = date('d_m_Y_h_i_s',time()) . '5.' . $extension;

       $destinationPaths = base_path().'/public/images/vehicle_image';

       $thumb_img =Image::make($file->getRealPath())->orientate()->resize(150, 150);

       $thumb_img->save($destinationPaths.'/'.$vehicle_rc_book_img,80);


   }       
   else{
    $vehicle_rc_book_img = $vehicle_master->vehicle_rc_book_img;
}



    $data = array(
  
    'vehicle_type'=>$request->vehicle_type,
    'vehicle_name'=>$request->vehicle_name,
    'vehicle_no'=>$request->vehicle_no,
    'vehicle_modal_no'=>$request->vehicle_modal_no,
    'vehicle_package'=>$request->vehicle_package,
    'vehicle_registered_no'=>$request->vehicle_registered_no,
    'vehicle_registered_year'=>$request->vehicle_registered_year,
    'vehicle_front_img'=>$vehicle_front_img,
    'vehicle_back_img'=>$vehicle_back_img,
    'vehicle_side_img'=>$vehicle_side_img,
    'vehicle_insurance_file'=>$vehicle_insurance_file,
    'vehicle_rc_book_img'=>$vehicle_rc_book_img,
    'insurance_expiry_date'=>$request->insurance_expiry_date,
    'vehicle_rc_no'=>$request->vehicle_rc_no,
    'vehicle_driving_location'=>$request->vehicle_driving_location,
     'vehicle_package_for'=>$request->vehicle_package_for,

    );

  
    $vehicle_master->update($data);


    DB::table('users')
    ->where('id',$vehicle_master->user_id)
    ->update(
        ['name' => $request->input('vehicle_name')]
    );


    return json_encode(['status'=>'success']);

	}


	public function rv_sim_registration_detail(Request $request)
	{

$record = sim_registration::where('user_id',Auth::user()->id)->first();  

return json_encode($record);

}

	public function rv_sim_registration(Request $request)
	{

$record = sim_registration::where('user_id',Auth::user()->id)->first();  

if (empty($record)) {
	 $data = array(
        'sim_slot_index'=>$request->input('sim_slot_index'),
        'sim_carrier_name'=>$request->input('sim_carrier_name'),
        'sim_imei_code'=>$request->input('sim_imei_code'),
        'sim_serial_name'=>$request->input('sim_serial_name'),
        'sim_phone_name'=>$request->input('sim_phone_name'),
        'sim_mobile_name'=>$request->input('sim_mobile_name'),
'user_id'=>Auth::user()->id,
    );
       $sim_registration = new sim_registration($data);
       $sim_registration->save();
       
}else{


 $data = array(
        'sim_slot_index'=>$request->input('sim_slot_index'),
        'sim_carrier_name'=>$request->input('sim_carrier_name'),
        'sim_imei_code'=>$request->input('sim_imei_code'),
        'sim_serial_name'=>$request->input('sim_serial_name'),
        'sim_phone_name'=>$request->input('sim_phone_name'),
        'sim_mobile_name'=>$request->input('sim_mobile_name'),
        'user_id'=>Auth::user()->id,

    );

         $record->update($data);

}


   return json_encode(['status'=>'success']);

}

	public function rv_today_assign_orders(Request $request)
	{


 
$orderitems=DB::table('suborders')
->join('suborder_rider_assignments','suborder_rider_assignments.suborder_id','suborders.id')
// ->where('suborder_rider_assignments.rider_userid',Auth::user()->id)
->select('suborder_rider_assignments.rider_accept_order_status','suborders.store_id',
'suborders.order_id',
'suborders.customer_user_id',
'suborders.suborder_u_id',
'suborders.order_date',
'suborders.delivery_date',
'suborders.id',
'suborders.pickup_type',
'suborders.paid_unpaid_status','suborder_rider_assignments.rider_status_updated_by','suborder_rider_assignments.rider_status_update_date')

->whereIn('suborders.order_status',['Ready To Pickup','Dispatch'])
->where('suborder_rider_assignments.rider_accept_order_status','<>','Rejected')
->orderBy('suborder_rider_assignments.id','desc')
->paginate(100);




// dd(Auth::user()->id);
$records=[];

foreach($orderitems as $index=>$data){

$store_info=store::where('id',$data->store_id)->first();

$addressBook=order_delivery_address::where('order_id',$data->order_id)->first();

$users=DB::table('customers')
->where('user_id',$data->customer_user_id)
->select('id','user_id','customer_userid','customer_name as name','customer_email as email','customer_mobile as mobile')
->first();
 
 

    $records[]=(object)[
        'id'=>$data->id,
'store_email'=>$store_info->store_email,
'store_mobile'=>$store_info->store_mobile,
'store_owner_name'=>$store_info->store_owner_name,
'store_name'=>$store_info->store_name,
'store_country'=>$store_info->country->country_name,
'store_state'=>$store_info->state->state_name,
'store_city'=>$store_info->city->city_name,
'store_locality'=>$store_info->locality->locality_name,
'store_category'=>$store_info->category->category_name,
'store_address'=>$store_info->store_address,
'store_pincode'=>$store_info->store_pincode,  
'suborder_u_id'=>$data->suborder_u_id,
'order_date'=>$data->order_date,
'delivery_date'=>$data->delivery_date,
'ready_to_pickup_status_date'=>$this->status_function($data->id),
'dispatch_status'=>$this->dispatch_status_function($data->id),
'pickup_type'=>$data->pickup_type,
'addressBook'=>$addressBook,
'users'=>$users,
'paid_unpaid_status'=>$data->paid_unpaid_status,
'rider_accept_order_status'=>$data->rider_accept_order_status,
'rider_status_updated_by'=>$data->rider_status_updated_by,
'rider_status_update_date'=>$data->rider_status_update_date,
    ];

}

// dd($records);


    return json_encode($records);


	}


        public function status_function($suborder_id)
    {
$order_status=DB::table('order_status_managements')->where('suborder_id',$suborder_id)
->where('status','Ready To Pickup')
->first();
if (!empty($order_status)) {
   return json_encode($order_status->status_date);

}

return '';

    }



        public function dispatch_status_function($suborder_id)
    {
$order_status=DB::table('order_status_managements')->where('suborder_id',$suborder_id)
->where('status','Dispatch')
->select('status','status_date')
->first();


return $order_status;


    }



   public function rv_assign_order_status_update(Request $request)
    {

     
        $record=DB::table('suborder_rider_assignments')
        ->where('suborder_rider_assignments.rider_regis_id',$request->rider_regis_id)
        ->where('suborder_rider_assignments.suborder_id',$request->suborder_id)
        ->first();


        $updatevender=\DB::table('suborder_rider_assignments')->where('id',$record->id)
        ->update([
        'rider_accept_order_status' => $request->status,
         'rider_status_updated_by'=>'Rider',
    'rider_status_update_date'=>Carbon::now()->toDateTimeString(),

        ]);


        return json_encode($request->status);

 }


   public function rv_delivered_orders(Request $request)
    {


$orderitems=DB::table('suborders')
->join('suborder_rider_assignments','suborder_rider_assignments.suborder_id','suborders.id')
->where('suborder_rider_assignments.rider_regis_id',$request->rider_regis_id)
->select('suborder_rider_assignments.rider_accept_order_status','suborders.store_id',
'suborders.order_id',
'suborders.customer_user_id',
'suborders.suborder_u_id',
'suborders.order_date',
'suborders.delivery_date',
'suborders.id',
'suborders.pickup_type',
'suborders.paid_unpaid_status','suborder_rider_assignments.rider_status_updated_by','suborder_rider_assignments.rider_status_update_date')
->where('suborders.order_status','Delivered')
->where('suborder_rider_assignments.rider_accept_order_status','Accepted')

->paginate(100);




// dd(Auth::user()->id);
$records=[];

foreach($orderitems as $index=>$data){

$store_info=store::where('id',$data->store_id)->first();

$addressBook=order_delivery_address::where('order_id',$data->order_id)->first();

$users=DB::table('customers')
->where('user_id',$data->customer_user_id)
->select('id','user_id','customer_userid','customer_name as name','customer_email as email','customer_mobile as mobile')
->first();
 
 

    $records[]=(object)[
        'id'=>$data->id,
'store_email'=>$store_info->store_email,
'store_mobile'=>$store_info->store_mobile,
'store_owner_name'=>$store_info->store_owner_name,
'store_name'=>$store_info->store_name,
'store_country'=>$store_info->country->country_name,
'store_state'=>$store_info->state->state_name,
'store_city'=>$store_info->city->city_name,
'store_locality'=>$store_info->locality->locality_name,
'store_category'=>$store_info->category->category_name,
'store_address'=>$store_info->store_address,
'store_pincode'=>$store_info->store_pincode,  
'suborder_u_id'=>$data->suborder_u_id,
'order_date'=>$data->order_date,
'delivery_date'=>$data->delivery_date,
'ready_to_pickup_status_date'=>$this->status_function($data->id),
'dispatch_status'=>$this->dispatch_status_function($data->id),
'pickup_type'=>$data->pickup_type,
'addressBook'=>$addressBook,
'users'=>$users,
'paid_unpaid_status'=>$data->paid_unpaid_status,
'rider_accept_order_status'=>$data->rider_accept_order_status,
'rider_status_updated_by'=>$data->rider_status_updated_by,
'rider_status_update_date'=>$data->rider_status_update_date,
    ];

}


return json_encode($records);
    }



   public function rv_canceled_orders(Request $request)
    {



$orderitems=DB::table('suborders')
->join('suborder_rider_assignments','suborder_rider_assignments.suborder_id','suborders.id')
->where('suborder_rider_assignments.rider_regis_id',$request->rider_regis_id)
->select('suborder_rider_assignments.rider_accept_order_status','suborders.store_id',
'suborders.order_id',
'suborders.customer_user_id',
'suborders.suborder_u_id',
'suborders.order_date',
'suborders.delivery_date',
'suborders.id',
'suborders.pickup_type',
'suborders.paid_unpaid_status','suborders.order_status','suborder_rider_assignments.rider_status_updated_by','suborder_rider_assignments.rider_status_update_date')
->where('suborder_rider_assignments.rider_accept_order_status','Rejected')
->paginate(100);




// dd($orderitems);
$records=[];

foreach($orderitems as $index=>$data){

$store_info=store::where('id',$data->store_id)->first();

$addressBook=order_delivery_address::where('order_id',$data->order_id)->first();

$users=DB::table('customers')
->where('user_id',$data->customer_user_id)
->select('id','user_id','customer_userid','customer_name as name','customer_email as email','customer_mobile as mobile')
->first();
 
 

    $records[]=(object)[
        'id'=>$data->id,
'store_email'=>$store_info->store_email,
'store_mobile'=>$store_info->store_mobile,
'store_owner_name'=>$store_info->store_owner_name,
'store_name'=>$store_info->store_name,
'store_country'=>$store_info->country->country_name,
'store_state'=>$store_info->state->state_name,
'store_city'=>$store_info->city->city_name,
'store_locality'=>$store_info->locality->locality_name,
'store_category'=>$store_info->category->category_name,
'store_address'=>$store_info->store_address,
'store_pincode'=>$store_info->store_pincode,  
'suborder_u_id'=>$data->suborder_u_id,
'order_date'=>$data->order_date,
'delivery_date'=>$data->delivery_date,
'ready_to_pickup_status_date'=>$this->status_function($data->id),
'dispatch_status'=>$this->dispatch_status_function($data->id),
'pickup_type'=>$data->pickup_type,
'addressBook'=>$addressBook,
'users'=>$users,
'paid_unpaid_status'=>$data->paid_unpaid_status,
'rider_accept_order_status'=>$data->rider_accept_order_status,
'rider_status_updated_by'=>$data->rider_status_updated_by,
'rider_status_update_date'=>$data->rider_status_update_date,
    ];

}

return json_encode($records);

   }


    
public function rv_document_view(Request $request)
{

$records=DB::table('rv_documents')->orderBy('rv_documents.id','desc');

         if (!empty($request->search)) {
         $records= $records
        ->orWhere('rv_documents.document_name','like','%' . $request->search . '%');
}

         $records= $records
         ->where('user_id',Auth::user()->id)
        ->get();



         $use = DB::table('rv_documents')  
                    ->select('document_name','id')     
   
            ->get(); 

 $rv_documents = array();
foreach($use as $user) {

$rv_documents[]=['id'=>(int)$user->id,'name'=> (string)$user->document_name];
}
  // return json_encode($rv_documents);
return compact('records','rv_documents');

    }

    
public function rv_document_form(Request $request)
{
  $records=DB::table('rv_documents')
         ->where('user_id',Auth::user()->id)
         ->pluck('document_name','document_name')->toarray();

// dd($records);

  $use = DB::table('documents')  
            ->select('document_name','id')
             ->where('status','Active')
             ->where('document_for','Rider')
    ->whereNotIn('document_name', $records)->select('document_name','id')->get(); 


$documents = array();
foreach($use as $user) {
$documents[]=['id'=>(int)$user->id,'name'=> (string)$user->document_name];

}


    return json_encode($documents);

}


    
public function rv_document_add(Request $request)
{

 if($request->hasFile('document_file'))
        {       
             $file = $request->file('document_file');
             $extension = $request->file('document_file')->getClientOriginalExtension();
     $document_file = date('d_m_Y_h_i_s',time()) . '1.' . $extension;
             $destinationPath = base_path().'/public/images/rv_document';
             // dd($destinationPath);
             $file->move($destinationPath,$document_file);
        }        
        else{
            $document_file = "";
        }



$data = array(
'document_name'=>$request->input('document_name'),
'document_file'=>$document_file,
'user_id'=>Auth::user()->id,
'rv_register_id'=>$request->rv_register_id,

);
         $rv_document = new rv_document($data);
         $rv_document->save();
                 
  return json_encode(['status'=>'success']);



    }

    
    
public function rv_document_update(Request $request)
{

  $rv_documents = rv_document::find($request->id); 

   if($request->hasFile('document_file'))
  
        {       
     $file = $request->file('document_file');
     $extension = $request->file('document_file')->getClientOriginalExtension();
     $document_file = date('d_m_Y_h_i_s',time()) . '1.' . $extension;

         $destinationPaths = base_path().'/public/images/rv_document';

  $thumb_img =Image::make($file->getRealPath())->orientate()->resize(100, 100);
  
     $thumb_img->save($destinationPaths.'/'.$document_file,80);

      }       
        else{
            $document_file = $rv_documents->document_file;
        }

$data = array(
'document_name'=>$request->input('document_name'),
'document_file'=>$document_file,

);
         $rv_documents->update($data);

  return json_encode(['status'=>'success']);
    }

    
}


