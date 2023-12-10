<?php

namespace App\Http\Controllers\service;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\service_photo_gallery;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;
use Image;
use File;


class photo_galleryController extends Controller
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



          if ( !in_array($uspermit->role, array('1','5'), false ) ) {

// dd('1');
              return redirect()->action('frontend\frontendController@index'); 

          }else{

            if($uspermit->role == '1'  && empty(session::get('service_id'))){

// dd('2');
              return redirect()->action('frontend\frontendController@index'); 

          }

      }

if (\Auth::user()->role == "5") {
      $service_id=DB::table('services')
             ->where('user_id',\Auth::user()->id)
             ->select('id','user_id','status','kyc_status')
             ->first();

              if ($service_id->kyc_status=='deactive') {
                 
              return redirect()->action('frontend\frontendcontroller@index'); 

             }
             $this->id=$service_id->id; 
$this->user_id=$service_id->user_id;  
            

   }elseif (\Auth::user()->role == "1") {

                    $this->id=session::get('service_id');
 $this->user_id=session::get('service_user_id');
}

return $next($request);
  });

    }
    
        public function index(Request $request)
    {
       
        $records=DB::table('service_photo_galleries')->orderBy('service_photo_galleries.id','desc');

         if (!empty($request->search)) {
         $records= $records
        ->orWhere('service_photo_galleries.gallery_img','like','%' . $request->search . '%');
}
         $records= $records
         ->where('service_photo_galleries.service_user_id',$this->user_id)
        ->paginate(25);



        

return view('service.service_photo_gallery.index',compact('records'));
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

         return view('service.service_photo_gallery.create');
    }

    /**
     * Service a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);

         
        if($request->hasFile('gallery_img'))
        {       
             $file = $request->file('gallery_img');
             $extension = $request->file('gallery_img')->getClientOriginalExtension();
     $gallery_img = date('d_m_Y_h_i_s',time()) . '1.' . $extension;
             $destinationPaths = base_path().'/public/images/service_photo_gallery';
             // dd($destinationPath);
             // $file->move($destinationPath,$gallery_img);

               $thumb_img =Image::make($file->getRealPath())->orientate()->resize(350, 350);
  
     $thumb_img->save($destinationPaths.'/'.$gallery_img,80);
        }        
        else{
            $gallery_img = "";
        }



$data = array(
'service_id'=>$this->id,
'service_user_id'=>$this->user_id,
'gallery_img'=>$gallery_img,

);
         $service_photo_gallery = new service_photo_gallery($data);
         $service_photo_gallery->save();
                 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('service/photo-gallery')->with($notification);

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

        return view('service.service_photo_gallery.show',compact('view'));
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
        $record = service_photo_gallery::find($id);         
        
  


         return view('service.service_photo_gallery.edit',compact('record'));

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
        
        $service_photo_galleries = service_photo_gallery::find($id); 

   if($request->hasFile('gallery_img'))
  
        {       
     $file = $request->file('gallery_img');
     $extension = $request->file('gallery_img')->getClientOriginalExtension();
     $gallery_img = date('d_m_Y_h_i_s',time()) . '1.' . $extension;

         $destinationPaths = base_path().'/public/images/service_photo_gallery';

   $thumb_img =Image::make($file->getRealPath())->orientate()->resize(350, 350);
  
     $thumb_img->save($destinationPaths.'/'.$gallery_img,80);

      }       
        else{
            $gallery_img = $service_photo_galleries->gallery_img;
        }

$data = array(
'gallery_img'=>$gallery_img,

);
         $service_photo_galleries->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('service/photo-gallery')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
                // return $request->id;

         $service_photo_galleries = service_photo_gallery::find($request->id);
          $service_photo_galleries->delete();

    }

     public function status_update(Request $request){
 
         $record=service_photo_gallery::find($request->user_id);
      
          if($record['status']=='Active'){
               $updatevender=\DB::table('service_photo_galleries')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);
            return json_encode('Deactive');
           } else {
              $updateuser=\DB::table('service_photo_galleries')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Active',
                                // 'updated_at' => date('Y-m-d H:i:s') 
                                 ]);
              return json_encode("Active");

        }
           }


}
