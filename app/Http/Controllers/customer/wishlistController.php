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


class wishlistController extends Controller
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

$stores=DB::table('wishlists')
->where('wishlists.persone_user_id',$this->user_id)
->where('wishlists.status','Like')
->pluck('wishlists.store_id')
->toArray();

// dd($stores);


 $stor=store::whereIn('id',array_unique($stores))->get();



// dd($stor);

 $stores=[];
    foreach($stor as $index=>$data){

        $stores[]=[
            'store_cover_photo'=>$data->store_cover_photo,
            'store_name'=>$data->store_name,
            'locality'=>$data->locality,
            'city'=>$data->city,
            'store_rating'=>$this->store_ratings($data->id),
            'id'=>$data->id,
 'user_id'=>$data->user_id,
        ];

    }


// dd($stores);

        return view('customer.wishlist.index',compact('stores'));
    }




public function store_ratings($id)
{   

    $sum=DB::table('reviews')
    ->where('store_id',$id)
    ->select('rating')
    ->sum('rating');


// dd($sum);
    $reviews_count=DB::table('reviews')
    ->where('store_id',$id)
    ->select('rating')
    ->count();


    if (!empty($reviews_count)) {

        $total=$sum/$reviews_count;
        $avg_rating= $total;

    }else{

        $avg_rating= 0;

    }


    return $avg_rating;

}



    public function show($id)
    {

        return view('customer.wishlist.index',compact('record'));
    }


  public function create()
    {
         $record='';

         return view('customer.wishlist.create',compact('record'));
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

return Redirect::to('customer/wishlist')->with($notification);

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

        return view('customer.wishlist.show',compact('view'));
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
        
         return view('customer.wishlist.edit',compact('record'));

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

return Redirect::to('customer/wishlist')->with($notification);
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
               $updatevender=\DB::table('profile')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);
            return json_encode('Deactive');
           } else {
              $updateuser=\DB::table('profile')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Active',
                                // 'updated_at' => date('Y-m-d H:i:s') 
                                 ]);
              return json_encode("Active");

        }
           }
           }


