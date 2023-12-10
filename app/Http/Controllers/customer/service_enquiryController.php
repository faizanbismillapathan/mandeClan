<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;
use DotenvEditor;
use App\service_customer_chat;
use Calendar;
use App\user;
use App\customer;

class service_enquiryController extends Controller
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


          if ( !in_array($uspermit->role, array('1','3'), false ) ) {

              return redirect()->action('frontend\frontendController@index'); 

          }else{

            if($uspermit->role == '1' && empty(Session::get('customer_id'))){


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

public function show($id)
{


         $chat_message=DB::table('service_customer_chats')
          ->where('service_customer_chats.enquiry_id',$id)
          ->select('message','id','identifier','created_at')
          ->get();


  $event_records=DB::table('service_bookings')->select('service_user_id','start_date','end_date')->where('id',$id)->first();


// dd($chat_message);

return view('customer.service_enquiry.view',compact('chat_message','event_records','id'));


}

public function index(Request $request)
{


  $event_records=DB::table('service_bookings')
    ->join('services','services.user_id','service_bookings.service_user_id')
    ->leftjoin('cities','cities.id','services.service_city')
->where('service_bookings.user_id',$this->user_id)
->select('service_bookings.*','services.service_name','services.service_mobile','services.service_email','cities.city_name','services.service_address');

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




return view('customer.service_enquiry.index',compact('event_records'));

}



public function store(Request $request)
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
'to_id'=>$request->service_user_id,
'enquiry_id'=>$request->service_booking_id,
'identifier'=>'Customer',
);

$service_customer_chat = new service_customer_chat($data);
$service_customer_chat->save();


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::back()->with($notification);

}



public function booking_update(Request $request)
{



    $service_customer_chat = service_customer_chat::find($id); 

    $data = array(
    'message_number'=>'1',
    'message'=>$request->user_message,
    'from_id'=>$this->user_id,
    'to_id'=>$request->service_user_id,
    'enquiry_id'=>$request->service_booking_id,
    'identifier'=>'Customer',
    );
    $service_customer_chat->update($data);

    $notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
    );

    return Redirect::to('admin/city')->with($notification);



}


}

