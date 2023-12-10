<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\service_plan;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;
use App\service;
use Image;
use File;
use App\user;

class archive_serviceController extends Controller
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
          return $next($request);
      });
    }
    
        public function index(Request $request)
    {
         
          $records=DB::table('services')
        ->leftjoin('cities','services.service_city','cities.id')
        ->leftjoin('service_categories','services.service_category','service_categories.id')
        ->leftjoin('countries','services.service_country','countries.id')
        ->leftjoin('service_plans','services.id','service_plans.service_id')    
        ->select('services.id','cities.city_name','countries.country_name','services.status','services.service_name','service_plans.plan_name','services.created_at','services.service_owner_name','services.service_mobile','services.service_email','service_categories.category_name');
        
                      if (!empty($request->search)) {
  $term=$request->search;
$records=$records
->where(function($q) use ($term) {
$q
   
        ->orWhere('countries.country_name','like','%' . $term . '%')
        ->orWhere('services.status','like','%' . $term . '%')
        ->orWhere('services.service_name','like','%' . $term . '%')
        ->orWhere('services.created_at','like','%' . $term . '%')
        ->orWhere('services.service_owner_name','like','%' . $term . '%')
        ->orWhere('services.service_mobile','like','%' . $term . '%')
        ->orWhere('services.service_email','like','%' . $term . '%')
        ->orWhere('service_categories.category_name','like','%' . $term . '%')
        ->orWhere('service_plans.plan_name','like','%' . $term . '%')
        ->orWhere('cities.city_name','like','%' . $term . '%');
    });


}   

       if (!empty($request->package)) {
  $records=  $records
     ->Where('service_plans.plan_name','like','%' . $request->package . '%');

}

     if (!empty($request->city)) {
  $records=  $records
     ->Where('services.service_city','like','%' . $request->city . '%');

}


     if (!empty($request->category)) {
  $records=  $records
     ->Where('services.service_category','like','%' . $request->category . '%');

}


$records=  $records
->orderBy('cities.updated_at','desc')
->groupby('services.id')
->where('services.status','Archive')

        ->paginate(25);



 $use=DB::table('services')
        ->join('cities','services.service_city','cities.id')
        ->select('cities.id','cities.city_name')
         ->orderBy('cities.id', 'asc')->get()
;

 $cities = array();
foreach($use as $user) {
$cities[$user->id] = $user->city_name;
}



$use=DB::table('services')
->join('service_categories','services.service_category','service_categories.id')
->select('service_categories.id','service_categories.category_name')
->where('service_categories.status','Active') 
->orderBy('service_categories.id', 'asc')->get();

 $categories = array();
foreach($use as $user) {
$categories[$user->id] = $user->category_name;
}




return view('admin.archive_service.index',compact('records','cities','categories'));
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $countries = DB::table('countries')  
                    ->select('country_name','id')
                     ->where('status','Active')
            ->orderBy('country_name', 'asc')->pluck('country_name','id'); 

  $categories = DB::table('service_categories')  
                    ->select('category_name','id')
                     ->where('status','Active')
            ->orderBy('category_name', 'asc')->pluck('category_name','id'); 

// dd($categories);


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


 // $subscriptions = DB::table('service_subscriptions')  
 //                    ->select('service_plan_name','id')
 //                     ->where('status','Active')
 //            ->orderBy('service_plan_name', 'asc')->pluck('service_plan_name','id'); 




         return view('admin.archive_service.create',compact('commissions','countries','categories'));
    }

    /**
     * service a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
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
            $service_logo = "";
        }


     if($request->hasFile('service_cover_photo'))
         {       
     $file = $request->file('service_cover_photo');
     $extension = $request->file('service_cover_photo')->getClientOriginalExtension();
     $service_cover_photo = date('d_m_Y_h_i_s',time()) . '2.' . $extension;

    $destinationPaths = base_path().'/public/images/service_cover_photo/';
       $thumb_img =Image::make($file->getRealPath())->orientate()->resize(660, 450);
     $thumb_img->save($destinationPaths.'/'.$service_cover_photo,80);

      }       
        else{
            $service_cover_photo = "";
        }


 $user_data = array(
'name' => $request->input('service_name'),
'email' => $request->input('service_email'),
'password' => bcrypt($request->input('service_password')),
'mobile' => str_replace(' ','',$request->input('service_mobile')),
'role' =>'5',
'status'=>'Active',

);
  $users = new user($user_data);
         $users->save();

$plans=DB::table('service_subscriptions')
->where('service_plan_name','Free')
->first();
 $aaa = array(
      ' ' => '-', 
      '/' => '-',
      ','=>'-',
      '---'=>'-',
      '--'=>'-',
      '_'=>'-',

    );

$service_name=str_replace( array_keys($aaa), 
      array_values($aaa), $request->service_name);


$subcat=DB::table('service_categories')->where('id',$request->service_category)->select('category_url')->first();
$locality=DB::table('localities')->where('id',$request->service_locality)->select('locality_url')->first();


    $service_link=strtolower($service_name.'-'.$subcat->category_url.'-'.$locality->locality_url);



         $data = array(
                'user_id' =>$users->id,
'service_unique_id'=>'Service'.$users->id.date('Y'),
'created_by'=>'Admin',
            'service_cover_photo'=>$service_cover_photo,
            'service_logo'=>$service_logo,
            'service_owner_name'=>$request->input('service_owner_name'),
            'service_owner_email'=>$request->input('service_owner_email'),
            'service_owner_mobile'=>$request->input('service_owner_mobile'),
            'service_name'=>$request->input('service_name'),
            'service_mobile'=>'+'.$request->user_country_code.str_replace(' ','',$request->input('service_mobile')),
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
            'service_password'=>$request->input('service_password'),
            'service_category'=>$request->input('service_category'),
            'service_country'=>$request->input('service_country'),
            'service_state'=>$request->input('service_state'),
            'service_city'=>$request->input('service_city'),
            'service_payout_option'=>$request->input('service_payout_option'),
            'service_plan_id'=>$plans->id,
            'service_email_option'=>$request->input('service_email_option'),
            'service_sms_option'=>$request->input('service_sms_option'),
            'service_stock_management'=>$request->input('service_stock_management'),
            'service_invoice_period'=>$request->input('service_invoice_period'),
            'str_verified_status'=>$request->input('str_verified_status'),
            'service_description'=>$request->input('service_description'),
            'service_owner_gendor'=>$request->input('service_owner_gendor'),
            'service_locality'=>$request->input('service_locality'),
            'service_link'=>$service_link,
 'service_open_time'=>$request->input('service_open_time'),
                        'service_close_time'=>$request->input('service_close_time'),
);
         $service = new service($data);
         $service->save();
                 


$plan_expiry_date=Carbon::now()->addDay($plans->service_plan_validity);

 $data = array(
'plan_name'=>$plans->service_plan_name,
'plan_price'=>$plans->service_plan_price,
'plan_id'=>$plans->service_plan_id,
'plan_discount'=>$plans->service_plan_discount,
'plan_validity'=>$plans->service_plan_validity,
'service_limit'=>$plans->service_product_limit,
'plan_features'=>$plans->service_plan_features,
'service_id'=>$service->id,
'plan_expiry_date'=>$plan_expiry_date,

                );

  $service_plan = new service_plan($data);
         $service_plan->save();
                 

$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/archive-service')->with($notification);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

$record=service::find($id);
Session::put('service_id',$id);
Session::put('service_name',$record->service_name);


        return view('seller.dashboard.index',compact('record'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $record = service::find($id);         
         // dd($record);
       $countries = DB::table('countries')  
                    ->select('country_name','id')
                     ->where('status','Active')
            ->orderBy('country_name', 'asc')->pluck('country_name','id'); 

  $categories = DB::table('service_categories')  
                    ->select('category_name','id')
                     ->where('status','Active')
            ->orderBy('category_name', 'asc')->pluck('category_name','id'); 

  $service_category = DB::table('service_categories')  
                    ->select('category_name','id')
                     ->where('status','Active')
                     ->where('service_categories.category_name',$record->service_category)
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
$user_id=$record->user_id;

         return view('admin.archive_service.edit',compact('commissions','countries','categories','subscriptions','record','states','cities','localities','service_category','user_id'));



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
       $thumb_img =Image::make($file->getRealPath())->orientate()->resize(660, 450);
     $thumb_img->save($destinationPaths.'/'.$service_cover_photo,80);

      }       
        else{
            $service_cover_photo = $services->service_cover_photo;
        }



$plans=DB::table('service_subscriptions')
->where('service_plan_name','Free')
->first();


$aaa = array(
      ' ' => '-', 
      '/' => '-',
      ','=>'-',
      '---'=>'-',
      '--'=>'-',
      '_'=>'-',

    );

$service_name=str_replace( array_keys($aaa), 
      array_values($aaa), $request->service_name);


$subcat=DB::table('service_categories')->where('id',$request->service_category)->select('category_url')->first();
$locality=DB::table('localities')->where('id',$request->service_locality)->select('locality_url')->first();


    $service_link=strtolower($service_name.'-'.$subcat->category_url.'-'.$locality->locality_url);



   $data = array(
//                 'user_id' =>$users->id,
// 'service_unique_id'=>'Str'.$users->id.date('Y'),
// 'created_by'=>'Admin',
            'service_cover_photo'=>$service_cover_photo,
            'service_logo'=>$service_logo,
            'service_owner_name'=>$request->input('service_owner_name'),
            'service_owner_email'=>$request->input('service_owner_email'),
            'service_owner_mobile'=>$request->input('service_owner_mobile'),
            'service_name'=>$request->input('service_name'),
            'service_mobile'=>'+'.$request->user_country_code.str_replace(' ','',$request->input('service_mobile')),
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
            'service_category'=>$request->input('service_category'),
            // 'service_product_category'=>implode(',', $request->service_product_category),
            'service_country'=>$request->input('service_country'),
            'service_state'=>$request->input('service_state'),
            'service_city'=>$request->input('service_city'),
            'service_payout_option'=>$request->input('service_payout_option'),
            'service_plan_id'=>$plans->id,
            'service_email_option'=>$request->input('service_email_option'),
            'service_sms_option'=>$request->input('service_sms_option'),
            'service_stock_management'=>$request->input('service_stock_management'),
            'service_invoice_period'=>$request->input('service_invoice_period'),
            'str_verified_status'=>$request->input('str_verified_status'),
            'service_description'=>$request->input('service_description'),
            'service_owner_gendor'=>$request->input('service_owner_gendor'),
                        'service_locality'=>$request->input('service_locality'),
'service_link'=>$service_link,
                        'service_open_time'=>$request->input('service_open_time'),
                        'service_close_time'=>$request->input('service_close_time'),
                        'service_password'=>$request->input('service_password'),

);


// dd($data);

         DB::table('users')
         ->where('id',$services->user_id)
         ->update(
[

'name' => $request->input('service_name'),
'email' => $request->input('service_email'),
'password' => bcrypt($request->input('service_password')),
'mobile' => str_replace(' ','',$$request->input('service_mobile')),
]
         );

         $services->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/archive-service')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
    $service = service::find($request->id);
    $users = user::find($service->user_id);

                   $service_bank_detail = DB::table('service_bank_details')->where('user_id',$service->user_id)->first();
                   $service_booking = DB::table('service_bookings')->where('user_id',$service->user_id)->first();

                   // $service_customer_chat = DB::table('service_customer_chats')->where('user_id',$service->user_id)->first();
 
                   $service_document = DB::table('service_documents')->where('user_id',$service->user_id)->first();
                   $service_photo_gallerie = DB::table('service_photo_galleries')->where('service_user_id',$service->user_id)->get();
                   $service_plan = DB::table('service_plans')->where('service_id',$service->id)->get();
                   $service_plan_invoice = DB::table('service_plan_invoices')->where('user_id',$service->user_id)->first();
                   $service_purchase_plan = DB::table('service_purchase_plans')->where('user_id',$service->user_id)->first();
                   $service_vendor_categorie = DB::table('service_vendor_categories')->where('user_id',$service->user_id)->get();

    

if (!empty($service_bank_detail)) {
    $service_bank_detail->delete();
   
}

if (!empty($service_booking)) {
    $service_booking->delete();
   
}

if (!empty($service_document)) {
    $service_document->delete();
   
}

if (!empty($service_photo_gallerie)) {
    // $service_photo_gallerie->delete();
    
   foreach($service_photo_gallerie as $data){

    $image_path = base_path().'/public/images/service_photo_gallery/'.$data->gallery_img; 
    if(File::exists($image_path)) {
        File::delete($image_path);

    }

    
$shop_categorie = DB::table('service_photo_galleries')->where('id',$data->id)->delete();
   
}
}

if (!empty($service_plan)) {
    // $service_plan->delete();

       foreach($service_plan as $data){
$service_plan = DB::table('service_plans')->where('id',$data->id)->delete();

}
   
}

if (!empty($service_plan_invoice)) {
    $service_plan_invoice->delete();
   
}

if (!empty($service_purchase_plan)) {
    $service_purchase_plan->delete();
   
}

if (!empty($service_vendor_categorie)) {
    // $service_vendor_categorie->delete();

    $service_vendor_categorie = DB::table('service_vendor_categories')->where('id',$data->id)->delete();

   
}

if (!empty($service)) {
    $service->delete();
   
}

if (!empty($users)) {
    $users->delete();
   
}

         
    }


  public function services_status_archive(Request $request){
 
         $record=service::find($request->id);
      
               $updatevender=\DB::table('services')->where('id',$request->id)
                              ->update([
                                'status' => 'Active',
                                 ]);
            return json_encode('Active');
           
           }


     public function status_update(Request $request){
 
         $record=service::find($request->user_id);
      
          if($record['status']=='Active'){
               $updatevender=\DB::table('services')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);
            return json_encode('Deactive');
           } else {
              $updateuser=\DB::table('services')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Active',
                                // 'updated_at' => date('Y-m-d H:i:s') 
                                 ]);
              return json_encode("Active");

        }
           }

    public function check_name(Request $request)
    {

        // return $request->checkstate;
        
      if(!empty($request->check_name)){

        $record = service::where('service_name', $request->check_name)->first();

         if(!empty($record)){
            return "exist";
         }else{
            return "notexist";
         }
      }
      if(!empty($request->check_name_edit)){

        $record = service::where('service_name', $request->check_name_edit)->get();

         if(count($record) <=1){
            return "notexist";
         }else{
            return "exist";
         }
      }
  }





     public function append_city(Request $request)
    {   
             $stateId= $request->id;
         $disticts =\DB::table('cities')
                      ->join('states', 'cities.state_id', '=', 'states.id')
                      ->select('cities.*','states.state_name')
                       ->where("cities.state_id",$stateId)
                       ->where("cities.status",'Active')
                      ->pluck('cities.city_name','cities.id');
                      
        return json_encode($disticts);
    }
}
