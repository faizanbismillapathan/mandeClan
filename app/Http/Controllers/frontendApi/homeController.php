<?php
namespace App\Http\Controllers\frontendApi;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\store;
use App\locality;
use App\store_category;
use App\product;
use App\wishlist;
use App\product_item;
use Auth;
use View;
use \Cart as Cart;
use App\product_addon_group;
use Twilio\Rest\Client;
use Exception;
use App\admin;

class homeController extends Controller
{



public function all_cities(Request $request)
    {     


$locality=locality::where('status','Active')
->get();

$localities=[];

foreach($locality as $data){

$localities[]=
['locality'=>$data->locality_name,
'city'=>$data->city->city_name,
'state'=>$data->state->state_name,
'country'=>$data->country->country_name];
}


return json_encode($localities);

 }


 public function home_categories(Request $request)
    {     

 $path=url('/').'/public/images/category_img/';

$store_categorys=store_category::where('status','Active')
->select('id','category_name','category_title',DB::raw("CONCAT('".$path."', store_categories.category_img) as category_img"))
->get();

return json_encode($store_categorys);

 }




// public function token_generate_api(Request $request)
//     {     


// $user = User::find(1);

// Auth::login($user);

// $tokenobj = \Auth::User()->createToken('name');

// $token = $tokenobj->accessToken;

// return json_encode($token);


// }

// public function token_test_api(Request $request)
//     {     

// return json_encode(\Auth::User());

//  }




public function store_list(Request $request)
    {     


    $stor=store::where('store_category',$request->category_id)->where('store_locality',$request->locality_id);

    if (!empty($request->search)) {
        $stor=$stor
        ->where('store_name','like',$request->search . '%');
    }
    $stor=$stor
    ->paginate(12);

    $stores=[];
    foreach($stor as $index=>$data){

    $stores[]=[
    'store_link'=>$data->store_link,
    'store_cover_photo'=>$data->store_cover_photo,
    'store_name'=>$data->store_name,
    'locality'=>$data->locality,
    'city'=>$data->city,
    'store_rating'=>$this->store_ratings($data->id),
    'id'=>$data->id,
    'user_id'=>$data->user_id,
    'like_dislike'=>$this->like_dislikes($data->id),
    ];

    }

    return json_encode($stores);


}



public function store_detail(Request $request)
    {     




    $record=store::where('id',$request->store_id)->first();

    $like_dislike=$this->like_dislikes($record->id);

    $sum=DB::table('reviews')
    ->where('store_id',$record->id)
    ->select('rating')
    ->sum('rating');



    $reviews_count=DB::table('reviews')
    ->where('store_id',$record->id)
    ->select('rating')
    ->count();


    if (!empty($reviews_count)) {

        $total=$sum/$reviews_count;
        $avg_rating= $total;

    }else{

        $avg_rating= 0;

    }


    $reviews=DB::table('reviews')
    ->where('store_id',$record->id)
    ->get();


    $store_galleries=DB::table('store_photo_galleries')
    ->where('store_id',$record->id)
    ->get();





    $stores=store::where('store_category',$record->store_category)
    ->where('store_locality',$record->store_locality)->paginate(8);


    return compact('record','avg_rating','reviews','store_galleries','stores','reviews_count','like_dislike');
}



public function store_ratings($id)
{   

    $sum=DB::table('reviews')
    ->where('store_id',$id)
    ->select('rating')
    ->sum('rating');


// dd($sum);
    $reviews_count=DB::table('reviews')
    ->where('store_id',$id)
    ->select('rating')
    ->count();


    if (!empty($reviews_count)) {

        $total=$sum/$reviews_count;
        $avg_rating= $total;

    }else{

        $avg_rating= 0;

    }


    return $avg_rating;

}



public function like_dislikes($store_id)
{

    if(!Auth::guest()){

        $record=\DB::table('wishlists')
        ->where('store_id',$store_id)
        ->where('persone_user_id',\Auth::user()->id)
        ->first();
        if (!empty($record)) {
         return $record->status;

     }
     return '';

 }


}



public function store_items(Request $request)
    {     


   

    $product_category=DB::table('stores')
    ->select(\DB::raw("GROUP_CONCAT(product_categories.product_category) as product_category"),\DB::raw("GROUP_CONCAT(product_categories.id) as id"),'product_categories.product_category_url')
    ->leftjoin("product_categories",\DB::raw("FIND_IN_SET(product_categories.id,stores.store_product_category)"),">",\DB::raw("'0'"))
    ->where('stores.id',$request->store_id)
    ->groupby('product_categories.id')
    ->whereNotNull('product_categories.id')
    ->get();




// dd($product_cat_name);

    $product_subcategories=DB::table('product_subcategories')
//
    ->select('product_subcategory','id');

    if (!empty($request->category_id)) {

        $product_subcategories=$product_subcategories
        ->where('product_subcategories.product_category',$request->category_id);

    }

    $product_subcategories=$product_subcategories
    ->get();

    $brands=DB::table('brands')
    ->select('brand_name','id');


    if (!empty($request->category_id)) {

        $brands=$brands
        ->where('brands.brand_category',$request->category_id);

    }
    $brands=$brands

    ->get();



    $produc=product::where('products.store_id',$request->store_id)
    ->join('product_items','products.id','product_items.product_id')
    ->select('products.id','products.product_name','product_items.item_price','product_items.item_offer_discount','product_items.item_img1','products.product_link',
        'product_items.item_unique_id','products.product_description','products.product_key_features','product_items.id as item_id','product_items.item_attr_varient','product_items.array_combine','product_items.item_status')
    ->where('product_items.item_status','Available')
    ->groupby('products.id');

    if (!empty($request->category_id)) {
        $produc=$produc
        ->where('products.product_category',$request->category_id);
    }


    if (!empty($request->subcategory_id)) {
        $produc=$produc
        ->where('products.product_subcategory',$request->subcategory_id);
    }


    if (!empty($request->brand_id)) {
        $produc=$produc
        ->where('products.product_brand',$request->brand_id);
    }


    if (!empty($request->sort)) {

        if ($request->sort=='new') {
            $produc=$produc
            ->orderBy('product_items.id','desc');
        }else{
            $produc=$produc
            ->orderBy('product_items.item_price',$request->sort);
        }

    }


    $produc=$produc
    ->paginate(20);


    $products=[];

    foreach($produc as $index=>$data){

        $item_selling_price=$data->item_price;

        if (!empty($data->item_offer_discount)) {
           $item_selling_price=$this->item_selling_prices($data->item_price,$data->item_offer_discount);
       }
       $products[]=(object)[
        'id'=>$data->id,
        'product_name'=>$data->product_name,
        'item_img1'=>$data->item_img1, 
        'item_price'=>$data->item_price,
        'item_selling_price'=>$item_selling_price,
        'item_offer_discount'=>$data->item_offer_discount,
        'product_category'=>$this->product_categories($data->id),
        'product_subcategory'=>$this->product_subcategories($data->id),
        'product_link'=>$data->product_link,
        'item_unique_id'=>$data->item_unique_id,
        'attributes1'=>$this->attributes_funct($data->id),
        'item_id'=>$data->item_id,
        'shopping_cart'=>$this->shopping_carts($data->item_id),
        'item_attr_varient'=>$data->item_attr_varient,
        'array_combine'=>unserialize($data->array_combine),
        'item_status'=>$data->item_status,
        'addons'=>$this->addonsFunct($data->id),
    ];
}



return compact('products','product_category','product_subcategories');

}




public function item_selling_prices($price,$offer_discount)
{   


    $selling_price = $price - ($price * ($offer_discount / 100));
    return $selling_price;

}


public function product_categories($product_category)
{   


$result=DB::table('product_categories')
->where('id',$product_category)
->select('id','product_category')
->first();


if (!empty($result)) {
   return $result->product_category;

}
return '';

}


public function product_subcategories($product_subcategory)
{   


$result=DB::table('product_subcategories')
->where('id',$product_subcategory)
->select('id','product_subcategory')
->first();


if (!empty($result)) {
return $result->product_subcategory;

}
return '';

}



public function shopping_carts($itemId)
{


    $carts=Cart::get($itemId);

    return $carts;
}



public function attributes_funct($id)
{

    $attributes=DB::table('product_attributes')
    ->where('product_id',$id)
    ->get();


    // dd($attributes);

    return $attributes;

}





public function addonsFunct($id)
{



$viewarray=[];
       $addon_groups=product_addon_group::where('product_id',$id)->get();

       foreach($addon_groups as $index=>$data){

$addon_groups_arr[$data->id]=$data->addon_group_name;


$viewarray[]=[
'id'=>$id,
'addon_group_name'=>$data->addon_group_name,  
'addon_group_type'=>$data->addon_group_type,  
    'group_list'  => $this->addon_group_list($data->id),
'addon_group_validation'=>$data->addon_group_validation,  

];
       }

// dd($viewarray);
    return $viewarray;
}




