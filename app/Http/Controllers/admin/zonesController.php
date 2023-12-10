<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\zone;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;

class zonesController extends Controller
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
       
        $records=DB::table('zones')
              ->join('countries','zones.zone_country','countries.id')

              ->orderBy('zones.id','desc');

         if (!empty($request->search)) {
        $term=$request->search;
$records=$records
->where(function($q) use ($term) {
$q
        ->orWhere('zones.zone_name','like','%' . $term . '%');
    });
}

         $records= $records
         ->select('countries.country_name','zones.*',\DB::raw("GROUP_CONCAT(states.state_name) as state_name"))
         ->groupBy('zones.zone_state')



           ->leftjoin("states",\DB::raw("FIND_IN_SET(states.id,zones.zone_state)"),">",\DB::raw("'0'"))
        ->paginate(25);



         $use = DB::table('zones')  
                    ->select('zone_name','id')        
   
            ->orderBy('zone_name', 'asc')->get(); 

 $zoness = array();
foreach($use as $user) {
$zoness[$user->zone_name] = $user->zone_name;
}

//  DB::table('count_masters')
// ->where('id','1')
// ->update([
// 'state_count'=>$count,
// ]);

return view('admin.zones.index',compact('records','zoness'));
   
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

         return view('admin.zones.create',compact('countries'));
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
    'zone_name'=>$request->input('zone_name'),
    'zone_country'=>$request->input('zone_country'),
    'zone_code'=>$request->input('zone_code'),
    'zone_state'=>implode(',',$request->zone_state)    
);
         $zone = new zone($data);
         $zone->save();
                 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/zones')->with($notification);

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

        return view('admin.zones.show',compact('view'));
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
        $record = zone::find($id);         

          $countries = DB::table('countries')  
                    ->select('country_name','id')
                     ->where('status','Active')
            ->orderBy('country_name', 'asc')->pluck('country_name','id'); 

  $states = DB::table('states')
             ->where('states.country_id','=', $record['zone_country'])
              ->where("states.status",'Active')
            ->pluck('states.state_name','states.id');

        
        // dd($states);
         return view('admin.zones.edit',compact('record','countries','states'));

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
        
        $zones = zone::find($id); 

   $data = array(
   'zone_name'=>$request->input('zone_name'),
    'zone_country'=>$request->input('zone_country'),
    'zone_code'=>$request->input('zone_code'),
    'zone_state'=>implode(',',$request->zone_state)        
);
         $zones->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/zones')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
         $zones = zone::find($request->id);
          $zones->delete();

          return $zones;
    }

     public function status_update(Request $request){
 
         $record=zone::find($request->user_id);
      
          if($record['status']=='Active'){
               $updatevender=\DB::table('zones')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);
            return json_encode('Deactive');
           } else {
              $updateuser=\DB::table('zones')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Active',
                                // 'updated_at' => date('Y-m-d H:i:s') 
                                 ]);
              return json_encode("Active");

        }
           }

}
