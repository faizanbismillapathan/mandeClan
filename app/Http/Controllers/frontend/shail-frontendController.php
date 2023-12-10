<?php
namespace App\Http\Controllers\frontend;

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
use App\service;
use App\service_category;
use App\vendor_service;
use App\service_subcategory;
use App\service_vendor_category;
use App\Traits\MailerTraits;
class frontendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     use MailerTraits;


    public function homesearch(Request $request)
    {     

        $locality_url=1;

        if (!empty($request->place_name)) {

            $localityobj=DB::table('localities')->where('locality_url',$request->place_name)->select('locality_name','id','locality_url')->first();

            if (!empty($localityobj)) {
              $locality_name=$localityobj->locality_name;
              $locality_url=$localityobj->locality_url;
          }

      }

      return $locality_url
;

  }


  public function index($locality=null,Request $request)
  {     

// dd(brypt('mande'));

// $product_category=DB::table('product_categories')
// ->select('product_categories.id','product_categories.product_category')
// ->get();

// foreach($product_category as $index=>$data){

//     DB::table('product_categories')
//     ->where('id',$data->id)
//     ->update([
// 'product_category_url'=>str_replace(' ','-',strtolower($data->product_category)),
//     ]);
// }



// $product_category=DB::table('products')
// ->select('products.product_unique_id','products.product_name','products.id')
// ->get();

// foreach($product_category as $index=>$data){

// // dd(str_replace(' ','-',strtolower($data->product_name)));
//     DB::table('products')
//     ->where('id',$data->id)
//     ->update([
// 'product_link'=>str_replace(' ','-',strtolower($data->product_name)).'-'.$data->product_unique_id,
//     ]);
// }return view('frontend.index', compact('categories', 'locality', 'servic_categories'));


$datas=DB::table('suborder_rider_assignments')->where('rider_accept_order_status','Pending')->get();
      

      foreach($datas as $data){
        
          $updatevender=\DB::table('suborder_rider_assignments')->where('id',$data->id)
                              ->update([
                                'rider_accept_order_status' => 'Accepted',
                                'rider_status_updated_by'=>'Machin',
                                'rider_status_update_date'=>Carbon::now()->toDateTimeString(),
                                 ]);
           }




    $locality_name='';
    $locality_url='';

    if (!empty($locality)) {

        $localityobj=DB::table('localities')->where('locality_url',$locality)->select('locality_name','id','locality_url')->first();

    }else{

        $localityobj=DB::table('localities')->where('locality_url','bardi')->select('locality_name','id','locality_url')->first();

    }


    if (!empty($localityobj)) {
      $locality_name=$localityobj->locality_name;
      $locality_url=$localityobj->locality_url;
  }

// dd($locality_url); 

  Session::put('locality_url',$locality_url);

  Session::put('locality_name',$locality_name);

  if (!\Auth::guest()) {

          $role = \Auth::user()->role; 

          // dd($role);
 switch ($role) {
    case '1':
    return redirect::to('/admin/dashboard');
    break;

      case '2':
    return redirect::to('/seller/dashboard');
    break;

      case '5':
    return redirect::to('/service/dashboard');
    break;

      case '4':
    return redirect::to('/service-partner/dashboard');
    break;

 

    default:
    break;

}

}


// dd($locality);
// $ip=\Request::ip();
// $geolocation = \Location::get('117.222.49.32');

  $categories=DB::table('store_categories')
  ->where('status','Active')
  ->orderby('sort','asc')
  ->get();

$servic_categories=DB::table('service_categories')
->orderby('sort','asc')
->where('status','Active')
->get();


 // return view('frontend.index',compact('categories','locality','servic_categories'));
  return view('frontend.index', compact('categories', 'locality', 'servic_categories'));

}


public function append_search_cities(Request $request)
{   

    $cities=DB::table('cities')
    ->orderBy('cities.updated_at','desc')
    ->where('country_id','231');

    if (!empty($request->searchValue)) {
        $cities=$cities
        ->Where('cities.city_name','like',$request->searchValue . '%');
    }
    $cities=$cities
    ->select('cities.city_name','cities.id')
    ->get();

    return $cities;

}

public function append_search_categories(Request $request)
{   

    $store_categories=DB::table('store_categories')
    ->orderBy('store_categories.updated_at','desc');

    if (!empty($request->searchCat)) {
        $store_categories=$store_categories
        ->Where('store_categories.category_name','like',$request->searchCat . '%');
    }
    $store_categories=$store_categories
    ->select('store_categories.category_name','store_categories.id','store_categories.category_thumbnail_img')
    ->get();


$service_categories=DB::table('service_categories')
    ->orderBy('service_categories.updated_at','desc');

    if (!empty($request->searchCat)) {
        $service_categories=$service_categories
        ->Where('service_categories.category_name','like',$request->searchCat . '%');
    }
    $service_categories=$service_categories
    ->select('service_categories.category_name','service_categories.id','service_categories.category_thumbnail_img')
    ->get();



$array = array_merge($store_categories->toArray(), $service_categories->toArray());

    return $array;

}




public function append_search_localities(Request $request)
{   

    $localities=DB::table('localities')
    ->join('cities','localities.city_id','cities.id')
    ->join('states','cities.state_id','states.id')
    ->join('countries','states.country_id','countries.id');


    if (!empty($request->searchValue)) {
        $localities=$localities
        ->orWhere('localities.pincode','like',$request->searchValue . '%')
        ->orWhere('localities.locality_name','like',$request->searchValue . '%')
        ->orWhere('cities.city_name','like',$request->searchValue . '%')
        ->orWhere('states.state_name','like',$request->searchValue . '%')
        ->orWhere('countries.country_name','like',$request->searchValue . '%');
    }
    $localities=$localities
    ->select('localities.id','cities.city_name','countries.country_name','states.state_name','localities.locality_name','localities.pincode')
    ->where('countries.id','101')
    ->get();

    return $localities;

}