  public function addon_group_list($id)
{
  $addon_group_list=DB::table('product_addons')
          ->where('product_addons.addon_group_id',$id)
->select('product_addons.*')
          ->get();


          return $addon_group_list;

}




public function view_cart(Request $request)
{   



$carts=Cart::getContent();

// dd($carts);

$products=[];
$prodt=[];

$total_weight=0;
$total_weight_gram=0;
$total_weight_kg=0;
$total_weight_lb=0;
$total_weight_oz=0;

foreach($carts as $index=>$data){

$store_name=$this->stores_functions($data->associatedModel->store_id);

        $products[$store_name][$data->id]=$data;

        
$total_weight+=$data->associatedModel->item_shipping_weight;



if ($data->associatedModel->item_shipping_weight_unit=='g') {
$total_weight_gram+=$data->associatedModel->item_shipping_weight*$data->quantity;
}

if ($data->associatedModel->item_shipping_weight_unit=='kg') {
$total_weight_kg+=$data->associatedModel->item_shipping_weight*$data->quantity;
}


if ($data->associatedModel->item_shipping_weight_unit=='lb') {
$total_weight_lb+=$data->associatedModel->item_shipping_weight*$data->quantity;
}


if ($data->associatedModel->item_shipping_weight_unit=='oz') {
$total_weight_oz+=$data->associatedModel->item_shipping_weight*$data->quantity;
}


}

   
   $kg_g=$total_weight_kg*1000;

   $lb_g=$total_weight_lb*453.592;

   $oz_g=$total_weight_oz*28.3495;


$all_gram=$total_weight_gram+$kg_g+$lb_g+$oz_g;

$all_kg=$all_gram/1000;





    return compact('carts','products','all_kg');

}



