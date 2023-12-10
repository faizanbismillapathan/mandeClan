<?php

namespace App\Http\Controllers\servicepartner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\rv_user_registration;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Toast;
use Carbon\Carbon;
use App\store;
use App\order_delivery_address;
use App\rv_document;



class canceled_ordersController extends Controller
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

          if ( !in_array($uspermit->role, array('1','4'), false ) ) {

// dd('1');
              return redirect()->action('frontend\frontendController@index'); 

          }else{

            if($uspermit->role == '1' && empty(Session::get('servicepartner_id'))){

// dd('2');
              return redirect()->action('frontend\frontendController@index'); 

          }

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


$orderitems=DB::table('suborders')
->join('suborder_rider_assignments','suborder_rider_assignments.suborder_id','suborders.id')
->where('suborder_rider_assignments.rider_regis_id',$this->id)
->select('suborder_rider_assignments.rider_accept_order_status','suborders.store_id',
'suborders.order_id',
'suborders.customer_user_id',
'suborders.suborder_u_id',
'suborders.order_date',
'suborders.delivery_date',
'suborders.id',
'suborders.pickup_type',
'suborders.paid_unpaid_status','suborders.order_status','suborder_rider_assignments.rider_status_updated_by','suborder_rider_assignments.rider_status_update_date')
->where('suborder_rider_assignments.rider_accept_order_status','Rejected')
->paginate(100);




// dd($orderitems);
$records=[];

foreach($orderitems as $index=>$data){

$store_info=store::where('id',$data->store_id)->first();

$addressBook=order_delivery_address::where('order_id',$data->order_id)->first();

$users=DB::table('customers')
->where('user_id',$data->customer_user_id)
->select('id','user_id','customer_userid','customer_name as name','customer_email as email','customer_mobile as mobile')
->first();
 
 

    $records[]=(object)[
        'id'=>$data->id,
'store_email'=>$store_info->store_email,
'store_mobile'=>$store_info->store_mobile,
'store_owner_name'=>$store_info->store_owner_name,
'store_name'=>$store_info->store_name,
'store_country'=>$store_info->country->country_name,
'store_state'=>$store_info->state->state_name,
'store_city'=>$store_info->city->city_name,
'store_locality'=>$store_info->locality->locality_name,
'store_category'=>$store_info->category->category_name,
'store_address'=>$store_info->store_address,
'store_pincode'=>$store_info->store_pincode,  
'suborder_u_id'=>$data->suborder_u_id,
'order_date'=>$data->order_date,
'delivery_date'=>$data->delivery_date,
'ready_to_pickup_status_date'=>$this->status_function($data->id),
'dispatch_status'=>$this->dispatch_status_function($data->id),
'pickup_type'=>$data->pickup_type,
'addressBook'=>$addressBook,
'users'=>$users,
'paid_unpaid_status'=>$data->paid_unpaid_status,
'rider_accept_order_status'=>$data->rider_accept_order_status,
'rider_status_updated_by'=>$data->rider_status_updated_by,
'rider_status_update_date'=>$data->rider_status_update_date,
    ];

}





return view('servicepartner.today_orders.index',compact('records'));


    }


        public function status_function($suborder_id)
    {
$order_status=DB::table('order_status_managements')->where('suborder_id',$suborder_id)
->where('status','Ready To Pickup')
->first();
if (!empty($order_status)) {
   return json_encode($order_status->status_date);

}

return '';

    }



        public function dispatch_status_function($suborder_id)
    {
$order_status=DB::table('order_status_managements')->where('suborder_id',$suborder_id)
->where('status','Dispatch')
->select('status','status_date')
->first();


// if (!empty($order_status)) {
// $dispatch=$data->status;
//     $dispatch_status_date=$data->status_date;


// }

return $order_status;


    }



   public function status_update(Request $request){
       

        $record=DB::table('suborder_rider_assignments')
        ->where('suborder_rider_assignments.rider_regis_id',$this->id)
        ->where('suborder_rider_assignments.suborder_id',$request->suborder_id)
        ->first();


        $updatevender=\DB::table('suborder_rider_assignments')->where('id',$record->id)
        ->update([
        'rider_accept_order_status' => $request->status,
         'rider_status_updated_by'=>'Rider',
                                         'rider_status_update_date'=>Carbon::now()->toDateTimeString(),

        ]);


        return json_encode($request->status);
     
}



public function rv_document_view(Request $request)
{

$records=DB::table('rv_documents')->orderBy('rv_documents.id','desc');

         if (!empty($request->search)) {
         $term=$request->search;
$records=$records
->where(function($q) use ($term) {
$q
        ->orWhere('rv_documents.document_name','like','%' . $term . '%');
    });
}

         $records= $records
         ->where('user_id',Auth::user()->id)
        ->get();



         $use = DB::table('rv_documents')  
                    ->select('document_name','id')     
   
            ->get(); 

 $rv_documents = array();
foreach($use as $user) {

$rv_documents[]=['id'=>(int)$user->id,'name'=> (string)$user->document_name];
}
  // return json_encode($rv_documents);
return compact('records','rv_documents');

    }

    
public function rv_document_form(Request $request)
{
  $records=DB::table('rv_documents')
         ->where('user_id',Auth::user()->id)
         ->pluck('document_name','document_name')->toarray();

// dd($records);

  $use = DB::table('documents')  
            ->select('document_name','id')
             ->where('status','Active')
    ->whereNotIn('document_name', $records)->select('document_name','id')->get(); 


$documents = array();
foreach($use as $user) {
$documents[]=['id'=>(int)$user->id,'name'=> (string)$user->document_name];

}


    return json_encode($documents);

}


    
public function rv_document_add(Request $request)
{

 if($request->hasFile('document_file'))
        {       
             $file = $request->file('document_file');
             $extension = $request->file('document_file')->getClientOriginalExtension();
     $document_file = date('d_m_Y_h_i_s',time()) . '1.' . $extension;
             $destinationPath = base_path().'/public/images/rv_document';
             // dd($destinationPath);
             $file->move($destinationPath,$document_file);
        }        
        else{
            $document_file = "";
        }



$data = array(
'document_name'=>$request->input('document_name'),
'document_file'=>$document_file,
'user_id'=>$this->user_id,
'store_id'=>$request->store_id,

);
         $rv_document = new rv_document($data);
         $rv_document->save();
                 
  return json_encode(['status'=>'success']);



    }

    
    
public function rv_document_update(Request $request)
{

  $rv_documents = rv_document::find($request->id); 

   if($request->hasFile('document_file'))
  
        {       
     $file = $request->file('document_file');
     $extension = $request->file('document_file')->getClientOriginalExtension();
     $document_file = date('d_m_Y_h_i_s',time()) . '1.' . $extension;

         $destinationPaths = base_path().'/public/images/rv_document';

  $thumb_img =Image::make($file->getRealPath())->orientate()->resize(100, 100);
  
     $thumb_img->save($destinationPaths.'/'.$document_file,80);

      }       
        else{
            $document_file = $rv_documents->document_file;
        }

$data = array(
'document_name'=>$request->input('document_name'),
'document_file'=>$document_file,

);
         $rv_documents->update($data);

  return json_encode(['status'=>'success']);
    }



}

