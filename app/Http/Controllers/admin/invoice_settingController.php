<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\invoice_setting;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;
use Image;
use File;
class invoice_settingController extends Controller
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
       
        $record = invoice_setting::find(1);         


return view('admin.invoice_setting.index',compact('record'));
   
    }

 
    public function store(Request $request)
    {
        // dd($request);

     if($request->hasFile('invoice_logo'))
  
        {       
     $file = $request->file('invoice_logo');
     $extension = $request->file('invoice_logo')->getClientOriginalExtension();
     $invoice_logo = date('d_m_Y_h_i_s',time()) . '1.' . $extension;

         $destinationPaths = base_path().'/public/images/invoice_setting';

  $thumb_img =Image::make($file->getRealPath())->orientate()->resize(100, 100);
  
     $thumb_img->save($destinationPaths.'/'.$invoice_logo,80);


      }       
        else{
            $invoice_logo = "";
        }


         if($request->hasFile('invoice_signature'))
  
        {       
     $file = $request->file('invoice_signature');
     $extension = $request->file('invoice_signature')->getClientOriginalExtension();
     $invoice_signature = date('d_m_Y_h_i_s',time()) . '2.' . $extension;

         $destinationPaths = base_path().'/public/images/invoice_setting';

  $thumb_img =Image::make($file->getRealPath())->orientate()->resize(100, 100);
  
     $thumb_img->save($destinationPaths.'/'.$invoice_signature,80);


      }       
        else{
            $invoice_signature = "";
        }
         $data = array(
   'order_id_prefix'=>$request->input('order_id_prefix'),
'order_id_postfix'=>$request->input('order_id_postfix'),
'suborder_id_prefix'=>$request->input('suborder_id_prefix'),
'suborder_id_postfix'=>$request->input('suborder_id_postfix'),
'invoice_terms'=>$request->input('invoice_terms'),
'invoice_logo'=>$invoice_logo,
'invoice_signature'=>$invoice_signature,
    
);
         $invoice_setting = new invoice_setting($data);
         $invoice_setting->save();
                 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/invoice-setting')->with($notification);

    }

  

    public function update(Request $request, $id)
    {
        
        $invoice_setting = invoice_setting::find($id); 


  if($request->hasFile('invoice_logo'))
  
        {       
     $file = $request->file('invoice_logo');
     $extension = $request->file('invoice_logo')->getClientOriginalExtension();
     $invoice_logo = date('d_m_Y_h_i_s',time()) . '1.' . $extension;

         $destinationPaths = base_path().'/public/images/invoice_setting';

  $thumb_img =Image::make($file->getRealPath())->orientate()->resize(100, 100);
  
     $thumb_img->save($destinationPaths.'/'.$invoice_logo,80);


      }       
        else{
            $invoice_logo = $invoice_setting->invoice_logo;
        }


         if($request->hasFile('invoice_signature'))
  
        {       
     $file = $request->file('invoice_signature');
     $extension = $request->file('invoice_signature')->getClientOriginalExtension();
     $invoice_signature = date('d_m_Y_h_i_s',time()) . '2.' . $extension;

         $destinationPaths = base_path().'/public/images/invoice_setting';

  $thumb_img =Image::make($file->getRealPath())->orientate()->resize(100, 100);
  
     $thumb_img->save($destinationPaths.'/'.$invoice_signature,80);


      }       
        else{
            $invoice_signature = $invoice_setting->invoice_signature;
        }

   $data = array(
'order_id_prefix'=>$request->input('order_id_prefix'),
'order_id_postfix'=>$request->input('order_id_postfix'),
'suborder_id_prefix'=>$request->input('suborder_id_prefix'),
'suborder_id_postfix'=>$request->input('suborder_id_postfix'),
'invoice_terms'=>$request->input('invoice_terms'),
'invoice_logo'=>$invoice_logo,
'invoice_signature'=>$invoice_signature,
    
);
         $invoice_setting->update($data);

           

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('admin/invoice-setting')->with($notification);
    }

    
}
