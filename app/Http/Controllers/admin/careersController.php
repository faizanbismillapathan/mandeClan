<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\career;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;
use App\Traits\MailerTraits;

class careersController extends Controller
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
       
        

        $records=DB::table('careers')->orderBy('id','desc');

         if (!empty($request->search)) {
        $term=$request->search;
$records=$records
->where(function($q) use ($term) {
$q
        ->orWhere('mobile_no','like','%' . $term . '%')
        ->orWhere('email','like','%' . $term . '%')
        ->orWhere('message','like','%' . $term . '%')
        ->orWhere('name','like','%' . $term . '%');
    });
}

         $records= $records
        ->paginate(25);




//  DB::table('count_masters')
// ->where('id','1')
// ->update([
// 'state_count'=>$count,
// ]);

return view('admin.careers.index',compact('records'));
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $record='';

         return view('admin.careers.create',compact('record'));
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
    'name'=>$request->input('name'),
    'mobile_no'=>$request->input('mobile_no'),
    
);
         $career = new career($data);
         $career->save();
                 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/careers')->with($notification);

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

        return view('admin.careers.show',compact('view'));
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
        $record = career::find($id);         
        
         return view('admin.careers.edit',compact('record'));

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
        
        $career = career::find($id); 

   $data = array(
    'name'=>$request->input('name'),
    'mobile_no'=>$request->input('mobile_no'),
    
);

   // dd($data);

         $career->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/careers')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
         $career = career::find($request->id);
          $career->delete();

          return $career;
    }

     public function status_update(Request $request){
 
         $updatevender=\DB::table('careers')->where('id',$request->user_id)
                              ->update([
                                'status' => $request->status,
                                 ]);



$enquiry1=career::find($request->user_id);

  
                    
$enquiry=[];
$enquiry['name']=$enquiry1->name;
$enquiry['category']=$enquiry1->apply_for;
$enquiry['updated_at']=$enquiry1->updated_at;
$enquiry['email']=$enquiry1->email;
$enquiry['status']=$enquiry1->status;
$enquiry['type']='Career';


$status=$this->BussinessStatusUpdate($enquiry);

    return json_encode($request->status);

           }

    public function check_unique_name(Request $request)
    {

        // return $request->checkunique_name;
        
      if(!empty($request->check_unique_name)){

        $record = career::where('name', $request->check_unique_name)->first();

         if(!empty($record)){
            return "exist";
         }else{
            return "notexist";
         }
      }
      if(!empty($request->check_unique_name_edit)){

        $record = career::where('name', $request->check_unique_name_edit)->get();

         if(count($record) <=1){
            return "notexist";
         }else{
            return "exist";
         }
      }
  }


   

}
