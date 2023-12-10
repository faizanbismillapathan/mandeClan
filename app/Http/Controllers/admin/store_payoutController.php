<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\product;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;
use Image;
use File;
use Auth;
use App\store;
use App\suborder;
use App\order_item;
use App\Exports\store_item_wise_excel_payout;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\store_wise_excel_payout;

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
        $this->middleware(function ($request, $next) {
          $uspermit = \Auth::user();
          if($uspermit->role != '1'){
              return redirect()->action('frontend\frontendController@index',['id' => 'Nagpur']);  
          }
          return $next($request);
      });
    }
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $record=DB::table('stores')
->where('id',$record->id)->select('id','store_category','store_product_category')->first();


        $categories = DB::table('product_categories')  
        ->whereIn('product_categories.id',explode(',',$record->store_product_category))
        ->pluck('product_categories.product_category','product_categories.id'); 

// dd($categories);

 $brands = DB::table('brands')  
                    ->select('brand_name','id')
                     ->where('status','Active')
                     // ->where('brand_category',$record->store_product_category)
            ->whereIn('brand_type', ['Both','Store'])->pluck('brand_name','id'); 


$warranty = [];
for ($warranty_exp=1; $warranty_exp <= 12; $warranty_exp++) $warranty[$warranty_exp] = $warranty_exp;


  

         $autoincid = mt_rand(10,100);
         $Y = date('Ys');
         $keydata = 'Prod'.$Y.''.$autoincid;


         return view('admin.seller_products.create',compact('categories','warranty','keydata','brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        if($request->hasFile('product_cover_photo'))
  
        {       
     $file = $request->file('product_cover_photo');
     $extension = $request->file('product_cover_photo')->getClientOriginalExtension();
     $product_cover_photo = date('d_m_Y_h_i_s',time()) . '.' . $extension;

         $destinationPaths = base_path().'/public/images/product_cover_photo';

  $thumb_img =Image::make($file->getRealPath())->orientate()->resize(600, 450);
  
     $thumb_img->save($destinationPaths.'/'.$product_cover_photo,80);

      }       
        else{
            $product_cover_photo = "";
        }


$record=DB::table('stores')
->where('id',$this->id)->select('id','store_unique_id')->first();

if ($request->product_free_shipping=='on') {   
   $product_free_shipping='Enable';
}else{
    $product_free_shipping='Disable';
}

if ($request->product_status=='on') {   
   $product_status='Active';
}else{
    $product_status='Deactive';
}


if ($request->product_cancel_available=='on') {   
   $product_cancel_available='Enable';
}else{
    $product_cancel_available='Disable';
}


if ($request->product_cod=='on') {   
   $product_cod='Enable';
}else{
    $product_cod='Disable';
}

// dd(Session::get('user_id'));
$data = array(
'store_id'=>$record->id,
'user_id'=>$this->user_id,
'store_unique_id'=>$record->store_unique_id,
'product_unique_id'=>$request->input('product_unique_id'),
'product_category'=>$request->input('product_category'),
'product_subcategory'=>$request->input('product_subcategory'),
'product_name'=>$request->input('product_name'),
'product_brand'=>$request->input('product_brand'),
'product_key_features'=>$request->input('product_key_features'),
'product_description'=>$request->input('product_description'),
'product_wg_duration'=>$request->input('product_wg_duration'),
'product_wg_dmy'=>$request->input('product_wg_dmy'),
'product_wg_type'=>$request->input('product_wg_type'),
'product_video_url'=>$request->input('product_video_url'),
// 'product_selling_date'=>$request->input('product_selling_date'),
// 'product_modal_number'=>$request->input('product_modal_number'),
// 'product_hsn_sac_code'=>$request->input('product_hsn_sac_code'),
// 'product_sku'=>$request->input('product_sku'),
// 'product_price'=>$request->input('product_price'),
// 'product_offer_price'=>$request->input('product_offer_price'),
// 'product_offer_discount'=>$request->input('product_offer_discount'),
// 'product_gift_charge'=>$request->input('product_gift_charge'),
// 'product_price_include'=>$product_price_include,
// 'product_text_class'=>$request->input('product_text_class'),
'product_tags'=>$request->input('product_tags'),
'product_free_shipping'=>$product_free_shipping,
// 'product_featured'=>$request->input('product_featured'),
'product_status'=>$product_status,
'product_cancel_available'=>$product_cancel_available,
'product_cod'=>$product_cod,
// 'product_img'=>$product_img,
'product_cover_photo'=>$product_cover_photo,
'product_link'=>str_replace(' ','-',strtolower($request->product_name)).'-'.$request->product_unique_id,
'created_by'=>'Custom',
);

// dd($data);
         $product = new product($data);
         $product->save();
                 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/seller-products')->with($notification);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store_wise_payout(Request $request)
    {

$from = $request->from_date;
$to = $request->to_date;


$records=[];
$view=[];

if (!empty($from) && !empty($to)) {}
    

    


$view=DB::table('stores')
->join('suborders','stores.id','suborders.store_id')
->select('stores.store_unique_id','stores.store_name','stores.id','stores.store_locality')
->whereBetween(DB::raw('DATE(order_date)'), [$from, $to]);
if ($request->city) {
    $view=$view
    ->where('stores.store_city',$request->city);
}
    $view=$view
->groupby('suborders.store_id')->paginate(50);




foreach($view as $index=>$data){

$records[]=(object)[
    'id'=>$data->id,
    'store_unique_id'=>$data->store_unique_id,
    'store_name'=>$data->store_name,
    'start_date'=>$from,
    'end_date'=>$to,
    'total_order'=>$this->total_orders($data->id,$from,$to),
    'locality'=>$this->localities($data->store_locality),
    'store_total_payment'=>$this->store_total_payments($data->id,$from,$to),
    'store_tax'=>$this->store_taxs($data->id),
    'store_tax_price'=>$this->store_tax_prices($data->id),
    'store_price'=>$this->store_prices($data->id),
    'store_paid_price'=>$this->store_paid_prices($data->id),
    'store_unpaid_price'=>$this->store_unpaid_prices($data->id),

];

    }

    // code...




$cities=DB::table('cities')->where('status','Active')->pluck('city_name','id')->toarray();


        return view('admin.payouts.store_wise_payout',compact('records','view','cities'));
    }

 

  public function store_wise_pdf_payout($id,Request $request)
    {

$record=store::find($id);

// 849

$from = $request->from_date;
$to = $request->to_date;

$suborders=suborder::where('suborders.store_id',$id)
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




   $pdfview= $record->store_unique_id.date('Ymd');
  //dd($records);
   $pdf =  \PDF::loadView('emails.store_pdf_payout_list',compact('record','records'));

     $pdf->setPaper('A4', 'landscape');


   return $pdf->download($pdfview.'.pdf');
   


// $cities=DB::table('cities')->where('status','Active')->pluck('city_name','id')->toarray();


//         return view('admin.payouts.store_wise_payout',compact('records','view','cities'));
    }



  public function order_dates($store_id)
    {
   
   $suborders=DB::table('suborders')
   ->where('suborders.store_id',$store_id)
   ->orderBy('suborders.id','asc')
   ->select('order_date')
   ->first();

// dd($suborders);
       return $suborders->order_date;
   
    }

  public function delivery_dates($store_id)
    {
   
 $suborders=DB::table('suborders')
   ->where('suborders.store_id',$store_id)
   ->orderBy('suborders.id','desc')
   ->select('delivery_date')
   ->first();

       return $suborders->delivery_date;   
    }

  public function total_orders($store_id,$from,$to)
    {
   

 $suborders=DB::table('suborders')
   ->where('suborders.store_id',$store_id)
->whereBetween(DB::raw('DATE(order_date)'), [$from, $to])
   ->select('id')
   ->get();


       return count($suborders);
   
    }

  public function localities($id)
    {
   

 $locality=DB::table('localities')
   ->where('id',$id)
   ->select('locality_name')
   ->first();

       return $locality->locality_name;
   
    }

  public function store_total_payments($store_id,$from,$to)
    {   

$subtotal=DB::table('suborders')
->where('suborders.store_id',$store_id)
->whereBetween(DB::raw('DATE(order_date)'), [$from, $to])
->sum('subtotal');

return $subtotal;
   
    }

  public function store_taxs($store_id)
    {
   
$total_tax=DB::table('suborders')
->where('suborders.store_id',$store_id)
->sum('total_tax');

return $total_tax;


    }

  public function store_tax_prices($store_id)
    {
   
      $total_tax=DB::table('suborders')
->where('suborders.store_id',$store_id)
->sum('tax_price');

return $total_tax;

   
    }

  public function store_prices($store_id)
    {

$subtotal=DB::table('suborders')
->where('suborders.store_id',$store_id)
->sum('subtotal');

return $subtotal;

   
    }

  public function store_paid_prices($store_id)
    {
   
       $subtotal=DB::table('suborders')
->where('suborders.store_id',$store_id)
->where('paid_unpaid_status','Paid')
->sum('subtotal');

return $subtotal;


   
    }

  public function store_unpaid_prices($store_id)
    {
   
       $subtotal=DB::table('suborders')
->where('suborders.store_id',$store_id)
->where('paid_unpaid_status','Unpaid')
->sum('subtotal');

return $subtotal;
   
    }





        public function store_payout_list($id,Request $request)
    {

$record=store::find($id);

// 849

$from = $request->from_date;
$to = $request->to_date;

$suborders=suborder::where('suborders.store_id',$id)
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


// dd($records);

        return view('admin.payouts.store_payout_list',compact('record','records'));
   
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




   public function store_item_wise_payout($id=null,Request $request)
    {
    
    $record=store::find($request->store_id);



$from = $request->from_date;
$to = $request->to_date;



if (!empty($id)) {
    $order_items=order_item::where('order_items.suborder_id',$id)
    ->whereBetween('created_at', [$from, $to])

->get();
}else{

    $order_items=order_item::where('order_items.store_id',$request->store_id)
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

        return view('admin.payouts.store_item_wise_payout',compact('record','records'));
   

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


    // $categories=DB::table('product_categories')
    // ->where('id',$id)
    // ->select('product_category')
    // ->first();

    // return $categories->product_category;

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


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($id);
        $record = product::find($id);         
        // dd($record);
       $record1=DB::table('stores')
->where('id',$record->store_id)->select('id','store_category','store_product_category')->first();


        
        $categories = DB::table('product_categories')  
        ->whereIn('product_categories.id',explode(',',$record1->store_product_category))
        ->pluck('product_categories.product_category','product_categories.id'); 



 $subcategories = DB::table('product_subcategories')  
        ->whereIn('product_category',explode(',',$record->product_category))
        ->pluck('product_subcategories.product_subcategory','product_subcategories.id'); 



 $brands = DB::table('brands')  
                    ->select('brand_name','id')
                     ->where('status','Active')
                     // ->where('brand_category',$record->store_product_category)
            ->whereIn('brand_type', ['Both','Store'])->pluck('brand_name','id'); 


 $brands = DB::table('brands')  
        ->whereIn('brand_category',explode(',',$record->product_category))
        ->pluck('brands.brand_name','brands.id'); 

        
$warranty = [];
for ($warranty_exp=1; $warranty_exp <= 12; $warranty_exp++) $warranty[$warranty_exp] = $warranty_exp;


         return view('admin.seller_products.edit',compact('record','categories','warranty','brands','subcategories','brands','record1'));

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
        // dd($request);

        $products = product::find($id); 

 if($request->hasFile('product_cover_photo'))
  
        {       
     $file = $request->file('product_cover_photo');
     $extension = $request->file('product_cover_photo')->getClientOriginalExtension();
     $product_cover_photo = date('d_m_Y_h_i_s',time()) . '.' . $extension;

         $destinationPaths = base_path().'/public/images/product_cover_photo';

  $thumb_img =Image::make($file->getRealPath())->orientate()->resize(600, 450);
  
     $thumb_img->save($destinationPaths.'/'.$product_cover_photo,80);

      }       
        else{
            $product_cover_photo = $products->product_cover_photo;
        }



if ($request->product_free_shipping=='on') {   
   $product_free_shipping='Enable';
}else{
    $product_free_shipping='Disable';
}

if ($request->product_status=='on') {   
   $product_status='Active';
}else{
    $product_status='Deactive';
}


if ($request->product_cancel_available=='on') {   
   $product_cancel_available='Enable';
}else{
    $product_cancel_available='Disable';
}


if ($request->product_cod=='on') {   
   $product_cod='Enable';
}else{
    $product_cod='Disable';
}

// dd(Session::get('user_id'));
$data = array(
'product_category'=>$request->input('product_category'),
'product_subcategory'=>$request->input('product_subcategory'),
'product_name'=>$request->input('product_name'),
'product_brand'=>$request->input('product_brand'),
'product_key_features'=>$request->input('product_key_features'),
'product_description'=>$request->input('product_description'),
'product_wg_duration'=>$request->input('product_wg_duration'),
'product_wg_dmy'=>$request->input('product_wg_dmy'),
'product_wg_type'=>$request->input('product_wg_type'),
'product_video_url'=>$request->input('product_video_url'),

'product_tags'=>$request->input('product_tags'),
'product_cancel_available'=>$product_cancel_available,
'product_cod'=>$product_cod,
'product_free_shipping'=>$product_free_shipping,
'product_status'=>$product_status,
'product_cover_photo'=>$product_cover_photo,
'product_link'=>str_replace(' ','-',strtolower($request->product_name)).'-'.$request->product_unique_id,

);

// dd($data);
         $products->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/seller-products')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
         $products = product::find($request->id);
          $products->delete();

          return $products;
    }

     public function status_update(Request $request){
 
         $record=product::find($request->user_id);
      
          if($record['product_status']=='Active'){
               $updatevender=\DB::table('products')->where('id',$request->user_id)
                              ->update([
                                'product_status' => 'Deactive',
                                 ]);
            return json_encode('Deactive');
           } else {
              $updateuser=\DB::table('products')->where('id',$request->user_id)
                              ->update([
                                'product_status' => 'Active',
                                 ]);
              return json_encode("Active");

        }
           }

    public function check_unique_name(Request $request)
    {

        // return $request->checkunique_name;
        
      if(!empty($request->check_unique_name)){

        $record = product::where('product_name', $request->check_unique_name)->first();

         if(!empty($record)){
            return "exist";
         }else{
            return "notexist";
         }
      }
      if(!empty($request->check_unique_name_edit)){

        $record = product::where('product_name', $request->check_unique_name_edit)->get();

         if(count($record) <=1){
            return "notexist";
         }else{
            return "exist";
         }
      }
  }


  public function append_product_category(Request $request)
    {   
             $product_categoryId= $request->id;

$subcategories =\DB::table('product_subcategories')                    
           ->where("product_subcategories.product_category",$product_categoryId)
           ->where("product_subcategories.status",'Active')
          ->pluck('product_subcategories.product_subcategory','product_subcategories.id');

        
$brands =\DB::table('brands')                    
                       ->where("brands.brand_category",$product_categoryId)
                       ->where("brands.status",'Active')
                      ->pluck('brands.brand_name','brands.id');



        return json_encode(['subcategories'=>$subcategories,'brands'=>$brands]);
    }


     public function store_item_wise_pdf_payout($id=null,Request $request)
  {   
   
// dd($order_id);

       $record=store::find($request->store_id);



$from = $request->from_date;
$to = $request->to_date;



if (!empty($id)) {
    $order_items=order_item::where('order_items.suborder_id',$id)
    ->whereBetween('created_at', [$from, $to])

->get();
}else{

    $order_items=order_item::where('order_items.store_id',$request->store_id)
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

$store_id = $request->store_id;
$record=store::find($store_id);

    $suborder_u_id=$record->store_unique_id;


if (!empty($record)) {
    
    $suborder_u_id=$record->suborder_u_id;
}

return Excel::download(new store_item_wise_excel_payout($id,$from,$to,$store_id),$suborder_u_id.date('Ymd').'.csv');


 }

  public function store_wise_excel_payout($id,Request $request)
  {   
   
$from = $request->from_date;
$to = $request->to_date;

$record=store::find($id);


return Excel::download(new store_wise_excel_payout($id,$from,$to),$record->store_unique_id.date('Ymd').'.csv');


 }



// ..................




}
