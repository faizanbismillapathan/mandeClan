<?php
namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\store;
use App\locality;
use App\store_category;
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
use App\customer;
use App\review;
use App\customer_address_book;
use App\suport_ticket;
use App\suport_ticket_detail;
use App\customer_bank_detail;
use App\suborder;
use App\order_status_management;
use App\customer_subscription;
use App\customer_purchase_plan;
use App\customer_plan_invoice;
use App\Traits\MailerTraits;





class customerApiController extends Controller
{


use MailerTraits;


public function testapi(Request $request)
{

return json_encode('success');

}



public function customer_dashboard(Request $request)
{


$order=suborder::where('customer_user_id',Auth::user()->id)->count();
$wishlist=wishlist::where('persone_user_id',Auth::user()->id)->count();
$followed=$order;

        return compact('order','followed','wishlist');

}



public function check_customer_auth($mobile)
{
$mobile_record = User::where('mobile', $mobile)->first();
if ($mobile_record) {

if ($mobile_record->role==3) {

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



public function customer_sigin_otp_verify(Request $request)
{

  $mobile = $request->mobile;

    $otp=(int)$request->otp;


$mobile_users=DB::table('users')->where('mobile',$mobile)->where('role','3')->first();

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
 
$customer=customer::where('user_id',$user->id)->select('id')->first();

    $data=array();
        $data['user_id']=$user->id;
         $data['name']=$user->name;
        $data['email']=$user->email;
        $data['id']=$customer->id;

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


public function customer_sigup_otp_verify(Request $request)
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
  'role' =>'3',
  'status'=>'Active'

);


$users = new user($user_data);
$users->save();


// return json_encode($users);


$data = array(
  'customer_name'=>$request->name,
  'customer_mobile'=>$mobile,
  'customer_email'=>$request->email,
    'customer_login_email'=>$request->email,
'customer_gender'=>$request->input('gendor'),
  'password'=>$otp,
  'status'=>"Active",
  'user_id' =>$users->id,
 'customer_userid'=>'Cust'.$users->id.date('Y'),
'created_by'=>'Self',

);


$customer = new customer($data);
$customer->save();


$user = User::find($users->id);
Auth::login($user);

$tokenobj = \Auth::User()->createToken('name');
$token = $tokenobj->accessToken;
 

    $data=array();
        $data['user_id']=$user->id;
         $data['name']=$user->name;
        $data['email']=$user->email;
 $data['id']=$customer->id;


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




public function customer_profile_view(Request $request)
{

  $record = customer::where('user_id',Auth::user()->id)->first();     

$use = DB::table('countries')  
->where('status','Active')
->orderBy('country_name', 'asc')->select('country_name','id')->get();

$countries = array();
foreach($use as $user) {
$countries[]=['id'=>(int)$user->id,'name'=> (string)$user->country_name];

}





  $states = DB::table('states')
             ->where('states.country_id','=', $record['customer_country'])
              ->where("states.status",'Active')
            ->select('states.state_name','states.id')->get();


$countries = array();
foreach($use as $user) {
$countries[]=['id'=>(int)$user->id,'name'=> (string)$user->country_name];

}


// dd($states);
             $use = DB::table('cities')
             ->where('cities.state_id','=', $record['customer_state'])
              // ->where("cities.status",'Active')
            ->select('cities.city_name','cities.id')->get();


$cities = array();
foreach($use as $user) {
$cities[]=['id'=>(int)$user->id,'name'=> (string)$user->city_name];

}


             $use = DB::table('localities')
             ->where('localities.city_id','=', $record['customer_city'])
              ->where("localities.status",'Active')
            ->select('localities.locality_name','localities.id')->get();


$localities = array();
foreach($use as $user) {
$localities[]=['id'=>(int)$user->id,'name'=> (string)$user->locality_name];

}



        
         return compact('record','countries','states','cities','localities');

}


public function customer_profile_update(Request $request)
{

$customer = customer::find($request->id); 


  if($request->hasFile('customer_img'))
  
        {       
     $file = $request->file('customer_img');
     $extension = $request->file('customer_img')->getClientOriginalExtension();
     $customer_img = date('d_m_Y_h_i_s',time()) . '1.' . $extension;

         $destinationPaths = base_path().'/public/images/customer_img';

  $thumb_img =Image::make($file->getRealPath())->orientate()->resize(150, 150);
  
     $thumb_img->save($destinationPaths.'/'.$customer_img,80);


      }       
        else{
            $customer_img = $customer->customer_img;
        }




   $data = array(
'customer_name'=>$request->input('customer_name'),
'customer_email'=>$request->input('customer_email'),
'customer_dob'=>$request->input('customer_dob'),
'customer_gender'=>$request->input('customer_gender'),
'customer_country'=>$request->input('customer_country'),
'customer_state'=>$request->input('customer_state'),
'customer_city'=>$request->input('customer_city'),
'customer_locality'=>$request->input('customer_locality'),
'customer_address'=>$request->input('customer_address'),
'customer_pincode'=>$request->input('customer_pincode'),    
'customer_mobile'=>'+'.$request->user_country_code.str_replace(' ','',$request->input('customer_mobile')) ,    
'customer_phone'=>$request->input('customer_phone'),    
'customer_img'=>$customer_img,    
);

   // dd($data);
         $customer->update($data);

           
              DB::table('users')
         ->where('id',$customer->user_id)
         ->update(
['name' => $request->input('customer_name')]
         );


return json_encode(['status'=>'success']);

}



public function customer_current_order(Request $request)
{


$record=DB::table('suborders')
->join('customers','customers.id','suborders.customer_id')
->orderBy('suborders.id','desc');

if (!empty($request->search)) {
$record= $record
->orWhere('customers.customer_name','like','%' . $request->search . '%');
}

$record= $record
->select('customers.customer_name','customers.customer_email','customers.customer_mobile','customers.customer_userid','suborders.order_date','suborders.delivery_date','suborders.delivery_time','suborders.suborder_u_id','suborders.customer_u_id',
'suborders.subtotal','suborders.payment_method','suborders.order_status','suborders.id','suborders.grand_total','suborders.total_item','suborders.store_id','suborders.shipping_charges','suborders.pickup_type')
->groupby('suborders.id')
->whereNotIn('suborders.order_status',['Delivered','Cancelled'])
->where('suborders.customer_user_id',Auth::user()->id)
->get();


    $records=[];

    foreach($record as $index=>$data){

        $records[]=(object)[
'suborder_u_id'=>$data->suborder_u_id,
'order_date'=>$data->order_date,
'store_info'=>$this->store_informations($data->store_id),
'subtotal'=>$data->subtotal,
'shipping_charges'=>$data->shipping_charges,
'grand_total'=>$data->grand_total,
'pickup_type'=>$data->pickup_type,
'delivery_date'=>$data->delivery_date,
'id'=>$data->id,
'order_status'=>$data->order_status,
'delivery_time'=>$data->delivery_time,

        ];
    }





        return compact('records','record');


}


 public function store_informations($store_id)
    {


    $record1=store::where('id',$store_id)->first();

             $path=url('/').'/public/images/store_cover_photo/';

 $record=(object)[
'category_name'=>$record1->category->category_name,
'store_name'=>$record1->store_name,
'store_cover_photo'=>$path.'/'.$record1->store_cover_photo,
'locality_name'=>$record1->locality->locality_name,
'state_name'=>$record1->state->state_name,
'store_mobile'=>$record1->store_mobile,
'store_phone'=>$record1->store_phone,
'store_email'=>$record1->store_email,
    ];



return $record;
}

public function customer_order_details($suborder_id)
{




$orderitems=DB::table('order_items')
->where('order_items.suborder_id',$suborder_id)
->get(); 


$order_items=[];

foreach($orderitems as $index=>$data){

    $order_items[]=(object)[

'product_name'=>$data->product_name,
'item_selling_price'=>$data->item_selling_price,
'item_quantity'=>$data->item_quantity,
'item_shipping_weight'=>$data->item_shipping_weight,
'item_shipping_weight_unit'=>$data->item_shipping_weight_unit,
'addon_details'=>unserialize($data->addon_name_price),
'item_u_id'=>$data->item_u_id,
'item_offer_discount'=>$data->item_offer_discount,
'item_price'=>$data->item_price,
    ];

}

$order=DB::table('suborders')->where('id',$suborder_id) ->where('suborders.customer_user_id',Auth::user()->id)->first();


$addressBook=DB::table('order_delivery_addresses')
->where('order_id',$order->order_id)->first();
 


return compact('order_items','order','addressBook');

}



public function customer_track_order($suborder_id)
{   

$record=DB::table('suborders')->where('suborders.id',$suborder_id)
->where('suborders.customer_user_id',Auth::user()->id)
    ->join('customers','customers.id','suborders.customer_id','order_status')
    ->select('customer_name','order_date')
->first();

// dd(Auth::user()->id);

$order_status=DB::table('order_status_managements')
->join('suborders','suborders.id','order_status_managements.suborder_id')
->where('order_status_managements.suborder_id',$suborder_id)
->where('suborders.customer_user_id',Auth::user()->id)->get();
    
    // dd($order_status);
$pending='';
$approval='';
$delivered='';
$ready_to_pickup='';
$dispatch='';

$pending_status_date='';
$approval_status_date='';
$delivered_status_date='';
$ready_to_pickup_status_date='';
$dispatch_status_date='';



foreach($order_status as $key=>$data){

if ($data->status=='Pending') {
    $pending=$data->status;
    $pending_status_date=$data->status_date;


}


if ($data->status=='Approval') {
    $approval=$data->status;
    $approval_status_date=$data->status_date;

}

if ($data->status=='Delivered') {
    $delivered=$data->status;
    $delivered_status_date=$data->status_date;

}

if ($data->status=='Ready To Pickup') {
    $ready_to_pickup=$data->status;
    $ready_to_pickup_status_date=$data->status_date;

}

if ($data->status=='Dispatch') {
    $dispatch=$data->status;
    $dispatch_status_date=$data->status_date;

}

}
    
    $header_not_display='Yes';

    return compact('header_not_display','pending_status_date','approval_status_date','delivered_status_date','ready_to_pickup_status_date','dispatch_status_date','pending','approval','delivered','ready_to_pickup','dispatch','record');
}



public function customer_cancelled_order(Request $request)
{






$record=DB::table('suborders')
    ->join('customers','customers.id','suborders.customer_id')

    ->orderBy('suborders.id','desc');

    if (!empty($request->search)) {
    $record= $record
    ->orWhere('customers.customer_name','like','%' . $request->search . '%');
    }

    $record= $record
    ->select('customers.customer_name','customers.customer_email','customers.customer_mobile','customers.customer_userid','suborders.order_date','suborders.delivery_date','suborders.delivery_time','suborders.suborder_u_id','suborders.customer_u_id',
    'suborders.subtotal','suborders.payment_method','suborders.order_status','suborders.id','suborders.grand_total','suborders.total_item','suborders.store_id','suborders.shipping_charges','suborders.pickup_type')
->groupby('suborders.id')
->where('suborders.order_status','Cancelled')
->where('suborders.customer_user_id',Auth::user()->id)

    ->get();


    $records=[];

    foreach($record as $index=>$data){

        $records[]=(object)[
'suborder_u_id'=>$data->suborder_u_id,
'order_date'=>$data->order_date,
'store_info'=>$this->store_informations($data->store_id),
'subtotal'=>$data->subtotal,
'shipping_charges'=>$data->shipping_charges,
'grand_total'=>$data->grand_total,
'pickup_type'=>$data->pickup_type,
'delivery_date'=>$data->delivery_date,
'id'=>$data->id,
'order_status'=>$data->order_status,
'delivery_time'=>$data->delivery_time,
'order_status_date'=>$this->order_status_date($data->id),

        ];
    }


        return compact('records','record');

}


   public function order_status_date($suborder_id)
    {


$order_status=order_status_management::where('suborder_id',$suborder_id)->first();

return $order_status->status_date;


}


public function customer_delivered_order(Request $request)
{



$record=DB::table('suborders')
    ->join('customers','customers.id','suborders.customer_id')

    ->orderBy('suborders.id','desc');

    if (!empty($request->search)) {
    $record= $record
    ->orWhere('customers.customer_name','like','%' . $request->search . '%');
    }

    $record= $record
    ->select('customers.customer_name','customers.customer_email','customers.customer_mobile','customers.customer_userid','suborders.order_date','suborders.delivery_date','suborders.delivery_time','suborders.suborder_u_id','suborders.customer_u_id',
    'suborders.subtotal','suborders.payment_method','suborders.order_status','suborders.id','suborders.grand_total','suborders.total_item','suborders.store_id','suborders.shipping_charges','suborders.pickup_type')
->groupby('suborders.id')
->where('suborders.order_status','Delivered')
->where('suborders.customer_user_id',Auth::user()->id)

    ->get();


    $records=[];

    foreach($record as $index=>$data){

        $records[]=(object)[
'suborder_u_id'=>$data->suborder_u_id,
'order_date'=>$data->order_date,
'store_info'=>$this->store_informations($data->store_id),
'subtotal'=>$data->subtotal,
'shipping_charges'=>$data->shipping_charges,
'grand_total'=>$data->grand_total,
'pickup_type'=>$data->pickup_type,
'delivery_date'=>$data->delivery_date,
'id'=>$data->id,
'order_status'=>$data->order_status,
'delivery_time'=>$data->delivery_time,

        ];
    }





        return compact('records','record');

}


public function customer_wishlist_stores(Request $request)
{



$stores=DB::table('wishlists')
->where('wishlists.persone_user_id',Auth::user()->id)
->where('wishlists.status','Like')
->pluck('wishlists.store_id')
->toArray();


 $stor=store::whereIn('id',array_unique($stores))->where('store_locality',$request->locality_id)->get();



// dd($stores);
         $path=url('/').'/public/images/store_cover_photo/';

 $stores=[];
    foreach($stor as $index=>$data){

        $stores[]=[
            'store_cover_photo'=>$path.'/'.$data->store_cover_photo,
            'store_name'=>$data->store_name,
            'locality'=>$data->locality,
            'city'=>$data->city,
            'store_rating'=>$this->store_ratings($data->id),
            'id'=>$data->id,
 'user_id'=>$data->user_id,
        ];

    }


// dd($stores);

        return compact('stores');



}





public function store_ratings($id)
{   

    $sum=DB::table('reviews')
    ->where('store_id',$id)
    ->select('rating')
    ->sum('rating');


// dd($sum);
    $reviews_count=DB::table('reviews')
    ->where('store_id',$id)
    ->select('rating')
    ->count();


    if (!empty($reviews_count)) {

        $total=$sum/$reviews_count;
        $avg_rating= $total;

    }else{

        $avg_rating= 0;

    }


    return $avg_rating;

}



public function customer_like_store(Request $request){


  $record=\DB::table('wishlists')
  ->where('store_user_id',$request->store_user_id)
  ->where('persone_user_id',\Auth::user()->id)
  ->first();


  if(!empty($record)){

      $updatevender=\DB::table('wishlists')->where('store_user_id',$request->store_id)
      ->where('persone_user_id',\Auth::user()->id)
      ->update([
        'status'=>'Like',
    ]);

  }else{
   $data = array(
    'store_id'=>$request->store_id,
    'persone_user_id'=>\Auth::user()->id,
    'status'=>'Like',
    'product_id'=>$request->product_id,
    'store_user_id'=>$request->store_user_id,
    'persone_name'=>\Auth::user()->name,
    'persone_role'=>\Auth::user()->role,

);
   $wishlist = new wishlist($data);
   $wishlist->save();

// return json_encode($record);

}

return json_encode('Like');
}


public function customer_dislike_store(Request $request){

 $record=\DB::table('wishlists')
 ->where('store_user_id',$request->store_user_id)
 ->where('persone_user_id',\Auth::user()->id)
 ->first();



 if(!empty($record)){

   $updatevender=\DB::table('wishlists')->where('store_user_id',$request->store_id)
   ->where('persone_user_id',\Auth::user()->id)
   ->update([
    'status'=>'Dislike',
]);
}else{
    $data = array(
        'store_id'=>$request->store_id,
        'persone_user_id'=>\Auth::user()->id,
        'status'=>'Dislike',
        'product_id'=>$request->product_id,
        'store_user_id'=>$request->store_user_id,
        'persone_name'=>\Auth::user()->name,
        'persone_role'=>\Auth::user()->role,


    );
    $wishlist = new wishlist($data);
    $wishlist->save();
}

return json_encode('Dislike');
}






public function customer_rating_review(Request $request)
{



$variable=DB::table('suborders')
->where('suborders.order_status','Delivered')
->join('reviews','suborders.id','reviews.suborder_id')
->select('suborders.suborder_u_id','suborders.delivery_date','suborders.delivery_time','suborders.id','reviews.reviews','reviews.rating','suborders.store_id','reviews.attachment')
->where('suborders.customer_user_id',Auth::user()->id)
->groupby('suborders.id')
->get();

$records=[];

foreach ($variable as $key => $value) {

                $path=url('/').'/public/images/reviews/';

   $records[]=(object)[
'store_info'=>$this->store_informations($value->store_id),
'suborder_u_id'=>$value->suborder_u_id,
'delivery_date'=>$value->delivery_date,
'rating'=>$value->rating,
'reviews'=>$value->reviews,
'id'=>$value->id,
'attachment'=>$path.'/'.$value->attachment,

   ];
}



// dd($records);

        return json_encode($records);
}

public function customer_add_rating_review(Request $request)
{


        $stores=DB::table('suborders')->select('store_user_id','id','store_u_id','store_id')->where('id',$request->suborder_id)->first();


 $stores1=DB::table('stores')->select('store_name')->where('id',$stores->store_id)->first();

  $customers=DB::table('customers')->select('customer_userid','user_id','id','customer_name')->where('user_id',Auth::user()->id)->first();

$check=DB::table('reviews')
->where('store_id',$request->store_id)
->where('suborder_id',$stores->id)
->where('persone_user_id',$customers->user_id)
->first();

if (empty($check)) {


     if($request->hasFile('attachment'))
  
        {       
     $file = $request->file('attachment');
     $extension = $request->file('attachment')->getClientOriginalExtension();
     $attachment = date('d_m_Y_h_i_s',time()) . '1.' . $extension;

         $destinationPaths = base_path().'/public/images/reviews';

  
        $file->move($destinationPaths, $attachment);


      }       
        else{
            $attachment = "";
        }


   
         $data = array(  
'store_name'=>$stores1->store_name,
'store_user_id'=>$stores->store_user_id,
'store_unique_id'=>$stores->store_u_id,
'store_id'=>$stores->store_id,
'persone_name'=>$customers->customer_name,
'persone_role'=>3,
'persone_user_id'=>$customers->user_id,
'persone_unique_id'=>$customers->customer_userid,
'reviews'=>$request->input('reviews'),
'rating'=>$request->input('rating'),
'status'=>'Active',
'suborder_id'=>$stores->id,
'attachment'=>$attachment,
);
         $review = new review($data);
         $review->save();
                 

 // code...
}else{ 

        $review = review::find($check->id); 
if($request->hasFile('attachment'))
  
        {       
     $file = $request->file('attachment');
     $extension = $request->file('attachment')->getClientOriginalExtension();
     $attachment = date('d_m_Y_h_i_s',time()) . '1.' . $extension;

         $destinationPaths = base_path().'/public/images/reviews';

  
        $file->move($destinationPaths, $attachment);


      }       
        else{
            $attachment = $review->attachment;
        }

 $data = array(  
'reviews'=>$request->input('reviews'),
'rating'=>$request->input('rating'),
'attachment'=>$attachment,
);


 $review->update($data); 

}
return json_encode(['status'=>'success']);

}

public function customer_addressbook_view(Request $request)
{

$records=customer_address_book::where('user_id',Auth::user()->id)->get();

return json_encode($records);

}

public function customer_addressbook_add(Request $request)
{


        // dd($request);
         $data = array(
    'user_id'=>Auth::user()->id,
    'name'=>$request->input('name'),
    'email'=>$request->input('email'),
        'mobile'=>$request->input('mobile'),
    'phone'=>$request->input('phone'),
    'country'=>$request->input('country'),
    'city'=>$request->input('city'),
    'locality'=>$request->input('locality'),
    'pincode'=>$request->input('pincode'),
    'address'=>$request->input('address'),
    'latitude'=>$request->input('latitude'),
    'longitude'=>$request->input('longitude'),
    
);
         $customer_address_book = new customer_address_book($data);
         $customer_address_book->save();
                 


return json_encode(['status'=>'success']);

}

public function customer_addressbooks(Request $request)
{


    $record = customer_address_book::where('id',$request->id)->where('user_id',Auth::user()->id)->first();         

          // dd($record->id);

$use = DB::table('countries')  
->select('country_name','id')
->where('status','Active')
->orderBy('country_name', 'asc')->select('country_name','id')->get();


$countries = array();
foreach($use as $user) {
$countries[]=['id'=>(int)$user->id,'name'=> (string)$user->country_name];

}


$stat = DB::table('states');
if ($record) {
    $stat = $stat 
->where('states.country_id', $record->country);
}
$stat = $stat 
->where("states.status",'Active')
->select('states.state_name','states.id')->get();


$states = array();
foreach($stat as $user) {
$states[]=['id'=>(int)$user->id,'name'=> (string)$user->state_name];

}



$citie = DB::table('cities');
if ($record) {
    $citie = $citie 

->where('cities.state_id','=', $record->state);
}
$citie = $citie 
->where("cities.status",'Active')
->select('cities.city_name','cities.id')->get();

$cities = array();
foreach($citie as $user) {
$cities[]=['id'=>(int)$user->id,'name'=> (string)$user->city_name];

}



$local = DB::table('localities');
if ($record) {
    $local = $local 

->where('localities.city_id','=', $record->city);
}
$local = $local 
->where("localities.status",'Active')
->select('localities.locality_name','localities.id')->get();

         

         $localities = array();
foreach($local as $user) {
$localities[]=['id'=>(int)$user->id,'name'=> (string)$user->locality_name];

}



         // dd($record->state);
        
 return compact('record','countries','states','cities','localities');


}


public function customer_addressbook_update(Request $request)
{


        
        $customer_address_book = customer_address_book::find($request->id); 

   $data = array(
'name'=>$request->input('name'),
'email'=>$request->input('email'),
'mobile'=>$request->input('mobile'),
'phone'=>$request->input('phone'),
'country'=>$request->input('country'),
'city'=>$request->input('city'),
'locality'=>$request->input('locality'),
'pincode'=>$request->input('pincode'),
'address'=>$request->input('address'),
'latitude'=>$request->input('latitude'),
'longitude'=>$request->input('longitude'),    
);
         $customer_address_book->update($data);

           

return json_encode(['status'=>'success']);

}

public function customer_addressbook_delete(Request $request)
{

  $role = customer_address_book::find($request->id);
          $role->delete();

          return json_encode(['status'=>'success']);

}



public function customer_add_bank_detail(Request $request)
{

        $bank_detail = customer_bank_detail::where('user_id',Auth::user()->id)->first();

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
         $customer_bank_detail = new customer_bank_detail($data);
         $customer_bank_detail->save();


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



public function customer_support_ticket_view(Request $request)
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



public function customer_support_ticket_add(Request $request)
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



public function customer_support_ticket_msg_show($ticket_id)
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



public function customer_support_ticket_send_msg(Request $request)
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






public function token_check(Request $request)
{

//customer
// $user = User::find(86898); 

// seller
// $user = User::find(86908);

//rv_user
// $user = User::find(86910);

 //servics
// $user = User::find(86935);

// Auth::login($user);
// $tokenobj = \Auth::User()->createToken('name');
// $auth = $tokenobj->accessToken;
 


 
$auth=Auth::user();


return json_encode($auth);
}



public function cancelled_order_by_customer(Request $request)
{


               $updatevender=\DB::table('suborders')->where('id',$request->suborder_id)
                              ->update([
                                'order_status' => 'Cancelled',
                                 ]);

$record=\DB::table('suborders')->where('id',$request->suborder_id)->first();

              $suborder_data = array(
'order_id'=>$record->order_id,
'suborder_id'=>$record->id,
'status'=>'Cancelled',
'status_date'=>Carbon::now()->toDateTimeString(),
'status_resone'=>'',
);


 $order_status_management = new order_status_management($suborder_data);
         $order_status_management->save();

return json_encode(['status'=>'success']);
        
        
}




public function customer_subs_plan_view(Request $request)
{



$customer_plans=DB::table('customer_subscriptions')
           ->orderByRaw("FIELD(customer_plan_name,'PLATINUM' , 'GOLD', 'SILVER', 'Free') ASC")
->where('customer_plan_name','<>','Free')
->get();

 $inform=DB::table('customer_purchase_plans')
 ->where('customer_purchase_plans.user_id',Auth::user()->id)
 ->select('customer_purchase_plans.created_at','customer_purchase_plans.customer_plan_name','customer_purchase_plans.plan_expiry_date','customer_purchase_plans.plan_status','customer_purchase_plans.id')
->where('plan_status','<>','Expired')
 ->first();

  return compact('inform','customer_plans');


}


public function customer_subs_plan_history(Request $request)
{

 $records=DB::table('customer_purchase_plans')
 ->join('customer_plan_invoices','customer_plan_invoices.customer_plan_id','customer_purchase_plans.id')
 ->where('customer_purchase_plans.user_id',Auth::user()->id)
 ->select('customer_purchase_plans.created_at','customer_purchase_plans.customer_plan_name','customer_purchase_plans.plan_expiry_date','customer_purchase_plans.plan_status','customer_purchase_plans.id','customer_plan_invoices.customer_invoice_id','customer_plan_invoices.customer_total_amount','customer_plan_invoices.status as invoic_status','customer_purchase_plans.customer_product_limit')
 ->get();


  return compact('records');


}




public function customer_purchase_plan(Request $request)
{


  $record = customer_subscription::find($request->subscription_plan_id); 
   // dd($record);

     $customer_info=store::find($request->store_id);
$currentDate=Carbon::now()->toDateTimeString();

$expiryDate=Carbon::now()->addDays($record->customer_plan_validity)->toDateTimeString();


     $plan_data = array(

'user_id'=>Auth::user()->id,
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






$assordersss = DB::table('stores')
->where('stores.id',$request->store_id)
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
'user_id'=>Auth::user()->id,
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
'generated_by'=>'store',
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


  $mailstatus = $this->StorePurchasePlans($customer_plan_invoice,$plans,$invoicepdf);

// dd($mailstatus);
return json_encode(['status'=>'success']);        


}

}