     public function orders(Request $request){


// dd($request->store_id);

$store_id=array_unique($request->store_id);


$users=DB::table('customers')
->where('user_id',Auth::user()->id)
->select('id','user_id','customer_userid','customer_name as name','customer_email as email','customer_mobile as mobile')
->first();



$shop=DB::table('stores')
->whereIn('id',$store_id)
->select(
'id',
'store_latitude',
'store_longitude',
'store_city',
'store_locality',
)
->first();

$invoices=DB::table('invoice_settings')
->select('order_id_prefix','order_id_postfix','suborder_id_prefix','suborder_id_postfix','invoice_terms','invoice_logo','invoice_signature')
->first();

// dd($invoices);

    $products=Cart::getContent();



$item_selling_price=[];
$sub_products=[];


foreach($products as $index=>$data){

// $item_price[$data->associatedModel->store_id][]=$data->associatedModel->item_price;
$item_selling_price[$data->associatedModel->store_id][]=$data->price*$data->quantity;
// $item_list[$data->associatedModel->store_id][]=$data->id;

$sub_products[$data->associatedModel->store_id][]=$data;

}


// dd($sub_products);

$stores=DB::table('stores')
->join('products','products.store_id','stores.id')
->whereIn('stores.id',$store_id)
->select('stores.id',
'stores.store_latitude',
'stores.store_longitude',
'stores.store_city',
'stores.user_id',
'stores.store_unique_id',
'stores.store_state',
'stores.store_country',
'stores.store_locality',
'stores.store_pincode',
'stores.store_address',
)
->groupby('stores.id')
->get();




      $data = array(
'customer_id'=>$users->id,
'customer_user_id'=>$users->user_id,
'customer_u_id'=>$users->customer_userid,
'payment_method'=>$request->payment_method,
'total_tip_price'=>'10',
'tip_order_status'=>'Paid',
'delivery_date'=>$request->delivery_date,
'delivery_time'=>$request->delivery_time,
'transection_id'=>'TRANSECTION001',
'order_date'=>Carbon::now()->toDateTimeString(),
'total_order_item'=>$products->count(),
'total_suborder'=>count($store_id),
'paid_unpaid_status'=>'Unpaid',
'coupan_discount'=>0,
'shipping_charges'=>0,
'subtotal'=>Cart::getSubTotal(),
'grand_total'=>Cart::getTotal(),
'order_status'=>'Pending',
'pickup_type'=>$request->pickup_type,
    
);

      // dd($data);


         $order = new order($data);
         $order->save();
                 
  DB::table('orders')
  ->where('id',$order->id)
  ->update([
'order_u_id'=>$invoices->order_id_prefix.date("Y").'c'.$order->id.$shop->store_city.'l'.$shop->store_locality.$invoices->order_id_postfix,

  ]);
$order=  DB::table('orders')
  ->where('id',$order->id)->first();


$order_subtotal=[];
$order_items=[];


$store_wise_subtotal=[];
$store_wise_items=[];
$sub_product_new=[];

foreach($stores as $index=>$shop)
{



$count = isset($item_selling_price[$shop->id]) ? count($item_selling_price[$shop->id]) : 0;
$subtotal = isset($item_selling_price[$shop->id]) ? array_sum($item_selling_price[$shop->id]) : 0;
$grand_total = isset($item_selling_price[$shop->id]) ? array_sum($item_selling_price[$shop->id]) : 0;

    $suborder_data = array(
'store_id'=>$shop->id,
'store_user_id'=>$shop->user_id,
'store_u_id'=>$shop->store_unique_id,
'customer_id'=>$users->id,
'customer_user_id'=>$users->user_id,
'customer_u_id'=>$users->customer_userid,
'order_id'=>$order->id,
'delivery_date'=>$request->delivery_date,
'delivery_time'=>$request->delivery_time,
'payment_method'=>$request->payment_method,
'tip_price'=>10,
'tip_order_status'=>'Paid',
'transection_id'=>'transection002',
'total_item'=>$count,
'paid_unpaid_status'=>'Unpaid',
'gift_packing_charges'=>0,
'subtotal'=>$subtotal,
'shipping_charges'=>0,
'grand_total'=>$grand_total,
'order_status'=>'Pending',
'order_date'=>Carbon::now()->toDateTimeString(),
 'pickup_type'=>$request->pickup_type,

);

    // dd($suborder_data);


 $suborder = new suborder($suborder_data);
         $suborder->save();

                


  DB::table('suborders')
  ->where('id',$suborder->id)
  ->update([
'suborder_u_id'=>$invoices->suborder_id_prefix.date("Y").$suborder->id.$shop->store_city.$shop->store_locality.$invoices->suborder_id_postfix,

  ]);

$suborder=  DB::table('suborders')
->select('payment_method',
    'id',
'suborder_u_id',
'grand_total',
'order_date',
'delivery_date',
'subtotal',
'shipping_charges','delivery_time','pickup_type')
  ->where('id',$suborder->id)->first();

    $order_subtotal[$shop->id]=$suborder;




    $sub_product = isset($sub_products[$shop->id]) ? $sub_products[$shop->id] : [];


    // $sub_product_new[] = isset($sub_products[$shop->id]) ? $sub_products[$shop->id] : [];

foreach($sub_product as $index=>$addTocart){

// dd($item->associatedModel);
$addon_name_price='';
$addon_id_groupid='';


if (isset($addTocart->associatedModel->addon_list)) {
   
$addon_name_price=serialize($addTocart->associatedModel->addon_list);
$addon_id_groupid=serialize($addTocart->associatedModel->addon_id);

  }


$item=DB::table('stores')
->join('products','products.store_id','stores.id')
->join('product_items','products.id','product_items.product_id')
->select('product_items.*','products.id','products.product_name','products.product_unique_id')
->where('product_items.id',$addTocart->id)
->where('stores.id',$addTocart->associatedModel->store_id)
->first();



  $item_data = array(
'order_id'=>$order->id,
'store_id'=>$addTocart->associatedModel->store_id,
'suborder_id'=>$suborder->id,
'product_id'=>$item->id,
'product_u_id'=>$item->product_unique_id,
'product_name'=>$item->product_name,
'item_barcode'=>$item->item_barcode,
'item_hsn_sac_code'=>$item->item_hsn_sac_code,
'item_sku'=>$item->item_sku,
'item_id'=>$addTocart->id,
'item_price'=>$item->item_price,
'item_selling_price'=>$addTocart->price,
'item_offer_discount'=>$item->item_offer_discount,
'item_img1'=>$item->item_img1,
'item_img2'=>$item->item_img2,
'item_img3'=>$item->item_img3,
'item_img4'=>$item->item_img4,
'item_status'=>'Pending',
'item_quantity'=>$addTocart->quantity,
'item_description'=>$addTocart->associatedModel->item_description,
'item_attr_key'=>$item->item_attr_key,
'item_attr_varient'=>$item->item_attr_varient,
'array_combine'=>$item->array_combine,
'item_shipping_weight'=>$item->item_shipping_weight,
'item_shipping_weight_unit'=>$item->item_shipping_weight_unit,
'product_item_status'=>$item->product_item_status,
'addon_name_price'=>$addon_name_price,
'addon_id_groupid'=>$addon_id_groupid,


);


 $order_item = new order_item($item_data);
         $order_item->save();

DB::table('order_items')
  ->where('id',$order_item->id)
  ->update([
'item_u_id'=>$invoices->suborder_id_prefix.date("Y").$order_item->id.$suborder->id.$shop->store_city.$shop->store_locality.$invoices->suborder_id_postfix,

  ]);



  $order_items[]=$order_item;
    $store_wise_items[$addTocart->associatedModel->store_id][$order_item->id]=$order_item;



}





    $suborder_data = array(
'order_id'=>$order->id,
'suborder_id'=>$suborder->id,
'status'=>'Pending',
'status_date'=>Carbon::now()->toDateTimeString(),
'status_resone'=>'',
);


 $order_status_management = new order_status_management($suborder_data);
         $order_status_management->save();




// dd($sub_products);

}




// dd($sub_product_new);



$addressBook='';

    if ($request->pickup_type=="Home Delivery") {

$addressBook=customer_address_book::where('id',$request->address_book)->first();

  $delivery_data = array(

'order_id'=>$order->id,
'store_id'=>$shop->id,
'customer_id'=>$users->id,
'customer_user_id'=>$users->user_id,
'customer_u_id'=>$users->customer_userid,
'customer_name'=>$addressBook->name,
'customer_email'=>$addressBook->email,
'customer_mobile'=>$addressBook->mobile,
'customer_phone'=>$addressBook->phone,
'customer_country'=>$addressBook->country,
'customer_state'=>$addressBook->state,
'customer_city'=>$addressBook->city,
'customer_locality'=>$addressBook->locality,
'customer_pincode'=>$addressBook->pincode,
'customer_address'=>$addressBook->address,
'customer_latitude'=>$addressBook->latitude,
'customer_longitude'=>$addressBook->longitude,

    );


// dd($delivery_data);
 $order_delivery = new order_delivery_address($delivery_data);
         $order_delivery->save();


}

  $pickup_data = array(

'order_id'=>$order->id,
'store_id'=>$shop->id,
'store_latitude'=>$shop->store_latitude,
'store_longitude'=>$shop->store_longitude,
'store_country'=>$shop->store_country,
'store_state'=>$shop->store_state,
'store_city'=>$shop->store_city,
'store_locality'=>$shop->store_locality,
'store_pincode'=>$shop->store_pincode,
'store_address'=>$shop->store_address,


    );

  // dd($pickup_data);


 $order_pickup = new order_pickup_address($pickup_data);
         $order_pickup->save();


// dd($order->delivery_time);

             $invoicepdf = \PDF::loadView('emails.order_invoice',compact('order_items','order','addressBook','users'));

  $mailstatus = $this->OrderCustomerEmail($addressBook,$invoicepdf,$order,$order_items,$users);


// dd($mailstatus);
foreach ($store_wise_items as $key => $order_items) {


$store=DB::table('stores')
->join('products','products.store_id','stores.id')
->where('stores.id',$key)
->select('stores.id',
'stores.store_owner_email',
'stores.store_name',
)
->groupby('stores.id')
->first();


$order=$order_subtotal[$key];

// dd($order);
   
  $invoicepdf = \PDF::loadView('emails.order_invoice',compact('order_items','order','addressBook','users'));
  $mailstatus = $this->OrderVendorEmail($store,$addressBook,$invoicepdf,$order,$order_items,$users);
}




// Cart::clear();



 return json_encode(['status'=>'success']);
}

}
