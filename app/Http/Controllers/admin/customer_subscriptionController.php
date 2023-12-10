<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\customer_subscription;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;

class customer_subscriptionController extends Controller
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
       
       
        $records=DB::table('customer_subscriptions')->orderBy('id','desc');

         if (!empty($request->search)) {
         $term=$request->search;
$records=$records
->where(function($q) use ($term) {
$q
        ->orWhere('customer_plan_name','like','%' . $term . '%');
    });
}

         $records= $records
        ->paginate(25);



         $use = DB::table('customer_subscriptions')  
                    ->select('customer_plan_name','id')        
   
            ->orderBy('customer_plan_name', 'asc')->get(); 

 $customer_subscriptions = array();
foreach($use as $user) {
$customer_subscriptions[$user->customer_plan_name] = $user->customer_plan_name;
}

//  DB::table('count_masters')
// ->where('id','1')
// ->update([
// 'state_count'=>$count,
// ]);

return view('admin.customer_subscription.index',compact('records','customer_subscriptions'));
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $record='';

         return view('admin.customer_subscription.create',compact('record'));
    }

    /**
     * customer a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function customer(Request $request)
    {

         $data = array(
        'customer_plan_name'=>$request->input('customer_plan_name'),
        'customer_plan_price'=>$request->input('customer_plan_price'),
        'customer_plan_id'=>$request->input('customer_plan_id'),
        'customer_plan_discount'=>$request->input('customer_plan_discount'),
        'customer_plan_validity'=>$request->input('customer_plan_validity'),
        'customer_product_limit'=>$request->input('customer_product_limit'),
        'customer_plan_features'=>$request->input('customer_plan_features'),
);

// DB::table('customer_subscriptions')->insert($data);


// dd($data);

         $customer_subscription = new customer_subscription($data);

         $customer_subscription->save();
                 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/customer-subscription')->with($notification);

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

        return view('admin.customer_subscription.show',compact('view'));
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
        $record = customer_subscription::find($id);         
        
         return view('admin.customer_subscription.edit',compact('record'));

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
        
        $customer_subscription = customer_subscription::find($id); 

   $data = array(
   'customer_plan_name'=>$request->input('customer_plan_name'),
        'customer_plan_price'=>$request->input('customer_plan_price'),
        'customer_plan_id'=>$request->input('customer_plan_id'),
        'customer_plan_discount'=>$request->input('customer_plan_discount'),
        'customer_plan_validity'=>$request->input('customer_plan_validity'),
        'customer_product_limit'=>$request->input('customer_product_limit'),
        'customer_plan_features'=>$request->input('customer_plan_features'),    
);
         $customer_subscription->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/customer-subscription')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
         $customer_subscription = customer_subscription::find($request->id);
          $customer_subscription->delete();

          return $customer_subscription;
    }

     public function status_update(Request $request){
 
         $record=customer_subscription::find($request->user_id);
      
          if($record['status']=='Active'){
               $updatevender=\DB::table('customer_subscriptions')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);
            return json_encode('Deactive');
           } else {
              $updateuser=\DB::table('customer_subscriptions')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Active',
                                // 'updated_at' => date('Y-m-d H:i:s') 
                                 ]);
              return json_encode("Active");

        }
           }

    public function check_customer_subscription(Request $request)
    {

        // return $request->checkcustomer_subscription;
        
      if(!empty($request->check_customer_subscription)){

        $record = customer_subscription::where('customer_plan_name', $request->check_customer_subscription)->first();

         if(!empty($record)){
            return "exist";
         }else{
            return "notexist";
         }
      }
      if(!empty($request->check_customer_subscription_edit)){

        $record = customer_subscription::where('customer_plan_name', $request->check_customer_subscription_edit)->get();

         if(count($record) <=1){
            return "notexist";
         }else{
            return "exist";
         }
      }
  }
}
