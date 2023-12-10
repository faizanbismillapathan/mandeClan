<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\ticket;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;
use Image;
use File;


class ticketsController extends Controller
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
    
        public function index(Request $request)
    {
       
        $records=DB::table('tickets')->orderBy('tickets.id','desc')
;
         if (!empty($request->search)) {
         $term=$request->search;
$records=$records
->where(function($q) use ($term) {
$q
        ->orWhere('tickets.ticket_name','like','%' . $term . '%');
    });
}

         $records= $records
         ->select('tickets.*',\DB::raw("GROUP_CONCAT(roles.role_name) as role_name"))

           ->leftjoin("roles",\DB::raw("FIND_IN_SET(roles.id,tickets.ticket_role)"),">",\DB::raw("'0'"))
->groupby('tickets.id')
        ->paginate(25);



         $use = DB::table('tickets')  
                    ->select('ticket_name','id')        
   
            ->orderBy('ticket_name', 'asc')->get(); 

 $tickets = array();
foreach($use as $user) {
$tickets[$user->ticket_name] = $user->ticket_name;
}

//  DB::table('count_masters')
// ->where('id','1')
// ->update([
// 'state_count'=>$count,
// ]);

return view('admin.tickets.index',compact('records','tickets'));
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          $categories = DB::table('roles')  
                    ->select('role_name','id')
                     ->where('status','Active')
            ->orderBy('role_name', 'asc')->pluck('role_name','id'); 



         return view('admin.tickets.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);

           

$data = array(
'ticket_role'=>implode(',',$request->input('ticket_role')),
'ticket_name'=>$request->input('ticket_name'),

);
         $ticket = new ticket($data);
         $ticket->save();
                 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/tickets')->with($notification);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
                 $view='';

        return view('admin.tickets.show',compact('view'));
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
        $record = ticket::find($id);         
        
         $categories = DB::table('roles')  
                    ->select('role_name','id')
                     ->where('status','Active')
            ->orderBy('role_name', 'asc')->pluck('role_name','id'); 



         return view('admin.tickets.edit',compact('record','categories'));

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
        
        $tickets = ticket::find($id); 

   

$data = array(
'ticket_role'=>implode(',',$request->input('ticket_role')),
'ticket_name'=>$request->input('ticket_name'),

);
         $tickets->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/tickets')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
         $tickets = ticket::find($request->id);
          $tickets->delete();

          return $tickets;
    }

     public function status_update(Request $request){
 
         $record=ticket::find($request->user_id);
      
          if($record['status']=='Active'){
               $updatevender=\DB::table('tickets')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);
            return json_encode('Deactive');
           } else {
              $updateuser=\DB::table('tickets')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Active',
                                // 'updated_at' => date('Y-m-d H:i:s') 
                                 ]);
              return json_encode("Active");

        }
           }

    public function check_unique_name(Request $request)
    {

        // return $request->checkunique_name;
        
      if(!empty($request->check_unique_name)){

        $record = ticket::where('ticket_name', $request->check_unique_name)->first();

         if(!empty($record)){
            return "exist";
         }else{
            return "notexist";
         }
      }
      if(!empty($request->check_unique_name_edit)){

        $record = ticket::where('ticket_name', $request->check_unique_name_edit)->get();

         if(count($record) <=1){
            return "notexist";
         }else{
            return "exist";
         }
      }
  }
}
