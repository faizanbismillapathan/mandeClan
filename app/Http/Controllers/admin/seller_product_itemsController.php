<?php

namespace App\Http\Controllers\admin;

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
use App\product_attribute;
use App\item_attribut;

use App\fake;

class seller_product_itemsController extends Controller
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
       

$records=DB::table('product_items')
->join('products','products.id','product_items.product_id')
->join('stores','stores.id','product_items.store_id')
->join('product_categories','product_categories.id','products.product_category')
->leftjoin('product_subcategories','product_subcategories.id','products.product_subcategory')
->orderBy('product_items.id','asc')
->select('product_items.id','products.product_name','stores.store_name','product_items.item_attr_varient','product_categories.product_category','product_subcategories.product_subcategory','product_items.item_price','product_items.item_status','product_items.item_sku','product_items.item_unique_id','product_items.item_offer_discount','product_categories.id as cat_id')
->paginate(100);



        return view('admin.product_items.index',compact('records'));


       }


//         public function show($id)
//     {

//         $record=store::find($id);
//         Session::put('store_id',$id);
//         Session::put('store_name',$record->store_name);
//         Session::put('store_user_id',$record->user_id);


// // dd($record);

//         return view('product_items.index',compact('record'));
//     }


       public function itemsView($id)
    {


        Session::put('product_id',$id);


$record=DB::table('products')
	->orderBy('products.id','desc')
	->join('product_categories','product_categories.id','products.product_category')
	->leftjoin('product_subcategories','product_subcategories.id','products.product_subcategory')
	->where('products.id',$id)
	->select('products.product_name','product_categories.product_category','product_subcategories.product_subcategory','products.id')
	->first();


// dd($record);



$records=DB::table('product_items')
    ->orderBy('product_items.id','asc')
    ->join('products','products.id','product_items.product_id')
        ->where('products.id',$id)
    ->select('product_items.*','products.product_name')
    ->paginate(100);




$attributs=DB::table('product_attributes')
->where('product_id',Session::get('product_id'))
->where('status','<>','deleted')
->get();

// dd($attributs);

$array1=DB::table('product_attributes')
->where('product_id',Session::get('product_id'))
->where('status','<>','deleted')
->pluck('attribute_name','attribute_name')
->toArray();


$array2=DB::table('units')->pluck('unit_title','unit_title')->toarray();


$dynamics = array_diff_key($array2, $array1);



$record_edit=product_item::whereNull('product_items.item_attr_varient')
->join('products','products.id','product_items.product_id')
->join('product_categories','product_categories.id','products.product_category')
->leftjoin('product_subcategories','product_subcategories.id','products.product_subcategory')
->select('product_items.*','products.product_name','products.product_cover_photo',
'products.product_name','product_categories.product_category','product_subcategories.product_subcategory')
->where('products.id',Session::get('product_id'))
->first();


// dd($record_edit);




        return view('admin.product_items.index',compact('record','records','attributs','dynamics','record_edit'));
    }


    public function create()
    {

$records=DB::table('product_attributes')
->where('product_id',Session::get('product_id'))
->get();
$record=DB::table('products')
    ->orderBy('products.id','desc')
    ->join('product_categories','product_categories.id','products.product_category')
    ->leftjoin('product_subcategories','product_subcategories.id','products.product_subcategory')
    ->where('products.id',Session::get('product_id'))
    ->select('products.product_name','product_categories.product_category','product_subcategories.product_subcategory','product_categories.id')
    ->first();


  return view('admin.product_items.create',compact('records','record'));


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

// dd(\Request::segment(3));
$record=product_item::where('product_items.id',$id)
->join('products','products.id','product_items.product_id')
->join('product_categories','product_categories.id','products.product_category')
->leftjoin('product_subcategories','product_subcategories.id','products.product_subcategory')
->select('product_items.*','products.product_name','products.product_cover_photo',
'products.product_name','product_categories.product_category','product_subcategories.product_subcategory')
->first();



$records=DB::table('product_items')
->orderBy('product_items.id','asc')
->where('product_items.product_id',$record->product_id)
->select('product_items.id','product_items.item_attr_varient')
->get();


// dd($records);
        return view('admin.product_items.edit',compact('record','records'));


    }

