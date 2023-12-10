<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\commission_setting;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;

class commission_settingController extends Controller
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

        $records=DB::table('commission_settings')
        ->join('product_categories','commission_settings.commission_store_id','product_categories.id')
        ->orderBy('id','desc');

        if (!empty($request->search)) {
           $term=$request->search;
           $records=$records
           ->where(function($q) use ($term) {
            $q
            ->orWhere('commission_type','like','%' . $term . '%');
        });
       }

       $records= $records
       ->select('commission_settings.*','product_categories.product_category')
       ->paginate(25);



       $use = DB::table('commission_settings')  
       ->select('commission_type','id')        

       ->orderBy('commission_type', 'asc')->get(); 

       $commissions = array();
       foreach($use as $user) {
        $commissions[$user->commission_type] = $user->commission_type;
    }

//  DB::table('count_masters')
// ->where('id','1')
// ->update([
// 'state_count'=>$count,
// ]);

    return view('admin.commission.index',compact('records','commissions'));

}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $check=DB::table('commission_settings')->whereNotNull('commission_store_id')->pluck('commission_store_id','commission_store_id')->toarray();


        $categories=DB::table('product_categories')
        ->where('product_categories.status','Active') 
        ->whereNotIn('id', $check)
        ->pluck('product_categories.product_category','product_categories.id');




        return view('admin.commission.create',compact('categories'));

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
        'commission_type'=>$request->input('commission_type'),
        'commission_rate'=>$request->input('commission_rate'),
        'commission_for'=>$request->input('commission_for'),
        'commission_store_id'=>$request->input('commission_store_id'),
        'status'=>'Active',

    );
       $commission_setting = new commission_setting($data);
       $commission_setting->save();



       $notification = array(
        'message' => 'Your form was successfully submit!', 
        'alert-type' => 'success'
    );

       return Redirect::to('admin/commission-setting')->with($notification);

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

       return view('admin.commission.show',compact('view'));
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
        $record = commission_setting::find($id);         
        


        $check=DB::table('commission_settings')
         ->where('commission_store_id','<>',$record->commission_store_id)
         ->whereNotNull('commission_store_id')
         ->pluck('commission_store_id','commission_store_id')
        ->toarray();


        $categories=DB::table('product_categories')
        ->where('product_categories.status','Active') 
        ->whereNotIn('id', $check)
        ->pluck('product_categories.product_category','product_categories.id');

        return view('admin.commission.edit',compact('record','categories'));

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

        $commission_setting = commission_setting::find($id); 

        $data = array(
          'commission_type'=>$request->input('commission_type'),
          'commission_rate'=>$request->input('commission_rate'),   
          'commission_for'=>$request->input('commission_for'),
          'commission_store_id'=>$request->input('commission_store_id'),

      );

        $commission_setting->update($data);



        $notification = array(
            'message' => 'Your form was successfully Update!', 
            'alert-type' => 'success'
        );

        return Redirect::to('admin/commission-setting')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

       $commission_setting = commission_setting::find($request->id);
       $commission_setting->delete();

       return $commission_setting;
   }

   public function status_update(Request $request){

       $record=commission_setting::find($request->user_id);

       if($record['status']=='Active'){
         $updatevender=\DB::table('commission_settings')->where('id',$request->user_id)
         ->update([
            'status' => 'Deactive',
        ]);
         return json_encode('Deactive');
     } else {
      $updateuser=\DB::table('commission_settings')->where('id',$request->user_id)
      ->update([
        'status' => 'Active',
                                // 'updated_at' => date('Y-m-d H:i:s') 
    ]);
      return json_encode("Active");

  }
}

public function check_commission(Request $request)
{

        // return $request->checkcommission;

  if(!empty($request->check_commission)){

    $record = commission_setting::where('commission_type', $request->check_commission)->first();

    if(!empty($record)){
        return "exist";
    }else{
        return "notexist";
    }
}
if(!empty($request->check_commission_edit)){

    $record = commission_setting::where('commission_type', $request->check_commission_edit)->get();

    if(count($record) <=1){
        return "notexist";
    }else{
        return "exist";
    }
}
}


public function commission_item_wise(Request $request)
{

    $record=DB::table('commission_settings')->first();

    return view('admin.commission.item_commission',compact('record'));

}



//  public function item_wise_commision_update(Request $request)
//     {

// $record=DB::table()->first();

// return view('admin.commission.item_commission',compact('record'));

// }


public function item_wise_commision_update(Request $request, $id)
{

    $commission_setting = commission_setting::find($id); 

    $data = array(
      'commission_type'=>$request->input('commission_type'),
      'commission_rate'=>$request->input('commission_rate'),   

  );

    $commission_setting->update($data);



    $notification = array(
        'message' => 'Your form was successfully Update!', 
        'alert-type' => 'success'
    );

    return Redirect::to('admin/commission-item-wise')->with($notification);
}




}
