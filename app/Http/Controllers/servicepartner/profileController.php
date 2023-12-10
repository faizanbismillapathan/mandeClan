<?php

namespace App\Http\Controllers\servicepartner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\rv_user_registration;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Toast;
use Image;
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

// dd(!in_array($uspermit->role, array(1,2)));

          if ( !in_array($uspermit->role, array('1','4'), false ) ) {

// dd('1');
              return redirect()->action('frontend\frontendController@index'); 

          }else{

            if($uspermit->role == '1' && empty(Session::get('servicepartner_id'))){

// dd('2');
              return redirect()->action('frontend\frontendController@index'); 

          }

      }
 


        if (\auth::user()->role == "4") {
      $servicepartner_id=db::table('rv_user_registrations')
             ->where('user_id',\Auth::user()->id)
             ->select('id','user_id')
             ->first();

            $this->id=$servicepartner_id->id; 
$this->user_id=$servicepartner_id->user_id;  

   }elseif (\auth::user()->role == "1") {

                    $this->id=session::get('servicepartner_id');
 $this->user_id=session::get('servicepartner_user_id');
}


      return $next($request);
  });


    }


    public function index()
    {

        // dd($id);
       $record = rv_user_registration::find($this->id);     

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


$user_id=$this->user_id;
                        $users = user::find($record->user_id);         

         return view('servicepartner.profile.index',compact('record','countries','states','cities','localities','user_id','users'));


    }


    


    public function create()
    {
       $record='';

       return view('servicepartner.profile.create',compact('record'));
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

       return Redirect::to('service-partner/profile')->with($notification);

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

       return view('servicepartner.profile.show',compact('view'));
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
        
        return view('servicepartner.profile.edit',compact('record'));

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
// dd($request);

$rv_user_registration = rv_user_registration::find($id); 


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

$users = user::find($rv_user_registration->user_id);         

if ($users->status !='Default') {
    
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
'rv_user_mobile'=>'+'.$request->user_country_code.str_replace(' ','',$request->input('rv_user_mobile')),    
'rv_user_phone'=>$request->input('rv_user_phone'),    
'rv_user_img'=>$rv_user_img,     
'rv_user_type'=>$type,    
'rv_user_password'=>$request->input('rv_user_password'),    
'rv_user_login_email'=>$request->input('rv_user_login_email'),    

);

// dd($data);
 $rv_user_registration->update($data);

   
      DB::table('users')
 ->where('id',$rv_user_registration->user_id)
 ->update(
[
    'name' => $request->rv_user_name,
'email' => $request->rv_user_login_email,
'password' => bcrypt($request->rv_user_password),
'mobile'=>'+'.$request->user_country_code.str_replace(' ','',$request->input('rv_user_mobile')),  
]
 );

// code...
}else{

    
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
// 'rv_user_mobile'=>'+'.$request->user_country_code.str_replace(' ','',$request->input('rv_user_mobile')),    
'rv_user_phone'=>$request->input('rv_user_phone'),    
'rv_user_img'=>$rv_user_img,     
'rv_user_type'=>$type,    
// 'rv_user_password'=>$request->input('rv_user_password'),    
// 'rv_user_login_email'=>$request->input('rv_user_login_email'),    

);

// dd($data);
 $rv_user_registration->update($data);

   
     
}

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('service-partner/profile')->with($notification);
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
       
       $record=role::find($request->user_id);
       
       if($record['status']=='Active'){
         $updatevender=\DB::table('profile')->where('id',$request->user_id)
         ->update([
            'status' => 'Deactive',
        ]);
         return json_encode('Deactive');
     } else {
      $updateuser=\DB::table('profile')->where('id',$request->user_id)
      ->update([
        'status' => 'Active',
                                // 'updated_at' => date('Y-m-d H:i:s') 
    ]);
      return json_encode("Active");

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

