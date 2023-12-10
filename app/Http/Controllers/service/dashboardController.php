<?php

namespace App\Http\Controllers\service;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\service;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Toast;
use App\User;
use App\vendor_service;
use App\service_booking;



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



          if ( !in_array($uspermit->role, array('1','5'), false ) ) {

// dd('1');
              return redirect()->action('frontend\frontendController@index'); 

          }else{

//             if($uspermit->role == '1'  && empty(session::get('service_id'))){

// // dd('2');
//               return redirect()->action('frontend\frontendController@index'); 

          // }

      }
       if (\Auth::user()->role == "5") {
      $service_id=DB::table('services')
             ->where('user_id',\Auth::user()->id)
             ->select('id','user_id','status','kyc_status')
             ->first();

              if ($service_id->kyc_status=='deactive') {
                 
              return redirect()->action('frontend\frontendcontroller@index'); 

             }
             $this->id=$service_id->id; 
$this->user_id=$service_id->user_id;  

   }elseif (\Auth::user()->role == "1") {

                    $this->id=session::get('service_id');
 $this->user_id=session::get('service_user_id');
}


return $next($request);
  });

    }

    public function index()
    {

 
        $total_services=vendor_service::where('service_id',$this->id)->count();
        $total_booking=service_booking::where('service_user_id',$this->id)->where('status','Booking')->count();
        $total_cancelled=service_booking::where('service_user_id',$this->id)->where('status','Cancelled')->count();
        $total_completed=service_booking::where('service_user_id',$this->id)->where('status','Completed')->count();


// dd($total_services);
        return view('service.dashboard.index',compact('total_services','total_booking','total_cancelled','total_completed'));
    }


    public function show($id)
    {
        $record=service::find($id);

        // dd($record->user_id);

        Session::put('service_id',$id);
        Session::put('service_name',$record->service_name);
        Session::put('service_user_id',$record->user_id);



 $total_services=vendor_service::where('service_id',$record->id)->count();
        $total_booking=service_booking::where('service_user_id',$record->user_id)->where('status','Booking')->count();
        $total_cancelled=service_booking::where('service_user_id',$record->user_id)->where('status','Cancelled')->count();
        $total_completed=service_booking::where('service_user_id',$record->user_id)->where('status','Completed')->count();


        return view('service.dashboard.index',compact('total_services','total_booking','total_cancelled','total_completed'));
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
