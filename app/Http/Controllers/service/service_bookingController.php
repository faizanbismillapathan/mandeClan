<?php

namespace App\Http\Controllers\service;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;
use DotenvEditor;
use App\service_bank_detail;
use App\service_booking;
use Calendar;
use App\user;
use App\customer;
use App\service_customer_chat;

class service_bookingController extends Controller
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


public function show($id)
{


         $chat_message=DB::table('service_customer_chats')
          ->where('service_customer_chats.enquiry_id',$id)
          ->select('message','id','identifier','created_at')
          ->get();


  $event_records=DB::table('service_bookings')->select('user_id','start_date','end_date')->where('id',$id)->first();


// dd($chat_message);

return view('service.booking.view',compact('chat_message','event_records','id'));


}



public function index(Request $request)
{


 $events = [];
 $data = service_booking::where('service_user_id',$this->user_id)->get();
 if($data->count()) {
    foreach ($data as $key => $value) {


            $colors=[
                'color' => '#569c02',
                'url' => url('service/booking?title='.$value->title),
            ];


if ($value->booked_by=='Admin') {
    $booked=' Add By Admin';

}else{
  $booked='';
}

$events[] = Calendar::event(
    $value->title.$booked,
    true,
    new \DateTime($value->start_date),
    new \DateTime($value->end_date.' +1 day'),
    null,
                    // Add color and link on event
    $colors
                    // [
                    //     'color' => '#f05050',
                    //     'url' => url('service/booking'),
                    // ]

);
}
}
$calendar = Calendar::addEvents($events);
        // return view('fullcalender', compact('calendar'));
// dd($calendar)
Session::put('url.role',\Request::fullUrl());
$currentURL=Session::get('url.role');

$event_records=DB::table('service_bookings')
    ->join('users','users.id','service_bookings.user_id')
    ->leftjoin('customers','customers.user_id','service_bookings.user_id')
    ->leftjoin('cities','cities.id','customers.customer_city')
->where('service_bookings.service_user_id',$this->user_id)
->select('service_bookings.*','users.name','users.mobile','users.email','cities.city_name','customers.customer_address','customers.customer_userid','customers.customer_name','customers.customer_email','customers.customer_mobile');

if (!empty($request->title)) {



    $event_records=$event_records
        ->where('service_bookings.title',$request->title);
}

    if (!empty($request->date)) {
    $event_records=$event_records
    ->whereDate('service_bookings.start_date','<=', $request->date)
    ->whereDate('service_bookings.end_date','>=', $request->date);
    }





$event_records=$event_records
->groupby('service_bookings.id')
->orderBy('service_bookings.id','Desc')
->paginate(25);


// dd($event_records);




$vendords=DB::table('services')
->select('service_name')
->where('user_id',$this->user_id)
->first();

 $states = DB::table('states')  
                    ->select('state_name','id')
                     ->where('status','Active')
            ->orderBy('state_name', 'asc')->pluck('state_name','id'); 


return view('service.booking.index',compact('currentURL','calendar','event_records','vendords','states'));

}



public function store(Request $request)
{ 


//     $both=$request->booking_date;

//  if (!empty($both)) {
//    $str= explode(' - ', $both);
//    $start_date=$str[0];
//    $end_date=$str[1];

// }else{
//     $start_date='';
//     $end_date='';
// }

$users_id=$request->input('user_id');

if (empty($users_id)) {
  
 $user_data = array(
      'name' => $request->input('customer_name'),
           'email' => $request->input('customer_email'),
           'password' => bcrypt($request->input('customer_password')),
            'role' =>'3',
            'status'=>'Active',

);
  $users = new user($user_data);
         $users->save();

$users_id=$users->id;


$state=DB::table('states')->where('id')->first();


         $data = array(
'customer_name'=>$request->input('customer_name'),
'customer_email'=>$request->input('customer_email'),
'customer_login_email'=>$request->input('customer_email'),
'customer_country'=>$state->country_id,
'customer_state'=>$request->input('customer_state'),
'customer_city'=>$request->input('customer_city'),
'customer_locality'=>$request->input('customer_locality'),
'customer_address'=>$request->input('customer_address'),
'customer_pincode'=>$request->input('customer_pincode'),
'customer_mobile'=>'+'.$request->user_country_code.str_replace(' ','',$request->input('customer_mobile')),    
'user_id' =>$users->id,
'customer_userid'=>'Cust'.$users->id.date('Y'),
'created_by'=>'Admin',



);
         $customer = new customer($data);
         $customer->save();

}

$data = array(
  
'title'=>$request->input('title'),
// 'start_date'=>$start_date,
// 'end_date'=>$end_date,
'start_date'=>$request->start_date,
'end_date'=>$request->end_date,
'status'=>$request->input('status'),
'description'=>$request->input('description'),
'service_user_id'=>$this->user_id,
'user_id'=>$users_id,
'booking_date'=>$request->start_date.'-'.$request->end_date,
'booked_by'=>'Service',
'booking_amount'=>$request->input('booking_amount'),
'advance_amount'=>$request->input('advance_amount'),
'payment_mode'=>$request->input('payment_mode'),

);

// dd($data);
$events = new service_booking($data);
$events->save();



$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::back()->with($notification);

}



