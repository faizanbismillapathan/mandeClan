<?php

namespace App\Http\Controllers\customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\customer;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Toast;
use App\suborder;
use App\wishlist;
use App\review;


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

          if ( !in_array($uspermit->role, array('1','3'), false ) ) {

// dd('1');
              return redirect()->action('frontend\frontendController@index'); 

          }else{

//             if($uspermit->role == '1' && empty(Session::get('customer_id'))){

// dd('2');
//               return redirect()->action('frontend\frontendController@index'); 

          // }

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


    public function index()
    {


$order=suborder::where('customer_user_id',$this->user_id)->count();
$wishlist=wishlist::where('persone_user_id',$this->user_id)->count();
$reviews=review::where('persone_user_id',$this->user_id)->count();

$followed=$order;

        return view('customer.dashboard.index',compact('order','followed','wishlist','reviews'));
    }


    public function show($id)
    {

$record=customer::find($id);
Session::put('customer_id',$id);
Session::put('customer_user_id',$record->user_id);

// dd($record->user_id);
Session::put('customer_name',$record->customer_name);

$order=suborder::where('customer_user_id',$record->user_id)->count();
$wishlist=wishlist::where('persone_user_id',$record->user_id)->count();
$followed=$order;
$reviews=review::where('persone_user_id',$this->user_id)->count();

        return view('customer.dashboard.index',compact('record','order','followed','wishlist','reviews'));
    }


  
}
