<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\vehicle_rate_chart;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;
use Image;
use File;

class vehicle_rate_chartController extends Controller
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
       
        $records=DB::table('vehicle_rate_charts')->orderBy('id','desc');

         if (!empty($request->search)) {
         $term=$request->search;
$records=$records
->where(function($q) use ($term) {
$q
        ->orWhere('vehicle_name','like','%' . $term . '%');
    });
}

         $records= $records
        ->paginate(25);



         $use = DB::table('vehicle_rate_charts')  
                    ->select('vehicle_name','id')        
   
            ->orderBy('vehicle_name', 'asc')->get(); 

 $vehicle_rate_charts = array();
foreach($use as $user) {
$vehicle_rate_charts[$user->vehicle_name] = $user->vehicle_name;
}



return view('admin.vehicle_rate_chart.index',compact('records','vehicle_rate_charts'));
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


         $autoincid = mt_rand(10,100);
         $Y = date('Ys');
         $keydata = 'VeRatChart'.$Y.''.$autoincid;


 $vehicle_types = DB::table('vehicle_types')  
                    ->select('vehicle_name','id')
                     ->where('status','Active')
            ->orderBy('vehicle_name', 'asc')->pluck('vehicle_name','id'); 


// dd($vehicle_types);
         return view('admin.vehicle_rate_chart.create',compact('keydata','vehicle_types'));
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
'vehicle_rate_chart_id'=>$request->input('vehicle_rate_chart_id'),
'package_name'=>$request->input('package_name'),
'vehicle_name'=>$request->input('vehicle_name'),
'vehicle_wheel'=>$request->input('vehicle_wheel'),
'vehicle_fuel'=>$request->input('vehicle_fuel'),
'vehicle_time_slote'=>$request->input('vehicle_time_slote'),
'vehicle_hourly_price'=>$request->input('vehicle_hourly_price'),
'vehicle_daily_price'=>$request->input('vehicle_daily_price'),
'vehicle_monthly_price'=>$request->input('vehicle_monthly_price'),
'vehicle_weekly_price'=>$request->input('vehicle_weekly_price'),

);
         $vehicle_rate_chart = new vehicle_rate_chart($data);
         $vehicle_rate_chart->save();
                 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/vehicle-rate-chart')->with($notification);

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

        return view('admin.vehicle_rate_chart.show',compact('view'));
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
        $record = vehicle_rate_chart::find($id);         
        

 $vehicle_types = DB::table('vehicle_types')  
                    ->select('vehicle_name','id')
                     ->where('status','Active')
            ->orderBy('vehicle_name', 'asc')->pluck('vehicle_name','id'); 


  $vehicle_wheels =\DB::table('vehicle_types')
                       ->where("vehicle_types.id",$record->vehicle_name)
                      ->pluck('vehicle_types.vehicle_no_of_wheel','vehicle_types.vehicle_no_of_wheel');


//       $disticts =\DB::table('vehicle_types')
//                        ->where("vehicle_types.id",3)
//                        ->where("vehicle_types.status",'Active')
//                       ->pluck('vehicle_types.vehicle_no_of_wheel','vehicle_types.vehicle_fuel');

// dd($disticts);

//   $types =\DB::table('vehicle_types')
//                       ->select('vehicle_types.vehicle_no_of_wheel','vehicle_types.vehicle_fuel','id')
//                       ->groupby('id')->get();

             
//  $arrr = array();
// foreach($types as $typess) {
// $arrr[$typess->vehicle_no_of_wheel] = $typess->vehicle_no_of_wheel;
// $arrr[$typess->vehicle_fuel] = $typess->vehicle_fuel;

// }

// dd($arrr);
         return view('admin.vehicle_rate_chart.edit',compact('record','vehicle_types','vehicle_wheels'));

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
        
        $vehicle_rate_chart = vehicle_rate_chart::find($id); 


$data = array(
'vehicle_rate_chart_id'=>$request->input('vehicle_rate_chart_id'),
'package_name'=>$request->input('package_name'),
'vehicle_name'=>$request->input('vehicle_name'),
'vehicle_wheel'=>$request->input('vehicle_wheel'),
'vehicle_fuel'=>$request->input('vehicle_fuel'),
'vehicle_time_slote'=>$request->input('vehicle_time_slote'),
'vehicle_hourly_price'=>$request->input('vehicle_hourly_price'),
'vehicle_daily_price'=>$request->input('vehicle_daily_price'),
'vehicle_monthly_price'=>$request->input('vehicle_monthly_price'),
'vehicle_weekly_price'=>$request->input('vehicle_weekly_price'),

);
         $vehicle_rate_chart->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/vehicle-rate-chart')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
         $vehicle_rate_chart = vehicle_rate_chart::find($request->id);
          $vehicle_rate_chart->delete();

          return $vehicle_rate_chart;
    }

     public function status_update(Request $request){
 
         $record=vehicle_rate_chart::find($request->user_id);
      
          if($record['status']=='Active'){
               $updatevender=\DB::table('vehicle_rate_charts')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);
            return json_encode('Deactive');
           } else {
              $updateuser=\DB::table('vehicle_rate_charts')->where('id',$request->user_id)
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

        $record = vehicle_rate_chart::where('vehicle_name', $request->check_unique_name)->first();

         if(!empty($record)){
            return "exist";
         }else{
            return "notexist";
         }
      }
      if(!empty($request->check_unique_name_edit)){

        $record = vehicle_rate_chart::where('vehicle_name', $request->check_unique_name_edit)->get();

         if(count($record) <=1){
            return "notexist";
         }else{
            return "exist";
         }
      }
  }


   public function append_vehicle_type(Request $request)
    {
 $stateId= $request->id;
         $disticts =\DB::table('vehicle_types')
                       ->where("vehicle_types.id",$stateId)
                       ->where("vehicle_types.status",'Active')
                      ->pluck('vehicle_types.vehicle_no_of_wheel','vehicle_types.vehicle_fuel');
                      
        return json_encode($disticts);
    

    }

}
