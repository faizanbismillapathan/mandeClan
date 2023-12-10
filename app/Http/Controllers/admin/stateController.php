<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\state;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;

class stateController extends Controller
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
         
        $records=DB::table('states')
       ->join('countries','states.country_id','countries.id')
        ->orderBy('states.id','desc');

        if (!empty($request->search)) {

         $term=$request->search;
$records=$records
->where(function($q) use ($term) {
$q
        ->orWhere('states.state_name','like','%' . $term . '%')
        ->orWhere('countries.country_name','like','%' . $term . '%');
    });

      }
         $records= $records
        ->select('states.id','states.state_name','countries.country_name','states.status')
        ->paginate(25);



         $use = DB::table('states')  
          ->join('countries','states.country_id','countries.id')
                    ->select('states.state_name','states.id')
            ->orderBy('states.state_name', 'asc')->get(); 

 $states = array();
foreach($use as $user) {
$states[$user->state_name] = $user->state_name;
}


//  DB::table('count_masters')
// ->where('id','1')
// ->update([
// 'state_count'=>$count,
// ]);



return view('admin.state.index',compact('records','states'));
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // dd('check_unique_'.\Request::segment(2),str_replace('-', '_', \Request::segment(2)).'Controller@check_unique_name');


         $countries = DB::table('countries')  
                    ->select('country_name','id')
                     ->where('status','Active')
            ->orderBy('country_name', 'asc')->pluck('country_name','id'); 

         return view('admin.state.create',compact('countries'));
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
    'state_name'=>$request->input('state_name'),
            'country_id'=>$request->input('country_id'),

);
         $state = new state($data);
         $state->save();
                 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/state')->with($notification);

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

        return view('admin.state.show',compact('view'));
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
        $record = state::find($id);         
        
        $countries = DB::table('countries')  
                    ->select('country_name','id')
                     ->where('status','Active')
            ->orderBy('country_name', 'asc')->pluck('country_name','id'); 


         return view('admin.state.edit',compact('record','countries'));

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
        
        $state = state::find($id); 

   $data = array(
    'state_name'=>$request->input('state_name'),
        'country_id'=>$request->input('country_id'),

);
         $state->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/state')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
         $state = state::find($request->id);
          $state->delete();

          return $state;
    }

     public function status_update(Request $request){
 
         $record=state::find($request->user_id);
      
          if($record['status']=='Active'){
               $updatevender=\DB::table('states')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);
            return json_encode('Deactive');
           } else {
              $updateuser=\DB::table('states')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Active',
                                // 'updated_at' => date('Y-m-d H:i:s') 
                                 ]);
              return json_encode("Active");

        }
           }

    public function check_unique_name(Request $request)
    {

        // return $request->checkstate;
        
      if(!empty($request->check_state)){

        $record = state::where('state_name', $request->check_state)->first();

         if(!empty($record)){
            return "exist";
         }else{
            return "notexist";
         }
      }
      if(!empty($request->check_state_edit)){

        $record = state::where('state_name', $request->check_state_edit)->get();

         if(count($record) <=1){
            return "notexist";
         }else{
            return "exist";
         }
      }
  }
}
