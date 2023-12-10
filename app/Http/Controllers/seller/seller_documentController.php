<?php

namespace App\Http\Controllers\seller;

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
use App\Traits\MailerTraits;
use App\User;


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
    
        public function index(Request $request)
    {
       
        $records=DB::table('seller_documents')->orderBy('seller_documents.id','desc');

         if (!empty($request->search)) {
         $term=$request->search;
$records=$records
->where(function($q) use ($term) {
$q
        ->orWhere('seller_documents.document_name','like','%' . $term . '%');
    });
}

         $records= $records
         ->where('user_id',$this->user_id)
        ->paginate(25);



         $use = DB::table('seller_documents')  
                    ->select('document_name','id')        
   
            ->orderBy('document_name', 'asc')->get(); 

 $seller_documents = array();
foreach($use as $user) {
$seller_documents[$user->document_name] = $user->document_name;
}



 $record=DB::table('seller_documents')
        ->where('user_id',$this->user_id)
        ->pluck('document_name','document_name')->toarray();
// dd($record);

  $documents = DB::table('documents')  
            ->select('document_name','id')
             ->where('status','Active')
             ->where('document_for','Store')
    ->whereNotIn('document_name', $record)->count(); 


// dd($documents);

return view('seller.seller_document.index',compact('records','seller_documents','documents'));
   
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

         return view('seller.seller_document.create',compact('documents'));
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
                 

$users=User::find($this->user_id);

$enquiry=[];
$enquiry['name']=$users->name;
$enquiry['email']=$users->email;
$enquiry['message']='Dear '.$users->name.' your attach  document '.$request->document_name.' is Waiting for Approval';
$enquiry['subject']='Mandeclan '.$request->document_name.' Document Are Pending';


$status=$this->UserStatusUpdate($enquiry);

// dd($status);

$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('seller/seller-document')->with($notification);

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

        return view('seller.seller_document.show',compact('view'));
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
         ->where('user_id',$this->user_id)
         ->where('document_name','<>',$record->document_name)
         ->pluck('document_name','document_name')->toarray();


        $documents = DB::table('documents')  
                    ->select('document_name','id')
                     ->where('status','Active')
                          ->where('document_for','Store')
                     ->whereNotIn('document_name', $records)
            ->orderBy('document_name', 'asc')->pluck('document_name','document_name'); 


         return view('seller.seller_document.edit',compact('record','documents'));

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

           
   $users=User::find($this->user_id);

                              $enquiry=[];
$enquiry['name']=$users->name;
$enquiry['email']=$users->email;
$enquiry['message']='Dear '.$users->name.' your attach  document '.$request->document_name.' is  Pending by admin at '.date('d-m-Y H-m-s',strtotime(Carbon::now()));
$enquiry['subject']='Mandeclan Document '.$request->document_name.' Document Are Pending By Admin';


$status=$this->UserStatusUpdate($enquiry);



$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('seller/seller-document')->with($notification);
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

          return $seller_documents;
    }

     public function status_update(Request $request){
 
         $record=seller_document::find($request->user_id);
      
          if($record['status']=='Active'){
               $updatevender=\DB::table('seller_documents')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);
            return json_encode('Deactive');
           } else {
              $updateuser=\DB::table('seller_documents')->where('id',$request->user_id)
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
}
