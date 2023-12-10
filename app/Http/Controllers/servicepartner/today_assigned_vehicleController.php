<?php

namespace App\Http\Controllers\servicepartner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\rv_user_registration;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Toast;


class today_assigned_vehicleController extends Controller
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

        
          $vehicle_record=DB::table('vehicle_masters')->where('assign_rv_id',$this->id)
             ->orderBy('id','desc')

          ->first();




return view('servicepartner.today_assigned_vehicle.index',compact('vehicle_record'));


    }


    


    public function create()
    {
       $record='';

       return view('servicepartner.today_assigned_vehicle.create',compact('record'));
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

       return Redirect::to('servicepartner/today_assigned_vehicle')->with($notification);

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

       return view('servicepartner.today_assigned_vehicle.show',compact('view'));
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
        
        return view('servicepartner.today_assigned_vehicle.edit',compact('record'));

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
      


$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('servicepartner/today_assigned_vehicle')->with($notification);
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
         $updatevender=\DB::table('today_assigned_vehicle')->where('id',$request->user_id)
         ->update([
            'status' => 'Deactive',
        ]);
         return json_encode('Deactive');
     } else {
      $updateuser=\DB::table('today_assigned_vehicle')->where('id',$request->user_id)
      ->update([
        'status' => 'Active',
                                // 'updated_at' => date('Y-m-d H:i:s') 
    ]);
      return json_encode("Active");

  }
}

}

