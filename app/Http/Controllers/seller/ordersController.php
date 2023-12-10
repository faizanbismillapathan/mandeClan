<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\user;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;
use App\order;
use App\order_address;
use App\store_wise_order;
use App\order_item;
use App\suborder;
use App\order_status_management;
use App\suborder_rider_assignment;
use App\order_delivery_address;

class ordersController extends Controller
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

          if ( !in_array($uspermit->role, array('1','2'), false ) ) {

// dd('1');
              return redirect()->action('frontend\frontendController@index'); 

          }else{

            if($uspermit->role == '1'  && empty(session::get('store_id'))){

// dd('2');
              return redirect()->action('frontend\frontendController@index'); 

          }

      }

      if (\Auth::user()->role == "2") {
      $store_id=DB::table('stores')
             ->where('user_id',\Auth::user()->id)
             ->select('id','user_id','status','kyc_status')
             ->first();

             if ($store_id->kyc_status=='deactive') {
                 
              return redirect()->action('frontend\frontendcontroller@index'); 

             }
$this->id=$store_id->id; 
$this->user_id=$store_id->user_id;  

   }elseif (\Auth::user()->role == "1") {

                    $this->id=session::get('store_id');
 
$this->user_id=session::get('store_user_id');
}


return $next($request);
  });


    }
    
        public function index(Request $request)
    {
       
        $records=DB::table('suborders')
    ->join('customers','customers.id','suborders.customer_id')
    ->leftjoin('order_delivery_addresses','order_delivery_addresses.order_id','suborders.order_id')
    ->orderBy('suborders.id','desc');

   if (!empty($request->search)) {
          $term=$request->search;
$records=$records
    ->where(function($q) use ($term) {
       $q
    ->orWhere('order_delivery_addresses.customer_address','like','%' . $term . '%')
    ->orWhere('customers.customer_name','like','%' . $term . '%')
    ->orWhere('customers.customer_email','like','%' . $term . '%')
    ->orWhere('customers.customer_mobile','like','%' . $term . '%')
    ->orWhere('customers.customer_userid','like','%' . $term . '%')
    ->orWhere('suborders.order_date','like','%' . $term . '%')
    ->orWhere('suborders.delivery_date','like','%' . $term . '%')
    ->orWhere('suborders.suborder_u_id','like','%' . $term . '%')
    ->orWhere('suborders.customer_u_id','like','%' . $term . '%')
    ->orWhere('suborders.payment_method','like','%' . $term . '%')
    ->orWhere('suborders.order_status','like','%' . $term . '%')
    ->orWhere('suborders.id','like','%' . $term . '%')
     ->orWhere('suborders.grand_total','like','%' . $term . '%');
     });
    }

    $records= $records
    ->select('order_delivery_addresses.customer_address','customers.customer_name','customers.customer_email','customers.customer_mobile','customers.customer_userid','suborders.order_date','suborders.delivery_date','suborders.delivery_time','suborders.suborder_u_id','suborders.customer_u_id',
    'suborders.subtotal','suborders.payment_method','suborders.order_status','suborders.id','suborders.grand_total','suborders.total_item','suborders.pickup_type','suborders.created_at')
    ->where('suborders.store_id',$this->id)

    ->paginate(25);


    // dd($this->id);



 $status=['Pending'=>'Pending','Cancelled'=>'Cancelled','Approved'=>'Approved','Ready To Pickup'=>'Ready To Pickup','Dispatch'=>'Dispatch','Delivered'=>'Delivered'];


return view('seller.orders.index',compact('records','status'));
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function suborder_items($suborder_id)
    {
         
// $order_items=DB::table('order_items')
// ->where('order_items.suborder_id',$suborder_id)
// ->get(); 

        
$orderitems=DB::table('order_items')
->where('order_items.suborder_id',$suborder_id)
->get(); 


// dd($orderitems);
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




$order=DB::table('suborders')->where('id',$suborder_id) ->where('suborders.store_id',$this->id)->first();

$addressBook=DB::table('order_delivery_addresses')
->where('order_id',$order->order_id)->first();




$order_status=DB::table('order_status_managements')->where('suborder_id',$suborder_id)->get();




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


$cities=DB::table('cities')
->where('cities.status','Active')
->pluck('cities.city_name','cities.id')->toarray();


$localities=DB::table('localities')
->where('status','Active')
->pluck('locality_name','id')->toarray();









$match_riders=DB::table('rv_user_registrations')
// ->join('cities','cities.id','rv_user_registrations.rv_user_city')
->join('localities','localities.id','rv_user_registrations.rv_user_locality')
->join('rider_masters','rv_user_registrations.id','rider_masters.rider_id')
->select('localities.locality_name','rider_masters.rider_userid','rv_user_registrations.rv_user_name','rv_user_registrations.rv_user_mobile','rv_user_registrations.rv_user_email','rv_user_registrations.id','rider_masters.id as master_id')
->where('rv_user_type','like','%' . 'Rider' . '%')
// ->where('rv_user_registrations.rv_user_city',$addressBook->customer_city)
// ->where('rv_user_registrations.rv_user_locality',$addressBook->customer_locality)

;

if (!empty($request->locality)) {
$match_riders=$match_riders
->Where('rv_user_registrations.rv_user_userid',$request->search);
}
$match_riders=$match_riders
->get();


// dd($match_riders);


$users=DB::table('customers')
->where('user_id',$order->customer_user_id)
->select('id','user_id','customer_userid','customer_name as name','customer_email as email','customer_mobile as mobile')
->first();



         return view('seller.orders.show',compact('order_items','order','addressBook','pending_status_date','approval_status_date','delivered_status_date','ready_to_pickup_status_date','dispatch_status_date','pending','approval','delivered','ready_to_pickup','dispatch','cities','localities','match_riders','users'));
    }



public function addon_details($id,$order_id)
    {

$table=DB::table('order_addons')
->where('order_addons.item_id',$id)
->where('order_addons.order_id',$order_id)
->select('order_addons.addon_name','order_addons.addon_price')
->get();


return $table;



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
         $orders = order::find($request->id);

         $suborder=suborder::where('order_id',$request->id)
         ->select('id')
         ->get();

         foreach($suborder as $data){

        $suborder = suborder::find($data->id);

        $suborder->delete();


         }


          $order_item=order_item::where('order_id',$request->id)
         ->select('id')
         ->get();

         foreach($order_item as $data1){

        $order_item = order_item::find($data1->id);

        $order_item->delete();


         }


          $orders->delete();

          return $orders;
    }

     public function status_update(Request $request){
 
      
    
               $updatevender=\DB::table('suborders')->where('id',$request->id)
                ->where('suborders.store_id',$this->id)
                              ->update([
                                'order_status' => $request->value,
                                 ]);

$record=\DB::table('suborders')->where('id',$request->id) ->where('suborders.store_id',$this->id)->first();

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



     public function find_riders(Request $request){



$match_riders=DB::table('rv_user_registrations')
->join('localities','localities.id','rv_user_registrations.rv_user_locality')
->join('rider_masters','rv_user_registrations.id','rider_masters.rider_id')
->select('localities.locality_name','rider_masters.rider_userid','rv_user_registrations.rv_user_name','rv_user_registrations.rv_user_mobile','rv_user_registrations.rv_user_email','rv_user_registrations.id','rider_masters.id as master_id')
->where('rv_user_type','like','%' . 'Rider' . '%')
;

if (!empty($request->locality)) {
$match_riders=$match_riders

->where('rv_user_registrations.rv_user_city',$addressBook->city_id)
->where('rv_user_registrations.rv_user_locality',$addressBook->locality_id);

}
$match_riders=$match_riders
->get();

return json_encode($match_riders);

}


     public function suborder_assign_rider(Request $request){


$check=DB::table('suborder_rider_assignments')->where('suborder_id',$request->suborder_id)->first();

     $suborder_data = array(
'status'=>'pending',
'rider_regis_id'=>$request->rider_regis_id,
'suborder_id'=>$request->suborder_id,
'rider_userid'=>$request->rider_userid,
);


if (empty($check)) {
    

 $suborder_rider_assignment = new suborder_rider_assignment($suborder_data);
         $suborder_rider_assignment->save();

}else{


               $updatevender=\DB::table('suborder_rider_assignments')->where('suborder_id',$request->suborder_id)->update($data);

}


$updatevender=\DB::table('suborders')->where('id',$request->suborder_id)
                              ->update([
                                'order_status' => 'Ready To Pickup',
                                 ]);

$record=\DB::table('suborders')->where('id',$request->suborder_id)->first();

              $suborder_data = array(
'order_id'=>$record->order_id,
'suborder_id'=>$record->id,
'status'=>'Ready To Pickup',
'status_date'=>Carbon::now()->toDateTimeString(),
'status_resone'=>'',
);


 $order_status_management = new order_status_management($suborder_data);
         $order_status_management->save();


return Redirect::back();

}



  public function order_invoice_pdf($suborder_id)
  {   
   

$order=  DB::table('suborders')
  ->where('id',$suborder_id)->first();

   $users=DB::table('customers')
->where('user_id',$order->customer_user_id)
->select('id','user_id','customer_userid','customer_name as name','customer_email as email','customer_mobile as mobile')
->first();


    $order_items=DB::table('order_items')
  ->where('suborder_id',$suborder_id)->get() ;



   $pdfview= $order->suborder_u_id.date('Ymd', strtotime($order->created_at));

$addressBook=order_delivery_address::where('order_id',$order->order_id)->first();

   $pdf =  \PDF::loadView('emails.order_invoice',compact('order_items','order','addressBook','users'));



   return $pdf->download($pdfview.'.pdf');
   

 }



}
