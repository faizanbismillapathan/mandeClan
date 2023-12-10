<?php

namespace App\Http\Controllers\servicepartner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\rv_user_registration;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Toast;


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


    public function index()
    {


        $today_ordrs=DB::table('suborders')
->join('suborder_rider_assignments','suborder_rider_assignments.suborder_id','suborders.id')
->where('suborder_rider_assignments.rider_regis_id',$this->id)
->whereIn('suborders.order_status',['Ready To Pickup','Dispatch'])
->where('suborder_rider_assignments.rider_accept_order_status','<>','Rejected')
->select('suborders.id')->count();


  $canceled_ordrs=DB::table('suborders')
->join('suborder_rider_assignments','suborder_rider_assignments.suborder_id','suborders.id')
->where('suborder_rider_assignments.rider_regis_id',$this->id)
->where('suborder_rider_assignments.rider_accept_order_status','Rejected')
->select('suborders.id')->count();


  $delivered_ordrs=DB::table('suborders')
->join('suborder_rider_assignments','suborder_rider_assignments.suborder_id','suborders.id')
->where('suborder_rider_assignments.rider_regis_id',$this->id)
->where('suborder_rider_assignments.rider_accept_order_status','Accepted')
->select('suborders.id')->count();


$user_id=$this->user_id;

        return view('servicepartner.dashboard.index',compact('today_ordrs','canceled_ordrs','delivered_ordrs','user_id'));
    }


    public function show($id)
    {

$record=rv_user_registration::find($id);
Session::put('servicepartner_id',$id);
Session::put('rv_user_name',$record->rv_user_name);
Session::put('servicepartner_user_id',$record->user_id);
// dd($record->user_id);


        $today_ordrs=DB::table('suborders')
->join('suborder_rider_assignments','suborder_rider_assignments.suborder_id','suborders.id')
->where('suborder_rider_assignments.rider_regis_id',$this->id)
->whereIn('suborders.order_status',['Ready To Pickup','Dispatch'])
->where('suborder_rider_assignments.rider_accept_order_status','<>','Rejected')
->select('suborders.id')->count();


  $canceled_ordrs=DB::table('suborders')
->join('suborder_rider_assignments','suborder_rider_assignments.suborder_id','suborders.id')
->where('suborder_rider_assignments.rider_regis_id',$this->id)
->where('suborder_rider_assignments.rider_accept_order_status','Rejected')
->select('suborders.id')->count();


  $delivered_ordrs=DB::table('suborders')
->join('suborder_rider_assignments','suborder_rider_assignments.suborder_id','suborders.id')
->where('suborder_rider_assignments.rider_regis_id',$this->id)
->where('suborder_rider_assignments.rider_accept_order_status','Accepted')
->select('suborders.id')->count();



        return view('servicepartner.dashboard.index',compact('record','today_ordrs','canceled_ordrs','delivered_ordrs'));
    }


  
}
