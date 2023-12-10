<?php

namespace App\Http\Controllers\servicepartner;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;
use DotenvEditor;
use App\rv_bank_detail;

class bank_detailController extends Controller
{

	        protected $config;
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


          if ( !in_array($uspermit->role, array('1','4'), false ) ) {


              return redirect()->action('frontend\frontendController@index'); 

          }else{



      }
 

        if (\auth::user()->role == "4") {
      $servicepartner_id=db::table('rv_user_registrations')
             ->where('user_id',\Auth::user()->id)
             ->select('id','user_id')
             ->first();

            $this->id=$servicepartner_id->id; 
$this->user_id=$servicepartner_id->user_id;  

   }elseif (\auth::user()->role == "1") {

                    $this->id=session::get('servicepartner_id');
 $this->user_id=session::get('servicepartner_user_id');
}


      return $next($request);
  });

    }


        public function index(Request $request)
    {
       
       
        $configs = config::first();

        $bank_detail = rv_bank_detail::where('user_id',Session::get('store_user_id'))->first();

return view('servicepartner.bank_detail.index',compact('configs','bank_detail'));
   
    }


  public function store(Request $request)
    {
        // dd($request);


if($request->status=='on'){
    $status='Active';
}else{
        $status='Deactive';

}

         $data = array(
    'bankname'=>$request->input('bankname'),
    'branchname'=>$request->input('branchname'),
    'ifsc'=>$request->input('ifsc'),
    'account'=>$request->input('account'),
    'acountname'=>$request->input('acountname'),
    'status'=>$status,
    // 'swift_code'=>$request->input('swift_code'),
    'user_id'=>Session::get('store_user_id'),
    
);
         $rv_bank_detail = new rv_bank_detail($data);
         $rv_bank_detail->save();
                 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('service-partner/bank-detail')->with($notification);

    }



public function update(Request $request, $id)
    {
        // dd($request);
        $rv_bank_detail = rv_bank_detail::find($id); 

if($request->status=='on'){
    $status='Active';
}else{
        $status='Deactive';

}
   $data = array(
 'bankname'=>$request->input('bankname'),
    'branchname'=>$request->input('branchname'),
    'ifsc'=>$request->input('ifsc'),
    'account'=>$request->input('account'),
    'acountname'=>$request->input('acountname'),
    'status'=>$status,
    // 'swift_code'=>$request->input('swift_code'),    
);

   // dd($data);
         $rv_bank_detail->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('service-partner/bank-detail')->with($notification);
    }


      public function status_update(Request $request){
 
         $record=rv_bank_detail::find($request->user_id);
      
          if($record['status']=='Active'){
               $updatevender=\DB::table('rv_bank_details')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);
            return json_encode('Deactive');
           } else {
              $updateuser=\DB::table('rv_bank_details')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Active',
                                // 'updated_at' => date('Y-m-d H:i:s') 
                                 ]);
              return json_encode("Active");

        }
           }


}

