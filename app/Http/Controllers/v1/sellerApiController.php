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
    use App\requested_store;
    use App\product_attribute;
    use App\seller_document;
    use App\store_photo_gallery;
    use App\suport_ticket;
    use App\suborder;
    use App\store_subscription;
    use App\store_purchase_plan;
    use App\store_plan_invoice;
    use App\Traits\MailerTraits;
    use App\shop_category;
    use Image;
    use File;
    use App\suport_ticket_detail;
    use App\service;
    use App\seller_bank_detail;
    use App\order_status_management;
    use App\order_delivery_address;

    class sellerApiController extends Controller
    {




        use MailerTraits;

        public function check_seller_auth($mobile)
        {



           $users=DB::table('users')->where('mobile',$mobile)->where('status','Default')->first();

           if (!empty($users)) {


               return ['status'=>'custome','mobile'=>$mobile];

           }


           $mobile_record = User::where('mobile', $mobile)->first();

           if (!empty($mobile_record)) {




               if ($mobile_record->role==2 || $mobile_record->role==5) {

                  if ($mobile_record->status=='Archive') {

                    return ['status'=>'archive','mobile'=>$mobile];

                }else{
                  $statuses=$this->send_user_otp($mobile_record,'sentotp');

                  return $statuses;
              }



          }else{

            return ['status'=>'not_permit','mobile'=>$mobile];
        }


    }


    return ['status'=>'signup','mobile'=>$mobile];


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


    public function resendOtp($mobile)
    {




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
                    'response'=>'sentotp',
                    'type'=>$msg['type']
                ];
                return ['status'=>'signin'];
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
                    'response'=>'sentotp',
                    'type'=>$msg['type']
                ];
                return ['status'=>'signin'];
            }

        }

    // Session::put('session_users_otp',$six_digit_otp);suborder_id

        return ['status'=>json_decode($response, true)];


    }

// ;;;;;;;;;;;;;

    public function seller_signup(Request $request)
    {


      $mobile = $request->store_owner_mobile;
      $email=$request->store_owner_email;


    if (str_contains($mobile,'+91') == false) {
            $mobile= '+91'.$mobile;

        }else if (str_contains($mobile,'+') == false) {
         $mobile= '+'.$mobile;

     }
    // return json_encode($request->type);

     $store_category=$request->store_category;

     if($request->type=='Service'){

        $role=5;

        $categoryname=DB::table('service_categories')->where('id',$store_category)->first();

        $category_name=$categoryname->category_name;

    }else{

      $role=2;
      $categoryname=DB::table('store_categories')->where('id',$store_category)->first();

      $category_name=$categoryname->category_name;

    }


    $user_data = array(
      'name' => $request->input('store_owner_name'),
      'mobile' =>$mobile,
      'email' => $request->input('store_owner_email'),
      'password' => bcrypt($request->store_password),
      'role' =>$role,
      'status'=>'Deactive'

    );
    $users = new user($user_data);
    $users->save();






    if ($request->type=='Store') {


        $aaa = array(
          ' ' => '-', 
          '/' => '-',
          ','=>'-',
          '---'=>'-',
          '--'=>'-',
          '_'=>'-',

      );

        $store_name=str_replace( array_keys($aaa), 
          array_values($aaa), $request->store_name);
        $subcat=DB::table('store_categories')->where('id',$store_category)->select('category_url')->first();
        $locality=DB::table('localities')->where('id',$request->store_locality)->select('locality_url')->first();

        $store_link=strtolower($store_name.'-'.$subcat->category_url.'-'.$locality->locality_url);


        $city=DB::table('cities')
        ->where('id',$request->store_city)
        ->first();

        $plans=DB::table('store_subscriptions')
        ->where('store_plan_name','Free')
        ->first();



        $data = array(
            'store_unique_id'=>'Str'.$users->id.date('Y'),
            'store_category'=>$store_category,
            'store_owner_name'=>$request->input('store_owner_name'),
            'store_owner_email'=>$request->input('store_owner_email'),
            'store_owner_gendor'=>$request->input('store_owner_gendor'),
            'store_owner_mobile'=>$mobile,
            'store_name'=>$request->store_name,
            'store_website'=>$request->store_website,
            'store_description'=>$request->description,
            'store_locality'=>$request->store_locality,
            'store_pincode'=>$request->store_pincode,                
            'status'=>"Deactive",
            'user_id' =>$users->id,
            'store_city'=>$request->input('store_city'),
            'created_by'=>'Frontend',
            'store_mobile'=>$mobile,
            'store_email'=>$request->input('store_owner_email'),
            'store_plan_id'=>$plans->id,
            'store_link'=>$store_link,
            'store_password'=>$request->store_password,
            'store_country'=>$city->country_id,
            'store_state'=>$city->state_id,
            'store_description'=>$request->description,



        );


        $requested_store = new store($data);
        $requested_store->save();


    }else if($request->type =='Service'){

        $aaa = array(
          ' ' => '-', 
          '/' => '-',
          ','=>'-',
          '---'=>'-',
          '--'=>'-',
          '_'=>'-',

      );


        $store_name=str_replace( array_keys($aaa), 
          array_values($aaa), $request->store_name);

        $subcat=DB::table('service_categories')->where('id',$store_category)->select('category_url')->first();
        $locality=DB::table('localities')->where('id',$request->store_locality)->select('locality_url')->first();


        $store_link=strtolower($store_name.'-'.$subcat->category_url.'-'.$locality->locality_url);


        $city=DB::table('cities')
        ->where('id',$request->store_city)
        ->first();



        $plans=DB::table('service_subscriptions')
        ->where('service_plan_name','Free')
        ->first();



        $data = array(
            'service_unique_id'=>'Serv'.$users->id.date('Y'),
            'service_category'=>$store_category,
            'service_owner_name'=>$request->input('store_owner_name'),
            'service_owner_email'=>$request->input('store_owner_email'),
            'service_owner_gendor'=>$request->input('store_owner_gendor'),
            'service_owner_mobile'=>$mobile,
            'service_mobile'=>$mobile,
            'service_name'=>$request->store_name,
            'service_website'=>$request->store_website,
            'service_description'=>$request->description,
            'service_locality'=>$request->store_locality,
            'service_pincode'=>$request->store_pincode,

            'status'=>"Deactive",
            'user_id' =>$users->id,
            'service_city'=>$request->input('store_city'),
            'created_by'=>'Frontend',
            'service_email'=>$request->input('store_owner_email'),
            'service_email'=>$request->input('store_owner_email'),
            'service_plan_id'=>$plans->id,
            'service_link'=>$store_link,
            'service_password'=>$request->store_password,
            'service_country'=>$city->country_id,
            'service_state'=>$city->state_id,
            'service_description'=>$request->description,

        );


        $service = new service($data);
        $service->save();



    }


    $locality=locality::where('id',$request->store_locality)->first();

    $service=[];

    $service['store_owner_name']=$request->store_owner_name;
    $service['store_owner_email']=$request->store_owner_email;
    $service['store_owner_mobile']=$mobile;
    $service['store_owner_gendor']=$request->store_owner_gendor;
    $service['category_name']=$category_name;
    $service['store_name']=$request->store_name;
    $service['created_at']=Carbon::now()->toDateString();
    $service['store_website']=$request->store_website;
    $service['store_description']=$request->description;
    $service['city_name']=$locality->city->city_name;
    $service['locality_name']=$locality->locality_name;
    $service['store_pincode']=$locality->pincode;

    $admin=admin::first();

    $mailstatus = $this->VendorSignupAdminSendEmail($admin,$service);


    $enquiry=[];
    $enquiry['name']=$users->name;
    $enquiry['email']=$users->email;




    $mailstatus = $this->VendorSignupVerifyEmail($enquiry);

    if (!empty($users)) {

        $user = User::find($users->id);
        Auth::login($user);

         return ['status'=>'success'];

    }else{

     
 return ['status'=>'not_in_same_role'];
    }




    

    }