function combinations($arrays, $i = 0) {

    if (!isset($arrays[$i])) {
        return array();
    }
    if ($i == count($arrays) - 1) {
        return $arrays[$i];
    }

    // get combinations from subsequent arrays
    $tmp = $this->combinations($arrays, $i + 1);
    // dd($tmp);

    $result = array();

    // concat each array from tmp with each element from $arrays[$i]
    foreach ($arrays[$i] as $id=>$v) {
        foreach ($tmp as $k=>$t) {
            $result[] = is_array($t) ? 
                array_merge(array($v), $t) :
                array($v, $t);
        }

    }

$all=[];
foreach($result as $data){
$all[]=implode('/',$data);
}
// $all['keys']=$alredystore_attr;

    return $all;
}





function generate_combinations(array $data, array &$all = array(), array $group = array(), $value = null, $i = 0)
{
    $keys = array_keys($data);
    if (isset($value) === true) {
        array_push($group, $value);
    }

    if ($i >= count($data)) {
        array_push($all, $group);
    } else {
        $currentKey     = $keys[$i];
        $currentElement = $data[$currentKey];
        foreach ($currentElement as $val) {
            $this->generate_combinations($data, $all, $group, $val, $i + 1);
        }
    }

$result=[];
foreach($all as $data){
$result[]=implode('/',$data);

}
    return $result;

}

 public function Create_Items()
    {


$alredystore_attr=DB::table('product_items')
->where('store_id',$this->id)
->where('product_id',Session::get('product_id'))
->groupby('item_attr_varient')
->orderBy('id')
->pluck('item_attr_varient','item_attr_varient')
->toArray();

// dd($alredystore_attr);name

$deleted=DB::table('product_attributes')
->where('store_id',$this->id)
->where('product_id',Session::get('product_id'))
->where('status','deleted')
->pluck('attribute_value')
->toarray();


$without_del=DB::table('product_attributes')
->where('store_id',$this->id)
->where('product_id',Session::get('product_id'))
->where('status','<>','deleted')
->pluck('attribute_value')
->toarray();


// dd($without_del);


if (count($deleted)>0 && count($without_del) > 0) {
    

for ($is=0; $is <count($deleted) ; $is++) { 
   
    $dynamics=[];
$dynamics[]=explode(',',$deleted[$is]);

$alredy_attrs=[];

 foreach ($dynamics as $key => $value) {
        if (is_array($value)) {
            $alredy_attrs = array_merge($alredy_attrs, array_flatten($value));
        } else {
            $alredy_attrs = array_merge($alredy_attrs, array($key => $value));
        }

}


// dd($alredy_attrs);

$update_value=$alredy_attrs[0];


$variable_up=DB::table('product_items')
->where('store_id',$this->id)
->where('product_id',Session::get('product_id'))
 ->Where(function ($query) use($update_value) {
                $query->orwhere('item_attr_varient',$update_value)
               ->orwhere('item_attr_varient', 'like',  '%' . '/'.$update_value.'/' .'%')
               ->orwhere('item_attr_varient', 'like',  '%' .$update_value.'/' .'%')
               ->orwhere('item_attr_varient', 'like',  '%' . '/'. $update_value .'%');

        })

->get();


foreach ($variable_up as $vals) {

    $value_varient=str_replace([$update_value.'/','/'.$update_value],'',$vals->item_attr_varient);
    $value_key=str_replace([$update_value.'/','/'.$update_value],'',$vals->item_attr_key);

// dd($value_key);

    // ...........
$valss= explode('/',$value_varient);

$attr_color=[];
$attribute_val=[];

       foreach ($valss as $ke1 => $val1) { 
          
          // dd($val1);

$rrr=DB::table('product_attributes')
->whereRaw("find_in_set('".$val1."',attribute_value)")
->select('attribute_name')
->where('product_id',Session::get('product_id'))

->first();  

          $attr_color[]=$rrr->attribute_name;
          $attribute_val[]=$val1;

       }


$array_combine=array_combine($attr_color, $attribute_val);

// ..............

           product_item::Where('id',$vals->id)
->where('store_id',$this->id)
->where('product_id',Session::get('product_id'))
            ->update([
'item_attr_varient'=>$value_varient,
'item_attr_key'=>$value_key,
'array_combine'=>serialize($array_combine),

            ]);




}




$variable=DB::table('product_items')
->where('store_id',$this->id)
->where('product_id',Session::get('product_id'))
 ->Where(function ($query) use($alredy_attrs) {

             for ($i = 1; $i < count($alredy_attrs); $i++){

// dd($alredy_attrs[$i]);

                $query->orwhere('item_attr_varient',$alredy_attrs[$i])
               ->orwhere('item_attr_varient', 'like',  '%' . '/'.$alredy_attrs[$i].'/' .'%')
               ->orwhere('item_attr_varient', 'like',  '%' .$alredy_attrs[$i].'/' .'%')
               ->orwhere('item_attr_varient', 'like',  '%' . '/'. $alredy_attrs[$i] .'%');

                             }      
        })

->get();



foreach ($variable as $key => $value) {
            product_item::findOrFail($value->id)->delete();

}

// dd('dd');

}

$deleted=DB::table('product_attributes')
->where('store_id',$this->id)
->where('product_id',Session::get('product_id'))
->where('status','deleted')
->select('attribute_value','id')
->get();


foreach ($deleted as $key => $value11) {
            product_attribute::findOrFail($value11->id)->delete();

}
 
}elseif (count($deleted)>0 &&count($without_del) == 0) {
    
$dynamics=explode(',',$deleted[0]);
// dd($dynamics[0]);

$aaa=[];

$variable=DB::table('product_items')
->where('store_id',$this->id)
->where('product_id',Session::get('product_id'))
 ->Where(function ($query) use($dynamics) {


             for ($i = 0; $i < count($dynamics); $i++){
// dd($i);

// $aaa[]=$dynamics[$i];

                $query->orwhere('item_attr_varient',$dynamics[$i])
               ->orwhere('item_attr_varient', 'like',  '%' . '/'.$dynamics[$i].'/' .'%')
               ->orwhere('item_attr_varient', 'like',  '%' .$dynamics[$i].'/' .'%')
               ->orwhere('item_attr_varient', 'like',  '%' . '/'. $dynamics[$i] .'%');

                             }      
        })

->get();


// dd($variable);

foreach ($variable as $key => $value) {
            product_item::findOrFail($value->id)->delete();

}

$deleted=DB::table('product_attributes')
->where('store_id',$this->id)
->where('product_id',Session::get('product_id'))
->where('status','deleted')
->select('attribute_value','id')
->get();


foreach ($deleted as $key => $value11) {
            product_attribute::findOrFail($value11->id)->delete();

}


}


$variable=DB::table('product_attributes')
->where('store_id',$this->id)
->where('product_id',Session::get('product_id'))
->select('id','attribute_name','attribute_value','old_attribute')
->where('status','new')
->get();

// dd($variable);

$attribut=[];
 
 foreach ($variable as $key => $value) {
    

// dd($value->old_attribute);

    if ($value->old_attribute) {
      

      $arr1=explode(',',$value->attribute_value);
$arr2=explode(',',$value->old_attribute);

// dd($arr2);

if (count($arr1) > count($arr2)) {

    $dynamics = array_diff($arr1, $arr2);
// dd($arr1);


$compare=DB::table('product_attributes')
->where('attribute_value','<>',$value->attribute_value)
->select('attribute_value')
->where('product_id',Session::get('product_id'))
->get();

// dd($compare);

$alredystore_attr=[];


$nnew=[];

foreach($compare as $kk){

$nnew[]=explode(',',$kk->attribute_value);
}

$alredystore_attr=$this->combinations($nnew);


// dd($alredystore_attr);


}elseif (count($arr2) > count($arr1)) {

    $dynamics = array_values(array_diff($arr2, $arr1));

// dd($dynamics);

$variable=DB::table('product_items')
->where('store_id',$this->id)
->where('product_id',Session::get('product_id'))
 ->Where(function ($query) use($dynamics) {

             for ($i = 0; $i < count($dynamics); $i++){

                $query->orwhere('item_attr_varient',$dynamics[$i])
               ->orwhere('item_attr_varient', 'like',  '%' . '/'.$dynamics[$i].'/' .'%')
               ->orwhere('item_attr_varient', 'like',  '%' .$dynamics[$i].'/' .'%')
               ->orwhere('item_attr_varient', 'like',  '%' . '/'. $dynamics[$i] .'%');

                             }      
        })

->get();

// dd($variable);

foreach ($variable as $key => $value) {
            product_item::findOrFail($value->id)->delete();

}
$dynamics=[];

}elseif (count($arr2) == count($arr1)) {
 $dynamics=[];

}else{

    $dynamics=explode(',',$value->attribute_value);
}


    }else{

            $dynamics=explode(',',$value->attribute_value);

// 
    }

    // dd($dynamics);

    $attribut[$key]=$dynamics;
 }

// dd($attribut);

if (count($alredystore_attr) >0 && count($attribut) >0) {
     
$attribut[]=$alredystore_attr;
     
 }

$child_arr=$this->combinations($attribut);

// dd($child_arr);

$alredystores=DB::table('product_items')
->where('store_id',$this->id)
->where('product_id',Session::get('product_id'))
->orderBy('id')
->select('id')
->get();




if (count($alredystore_attr) ==0 ) {

 
         $autoincid = mt_rand(10,100);
         $Y = date('YHms');
         $keydata = $Y.'item'.$autoincid;
         $record=product::find(Session::get('product_id'))->select('id','product_category','product_subcategory')->first();

    foreach($child_arr as $key=>$value){

// dd($value);

       $valss= explode('/',$value);

$attr_color=[];
$attribute_val=[];

       foreach ($valss as $ke1 => $val1) { 
          
          // dd($val1);

$rrr=DB::table('product_attributes')
->whereRaw("find_in_set('".$val1."',attribute_value)")
->select('attribute_name')
->where('product_id',Session::get('product_id'))

->first();  

          $attr_color[]=$rrr->attribute_name;
          $attribute_val[]=$val1;

       }


$array_combine=array_combine($attr_color, $attribute_val);

// dd($array_combine);

$product_item_id = DB::table('product_items')->insertGetId([
'item_attr_varient'=>$value,
'item_attr_key'=>$value,
'item_unique_id'=>$keydata,
'store_id'=>$this->id,
'user_id'=>$this->user_id,
'product_id'=>Session::get('product_id'),
'item_category'=>$record->product_category,
'item_subcategory'=>$record->product_subcategory,
'array_combine'=>serialize($array_combine),
'product_item_status'=>'Varient',

]);


// dd($product_item_id);


  }
}else{

// dd($alredystore_attr);

    // dd($child_arr);

if (count($child_arr)>0) {
  $count= count($child_arr)-count($alredystore_attr);


for ($i=1; $i < $count+1 ; $i++) { 
   $alredystore_attr[]=$i;

}
// dd($alredystore_attr);

$child_arr=array_combine($alredystore_attr,$child_arr);

// dd($child_arr);


$item_attr_material_new=[];
$item_attr_style_new=[];
foreach($child_arr as $keys=>$value1){

// dd($keys);
$check=product_item::where('item_attr_key',$keys)
->where('store_id',$this->id)
->where('product_id',Session::get('product_id'))
->first();


// ...............................

$valss= explode('/',$value1);

$attr_color=[];
$attribute_val=[];

       foreach ($valss as $ke1 => $val1) { 
          
          // dd($val1);

$rrr=DB::table('product_attributes')
->whereRaw("find_in_set('".$val1."',attribute_value)")
->select('attribute_name')
->where('product_id',Session::get('product_id'))
->first();  
          // dd($rrr->attribute_name);
if (!empty($rrr)) {

   $attr_color[]=$rrr->attribute_name;
       

}else{

        $attr_color[]='';

}

   $attribute_val[]=$val1;
         

       }


$array_combine=array_combine($attr_color, $attribute_val);

// dd($array_combine);
    if (!empty($check)) {
product_item::where('item_attr_key',$keys)
->where('store_id',$this->id)
->where('product_id',Session::get('product_id'))
->update([
'item_attr_varient'=>$value1,
'item_attr_key'=>$value1,
'array_combine'=>serialize($array_combine),

]);





}else{
// $sss11[]=$keys;

  
         $autoincid = mt_rand(10,100);
            $Y = date('YHms');
         $keydata = $Y.'item'.$autoincid;

$record=product::find(Session::get('product_id'))->select('id','product_category','product_subcategory')->first();


$product_item_id = DB::table('product_items')->insertGetId([
   'item_attr_varient'=>$value1,
'item_attr_key'=>$value1,
'item_unique_id'=>$keydata,
'store_id'=>$this->id,
'user_id'=>$this->user_id,
'product_id'=>Session::get('product_id'),
'item_category'=>$record->product_category,
'item_subcategory'=>$record->product_subcategory,
// 'item_attr_color'=>$item_attr_color,
// 'item_attr_size'=>$item_attr_size,
// 'item_attr_material'=>$item_attr_material,
// 'item_attr_style'=>$item_attr_style,
'product_item_status'=>'Varient',
'array_combine'=>serialize($array_combine),

]);


//  $item_attr_material_new[]=$item_attr_material;

// $item_attr_style_new[]=$item_attr_style;
}

     
}
// dd($item_attr_style_new);

}

}


$alredystores=DB::table('product_attributes')
->where('store_id',$this->id)
->where('product_id',Session::get('product_id'))
->where('status','new')
->update([
'status'=>'used',
'old_attribute'=>'',
]);


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('seller/products/'.Session::get('product_id').'/items')->with($notification);

    }



