<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\seller_document;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;
use Image;
use File;
use App\store;
use App\User;
use App\Traits\MailerTraits;


class seller_documentController extends Controller
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
       
         $record=DB::table('stores')
        ->leftjoin('cities','stores.store_city','cities.id')
        ->leftjoin('store_categories','stores.store_category','store_categories.id')
        ->leftjoin('localities','stores.store_locality','localities.id')
        ->leftjoin('seller_documents','stores.user_id','seller_documents.user_id')

        ->orderBy('seller_documents.id','desc');

         if (!empty($request->search)) {
         $term=$request->search;
$records=$records
->where(function($q) use ($term) {
$q
        ->orWhere('seller_documents.document_name','like','%' . $term . '%');
    });
}

         $record= $record
         ->groupby('seller_documents.user_id')
         ->select('stores.store_name','store_categories.category_name','stores.store_mobile','stores.store_email','localities.locality_name','cities.city_name','stores.kyc_status','seller_documents.user_id','seller_documents.document_name',DB::raw('count(seller_documents.id) as count'),'stores.id','stores.created_at')
         ->where('stores.kyc_status','Deactive')
        ->paginate(25);



         $use = DB::table('seller_documents')  
                    ->select('document_name','id')        
   
            ->orderBy('document_name', 'asc')->get(); 

 $seller_documents = array();
foreach($use as $user) {
$seller_documents[$user->document_name] = $user->document_name;
}


$records=[];

foreach($record as $index=>$data){

$records[]=(object)[
'store_name'=>$data->store_name,
'category_name'=>$data->category_name,
'store_mobile'=>$data->store_mobile,
'store_email'=>$data->store_email,
'locality_name'=>$data->locality_name,
'city_name'=>$data->city_name,
'kyc_status'=>$data->kyc_status,
'user_id'=>$data->user_id,
'document_name'=>$data->document_name,
'count'=>$data->count,
'id'=>$data->id,
'created_at'=>$data->created_at,
'total_document'=>$this->function_total_document($data->user_id),
'total_pending'=>$this->function_total_pending($data->user_id),
'total_approved'=>$this->function_total_approved($data->user_id),

];

}

// dd($records);





return view('admin.seller_document.index',compact('records','seller_documents'));
   
    }


    public function function_total_document($user_id)
    {

 $total_document=DB::table('documents')
 ->where('document_for','Store')
         ->count();

         return $total_document;
}


    public function function_total_pending($user_id)
    {


 $total_pending=DB::table('seller_documents')
         ->where('user_id',$user_id)
         ->where('status','Pending')
         ->count();
                  return $total_pending;

}



    public function function_total_approved($user_id)
    {

 $total_approved=DB::table('seller_documents')
         ->where('user_id',$user_id)
                  ->where('status','Approved')
         ->count();
                  return $total_approved;


}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $records=DB::table('seller_documents')
         ->where('user_id',$this->user_id)
         ->pluck('document_name','document_name')->toarray();

// dd($records);

  $documents = DB::table('documents')  
            ->select('document_name','id')
             ->where('status','Active')
                          ->where('document_for','Store')

    ->whereNotIn('document_name', $records)->pluck('document_name','document_name'); 

         return view('admin.seller_document.create',compact('documents'));
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

         
        if($request->hasFile('document_file'))
        {       
             $file = $request->file('document_file');
             $extension = $request->file('document_file')->getClientOriginalExtension();
     $document_file = date('d_m_Y_h_i_s',time()) . '1.' . $extension;
             $destinationPath = base_path().'/public/images/seller_document';
             // dd($destinationPath);
             $file->move($destinationPath,$document_file);
        }        
        else{
            $document_file = "";
        }



$data = array(
'document_name'=>$request->input('document_name'),
'document_file'=>$document_file,
'user_id'=>$this->user_id,
'store_id'=>$this->id,

);
         $seller_document = new seller_document($data);
         $seller_document->save();
                 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/seller-document')->with($notification);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
         $records = DB::table('seller_documents')  
                       ->where('store_id',$id)      
            ->orderBy('document_name', 'asc')->paginate('20'); 

 $record=DB::table('stores')
        ->leftjoin('cities','stores.store_city','cities.id')
        ->leftjoin('store_categories','stores.store_category','store_categories.id')
        ->leftjoin('localities','stores.store_locality','localities.id')
         ->select('stores.store_name','store_categories.category_name','stores.store_mobile','stores.store_email','localities.locality_name','cities.city_name','stores.status','stores.id')
         ->where('stores.id',$id)
         ->first();


        return view('admin.seller_document.show',compact('records','record'));
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
        $record = seller_document::find($id);         
        
     $records=DB::table('seller_documents')
         ->where('user_id',$record->user_id)
         ->where('document_name','<>',$record->document_name)
         ->pluck('document_name','document_name')->toarray();



        $documents = DB::table('documents')  
                    ->select('document_name','id')
                     ->where('status','Active')
                     ->where('document_for','Store')
                     ->whereNotIn('document_name', $records)
            ->orderBy('document_name', 'asc')->pluck('document_name','document_name'); 



 $result=DB::table('stores')
        ->leftjoin('cities','stores.store_city','cities.id')
        ->leftjoin('store_categories','stores.store_category','store_categories.id')
        ->leftjoin('localities','stores.store_locality','localities.id')
         ->select('stores.store_name','store_categories.category_name','stores.store_mobile','stores.store_email','localities.locality_name','cities.city_name','stores.status','stores.id')
         ->where('stores.id',$record->store_id)
         ->first();



         return view('admin.seller_document.edit',compact('record','documents','result'));

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
        
        $seller_documents = seller_document::find($id); 

   if($request->hasFile('document_file'))
  
        {       
     $file = $request->file('document_file');
     $extension = $request->file('document_file')->getClientOriginalExtension();
     $document_file = date('d_m_Y_h_i_s',time()) . '1.' . $extension;

         $destinationPaths = base_path().'/public/images/seller_document';

  $thumb_img =Image::make($file->getRealPath())->orientate()->resize(100, 100);
  
     $thumb_img->save($destinationPaths.'/'.$document_file,80);

      }       
        else{
            $document_file = $seller_documents->document_file;
        }

