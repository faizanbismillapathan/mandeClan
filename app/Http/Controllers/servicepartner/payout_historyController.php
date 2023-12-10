<?php

namespace App\Http\Controllers\servicepartner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\rv_user_registration;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Toast;


class payout_historyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

  
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

        
return view('servicepartner.payout_history.index');


    }


    


    public function create()
    {
       $record='';

       return view('servicepartner.payout_history.create',compact('record'));
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

       return Redirect::to('servicepartner/payout_history')->with($notification);

   }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       // dd($id);

       return view('servicepartner.payout_history.show',compact('id'));
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
        
        return view('servicepartner.payout_history.edit',compact('record'));

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
        
        $servicepartner = servicepartner::find($id); 


  if($request->hasFile('servicepartner_img'))
  
        {       
     $file = $request->file('servicepartner_img');
     $extension = $request->file('servicepartner_img')->getClientOriginalExtension();
     $servicepartner_img = date('d_m_Y_h_i_s',time()) . '1.' . $extension;

         $destinationPaths = base_path().'/public/images/servicepartner_img';

  $thumb_img =Image::make($file->getRealPath())->orientate()->resize(150, 150);
  
     $thumb_img->save($destinationPaths.'/'.$servicepartner_img,80);


      }       
        else{
            $servicepartner_img = $servicepartner->servicepartner_img;
        }




   $data = array(
'servicepartner_name'=>$request->input('servicepartner_name'),
'servicepartner_email'=>$request->input('servicepartner_email'),
'servicepartner_dob'=>$request->input('servicepartner_dob'),
'servicepartner_gender'=>$request->input('servicepartner_gender'),
// 'servicepartner_login_email'=>$request->input('servicepartner_login_email'),
// 'servicepartner_password'=>$request->input('servicepartner_password'),
'servicepartner_country'=>$request->input('servicepartner_country'),
'servicepartner_state'=>$request->input('servicepartner_state'),
'servicepartner_city'=>$request->input('servicepartner_city'),
'servicepartner_locality'=>$request->input('servicepartner_locality'),
'servicepartner_address'=>$request->input('servicepartner_address'),
'servicepartner_pincode'=>$request->input('servicepartner_pincode'),    
'servicepartner_mobile'=>$request->input('servicepartner_mobile'),    
'servicepartner_phone'=>$request->input('servicepartner_phone'),    
'servicepartner_img'=>$servicepartner_img,    
);

   // dd($data);
         $servicepartner->update($data);

           
              DB::table('users')
         ->where('id',$servicepartner->user_id)
         ->update(
['name' => $request->input('servicepartner_name')]
         );



$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('servicepartner/payout_history')->with($notification);
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
         $updatevender=\DB::table('payout_history')->where('id',$request->user_id)
         ->update([
            'status' => 'Deactive',
        ]);
         return json_encode('Deactive');
     } else {
      $updateuser=\DB::table('payout_history')->where('id',$request->user_id)
      ->update([
        'status' => 'Active',
                                // 'updated_at' => date('Y-m-d H:i:s') 
    ]);
      return json_encode("Active");

  }
}

}

