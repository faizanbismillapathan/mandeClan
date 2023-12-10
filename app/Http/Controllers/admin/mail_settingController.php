<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;
use DotenvEditor;


class mail_settingController extends Controller
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

       
return view('admin.mail_setting.index');
   
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

                $input = $request->all();

           $env_keys_save = DotenvEditor::setKeys([

            'MAIL_FROM_NAME' => $input['MAIL_FROM_NAME'],
            'MAIL_DRIVER' => $input['MAIL_DRIVER'],
            'MAIL_FROM_ADDRESS' => $input['MAIL_FROM_ADDRESS'],
            'MAIL_HOST' => $input['MAIL_HOST'],
            'MAIL_PORT' => $input['MAIL_PORT'],
            'MAIL_USERNAME' => $input['MAIL_USERNAME'],
            'MAIL_PASSWORD' => $input['MAIL_PASSWORD'],
            'MAIL_ENCRYPTION' => $input['MAIL_ENCRYPTION'],

        ]);

        $env_keys_save->save();

                 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/mail-setting')->with($notification);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    
    public function update(Request $request, $id)
    {
        
    

return Redirect::to('admin/mail-setting')->with($notification);

    }

   

     public function status_update(Request $request){
 
         $record=mail::find($request->user_id);
      
          if($record['status']=='Active'){
               $updatevender=\DB::table('countries')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);
            return json_encode('Deactive');
           } else {
              $updateuser=\DB::table('countries')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Active',
                                // 'updated_at' => date('Y-m-d H:i:s') 
                                 ]);
              return json_encode("Active");

        }
           }

}
