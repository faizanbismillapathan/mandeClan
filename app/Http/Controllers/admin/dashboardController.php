<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\User;
use App\customer;
use App\order;
use App\product;
use App\store;
use App\store_category;

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

       $this->middleware(function ($request, $next) {
          $uspermit = \Auth::user();
           if($uspermit->role != '1'){
              return redirect()->action('frontend\frontendController@index',['id' => 'Nagpur']);  
          }
          return $next($request);
      });
    }


 public function index()
    {

$customer=customer::count();
$order=order::count();
$product=product::count();
$store=store::count();
$category=store_category::count();

$Cancelorder=order::where('order_status','Cancel')->count();
$Dispatchorder=order::where('order_status','Dispatch')->count();



        return view('admin.dashboard.index',compact(
'customer','order','product','store','category','Cancelorder','Dispatchorder'     ));
    }

    public function check_login_email(Request $request)
    {


        $record = User::where('email', $request->check_login_email)->first();

         if(!empty($record)){
            return "exist";
         }else{
            return "notexist";
         }
         
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
