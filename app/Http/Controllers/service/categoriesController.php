<?php

namespace App\Http\Controllers\service;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\service_vendor_category;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;
use App\service_subcategory;

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



          if ( !in_array($uspermit->role, array('1','5'), false ) ) {

// dd('1');
              return redirect()->action('frontend\frontendController@index'); 

          }else{

            if($uspermit->role == '1'  && empty(session::get('service_id'))){

// dd('2');
              return redirect()->action('frontend\frontendController@index'); 

          }

      }if (\Auth::user()->role == "5") {
      $service_id=DB::table('services')
             ->where('user_id',\Auth::user()->id)
             ->select('id','user_id','status','kyc_status')
             ->first();

              if ($service_id->kyc_status=='deactive') {
                 
              return redirect()->action('frontend\frontendcontroller@index'); 

             }
             $this->id=$service_id->id; 
$this->user_id=$service_id->user_id;  

   }elseif (\Auth::user()->role == "1") {

$this->id=session::get('service_id');
$this->user_id=session::get('service_user_id');


}


return $next($request);
  });


    }
    
        public function index(Request $request)
    {
       

$services=DB::table('services')
->select('service_category','id','service_name','service_subcategory')
->where('id',$this->id)
->first();


// dd($services->service_subcategory);

    
  $use = DB::table('service_categories')  
                    ->select('category_name','id')        
   ->whereNotIn('id',[$services->service_category])
            ->orderBy('category_name', 'asc')->get(); 

 $service_categorys = array();
foreach($use as $user) {
$service_categorys[$user->id] = $user->category_name;
}




$shop_categories=DB::table('services')
->select(\DB::raw("GROUP_CONCAT(service_subcategories.service_subcategory) as service_subcategory"),\DB::raw("GROUP_CONCAT(service_subcategories.id) as id"))
->leftjoin("service_subcategories",\DB::raw("FIND_IN_SET(service_subcategories.id,services.service_subcategory)"),">",\DB::raw("'0'"))
->where('services.id',$this->id)
->groupby('service_subcategories.id')
->whereNotNull('service_subcategories.id')
->get();



$newarr=[];

foreach($shop_categories as $index=>$data){

$newarr[]=$data->id;
}

// dd($newarr);

   $categories= DB::table('service_subcategories')
->where('service_subcategories.service_category',$services->service_category)
->select('service_subcategories.service_subcategory','service_subcategories.id');

if (count($newarr)>0) {
   $categories= $categories
   ->whereNotIn('service_subcategories.id',$newarr);
}

 $categories= $categories
->get();



// dd($categories);

return view('service.categories.index',compact('categories','service_categorys','shop_categories','services'));
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $record='';

         return view('service.categories.create',compact('record'));
    }


  public function store_custom_category(Request $request)
    {


          $data = array(
    'service_category'=>$request->input('service_category'),
    'service_subcategory'=>$request->input('service_subcategory'),

);

          $service_subcategory = service_subcategory::updateOrCreate($data);


// dd($service_subcategory->id);
         // $service_subcategory = new service_subcategory($data);
         // $service_subcategory->save();

            

    $data = array(
    'service_id'=>$this->id,
    'user_id'=>$this->user_id,
    'service_category_id'=>$request->service_category,
    'status'=>'Active',
    'service_subcategory'=>$request->service_subcategory,
    'service_subcategory_id'=>$service_subcategory->id

    );


$service_vendor_category = service_vendor_category::updateOrCreate($data);


  $category_id=DB::table('services')
        ->select('service_subcategory','id')
        ->where('id',$this->id)
        ->first();

DB::table('services')
->where('id',$this->id)
->update([
'service_subcategory'=>$category_id->service_subcategory.','.$service_subcategory->id,
]);



        
         
                 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('service/categories')->with($notification);

    }


    /**
     * Service a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $category_id=DB::table('service_subcategories')
        ->select('service_category','id','service_subcategory')
        ->whereIn('id',$request->category_id)
        ->get();

                
foreach($category_id as $index=>$data){

    $data = array(
    'service_id'=>$this->id,
    'user_id'=>$this->user_id,
    'service_category_id'=>$data->service_category,
    'status'=>'Active',
    'service_subcategory'=>$data->service_subcategory,
    'service_subcategory_id'=>$data->id


    );


$service_vendor_category = service_vendor_category::updateOrCreate($data);


DB::table('services')
->where('id',$this->id)
->update([
'service_subcategory'=>implode(',',$request->category_id),
]);
}
        
         
                 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('service/categories')->with($notification);

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

        return view('service.categories.show',compact('view'));
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
        $record = service_vendor_category::find($id);         
        
         return view('service.categories.edit',compact('record'));

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
        
        $service_vendor_category = service_vendor_category::find($id); 

   $data = array(
    'service_id'=>$request->input('service_id'),
    'service_category_id'=>$request->input('service_category_id'),
    'service_subcategory'=>$request->input('service_subcategory'),    
);
         $service_vendor_category->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('service/categories')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
         $service_vendor_category = service_vendor_category::find($request->id);
          $service_vendor_category->delete();

          return $service_vendor_category;
    }

     public function status_update(Request $request){
 
         $record=service_vendor_category::find($request->user_id);
      
          if($record['status']=='Active'){
               $updatevender=\DB::table('service_categories')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);
            return json_encode('Deactive');
           } else {
              $updateuser=\DB::table('service_categories')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Active',
                                // 'updated_at' => date('Y-m-d H:i:s') 
                                 ]);
              return json_encode("Active");

        }
           }

 

   public function append_category_checkbox(Request $request)
    {
      
$services=DB::table('services')
->select('service_subcategory','id')
->where('id',$this->id)
->first();

$arr=explode(',', $services->service_subcategory);

 $categories= DB::table('service_subcategories')
->where('service_subcategories.service_category',$request->id)
->select('service_subcategories.service_subcategory','service_subcategories.id')
->whereNotIn('id',$arr)
->get();

return json_encode($categories);

      }

}
