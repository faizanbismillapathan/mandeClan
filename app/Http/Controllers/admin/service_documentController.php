<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\service_document;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;
use Image;
use File;
use App\store;
use App\User;
use App\Traits\MailerTraits;
use App\service;


class service_documentController extends Controller
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
       
         $record=DB::table('services')
        ->leftjoin('cities','services.service_city','cities.id')
        ->leftjoin('service_categories','services.service_category','service_categories.id')
        ->leftjoin('localities','services.service_locality','localities.id')
        ->join('service_documents','services.user_id','service_documents.user_id')

        ->orderBy('service_documents.id','desc');

         if (!empty($request->search)) {
         $term=$request->search;
$record=$record
->where(function($q) use ($term) {
$q
        ->orWhere('service_documents.document_name','like','%' . $term . '%');
    });
}

         $record= $record
         ->select('services.service_name','service_categories.category_name','services.service_mobile','services.service_email','localities.locality_name','cities.city_name','services.kyc_status','service_documents.user_id','service_documents.document_name',DB::raw('count(service_documents.id) as count'),'services.id','services.created_at')
         ->where('services.kyc_status','Deactive')
         ->groupby('service_documents.user_id')
        ->paginate(25);



         $use = DB::table('service_documents')  
                    ->select('document_name','id')        
   
            ->orderBy('document_name', 'asc')->get(); 

 $service_documents = array();
foreach($use as $user) {
$service_documents[$user->document_name] = $user->document_name;
}


$records=[];

foreach($record as $index=>$data){

$records[]=(object)[
'service_name'=>$data->service_name,
'category_name'=>$data->category_name,
'service_mobile'=>$data->service_mobile,
'service_email'=>$data->service_email,
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





return view('admin.service_document.index',compact('records','service_documents'));
   
    }


    public function function_total_document($user_id)
    {

 $total_document=DB::table('documents')
              ->where('document_for','Service')

         ->count();

         return $total_document;
}


    public function function_total_pending($user_id)
    {


 $total_pending=DB::table('service_documents')
         ->where('user_id',$user_id)
         ->where('status','Pending')
         ->count();
                  return $total_pending;

}



    public function function_total_approved($user_id)
    {

 $total_approved=DB::table('service_documents')
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

        $records=DB::table('service_documents')
         ->where('user_id',$this->user_id)
         ->pluck('document_name','document_name')->toarray();

// dd($records);

  $documents = DB::table('documents')  
            ->select('document_name','id')
             ->where('status','Active')
             ->where('document_for','Service')
    ->whereNotIn('document_name', $records)->pluck('document_name','document_name'); 

         return view('admin.service_document.create',compact('documents'));
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
             $destinationPath = base_path().'/public/images/service_document';
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
'service_id'=>$this->id,

);
         $service_document = new service_document($data);
         $service_document->save();
                 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/service-document')->with($notification);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
         $records = DB::table('service_documents')  
                       ->where('service_id',$id)      
            ->orderBy('document_name', 'asc')->paginate('20'); 

 $record=DB::table('services')
        ->leftjoin('cities','services.service_city','cities.id')
        ->leftjoin('service_categories','services.service_category','service_categories.id')
        ->leftjoin('localities','services.service_locality','localities.id')
         ->select('services.service_name','service_categories.category_name','services.service_mobile','services.service_email','localities.locality_name','cities.city_name','services.status','services.id')
         ->where('services.id',$id)
         ->first();

// dd($records);

        return view('admin.service_document.show',compact('records','record'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $record = service_document::find($id);         
                // dd($record);

     $records=DB::table('service_documents')
         ->where('user_id',$record->user_id)
         ->where('document_name','<>',$record->document_name)
         ->pluck('document_name','document_name')->toarray();



        $documents = DB::table('documents')  
                    ->select('document_name','id')
                     ->where('status','Active')
                                  ->where('document_for','Service')
                     ->whereNotIn('document_name', $records)
            ->orderBy('document_name', 'asc')->pluck('document_name','document_name'); 



 $result=DB::table('services')
        ->leftjoin('cities','services.service_city','cities.id')
        ->leftjoin('service_categories','services.service_category','service_categories.id')
        ->leftjoin('localities','services.service_locality','localities.id')
         ->select('services.service_name','service_categories.category_name','services.service_mobile','services.service_email','localities.locality_name','cities.city_name','services.status','services.id')
         ->where('services.id',$record->service_id)
         ->first();



         return view('admin.service_document.edit',compact('record','documents','result'));

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
        
        $service_documents = service_document::find($id); 

   if($request->hasFile('document_file'))
  
        {       
     $file = $request->file('document_file');
     $extension = $request->file('document_file')->getClientOriginalExtension();
     $document_file = date('d_m_Y_h_i_s',time()) . '1.' . $extension;

         $destinationPaths = base_path().'/public/images/service_document';

  $thumb_img =Image::make($file->getRealPath())->orientate()->resize(100, 100);
  
     $thumb_img->save($destinationPaths.'/'.$document_file,80);

      }       
        else{
            $document_file = $service_documents->document_file;
        }

$data = array(
'document_name'=>$request->input('document_name'),
'document_file'=>$document_file,

);
         $service_documents->update($data);

           

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
      
            $service_documents = service_document::find($request->id);
            $service_documents->delete();



$users=User::find($service_documents->user_id);

                              $enquiry=[];
$enquiry['name']=$users->name;
$enquiry['email']=$users->email;
$enquiry['message']='Dear '.$users->name.' your attach  document '.$service_documents->document_name.' was  Deleted by admin at '.date('d-m-Y H-m-s',strtotime(Carbon::now()));
$enquiry['subject']='Mandeclan Document '.$service_documents->document_name.' Document was Deleted By Admin. Please attach Correct Document';


$status=$this->UserStatusUpdate($enquiry);



          return $service_documents;
    }

     public function status_update(Request $request){
 
         $record=service_document::find($request->user_id);
      
          if($record['status']=='Pending'){
               $updatevender=\DB::table('service_documents')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Approved',
                                 ]);


$users=User::find($record->user_id);

                              $enquiry=[];
$enquiry['name']=$users->name;
$enquiry['email']=$users->email;
$enquiry['message']='Dear '.$users->name.' your attach  document '.$record->document_name.' is  Approved by admin at '.date('d-m-Y H-m-s',strtotime(Carbon::now()));
$enquiry['subject']='Mandeclan '.$record->document_name.' Document id Approved By Admin';


$status=$this->UserStatusUpdate($enquiry);


            return json_encode('Approved');


           } else {
              $updateuser=\DB::table('service_documents')->where('id',$request->user_id)
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

        $record = service_document::where('document_name', $request->check_unique_name)->first();

         if(!empty($record)){
            return "exist";
         }else{
            return "notexist";
         }
      }
      if(!empty($request->check_unique_name_edit)){

        $record = service_document::where('document_name', $request->check_unique_name_edit)->get();

         if(count($record) <=1){
            return "notexist";
         }else{
            return "exist";
         }
      }
  }


    public function service_kyc_status_update(Request $request){
 
         $record=service::find($request->user_id);
      
          if($record['kyc_status']=='Active'){
               $updatevender=\DB::table('services')->where('id',$request->user_id)
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
              $updateuser=\DB::table('services')->where('id',$request->user_id)
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
