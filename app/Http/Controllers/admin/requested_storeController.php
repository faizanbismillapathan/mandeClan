<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\requested_store;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;
use App\Traits\MailerTraits;
use App\store;
use App\user;

class requested_storeController extends Controller
{


        use MailerTraits;

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
       

      
    
       $records=requested_store::orderBy('id','desc');

                     if (!empty($request->search)) {
  $term=$request->search;
$records=$records
->where(function($q) use ($term) {
$q
     ->orWhere('requested_stores.store_owner_name','like','%' . $term . '%')
     ->orWhere('requested_stores.store_owner_email','like','%' . $term . '%')
     ->orWhere('requested_stores.store_owner_mobile','like','%' . $term . '%')
     ->orWhere('requested_stores.store_owner_gendor','like','%' . $term . '%')
     ->orWhere('requested_stores.store_category','like','%' . $term . '%')
     ->orWhere('requested_stores.store_name','like','%' . $term . '%')
     ->orWhere('requested_stores.store_website','like','%' . $term . '%')
     ->orWhere('requested_stores.store_description','like','%' . $term . '%')
     ->orWhere('requested_stores.store_address','like','%' . $term . '%');
 });
   
} 
$records=  $records
        ->paginate(25);


$use = DB::table('requested_stores')  
->select('store_name','id')        
->orderBy('store_name', 'asc')->get(); 

$requested_stores = array();
foreach($use as $user) {
$requested_stores[$user->store_name] = $user->store_name;
}



// dd($status);

return view('admin.requested_store.index',compact('records','requested_stores'));
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
         
         $countries = DB::table('countries')  
                    ->select('country_name','id')
                     ->where('status','Active')
            ->orderBy('country_name', 'asc')->pluck('country_name','id'); 

  $categories = DB::table('store_categories')  
                    ->select('category_name','id')
                     ->where('status','Active')
            ->orderBy('category_name', 'asc')->pluck('category_name','id'); 



         return view('admin.requested_store.create',compact('countries','categories'));
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
    'store_name'=>$request->input('store_name'),
        'store_mobile'=>'+'.$request->user_country_code.str_replace(' ','',$request->input('store_mobile')),
    'store_owner_email'=>$request->input('store_owner_email'),
    'store_owner_name'=>$request->input('store_owner_name'),
    'store_address'=>$request->input('store_address'),
    'store_country'=>$request->input('store_country'),
    'store_state'=>$request->input('store_state'),
    'store_city'=>$request->input('store_city'),
    'store_locality'=>$request->input('store_locality'),
    'store_pincode'=>$request->input('store_pincode'),
    'requested_by'=>$request->input('requested_by'),
    'store_category'=>$request->input('store_category'),
    'store_description'=>$request->input('store_description'),

);
         $requested_store = new requested_store($data);
         $requested_store->save();
                 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/requested-store')->with($notification);

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

        return view('admin.requested_store.show',compact('view'));
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
        $record = requested_store::find($id);         
        

        
       $countries = DB::table('countries')  
                    ->select('country_name','id')
                     ->where('status','Active')
            ->orderBy('country_name', 'asc')->pluck('country_name','id'); 

  $categories = DB::table('store_categories')  
                    ->select('category_name','id')
                     ->where('status','Active')
            ->orderBy('category_name', 'asc')->pluck('category_name','id'); 



 $states = DB::table('countries')
            ->join('states', 'countries.id', '=', 'states.country_id')
             ->where('countries.id','=', $record['store_country'])
              ->where("states.status",'Active')
            ->pluck('states.state_name','states.id');

