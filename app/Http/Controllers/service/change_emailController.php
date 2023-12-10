<?php

namespace App\Http\Controllers\service;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\service;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Toast;
use Auth;
use Carbon\Carbon;
 use App\Traits\MailerTraits;

class change_emailController extends Controller
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

          if ( !in_array($uspermit->role, array('1','2'), false ) ) {

// dd('1');
              return redirect()->action('frontend\frontendController@index'); 

          }else{

            if($uspermit->role == '1'  && empty(session::get('store_id'))){

// dd('2');
              return redirect()->action('frontend\frontendController@index'); 

          }

      }if (\Auth::user()->role == "2") {
      $store_id=DB::table('stores')
             ->where('user_id',\Auth::user()->id)
             ->select('id','user_id','status','kyc_status')
             ->first();

             if ($store_id->kyc_status=='deactive') {
                 
              return redirect()->action('frontend\frontendcontroller@index'); 

             }
$this->id=$store_id->id; 
$this->user_id=$store_id->user_id;  

   }elseif (\Auth::user()->role == "1") {

                    $this->id=session::get('store_id');
 
$this->user_id=session::get('store_user_id');
}


return $next($request);
  });

    }

    public function index()
    {


$record=DB::table('users')->where('id',$this->user_id)->first();




        return view('service.change_email.index',compact('record'));
    }


    public function show($id)
    {

        return view('service.change_email.index',compact('record'));
    }


  public function create()
    {
         $record='';

         return view('service.change_email.create',compact('record'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

      public function verify_service_email(Request $request)
    {

  $otp=$request->otp;
  $email=$request->email;

if ($email) {
    
if ($otp==Session::get('email_otp')) {

$users=DB::table('users')->where('id',$this->user_id)
->update([
'email'=>$email,
'email_verified_at'=>Carbon::now()->toDateTimeString(),
]);


$users=DB::table('stores')->where('id',$this->user_id)
->update([
'store_email'=>$email,

]);

     \Auth::logout();

return 'success1';
}else{

return 'error';
    }



}else{

    if ($otp==Session::get('email_otp')) {

return 'success';
}else{

return 'error';
    }

}


}

    public function store(Request $request)
    {
        


$users=DB::table('users')->where('id',$this->user_id)->first();

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


       public function service_update_email(Request $request)
    {

$users=DB::table('users')->where('id',$this->user_id)
->update([
'email'=>$request->store_email,
]);


$users=DB::table('stores')->where('id',$this->user_id)
->update([
'store_email'=>$request->store_email,
]);


$notification = array(
    'message' => 'Your Email was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::back()->with($notification);


    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show1($id)
    {
                 $view='';

        return view('service.change_email.show',compact('view'));
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
        
         return view('service.change_email.edit',compact('record'));

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
        
        $role = role::find($id); 

   $data = array(
    'role_name'=>$request->input('role_name'),
    
);
         $role->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('service/change-email')->with($notification);
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
           }


