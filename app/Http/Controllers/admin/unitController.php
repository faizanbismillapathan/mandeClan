<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\unit;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;
use App\unit_value;
class unitController extends Controller
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
       
        $records=unit::orderBy('id','desc');

         if (!empty($request->search)) {
         $term=$request->search;
$records=$records
->where(function($q) use ($term) {
$q
        ->orWhere('unit_title','like','%' . $term . '%');
    });

}

         $records= $records
        ->paginate(25);


// dd($records);
         $use = DB::table('units')  
                    ->select('unit_title','id')    
            ->orderBy('unit_title', 'asc')->get(); 


 $units = array();
foreach($use as $user) {
$units[$user->unit_title] = $user->unit_title;
}



return view('admin.unit.index',compact('records','units'));
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $record='';

         return view('admin.unit.create',compact('record'));
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
    'unit_title'=>$request->input('unit_title'),
    
);
         $unit = new unit($data);
         $unit->save();
                 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/unit')->with($notification);

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

        return view('admin.unit.show',compact('view'));
    }


  public function unit_values($id)
    {

    $record=unit::find($id);

    // dd($id);
$product_categories = DB::table('product_categories')  
                    ->select('product_category','id')
                     ->where('status','Active')
            ->orderBy('product_category', 'asc')
            ->pluck('product_category','id'); 

$records=Db::table('unit_values')
// ->join('product_categories','product_categories.id','unit_values.unit_category')
->where('unit_values.unit_id',$id)
->select('unit_values.*')
->get();

// dd($records);
        return view('admin.unit.values',compact('record','product_categories','records'));
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
        $record = unit::find($id);         
        
         return view('admin.unit.edit',compact('record'));

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
        
        $unit = unit::find($id); 

   $data = array(
    'unit_title'=>$request->input('unit_title'),
    
);
         $unit->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/unit')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
         $unit = unit::find($request->id);
          $unit->delete();

          return $unit;
    }


    public function value_destroy(Request $request)
    {
      
         $unit = unit_value::find($request->id);
          $unit->delete();

          return $unit;
    }


     public function status_update(Request $request){
 
         $record=unit::find($request->user_id);
      
          if($record['status']=='Active'){
               $updatevender=\DB::table('units')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);
            return json_encode('Deactive');
           } else {
              $updateuser=\DB::table('units')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Active',
                                // 'updated_at' => date('Y-m-d H:i:s') 
                                 ]);
              return json_encode("Active");

        }
           }

             public function value_status_update(Request $request){
 
         $record=unit_value::find($request->user_id);
      
          if($record['status']=='Active'){
               $updatevender=\DB::table('unit_values')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);
            return json_encode('Deactive');
           } else {
              $updateuser=\DB::table('unit_values')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Active',
                                // 'updated_at' => date('Y-m-d H:i:s') 
                                 ]);
              return json_encode("Active");

        }
           }


    public function check_unit(Request $request)
    {

        // return $request->checkunit;
        
      if(!empty($request->check_unit)){

        $record = unit::where('unit_title', $request->check_unit)->first();

         if(!empty($record)){
            return "exist";
         }else{
            return "notexist";
         }
      }
      if(!empty($request->check_unit_edit)){

        $record = unit::where('unit_title', $request->check_unit_edit)->get();

         if(count($record) <=1){
            return "notexist";
         }else{
            return "exist";
         }
      }
  }


  public function unit_value_store(Request $request)
    {
        // dd($request);
         $data = array(
            'unit_value'=>$request->input('unit_value'),
            'unit_short_code'=>$request->input('unit_short_code'),
            'unit_id'=>$request->input('unit_id'),
            // 'unit_category'=>$request->input('unit_category'),

);
         $unit_value = new unit_value($data);
         $unit_value->save();
                 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::back()->with($notification);

    }



   public function unit_value_update(Request $request, $id)
    {

        // dd($id);
        
$unit_value = unit_value::find($id); 

$data = array(
'unit_value'=>$request->input('unit_value'),
'unit_short_code'=>$request->input('unit_short_code'),
            // 'unit_category'=>$request->input('unit_category'),

);

$unit_value->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::back()->with($notification);
    }


}
