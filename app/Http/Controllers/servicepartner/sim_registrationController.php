<?php

namespace App\Http\Controllers\servicepartner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\sim_registration;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Toast;
use Auth;

class sim_registrationController extends Controller
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

 $record = sim_registration::where('user_id',$this->user_id)->first();         

return view('servicepartner.sim_registration.index',compact('record'));


    }


    


    public function create()
    {
       $record='';

       return view('servicepartner.sim_registration.create',compact('record'));
   }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
       $data = array(
        'sim_slot_index'=>$request->input('sim_slot_index'),
        'sim_carrier_name'=>$request->input('sim_carrier_name'),
        'sim_imei_code'=>$request->input('sim_imei_code'),
        'sim_serial_name'=>$request->input('sim_serial_name'),
        'sim_phone_name'=>$request->input('sim_phone_name'),
        'sim_mobile_name'=>$request->input('sim_mobile_name'),
'user_id'=>$this->user_id,
    );
       $sim_registration = new sim_registration($data);
       $sim_registration->save();
       


       $notification = array(
        'message' => 'Your form was successfully submit!', 
        'alert-type' => 'success'
    );

       return Redirect::to('service-partner/sim-registration')->with($notification);

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

       return view('servicepartner.sim_registration.show',compact('view'));
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
        $record = sim_registration::find($id);         
        
        return view('servicepartner.sim_registration.edit',compact('record'));

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
        
        $sim_registration = sim_registration::find($id); 

 $data = array(
        'sim_slot_index'=>$request->input('sim_slot_index'),
        'sim_carrier_name'=>$request->input('sim_carrier_name'),
        'sim_imei_code'=>$request->input('sim_imei_code'),
        'sim_serial_name'=>$request->input('sim_serial_name'),
        'sim_phone_name'=>$request->input('sim_phone_name'),
        'sim_mobile_name'=>$request->input('sim_mobile_name'),
        'user_id'=>$this->user_id,

    );

         $sim_registration->update($data);

           
        
$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('service-partner/sim-registration')->with($notification);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
 

}

