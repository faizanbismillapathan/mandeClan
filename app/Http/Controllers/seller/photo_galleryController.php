<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\store_photo_gallery;
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
       
        $records=DB::table('store_photo_galleries')->orderBy('store_photo_galleries.id','desc');

         if (!empty($request->search)) {
        $term=$request->search;
$records=$records
->where(function($q) use ($term) {
$q
        ->orWhere('store_photo_galleries.gallery_img','like','%' . $term . '%');
    });
}
         $records= $records
         ->where('store_photo_galleries.store_user_id',$this->user_id)
        ->paginate(25);



        

return view('seller.store_photo_gallery.index',compact('records'));
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

         return view('seller.store_photo_gallery.create');
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

         
        if($request->hasFile('gallery_img'))
        {       
             $file = $request->file('gallery_img');
             $extension = $request->file('gallery_img')->getClientOriginalExtension();
     $gallery_img = date('d_m_Y_h_i_s',time()) . '1.' . $extension;
             $destinationPaths = base_path().'/public/images/store_photo_gallery';
             // dd($destinationPath);
             // $file->move($destinationPath,$gallery_img);

               $thumb_img =Image::make($file->getRealPath())->orientate()->resize(350, 350);
  
     $thumb_img->save($destinationPaths.'/'.$gallery_img,80);
        }        
        else{
            $gallery_img = "";
        }



$data = array(
'store_id'=>$this->id,
'store_user_id'=>$this->user_id,
'gallery_img'=>$gallery_img,

);
         $store_photo_gallery = new store_photo_gallery($data);
         $store_photo_gallery->save();
                 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('seller/photo-gallery')->with($notification);

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

        return view('seller.store_photo_gallery.show',compact('view'));
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
        $record = store_photo_gallery::find($id);         
        
  


         return view('seller.store_photo_gallery.edit',compact('record'));

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
        
        $store_photo_galleries = store_photo_gallery::find($id); 

   if($request->hasFile('gallery_img'))
  
        {       
     $file = $request->file('gallery_img');
     $extension = $request->file('gallery_img')->getClientOriginalExtension();
     $gallery_img = date('d_m_Y_h_i_s',time()) . '1.' . $extension;

         $destinationPaths = base_path().'/public/images/store_photo_gallery';

   $thumb_img =Image::make($file->getRealPath())->orientate()->resize(350, 350);
  
     $thumb_img->save($destinationPaths.'/'.$gallery_img,80);

      }       
        else{
            $gallery_img = $store_photo_galleries->gallery_img;
        }

$data = array(
'gallery_img'=>$gallery_img,

);
         $store_photo_galleries->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('seller/photo-gallery')->with($notification);
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

         $store_photo_galleries = store_photo_gallery::find($request->id);
          $store_photo_galleries->delete();

    }

     public function status_update(Request $request){
 
         $record=store_photo_gallery::find($request->user_id);
      
          if($record['status']=='Active'){
               $updatevender=\DB::table('store_photo_galleries')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);
            return json_encode('Deactive');
           } else {
              $updateuser=\DB::table('store_photo_galleries')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Active',
                                // 'updated_at' => date('Y-m-d H:i:s') 
                                 ]);
              return json_encode("Active");

        }
           }


}
