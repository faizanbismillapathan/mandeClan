<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\push_notification;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;
use App\Notifications\OfferPushNotifications;
use Illuminate\Support\Facades\Notification;
use DotenvEditor;
use App\User;


// use NotificationChannels\OneSignal\OneSignalChannel;
// use NotificationChannels\OneSignal\OneSignalMessage;
// use NotificationChannels\OneSignal\OneSignalWebButton;
// use Illuminate\Notifications\Notification;



class push_notificationController extends Controller
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
       
return view('admin.push_notification.index');
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $record='';

         return view('admin.push_notification.create',compact('record'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

         if(env('ONESIGNAL_APP_ID') =='' && env('ONESIGNAL_REST_API_KEY') == ''){
            // notify()->error('Please update onesignal keys in settings !','Keys not found !');
            // return back()->withInput();
             $notification = array(
    'message' => 'Please update onesignal keys in settings !','Keys not found !', 
    'alert-type' => 'success'
);

return Redirect::to('admin/push-notification')->with($notification);

        }

        try {

            $usergroup = User::query();

            $data = [
                'subject' => $request->subject,
                'body' => $request->message,
                'target_url' => $request->target_url ?? null,
                'icon' => $request->icon ?? null,
                'image' => $request->image ?? null,
                'show_button' => $request->show_button ? "yes" : "no",
                'button_text' => $request->btn_text ?? null,
                'button_url' => $request->btn_url ?? null,
            ];

            if ($request->user_group == 'all_customers') {

                $users = $usergroup->select('id')->where('role', '=', '3')->get();

            } elseif ($request->user_group == 'all_sellers') {

                $users = $usergroup->select('id')->where('role', '=', '2')->get();

            } elseif ($request->user_group == 'all_admins') {

                $users = $usergroup->select('id')->where('role', '=', '1')->get();

            } else {
                // all users
                $users = $usergroup->select('id')->get();
            }

            $users = $usergroup->select('id')->get();

            Notification::send($users, new OfferPushNotifications($data));

          
            $notification = array(
    'message' => 'Notification pushed successfully !', 
    'alert-type' => 'success'
);

return Redirect::to('admin/push-notification')->with($notification);



        } catch (\Exception $e) {

            // notify()->error($e->getMessage());
            return $e;

        }

$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/push-notification')->with($notification);

    }



 public function updateKeys(Request $request){

        $env_keys_save = DotenvEditor::setKeys([
            'ONESIGNAL_APP_ID' => $request->ONESIGNAL_APP_ID,
            'ONESIGNAL_REST_API_KEY' => $request->ONESIGNAL_REST_API_KEY
        ]);

        $env_keys_save->save();

      
$notification = array(
    'message' => 'Keys updated successfully !', 
    'alert-type' => 'success'
);

return Redirect::back()->with($notification);
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

        return view('admin.push_notification.show',compact('view'));
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
        $record = push_notification::find($id);         
        
         return view('admin.push_notification.edit',compact('record'));

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
        
        $push_notification = push_notification::find($id); 

   $data = array(
    'push_notification_name'=>$request->input('push_notification_name'),
    
);
         $push_notification->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/push-notification')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
         $push_notification = push_notification::find($request->id);
          $push_notification->delete();

          return $push_notification;
    }

     public function status_update(Request $request){
 
         $record=push_notification::find($request->user_id);
      
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