$data = array(
'document_name'=>$request->input('document_name'),
'document_file'=>$document_file,

);
         $seller_documents->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
            $seller_documents = seller_document::find($request->id);
            $seller_documents->delete();



$users=User::find($seller_documents->user_id);

                              $enquiry=[];
$enquiry['name']=$users->name;
$enquiry['email']=$users->email;
$enquiry['message']='Dear '.$users->name.' your attach  document '.$seller_documents->document_name.' was  Deleted by admin at '.date('d-m-Y H-m-s',strtotime(Carbon::now()));
$enquiry['subject']='Mandeclan Document '.$seller_documents->document_name.' Document was Deleted By Admin. Please attach Correct Document';


$status=$this->UserStatusUpdate($enquiry);



          return $seller_documents;
    }

     public function status_update(Request $request){
 
         $record=seller_document::find($request->user_id);
      
          if($record['status']=='Pending'){
               $updatevender=\DB::table('seller_documents')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Approved',
                                 ]);


$users=User::find($record->user_id);

                              $enquiry=[];
$enquiry['name']=$users->name;
$enquiry['email']=$users->email;
$enquiry['message']='Dear '.$users->name.' your attach  document '.$record->document_name.' is  Approved by admin at '.date('d-m-Y H-m-s',strtotime(Carbon::now()));
$enquiry['subject']='Mandeclan '.$record->document_name.' Document Are Approved By Admin';


$status=$this->UserStatusUpdate($enquiry);


            return json_encode('Approved');


           } else {
              $updateuser=\DB::table('seller_documents')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Pending',
                                 ]);

        $users=User::find($record->user_id);

                              $enquiry=[];
$enquiry['name']=$users->name;
$enquiry['email']=$users->email;
$enquiry['message']='Dear '.$users->name.' your attach  document '.$record->document_name.' is  Pending by admin at '.date('d-m-Y H-m-s',strtotime(Carbon::now()));
$enquiry['subject']='Mandeclan Document '.$record->document_name.' Document Are Pending By Admin';


$status=$this->UserStatusUpdate($enquiry);



              return json_encode("Pending");

        }
           }



    public function check_unique_name(Request $request)
    {

        // return $request->checkunique_name;
        
      if(!empty($request->check_unique_name)){

        $record = seller_document::where('document_name', $request->check_unique_name)->first();

         if(!empty($record)){
            return "exist";
         }else{
            return "notexist";
         }
      }
      if(!empty($request->check_unique_name_edit)){

        $record = seller_document::where('document_name', $request->check_unique_name_edit)->get();

         if(count($record) <=1){
            return "notexist";
         }else{
            return "exist";
         }
      }
  }


    public function kyc_status_update(Request $request){
 
         $record=store::find($request->user_id);
      
          if($record['kyc_status']=='Active'){
               $updatevender=\DB::table('stores')->where('id',$request->user_id)
                              ->update([
                                'kyc_status' => 'Deactive',
                                 ]);


                               $users=User::find($record->user_id);

                              $enquiry=[];
$enquiry['name']=$users->name;
$enquiry['email']=$users->email;
$enquiry['message']='Dear '.$users->name.' your Account Has beeen Deactivated by admin at '.date('d-m-Y H-m-s',strtotime(Carbon::now()));
$enquiry['subject']=' Your Mandeclan Account Has beeen Deactivated';


$status=$this->UserStatusUpdate($enquiry);


            return json_encode('Deactive');
           } else {
              $updateuser=\DB::table('stores')->where('id',$request->user_id)
                              ->update([
                                'kyc_status' => 'Active',
                                // 'updated_at' => date('Y-m-d H:i:s') 
                                 ]);

                                 $users=User::find($record->user_id);

                              $enquiry=[];
$enquiry['name']=$users->name;
$enquiry['email']=$users->email;
$enquiry['message']='Dear '.$users->name.' your Account Has beeen Activated by admin at '.date('d-m-Y H-m-s',strtotime(Carbon::now()));
$enquiry['subject']=' Your Mandeclan Account Has beeen Activated';


$status=$this->UserStatusUpdate($enquiry);

              return json_encode("Active");

        }
           }
}
