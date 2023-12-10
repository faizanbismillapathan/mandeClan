<?php
namespace App\Http\Controllers\service;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\user;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;

class invoice_settingController extends Controller
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

      }

return $next($request);
  });


    }
    
        public function index(Request $request)
    {
       
//         $records=DB::table('invoice_setting')->orderBy('id','desc');

//          if (!empty($request->search)) {
//          $records= $records
//         ->orWhere('order_name','like','%' . $request->search . '%');
// }

//          $records= $records
//         ->paginate(25);



//          $use = DB::table('invoice_setting')  
//                     ->select('order_name','id')        
   
//             ->orderBy('order_name', 'asc')->get(); 

//  $invoice_setting = array();
// foreach($use as $user) {
// $invoice_setting[$user->order_name] = $user->order_name;
// }

//  DB::table('count_masters')
// ->where('id','1')
// ->update([
// 'state_count'=>$count,
// ]);

return view('service.invoice_setting.index');
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $record='';

         return view('service.invoice_setting.create',compact('record'));
    }

    /**
     * Service a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
         $data = array(
    'order_name'=>$request->input('order_name'),
    
);
         $invoice_setting = new invoice_setting($data);
         $invoice_setting->save();
                 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('service/invoice-setting')->with($notification);

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

        return view('service.invoice_setting.show',compact('view'));
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
        $record = user::find($id);         
        
         return view('service.invoice_setting.edit',compact('record'));

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
        
        $invoice_setting = order::find($id); 

   $data = array(
    'order_name'=>$request->input('order_name'),
    
);
         $invoice_setting->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('service/invoice-setting')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
         $invoice_setting = order::find($request->id);
          $invoice_setting->delete();

          return $invoice_setting;
    }

     public function status_update(Request $request){
 
         $record=order::find($request->user_id);
      
          if($record['status']=='Active'){
               $updatevender=\DB::table('invoice_setting')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);
            return json_encode('Deactive');
           } else {
              $updateuser=\DB::table('invoice_setting')->where('id',$request->user_id)
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

        $record = order::where('order_name', $request->check_unique_name)->first();

         if(!empty($record)){
            return "exist";
         }else{
            return "notexist";
         }
      }
      if(!empty($request->check_unique_name_edit)){

        $record = order::where('order_name', $request->check_unique_name_edit)->get();

         if(count($record) <=1){
            return "notexist";
         }else{
            return "exist";
         }
      }
  }
}
