<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\shop_category;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;
use App\product_category;

class categoriesController extends Controller
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

      }if (\Auth::user()->role == "2") {
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
       

$stores=DB::table('stores')
->select('store_category','id','store_name')
->where('id',$this->id)
->first();


// dd($this->id);

    
  $use = DB::table('store_categories')  
                    ->select('category_name','id')        
   ->whereNotIn('id',[$stores->store_category])
            ->orderBy('category_name', 'asc')->get(); 

 $store_categorys = array();
foreach($use as $user) {
$store_categorys[$user->id] = $user->category_name;
}




$shop_categ=DB::table('stores')
->select(\DB::raw("GROUP_CONCAT(product_categories.product_category) as product_category"),\DB::raw("GROUP_CONCAT(product_categories.id) as id"))
->leftjoin("product_categories",\DB::raw("FIND_IN_SET(product_categories.id,stores.store_product_category)"),">",\DB::raw("'0'"))
->where('stores.id',$this->id)
->groupby('product_categories.id')
->whereNotNull('product_categories.id')
->get();



$newarr=[];
$shop_categories=[];

foreach($shop_categ as $index=>$data){

$newarr[]=$data->id;

$shop_categories[]=(object)[
'product_category'=>$data->product_category,
'id'=>$data->id,
'permission'=>$this->checks_allow_or_not($data->id),
];


}

// dd($newarr);

   $categories= DB::table('product_categories')
->where('product_categories.store_category',$stores->store_category)
->select('product_categories.product_category','product_categories.id');

if (count($newarr)>0) {
   $categories= $categories
   ->whereNotIn('product_categories.id',$newarr);
}

 $categories= $categories
->get();



// dd($categories);

return view('seller.categories.index',compact('categories','store_categorys','shop_categories','stores'));
   
    }


     public function checks_allow_or_not($id)
    {
         $record=DB::table('products')->where('product_category',$id)->where('store_id',$this->id)->first();

if (!empty($record)) {
    return 'Yes';
}
         return 'Not';
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $record='';

         return view('seller.categories.create',compact('record'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $category_id=DB::table('product_categories')
        ->select('store_category','id','product_category')
        ->whereIn('id',$request->category_id)
        ->get();

                
foreach($category_id as $index=>$data){

     $data = array(
    'store_id'=>$this->id,
    'user_id'=>$this->user_id,
    'store_category_id'=>$data->store_category,
    'product_category_id'=>$data->id,
        'status'=>'Active',
        'product_category'=>$data->product_category,

);


$shop_category = shop_category::updateOrCreate($data);


DB::table('stores')
->where('id',$this->id)
->update([
'store_product_category'=>implode(',',$request->category_id),
]);
}
        
         
                 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('seller/categories')->with($notification);

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

        return view('seller.categories.show',compact('view'));
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
        $record = shop_category::find($id);         
        
         return view('seller.categories.edit',compact('record'));

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
        
        $shop_category = shop_category::find($id); 

   $data = array(
    'store_id'=>$request->input('store_id'),
    'store_category_id'=>$request->input('store_category_id'),
    'product_category_id'=>$request->input('product_category_id'),    
);
         $shop_category->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('seller/categories')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
         $shop_category = shop_category::find($request->id);
          $shop_category->delete();

          return $shop_category;
    }

     public function status_update(Request $request){
 
         $record=shop_category::find($request->user_id);
      
          if($record['status']=='Active'){
               $updatevender=\DB::table('store_categories')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);
            return json_encode('Deactive');
           } else {
              $updateuser=\DB::table('store_categories')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Active',
                                // 'updated_at' => date('Y-m-d H:i:s') 
                                 ]);
              return json_encode("Active");

        }
           }

 

   public function append_category_checkbox(Request $request)
    {
      
$stores=DB::table('stores')
->select('store_product_category','id')
->where('id',$this->id)
->first();

$arr=explode(',', $stores->store_product_category);

 $categories= DB::table('product_categories')
->where('product_categories.store_category',$request->id)
->select('product_categories.product_category','product_categories.id')
->whereNotIn('id',$arr)
->get();

return json_encode($categories);

      }



       public function store_custom_category(Request $request)
    {


$product_category=DB::table('product_categories')->where('product_category',$request->product_category)->first();


if (empty($product_category)) {
     $data = array(
    'product_category'=>$request->input('product_category'),
'product_category_url'=>str_replace(' ','-',strtolower($request->product_category)),

);
        
$product_category = product_category::updateOrCreate($data);

}


$data = array(
'store_id'=>$this->id,
'user_id'=>$this->user_id,
'store_category_id'=>$product_category->store_category,
'product_category_id'=>$product_category->id,
'status'=>'Active',
'product_category'=>$product_category->product_category,
);


$shop_category = shop_category::updateOrCreate($data);



  $category_id=DB::table('stores')
        ->select('store_product_category','id')
        ->where('id',$this->id)
        ->first();



DB::table('stores')
->where('id',$this->id)
->update([
'store_product_category'=>$category_id->store_product_category.','.$product_category->id,

]);



$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('seller/categories')->with($notification);

    }

}
