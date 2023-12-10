<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\tax_rate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;
use App\zone;

class tax_rateController extends Controller
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
       
        $records=DB::table('tax_rates')
->join('zones','zones.id','tax_rates.tax_zone')
        ->orderBy('tax_rates.id','desc');

         if (!empty($request->search)) {
         $term=$request->search;
$records=$records
->where(function($q) use ($term) {
$q
        ->orWhere('tax_rates.tax_name','like','%' . $term . '%');
    });
}

         $records= $records
         ->select('tax_rates.*','zones.zone_name')
        ->paginate(25);



         $use = DB::table('tax_rates')  
                    ->select('tax_name','id')        
   
            ->orderBy('tax_name', 'asc')->get(); 

 $tax_rates = array();
foreach($use as $user) {
$tax_rates[$user->tax_name] = $user->tax_name;
}

//  DB::table('count_masters')
// ->where('id','1')
// ->update([
// 'state_count'=>$count,
// ]);

return view('admin.tax_rates.index',compact('records','tax_rates'));
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $zones=zone::pluck('zone_name','id');

         return view('admin.tax_rates.create',compact('zones'));
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
    'tax_name'=>$request->input('tax_name'),
    'tax_zone'=>$request->input('tax_zone'),
    'tax_type'=>$request->input('tax_type'),
    'tax_rate'=>$request->input('tax_rate')
    
);
         $tax_rate = new tax_rate($data);
         $tax_rate->save();
                 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/tax-rate')->with($notification);

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

        return view('admin.tax_rates.show',compact('view'));
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
        $record = tax_rate::find($id);         
        
                 $zones=zone::pluck('zone_name','id');

         return view('admin.tax_rates.edit',compact('record','zones'));

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
        
        $tax_rate = tax_rate::find($id); 

   $data = array(
    'tax_name'=>$request->input('tax_name'),
    'tax_zone'=>$request->input('tax_zone'),
    'tax_type'=>$request->input('tax_type'),
    'tax_rate'=>$request->input('tax_rate')    
);
         $tax_rate->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/tax-rate')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
         $tax_rate = tax_rate::find($request->id);
          $tax_rate->delete();

          return $tax_rate;
    }

     public function status_update(Request $request){
 
         $record=tax_rate::find($request->user_id);
      
          if($record['status']=='Active'){
               $updatevender=\DB::table('tax_rates')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);
            return json_encode('Deactive');
           } else {
              $updateuser=\DB::table('tax_rates')->where('id',$request->user_id)
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

        $record = tax_rate::where('tax_name', $request->check_unique_name)->first();

         if(!empty($record)){
            return "exist";
         }else{
            return "notexist";
         }
      }
      if(!empty($request->check_unique_name_edit)){

        $record = tax_rate::where('tax_name', $request->check_unique_name_edit)->get();

         if(count($record) <=1){
            return "notexist";
         }else{
            return "exist";
         }
      }
  }
}
