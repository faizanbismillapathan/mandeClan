<?php

namespace App\Http\Controllers\service;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\service;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Toast;
use App\service_purchase_plan;
use App\service_plan_invoice;



class plan_historyController extends Controller
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

      }if (\Auth::user()->role == "5") {
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


 $records=DB::table('service_purchase_plans')
 ->join('service_plan_invoices','service_plan_invoices.service_plan_id','service_purchase_plans.id')
 ->where('service_purchase_plans.user_id',$this->user_id)
 ->select('service_purchase_plans.created_at','service_purchase_plans.service_plan_name','service_purchase_plans.plan_expiry_date','service_purchase_plans.plan_status','service_purchase_plans.id','service_plan_invoices.service_invoice_id','service_plan_invoices.service_total_amount','service_plan_invoices.status as invoic_status','service_purchase_plans.service_product_limit')
 ->get();


// dd($records);
        return view('service.plan_history.index',compact('records'));
    }





    public function service_invoice_pdf($id)
    {   
               $admin_info=DB::table('admins')
       ->first();


$plans=service_purchase_plan::where('user_id',$this->user_id)
->where('service_purchase_plans.id',$id)
->first();


$service_plan_invoice=service_plan_invoice::where('user_id',$this->user_id)
->where('service_plan_invoices.service_plan_id',$id)
->first();


  $invoicepdf = \PDF::loadView('emails.service_plan_invoice',compact('service_plan_invoice','plans','admin_info'));

            return $invoicepdf->download('Marchant'.$plans->id.'.pdf');

    }


    public function show($id)
    {

        return view('service.plan_history.index',compact('record'));
    }


  public function create()
    {
         $record='';

         return view('service.plan_history.create',compact('record'));
    }

    /**
     * Service a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        


  $record=DB::table('services')
  ->where('user_id',Auth::user()->id)
  ->select('user_password')
  ->first();
// dd($record);


  $allow_to_change=DB::table('services')
->where('user_id',Auth::User()->id)
->select('service_password')
->whereBetween('service_password_date', array(Carbon::now()->subDays(1)->toDateTimeString(), Carbon::now()->toDateTimeString()))
->first();

// dd($allow_to_change);
if (!empty($allow_to_change)) {
  
  $allows='No';

}else{
  $allows='Yes';

}



  return view('user.user-change-password',compact('record','allows'));



$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('service/plan_history')->with($notification);

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

        return view('service.plan_history.show',compact('view'));
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
        $record = role::find($id);         
        
         return view('service.plan_history.edit',compact('record'));

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
        
        $role = role::find($id); 

   $data = array(
    'role_name'=>$request->input('role_name'),
    
);
         $role->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('service/plan_history')->with($notification);
    }

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
 
         $record=role::find($request->user_id);
      
          if($record['status']=='Active'){
               $updatevender=\DB::table('services')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);
            return json_encode('Deactive');
           } else {
              $updateuser=\DB::table('services')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Active',
                                // 'updated_at' => date('Y-m-d H:i:s') 
                                 ]);
              return json_encode("Active");

        }
           }
           }


