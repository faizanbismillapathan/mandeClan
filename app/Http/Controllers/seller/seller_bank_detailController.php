<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;
use DotenvEditor;
use App\seller_bank_detail;

class seller_bank_detailController extends Controller
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

// dd('4');

        $this->middleware(function ($request, $next) {
          $uspermit = \Auth::user();

// dd(!in_array($uspermit->role, array(1,2)));

          if ( !in_array($uspermit->role, array('1','2'), false ) ) {

// dd('1');
              return redirect()->action('frontend\frontendController@index'); 

          }else{

            if($uspermit->role == '1'  && empty(session::get('store_id'))){

// dd('2');
              return redirect()->action('frontend\frontendController@index'); 

          }

      }

if (\Auth::user()->role == "2") {
      $store_id=DB::table('stores')
             ->where('user_id',\Auth::user()->id)
             ->select('id','user_id','status','kyc_status')
             ->first();

             if ($store_id->kyc_status=='deactive') {
                 
              return redirect()->action('frontend\frontendcontroller@index'); 

             }
$this->id=$store_id->id; 
$this->user_id=$store_id->user_id;  

   }elseif (\Auth::user()->role == "1") {

                    $this->id=session::get('store_id');
                   
$this->user_id=session::get('store_user_id');
}


return $next($request);
  });

    }


        public function index(Request $request)
    {
       
       
        $configs = config::first();

        $bank_detail = seller_bank_detail::where('user_id',$this->user_id)->first();

return view('seller.bank_detail.index',compact('configs','bank_detail'));
   
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
    'user_id'=>$this->user_id,
    
);
         $seller_bank_detail = new seller_bank_detail($data);
         $seller_bank_detail->save();
                 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('seller/bank-detail')->with($notification);

    }



public function update(Request $request, $id)
    {
        // dd($request);
        $seller_bank_detail = seller_bank_detail::find($id); 

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
         $seller_bank_detail->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('seller/bank-detail')->with($notification);
    }


      public function status_update(Request $request){
 
         $record=seller_bank_detail::find($request->user_id);
      
          if($record['status']=='Active'){
               $updatevender=\DB::table('seller_bank_details')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);
            return json_encode('Deactive');
           } else {
              $updateuser=\DB::table('seller_bank_details')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Active',
                                // 'updated_at' => date('Y-m-d H:i:s') 
                                 ]);
              return json_encode("Active");

        }
           }


}

