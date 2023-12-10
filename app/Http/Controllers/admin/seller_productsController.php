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


class seller_productsController extends Controller
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
       
        $records=DB::table('products')->orderBy('products.id','desc')
        ->join('product_categories','product_categories.id','products.product_category')
 ->leftjoin('product_subcategories','product_subcategories.id','products.product_subcategory')
             ->leftjoin('brands','brands.id','products.product_brand');
         if (!empty($request->search)) {
         $term=$request->search;
$records=$records
->where(function($q) use ($term) {
$q
        ->orWhere('products.product_name','like','%' . $term . '%');
    });
}

         $records= $records
         ->select('products.*','product_categories.product_category','product_subcategories.product_subcategory','brands.brand_name','products.master_id')
         // ->where('products.store_id',$this->id)
        ->paginate(25);



         $use = DB::table('products')  
                    ->select('product_name','id')        
   
            ->orderBy('product_name', 'asc')->get(); 

 $products = array();
foreach($use as $user) {
$products[$user->product_name] = $user->product_name;
}



 $checks=DB::table('stores')
        ->join('store_categories','store_categories.id','stores.store_category')
        // ->where('stores.id',$this->id)
        ->select('stores.id','store_categories.category_name')->first();

return view('admin.seller_products.index',compact('records','products','checks'));
   
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
    public function show($id)
    {
                 $view='';

        return view('admin.seller_products.show',compact('view'));
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
}
