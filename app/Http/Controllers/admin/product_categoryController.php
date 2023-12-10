<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\product_category;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;

class product_categoryController extends Controller
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
       
        $records=DB::table('product_categories')->orderBy('product_categories.id','desc')
        ->leftjoin('store_categories','store_categories.id','product_categories.store_category')
        ->leftjoin('products','products.product_category','product_categories.id');

         if (!empty($request->search)) {
         $term=$request->search;
$records=$records
->where(function($q) use ($term) {
$q
       ->orWhere('product_categories.product_category','like','%' . $term . '%')
        ->orWhere('store_categories.category_name','like','%' . $term . '%');
    });
}

         $records= $records
         ->select('store_categories.category_name','product_categories.*','products.id as not_prmit')
         ->groupby('product_categories.id')
        ->paginate(25);



         $use = DB::table('product_categories')  
                    ->select('product_category','id')        
   
            ->orderBy('product_category', 'asc')->get(); 

 $product_categorys = array();
foreach($use as $user) {
$product_categorys[$user->product_category] = $user->product_category;
}

//  DB::table('count_masters')
// ->where('id','1')
// ->update([
// 'state_count'=>$count,
// ]);

return view('admin.subcategory.index',compact('records','product_categorys'));
   
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


         return view('admin.subcategory.create',compact('record','store_categories'));
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
'product_category_url'=>str_replace(' ','-',strtolower($request->product_category)),

);
         $product_category = new product_category($data);
         $product_category->save();
                 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/product-category')->with($notification);

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

        return view('admin.subcategory.show',compact('view'));
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
        $record = product_category::find($id);         
        
             $store_categories = DB::table('store_categories')  
                    ->select('category_name','id')
                     ->where('status','Active')
            ->orderBy('category_name', 'asc')->pluck('category_name','id'); 


         return view('admin.subcategory.edit',compact('record','store_categories'));

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
        
        $product_category = product_category::find($id); 

   $data = array(

    'store_category'=>$request->input('store_category'),
    'product_category'=>$request->input('product_category'),  
    'product_category_url'=>str_replace(' ','-',strtolower($request->product_category)),
  
);
         $product_category->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/product-category')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
         $product_category = product_category::find($request->id);
          $product_category->delete();

          return $product_category;
    }

     public function status_update(Request $request){
 
         $record=product_category::find($request->user_id);
      
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

    public function check_product_category(Request $request)
    {

        // return $request->checkproduct_category;
        
      if(!empty($request->check_product_category)){

        $record = product_category::where('store_category', $request->check_product_category)->first();

         if(!empty($record)){
            return "exist";
         }else{
            return "notexist";
         }
      }
      if(!empty($request->check_category_edit)){

        $record = product_category::where('store_category', $request->check_category_edit)->get();

         if(count($record) <=1){
            return "notexist";
         }else{
            return "exist";
         }
      }
  }
}