public function store_list(Request $request)
{   


  if (!\Auth::guest()) {

          $role = \Auth::user()->role; 

          // dd($role);
 switch ($role) {
    case '1':
    return redirect::to('/admin/dashboard');
    break;

      case '2':
    return redirect::to('/seller/dashboard');
    break;

      case '5':
    return redirect::to('/service/dashboard');
    break;

      case '4':
    return redirect::to('/service-partner/dashboard');
    break;

 

    default:
    break;

}

}

    $locality=\Request::segment(1);
    $category=\Request::segment(2);

// dd($locality);

 $localityobj=DB::table('localities')->where('locality_url',$locality)->select('locality_name','id','locality_url')->first();

  if (!empty($localityobj)) {
      $locality_name=$localityobj->locality_name;
  }

        Session::put('locality_url',$locality);
        Session::put('locality_name',$locality_name);

    $category=store_category::where('category_url',$category)->select('id','category_name')->first();

    $locality=locality::where('locality_url',$locality)->select('id')->first();


    $stor=store::where('store_category',$category->id)->where('store_locality',$locality->id);

    if (!empty($request->search)) {
        $stor=$stor
        ->where('store_name','like',$request->search . '%');
    }
    $stor=$stor
    ->where('stores.status','Active')
    ->where('stores.kyc_status','Active')
    ->paginate(12);

    $stores=[];
    foreach($stor as $index=>$data){

    $stores[]=[
    'store_link'=>$data->store_link,
    'store_cover_photo'=>$data->store_cover_photo,
    'store_name'=>$data->store_name,
    'locality'=>$data->locality,
    'city'=>$data->city,
    'store_rating'=>$this->store_ratings($data->user_id),
    'id'=>$data->id,
    'user_id'=>$data->user_id,
    'like_dislike'=>$this->like_dislikes($data->user_id),
    ];

    }


        // dd($stores);
    return view('frontend.store_list',compact('stores','category','stor'));

}



