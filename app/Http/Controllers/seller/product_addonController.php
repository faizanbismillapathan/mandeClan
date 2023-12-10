<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\product_addon_group;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;
use Image;
use File;
use Auth;
use App\product_addon;
use Illuminate\Support\Facades\URL;



class product_addonController extends Controller
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

         

    }
    
        public function index($id)
    {

// dd($product_id);

        // dd('product_addon_groupController');


$record=DB::table('products')
    ->orderBy('products.id','desc')
    ->join('product_categories','product_categories.id','products.product_category')
    ->leftjoin('product_subcategories','product_subcategories.id','products.product_subcategory')
    ->where('products.id',$id)
    ->select('products.product_name','product_categories.product_category','product_subcategories.product_subcategory','products.id')
    ->first();




       $addon_groups=product_addon_group::where('product_id',$id)->get();

// dd($addon_groups);
$addon_groups_arr=[];
$viewarray=[];

       foreach($addon_groups as $index=>$data){
$addon_groups_arr[$data->id]=$data->addon_group_name;


$viewarray[]=[

'addon_group_name'=>$data->addon_group_name,  
'addon_group_type'=>$data->addon_group_type,  
    'group_list'  => $this->addon_group_list($data->id),

];
       }



          $addon_group_list=DB::table('product_addons')
->join('product_addon_groups','product_addon_groups.id','product_addons.addon_group_id')
          ->where('product_addon_groups.product_id',$id)
->select('product_addons.*')
          ->get();


 // Session::put('addon_group',1);
  // Session::put('addon_list',0);

$notification = array(
   
    'addon_list'=>0,
    'addon_group'=>1,
);



       return view('seller.product_addon.index',compact('addon_groups','record','addon_groups_arr','addon_group_list','id','viewarray'))->with($notification);

       }


  public function addon_group_list($id)
{

  $addon_group_list=DB::table('product_addons')
          ->where('product_addons.addon_group_id',$id)
->select('product_addons.*')
          ->get();


          return $addon_group_list;

}


        public function addonView($id)
    {


return view('seller.product_addon.view');  
    }



    public function create()
    {



    }


      public function edit($id)
    {


$record=product_addon::find($id);

        return view('seller.product_addons.index',compact('record'));


    }


  public function store(Request $request)
    {

$group=product_addon_group::find($request->addon_group_id);

$data = array(

'addon_group_id'=>$request->input('addon_group_id'),
'addon_group_name'=>$group->addon_group_name,
'addon_name'=>$request->input('addon_name'),
'addon_price'=>$request->input('addon_price'),

);

  $product = new product_addon($data);
         $product->save();
                 

$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success',
    'addon_list'=>1,
    'addon_group'=>0,
);


 // Session::put('addon_group',0);
  // Session::put('addon_list',1);


return Redirect::back()->with($notification);

    }


      public function update(Request $request)
    {
        

        $products = product_addon::find($request->id); 


$group=product_addon_group::find($request->addon_group_id);

$data = array(

'addon_group_id'=>$request->input('addon_group_id'),
'addon_group_name'=>$group->addon_group_name,
'addon_name'=>$request->input('addon_name'),
'addon_price'=>$request->input('addon_price'),

);



                 $products->update($data);

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success',
        'addon_list'=>1,
        'addon_group'=>0,
);


 // Session::put('addon_group',0);
  // Session::put('addon_list',1);



return Redirect::back()->with($notification);


// return Redirect::to(URL::previous() . "#id_tab_addon_list");

}

public function destroy(Request $request)
    {
      
         $products = product_addon::find($request->id);
          $products->delete();

          return $products;
    }

     public function status_update(Request $request){
 
         $record=product_addon::find($request->user_id);
      
          if($record['status']=='Active'){
               $updatevender=\DB::table('product_addons')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);
            return json_encode('Deactive');
           } else {
              $updateuser=\DB::table('product_addons')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Active',
                                 ]);
              return json_encode("Active");

        }
           }

}