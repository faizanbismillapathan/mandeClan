<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\return_policy;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;

class return_policyController extends Controller
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
       
        $records=DB::table('return_policies')->orderBy('id','desc');

         if (!empty($request->search)) {
        $term=$request->search;
$records=$records
->where(function($q) use ($term) {
$q
        ->orWhere('policy_name','like','%' . $term . '%');
    });
}

         $records= $records
        ->paginate(25);



         $use = DB::table('return_policies')  
                    ->select('policy_name','id')        
   
            ->orderBy('policy_name', 'asc')->get(); 

 $return_policys = array();
foreach($use as $user) {
$return_policys[$user->policy_name] = $user->policy_name;
}

//  DB::table('count_masters')
// ->where('id','1')
// ->update([
// 'state_count'=>$count,
// ]);

return view('admin.return_policy.index',compact('records','return_policys'));
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          $categories = DB::table('store_categories')  
                    ->select('category_name','id')
                     ->where('status','Active')
            ->orderBy('category_name', 'asc')->pluck('category_name','id'); 


         return view('admin.return_policy.create',compact('categories'));
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
'policy_name'=>implode(',', $request->policy_name),
'policy_category'=>$request->input('policy_category'),
'deduction_percent'=>$request->input('deduction_percent'),
'return_days'=>$request->input('return_days'),
'policy_description'=>$request->input('policy_description'),
'return_accepted_by'=>$request->input('return_accepted_by'),
    
);
         $return_policy = new return_policy($data);
         $return_policy->save();
                 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/return-policy')->with($notification);

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

        return view('admin.return_policy.show',compact('view'));
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
        $record = return_policy::find($id);         
        
            $categories = DB::table('store_categories')  
                    ->select('category_name','id')
                     ->where('status','Active')
            ->orderBy('category_name', 'asc')->pluck('category_name','id'); 

         return view('admin.return_policy.edit',compact('record','categories'));

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
        
        $return_policy = return_policy::find($id); 

   $data = array(
'policy_name'=>implode(',', $request->input('policy_name')),
'policy_category'=>$request->input('policy_category'),
'deduction_percent'=>$request->input('deduction_percent'),
'return_days'=>$request->input('return_days'),
'policy_description'=>$request->input('policy_description'),
'return_accepted_by'=>$request->input('return_accepted_by'),

);
         $return_policy->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/return-policy')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
         $return_policy = return_policy::find($request->id);
          $return_policy->delete();

          return $return_policy;
    }

     public function status_update(Request $request){
 
         $record=return_policy::find($request->user_id);
      
          if($record['status']=='Active'){
               $updatevender=\DB::table('return_policies')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);
            return json_encode('Deactive');
           } else {
              $updateuser=\DB::table('return_policies')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Active',
                                 ]);
              return json_encode("Active");

        }
           }

    public function check_unique_name(Request $request)
    {

        // return $request->checkunique_name;
        
      if(!empty($request->check_unique_name)){

        $record = return_policy::where('policy_name', $request->check_unique_name)->first();

         if(!empty($record)){
            return "exist";
         }else{
            return "notexist";
         }
      }
      if(!empty($request->check_unique_name_edit)){

        $record = return_policy::where('policy_name', $request->check_unique_name_edit)->get();

         if(count($record) <=1){
            return "notexist";
         }else{
            return "exist";
         }
      }
  }
}
