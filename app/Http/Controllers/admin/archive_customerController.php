<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\customer;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;
use Image;
use File;
use App\user;
use App\user_account_delete;

class archive_customerController extends Controller
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

        $records=DB::table('customers')
        ->leftjoin('cities','cities.id','customers.customer_city')
        ->leftjoin('countries','countries.id','customers.customer_country')

        ->orderBy('customers.id','desc');

        if (!empty($request->search)) {
           $records= $records
           ->orWhere('customers.customer_name','like','%' . $request->search . '%');
       }

       $records= $records
       ->select('countries.country_name','cities.city_name','customers.*')
       ->where('customers.status','Archive')
       ->paginate(25);



       $use = DB::table('customers')  
       ->select('customer_name','id')        

       ->orderBy('customer_name', 'asc')->get(); 

       $customers = array();
       foreach($use as $user) {
        $customers[$user->customer_name] = $user->customer_name;
    }

//  DB::table('count_masters')
// ->where('id','1')
// ->update([
// 'state_count'=>$count,
// ]);

    return view('admin.archive_customer.index',compact('records','customers'));

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

        return view('admin.archive_customer.create',compact('countries'));
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
    $customer_img = "";
}




$user_data = array(
    'name' => $request->input('customer_name'),
    'email' => $request->input('customer_login_email'),
    'password' => bcrypt($request->input('customer_password')),
    'mobile'=>'+'.$request->user_country_code.str_replace(' ','',$request->input('customer_mobile')),
    'role' =>'3',
    'status'=>'Active',

);
$users = new user($user_data);
$users->save();



$data = array(
    'customer_name'=>$request->input('customer_name'),
    'customer_email'=>$request->input('customer_email'),
    'customer_dob'=>$request->input('customer_dob'),
    'customer_gender'=>$request->input('customer_gender'),
    'customer_login_email'=>$request->input('customer_login_email'),
    'customer_password'=>$request->input('customer_password'),
    'customer_country'=>$request->input('customer_country'),
    'customer_state'=>$request->input('customer_state'),
    'customer_city'=>$request->input('customer_city'),
    'customer_locality'=>$request->input('customer_locality'),
    'customer_address'=>$request->input('customer_address'),
    'customer_pincode'=>$request->input('customer_pincode'),
    'customer_mobile'=>'+'.$request->user_country_code.str_replace(' ','',$request->input('customer_mobile')),    
    'customer_phone'=>$request->input('customer_phone'),    
    'customer_img'=>$customer_img,   
    'user_id' =>$users->id,
    'customer_userid'=>'Cust'.$users->id.date('Y'),
    'created_by'=>'Admin',



);
$customer = new customer($data);
$customer->save();



$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/archive-customer')->with($notification);

}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $view='';

       return view('admin.archive_customer.show',compact('view'));
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
        $record = customer::find($id);     

        $countries = DB::table('countries')  
        ->select('country_name','id')
        ->where('status','Active')
        ->orderBy('country_name', 'asc')->pluck('country_name','id'); 




        $states = DB::table('states')
        ->where('states.country_id','=', $record['customer_country'])
        ->where("states.status",'Active')
        ->pluck('states.state_name','states.id');

// dd($states);
        $cities = DB::table('cities')
        ->where('cities.state_id','=', $record['customer_state'])
        ->where("cities.status",'Active')
        ->pluck('cities.city_name','cities.id');


        $localities = DB::table('localities')
        ->where('localities.city_id','=', $record['customer_city'])
        ->where("localities.status",'Active')
        ->pluck('localities.locality_name','localities.id');


        $user_id=$record->user_id;

        
        return view('admin.archive_customer.edit',compact('record','countries','states','cities','localities','user_id'));

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

        $customer = customer::find($id); 


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
        'customer_login_email'=>$request->input('customer_login_email'),
        'customer_password'=>$request->input('customer_password'),
        'customer_country'=>$request->input('customer_country'),
        'customer_state'=>$request->input('customer_state'),
        'customer_city'=>$request->input('customer_city'),
        'customer_locality'=>$request->input('customer_locality'),
        'customer_address'=>$request->input('customer_address'),
        'customer_pincode'=>$request->input('customer_pincode'),    
        'customer_mobile'=>'+'.$request->user_country_code.str_replace(' ','',$request->input('customer_mobile')),    
        'customer_phone'=>$request->input('customer_phone'),    
        'customer_img'=>$customer_img,    
    );

   // dd($data);
    $customer->update($data);


    DB::table('users')
    ->where('id',$customer->user_id)
    ->update(
        [
            'name' => $request->input('customer_name'),
            'email' => $request->input('customer_login_email'),
            'password' => bcrypt($request->input('customer_password')),
            'mobile'=>'+'.$request->user_country_code.str_replace(' ','',$request->input('customer_mobile')),
        ]
    );



    $notification = array(
        'message' => 'Your form was successfully Update!', 
        'alert-type' => 'success'
    );

    return Redirect::to('admin/archive-customer')->with($notification);
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

       $customer = customer::find($request->id);
       $users = user::find($customer->user_id);      

       $customer_address_book = DB::table('customer_address_books')->where('user_id',$customer->user_id)->first();
       $customer_bank_detail = DB::table('customer_bank_details')->where('user_id',$customer->user_id)->first();
       $customer_plan_invoice = DB::table('customer_plan_invoices')->where('user_id',$customer->user_id)->first();
       $customer_purchase_plan = DB::table('customer_purchase_plans')->where('user_id',$customer->user_id)->get();



if (!empty($customer_address_book)) {
    $customer_address_book->delete();
   
}

if (!empty($customer_bank_detail)) {
    $customer_bank_detail->delete();
   
}

if (!empty($customer_plan_invoice)) {
    $customer_plan_invoice->delete();
   
}

if (!empty($customer_purchase_plan)) {
    // $customer_purchase_plan->delete();

      foreach($customer_purchase_plan as $data){

$shop_categorie = DB::table('customer_purchase_plans')->where('id',$data->id)->delete();
   
}

   
}

if (!empty($customer)) {
    $customer->delete();
   
}
if (!empty($users)) {
    $users->delete();
   
}

         //  return $customer;




       return json_encode('Archive');


   }

   public function status_update(Request $request){

       $record=customer::find($request->user_id);

       if($record['status']=='Active'){
         $updatevender=\DB::table('customers')->where('id',$request->user_id)
         ->update([
            'status' => 'Deactive',
        ]);
         return json_encode('Deactive');
     } else {
      $updateuser=\DB::table('customers')->where('id',$request->user_id)
      ->update([
        'status' => 'Active',
                                // 'updated_at' => date('Y-m-d H:i:s') 
    ]);
      return json_encode("Active");

  }
}

public function check_unique_name(Request $request)
{

        // return $request->checkunique_name;

  if(!empty($request->check_unique_name)){

    $record = customer::where('customer_name', $request->check_unique_name)->first();

    if(!empty($record)){
        return "exist";
    }else{
        return "notexist";
    }
}
if(!empty($request->check_unique_name_edit)){

    $record = customer::where('customer_name', $request->check_unique_name_edit)->get();

    if(count($record) <=1){
        return "notexist";
    }else{
        return "exist";
    }
}
}

public function archive_customers_recorver(Request $request){

   $record=customer::find($request->id);

   $updatevender=\DB::table('customers')->where('id',$request->id)
   ->update([
    'status' => 'Active',
]);
   return json_encode('Active');

}

}
