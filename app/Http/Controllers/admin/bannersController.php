<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\banner;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;
use Image;
use File;
class bannersController extends Controller
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
       
        $records=DB::table('banners')->orderBy('id','desc');

         if (!empty($request->search)) {
        $term=$request->search;
$records=$records
->where(function($q) use ($term) {
$q
        ->orWhere('banner_img','like','%' . $term . '%');
    });
}

         $records= $records
        ->paginate(25);



       

return view('admin.banners.index',compact('records'));
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $record='';

         return view('admin.banners.create',compact('record'));
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

         if($request->hasFile('banner_app_img'))
  
        {       
     $file = $request->file('banner_app_img');
     $extension = $request->file('banner_app_img')->getClientOriginalExtension();
     $banner_app_img = date('d_m_Y_h_i_s',time()) . 'app.' . $extension;

         $destinationPaths = base_path().'/public/images/banners';

         $file->move($destinationPaths, $banner_app_img);

      }       
        else{
            $banner_app_img = "";
        }



         if($request->hasFile('banner_web_img'))
  
        {       
     $file = $request->file('banner_web_img');
     $extension = $request->file('banner_web_img')->getClientOriginalExtension();
     $banner_web_img = date('d_m_Y_h_i_s',time()) . 'web.' . $extension;

         $destinationPaths = base_path().'/public/images/banners';

         $file->move($destinationPaths, $banner_web_img);

      }       
        else{
            $banner_web_img = "";
        }




         $data = array(
    'banner_app_img'=>$banner_app_img,
    'banner_web_img'=>$banner_web_img,

);
         $banner = new banner($data);
         $banner->save();
                 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/banners')->with($notification);

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

        return view('admin.banners.show',compact('view'));
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
        $record = banner::find($id);         
        
         return view('admin.banners.edit',compact('record'));

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
        
        $banner = banner::find($id); 


if($request->hasFile('banner_app_img'))
  
        {       
     $file = $request->file('banner_app_img');
     $extension = $request->file('banner_app_img')->getClientOriginalExtension();
     $banner_app_img = date('d_m_Y_h_i_s',time()) . 'app.' . $extension;

         $destinationPaths = base_path().'/public/images/banners';

         $file->move($destinationPaths, $banner_app_img);

      }       
        else{
            $banner_app_img = $banner->banner_app_img;
        }



         if($request->hasFile('banner_web_img'))
  
        {       
     $file = $request->file('banner_web_img');
     $extension = $request->file('banner_web_img')->getClientOriginalExtension();
     $banner_web_img = date('d_m_Y_h_i_s',time()) . 'web.' . $extension;

         $destinationPaths = base_path().'/public/images/banners';

         $file->move($destinationPaths, $banner_web_img);

      }       
        else{
            $banner_web_img = $banner->banner_web_img;
        }




   $data = array(
  'banner_app_img'=>$banner_app_img,
    'banner_web_img'=>$banner_web_img,
    
);
         $banner->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/banners')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
         $banner = banner::find($request->id);
          $banner->delete();

          return $banner;
    }

     public function status_update(Request $request){
 
         $record=banner::find($request->user_id);
      
          if($record['status']=='Active'){
               $updatevender=\DB::table('banners')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);
            return json_encode('Deactive');
           } else {
              $updateuser=\DB::table('banners')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Active',
                                // 'updated_at' => date('Y-m-d H:i:s') 
                                 ]);
              return json_encode("Active");

        }
           }

    public function check_banner_img(Request $request)
    {

        
      if(!empty($request->check_name)){

        $record = banner::where('banner_img', $request->check_name)->first();

         if(!empty($record)){
            return "exist";
         }else{
            return "notexist";
         }
      }

      if(!empty($request->check_name_edit)){

        $record = banner::where('banner_img', $request->check_name_edit)->get();

         if(count($record) <=1){
            return "notexist";
         }else{
            return "exist";
         }
      }
  }
}
