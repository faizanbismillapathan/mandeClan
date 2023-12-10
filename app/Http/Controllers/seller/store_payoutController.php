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
use App\store;
use App\suborder;
use App\order_item;
use App\product;


class store_payoutController extends Controller
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
             ->select('id','user_id')
             ->first();

            $this->id=$store_id->id; 
$this->user_id=$store_id->user_id;  

   }elseif (\Auth::user()->role == "1") {

                    $this->id=session::get('store_id');
 $this->user_id=session::get('store_user_id');
}

   
return $next($request);
  });


    }


     public function store_payout(Request $request)
    {
               $record=store::find($this->id);

// 849

$from = $request->from_date;
$to = $request->to_date;

$suborders=suborder::where('suborders.store_id',$this->id)
->whereBetween(DB::raw('DATE(order_date)'), [$from, $to])
->get();

$records=[];

foreach($suborders as $index=>$data){

$records[]=(object)[
'store_id'=>$data->store_id,
'id'=>$data->id,
'created_at'=>$data->created_at,
'suborder_u_id'=>$data->suborder_u_id,
'total_item'=>$data->total_item,
'total_item_weight'=>$this->total_item_weights($data->id),
'total_item_price'=>$this->total_item_prices($data->id),
'delevery_status'=>$data->order_status,
'Status'=>$data->paid_unpaid_status,
];

}


        return view('seller.payouts.store_payout',compact('record','records'));
    }

 


   public function total_item_weights($suborder_id)
    {
                 $view=DB::table('order_items')->where('suborder_id',$suborder_id)->sum('item_shipping_weight');

        return $view;
    }




   public function total_item_prices($suborder_id)
    {
                               $view=DB::table('order_items')->where('suborder_id',$suborder_id)->sum('item_selling_price');


        return $view;
    }



   //      public function store_invoices(Request $request)
   //  {

   //      return view('seller.payouts.store_invoices');
   
   //  }


   // public function store_item_wise_payout(Request $request)
   //  {
   //               $view='';

   //      return view('seller.payouts.store_item_wise_payout',compact('view'));
   //  }


    

     public function store_item_wise_payout($id=null,Request $request)
    {
    
    $record=store::find($this->id);



$from = $request->from_date;
$to = $request->to_date;



if (!empty($id)) {
    $order_items=order_item::where('order_items.suborder_id',$id)
    ->whereBetween('created_at', [$from, $to])

->get();
}else{

    $order_items=order_item::where('order_items.store_id',$this->id)
->whereBetween('created_at', [$from, $to])

    ->get();
}

$records=[];

foreach($order_items as $index=>$data){

// dd($data->commission_amount);
$records[]=(object)[
'store_id'=>$data->store_id,
'id'=>$data->id,
'created_at'=>$data->created_at,
'item_u_id'=>$data->item_u_id,
'item_sku'=>$data->item_sku,
'category_name'=>$this->categorys($data->product_id),
'product_category'=>$this->product_categorys($data->product_id),
'product_name'=>$data->product_name,
'product_attributes'=>$this->attributes_funct($data->product_id),
'item_shipping_weight'=>$data->item_shipping_weight,
'item_shipping_weight_unit'=>$data->item_shipping_weight_unit,
'item_shipping_price'=>$data->item_shipping_price,
'total_Weight'=>$data->item_shipping_weight*$data->item_quantity,
'item_tax_price'=>$data->item_tax_price,
'item_selling_price'=>$data->item_selling_price,
'commission_amount'=>$data->commission_amount,
'commission_percent'=>$data->commission_percent,
'order_status'=>$this->order_status_function($data->suborder_id),
'paid_unpaid_status'=>$this->paid_unpaid_status_function($data->suborder_id),
'total_price'=>$data->item_selling_price*$data->item_quantity,
'item_quantity'=>$data->item_quantity,
];

}


// dd($records);

        return view('seller.payouts.store_item_wise_payout',compact('record','records'));
   

    }




public function categorys($id)
{

$product=product::find($id);



if (!empty($product->category)) {
    
    return $product->category->product_category;
}else{
    return '';
}

    // $categories=DB::table('store_categories')
    // ->where('id',$id)
    // ->select('category_name')
    // ->first();


}



public function product_categorys($id)
{

$product=product::find($id);

if (!empty($product->subcategory)) {
    
    return $product->subcategory->product_subcategory;
}else{
    return '';
}

}


public function attributes_funct($id)
{

    // dd($id);

    $attributes=DB::table('product_attributes')
    ->where('product_id',$id)
    ->pluck('attribute_name','attribute_name')
    ->toArray();


    

    return implode(',',$attributes);

}



public function order_status_function($id)
{

$record=DB::table('suborders')->where('id',$id)->first();

return $record->order_status;

}


public function paid_unpaid_status_function($id)
{


$record=DB::table('suborders')->where('id',$id)->first();

return $record->paid_unpaid_status;
}




     public function store_item_wise_pdf_payout($id=null,Request $request)
  {   
   
// dd($order_id);

       $record=store::find($this->id);



$from = $request->from_date;
$to = $request->to_date;



if (!empty($id)) {
    $order_items=order_item::where('order_items.suborder_id',$id)
    ->whereBetween('created_at', [$from, $to])

->get();
}else{

    $order_items=order_item::where('order_items.store_id',$this->id)
->whereBetween('created_at', [$from, $to])

    ->get();
}

$records=[];

foreach($order_items as $index=>$data){

$records[]=(object)[
'store_id'=>$data->store_id,
'id'=>$data->id,
'created_at'=>$data->created_at,
'item_u_id'=>$data->item_u_id,
'item_sku'=>$data->item_sku,
'category_name'=>$this->categorys($data->product_id),
'product_category'=>$this->product_categorys($data->product_id),
'product_name'=>$data->product_name,
'product_attributes'=>$this->attributes_funct($data->product_id),
'item_shipping_weight'=>$data->item_shipping_weight,
'item_shipping_weight_unit'=>$data->item_shipping_weight_unit,
'item_shipping_price'=>$data->item_shipping_price,
'total_Weight'=>$data->item_shipping_weight*$data->item_quantity,
'item_tax_price'=>$data->item_tax_price,
'item_selling_price'=>$data->item_selling_price,
'commission_amount'=>$data->commission_amount,
'commission_percent'=>$data->commission_percent,
'order_status'=>$this->order_status_function($data->suborder_id),
'paid_unpaid_status'=>$this->paid_unpaid_status_function($data->suborder_id),
'total_price'=>$data->item_selling_price*$data->item_quantity,
'item_quantity'=>$data->item_quantity,
];

}


// dd($records);

   $pdfview= $record->store_unique_id.date('Ymd');
  //dd($records);
   $pdf =  \PDF::loadView('emails.store_item_wise_pdf_payout',compact('record','records'));

     $pdf->setPaper('A3', 'landscape');


   return $pdf->download($pdfview.'.pdf');
   

 }
 

 

  public function store_item_wise_excel_payout($id=null,Request $request)
  {   
   
$from = $request->from_date;
$to = $request->to_date;

$record=suborder::find($id);

$store_id = $this->id;
$record=store::find($store_id);

    $suborder_u_id=$record->store_unique_id;


if (!empty($record)) {
    
    $suborder_u_id=$record->suborder_u_id;
}

return Excel::download(new store_item_wise_excel_payout($id,$from,$to,$store_id),$suborder_u_id.date('Ymd').'.csv');


 }


}