public function booking_update(Request $request)
{

    $Event = service_booking::findOrFail($request->id); 

//     $both=$request->booking_date;

//     if (!empty($both)) {
//    $str= explode(' - ', $both);

//        $start_date=$str[0];
//        $end_date=$str[1];

//    }else{
//     $start_date='';
//     $end_date='';
// }

$data = array(
  
'title'=>$request->input('title'),
'start_date'=>$request->start_date,
'end_date'=>$request->end_date,
'status'=>$request->input('status'),
'description'=>$request->input('description'),
'booking_date'=>$request->start_date.'-'.$request->end_date,
'booked_by'=>'Service',
'booking_amount'=>$request->input('booking_amount'),
'advance_amount'=>$request->input('advance_amount'),
'payment_mode'=>$request->input('payment_mode'),

);



$Event->update($data);



$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::back()->with($notification);
}


public function status_update(Request $request){

 $record=service_bank_detail::find($request->user_id);

 if($record['status']=='Active'){
   $updatevender=\DB::table('service_bank_details')->where('id',$request->user_id)
   ->update([
    'status' => 'Deactive',
]);
   return json_encode('Deactive');
} else {
  $updateuser=\DB::table('service_bank_details')->where('id',$request->user_id)
  ->update([
    'status' => 'Active',
                                // 'updated_at' => date('Y-m-d H:i:s') 
]);
  return json_encode("Active");

}
}




public function destroy(Request $request)
{
       
    $role = service_booking::find($request->id);
 $role->delete();

 return $role;
}



public function check_booking_date(Request $request)
{

        // return $request->checkCountry;

  if(!empty($request->check_booking_date)){

    $record = vendor_booking::where('booking_date', $request->check_booking_date)->first();

    if(!empty($record)){
        return "exist";
    }else{
        return "notexist";
    }
}
if(!empty($request->check_booking_date_edit)){

    $record = vendor_booking::where('booking_date', $request->check_booking_date_edit)->get();

    if(count($record) <=1){
        return "notexist";
    }else{
        return "exist";
    }
}
}

public function vendor_booking_detail(Request $request)
{

    $ajax_records=DB::table('service_bookings')
    ->where('service_user_id',$this->user_id)
    ->whereDate('start_date','<=', $request->date)
    ->whereDate('end_date','>=', $request->date)
    ->orderBy('id','Desc')
    ->select('id','created_at','updated_at','start_date','end_date','title','description','status')
    ->get();
    $vendords=DB::table('services')
    ->select('service_name')
    ->where('id',$this->user_id)
    ->first();

    $data=array();
    $data['ajax_records']=$ajax_records;
    $data['service_name']=$vendords->service_name;
    $data['select_date']=$request->date;


    return json_encode($data);

}


public function append_user_info(Request $request)
{

    $users=DB::table('users')
    ->join('customers','customers.user_id','users.id')
    ->leftjoin('cities','cities.id','customers.customer_city')
    ->Where('users.mobile','like','%' . $request->mobile . '%')
    ->select('users.id','users.name','users.mobile','users.email','cities.city_name','customers.customer_address')
    ->where('users.role','3')->first();

     return json_encode($users);

}


public function service_enquiry(Request $request)
{ 

 $messages=DB::table('service_customer_chats')
    ->where('service_customer_chats.enquiry_id',$request->service_booking_id)
    ->orderBy('service_customer_chats.id', 'desc')
    ->first();

// dd($messages);

if (!empty($messages)) {
      $message_number= $messages->message_number;
     }else{
      $message_number='1';
     }



$data = array(
'message_number'=>$message_number,
'message'=>$request->user_message,
'from_id'=>$this->user_id,
'user_id'=>$this->user_id,
'to_id'=>$request->customer_user_id,
'enquiry_id'=>$request->service_booking_id,
'identifier'=>'Service',
);

$service_customer_chat = new service_customer_chat($data);
$service_customer_chat->save();


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::back()->with($notification);

}


}

