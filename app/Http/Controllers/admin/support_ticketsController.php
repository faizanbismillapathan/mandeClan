<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\country;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;
use App\suport_ticket_detail;


class support_ticketsController extends Controller
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


 $records=DB::table('suport_tickets')
 ->orderBy('id','desc')
 ->paginate(50);


        return view('admin.support_ticket.index',compact('records'));
    }


    public function show($id)
    {

        return view('admin.support_ticket.index',compact('record'));
    }


  public function create()
    {
         $record='';

         return view('admin.support_ticket.create',compact('record'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

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
'user_id'=>\Auth::user()->id,
'message_by'=>'Admin',
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show1($id)
    {
                 $view='';

        return view('admin.support_ticket.show',compact('view'));
    }

     public function support_ticket_msg()
    {

        return view('admin.support_ticket.view');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($ticket_id)
    {
        // dd($id);

         $records=DB::table('suport_ticket_details')
  ->where('suport_ticket_details.ticket_id',$ticket_id)
 ->get();


 $record=DB::table('suport_tickets')
 ->where('suport_tickets.id',$ticket_id)
 ->first();



        
         return view('admin.support_ticket.edit',compact('records','record'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
         $role = role::find($request->id);
          $role->delete();

          return $role;
    }

     public function status_update(Request $request){
 
         // $record=suport_ticket::find($request->user_id);
      
               $updatevender=\DB::table('suport_tickets')->where('id',$request->id)
                              ->update([
                                'status' => $request->status,
                                 ]);
            return json_encode($request->status);
        

           }



           }

