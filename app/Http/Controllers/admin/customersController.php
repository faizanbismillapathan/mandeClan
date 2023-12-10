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

class customersController extends Controller
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
                  ->join('users','customers.user_id','users.id')

        ->orderBy('customers.id','desc');

         if (!empty($request->search)) {
         $term=$request->search;
$records=$records
->where(function($q) use ($term) {
$q
        ->orWhere('customers.customer_name','like','%' . $term . '%');
    });
}

         $records= $records
         ->select('countries.country_name','cities.city_name','customers.*','users.email_verified_at','users.status as user_status')
         ->where('customers.status','<>','Archive')

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

return view('admin.customers.index',compact('records','customers'));
   
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

         return view('admin.customers.create',compact('countries'));
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

return Redirect::to('admin/customers')->with($notification);

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

        return view('admin.customers.show',compact('view'));
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
         $pass = Customer::where('id', $id)->value('customer_password');

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
        $users = user::find($user_id);         

        
         return view('admin.customers.edit',compact('record','countries','pass' ,'states','cities','localities','user_id','users'));

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


$users = user::find($customer->user_id);         

if ($users->status !='Default') {

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

}else{

$data = array(
'customer_name'=>$request->input('customer_name'),
'customer_email'=>$request->input('customer_email'),
'customer_dob'=>$request->input('customer_dob'),
'customer_gender'=>$request->input('customer_gender'),
// 'customer_login_email'=>$request->input('customer_login_email'),
// 'customer_password'=>$request->input('customer_password'),
'customer_country'=>$request->input('customer_country'),
'customer_state'=>$request->input('customer_state'),
'customer_city'=>$request->input('customer_city'),
'customer_locality'=>$request->input('customer_locality'),
'customer_address'=>$request->input('customer_address'),
'customer_pincode'=>$request->input('customer_pincode'),    
// 'customer_mobile'=>'+'.$request->user_country_code.str_replace(' ','',$request->input('customer_mobile')),    
'customer_phone'=>$request->input('customer_phone'),    
'customer_img'=>$customer_img,    
);

   // dd($data);
         $customer->update($data);
    
}

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/customers')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
         // $customer = customer::find($request->id);
         //  $users = user::find($customer->user_id);      
         //  $users->delete();
         //  $customer->delete();
         //  return $customer;


  $record=customer::find($request->id);

       $updatevender=\DB::table('customers')->where('id',$request->id)
                      ->update([
                        'status' => 'Archive',
'status_date'=>Carbon::now()->toDateString(),
'status_created_by'=>'Admin',
                         ]);


                      $updatevender=\DB::table('users')->where('id',$record->user_id)
->update([
'status' => 'Archive',
]);


user_account_delete::Insert([
'user_id' => $record->user_id,
'status_reason' => $request->status_reason,
'status_comment' => $request->status_comment,
'status' => 'Archive',

]);


    return json_encode('Archive');


    }

     public function status_update(Request $request){
 
         $record=customer::find($request->user_id);
      
          if($record['status']=='Active'){
               $updatevender=\DB::table('customers')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);

                      $updatevender=\DB::table('users')->where('id',$record->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);


            return json_encode('Deactive');

           } else {
            
              $updateuser=\DB::table('customers')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Active',
                                 ]);

                                $updatevender=\DB::table('users')->where('id',$record->user_id)
                              ->update([
                                'status' => 'Active',
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
}
