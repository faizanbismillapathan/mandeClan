<?php

namespace App\Http\Controllers\admin;

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

class subordersController extends Controller
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
       
      
 $datas=suborder_rider_assignment::where('rider_accept_order_status','Pending')->get();
      
// dd($datas);
      foreach($datas as $data){
        
          $updatevender=\DB::table('suborder_rider_assignments')->where('id',$data->id)
                              ->update([
                                'rider_accept_order_status' => 'Accepted',
                                'rider_status_updated_by'=>'Machin',
                                'rider_status_update_date'=>Carbon::now()->toDateTimeString(),
                                 ]);
           }


        $records=DB::table('suborders')
    ->join('customers','customers.id','suborders.customer_id')
    ->leftjoin('order_delivery_addresses','order_delivery_addresses.order_id','suborders.order_id')
    ->join('stores','stores.id','suborders.store_id')
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
    'suborders.subtotal','suborders.payment_method','suborders.order_status','suborders.id','suborders.grand_total','suborders.total_item','suborders.shipping_charges','stores.store_name','stores.store_email','stores.store_mobile','stores.store_unique_id','suborders.pickup_type','suborders.created_at')

    ->paginate(25);





 $status=['Pending'=>'Pending','Cancelled'=>'Cancelled','Approved'=>'Approved','Ready To Pickup'=>'Ready To Pickup','Dispatch'=>'Dispatch','Delivered'=>'Delivered'];

return view('admin.suborders.index',compact('records','status'));
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function suborder_items($suborder_id)
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




$order=DB::table('suborders')->where('id',$suborder_id)->first();

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
$assigns=\DB::table('suborder_rider_assignments')
->join('rv_user_registrations','rv_user_registrations.id','suborder_rider_assignments.rider_regis_id')
->where('suborder_rider_assignments.suborder_id',$suborder_id)->select('rv_user_name','rider_accept_order_status','suborder_rider_assignments.created_at','suborder_rider_assignments.id','suborder_rider_assignments.rider_status_updated_by','suborder_rider_assignments.rider_status_update_date')
->get();

$assigns_only=\DB::table('suborder_rider_assignments')
->join('rv_user_registrations','rv_user_registrations.id','suborder_rider_assignments.rider_regis_id')
->where('suborder_rider_assignments.suborder_id',$suborder_id)->select('rv_user_name','rider_accept_order_status','suborder_rider_assignments.created_at','suborder_rider_assignments.id')->where('suborder_rider_assignments.rider_accept_order_status','Accepted')
->first();

// dd($assigns);

