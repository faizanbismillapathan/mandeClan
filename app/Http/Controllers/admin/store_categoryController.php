<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\store_category;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;
use Image;
use File;

class store_categoryController extends Controller
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
       
        $records=DB::table('store_categories')->orderBy('id','desc');

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



         $use = DB::table('store_categories')  
                    ->select('category_name','id')        
   
            ->orderBy('category_name', 'asc')->get(); 

 $store_categorys = array();
foreach($use as $user) {
$store_categorys[$user->category_name] = $user->category_name;
}

//  DB::table('count_masters')
// ->where('id','1')
// ->update([
// 'state_count'=>$count,
// ]);

return view('admin.category.index',compact('records','store_categorys'));
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $record='';

         return view('admin.category.create',compact('record'));
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
         $store_category = new store_category($data);
         $store_category->save();
                 
DB::table('store_categories')
->where('id',$store_category->id)
->update([

'sort'=>$store_category->id,
]);


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/store-category')->with($notification);

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

        return view('admin.category.show',compact('view'));
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
        $record = store_category::find($id);         
        
         return view('admin.category.edit',compact('record'));

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
        
        $store_category = store_category::find($id); 

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
            $category_img = $store_category->category_img;
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
            $category_thumbnail_img = $store_category->category_thumbnail_img;
        }



   $data = array(
    'category_name'=>$request->input('category_name'),
    'category_img'=>$category_img,
 'category_thumbnail_img'=>$category_thumbnail_img,
 'category_title'=>$request->input('category_title'),
'category_url'=>str_replace(' ','-',strtolower($request->category_name)),

);
         $store_category->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/store-category')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
         $store_category = store_category::find($request->id);
          $store_category->delete();

          return $store_category;
    }

     public function status_update(Request $request){
 
         $record=store_category::find($request->user_id);
      
          if($record['status']=='Active'){
               $updatevender=\DB::table('store_categories')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);
            return json_encode('Deactive');
           } else {
              $updateuser=\DB::table('store_categories')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Active',
                                // 'updated_at' => date('Y-m-d H:i:s') 
                                 ]);
              return json_encode("Active");

        }
           }

    public function check_store_category(Request $request)
    {

        // return $request->checkstore_category;
        
      if(!empty($request->check_store_category)){

        $record = store_category::where('category_name', $request->check_store_category)->first();

         if(!empty($record)){
            return "exist";
         }else{
            return "notexist";
         }
      }
      if(!empty($request->check_category_edit)){

        $record = store_category::where('category_name', $request->check_category_edit)->get();

         if(count($record) <=1){
            return "notexist";
         }else{
            return "exist";
         }
      }
  }
}
