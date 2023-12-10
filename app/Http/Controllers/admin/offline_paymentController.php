<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\offline_payment;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;
use Image;
use File;
class offline_paymentController extends Controller
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

        $records=DB::table('offline_payments')->orderBy('id','desc');

        if (!empty($request->search)) {
          $term=$request->search;
$records=$records
->where(function($q) use ($term) {
$q
           ->orWhere('payment_name','like','%' . $term . '%');
       });
       }

       $records= $records
       ->paginate(25);



       $use = DB::table('offline_payments')  
       ->select('payment_name','id')        

       ->orderBy('payment_name', 'asc')->get(); 

       $offline_payments = array();
       foreach($use as $user) {
        $offline_payments[$user->payment_name] = $user->payment_name;
    }

//  DB::table('count_masters')
// ->where('id','1')
// ->update([
// 'state_count'=>$count,
// ]);

    return view('admin.offline_payment.index',compact('records','offline_payments'));

}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $record='';

       return view('admin.offline_payment.create',compact('record'));
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

      if($request->hasFile('thumbnail'))

      {       
       $file = $request->file('thumbnail');
       $extension = $request->file('thumbnail')->getClientOriginalExtension();
       $thumbnail = date('d_m_Y_h_i_s',time()) . '1.' . $extension;

       $destinationPaths = base_path().'/public/images/thumbnail';

       $thumb_img =Image::make($file->getRealPath())->orientate()->resize(100, 100);

       $thumb_img->save($destinationPaths.'/'.$thumbnail,80);


   }       
   else{
    $thumbnail = "";
}



$data = array(
    'payment_name'=>$request->input('payment_name'),
    'description'=>$request->input('description'),
    'thumbnail'=>$thumbnail,

);
$offline_payment = new offline_payment($data);
$offline_payment->save();



$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/offline-payment')->with($notification);

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

       return view('admin.offline_payment.show',compact('view'));
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
        $record = offline_payment::find($id);         
        
        return view('admin.offline_payment.edit',compact('record'));

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

        $offline_payment = offline_payment::find($id); 


        if($request->hasFile('thumbnail'))

        {       
           $file = $request->file('thumbnail');
           $extension = $request->file('thumbnail')->getClientOriginalExtension();
           $thumbnail = date('d_m_Y_h_i_s',time()) . '1.' . $extension;

           $destinationPaths = base_path().'/public/images/thumbnail';

           $thumb_img =Image::make($file->getRealPath())->orientate()->resize(100, 100);

           $thumb_img->save($destinationPaths.'/'.$thumbnail,80);


       }       
       else{
        $thumbnail = $offline_payment->thumbnail;
    }

    $data = array(
        'payment_name'=>$request->input('payment_name'),
        'description'=>$request->input('description'),
        'thumbnail'=>$thumbnail,

    );
    $offline_payment->update($data);



    $notification = array(
        'message' => 'Your form was successfully Update!', 
        'alert-type' => 'success'
    );

    return Redirect::to('admin/offline-payment')->with($notification);
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

       $offline_payment = offline_payment::find($request->id);
       $offline_payment->delete();

       return $offline_payment;
   }

   public function status_update(Request $request){

       $record=offline_payment::find($request->user_id);

       if($record['status']=='Active'){
        $updatevender=\DB::table('offline_payments')->where('id',$request->user_id)
         ->update([
            'status' => 'Deactive',
        ]);
         return json_encode('Deactive');
     } else {
        $updateuser=\DB::table('offline_payments')->where('id',$request->user_id)
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

    $record = offline_payment::where('payment_name', $request->check_unique_name)->first();

    if(!empty($record)){
        return "exist";
    }else{
        return "notexist";
    }
}
if(!empty($request->check_unique_name_edit)){

    $record = offline_payment::where('payment_name', $request->check_unique_name_edit)->get();

    if(count($record) <=1){
        return "notexist";
    }else{
        return "exist";
    }
}
}
}