// store_email
    public function seller_signup_old(Request $request)
    {


      $mobile = $request->store_owner_mobile;
      $otp=(int)$request->otp;
      $email=$request->store_owner_email;



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



        $msg = json_decode($response, true);



        if (str_contains($mobile,'+91') == false) {
            $mobile= '+91'.$mobile;

        }else if (str_contains($mobile,'+') == false) {
         $mobile= '+'.$mobile;

     }
    // return json_encode($request->type);

     $store_category=$request->store_category;

     if($request->type=='Service'){

        $role=5;

        $categoryname=DB::table('service_categories')->where('id',$store_category)->first();

        $category_name=$categoryname->category_name;

    }else{

      $role=2;
      $categoryname=DB::table('store_categories')->where('id',$store_category)->first();

      $category_name=$categoryname->category_name;

    }


    $user_data = array(
      'name' => $request->input('store_owner_name'),
      'mobile' =>$mobile,
      'email' => $request->input('store_owner_email'),
      'password' => bcrypt($request->store_password),
      'role' =>$role,
      'status'=>'Deactive'

    );
    $users = new user($user_data);
    $users->save();






    if ($request->type=='Store') {


        $aaa = array(
          ' ' => '-', 
          '/' => '-',
          ','=>'-',
          '---'=>'-',
          '--'=>'-',
          '_'=>'-',

      );

        $store_name=str_replace( array_keys($aaa), 
          array_values($aaa), $request->store_name);
        $subcat=DB::table('store_categories')->where('id',$store_category)->select('category_url')->first();
        $locality=DB::table('localities')->where('id',$request->store_locality)->select('locality_url')->first();

        $store_link=strtolower($store_name.'-'.$subcat->category_url.'-'.$locality->locality_url);


        $city=DB::table('cities')
        ->where('id',$request->store_city)
        ->first();

        $plans=DB::table('store_subscriptions')
        ->where('store_plan_name','Free')
        ->first();



        $data = array(
            'store_unique_id'=>'Str'.$users->id.date('Y'),
            'store_category'=>$store_category,
            'store_owner_name'=>$request->input('store_owner_name'),
            'store_owner_email'=>$request->input('store_owner_email'),
            'store_owner_gendor'=>$request->input('store_owner_gendor'),
            'store_owner_mobile'=>$mobile,
            'store_name'=>$request->store_name,
            'store_website'=>$request->store_website,
            'store_description'=>$request->description,
            'store_locality'=>$request->store_locality,
            'store_pincode'=>$request->store_pincode,                
            'status'=>"Deactive",
            'user_id' =>$users->id,
            'store_city'=>$request->input('store_city'),
            'created_by'=>'Frontend',
            'store_mobile'=>$mobile,
            'store_email'=>$request->input('store_owner_email'),
            'store_plan_id'=>$plans->id,
            'store_link'=>$store_link,
            'store_password'=>$request->store_password,
            'store_country'=>$city->country_id,
            'store_state'=>$city->state_id,
            'store_description'=>$request->description,



        );


        $requested_store = new store($data);
        $requested_store->save();


    }else if($request->type =='Service'){

        $aaa = array(
          ' ' => '-', 
          '/' => '-',
          ','=>'-',
          '---'=>'-',
          '--'=>'-',
          '_'=>'-',

      );


        $store_name=str_replace( array_keys($aaa), 
          array_values($aaa), $request->store_name);

        $subcat=DB::table('service_categories')->where('id',$store_category)->select('category_url')->first();
        $locality=DB::table('localities')->where('id',$request->store_locality)->select('locality_url')->first();


        $store_link=strtolower($store_name.'-'.$subcat->category_url.'-'.$locality->locality_url);


        $city=DB::table('cities')
        ->where('id',$request->store_city)
        ->first();



        $plans=DB::table('service_subscriptions')
        ->where('service_plan_name','Free')
        ->first();



        $data = array(
            'service_unique_id'=>'Serv'.$users->id.date('Y'),
            'service_category'=>$store_category,
            'service_owner_name'=>$request->input('store_owner_name'),
            'service_owner_email'=>$request->input('store_owner_email'),
            'service_owner_gendor'=>$request->input('store_owner_gendor'),
            'service_owner_mobile'=>$mobile,
            'service_mobile'=>$mobile,
            'service_name'=>$request->store_name,
            'service_website'=>$request->store_website,
            'service_description'=>$request->description,
            'service_locality'=>$request->store_locality,
            'service_pincode'=>$request->store_pincode,

            'status'=>"Deactive",
            'user_id' =>$users->id,
            'service_city'=>$request->input('store_city'),
            'created_by'=>'Frontend',
            'service_email'=>$request->input('store_owner_email'),
            'service_email'=>$request->input('store_owner_email'),
            'service_plan_id'=>$plans->id,
            'service_link'=>$store_link,
            'service_password'=>$request->store_password,
            'service_country'=>$city->country_id,
            'service_state'=>$city->state_id,
            'service_description'=>$request->description,

        );


        $service = new service($data);
        $service->save();



    }


    $locality=locality::where('id',$request->store_locality)->first();

    $service=[];

    $service['store_owner_name']=$request->store_owner_name;
    $service['store_owner_email']=$request->store_owner_email;
    $service['store_owner_mobile']=$mobile;
    $service['store_owner_gendor']=$request->store_owner_gendor;
    $service['category_name']=$category_name;
    $service['store_name']=$request->store_name;
    $service['created_at']=Carbon::now()->toDateString();
    $service['store_website']=$request->store_website;
    $service['store_description']=$request->description;
    $service['city_name']=$locality->city->city_name;
    $service['locality_name']=$locality->locality_name;
    $service['store_pincode']=$locality->pincode;

    $admin=admin::first();

    // dd($mailstatus);
    $mailstatus = $this->VendorSignupAdminSendEmail($admin,$service);


    $enquiry=[];
    $enquiry['name']=$users->name;
    $enquiry['email']=$users->email;




    $mailstatus = $this->VendorSignupVerifyEmail($enquiry);

    if (!empty($users)) {

        $user = User::find($users->id);
        Auth::login($user);

        return "success";

    }else{

      return "not_in_same_role";

    }




    } else {
        $data = [
            'status'=>'false',
            'error'=>'true',
            'response'=>$err
        ];

        return "error";


    }

    }
    public function seller_sigup(Request $request)
    {



        if ($request->type=='Store') {
            $role=2;

        }else if($request->type=='Service'){

            $role=5;
        }


        $user_data = array(
          'name' => $request->input('name'),
          'mobile' =>$request->mobile,
          'email' => $request->input('email'),
          'password' => bcrypt($request->password),
          'role' =>$role,
          'status'=>'Deactive'

      );
        $users = new user($user_data);
        $users->save();






        if ($request->type=='Store') {


            $aaa = array(
              ' ' => '-', 
              '/' => '-',
              ','=>'-',
              '---'=>'-',
              '--'=>'-',
              '_'=>'-',

          );

            $store_name=str_replace( array_keys($aaa), 
              array_values($aaa), $request->store_name);
            $subcat=DB::table('store_categories')->where('id',$request->category)->select('category_url')->first();
            $locality=DB::table('localities')->where('id',$request->locality)->select('locality_url')->first();

            $store_link=strtolower($store_name.'-'.$subcat->category_url.'-'.$locality->locality_url);


            $city=DB::table('cities')
            ->where('id',$request->city)
            ->first();

            $plans=DB::table('store_subscriptions')
            ->where('store_plan_name','Free')
            ->first();



            $data = array(
                'store_unique_id'=>'Str'.$users->id.date('Y'),
                'store_category'=>$request->input('category'),
                'store_owner_name'=>$request->input('name'),
                'store_owner_email'=>$request->input('email'),
                'store_owner_gendor'=>$request->input('gendor'),
                'store_owner_mobile'=>$request->mobile,
                'store_name'=>$request->store_name,
                'store_website'=>$request->website,
                'store_description'=>$request->description,
                'store_locality'=>$request->locality,
                'store_pincode'=>$request->pincode,
                'password'=>$request->password,
                'status'=>"Deactive",
                'user_id' =>$users->id,
                'store_city'=>$request->input('city'),
                'created_by'=>'Frontend',
                'store_mobile'=>$request->mobile,
                'store_email'=>$request->input('email'),
                'store_email'=>$request->input('email'),
                'store_plan_id'=>$plans->id,
                'store_link'=>$store_link,
                'store_password'=>123456,
                'store_country'=>$city->country_id,
                'store_state'=>$city->state_id,
                'store_description'=>$request->description,



            );

            $store = new store($data);
            $store->save();


        }else if($request->type =='Service'){

            $aaa = array(
              ' ' => '-', 
              '/' => '-',
              ','=>'-',
              '---'=>'-',
              '--'=>'-',
              '_'=>'-',

          );


            $store_name=str_replace( array_keys($aaa), 
              array_values($aaa), $request->store_name);

            $subcat=DB::table('service_categories')->where('id',$request->category)->select('category_url')->first();
            $locality=DB::table('localities')->where('id',$request->locality)->select('locality_url')->first();


            $store_link=strtolower($store_name.'-'.$subcat->category_url.'-'.$locality->locality_url);


            $city=DB::table('cities')
            ->where('id',$request->city)
            ->first();



            $plans=DB::table('service_subscriptions')
            ->where('service_plan_name','Free')
            ->first();



            $data = array(
                'service_unique_id'=>'Serv'.$users->id.date('Y'),
                'service_category'=>$request->input('category'),
                'service_owner_name'=>$request->input('name'),
                'service_owner_email'=>$request->input('email'),
                'service_owner_gendor'=>$request->input('gendor'),
                'service_owner_mobile'=>$request->mobile,
                'service_mobile'=>$request->mobile,
                'service_name'=>$request->store_name,
                'service_website'=>$request->website,
                'service_description'=>$request->description,
                'service_locality'=>$request->locality,
                'service_pincode'=>$request->pincode,
                'password'=>$request->password,
                'status'=>"Deactive",
                'user_id' =>$users->id,
                'service_city'=>$request->input('city'),
                'created_by'=>'Frontend',
                'service_email'=>$request->input('email'),
                'service_email'=>$request->input('email'),
                'service_plan_id'=>$plans->id,
                'service_link'=>$store_link,
                'service_password'=>123456,
                'service_country'=>$city->country_id,
                'service_state'=>$city->state_id,
                'service_description'=>$request->description,

            );


            $service = new service($data);
            $service->save();

        }

        return ['status'=>'success'];
    }



    public function seller_sigin_otp_verify(Request $request)
    {

      $mobile = $request->mobile;

      $otp=(int)$request->otp;



      $DefaultUsers=DB::table('users')->where('mobile',$mobile)->where('status','Default')->where('password',$otp)->first();


      if (!empty($DefaultUsers)) {

        $user = User::find($DefaultUsers->id);
        Auth::login($user);


        $tokenobj = \Auth::User()->createToken('name');
        $token = $tokenobj->accessToken;

        if ($user->role==2) {
            $stores=store::where('user_id',$user->id)->first();

            $roles='Store';

        }elseif ($user->role==5) {

            $stores=service::where('user_id',$user->id)->first();

            $roles='Service';

        }
        $path=url('/').'/public/images/store_cover_photo/';

        $data=array();
        $data['user_id']=$user->id;
        $data['id']=$stores->id;
        $data['name']=$stores->store_name;
        $data['email']=$user->email;
        $data['role']=$roles;
     $data['category']=$stores->category->category_name;
            $data['store_cover_photo']=$path.$stores->store_cover_photo;

        return ['status'=>'success','data' => $data,'token'=>$token];


    }else{



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

        $mobile_users=DB::table('users')
        ->where('mobile',$mobile)
        ->first();

        if (!empty($mobile_users)) {

            $user = User::find($mobile_users->id);


            Auth::login($user);

            $tokenobj = \Auth::User()->createToken('name');
            $token = $tokenobj->accessToken;
            
            if ($user->role==2) {
                $stores=store::where('user_id',$user->id)->first();

                $roles='Store';

            }elseif ($user->role==5) {

                $stores=service::where('user_id',$user->id)->first();

                $roles='Service';

            }


        $path=url('/').'/public/images/store_cover_photo/';


            $data=array();
            $data['user_id']=$user->id;
            $data['id']=$stores->id;
            $data['name']=$stores->store_name;
            $data['email']=$user->email;
            $data['role']=$roles;
            $data['category']=$stores->category->category_name;
            $data['store_cover_photo']=$path.$stores->store_cover_photo;

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

    return ['status'=>'error'];
    }
    }



    }


    public function seller_sigup_otp_verify(Request $request)
    {


      $mobile = $request->store_owner_mobile;
      $otp=(int)$request->otp;
      $email=$request->store_owner_email;



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





        $msg = json_decode($response, true);



        if (str_contains($mobile,'+91') == false) {
            $mobile= '+91'.$mobile;

        }else if (str_contains($mobile,'+') == false) {
         $mobile= '+'.$mobile;

     }
    // return json_encode($request->type);

     $store_category=$request->store_category;

     if($request->type=='Service'){

        $role=5;

        $categoryname=DB::table('service_categories')->where('id',$store_category)->first();

        $category_name=$categoryname->category_name;

    }else{

      $role=2;
      $categoryname=DB::table('store_categories')->where('id',$store_category)->first();

      $category_name=$categoryname->category_name;

    }


    $user_data = array(
      'name' => $request->input('store_owner_name'),
      'mobile' =>$mobile,
      'email' => $request->input('store_owner_email'),
      'password' => bcrypt($request->store_password),
      'role' =>$role,
      'status'=>'Deactive'

    );
    $users = new user($user_data);
    $users->save();






    if ($request->type=='Store') {


        $aaa = array(
          ' ' => '-', 
          '/' => '-',
          ','=>'-',
          '---'=>'-',
          '--'=>'-',
          '_'=>'-',

      );

        $store_name=str_replace( array_keys($aaa), 
          array_values($aaa), $request->store_name);
        $subcat=DB::table('store_categories')->where('id',$store_category)->select('category_url')->first();
        $locality=DB::table('localities')->where('id',$request->store_locality)->select('locality_url')->first();

        $store_link=strtolower($store_name.'-'.$subcat->category_url.'-'.$locality->locality_url);


        $city=DB::table('cities')
        ->where('id',$request->store_city)
        ->first();

        $plans=DB::table('store_subscriptions')
        ->where('store_plan_name','Free')
        ->first();



        $data = array(
            'store_unique_id'=>'Str'.$users->id.date('Y'),
            'store_category'=>$store_category,
            'store_owner_name'=>$request->input('store_owner_name'),
            'store_owner_email'=>$request->input('store_owner_email'),
            'store_owner_gendor'=>$request->input('store_owner_gendor'),
            'store_owner_mobile'=>$mobile,
            'store_name'=>$request->store_name,
            'store_website'=>$request->store_website,
            'store_description'=>$request->description,
            'store_locality'=>$request->store_locality,
            'store_pincode'=>$request->store_pincode,                
            'status'=>"Deactive",
            'user_id' =>$users->id,
            'store_city'=>$request->input('store_city'),
            'created_by'=>'Frontend',
            'store_mobile'=>$mobile,
            'store_email'=>$request->input('store_owner_email'),
            'store_plan_id'=>$plans->id,
            'store_link'=>$store_link,
            'store_password'=>$request->store_password,
            'store_country'=>$city->country_id,
            'store_state'=>$city->state_id,
            'store_description'=>$request->description,



        );


        $requested_store = new store($data);
        $requested_store->save();


    }else if($request->type =='Service'){

        $aaa = array(
          ' ' => '-', 
          '/' => '-',
          ','=>'-',
          '---'=>'-',
          '--'=>'-',
          '_'=>'-',

      );


        $store_name=str_replace( array_keys($aaa), 
          array_values($aaa), $request->store_name);

        $subcat=DB::table('service_categories')->where('id',$store_category)->select('category_url')->first();
        $locality=DB::table('localities')->where('id',$request->store_locality)->select('locality_url')->first();


        $store_link=strtolower($store_name.'-'.$subcat->category_url.'-'.$locality->locality_url);


        $city=DB::table('cities')
        ->where('id',$request->store_city)
        ->first();



        $plans=DB::table('service_subscriptions')
        ->where('service_plan_name','Free')
        ->first();




        $data = array(
            'service_unique_id'=>'Serv'.$users->id.date('Y'),
            'service_category'=>$store_category,
            'service_owner_name'=>$request->input('store_owner_name'),
            'service_owner_email'=>$request->input('store_owner_email'),
            'service_owner_gendor'=>$request->input('store_owner_gendor'),
            'service_owner_mobile'=>$mobile,
            'service_mobile'=>$mobile,
            'service_name'=>$request->store_name,
            'service_website'=>$request->store_website,
            'service_description'=>$request->description,
            'service_locality'=>$request->store_locality,
            'service_pincode'=>$request->store_pincode,

            'status'=>"Deactive",
            'user_id' =>$users->id,
            'service_city'=>$request->input('store_city'),
            'created_by'=>'Frontend',
            'service_email'=>$request->input('store_owner_email'),
            'service_email'=>$request->input('store_owner_email'),
            'service_plan_id'=>$plans->id,
            'service_link'=>$store_link,
            'service_password'=>$request->store_password,
            'service_country'=>$city->country_id,
            'service_state'=>$city->state_id,
            'service_description'=>$request->description,

        );


        $service = new service($data);
        $service->save();



    }


    $locality=locality::where('id',$request->store_locality)->first();

    $service=[];

    $service['store_owner_name']=$request->store_owner_name;
    $service['store_owner_email']=$request->store_owner_email;
    $service['store_owner_mobile']=$mobile;
    $service['store_owner_gendor']=$request->store_owner_gendor;
    $service['category_name']=$category_name;
    $service['store_name']=$request->store_name;
    $service['created_at']=Carbon::now()->toDateString();
    $service['store_website']=$request->store_website;
    $service['store_description']=$request->description;
    $service['city_name']=$locality->city->city_name;
    $service['locality_name']=$locality->locality_name;
    $service['store_pincode']=$locality->pincode;

    $admin=admin::first();

    // dd($mailstatus);
    $mailstatus = $this->VendorSignupAdminSendEmail($admin,$service);


    $enquiry=[];
    $enquiry['name']=$users->name;
    $enquiry['email']=$users->email;




    $mailstatus = $this->VendorSignupVerifyEmail($enquiry);

    if (!empty($users)) {

        $user = User::find($users->id);
        Auth::login($user);

                return ['status'=>'success'];


    }else{

      // return "not_in_same_role";

                return ['status'=>'not_in_same_role'];


    }




    //         $user = User::find($users->id);
    //         Auth::login($user);

    //         $tokenobj = \Auth::User()->createToken('name');
    //         $token = $tokenobj->accessToken;


    //         $data=array();
    //         $data['user_id']=$user->id;
    //         $data['name']=$stores->store_name;
    //         $data['email']=$user->email;
    //         $data['id']=$store->id;
    //         return ['status'=>'success','data' => $data,'token'=>$token];
    //     // return "success";
    // // return ['status'=>'success'];


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


    public function seller_dashboard(Request $request)
    {

       $store=store::where('user_id',Auth::user()->id)->select('id')->first();


      $product=product::where('store_id',$store->id)->count();

      $order=suborder::where('store_user_id',Auth::user()->id)->count();
      $Cancelorder=suborder::where('store_user_id',Auth::user()->id)->where('order_status','Cancel')->count();
      $Dispatchorder=suborder::where('store_user_id',Auth::user()->id)->where('order_status','Dispatch')->count();


    // dd($product);
      return compact('product','order','Cancelorder','Dispatchorder');

    }



    public function seller_profile_view_only(Request $request)
    {



    // dd( $request->id);

        $record1 = store::where('user_id',Auth::user()->id)->first();         
        $path=url('/').'/public/images/store_cover_photo/';


        $record=(object)[
            'id'=>$record1->id,
            'store_unique_id'=>$record1->store_unique_id,
            'store_owner_name'=>$record1->store_owner_name,
            'store_owner_email'=>$record1->store_owner_email,
            'store_owner_mobile'=>$record1->store_owner_mobile,
            'category_name'=>$record1->category->category_name,
            'store_name'=>$record1->store_name,
            'store_cover_photo'=>$path.$record1->store_cover_photo,
            'locality_name'=>$record1->locality->locality_name,
            'state_name'=>$record1->state->state_name,
            'store_mobile'=>$record1->store_mobile,
            'store_phone'=>$record1->store_phone,
            'store_email'=>$record1->store_email,
            'store_open_time'=>$record1->store_open_time,
            'store_close_time'=>$record1->store_close_time,
            'store_address'=>$record1->store_address,
            'store_description'=>$record1->store_description,
            'store_owner_gendor'=>$record1->store_owner_gendor,
            'store_longitude'=>$record1->store_longitude,
            'store_latitude'=>$record1->store_latitude,
            'store_gstin_no'=>$record1->store_gstin_no,
            'kyc_status'=>$record1->kyc_status,
            'store_password'=>$record1->store_password,
            'country'=>$record1->country->country_name,
            'state'=>$record1->state->state_name,
            'city'=>$record1->city->city_name,
            'locality'=>$record1->locality->locality_name,
            'store_pincode'=>$record1->store_pincode,
            'store_longitude'=>$record1->store_longitude,
            'store_latitude'=>$record1->store_latitude,
            'store_country'=>$record1->store_country,
            'store_state'=>$record1->store_state,
            'store_city'=>$record1->store_city,
            'store_locality'=>$record1->store_locality,


        ];



        $getOpenDatas=['1 am', '2 am', '3 am', '4 am', '5 am', '6 am', '7 am', '8 am', '9 am', '10 am', '11 am', '12 am'];

        $getCloseDatas=['1 pm', '2 pm', '3 pm', '4 pm', '5 pm', '6 pm', '7 pm', '8 pm', '9 pm', '10 pm', '11 pm', '12 pm' ];



        // $getOpenDatas = array();
        // foreach($getdatas as $user=>$key) {
        //     $getOpenDatas[]=['id'=>(int)$key,'name'=> (string)$user];
        // }
        // $getCloseDatas = array();
        // foreach($getdatas1 as $user=>$key) {
        //     $getCloseDatas[]=['id'=>(int)$key,'name'=> (string)$user];
        // }


        $countries = DB::table('countries')  
        ->select('country_name','id')
        ->where('status','Active')
        ->get(); 


     $states = DB::table('states')
                 ->where('states.country_id','=', $record1->store_country)
                  ->where("states.status",'Active')
                ->select('states.state_name','states.id')->get();

    // dd($states);
                 $cities = DB::table('cities')
                 ->where('cities.state_id','=', $record1->store_state)
                  ->where("cities.status",'Active')
                ->select('cities.city_name','cities.id')->get();


                 $localities = DB::table('localities')
                 ->where('localities.city_id','=', $record1->store_city)
                  ->where("localities.status",'Active')
                ->select('localities.locality_name','localities.id')->get();


        return json_encode(compact('record','getOpenDatas','getCloseDatas','countries','states','cities','localities'));
    }




    public function seller_profile_view(Request $request)
    {



    // dd( $request->id);

        $record = store::where('user_id',Auth::user()->id)->first();         
        
        $countries = DB::table('countries')  
        ->select('country_name','id')
        ->where('status','Active')
        ->orderBy('country_name', 'asc')->pluck('country_name','id'); 

        $categories = DB::table('store_categories')  
        ->select('category_name','id')
        ->where('status','Active')
        ->orderBy('category_name', 'asc')->pluck('category_name','id'); 


        $use = DB::table('commission_settings')  
        ->select('commission_rate','commission_type','id')
        ->where('status','Active')
        ->where('commission_for','Store')
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


     $subscriptions = DB::table('store_subscriptions')  
     ->select('store_plan_name','id')
     ->where('status','Active')
     ->orderBy('store_plan_name', 'asc')->pluck('store_plan_name','id'); 



     $states = DB::table('states')
     ->where('states.country_id','=', $record['store_country'])
     ->where("states.status",'Active')
     ->pluck('states.state_name','states.id');

    // dd($states);
     $cities = DB::table('cities')
     ->where('cities.state_id','=', $record['store_state'])
     ->where("cities.status",'Active')
     ->pluck('cities.city_name','cities.id');


     $localities = DB::table('localities')
     ->where('localities.city_id','=', $record['store_city'])
     ->where("localities.status",'Active')
     ->pluck('localities.locality_name','localities.id');


    // dd($localities);

     return compact('commissions','countries','categories','subscriptions','record','states','cities','localities');
    }



    public function seller_profile_update(Request $request)
    {

      $stores = store::find($request->id); 



      if($request->hasFile('store_cover_photo'))
      {       
         $file = $request->file('store_cover_photo');
         $extension = $request->file('store_cover_photo')->getClientOriginalExtension();
         $store_cover_photo = date('d_m_Y_h_i_s',time()) . '2.' . $extension;

         $destinationPaths = base_path().'/public/images/store_cover_photo/';
         $thumb_img =Image::make($file->getRealPath())->orientate()->resize(400, 250);
         $thumb_img->save($destinationPaths.'/'.$store_cover_photo,80);

     }       
     else{
        $store_cover_photo = $stores->store_cover_photo;
    }




    $data = array(
        'store_cover_photo'=>$store_cover_photo,
       
    );




    $stores->update($data);


    return json_encode(['status'=>'success']);

    }


    public function seller_detail_update(Request $request)
    {

      $stores = store::find($request->id); 



      $plans=DB::table('store_subscriptions')
      ->where('store_plan_name','Free')
      ->first();

      if($request->hasFile('store_cover_photo'))
      {       
         $file = $request->file('store_cover_photo');
         $extension = $request->file('store_cover_photo')->getClientOriginalExtension();
         $store_cover_photo = date('d_m_Y_h_i_s',time()) . '2.' . $extension;

         $destinationPaths = base_path().'/public/images/store_cover_photo/';
         $thumb_img =Image::make($file->getRealPath())->orientate()->resize(400, 250);
         $thumb_img->save($destinationPaths.'/'.$store_cover_photo,80);

     }       
     else{
        $store_cover_photo = $stores->store_cover_photo;
    }


    $aaa = array(
      ' ' => '-', 
      '/' => '-',
      ','=>'-',
      '---'=>'-',
      '--'=>'-',
      '_'=>'-',

    );

    $store_name=str_replace( array_keys($aaa), 
      array_values($aaa), $request->store_name);


    $subcat=DB::table('store_categories')->where('id',$stores->store_category)->select('category_url')->first();
    $locality=DB::table('localities')->where('id',$stores->store_locality)->select('locality_url')->first();


    $store_link=strtolower($store_name.'-'.$subcat->category_url.'-'.$locality->locality_url);





    $data = array(
        'store_cover_photo'=>$store_cover_photo,
        'store_owner_name'=>$request->input('store_owner_name'),
        'store_owner_email'=>$request->input('store_owner_email'),
        'store_owner_mobile'=>$request->input('store_owner_mobile'),

        'store_gstin_no'=>$request->input('store_gstin_no'),
        'store_website'=>$request->input('store_website'),
        'store_facebook_url'=>$request->input('store_facebook_url'),
        'store_instagram_url'=>$request->input('store_instagram_url'),
        'store_you_tube_url'=>$request->input('store_you_tube_url'),
        'store_twitter_url'=>$request->input('store_twitter_url'),
        'store_plan_id'=>$plans->id,
        'str_verified_status'=>$request->input('str_verified_status'),
        'store_description'=>$request->input('store_description'),
        'store_owner_gendor'=>$request->input('store_owner_gendor'),
        'store_link'=>$store_link,
        'store_open_time'=>$request->input('store_open_time'),
        'store_close_time'=>$request->input('store_close_time'),
    );



    DB::table('users')
    ->where('id',$stores->user_id)
    ->update(
        ['name' => $request->input('store_name')]
    );




    $stores->update($data);


    return json_encode(['status'=>'success']);

    }


    public function seller_location_update(Request $request)
    {

      $stores = store::find($request->id); 


      $data = array(
        'store_pincode'=>$request->input('store_pincode'),
        'store_address'=>$request->input('store_address'),
        'store_longitude'=>$request->input('store_longitude'),
        'store_latitude'=>$request->input('store_latitude'),
        'store_country'=>$request->input('store_country'),
        'store_state'=>$request->input('store_state'),
        'store_city'=>$request->input('store_city'),
        'store_locality'=>$request->input('store_locality'),

    );


      $stores->update($data);


      return json_encode(['status'=>'success']);

    }




    // public function seller_detail_update(Request $request)
    // {

    //   $stores = store::find($request->id); 



    // $plans=DB::table('store_subscriptions')
    // ->where('store_plan_name','Free')
    // ->first();

    // if($request->hasFile('store_cover_photo'))
    // {       
    //    $file = $request->file('store_cover_photo');
    //    $extension = $request->file('store_cover_photo')->getClientOriginalExtension();
    //    $store_cover_photo = date('d_m_Y_h_i_s',time()) . '2.' . $extension;

    //    $destinationPaths = base_path().'/public/images/store_cover_photo/';
    //    $thumb_img =Image::make($file->getRealPath())->orientate()->resize(400, 250);
    //    $thumb_img->save($destinationPaths.'/'.$store_cover_photo,80);

    // }       
    // else{
    //     $store_cover_photo = $stores->store_cover_photo;
    // }


    // $data = array(
    // 'store_cover_photo'=>$store_cover_photo,
    // 'store_logo'=>$store_logo,
    // 'store_owner_name'=>$request->input('store_owner_name'),
    // 'store_owner_email'=>$request->input('store_owner_email'),
    // 'store_owner_mobile'=>$request->input('store_owner_mobile'),
    // 'store_name'=>$request->input('store_name'),
    // 'store_mobile'=>$request->input('store_mobile'),
    // 'store_phone'=>$request->input('store_phone'),
    // 'store_email'=>$request->input('store_email'),
    // 'store_gstin_no'=>$request->input('store_gstin_no'),
    // 'store_website'=>$request->input('store_website'),
    // 'store_facebook_url'=>$request->input('store_facebook_url'),
    // 'store_instagram_url'=>$request->input('store_instagram_url'),
    // 'store_you_tube_url'=>$request->input('store_you_tube_url'),
    // 'store_twitter_url'=>$request->input('store_twitter_url'),
    // 'store_pincode'=>$request->input('store_pincode'),
    // 'store_address'=>$request->input('store_address'),
    // 'store_longitude'=>$request->input('store_longitude'),
    // 'store_latitude'=>$request->input('store_latitude'),

    // 'store_category'=>$request->input('store_category'),
    // 'store_country'=>$request->input('store_country'),
    // 'store_state'=>$request->input('store_state'),
    // 'store_city'=>$request->input('store_city'),
    // 'store_plan_id'=>$plans->id,

    // 'str_verified_status'=>$request->input('str_verified_status'),
    // 'store_description'=>$request->input('store_description'),
    // 'store_owner_gendor'=>$request->input('store_owner_gendor'),
    // 'store_locality'=>$request->input('store_locality'),
    // 'store_link'=>$store_link,
    // 'store_open_time'=>$request->input('store_open_time'),
    // 'store_close_time'=>$request->input('store_close_time'),
    // );



    // DB::table('users')
    // ->where('id',$stores->user_id)
    // ->update(
    //     ['name' => $request->input('store_name')]
    // );




    // $stores->update($data);


    // return json_encode(['status'=>'success']);

    // }



    public function seller_categories(Request $request)
    {


        $stores=DB::table('stores')
        ->select('store_category','id','store_name')
        ->where('user_id',Auth::user()->id)
        ->first();


    // dd($request->id);

        
        $use = DB::table('store_categories')  
        ->select('category_name','id')        
        ->whereNotIn('id',[$stores->store_category])
        ->orderBy('category_name', 'asc')->get(); 

        $store_categorys = array();
        foreach($use as $user) {
            $store_categorys[]=['id'=>(int)$user->id,'name'=> (string)$user->category_name];
        }




        $shop_categories=DB::table('stores')
        ->select(\DB::raw("GROUP_CONCAT(product_categories.product_category) as product_category"),\DB::raw("GROUP_CONCAT(product_categories.id) as id"))
        ->leftjoin("product_categories",\DB::raw("FIND_IN_SET(product_categories.id,stores.store_product_category)"),">",\DB::raw("'0'"))
        ->where('stores.user_id',Auth::user()->id)
        ->groupby('product_categories.id')
        ->whereNotNull('product_categories.id')
        ->get();



        $newarr=[];

        foreach($shop_categories as $index=>$data){

            $newarr[]=$data->id;
        }

    // dd($newarr);

        $categories= DB::table('product_categories')
        ->where('product_categories.store_category',$stores->store_category)
        ->select('product_categories.product_category','product_categories.id');

        if (count($newarr)>0) {
           $categories= $categories
           ->whereNotIn('product_categories.id',$newarr);
       }

       $categories= $categories
       ->get();



    // dd($categories);

       return compact('categories','store_categorys','shop_categories','stores');


    }




    public function seller_add_new_category(Request $request)
    {

        $category_id=DB::table('product_categories')
        ->select('store_category','id','product_category')
        ->whereIn('id',$request->category_id)
        ->get();

        
        foreach($category_id as $index=>$data){

         $data = array(
            'store_id'=>$request->store_id,
            'user_id'=>Auth::user()->id,
            'store_category_id'=>$data->store_category,
            'product_category_id'=>$data->id,
            'status'=>'Active',
            'product_category'=>$data->product_category,

        );


         $shop_category = shop_category::updateOrCreate($data);


         DB::table('stores')
         ->where('user_id',Auth::user()->id)
         ->update([
            'store_product_category'=>implode(',',$request->category_id),
        ]);
     }



     return json_encode(['status'=>'success']);

    }

    public function append_product_category(Request $request)
    {

        $product_categoryId= $request->id;

        $subcategories =\DB::table('product_subcategories')                    
        ->where("product_subcategories.product_category",$product_categoryId)
        ->where("product_subcategories.status",'Active');
        if (!empty($request->search)) {
        $subcategories= $subcategories
        ->orWhere('product_subcategories.product_subcategory','like','%' . $request->search . '%');
    }

    $subcategories= $subcategories
        ->select('product_subcategories.product_subcategory','product_subcategories.id')->get();


    return json_encode($subcategories);


        // $brands =\DB::table('brands')                    
        // ->where("brands.brand_category",$product_categoryId)
        // ->where("brands.status",'Active')
        // ->select('brands.brand_name','brands.id')->get();



        // return json_encode(['subcategories'=>$subcategories,'brands'=>$brands]);

    }

    public function seller_append_category(Request $request)
    {

        $stores=DB::table('stores')
        ->select('store_product_category','id','store_category')
        ->where('user_id',Auth::user()->id)
        ->first();

        $arr=explode(',', $stores->store_product_category);

        $categories= DB::table('product_categories')
        ->where('product_categories.store_category',$stores->store_category)
        ->select('product_categories.product_category','product_categories.id')
        ->whereNotIn('id',$arr)
        ->get();

        return json_encode($categories);

    }

    public function master_product_list(Request $request)
    {


       $store=store::where('user_id',Auth::user()->id)->select('id')->first();


       $table_id=DB::table('products')
       ->where('products.store_id',$store->id)
       ->where('master_id','<>',0)
       ->pluck('master_id','master_id')->toarray();


             // dd($table);

       $records=DB::table('product_masters')->orderBy('product_masters.id','desc')
       ->join('store_categories','store_categories.id','product_masters.store_category')
       ->join('stores','stores.store_category','store_categories.id')
       ->leftjoin('brands','brands.id','product_masters.product_brand')

       ->join('product_categories','product_categories.id','product_masters.product_category')
       ->leftjoin('product_subcategories','product_subcategories.id','product_masters.product_subcategory');
       if (!empty($request->search)) {
        $records= $records
        ->orWhere('product_masters.product_name','like','%' . $request->search . '%');
    }

    $records= $records
    ->select('product_masters.*','product_categories.product_category','product_subcategories.product_subcategory','store_categories.category_name','brands.brand_name')
    ->where('stores.id',$request->id)
    ->whereNotIn('product_masters.id',$table_id)
    ->get();


    // dd($records);

    return json_encode($records);

    }



    public function master_product_store(Request $request)
    {



        $master=DB::table('product_masters')
        ->where('id',$request->id)->first();


        $record=DB::table('stores')
        ->where('user_id',Auth::user()->id)->select('id','store_unique_id')->first();

        $data = array(
            'store_id'=>$record->id,
            'user_id'=>Auth::user()->id,
            'store_unique_id'=>$record->store_unique_id,
            'product_unique_id'=>$master->product_unique_id,
            'product_category'=>$master->product_category,
            'product_subcategory'=>$master->product_subcategory,
            'product_name'=>$master->product_name,
            'product_brand'=>$master->product_brand,
            'product_key_features'=>$master->product_key_features,
            'product_description'=>$master->product_description,
            'product_wg_duration'=>$master->product_wg_duration,
            'product_wg_dmy'=>$master->product_wg_dmy,
            'product_wg_type'=>$master->product_wg_type,
            'product_video_url'=>$master->product_video_url,
            'product_tags'=>$master->product_tags,
            'product_free_shipping'=>$master->product_free_shipping,
            'product_status'=>$master->product_status,
            'product_cancel_available'=>$master->product_cancel_available,
            'product_cod'=>$master->product_cod,
            'product_cover_photo'=>$master->product_cover_photo,
            'product_link'=>str_replace(' ','-',strtolower($master->product_name)).'-'.$master->product_unique_id,
            'master_id'=>$master->id,
            'created_by'=>'Master',
        );

    // dd($data);
        $product = new product($data);
        $product->save();


        return json_encode(['status'=>'success']);

    }




    public function seller_product_view(Request $request)
    {


       $store=store::where('user_id',Auth::user()->id)->first();

     $path=url('/').'/public/images/product_cover_photo/';



       $records=DB::table('products')->orderBy('products.id','desc')
       ->join('product_categories','product_categories.id','products.product_category')
       ->leftjoin('product_subcategories','product_subcategories.id','products.product_subcategory')
       ->leftjoin('brands','brands.id','products.product_brand');

       if (!empty($request->search)) {

          $term=$request->search;

          $records=$records
          ->where(function($q) use ($term) {
             $q

             ->orWhere('products.product_name','like','%' . $term . '%')
             ->orWhere('product_categories.product_category','like','%' . $term . '%')
             ->orWhere('product_subcategories.product_subcategory','like','%' . $term . '%')
             ->orWhere('brands.brand_name','like','%' . $term . '%');
         });


      }
      if (!empty($request->status)) {
        $records=$records
        ->Where('products.product_status','like','%' . $request->status . '%');

    }

    $records= $records
    ->select('products.id','products.product_name','product_categories.product_category','product_subcategories.product_subcategory','brands.brand_name','products.master_id','products.product_status',DB::raw("CONCAT('".$path."', products.product_cover_photo) as cover_photo"),'products.product_cover_photo')
    ->where('products.store_id',$store->id)
    ->get();



     // $checks=DB::table('stores')
     //        ->join('store_categories','store_categories.id','stores.store_category')
     //        ->where('stores.id',$this->id)
     //        ->select('stores.id','store_categories.category_name')->first();

    $addon_permission=false;

    if(in_array($store->category->category_name,['Ready Food','Bakery','Restaurants','Convenience'])){
    $addon_permission=true;
    }



    return json_encode(compact('addon_permission','records'));

    }



    public function product_status_update(Request $request){

       $record=product::find($request->id);

       if($record['product_status']=='Active'){
         $updatevender=\DB::table('products')->where('id',$request->id)
         ->update([
            'product_status' => 'Deactive',
        ]);
         return json_encode('Deactive');
     } else {
      $updateuser=\DB::table('products')->where('id',$request->id)
      ->update([
        'product_status' => 'Active',
    ]);
      return json_encode("Active");

    }
    }

    public function seller_product_form(Request $request)
    {


      $record=DB::table('stores')
      ->where('user_id',Auth::user()->id)->select('id','store_category','store_product_category')->first();


      $categories = DB::table('product_categories')  
      ->whereIn('product_categories.id',explode(',',$record->store_product_category))
      ->select('product_categories.product_category as name','product_categories.id')->get(); 


    $wg_type=['Guarantee','Warranty'];

    $wg_dmy=['Day','Month','Year'];


     $brands = DB::table('brands')  
                        ->select('brand_name','id')
                         ->where('status','Active')
                ->whereIn('brand_type', ['Both','Store'])->pluck('brand_name','id'); 


      $wg_duration = [];
      for ($wg_duration_exp=1; $wg_duration_exp <= 12; $wg_duration_exp++) $wg_duration[] = $wg_duration_exp;


      $autoincid = mt_rand(10,100);
      $Y = date('Ys');
      $keydata = 'Prod'.$Y.''.$autoincid;




      return compact('categories','wg_duration','keydata','wg_type','wg_dmy','brands');
    }


    public function seller_product_add(Request $request)
    {


        if($request->hasFile('product_cover_photo'))

        {       
         $file = $request->file('product_cover_photo');
         $extension = $request->file('product_cover_photo')->getClientOriginalExtension();
         $product_cover_photo = date('d_m_Y_h_i_s',time()) . '.' . $extension;

         $destinationPaths = base_path().'/public/images/product_cover_photo';

         $thumb_img =Image::make($file->getRealPath())->orientate()->resize(600, 450);

         $thumb_img->save($destinationPaths.'/'.$product_cover_photo,80);

     }       
     else{
        $product_cover_photo = "";
    }


    $record=DB::table('stores')
    ->where('user_id',Auth::user()->id)->select('id','store_unique_id')->first();

    if ($request->product_free_shipping==true) {   
       $product_free_shipping='Enable';
    }else{
        $product_free_shipping='Disable';
    }

    if ($request->product_status==true) {   
       $product_status='Active';
    }else{
        $product_status='Deactive';
    }


    if ($request->product_cancel_available==true) {   
       $product_cancel_available='Enable';
    }else{
        $product_cancel_available='Disable';
    }


    if ($request->product_cod==true) {   
       $product_cod='Enable';
    }else{
        $product_cod='Disable';
    }

    // dd(Session::get('user_id'));
    $data = array(
        'store_id'=>$record->id,
        'user_id'=>Auth::user()->id,
        'store_unique_id'=>$record->store_unique_id,
        'product_unique_id'=>$request->input('product_unique_id'),
        'product_category'=>$request->input('product_category'),
        'product_subcategory'=>$request->input('product_subcategory'),
        'product_name'=>$request->input('product_name'),
        'product_brand'=>$request->input('product_brand'),
        'product_key_features'=>$request->input('product_key_features'),
        'product_description'=>$request->input('product_description'),
        'product_wg_duration'=>$request->input('product_wg_duration'),
        'product_wg_dmy'=>$request->input('product_wg_dmy'),
        'product_wg_type'=>$request->input('product_wg_type'),
        'product_video_url'=>$request->input('product_video_url'),
    // 'product_selling_date'=>$request->input('product_selling_date'),
    // 'product_modal_number'=>$request->input('product_modal_number'),
    // 'product_hsn_sac_code'=>$request->input('product_hsn_sac_code'),
    // 'product_sku'=>$request->input('product_sku'),
    // 'product_price'=>$request->input('product_price'),
    // 'product_offer_price'=>$request->input('product_offer_price'),
    // 'product_offer_discount'=>$request->input('product_offer_discount'),
    // 'product_gift_charge'=>$request->input('product_gift_charge'),
    // 'product_price_include'=>$product_price_include,
    // 'product_text_class'=>$request->input('product_text_class'),
        'product_tags'=>$request->input('product_tags'),
        'product_free_shipping'=>$product_free_shipping,
    // 'product_featured'=>$request->input('product_featured'),
        'product_status'=>$product_status,
        'product_cancel_available'=>$product_cancel_available,
        'product_cod'=>$product_cod,
    // 'product_img'=>$product_img,
        'product_cover_photo'=>$product_cover_photo,
        'product_link'=>str_replace(' ','-',strtolower($request->product_name)).'-'.$request->product_unique_id,
        'created_by'=>'Custom',
    );

    // dd($data);
    $product = new product($data);
    $product->save();

    return json_encode(['status'=>'success']);

    }


    public function seller_product_edit_form($id)
    {

        $record = product::find($id);        

        $record1=DB::table('stores')
        ->where('user_id',Auth::user()->id)->select('id','store_category','store_product_category')->first();



    $product_categories=DB::table('product_categories')->where('id',$record->product_category)->select('product_category','id')->first();
    $product_subcategories=DB::table('product_subcategories')->where('id',$record->product_subcategory)->select('product_subcategory','id')->first();
    $brands=DB::table('brands')->where('id',$record->product_brand)->select('brand_name','id')->first();

    $category_name='';
    $subcategory_name='';
    $brand_name='';


    if ($product_categories) {
       $category_name=$product_categories->product_category;
    }
    if ($product_subcategories) {
       $subcategory_name=$product_subcategories->product_subcategory;
    }
    if ($brands) {
       $brand_name=$brands->brand_name;
    }
     $path=url('/').'/public/images/product_cover_photo/';

    // $product_status=$record->product_status;
    // $product_free_shipping=$record->product_free_shipping;
    // $product_cancel_available=$record->product_cancel_available;
    // $product_cod=$record->product_cod;


    if ($record->product_status=='Active') {   
       $product_status=true;
    }else{
        $product_status='';
    }


    if ($record->product_free_shipping=='Enable') {   
       $product_free_shipping=true;
    }else{
        $product_free_shipping='';
    }


    if ($record->product_cancel_available=='Enable') {   
       $product_cancel_available=true;
    }else{
        $product_cancel_available='';
    }



    if ($record->product_cod=='Enable') {   
       $product_cod=true;
    }else{
        $product_cod='';
    }




        $products=(object)[
            'id'=>$record->id,
             'product_name'=> $record->product_name,
            'product_category'=> $record->product_category,
            'product_subcategory'=> $record->product_subcategory,
            'product_brand'=> $record->product_brand,
            'product_cover_photo'=> $path.$record->product_cover_photo,
            'product_key_features'=> $record->product_key_features,
            'product_description'=> $record->product_description,
            'product_wg_type'=> $record->product_wg_type,
            'product_wg_dmy'=> $record->product_wg_dmy,
            'product_wg_duration'=> $record->product_wg_duration,
            'product_video_url'=> $record->product_video_url,
            'product_tags'=> $record->product_tags,
            'product_status'=> $product_status,
            'product_free_shipping'=> $product_free_shipping,
            'product_cancel_available'=> $product_cancel_available,
            'product_cod'=> $product_cod,
            'category_name'=> $category_name,
            'subcategory_name'=> $subcategory_name,
            'brand_name'=> $brand_name,

        ];


     $categories = DB::table('product_categories')  
      ->whereIn('product_categories.id',explode(',',$record1->store_product_category))
      ->select('product_categories.product_category as name','product_categories.id')->get(); 


        $subcategories = DB::table('product_subcategories')  
        ->whereIn('product_category',explode(',',$record->product_category))
        ->select('product_subcategories.product_subcategory','product_subcategories.id')->get(); 

        



    $wg_type=['Guarantee','Warranty'];

    $wg_dmy=['Day','Month','Year'];


     $brands = DB::table('brands')  
                        ->select('brand_name','id')
                         ->where('status','Active')
                ->whereIn('brand_type', ['Both','Store'])->pluck('brand_name','id'); 


      $wg_duration = [];
      for ($wg_duration_exp=1; $wg_duration_exp <= 12; $wg_duration_exp++) $wg_duration[] = $wg_duration_exp;




        return compact('products','categories','wg_duration','brands','wg_dmy','wg_type','subcategories');


    }


    public function seller_product_update(Request $request)
    {

       $products = product::find($request->id); 

    //    if($request->hasFile('product_cover_photo'))

    //    {       
    //      $file = $request->file('product_cover_photo');
    //      $extension = $request->file('product_cover_photo')->getClientOriginalExtension();
    //      $product_cover_photo = date('d_m_Y_h_i_s',time()) . '.' . $extension;

    //      $destinationPaths = base_path().'/public/images/product_cover_photo';

    //      $thumb_img =Image::make($file->getRealPath())->orientate()->resize(600, 450);

    //      $thumb_img->save($destinationPaths.'/'.$product_cover_photo,80);

    //  }       
    //  else{
    //     $product_cover_photo = $products->product_cover_photo;
    // }



    // if ($request->product_free_shipping=='on') {   
    //    $product_free_shipping='Enable';
    // }else{
    //     $product_free_shipping='Disable';
    // }

    // if ($request->product_status=='on') {   
    //    $product_status='Active';
    // }else{
    //     $product_status='Deactive';
    // }


    // if ($request->product_cancel_available=='on') {   
    //    $product_cancel_available='Enable';
    // }else{
    //     $product_cancel_available='Disable';
    // }


    // if ($request->product_cod=='on') {   
    //    $product_cod='Enable';
    // }else{
    //     $product_cod='Disable';
    // }

    // // dd(Session::get('user_id'));
    // $data = array(
    //     'product_category'=>$request->input('product_category'),
    //     'product_subcategory'=>$request->input('product_subcategory'),
    //     'product_name'=>$request->input('product_name'),
    //     'product_brand'=>$request->input('product_brand'),
    //     'product_key_features'=>$request->input('product_key_features'),
    //     'product_description'=>$request->input('product_description'),
    //     'product_wg_duration'=>$request->input('product_wg_duration'),
    //     'product_wg_dmy'=>$request->input('product_wg_dmy'),
    //     'product_wg_type'=>$request->input('product_wg_type'),
    //     'product_video_url'=>$request->input('product_video_url'),

    //     'product_tags'=>$request->input('product_tags'),
    //     'product_cancel_available'=>$product_cancel_available,
    //     'product_cod'=>$product_cod,
    //     'product_free_shipping'=>$product_free_shipping,
    //     'product_status'=>$product_status,
    //     'product_cover_photo'=>$product_cover_photo,
    //     'product_link'=>str_replace(' ','-',strtolower($request->product_name)).'-'.$request->product_unique_id,

    // );

    // dd($data);



        if($request->hasFile('product_cover_photo'))

        {       
         $file = $request->file('product_cover_photo');
         $extension = $request->file('product_cover_photo')->getClientOriginalExtension();
         $product_cover_photo = date('d_m_Y_h_i_s',time()) . '.' . $extension;

         $destinationPaths = base_path().'/public/images/product_cover_photo';

         $thumb_img =Image::make($file->getRealPath())->orientate()->resize(600, 450);

         $thumb_img->save($destinationPaths.'/'.$product_cover_photo,80);

     }       
     else{
         $product_cover_photo = $products->product_cover_photo;
    }


    if ($request->product_free_shipping==true) {   
       $product_free_shipping='Enable';
    }else{
        $product_free_shipping='Disable';
    }

    if ($request->product_status==true) {   
       $product_status='Active';
    }else{
        $product_status='Deactive';
    }


    if ($request->product_cancel_available==true) {   
       $product_cancel_available='Enable';
    }else{
        $product_cancel_available='Disable';
    }


    if ($request->product_cod==true) {   
       $product_cod='Enable';
    }else{
        $product_cod='Disable';
    }

    $data = array(
        'product_category'=>$request->input('product_category'),
        'product_subcategory'=>$request->input('product_subcategory'),
        'product_name'=>$request->input('product_name'),
        'product_brand'=>$request->input('product_brand'),
        'product_key_features'=>$request->input('product_key_features'),
        'product_description'=>$request->input('product_description'),
        'product_wg_duration'=>$request->input('product_wg_duration'),
        'product_wg_dmy'=>$request->input('product_wg_dmy'),
        'product_wg_type'=>$request->input('product_wg_type'),
        'product_video_url'=>$request->input('product_video_url'),
        'product_tags'=>$request->input('product_tags'),
        'product_free_shipping'=>$product_free_shipping,
        'product_status'=>$product_status,
        'product_cancel_available'=>$product_cancel_available,
        'product_cod'=>$product_cod,
        'product_cover_photo'=>$product_cover_photo,
        'product_link'=>str_replace(' ','-',strtolower($request->product_name)).'-'.$request->product_unique_id,

    );
    $products->update($data);

    return json_encode(['status'=>'success']);

    }


    public function product_item_add(Request $request)
    {


        $record=Product::find($request->product_id)->first();


        if($request->hasFile('item_img1'))

        {

         $file = $request->file('item_img1');
         $extension = $request->file('item_img1')->getClientOriginalExtension();
         $item_img1 = date('d_m_Y_h_i_s',time()) . '1.' . $extension;

         $destinationPaths = base_path().'/public/images/product_items';

         $thumb_img =Image::make($file->getRealPath())->orientate()->resize(600, 450);

         $thumb_img->save($destinationPaths.'/'.$item_img1,80);

     }       
     else{
        $item_img1 = '';
    }

    if($request->hasFile('item_img2'))

    {       
     $file = $request->file('item_img2');
     $extension = $request->file('item_img2')->getClientOriginalExtension();
     $item_img2 = date('d_m_Y_h_i_s',time()) . '2.' . $extension;

     $destinationPaths = base_path().'/public/images/product_items';

     $thumb_img =Image::make($file->getRealPath())->orientate()->resize(600, 450);

     $thumb_img->save($destinationPaths.'/'.$item_img2,80);

    }       
    else{
        $item_img2 = '';
    }

    if($request->hasFile('item_img3'))

    {       
     $file = $request->file('item_img3');
     $extension = $request->file('item_img3')->getClientOriginalExtension();
     $item_img3 = date('d_m_Y_h_i_s',time()) . '3.' . $extension;

     $destinationPaths = base_path().'/public/images/product_items';

     $thumb_img =Image::make($file->getRealPath())->orientate()->resize(600, 450);

     $thumb_img->save($destinationPaths.'/'.$item_img3,80);

    }       
    else{
        $item_img3 = '';
    }

    if($request->hasFile('item_img4'))

    {       
     $file = $request->file('item_img4');
     $extension = $request->file('item_img4')->getClientOriginalExtension();
     $item_img4 = date('d_m_Y_h_i_s',time()) . '4.' . $extension;

     $destinationPaths = base_path().'/public/images/product_items';

     $thumb_img =Image::make($file->getRealPath())->orientate()->resize(600, 450);

     $thumb_img->save($destinationPaths.'/'.$item_img4,80);

    }       
    else{
        $item_img4 = '';
    }



    $autoincid = mt_rand(10,100);
    $Y = date('YHms');
    $keydata = $Y.'item'.$autoincid;


    $data = array(
        'item_name'=>$request->input('item_name'),
        'item_barcode'=>$request->input('item_barcode'),
        'item_hsn_sac_code'=>$request->input('item_hsn_sac_code'),
        'item_sku'=>$request->input('item_sku'),
        'item_price'=>$request->input('item_price'),
        'item_offer_discount'=>$request->input('item_offer_discount'),
        'item_img1'=>$item_img1,
        'item_img2'=>$item_img2,
        'item_img3'=>$item_img3,
        'item_img4'=>$item_img4,
        'item_quantity'=>$request->input('item_quantity'),
        'item_description'=>$request->input('item_description'),
        'item_shipping_weight'=>$request->input('item_shipping_weight'),
        'item_shipping_weight_unit'=>$request->input('item_shipping_weight_unit'),

        'item_unique_id'=>$keydata,
        'store_id'=>$request->store_id,
        'user_id'=>Auth::user()->id,
        'product_id'=>$request->product_id,
        'item_category'=>$record->product_category,
        'item_subcategory'=>$record->product_subcategory,
        'product_item_status'=>'Single',
        'item_status'=>$request->input('item_status'),

    );

    $product_item=new product_item($data);

    $product_item->save();


    return json_encode(['status'=>'success']);

    }


    public function product_item_form($product_id)
    {




        $record=DB::table('products')
        ->orderBy('products.id','desc')
        ->join('product_categories','product_categories.id','products.product_category')
        ->leftjoin('product_subcategories','product_subcategories.id','products.product_subcategory')
        ->where('products.id',$product_id)
        ->select('products.product_name','product_categories.product_category','product_subcategories.product_subcategory','products.id')
        ->first();


    // dd($record);



        $records=DB::table('product_items')
        ->orderBy('product_items.id','asc')
        ->join('products','products.id','product_items.product_id')
        ->where('products.id',$product_id)
        ->select('product_items.*','products.product_name')
        ->get();




        $attributs=DB::table('product_attributes')
        ->where('product_id',$product_id)
        ->where('status','<>','deleted')
        ->get();

    // dd($attributs);

        $array1=DB::table('product_attributes')
        ->where('product_id',$product_id)
        ->where('status','<>','deleted')
        ->pluck('attribute_name','attribute_name')
        ->toArray();


        $array2=DB::table('units')->pluck('unit_title','unit_title')->toarray();


        $dynamics = array_diff_key($array2, $array1);


     $path=url('/').'/public/images/product_items/';

        $record_edit=product_item::whereNull('product_items.item_attr_varient')
        ->join('products','products.id','product_items.product_id')
        ->join('product_categories','product_categories.id','products.product_category')
        ->leftjoin('product_subcategories','product_subcategories.id','products.product_subcategory')
        ->select('product_items.*','products.product_name','products.product_cover_photo',
            'products.product_name','product_categories.product_category','product_subcategories.product_subcategory',DB::raw("CONCAT('".$path."', product_items.item_img1) as item_img1"))
        ->where('products.id',$product_id)
        ->first();





// $unit=['kg','g','lb','oz'];
// $item_shipping_weight_unit=[];
// foreach($unit as $data){

//     $item_shipping_weight_unit[]=['id'=>$data];

// }
//     // dd($record);

        $Y = date('ys');

$keydata = 'IT'.$Y.'PM'.mt_rand(100,1000);

        return compact('record','records','attributs','dynamics','record_edit','keydata');
    }


    public function product_item_update(Request $request)
    {



        $products = product_item::find($request->id); 


        $item_status=$products->item_status;
        
        if (!empty($request->item_status)) {
           $item_status=$request->input('item_status');

       }



       $record=Product::find($request->product_id)->first();


       if($request->hasFile('item_img1'))

       {       
         $file = $request->file('item_img1');
         $extension = $request->file('item_img1')->getClientOriginalExtension();
         $item_img1 = date('d_m_Y_h_i_s',time()) . '1.' . $extension;

         $destinationPaths = base_path().'/public/images/product_items';

         $thumb_img =Image::make($file->getRealPath())->orientate()->resize(600, 450);

         $thumb_img->save($destinationPaths.'/'.$item_img1,80);

     }       
     else{
        $item_img1 = $products->item_img1;
    }

    if($request->hasFile('item_img2'))

    {       
     $file = $request->file('item_img2');
     $extension = $request->file('item_img2')->getClientOriginalExtension();
     $item_img2 = date('d_m_Y_h_i_s',time()) . '2.' . $extension;

     $destinationPaths = base_path().'/public/images/product_items';

     $thumb_img =Image::make($file->getRealPath())->orientate()->resize(600, 450);

     $thumb_img->save($destinationPaths.'/'.$item_img2,80);

    }       
    else{
        $item_img2 = $products->item_img2;
    }

    if($request->hasFile('item_img3'))

    {       
     $file = $request->file('item_img3');
     $extension = $request->file('item_img3')->getClientOriginalExtension();
     $item_img3 = date('d_m_Y_h_i_s',time()) . '3.' . $extension;

     $destinationPaths = base_path().'/public/images/product_items';

     $thumb_img =Image::make($file->getRealPath())->orientate()->resize(600, 450);

     $thumb_img->save($destinationPaths.'/'.$item_img3,80);

    }       
    else{
        $item_img3 = $products->item_img3;
    }

    if($request->hasFile('item_img4'))

    {       
     $file = $request->file('item_img4');
     $extension = $request->file('item_img4')->getClientOriginalExtension();
     $item_img4 = date('d_m_Y_h_i_s',time()) . '4.' . $extension;

     $destinationPaths = base_path().'/public/images/product_items';

     $thumb_img =Image::make($file->getRealPath())->orientate()->resize(600, 450);

     $thumb_img->save($destinationPaths.'/'.$item_img4,80);

    }       
    else{
        $item_img4 = $products->item_img4;
    }



    $data = array(
        'item_name'=>$request->input('item_name'),
        'item_barcode'=>$request->input('item_barcode'),
        'item_hsn_sac_code'=>$request->input('item_hsn_sac_code'),
        'item_sku'=>$request->input('item_sku'),
        'item_price'=>$request->input('item_price'),
        'item_offer_discount'=>$request->input('item_offer_discount'),
        'item_img1'=>$item_img1,
        'item_img2'=>$item_img2,
        'item_img3'=>$item_img3,
        'item_img4'=>$item_img4,
        'item_quantity'=>$request->input('item_quantity'),
        'item_description'=>$request->input('item_description'),
        'item_shipping_weight'=>$request->input('item_shipping_weight'),
        'item_shipping_weight_unit'=>$request->input('item_shipping_weight_unit'),
        'item_status'=>$item_status,

    );

    // dd($data);

    $products->update($data);

    return json_encode(['status'=>'success']);

    }


    public function product_add_options(Request $request)
    {


        $data1=[
            'store_id'=>$request->id,
            'store_user_id'=>Auth::user()->id,
            'product_id'=>$request->product_id,
            'attribute_name'=>$request->attribute_name,
            'attribute_value'=>implode(',',array_filter($request->attribute_value)),
            'status'=>'new',
            'old_attribute'=>'',
        ];


        $item = product_attribute::insert($data1);
        
        return json_encode(['status'=>'success']);
    }


    public function product_update_options(Request $request)
    {


     $products = product_attribute::find($request->id); 


     $old_attribute=$products->attribute_value;

     if ($products->status=='new') {

      $old_attribute=$products->old_attribute;

    }
    $data1=[
        'attribute_name'=>$request->attribute_name,
        'attribute_value'=>implode(',',array_filter($request->attribute_value)),
        'status'=>'new',
        'old_attribute'=>$old_attribute,

    ];

    $products->update($data1);

    return json_encode(['status'=>'success']);           

    }


    public function product_add_varient(Request $request)
    {




        $alredystore_attr=DB::table('product_items')
        ->where('store_id',$request->store_id)
        ->where('product_id',$request->product_id)
        ->groupby('item_attr_varient')
        ->orderBy('id')
        ->pluck('item_attr_varient','item_attr_varient')
        ->toArray();

    // dd($alredystore_attr);name

        $deleted=DB::table('product_attributes')
        ->where('store_id',$request->store_id)
        ->where('product_id',$request->product_id)
        ->where('status','deleted')
        ->pluck('attribute_value')
        ->toarray();


        $without_del=DB::table('product_attributes')
        ->where('store_id',$request->store_id)
        ->where('product_id',$request->product_id)
        ->where('status','<>','deleted')
        ->pluck('attribute_value')
        ->toarray();


    // dd($without_del);


        if (count($deleted)>0 && count($without_del) > 0) {


            for ($is=0; $is <count($deleted) ; $is++) { 

                $dynamics=[];
                $dynamics[]=explode(',',$deleted[$is]);

                $alredy_attrs=[];

                foreach ($dynamics as $key => $value) {
                    if (is_array($value)) {
                        $alredy_attrs = array_merge($alredy_attrs, array_flatten($value));
                    } else {
                        $alredy_attrs = array_merge($alredy_attrs, array($key => $value));
                    }

                }


    // dd($alredy_attrs);

                $update_value=$alredy_attrs[0];


                $variable_up=DB::table('product_items')
                ->where('store_id',$request->store_id)
                ->where('product_id',$request->product_id)
                ->Where(function ($query) use($update_value) {
                    $query->orwhere('item_attr_varient',$update_value)
                    ->orwhere('item_attr_varient', 'like',  '%' . '/'.$update_value.'/' .'%')
                    ->orwhere('item_attr_varient', 'like',  '%' .$update_value.'/' .'%')
                    ->orwhere('item_attr_varient', 'like',  '%' . '/'. $update_value .'%');

                })

                ->get();


                foreach ($variable_up as $vals) {

                    $value_varient=str_replace([$update_value.'/','/'.$update_value],'',$vals->item_attr_varient);
                    $value_key=str_replace([$update_value.'/','/'.$update_value],'',$vals->item_attr_key);

    // dd($value_key);

        // ...........
                    $valss= explode('/',$value_varient);

                    $attr_color=[];
                    $attribute_val=[];

                    foreach ($valss as $ke1 => $val1) { 

              // dd($val1);

                        $rrr=DB::table('product_attributes')
                        ->whereRaw("find_in_set('".$val1."',attribute_value)")
                        ->select('attribute_name')
                        ->where('product_id',$request->product_id)

                        ->first();  

                        $attr_color[]=$rrr->attribute_name;
                        $attribute_val[]=$val1;

                    }


                    $array_combine=array_combine($attr_color, $attribute_val);

    // ..............

                    product_item::Where('id',$vals->id)
                    ->where('store_id',$request->store_id)
                    ->where('product_id',$request->product_id)
                    ->update([
                        'item_attr_varient'=>$value_varient,
                        'item_attr_key'=>$value_key,
                        'array_combine'=>serialize($array_combine),

                    ]);




                }




                $variable=DB::table('product_items')
                ->where('store_id',$request->store_id)
                ->where('product_id',$request->product_id)
                ->Where(function ($query) use($alredy_attrs) {

                 for ($i = 1; $i < count($alredy_attrs); $i++){

    // dd($alredy_attrs[$i]);

                    $query->orwhere('item_attr_varient',$alredy_attrs[$i])
                    ->orwhere('item_attr_varient', 'like',  '%' . '/'.$alredy_attrs[$i].'/' .'%')
                    ->orwhere('item_attr_varient', 'like',  '%' .$alredy_attrs[$i].'/' .'%')
                    ->orwhere('item_attr_varient', 'like',  '%' . '/'. $alredy_attrs[$i] .'%');

                }      
            })

                ->get();



                foreach ($variable as $key => $value) {
                    product_item::findOrFail($value->id)->delete();

                }

    // dd('dd');

            }

            $deleted=DB::table('product_attributes')
            ->where('store_id',$request->store_id)
            ->where('product_id',$request->product_id)
            ->where('status','deleted')
            ->select('attribute_value','id')
            ->get();


            foreach ($deleted as $key => $value11) {
                product_attribute::findOrFail($value11->id)->delete();

            }
            
        }elseif (count($deleted)>0 &&count($without_del) == 0) {

            $dynamics=explode(',',$deleted[0]);
    // dd($dynamics[0]);

            $aaa=[];

            $variable=DB::table('product_items')
            ->where('store_id',$request->store_id)
            ->where('product_id',$request->product_id)
            ->Where(function ($query) use($dynamics) {


             for ($i = 0; $i < count($dynamics); $i++){
    // dd($i);

    // $aaa[]=$dynamics[$i];

                $query->orwhere('item_attr_varient',$dynamics[$i])
                ->orwhere('item_attr_varient', 'like',  '%' . '/'.$dynamics[$i].'/' .'%')
                ->orwhere('item_attr_varient', 'like',  '%' .$dynamics[$i].'/' .'%')
                ->orwhere('item_attr_varient', 'like',  '%' . '/'. $dynamics[$i] .'%');

            }      
        })

            ->get();


    // dd($variable);

            foreach ($variable as $key => $value) {
                product_item::findOrFail($value->id)->delete();

            }

            $deleted=DB::table('product_attributes')
            ->where('store_id',$request->store_id)
            ->where('product_id',$request->product_id)
            ->where('status','deleted')
            ->select('attribute_value','id')
            ->get();


            foreach ($deleted as $key => $value11) {
                product_attribute::findOrFail($value11->id)->delete();

            }


        }


        $variable=DB::table('product_attributes')
        ->where('store_id',$request->store_id)
        ->where('product_id',$request->product_id)
        ->select('id','attribute_name','attribute_value','old_attribute')
        ->where('status','new')
        ->get();

    // dd($variable);

        $attribut=[];
        
        foreach ($variable as $key => $value) {


    // dd($value->old_attribute);

            if ($value->old_attribute) {


              $arr1=explode(',',$value->attribute_value);
              $arr2=explode(',',$value->old_attribute);

    // dd($arr2);

              if (count($arr1) > count($arr2)) {

                $dynamics = array_diff($arr1, $arr2);
    // dd($arr1);


                $compare=DB::table('product_attributes')
                ->where('attribute_value','<>',$value->attribute_value)
                ->select('attribute_value')
                ->where('product_id',$request->product_id)
                ->get();

    // dd($compare);

                $alredystore_attr=[];


                $nnew=[];

                foreach($compare as $kk){

                    $nnew[]=explode(',',$kk->attribute_value);
                }

                $alredystore_attr=$this->combinations($nnew);


    // dd($alredystore_attr);


            }elseif (count($arr2) > count($arr1)) {

                $dynamics = array_values(array_diff($arr2, $arr1));

    // dd($dynamics);

                $variable=DB::table('product_items')
                ->where('store_id',$request->store_id)
                ->where('product_id',$request->product_id)
                ->Where(function ($query) use($dynamics) {

                 for ($i = 0; $i < count($dynamics); $i++){

                    $query->orwhere('item_attr_varient',$dynamics[$i])
                    ->orwhere('item_attr_varient', 'like',  '%' . '/'.$dynamics[$i].'/' .'%')
                    ->orwhere('item_attr_varient', 'like',  '%' .$dynamics[$i].'/' .'%')
                    ->orwhere('item_attr_varient', 'like',  '%' . '/'. $dynamics[$i] .'%');

                }      
            })

                ->get();

    // dd($variable);

                foreach ($variable as $key => $value) {
                    product_item::findOrFail($value->id)->delete();

                }
                $dynamics=[];

            }elseif (count($arr2) == count($arr1)) {
             $dynamics=[];

         }else{

            $dynamics=explode(',',$value->attribute_value);
        }


    }else{

        $dynamics=explode(',',$value->attribute_value);

    // 
    }

        // dd($dynamics);

    $attribut[$key]=$dynamics;
    }

    // dd($attribut);

    if (count($alredystore_attr) >0 && count($attribut) >0) {

        $attribut[]=$alredystore_attr;
        
    }

    $child_arr=$this->combinations($attribut);

    // dd($child_arr);

    $alredystores=DB::table('product_items')
    ->where('store_id',$request->store_id)
    ->where('product_id',$request->product_id)
    ->orderBy('id')
    ->select('id')
    ->get();




    if (count($alredystore_attr) ==0 ) {


     $autoincid = mt_rand(10,100);
     $Y = date('YHms');
     $keydata = $Y.'item'.$autoincid;
     $record=product::find($request->product_id)->select('id','product_category','product_subcategory')->first();

     foreach($child_arr as $key=>$value){

    // dd($value);

       $valss= explode('/',$value);

       $attr_color=[];
       $attribute_val=[];

       foreach ($valss as $ke1 => $val1) { 

              // dd($val1);

        $rrr=DB::table('product_attributes')
        ->whereRaw("find_in_set('".$val1."',attribute_value)")
        ->select('attribute_name')
        ->where('product_id',$request->product_id)

        ->first();  

        $attr_color[]=$rrr->attribute_name;
        $attribute_val[]=$val1;

    }


    $array_combine=array_combine($attr_color, $attribute_val);

    // dd($array_combine);

    $product_item_id = DB::table('product_items')->insertGetId([
        'item_attr_varient'=>$value,
        'item_attr_key'=>$value,
        'item_unique_id'=>$keydata,
        'store_id'=>$request->store_id,
        'user_id'=>Auth::user()->id,
        'product_id'=>$request->product_id,
        'item_category'=>$record->product_category,
        'item_subcategory'=>$record->product_subcategory,
        'array_combine'=>serialize($array_combine),
        'product_item_status'=>'Varient',

    ]);


    // dd($product_item_id);


    }
    }else{

    // dd($alredystore_attr);

        // dd($child_arr);

        if (count($child_arr)>0) {
          $count= count($child_arr)-count($alredystore_attr);


          for ($i=1; $i < $count+1 ; $i++) { 
           $alredystore_attr[]=$i;

       }
    // dd($alredystore_attr);

       $child_arr=array_combine($alredystore_attr,$child_arr);

    // dd($child_arr);


       $item_attr_material_new=[];
       $item_attr_style_new=[];
       foreach($child_arr as $keys=>$value1){

    // dd($keys);
        $check=product_item::where('item_attr_key',$keys)
        ->where('store_id',$request->store_id)
        ->where('product_id',$request->product_id)
        ->first();


    // ...............................

        $valss= explode('/',$value1);

        $attr_color=[];
        $attribute_val=[];

        foreach ($valss as $ke1 => $val1) { 

              // dd($val1);

            $rrr=DB::table('product_attributes')
            ->whereRaw("find_in_set('".$val1."',attribute_value)")
            ->select('attribute_name')
            ->where('product_id',$request->product_id)
            ->first();  
              // dd($rrr->attribute_name);

            $attr_color[]=$rrr->attribute_name;
            $attribute_val[]=$val1;

        }


        $array_combine=array_combine($attr_color, $attribute_val);

    // dd($array_combine);
        if (!empty($check)) {
            product_item::where('item_attr_key',$keys)
            ->where('store_id',$request->store_id)
            ->where('product_id',$request->product_id)
            ->update([
                'item_attr_varient'=>$value1,
                'item_attr_key'=>$value1,
                'array_combine'=>serialize($array_combine),

            ]);





        }else{
    // $sss11[]=$keys;


          $autoincid = mt_rand(10,100);
          $Y = date('YHms');
          $keydata = $Y.'item'.$autoincid;

          $record=product::find($request->product_id)->select('id','product_category','product_subcategory')->first();


          $product_item_id = DB::table('product_items')->insertGetId([
           'item_attr_varient'=>$value1,
           'item_attr_key'=>$value1,
           'item_unique_id'=>$keydata,
           'store_id'=>$request->id,
           'user_id'=>Auth::user()->id,
           'product_id'=>$request->product_id,
           'item_category'=>$record->product_category,
           'item_subcategory'=>$record->product_subcategory,
    // 'item_attr_color'=>$item_attr_color,
    // 'item_attr_size'=>$item_attr_size,
    // 'item_attr_material'=>$item_attr_material,
    // 'item_attr_style'=>$item_attr_style,
           'product_item_status'=>'Varient',
           'array_combine'=>serialize($array_combine),

       ]);


    //  $item_attr_material_new[]=$item_attr_material;

    // $item_attr_style_new[]=$item_attr_style;
      }


    }
    // dd($item_attr_style_new);

    }

    }


    $alredystores=DB::table('product_attributes')
    ->where('store_id',$request->store_id)
    ->where('product_id',$request->product_id)
    ->where('status','new')
    ->update([
        'status'=>'used',
        'old_attribute'=>'',
    ]);

    return json_encode(['status'=>'success']);
    }




    function combinations($arrays, $i = 0) {

        if (!isset($arrays[$i])) {
            return array();
        }
        if ($i == count($arrays) - 1) {
            return $arrays[$i];
        }

        // get combinations from subsequent arrays
        $tmp = $this->combinations($arrays, $i + 1);
        // dd($tmp);

        $result = array();

        // concat each array from tmp with each element from $arrays[$i]
        foreach ($arrays[$i] as $id=>$v) {
            foreach ($tmp as $k=>$t) {
                $result[] = is_array($t) ? 
                array_merge(array($v), $t) :
                array($v, $t);
            }

        }

        $all=[];
        foreach($result as $data){
            $all[]=implode('/',$data);
        }
    // $all['keys']=$alredystore_attr;

        return $all;
    }





    public function seller_document_view(Request $request)
    {

     $path=url('/').'/public/images/seller_document/';


        $records=DB::table('seller_documents')->orderBy('seller_documents.id','desc');

        if (!empty($request->search)) {
         $records= $records
         ->orWhere('seller_documents.document_name','like','%' . $request->search . '%');
     }

     $records= $records
     ->where('user_id',Auth::user()->id)
     ->select('id','document_name','status',DB::raw("CONCAT('".$path."', seller_documents.document_file) as document_file"))
     ->get();


      // return json_encode($seller_documents);
    return compact('records');

    }


    public function seller_document_form(Request $request)
    {

          $record = seller_document::find($request->id); 

      $records=DB::table('seller_documents')
      ->where('user_id',Auth::user()->id)
      ->pluck('document_name','document_name')->toarray();
    // dd($records);
      $use = DB::table('documents')  
      ->select('document_name','id')
      ->where('status','Active')
      ->where('document_for','Store')
      ->whereNotIn('document_name', $records)->select('document_name','id')->get(); 

      $documents = array();
      foreach($use as $user) {
        $documents[]=['id'=>(int)$user->id,'name'=> (string)$user->document_name];

    }


    return json_encode(compact('documents','record'));

    }



    public function seller_document_add(Request $request)
    {

     if($request->hasFile('document_file'))
     {       
         $file = $request->file('document_file');
         $extension = $request->file('document_file')->getClientOriginalExtension();
         $document_file = date('d_m_Y_h_i_s',time()) . '1.' . $extension;
         $destinationPath = base_path().'/public/images/seller_document';
                 // dd($destinationPath);
         $file->move($destinationPath,$document_file);
     }        
     else{
        $document_file = "";
    }

      $record=DB::table('stores')
        ->where('user_id',Auth::user()->id)->select('id','store_unique_id')->first();



    $data = array(
        'document_name'=>$request->input('document_name'),
        'document_file'=>$document_file,
        'user_id'=>Auth::user()->id,
        'store_id'=>$record->id,

    );
    $seller_document = new seller_document($data);
    $seller_document->save();

    return json_encode(['status'=>'success']);

    }



    public function seller_document_update(Request $request)
    {

      $seller_documents = seller_document::find($request->id); 

      if($request->hasFile('document_file'))

      {       
         $file = $request->file('document_file');
         $extension = $request->file('document_file')->getClientOriginalExtension();
         $document_file = date('d_m_Y_h_i_s',time()) . '1.' . $extension;

         $destinationPaths = base_path().'/public/images/seller_document';

         $thumb_img =Image::make($file->getRealPath())->orientate()->resize(100, 100);

         $thumb_img->save($destinationPaths.'/'.$document_file,80);

     }       
     else{
        $document_file = $seller_documents->document_file;
    }

    $data = array(
        'document_name'=>$request->input('document_name'),
        'document_file'=>$document_file,

    );
    $seller_documents->update($data);

    return json_encode(['status'=>'success']);
    }



    public function seller_orders_list(Request $request)
    {


     $records=DB::table('suborders')
     ->join('customers','customers.id','suborders.customer_id')
     ->leftjoin('order_delivery_addresses','order_delivery_addresses.order_id','suborders.order_id')
     ->orderBy('suborders.id','desc');

     if (!empty($request->search)) {
        $records= $records
        ->orWhere('order_delivery_addresses.customer_address','like','%' . $request->search . '%')
        ->orWhere('customers.customer_name','like','%' . $request->search . '%')
        ->orWhere('customers.customer_email','like','%' . $request->search . '%')
        ->orWhere('customers.customer_mobile','like','%' . $request->search . '%')
        ->orWhere('customers.customer_userid','like','%' . $request->search . '%')
        ->orWhere('suborders.order_date','like','%' . $request->search . '%')
        ->orWhere('suborders.delivery_date','like','%' . $request->search . '%')
        ->orWhere('suborders.suborder_u_id','like','%' . $request->search . '%')
        ->orWhere('suborders.customer_u_id','like','%' . $request->search . '%')
        ->orWhere('suborders.payment_method','like','%' . $request->search . '%')
        ->orWhere('suborders.order_status','like','%' . $request->search . '%')
        ->orWhere('suborders.id','like','%' . $request->search . '%')
        ->orWhere('suborders.grand_total','like','%' . $request->search . '%');
    }

    if (!empty($request->status)) {
        $records= $records
        ->orWhere('suborders.order_status','like','%' . $request->status . '%');

    }

    $records= $records
     

      

    ->select('order_delivery_addresses.customer_address','customers.customer_name','customers.customer_email','customers.customer_mobile','customers.customer_userid',DB::raw("(DATE_FORMAT(suborders.order_date,'%d-%M-%y %h:%i A')) as order_date"),'suborders.delivery_date','suborders.delivery_time','suborders.suborder_u_id','suborders.customer_u_id',
        'suborders.subtotal','suborders.payment_method','suborders.order_status','suborders.id','suborders.grand_total','suborders.total_item','suborders.pickup_type','suborders.paid_unpaid_status')
    ->where('suborders.store_user_id',Auth::user()->id)
    ->get();


    $status=['Pending'=>'Pending','Cancelled'=>'Cancelled','Approved'=>'Approved','Ready To Pickup'=>'Ready To Pickup','Dispatch'=>'Dispatch','Delivered'=>'Delivered'];


    return compact('records','status');




    }


    public function seller_orders_detail($suborder_id)
    {


             
    // $order_items=DB::table('order_items')
    // ->where('order_items.suborder_id',$suborder_id)
    // ->get(); 

            
    $orderitems=DB::table('order_items')
    ->where('order_items.suborder_id',$suborder_id)
    ->get(); 


    // dd($orderitems);
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




    $order=DB::table('suborders')->where('id',$suborder_id) ->first();

    $address_book=order_delivery_address::where('order_id',$order->order_id)->first();

$addressBook=[];


if (!empty($address_book)) {
 
 $locality_name='';

 if ($address_book->localitys) {
     $locality_name=$address_book->localitys->locality_name;
 }

  $city_name='';
 
 if ($address_book->citys) {
     $city_name=$address_book->citys->city_name;
 }

   $state_name='';

 if ($address_book->states) {
     $state_name=$address_book->states->state_name;
 }

   $country_name='';

 if ($address_book->countrys) {
     $country_name=$address_book->countrys->country_name;
 }


    $addressBook=[
    'customer_name'=>$address_book->customer_name,
    'locality_name'=>$locality_name,
    'city_name'=>$city_name,
    'state_name'=>$state_name,
    'country_name'=>$country_name,
    'customer_address'=>$address_book->customer_address,
    'customer_mobile'=>$address_book->customer_mobile,
    'customer_email'=>$address_book->customer_email,


    ];
   // code...
}
    $order_status=DB::table('order_status_managements')->where('suborder_id',$suborder_id)->get();




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








 


    $users=DB::table('customers')
    ->where('user_id',$order->customer_user_id)
    ->select('id','user_id','customer_userid','customer_name as name','customer_email as email','customer_mobile as mobile')
    ->first();



             return compact('order_items','order','addressBook','pending_status_date','approval_status_date','delivered_status_date','ready_to_pickup_status_date','dispatch_status_date','pending','approval','delivered','ready_to_pickup','dispatch','users');


    }



    public function order_status_update(Request $request){


 
      
    
               $updatevender=\DB::table('suborders')->where('id',$request->id)
                
                              ->update([
                                'order_status' => $request->value,
                                 ]);

$record=\DB::table('suborders')->where('id',$request->id) ->first();

              $suborder_data = array(
'order_id'=>$record->order_id,
'suborder_id'=>$record->id,
'status'=>$request->value,
'status_date'=>Carbon::now()->toDateTimeString(),
'status_resone'=>'',
);


 $order_status_management = new order_status_management($suborder_data);
         $order_status_management->save();

            return json_encode($request->value);

}

    public function seller_photo_gallery(Request $request)
    {
     $path=url('/').'/public/images/store_photo_gallery/';

     $records=DB::table('store_photo_galleries')->orderBy('store_photo_galleries.id','desc');

     if (!empty($request->search)) {
         $records= $records
         ->orWhere('store_photo_galleries.gallery_img','like','%' . $request->search . '%');
     }
     $records= $records
     ->where('store_photo_galleries.store_user_id',Auth::user()->id)
     ->whereNotNull('gallery_img')
     ->select('id',DB::raw("CONCAT('".$path."', store_photo_galleries.gallery_img) as gallery_img"))
     ->get();


     return json_encode($records);

    }



    public function seller_photo_gallery_add(Request $request)
    {


        if($request->hasFile('gallery_img'))
        {       
         $file = $request->file('gallery_img');
         $extension = $request->file('gallery_img')->getClientOriginalExtension();
         $gallery_img = date('d_m_Y_h_i_s',time()) . '1.' . $extension;
         $destinationPaths = base_path().'/public/images/store_photo_gallery';

         $thumb_img =Image::make($file->getRealPath())->orientate()->resize(350, 350);

         $thumb_img->save($destinationPaths.'/'.$gallery_img,80);
     }        
     else{
        $gallery_img = "";
    }



    $data = array(
        'store_id'=>$request->id,
        'store_user_id'=>Auth::user()->id,
        'gallery_img'=>$gallery_img,

    );
    $store_photo_gallery = new store_photo_gallery($data);
    $store_photo_gallery->save();


    return json_encode(['status'=>'success']);

    }



    public function seller_photo_gallery_update(Request $request)
    {



        $store_photo_galleries = store_photo_gallery::find($request->id); 

        if($request->hasFile('gallery_img'))

        {       
         $file = $request->file('gallery_img');
         $extension = $request->file('gallery_img')->getClientOriginalExtension();
         $gallery_img = date('d_m_Y_h_i_s',time()) . '1.' . $extension;

         $destinationPaths = base_path().'/public/images/store_photo_gallery';

         $thumb_img =Image::make($file->getRealPath())->orientate()->resize(350, 350);

         $thumb_img->save($destinationPaths.'/'.$gallery_img,80);

     }       
     else{
        $gallery_img = $store_photo_galleries->gallery_img;
    }

    $data = array(
        'gallery_img'=>$gallery_img,

    );
    $store_photo_galleries->update($data);

    return json_encode(['status'=>'success']);

    }




    public function seller_support_ticket_view(Request $request)
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
     ->where('ticket_role','like','%' .'Seller' . '%')
     ->orderBy('ticket_name', 'asc')->select('ticket_name','id')->get(); 

    // dd($tickets);

     $tickets = array();
     foreach($use as $user) {
        $tickets[]=['id'=>(int)$user->id,'name'=> (string)$user->ticket_name];

    }


    return json_encode($tickets);

    }



    public function seller_support_ticket_add(Request $request)
    {

        $data = array(
            'ticket_name'=>$request->input('ticket_name'),
            'vendor_name'=>Auth::user()->name,
            'vendor_email'=>Auth::user()->email,
            'subject'=>$request->input('subject'),
            'message'=>$request->input('message'),
            'user_id'=>Auth::user()->id,
            'message_by'=>'Seller',
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
        'message_by'=>'Seller',
        'attachment'=>$attachment,
        
    );
    $suport_ticket_detail = new suport_ticket_detail($data);
    $suport_ticket_detail->save();




    return json_encode(['status'=>'success']);

    }



    public function seller_support_ticket_msg_show($ticket_id)
    {

        $path=url('/').'/public/images/tickets/';



     $records=DB::table('suport_ticket_details')
     ->whereIn('suport_ticket_details.message_by',['Seller','Admin'])
         ->where('suport_ticket_details.ticket_id',$ticket_id)
    ->select('id','name','message',DB::raw("CONCAT('".$path."', attachment) as attachment"), DB::raw("(DATE_FORMAT(suport_ticket_details.updated_at,'%d-%M-%y %h:%i A')) as updated_at")
    )
     ->get();


     // {{date("d-M-y", strtotime($data->created_at))}} {{date("g:i A", strtotime($data->created_at))}}




     $record=DB::table('suport_tickets')
     ->where('suport_tickets.user_id',Auth::user()->id)
     ->where('suport_tickets.id',$ticket_id)
     ->first();



     return compact('records','record');

    }



    public function seller_support_ticket_send_msg(Request $request)
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
        'message_by'=>'Seller',
        'attachment'=>$attachment,

    );

     // dd($data);
    $suport_ticket_detail = new suport_ticket_detail($data);
    $suport_ticket_detail->save();




    return json_encode(['status'=>'success']);


    }


    public function seller_subs_plan_view(Request $request)
    {


        $store_plans=DB::table('store_subscriptions')
        ->orderByRaw("FIELD(store_plan_name,'PLATINUM' , 'GOLD', 'SILVER', 'Free') ASC")
        ->where('store_plan_name','<>','Free')
        ->get();

        $inform=DB::table('store_purchase_plans')
        ->where('store_purchase_plans.user_id',Auth::user()->id)
        ->select('store_purchase_plans.created_at','store_purchase_plans.store_plan_name','store_purchase_plans.plan_expiry_date','store_purchase_plans.plan_status','store_purchase_plans.id')
        ->where('plan_status','<>','Expired')
        ->first();


        return compact('inform','store_plans');


    }



    public function seller_purchase_plan(Request $request)
    {




      $record = store_subscription::find($request->subscription_plan_id); 

      $store_info=store::where('user_id',Auth::user()->id)->first();
      $currentDate=Carbon::now()->toDateTimeString();

      $expiryDate=Carbon::now()->addDays($record->store_plan_validity)->toDateTimeString();


      $plan_data = array(

        'user_id'=>Auth::user()->id,
        'store_plan_name'=>$record->store_plan_name,
        'store_plan_price'=>$record->store_plan_price,
        'store_plan_id'=>$record->store_plan_id,
        'store_plan_discount'=>$record->store_plan_discount,
        'store_plan_validity'=>$record->store_plan_validity,
        'store_product_limit'=>$record->store_product_limit,
        'store_plan_features'=>$record->store_plan_features,
        'status'=>$record->status,
        'plan_used'=>'0',
        'plan_expiry_date'=>$expiryDate,
    // 'plan_transaction_id'=>'SPSP'.$store_info->store_name.date('Y'),
        'plan_transaction_id'=>$request->token,
        'paid_amount'=>$request->totalAmount,
        'plan_status'=>'Active',


    );
      $plans = new store_purchase_plan($plan_data);
      $plans->save();






      $assordersss = DB::table('stores')
      ->where('stores.user_id',Auth::user()->id)
      ->update([
        'store_plan_id' => $request->subscription_plan_id]);





      $admin_info=DB::table('admins')
      ->first();



      

      $admin_sgst=0;

      $discount=  ($plans->store_plan_discount / 100) * $plans->store_plan_price;
      $discount_amount= $discount;

      $subtotal=$plans->store_plan_price-$discount;

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
        'store_invoice_id'=> 'StrPI'.$plans->id.date('Y'),
        'store_email'=>$store_info->store_email,
        'store_mobile'=>$store_info->store_mobile,
        'store_owner_name'=>$store_info->store_owner_name,
        'store_name'=>$store_info->store_name,
        'admin_name'=>$admin_info->admin_name,
        'admin_email'=>$admin_info->admin_email,
        'admin_mobile'=>$admin_info->admin_mobile,
        'admin_address'=>$admin_info->admin_address,
        'transaction_date'=>Carbon::now(),
        'store_total_amount'=>number_format((float)$total, 2, '.', ''),
        'store_discount_amount'=>$discount_amount,
        'store_gst_amount'=>$gst_amount,
        'store_payment_gateway'=>$request->payment_method,
        'admin_gst'=>$admin_sgst,
        'store_plan_id'=>$plans->id,
        'generated_by'=>'store',
        'store_subtotal'=>$subtotal,
        'store_country'=>$store_info->country->country_name,
        'store_state'=>$store_info->state->state_name,
        'store_city'=>$store_info->city->city_name,
        'store_locality'=>$store_info->locality->locality_name,
        'store_category'=>$store_info->category->category_name,
        'store_address'=>$store_info->store_address,
        'store_pincode'=>$store_info->store_pincode,                
        

    );


    $store_plan_invoice = new store_plan_invoice($data);
    $store_plan_invoice->save();




    $invoicepdf = \PDF::loadView('emails.store_plan_invoice',compact('store_plan_invoice','plans','admin_info'));


    $mailstatus = $this->StorePurchasePlans($store_plan_invoice,$plans,$invoicepdf);


    return json_encode(['status'=>'success']);        


    }


    public function seller_subs_plan_history(Request $request)
    {



     $records=DB::table('store_purchase_plans')
     ->join('store_plan_invoices','store_plan_invoices.store_plan_id','store_purchase_plans.id')
     ->where('store_purchase_plans.user_id',Auth::user()->id)
     ->select('store_purchase_plans.created_at','store_purchase_plans.store_plan_name','store_purchase_plans.plan_expiry_date','store_purchase_plans.plan_status','store_purchase_plans.id','store_plan_invoices.store_invoice_id','store_plan_invoices.store_total_amount','store_plan_invoices.status as invoic_status','store_purchase_plans.store_product_limit')
     ->get();


     return json_encode($records);


    }





    public function seller_plan_invoice_download(Request $request)
    {   
       $admin_info=DB::table('admins')
       ->first();


       $plans=store_purchase_plan::where('user_id',Auth::user()->id)
       ->where('store_purchase_plans.id',$request->id)
       ->first();


       $store_plan_invoice=store_plan_invoice::where('user_id',Auth::user()->id)
       ->where('store_plan_invoices.store_plan_id',$request->id)
       ->first();


       $invoicepdf = \PDF::loadView('emails.store_plan_invoice',compact('store_plan_invoice','plans','admin_info'));

       return $invoicepdf->download('Marchant'.$plans->id.'.pdf');

    }




    public function seller_bank_detail_view(Request $request)
    {

        $bank_detail = seller_bank_detail::where('user_id',Auth::user()->id)->first();

    return json_encode($bank_detail);
    }


    public function seller_add_bank_detail(Request $request)
    {

        $bank_detail = seller_bank_detail::where('user_id',Auth::user()->id)->first();

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
            $seller_bank_detail = new seller_bank_detail($data);
            $seller_bank_detail->save();


        }else{


        $bank_detail = seller_bank_detail::find($bank_detail->id);

            $data = array(
                'bankname'=>$request->input('bankname'),
                'branchname'=>$request->input('branchname'),
                'ifsc'=>$request->input('ifsc'),
                'account'=>$request->input('account'),
                'acountname'=>$request->input('acountname'),

                'status'=>$request->status

            );


            $bank_detail->update($data);


        }
        return json_encode(['status'=>'success']);
    }



    public function kyc_status(Request $request)
    {

          $result=DB::table('stores')
           ->select('store_name','id','store_category','kyc_status','status')
           ->where('user_id',Auth::user()->id)
           ->first();



    return json_encode($result);


    }



