<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\product_master;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;
use Image;
use File;
use Auth;
use App\product;


class product_mastersController extends Controller
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
      

      $table_id=DB::table('products')
         ->where('products.store_id',$this->id)
         ->where('master_id','<>',0)
         ->pluck('master_id','master_id')->toarray();


         // dd($table);

    $records=DB::table('product_masters')->orderBy('product_masters.id','desc')
    ->join('store_categories','store_categories.id','product_masters.store_category')
            ->join('stores','stores.store_category','store_categories.id')
            ->leftjoin('brands','brands.id','product_masters.product_brand')

    ->join('product_categories','product_categories.id','product_masters.product_category')
    ->leftjoin('product_subcategories','product_subcategories.id','product_masters.product_subcategory');
    if (!empty($request->search)) {
    $term=$request->search;
$records=$records
->where(function($q) use ($term) {
$q
    ->orWhere('product_masters.product_name','like','%' . $term . '%');
});
    }

    $records= $records
    ->select('product_masters.*','product_categories.product_category','product_subcategories.product_subcategory','store_categories.category_name','brands.brand_name')
    ->where('stores.id',$this->id)
    ->whereNotIn('product_masters.id',$table_id)
    ->paginate(25);


// dd($records);

return view('seller.product_master.index',compact('records'));


    }



        public function master_product_store(Request $request)
    {



$master=DB::table('product_masters')
->where('id',$request->id)->first();


$record=DB::table('stores')
->where('id',$this->id)->select('id','store_unique_id')->first();

$data = array(
'store_id'=>$record->id,
'user_id'=>$this->user_id,
'store_unique_id'=>$record->store_unique_id,
'product_unique_id'=>$master->product_unique_id,
'product_category'=>$master->product_category,
'product_subcategory'=>$master->product_subcategory,
'product_name'=>$master->product_name,
'product_brand'=>$master->product_brand,
'product_key_features'=>$master->product_key_features,
'product_description'=>$master->product_description,
'product_wg_duration'=>$master->product_wg_duration,
'product_wg_dmy'=>$master->product_wg_dmy,
'product_wg_type'=>$master->product_wg_type,
'product_video_url'=>$master->product_video_url,
'product_tags'=>$master->product_tags,
'product_free_shipping'=>$master->product_free_shipping,
'product_status'=>$master->product_status,
'product_cancel_available'=>$master->product_cancel_available,
'product_cod'=>$master->product_cod,
'product_cover_photo'=>$master->product_cover_photo,
'product_link'=>str_replace(' ','-',strtolower($master->product_name)).'-'.$master->product_unique_id,
'master_id'=>$master->id,
'created_by'=>'Master',
);

// dd($data);
         $product = new product($data);
         $product->save();


return json_encode(['status'=>'success']);

    }




}