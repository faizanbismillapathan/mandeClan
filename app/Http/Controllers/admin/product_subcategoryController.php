<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\product_subcategory;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;

class product_subcategoryController extends Controller
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
       
        $records=DB::table('product_subcategories')
        ->orderBy('product_subcategories.id','desc')
        ->join('product_categories','product_categories.id','product_subcategories.product_category')
  ->join('store_categories','store_categories.id','product_categories.store_category');
         if (!empty($request->search)) {
         $term=$request->search;
$records=$records
->where(function($q) use ($term) {
$q
       ->orWhere('product_subcategories.product_subcategory','like','%' . $term . '%')
        ->orWhere('product_categories.product_category','like','%' . $term . '%');
    });
}

         $records= $records
         ->select('store_categories.category_name','product_subcategories.*','product_categories.product_category')
        ->paginate(25);



         $use = DB::table('product_categories')  
                    ->select('product_category','id')        
   
            ->orderBy('product_category', 'asc')->get(); 

 $product_subcategorys = array();
foreach($use as $user) {
$product_subcategorys[$user->product_category] = $user->product_category;
}

//  DB::table('count_masters')
// ->where('id','1')
// ->update([
// 'state_count'=>$count,
// ]);

return view('admin.product_subcategory.index',compact('records','product_subcategorys'));
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $record='';
     $store_categories = DB::table('store_categories')  
                    ->select('category_name','id')
                     ->where('status','Active')
            ->orderBy('category_name', 'asc')->pluck('category_name','id'); 


         return view('admin.product_subcategory.create',compact('record','store_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
         $data = array(
     'store_category'=>$request->input('store_category'),
    'product_category'=>$request->input('product_category'),
    'product_subcategory'=>$request->input('product_subcategory'),

);
         $product_subcategory = new product_subcategory($data);
         $product_subcategory->save();
                 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/product-subcategory')->with($notification);

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

        return view('admin.product_subcategory.show',compact('view'));
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
        $record = product_subcategory::find($id);         
        
             $store_categories = DB::table('store_categories')  
                    ->select('category_name','id')
                     ->where('status','Active')
            ->orderBy('category_name', 'asc')->pluck('category_name','id'); 



  $product_categories = DB::table('product_categories')
             ->where('product_categories.store_category','=', $record['store_category'])
              ->where("product_categories.status",'Active')
            ->pluck('product_categories.product_category','product_categories.id');

// dd($product_categories);
         return view('admin.product_subcategory.edit',compact('record','store_categories','product_categories'));

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
        
        $product_subcategory = product_subcategory::find($id); 

   $data = array(
     'store_category'=>$request->input('store_category'),
    'product_category'=>$request->input('product_category'),
    'product_subcategory'=>$request->input('product_subcategory'),    
);
         $product_subcategory->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/product-subcategory')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
         $product_subcategory = product_subcategory::find($request->id);
          $product_subcategory->delete();

          return $product_subcategory;
    }

     public function status_update(Request $request){
 
         $record=product_subcategory::find($request->user_id);
      
          if($record['status']=='Active'){
               $updatevender=\DB::table('product_categories')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);
            return json_encode('Deactive');
           } else {
              $updateuser=\DB::table('product_categories')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Active',
                                // 'updated_at' => date('Y-m-d H:i:s') 
                                 ]);
              return json_encode("Active");

        }
           }

    public function check_product_subcategory(Request $request)
    {

        // return $request->checkproduct_subcategory;
        
      if(!empty($request->check_product_subcategory)){

        $record = product_subcategory::where('product_category', $request->check_product_subcategory)->first();

         if(!empty($record)){
            return "exist";
         }else{
            return "notexist";
         }
      }
      if(!empty($request->check_category_edit)){

        $record = product_subcategory::where('product_category', $request->check_category_edit)->get();

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
         $disticts =\DB::table('product_categories')
                      ->join('store_categories', 'product_categories.store_category', '=', 'store_categories.id')
                       ->where("product_categories.store_category",$product_categoryId)
                       ->where("product_categories.status",'Active')
                      ->pluck('product_categories.product_category','product_categories.id');

        

        return json_encode($disticts);
    }


     public function append_product_subcategory(Request $request)
    {   
             $product_categoryId= $request->id;
         $disticts =\DB::table('product_subcategories')
                      ->join('product_categories', 'product_subcategories.product_category', '=', 'product_categories.id')
                       ->where("product_subcategories.product_category",$product_categoryId)
                       ->where("product_subcategories.status",'Active')
                      ->pluck('product_subcategories.product_subcategory','product_subcategories.id');

        

        return json_encode($disticts);
    }
}
