<?php
namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\service;
use App\locality;
use App\service_category;
use App\product;
use App\wishlist;
use App\product_item;
use Auth;
use View;
use \Cart as Cart;
use App\product_addon_group;
use Twilio\Rest\Client;
use Exception;
use App\admin;
use App\requested_service;
use App\product_attribute;
use App\service_document;
use App\service_photo_gallery;
use App\suport_ticket;
use App\suborder;
use App\service_subscription;
use App\service_purchase_plan;
use App\service_plan_invoice;
use App\Traits\MailerTraits;
use App\shop_category;
use Image;
use File;
use App\suport_ticket_detail;
use App\vendor_service;
use App\service_booking;

use App\service_vendor_category;
use App\service_subcategory;
use Calendar;
use App\service_customer_chat;
use App\service_bank_detail;


class serviceApiController extends Controller
{




    use MailerTraits;

    public function check_service_auth($mobile)
    {
        $mobile_record = User::where('mobile', $mobile)->first();
        if ($mobile_record) {

            if ($mobile_record->role==5) {

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
                    'response'=>'success',
                    'type'=>$msg['type']
                ];
                return ['status'=>'success'];
            }

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
                    'response'=>$msg['message'],
                    'type'=>$msg['type']
                ];
                return ['status'=>'signin'];
            }

        }

