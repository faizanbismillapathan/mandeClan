<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\store_subscription;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;

class store_subscriptionController extends Controller
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
       
       
        $records=DB::table('store_subscriptions')->orderBy('id','desc');

         if (!empty($request->search)) {
        $term=$request->search;
$records=$records
->where(function($q) use ($term) {
$q
        ->orWhere('store_plan_name','like','%' . $term . '%');
    });
}

         $records= $records
        ->paginate(25);



         $use = DB::table('store_subscriptions')  
                    ->select('store_plan_name','id')        
   
            ->orderBy('store_plan_name', 'asc')->get(); 

 $store_subscriptions = array();
foreach($use as $user) {
$store_subscriptions[$user->store_plan_name] = $user->store_plan_name;
}

//  DB::table('count_masters')
// ->where('id','1')
// ->update([
// 'state_count'=>$count,
// ]);

return view('admin.store_subscription.index',compact('records','store_subscriptions'));
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $record='';

         return view('admin.store_subscription.create',compact('record'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

         $data = array(
        'store_plan_name'=>$request->input('store_plan_name'),
        'store_plan_price'=>$request->input('store_plan_price'),
        'store_plan_id'=>$request->input('store_plan_id'),
        'store_plan_discount'=>$request->input('store_plan_discount'),
        'store_plan_validity'=>$request->input('store_plan_validity'),
        'store_product_limit'=>$request->input('store_product_limit'),
        'store_plan_features'=>$request->input('store_plan_features'),
);

// DB::table('store_subscriptions')->insert($data);


// dd($data);

         $store_subscription = new store_subscription($data);

         $store_subscription->save();
                 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/store-subscription')->with($notification);

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

        return view('admin.store_subscription.show',compact('view'));
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
        $record = store_subscription::find($id);         
        
         return view('admin.store_subscription.edit',compact('record'));

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
        
        $store_subscription = store_subscription::find($id); 

   $data = array(
   'store_plan_name'=>$request->input('store_plan_name'),
        'store_plan_price'=>$request->input('store_plan_price'),
        'store_plan_id'=>$request->input('store_plan_id'),
        'store_plan_discount'=>$request->input('store_plan_discount'),
        'store_plan_validity'=>$request->input('store_plan_validity'),
        'store_product_limit'=>$request->input('store_product_limit'),
        'store_plan_features'=>$request->input('store_plan_features'),    
);
         $store_subscription->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/store-subscription')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
         $store_subscription = store_subscription::find($request->id);
          $store_subscription->delete();

          return $store_subscription;
    }

     public function status_update(Request $request){
 
         $record=store_subscription::find($request->user_id);
      
          if($record['status']=='Active'){
               $updatevender=\DB::table('store_subscriptions')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);
            return json_encode('Deactive');
           } else {
              $updateuser=\DB::table('store_subscriptions')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Active',
                                // 'updated_at' => date('Y-m-d H:i:s') 
                                 ]);
              return json_encode("Active");

        }
           }

    public function check_store_subscription(Request $request)
    {

        // return $request->checkstore_subscription;
        
      if(!empty($request->check_store_subscription)){

        $record = store_subscription::where('store_plan_name', $request->check_store_subscription)->first();

         if(!empty($record)){
            return "exist";
         }else{
            return "notexist";
         }
      }
      if(!empty($request->check_store_subscription_edit)){

        $record = store_subscription::where('store_plan_name', $request->check_store_subscription_edit)->get();

         if(count($record) <=1){
            return "notexist";
         }else{
            return "exist";
         }
      }
  }
}
