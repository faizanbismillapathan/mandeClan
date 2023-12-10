<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\user;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;
use App\store;
use App\customer;
use App\rv_user_registration;


class default_credentialController extends Controller
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
       
        $records=DB::table('users')->orderBy('id','asc');

         if (!empty($request->search)) {
         $term=$request->search;
$records=$records
->where(function($q) use ($term) {
$q
        ->orWhere('mobile','like','%' . $term . '%');
    });
}

         $records= $records
         ->where('status','Default')
        ->paginate(25);



         


return view('admin.default_credential.index',compact('records'));
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $record='';

         return view('admin.default_credential.create',compact('record'));
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
  'role'=>$request->input('role'),
    'mobile'=>$request->input('mobile'),
    'otp'=>$request->input('otp'),    
    'name'=>$request->input('name'),    

);
         $default_credential = new default_credential($data);
         $default_credential->save();
                 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/default-credential')->with($notification);

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

        return view('admin.default_credential.show',compact('view'));
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
        $record = default_credential::find($id);         
        
         return view('admin.default_credential.edit',compact('record'));

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
        
        $user = user::find($id); 

//
   $data = array(
'mobile'=>$request->input('mobile'),
'password'=>$request->input('password'),    
);

 // dd($data);


         $user->update($data);

           

if ($user->role==2) {
   
    $store = store::where('user_id',$id)->first(); 

   $data = array(
'store_mobile'=>$request->input('mobile'),
'store_password'=>$request->input('password'),    
);
         $store->update($data);


}else if ($user->role==3) {
   
    $customer = customer::where('user_id',$id)->first(); 

   $data = array(
'customer_mobile'=>'+'.$request->user_country_code.str_replace(' ','',$request->input('mobile')),
'customer_password'=>$request->input('password'),    
);
         $customer->update($data);


}
    else if ($user->role==4) {
   
    $rv_user_registration = rv_user_registration::where('user_id',$id)->first(); 

   $data = array(
'rv_user_mobile'=>$request->input('mobile'),
'rv_user_password'=>$request->input('password'),    
);
         $rv_user_registration->update($data);


}
     
       





$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/default-credential')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
         $default_credential = default_credential::find($request->id);
          $default_credential->delete();

          return $default_credential;
    }

   

  
}
