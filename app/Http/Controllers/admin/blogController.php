<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\blog;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;
use Image;
use File;

class blogController extends Controller
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
       
        $records=DB::table('blogs')->orderBy('id','desc');

         if (!empty($request->search)) {
        $term=$request->search;
$records=$records
->where(function($q) use ($term) {
$q
        ->orWhere('blog_heading','like','%' . $term . '%')
        ->orWhere('blog_description','like','%' . $term . '%')
        ->orWhere('author_name','like','%' . $term . '%')
        ->orWhere('status','like','%' . $term . '%');
    });

}

         $records= $records
        ->paginate(25);



         $use = DB::table('blogs')  
                    ->select('blog_heading','id')        
   
            ->orderBy('blog_heading', 'asc')->get(); 

 $blogs = array();
foreach($use as $user) {
$blogs[$user->blog_heading] = $user->blog_heading;
}

//  DB::table('count_masters')
// ->where('id','1')
// ->update([
// 'state_count'=>$count,
// ]);

return view('admin.blog.index',compact('records','blogs'));
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $record='';

         return view('admin.blog.create',compact('record'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($blog_image);

        if($request->hasFile('blog_image'))
  
        {       
     $file = $request->file('blog_image');
     $extension = $request->file('blog_image')->getClientOriginalExtension();
     $blog_image = date('d_m_Y_h_i_s',time()) . '1.' . $extension;

         $destinationPaths = base_path().'/public/images/blog_image';

  $thumb_img =Image::make($file->getRealPath())->orientate()->resize(100, 100);
  
     $thumb_img->save($destinationPaths.'/'.$blog_image,80);


      } 
       else{
            $blog_image = "";
        }


         $data = array(
    'blog_heading'=>$request->input('blog_heading'),
    'author_name'=>$request->input('author_name'),
    'author_designation'=>$request->input('author_designation'),
    'blog_image'=>$blog_image,
    'blog_description'=>$request->input('blog_description'),
    'about_author'=>$request->input('about_author'),
    
);
         $blog = new blog($data);
         $blog->save();
                 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/blog')->with($notification);

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

        return view('admin.blog.show',compact('view'));
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
        $record = blog::find($id);         
        
         return view('admin.blog.edit',compact('record'));

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
        
        $blog = blog::find($id); 

     if($request->hasFile('blog_image'))
  
        {       
     $file = $request->file('blog_image');
     $extension = $request->file('blog_image')->getClientOriginalExtension();
     $blog_image = date('d_m_Y_h_i_s',time()) . '1.' . $extension;

         $destinationPaths = base_path().'/public/images/blog_image';

  $thumb_img =Image::make($file->getRealPath())->orientate()->resize(100, 100);
  
     $thumb_img->save($destinationPaths.'/'.$blog_image,80);


      } 
       else{
            $blog_image = $blog->blog_image;
        }
        

         $data = array(
    'blog_heading'=>$request->input('blog_heading'),
    'author_name'=>$request->input('author_name'),
    'author_designation'=>$request->input('author_designation'),
    'blog_image'=>$blog_image,
    'blog_description'=>$request->input('blog_description'),
    'about_author'=>$request->input('about_author'),
    
);    $blog->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/blog')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
         $blog = blog::find($request->id);
          $blog->delete();

          return $blog;
    }

     public function status_update(Request $request){
 
         $record=blog::find($request->user_id);
      
          if($record['status']=='Active'){
               $updatevender=\DB::table('blogs')->where('id',$request->user_id)
                              ->update([
                                'status' => 'Deactive',
                                 ]);
            return json_encode('Deactive');
           } else {
              $updateuser=\DB::table('blogs')->where('id',$request->user_id)
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

        $record = blog::where('blog_heading', $request->check_unique_name)->first();

         if(!empty($record)){
            return "exist";
         }else{
            return "notexist";
         }
      }
      if(!empty($request->check_unique_name_edit)){

        $record = blog::where('blog_heading', $request->check_unique_name_edit)->get();

         if(count($record) <=1){
            return "notexist";
         }else{
            return "exist";
         }
      }
  }
}