// dd($states);
             $cities = DB::table('states')
            ->join('cities', 'states.id', '=', 'cities.state_id')
             ->where('states.id','=', $record['store_state'])
              ->where("cities.status",'Active')
            ->pluck('cities.city_name','cities.id');


             $localities = DB::table('cities')
            ->join('localities', 'cities.id', '=', 'localities.city_id')
             ->where('cities.id','=', $record['store_city'])
              ->where("localities.status",'Active')
            ->pluck('localities.locality_name','localities.id');


         return view('admin.requested_store.edit',compact('record','countries','categories','states','cities','localities'));

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
        
        $requested_store = requested_store::find($id); 

     $data = array(
    'store_name'=>$request->input('store_name'),
        'store_mobile'=>'+'.$request->user_country_code.str_replace(' ','',$request->input('store_mobile')),
    'store_owner_email'=>$request->input('store_owner_email'),
    'store_owner_name'=>$request->input('store_owner_name'),
    'store_address'=>$request->input('store_address'),
    'store_country'=>$request->input('store_country'),
    'store_state'=>$request->input('store_state'),
    'store_city'=>$request->input('store_city'),
    'store_locality'=>$request->input('store_locality'),
    'store_pincode'=>$request->input('store_pincode'),
    'requested_by'=>$request->input('requested_by'),
    'store_category'=>$request->input('store_category'),
    'store_description'=>$request->input('store_description'),

);

         $requested_store->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/requested-store')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
         $requested_store = requested_store::find($request->id);
          $requested_store->delete();

          return $requested_store;
    }

     public function status_update(Request $request){
 
      
               $updatevender=\DB::table('requested_stores')->where('id',$request->user_id)
                              ->update([
                                'status' => $request->status,
                                 ]);

$enquiry1=requested_store::find($request->user_id);



    if($enquiry1->store_type=='Store'){

        $category=$enquiry1->category->category_name;

    }else{

        $category=$enquiry1->servicecategory->category_name;
    }


if ($enquiry1->status=='Approved') {
    
     if($enquiry1->store_type=='Store'){
        
$user_data = array(
'name' => $enquiry1->store_name,
'email' => $enquiry1->store_owner_email,
'password' => bcrypt(123456),
'role' =>'2',
'status'=>'Active',

);
$users = new user($user_data);
$users->save();


$aaa = array(
      ' ' => '-', 
      '/' => '-',
      ','=>'-',
      '---'=>'-',
      '--'=>'-',
      '_'=>'-',

    );

$store_name=str_replace( array_keys($aaa), 
      array_values($aaa), $enquiry1->store_name);

$subcat=DB::table('store_categories')->where('id',$enquiry1->store_category)->select('category_url')->first();
$locality=DB::table('localities')->where('id',$enquiry1->store_locality)->select('locality_url')->first();


    $store_link=strtolower($store_name.'-'.$subcat->category_url.'-'.$locality->locality_url);


$plans=DB::table('store_subscriptions')
->where('store_plan_name','Free')
->first();


$city=DB::table('cities')
->where('id',$enquiry1->store_city)
->first();

         $data = array(
'user_id' =>$users->id,
'store_unique_id'=>'Str'.$users->id.date('Y'),
'created_by'=>'Self',
'store_owner_name'=>$enquiry1->store_owner_name,
'store_owner_email'=>$enquiry1->store_owner_email,
'store_owner_mobile'=>$enquiry1->store_owner_mobile,
'store_name'=>$enquiry1->store_name,
'store_mobile'=>$enquiry1->store_mobile,
'store_phone'=>$enquiry1->store_phone,
'store_email'=>$enquiry1->store_owner_email,
'store_owner_gendor'=>$enquiry1->store_owner_gendor,
'store_locality'=>$enquiry1->store_locality,
'store_link'=>$store_link,
'store_website'=>$enquiry1->store_website,
'store_pincode'=>$enquiry1->store_pincode,
'store_address'=>$enquiry1->store_address,
'store_email'=>$enquiry1->store_owner_email,
'store_email'=>$enquiry1->store_owner_email,
'store_password'=>123456,
'store_category'=>$enquiry1->store_category,
'store_country'=>$city->country_id,
'store_state'=>$city->state_id,
'store_city'=>$enquiry1->store_city,
'store_plan_id'=>$plans->id,
'store_description'=>$enquiry1->store_description,
'store_locality'=>$enquiry1->store_locality,
'store_mobile'=>$enquiry1->store_owner_mobile,

);
         $store = new store($data);
         $store->save();
              

    }else{

        
$user_data = array(
'name' => $enquiry1->store_name,
'email' => $enquiry1->store_owner_email,
'password' => bcrypt(123456),
'role' =>'5',
'status'=>'Active',

);
$users = new user($user_data);
$users->save();


$aaa = array(
      ' ' => '-', 
      '/' => '-',
      ','=>'-',
      '---'=>'-',
      '--'=>'-',
      '_'=>'-',

    );

$store_name=str_replace( array_keys($aaa), 
      array_values($aaa), $enquiry1->store_name);

$subcat=DB::table('service_categories')->where('id',$enquiry1->store_category)->select('category_url')->first();
$locality=DB::table('localities')->where('id',$enquiry1->store_locality)->select('locality_url')->first();


    $store_link=strtolower($store_name.'-'.$subcat->category_url.'-'.$locality->locality_url);


$plans=DB::table('service_subscriptions')
->where('service_plan_name','Free')
->first();


$city=DB::table('cities')
->where('id',$enquiry1->store_city)
->first();

         $data = array(
'user_id' =>$users->id,
'service_unique_id'=>'Str'.$users->id.date('Y'),
'created_by'=>'Self',
'service_owner_name'=>$enquiry1->store_owner_name,
'service_owner_email'=>$enquiry1->store_owner_email,
'service_owner_mobile'=>$enquiry1->store_owner_mobile,
'service_mobile'=>$enquiry1->store_owner_mobile,
'service_name'=>$enquiry1->store_name,
'service_mobile'=>$enquiry1->store_mobile,
'service_phone'=>$enquiry1->store_phone,
'service_email'=>$enquiry1->store_email,
'service_owner_gendor'=>$enquiry1->store_owner_gendor,
'service_locality'=>$enquiry1->store_locality,
'service_link'=>$store_link,
'service_website'=>$enquiry1->store_website,
'service_pincode'=>$enquiry1->store_pincode,
'service_address'=>$enquiry1->store_address,
'service_email'=>$enquiry1->store_owner_email,
'service_password'=>123456,
'service_category'=>$enquiry1->store_category,
'store_country'=>$city->country_id,
'store_state'=>$city->state_id,
'service_city'=>$enquiry1->store_city,
'service_plan_id'=>$plans->id,
'service_description'=>$enquiry1->store_description,
'service_locality'=>$enquiry1->store_locality,
'service_email'=>$enquiry1->store_owner_email,

);
         $store = new service($data);
         $store->save();

    }

$enquiry=[];
$enquiry['name']=$enquiry1->store_owner_name;
$enquiry['category']=$category;
$enquiry['updated_at']=$enquiry1->updated_at;
$enquiry['email']=$enquiry1->store_owner_email;
$enquiry['status']=$enquiry1->status;
$enquiry['type']='Business With Us';

$status=$this->BussinessApprovedStatusUpdate($enquiry,$store);



}else{


                    
$enquiry=[];
$enquiry['name']=$enquiry1->store_owner_name;
$enquiry['category']=$category;
$enquiry['updated_at']=$enquiry1->updated_at;
$enquiry['email']=$enquiry1->store_owner_email;
$enquiry['status']=$enquiry1->status;
$enquiry['type']='Business With Us';

$status=$this->BussinessStatusUpdate($enquiry);


}



$this->BussinessStatusUpdate($enquiry);

            return json_encode($request->status);
       

        }
           

    public function check_unique_name(Request $request)
    {

        // return $request->checkunique_name;
        
      if(!empty($request->check_unique_name)){

        $record = requested_store::where('store_name', $request->check_unique_name)->first();

         if(!empty($record)){
            return "exist";
         }else{
            return "notexist";
         }
      }
      if(!empty($request->check_unique_name_edit)){

        $record = requested_store::where('store_name', $request->check_unique_name_edit)->get();

         if(count($record) <=1){
            return "notexist";
         }else{
            return "exist";
         }
      }
  }
}
