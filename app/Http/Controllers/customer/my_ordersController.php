<?php

namespace App\Http\Controllers\customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\customer;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Toast;
use App\store;
use App\order_status_management;
use Carbon\Carbon;


class my_ordersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    
      public function __construct()
    { 
        $this->middleware('auth');

// dd('4');

        $this->middleware(function ($request, $next) {
          $uspermit = \Auth::user();

// dd(!in_array($uspermit->role, array(1,2)));

          if ( !in_array($uspermit->role, array('1','3'), false ) ) {

// dd('1');
              return redirect()->action('frontend\frontendController@index'); 

          }else{

            if($uspermit->role == '1' && empty(Session::get('customer_id'))){

// dd('2');
              return redirect()->action('frontend\frontendController@index'); 

          }

      }
 

        if (\auth::user()->role == "3") {
      $customer_id=db::table('customers')
             ->where('user_id',\auth::user()->id)
             ->select('id','user_id')
             ->first();

            $this->id=$customer_id->id; 
$this->user_id=$customer_id->user_id;  

   }elseif (\auth::user()->role == "1") {

                    $this->id=session::get('customer_id');
 $this->user_id=session::get('customer_user_id');
}


      return $next($request);
  });


    }


    public function index()
    {



$record=DB::table('suborders')
->join('customers','customers.id','suborders.customer_id')
->orderBy('suborders.id','desc');

if (!empty($request->search)) {
$term=$request->search;
$record=$record
->where(function($q) use ($term) {
$q
->orWhere('customers.customer_name','like','%' . $$term . '%');
});
}

$record= $record
->select('customers.customer_name','customers.customer_email','customers.customer_mobile','customers.customer_userid','suborders.order_date','suborders.delivery_date','suborders.delivery_time','suborders.suborder_u_id','suborders.customer_u_id',
'suborders.subtotal','suborders.payment_method','suborders.order_status','suborders.id','suborders.grand_total','suborders.total_item','suborders.store_id','suborders.shipping_charges','suborders.pickup_type')
->groupby('suborders.id')
->whereNotIn('suborders.order_status',['Delivered','Cancelled'])
->where('suborders.customer_user_id',$this->user_id)
->paginate(25);


    $records=[];

    foreach($record as $index=>$data){

        $records[]=(object)[
'suborder_u_id'=>$data->suborder_u_id,
'order_date'=>$data->order_date,
'store_info'=>$this->store_informations($data->store_id),
'subtotal'=>$data->subtotal,
'shipping_charges'=>$data->shipping_charges,
'grand_total'=>$data->grand_total,
'pickup_type'=>$data->pickup_type,
'delivery_date'=>$data->delivery_date,
'id'=>$data->id,
'order_status'=>$data->order_status,
'delivery_time'=>$data->delivery_time,

        ];
    }





        return view('customer.orders.index',compact('records','record'));
    }



    public function store_informations($store_id)
    {


    $record=store::where('id',$store_id)->first();

return $record;
}


    public function order_detail($suborder_id)
    {



$orderitems=DB::table('order_items')
->where('order_items.suborder_id',$suborder_id)
->get(); 


$order_items=[];

foreach($orderitems as $index=>$data){

    $order_items[]=(object)[

'product_name'=>$data->product_name,
'item_selling_price'=>$data->item_selling_price,
'item_quantity'=>$data->item_quantity,
'item_shipping_weight'=>$data->item_shipping_weight,
'item_shipping_weight_unit'=>$data->item_shipping_weight_unit,
'addon_details'=>unserialize($data->addon_name_price),
'item_u_id'=>$data->item_u_id,
'item_offer_discount'=>$data->item_offer_discount,
'item_price'=>$data->item_price,
    ];

}

$order=DB::table('suborders')->where('id',$suborder_id) ->where('suborders.customer_user_id',$this->user_id)->first();

// dd($order);

$addressBook=DB::table('order_delivery_addresses')
->where('order_id',$order->order_id)->first();
// dd($id);
// return view('customer.orders.order_detail');
 
$users=DB::table('customers')
->where('user_id',$order->customer_user_id)
->select('id','user_id','customer_userid','customer_name as name','customer_email as email','customer_mobile as mobile')
->first();


return view('customer.orders.order_detail',compact('order_items','order','addressBook','users'));


    }


  public function create()
    {
         $record='';

         return view('customer.orders.create',compact('record'));
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
    
);
         $role = new role($data);
         $role->save();
                 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('customer/my-orders')->with($notification);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show1($id)
    {
                 $view='';

        return view('customer.orders.show',compact('view'));
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
        
         return view('customer.orders.edit',compact('record'));

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

return Redirect::to('customer/my-orders')->with($notification);
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

    





public function track_order($suborder_id)
{   

$record=DB::table('suborders')->where('suborders.id',$suborder_id)
->where('suborders.customer_user_id',$this->user_id)
    ->join('customers','customers.id','suborders.customer_id','order_status')
    ->select('customer_name','order_date')
->first();

// dd($this->user_id);

$order_status=DB::table('order_status_managements')
->join('suborders','suborders.id','order_status_managements.suborder_id')
->where('order_status_managements.suborder_id',$suborder_id)
->where('suborders.customer_user_id',$this->user_id)->get();
    
    // dd($order_status);
$pending='';
$approval='';
$delivered='';
$ready_to_pickup='';
$dispatch='';

$pending_status_date='';
$approval_status_date='';
$delivered_status_date='';
$ready_to_pickup_status_date='';
$dispatch_status_date='';



foreach($order_status as $key=>$data){

if ($data->status=='Pending') {
    $pending=$data->status;
    $pending_status_date=$data->status_date;


}


if ($data->status=='Approval') {
    $approval=$data->status;
    $approval_status_date=$data->status_date;

}

if ($data->status=='Delivered') {
    $delivered=$data->status;
    $delivered_status_date=$data->status_date;

}

if ($data->status=='Ready To Pickup') {
    $ready_to_pickup=$data->status;
    $ready_to_pickup_status_date=$data->status_date;

}

if ($data->status=='Dispatch') {
    $dispatch=$data->status;
    $dispatch_status_date=$data->status_date;

}

}
    
    $header_not_display='Yes';

    return view('frontend.track_order',compact('header_not_display','pending_status_date','approval_status_date','delivered_status_date','ready_to_pickup_status_date','dispatch_status_date','pending','approval','delivered','ready_to_pickup','dispatch','record'));
}



  public function status_update(Request $request){
 
      
    
               $updatevender=\DB::table('suborders')->where('id',$request->id)
                              ->update([
                                'order_status' => $request->value,
                                 ]);

$record=\DB::table('suborders')->where('id',$request->id)->first();

              $suborder_data = array(
'order_id'=>$record->order_id,
'suborder_id'=>$record->id,
'status'=>$request->value,
'status_date'=>Carbon::now()->toDateTimeString(),
'status_resone'=>'',
);


 $order_status_management = new order_status_management($suborder_data);
         $order_status_management->save();

            return json_encode($request->value);
        
           }




           }


