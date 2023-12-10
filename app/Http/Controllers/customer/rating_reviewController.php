<?php

namespace App\Http\Controllers\customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\customer;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Toast;
use App\store;
use App\review;


class rating_reviewController extends Controller
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

$variable=DB::table('suborders')
->where('suborders.order_status','Delivered')
->leftjoin('reviews','suborders.id','reviews.suborder_id')
->select('suborders.suborder_u_id','suborders.delivery_date','suborders.delivery_time','suborders.id','reviews.reviews','reviews.rating','suborders.store_id')
->where('suborders.customer_user_id',$this->user_id)
->groupby('suborders.id')
->paginate(25);

$records=[];

foreach ($variable as $key => $value) {
   
   $records[]=(object)[
'store_info'=>$this->store_informations($value->store_id),
'suborder_u_id'=>$value->suborder_u_id,
'delivery_date'=>$value->delivery_date,
'rating'=>$value->rating,
'reviews'=>$value->reviews,
'id'=>$value->id,
   ];
}



// dd($records);

        return view('customer.rating_review.index',compact('records','variable'));
    }

   public function store_informations($store_id)
    {


    $record=store::where('id',$store_id)->first();

return $record;
}

    public function show($suborder_id)
    {


         return view('customer.rating_review.reviews',compact('suborder_id'));
    }


  public function create()
    {
         $record='';

         return view('customer.rating_review.create',compact('record'));
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
    'role_name'=>$request->input('role_name'),
    
);
         $role = new role($data);
         $role->save();
                 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('customer/rating-review')->with($notification);

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

        return view('customer.rating_review.show',compact('view'));
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
        
         return view('customer.rating_review.edit',compact('record'));

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

return Redirect::to('customer/rating-review')->with($notification);
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
               $updatevender=\DB::table('rating_review')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);
            return json_encode('Deactive');
           } else {
              $updateuser=\DB::table('rating_review')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Active',
                                // 'updated_at' => date('Y-m-d H:i:s') 
                                 ]);
              return json_encode("Active");

        }
           }





public function store_reviews($store_id)
    {

         return view('customer.rating_review.reviews',compact('store_id'));

    }




public function store_review_add(Request $request)
    {
        // dd($request);

       


        $stores=DB::table('suborders')->select('store_user_id','id','store_u_id','store_id')->where('id',$request->suborder_id)->first();


 $stores1=DB::table('stores')->select('store_name')->where('id',$stores->store_id)->first();
// 
  $customers=DB::table('customers')->select('customer_userid','user_id','id','customer_name')->where('id',$this->id)->first();

$check=DB::table('reviews')
->where('store_id',$request->store_id)
->where('suborder_id',$stores->id)
->where('persone_user_id',$customers->user_id)
->first();

if (empty($check)) {


     if($request->hasFile('attachment'))
  
        {       
     $file = $request->file('attachment');
     $extension = $request->file('attachment')->getClientOriginalExtension();
     $attachment = date('d_m_Y_h_i_s',time()) . '1.' . $extension;

         $destinationPaths = base_path().'/public/images/reviews';

  
        $file->move($destinationPaths, $attachment);


      }       
        else{
            $attachment = "";
        }


   
         $data = array(  
'store_name'=>$stores1->store_name,
'store_user_id'=>$stores->store_user_id,
'store_unique_id'=>$stores->store_u_id,
'store_id'=>$stores->store_id,
'persone_name'=>$customers->customer_name,
'persone_role'=>3,
'persone_user_id'=>$customers->user_id,
'persone_unique_id'=>$customers->customer_userid,
'reviews'=>$request->input('reviews'),
'rating'=>$request->input('rating'),
'status'=>'Active',
'suborder_id'=>$stores->id,
'attachment'=>$attachment,
);
         $review = new review($data);
         $review->save();
                 

 // code...
}else{ 

        $review = review::find($check->id); 
if($request->hasFile('attachment'))
  
        {       
     $file = $request->file('attachment');
     $extension = $request->file('attachment')->getClientOriginalExtension();
     $attachment = date('d_m_Y_h_i_s',time()) . '1.' . $extension;

         $destinationPaths = base_path().'/public/images/reviews';

  
        $file->move($destinationPaths, $attachment);


      }       
        else{
            $attachment = $review->attachment;
        }

 $data = array(  
'reviews'=>$request->input('reviews'),
'rating'=>$request->input('rating'),
'attachment'=>$attachment,
);


 $review->update($data); 

}
$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('customer/rating-review')->with($notification);

    }

           }


