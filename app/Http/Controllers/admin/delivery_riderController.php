<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\rider_master;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;
use Image;
use File;
use App\user;
use App\rv_user_registration;

class delivery_riderController extends Controller
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

        $records=DB::table('rider_masters')
               ->join('rv_user_registrations','rv_user_registrations.id','rider_masters.rider_id')
        ->join('cities','cities.id','rv_user_registrations.rv_user_city')
        ->join('countries','countries.id','rv_user_registrations.rv_user_country')

        ->orderBy('rv_user_registrations.id','desc');

        if (!empty($request->search)) {
           $term=$request->search;
$records=$records
->where(function($q) use ($term) {
$q
->orWhere('rv_user_registrations.rv_user_userid','like','%' . $term . '%')
->orWhere('rv_user_registrations.rv_user_name','like','%' . $term . '%')
->orWhere('rv_user_registrations.rv_user_mobile','like','%' . $term . '%')
->orWhere('rv_user_registrations.rv_user_email','like','%' . $term . '%')
->orWhere('countries.country_name','like','%' . $term . '%')

->orWhere('cities.city_name','like','%' . $term . '%')
->orWhere('rv_user_registrations.status','like','%' . $term . '%');
});
       }

       $records= $records
       ->select('countries.country_name','cities.city_name','rider_masters.*','rv_user_registrations.*')
       ->paginate(25);



       $use = DB::table('rv_user_registrations')  
       ->select('rv_user_name','id')        

       ->orderBy('rv_user_name', 'asc')->get(); 

       $rider_master = array();
       foreach($use as $user) {
        $rider_master[$user->rv_user_name] = $user->rv_user_name;
    }

//  DB::table('count_masters')
// ->where('id','1')
// ->update([
// 'state_count'=>$count,
// ]);

    return view('admin.delivery_rider.index',compact('records','rider_master'));

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
        if (!empty($request->search)) {

           $record=DB::table('rv_user_registrations')
           ->join('countries','countries.id','rv_user_registrations.rv_user_country')
           ->join('states','states.id','rv_user_registrations.rv_user_state')
           ->join('cities','cities.id','rv_user_registrations.rv_user_city')
           ->join('localities','localities.id','rv_user_registrations.rv_user_locality')

           ->orderBy('rv_user_registrations.id','desc')

       ->Where('rv_user_registrations.rv_user_userid',$request->search)

           ->select('countries.country_name','cities.city_name','states.state_name','localities.locality_name','rv_user_registrations.*')
         ->where('rv_user_type','like','%' . 'Rider' . '%')
           ->first();


// dd($record);

  $check=DB::table('rider_masters')
        ->where('rider_userid',$record->rv_user_userid)
        ->first();

        if (!empty($check)) {
            
            $record='';
            $new_msg="Already create this Rider";
        }


       }
// dd($record);



       $documents = DB::table('documents')  
       ->select('document_name','id')      
         ->where('document_for','Rider')
       ->orderBy('document_name', 'asc')->pluck('document_name','document_name');

       $license_type = DB::table('driving_licenses')  
       ->select('driving_license_name','id')
       ->where('status','Active')
       ->orderBy('driving_license_name', 'asc')->pluck('driving_license_name','driving_license_name'); 

 $rider_plans = DB::table('rider_plans')  
       ->select('rider_plan_name','id')      
       ->orderBy('rider_plan_name', 'asc')->pluck('rider_plan_name','id');


       return view('admin.delivery_rider.create',compact('record','documents','license_type','new_msg','rider_plans'));
   }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $record= rv_user_registration::find($request->id);

        $check=DB::table('rider_masters')
        ->where('rider_userid',$record->rv_user_userid)
        ->first();
// dd($check);


        if (empty($check)) {
    // code...

          if($request->hasFile('rider_license_front_img'))

          {       
           $file = $request->file('rider_license_front_img');
           $extension = $request->file('rider_license_front_img')->getClientOriginalExtension();
           $rider_license_front_img = date('d_m_Y_h_i_s',time()) . '1.' . $extension;

           $destinationPaths = base_path().'/public/images/delivery_img';

           $thumb_img =Image::make($file->getRealPath())->orientate()->resize(150, 150);

           $thumb_img->save($destinationPaths.'/'.$rider_license_front_img,80);


       }       
       else{
        $rider_license_front_img = "";
    }


    if($request->hasFile('rider_license_back_img'))

    {       
       $file = $request->file('rider_license_back_img');
       $extension = $request->file('rider_license_back_img')->getClientOriginalExtension();
       $rider_license_back_img = date('d_m_Y_h_i_s',time()) . '1.' . $extension;

       $destinationPaths = base_path().'/public/images/delivery_img';

       $thumb_img =Image::make($file->getRealPath())->orientate()->resize(150, 150);

       $thumb_img->save($destinationPaths.'/'.$rider_license_back_img,80);


   }       
   else{
    $rider_license_back_img = "";
}




// $user_data = array(
//   'name' => $record->rv_user_name,
//   'email' => $record->rv_user_login_email,
//   'password' => bcrypt($record->rv_user_password),
//   'role' =>'4',
//   'status'=>'Active',

// );
// $users = new user($user_data);
// $users->save();

$driving_license_type='';

if (!empty($request->driving_license_type)) {
    $driving_license_type=implode(',',$request->driving_license_type);

}
$data = array(
     'user_id' =>$record->user_id,
    'rider_userid'=>$record->rv_user_userid,
    'rider_id'=>$record->id,   
    'driving_license_type'=>$driving_license_type,
    'rider_driving_license_no'=>$request->rider_driving_license_no,
    'rider_driving_expiry_date'=>$request->rider_driving_expiry_date,
    'rider_license_front_img'=>$rider_license_front_img,
    'rider_license_back_img'=>$rider_license_back_img,
    'rider_plan_id'=>$request->rider_plan_id,

);

         // dd($data);
$rider_master = new rider_master($data);
$rider_master->save();


}

