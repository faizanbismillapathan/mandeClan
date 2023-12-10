<?php
namespace App\Http\Controllers\v1;

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
use App\contact_us;
use App\career;
use App\requested_store;
use App\customer;

use App\customer_address_book;
use App\config;
use App\bank_detail;






class homeApiController extends Controller
{


public function testapi(Request $request)
{


return json_encode('success');

}
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
'country'=>$data->country->country_name,
'id'=>$data->id,

];
}


return json_encode($localities);

 }


 public function home_categories(Request $request)
    {     

 $path=url('/').'/public/images/category_img/';

$store_categorys=store_category::where('status','Active')
->select('id','category_name','category_title',DB::raw("CONCAT('".$path."', store_categories.category_img) as category_img"))
->where('status','Active')
->get();



return json_encode($store_categorys);

 }






public function token_generate_api(Request $request)
    {     


$user = User::find(1);

Auth::login($user);

$tokenobj = \Auth::User()->createToken('name');

$token = $tokenobj->accessToken;

return json_encode($token);


}

public function token_test_api(Request $request)
    {     

return json_encode(\Auth::User());

 }




public function store_list(Request $request)
    {     


    $stor=store::where('store_category',$request->category_id)->where('store_locality',$request->locality_id);

    if (!empty($request->search)) {
        $stor=$stor
        ->where('store_name','like',$request->search . '%');
    }
    $stor=$stor
    ->get();

    $stores=[];

             $path=url('/').'/public/images/store_cover_photo/';

    foreach($stor as $index=>$data){

    $stores[]=[
    'store_link'=>$data->store_link,
    'store_cover_photo'=>$path.'/'.$data->store_cover_photo,
    'store_name'=>$data->store_name,
    'locality'=>$data->locality,
    'city'=>$data->city,
    'store_rating'=>$this->store_ratings($data->user_id),
    'id'=>$data->id,
    'user_id'=>$data->user_id,
    'like_dislike'=>$this->like_dislikes($data->user_id),
    ];

    }

    return json_encode($stores);


}



public function store_detail(Request $request)
    {     




    $record1=store::where('id',$request->store_id)->first();


         $path=url('/').'/public/images/store_cover_photo/';


    $record=(object)[
'id'=>$record1->id,
'category_url'=>$record1->category->category_url,
'category_name'=>$record1->category->category_name,
'store_name'=>$record1->store_name,
'store_cover_photo'=>$path.'/'.$record1->store_cover_photo,
'locality_name'=>$record1->locality->locality_name,
'state_name'=>$record1->state->state_name,
'store_mobile'=>$record1->store_mobile,
'store_phone'=>$record1->store_phone,
'store_email'=>$record1->store_email,
'store_open_time'=>$record1->store_open_time,
'store_close_time'=>$record1->store_close_time,
'store_address'=>$record1->store_address,
'store_description'=>$record1->store_description,
    ];

    $like_dislike=$this->like_dislikes($record1->user_id);

    $sum=DB::table('reviews')
    ->where('store_user_id',$record1->id)
    ->select('rating')
    ->sum('rating');



    $reviews_count=DB::table('reviews')
    ->where('store_user_id',$record1->id)
    ->select('rating')
    ->count();


    if (!empty($reviews_count)) {

        $total=$sum/$reviews_count;
        $avg_rating= $total;

    }else{

        $avg_rating= 0;

    }


    $reviews=DB::table('reviews')
    ->where('store_user_id',$record1->id)
    ->get();

         $path=url('/').'/public/images/store_photo_gallery/';





    $store_galleries=DB::table('store_photo_galleries')
    ->where('store_id',$record1->id)
    ->select('id',DB::raw("CONCAT('".$path."', gallery_img) as gallery_img"))
    ->get();





    $stor=store::where('store_category',$record1->store_category)
    ->where('store_locality',$record1->store_locality)->limit(8)->get();



    $outlet_stores=[];

             $path=url('/').'/public/images/store_cover_photo/';

    foreach($stor as $index=>$data){

    $outlet_stores[]=[
    'store_link'=>$data->store_link,
    'store_cover_photo'=>$path.'/'.$data->store_cover_photo,
    'store_name'=>$data->store_name,
    'locality'=>$data->locality,
    'city'=>$data->city,
    'store_rating'=>$this->store_ratings($data->user_id),
    'id'=>$data->id,
    'user_id'=>$data->user_id,
    'like_dislike'=>$this->like_dislikes($data->user_id),
    ];

    }


    return compact('record','avg_rating','reviews','store_galleries','outlet_stores','reviews_count','like_dislike');
}



