<?php
namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\service;
use App\locality;
use App\service_category;
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
use App\service_vendor_category;
use App\service_booking;



class serviceHomeApiController extends Controller
{


    public function testapi(Request $request)
    {
        return json_encode('success');


    }


    public function service_categories(Request $request)
    {     

       $path=url('/').'/public/images/category_img/';


       $servic_categories=DB::table('service_categories')
       ->select('id','category_name','category_title',DB::raw("CONCAT('".$path."',service_categories.category_img) as category_img"))
       ->where('status','Active')
       ->get();


       return json_encode($servic_categories);

   }


   public function service_list(Request $request)
   {    


     $stor=service::where('service_category',$request->category_id)->where('service_locality',$request->locality_id);

     if (!empty($request->search)) {
        
        $term=$request->search;
$stor=$stor
->where(function($q) use ($term) {
$q
        ->where('service_name','like',. $term . '%');
    });
    }
    $stor=$stor
    ->get();

    $stores=[];

    $path=url('/').'/public/images/service_cover_photo/';


    $services=[];
    foreach($stor as $index=>$data){

        $services[]=[
            'service_link'=>$data->service_link,
            'service_cover_photo'=>$path.'/'.$data->service_cover_photo,
            'service_name'=>$data->service_name,
            'locality'=>$data->locality,
            'city'=>$data->city,
            'service_rating'=>$this->service_ratings($data->user_id),
            'id'=>$data->id,
            'user_id'=>$data->user_id,
            'like_dislike'=>$this->like_dislikes($data->user_id),
        ];

    }

// dd($services);

    return json_encode($services);

}




public function service_ratings($id)
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




public function service_detail(Request $request)
{    



    $record1=service::where('id',$request->service_id)->first();


    $path=url('/').'/public/images/service_cover_photo/';


    $record=(object)[
        'id'=>$record1->id,
        'category_url'=>$record1->category->category_url,
        'category_name'=>$record1->category->category_name,
        'service_name'=>$record1->service_name,
        'service_cover_photo'=>$path.'/'.$record1->service_cover_photo,
        'locality_name'=>$record1->locality->locality_name,
        'state_name'=>$record1->state->state_name,
        'service_mobile'=>$record1->service_mobile,
        'service_phone'=>$record1->service_phone,
        'service_email'=>$record1->service_email,
        'service_open_time'=>$record1->service_open_time,
        'service_close_time'=>$record1->service_close_time,
        'service_address'=>$record1->service_address,
        'service_description'=>$record1->service_description,
    ];



    $like_dislike=$this->like_dislikes($record1->user_id);

    $sum=DB::table('reviews')
    ->where('store_user_id',$record1->id)
    ->select('rating')
    ->sum('rating');


// dd($sum);
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


    $service_galleries=DB::table('service_photo_galleries')
    ->where('service_user_id',$record1->id)
    ->select('id',DB::raw("CONCAT('".$path."', gallery_img) as gallery_img"))
    ->get();


    $stor=service::where('service_category',$record1->service_category)
    ->where('service_locality',$record1->service_locality)->limit(8)->get();


    $outlet_services=[];

    $path=url('/').'/public/images/service_cover_photo/';

    foreach($stor as $index=>$data){

        $outlet_services[]=[
            'service_link'=>$data->service_link,
            'service_cover_photo'=>$path.'/'.$data->service_cover_photo,
            'service_name'=>$data->service_name,
            'locality'=>$data->locality,
            'city'=>$data->city,
            'service_rating'=>$this->service_ratings($data->user_id),
            'id'=>$data->id,
            'user_id'=>$data->user_id,
            'like_dislike'=>$this->like_dislikes($data->user_id),
        ];

    }



    return compact('record','avg_rating','reviews','service_galleries','outlet_services','reviews_count','like_dislike');

}





public function service_item_list(Request $request)
{    

 // $record=service::where('id',$request->service_id)->first();


    // $service_subcategory=service_vendor_category::where('service_vendor_categories.service_id',$request->service_id)
    // ->get();

$service_subcategory=DB::table('services')
->select(\DB::raw("GROUP_CONCAT(service_subcategories.service_subcategory) as service_subcategory"),\DB::raw("GROUP_CONCAT(service_subcategories.id) as id"))
->leftjoin("service_subcategories",\DB::raw("FIND_IN_SET(service_subcategories.id,services.service_subcategory)"),">",\DB::raw("'0'"))
->where('services.id',$request->service_id)
->groupby('service_subcategories.id')
->whereNotNull('service_subcategories.id')
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


    $path=url('/').'/public/images/service_img/';


    $produc=service::where('services.id',$request->service_id)
    ->join('vendor_services','services.id','vendor_services.service_id')
    ->select('services.id','vendor_services.service_name','vendor_services.service_price','vendor_services.service_offer_discount',DB::raw("CONCAT('".$path."', vendor_services.service_img) as service_img"),'services.service_link',
        'vendor_services.service_unique_id','services.service_description','vendor_services.id as vendor_service_id','vendor_services.status','vendor_services.service_brand','vendor_services.service_subcategory')
    ->where('vendor_services.status','Active')
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



    $services=[];

    foreach($produc as $index=>$data){

        $service_selling_price=$data->service_price;

        if (!empty($data->service_offer_discount)) {
         $service_selling_price=$this->item_selling_prices($data->service_price,$data->service_offer_discount);
     }
     $services[]=(object)[
        'id'=>$index+1,
        'service_name'=>$data->service_name,
        'service_img'=>$data->service_img, 
        'service_price'=>$data->service_price,
        'service_selling_price'=>$service_selling_price,
        'service_offer_discount'=>$data->service_offer_discount,
        'service_subcategory'=>$this->service_subcategories($request->service_subcategory),
        // 'service_link'=>$data->service_link,
        // 'service_unique_id'=>$data->service_unique_id,
        'service_id'=>$data->vendor_service_id,
        'status'=>$data->status,
        'brand_name'=>$this->service_brands($data->service_brand)
    ];
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

return compact('services','service_subcategory','service_cat_name','brands');



}



public function item_selling_prices($price,$offer_discount)
{   


    $selling_price = $price - ($price * ($offer_discount / 100));
    return $selling_price;

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




public function service_book_enquiry(Request $request)
{    

    $data = array(  
        'title'=>$request->input('title'),
        'start_date'=>$request->start_date,
        'end_date'=>$request->end_date,
        'status'=>'Pending',
        'description'=>$request->input('description'),
        'service_user_id'=>$request->service_user_id,
        'user_id'=>Auth::user()->id,
        'booking_date'=>$request->start_date.'-'.$request->end_date,
        'booked_by'=>'Customer',
        'booking_amount'=>$request->input('booking_amount'),
        'advance_amount'=>$request->input('advance_amount'),
        'payment_mode'=>$request->input('payment_mode'),
'booking_subcategory'=>implode(',',$request->input('booking_subcategory')),

    );

// dd($data);
    $events = new service_booking($data);
    $events->save();

    return json_encode(['status'=>'success']);


}



public function service_booking_category(Request $request)
{
//     $categories=service_vendor_category::where('service_vendor_categories.service_id',$request->service_id)
//     ->select('service_subcategory','service_subcategory_id as id')
// ->get();

$categories=DB::table('services')
->select(\DB::raw("GROUP_CONCAT(service_subcategories.service_subcategory) as service_subcategory"),\DB::raw("GROUP_CONCAT(service_subcategories.id) as id"))
->leftjoin("service_subcategories",\DB::raw("FIND_IN_SET(service_subcategories.id,services.service_subcategory)"),">",\DB::raw("'0'"))
->where('services.id',$request->service_id)
->groupby('service_subcategories.id')
->whereNotNull('service_subcategories.id')
->get();



    return json_encode($categories);


}


}