<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\rv_user_registration;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;
use Image;
use File;
use App\user;
use App\user_account_delete;

class rider_vehicle_infoController extends Controller
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
       
      
        $records=DB::table('rv_user_registrations')
        ->join('cities','cities.id','rv_user_registrations.rv_user_city')
                ->join('localities','localities.id','rv_user_registrations.rv_user_locality')
                  ->join('users','rv_user_registrations.user_id','users.id')

        ->orderBy('rv_user_registrations.id','desc');

         if (!empty($request->search)) {
        $term=$request->search;
$records=$records
->where(function($q) use ($term) {
$q
        ->orWhere('rv_user_registrations.rv_user_userid','like','%' . $term . '%')
        ->orWhere('rv_user_registrations.rv_user_name','like','%' . $term . '%')
        ->orWhere('rv_user_registrations.rv_user_mobile','like','%' . $term . '%')
        ->orWhere('rv_user_registrations.rv_user_gender','like','%' . $term . '%')
        ->orWhere('cities.city_name','like','%' . $term . '%')
        ->orWhere('localities.locality_name','like','%' . $term . '%')
        ->orWhere('rv_user_registrations.rv_user_type','like','%' . $term . '%')
        ->orWhere('rv_user_registrations.status','like','%' . $term . '%','kyc_status ');
    });
}

         $records= $records
         ->select('localities.locality_name','cities.city_name','rv_user_registrations.*','users.status as user_status')
                  ->where('rv_user_registrations.status','<>','Archive')

        ->paginate(25);



         $use = DB::table('rv_user_registrations')  
                    ->select('rv_user_name','id')        
   
            ->orderBy('rv_user_name', 'asc')->get(); 

 $rv_user_registrations = array();
foreach($use as $user) {
$rv_user_registrations[$user->rv_user_name] = $user->rv_user_name;
}



return view('admin.rider_vehicle_info.index',compact('records','rv_user_registrations'));
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

$countries = DB::table('countries')  
        ->select('country_name','id')
         ->where('status','Active')
->orderBy('country_name', 'asc')->pluck('country_name','id'); 
         
         

         $autoincid = mt_rand(10,100);
         $Y = date('Ys');
         $keydata = 'Rider'.$Y.''.$autoincid;


         return view('admin.rider_vehicle_info.create',compact('countries','keydata'));
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


          if($request->hasFile('rv_user_img'))
  
        {       
     $file = $request->file('rv_user_img');
     $extension = $request->file('rv_user_img')->getClientOriginalExtension();
     $rv_user_img = date('d_m_Y_h_i_s',time()) . '1.' . $extension;

         $destinationPaths = base_path().'/public/images/delivery_img';

  $thumb_img =Image::make($file->getRealPath())->orientate()->resize(150, 150);
  
     $thumb_img->save($destinationPaths.'/'.$rv_user_img,80);


      }       
        else{
            $rv_user_img = "";
        }


  //           if($request->hasFile('rv_user_marksheet'))
  
  //       {       
  //    $file = $request->file('rv_user_marksheet');
  //    $extension = $request->file('rv_user_marksheet')->getClientOriginalExtension();
  //    $rv_user_marksheet = date('d_m_Y_h_i_s',time()) . '2.' . $extension;

  //        $destinationPaths = base_path().'/public/images/delivery_img';

  // $thumb_img =Image::make($file->getRealPath())->orientate()->resize(150, 150);
  
  //    $thumb_img->save($destinationPaths.'/'.$rv_user_marksheet,80);


  //     }       
  //       else{
  //           $rv_user_marksheet = "";
  //       }
$type='';

if (!empty($request->rv_user_type)) {
$type=implode(',',$request->rv_user_type);
}

