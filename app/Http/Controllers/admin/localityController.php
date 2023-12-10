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
use App\locality;

class localityController extends Controller
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
         
          $records=DB::table('localities')
                 ->join('cities','localities.city_id','cities.id')
               ->join('states','cities.state_id','states.id')
              ->join('countries','states.country_id','countries.id')
       ->select('localities.id','cities.city_name','countries.country_name','localities.status','states.state_name','localities.locality_name','localities.pincode');

               if (!empty($request->search)) {
  $term=$request->search;
$records=$records
->where(function($q) use ($term) {
$q
     ->orWhere('countries.country_name','like','%' . $term . '%')
     ->orWhere('states.state_name','like','%' . $term . '%')
     ->orWhere('localities.locality_name','like','%' . $term . '%')
          ->orWhere('localities.pincode','like','%' . $term . '%')

     ->orWhere('cities.city_name','like','%' . $term . '%');
 });
}  

$records=  $records
->orderBy('cities.updated_at','desc')

        ->paginate(25);



  $use = DB::table('localities')  
                 ->join('cities','localities.city_id','cities.id')

                    ->select('cities.city_name','cities.id')        
   
            ->orderBy('cities.city_name', 'asc')->get(); 

 $citys = array();
foreach($use as $user) {
$citys[$user->city_name] = $user->city_name;
}


//  DB::table('counts')
// ->where('id','1')
// ->update([
// 'state_count'=>$count,
// ]);



return view('admin.locality.index',compact('records','citys'));
   
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


 $cities = DB::table('cities')  
                    ->select('city_name','id')
                     ->where('status','Active')
            ->orderBy('city_name', 'asc')->pluck('city_name','id'); 



         return view('admin.locality.create',compact('countries','states','cities'));
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
            'city_id'=>$request->input('city_id'),
            'locality_name'=>$request->input('locality_name'),
            'pincode'=>$request->input('pincode'),
            'locality_url'=>str_replace(' ','-',strtolower($request->locality_name)),

);
         $locality = new locality($data);
         $locality->save();
                 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/locality')->with($notification);

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

        return view('admin.locality.show',compact('view'));
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
        $record = locality::find($id);         
        
        $countries = DB::table('countries')  
                    ->select('country_name','id')
                     ->where('status','Active')
            ->orderBy('country_name', 'asc')->pluck('country_name','id'); 



  $states = DB::table('countries')
            ->join('states', 'countries.id', '=', 'states.country_id')
             ->where('countries.id','=', $record['country_id'])
              ->where("states.status",'Active')
            ->pluck('states.state_name','states.id');

             $cities = DB::table('states')
            ->join('cities', 'states.id', '=', 'cities.state_id')
             ->where('states.id','=', $record['state_id'])
              ->where("cities.status",'Active')
            ->pluck('cities.city_name','cities.id');


         return view('admin.locality.edit',compact('record','countries','cities','states'));

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
        
        $locality = locality::find($id); 

   $data = array(
            'city_id'=>$request->input('city_id'),
            'locality_name'=>$request->input('locality_name'),
        'country_id'=>$request->input('country_id'),
        'state_id'=>$request->input('state_id'),
                    'pincode'=>$request->input('pincode'),
                    'locality_url'=>str_replace(' ','-',strtolower($request->locality_name)),


);
         $locality->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/locality')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
         $locality = locality::find($request->id);
          $locality->delete();

          return $locality;
    }

     public function status_update(Request $request){
 
         $record=locality::find($request->user_id);
      
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

        $record = locality::where('locality_name', $request->check_name)->first();

         if(!empty($record)){
            return "exist";
         }else{
            return "notexist";
         }
      }
      if(!empty($request->check_name_edit)){

        $record = locality::where('locality_name', $request->check_name_edit)->get();

         if(count($record) <=1){
            return "notexist";
         }else{
            return "exist";
         }
      }
  }





     public function append_city(Request $request)
    {   
             $stateId= $request->id;
         $disticts =\DB::table('cities')
                      ->join('states', 'cities.state_id', '=', 'states.id')
                       ->where("cities.state_id",$stateId)
                       ->where("cities.status",'Active')
                      ->pluck('cities.city_name','cities.id');
                      
        return json_encode($disticts);
    }



     public function append_locality(Request $request)
    {   
             $cityId= $request->id;
         $disticts =\DB::table('localities')
                      ->join('cities', 'localities.city_id', '=', 'cities.id')
                       ->where("localities.city_id",$cityId)
                       ->where("localities.status",'Active')
                      ->pluck('localities.locality_name','localities.id');
                      
        return json_encode($disticts);
    }



     public function append_pincode(Request $request)
    {   
             $Id= $request->id;
         $disticts =\DB::table('localities')
                     ->where("localities.id",$Id)
                      ->select('localities.pincode','localities.id')->first();
                      
        return json_encode($disticts->pincode);
    }

}