$users=DB::table('customers')
->where('user_id',$order->customer_user_id)
->select('id','user_id','customer_userid','customer_name as name','customer_email as email','customer_mobile as mobile')
->first();


         return view('admin.suborders.show',compact('order_items','order','addressBook','pending_status_date','approval_status_date','delivered_status_date','ready_to_pickup_status_date','dispatch_status_date','pending','approval','delivered','ready_to_pickup','dispatch','cities','localities','match_riders','assigns','users','assigns_only'));
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



     public function find_riders(Request $request){



$match_riders=DB::table('rv_user_registrations')
->join('localities','localities.id','rv_user_registrations.rv_user_locality')
->join('rider_masters','rv_user_registrations.id','rider_masters.rider_id')
->select('localities.locality_name','rider_masters.rider_userid','rv_user_registrations.rv_user_name','rv_user_registrations.rv_user_mobile','rv_user_registrations.rv_user_email','rv_user_registrations.id','rider_masters.id as master_id')
->where('rv_user_type','like','%' . 'Rider' . '%')
->where('rv_user_registrations.rv_user_city',$request->city_id)
->where('rv_user_registrations.rv_user_locality',$request->locality_id)
->get();

return json_encode($match_riders);

}



    public function re_assign_order(Request $request){

$record=suborder_rider_assignment::find($request->id);


      $suborder_data = array(
'rider_regis_id'=>$record->rider_regis_id,
'suborder_id'=>$record->suborder_id,
'rider_userid'=>$record->rider_userid,
'rider_accept_order_status'=>'Pending',
// 'rider_status_updated_by'=>'Machin',
'rider_status_update_date'=>Carbon::now()->toDateTimeString(),
);

 $suborder_rider_assignment = new suborder_rider_assignment($suborder_data);
         $suborder_rider_assignment->save();


return json_encode($request->id);
    }

 public function assign_order_status_update(Request $request){
 
     
 
         $record=suborder_rider_assignment::find($request->user_id);
      
          if($record['rider_accept_order_status']=='Accepted'){
               $updatevender=\DB::table('suborder_rider_assignments')->where('id',$request->user_id)
                              ->update([
                                'rider_accept_order_status' => 'Rejected',
                                'rider_status_updated_by'=>'Admin',
                                'rider_status_update_date'=>Carbon::now()->toDateTimeString(),
                                 ]);
            return json_encode('Rejected');
           } else {
              $updateuser=\DB::table('suborder_rider_assignments')->where('id',$request->user_id)
                              ->update([
                                'rider_accept_order_status' => 'Accepted',
                                 'rider_status_updated_by'=>'Admin',
                                                                 'rider_status_update_date'=>Carbon::now()->toDateTimeString(),

                                 ]);
              return json_encode("Accepted");

        }
           
    

                          }
     public function suborder_assign_rider(Request $request){


$check=DB::table('suborder_rider_assignments')->where('suborder_id',$request->suborder_id)->where('rider_accept_order_status','Accepted')->first();

    

if (empty($check)) {
    
 $suborder_data = array(
'rider_accept_order_status'=>'Pending',
'rider_regis_id'=>$request->rider_regis_id,
'suborder_id'=>$request->suborder_id,
'rider_userid'=>$request->rider_userid,
'rider_status_update_date'=>Carbon::now()->toDateTimeString(),

);

 $suborder_rider_assignment = new suborder_rider_assignment($suborder_data);
         $suborder_rider_assignment->save();

}else{
 $suborder_data = array(
'rider_regis_id'=>$request->rider_regis_id,
'suborder_id'=>$request->suborder_id,
'rider_userid'=>$request->rider_userid,
);


$updatevender=\DB::table('suborder_rider_assignments')->where('suborder_id',$request->suborder_id)->update($suborder_data);

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
    
 public function user_invoice_view($id)
   {
    
    $record=DB::table('pd_profiles')
    ->first();


    $records = DB::table('user_service_plans')  
    ->leftjoin('user_invoices','user_invoices.user_service_id','user_service_plans.id')
    ->select('user_invoices.*','user_service_plans.user_plan_name','user_service_plans.id','user_service_plans.user_plan_code','user_service_plans.user_plan_price','user_service_plans.status as serv_status','user_service_plans.user_plan_transaction_id','user_service_plans.user_paid_amount','user_service_plans.user_plan_active_date','user_service_plans.user_plan_expiry_date','user_service_plans.user_plan_status','user_invoices.user_total_amount','user_coup_percent','user_coup_amount','user_coup_disc_amount','user_coupon_no','user_reference_no','user_coup_subtotal')

    ->where('user_service_plans.user_id',Auth::user()->id)
    ->where('user_invoices.id',$id)
    ->first(); 


    return view('emails.order_email_body',compact('record','records'));            

  }

  public function order_invoice_pdf($order_id)
  {   
   


$order=  DB::table('orders')
  ->where('id',$order_id)->first();

   $users=DB::table('customers')
->where('user_id',$order->customer_user_id)
->select('id','user_id','customer_userid','customer_name as name','customer_email as email','customer_mobile as mobile')
->first();


    $order_items=DB::table('order_items')
  ->where('order_id',$order_id)->get() ;



   $pdfview= $order->order_u_id.date('Ymd', strtotime($order->created_at));

$addressBook=order_delivery_address::where('order_id',$order_id)->first();

   $pdf =  \PDF::loadView('emails.order_invoice',compact('order_items','order','addressBook','users'));



   return $pdf->download($pdfview.'.pdf');
   

 }


  public function suborder_invoice_pdf($suborder_id)
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
