<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\term_condition;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;

class term_conditionController extends Controller
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
       
       $records=DB::table('term_conditions')->paginate(10);


return view('admin.term_condition.index',compact('records'));
   
    }

     public function create()
    {
         $roles = DB::table('roles')  
                    ->select('role_name','id')
                     ->where('status','Active')
            ->orderBy('role_name', 'asc')->pluck('role_name','role_name'); 

         return view('admin.term_condition.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

         $data = array(
    'title'=>$request->input('title'),
    'description'=>$request->input('description'),
    'role'=>$request->input('role'),
    
);
         $term_condition = new term_condition($data);
         $term_condition->save();
                 

$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/term-condition')->with($notification);

    }

 
  public function edit($id)
    {
        // dd($id);
        $roles = DB::table('roles')  
                    ->select('role_name','id')
                     ->where('status','Active')
            ->orderBy('role_name', 'asc')->pluck('role_name','role_name'); 


// dd($roles);

        $record = term_condition::find($id);         
        
         return view('admin.term_condition.edit',compact('record','roles'));

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
        
        $term_condition = term_condition::find($id); 

     $data = array(
    'title'=>$request->input('title'),
    'description'=>$request->input('description'),
    'role'=>$request->input('role'),
    );

         $term_condition->update($data);

          

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/term-condition')->with($notification);
    }

  

     public function destroy(Request $request)
    {
      
         $term_condition = term_condition::find($request->id);
          $term_condition->delete();

          return $term_condition;
    }



}
