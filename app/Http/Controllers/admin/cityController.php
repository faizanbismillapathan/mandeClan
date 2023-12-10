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
use App\city;

class cityController extends Controller
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
         
          $records=DB::table('cities')
       ->join('states','cities.state_id','states.id')
              ->join('countries','states.country_id','countries.id')
       ->select('cities.id','cities.city_name','countries.country_name','cities.status','states.state_name');

               if (!empty($request->search)) {
$term=$request->search;
$records=$records
->where(function($q) use ($term) {
$q
     ->orWhere('countries.country_name','like','%' . $term . '%')
     ->orWhere('states.state_name','like','%' . $term . '%')
     ->orWhere('cities.city_name','like','%' . $term . '%');
 });
}  

$records=  $records
->orderBy('cities.updated_at','desc')

        ->paginate(25);



  $use = DB::table('countries')  
                    ->select('country_name','id')        
   
            ->orderBy('country_name', 'asc')->get(); 

 $countrys = array();
foreach($use as $user) {
$countrys[$user->country_name] = $user->country_name;
}


//  DB::table('counts')
// ->where('id','1')
// ->update([
// 'state_count'=>$count,
// ]);



return view('admin.city.index',compact('records','countrys'));
   
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


 $states = DB::table('states')  
                    ->select('state_name','id')
                     ->where('status','Active')
            ->orderBy('state_name', 'asc')->pluck('state_name','id'); 



         return view('admin.city.create',compact('countries','states'));
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
            'state_id'=>$request->input('state_id'),
            'country_id'=>$request->input('country_id'),
            'city_name'=>$request->input('city_name')
);
         $city = new city($data);
         $city->save();
                 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/city')->with($notification);

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

        return view('admin.city.show',compact('view'));
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
        $record = city::find($id);         
        
        $countries = DB::table('countries')  
                    ->select('country_name','id')
                     ->where('status','Active')
            ->orderBy('country_name', 'asc')->pluck('country_name','id'); 


 $states = DB::table('states')  
                    ->select('state_name','id')
                     ->where('status','Active')
            ->orderBy('state_name', 'asc')->pluck('state_name','id'); 


  $cities = DB::table('countries')
            ->join('states', 'countries.id', '=', 'states.country_id')
             ->where('countries.id','=', $record['country_id'])
              ->where("states.status",'Active')
            ->pluck('states.state_name','states.id');


//   $cities = DB::table('countries')
//             ->join('states', 'countries.id', '=', 'states.country_id')
//             ->select('states.id as state_id','countries.id as country_id')
//             ->groupBy('states.id')->get();


// foreach ($cities as $key => $value) {
   
//    $check=   DB::table('cities')
//    ->where('state_id',$value->state_id)
//       ->where('country_id',$value->country_id)
// ->first();



//    if (empty($check)) {
//          DB::table('cities')
//    ->where('state_id',$value->state_id)
//    ->update(['country_id'=>$value->country_id]);
//    }



// }

// dd($cities);
         return view('admin.city.edit',compact('record','countries','cities','states'));

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
        
        $city = city::find($id); 

   $data = array(
    'city_name'=>$request->input('city_name'),
        'country_id'=>$request->input('country_id'),
        'state_id'=>$request->input('state_id'),

);
         $city->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/city')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
         $city = city::find($request->id);
          $city->delete();

          return $city;
    }

     public function status_update(Request $request){
 
         $record=city::find($request->user_id);
      
          if($record['status']=='Active'){
               $updatevender=\DB::table('cities')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);
            return json_encode('Deactive');
           } else {
              $updateuser=\DB::table('cities')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Active',
                                // 'updated_at' => date('Y-m-d H:i:s') 
                                 ]);
              return json_encode("Active");

        }
           }

    public function check_name(Request $request)
    {

        // return $request->checkstate;
        
      if(!empty($request->check_name)){

        $record = city::where('city_name', $request->check_name)->first();

         if(!empty($record)){
            return "exist";
         }else{
            return "notexist";
         }
      }
      if(!empty($request->check_name_edit)){

        $record = city::where('city_name', $request->check_name_edit)->get();

         if(count($record) <=1){
            return "notexist";
         }else{
            return "exist";
         }
      }
  }



  public function append_state(Request $request)
    {   
             $countryId= $request->id;
         $disticts =\DB::table('states')
                      ->join('countries', 'states.country_id', '=', 'countries.id')
                      ->select('states.*','countries.country_name')
                       ->where("states.country_id",$countryId)
                       ->where("states.status",'Active')
                      ->pluck('states.state_name','states.id');

        

        return json_encode($disticts);
    }


     public function append_city(Request $request)
    {   
             $stateId= $request->id;
         $disticts =\DB::table('cities')
                      ->join('states', 'cities.state_id', '=', 'states.id')
                      ->select('cities.*','states.state_name')
                       ->where("cities.state_id",$stateId)
                       ->where("cities.status",'Active')
                      ->pluck('cities.city_name','cities.id');
                      
        return json_encode($disticts);
    }
}
