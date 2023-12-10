<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\role;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;

class usersController extends Controller
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
       
//         $records=DB::table('roles')->orderBy('role_name','asc');

//          if (!empty($request->search)) {
//         $term=$request->search;
//$records=$records
//->where(function($q) use ($term) {
//$q
//         ->orWhere('role_name','like','%' . $term . '%');
  //  });
// }

//          $records= $records
//         ->paginate(25);



//          $use = DB::table('roles')  
//                     ->select('role_name','id')        
   
//             ->orderBy('role_name', 'asc')->get(); 

//  $role_names = array();
// foreach($use as $user) {
// $role_names[$user->role_name] = $user->role_name;
// }

return view('admin.roles.index');
   
         // return view('admin.roles.index.',compact('records','role_names'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $currentURL='';

         return view('admin.roles.create',compact('currentURL'));
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
    'status'=>"Active",
);
         $role = new role($data);
         $role->save();
                 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::back()->with($notification);

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
        
        // dd($record->role_name);
         return view('admin.roles.edit',compact('currentURL','record'));

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
        
        $role = role::find($id); 

   $data = array(
    'role_name'=>$request->input('role_name'),
    
);
         $role->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::back()->with($notification);
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
               $updatevender=\DB::table('roles')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);
            return json_encode('Deactive');
           } else {
              $updateuser=\DB::table('roles')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Active',
                                // 'updated_at' => date('Y-m-d H:i:s') 
                                 ]);
              return json_encode("Active");

        }
           }

    public function check_role_name(Request $request)
    {

        // return $request->checkCountry;
        
      if(!empty($request->check_role)){

        $record = role::where('role_name', $request->check_role)->first();

         if(!empty($record)){
            return "exist";
         }else{
            return "notexist";
         }
      }
      if(!empty($request->check_role_edit)){

        $record = role::where('role_name', $request->check_role_edit)->get();

         if(count($record) <=1){
            return "notexist";
         }else{
            return "exist";
         }
      }
  }
}
