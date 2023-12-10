<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\vehicle_master;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;
use App\assign_vehicle_to_rider;

class assigned_vehicleController extends Controller
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

      $records=DB::table('vehicle_masters')

      ->orderBy('vehicle_masters.id','desc');

      if (!empty($request->search)) {
         $term=$request->search;
$records=$records
->where(function($q) use ($term) {
$q
->orWhere('vehicle_masters.vehicle_unique_id','like','%' . $term . '%')
->orWhere('vehicle_masters.vehicle_type','like','%' . $term . '%')
->orWhere('vehicle_masters.vehicle_userid','like','%' . $term . '%')
->orWhere('vehicle_masters.vehicle_driving_location','like','%' . $term . '%')
->orWhere('vehicle_masters.vehicle_package','like','%' . $term . '%')

->orWhere('vehicle_masters.vehicle_name','like','%' . $term . '%');
});
     }

     $records= $records
     ->paginate(25);

// dd($records);

     return view('admin.assigned_vehicle.index',compact('records'));

 }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $record='';

       return view('admin.assigned_vehicle.create',compact('record'));
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
        'assigned_vehicle_name'=>$request->input('assigned_vehicle_name'),

    );
       $assigned_vehicle = new assigned_vehicle($data);
       $assigned_vehicle->save();



       $notification = array(
        'message' => 'Your form was successfully submit!', 
        'alert-type' => 'success'
    );

       return Redirect::to('admin/assigned_vehicle')->with($notification);

   }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

      $vehicle_record=DB::table('vehicle_masters')
      ->where('id',$id)->first();

      $license=DB::table('vehicle_types')
      ->where('vehicle_name',$vehicle_record->vehicle_type)->select('vehicle_license_name')->first();


  $rider_records=DB::table('rider_masters')
  ->join('rv_user_registrations','rv_user_registrations.id','rider_masters.rider_id')
  ->join('cities','cities.id','rv_user_registrations.rv_user_city')
  // ->where('rider_masters.rider_availability','Available')
  ->where('rider_masters.driving_license_type','like','%' . $license->vehicle_license_name . '%')
  ->where('rider_masters.status','Active')
  ->select('rider_masters.id','rv_user_registrations.rv_user_name','rv_user_registrations.rv_user_userid','rv_user_registrations.rv_user_city','rider_masters.driving_license_type','rider_masters.rider_driving_expiry_date','rv_user_registrations.id as rv_id','rv_user_registrations.rv_user_userid','cities.city_name','rider_masters.rider_plan_id','rider_masters.rider_availability')
  ->groupBy('rider_masters.id')->get();

// dd($license->vehicle_license_name);

      return view('admin.assigned_vehicle.create',compact('vehicle_record','rider_records'));

  }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $vehicle_record=DB::table('vehicle_masters')
      ->where('id',$id)->first();

    $license=DB::table('vehicle_types')
  ->where('vehicle_name',$vehicle_record->vehicle_type)->select('vehicle_license_name')->first();


      $rider_records=DB::table('rider_masters')
      ->join('rv_user_registrations','rv_user_registrations.id','rider_masters.rider_id')
      ->join('cities','cities.id','rv_user_registrations.rv_user_city')
      // ->where('rider_masters.rider_availability','Available')
      ->where('rider_masters.driving_license_type','like','%' . $license->vehicle_license_name . '%')
      ->where('rider_masters.status','Active')->select('rider_masters.id','rv_user_registrations.rv_user_name','rv_user_registrations.rv_user_userid','rv_user_registrations.rv_user_city','rider_masters.driving_license_type','rider_masters.rider_driving_expiry_date','rv_user_registrations.id as rv_id','rv_user_registrations.rv_user_userid','cities.city_name','rider_masters.rider_plan_id','rider_masters.rider_availability')
      ->groupBy('rider_masters.id')->get();

