<?php

namespace App\Http\Controllers\servicepartner;

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


class documentController extends Controller
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

// dd(!in_array($uspermit->role, array(1,4)));

          if ( !in_array($uspermit->role, array('1','4'), false ) ) {

// dd('1');
              return redirect()->action('frontend\frontendController@index'); 

          }else{

            if($uspermit->role == '1' && empty(Session::get('servicepartner_id'))){

// dd('2');
              return redirect()->action('frontend\frontendController@index'); 

          }

      }
       

        if (\auth::user()->role == "4") {
      $servicepartner_id=db::table('rv_user_registrations')
             ->where('user_id',\Auth::user()->id)
             ->select('id','user_id')
             ->first();

            $this->id=$servicepartner_id->id; 
$this->user_id=$servicepartner_id->user_id;  

   }elseif (\auth::user()->role == "1") {

                    $this->id=session::get('servicepartner_id');
 $this->user_id=session::get('servicepartner_user_id');
}

      return $next($request);
  });

    }
    
        public function index(Request $request)
    {
       
        $records=DB::table('rv_documents')->orderBy('rv_documents.id','desc');

         if (!empty($request->search)) {
         $term=$request->search;
$records=$records
->where(function($q) use ($term) {
$q
        ->orWhere('rv_documents.document_name','like','%' . $term . '%');
    });
}

         $records= $records
         ->where('user_id',$this->user_id)
        ->paginate(25);



         $use = DB::table('rv_documents')  
                    ->select('document_name','id')        
   
            ->orderBy('document_name', 'asc')->get(); 

 $rv_documents = array();
foreach($use as $user) {
$rv_documents[$user->document_name] = $user->document_name;
}

//  DB::table('count_masters')
// ->where('id','1')
// ->update([
// 'state_count'=>$count,
// ]);

return view('servicepartner.document.index',compact('records','rv_documents'));
   
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


  $documents = DB::table('documents')  
            ->select('document_name','id')
             ->where('status','Active')
                  ->where('document_for','Rider')
    ->whereNotIn('document_name', $records)->pluck('document_name','document_name'); 

    
         return view('servicepartner.document.create',compact('documents'));
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

return Redirect::to('service-partner/document')->with($notification);

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

        return view('servicepartner.document.show',compact('view'));
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
        
        // $documents = DB::table('documents')  
        //             ->select('document_name','id')
        //              ->where('status','Active')
        //     ->orderBy('document_name', 'asc')->pluck('document_name','document_name'); 

   $records=DB::table('rv_documents')
         ->where('user_id',$this->user_id)
         ->where('document_name','<>',$record->document_name)
         ->pluck('document_name','document_name')->toarray();


        $documents = DB::table('documents')  
                    ->select('document_name','id')
                     ->where('status','Active')
                       ->where('document_for','Rider')
                     ->whereNotIn('document_name', $records)
            ->orderBy('document_name', 'asc')->pluck('document_name','document_name'); 



         return view('servicepartner.document.edit',compact('record','documents'));

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

);
         $rv_documents->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('service-partner/document')->with($notification);
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

     public function status_update(Request $request){
 
         $record=rv_document::find($request->user_id);
      
          if($record['status']=='Active'){
               $updatevender=\DB::table('rv_documents')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);
            return json_encode('Deactive');
           } else {
              $updateuser=\DB::table('rv_documents')->where('id',$request->user_id)
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