public function vendor_service_list(Request $request)
{   


  if (!\Auth::guest()) {

          $role = \Auth::user()->role; 

          // dd($role);
 switch ($role) {
    case '1':
    return redirect::to('/admin/dashboard');
    break;

      case '2':
    return redirect::to('/seller/dashboard');
    break;

      case '5':
    return redirect::to('/service/dashboard');
    break;

      case '4':
    return redirect::to('/service-partner/dashboard');
    break;

 

    default:
    break;

}

}



    $locality=\Request::segment(1);
    $category=\Request::segment(2);

// dd($locality);

 $localityobj=DB::table('localities')->where('locality_url',$locality)->select('locality_name','id','locality_url')->first();

  if (!empty($localityobj)) {
      $locality_name=$localityobj->locality_name;
  }

        Session::put('locality_url',$locality);
        Session::put('locality_name',$locality_name);

    $category=service_category::where('category_url',$category)->select('id','category_name')->first();

    $locality=locality::where('locality_url',$locality)->select('id')->first();


    $stor=service::where('service_category',$category->id)->where('service_locality',$locality->id);

    if (!empty($request->search)) {
        $stor=$stor
        ->where('service_name','like',$request->search . '%');
    }
    $stor=$stor
        ->where('services.status','Active')
    ->where('services.kyc_status','Active')
    ->paginate(12);

    $services=[];
    foreach($stor as $index=>$data){

    $services[]=[
    'service_link'=>$data->service_link,
    'service_cover_photo'=>$data->service_cover_photo,
    'service_name'=>$data->service_name,
    'locality'=>$data->locality,
    'city'=>$data->city,
    'service_rating'=>$this->store_ratings($data->user_id),
    'id'=>$data->id,
    'user_id'=>$data->user_id,
    'like_dislike'=>$this->like_dislikes($data->user_id),
    ];

    }

// dd($services);

    return view('frontend.vendor_service_list',compact('services','category','stor'));

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



public function service_detail($link)
{   


  if (!\Auth::guest()) {

          $role = \Auth::user()->role; 

          // dd($role);
 switch ($role) {
    case '1':
    return redirect::to('/admin/dashboard');
    break;

      case '2':
    return redirect::to('/seller/dashboard');
    break;

      case '5':
    return redirect::to('/service/dashboard');
    break;

      case '4':
    return redirect::to('/service-partner/dashboard');
    break;

 

    default:
    break;

}

}


    $record=service::where('service_link',$link)->first();

// dd($record);


    $like_dislike=$this->like_dislikes($record->user_id);

    $sum=DB::table('reviews')
    ->where('store_user_id',$record->user_id)
    ->select('rating')
    ->sum('rating');


    $reviews_count=DB::table('reviews')
    ->where('store_user_id',$record->user_id)
    ->select('rating')
    ->count();


    if (!empty($reviews_count)) {

        $total=$sum/$reviews_count;
        $avg_rating= $total;

    }else{

        $avg_rating= 0;

    }


    $reviews=DB::table('reviews')
    ->where('store_user_id',$record->user_id)
    ->get();


    $service_galleries=DB::table('service_photo_galleries')
    ->where('service_user_id',$record->user_id)
    ->get();


    $services=service::where('service_category',$record->service_category)
    ->where('services.status','Active')
    ->where('services.kyc_status','Active')
    ->where('service_locality',$record->service_locality)->paginate(8);


 $states = DB::table('states')  
                    ->select('state_name','id')
                     ->where('status','Active')
            ->orderBy('state_name', 'asc')->pluck('state_name','id'); 



// $use=service_vendor_category::where('service_vendor_categories.service_id',$record->id)
// ->get();

$use=DB::table('services')
->select(\DB::raw("GROUP_CONCAT(service_subcategories.service_subcategory) as service_subcategory"),\DB::raw("GROUP_CONCAT(service_subcategories.id) as id"))
->leftjoin("service_subcategories",\DB::raw("FIND_IN_SET(service_subcategories.id,services.service_subcategory)"),">",\DB::raw("'0'"))
->where('services.id',$record->id)
->groupby('service_subcategories.id')
->whereNotNull('service_subcategories.id')
->get();
    

 $categories = array();
foreach($use as $user) {
$categories[$user->id] = $user->service_subcategory;
}

// dd($categories);


    return view('frontend.service_detail',compact('record','avg_rating','reviews','service_galleries','services','reviews_count','like_dislike','states','categories'));

}



public function store_detail($link)
{   


  if (!\Auth::guest()) {

          $role = \Auth::user()->role; 

          // dd($role);
 switch ($role) {
    case '1':
    return redirect::to('/admin/dashboard');
    break;

      case '2':
    return redirect::to('/seller/dashboard');
    break;

      case '5':
    return redirect::to('/service/dashboard');
    break;

      case '4':
    return redirect::to('/service-partner/dashboard');
    break;

 

    default:
    break;

}

}


 



    $record=store::where('store_link',$link)->first();


// dd($record->store_product_category);


    $like_dislike=$this->like_dislikes($record->user_id);

    $sum=DB::table('reviews')
    ->where('store_user_id',$record->user_id)
    ->select('rating')
    ->sum('rating');


// dd($sum);
    $reviews_count=DB::table('reviews')
    ->where('store_user_id',$record->user_id)
    ->select('rating')
    ->count();


    if (!empty($reviews_count)) {

        $total=$sum/$reviews_count;
        $avg_rating= $total;

    }else{

        $avg_rating= 0;

    }


    $reviews=DB::table('reviews')
    ->where('store_user_id',$record->user_id)
    ->get();


    $store_galleries=DB::table('store_photo_galleries')
    ->where('store_user_id',$record->user_id)
    ->get();
// 
    $product_ids=DB::table('products')->where('products.store_id',$record->id)
    ->select('products.product_category',DB::raw('COUNT(products.product_category) as total'))
    ->groupby('product_category')
    ->orderBy('total','desc')
->first();

// dd($product);
$cat_id='';

if (!empty($product_ids)) {
   $cat_id=$product_ids->product_category;
}


    $stores=store::where('store_category',$record->store_category)
        ->where('stores.status','Active')
          ->where('stores.kyc_status','Active')
    ->where('store_locality',$record->store_locality)->paginate(8);


    return view('frontend.store_detail',compact('record','avg_rating','reviews','store_galleries','stores','reviews_count','like_dislike','cat_id'));

}



public function online_order($link,Request $request)
{   


  if (!\Auth::guest()) {

          $role = \Auth::user()->role; 

          // dd($role);
 switch ($role) {
    case '1':
    return redirect::to('/admin/dashboard');
    break;

      case '2':
    return redirect::to('/seller/dashboard');
    break;

      case '5':
    return redirect::to('/service/dashboard');
    break;

      case '4':
    return redirect::to('/service-partner/dashboard');
    break;

     default:
    break;

}

}


    $cartCollection = Cart::getContent();



    $record=store::where('store_link',$link)->first();


    $like_dislike=$this->like_dislikes($record->user_id);

//     $sum=DB::table('reviews')
//     ->where('store_id',$record->id)
//     ->select('rating')
//     ->sum('rating');


// // dd($sum);
//     $reviews_count=DB::table('reviews')
//     ->where('store_id',$record->id)
//     ->select('rating')
//     ->count();


//     if (!empty($reviews_count)) {

//         $total=$sum/$reviews_count;
//         $avg_rating= $total;

//     }else{

//         $avg_rating= 0;

//     }


    $product_category=DB::table('stores')
    ->select(\DB::raw("GROUP_CONCAT(product_categories.product_category) as product_category"),\DB::raw("GROUP_CONCAT(product_categories.id) as id"),'product_categories.product_category_url')
    ->leftjoin("product_categories",\DB::raw("FIND_IN_SET(product_categories.id,stores.store_product_category)"),">",\DB::raw("'0'"))
    ->where('stores.id',$record->id)
    ->groupby('product_categories.id')
    ->whereNotNull('product_categories.id')
    ->get();

// dd($product_category);

    $arr=0;
    $break_key=100;
    $product_cat_id='';
    $product_cat_name='';

    foreach($product_category as $index=>$data)
    {


        if ($index==0) {
            $product_cat_name=$data->product_category;

            $product_cat_id=$data->id;
        }

        if ($arr <= 120) {
            $product_cat_name=$data->product_category;

            $arr+=strlen($data->product_category)+3;

        }else{

            $break_key=$index;
            break;
        }




    }


// dd($product_cat_name);

    $product_subcategories=DB::table('product_subcategories')
//
    ->select('product_subcategory','id');

    if (!empty($request->category)) {

        $product_subcategories=$product_subcategories
        ->where('product_subcategories.product_category',$request->category);

    }else{

        $product_subcategories=$product_subcategories
        ->where('product_subcategories.product_category',$product_cat_id);
    }

    $product_subcategories=$product_subcategories
    ->get();

    $brands=DB::table('brands')
        ->join('products','products.product_brand','brands.id')

    ->select('brands.brand_name','brands.id');


    if (!empty($request->category)) {

        $brands=$brands
        ->where('products.product_category',$request->category);

    }else{

        $brands=$brands
        ->where('products.product_category',$product_cat_id);
    }
    $brands=$brands

    ->get();



    $produc=product::where('products.store_id',$record->id)
    ->join('product_items','products.id','product_items.product_id')
    ->select('products.id','products.product_name','product_items.item_price','product_items.item_offer_discount','product_items.item_img1','products.product_link',
        'product_items.item_unique_id','products.product_description','products.product_key_features','product_items.id as item_id','product_items.item_attr_varient','product_items.array_combine','product_items.item_status','products.product_category')
    ->where('product_items.item_status','Available')
    ->groupby('products.id');

    if (!empty($request->category)) {
        $produc=$produc
        ->where('products.product_category',$request->category);
    }


    if (!empty($request->subcategory)) {
        $produc=$produc
        ->where('products.product_subcategory',$request->subcategory);
    }


    if (!empty($request->brand)) {
        $produc=$produc
        ->where('products.product_brand',$request->brand);
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

// $record1=DB::table('commission_settings')->first();
// $percentage=$record1->commission_rate;



// $store1=store::find($this->id);





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


$item_selling_price=round($item_price,2);

if (!empty($data->item_offer_discount)) {
$item_selling_price=$this->item_selling_prices(round($item_price,2),$data->item_offer_discount);
}


       $products[]=(object)[
        'id'=>$data->id,
        'product_name'=>$data->product_name,
        'item_img1'=>$data->item_img1, 
        'item_price'=>$item_price,
        'item_selling_price'=>$item_selling_price,
        'item_offer_discount'=>$data->item_offer_discount,
        'product_category'=>$this->product_categories($data->id),
        'product_subcategory'=>$this->product_subcategories($data->id),
        // 'more_items_count'=>$this->more_items_count($data->id),
        // 'avg_rating'=>$this->avg_ratings($data->id),
        // 'reviews'=>$this->reviewss($data->id),
        'product_link'=>$data->product_link,
        // 'item_name'=>$data->item_name,
        // 'like_dislike'=>$this->like_dislikes($data->user_id),
        'item_unique_id'=>$data->item_unique_id,
        'attributes1'=>$this->attributes_funct($data->id),
        'item_id'=>$data->item_id,
        'shopping_cart'=>$this->shopping_carts($data->item_id),
        'item_attr_varient'=>$data->item_attr_varient,
        'array_combine'=>unserialize($data->array_combine),
        'item_status'=>$data->item_status,
        'addons'=>$this->addonsFunct($data->id),
        'product_description'=>$data->product_description,
    ];
}


// dd($products);
// Cart::clear();
$sum=DB::table('reviews')
    ->where('store_user_id',$record->user_id)
    ->select('rating')
    ->sum('rating');


// dd($sum);
    $reviews_count=DB::table('reviews')
    ->where('store_user_id',$record->user_id)
    ->select('rating')
    ->count();


    if (!empty($reviews_count)) {

        $total=$sum/$reviews_count;
        $avg_rating= $total;

    }else{

        $avg_rating= 0;

    }

    if (!empty($request->category)) {

$result=DB::table('product_categories')
->where('id',$request->category)
->select('id','product_category')
->first();

if (!empty($result)) {

$product_cat_name=$result->product_category;
}

    }

return view('frontend.online_order',compact('record','avg_rating','reviews_count','products','product_category','break_key','product_subcategories','product_cat_name','brands','produc','cartCollection','like_dislike'));

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

public function service_subcategories($service_subcategory)
{   


$result=DB::table('service_subcategories')
->where('id',$service_subcategory)
->select('id','service_subcategory')
->first();


if (!empty($result)) {
return $result->service_subcategory;

}
return '';

}





public function attr_base_change_item(Request $request)
{   


    // $array_combine=serialize(array_combine($request->attr_name, $request->attr_val));


    // return json_encode(['attr_name'=>$request->attr_name,'arr_val'=> $request->attr_val]);
    $produc=product::where('products.id',$request->product_id)
    ->leftjoin('product_items','products.id','product_items.product_id')
    ->select('product_items.id','product_items.array_combine')
    ->groupby('product_items.id')
    ->whereNotNull('product_items.array_combine')
    ->get();

    // return json_encode($produc);


$finalarr=[];


    foreach($produc as $index=>$data){

$arr=unserialize($data->array_combine);

$arr_key=array_keys($arr);
$arr_val=array_values($arr);


$attr_name=$request->attr_name;
$attr_val=$request->attr_val;


$result1=array_diff($arr_key,$attr_name);
$result2=array_diff($arr_val,$attr_val);

// return json_encode($arr_val);


if (count($result1) == 0 && count($result2) == 0) {
   
   $finalarr[]=$data->id;
}

    }


// return json_encode($finalarr);

    $produc=product::where('products.id',$request->product_id)
    ->join('product_items','products.id','product_items.product_id')
    ->select('products.id','products.product_name','product_items.item_price','product_items.item_offer_discount','product_items.item_img1','products.product_link',
        'product_items.item_unique_id','products.product_description','products.product_key_features','product_items.id as item_id','product_items.item_attr_varient','product_items.array_combine','products.store_id',
        'product_items.item_status','products.product_category')
    ->where('product_items.id',$finalarr[0])
    ->groupby('products.id')
    ->first();




    $record=store::where('id',$produc->store_id)->first();



// $record=DB::table('commission_settings')->first();
// $percentage=$record->commission_rate;


// $store1=store::find($this->id);

$percents=DB::table('commission_settings')->where('commission_store_id',$produc->product_category)->first();

$percentage1=0;


if (!empty($percents)) {
    $percentage1=$percents->commission_rate;
}

$record=DB::table('commission_settings')->first();

$percentage2=$record->commission_rate;

$percentage=$percentage1+$percentage2;


//     $item_price=$produc->item_price;

//     if (!empty($produc->item_offer_discount)) {
//        $item_price=$this->item_selling_prices($produc->item_price,$produc->item_offer_discount);
//    }

// $percent=($percentage / 100) * $item_price;

// $item_selling_price=$item_price+$percent;


$percent=($percentage / 100) * $produc->item_price;

$item_price=$produc->item_price+$percent;


    $item_selling_price=round($item_price,2);

    if (!empty($produc->item_offer_discount)) {
       $item_selling_price=$this->item_selling_prices(round($item_price,2),$produc->item_offer_discount);
   }


   $data=(object)[

     'id'=>$produc->id,
        'product_name'=>$produc->product_name,
        'item_img1'=>$produc->item_img1, 
        'item_price'=>$item_price,
        'item_selling_price'=>$item_selling_price,
        'item_offer_discount'=>$produc->item_offer_discount,
        'product_category'=>$this->product_categories($produc->id),
        'product_subcategory'=>$this->product_subcategories($produc->id),
        // 'more_items_count'=>$this->more_items_count($produc->id),
        // 'avg_rating'=>$this->avg_ratings($produc->id),
        // 'reviews'=>$this->reviewss($produc->id),
        'product_link'=>$produc->product_link,
        // 'item_name'=>$produc->item_name,
        // 'like_dislike'=>$this->like_dislikes($produc->user_id),
        'item_unique_id'=>$produc->item_unique_id,
        'attributes1'=>$this->attributes_funct($produc->id),
        'item_id'=>$produc->item_id,
        'shopping_cart'=>$this->shopping_carts($produc->item_id),
        'item_attr_varient'=>$produc->item_attr_varient,
        'array_combine'=>unserialize($produc->array_combine),
        'item_status'=>$produc->item_status,
        'addons'=>$this->addonsFunct($produc->id),
];



$loadbutton = View::make("frontend.item_list")->with(['item'=>$data,'record'=>$record])->render();


return json_encode(['loadbutton'=>$loadbutton]);

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




public function shopping_carts($itemId)
{


    $carts=Cart::get($itemId);

    // dd($carts);
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
public function like_dislikes($user_id)
{


//  $records=\DB::table('wishlists')
//         ->where('store_user_id',$user_id)
//         ->where('persone_user_id',\Auth::user()->id)
//         ->select('store_user_id','persone_user_id','id')
//         ->get();

// // dd($records);

// foreach ($records as $key => $value) {
         
  
//   if ($key != 0) {

//         $records=\DB::table('wishlists')
//         ->where('store_user_id',$user_id)
//         ->where('persone_user_id',\Auth::user()->id)
//         ->where('id',$value->id)
//         ->delete();
 
//   }

//          }       



    if(!Auth::guest()){

        $record=\DB::table('wishlists')
        ->where('store_user_id',$user_id)
        ->where('persone_user_id',\Auth::user()->id)
        ->first();
// dd($record);

        if (!empty($record)) {
         return $record->status;

     }
     return '';

 }


}





public function item_selling_prices($price,$offer_discount)
{   


    $selling_price = $price - ($price * ($offer_discount / 100));
    return round($selling_price,2);

}



public function avg_ratings($id)
{   

// dd($id);
 $sum=DB::table('reviews')
 ->where('product_id',$id)
 ->select('rating')
 ->sum('rating');


// dd($sum);
 $reviews_count=DB::table('reviews')
 ->where('product_id',$id)
 ->select('rating')
 ->count();


 if (!empty($reviews_count)) {

    $total=$sum/$reviews_count;

    $avg_rating= round($total);

}else{

    $avg_rating= 0.00;

}

// dd($avg_rating);
return $avg_rating;


}

public function reviewss($id)
{   


    $reviews_count=DB::table('reviews')
    ->where('product_id',$id)
    ->select('rating')
    ->count();

    return $reviews_count;

}


public function more_items_count($id)
{   

    $counts=DB::table('product_items')
    ->where('product_id',$id)
    ->select('id')
    ->count();

    return json_encode($counts);
}





public function product_item(Request $request)
{   

    return view('frontend.product_item');

}





public function product_detail(Request $request,$link)
{   


  $items=product::where('products.product_link',$link)
  ->join('product_items','products.id','product_items.product_id')
  ->select('products.id','products.product_name','product_items.item_price','product_items.item_offer_discount','product_items.item_img1','product_items.item_img2','product_items.item_img3','product_items.item_img4','product_items.item_description','products.store_id','product_items.id as item_id','product_items.item_attr_varient','products.product_description','products.product_key_features','product_items.id as item_id','product_items.item_status','products.product_category')
  ->where('product_items.item_unique_id',$request->item)
  ->groupby('products.id')->first();


  $record=store::where('id',$items->store_id)
  ->first();


      $like_dislike=$this->like_dislikes($record->user_id);


  $sum=DB::table('reviews')
  ->where('store_user_id',$record->id)
  ->select('rating')
  ->sum('rating');


  $reviews_count=DB::table('reviews')
  ->where('store_user_id',$record->id)
  ->select('rating')
  ->count();


  if (!empty($reviews_count)) {

    $total=$sum/$reviews_count;
    $avg_rating= $total;

}else{

    $avg_rating= 0;

}


$percents=DB::table('commission_settings')->where('commission_store_id',$items->product_category)->first();

$percentage1=0;


if (!empty($percents)) {
    $percentage1=$percents->commission_rate;
}

$record1=DB::table('commission_settings')->first();

$percentage2=$record1->commission_rate;

$percentage=$percentage1+$percentage2;


// $item_price=$items->item_price;

// if (!empty($items->item_offer_discount)) {

// $item_price=$this->item_selling_prices($items->item_price,$items->item_offer_discount);

// }

// $percent=($percentage / 100) * $item_price;

// $item_selling_price=$item_price+$percent;


$percent=($percentage / 100) * $items->item_price;


$item_price=$items->item_price+$percent;


$item_selling_price=$this->item_selling_prices(round($item_price,2),$items->item_offer_discount);


$avg_rating=$this->avg_ratings($items->id);

// $reviews=$this->reviewss($items->id);

$ratings=DB::table('reviews')
->where('product_id',$items->id)
->select('rating')
->sum('rating');


// $tabs=[
//     'Poor','Average','Good','VeryGood','Excellent'];

// // dd($value);
//     foreach($tabs as $index=>$ddd){

//         $review_tabs[$ddd]=$this->rating_percents($index+1,$reviews,$items->id,'#ff8c5a');

//     }

    // $reviewses=DB::table('reviews')
    // ->where('product_id',$items->id)
    // ->get();

    $attributes=DB::table('product_attributes')
    ->where('product_id',$items->id)
    ->get();


    $attr_arr=explode('/',$items->item_attr_varient);

// $attributes=[];

// foreach($attribut as $index=>$data){
// $attributes[]=[
// 'attribute_value'=>$data->attribute_value,
// 'id'=>$data->id,
// 'status'=>$this->attibute_status($data->id,$items->item_id),
// ];

// }
// dd($attributes);


  // $records=product::where('products.product_link',$link)
  //   ->join('product_items','products.id','product_items.product_id')
  //   ->select('products.id','products.product_name','product_items.item_price','product_items.item_offer_discount','product_items.item_img1','product_items.item_img2','product_items.item_img3','product_items.item_img4','product_items.item_description','products.store_id')
  //   ->groupby('product_items.id')
  //   ->get();


    $shopping_cart=Cart::get($items->item_id);


// dd($shopping_cart);$reviews  reviewses review_tabs
    return view('frontend.item_detail',compact('record','reviews_count','items','item_selling_price','avg_rating','attributes','ratings','attr_arr','shopping_cart','like_dislike'));


}




// public function attibute_status($id,$item_id)
// {   


//   $items=DB::table('product_items')
//     ->select('product_items.id','item_attr_varient')
//     ->where('product_items.id',$item_id)->first();

// $arr=[];

//     if (!empty($items)) {

// $arr=explode('/',$items->item_attr_varient);

//     }

// return $arr;

// }


public function rating_percents($value,$total,$id,$color)
{   

// dd($total);
   $review_tabs=DB::table('reviews')
   ->where('product_id',$id)
   ->where('rating',$value)
   ->count();

   $percent=0;

   if ($review_tabs) {
     $percent=$review_tabs/$total*100;

 }




 return ['count'=>$review_tabs,'percent'=>$percent,'color'=>$color];
}



public function view_cart(Request $request)
{   

  if (!\Auth::guest()) {

          $role = \Auth::user()->role; 

          // dd($role);
 switch ($role) {
    case '1':
    return redirect::to('/admin/dashboard');
    break;

      case '2':
    return redirect::to('/seller/dashboard');
    break;

      case '5':
    return redirect::to('/service/dashboard');
    break;

      case '4':
    return redirect::to('/service-partner/dashboard');
    break;

 

    default:
    break;

}

}


$carts=Cart::getContent();


$products=[];
$prodt=[];

$total_weight=0;
$total_weight_gram=0;
$total_weight_kg=0;
$total_weight_lb=0;
$total_weight_oz=0;



$total_price=0;
$discount_price=0;
$total_main_price=0;

$total_tax_price=0;

foreach($carts as $index=>$data){

$store_name=$this->stores_functions($data->associatedModel->store_id);

        $products[$store_name][$data->id]=$data;

        
$total_weight+=$data->associatedModel->item_shipping_weight;


$total_main_price+=round($data->associatedModel->item_price,2)*$data->quantity;

$total_price+=round($data->associatedModel->item_selling_price,2)*$data->quantity;

$discount_price=round($total_main_price-$total_price,2);

$total_tax_price = round($total_price * (18 / 100),2);



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

$all_kg=round($all_gram/1000,2);


$subtotal=round($total_main_price-$discount_price+$total_tax_price,2);

// dd($subtotal);


    return view('frontend.view_cart',compact('carts','products','all_kg','total_main_price','discount_price','total_tax_price','subtotal','total_price'));

}



  function readableMetric($kg)
    {
        $amt = $kg * pow(1000, 3);
        $s = array('mcg', 'mg', 'gm', 'kg','tonne');
        $e = floor(log10($amt)/log10(1000));
        return [
            "amount" => $amt/pow(1000, $e),
            "unit"   => $s[$e]
        ];
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








public function like_update(Request $request){


  $record=\DB::table('wishlists')
  ->where('store_user_id',$request->store_user_id)
  ->where('persone_user_id',\Auth::user()->id)
  ->first();


  if(!empty($record)){

      $updatevender=\DB::table('wishlists')->where('store_user_id',$request->store_user_id)
      ->where('persone_user_id',\Auth::user()->id)
      ->update([
        'status'=>'Like',
    ]);

  }else{
   $data = array(
    'store_id'=>$request->store_id,
    'persone_user_id'=>\Auth::user()->id,
    'status'=>'Like',
    'product_id'=>$request->product_id,
    'store_user_id'=>$request->store_user_id,
    'persone_name'=>\Auth::user()->name,
    'persone_role'=>\Auth::user()->role,

);
   $wishlist = new wishlist($data);
   $wishlist->save();

         // return json_encode($record);

}

return json_encode('Like');
}


public function dislike_update(Request $request){

 $record=\DB::table('wishlists')
 ->where('store_user_id',$request->store_user_id)
 ->where('persone_user_id',\Auth::user()->id)
 ->first();



 if(!empty($record)){

   $updatevender=\DB::table('wishlists')->where('store_user_id',$request->store_user_id)
   ->where('persone_user_id',\Auth::user()->id)
   ->update([
    'status'=>'Dislike',
]);
}else{
    $data = array(
        'store_id'=>$request->store_id,
        'persone_user_id'=>\Auth::user()->id,
        'status'=>'Dislike',
        'product_id'=>$request->product_id,
        'store_user_id'=>$request->store_user_id,
        'persone_name'=>\Auth::user()->name,
        'persone_role'=>\Auth::user()->role,


    );
    $wishlist = new wishlist($data);
    $wishlist->save();
}

return json_encode('Dislike');
}



public function attr_base_change_item_details(Request $request)
{   


    // $array_combine=serialize(array_combine($request->attr_name, $request->attr_val));

 $produc=product::where('products.id',$request->product_id)
    ->leftjoin('product_items','products.id','product_items.product_id')
    ->select('product_items.id','product_items.array_combine')
    ->groupby('product_items.id')
    ->whereNotNull('product_items.array_combine')
    ->get();

    // return json_encode($produc);


$finalarr=[];


    foreach($produc as $index=>$data){

$arr=unserialize($data->array_combine);

$arr_key=array_keys($arr);
$arr_val=array_values($arr);


$attr_name=$request->attr_name;
$attr_val=$request->attr_val;


$result1=array_diff($arr_key,$attr_name);
$result2=array_diff($arr_val,$attr_val);

// return json_encode($arr_val);


if (count($result1) == 0 && count($result2) == 0) {
   
   $finalarr[]=$data->id;
}

    }


// return json_encode($finalarr);

     $items=product::where('products.id',$request->product_id)
    ->join('product_items','products.id','product_items.product_id')
    ->select('products.id','products.product_name','product_items.item_price','product_items.item_offer_discount','product_items.item_img1','product_items.item_img2','product_items.item_img3','product_items.item_img4','product_items.item_description','products.store_id','product_items.id as item_id','product_items.item_attr_varient','products.product_description','products.product_key_features','product_items.item_unique_id',
        'product_items.item_status','products.product_category')
    ->where('product_items.id',$finalarr[0])
    ->groupby('products.id')
    ->first();


    $record=store::where('id',$items->store_id)
    ->first();

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


// $record1=DB::table('commission_settings')->first();
// $percentage=$record1->commission_rate;


// $store1=store::find($this->id);

$percents=DB::table('commission_settings')->where('commission_store_id',$items->product_category)->first();

$percentage1=0;


if (!empty($percents)) {
    $percentage1=$percents->commission_rate;
}

$record1=DB::table('commission_settings')->first();

$percentage2=$record1->commission_rate;

$percentage=$percentage1+$percentage2;

//     $item_price=$items->item_price;

//     if (!empty($items->item_offer_discount)) {

// $item_price=$this->item_selling_prices($items->item_price,$items->item_offer_discount);

// }
// $percent=($percentage / 100) * $item_price;


// $item_selling_price=$item_price+$percent;



$percent=($percentage / 100) * $items->item_price;


$item_price=$items->item_price+$percent;


    $item_selling_price=$this->item_selling_prices(round($item_price,2),$items->item_offer_discount);



    $avg_rating=$this->avg_ratings($items->id);

    $reviews=$this->reviewss($items->id);

    $ratings=DB::table('reviews')
    ->where('product_id',$items->id)
    ->select('rating')
    ->sum('rating');


    $tabs=[
        'Poor','Average','Good','VeryGood','Excellent'];

        foreach($tabs as $index=>$ddd){

            $review_tabs[$ddd]=$this->rating_percents($index+1,$reviews,$items->id,'#ff8c5a');

        }

        $reviewses=DB::table('reviews')
        ->where('product_id',$items->id)
        ->get();

        $attributes=DB::table('product_attributes')
        ->where('product_id',$items->id)
        ->get();


        $attr_arr=explode('/',$items->item_attr_varient);



        $records=product::where('products.id',$items->id)
        ->join('product_items','products.id','product_items.product_id')
        ->select('products.id','products.product_name','product_items.item_price','product_items.item_offer_discount','product_items.item_img1','product_items.item_img2','product_items.item_img3','product_items.item_img4','product_items.item_description','products.store_id')
        ->groupby('product_items.id')
        ->get();


        $shopping_cart=Cart::get($items->item_id);


// dd($shopping_cart);


        $loadbutton = View::make("frontend.item_detail_list")->with(['items'=>$items,
            'reviews_count'=>$reviews_count,
            'item_selling_price'=>$item_selling_price,
            'avg_rating'=>$avg_rating,
            'reviews'=>$reviews,
            'attributes'=>$attributes,
            'review_tabs'=>$review_tabs,
            'ratings'=>$ratings,
            'reviewses'=>$reviewses,
            'attr_arr'=>$attr_arr,
            'shopping_cart'=>$shopping_cart])->render();



        return json_encode(['loadbutton'=>$loadbutton,'item_id'=>$items->item_unique_id]);




    }

public function testmail(Request $request)
 {
     


    $output= $this->TestMailTemplet($request->template_name);

         dd($output);



//        try{
           
//             \Mail::raw('Hi, welcome user!', function ($message) {
//                  $message->from('mandeclandotcom@gmail.com', 'mandeclandotcom');
// $message->to('zareena2086@gmail.com', 'zareena MandeClan Test');
//    $message->subject('Test Email Address by MandeClan');
   
// });

//                 dd('success');

           
//         } catch (\Exception $e) {
//  dd($e);
//  }
     

 }


public function testsms(Request $request)
 {
   

  
        $receiverNumber = "+919673259597";

        $message = "This is testing from mandeclan.com";

  

        try {

  

            $account_sid = getenv("TWILIO_SID");

            $auth_token = getenv("TWILIO_AUTH_TOKEN");

            $twilio_number = getenv("TWILIO_NUMBER");

  

            $client = new Client($account_sid, $auth_token);

            $client->messages->create($receiverNumber, [

                'from' => $twilio_number, 

                'body' => $message]);


$message = $client->messages
                  ->create("whatsapp:".$receiverNumber, // to
                           [
                               "mediaUrl" => ["https://images.unsplash.com/photo-1545093149-618ce3bcf49d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=668&q=80"],
                               "from" => "whatsapp:".$twilio_number,
                                "body" => $message
                           ]
                  );


            dd('SMS Sent Successfully.');

  

        } catch (Exception $e) {

            dd("Error: ". $e->getMessage());

        }

} 





public function sendCustomMessage(Request $request)
    {
        $validatedData = $request->validate([
            'users' => 'required|array',
            'body' => 'required',
        ]);
        $recipients = $validatedData["users"];
        // iterate over the array of recipients and send a twilio request for each
        foreach ($recipients as $recipient) {
            $this->sendMessage($validatedData["body"], $recipient);
        }
        return back()->with(['success' => "Messages on their way!"]);
    }
    /**
     * Sends sms to user using Twilio's programmable sms client
     * @param String $message Body of sms
     * @param Number $recipients Number of recipient
     */
    private function sendMessage($message, $recipients)
    {
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");
        $client = new Client($account_sid, $auth_token);
        $client->messages->create($recipients, ['from' => $twilio_number, 'body' => $message]);
    }


public function checkout(Request $request)
{   


  if (!\Auth::guest()) {

          $role = \Auth::user()->role; 

          // dd($role);
 switch ($role) {
    case '1':
    return redirect::to('/admin/dashboard');
    break;

      case '2':
    return redirect::to('/seller/dashboard');
    break;

      case '5':
    return redirect::to('/service/dashboard');
    break;

      case '4':
    return redirect::to('/service-partner/dashboard');
    break;

 

    default:
    break;

}

}


    $products=Cart::getContent();

dd($products);

$total_weight_gram=0;
$total_weight_kg=0;
$total_weight_lb=0;
$total_weight_oz=0;
// $item_price=[];
// $item_selling_price=[];


foreach($products as $index=>$data){

// $item_price[$data->associatedModel->store_id][]=round($data->associatedModel->item_price,2);
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

$all_kg=round($all_gram/1000,2);



$customer=customer::where('user_id',Auth::user()->id)
->first();


$addressBook=customer_address_book::where('user_id',Auth::user()->id)->get();


        $configs = config::first(); 

        $bank_detail = bank_detail::first();

    return compact('products','all_kg','customer','addressBook','configs','bank_detail');

}




public function online_book($link,Request $request)
{   

  if (!\Auth::guest()) {

          $role = \Auth::user()->role; 

          // dd($role);
 switch ($role) {
    case '1':
    return redirect::to('/admin/dashboard');
    break;

      case '2':
    return redirect::to('/seller/dashboard');
    break;

      case '5':
    return redirect::to('/service/dashboard');
    break;

      case '4':
    return redirect::to('/service-partner/dashboard');
    break;

 

    default:
    break;

}

}


    $record=service::where('service_link',$link)->first();

    $like_dislike=$this->like_dislikes($record->user_id);



$service_subcategory=DB::table('services')
->select(\DB::raw("GROUP_CONCAT(service_subcategories.service_subcategory) as service_subcategory"),\DB::raw("GROUP_CONCAT(service_subcategories.id) as id"))
->leftjoin("service_subcategories",\DB::raw("FIND_IN_SET(service_subcategories.id,services.service_subcategory)"),">",\DB::raw("'0'"))
->where('services.id',$record->id)
->groupby('service_subcategories.id')
->whereNotNull('service_subcategories.id')
->get();





 $product_category=DB::table('stores')
    ->select(\DB::raw("GROUP_CONCAT(product_categories.product_category) as product_category"),\DB::raw("GROUP_CONCAT(product_categories.id) as id"),'product_categories.product_category_url')
    ->leftjoin("product_categories",\DB::raw("FIND_IN_SET(product_categories.id,stores.store_product_category)"),">",\DB::raw("'0'"))
    ->where('stores.id',$record->id)
    ->groupby('product_categories.id')
    ->whereNotNull('product_categories.id')
    ->get();

    


    $brands=DB::table('brands')
    ->join('vendor_services','vendor_services.service_brand','brands.id')
    ->select('brands.brand_name','brands.id');


    if (!empty($request->category)) {

        $brands=$brands
        ->where('vendor_services.service_subcategory',$request->category);

    }
    $brands=$brands

    ->get();



    $produc=service::where('services.id',$record->id)
    ->join('vendor_services','services.id','vendor_services.service_id')
    ->select('services.id','vendor_services.service_name','vendor_services.service_price','vendor_services.service_offer_discount','vendor_services.service_img','services.service_link',
        'vendor_services.service_unique_id','services.service_description','vendor_services.id as vendor_service_id','vendor_services.status','vendor_services.service_brand','vendor_services.service_subcategory')
    ->where('services.status','Active')
    ->where('services.kyc_status','Active')
    ->groupby('vendor_services.id');

    if (!empty($request->category)) {
        $produc=$produc
        ->where('vendor_services.service_subcategory',$request->category);
    }



    if (!empty($request->brand)) {
        $produc=$produc
        ->where('vendor_services.service_brand',$request->brand);
    }


    if (!empty($request->sort)) {

        if ($request->sort=='new') {
            $produc=$produc
            ->orderBy('vendor_services.id','desc');
        }else{
            $produc=$produc
            ->orderBy('vendor_services.service_price',$request->sort);
        }

    }


    $produc=$produc
    ->paginate(20);


// dd($produc);
    $services=[];

    foreach($produc as $index=>$data){

        $service_selling_price=$data->service_price;

        if (!empty($data->service_offer_discount)) {
           $service_selling_price=$this->item_selling_prices($data->service_price,$data->service_offer_discount);
       }
       $services[]=(object)[
        'id'=>$data->id,
        'service_name'=>$data->service_name,
        'service_img'=>$data->service_img, 
        'service_price'=>$data->service_price,
        'service_selling_price'=>$service_selling_price,
        'service_offer_discount'=>$data->service_offer_discount,
        'service_subcategory'=>$this->service_subcategories($data->service_subcategory),
        'service_link'=>$data->service_link,
        'service_unique_id'=>$data->service_unique_id,
        'service_id'=>$data->id,
        'status'=>$data->status,
        'brand_name'=>$this->service_brands($data->service_brand),
        'service_description'=>$data->service_description,
    ];
}


// dd($services);

$sum=DB::table('reviews')
    ->where('store_user_id',$record->id)
    ->select('rating')
    ->sum('rating');


// dd($sum);
    $reviews_count=DB::table('reviews')
    ->where('store_user_id',$record->id)
    ->select('rating')
    ->count();


    if (!empty($reviews_count)) {

        $total=$sum/$reviews_count;
        $avg_rating= $total;

    }else{

        $avg_rating= 0;

    }


$service_cat_name='';

    if (!empty($request->category)) {

$result=DB::table('service_subcategories')
->where('id',$request->category)
->select('id','service_subcategory')
->first();


if (!empty($result)) {

$service_cat_name=$result->service_subcategory;
}

    }




 $categories = array();
foreach($service_subcategory as $user) {
$categories[$user->id] = $user->service_subcategory;
}


return view('frontend.online_book',compact('record','avg_rating','reviews_count','services','service_subcategory','service_cat_name','brands','like_dislike','categories'));

    }

    


public function payment_process(Request $request)
{   

return view('frontend.payment_process');

}


 public function append_state(Request $request)
    {   
             $countryId= $request->id;
         $disticts =\DB::table('states')
                      ->join('countries', 'states.country_id', '=', 'countries.id')
                      ->select('states.*','countries.country_name')
                       ->where("states.country_id",$countryId)
                       ->where("states.status",'Active')
                      ->pluck('states.state_name','states.id');

        

        return json_encode($disticts);
    }


        public function append_city(Request $request)
    {   
             $stateId= $request->id;
         $disticts =\DB::table('cities')
                      ->join('states', 'cities.state_id', '=', 'states.id')
                       ->where("cities.state_id",$stateId)
                       ->where("cities.status",'Active')
                      ->pluck('cities.city_name','cities.id');
                      
        return json_encode($disticts);
    }



     public function append_locality(Request $request)
    {   
             $cityId= $request->id;
         $disticts =\DB::table('localities')
                      ->join('cities', 'localities.city_id', '=', 'cities.id')
                       ->where("localities.city_id",$cityId)
                       ->where("localities.status",'Active')
                      ->pluck('localities.locality_name','localities.id');
                      
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

}
