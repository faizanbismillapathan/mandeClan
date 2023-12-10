<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\store_plan;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;
use App\store;
use Image;
use File;
use App\user;
use App\user_account_delete;
use App\seller_document;

class archive_storeController extends Controller
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
         
          $records=DB::table('stores')
        ->leftjoin('cities','stores.store_city','cities.id')
        ->leftjoin('store_categories','stores.store_category','store_categories.id')
        ->leftjoin('countries','stores.store_country','countries.id')
        ->leftjoin('store_purchase_plans','stores.user_id','store_purchase_plans.user_id')    
        ->select('stores.id','cities.city_name','countries.country_name','stores.status','stores.store_name','store_purchase_plans.store_plan_name','stores.created_at','stores.store_owner_name','stores.store_mobile','stores.store_email','store_categories.category_name','stores.user_id');
        
        // \DB::raw("GROUP_CONCAT(product_categories.product_category) as product_category")
          // ->leftjoin("product_categories",\DB::raw("FIND_IN_SET(product_categories.id,stores.store_product_category)"),">",\DB::raw("'0'"));

               if (!empty($request->search)) {
  $records=  $records
   
        ->orWhere('countries.country_name','like','%' . $request->search . '%')
        ->orWhere('stores.status','like','%' . $request->search . '%')
        ->orWhere('stores.store_name','like','%' . $request->search . '%')
        ->orWhere('stores.created_at','like','%' . $request->search . '%')
        ->orWhere('stores.store_owner_name','like','%' . $request->search . '%')
        ->orWhere('stores.store_mobile','like','%' . $request->search . '%')
        ->orWhere('stores.store_email','like','%' . $request->search . '%')
        ->orWhere('store_categories.category_name','like','%' . $request->search . '%')
        ->orWhere('store_plans.plan_name','like','%' . $request->search . '%')
        ->orWhere('cities.city_name','like','%' . $request->search . '%');


}  

       if (!empty($request->package)) {
  $records=  $records
     ->Where('store_plans.plan_name','like','%' . $request->package . '%');

}

     if (!empty($request->city)) {
  $records=  $records
     ->Where('stores.store_city','like','%' . $request->city . '%');

}


     if (!empty($request->category)) {
  $records=  $records
     ->Where('stores.store_category','like','%' . $request->category . '%');

}


$records=  $records
->orderBy('cities.updated_at','desc')
->where('stores.status','Archive')

->groupby('stores.id')

        ->paginate(25);



//    $use = DB::table('store_subscriptions')  
//                     ->select('store_plan_name','id')
//                      ->where('status','Active')
//                ->orderBy('store_plan_name', 'asc')->get(); 

//  $packages = array();
// foreach($use as $user) {
// $packages[$user->id] = $user->store_plan_name;
// }


 $use=DB::table('stores')
        ->join('cities','stores.store_city','cities.id')
        ->select('cities.id','cities.city_name')
         ->orderBy('cities.id', 'asc')->get()
;

 $cities = array();
foreach($use as $user) {
$cities[$user->id] = $user->city_name;
}



$use=DB::table('stores')
->join('store_categories','stores.store_category','store_categories.id')
->select('store_categories.id','store_categories.category_name')
->where('store_categories.status','Active') 
->orderBy('store_categories.id', 'asc')->get();

 $categories = array();
foreach($use as $user) {
$categories[$user->id] = $user->category_name;
}




//  DB::table('counts')
// ->where('id','1')
// ->update([
// 'state_count'=>$count,
// ]);

// dd($records);
// $shop_categories = DB::table('shop_categories')->where('user_id','86892')->get();

// if (count($shop_categories)>0) {

//        foreach($shop_categories as $data){

// $shop_categorie = DB::table('shop_categories')->where('id',$data->id)->first();
// dd($shop_categorie);
// if (!empty($shop_categorie)) {

//         $shop_categorie->delete();
//     }
   
// }


   
// }