public function seller_sign_up_form(Request $request){

  $categories = DB::table('store_categories')  
  ->select('category_name','id')
  ->where('status','Active')
  ->orderBy('category_name', 'asc')->select('category_name','id')->get(); 

$cities =\DB::table('cities') 
->where('status','Active')                
->select('cities.city_name','cities.id')->get();


$localities =\DB::table('localities') 
->where('status','Active')        
->where('city_id',Session::get('store_city'))       
->select('localities.locality_name','localities.id')->get();


$servic_categories=DB::table('service_categories')
->orderby('sort','asc')
->where('status','Active')
->select('category_name','id')->get();



  return compact('categories','cities','servic_categories','localities');


}

public function seller_change_password_view(Request $request)
    {


 $record=DB::table('stores')
     ->where('user_id',Auth::user()->id)
     ->select('store_email','store_password')
     ->first();


return json_encode($record);



    }


      public function seller_change_password(Request $request)
    {
        


  $record=DB::table('stores')
  ->where('user_id',Auth::user()->id)
  ->select('store_password')
  ->first();


$allow_to_change=DB::table('stores')
->where('user_id',Auth::user()->id)
->update(['store_password'=>$request->new_password]);


$assorder = DB::table('users')
->where('id', Auth::user()->id)
->update([
'password' => bcrypt($request->input('new_password'))]);

return ['status'=>'success'];

    }




      public function verify_seller_email(Request $request)
    {

  $otp=$request->otp;
  $email=$request->email;

if ($email) {
    
if ($otp==Session::get('email_otp')) {

$users=DB::table('users')->where('id',Auth::user()->id)
->update([
'email'=>$email,
'email_verified_at'=>Carbon::now()->toDateTimeString(),
]);


$users=DB::table('stores')->where('id',Auth::user()->id)
->update([
'store_email'=>$email,

]);

     // \Auth::logout();

            return ['status'=>'success'];

}else{

// return 'error';
                return ['status'=>'error'];

    }



}else{

    if ($otp==Session::get('email_otp')) {

            return ['status'=>'success'];
}else{

// return 'error';
                return ['status'=>'error'];

    }

}


}



       public function seller_update_email(Request $request)
    {

$users=DB::table('users')->where('id',Auth::user()->id)
->update([
'email'=>$request->store_new_email,
]);


$users=DB::table('stores')->where('id',Auth::user()->id)
->update([
'store_email'=>$request->store_new_email,
]);


            return ['status'=>'success'];


    }



   public function seller_send_email(Request $request)
    {
        


$users=DB::table('users')->where('id',Auth::user()->id)->first();

$otp = mt_rand(100000,999999);
// dd($enquiry);
$enquiry=[];
$enquiry['name']=$users->name;
$enquiry['email']=$request->email;
$enquiry['otp']=$otp;


Session::put('email_otp',$otp);


$email=$this->sendOtpOnEmail($enquiry);

return json_encode($email);



    }


   public function seller_change_email_view()
    {


$record=DB::table('users')->where('id',Auth::user()->id)->first();


return json_encode($record);


    }



     public function seller_change_mobile_view(Request $request)
    {

$record=DB::table('users')->where('id',Auth::user()->id)->first();

return view('seller.change_contactno.index',compact('record'));

    }

      public function seller_send_mobile(Request $request)
    {



$users=DB::table('users')->where('id',Auth::user()->id)->first();

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


return json_encode($mobile);



    }

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