// Session::put('session_users_otp',$six_digit_otp);

        return ['status'=>json_decode($response, true)];


    }



    public function service_sigin_otp_verify(Request $request)
    {

      $mobile = $request->mobile;

      $otp=(int)$request->otp;


      $mobile_users=DB::table('users')->where('mobile',$mobile)->where('role','5')->first();

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

// return $response;
    $new_response=json_decode($response, true);




    if ($new_response['message']=='OTP verified success' || $new_response['message']=='Mobile no. already verified' || $new_response['message']=='Mobile no. not found' || $new_response['message'] =='OTP expired') {
           // return json_encode($mobile_users);

      if (!empty($mobile_users)) {

        $user = User::find($mobile_users->id);

        $services=service::where('user_id',$user->id)->select('id')->first();

        Auth::login($user);
        $tokenobj = \Auth::User()->createToken('name');
        $token = $tokenobj->accessToken;


        $data=array();
        $data['user_id']=$user->id;
        $data['id']=$services->id;
        $data['name']=$user->name;
        $data['email']=$user->email;

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


public function service_sigup_otp_verify(Request $request)
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

// return json_encode($new_response);

    if ($new_response['message']=='OTP verified success' || $new_response['message']=='Mobile no. already verified') {          


        $msg = json_decode($response, true);

// if (strlen($mobile)==10) {
//   $mobile='+91'.$mobile;
// }



        $user_data = array(
          'name' => $request->input('name'),
          'mobile' =>$mobile,
          'email' => $request->input('email'),
          'password' => bcrypt($otp),
          'role' =>'5',
          'status'=>'Deactive'

      );
        $users = new user($user_data);
        $users->save();


        $data = array(
            'service_category'=>$request->input('category'),
            'service_owner_name'=>$request->input('name'),
            'service_owner_email'=>$request->input('email'),
            'service_owner_mobile'=>$mobile,
            'service_name'=>$request->input('service_name'),
            'password'=>$otp,
            'status'=>"Deactive",
            'user_id' =>$users->id,
            'service_city'=>$request->input('service_city'),
            'created_by'=>'Frontend',

        );

        $service = new service($data);
        $service->save();





        $user = User::find($users->id);
        Auth::login($user);

        $tokenobj = \Auth::User()->createToken('name');
        $token = $tokenobj->accessToken;


        $data=array();
        $data['user_id']=$user->id;
        $data['name']=$user->name;
        $data['email']=$user->email;
        $data['id']=$service->id;
        return ['status'=>'success','data' => $data,'token'=>$token];
    // return "success";
// return ['status'=>'success'];


    } else {
        $data = [
            'status'=>'false',
            'error'=>'true',
            'response'=>$err
        ];

        return ['status'=>json_decode($response, true)];


    }

}



public function testapi(Request $request)
{


    return json_encode('success');

}


public function service_dashboard(Request $request)
{


    $total_services=vendor_service::where('service_id',Auth::user()->id)->count();
    $total_booking=service_booking::where('service_user_id',Auth::user()->id)->where('status','Booking')->count();
    $total_cancelled=service_booking::where('service_user_id',Auth::user()->id)->where('status','Cancelled')->count();
    $total_completed=service_booking::where('service_user_id',Auth::user()->id)->where('status','Completed')->count();


    return compact('total_services','total_booking','total_cancelled','total_completed');


}



public function service_profile_view_only(Request $request)
{



// dd( $request->id);

    $record1 = service::where('user_id',Auth::user()->id)->first();         
    $path=url('/').'/public/images/service_cover_photo/';

    $record=(object)[
        'id'=>$record1->id,
        'service_unique_id'=>$record1->service_unique_id,
        'service_owner_name'=>$record1->service_owner_name,
        'service_owner_email'=>$record1->service_owner_email,
        'service_owner_mobile'=>$record1->service_owner_mobile,
        'category_name'=>$record1->category->category_name,
        'service_name'=>$record1->service_name,
        'service_cover_photo'=>$path.'/'.$record1->service_cover_photo,
        'locality_name'=>$record1->locality->locality_name,
        'state_name'=>$record1->state->state_name,
        'service_mobile'=>$record1->service_mobile,
        'service_phone'=>$record1->service_phone,
        'service_email'=>$record1->service_email,
        'service_open_time'=>$record1->service_open_time,
        'service_close_time'=>$record1->service_close_time,
        'service_address'=>$record1->service_address,
        'service_description'=>$record1->service_description,
    ];



    return json_encode($record);
}




public function service_profile_view(Request $request)
{



// dd( $request->id);

    $record = service::where('user_id',Auth::user()->id)->first();         


// return json_encode(Auth::user()->id);


    $countries = DB::table('countries')  
    ->select('country_name','id')
    ->where('status','Active')
    ->orderBy('country_name', 'asc')->pluck('country_name','id'); 

    $categories = DB::table('service_categories')  
    ->select('category_name','id')
    ->where('status','Active')
    ->orderBy('category_name', 'asc')->pluck('category_name','id'); 


    $use = DB::table('commission_settings')  
    ->select('commission_rate','commission_type','id')
    ->where('status','Active')
    ->where('commission_for','service')
    ->orderBy('commission_rate', 'asc')->select('commission_rate','id','commission_type')->get(); 



    $commissions = array();
    foreach($use as $user) {

        if ($user->commission_type=='Percentage') {
            $type='%';
        }else{
           $type='$';
       }
       $commissions[$user->id] = $user->commission_rate.$type;
   }


   $subscriptions = DB::table('service_subscriptions')  
   ->select('service_plan_name','id')
   ->where('status','Active')
   ->orderBy('service_plan_name', 'asc')->pluck('service_plan_name','id'); 



   $states = DB::table('states')
   ->where('states.country_id','=', $record['service_country'])
   ->where("states.status",'Active')
   ->pluck('states.state_name','states.id');

// dd($states);
   $cities = DB::table('cities')
   ->where('cities.state_id','=', $record['service_state'])
   ->where("cities.status",'Active')
   ->pluck('cities.city_name','cities.id');


   $localities = DB::table('localities')
   ->where('localities.city_id','=', $record['service_city'])
   ->where("localities.status",'Active')
   ->pluck('localities.locality_name','localities.id');


// dd($localities);

   return compact('commissions','countries','categories','subscriptions','record','states','cities','localities');
}

public function service_profile_update(Request $request)
{

  $services = service::find($request->id); 



  if($request->hasFile('service_logo'))

  {       
   $file = $request->file('service_logo');
   $extension = $request->file('service_logo')->getClientOriginalExtension();
   $service_logo = date('d_m_Y_h_i_s',time()) . '1.' . $extension;

   $destinationPaths = base_path().'/public/images/service_logo';

   $thumb_img =Image::make($file->getRealPath())->orientate()->resize(100, 100);

   $thumb_img->save($destinationPaths.'/'.$service_logo,80);


}       
else{
    $service_logo = $services->service_logo;
}


if($request->hasFile('service_cover_photo'))
{       
   $file = $request->file('service_cover_photo');
   $extension = $request->file('service_cover_photo')->getClientOriginalExtension();
   $service_cover_photo = date('d_m_Y_h_i_s',time()) . '2.' . $extension;

   $destinationPaths = base_path().'/public/images/service_cover_photo/';
   $thumb_img =Image::make($file->getRealPath())->orientate()->resize(400, 250);
   $thumb_img->save($destinationPaths.'/'.$service_cover_photo,80);

}       
else{
    $service_cover_photo = $services->service_cover_photo;
}


$data = array(
//                
    'service_cover_photo'=>$service_cover_photo,
    'service_logo'=>$service_logo,
    'service_owner_name'=>$request->input('service_owner_name'),
    'service_owner_email'=>$request->input('service_owner_email'),
    'service_owner_mobile'=>$request->input('service_owner_mobile'),
    'service_name'=>$request->input('service_name'),
    'service_mobile'=>$request->input('service_mobile'),
    'service_phone'=>$request->input('service_phone'),
    'service_email'=>$request->input('service_email'),
    'service_gstin_no'=>$request->input('service_gstin_no'),
    'service_website'=>$request->input('service_website'),
    'service_facebook_url'=>$request->input('service_facebook_url'),
    'service_instagram_url'=>$request->input('service_instagram_url'),
    'service_you_tube_url'=>$request->input('service_you_tube_url'),
    'service_twitter_url'=>$request->input('service_twitter_url'),
    'service_pincode'=>$request->input('service_pincode'),
    'service_address'=>$request->input('service_address'),
    'service_longitude'=>$request->input('service_longitude'),
    'service_latitude'=>$request->input('service_latitude'),
    'service_paypal_email'=>$request->input('service_paypal_email'),
    'service_paytm_mobile'=>$request->input('service_paytm_mobile'),
    'str_bank_account_no'=>$request->input('str_bank_account_no'),
    'str_bank_account_name'=>$request->input('str_bank_account_name'),
    'str_bank_bank_name'=>$request->input('str_bank_bank_name'),
    'str_bank_ifsc_code'=>$request->input('str_bank_ifsc_code'),
    'str_bank_branch'=>$request->input('str_bank_branch'),
    'str_bank_branch_addr'=>$request->input('str_bank_branch_addr'),
    'str_bank_account_type'=>$request->input('str_bank_account_type'),
    'service_commission_id'=>$request->input('service_commission_id'),
    'service_category'=>$request->input('service_category'),
    'service_country'=>$request->input('service_country'),
    'service_state'=>$request->input('service_state'),
    'service_city'=>$request->input('service_city'),
    'service_payout_option'=>$request->input('service_payout_option'),
    'service_plan_id'=>$request->input('service_plan_id'),
    'service_email_option'=>$request->input('service_email_option'),
    'service_sms_option'=>$request->input('service_sms_option'),
    'service_stock_management'=>$request->input('service_stock_management'),
    'service_invoice_period'=>$request->input('service_invoice_period'),
    'str_verified_status'=>$request->input('str_verified_status'),
    'service_description'=>$request->input('service_description'),
    'service_owner_gendor'=>$request->input('service_owner_gendor'),
    'service_locality'=>$request->input('service_locality'),

);



DB::table('users')
->where('id',$services->user_id)
->update(
    ['name' => $request->input('service_name')]
);




$services->update($data);


return json_encode(['status'=>'success']);

}


public function service_document_view(Request $request)
{

    $records=DB::table('service_documents')->orderBy('service_documents.id','desc');

    if (!empty($request->search)) {
       $records= $records
       ->orWhere('service_documents.document_name','like','%' . $request->search . '%');
   }

   $records= $records
   ->where('user_id',Auth::user()->id)
   ->get();



   $use = DB::table('service_documents')  
   ->select('document_name','id')     
   
   ->get(); 

   $service_documents = array();
   foreach($use as $user) {

    $service_documents[]=['id'=>(int)$user->id,'name'=> (string)$user->document_name];
}
  // return json_encode($service_documents);
return compact('records','service_documents');

}


public function service_document_form(Request $request)
{
  $records=DB::table('service_documents')
  ->where('user_id',Auth::user()->id)
  ->pluck('document_name','document_name')->toarray();

// dd($records);

  $use = DB::table('documents')  
  ->select('document_name','id')
  ->where('status','Active')
  ->where('document_for','Service')
  ->whereNotIn('document_name', $records)->select('document_name','id')->get(); 


  $documents = array();
  foreach($use as $user) {
    $documents[]=['id'=>(int)$user->id,'name'=> (string)$user->document_name];

}


return json_encode($documents);

}



public function service_document_add(Request $request)
{

   if($request->hasFile('document_file'))
   {       
       $file = $request->file('document_file');
       $extension = $request->file('document_file')->getClientOriginalExtension();
       $document_file = date('d_m_Y_h_i_s',time()) . '1.' . $extension;
       $destinationPath = base_path().'/public/images/service_document';
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
    'service_id'=>$request->service_id,

);
$service_document = new service_document($data);
$service_document->save();

return json_encode(['status'=>'success']);



}



public function service_document_update(Request $request)
{

  $service_documents = service_document::find($request->id); 

  if($request->hasFile('document_file'))

  {       
   $file = $request->file('document_file');
   $extension = $request->file('document_file')->getClientOriginalExtension();
   $document_file = date('d_m_Y_h_i_s',time()) . '1.' . $extension;

   $destinationPaths = base_path().'/public/images/service_document';

   $thumb_img =Image::make($file->getRealPath())->orientate()->resize(100, 100);

   $thumb_img->save($destinationPaths.'/'.$document_file,80);

}       
else{
    $document_file = $service_documents->document_file;
}

$data = array(
    'document_name'=>$request->input('document_name'),
    'document_file'=>$document_file,

);
$service_documents->update($data);

return json_encode(['status'=>'success']);
}




public function service_photo_gallery(Request $request)
{
   $path=url('/').'/public/images/service_photo_gallery/';

   $records=DB::table('service_photo_galleries')->orderBy('service_photo_galleries.id','desc');

   if (!empty($request->search)) {
       $records= $records
       ->orWhere('service_photo_galleries.gallery_img','like','%' . $request->search . '%');
   }
   $records= $records
   ->where('service_photo_galleries.service_user_id',Auth::user()->id)
   ->whereNotNull('gallery_img')
   ->select('id',DB::raw("CONCAT('".$path."', service_photo_galleries.gallery_img) as gallery_img"))
   ->get();


   return json_encode($records);

}



public function service_photo_gallery_add(Request $request)
{


    if($request->hasFile('gallery_img'))
    {       
       $file = $request->file('gallery_img');
       $extension = $request->file('gallery_img')->getClientOriginalExtension();
       $gallery_img = date('d_m_Y_h_i_s',time()) . '1.' . $extension;
       $destinationPaths = base_path().'/public/images/service_photo_gallery';

       $thumb_img =Image::make($file->getRealPath())->orientate()->resize(350, 350);

       $thumb_img->save($destinationPaths.'/'.$gallery_img,80);
   }        
   else{
    $gallery_img = "";
}



$data = array(
    'service_id'=>$request->service_id,
    'service_user_id'=>Auth::user()->id,
    'gallery_img'=>$gallery_img,

);
$service_photo_gallery = new service_photo_gallery($data);
$service_photo_gallery->save();


return json_encode(['status'=>'success']);

}



public function service_photo_gallery_update(Request $request)
{



    $service_photo_galleries = service_photo_gallery::find($request->id); 

    if($request->hasFile('gallery_img'))

    {       
       $file = $request->file('gallery_img');
       $extension = $request->file('gallery_img')->getClientOriginalExtension();
       $gallery_img = date('d_m_Y_h_i_s',time()) . '1.' . $extension;

       $destinationPaths = base_path().'/public/images/service_photo_gallery';

       $thumb_img =Image::make($file->getRealPath())->orientate()->resize(350, 350);

       $thumb_img->save($destinationPaths.'/'.$gallery_img,80);

   }       
   else{
    $gallery_img = $service_photo_galleries->gallery_img;
}

$data = array(
    'gallery_img'=>$gallery_img,

);
$service_photo_galleries->update($data);

return json_encode(['status'=>'success']);

}




public function service_support_ticket_view(Request $request)
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


   $use = DB::table('tickets')  
   ->select('ticket_name','id')
   ->where('status','Active')
   ->where('ticket_role','like','%' .'service' . '%')
   ->orderBy('ticket_name', 'asc')->select('ticket_name','id')->get(); 

// dd($tickets);

   $tickets = array();
   foreach($use as $user) {
    $tickets[]=['id'=>(int)$user->id,'name'=> (string)$user->ticket_name];

}


return json_encode($tickets);

}



public function service_support_ticket_add(Request $request)
{

    $data = array(
        'ticket_name'=>$request->input('ticket_name'),
        'vendor_name'=>Auth::user()->name,
        'vendor_email'=>Auth::user()->email,
        'subject'=>$request->input('subject'),
        'message'=>$request->input('message'),
        'user_id'=>Auth::user()->id,
        'message_by'=>'service',
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
    'message_by'=>'service',
    'attachment'=>$attachment,
    
);
$suport_ticket_detail = new suport_ticket_detail($data);
$suport_ticket_detail->save();




return json_encode(['status'=>'success']);

}



public function service_support_ticket_msg_show($ticket_id)
{


   $records=DB::table('suport_ticket_details')
   ->whereIn('suport_ticket_details.message_by',['service','Admin'])
   ->where('suport_ticket_details.ticket_id',$ticket_id)

   ->get();


   $record=DB::table('suport_tickets')
   ->where('suport_tickets.user_id',Auth::user()->id)
   ->where('suport_tickets.id',$ticket_id)
   ->first();



   return compact('records','record');

}



public function service_support_ticket_send_msg(Request $request)
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
    'message_by'=>'service',
    'attachment'=>$attachment,

);

 // dd($data);