$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/delivery-rider')->with($notification);

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

       return view('admin.delivery_rider.show',compact('view'));
   }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

       $record=DB::table('rider_masters')
       ->join('rv_user_registrations','rv_user_registrations.id','rider_masters.rider_id')
       ->join('countries','countries.id','rv_user_registrations.rv_user_country')
       ->join('states','states.id','rv_user_registrations.rv_user_state')
       ->join('cities','cities.id','rv_user_registrations.rv_user_city')
       ->join('localities','localities.id','rv_user_registrations.rv_user_locality')
       ->where('rv_user_registrations.id',$id)
       ->select('countries.country_name','cities.city_name','states.state_name','localities.locality_name','rv_user_registrations.*','rider_masters.*')
       ->first();


       $license_type = DB::table('driving_licenses')  
       ->select('driving_license_name','id')
       ->where('status','Active')
       ->orderBy('driving_license_name', 'asc')->pluck('driving_license_name','driving_license_name'); 

$rider_plans = DB::table('rider_plans')  
       ->select('rider_plan_name','id')      
       ->orderBy('rider_plan_name', 'asc')->pluck('rider_plan_name','id');


       return view('admin.delivery_rider.edit',compact('record','license_type','rider_plans'));

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

        $rider_master = rider_master::find($id); 

        if($request->hasFile('rider_license_front_img'))

        {       
           $file = $request->file('rider_license_front_img');
           $extension = $request->file('rider_license_front_img')->getClientOriginalExtension();
           $rider_license_front_img = date('d_m_Y_h_i_s',time()) . '1.' . $extension;

           $destinationPaths = base_path().'/public/images/delivery_img';

           $thumb_img =Image::make($file->getRealPath())->orientate()->resize(150, 150);

           $thumb_img->save($destinationPaths.'/'.$rider_license_front_img,80);


       }       
       else{
        $rider_license_front_img = $rider_master->rider_license_front_img;
    }


    if($request->hasFile('rider_license_back_img'))

    {       
       $file = $request->file('rider_license_back_img');
       $extension = $request->file('rider_license_back_img')->getClientOriginalExtension();
       $rider_license_back_img = date('d_m_Y_h_i_s',time()) . '1.' . $extension;

       $destinationPaths = base_path().'/public/images/delivery_img';

       $thumb_img =Image::make($file->getRealPath())->orientate()->resize(150, 150);

       $thumb_img->save($destinationPaths.'/'.$rider_license_back_img,80);


   }       
   else{
    $rider_license_back_img = $rider_master->rider_license_back_img;
}

$driving_license_type='';

if (!empty($request->driving_license_type)) {
    $driving_license_type=implode(',',$request->driving_license_type);

}
$data = array(
    'driving_license_type'=>$driving_license_type,
    'rider_driving_license_no'=>$request->rider_driving_license_no,
    'rider_driving_expiry_date'=>$request->rider_driving_expiry_date,
    'rider_license_front_img'=>$rider_license_front_img,
    'rider_license_back_img'=>$rider_license_back_img,
    'rider_plan_id'=>$request->rider_plan_id,

);

   // dd($data);
$rider_master->update($data);





$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/delivery-rider')->with($notification);
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

       $rider_master = rider_master::find($request->id);
       $rider_master->delete();

       return $rider_master;
   }

   public function status_update(Request $request){

       $record=rider_master::find($request->user_id);

       if($record['status']=='Active'){
         $updatevender=\DB::table('rider_masters')->where('id',$request->user_id)
         ->update([
            'status' => 'Deactive',
        ]);
         return json_encode('Deactive');
     } else {
      $updateuser=\DB::table('rider_masters')->where('id',$request->user_id)
      ->update([
        'status' => 'Active',
                                // 'updated_at' => date('Y-m-d H:i:s') 
    ]);
      return json_encode("Active");

  }
}
}
