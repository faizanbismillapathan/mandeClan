<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\user;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;

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

          if ( !in_array($uspermit->role, array('1','2'), false ) ) {

// dd('1');
              return redirect()->action('frontend\frontendController@index'); 

          }else{

            if($uspermit->role == '1'  && empty(session::get('store_id'))){

// dd('2');
              return redirect()->action('frontend\frontendController@index'); 

          }

      }
       
 if (\Auth::user()->role == "2") {
      $store_id=DB::table('stores')
             ->where('user_id',\Auth::user()->id)
             ->select('id','user_id')
             ->first();

            $this->id=$store_id->id; 
$this->user_id=$store_id->user_id;  

   }elseif (\Auth::user()->role == "1") {

                    $this->id=session::get('store_id');
 $this->user_id=session::get('store_user_id');
}

   
return $next($request);
  });


    }
        public function index(Request $request)
    {
       
//         $records=DB::table('canceled_orders')->orderBy('id','desc');

//          if (!empty($request->search)) {
//         $term=$request->search;
//$records=$records
//->where(function($q) use ($term) {
//$q
//         ->orWhere('order_name','like','%' . $term . '%');
    });
// }

//          $records= $records
//         ->paginate(25);



//          $use = DB::table('canceled_orders')  
//                     ->select('order_name','id')        
   
//             ->orderBy('order_name', 'asc')->get(); 

//  $canceled_orders = array();
// foreach($use as $user) {
// $canceled_orders[$user->order_name] = $user->order_name;
// }

//  DB::table('count_masters')
// ->where('id','1')
// ->update([
// 'state_count'=>$count,
// ]);

return view('seller.canceled_orders.index');
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $record='';

         return view('seller.canceled_orders.create',compact('record'));
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
    'order_name'=>$request->input('order_name'),
    
);
         $canceled_orders = new canceled_orders($data);
         $canceled_orders->save();
                 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('seller/canceled-orders')->with($notification);

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

        return view('seller.canceled_orders.show',compact('view'));
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
        $record = user::find($id);         
        
         return view('seller.canceled_orders.edit',compact('record'));

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
        
        $canceled_orders = order::find($id); 

   $data = array(
    'order_name'=>$request->input('order_name'),
    
);
         $canceled_orders->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('seller/canceled-orders')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
         $canceled_orders = order::find($request->id);
          $canceled_orders->delete();

          return $canceled_orders;
    }

     public function status_update(Request $request){
 
         $record=order::find($request->user_id);
      
          if($record['status']=='Active'){
               $updatevender=\DB::table('canceled_orders')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);
            return json_encode('Deactive');
           } else {
              $updateuser=\DB::table('canceled_orders')->where('id',$request->user_id)
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

        $record = order::where('order_name', $request->check_unique_name)->first();

         if(!empty($record)){
            return "exist";
         }else{
            return "notexist";
         }
      }
      if(!empty($request->check_unique_name_edit)){

        $record = order::where('order_name', $request->check_unique_name_edit)->get();

         if(count($record) <=1){
            return "notexist";
         }else{
            return "exist";
         }
      }
  }
}