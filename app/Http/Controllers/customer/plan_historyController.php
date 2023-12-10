<?php

namespace App\Http\Controllers\customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\customer;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Toast;
use App\customer_purchase_plan;
use App\customer_plan_invoice;



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

// dd(!in_array($uspermit->role, array(1,2)));

          if ( !in_array($uspermit->role, array('1','3'), false ) ) {

// dd('1');
              return redirect()->action('frontend\frontendController@index'); 

          }else{

            if($uspermit->role == '1' && empty(Session::get('customer_id'))){

// dd('2');
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

    

    public function index()
    {


 $records=DB::table('customer_purchase_plans')
 ->join('customer_plan_invoices','customer_plan_invoices.customer_plan_id','customer_purchase_plans.id')
 ->where('customer_purchase_plans.user_id',$this->user_id)
 ->select('customer_purchase_plans.created_at','customer_purchase_plans.customer_plan_name','customer_purchase_plans.plan_expiry_date','customer_purchase_plans.plan_status','customer_purchase_plans.id','customer_plan_invoices.customer_invoice_id','customer_plan_invoices.customer_total_amount','customer_plan_invoices.status as invoic_status','customer_purchase_plans.customer_product_limit')
 ->get();


// dd($records);
        return view('customer.plan_history.index',compact('records'));
    }





    public function customer_invoice_pdf($id)
    {   
               $admin_info=DB::table('admins')
       ->first();


$plans=customer_purchase_plan::where('user_id',$this->user_id)
->where('customer_purchase_plans.id',$id)
->first();


$customer_plan_invoice=customer_plan_invoice::where('user_id',$this->user_id)
->where('customer_plan_invoices.customer_plan_id',$id)
->first();


  $invoicepdf = \PDF::loadView('emails.customer_plan_invoice',compact('customer_plan_invoice','plans','admin_info'));

            return $invoicepdf->download('Marchant'.$plans->id.'.pdf');

    }


    public function show($id)
    {

        return view('customer.plan_history.index',compact('record'));
    }


  public function create()
    {
         $record='';

         return view('customer.plan_history.create',compact('record'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        


  $record=DB::table('stores')
  ->where('user_id',Auth::user()->id)
  ->select('user_password')
  ->first();
// dd($record);


  $allow_to_change=DB::table('stores')
->where('user_id',Auth::User()->id)
->select('customer_password')
->whereBetween('customer_password_date', array(Carbon::now()->subDays(1)->toDateTimeString(), Carbon::now()->toDateTimeString()))
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

return Redirect::to('customer/plan_history')->with($notification);

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

        return view('customer.plan_history.show',compact('view'));
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
        
         return view('customer.plan_history.edit',compact('record'));

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

return Redirect::to('customer/plan_history')->with($notification);
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
               $updatevender=\DB::table('customers')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);
            return json_encode('Deactive');
           } else {
              $updateuser=\DB::table('customers')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Active',
                                // 'updated_at' => date('Y-m-d H:i:s') 
                                 ]);
              return json_encode("Active");

        }
           }
           }


