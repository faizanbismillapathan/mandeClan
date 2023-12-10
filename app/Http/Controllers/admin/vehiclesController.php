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
use Image;
use File;
use App\user;
use App\rv_user_registration;

class vehiclesController extends Controller
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
->orWhere('vehicle_masters.vehicle_userid','like','%' . $term . '%')
->orWhere('vehicle_masters.vehicle_type','like','%' . $term . '%')
->orWhere('vehicle_masters.vehicle_no','like','%' . $term . '%')
->orWhere('vehicle_masters.vehicle_modal_no','like','%' . $term . '%')
->orWhere('vehicle_masters.vehicle_unique_id','like','%' . $term . '%')
->orWhere('vehicle_masters.insurance_expiry_date','like','%' . $term . '%')
->orWhere('vehicle_masters.vehicle_package','like','%' . $term . '%')
->orWhere('vehicle_masters.vehicle_package_for','like','%' . $term . '%')
->orWhere('vehicle_masters.status','like','%' . $term . '%');
});
       }

       $records= $records
       ->paginate(25);



       $use = DB::table('vehicle_masters')  
       ->select('vehicle_name','id')        

       ->orderBy('vehicle_name', 'asc')->get(); 

       $vehicle_masters = array();
       foreach($use as $user) {
        $vehicle_masters[$user->vehicle_name] = $user->vehicle_name;
    }



    return view('admin.vehicles.index',compact('records','vehicle_masters'));

}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {



        $record='';
        $new_msg='';
        $records=[];

        if (!empty($request->search)) {

           $record=DB::table('rv_user_registrations')
           ->join('countries','countries.id','rv_user_registrations.rv_user_country')
           ->join('states','states.id','rv_user_registrations.rv_user_state')
           ->join('cities','cities.id','rv_user_registrations.rv_user_city')
           ->join('localities','localities.id','rv_user_registrations.rv_user_locality')

           ->orderBy('rv_user_registrations.id','desc')

       ->Where('rv_user_registrations.rv_user_userid',$request->search)

           ->select('countries.country_name','cities.city_name','states.state_name','localities.locality_name','rv_user_registrations.*')
         ->where('rv_user_type','like','%' . 'Vehicle' . '%')
           ->first();


if (!empty($record)) {
    
$records=DB::table('vehicle_masters')
->where('vehicle_owner_id',$record->id)->get();

}


}


       $locations = DB::table('cities')  
       ->join('countries','countries.id','cities.country_id')
       ->select('cities.city_name','cities.id')   
       ->where('countries.country_name','UNITED STATES')   
       ->orderBy('cities.id', 'asc')
       // ->limit('10')
              ->where('cities.status','Active') 
 
       ->pluck('cities.city_name','cities.city_name');


 $vehicle_names = DB::table('vehicle_types')  
       ->select('vehicle_name','id')      
       ->orderBy('vehicle_name', 'asc')->pluck('vehicle_name','vehicle_name');

 $package_names = DB::table('vehicle_rate_charts')  
       ->select('package_name','id')      
       ->orderBy('package_name', 'asc')->pluck('package_name','package_name');




        return view('admin.vehicles.create',compact('record','new_msg','vehicle_names','package_names','records','locations'));
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
$record= rv_user_registration::find($request->id);

// dd($record);
        $check=DB::table('vehicle_masters')
        ->where('vehicle_userid',$record->vehicle_userid)
        ->first();



 if($request->hasFile('vehicle_front_img'))

    {       
       $file = $request->file('vehicle_front_img');
       $extension = $request->file('vehicle_front_img')->getClientOriginalExtension();
       $vehicle_front_img = date('d_m_Y_h_i_s',time()) . '1.' . $extension;

       $destinationPaths = base_path().'/public/images/vehicle_image';

       $thumb_img =Image::make($file->getRealPath())->orientate()->resize(150, 150);

       $thumb_img->save($destinationPaths.'/'.$vehicle_front_img,80);


   }       
   else{
    $vehicle_front_img = "";
}


 if($request->hasFile('vehicle_back_img'))

    {       
       $file = $request->file('vehicle_back_img');
       $extension = $request->file('vehicle_back_img')->getClientOriginalExtension();
       $vehicle_back_img = date('d_m_Y_h_i_s',time()) . '2.' . $extension;

       $destinationPaths = base_path().'/public/images/vehicle_image';

       $thumb_img =Image::make($file->getRealPath())->orientate()->resize(150, 150);

       $thumb_img->save($destinationPaths.'/'.$vehicle_back_img,80);


   }       
   else{
    $vehicle_back_img = "";
}


 if($request->hasFile('vehicle_side_img'))

    {       
       $file = $request->file('vehicle_side_img');
       $extension = $request->file('vehicle_side_img')->getClientOriginalExtension();
       $vehicle_side_img = date('d_m_Y_h_i_s',time()) . '3.' . $extension;

       $destinationPaths = base_path().'/public/images/vehicle_image';

       $thumb_img =Image::make($file->getRealPath())->orientate()->resize(150, 150);

       $thumb_img->save($destinationPaths.'/'.$vehicle_side_img,80);


   }       
   else{
    $vehicle_side_img = "";
}


 if($request->hasFile('vehicle_insurance_file'))

    {       
       $file = $request->file('vehicle_insurance_file');
       $extension = $request->file('vehicle_insurance_file')->getClientOriginalExtension();
       $vehicle_insurance_file = date('d_m_Y_h_i_s',time()) . '4.' . $extension;

       $destinationPaths = base_path().'/public/images/vehicle_image';

       $thumb_img =Image::make($file->getRealPath())->orientate()->resize(150, 150);

       $thumb_img->save($destinationPaths.'/'.$vehicle_insurance_file,80);


   }       
   else{
    $vehicle_insurance_file = "";
}


 if($request->hasFile('vehicle_rc_book_img'))

    {       
       $file = $request->file('vehicle_rc_book_img');
       $extension = $request->file('vehicle_rc_book_img')->getClientOriginalExtension();
       $vehicle_rc_book_img = date('d_m_Y_h_i_s',time()) . '5.' . $extension;

       $destinationPaths = base_path().'/public/images/vehicle_image';

       $thumb_img =Image::make($file->getRealPath())->orientate()->resize(150, 150);

       $thumb_img->save($destinationPaths.'/'.$vehicle_rc_book_img,80);


   }       
   else{
    $vehicle_rc_book_img = "";
}



$data = array(
    'vehicle_owner_id'=>$record->id,   
    'vehicle_userid'=>$record->rv_user_userid,
    'user_id'=>$record->user_id,
    'vehicle_type'=>$request->vehicle_type,
    'vehicle_name'=>$request->vehicle_name,
    'vehicle_no'=>$request->vehicle_no,
    'vehicle_modal_no'=>$request->vehicle_modal_no,
    'vehicle_package'=>$request->vehicle_package,
    'vehicle_registered_no'=>$request->vehicle_registered_no,
    'vehicle_registered_year'=>$request->vehicle_registered_year,
    'vehicle_front_img'=>$vehicle_front_img,
    'vehicle_back_img'=>$vehicle_back_img,
    'vehicle_side_img'=>$vehicle_side_img,
    'vehicle_insurance_file'=>$vehicle_insurance_file,
    'vehicle_rc_book_img'=>$vehicle_rc_book_img,
    'insurance_expiry_date'=>$request->insurance_expiry_date,
    'vehicle_rc_no'=>$request->vehicle_rc_no,
    'vehicle_driving_location'=>$request->vehicle_driving_location,
        'vehicle_unique_id'=>'VehicleId'.$record->user_id.date('Y'),
    'vehicle_package_for'=>$request->vehicle_package_for,

);
$vehicle_master = new vehicle_master($data);
$vehicle_master->save();




$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/vehicles')->with($notification);

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

       return view('admin.vehicles.show',compact('view'));
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
        $record_vehicle = vehicle_master::find($id);     


           $record=DB::table('rv_user_registrations')
           ->join('countries','countries.id','rv_user_registrations.rv_user_country')
           ->join('states','states.id','rv_user_registrations.rv_user_state')
           ->join('cities','cities.id','rv_user_registrations.rv_user_city')
         ->join('localities','localities.id','rv_user_registrations.rv_user_locality')
       ->where('rv_user_registrations.id',$record_vehicle->vehicle_owner_id)
           ->select('countries.country_name','cities.city_name','states.state_name','localities.locality_name','rv_user_registrations.*')
         ->where('rv_user_type','like','%' . 'Vehicle' . '%')
           ->first();


$records=DB::table('vehicle_masters')
->where('vehicle_owner_id',$record->id)->get();


       $documents = DB::table('documents')  
       ->select('document_name','id')      
       ->orderBy('document_name', 'asc')->pluck('document_name','document_name');

   $locations = DB::table('cities')  
       ->join('countries','countries.id','cities.country_id')
       ->select('cities.city_name','cities.id')   
       ->where('countries.country_name','UNITED STATES')   
       ->orderBy('cities.id', 'asc')
       // ->limit('10')
       ->where('cities.status','Active') 
          ->pluck('cities.city_name','cities.city_name');

// dd($locations);


       $vehicle_names = DB::table('vehicle_types')  
       ->select('vehicle_name','id')      
       ->orderBy('vehicle_name', 'asc')->pluck('vehicle_name','vehicle_name');

 $package_names = DB::table('vehicle_rate_charts')  
       ->select('package_name','id')      
       ->orderBy('package_name', 'asc')->pluck('package_name','package_name');


// dd($vehicle_names);     
        
        return view('admin.vehicles.edit',compact('record','documents','vehicle_names','package_names','records','record_vehicle','locations'));

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

        $vehicle_master = vehicle_master::find($id); 


        
 if($request->hasFile('vehicle_front_img'))

    {       
       $file = $request->file('vehicle_front_img');
       $extension = $request->file('vehicle_front_img')->getClientOriginalExtension();
       $vehicle_front_img = date('d_m_Y_h_i_s',time()) . '1.' . $extension;

       $destinationPaths = base_path().'/public/images/vehicle_image';

       $thumb_img =Image::make($file->getRealPath())->orientate()->resize(150, 150);

       $thumb_img->save($destinationPaths.'/'.$vehicle_front_img,80);


   }       
   else{
    $vehicle_front_img = $vehicle_master->vehicle_front_img;
}


 if($request->hasFile('vehicle_back_img'))

    {       
       $file = $request->file('vehicle_back_img');
       $extension = $request->file('vehicle_back_img')->getClientOriginalExtension();
       $vehicle_back_img = date('d_m_Y_h_i_s',time()) . '2.' . $extension;

       $destinationPaths = base_path().'/public/images/vehicle_image';

       $thumb_img =Image::make($file->getRealPath())->orientate()->resize(150, 150);

       $thumb_img->save($destinationPaths.'/'.$vehicle_back_img,80);


   }       
   else{
    $vehicle_back_img = $vehicle_master->vehicle_back_img;
}


 if($request->hasFile('vehicle_side_img'))

    {       
       $file = $request->file('vehicle_side_img');
       $extension = $request->file('vehicle_side_img')->getClientOriginalExtension();
       $vehicle_side_img = date('d_m_Y_h_i_s',time()) . '3.' . $extension;

       $destinationPaths = base_path().'/public/images/vehicle_image';

       $thumb_img =Image::make($file->getRealPath())->orientate()->resize(150, 150);

       $thumb_img->save($destinationPaths.'/'.$vehicle_side_img,80);


   }       
   else{
    $vehicle_side_img = $vehicle_master->vehicle_side_img;
}


 if($request->hasFile('vehicle_insurance_file'))

    {       
       $file = $request->file('vehicle_insurance_file');
       $extension = $request->file('vehicle_insurance_file')->getClientOriginalExtension();
       $vehicle_insurance_file = date('d_m_Y_h_i_s',time()) . '4.' . $extension;

       $destinationPaths = base_path().'/public/images/vehicle_image';

       $thumb_img =Image::make($file->getRealPath())->orientate()->resize(150, 150);

       $thumb_img->save($destinationPaths.'/'.$vehicle_insurance_file,80);


   }       
   else{
    $vehicle_insurance_file = $vehicle_master->vehicle_insurance_file;
}


 if($request->hasFile('vehicle_rc_book_img'))

    {       
       $file = $request->file('vehicle_rc_book_img');
       $extension = $request->file('vehicle_rc_book_img')->getClientOriginalExtension();
       $vehicle_rc_book_img = date('d_m_Y_h_i_s',time()) . '5.' . $extension;

       $destinationPaths = base_path().'/public/images/vehicle_image';

       $thumb_img =Image::make($file->getRealPath())->orientate()->resize(150, 150);

       $thumb_img->save($destinationPaths.'/'.$vehicle_rc_book_img,80);


   }       
   else{
    $vehicle_rc_book_img = $vehicle_master->vehicle_rc_book_img;
}



    $data = array(
    // 'vehicle_owner_id'=>$record->id,   
    // 'vehicle_userid'=>$record->vehicle_userid,
    // 'user_id'=>$record->user_id,
    'vehicle_type'=>$request->vehicle_type,
    'vehicle_name'=>$request->vehicle_name,
    'vehicle_no'=>$request->vehicle_no,
    'vehicle_modal_no'=>$request->vehicle_modal_no,
    'vehicle_package'=>$request->vehicle_package,
    'vehicle_registered_no'=>$request->vehicle_registered_no,
    'vehicle_registered_year'=>$request->vehicle_registered_year,
    'vehicle_front_img'=>$vehicle_front_img,
    'vehicle_back_img'=>$vehicle_back_img,
    'vehicle_side_img'=>$vehicle_side_img,
    'vehicle_insurance_file'=>$vehicle_insurance_file,
    'vehicle_rc_book_img'=>$vehicle_rc_book_img,
    'insurance_expiry_date'=>$request->insurance_expiry_date,
    'vehicle_rc_no'=>$request->vehicle_rc_no,
    'vehicle_driving_location'=>$request->vehicle_driving_location,
        'vehicle_package_for'=>$request->vehicle_package_for,

    );

   // dd($data);
    $vehicle_master->update($data);


    DB::table('users')
    ->where('id',$vehicle_master->user_id)
    ->update(
        ['name' => $request->input('vehicle_name')]
    );



    $notification = array(
        'message' => 'Your form was successfully Update!', 
        'alert-type' => 'success'
    );

    return Redirect::to('admin/vehicles')->with($notification);
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

       $vehicle_master = vehicle_master::find($request->id);
       $vehicle_master->delete();

       return $vehicle_master;
   }

   public function status_update(Request $request){

       $record=vehicle_master::find($request->user_id);

       if($record['status']=='Active'){
         $updatevender=\DB::table('vehicle_masters')->where('id',$request->user_id)
         ->update([
            'status' => 'Deactive',
        ]);
         return json_encode('Deactive');
     } else {
      $updateuser=\DB::table('vehicle_masters')->where('id',$request->user_id)
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

    $record = vehicle_master::where('vehicle_name', $request->check_unique_name)->first();

    if(!empty($record)){
        return "exist";
    }else{
        return "notexist";
    }
}
if(!empty($request->check_unique_name_edit)){

    $record = vehicle_master::where('vehicle_name', $request->check_unique_name_edit)->get();

    if(count($record) <=1){
        return "notexist";
    }else{
        return "exist";
    }
}
}
}
