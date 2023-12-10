<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\brand;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;
use Image;
use File;


class brandsController extends Controller
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
       
        $records=DB::table('brands')->orderBy('brands.id','desc');

         if (!empty($request->search)) {
         $term=$request->search;
$records=$records
->where(function($q) use ($term) {
$q
        ->orWhere('brands.brand_name','like','%' . $term . '%')
        ->orWhere('brands.brand_type','like','%' . $term . '%');
    });

}

         $records= $records
         ->select('brands.brand_type','brands.*')
        ->paginate(25);



         $use = DB::table('brands')  
                    ->select('brand_name','id')        
   
            ->orderBy('brand_name', 'asc')->get(); 

 $brands = array();
foreach($use as $user) {
$brands[$user->brand_name] = $user->brand_name;
}

//  DB::table('count_masters')
// ->where('id','1')
// ->update([
// 'state_count'=>$count,
// ]);

return view('admin.brands.index',compact('records','brands'));
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


// $store_categories = DB::table('product_categories')  
//     ->select('product_category','id')
//      ->where('status','Active')
// ->orderBy('product_category', 'asc')->pluck('product_category','id'); 


// $service_categories = DB::table('service_subcategories')  
//     ->select('service_subcategory','id')
//      ->where('status','Active')
// ->orderBy('service_subcategory', 'asc')->pluck('service_subcategory','id'); 


// $categories=array_merge((array) $categories1, (array) $categories2);compact('store_categories','service_categories')

         return view('admin.brands.create');
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

            if($request->hasFile('brand_logo'))
  
        {       
     $file = $request->file('brand_logo');
     $extension = $request->file('brand_logo')->getClientOriginalExtension();
     $brand_logo = date('d_m_Y_h_i_s',time()) . '1.' . $extension;

         $destinationPaths = base_path().'/public/images/brands';

  $thumb_img =Image::make($file->getRealPath())->orientate()->resize(100, 100);
  
     $thumb_img->save($destinationPaths.'/'.$brand_logo,80);

      }       
        else{
            $brand_logo = "";
        }

$data = array(
// 'brand_category'=>$request->input('brand_category'),
'brand_name'=>$request->input('brand_name'),
'brand_logo'=>$brand_logo,
'brand_type'=>$request->input('brand_type'),

);
         $brand = new brand($data);
         $brand->save();
                 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/brands')->with($notification);

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

        return view('admin.brands.show',compact('view'));
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
        $record = brand::find($id);         
        
         $categories1 = DB::table('product_categories')  
                    ->select('product_category','id')
                     ->where('status','Active')
            ->orderBy('product_category', 'asc')->pluck('product_category','id'); 


$categories2 = DB::table('service_subcategories')  
                    ->select('service_subcategory','id')
                     ->where('status','Active')
            ->orderBy('service_subcategory', 'asc')->pluck('service_subcategory','id'); 


$categories=array_merge((array) $categories1, (array) $categories2);


         return view('admin.brands.edit',compact('record','categories'));

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
        
        $brands = brand::find($id); 

   if($request->hasFile('brand_logo'))
  
        {       
     $file = $request->file('brand_logo');
     $extension = $request->file('brand_logo')->getClientOriginalExtension();
     $brand_logo = date('d_m_Y_h_i_s',time()) . '1.' . $extension;

         $destinationPaths = base_path().'/public/images/brands';

  $thumb_img =Image::make($file->getRealPath())->orientate()->resize(100, 100);
  
     $thumb_img->save($destinationPaths.'/'.$brand_logo,80);

      }       
        else{
            $brand_logo = $brands->brand_logo;
        }

$data = array(
// 'brand_category'=>$request->input('brand_category'),
'brand_name'=>$request->input('brand_name'),
'brand_logo'=>$brand_logo,
'brand_type'=>$request->input('brand_type'),

);
         $brands->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/brands')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
         $brands = brand::find($request->id);
          $brands->delete();

          return $brands;
    }

     public function status_update(Request $request){
 
         $record=brand::find($request->user_id);
      
          if($record['status']=='Active'){
               $updatevender=\DB::table('brands')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);
            return json_encode('Deactive');
           } else {
              $updateuser=\DB::table('brands')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Active',
                                // 'updated_at' => date('Y-m-d H:i:s') 
                                 ]);
              return json_encode("Active");

        }
           }

    public function check_unique_name(Request $request)
    {

        // return $request->checkunique_name;
        
      if(!empty($request->check_unique_name)){

        $record = brand::where('brand_name', $request->check_unique_name)->first();

         if(!empty($record)){
            return "exist";
         }else{
            return "notexist";
         }
      }
      if(!empty($request->check_unique_name_edit)){

        $record = brand::where('brand_name', $request->check_unique_name_edit)->get();

         if(count($record) <=1){
            return "notexist";
         }else{
            return "exist";
         }
      }
  }
}
