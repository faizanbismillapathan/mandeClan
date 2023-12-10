<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\product;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;
use Image;
use File;
use Auth;
use App\product_addon_group;



class product_addon_groupController extends Controller
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
             ->select('id','user_id','status','kyc_status')
             ->first();

             if ($store_id->kyc_status=='deactive') {
                 
              return redirect()->action('frontend\frontendcontroller@index'); 

             }
$this->id=$store_id->id; 
$this->user_id=$store_id->user_id;  

   }elseif (\Auth::user()->role == "1") {

                    $this->id=session::get('store_id');
 
$this->user_id=session::get('store_user_id');
}

return $next($request);
  });

// session::put()



    }
    
        public function index(Request $request)
    {



       
       return view('seller.product_addon_group.index');

       }


        public function show($id)
    {

       
    }



    public function create()
    {



    }


      public function edit($id)
    {


$record=product_addon_group::find($id);

        return view('seller.product_addons.index',compact('record'));


    }


  public function store(Request $request)
    {



$data = array(
'store_id'=>$this->id,
'user_id'=>$this->user_id,
'product_id'=>$request->product_id,
'addon_group_name'=>$request->input('addon_group_name'),
'addon_group_type'=>$request->input('addon_group_type'),
'addon_group_validation'=>$request->input('addon_group_validation'),

);

  $product = new product_addon_group($data);
         $product->save();
                 
 // Session::put('addon_group',1);
  // Session::put('addon_list',0);


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success',
         'addon_list'=>0,
        'addon_group'=>1,
);



return Redirect::back()->with($notification);

    }


      public function update(Request $request)
    {
        

        $products = product_addon_group::find($request->id); 


$data = array(
'addon_group_name'=>$request->input('addon_group_name'),
'addon_group_type'=>$request->input('addon_group_type'),
'addon_group_validation'=>$request->input('addon_group_validation'),

);

                 $products->update($data);

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success',
      'addon_list'=>0,
        'addon_group'=>1,
);

 // Session::put('addon_group',1);
  // Session::put('addon_list',0);

return Redirect::back()->with($notification);

}

public function destroy(Request $request)
    {
      
         $products = product_addon_group::find($request->id);
          $products->delete();

          return $products;
    }

     public function status_update(Request $request){
 
         $record=product_addon_group::find($request->user_id);
      
          if($record['status']=='Active'){
               $updatevender=\DB::table('product_addon_groups')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);
            return json_encode('Deactive');
           } else {
              $updateuser=\DB::table('product_addon_groups')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Active',
                                 ]);
              return json_encode("Active");

        }
           }

}