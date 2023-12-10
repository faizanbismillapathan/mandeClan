<?php

namespace App\Http\Controllers\admin;

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


class productsController extends Controller
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
      


// $masters = DB::table('product_masters')
// ->join('product_categories','product_categories.id','product_masters.product_category')
// ->join('store_categories','product_categories.store_category','store_categories.id')  
// ->select('store_categories.id as store_cat','product_masters.id')        
// ->get(); 


// foreach($masters as $index=>$data){

//     DB::table('product_masters')
//     ->where('id',$data->id)
//     ->update([

// 'store_category'=>$data->store_cat,
//     ]);
// } 




        $records=DB::table('product_masters')->orderBy('product_masters.id','desc')
        ->join('store_categories','store_categories.id','product_masters.store_category')
        ->join('product_categories','product_categories.id','product_masters.product_category')
 ->leftjoin('product_subcategories','product_subcategories.id','product_masters.product_subcategory')        
  ->leftjoin('brands','brands.id','product_masters.product_brand');
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
        ->paginate(25);



         $use = DB::table('product_masters')  
                    ->select('product_name','id')        
   
            ->orderBy('product_name', 'asc')->get(); 

 $products = array();
foreach($use as $user) {
$products[$user->product_name] = $user->product_name;
}

//  DB::table('count_masters')
// ->where('id','1')
// ->update([
// 'state_count'=>$count,
// ]);

return view('admin.products.index',compact('records','products'));
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//         $record=DB::table('stores')
// ->select('id','store_category','store_product_category')->get();

  $categories = DB::table('store_categories')  
        
        ->pluck('store_categories.category_name','store_categories.id'); 

        // $categories = DB::table('product_categories')  
        // ->whereIn('product_categories.id',explode(',',$record->store_product_category))
        // ->pluck('product_categories.product_category','product_categories.id'); 

// dd($categories);

 // $brands = DB::table('brands')  
 //                    ->select('brand_name','id')
 //                     ->where('status','Active')
 //                     ->where('brand_category',$record->store_product_category)
 //            ->orderBy('brand_name', 'asc')->pluck('brand_name','id'); 


$warranty = [];
for ($warranty_exp=1; $warranty_exp <= 12; $warranty_exp++) $warranty[$warranty_exp] = $warranty_exp;


  

         $autoincid = mt_rand(10,100);
         $Y = date('Ys');
         $keydata = 'Prod'.$Y.''.$autoincid;


         return view('admin.products.create',compact('categories','warranty','keydata'));
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
// 'store_id'=>$record->id,
// 'user_id'=>Auth::user()->id,
// 'store_unique_id'=>$record->store_unique_id,
'product_unique_id'=>$request->input('product_unique_id'),
'store_category'=>$request->input('store_category'),
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
'product_free_shipping'=>$product_free_shipping,
'product_status'=>$product_status,
'product_cancel_available'=>$product_cancel_available,
'product_cod'=>$product_cod,
'product_cover_photo'=>$product_cover_photo,
'product_link'=>str_replace(' ','-',strtolower($request->product_name)).'-'.$request->product_unique_id,
);

// dd($data);
         $product_master = new product_master($data);
         $product_master->save();
                 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/products')->with($notification);

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

        return view('admin.products.show',compact('view'));
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
        $record = product_master::find($id);         


        

  $categories = DB::table('store_categories')        
        ->pluck('store_categories.category_name','store_categories.id'); 



        $product_categories = DB::table('product_categories')  
        ->where('product_categories.store_category',$record->store_category)
        ->pluck('product_categories.product_category','product_categories.id'); 



 $subcategories = DB::table('product_subcategories')  
        ->where('product_category',$record->product_category)
        ->pluck('product_subcategories.product_subcategory','product_subcategories.id'); 


 $brands = DB::table('brands')  
        ->where('brand_category',$record->product_category)
        ->pluck('brands.brand_name','brands.id'); 

        
$warranty = [];
for ($warranty_exp=1; $warranty_exp <= 12; $warranty_exp++) $warranty[$warranty_exp] = $warranty_exp;


         return view('admin.products.edit',compact('record','categories','warranty','brands','subcategories','product_categories'));

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

        $products = product_master::find($id); 

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
    'store_category'=>$request->input('store_category'),
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

return Redirect::to('admin/products')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
         $products = product_master::find($request->id);
          $products->delete();

          return $products;
    }

     public function status_update(Request $request){
 
         $record=product_master::find($request->user_id);
      
          if($record['product_status']=='Active'){
               $updatevender=\DB::table('product_masters')->where('id',$request->user_id)
                              ->update([
                                'product_status' => 'Deactive',
                                 ]);
            return json_encode('Deactive');
           } else {
              $updateuser=\DB::table('product_masters')->where('id',$request->user_id)
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

        $record = product_master::where('product_name', $request->check_unique_name)->first();

         if(!empty($record)){
            return "exist";
         }else{
            return "notexist";
         }
      }
      if(!empty($request->check_unique_name_edit)){

        $record = product_master::where('product_name', $request->check_unique_name_edit)->get();

         if(count($record) <=1){
            return "notexist";
         }else{
            return "exist";
         }
      }
  }


  public function append_product_subcategory(Request $request)
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

      public function append_product_category(Request $request)
    {  

 $product_categoryId= $request->id;

$subcategories =\DB::table('product_categories')                    
           ->where("product_categories.store_category",$product_categoryId)
           ->where("product_categories.status",'Active')
          ->pluck('product_categories.product_category','product_categories.id');

        

return json_encode($subcategories);
    }


}
