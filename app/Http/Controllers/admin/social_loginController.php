<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;
use DotenvEditor;

class social_loginController extends Controller
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
                     $this->config = config::first();

          return $next($request);
      });
    }
    
        public function index(Request $request)
    {
       
        $configs = config::first();

return view('admin.social_login.index',compact('configs'));
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $record='';

         return view('admin.social_login.create',compact('record'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd(Request $request);
         $data = array(
    'social_login_name'=>$request->input('social_login_name'),
    
);
         $social_login = new social_login($data);
         $social_login->save();
                 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/social-login')->with($notification);

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

        return view('admin.social_login.show',compact('view'));
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
        $record = social_login::find($id);         
        
         return view('admin.social_login.edit',compact('record'));

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
        
        $social_login = social_login::find($id); 

   $data = array(
    'social_login_name'=>$request->input('social_login_name'),
    
);
         $social_login->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/social-login')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
         $social_login = social_login::find($request->id);
          $social_login->delete();

          return $social_login;
    }

     public function status_update(Request $request){
 
         $record=social_login::find($request->user_id);
      
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

    public function check_unique_name(Request $request)
    {

        // return $request->checkunique_name;
        
      if(!empty($request->check_unique_name)){

        $record = social_login::where('social_login_name', $request->check_unique_name)->first();

         if(!empty($record)){
            return "exist";
         }else{
            return "notexist";
         }
      }
      if(!empty($request->check_unique_name_edit)){

        $record = social_login::where('social_login_name', $request->check_unique_name_edit)->get();

         if(count($record) <=1){
            return "notexist";
         }else{
            return "exist";
         }
      }
  }


  // ................................

   public function facebookSettings(Request $request)
    {

        $this->config->fb_login_enable = isset($request->fb_login_enable) ? 1 : 0;

        

        $env_keys_save =  DotenvEditor::setKeys([
            'FACEBOOK_CLIENT_ID' => $request->FACEBOOK_CLIENT_ID, 
            'FACEBOOK_CLIENT_SECRET' => $request->FACEBOOK_CLIENT_SECRET, 
            'FB_CALLBACK_URL' => $request->FB_CALLBACK_URL
        ]);

        $env_keys_save->save();

        $this->config->save();

        // notify()->success('Facebook Login Settings Updated !');

        
$notification = array(
    'message' => 'Facebook Login Settings Updated !', 
    'alert-type' => 'success'
);
        return back()->with($notification);

    }

    public function googleSettings(Request $request)
    {
      
        $this->config->google_login_enable = isset($request->google_login_enable) ? 1 : 0;

        $env_keys_save =  DotenvEditor::setKeys([
            'GOOGLE_CLIENT_ID' => $request->GOOGLE_CLIENT_ID, 
            'GOOGLE_CLIENT_SECRET' => $request->GOOGLE_CLIENT_SECRET, 
            'GOOGLE_CALLBACK_URL' => $request->GOOGLE_CALLBACK_URL
        ]);

        $env_keys_save->save();

        $this->config->save();

        // notify()->success('Google Login Settings Updated !');

        
$notification = array(
    'message' => 'Google Login Settings Updated !', 
    'alert-type' => 'success'
);
        return back()->with($notification);

    }

    public function twitterSettings(Request $request)
    {
    
        $this->config->twitter_enable = isset($request->twitter_enable) ? 1 : 0;

        $env_keys_save =  DotenvEditor::setKeys([
            'TWITTER_API_KEY' => $request->TWITTER_API_KEY, 
            'TWITTER_SECRET_KEY' => $request->TWITTER_SECRET_KEY, 
            'TWITTER_CALLBACK_URL' => $request->TWITTER_CALLBACK_URL
        ]);

        $env_keys_save->save();

        $this->config->save();

        // notify()->success('Twitter Login Settings Updated !');

        
$notification = array(
    'message' => 'Twitter Login Settings Updated !', 
    'alert-type' => 'success'
);
        return back()->with($notification);

    }

    public function amazonSettings(Request $request)
    {
    
        $this->config->amazon_enable = isset($request->amazon_enable) ? 1 : 0;

        $env_keys_save =  DotenvEditor::setKeys([
            'AMAZON_LOGIN_ID' => $request->AMAZON_LOGIN_ID, 
            'AMAZON_LOGIN_SECRET' => $request->AMAZON_LOGIN_SECRET, 
            'AMAZON_LOGIN_CALLBACK' => $request->AMAZON_LOGIN_CALLBACK
        ]);

        $env_keys_save->save();

        $this->config->save();

        // notify()->success('Amazon Login Settings Updated !');

        
$notification = array(
    'message' => 'Amazon Login Settings Updated !', 
    'alert-type' => 'success'
);
        return back()->with($notification);

    }

    public function linkedinSettings(Request $request)
    {
    
        $this->config->linkedin_enable = isset($request->linkedin_enable) ? 1 : 0;


        $env_keys_save =  DotenvEditor::setKeys([

            'LINKEDIN_CLIENT_ID' => $request->LINKEDIN_CLIENT_ID, 
            'LINKEDIN_SECRET' => $request->LINKEDIN_SECRET, 
            'LINKEDIN_CALLBACK' => $request->LINKEDIN_CALLBACK

        ]);

        $env_keys_save->save();

        $this->config->save();

        // notify()->success('Linkedin Login Settings Updated !');

        
$notification = array(
    'message' => 'Linkedin Login Settings Updated !', 
    'alert-type' => 'success'
);
        return back()->with($notification);

    }


      public function gitlabSettings(Request $request)
    {

        $env_keys_save =  DotenvEditor::setKeys([
            'GITLAB_CLIENT_ID' => $request->GITLAB_CLIENT_ID, 
            'GITLAB_CLIENT_SECRET' => $request->GITLAB_CLIENT_SECRET, 
            'GITLAB_CALLBACK_URL' => $request->GITLAB_CALLBACK_URL,
            'ENABLE_GITLAB' => isset($request->ENABLE_GITLAB) ? "1" : "0"
        ]);

        $env_keys_save->save();

        // notify()->success('Gitlab Settings has been saved');

        
$notification = array(
    'message' => 'Gitlab Settings has been saved', 
    'alert-type' => 'success'
);
        return back()->with($notification);

       
    }

}
