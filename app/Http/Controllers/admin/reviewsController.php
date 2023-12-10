<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\review;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;

class reviewsController extends Controller
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
       
        $records=DB::table('reviews')
        ->orderBy('suborder_id','desc');

         if (!empty($request->search)) {
         $term=$request->search;
$records=$records
->where(function($q) use ($term) {
$q
        ->orWhere('store_name','like','%' . $term . '%')
        ->orWhere('store_unique_id','like','%' . $term . '%')
        ->orWhere('persone_name','like','%' . $term . '%')
        ->orWhere('persone_unique_id','like','%' . $term . '%')
        ->orWhere('reviews','like','%' . $term . '%')
        ->orWhere('rating','like','%' . $term . '%');
    });

    }

         $records= $records
        ->paginate(25);



      

return view('admin.reviews.index',compact('records'));
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $record='';


  $stores = DB::table('stores')  
                    ->select('store_name','id')
                     ->where('status','Active')
            ->orderBy('store_name', 'asc')->pluck('store_name','id'); 


$customers= DB::table('customers')  
                    ->select('customer_name','id')
                     ->where('status','Active')
            ->orderBy('customer_name', 'asc')->pluck('customer_name','id'); 


         return view('admin.reviews.create',compact('record','stores','customers'));
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

        $stores=DB::table('stores')->select('store_name','user_id','id','store_unique_id')->where('id',$request->store_id)->first();

  $customers=DB::table('customers')->select('customer_userid','user_id','id','customer_name')->where('id',$request->customer_id)->first();


         $data = array(
  
'store_name'=>$stores->store_name,
'store_user_id'=>$stores->user_id,
'store_unique_id'=>$stores->store_unique_id,
'store_id'=>$stores->id,
'persone_name'=>$customers->customer_name,
'persone_role'=>3,
'persone_user_id'=>$customers->user_id,
'persone_unique_id'=>$customers->customer_userid,
'reviews'=>$request->input('reviews'),
'rating'=>$request->input('rating'),
'status'=>'Active',
);
         $review = new review($data);
         $review->save();
                 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/reviews')->with($notification);

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

        return view('admin.reviews.show',compact('view'));
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
        $record = review::find($id);         
        
         return view('admin.reviews.edit',compact('record'));

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
        
        $review = review::find($id); 

   $data = array(
   'reviews'=>$request->input('reviews'),
'rating'=>$request->input('rating'),
);
         $review->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/reviews')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
         $review = review::find($request->id);
          $review->delete();

          return $review;
    }

     public function status_update(Request $request){
 
         $record=review::find($request->user_id);
      
          if($record['status']=='Active'){
               $updatevender=\DB::table('reviews')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);
            return json_encode('Deactive');
           } else {
              $updateuser=\DB::table('reviews')->where('id',$request->user_id)
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

        $record = review::where('product_name', $request->check_unique_name)->first();

         if(!empty($record)){
            return "exist";
         }else{
            return "notexist";
         }
      }
      if(!empty($request->check_unique_name_edit)){

        $record = review::where('product_name', $request->check_unique_name_edit)->get();

         if(count($record) <=1){
            return "notexist";
         }else{
            return "exist";
         }
      }
  }
}