$users=DB::table('users')->where('id',Auth::user()->id)
->update([
'mobile'=>$new_mobile,
]);


$users=DB::table('stores')->where('user_id',Auth::user()->id)
->update([
'store_mobile'=>$new_mobile,
]);


                 return ['status'=>'success'];


}


            return ['status'=>'success'];


}


            return ['status'=>'error'];



    }



 public function seller_acount_deactivate(Request $request){
 

         $record=store::where('user_id',Auth::user()->id)->first();
      
          if($record->status=='Active'){
               $updatevender=\DB::table('stores')->where('user_id',Auth::user()->id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);

                              $updatevender=\DB::table('users')->where('id',$record->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);



            return ['status'=>'success'];


           } else {
              $updateuser=\DB::table('stores')->where('user_id',Auth::user()->id)
                              ->update([
                                'status' => 'Active',
                                 ]);

                         $updatevender=\DB::table('users')->where('id',$record->id)
                              ->update([
                                'status' => 'Active',
                                 ]);




            return ['status'=>'success'];

        }
           }

  
  public function delete_account_otp_verify(Request $request)
    {
        


  $otp=$request->otp;

$users=DB::table('users')->where('id',Auth::user()->id)->first();
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

if ($new_response['message']=='OTP verified success' || $new_response['message']=='Mobile no. already verified' || $new_response['message']=='Mobile no. not found' || $new_response['message'] =='OTP expired') {

 // $record=store::find($request->id);
    
                   $record=store::where('user_id',Auth::user()->id)->first();

      
               $updatevender=\DB::table('stores')->where('user_id',Auth::user()->id)
                              ->update([
                                'status' => 'Archive',
                                'status_date'=>Carbon::now()->toDateString(),
                                'status_created_by'=>'Self',
                                 ]);

$updatevender=\DB::table('users')->where('id',Auth::user()->id)
->update([
'status' => 'Archive',
]);


user_account_delete::Insert([
'user_id' => Auth::user()->id,
'status_reason' => Session::get('status_reason'),
'status_comment' => Session::get('status_comment'),
'status' => 'Archive',

]);

            return ['status'=>'success'];

}

            return ['status'=>'error'];


}


    public function send_delete_account_otp(Request $request)
    {       



  $otp=$request->otp;


$users=DB::table('users')->where('id',Auth::user()->id)->first();
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

    }
     



     public function store_payout(Request $request)
    {
               $record=store::where('user_id',Auth::user()->id)->first();

$from = $request->from_date;
$to = $request->to_date;

$suborders=suborder::where('suborders.store_user_id',Auth::user()->id)
->whereBetween(DB::raw('DATE(order_date)'), [$from, $to])
->get();

$records=[];

foreach($suborders as $index=>$data){

$records[]=(object)[
'store_id'=>$data->store_id,
'id'=>$data->id,
'created_at'=>$data->created_at,
'suborder_u_id'=>$data->suborder_u_id,
'total_item'=>$data->total_item,
'total_item_weight'=>$this->total_item_weights($data->id),
'total_item_price'=>$this->total_item_prices($data->id),
'delevery_status'=>$data->order_status,
'Status'=>$data->paid_unpaid_status,
];

}


        return compact('record','records');
    }

 


   public function total_item_weights($suborder_id)
    {
                 $view=DB::table('order_items')->where('suborder_id',$suborder_id)->sum('item_shipping_weight');

        return $view;
    }




   public function total_item_prices($suborder_id)
    {
                               $view=DB::table('order_items')->where('suborder_id',$suborder_id)->sum('item_selling_price');


        return $view;
    }



    

     public function store_item_wise_payout($id=null,Request $request)
    {
    

               $record=store::where('user_id',Auth::user()->id)->first();


$from = $request->from_date;
$to = $request->to_date;



if (!empty($id)) {
    $order_items=order_item::where('order_items.suborder_id',$id)
    ->whereBetween('created_at', [$from, $to])

->get();
}else{

    $order_items=order_item::where('order_items.store_id',$record->id)
->whereBetween('created_at', [$from, $to])

    ->get();
}

$records=[];

foreach($order_items as $index=>$data){

// dd($data->commission_amount);
$records[]=(object)[
'store_id'=>$data->store_id,
'id'=>$data->id,
'created_at'=>$data->created_at,
'item_u_id'=>$data->item_u_id,
'item_sku'=>$data->item_sku,
'category_name'=>$this->categorys($data->product_id),
'product_category'=>$this->product_categorys($data->product_id),
'product_name'=>$data->product_name,
'product_attributes'=>$this->attributes_funct($data->product_id),
'item_shipping_weight'=>$data->item_shipping_weight,
'item_shipping_weight_unit'=>$data->item_shipping_weight_unit,
'item_shipping_price'=>$data->item_shipping_price,
'total_Weight'=>$data->item_shipping_weight*$data->item_quantity,
'item_tax_price'=>$data->item_tax_price,
'item_selling_price'=>$data->item_selling_price,
'commission_amount'=>$data->commission_amount,
'commission_percent'=>$data->commission_percent,
'order_status'=>$this->order_status_function($data->suborder_id),
'paid_unpaid_status'=>$this->paid_unpaid_status_function($data->suborder_id),
'total_price'=>$data->item_selling_price*$data->item_quantity,
'item_quantity'=>$data->item_quantity,
];

}


// dd($records);

        return compact('record','records');
   

    }