return view('admin.archive_stores.index',compact('records','cities','categories'));
   
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

  $categories = DB::table('store_categories')  
                    ->select('category_name','id')
                     ->where('status','Active')
            ->orderBy('category_name', 'asc')->pluck('category_name','id'); 


  $product_category = DB::table('product_categories')  
                    ->select('product_category','id')
                     ->where('status','Active')
            ->orderBy('product_category', 'asc')->pluck('product_category','id'); 



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


 // $subscriptions = DB::table('store_subscriptions')  
 //                    ->select('store_plan_name','id')
 //                     ->where('status','Active')
 //            ->orderBy('store_plan_name', 'asc')->pluck('store_plan_name','id'); 




         return view('admin.archive_stores.create',compact('commissions','countries','categories','product_category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);


//           $this->validate($request, [
//              'store_logo' => 'dimensions:min_width=100,min_height=100',
//                 'store_cover_photo' => 'dimensions:min_width=400,min_height=250'
//         ],[
// 'store_logo.dimensions'=>'This image size required minimum 100*100 ',
// 'store_cover_photo.dimensions'=>'This image size required minimum 400*250 ',

//         ]);

        if($request->hasFile('store_logo'))
  
        {       
     $file = $request->file('store_logo');
     $extension = $request->file('store_logo')->getClientOriginalExtension();
     $store_logo = date('d_m_Y_h_i_s',time()) . '1.' . $extension;

         $destinationPaths = base_path().'/public/images/store_logo';

  $thumb_img =Image::make($file->getRealPath())->orientate()->resize(100, 100);
  
     $thumb_img->save($destinationPaths.'/'.$store_logo,80);


      }       
        else{
            $store_logo = "";
        }


     if($request->hasFile('store_cover_photo'))
         {       
     $file = $request->file('store_cover_photo');
     $extension = $request->file('store_cover_photo')->getClientOriginalExtension();
     $store_cover_photo = date('d_m_Y_h_i_s',time()) . '2.' . $extension;

    $destinationPaths = base_path().'/public/images/store_cover_photo/';
       $thumb_img =Image::make($file->getRealPath())->orientate()->resize(660, 450);
     $thumb_img->save($destinationPaths.'/'.$store_cover_photo,80);

      }       
        else{
            $store_cover_photo = "";
        }


 $user_data = array(
'name' => $request->input('store_name'),
'email' => $request->input('store_email'),
'password' => bcrypt($request->input('store_password')),
'mobile' =>'+'.$request->user_country_code.str_replace(' ','',$request->input('store_mobile')),
'role' =>'2',
'status'=>'Active',

);
  $users = new user($user_data);
         $users->save();

$plans=DB::table('store_subscriptions')
->where('store_plan_name','Free')
->first();
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


$subcat=DB::table('store_categories')->where('id',$request->store_category)->select('category_url')->first();
$locality=DB::table('localities')->where('id',$request->store_locality)->select('locality_url')->first();


    $store_link=strtolower($store_name.'-'.$subcat->category_url.'-'.$locality->locality_url);



         $data = array(
'user_id' =>$users->id,
'store_unique_id'=>'Str'.$users->id.date('Y'),
'created_by'=>'Admin',
'store_cover_photo'=>$store_cover_photo,
'store_logo'=>$store_logo,
'store_owner_name'=>$request->input('store_owner_name'),
'store_owner_email'=>$request->input('store_owner_email'),
'store_owner_mobile'=>$request->input('store_owner_mobile'),
'store_name'=>$request->input('store_name'),
'store_mobile'=>'+'.$request->user_country_code.str_replace(' ','',$request->input('store_mobile')),
'store_phone'=>$request->input('store_phone'),
'store_email'=>$request->input('store_email'),
'store_gstin_no'=>$request->input('store_gstin_no'),
'store_website'=>$request->input('store_website'),
'store_facebook_url'=>$request->input('store_facebook_url'),
'store_instagram_url'=>$request->input('store_instagram_url'),
'store_you_tube_url'=>$request->input('store_you_tube_url'),
'store_twitter_url'=>$request->input('store_twitter_url'),
'store_pincode'=>$request->input('store_pincode'),
'store_address'=>$request->input('store_address'),
'store_longitude'=>$request->input('store_longitude'),
'store_latitude'=>$request->input('store_latitude'),
'store_paypal_email'=>$request->input('store_paypal_email'),
'store_paytm_mobile'=>'+'.$request->user_country_code.str_replace(' ','',$request->input('store_paytm_mobile')),
'str_bank_account_no'=>$request->input('str_bank_account_no'),
'str_bank_account_name'=>$request->input('str_bank_account_name'),
'str_bank_bank_name'=>$request->input('str_bank_bank_name'),
'str_bank_ifsc_code'=>$request->input('str_bank_ifsc_code'),
'str_bank_branch'=>$request->input('str_bank_branch'),
'str_bank_branch_addr'=>$request->input('str_bank_branch_addr'),
'str_bank_account_type'=>$request->input('str_bank_account_type'),
'store_commission_id'=>$request->input('store_commission_id'),
'store_email'=>$request->input('store_email'),
'store_password'=>$request->input('store_password'),
'store_category'=>$request->input('store_category'),
// 'store_product_category'=>implode(',', $request->store_product_category),
'store_country'=>$request->input('store_country'),
'store_state'=>$request->input('store_state'),
'store_city'=>$request->input('store_city'),
'store_payout_option'=>$request->input('store_payout_option'),
'store_plan_id'=>$plans->id,
'store_email_option'=>$request->input('store_email_option'),
'store_sms_option'=>$request->input('store_sms_option'),
'store_stock_management'=>$request->input('store_stock_management'),
'store_invoice_period'=>$request->input('store_invoice_period'),
'str_verified_status'=>$request->input('str_verified_status'),
'store_description'=>$request->input('store_description'),
'store_owner_gendor'=>$request->input('store_owner_gendor'),
'store_locality'=>$request->input('store_locality'),
'store_link'=>$store_link,
'store_open_time'=>$request->input('store_open_time'),
'store_close_time'=>$request->input('store_close_time'),
);
         $store = new store($data);
         $store->save();
                 


$plan_expiry_date=Carbon::now()->addDay($plans->store_plan_validity);

 $data = array(
'plan_name'=>$plans->store_plan_name,
'plan_price'=>$plans->store_plan_price,
'plan_id'=>$plans->store_plan_id,
'plan_discount'=>$plans->store_plan_discount,
'plan_validity'=>$plans->store_plan_validity,
'product_limit'=>$plans->store_product_limit,
'plan_features'=>$plans->store_plan_features,
'store_id'=>$store->id,
'plan_expiry_date'=>$plan_expiry_date,

                );

  $store_plan = new store_plan($data);
         $store_plan->save();
                 

$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/archive-store')->with($notification);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

$record=store::find($id);
Session::put('store_id',$id);
Session::put('store_name',$record->store_name);


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
        // dd($id);
        $record = store::find($id);         
        
       $countries = DB::table('countries')  
                    ->select('country_name','id')
                     ->where('status','Active')
            ->orderBy('country_name', 'asc')->pluck('country_name','id'); 

  $categories = DB::table('store_categories')  
                    ->select('category_name','id')
                     ->where('status','Active')
            ->orderBy('category_name', 'asc')->pluck('category_name','id'); 

  $product_category = DB::table('product_categories')  
                    ->select('product_category','id')
                     ->where('status','Active')
                     ->where('product_categories.store_category',$record->store_category)
            ->orderBy('product_category', 'asc')->pluck('product_category','id'); 

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
$user_id=$record->user_id;

         return view('admin.archive_stores.edit',compact('commissions','countries','categories','subscriptions','record','states','cities','localities','product_category','user_id'));



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
        
        $stores = store::find($id); 



if($request->hasFile('store_logo'))
  
        {       
     $file = $request->file('store_logo');
     $extension = $request->file('store_logo')->getClientOriginalExtension();
     $store_logo = date('d_m_Y_h_i_s',time()) . '1.' . $extension;

         $destinationPaths = base_path().'/public/images/store_logo';

  $thumb_img =Image::make($file->getRealPath())->orientate()->resize(100, 100);
  
     $thumb_img->save($destinationPaths.'/'.$store_logo,80);


      }       
        else{
            $store_logo = $stores->store_logo;
        }


     if($request->hasFile('store_cover_photo'))
         {       
     $file = $request->file('store_cover_photo');
     $extension = $request->file('store_cover_photo')->getClientOriginalExtension();
     $store_cover_photo = date('d_m_Y_h_i_s',time()) . '2.' . $extension;

    $destinationPaths = base_path().'/public/images/store_cover_photo/';
       $thumb_img =Image::make($file->getRealPath())->orientate()->resize(660, 450);
     $thumb_img->save($destinationPaths.'/'.$store_cover_photo,80);

      }       
        else{
            $store_cover_photo = $stores->store_cover_photo;
        }



$plans=DB::table('store_subscriptions')
->where('store_plan_name','Free')
->first();


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


$subcat=DB::table('store_categories')->where('id',$request->store_category)->select('category_url')->first();
$locality=DB::table('localities')->where('id',$request->store_locality)->select('locality_url')->first();


    $store_link=strtolower($store_name.'-'.$subcat->category_url.'-'.$locality->locality_url);



   $data = array(
//                 'user_id' =>$users->id,
// 'store_unique_id'=>'Str'.$users->id.date('Y'),
// 'created_by'=>'Admin',
'store_cover_photo'=>$store_cover_photo,
'store_logo'=>$store_logo,
'store_owner_name'=>$request->input('store_owner_name'),
'store_owner_email'=>$request->input('store_owner_email'),
'store_owner_mobile'=>$request->input('store_owner_mobile'),
'store_name'=>$request->input('store_name'),
'store_mobile'=>'+'.$request->user_country_code.str_replace(' ','',$request->input('store_mobile')),
'store_phone'=>$request->input('store_phone'),
'store_email'=>$request->input('store_email'),
'store_gstin_no'=>$request->input('store_gstin_no'),
'store_website'=>$request->input('store_website'),
'store_facebook_url'=>$request->input('store_facebook_url'),
'store_instagram_url'=>$request->input('store_instagram_url'),
'store_you_tube_url'=>$request->input('store_you_tube_url'),
'store_twitter_url'=>$request->input('store_twitter_url'),
'store_pincode'=>$request->input('store_pincode'),
'store_address'=>$request->input('store_address'),
'store_longitude'=>$request->input('store_longitude'),
'store_latitude'=>$request->input('store_latitude'),
'store_paypal_email'=>$request->input('store_paypal_email'),
'store_paytm_mobile'=>'+'.$request->user_country_code.str_replace(' ','',$request->input('store_paytm_mobile')),
'str_bank_account_no'=>$request->input('str_bank_account_no'),
'str_bank_account_name'=>$request->input('str_bank_account_name'),
'str_bank_bank_name'=>$request->input('str_bank_bank_name'),
'str_bank_ifsc_code'=>$request->input('str_bank_ifsc_code'),
'str_bank_branch'=>$request->input('str_bank_branch'),
'str_bank_branch_addr'=>$request->input('str_bank_branch_addr'),
'str_bank_account_type'=>$request->input('str_bank_account_type'),
'store_commission_id'=>$request->input('store_commission_id'),
'store_email'=>$request->input('store_email'),
'store_category'=>$request->input('store_category'),
// 'store_product_category'=>implode(',', $request->store_product_category),
'store_country'=>$request->input('store_country'),
'store_state'=>$request->input('store_state'),
'store_city'=>$request->input('store_city'),
'store_payout_option'=>$request->input('store_payout_option'),
'store_plan_id'=>$plans->id,
'store_email_option'=>$request->input('store_email_option'),
'store_sms_option'=>$request->input('store_sms_option'),
'store_stock_management'=>$request->input('store_stock_management'),
'store_invoice_period'=>$request->input('store_invoice_period'),
'str_verified_status'=>$request->input('str_verified_status'),
'store_description'=>$request->input('store_description'),
'store_owner_gendor'=>$request->input('store_owner_gendor'),
'store_locality'=>$request->input('store_locality'),
'store_link'=>$store_link,
'store_open_time'=>$request->input('store_open_time'),
'store_close_time'=>$request->input('store_close_time'),
'store_password'=>$request->input('store_password'),

);


// dd($data);

         DB::table('users')
         ->where('id',$stores->user_id)
         ->update(
[

'name' => $request->input('store_name'),
'email' => $request->input('store_email'),
'password' => bcrypt($request->input('store_password')),
'mobile' => str_replace(' ','',$request->input('store_mobile')),
]
         );
// $plan_expiry_date=Carbon::now()->addDay($plans->store_plan_validity);

// $data = array(
// 'plan_name'=>$plans->store_plan_name,
// 'plan_price'=>$plans->store_plan_price,
// 'plan_id'=>$plans->store_plan_id,
// 'plan_discount'=>$plans->store_plan_discount,
// 'plan_validity'=>$plans->store_plan_validity,
// 'product_limit'=>$plans->store_product_limit,
// 'plan_features'=>$plans->store_plan_features,
// 'store_id'=>$id,
// 'plan_expiry_date'=>$plan_expiry_date,

//                 );

//   $store_plan = new store_plan($data);
//          $store_plan->save();



         $stores->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/archive-store')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
$store = store::find($request->id);
$users = user::find($store->user_id);
$store_carts = DB::table('store_carts')->where('user_id',$store->user_id)->first();
$shop_categories = DB::table('shop_categories')->where('user_id',$store->user_id)->get();
$store_photo_galleries = DB::table('store_photo_galleries')->where('store_user_id',$store->user_id)->get();
$store_plans = DB::table('store_plans')->where('store_id',$store->id)->first();
$store_plan_invoices = DB::table('store_plan_invoices')->where('user_id',$store->user_id)->first();
$store_purchase_plans = DB::table('store_purchase_plans')->where('user_id',$store->user_id)->first();

$abandoned_store_carts = DB::table('abandoned_store_carts')->where('store_id',$store->id)->first();
$seller_bank_details = DB::table('seller_bank_details')->where('user_id',$store->user_id)->first();
$seller_documents = DB::table('seller_documents')->where('user_id',$store->user_id)->get();

$order_delivery_addresse = DB::table('order_delivery_addresses')->where('store_id',$store->id)->first();

$product = DB::table('products')->where('user_id',$store->user_id)->first();
$product_addon_group = DB::table('product_addon_groups')->where('user_id',$store->user_id)->first();
$product_addon='';
if ($product_addon_group) {
$product_addon = DB::table('product_addons')->where('addon_group_id',$product_addon_group->id)->first();
}
$product_attribute = DB::table('product_attributes')->where('store_user_id',$store->user_id)->first();
$product_item = DB::table('product_items')->where('user_id',$store->user_id)->first();

$suport_ticket = DB::table('suport_tickets')->where('user_id',$store->user_id)->first();





if (!empty($order_delivery_addresse)) {
    $order_delivery_addresse->delete();
   
}

if (!empty($product)) {
    $product->delete();
   
}
if (!empty($product_addon)) {
    $product_addon->delete();
   
}


if (!empty($product_addon_group)) {
    $product_addon_group->delete();
   
}
if (!empty($product_attribute)) {
    $product_attribute->delete();
   
}
if (!empty($product_item)) {
    $product_item->delete();
   
}

if (!empty($suport_ticket)) {
    $suport_ticket->delete();
   
}
if (!empty($store_carts)) {
    $store_carts->delete();
   
}


       foreach($shop_categories as $data){

$shop_categorie = DB::table('shop_categories')->where('id',$data->id)->delete();
   
}


   
   foreach($store_photo_galleries as $data){

    $image_path = base_path().'/public/images/store_photo_gallery/'.$data->gallery_img; 
    if(File::exists($image_path)) {
        File::delete($image_path);

    }

    
$shop_categorie = DB::table('store_photo_galleries')->where('id',$data->id)->delete();
   
}
// if (!empty($store_photo_galleries)) {
//     $store_photo_galleries->delete();
   
// }
// if (!empty($store_plans)) {
//     $store_plans->delete();
   
// }
// if (!empty($store_plan_invoices)) {
//     $store_plan_invoices->delete();
   
// }
// if (!empty($store_purchase_plans)) {
//     $store_purchase_plans->delete();
   
// }


if (!empty($abandoned_store_carts)) {
    $abandoned_store_carts->delete();
   
}


    foreach($seller_documents as $data){


$seller_document = DB::table('seller_documents')->where('id',$data->id)->delete();

// $seller_document = seller_document::find($data->id);

// if (!empty($seller_document)) {

//         $seller_document->delete();
//     }
   
}


if (!empty($seller_bank_details)) {
    $seller_bank_details->delete();
   
}
if (!empty($store)) {
    $store->delete();
   
}
if (!empty($users)) {
    $users->delete();
   
}




//         $record=store::find($request->id);

//                $updatevender=\DB::table('stores')->where('id',$request->id)
//                               ->update([
//                                 'status' => 'Archive',
// 'status_date'=>Carbon::now()->toDateString(),
// 'status_created_by'=>'Admin',
//                                  ]);

//                               $updatevender=\DB::table('users')->where('id',$record->user_id)
// ->update([
// 'status' => 'Archive',
// ]);

// user_account_delete::Insert([
// 'user_id' => $record->user_id,
// 'status_reason' => $request->status_reason,
// 'status_comment' => $request->status_comment,
// 'status' => 'Archive',

// ]);


            return json_encode('succes');


    }



     public function status_update(Request $request){
 
         $record=store::find($request->user_id);
      
          if($record['status']=='Active'){
               $updatevender=\DB::table('stores')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);
            return json_encode('Deactive');
           } else {
              $updateuser=\DB::table('stores')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Active',
                                // 'updated_at' => date('Y-m-d H:i:s') 
                                 ]);
              return json_encode("Active");

        }
           }



     public function stores_status_archive(Request $request){
 
         $record=store::find($request->id);
      
               $updatevender=\DB::table('stores')->where('id',$request->id)
                              ->update([
                                'status' => 'Active',
                                 ]);
            return json_encode('Active');
           
           }


    public function check_name(Request $request)
    {

        // return $request->checkstate;
        
      if(!empty($request->check_name)){

        $record = store::where('store_name', $request->check_name)->first();

         if(!empty($record)){
            return "exist";
         }else{
            return "notexist";
         }
      }
      if(!empty($request->check_name_edit)){

        $record = store::where('store_name', $request->check_name_edit)->get();

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
