<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\rv_document;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;
use Image;
use File;
use App\Traits\MailerTraits;
use App\rv_user_registration;
use App\User;


class rv_documentController extends Controller
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
       


        $record=DB::table('rv_user_registrations')
        ->join('cities','cities.id','rv_user_registrations.rv_user_city')
                ->join('localities','localities.id','rv_user_registrations.rv_user_locality')
->join('rv_documents','rv_documents.rv_register_id','rv_user_registrations.id')
        ->orderBy('rv_user_registrations.id','desc');

         if (!empty($request->search)) {
         $term=$request->search;
$records=$records
->where(function($q) use ($term) {
$q
        ->orWhere('rv_user_registrations.rv_user_userid','like','%' . $term . '%')
        ->orWhere('rv_user_registrations.rv_user_name','like','%' . $term . '%')
        ->orWhere('rv_user_registrations.rv_user_mobile','like','%' . $term . '%')
        ->orWhere('rv_user_registrations.rv_user_gender','like','%' . $term . '%')
        ->orWhere('cities.city_name','like','%' . $term . '%')
        ->orWhere('localities.locality_name','like','%' . $term . '%')
        ->orWhere('rv_user_registrations.rv_user_type','like','%' . $term . '%')
        ->orWhere('rv_user_registrations.status','like','%' . $term . '%');
    });
}

         $record= $record
         ->select('localities.locality_name','cities.city_name','rv_user_registrations.*',DB::raw('count(rv_documents.id) as count'))

         ->select('rv_user_registrations.rv_user_name','rv_user_registrations.rv_user_mobile','rv_user_registrations.rv_user_email','localities.locality_name','cities.city_name','rv_user_registrations.kyc_status','rv_documents.user_id','rv_documents.document_name',DB::raw('count(rv_documents.id) as count'),'rv_user_registrations.id','rv_user_registrations.created_at')


                  ->where('rv_user_registrations.status','<>','Archive')

        ->paginate(25);

         $use = DB::table('rv_documents')  
                    ->select('document_name','id')        
   
            ->orderBy('document_name', 'asc')->get(); 

 $rv_documents = array();
foreach($use as $user) {
$rv_documents[$user->document_name] = $user->document_name;
}



$records=[];

foreach($record as $index=>$data){

$records[]=(object)[
'rv_user_name'=>$data->rv_user_name,
'rv_user_mobile'=>$data->rv_user_mobile,
'rv_user_email'=>$data->rv_user_email,
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

return view('admin.rv_document.index',compact('records','rv_documents'));
   
    }




    public function function_total_document($user_id)
    {

 $total_document=DB::table('documents')
   ->where('document_for','Rider')
         ->count();

         return $total_document;
}


    public function function_total_pending($user_id)
    {


 $total_pending=DB::table('rv_documents')
         ->where('user_id',$user_id)
         ->where('status','Pending')
         ->count();
                  return $total_pending;

}



    public function function_total_approved($user_id)
    {

 $total_approved=DB::table('rv_documents')
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

        $records=DB::table('rv_documents')
         ->where('user_id',$this->user_id)
         ->pluck('document_name','document_name')->toarray();

// dd($records);

  $documents = DB::table('documents')  
            ->select('document_name','id')
             ->where('status','Active')
             ->where('document_for','Rider')
    ->whereNotIn('document_name', $records)->pluck('document_name','document_name'); 

         return view('admin.rv_document.create',compact('documents'));
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
             $destinationPath = base_path().'/public/images/rv_document';
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
'rv_register_id'=>$this->id,

);
         $rv_document = new rv_document($data);
         $rv_document->save();
                 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/rv-document')->with($notification);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
                  $records = DB::table('rv_documents')  
                       ->where('rv_register_id',$id)      
            ->orderBy('document_name', 'asc')->paginate('20'); 


// dd($records);

             $record= DB::table('rv_user_registrations')
        ->join('cities','cities.id','rv_user_registrations.rv_user_city')
                ->join('localities','localities.id','rv_user_registrations.rv_user_locality')
         ->select('rv_user_registrations.rv_user_name','rv_user_registrations.rv_user_mobile','rv_user_registrations.rv_user_email','localities.locality_name','cities.city_name','rv_user_registrations.status','rv_user_registrations.id')
         ->where('rv_user_registrations.id',$id)
         ->first();



        return view('admin.rv_document.show',compact('records','record'));

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
        $record = rv_document::find($id);         
        

           $records=DB::table('rv_documents')
         ->where('user_id',$record->user_id)
         ->where('document_name','<>',$record->document_name)
         ->pluck('document_name','document_name')->toarray();




     $documents = DB::table('documents')  
                    ->select('document_name','id')
                     ->where('status','Active')
                     ->whereNotIn('document_name', $records)
                       ->where('document_for','Rider')
            ->orderBy('document_name', 'asc')->pluck('document_name','document_name'); 


 $result= DB::table('rv_user_registrations')
        ->join('cities','cities.id','rv_user_registrations.rv_user_city')
                ->join('localities','localities.id','rv_user_registrations.rv_user_locality')

         ->select('rv_user_registrations.rv_user_name','rv_user_registrations.rv_user_mobile','rv_user_registrations.rv_user_email','localities.locality_name','cities.city_name','rv_user_registrations.status','rv_user_registrations.id')
         ->where('rv_user_registrations.id',$record->rv_register_id)
         ->first();

         return view('admin.rv_document.edit',compact('record','documents','result'));

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
        
        $rv_documents = rv_document::find($id); 

   if($request->hasFile('document_file'))
  
        {       
     $file = $request->file('document_file');
     $extension = $request->file('document_file')->getClientOriginalExtension();
     $document_file = date('d_m_Y_h_i_s',time()) . '1.' . $extension;

         $destinationPaths = base_path().'/public/images/rv_document';

  $thumb_img =Image::make($file->getRealPath())->orientate()->resize(100, 100);
  
     $thumb_img->save($destinationPaths.'/'.$document_file,80);

      }       
        else{
            $document_file = $rv_documents->document_file;
        }

$data = array(
'document_name'=>$request->input('document_name'),
'document_file'=>$document_file,
'user_id'=>$rv_documents->user_id,
'rv_register_id'=>$rv_documents->rv_register_id,
);
  
// dd($data);

         $rv_documents->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/rv-document')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
         $rv_documents = rv_document::find($request->id);
          $rv_documents->delete();

          return $rv_documents;
    }

   

    public function rv_kyc_status_update(Request $request){
 
         $record=rv_user_registration::find($request->user_id);
      
          if($record['kyc_status']=='Active'){
               $updatevender=\DB::table('rv_user_registrations')->where('id',$request->user_id)
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
              $updateuser=\DB::table('rv_user_registrations')->where('id',$request->user_id)
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


    public function check_unique_name(Request $request)
    {

        // return $request->checkunique_name;
        
      if(!empty($request->check_unique_name)){

        $record = rv_document::where('document_name', $request->check_unique_name)->first();

         if(!empty($record)){
            return "exist";
         }else{
            return "notexist";
         }
      }
      if(!empty($request->check_unique_name_edit)){

        $record = rv_document::where('document_name', $request->check_unique_name_edit)->get();

         if(count($record) <=1){
            return "notexist";
         }else{
            return "exist";
         }
      }
  }
}