// dd($rider_records);
      return view('admin.assigned_vehicle.edit',compact('vehicle_record','rider_records'));

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

        $assigned_vehicle = assigned_vehicle::find($id); 

        $data = array(
            'assigned_vehicle_name'=>$request->input('assigned_vehicle_name'),

        );
        $assigned_vehicle->update($data);



        $notification = array(
            'message' => 'Your form was successfully Update!', 
            'alert-type' => 'success'
        );

        return Redirect::to('admin/assigned_vehicle')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

       $assigned_vehicle = assigned_vehicle::find($request->id);
       $assigned_vehicle->delete();

       return $assigned_vehicle;
   }

   public function status_update(Request $request){

       $record=assigned_vehicle::find($request->user_id);

       if($record['status']=='Active'){
         $updatevender=\DB::table('assigned_vehicles')->where('id',$request->user_id)
         ->update([
            'status' => 'Deactive',
        ]);
         return json_encode('Deactive');
     } else {
      $updateuser=\DB::table('assigned_vehicles')->where('id',$request->user_id)
      ->update([
        'status' => 'Active',
                                // 'updated_at' => date('Y-m-d H:i:s') 
    ]);
      return json_encode("Active");

  }
}


public function assigned_vehicle_to_rider(Request $request){

    $check=\DB::table('rider_masters')->where('id',$request->rider_id)->first();



if ($check->rider_availability ==  'Available') {

     $record=vehicle_master::find($request->vehicle_id);


$data = array(
            'vehicle_id'=>$request->vehicle_id,
        'vehicle_owner_id'=>$record->vehicle_owner_id,
        'rider_id'=>$request->rider_id,
        'rider_availability'=>'Not Available',
        'assign_rv_id'=>$request->rv_id,
        'assign_vehicle_u_id'=>$request->rider_u_id,
        'rider_plan_id'=>$request->rider_plan_id,
        'vehicle_plan_id'=>$record->vehicle_package,

    );
       $assign_vehicle_to_rider = new assign_vehicle_to_rider($data);
       $assign_vehicle_to_rider->save();




   $updatevender=\DB::table('vehicle_masters')->where('id',$request->vehicle_id)
   ->update([
      'vehicle_availability' => 'Not Available',
    'assign_rv_id'=>$request->rv_id,
    'assign_rider_u_id'=>$request->rider_u_id,
    'assign_rider_id'=>$request->rider_id,
]);


    $updatevender=\DB::table('rider_masters')->where('id',$request->rider_id)
   ->update([
    'rider_availability' => 'Not Available',
  
]);

      return json_encode('Not Available');

}else{


   $record=vehicle_master::find($request->vehicle_id);



$data = array(
            'vehicle_id'=>$request->vehicle_id,
        'vehicle_owner_id'=>$record->vehicle_owner_id,
        'rider_id'=>$request->rider_id,
        'rider_availability'=>'Available',
        'assign_rv_id'=>$request->rv_id,
        'assign_vehicle_u_id'=>$request->rider_u_id,

    );
       // $assigned_vehicle = new assigned_vehicle($data);
       // $assigned_vehicle->save();

 $updatevender=\DB::table('assign_vehicle_to_riders')->where('id',$request->assign_vehicle_id)
  ->update($data);

   $updatevender=\DB::table('vehicle_masters')->where('id',$request->vehicle_id)
   ->update([
    'assign_rv_id'=>$request->rv_id,
    'assign_rider_u_id'=>$request->rider_u_id,
    'assign_rider_id'=>$request->rider_id,
        'vehicle_availability' => 'Available',

]);



    $updatevender=\DB::table('rider_masters')->where('id',$request->rider_id)
   ->update([
    'rider_availability' => 'Available',
  
]);

      return json_encode('Available');

}


}



// public function unassigned_vehicle_to_rider(Request $request){

//       return json_encode("Active");

 
//       return json_encode("Active");

// }

public function check_unique_name(Request $request)
{

        // return $request->checkunique_name;

  if(!empty($request->check_unique_name)){

    $record = assigned_vehicle::where('assigned_vehicle_name', $request->check_unique_name)->first();

    if(!empty($record)){
        return "exist";
    }else{
        return "notexist";
    }
}
if(!empty($request->check_unique_name_edit)){

    $record = assigned_vehicle::where('assigned_vehicle_name', $request->check_unique_name_edit)->get();

    if(count($record) <=1){
        return "notexist";
    }else{
        return "exist";
    }
}

      return json_encode("Active");

}
}
