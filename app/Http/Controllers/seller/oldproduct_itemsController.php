<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\product;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;
use Image;
use File;
use Auth;
use App\product_item;
use App\item_attribut;



class oldproduct_itemsController extends Controller
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
       

       }


        public function show($id)
    {

        $record=store::find($id);
        Session::put('store_id',$id);
        Session::put('store_name',$record->store_name);
        Session::put('store_user_id',$record->user_id);



        return view('seller.dashboard.index',compact('record'));
    }


       public function itemsView($id)
    {


        Session::put('product_id',$id);


$record=DB::table('products')
	->orderBy('products.id','desc')
	->join('product_categories','product_categories.id','products.product_category')
	->join('product_subcategories','product_subcategories.id','products.product_subcategory')
	->where('products.id',$id)
	->select('products.product_name','product_categories.product_category','product_subcategories.product_subcategory','products.id')
	->first();




$records=DB::table('product_items')
    ->orderBy('product_items.id','desc')
    ->join('products','products.id','product_items.product_id')
    
    ->where('products.id',$id)
    ->select('product_items.*','products.product_name')
    ->paginate(15);

// dd($records);
        
        return view('seller.product_items.index',compact('record','records'));
    }


    public function create()
    {


  
         $autoincid = mt_rand(10,100);
         $Y = date('Ys');
         $keydata = 'Item'.$Y.''.$autoincid;

	$record=DB::table('products')
	->orderBy('products.id','desc')
	->join('product_categories','product_categories.id','products.product_category')
	->join('product_subcategories','product_subcategories.id','products.product_subcategory')
	->where('products.id',Session::get('product_id'))
	->select('products.product_name','product_categories.product_category','product_subcategories.product_subcategory','product_categories.id')
	->first();


// $attributs=DB::table('product_attributes')
// ->join('units','units.id','product_attributes.unit_id')
// ->join('unit_values','unit_values.unit_id','units.id')   
// // ->where('product_attributes.category_id',$record->product_category)
// ->whereRaw("find_in_set('1',product_attributes.category_id)")
// ->select('units.unit_title','unit_values.unit_value','unit_values.unit_short_code','product_attributes.category_id')
// ->get();

$attr=DB::table('product_attributes')
->whereRaw("find_in_set($record->id,product_attributes.category_id)")
->get();

$attributs=[];

foreach($attr as $index=>$data){
$attributs[]=[
'unit_name'=>$data->attr_name,
'unit_id'=>$data->unit_id,
'attr_id'=>$data->id,
'attribut_value'=>$this->attribut_function($data->unit_id),

];

}
	// dd($attributs);


        return view('seller.product_items.create',compact('keydata','record','attributs'));


    }


      public function attribut_function($id)
    {

$attributs=DB::table('unit_values')
->join('units','units.id','unit_values.unit_id')
->select('unit_values.unit_value','unit_values.unit_short_code','units.unit_title','unit_values.id')
->where('units.id',$id)
->get();

// dd($attributs);
return $attributs;

    }

      public function edit($id)
    {

        // product_categories

$record=product_item::find($id);

$record1=DB::table('products')
    ->orderBy('products.id','desc')
    ->join('product_categories','product_categories.id','products.product_category')
    ->where('products.id',Session::get('product_id'))
    ->select('products.product_name','product_categories.product_category','product_categories.id')
    ->first();


$attr=DB::table('product_attributes')
->whereRaw("find_in_set($record1->id,product_attributes.category_id)")
->get();

$attributs=[];

foreach($attr as $index=>$data){

$attributs[]=[
'unit_name'=>$data->attr_name,
'unit_id'=>$data->unit_id,
'attr_id'=>$data->id,
'attribut_value'=>$this->attribut_function($data->unit_id),

];

}

// dd($record->item_attr_id);

$checked_attributs=explode(',',$record->item_attr_id);


        return view('seller.product_items.edit',compact('record','attributs','checked_attributs'));


    }


  public function store(Request $request)
    {
// dd($request->attr_value_id);

$record=product::find(Session::get('product_id'))->first();


          if($request->hasFile('item_img1'))
  
        {       
     $file = $request->file('item_img1');
     $extension = $request->file('item_img1')->getClientOriginalExtension();
     $item_img1 = date('d_m_Y_h_i_s',time()) . '1.' . $extension;

         $destinationPaths = base_path().'/public/images/product_items';

  $thumb_img =Image::make($file->getRealPath())->orientate()->resize(600, 450);
  
     $thumb_img->save($destinationPaths.'/'.$item_img1,80);

      }       
        else{
            $item_img1 = "";
        }

                  if($request->hasFile('item_img2'))
  
        {       
     $file = $request->file('item_img2');
     $extension = $request->file('item_img2')->getClientOriginalExtension();
     $item_img2 = date('d_m_Y_h_i_s',time()) . '2.' . $extension;

         $destinationPaths = base_path().'/public/images/product_items';

  $thumb_img =Image::make($file->getRealPath())->orientate()->resize(600, 450);
  
     $thumb_img->save($destinationPaths.'/'.$item_img2,80);

      }       
        else{
            $item_img2 = "";
        }

                  if($request->hasFile('item_img3'))
  
        {       
     $file = $request->file('item_img3');
     $extension = $request->file('item_img3')->getClientOriginalExtension();
     $item_img3 = date('d_m_Y_h_i_s',time()) . '3.' . $extension;

         $destinationPaths = base_path().'/public/images/product_items';

  $thumb_img =Image::make($file->getRealPath())->orientate()->resize(600, 450);
  
     $thumb_img->save($destinationPaths.'/'.$item_img3,80);

      }       
        else{
            $item_img3 = "";
        }

                  if($request->hasFile('item_img4'))
  
        {       
     $file = $request->file('item_img4');
     $extension = $request->file('item_img4')->getClientOriginalExtension();
     $item_img4 = date('d_m_Y_h_i_s',time()) . '4.' . $extension;

         $destinationPaths = base_path().'/public/images/product_items';

  $thumb_img =Image::make($file->getRealPath())->orientate()->resize(600, 450);
  
     $thumb_img->save($destinationPaths.'/'.$item_img4,80);

      }       
        else{
            $item_img4 = "";
        }

$attributs=$request->attr_value_id;

$item_attr_id='';
$item_attr_value='';
$attribut_key='';

if (!empty($attributs)) {
  $attribut_key=array_keys($attributs);
$item_attr_id=implode(',',$attributs);
$item_attr_value=implode(',',$attribut_key);
}




// dd(implode(',',$attribut_key));
// dd($attributs);
$data = array(
'store_id'=>$this->id,
'user_id'=>$this->user_id,
'product_id'=>Session::get('product_id'),
'item_name'=>$request->input('item_name'),
'item_unique_id'=>$request->input('item_unique_id'),
'item_category'=>$record->product_category,
'item_subcategory'=>$record->product_subcategory,
'item_modal_number'=>$request->input('item_modal_number'),
'item_hsn_sac_code'=>$request->input('item_hsn_sac_code'),
'item_sku'=>$request->input('item_sku'),
'item_price'=>$request->input('item_price'),
'item_offer_price'=>$request->input('item_offer_price'),
'item_offer_discount'=>$request->input('item_offer_discount'),
'item_img1'=>$item_img1,
'item_img2'=>$item_img2,
'item_img3'=>$item_img3,
'item_img4'=>$item_img4,
'item_status'=>'Available',
'item_quantity'=>$request->input('item_quantity'),
'item_tags'=>$request->input('item_tags'),
'item_features'=>$request->input('item_features'),
'item_description'=>$request->input('item_description'),
'item_attr_id'=>$item_attr_id,
'item_attr_value'=>$item_attr_value,

);

  $product = new product_item($data);
         $product->save();
        
        if (!empty($attributs)) {
           
       
foreach($attributs as $index=>$data){

     // dd($index);
$data1=[
    'store_id'=>$this->id,
    'item_id'=>$product->id,
'unit_id'=>$request->unit_id,
'attr_id'=>$request->attr_id,
'unit_name'=>$request->unit_name,
'attr_value_id'=>$data,
'unit_value'=>$index,
];
$item = item_attribut::updateOrCreate($data1);
 }

      // $item = new item_attribut($data1);
      //    $item->save();
}

$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('seller/products/'.Session::get('product_id').'/items')->with($notification);

    }


      public function update(Request $request, $id)
    {
        

        $products = product_item::find($id); 


$record=Product::find(Session::get('product_id'))->first();


          if($request->hasFile('item_img1'))
  
        {       
     $file = $request->file('item_img1');
     $extension = $request->file('item_img1')->getClientOriginalExtension();
     $item_img1 = date('d_m_Y_h_i_s',time()) . '1.' . $extension;

         $destinationPaths = base_path().'/public/images/product_items';

  $thumb_img =Image::make($file->getRealPath())->orientate()->resize(600, 450);
  
     $thumb_img->save($destinationPaths.'/'.$item_img1,80);

      }       
        else{
            $item_img1 = $products->item_img1;
        }

                  if($request->hasFile('item_img2'))
  
        {       
     $file = $request->file('item_img2');
     $extension = $request->file('item_img2')->getClientOriginalExtension();
     $item_img2 = date('d_m_Y_h_i_s',time()) . '2.' . $extension;

         $destinationPaths = base_path().'/public/images/product_items';

  $thumb_img =Image::make($file->getRealPath())->orientate()->resize(600, 450);
  
     $thumb_img->save($destinationPaths.'/'.$item_img2,80);

      }       
        else{
            $item_img2 = $products->item_img2;
        }

                  if($request->hasFile('item_img3'))
  
        {       
     $file = $request->file('item_img3');
     $extension = $request->file('item_img3')->getClientOriginalExtension();
     $item_img3 = date('d_m_Y_h_i_s',time()) . '3.' . $extension;

         $destinationPaths = base_path().'/public/images/product_items';

  $thumb_img =Image::make($file->getRealPath())->orientate()->resize(600, 450);
  
     $thumb_img->save($destinationPaths.'/'.$item_img3,80);

      }       
        else{
            $item_img3 = $products->item_img3;
        }

                  if($request->hasFile('item_img4'))
  
        {       
     $file = $request->file('item_img4');
     $extension = $request->file('item_img4')->getClientOriginalExtension();
     $item_img4 = date('d_m_Y_h_i_s',time()) . '4.' . $extension;

         $destinationPaths = base_path().'/public/images/product_items';

  $thumb_img =Image::make($file->getRealPath())->orientate()->resize(600, 450);
  
     $thumb_img->save($destinationPaths.'/'.$item_img4,80);

      }       
        else{
            $item_img4 = $products->item_img4;
        }

$attributs=$request->attr_value_id;

$item_attr_id='';
$item_attr_value='';
$attribut_key='';
$item_attr_value='';

if (!empty($attributs)) {
  $attribut_key=array_keys($attributs);
$item_attr_id=implode(',',$attributs);
$item_attr_value=implode(',',$attribut_key);
}


$data = array(
// 'store_id'=>$this->id,
// 'user_id'=>$this->user_id,
// 'product_id'=>Session::get('product_id'),
'item_name'=>$request->input('item_name'),
// 'item_category'=>$record->product_category,
// 'item_subcategory'=>$record->product_subcategory,
'item_modal_number'=>$request->input('item_modal_number'),
'item_hsn_sac_code'=>$request->input('item_hsn_sac_code'),
'item_sku'=>$request->input('item_sku'),
'item_price'=>$request->input('item_price'),
'item_offer_price'=>$request->input('item_offer_price'),
'item_offer_discount'=>$request->input('item_offer_discount'),
'item_img1'=>$item_img1,
'item_img2'=>$item_img2,
'item_img3'=>$item_img3,
'item_img4'=>$item_img4,
// 'item_status'=>$request->input('item_status'),
'item_quantity'=>$request->input('item_quantity'),
'item_tags'=>$request->input('item_tags'),
'item_features'=>$request->input('item_features'),
'item_description'=>$request->input('item_description'),
'item_attr_id'=>$item_attr_id,
'item_attr_value'=>$item_attr_value,
);

                 $products->update($data);
        if (!empty($attributs)) {

foreach($attributs as $index=>$data){

     // dd($index);
$data1=[
    'store_id'=>$this->id,
    'item_id'=>$products->id,
'unit_id'=>$request->unit_id,
'attr_id'=>$request->attr_id,
'unit_name'=>$request->unit_name,
'attr_value_id'=>$data,
'unit_value'=>$index,
];
$item = item_attribut::updateOrCreate($data1);

      // $item = new item_attribut($data1);
      //    $item->save();
}

}

$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('seller/products/'.Session::get('product_id').'/items')->with($notification);

}

public function destroy(Request $request)
    {
      
         $products = product_item::find($request->id);
          $products->delete();

          return $products;
    }

     public function status_update(Request $request){
 
         $record=product_item::find($request->user_id);
      
          if($record['item_status']=='Available'){
               $updatevender=\DB::table('product_items')->where('id',$request->user_id)
                              ->update([
                                'item_status' => 'Not Available',
                                 ]);
            return json_encode('Not Available');
           } else {
              $updateuser=\DB::table('product_items')->where('id',$request->user_id)
                              ->update([
                                'item_status' => 'Available',
                                 ]);
              return json_encode("Available");

        }
           }

}