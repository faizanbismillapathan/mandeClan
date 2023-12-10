<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\currency_setting;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;

class currency_settingController extends Controller
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
       
        $records=DB::table('currency_settings')->orderBy('id','desc');

         if (!empty($request->search)) {
        $term=$request->search;
$records=$records
->where(function($q) use ($term) {
$q
        ->orWhere('currency_code','like','%' . $term . '%');
    });
}

         $records= $records
        ->paginate(25);



         $use = DB::table('currency_settings')  
                    ->select('currency_code','id')        
   
            ->orderBy('currency_code', 'asc')->get(); 

 $currency_settings = array();
foreach($use as $user) {
$currency_settings[$user->currency_code] = $user->currency_code;
}

//  DB::table('count_masters')
// ->where('id','1')
// ->update([
// 'state_count'=>$count,
// ]);

return view('admin.currency_setting.index',compact('records','currency_settings'));
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $record='';

         return view('admin.currency_setting.create',compact('record'));
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
'currency_code'=>$request->input('currency_code'),
'currency_exchange_rate'=>$request->input('currency_exchange_rate'),
'currency_position'=>$request->input('currency_position'),
'currency_symbol'=>$request->input('currency_symbol'),

);
         $currency_setting = new currency_setting($data);
         $currency_setting->save();
                 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/currency-setting')->with($notification);

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

        return view('admin.currency_setting.show',compact('view'));
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
        $record = currency_setting::find($id);         
        
         return view('admin.currency_setting.edit',compact('record'));

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
        
        $currency_setting = currency_setting::find($id); 

   $data = array(
'currency_code'=>$request->input('currency_code'),
'currency_exchange_rate'=>$request->input('currency_exchange_rate'),
'currency_position'=>$request->input('currency_position'),
'currency_symbol'=>$request->input('currency_symbol'),    
);
         $currency_setting->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/currency-setting')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
         $currency_setting = currency_setting::find($request->id);
          $currency_setting->delete();

          return $currency_setting;
    }

     public function status_update(Request $request){
 
         $record=currency_setting::find($request->user_id);
      
          if($record['status']=='Active'){
               $updatevender=\DB::table('currency_settings')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);
            return json_encode('Deactive');
           } else {
              $updateuser=\DB::table('currency_settings')->where('id',$request->user_id)
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

        $record = currency_setting::where('currency_code', $request->check_unique_name)->first();

         if(!empty($record)){
            return "exist";
         }else{
            return "notexist";
         }
      }
      if(!empty($request->check_unique_name_edit)){

        $record = currency_setting::where('currency_code', $request->check_unique_name_edit)->get();

         if(count($record) <=1){
            return "notexist";
         }else{
            return "exist";
         }
      }
  }
}
