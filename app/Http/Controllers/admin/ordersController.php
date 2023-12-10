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
       
        $records=DB::table('orders')
    ->join('customers','customers.id','orders.customer_id')
    // ->join('order_delivery_addresses','order_delivery_addresses.order_id','orders.id')
    ->orderBy('orders.id','desc');

    if (!empty($request->search)) {
   $term=$request->search;
$records=$records
->where(function($q) use ($term) {
$q
    ->orWhere('customers.customer_name','like','%' . $term . '%')
    ->orWhere('customers.customer_email','like','%' . $term . '%')
    ->orWhere('customers.customer_mobile','like','%' . $term . '%')
    ->orWhere('customers.customer_userid','like','%' . $term . '%')
    ->orWhere('orders.order_date','like','%' . $term . '%')
    ->orWhere('orders.delivery_date','like','%' . $term . '%')
    ->orWhere('orders.order_u_id','like','%' . $term . '%')
    ->orWhere('orders.customer_u_id','like','%' . $term . '%')
    ->orWhere('orders.total_suborder','like','%' . $term . '%')
    ->orWhere('orders.payment_method','like','%' . $term . '%')
    ->orWhere('orders.order_status','like','%' . $term . '%')
    ->orWhere('orders.id','like','%' . $term . '%')
     ->orWhere('orders.grand_total','like','%' . $term . '%')
    ->orWhere('orders.total_order_item','like','%' . $term . '%');
});
    }

    $records= $records
    ->select('customers.customer_name','customers.customer_email','customers.customer_mobile','customers.customer_userid','orders.order_date','orders.delivery_date','orders.delivery_time','orders.order_u_id','orders.customer_u_id',
    'orders.total_suborder','orders.payment_method','orders.order_status','orders.id','orders.grand_total','orders.total_order_item','orders.created_at')

    ->paginate(25);




 $status=['Pending'=>'Pending','Cancelled'=>'Cancelled','Approved'=>'Approved','Ready To Pickup'=>'Ready To Pickup','Dispatch'=>'Dispatch','Delivered'=>'Delivered'];