public function categorys($id)
{

$product=product::find($id);



if (!empty($product->category)) {
    
    return $product->category->product_category;
}else{
    return '';
}


}



public function product_categorys($id)
{

$product=product::find($id);

if (!empty($product->subcategory)) {
    
    return $product->subcategory->product_subcategory;
}else{
    return '';
}

}


public function attributes_funct($id)
{


    $attributes=DB::table('product_attributes')
    ->where('product_id',$id)
    ->pluck('attribute_name','attribute_name')
    ->toArray();


    

    return implode(',',$attributes);

}



public function order_status_function($id)
{

$record=DB::table('suborders')->where('id',$id)->first();

return $record->order_status;

}


public function paid_unpaid_status_function($id)
{


$record=DB::table('suborders')->where('id',$id)->first();

return $record->paid_unpaid_status;
}




     public function store_item_wise_pdf_payout($id=null,Request $request)
  {   
   

       // $record=store::find($request->id);
       $record=store::where('user_id',Auth::user()->id)->first();




$from = $request->from_date;
$to = $request->to_date;



if (!empty($id)) {
    $order_items=order_item::where('order_items.suborder_id',$id)
    ->whereBetween('created_at', [$from, $to])

->get();
}else{

    $order_items=order_item::where('order_items.store_id',$record->id)
->whereBetween('created_at', [$from, $to])

    ->get();
}

$records=[];

foreach($order_items as $index=>$data){

$records[]=(object)[
'store_id'=>$data->store_id,
'id'=>$data->id,
'created_at'=>$data->created_at,
'item_u_id'=>$data->item_u_id,
'item_sku'=>$data->item_sku,
'category_name'=>$this->categorys($data->product_id),
'product_category'=>$this->product_categorys($data->product_id),
'product_name'=>$data->product_name,
'product_attributes'=>$this->attributes_funct($data->product_id),
'item_shipping_weight'=>$data->item_shipping_weight,
'item_shipping_weight_unit'=>$data->item_shipping_weight_unit,
'item_shipping_price'=>$data->item_shipping_price,
'total_Weight'=>$data->item_shipping_weight*$data->item_quantity,
'item_tax_price'=>$data->item_tax_price,
'item_selling_price'=>$data->item_selling_price,
'commission_amount'=>$data->commission_amount,
'commission_percent'=>$data->commission_percent,
'order_status'=>$this->order_status_function($data->suborder_id),
'paid_unpaid_status'=>$this->paid_unpaid_status_function($data->suborder_id),
'total_price'=>$data->item_selling_price*$data->item_quantity,
'item_quantity'=>$data->item_quantity,
];

}


// dd($records);

   $pdfview= $record->store_unique_id.date('Ymd');
  //dd($records);
   $pdf =  \PDF::loadView('emails.store_item_wise_pdf_payout',compact('record','records'));

     $pdf->setPaper('A3', 'landscape');


   return $pdf->download($pdfview.'.pdf');
   

 }
 

 

  public function store_item_wise_excel_payout($id=null,Request $request)
  {   
   
$from = $request->from_date;
$to = $request->to_date;

$record=suborder::find($id);


       $record=store::where('user_id',Auth::user()->id)->first();

    $suborder_u_id=$record->store_unique_id;

$store_id=0;

if (!empty($record)) {
    
    $suborder_u_id=$record->suborder_u_id;

    $store_id = $record->id;

}

return Excel::download(new store_item_wise_excel_payout($id,$from,$to,$store_id),$suborder_u_id.date('Ymd').'.csv');


 }


    }