function mycustomcombination($arrays, $attribut) {

$ddd=$this->mycustomcombination($total,$attribut);

// dd($attribut);

$child_arr = [];

    
// dd($total);
 if ($total==1) {

     foreach($attribut[0] as $index=>$data){
     DB::table('fakes')->insert([
'name'=>$data,

     ]);

}
 }

// ...........................................

 if ($total==2) {

         foreach($attribut[0] as $index=>$data){

     foreach($attribut[1] as $index1=>$data1){

 DB::table('fakes')->insert([
'name'=>$data.'/'.$data1,

     ]);

}
}
     
 }


// ...........................................

 if ($total==3) {

         foreach($attribut[0] as $index=>$data){

     foreach($attribut[1] as $index1=>$data1){

     foreach($attribut[2] as $index2=>$data2){


 DB::table('fakes')->insert([
'name'=>$data.'/'.$data1.'/'.$data2,

     ]);

}

}
}
     
 }


 // ...........................................

 if ($total==4) {

         foreach($attribut[0] as $index=>$data){

     foreach($attribut[1] as $index1=>$data1){

     foreach($attribut[2] as $index2=>$data2){

     foreach($attribut[3] as $index3=>$data3){


 DB::table('fakes')->insert([
'name'=>$data.'/'.$data1.'/'.$data2.'/'.$data3,

     ]);

}
}
}
}
     
 }
}
  public function store(Request $request)
    {


$data1=[
'store_id'=>$this->id,
'store_user_id'=>$this->user_id,
'product_id'=>Session::get('product_id'),
'attribute_name'=>$request->attribute_name,
'attribute_value'=>implode(',',array_filter($request->attribute_value)),
'status'=>'new',
'old_attribute'=>'',
];


$item = product_attribute::insert($data1);
 


$notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

return Redirect::to('seller/products/'.Session::get('product_id').'/items')->with($notification);

    }




      public function attr_store(Request $request)
    {
        

       
//        $products = product_item::find($id); 

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
            $item_img1 = '';
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
            $item_img2 = '';
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
            $item_img3 = '';
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
            $item_img4 = '';
        }


 
         $autoincid = mt_rand(10,100);
         $Y = date('YHms');
         $keydata = $Y.'item'.$autoincid;


