<?php

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\admin;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Toast;
use Image;
use File;

class profileController extends Controller
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


    public function index()
    {

        // dd($id);
        $record = admin::find(1);     

           $countries = DB::table('countries')  
                    ->select('country_name','id')
                     ->where('status','Active')
            ->orderBy('country_name', 'asc')->pluck('country_name','id'); 

// dd($record);


  $states = DB::table('states')
             ->where('states.country_id','=', $record['admin_country'])
              ->where("states.status",'Active')
            ->pluck('states.state_name','states.id');

// dd($states);
             $cities = DB::table('cities')
             ->where('cities.state_id','=', $record['admin_state'])
              // ->where("cities.status",'Active')
            ->pluck('cities.city_name','cities.id');


             $localities = DB::table('localities')
             ->where('localities.city_id','=', $record['admin_city'])
              ->where("localities.status",'Active')
            ->pluck('localities.locality_name','localities.id');



        
         return view('admin.profile.index',compact('record','countries','states','cities','localities'));


    }


    


    public function create()
    {
       $record='';

       return view('admin.profile.create',compact('record'));
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

       return Redirect::to('admin/profile')->with($notification);

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

       return view('admin.profile.show',compact('view'));
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
        
        return view('admin.profile.edit',compact('record'));

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
        // dd($request);
        
        $admin = admin::find($id); 


  if($request->hasFile('admin_img'))
  
        {       
     $file = $request->file('admin_img');
     $extension = $request->file('admin_img')->getClientOriginalExtension();
     $admin_img = date('d_m_Y_h_i_s',time()) . '1.' . $extension;

         $destinationPaths = base_path().'/public/images/admin_img';

  $thumb_img =Image::make($file->getRealPath())->orientate()->resize(150, 150);
  
     $thumb_img->save($destinationPaths.'/'.$admin_img,80);


      }       
        else{
            $admin_img = $admin->admin_img;
        }




   $data = array(
'admin_name'=>$request->input('admin_name'),
'admin_email'=>$request->input('admin_email'),
'admin_dob'=>$request->input('admin_dob'),
'admin_gender'=>$request->input('admin_gender'),
'admin_login_email'=>$request->input('admin_login_email'),
'admin_password'=>$request->input('admin_password'),
'admin_country'=>$request->input('admin_country'),
'admin_state'=>$request->input('admin_state'),
'admin_city'=>$request->input('admin_city'),
'admin_locality'=>$request->input('admin_locality'),
'admin_address'=>$request->input('admin_address'),
'admin_pincode'=>$request->input('admin_pincode'),    
'admin_mobile'=>$request->input('admin_mobile'),    
'admin_phone'=>$request->input('admin_phone'),    
'admin_img'=>$admin_img,    
);

   // dd($data);
         $admin->update($data);

           
              DB::table('users')
         ->where('id',$admin->user_id)
         ->update(
['name' => $request->input('admin_name'),
'email' => $request->input('admin_login_email'),
'password' => bcrypt($request->input('admin_password'))]
         );



$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/profile')->with($notification);
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
         $updatevender=\DB::table('profile')->where('id',$request->user_id)
         ->update([
            'status' => 'Deactive',
        ]);
         return json_encode('Deactive');
     } else {
      $updateuser=\DB::table('profile')->where('id',$request->user_id)
      ->update([
        'status' => 'Active',
                                // 'updated_at' => date('Y-m-d H:i:s') 
    ]);
      return json_encode("Active");

  }
}

}

