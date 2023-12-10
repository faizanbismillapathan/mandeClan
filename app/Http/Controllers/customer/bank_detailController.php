<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;
use DotenvEditor;
use App\customer_bank_detail;

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

// dd('4');

        $this->middleware(function ($request, $next) {
          $uspermit = \Auth::user();

// dd(!in_array($uspermit->role, array(1,2)));

          if ( !in_array($uspermit->role, array('1','3'), false ) ) {

// dd('1');
              return redirect()->action('frontend\frontendController@index'); 

          }else{

            if($uspermit->role == '1' && empty(Session::get('customer_id'))){

// dd('2');
              return redirect()->action('frontend\frontendController@index'); 

          }

      }
 

        if (\auth::user()->role == "3") {
      $customer_id=db::table('customers')
             ->where('user_id',\auth::user()->id)
             ->select('id','user_id')
             ->first();

            $this->id=$customer_id->id; 
$this->user_id=$customer_id->user_id;  

   }elseif (\auth::user()->role == "1") {

                    $this->id=session::get('customer_id');
 $this->user_id=session::get('customer_user_id');
}


      return $next($request);
  });


    }


        public function index(Request $request)
    {
       
       
        $configs = config::first();

        $bank_detail = customer_bank_detail::where('user_id',$this->user_id)->first();

return view('customer.bank_detail.index',compact('configs','bank_detail'));
   
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
         $customer_bank_detail = new customer_bank_detail($data);
         $customer_bank_detail->save();
                 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('customer/bank-detail')->with($notification);

    }



public function update(Request $request, $id)
    {
        // dd($request);
        $customer_bank_detail = customer_bank_detail::find($id); 

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
         $customer_bank_detail->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('customer/bank-detail')->with($notification);
    }


      public function status_update(Request $request){
 
         $record=customer_bank_detail::find($request->user_id);
      
          if($record['status']=='Active'){
               $updatevender=\DB::table('customer_bank_details')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);
            return json_encode('Deactive');
           } else {
              $updateuser=\DB::table('customer_bank_details')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Active',
                                // 'updated_at' => date('Y-m-d H:i:s') 
                                 ]);
              return json_encode("Active");

        }
           }


}

