<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\service_category;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;
use Image;
use File;

class service_categoryController extends Controller
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
       
        $records=DB::table('service_categories')->orderBy('id','desc');

         if (!empty($request->search)) {
        $term=$request->search;
$records=$records
->where(function($q) use ($term) {
$q
        ->orWhere('category_name','like','%' . $term . '%')
                ->orWhere('category_title','like','%' . $term . '%');
            });
}

         $records= $records
        ->paginate(25);



         $use = DB::table('service_categories')  
                    ->select('category_name','id')        
   
            ->orderBy('category_name', 'asc')->get(); 

 $service_categorys = array();
foreach($use as $user) {
$service_categorys[$user->category_name] = $user->category_name;
}

//  DB::table('count_masters')
// ->where('id','1')
// ->update([
// 'state_count'=>$count,
// ]);

return view('admin.service_category.index',compact('records','service_categorys'));
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $record='';

         return view('admin.service_category.create',compact('record'));
    }

    /**
     * service a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        if($request->hasFile('category_img'))
  
        {       
     $file = $request->file('category_img');
     $extension = $request->file('category_img')->getClientOriginalExtension();
     $category_img = date('d_m_Y_h_i_s',time()) . '1.' . $extension;

         $destinationPaths = base_path().'/public/images/category_img';

  $thumb_img =Image::make($file->getRealPath())->orientate()->resize(300, 250);
  
     $thumb_img->save($destinationPaths.'/'.$category_img,80);


      }       
        else{
            $category_img = "";
        }



  if($request->hasFile('category_thumbnail_img'))
  
        {       
     $file = $request->file('category_thumbnail_img');
     $extension = $request->file('category_thumbnail_img')->getClientOriginalExtension();
     $category_thumbnail_img = date('d_m_Y_h_i_s',time()) . '2.' . $extension;

         $destinationPaths = base_path().'/public/images/category_thumbnail_img';

  $thumb_img =Image::make($file->getRealPath())->orientate()->resize(90, 60);
  
     $thumb_img->save($destinationPaths.'/'.$category_thumbnail_img,80);


      }       
        else{
            $category_thumbnail_img = "";
        }



$data = array(
'category_name'=>$request->input('category_name'),
'category_title'=>$request->input('category_title'),
'category_img'=>$category_img,
'category_thumbnail_img'=>$category_thumbnail_img,
'category_url'=>str_replace(' ','-',strtolower($request->category_name)),

);
         $service_category = new service_category($data);
         $service_category->save();
                 
DB::table('service_categories')
->where('id',$service_category->id)
->update([

'sort'=>$service_category->id,
]);


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/service-category')->with($notification);

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

        return view('admin.service_category.show',compact('view'));
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
        $record = service_category::find($id);         
        
         return view('admin.service_category.edit',compact('record'));

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
        
        $service_category = service_category::find($id); 

   if($request->hasFile('category_img'))
  
        {       
     $file = $request->file('category_img');
     $extension = $request->file('category_img')->getClientOriginalExtension();
     $category_img = date('d_m_Y_h_i_s',time()) . '1.' . $extension;

         $destinationPaths = base_path().'/public/images/category_img';

  $thumb_img =Image::make($file->getRealPath())->orientate()->resize(300, 250);
  
     $thumb_img->save($destinationPaths.'/'.$category_img,80);


      }       
        else{
            $category_img = $service_category->category_img;
        }



  if($request->hasFile('category_thumbnail_img'))
  
        {       
     $file = $request->file('category_thumbnail_img');
     $extension = $request->file('category_thumbnail_img')->getClientOriginalExtension();
     $category_thumbnail_img = date('d_m_Y_h_i_s',time()) . '2.' . $extension;

         $destinationPaths = base_path().'/public/images/category_thumbnail_img';

  $thumb_img =Image::make($file->getRealPath())->orientate()->resize(90, 60);
  
     $thumb_img->save($destinationPaths.'/'.$category_thumbnail_img,80);


      }       
        else{
            $category_thumbnail_img = $service_category->category_thumbnail_img;
        }



   $data = array(
    'category_name'=>$request->input('category_name'),
    'category_img'=>$category_img,
 'category_thumbnail_img'=>$category_thumbnail_img,
 'category_title'=>$request->input('category_title'),
'category_url'=>str_replace(' ','-',strtolower($request->category_name)),

);
         $service_category->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/service-category')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
         $service_category = service_category::find($request->id);
          $service_category->delete();

          return $service_category;
    }

     public function status_update(Request $request){
 
         $record=service_category::find($request->user_id);
      
          if($record['status']=='Active'){
               $updatevender=\DB::table('service_categories')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);
            return json_encode('Deactive');
           } else {
              $updateuser=\DB::table('service_categories')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Active',
                                // 'updated_at' => date('Y-m-d H:i:s') 
                                 ]);
              return json_encode("Active");

        }
           }

    public function check_service_category(Request $request)
    {

        // return $request->checkservice_category;
        
      if(!empty($request->check_service_category)){

        $record = service_category::where('category_name', $request->check_service_category)->first();

         if(!empty($record)){
            return "exist";
         }else{
            return "notexist";
         }
      }
      if(!empty($request->check_category_edit)){

        $record = service_category::where('category_name', $request->check_category_edit)->get();

         if(count($record) <=1){
            return "notexist";
         }else{
            return "exist";
         }
      }
  }
}
