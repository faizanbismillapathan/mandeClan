<?php

namespace App\Http\Controllers\service;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\vendor_service;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;
use Image;
use File;
use Auth;


class vendor_servicesController extends Controller
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

            if($uspermit->role == '1'  && empty(session::get('service_id'))){

// dd('2');
              return redirect()->action('frontend\frontendController@index'); 

          }

      }

if (\Auth::user()->role == "2") {
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
    
        public function index(Request $request)
    {
       
        $records=DB::table('vendor_services')->orderBy('vendor_services.id','desc')
        ->join('service_categories','service_categories.id','vendor_services.service_category')
        ->leftjoin('service_subcategories','service_subcategories.id','vendor_services.service_subcategory')
             ->leftjoin('brands','brands.id','vendor_services.service_brand');
         if (!empty($request->search)) {
         $records= $records
        ->orWhere('vendor_services.service_name','like','%' . $request->search . '%');
        }

         $records= $records
         ->select('vendor_services.*','service_categories.category_name','service_subcategories.service_subcategory','brands.brand_name')
         ->where('vendor_services.service_id',$this->id)
        ->paginate(25);



         // dd($records);


return view('service.services.index',compact('records'));
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // dd($this->id);
$record=DB::table('services')
->where('id',$this->id)->select('id','service_category','service_subcategory')->first();



$service_subcategory=DB::table('services')
->select(\DB::raw("GROUP_CONCAT(service_subcategories.service_subcategory) as service_subcategory"),\DB::raw("GROUP_CONCAT(service_subcategories.id) as id"))
->leftjoin("service_subcategories",\DB::raw("FIND_IN_SET(service_subcategories.id,services.service_subcategory)"),">",\DB::raw("'0'"))
->where('services.id',$this->id)
->groupby('service_subcategories.id')
->whereNotNull('service_subcategories.id')
->get();



 $categories = array();
foreach($service_subcategory as $user) {
$categories[$user->id] = $user->service_subcategory;
}


// dd($categories);




$warranty = [];
for ($warranty_exp=1; $warranty_exp <= 12; $warranty_exp++) $warranty[$warranty_exp] = $warranty_exp;




$autoincid = mt_rand(10,100);
$Y = date('Ys');
$keydata = 'Prod'.$Y.''.$autoincid;


 $brands = DB::table('brands')  
                    ->select('brand_name','id')
                     ->where('status','Active')
            ->whereIn('brand_type', ['Both','Service'])->pluck('brand_name','id'); 




         return view('service.services.create',compact('categories','warranty','keydata','record','brands'));
    }

    /**
     * service a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        if($request->hasFile('service_img'))
  
        {       
     $file = $request->file('service_img');
     $extension = $request->file('service_img')->getClientOriginalExtension();
     $service_img = date('d_m_Y_h_i_s',time()) . '.' . $extension;

         $destinationPaths = base_path().'/public/images/service_img';

  $thumb_img =Image::make($file->getRealPath())->orientate()->resize(600, 450);
  
     $thumb_img->save($destinationPaths.'/'.$service_img,80);

      }       
        else{
            $service_img = "";
        }


$record=DB::table('services')
->where('id',$this->id)->select('id','service_unique_id')->first();


// dd($record);

$service_payment_mode='';
if ($request->service_payment_mode) {
   $service_payment_mode =implode(',',$request->service_payment_mode);
}
$data = array(
'service_id'=>$record->id,
'user_id'=>$this->user_id,
'vendor_unique_id'=>$record->service_unique_id,
'service_unique_id'=>$request->input('service_unique_id'),
'service_category'=>$request->input('service_category'),
'service_subcategory'=>$request->input('service_subcategory'),
'service_name'=>$request->input('service_name'),
'service_brand'=>$request->input('service_brand'),
'service_description'=>$request->input('service_description'),
'service_sku'=>$request->input('service_sku'),
'service_price'=>$request->input('service_price'),
'service_payment_mode'=>$service_payment_mode,
'service_offer_discount'=>$request->input('service_offer_discount'),
'service_img'=>$service_img,
'service_link'=>str_replace(' ','-',strtolower($request->service_name)).'-'.$request->service_unique_id,
'created_by'=>'Custom',
);

// dd($data);
         $vendor_service = new vendor_service($data);
         $vendor_service->save();
                 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('service/services')->with($notification);

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

        return view('service.services.show',compact('view'));
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
        $record = vendor_service::find($id);         
        

       $record1=DB::table('vendor_services')
->where('service_id',$this->id)->select('id','service_category','service_subcategory')->first();




$service_subcategory=DB::table('services')
->select(\DB::raw("GROUP_CONCAT(service_subcategories.service_subcategory) as service_subcategory"),\DB::raw("GROUP_CONCAT(service_subcategories.id) as id"))
->leftjoin("service_subcategories",\DB::raw("FIND_IN_SET(service_subcategories.id,services.service_subcategory)"),">",\DB::raw("'0'"))
->where('services.id',$this->id)
->groupby('service_subcategories.id')
->whereNotNull('service_subcategories.id')
->get();



 $categories = array();
foreach($service_subcategory as $user) {
$categories[$user->id] = $user->service_subcategory;
}


 

 $brands = DB::table('brands')  
        ->where('brand_category',$record->service_category)
        ->pluck('brands.brand_name','brands.id'); 

        // dd($record->service_category);

$warranty = [];
for ($warranty_exp=1; $warranty_exp <= 12; $warranty_exp++) $warranty[$warranty_exp] = $warranty_exp;



 $brands = DB::table('brands')  
                    ->select('brand_name','id')
                     ->where('status','Active')
            ->whereIn('brand_type', ['Both','Service'])->pluck('brand_name','id'); 



         return view('service.services.edit',compact('record','categories','warranty','brands','record1','brands'));

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
        // dd($request);

        $vendor_services = vendor_service::find($id); 
 if($request->hasFile('service_img'))
  
        {       
     $file = $request->file('service_img');
     $extension = $request->file('service_img')->getClientOriginalExtension();
     $service_img = date('d_m_Y_h_i_s',time()) . '.' . $extension;

         $destinationPaths = base_path().'/public/images/service_img';

  $thumb_img =Image::make($file->getRealPath())->orientate()->resize(600, 450);
  
     $thumb_img->save($destinationPaths.'/'.$service_img,80);

      }       
        else{
            $service_img = $vendor_services->service_img;
        }




$record=DB::table('services')
->where('id',$this->id)->select('id','service_unique_id')->first();


// dd($record);
$service_payment_mode='';
if ($request->service_payment_mode) {
   $service_payment_mode =implode(',',$request->service_payment_mode);
}
$data = array(
// 'service_id'=>$record->id,
// 'user_id'=>Auth::user()->id,
// 'vendor_unique_id'=>$record->service_unique_id,
'service_unique_id'=>$request->input('service_unique_id'),
'service_category'=>$request->input('service_category'),
'service_subcategory'=>$request->input('service_subcategory'),
'service_name'=>$request->input('service_name'),
'service_brand'=>$request->input('service_brand'),
'service_description'=>$request->input('service_description'),
'service_sku'=>$request->input('service_sku'),
'service_price'=>$request->input('service_price'),
'service_payment_mode'=>$service_payment_mode,
'service_offer_discount'=>$request->input('service_offer_discount'),
'service_img'=>$service_img,
'service_link'=>str_replace(' ','-',strtolower($request->service_name)).'-'.$request->service_unique_id,
// 'created_by'=>'Custom',
);


// dd($data);
         $vendor_services->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('service/services')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
         $vendor_services = vendor_service::find($request->id);
          $vendor_services->delete();

          return $vendor_services;
    }

     public function status_update(Request $request){
 
         $record=vendor_service::find($request->user_id);
      
          if($record['status']=='Active'){
               $updatevender=\DB::table('vendor_services')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);
            return json_encode('Deactive');
           } else {
              $updateuser=\DB::table('vendor_services')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Active',
                                 ]);
              return json_encode("Active");

        }
           }

    public function check_unique_name(Request $request)
    {

        // return $request->checkunique_name;
        
      if(!empty($request->check_unique_name)){

        $record = vendor_service::where('service_name', $request->check_unique_name)->first();

         if(!empty($record)){
            return "exist";
         }else{
            return "notexist";
         }
      }
      if(!empty($request->check_unique_name_edit)){

        $record = vendor_service::where('service_name', $request->check_unique_name_edit)->get();

         if(count($record) <=1){
            return "notexist";
         }else{
            return "exist";
         }
      }
  }


  public function append_service_category(Request $request)
    {   
             $service_categoryId= $request->id;

// $subcategories =\DB::table('service_subcategories')                    
//            ->where("service_subcategories.service_category",$service_categoryId)
//            ->where("service_subcategories.status",'Active')
//           ->pluck('service_subcategories.service_subcategory','service_subcategories.id');

        
$brands =\DB::table('brands')                    
                       ->where("brands.brand_category",$service_categoryId)
                       ->where("brands.status",'Active')
                      ->pluck('brands.brand_name','brands.id');



        return json_encode($brands);
    }
}
