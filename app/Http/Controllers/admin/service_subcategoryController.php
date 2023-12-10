<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\service_subcategory;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;

class service_subcategoryController extends Controller
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
       
        $records=DB::table('service_subcategories')
        ->orderBy('service_subcategories.id','desc')
        ->join('service_categories','service_categories.id','service_subcategories.service_category');
        
         if (!empty($request->search)) {
        $term=$request->search;
$records=$records
->where(function($q) use ($term) {
$q
       ->orWhere('service_subcategories.service_subcategory','like','%' . $term . '%')
        ->orWhere('service_categories.category_name','like','%' . $term . '%');
    });
}

         $records= $records
         ->select('service_subcategories.*','service_categories.category_name')
        ->paginate(25);



         $use = DB::table('service_categories')  
                    ->select('category_name','id')        
   
            ->orderBy('category_name', 'asc')->get(); 

 $service_subcategorys = array();
foreach($use as $user) {
$service_subcategorys[$user->category_name] = $user->category_name;
}

//  DB::table('count_masters')
// ->where('id','1')
// ->update([
// 'state_count'=>$count,
// ]);

return view('admin.service_subcategory.index',compact('records','service_subcategorys'));
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $record='';
     $service_categories = DB::table('service_categories')  
                    ->select('category_name','id')
                     ->where('status','Active')
            ->orderBy('category_name', 'asc')->pluck('category_name','id'); 


         return view('admin.service_subcategory.create',compact('record','service_categories'));
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
    'service_category'=>$request->input('service_category'),
    'service_subcategory'=>$request->input('service_subcategory'),

);
         $service_subcategory = new service_subcategory($data);
         $service_subcategory->save();
                 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/service-subcategory')->with($notification);

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

        return view('admin.service_subcategory.show',compact('view'));
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
        $record = service_subcategory::find($id);         
        
             $service_categories = DB::table('service_categories')  
                    ->select('category_name','id')
                     ->where('status','Active')
            ->orderBy('category_name', 'asc')->pluck('category_name','id'); 



  
// dd($service_categories);
         return view('admin.service_subcategory.edit',compact('record','service_categories'));

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
        
        $service_subcategory = service_subcategory::find($id); 

   $data = array(
     'service_category'=>$request->input('service_category'),
    'service_category'=>$request->input('service_category'),
    'service_subcategory'=>$request->input('service_subcategory'),    
);
         $service_subcategory->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/service-subcategory')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
         $service_subcategory = service_subcategory::find($request->id);
          $service_subcategory->delete();

          return $service_subcategory;
    }

     public function status_update(Request $request){
 
         $record=service_subcategory::find($request->user_id);
      
          if($record['status']=='Active'){
               $updatevender=\DB::table('service_subcategories')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);
            return json_encode('Deactive');
           } else {
              $updateuser=\DB::table('service_subcategories')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Active',
                                // 'updated_at' => date('Y-m-d H:i:s') 
                                 ]);
              return json_encode("Active");

        }
           }

    public function check_service_subcategory(Request $request)
    {

        // return $request->checkservice_subcategory;
        
      if(!empty($request->check_service_subcategory)){

        $record = service_subcategory::where('service_category', $request->check_service_subcategory)->first();

         if(!empty($record)){
            return "exist";
         }else{
            return "notexist";
         }
      }
      if(!empty($request->check_category_edit)){

        $record = service_subcategory::where('service_category', $request->check_category_edit)->get();

         if(count($record) <=1){
            return "notexist";
         }else{
            return "exist";
         }
      }
  }


   public function append_service_category(Request $request)
    {   
             $service_categoryId= $request->id;
         $disticts =\DB::table('service_categories')
                       ->where("service_categories.category_name",$service_categoryId)
                       ->where("service_categories.status",'Active')
                      ->pluck('service_categories.category_name','service_categories.id');

        

        return json_encode($disticts);
    }


     public function append_service_subcategory(Request $request)
    {   
             $service_categoryId= $request->id;
         $disticts =\DB::table('service_subcategories')
                       ->where("service_subcategories.service_category",$service_categoryId)
                       ->where("service_subcategories.status",'Active')
                      ->pluck('service_subcategories.service_subcategory','service_subcategories.id');

        

        return json_encode($disticts);
    }
}