public function store_ratings($id)
{   

    $sum=DB::table('reviews')
    ->where('store_user_id',$id)
    ->select('rating')
    ->sum('rating');


// dd($sum);
    $reviews_count=DB::table('reviews')
    ->where('store_user_id',$id)
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
        ->where('store_user_id',$store_id)
        ->where('persone_user_id',\Auth::user()->id)
        ->first();

        
        if (!empty($record)) {
         return $record->status;

     }
     return '';

 }


}



public function store_item_list(Request $request)
    {     


    $product_category=DB::table('stores')
    ->select(\DB::raw("GROUP_CONCAT(product_categories.product_category) as name"),\DB::raw("GROUP_CONCAT(product_categories.id) as id"))
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
        ->where('products.product_category',$request->category_id);

    }
    $brands=$brands

    ->get();



    $produc=product::where('products.store_id',$request->store_id)
    ->join('product_items','products.id','product_items.product_id')
    ->select('products.id','products.product_name','product_items.item_price','product_items.item_offer_discount','product_items.item_img1','products.product_link',
        'product_items.item_unique_id','products.product_description','products.product_key_features','product_items.id as item_id','product_items.item_attr_varient','product_items.array_combine','product_items.item_status','products.product_category')
    ->where('product_items.item_status','Available')
    ->groupby('products.id');

    if (!empty($request->category_id)) {
        $produc=$produc
        ->where('products.product_category',$request->category_id);
    }

  if (!empty($request->keyword)) {
        $produc=$produc
        ->where('products.product_name',$request->keyword);
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
    ->get();


    $products=[];







    foreach($produc as $index=>$data){



$percents=DB::table('commission_settings')->where('commission_store_id',$data->product_category)->first();

$percentage1=0;


if (!empty($percents)) {
    $percentage1=$percents->commission_rate;
}

$record1=DB::table('commission_settings')->first();

$percentage2=$record1->commission_rate;

$percentage=$percentage1+$percentage2;

$percent=($percentage / 100) * $data->item_price;


$item_price=$data->item_price+$percent;


        $item_selling_price=$item_price;

        if (!empty($data->item_offer_discount)) {
           $item_selling_price=$this->item_selling_prices($item_price,$data->item_offer_discount);
       }


                    $path=url('/').'/public/images/product_items/';

 
       $products[]=(array)[
        'id'=>$data->id,
                'name'=>$data->product_name,
        'product_name'=>$data->product_name,
        'item_img1'=>$path.'/'.$data->item_img1, 
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


// $data=[];
// $data['products']=$products
// $data['product_category']=$products
// $data[]=$products


return compact('products','product_category','product_subcategories');

}




public function item_selling_prices($price,$offer_discount)
{   


    $selling_price = $price - ($price * ($offer_discount / 100));
    return round($selling_price,2);

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


 $item_records=DB::table('products')
            ->join('product_items','products.id','product_items.product_id')
            ->join('product_categories','products.product_category','product_categories.id')
             ->leftjoin('product_subcategories','products.product_subcategory','product_subcategories.id')
      ->select('products.id','products.product_name','product_items.item_price','product_items.item_offer_discount','product_items.item_description','products.store_id','product_items.id as item_id','product_items.item_attr_varient','products.product_category as category','product_categories.product_category','product_subcategories.product_subcategory','product_items.array_combine','product_items.item_img1','products.store_id','product_items.item_shipping_weight','product_items.item_shipping_weight_unit')
      ->whereIn('product_items.id',$request->item_id)
      ->get();


foreach($item_records as $key=>$items){

$attributes=unserialize($items->array_combine);



$percents=DB::table('commission_settings')->where('commission_store_id',$items->category)->first();

$percentage1=0;


if (!empty($percents)) {
    $percentage1=$percents->commission_rate;
}

$record1=DB::table('commission_settings')->first();

$percentage2=$record1->commission_rate;

$percentage=$percentage1+$percentage2;

$percent=($percentage / 100) * $items->item_price;


$item_price=$items->item_price+$percent;

// ...
        $item_selling_price=round($item_price,2);

        if (!empty($items->item_offer_discount)) {

              $item_selling_price = round($item_price -($item_price * ($items->item_offer_discount / 100)),2);

       }

$addon_group_list=[];
$addon_grouplist=[];


if (isset($request->all_check_id[$items->item_id])) {

    $addon_group_list=DB::table('product_addons')
->whereIn('product_addons.id',explode(',',$request->all_check_id[$items->item_id]))
->pluck('product_addons.addon_name','product_addons.addon_price')
->toArray();

$addon_grouplist=DB::table('product_addons')
->whereIn('product_addons.id',explode(',',$request->all_check_id[$items->item_id]))
->pluck('product_addons.id','product_addons.addon_group_id')
->toArray();

}


$tax_price = $item_selling_price * (18 / 100);

    if (!empty($items->item_offer_discount)) {
                    $price = $items->item_price - ($items->item_price * ($items->item_offer_discount / 100));

                }else{
                    $price=$items->item_price;
                }

            

$commission_amount=($percentage / 100) * $price; 

$addon_price=0;

if (isset($request->addon_price[$items->item_id])) {

$addon_price=$request->addon_price[$items->item_id];

}

// return json_encode($item_selling_price);

$items1=(object)[
'id'=>$items->item_id,
'product_name'=>$items->product_name,
'basic_item_price'=>$items->item_price,
'item_offer_discount'=>$items->item_offer_discount,
'item_description'=>$items->item_description,
'store_id'=>$items->store_id,
'item_attr_varient'=>$items->item_attr_varient,
'product_category'=>$items->product_category,
'product_category'=>$items->product_category,
'product_subcategory'=>$items->product_subcategory,
'array_combine'=>$items->array_combine,
'item_img1'=>$items->item_img1,
'store_id'=>$items->store_id,   
'item_shipping_weight'=>$items->item_shipping_weight,
'item_shipping_weight_unit'=>$items->item_shipping_weight_unit,
'addon_list'=>$addon_group_list,
'addon_id'=>$addon_grouplist,

'commission_percent'=>$percentage,
'commission_amount'=>$commission_amount,
'item_price'=>$item_price,
'item_selling_price'=>$item_selling_price+$addon_price,
'item_shipping_charge'=>0,
'total_tax'=>18,
'tax_price'=>$tax_price,

];





    $carts[]=(object)[
       'id' => $items->item_id,
       'name' => $items->product_name,
       'store_id'=>$items->store_id,
       'price' =>  $item_selling_price+$addon_price,
       'quantity' => $request->quantity[$items->item_id],
       'attributes' => $attributes,
       'associatedModel' => $items1,
   ];




}



// dd($carts);

$products=[];
$prodt=[];

$total_weight=0;
$total_weight_gram=0;
$total_weight_kg=0;
$total_weight_lb=0;
$total_weight_oz=0;

foreach($carts as $index=>$data){


    // return $data->associatedModel->store_id;

$store_name=$this->stores_functions($data->associatedModel->store_id);

        $products[$store_name][$data->id]=[
'store_name'=>$store_name,
'products_record'=>$this->products_records($data),


        ];

        
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







public function stores_functions($store_id)
{   

  $result=DB::table('stores')
      ->select('store_name','id','store_category')
      ->where('id',$store_id)
      ->first();

$category=DB::table('store_categories')
      ->select('category_name','id')
      ->where('id',$result->store_category)
      ->first();


return  $result->store_name.'('. $category->category_name .')';


}




     public function products_records($data){

$data1=[
'item_img1'=>$data->associatedModel->item_img1,
'name'=>$data->name,
'product_category'=>$data->associatedModel->product_category,
'product_subcategory'=>$data->associatedModel->product_subcategory,
'attributes'=>$data->attributes,
'price '=>$data->price ,
'item_shipping_weight'=>$data->associatedModel->item_shipping_weight,
'item_shipping_weight_unit'=>$data->associatedModel->item_shipping_weight_unit,
'item_offer_discount'=>$data->associatedModel->item_offer_discount,
'quantity'=>$data->quantity,
'addon_list'=>$data->associatedModel->addon_list,
'id'=>$data->id,
];


return $data1;

}

     public function orders(Request $request){


// dd($request->store_id);


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

    // $products=Cart::getContent();


    $products[]=(object)[
       'id' => $items->item_id,
       'name' => $items->product_name,
       'store_id'=>$items->store_id,
       'price' =>  $item_selling_price+$addon_price,
       'quantity' => $request->quantity[$items->item_id],
       'attributes' => $attributes,
       'associatedModel' => $items1,
   ];




$item_selling_price=[];
$sub_products=[];

$total_price=[];
$total_price1=[];

foreach($products as $index=>$data){

$item_selling_price[$data->associatedModel->store_id][]=$data->price*$data->quantity;

$sub_products[$data->associatedModel->store_id][]=$data;

$total_main_price1[$data->associatedModel->store_id][]=round($data->associatedModel->item_price,2)*$data->quantity;

$total_price1[$data->associatedModel->store_id][]=round($data->associatedModel->item_selling_price,2)*$data->quantity;


$item_selling_price1[]=$data->price*$data->quantity;

$total_main_price11[]=round($data->associatedModel->item_price,2)*$data->quantity;

$total_price11[]=round($data->associatedModel->item_selling_price,2)*$data->quantity;

}



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

// dd($stores);


         $autoincid = mt_rand(10,100);
         $Y = date('Ys');
         $keydata = 'Tran'.$Y.''.$autoincid;



$subtotal = isset($item_selling_price1) ? array_sum($item_selling_price1) : 0;

$count11 = isset($total_main_price11) ? array_sum($total_main_price11) : 0;
$count22 = isset($total_price11) ? array_sum($total_price11) : 0;

$save_price=$count11-$count22;
$tax_price = $count22 * (18 / 100);

$grand_total=$count11-$save_price+$tax_price;




$data = array(
'customer_id'=>$users->id,
'customer_user_id'=>$users->user_id,
'customer_u_id'=>$users->customer_userid,
'payment_method'=>$request->payment_method,
'total_tip_price'=>'10',
'tip_order_status'=>'Paid',
'delivery_date'=>$request->delivery_date,
'delivery_time'=>$request->delivery_time,
'transection_id'=>$keydata,
'order_date'=>Carbon::now()->toDateTimeString(),
'total_order_item'=>$products->count(),
'total_suborder'=>count($store_id),
'paid_unpaid_status'=>$paid,
'coupan_discount'=>0,
'shipping_charges'=>0,
'subtotal'=>$subtotal,
'grand_total'=>$grand_total,
'order_status'=>'Pending',
'pickup_type'=>$request->pickup_type,
'total_tax'=>18,
'tax_price'=>$tax_price,
'save_price'=>$save_price,
);

      // dd($data);


         $order = new order($data);
         $order->save();
                 
  DB::table('orders')
  ->where('id',$order->id)
  ->update([

'order_u_id'=>$invoices->order_id_prefix.date("y").'c'.$order->id.$invoices->order_id_postfix,

  ]);
$order=  DB::table('orders')
  ->where('id',$order->id)->first();


$order_subtotal=[];
$order_items=[];


$store_wise_subtotal=[];
$store_wise_items=[];
$sub_product_new=[];

// dd($stores);

foreach($stores as $index=>$shop)
{


$count = isset($item_selling_price[$shop->id]) ? count($item_selling_price[$shop->id]) : 0;
$subtotal = isset($item_selling_price[$shop->id]) ? array_sum($item_selling_price[$shop->id]) : 0;


$count1 = isset($total_main_price1[$shop->id]) ? array_sum($total_main_price1[$shop->id]) : 0;
$count2 = isset($total_price1[$shop->id]) ? array_sum($total_price1[$shop->id]) : 0;

$discount_price=$count1-$count2;
$total_tax_price = round($count2 * (18 / 100),2);

$grand_total=$count1-$discount_price+$total_tax_price;

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
'transection_id'=>$keydata,
'total_item'=>$count,
'paid_unpaid_status'=>$paid,
'gift_packing_charges'=>0,
'subtotal'=>$subtotal,
'shipping_charges'=>0,
'grand_total'=>$grand_total,
'order_status'=>'Pending',
'order_date'=>Carbon::now()->toDateTimeString(),
'pickup_type'=>$request->pickup_type,
'total_tax'=>18,
'tax_price'=>$total_tax_price,
'discount_price'=>$discount_price,
);

    // dd($suborder_data);


 $suborder = new suborder($suborder_data);
         $suborder->save();

                


  DB::table('suborders')
  ->where('id',$suborder->id)
  ->update([
 'suborder_u_id'=>$invoices->suborder_id_prefix.date("y").$suborder->id.$invoices->suborder_id_postfix,

  ]);

$suborder=  DB::table('suborders')
->select('payment_method',
    'id',
'suborder_u_id',
'grand_total',
'order_date',
'delivery_date',
'subtotal',
'shipping_charges','delivery_time','pickup_type',
'total_tax',
'tax_price',
'discount_price',
)
  ->where('id',$suborder->id)->first();

    $order_subtotal[$shop->id]=$suborder;




    $sub_product = isset($sub_products[$shop->id]) ? $sub_products[$shop->id] : [];



foreach($sub_product as $index=>$addTocart){

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
'base_price'=>$item->item_price,
'item_price'=>$addTocart->associatedModel->item_price,
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
'commission_percent'=>$addTocart->associatedModel->commission_percent,
'commission_amount'=>$addTocart->associatedModel->commission_amount,
'item_shipping_charge'=>$addTocart->associatedModel->item_shipping_charge,
'item_tax'=>18,
'item_tax_price'=>$addTocart->associatedModel->item_selling_price * (18 / 100),

);


 $order_item = new order_item($item_data);
         $order_item->save();

DB::table('order_items')
  ->where('id',$order_item->id)
  ->update([
'item_u_id'=>$invoices->suborder_id_prefix.date("y").$order_item->id.$suborder->id.$invoices->suborder_id_postfix,

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

if (!empty($addressBook)) {
   
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
 // code...
}

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
'stores.store_email'
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



public function checkout(Request $request)
{   


 $item_records=DB::table('products')
            ->join('product_items','products.id','product_items.product_id')
            ->join('product_categories','products.product_category','product_categories.id')
             ->leftjoin('product_subcategories','products.product_subcategory','product_subcategories.id')
      ->select('products.id','products.product_name','product_items.item_price','product_items.item_offer_discount','product_items.item_description','products.store_id','product_items.id as item_id','product_items.item_attr_varient','products.product_category as category','product_categories.product_category','product_subcategories.product_subcategory','product_items.array_combine','product_items.item_img1','products.store_id','product_items.item_shipping_weight','product_items.item_shipping_weight_unit')
      ->whereIn('product_items.id',$request->item_id)
      ->get();


foreach($item_records as $key=>$items){

$attributes=unserialize($items->array_combine);



$percents=DB::table('commission_settings')->where('commission_store_id',$items->category)->first();

$percentage1=0;


if (!empty($percents)) {
    $percentage1=$percents->commission_rate;
}

$record1=DB::table('commission_settings')->first();

$percentage2=$record1->commission_rate;

$percentage=$percentage1+$percentage2;

$percent=($percentage / 100) * $items->item_price;


$item_price=$items->item_price+$percent;

// ...
        $item_selling_price=round($item_price,2);

        if (!empty($items->item_offer_discount)) {

              $item_selling_price = round($item_price -($item_price * ($items->item_offer_discount / 100)),2);

       }

$addon_group_list=[];
$addon_grouplist=[];


if (isset($request->all_check_id[$items->item_id])) {

    $addon_group_list=DB::table('product_addons')
->whereIn('product_addons.id',explode(',',$request->all_check_id[$items->item_id]))
->pluck('product_addons.addon_name','product_addons.addon_price')
->toArray();

$addon_grouplist=DB::table('product_addons')
->whereIn('product_addons.id',explode(',',$request->all_check_id[$items->item_id]))
->pluck('product_addons.id','product_addons.addon_group_id')
->toArray();

}


$tax_price = $item_selling_price * (18 / 100);

    if (!empty($items->item_offer_discount)) {
                    $price = $items->item_price - ($items->item_price * ($items->item_offer_discount / 100));

                }else{
                    $price=$items->item_price;
                }

            

$commission_amount=($percentage / 100) * $price; 

$addon_price=0;

if (isset($request->addon_price[$items->item_id])) {

$addon_price=$request->addon_price[$items->item_id];

}



$items1=(object)[
'id'=>$items->item_id,
'product_name'=>$items->product_name,
'basic_item_price'=>$items->item_price,
'item_offer_discount'=>$items->item_offer_discount,
'item_description'=>$items->item_description,
'store_id'=>$items->store_id,
'item_attr_varient'=>$items->item_attr_varient,
'product_category'=>$items->product_category,
'product_category'=>$items->product_category,
'product_subcategory'=>$items->product_subcategory,
'array_combine'=>$items->array_combine,
'item_img1'=>$items->item_img1,
'store_id'=>$items->store_id,   
'item_shipping_weight'=>$items->item_shipping_weight,
'item_shipping_weight_unit'=>$items->item_shipping_weight_unit,
'addon_list'=>$addon_group_list,
'addon_id'=>$addon_grouplist,

'commission_percent'=>$percentage,
'commission_amount'=>$commission_amount,
'item_price'=>$item_price,
'item_selling_price'=>$item_selling_price+$addon_price,
'item_shipping_charge'=>0,
'total_tax'=>18,
'tax_price'=>$tax_price,

];





    $products[]=(object)[
       'id' => $items->item_id,
       'name' => $items->product_name,
       'store_id'=>$items->store_id,
       'price' =>  $item_selling_price+$addon_price,
       'quantity' => $request->quantity[$items->item_id],
       'attributes' => $attributes,
       'associatedModel' => $items1,
   ];




}

    // $products=Cart::getContent();



$total_weight_gram=0;
$total_weight_kg=0;
$total_weight_lb=0;
$total_weight_oz=0;
// $item_price=[];
// $item_selling_price=[];


foreach($products as $index=>$data){

// $item_price[$data->associatedModel->store_id][]=$data->associatedModel->item_price;
// $item_selling_price[$data->associatedModel->store_id][]=$data->price;

if ($data->associatedModel->item_shipping_weight_unit=='g') {
$total_weight_gram+=$data->associatedModel->item_shipping_weight;
}

if ($data->associatedModel->item_shipping_weight_unit=='kg') {
$total_weight_kg+=$data->associatedModel->item_shipping_weight;
}


if ($data->associatedModel->item_shipping_weight_unit=='lb') {
$total_weight_lb+=$data->associatedModel->item_shipping_weight;
}


if ($data->associatedModel->item_shipping_weight_unit=='oz') {
$total_weight_oz+=$data->associatedModel->item_shipping_weight;
}


}



// dd($item_selling_price);
   
   $kg_g=$total_weight_kg*1000;

   $lb_g=$total_weight_lb*453.592;

   $oz_g=$total_weight_oz*28.3495;


$all_gram=$total_weight_gram+$kg_g+$lb_g+$oz_g;

$all_kg=$all_gram/1000;



$customer=customer::where('user_id',Auth::user()->id)
->first();


$addressBook=customer_address_book::get();


        $configs = config::first(); 

        $bank_detail = bank_detail::first();

    return compact('products','all_kg','customer','addressBook','configs','bank_detail');

}

    

public function add_item_to_cart(Request $request)
    {     



      $items=DB::table('products')
            ->join('product_items','products.id','product_items.product_id')
            ->join('product_categories','products.product_category','product_categories.id')
             ->leftjoin('product_subcategories','products.product_subcategory','product_subcategories.id')
      ->select('products.id','products.product_name','product_items.item_price','product_items.item_offer_discount','product_items.item_description','products.store_id','product_items.id as item_id','product_items.item_attr_varient','products.product_category as category','product_categories.product_category','product_subcategories.product_subcategory','product_items.array_combine','product_items.item_img1','products.store_id','product_items.item_shipping_weight','product_items.item_shipping_weight_unit')
      ->where('product_items.id',$request->item_id)
      ->first();


$attributes=unserialize($items->array_combine);


$percents=DB::table('commission_settings')->where('commission_store_id',$items->category)->first();

$percentage1=0;


if (!empty($percents)) {
    $percentage1=$percents->commission_rate;
}

$record1=DB::table('commission_settings')->first();

$percentage2=$record1->commission_rate;

$percentage=$percentage1+$percentage2;




$percent=($percentage / 100) * $items->item_price;

$item_price=$items->item_price+$percent;
// ...
        $item_selling_price=round($item_price,2);

        if (!empty($items->item_offer_discount)) {

              $item_selling_price = round($item_price -($item_price * ($items->item_offer_discount / 100)),2);

       }



$addon_group_list=[];
$addon_grouplist=[];
$arra=[];


if (isset($request->all_check_id[$items->item_id])) {

    $addon_group_list=DB::table('product_addons')
->whereIn('product_addons.id',explode(',',$request->all_check_id[$items->item_id]))
->pluck('product_addons.addon_name','product_addons.addon_price')
->toArray();

$addon_grouplist=DB::table('product_addons')
->whereIn('product_addons.id',explode(',',$request->all_check_id[$items->item_id]))
->pluck('product_addons.id','product_addons.addon_group_id')
->toArray();

}
$tax_price = $item_selling_price * (18 / 100);


 if (!empty($items->item_offer_discount)) {
                    $price = $items->item_price - ($items->item_price * ($items->item_offer_discount / 100));

                }else{
                    $price=$items->item_price;
                }

            

$commission_amount=($percentage / 100) * $price; 

$addon_price=0;

if (isset($request->addon_price[$items->item_id])) {

$addon_price=$request->addon_price[$items->item_id];

}



$items1=(object)[
'id'=>$items->id,
'product_name'=>$items->product_name,
'basic_item_price'=>$items->item_price,
'item_offer_discount'=>$items->item_offer_discount,
'item_description'=>$items->item_description,
'store_id'=>$items->store_id,
'id'=>$items->id,
'item_attr_varient'=>$items->item_attr_varient,
'product_category'=>$items->product_category,
'product_category'=>$items->product_category,
'product_subcategory'=>$items->product_subcategory,
'array_combine'=>$items->array_combine,
'item_img1'=>$items->item_img1,
'store_id'=>$items->store_id,   
'item_shipping_weight'=>$items->item_shipping_weight,
'item_shipping_weight_unit'=>$items->item_shipping_weight_unit,
'addon_list'=>$addon_group_list,
'addon_id'=>$addon_grouplist,
'commission_percent'=>$percentage,
'commission_amount'=>$commission_amount,
'item_price'=>$item_price,
'item_selling_price'=>$item_selling_price+$addon_price,
'item_shipping_charge'=>0,
'total_tax'=>18,
'tax_price'=>$tax_price,
];




   //    \Cart::add([
   //     'id' => $request->item_id,
   //     'name' => $items->product_name,
   //     'store_id'=>$items->store_id,
   //     'price' =>  $item_selling_price+$addon_price,
   //     'quantity' => (int)$request->quantity[$items->item_id],
   //     'attributes' => $attributes,
   //     'associatedModel' => $items1,
   // ]);

$arra[]=(object)[
       'id' => $request->item_id,
       'name' => $items->product_name,
       'store_id'=>$items->store_id,
       'price' =>  $item_selling_price+$addon_price,
       'quantity' => $request->quantity[$items->item_id],
       'attributes' => $attributes,
       'associatedModel' => $items1,
   ];





   //  $products[]=(object)[
   //     'id' => $items->item_id,
   //     'name' => $items->product_name,
   //     'store_id'=>$items->store_id,
   //     'price' =>  $item_selling_price+$addon_price,
   //     'quantity' => $request->quantity[$items->item_id],
   //     'attributes' => $attributes,
   //     'associatedModel' => $items1,
   // ];





      if(!Auth::guest() && Auth::user()->role==3){

         $userId = Auth::user()->id; 


           $datadata = DB::table('customers')
           ->where('user_id',$userId)
           ->select('customer_userid','user_id')
           ->first(); 



           if (!empty($datadata)) {



            DB::table('store_carts')->insert(
              [
               'product_id' => $items->id,
               'item_id' => $request->item_id,
               'store_id' => $items->store_id,
               'product_name' => $items->product_name,
               'quantity' => $request->quantity[$items->item_id],
               'sell_price' => $request->addon_price[$items->item_id],
               'cwitemid' => $request->id,
               'user_unique_id'=>$datadata->customer_userid,
               'user_id'=>$datadata->user_id,
               'add_by'=>'Web',
           ]

       );
        }
}




    $counter = count($arra);




return response()->json(['counter'=>$counter]);




   


    }


public function banners(Request $request){


 $path=url('/').'/public/images/banners/';



$records=DB::table('banners')->orderBy('id','desc')
->pluck(DB::raw("CONCAT('".$path."', banners.banner_app_img) as banner_app_img"))
->toArray();

// $records = array();
// foreach($use as $user) {
// $records[]=[$user->banner_app_img];

// }

return $records;
}


public function contact_us_store(Request $request)
{

$data = array(
'name'=>$request->input('name'),    
'mobile_no'=>$request->input('mobile_no'),
'email'=>$request->input('email'),
'message'=>$request->input('message'),
);

$contact_us = new contact_us($data);
$contact_us->save();
 

return json_encode(['status'=>'success']);

}



public function career_store(Request $request){

$data = array(
'name'=>$request->input('name'),
'mobile_no'=>$request->input('mobile_no'),
'email'=>$request->input('email'),
'apply_for'=>$request->input('apply_for'),
'message'=>$request->input('message'),

);



$career = new career($data);
$career->save();

return json_encode(['status'=>'success']);

}



public function business_with_us_store(Request $request){

$data = array(
'store_owner_name'=>$request->store_owner_name,
'store_owner_email'=>$request->store_owner_email,
'store_owner_mobile'=>$request->store_owner_mobile,
'store_owner_gendor'=>$request->store_owner_gendor,
'store_category'=>$request->store_category,
'store_name'=>$request->store_name,
'store_website'=>$request->store_website,
'store_description'=>$request->store_description,
'store_address'=>$request->store_address,

);


$requested_store = new requested_store($data);
$requested_store->save();
 
return json_encode(['status'=>'success']);

}



public function faqs(Request $request){

$records=DB::table('faqs')
->get();

$admin=admin::first();

return compact('records','admin');



}



public function policy_pages(Request $request){

$pages=DB::table('pages')
->orderby('id','asc')
->where('status','Active')
->get();


return json_encode($pages);

}
     




public function service_brands($brand_id)
{   


$result=DB::table('brands')
->where('id',$brand_id)
->select('id','brand_name')
->first();


if (!empty($result)) {
return $result->brand_name;

}
return '';

}

public function append_state(Request $request)
    {   
             $countryId= $request->id;

         $disticts =\DB::table('states')
                      ->join('countries', 'states.country_id', '=', 'countries.id')
                       ->where("states.country_id",$countryId)
                       ->where("states.status",'Active');
                       if (!empty($request->search)) {
                        $disticts =$disticts 
                              ->Where('states.state_name','like','%' . $request->search . '%');

                       }
   $disticts =$disticts 

                      ->select('states.state_name','states.id')->get();

        

        return json_encode($disticts);
    }


        public function append_city(Request $request)
    {   
             $stateId= $request->id;
         $disticts =\DB::table('cities')
                      ->join('states', 'cities.state_id', '=', 'states.id')
                       ->where("cities.state_id",$stateId)
                       ->where("cities.status",'Active');
                       if (!empty($request->search)) {
                        $disticts =$disticts 
                              ->Where('cities.city_name','like','%' . $request->search . '%');

                       }
   $disticts =$disticts 


                      ->select('cities.city_name','cities.id')->get();
                      
        return json_encode($disticts);
    }



     public function append_locality(Request $request)
    {   
             $cityId= $request->id;
         $disticts =\DB::table('localities')
                      ->join('cities', 'localities.city_id', '=', 'cities.id')
                       ->where("localities.city_id",$cityId)
                       ->where("localities.status",'Active');
                       if (!empty($request->search)) {
                        $disticts =$disticts 
                              ->Where('localities.locality_name','like','%' . $request->search . '%');

                       }
   $disticts =$disticts 
                      ->select('localities.locality_name','localities.id')->get();
                      
        return json_encode($disticts);
    }



     public function append_pincode(Request $request)
    {   
             $Id= $request->id;
         $disticts =\DB::table('localities')
                     ->where("localities.id",$Id)
                      ->select('localities.pincode','localities.id')->first();
                      
        return json_encode($disticts->pincode);
    }


    


    public function getTermsConditionsPage(Request $request)
    {   


        $admin=admin::first();

        $record=DB::table('pages')->where('page_slug','terms-and-conditions')->first();

        return compact('admin','record');


    }


   public function getAboutUsPage(Request $request)
    {   


        $admin=admin::first();
                $record=DB::table('pages')->where('page_slug','about-us')->first();


        return compact('admin','record');


    }

     
}