$data = array(
'item_name'=>$request->input('item_name'),
'item_barcode'=>$request->input('item_barcode'),
'item_hsn_sac_code'=>$request->input('item_hsn_sac_code'),
'item_sku'=>$request->input('item_sku'),
'item_price'=>$request->input('item_price'),
'item_offer_discount'=>$request->input('item_offer_discount'),
'item_img1'=>$item_img1,
'item_img2'=>$item_img2,
'item_img3'=>$item_img3,
'item_img4'=>$item_img4,
'item_quantity'=>$request->input('item_quantity'),
'item_description'=>$request->input('item_description'),
'item_shipping_weight'=>$request->input('item_shipping_weight'),
'item_shipping_weight_unit'=>$request->input('item_shipping_weight_unit'),
// 'item_attr_varient'=>$value,
// 'item_attr_key'=>$value,
'item_unique_id'=>$keydata,
'store_id'=>$this->id,
'user_id'=>$this->user_id,
'product_id'=>Session::get('product_id'),
'item_category'=>$record->product_category,
'item_subcategory'=>$record->product_subcategory,
// 'array_combine'=>serialize($array_combine),
'product_item_status'=>'Single',
'item_status'=>$request->input('item_status'),

);

$product_item=new product_item($data);

$product_item->save();

                 // $products->update($data);


