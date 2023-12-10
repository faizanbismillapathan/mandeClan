<?php

namespace App\Http\Controllers\service;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\service;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Toast;
use Image;
use File;
use App\user;
use App\Traits\MailerTraits;

class profileController extends Controller
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

    public function index(Request $request)
    {
        
        
// dd( $this->id);

$record = service::find($this->id);         
        
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
                       ->where('commission_for','Service')
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
$user_id=$this->user_id;
        $users = user::find($user_id);         

         return view('service.profile.index',compact('commissions','countries','categories','subscriptions','record','states','cities','localities','user_id','users'));
    }


    public function show($id)
    {

$record=service::find($id);
// Session::put('service_id',$id);
// Session::put('service_name',$record->service_name);


        return view('service.profile.index',compact('record'));
    }




    public function update(Request $request, $id)
    {
        
        $services = service::find($id); 



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




$users = user::find($services->user_id);         
if ($users->status !='Default') {


   $data = array(
//                 'user_id' =>$users->id,
// 'service_unique_id'=>'Str'.$users->id.date('Y'),
// 'created_by'=>'service',
            'service_cover_photo'=>$service_cover_photo,
            'service_logo'=>$service_logo,
            'service_owner_name'=>$request->input('service_owner_name'),
            'service_owner_email'=>$request->input('service_owner_email'),
            'service_owner_mobile'=>$request->input('service_owner_mobile'),
            'service_name'=>$request->input('service_name'),
            // 'service_mobile'=>'+'.$request->user_country_code.str_replace(' ','',$request->input('service_mobile')),
            // 'service_phone'=>$request->input('service_phone'),
            // 'service_email'=>$request->input('service_email'),
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
            'service_paytm_mobile'=>'+'.$request->user_country_code.str_replace(' ','',$request->input('service_paytm_mobile')),
            'str_bank_account_no'=>$request->input('str_bank_account_no'),
            'str_bank_account_name'=>$request->input('str_bank_account_name'),
            'str_bank_bank_name'=>$request->input('str_bank_bank_name'),
            'str_bank_ifsc_code'=>$request->input('str_bank_ifsc_code'),
            'str_bank_branch'=>$request->input('str_bank_branch'),
            'str_bank_branch_addr'=>$request->input('str_bank_branch_addr'),
            'str_bank_account_type'=>$request->input('str_bank_account_type'),
            'service_commission_id'=>$request->input('service_commission_id'),
            // 'service_email'=>$request->input('service_email'),
            // 'service_password'=>$request->input('service_password'),
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
[
'name' => $request->input('service_name'),
'email' => $request->input('service_email'),
// 'password' => bcrypt($request->input('service_password')),
// 'mobile' => str_replace(' ','',$request->input('service_mobile')),
]
         );


}else{


   $data = array(
//                 'user_id' =>$users->id,
// 'service_unique_id'=>'Str'.$users->id.date('Y'),
// 'created_by'=>'service',
            'service_cover_photo'=>$service_cover_photo,
            'service_logo'=>$service_logo,
            'service_owner_name'=>$request->input('service_owner_name'),
            'service_owner_email'=>$request->input('service_owner_email'),
            // 'service_owner_mobile'=>$request->input('service_owner_mobile'),
            'service_name'=>$request->input('service_name'),
            // 'service_mobile'=>'+'.$request->user_country_code.str_replace(' ','',$request->input('service_mobile')),
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
            'service_paytm_mobile'=>'+'.$request->user_country_code.str_replace(' ','',$request->input('service_paytm_mobile')),
            'str_bank_account_no'=>$request->input('str_bank_account_no'),
            'str_bank_account_name'=>$request->input('str_bank_account_name'),
            'str_bank_bank_name'=>$request->input('str_bank_bank_name'),
            'str_bank_ifsc_code'=>$request->input('str_bank_ifsc_code'),
            'str_bank_branch'=>$request->input('str_bank_branch'),
            'str_bank_branch_addr'=>$request->input('str_bank_branch_addr'),
            'str_bank_account_type'=>$request->input('str_bank_account_type'),
            'service_commission_id'=>$request->input('service_commission_id'),
            // 'service_email'=>$request->input('service_email'),
            // 'service_password'=>$request->input('service_password'),
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
    
}

         $services->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('service/profile')->with($notification);
    }

   public function status_update(Request $request){
 
 // dd($request);
         $record=service::find($this->id);
      
          if($record['status']=='Active'){
               $updatevender=\DB::table('services')->where('id',$this->id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);

                              $updatevender=\DB::table('users')->where('id',$record->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);


           // \Auth::logout();


return Redirect::back();


           } else {
              $updateuser=\DB::table('services')->where('id',$this->id)
                              ->update([
                                'status' => 'Active',
                                 ]);

                         $updatevender=\DB::table('users')->where('id',$record->id)
                              ->update([
                                'status' => 'Active',
                                 ]);


// \Auth::logout();


return Redirect::back();
              // return json_encode("Active");



        }
           }  


              public function status_email_verify(Request $request){


$users=DB::table('users')->where('id',$this->user_id)->first();
$enquiry=[];
$enquiry['name']=$users->name;
$enquiry['email']=$users->email;
$enquiry['user_id']=\Crypt::encrypt($users->id);


$mailstatus = $this->VerifyEmail($enquiry);

          

$notification = array(
    'message' => 'Send email successfully .Please Check email ', 
    'alert-type' => 'success'
);

return Redirect::back()->with($notification);
}


}
