<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\service_subscription;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;

class service_subscriptionController extends Controller
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
       
       
        $records=DB::table('service_subscriptions')->orderBy('id','desc');

         if (!empty($request->search)) {
         $term=$request->search;
$records=$records
->where(function($q) use ($term) {
$q
        ->orWhere('service_plan_name','like','%' . $term . '%');
    });
}

         $records= $records
        ->paginate(25);



         $use = DB::table('service_subscriptions')  
                    ->select('service_plan_name','id')        
   
            ->orderBy('service_plan_name', 'asc')->get(); 

 $service_subscriptions = array();
foreach($use as $user) {
$service_subscriptions[$user->service_plan_name] = $user->service_plan_name;
}


return view('admin.service_subscription.index',compact('records','service_subscriptions'));
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $record='';

         return view('admin.service_subscription.create',compact('record'));
    }

    /**
     * service a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

         $data = array(
        'service_plan_name'=>$request->input('service_plan_name'),
        'service_plan_price'=>$request->input('service_plan_price'),
        'service_plan_id'=>$request->input('service_plan_id'),
        'service_plan_discount'=>$request->input('service_plan_discount'),
        'service_plan_validity'=>$request->input('service_plan_validity'),
        'service_product_limit'=>$request->input('service_product_limit'),
        'service_plan_features'=>$request->input('service_plan_features'),
);



         $service_subscription = new service_subscription($data);

         $service_subscription->save();
                 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/service-subscription')->with($notification);

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

        return view('admin.service_subscription.show',compact('view'));
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
        $record = service_subscription::find($id);         
        
         return view('admin.service_subscription.edit',compact('record'));

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
        
        $service_subscription = service_subscription::find($id); 

   $data = array(
   'service_plan_name'=>$request->input('service_plan_name'),
        'service_plan_price'=>$request->input('service_plan_price'),
        'service_plan_id'=>$request->input('service_plan_id'),
        'service_plan_discount'=>$request->input('service_plan_discount'),
        'service_plan_validity'=>$request->input('service_plan_validity'),
        'service_product_limit'=>$request->input('service_product_limit'),
        'service_plan_features'=>$request->input('service_plan_features'),    
);
         $service_subscription->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/service-subscription')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
         $service_subscription = service_subscription::find($request->id);
          $service_subscription->delete();

          return $service_subscription;
    }

     public function status_update(Request $request){
 
         $record=service_subscription::find($request->user_id);
      
          if($record['status']=='Active'){
               $updatevender=\DB::table('service_subscriptions')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);
            return json_encode('Deactive');
           } else {
              $updateuser=\DB::table('service_subscriptions')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Active',
                                // 'updated_at' => date('Y-m-d H:i:s') 
                                 ]);
              return json_encode("Active");

        }
           }

    public function check_service_subscription(Request $request)
    {

        
      if(!empty($request->check_service_subscription)){

        $record = service_subscription::where('service_plan_name', $request->check_service_subscription)->first();

         if(!empty($record)){
            return "exist";
         }else{
            return "notexist";
         }
      }
      if(!empty($request->check_service_subscription_edit)){

        $record = service_subscription::where('service_plan_name', $request->check_service_subscription_edit)->get();

         if(count($record) <=1){
            return "notexist";
         }else{
            return "exist";
         }
      }
  }
}