$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('seller/products/'.Session::get('product_id').'/items')->with($notification);

}




      public function attr_update(Request $request)
    {
        


        $products = product_attribute::find($request->id); 




$old_attribute=$products->attribute_value;

if ($products->status=='new') {

  $old_attribute=$products->old_attribute;

}
$data1=[
'attribute_name'=>$request->attribute_name,
'attribute_value'=>implode(',',array_filter($request->attribute_value)),
'status'=>'new',
'old_attribute'=>$old_attribute,

];

                 $products->update($data1);


$notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::to('seller/products/'.Session::get('product_id').'/items')->with($notification);

}



public function update(Request $request, $id)
    {
        

        $products = product_item::find($id); 


 $item_status=$products->item_status;
 
if (!empty($request->item_status)) {
   $item_status=$request->input('item_status');

}
    


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



$data = array(
'item_name'=>$request->input('item_name'),
'item_barcode'=>$request->input('item_barcode'),
'item_hsn_sac_code'=>$request->input('item_hsn_sac_code'),
'item_sku'=>$request->input('item_sku'),
'item_price'=>$request->input('item_price'),
'item_offer_discount'=>$request->input('item_offer_discount'),
'item_img1'=>$item_img1,
'item_img2'=>$item_img2,
'item_img3'=>$item_img3,
'item_img4'=>$item_img4,
'item_quantity'=>$request->input('item_quantity'),
'item_description'=>$request->input('item_description'),
'item_shipping_weight'=>$request->input('item_shipping_weight'),
'item_shipping_weight_unit'=>$request->input('item_shipping_weight_unit'),
'item_status'=>$item_status,

);

// dd($data);

                 $products->update($data);


                 $notification = array(
    'message' => 'Your form was successfully Update!', 
    'alert-type' => 'success'
);

return Redirect::back()->with($notification);

}



public function destroy(Request $request)
    {
      
         $products = product_attribute::find($request->id);
          $products->update([
'status'=>'deleted'
          ]);

          return $products;
    }




public function delete($id)
    {
      
         $products = product_item::find($id);
          $products->delete();



$notification = array(
    'message' => 'Your form was successfully delete!', 
    'alert-type' => 'success'
);



          return Redirect::back()->with($notification);
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