$user_data = array(
'name' => $request->rv_user_name,
'email' => $request->rv_user_login_email,
'password' => bcrypt($request->rv_user_password),
'mobile'=>'+'.$request->user_country_code.str_replace(' ','',$request->input('rv_user_mobile')),    
'role' =>'4',
'status'=>'Active',

);
// dd($user_data);
  $users = new user($user_data);
         $users->save();


         $data = array(
'rv_user_name'=>$request->input('rv_user_name'),
'rv_user_email'=>$request->input('rv_user_email'),
'rv_user_dob'=>$request->input('rv_user_dob'),
'rv_user_gender'=>$request->input('rv_user_gender'),
'rv_user_login_email'=>$request->input('rv_user_login_email'),
'rv_user_password'=>$request->input('rv_user_password'),
'rv_user_country'=>$request->input('rv_user_country'),
'rv_user_state'=>$request->input('rv_user_state'),
'rv_user_city'=>$request->input('rv_user_city'),
'rv_user_locality'=>$request->input('rv_user_locality'),
'rv_user_address'=>$request->input('rv_user_address'),
'rv_user_pincode'=>$request->input('rv_user_pincode'),
'rv_user_mobile'=>'+'.$request->user_country_code.str_replace(' ','',$request->input('rv_user_mobile')),    
'rv_user_phone'=>$request->input('rv_user_phone'),    
'rv_user_img'=>$rv_user_img,   
'user_id' =>$users->id,
'rv_user_userid'=>$request->rv_user_userid,
'created_by'=>'Admin',
'rv_user_type'=>$type,    
);


         $rv_user_registration = new rv_user_registration($data);
         $rv_user_registration->save();

                 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/rider-vehicle-info')->with($notification);

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

        return view('admin.rider_vehicle_info.show',compact('view'));
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
        $record = rv_user_registration::find($id);     

           $countries = DB::table('countries')  
                    ->select('country_name','id')
                     ->where('status','Active')
            ->orderBy('country_name', 'asc')->pluck('country_name','id'); 




  $states = DB::table('states')
             ->where('states.country_id','=', $record['rv_user_country'])
              ->where("states.status",'Active')
            ->pluck('states.state_name','states.id');

// dd($states);
             $cities = DB::table('cities')
             ->where('cities.state_id','=', $record['rv_user_state'])
              ->where("cities.status",'Active')
            ->pluck('cities.city_name','cities.id');


             $localities = DB::table('localities')
             ->where('localities.city_id','=', $record['rv_user_city'])
              ->where("localities.status",'Active')
            ->pluck('localities.locality_name','localities.id');


$user_id=$record->user_id;
                $users = user::find($record->user_id);         

         return view('admin.rider_vehicle_info.edit',compact('record','countries','states','cities','localities','user_id','users'));

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
        
        $rv_user_registration = rv_user_registration::find($id); 


  if($request->hasFile('rv_user_img'))
  
        {       
     $file = $request->file('rv_user_img');
     $extension = $request->file('rv_user_img')->getClientOriginalExtension();
     $rv_user_img = date('d_m_Y_h_i_s',time()) . '1.' . $extension;

         $destinationPaths = base_path().'/public/images/delivery_img';

  $thumb_img =Image::make($file->getRealPath())->orientate()->resize(150, 150);
  
     $thumb_img->save($destinationPaths.'/'.$rv_user_img,80);


      }       
        else{
            $rv_user_img = $rv_user_registration->rv_user_img;
        }



  //           if($request->hasFile('rv_user_marksheet'))
  
  //       {       
  //    $file = $request->file('rv_user_marksheet');
  //    $extension = $request->file('rv_user_marksheet')->getClientOriginalExtension();
  //    $rv_user_marksheet = date('d_m_Y_h_i_s',time()) . '2.' . $extension;

  //        $destinationPaths = base_path().'/public/images/delivery_img';

  // $thumb_img =Image::make($file->getRealPath())->orientate()->resize(150, 150);
  
  //    $thumb_img->save($destinationPaths.'/'.$rv_user_marksheet,80);


  //     }       
  //       else{
  //           $rv_user_marksheet = $rv_user_registration->rv_user_marksheet;
  //       }
$type='';

if (!empty($request->rv_user_type)) {
$type=implode(',',$request->rv_user_type);
}

                        $users = user::find($rv_user_registration->user_id);         
