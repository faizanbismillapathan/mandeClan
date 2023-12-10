<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\rider_plan;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;

class rider_planController extends Controller
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
       
        $records=DB::table('rider_plans')->orderBy('id','desc');

         if (!empty($request->search)) {
        $term=$request->search;
$records=$records
->where(function($q) use ($term) {
$q
        ->orWhere('rider_plan_name','like','%' . $term . '%');
    });
}

         $records= $records
        ->paginate(25);



         $use = DB::table('rider_plans')  
                    ->select('rider_plan_name','id')        
   
            ->orderBy('rider_plan_name', 'asc')->get(); 

 $rider_plans = array();
foreach($use as $user) {
$rider_plans[$user->rider_plan_name] = $user->rider_plan_name;
}

//  DB::table('count_masters')
// ->where('id','1')
// ->update([
// 'state_count'=>$count,
// ]);

return view('admin.rider_plan.index',compact('records','rider_plans'));
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $record='';

         return view('admin.rider_plan.create',compact('record'));
    }

    /**
     * rider a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

         $data = array(
        'rider_plan_name'=>$request->input('rider_plan_name'),
        'rider_plan_price'=>$request->input('rider_plan_price'),
        'rider_plan_id'=>$request->input('rider_plan_id'),
        'rider_plan_discount'=>$request->input('rider_plan_discount'),
        'rider_plan_validity'=>$request->input('rider_plan_validity'),
        'rider_product_limit'=>$request->input('rider_product_limit'),
        'rider_plan_features'=>$request->input('rider_plan_features'),
);

// DB::table('rider_plans')->insert($data);


// dd($data);

         $rider_plan = new rider_plan($data);

         $rider_plan->save();
                 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/rider-plan')->with($notification);

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

        return view('admin.rider_plan.show',compact('view'));
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
        $record = rider_plan::find($id);         
        
         return view('admin.rider_plan.edit',compact('record'));

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
        
        $rider_plan = rider_plan::find($id); 

   $data = array(
   'rider_plan_name'=>$request->input('rider_plan_name'),
        'rider_plan_price'=>$request->input('rider_plan_price'),
        'rider_plan_id'=>$request->input('rider_plan_id'),
        'rider_plan_discount'=>$request->input('rider_plan_discount'),
        'rider_plan_validity'=>$request->input('rider_plan_validity'),
        'rider_product_limit'=>$request->input('rider_product_limit'),
        'rider_plan_features'=>$request->input('rider_plan_features'),    
);
         $rider_plan->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/rider-plan')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
         $rider_plan = rider_plan::find($request->id);
          $rider_plan->delete();

          return $rider_plan;
    }

     public function status_update(Request $request){
 
         $record=rider_plan::find($request->user_id);
      
          if($record['status']=='Active'){
               $updatevender=\DB::table('rider_plans')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);
            return json_encode('Deactive');
           } else {
              $updateuser=\DB::table('rider_plans')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Active',
                                // 'updated_at' => date('Y-m-d H:i:s') 
                                 ]);
              return json_encode("Active");

        }
           }

    public function check_rider_plan(Request $request)
    {

        // return $request->checkrider_plan;
        
      if(!empty($request->check_rider_plan)){

        $record = rider_plan::where('rider_plan_name', $request->check_rider_plan)->first();

         if(!empty($record)){
            return "exist";
         }else{
            return "notexist";
         }
      }
      if(!empty($request->check_rider_plan_edit)){

        $record = rider_plan::where('rider_plan_name', $request->check_rider_plan_edit)->get();

         if(count($record) <=1){
            return "notexist";
         }else{
            return "exist";
         }
      }
  }
}