return view('admin.orders.index',compact('records','status'));
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function order_items($order_id)
    {
         
$orderitems=DB::table('order_items')
->where('order_items.order_id',$order_id)
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


$order=DB::table('orders')->where('id',$order_id)->first();

$addressBook=DB::table('order_delivery_addresses')
->where('order_id',$order_id)->first();



$cities=DB::table('cities')
->where('cities.status','Active')
->pluck('cities.city_name','cities.id')->toarray();



// dd($order_items);


$localities=DB::table('localities')
->where('status','Active')
->pluck('locality_name','id')->toarray();
// dd($localities);

$users=DB::table('customers')
->where('user_id',$order->customer_user_id)
->select('id','user_id','customer_userid','customer_name as name','customer_email as email','customer_mobile as mobile')
->first();

// dd($order->customer_u_id);

         return view('admin.orders.show',compact('order_items','order','addressBook','cities','localities','users'));
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
         $data = array(
    'order_name'=>$request->input('order_name'),
    
);
         $orders = new orders($data);
         $orders->save();
                 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/orders')->with($notification);

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

        return view('admin.orders.show',compact('view'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $order = order::find($id);         
        
         return view('admin.orders.edit',compact('order'));

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
        
        $orders = order::find($id); 

   $data = array(
    'order_name'=>$request->input('order_name'),
    
);
         $orders->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/orders')->with($notification);
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
 
      
       
               $updatevender=\DB::table('orders')->where('id',$request->id)
                              ->update([
                                'order_status' => $request->value,
                                 ]);
            return json_encode($request->value);
        
           }



    public function check_unique_name(Request $request)
    {

        // return $request->checkunique_name;
        
      if(!empty($request->check_unique_name)){

        $record = order::where('order_name', $request->check_unique_name)->first();

         if(!empty($record)){
            return "exist";
         }else{
            return "notexist";
         }
      }
      if(!empty($request->check_unique_name_edit)){

        $record = order::where('order_name', $request->check_unique_name_edit)->get();

         if(count($record) <=1){
            return "notexist";
         }else{
            return "exist";
         }
      }
  }

       public function dummy_orders($id){

$users=DB::table('customers')
->where('id',2)
->select('id','user_id','customer_userid')
->first();

// $item=DB::table('products')
// ->where('id',$id)
// ->select('id','product_unique_id','product_name','product_price')
// ->first();


$shop=DB::table('stores')
->where('id',Session::get('store_id'))
->select(
'id',
'store_latitude',
'store_longitude',
'store_city',
'store_locality',
)
->first();

$invoices=DB::table('invoice_settings')

->select( 'order_id_prefix','order_id_postfix','suborder_id_prefix','suborder_id_postfix','invoice_terms','invoice_logo','invoice_signature')
->first();



      $data = array(
'customer_id'=>$users->id,
'customer_user_id'=>$users->user_id,
'customer_u_id'=>$users->customer_userid,
'payment_method'=>'COD',
'total_tip_price'=>'10',
'tip_order_status'=>'Paid',
'expected_delivery_date'=>Carbon::now()->addDays(1),
'transection_id'=>'TRANSECTION001',
'order_date'=>'2021-08-12',
'total_order_qty'=>6,
'total_store_wise_order'=>3,
'paid_unpaid_status'=>'Unpaid',
'subtotal'=>5259.51,
'coupan_discount'=>0,
'total_dilevery_charges'=>30,
'grand_total'=>5289.51,
    
);
         $order = new order($data);
         $order->save();
                 
  DB::table('orders')
  ->where('id',$order->id)
  ->update([
'order_u_id'=>$invoices->order_id_prefix.date("Y").$order->id.$shop->store_city.$shop->store_locality.$invoices->order_id_postfix,

  ]);


$stores=DB::table('stores')
->join('products','products.store_id','stores.id')
->where('stores.id',Session::get('store_id'))
// ->whereIn('products.id',[1,2])
->select('stores.id',
'stores.store_latitude',
'stores.store_longitude',
'stores.store_city',
'stores.store_locality',
'stores.user_id',
'stores.store_unique_id',
// 'products.id as product_id','products.product_unique_id','products.product_name','products.product_price'
)
->groupby('stores.id')
->get();

// dd($stores);

foreach($stores as $index=>$shop)
{

    $data = array(
'store_id'=>$shop->id,
'store_user_id'=>$shop->user_id,
'store_u_id'=>$shop->store_unique_id,
'customer_id'=>$users->id,
'customer_user_id'=>$users->user_id,
'customer_u_id'=>$users->customer_userid,
'order_u_id'=>$order->order_u_id,

// 'store_wise_order_u_id'=>$invoices->suborder_id_prefix.date("Y").$shop->store_city.$shop->store_locality.$invoices->suborder_id_postfix,

'delivery_date'=>Carbon::now()->addDays(1),
'payment_method'=>'COD',
'tip_price'=>10,
'tip_order_status'=>'Paid',
'transection_id'=>'transection002',
'store_wise_order_qty'=>2,
// 'total_store_wise_order'=>$shop->total_store_wise_order,
'paid_unpaid_status'=>'Unpaid',
// 'product_id'=>$shop->product_id,
// 'product_u_id'=>$shop->product_unique_id,
// 'product_name'=>$shop->product_name,
// 'product_qty'=>2,
// 'product_price'=>$shop->product_price,
// 'total_tax'=>$shop->total_tax,
'shipping_charges'=>10,
'subtotal'=>1753.17,
'gift_packing_charges'=>0,
'dilevery_charges'=>10,
'grand_total'=>1763.17,
// 'store_invoice_no'=>$shop->store_invoice_no,
);



 $store_wise_order = new store_wise_order($data);
         $store_wise_order->save();

                 
  DB::table('store_wise_orders')
  ->where('id',$order->id)
  ->update([
'store_wise_order_u_id'=>$invoices->suborder_id_prefix.date("Y").$store_wise_order->id.$shop->store_city.$shop->store_locality.$invoices->suborder_id_postfix,

  ]);


$products=DB::table('stores')
->join('products','products.store_id','stores.id')
->whereIn('products.id',[1,2])
->where('stores.id',$shop->id)
->get();

// dd($products);

foreach($products as $index=>$item)
{

  $data = array(
'product_id'=>$item->id,
'product_u_id'=>$item->product_unique_id,
'product_name'=>$item->product_name,
'product_qty'=>1,
'product_price'=>$item->product_price,
'order_detail'=>$item->product_description,
'product_category'=>$item->product_category,
'order_id'=>$order->id,
'store_id'=>$shop->id,
// 'store_wise_order_id'=>$item->store_wise_order,
'product_brand'=>$item->product_brand,
'product_key_features'=>$item->product_key_features,
'product_wg_duration'=>$item->product_wg_duration,
'product_wg_dmy'=>$item->product_wg_dmy,
'product_wg_type'=>$item->product_wg_type,
'product_video_url'=>$item->product_video_url,
'product_modal_number'=>$item->product_modal_number,
'product_hsn_sac_code'=>$item->product_hsn_sac_code,
'product_sku'=>$item->product_sku,
'product_offer_price'=>$item->product_offer_price,
'product_offer_discount'=>$item->product_offer_discount,
'product_gift_charge'=>$item->product_gift_charge,
'product_tags'=>$item->product_tags,
);

 $order_item = new order_item($data);
         $order_item->save();

    
}


  $data = array(

'order_id'=>$order->id,
'store_wise_order_id'=>$store_wise_order->id,
'store_id'=>$shop->id,
'store_latitude'=>$shop->store_latitude,
'store_longitude'=>$shop->store_longitude,
'customer_latitude'=>'21.1653977',
'customer_longitude'=>'79.08183',

    );

 $order_address = new order_address($data);
         $order_address->save();


}



$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);



}


}