if ($users->status !='Default') {

   $data = array(
'rv_user_name'=>$request->input('rv_user_name'),
'rv_user_email'=>$request->input('rv_user_email'),
'rv_user_dob'=>$request->input('rv_user_dob'),
'rv_user_gender'=>$request->input('rv_user_gender'),
'rv_user_login_email'=>$request->input('rv_user_login_email'),
'rv_user_password'=>$request->input('rv_user_password'),
'rv_user_country'=>$request->input('rv_user_country'),
'rv_user_state'=>$request->input('rv_user_state'),
'rv_user_city'=>$request->input('rv_user_city'),
'rv_user_locality'=>$request->input('rv_user_locality'),
'rv_user_address'=>$request->input('rv_user_address'),
'rv_user_pincode'=>$request->input('rv_user_pincode'),    
'rv_user_mobile'=>'+'.$request->user_country_code.str_replace(' ','',$request->input('rv_user_mobile')),    
'rv_user_phone'=>$request->input('rv_user_phone'),    
'rv_user_img'=>$rv_user_img,    
// 'rv_user_qulification'=>$request->input('rv_user_qulification'),    
// 'deposit_amount'=>$request->input('deposit_amount'),    
// 'rv_user_marksheet'=>$rv_user_marksheet,    
'rv_user_type'=>$type,    

);

   // dd($data);
         $rv_user_registration->update($data);

           
              DB::table('users')
         ->where('id',$rv_user_registration->user_id)
         ->update(
[

'name' => $request->rv_user_name,
'email' => $request->rv_user_login_email,
'password' => bcrypt($request->rv_user_password),
'mobile'=>'+'.$request->user_country_code.str_replace(' ','',$request->input('rv_user_mobile')),    

]
         );

}else{

$data = array(
'rv_user_name'=>$request->input('rv_user_name'),
'rv_user_email'=>$request->input('rv_user_email'),
'rv_user_dob'=>$request->input('rv_user_dob'),
'rv_user_gender'=>$request->input('rv_user_gender'),
'rv_user_country'=>$request->input('rv_user_country'),
'rv_user_state'=>$request->input('rv_user_state'),
'rv_user_city'=>$request->input('rv_user_city'),
'rv_user_locality'=>$request->input('rv_user_locality'),
'rv_user_address'=>$request->input('rv_user_address'),
'rv_user_pincode'=>$request->input('rv_user_pincode'),    
'rv_user_phone'=>$request->input('rv_user_phone'),    
'rv_user_img'=>$rv_user_img,      
'rv_user_type'=>$type,    

);

   // dd($data);
         $rv_user_registration->update($data);


}

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/rider-vehicle-info')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
         // $rv_user_registration = rv_user_registration::find($request->id);
         //  $rv_user_registration->delete();
         //  return $rv_user_registration;


        $record=rv_user_registration::find($request->id);
      
               $updatevender=\DB::table('rv_user_registrations')->where('id',$request->id)
                              ->update([
                                'status' => 'Archive',
'status_date'=>Carbon::now()->toDateString(),
'status_created_by'=>'Admin',
                                 ]);

                              $updatevender=\DB::table('users')->where('id',$record->user_id)
->update([
'status' => 'Archive',
]);


user_account_delete::Insert([
'user_id' => $record->user_id,
'status_reason' => $request->status_reason,
'status_comment' => $request->status_comment,
'status' => 'Archive',

]);


            return json_encode('Archive');


    }

     public function status_update(Request $request){
 
         $record=rv_user_registration::find($request->user_id);
      
          if($record['status']=='Active'){
               $updatevender=\DB::table('rv_user_registrations')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);

                              $updatevender=\DB::table('users')->where('id',$record->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);


            return json_encode('Deactive');
           } else {
              $updateuser=\DB::table('rv_user_registrations')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Active',
                                // 'updated_at' => date('Y-m-d H:i:s') 
                                 ]);

                              $updatevender=\DB::table('users')->where('id',$record->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);


              return json_encode("Active");

        }
           }

    public function check_unique_name(Request $request)
    {

        // return $request->checkunique_name;
        
      if(!empty($request->check_unique_name)){

        $record = rv_user_registration::where('rv_user_name', $request->check_unique_name)->first();

         if(!empty($record)){
            return "exist";
         }else{
            return "notexist";
         }
      }
      if(!empty($request->check_unique_name_edit)){

        $record = rv_user_registration::where('rv_user_name', $request->check_unique_name_edit)->get();

         if(count($record) <=1){
            return "notexist";
         }else{
            return "exist";
         }
      }
  }
}
