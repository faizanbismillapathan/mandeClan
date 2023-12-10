<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\vehicle_type;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;
use Image;
use File;

class vehicle_typeController extends Controller
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
       
        $records=DB::table('vehicle_types')->orderBy('id','desc');

         if (!empty($request->search)) {
        $term=$request->search;
$records=$records
->where(function($q) use ($term) {
$q
->orWhere('vehicle_unique_id','like','%' . $term . '%')
->orWhere('vehicle_name','like','%' . $term . '%')
->orWhere('vehicle_no_of_wheel','like','%' . $term . '%')
->orWhere('vehicle_fuel','like','%' . $term . '%')
->orWhere('vehicle_license_name','like','%' . $term . '%')
 ->orWhere('vehicle_name','like','%' . $term . '%');
});
}

         $records= $records
        ->paginate(25);



         $use = DB::table('vehicle_types')  
                    ->select('vehicle_name','id')        
   
            ->orderBy('vehicle_name', 'asc')->get(); 

 $vehicle_types = array();
foreach($use as $user) {
$vehicle_types[$user->vehicle_name] = $user->vehicle_name;
}

//  DB::table('count_masters')
// ->where('id','1')
// ->update([
// 'state_count'=>$count,
// ]);

return view('admin.vehicle_type.index',compact('records','vehicle_types'));
   
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
         $keydata = 'Vehicle'.$Y.''.$autoincid;


$vehicle_license = DB::table('driving_licenses')  
                    ->select('driving_license_name','id')
                     ->where('status','Active')
            ->orderBy('driving_license_name', 'asc')->pluck('driving_license_name','driving_license_name'); 


         return view('admin.vehicle_type.create',compact('keydata','vehicle_license'));
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


        if($request->hasFile('vehicle_image'))
  
        {       
     $file = $request->file('vehicle_image');
     $extension = $request->file('vehicle_image')->getClientOriginalExtension();
     $vehicle_image = date('d_m_Y_h_i_s',time()) . '1.' . $extension;

         $destinationPaths = base_path().'/public/images/vehicle_image';

  $thumb_img =Image::make($file->getRealPath())->orientate()->resize(100, 100);
  
     $thumb_img->save($destinationPaths.'/'.$vehicle_image,80);


      }       
        else{
            $vehicle_image = "";
        }



         $data = array(
    'vehicle_name'=>$request->input('vehicle_name'),
    'vehicle_no_of_wheel'=>$request->input('vehicle_no_of_wheel'),
    'vehicle_unique_id'=>$request->input('vehicle_unique_id'),
    'vehicle_image'=>$vehicle_image,
    'vehicle_fuel'=>$request->input('vehicle_fuel'),
        'vehicle_license_name'=>$request->input('vehicle_license_name'),

);
         $vehicle_type = new vehicle_type($data);
         $vehicle_type->save();
                 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/vehicle-type')->with($notification);

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

        return view('admin.vehicle_type.show',compact('view'));
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
        $record = vehicle_type::find($id);         
        

$vehicle_license = DB::table('driving_licenses')  
                    ->select('driving_license_name','id')
                     ->where('status','Active')
            ->orderBy('driving_license_name', 'asc')->pluck('driving_license_name','driving_license_name'); 


         return view('admin.vehicle_type.edit',compact('record','vehicle_license'));

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
        
        $vehicle_type = vehicle_type::find($id); 


        if($request->hasFile('vehicle_image'))
  
        {       
     $file = $request->file('vehicle_image');
     $extension = $request->file('vehicle_image')->getClientOriginalExtension();
     $vehicle_image = date('d_m_Y_h_i_s',time()) . '1.' . $extension;

         $destinationPaths = base_path().'/public/images/vehicle_image';

  $thumb_img =Image::make($file->getRealPath())->orientate()->resize(100, 100);
  
     $thumb_img->save($destinationPaths.'/'.$vehicle_image,80);


      }       
        else{
            $vehicle_image = $vehicle_type->vehicle_image;
        }


     $data = array(
    'vehicle_name'=>$request->input('vehicle_name'),
    'vehicle_no_of_wheel'=>$request->input('vehicle_no_of_wheel'),
    // 'vehicle_unique_id'=>$request->input('vehicle_unique_id'),
    'vehicle_image'=>$vehicle_image,
    'vehicle_fuel'=>$request->input('vehicle_fuel'),
        'vehicle_license_name'=>$request->input('vehicle_license_name'),

);
         $vehicle_type->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/vehicle-type')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
         $vehicle_type = vehicle_type::find($request->id);
          $vehicle_type->delete();

          return $vehicle_type;
    }

     public function status_update(Request $request){
 
         $record=vehicle_type::find($request->user_id);
      
          if($record['status']=='Active'){
               $updatevender=\DB::table('vehicle_types')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);
            return json_encode('Deactive');
           } else {
              $updateuser=\DB::table('vehicle_types')->where('id',$request->user_id)
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

        $record = vehicle_type::where('vehicle_name', $request->check_unique_name)->first();

         if(!empty($record)){
            return "exist";
         }else{
            return "notexist";
         }
      }
      if(!empty($request->check_unique_name_edit)){

        $record = vehicle_type::where('vehicle_name', $request->check_unique_name_edit)->get();

         if(count($record) <=1){
            return "notexist";
         }else{
            return "exist";
         }
      }
  }
}