$suport_ticket_detail = new suport_ticket_detail($data);
$suport_ticket_detail->save();




return json_encode(['status'=>'success']);


}


public function service_subs_plan_view(Request $request)
{


    $service_plans=DB::table('service_subscriptions')
    ->orderByRaw("FIELD(service_plan_name,'PLATINUM' , 'GOLD', 'SILVER', 'Free') ASC")
    ->where('service_plan_name','<>','Free')
    ->get();

    $inform=DB::table('service_purchase_plans')
    ->where('service_purchase_plans.user_id',Auth::user()->id)
    // ->select('service_purchase_plans.created_at','service_purchase_plans.service_plan_name','service_purchase_plans.plan_expiry_date','service_purchase_plans.plan_status','service_purchase_plans.id')
    ->where('plan_status','<>','Expired')
    ->first();


    return compact('inform','service_plans');


}



public function service_purchase_plan(Request $request)
{




  $record = service_subscription::find($request->subscription_plan_id); 

  $service_info=service::where('user_id',Auth::user()->id)->first();
  $currentDate=Carbon::now()->toDateTimeString();

  $expiryDate=Carbon::now()->addDays($record->service_plan_validity)->toDateTimeString();


  $plan_data = array(

    'user_id'=>Auth::user()->id,
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
  ->where('services.user_id',Auth::user()->id)
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
    'user_id'=>Auth::user()->id,
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


$mailstatus = $this->servicePurchasePlans($service_plan_invoice,$plans,$invoicepdf);


return json_encode(['status'=>'success']);        


}


public function service_subs_plan_history(Request $request)
{



   $records=DB::table('service_purchase_plans')
   ->join('service_plan_invoices','service_plan_invoices.service_plan_id','service_purchase_plans.id')
   ->where('service_purchase_plans.user_id',Auth::user()->id)
   ->select('service_purchase_plans.created_at','service_purchase_plans.service_plan_name','service_purchase_plans.plan_expiry_date','service_purchase_plans.plan_status','service_purchase_plans.id','service_plan_invoices.service_invoice_id','service_plan_invoices.service_total_amount','service_plan_invoices.status as invoic_status','service_purchase_plans.service_product_limit')
   ->get();


   return json_encode($records);


}





public function service_plan_invoice_download(Request $request)
{   
 $admin_info=DB::table('admins')
 ->first();


 $plans=service_purchase_plan::where('user_id',Auth::user()->id)
 ->where('service_purchase_plans.id',$request->id)
 ->first();


 $service_plan_invoice=service_plan_invoice::where('user_id',Auth::user()->id)
 ->where('service_plan_invoices.service_plan_id',$request->id)
 ->first();


 $invoicepdf = \PDF::loadView('emails.service_plan_invoice',compact('service_plan_invoice','plans','admin_info'));

 return $invoicepdf->download('Marchant'.$plans->id.'.pdf');

}



public function service_add_bank_detail(Request $request)
{

    $bank_detail = service_bank_detail::where('user_id',Auth::user()->id)->first();

    if (empty($bank_detail)) {

        $data = array(
            'bankname'=>$request->input('bankname'),
            'branchname'=>$request->input('branchname'),
            'ifsc'=>$request->input('ifsc'),
            'account'=>$request->input('account'),
            'acountname'=>$request->input('acountname'),
            'user_id'=>Auth::user()->id,
            'status'=>$request->status,

        );
        $service_bank_detail = new service_bank_detail($data);
        $service_bank_detail->save();


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





public function service_selected_categories(Request $request)
{

    $services=DB::table('services')
    ->select('service_category','id','service_name','service_subcategory')
    ->where('id',$request->service_id)
    ->first();


    $use = DB::table('service_categories')  
    ->select('category_name','id')        
    ->whereNotIn('id',[$services->service_category])
    ->orderBy('category_name', 'asc')->get(); 

    $service_categorys = array();
    foreach($use as $user) {
        $service_categorys[]=['id'=>(int)$user->id,'name'=> (string)$user->category_name];
    }


    $shop_categories=DB::table('services')
    ->select(\DB::raw("GROUP_CONCAT(service_subcategories.service_subcategory) as service_subcategory"),\DB::raw("GROUP_CONCAT(service_subcategories.id) as id"))
    ->leftjoin("service_subcategories",\DB::raw("FIND_IN_SET(service_subcategories.id,services.service_subcategory)"),">",\DB::raw("'0'"))
    ->where('services.id',$request->service_id)
    ->groupby('service_subcategories.id')
    ->whereNotNull('service_subcategories.id')
    ->get();

    $newarr=[];

    foreach($shop_categories as $index=>$data){
        $newarr[]=$data->id;
    }

// dd($newarr);

    $categories= DB::table('service_subcategories')
    ->where('service_subcategories.service_category',$services->service_category)
    ->select('service_subcategories.service_subcategory','service_subcategories.id');

    if (count($newarr)>0) {
        $categories= $categories
        ->whereNotIn('service_subcategories.id',$newarr);
    }

    $categories= $categories
    ->get();


    return compact('categories','service_categorys','shop_categories','services');


}





public function service_add_new_category(Request $request)
{

   $category_id=DB::table('service_subcategories')
   ->select('service_category','id','service_subcategory')
   ->whereIn('id',$request->category_id)
   ->get();


   foreach($category_id as $index=>$data){

    $data = array(
        'service_id'=>$request->service_id,
        'user_id'=>Auth::user()->id,
        'service_category_id'=>$data->service_category,
        'status'=>'Active',
        'service_subcategory'=>$data->service_subcategory,
        'service_subcategory_id'=>$data->id


    );


    $service_vendor_category = service_vendor_category::updateOrCreate($data);


    DB::table('services')
    ->where('id',$request->service_id)
    ->update([
        'service_subcategory'=>implode(',',$request->category_id),
    ]);
}

return json_encode(['status'=>'success']);

}



public function service_add_new_custome_category(Request $request)
{


  $data = array(
    'service_category'=>$request->input('service_category'),
    'service_subcategory'=>$request->input('service_subcategory'),

);

  $service_subcategory = service_subcategory::updateOrCreate($data);


// dd($service_subcategory->id);
         // $service_subcategory = new service_subcategory($data);
         // $service_subcategory->save();



  $data = array(
    'service_id'=>$request->service_id,
    'user_id'=>Auth::user()->id,
    'service_category_id'=>$request->service_category,
    'status'=>'Active',
    'service_subcategory'=>$request->service_subcategory,
    'service_subcategory_id'=>$service_subcategory->id

);


  $service_vendor_category = service_vendor_category::updateOrCreate($data);


  $category_id=DB::table('services')
  ->select('service_subcategory','id')
  ->where('id',$request->service_id)
  ->first();

  DB::table('services')
  ->where('id',$request->service_id)
  ->update([
    'service_subcategory'=>$category_id->service_subcategory.','.$service_subcategory->id,
]);


  return json_encode(['status'=>'success']);

}



public function service_item_view(Request $request)
{



    $records=DB::table('vendor_services')->orderBy('vendor_services.id','desc')
    ->join('service_categories','service_categories.id','vendor_services.service_category')
    ->leftjoin('service_subcategories','service_subcategories.id','vendor_services.service_subcategory')
    ->leftjoin('brands','brands.id','vendor_services.service_brand');
    if (!empty($request->search)) {
       $records= $records
       ->orWhere('vendor_services.service_name','like','%' . $request->search . '%');
   }

   $records= $records
   ->select('vendor_services.*','service_categories.category_name','service_subcategories.service_subcategory','brands.brand_name')
   ->where('vendor_services.user_id',Auth::user()->id)
   ->paginate(25);

   return json_encode($records);
}



public function service_item_form_view(Request $request)
{


    $record = vendor_service::find($request->id);         


    $services=DB::table('services')
    ->where('user_id',Auth::user()->id)->select('id','service_category','service_subcategory')->first();

// return json_encode($services);
    $categories = DB::table('service_vendor_categories')  
    ->where('service_vendor_categories.id',explode(',',$services->service_subcategory))

    ->pluck('service_vendor_categories.service_subcategory','service_vendor_categories.service_subcategory_id as id'); 


    $warranty = [];
    for ($warranty_exp=1; $warranty_exp <= 12; $warranty_exp++) $warranty[$warranty_exp] = $warranty_exp;


    

    $autoincid = mt_rand(10,100);
    $Y = date('Ys');
    $keydata = 'Prod'.$Y.''.$autoincid;


    $brands = DB::table('brands')  
    ->select('brand_name','id')
    ->where('status','Active')
    ->whereIn('brand_type', ['Both','Service'])->pluck('brand_name','id'); 

    return compact('categories','warranty','keydata','services','brands','record');


}




public function service_item_add(Request $request)
{



    if($request->hasFile('service_img'))

    {       
       $file = $request->file('service_img');
       $extension = $request->file('service_img')->getClientOriginalExtension();
       $service_img = date('d_m_Y_h_i_s',time()) . '.' . $extension;

       $destinationPaths = base_path().'/public/images/service_img';

       $thumb_img =Image::make($file->getRealPath())->orientate()->resize(600, 450);

       $thumb_img->save($destinationPaths.'/'.$service_img,80);

   }       
   else{
    $service_img = "";
}


$record=DB::table('services')
->where('user_id',Auth::user()->id)->select('id','service_unique_id')->first();


// dd($record);

$service_payment_mode='';
if ($request->service_payment_mode) {
 $service_payment_mode =implode(',',$request->service_payment_mode);
}
$data = array(
    'service_id'=>$record->id,
    'user_id'=>Auth::user()->id,
    'vendor_unique_id'=>$record->service_unique_id,
    'service_unique_id'=>$request->input('service_unique_id'),
    'service_category'=>$request->input('service_category'),
    'service_subcategory'=>$request->input('service_subcategory'),
    'service_name'=>$request->input('service_name'),
    'service_brand'=>$request->input('service_brand'),
    'service_description'=>$request->input('service_description'),
    'service_sku'=>$request->input('service_sku'),
    'service_price'=>$request->input('service_price'),
    'service_payment_mode'=>$service_payment_mode,
    'service_offer_discount'=>$request->input('service_offer_discount'),
    'service_img'=>$service_img,
    'service_link'=>str_replace(' ','-',strtolower($request->service_name)).'-'.$request->service_unique_id,
    'created_by'=>'Custom',
);

// dd($data);
$vendor_service = new vendor_service($data);
$vendor_service->save();


return json_encode(['status'=>'success']);


}



public function service_item_update(Request $request)
{

   $vendor_services = vendor_service::find($request->id); 
   if($request->hasFile('service_img'))

   {       
       $file = $request->file('service_img');
       $extension = $request->file('service_img')->getClientOriginalExtension();
       $service_img = date('d_m_Y_h_i_s',time()) . '.' . $extension;

       $destinationPaths = base_path().'/public/images/service_img';

       $thumb_img =Image::make($file->getRealPath())->orientate()->resize(600, 450);

       $thumb_img->save($destinationPaths.'/'.$service_img,80);

   }       
   else{
    $service_img = $vendor_services->service_img;
}




$record=DB::table('services')
->where('id',$request->id)->select('id','service_unique_id')->first();


// dd($record);
$service_payment_mode='';
if ($request->service_payment_mode) {
 $service_payment_mode =implode(',',$request->service_payment_mode);
}
$data = array(

    'service_unique_id'=>$request->input('service_unique_id'),
    'service_category'=>$request->input('service_category'),
    'service_subcategory'=>$request->input('service_subcategory'),
    'service_name'=>$request->input('service_name'),
    'service_brand'=>$request->input('service_brand'),
    'service_description'=>$request->input('service_description'),
    'service_sku'=>$request->input('service_sku'),
    'service_price'=>$request->input('service_price'),
    'service_payment_mode'=>$service_payment_mode,
    'service_offer_discount'=>$request->input('service_offer_discount'),
    'service_img'=>$service_img,
    'service_link'=>str_replace(' ','-',strtolower($request->service_name)).'-'.$request->service_unique_id,
// 'created_by'=>'Custom',
);


// dd($data);
$vendor_services->update($data);

return json_encode(['status'=>'success']);

}



public function service_item_delete(Request $request)
{


    $vendor_services = vendor_service::find($request->id);
    $vendor_services->delete();

    return json_encode(['status'=>'success']);

}



public function service_booking_view(Request $request)
{



 $events = [];
 $data = service_booking::where('service_user_id',Auth::user()->id)->get();
 if($data->count()) {
    foreach ($data as $key => $value) {


            $colors=[
                'color' => '#569c02',
                'url' => url('service/booking?title='.$value->title),
            ];


if ($value->booked_by=='Admin') {
    $booked=' Add By Admin';

}else{
  $booked='';
}

$events[] = Calendar::event(
    $value->title.$booked,
    true,
    new \DateTime($value->start_date),
    new \DateTime($value->end_date.' +1 day'),
    null,
                    // Add color and link on event
    $colors
                    // [
                    //     'color' => '#f05050',
                    //     'url' => url('service/booking'),
                    // ]

);
}
}
$calendar = Calendar::addEvents($events);
        // return view('fullcalender', compact('calendar'));
// dd($calendar)
Session::put('url.role',\Request::fullUrl());
$currentURL=Session::get('url.role');

$event_records=DB::table('service_bookings')
    ->join('users','users.id','service_bookings.user_id')
    ->leftjoin('customers','customers.user_id','service_bookings.user_id')
    ->leftjoin('cities','cities.id','customers.customer_city')
->where('service_bookings.service_user_id',Auth::user()->id)
->select('service_bookings.*','users.name','users.mobile','users.email','cities.city_name','customers.customer_address');

if (!empty($request->title)) {

    $event_records=$event_records
        ->where('service_bookings.title',$request->title);
}

    if (!empty($request->date)) {
    $event_records=$event_records
    ->whereDate('service_bookings.start_date','<=', $request->date)
    ->whereDate('service_bookings.end_date','>=', $request->date);
    }





$event_records=$event_records
->groupby('service_bookings.id')
->orderBy('service_bookings.id','Desc')
->paginate(25);


// dd($event_records);




$vendords=DB::table('services')
->select('service_name')
->where('user_id',Auth::user()->id)
->first();

 $states = DB::table('states')  
                    ->select('state_name','id')
                     ->where('status','Active')
            ->orderBy('state_name', 'asc')->pluck('state_name','id'); 


return compact('currentURL','calendar','event_records','vendords','states');



}


public function append_booking_user_info(Request $request)
{

    $users=DB::table('users')
    ->join('customers','customers.user_id','users.id')
    ->leftjoin('cities','cities.id','customers.customer_city')
    ->Where('users.mobile','like','%' . $request->mobile . '%')
    ->select('users.id','users.name','users.mobile','users.email','cities.city_name','customers.customer_address')
    ->where('users.role','3')->first();

     return json_encode($users);

}


public function service_booking_add(Request $request)
{



$users_id=$request->input('user_id');

if (empty($users_id)) {
  
 $user_data = array(
      'name' => $request->input('customer_name'),
           'email' => $request->input('customer_email'),
           'password' => bcrypt($request->input('customer_password')),
            'role' =>'3',
            'status'=>'Active',

);
  $users = new user($user_data);
         $users->save();

$users_id=$users->id;


$state=DB::table('states')->where('id')->first();


         $data = array(
'customer_name'=>$request->input('customer_name'),
'customer_email'=>$request->input('customer_email'),
'customer_login_email'=>$request->input('customer_email'),
'customer_country'=>$state->country_id,
'customer_state'=>$request->input('customer_state'),
'customer_city'=>$request->input('customer_city'),
'customer_locality'=>$request->input('customer_locality'),
'customer_address'=>$request->input('customer_address'),
'customer_pincode'=>$request->input('customer_pincode'),
'customer_mobile'=>$request->input('customer_mobile'),    
'user_id' =>$users->id,
'customer_userid'=>'Cust'.$users->id.date('Y'),
'created_by'=>'Admin',



);
         $customer = new customer($data);
         $customer->save();

}

$data = array(
  
'title'=>$request->input('title'),
'start_date'=>$request->start_date,
'end_date'=>$request->end_date,
'status'=>$request->input('status'),
'description'=>$request->input('description'),
'service_user_id'=>Auth::user()->id,
'user_id'=>$users_id,
'booking_date'=>$request->start_date.'-'.$request->start_date,
'booked_by'=>'Service',
'booking_amount'=>$request->input('booking_amount'),
'advance_amount'=>$request->input('advance_amount'),
'payment_mode'=>$request->input('payment_mode'),
'booking_subcategory'=>implode(',',$request->input('booking_subcategory')),

);

// dd($data);
$events = new service_booking($data);
$events->save();

return ['status'=>'success'];
}

public function service_booking_update(Request $request)
{

$Event = service_booking::findOrFail($request->id); 

//     $both=$request->booking_date;

//     if (!empty($both)) {
//    $str= explode(' - ', $both);

//        $start_date=$str[0];
//        $end_date=$str[1];

//    }else{
//     $start_date='';
//     $end_date='';
// }

$data = array(
  
'title'=>$request->input('title'),
'start_date'=>$request->start_date,
'end_date'=>$request->end_date,
'status'=>$request->input('status'),
'description'=>$request->input('description'),
'booking_date'=>$request->start_date.'-'.$request->end_date,
'booked_by'=>'Service',
'booking_amount'=>$request->input('booking_amount'),
'advance_amount'=>$request->input('advance_amount'),
'payment_mode'=>$request->input('payment_mode'),
'booking_subcategory'=>implode(',',$request->input('booking_subcategory')),

);



$Event->update($data);


return ['status'=>'success'];

}

public function service_booking_delete(Request $request)
{

 $role = service_booking::find($request->id);
 $role->delete();

return ['status'=>'success'];

}



public function service_booking_send_enquiry(Request $request)
{

 $messages=DB::table('service_customer_chats')
    ->where('service_customer_chats.enquiry_id',$request->service_booking_id)
    ->orderBy('service_customer_chats.id', 'desc')
    ->first();

// dd($messages);

if (!empty($messages)) {
      $message_number= $messages->message_number;
     }else{
      $message_number='1';
     }



$data = array(
'message_number'=>$message_number,
'message'=>$request->user_message,
'from_id'=>Auth::user()->id,
'user_id'=>Auth::user()->id,
'to_id'=>$request->customer_user_id,
'enquiry_id'=>$request->service_booking_id,
'identifier'=>'Service',
);

$service_customer_chat = new service_customer_chat($data);
$service_customer_chat->save();

return ['status'=>'success'];

}

public function service_booking_view_enquiry(Request $request)
{


         $chat_message=DB::table('service_customer_chats')
          ->where('service_customer_chats.enquiry_id',$request->service_booking_id)
          ->select('message','id','identifier','created_at')
          ->get();


  $event_records=DB::table('service_bookings')->select('user_id','start_date','end_date')->where('id',$request->service_booking_id)->first();



return compact('chat_message','event_records');


}


}