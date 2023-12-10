<?php

namespace App\Http\Controllers\seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\store;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Toast;
use App\User;
use App\product;
use App\suborder;



class dashboardController extends Controller
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

// dd(!in_array($uspermit->role, array(1,2)));

          if ( !in_array($uspermit->role, array('1','2'), false ) ) {

// dd('1');
              return redirect()->action('frontend\frontendController@index'); 

          }else{

//             if($uspermit->role == '1'  && empty(session::get('store_id'))){

// // dd('2');
//               return redirect()->action('frontend\frontendController@index'); 

          // }

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

    public function index()
    {

// dd(Session::get('email_otp'));
 
        $product=product::where('store_id',$this->id)->count();

$order=suborder::where('store_user_id',$this->user_id)->count();
$Cancelorder=suborder::where('store_user_id',$this->user_id)->where('order_status','Cancel')->count();
$Dispatchorder=suborder::where('store_user_id',$this->user_id)->where('order_status','Dispatch')->count();

//     $subtotal=DB::table('suborders')
// ->where('suborders.store_id',$this->id)
// ->where('paid_unpaid_status','Paid')
// ->sum('subtotal');

// return $subtotal;

$received_payouts=DB::table('order_items')->where('store_id',$this->id)->sum('item_selling_price');

$commission_amount=DB::table('order_items')->where('store_id',$this->id)->sum('commission_amount');

$total_earning=$received_payouts-$commission_amount;

// dd($item_selling_price);
        return view('seller.dashboard.index',compact('product','order','Cancelorder','Dispatchorder','total_earning','received_payouts'));
    }


    public function show($id)
    {
        $record=store::find($id);

        // dd($record->user_id);

        Session::put('store_id',$id);
        Session::put('store_name',$record->store_name);
        Session::put('store_user_id',$record->user_id);


 $product=product::where('store_id',$record->id)->count();

$order=suborder::where('store_user_id',$record->user_id)->count();
$Cancelorder=suborder::where('store_user_id',$record->user_id)->where('order_status','Cancel')->count();
$Dispatchorder=suborder::where('store_user_id',$record->user_id)->where('order_status','Dispatch')->count();


$received_payouts=DB::table('order_items')->where('store_id',$record->id)->sum('item_selling_price');

$commission_amount=DB::table('order_items')->where('store_id',$record->id)->sum('commission_amount');

$total_earning=$received_payouts-$commission_amount;

        return view('seller.dashboard.index',compact('product','order','Cancelorder','Dispatchorder','total_earning','received_payouts'));
    }


    public function check_edit_login_email(Request $request)
    {


        $record = User::where('email', $request->check_edit_login_email)->get();

        if(count($record) <=1){
            return "notexist";
        }else{
            return "exist";
        }

    }


}
