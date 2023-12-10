<?php

namespace App\Http\Controllers\servicepartner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\suport_ticket;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Toast;

use App\suport_ticket_detail;


class support_ticketController extends Controller
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
 $records=DB::table('suport_tickets')->orderBy('id','desc');

         if (!empty($request->search)) {
        $term=$request->search;
$records=$records
->where(function($q) use ($term) {
$q
    ->orWhere('ticket_name','like','%' . $termh . '%')
    ->orWhere('vendor_name','like','%' . $termh . '%')
    ->orWhere('vendor_email','like','%' . $termh . '%')
    ->orWhere('subject','like','%' . $termh . '%')
    ->orWhere('message','like','%' . $termh . '%');
});
}

         $records= $records
         ->where('suport_tickets.user_id',$this->user_id)
        ->paginate(25);

        return view('servicepartner.support_ticket.index',compact('records'));
    }


    public function show($id)
    {

        return view('servicepartner.support_ticket.index');
    }


  public function create()
    {
         
 $tickets = DB::table('tickets')  
                    ->select('ticket_name','id')
                     ->where('status','Active')
                     ->where('ticket_role','like','%' .'Service Partner' . '%')
            ->orderBy('ticket_name', 'asc')->pluck('ticket_name','ticket_name'); 

// dd($tickets);
         return view('servicepartner.support_ticket.create',compact('tickets'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($data);
         $data = array(
    'ticket_name'=>$request->input('ticket_name'),
    'vendor_name'=>$request->input('vendor_name'),
    'vendor_email'=>$request->input('vendor_email'),
    'subject'=>$request->input('subject'),
    'message'=>$request->input('message'),
    'user_id'=>$this->user_id,
    'message_by'=>'Service Partner',
    'ticket_no'=>uniqid(),
    
);


          // dd($data);

          
         $suport_ticket = new suport_ticket($data);
         $suport_ticket->save();
                 


    if($request->hasFile('attachment'))
  
        {       
     $file = $request->file('attachment');
     $extension = $request->file('attachment')->getClientOriginalExtension();
     $attachment = date('d_m_Y_h_i_s',time()) . '1.' . $extension;

         $destinationPaths = base_path().'/public/images/tickets';

  
        $file->move($destinationPaths, $attachment);


      }       
        else{
            $attachment = "";
        }


 $data = array(
    'ticket_id'=>$suport_ticket->id,
    'name'=>$request->input('vendor_name'),
    'message'=>$request->input('message'),
     'user_id'=>$this->user_id,
    'message_by'=>'Service Partner',
'attachment'=>$attachment,
    
);
         $suport_ticket_detail = new suport_ticket_detail($data);
         $suport_ticket_detail->save();
                 



$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('service-partner/support-ticket')->with($notification);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show1($id)
    {
                 $view='';

        return view('servicepartner.support_ticket.show',compact('view'));
    }

     public function support_ticket_msg($ticket_id)
    {

 $records=DB::table('suport_ticket_details')
 ->whereIn('suport_ticket_details.message_by',['Service Partner','Admin'])
  ->where('suport_ticket_details.ticket_id',$ticket_id)

 ->get();


 $record=DB::table('suport_tickets')
 ->where('suport_tickets.user_id',$this->user_id)
 ->where('suport_tickets.id',$ticket_id)
 ->first();


// dd($record);
        return view('servicepartner.support_ticket.view',compact('records','record'));

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($id);
        $record = suport_ticket::find($id);         
        

 $tickets = DB::table('tickets')  
                    ->select('ticket_name','id')
                     ->where('status','Active')
            ->orderBy('ticket_name', 'asc')->pluck('ticket_name','ticket_name'); 


         return view('servicepartner.support_ticket.edit',compact('record','tickets'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        
        $suport_ticket = suport_ticket::find($id); 

   $data = array(
'ticket_name'=>$request->input('ticket_name'),
    'vendor_name'=>$request->input('vendor_name'),
    'vendor_email'=>$request->input('vendor_email'),
    'subject'=>$request->input('subject'),
    'message'=>$request->input('message'),    
);
         $suport_ticket->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
         $suport_ticket = suport_ticket::find($request->id);
          $suport_ticket->delete();

          return $suport_ticket;
    }

     public function status_update(Request $request){
 
         $record=suport_ticket::find($request->user_id);
      
          if($record['status']=='Active'){
               $updatevender=\DB::table('support_ticket')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);
            return json_encode('Deactive');
           } else {
              $updateuser=\DB::table('support_ticket')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Active',
                                // 'updated_at' => date('Y-m-d H:i:s') 
                                 ]);
              return json_encode("Active");

        }
           }



public function reply_support_ticket(Request $request)
    {
        // 
        
        if($request->hasFile('attachment'))
  
        {       
     $file = $request->file('attachment');
     $extension = $request->file('attachment')->getClientOriginalExtension();
     $attachment = date('d_m_Y_h_i_s',time()) . '1.' . $extension;

         $destinationPaths = base_path().'/public/images/tickets';

  
        $file->move($destinationPaths, $attachment);


      }       
        else{
            $attachment = "";
        }


$data = array(
'ticket_id'=>$request->ticket_id,
'name'=>$request->input('name'),
'message'=>$request->input('message'),
'user_id'=>$this->user_id,
'message_by'=>'Service Partner',
'attachment'=>$attachment,

);

 // dd($data);
         $suport_ticket_detail = new suport_ticket_detail($data);
         $suport_ticket_detail->save();
                 



$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::back()->with($notification);

    }


   }


