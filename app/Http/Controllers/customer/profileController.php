<?php

namespace App\Http\Controllers\customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\customer;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Toast;
use App\User;
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

// dd(!in_array($uspermit->role, array(1,2)));

          if ( !in_array($uspermit->role, array('1','3'), false ) ) {

// dd('1');
              return redirect()->action('frontend\frontendController@index'); 

          }else{

            if($uspermit->role == '1' && empty(Session::get('customer_id'))){

// dd('2');
              return redirect()->action('frontend\frontendController@index'); 

          }

      }
 

   if (\Auth::user()->role == "3") {
      $customer_id=DB::table('customers')
             ->where('user_id',\Auth::user()->id)
             ->select('id','user_id')
             ->first();

            $this->id=$customer_id->id; 
$this->user_id=$customer_id->user_id;  

   }elseif (\Auth::user()->role == "1") {

                    $this->id=session::get('customer_id');
 $this->user_id=session::get('customer_user_id');
}



        if (\auth::user()->role == "3") {
      $customer_id=db::table('customers')
             ->where('user_id',\auth::user()->id)
             ->select('id','user_id')
             ->first();

            $this->id=$customer_id->id; 
$this->user_id=$customer_id->user_id;  

   }elseif (\auth::user()->role == "1") {

                    $this->id=session::get('customer_id');
 $this->user_id=session::get('customer_user_id');
}


      return $next($request);
  });


    }


    public function index()
    {

        // dd($id);
        $record = customer::find($this->id);     

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
              // ->where("cities.status",'Active')
            ->pluck('cities.city_name','cities.id');


             $localities = DB::table('localities')
             ->where('localities.city_id','=', $record['customer_city'])
              ->where("localities.status",'Active')
            ->pluck('localities.locality_name','localities.id');

$user_id=$this->user_id;

//             $record = User::where('email', 'zareena2086@gmail.com')->where('id','<>',$user_id)->first();
        $users = user::find($user_id);         

// dd($record);
         return view('customer.profile.index',compact('record','countries','states','cities','localities','user_id','users'));


    }


    


    public function create()
    {
       $record='';

       return view('customer.profile.create',compact('record'));
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
       $data = array(
        'role_name'=>$request->input('role_name'),
        
    );
       $role = new role($data);
       $role->save();
       


       $notification = array(
        'message' => 'Your form was successfully submit!', 
        'alert-type' => 'success'
    );

       return Redirect::to('customer/profile')->with($notification);

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

       return view('customer.profile.show',compact('view'));
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
        $record = role::find($id);         
        
        return view('customer.profile.edit',compact('record'));

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
        // dd($request->input('customer_mobile'));
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

    DB::table('users')
         ->where('id',$customer->user_id)
         ->update(
[
    'name' => $request->input('customer_name'),
    // 'email' => $request->input('customer_login_email'),
    // 'password' => bcrypt($request->input('customer_password')),
    // 'mobile'=>'+'.$request->user_country_code.str_replace(' ','',$request->input('customer_mobile')),
]
         );



$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('customer/profile')->with($notification);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
       $role = role::find($request->id);
       $role->delete();

       return $role;
   }


 public function status_update(Request $request){
 
         $record=customer::find($this->id);
      
          if($record['status']=='Active'){
               $updatevender=\DB::table('customers')->where('id',$this->id)
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
              $updateuser=\DB::table('customers')->where('id',$this->id)
                              ->update([
                                'status' => 'Active',
                                 ]);

                         $updatevender=\DB::table('users')->where('id',$record->id)
                              ->update([
                                'status' => 'Active',
                                 ]);


// \Auth::logout();


return Redirect::back();

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

