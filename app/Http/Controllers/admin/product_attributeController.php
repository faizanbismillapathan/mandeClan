<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\product_attribute;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;
use App\unit;
use App\product_category;
use App\unit_value;

class product_attributeController extends Controller
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
       
//        $datas=product_attribute::find(1);

// // dd($datas->product_category);

        $reco=product_attribute::orderBy('id','desc');

         if (!empty($request->search)) {
         $term=$request->search;
$reco=$reco
->where(function($q) use ($term) {
$q
        ->orWhere('attr_name','like','%' . $term . '%');
    });
}

         $reco= $reco
        ->paginate(25);

// dd($reco);
    $records=[];

foreach($reco as $index=>$data){

$records[]=[

'id'=>$data->id,
'attr_name'=>$data->attr_name,
'unit_value'=>$this->unit_values_funct($data->unit_id),
'product_category'=>$this->product_categorys_funct($data->unit_id,$data->category_id),
'status'=>$data->status ,
];

}

// dd($records);

$use = DB::table('product_attributes')  

                    ->select('attr_name','id')       
   
            ->orderBy('attr_name', 'asc')->get(); 

 $product_attributes = array();
foreach($use as $user) {
$product_attributes[$user->attr_name] = $user->attr_name;
}

//  DB::table('count_masters')
// ->where('id','1')
// ->update([
// 'state_count'=>$count,
// ]);

return view('admin.attributes.index',compact('records','product_attributes','reco'));
   
    }


   public function unit_values_funct($unit_id)
    {

return  DB::table('unit_values')->where('unit_id',$unit_id)->select('id','unit_value','unit_short_code')->get();

    }



 public function product_categorys_funct($unit_id,$category_id)
    {
// dd();
return DB::table('product_categories')
->whereIn('product_categories.id',explode(',',$category_id))
->select('product_categories.product_category')
->get();

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

         $unit_arr = DB::table('product_attributes')
         ->pluck('unit_id','unit_id');

// dd($unit_arr);

           $units = DB::table('units')  
                    ->select('unit_title','id') 
                    ->WhereNotIn('id',$unit_arr)    
            ->orderBy('unit_title', 'asc')->pluck('unit_title','id'); 

// dd($units);

  $categories = DB::table('product_categories')  
                    ->select('product_category','id')     
            ->orderBy('product_category', 'asc')->select('product_category','id')->get(); 



         return view('admin.attributes.create',compact('units','categories'));
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
        $category_id='';

        if (!empty($request->category_id)) {            
            $category_id=implode(',', $request->category_id);
        }
$att_names=unit::find($request->unit_id);


         $data = array(
'attr_name'=>$att_names->unit_title,
    // 'category_id'=>$request->input('category_id'),
    'unit_id'=>$request->input('unit_id'),
    'category_id'=>$category_id,
);


         // dd($data);
         $product_attribute = new product_attribute($data);
         $product_attribute->save();
                 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/product-attribute')->with($notification);

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

        return view('admin.attributes.show',compact('view'));
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
        $record = product_attribute::find($id);

         $units = DB::table('units')  
                    ->select('unit_title','id')  
   
            ->orderBy('unit_title', 'asc')->pluck('unit_title','id'); 

  $categories = DB::table('product_categories')  
                    ->select('product_category','id')     
            ->orderBy('product_category', 'asc')->select('product_category','id')->get(); 



         return view('admin.attributes.edit',compact('units','categories','record'));         
        

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
        
        $product_attribut = product_attribute::find($id); 

$category_id=$product_attribut->category_id;

        if (!empty($request->category_id)) {            
            $category_id=implode(',', $request->category_id);
        }
        

$att_names=unit::find($request->unit_id);

   $data = array(
// 'attr_name'=>$att_names->unit_title,
'category_id'=>$category_id,
// 'category_id'=>$request->input('category_id'),
// 'unit_id'=>$request->input('unit_id'),    
);
         $product_attribut->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/product-attribute')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
         $product_attribut = product_attribute::find($request->id);
          $product_attribut->delete();

          return $product_attribut;
    }

     public function status_update(Request $request){
 
         $record=product_attribute::find($request->user_id);
      
          if($record['status']=='Active'){
               $updatevender=\DB::table('product_attributes')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);
            return json_encode('Deactive');
           } else {
              $updateuser=\DB::table('product_attributes')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Active',
                                // 'updated_at' => date('Y-m-d H:i:s') 
                                 ]);
              return json_encode("Active");

        }
           }

    public function check_product_attribut(Request $request)
    {

        // return $request->checkproduct_attribut;
        
      if(!empty($request->check_name)){

        $record = product_attribute::where('attr_name', $request->check_name)->first();

         if(!empty($record)){
            return "exist";
         }else{
            return "notexist";
         }
      }
      if(!empty($request->check_name_edit)){

        $record = product_attribute::where('attr_name', $request->check_name_edit)->get();

         if(count($record) <=1){
            return "notexist";
         }else{
            return "exist";
         }
      }
  }
}
