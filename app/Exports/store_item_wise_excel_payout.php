<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;
use App\order_item;
use App\product;



class store_item_wise_excel_payout implements FromCollection, WithHeadings
{



// protected $id;

 function __construct($id=null,$from,$to,$store_id) {
        $this->id = $id;
        $this->from = $from;
        $this->to = $to;
        $this->store_id=$store_id;
 }

 
    public function collection()
    {
        

if (!empty($this->id)) {
    $order_items=order_item::where('order_items.suborder_id',$this->id)
    ->whereBetween('created_at', [$this->from, $this->to])

->get();
}else{

    $order_items=order_item::where('order_items.store_id',$this->store_id)
->whereBetween('created_at', [$this->from, $this->to])

    ->get();
}

$records=[];

foreach($order_items as $index=>$data){

$records[]=(object)[
'created_at'=>$data->created_at,
'item_u_id'=>$data->item_u_id,
'item_sku'=>$data->item_sku,
'category_name'=>$this->categorys($data->product_id),
'product_category'=>$this->product_categorys($data->product_id),
'product_name'=>$data->product_name,
'product_attributes'=>$this->attributes_funct($data->product_id),
'item_shipping_weight'=>$data->item_shipping_weight.' '.$data->item_shipping_weight_unit,
'item_selling_price'=>$data->item_selling_price,
'item_quantity'=>$data->item_quantity,
'total_Weight'=>$data->item_shipping_weight*$data->item_quantity,
'item_tax_price'=>$data->item_tax_price,
'total_price'=>$data->item_selling_price*$data->item_quantity,
'commission_amount'=>$data->commission_amount,
'commission_percent'=>$data->commission_percent,
'order_status'=>$this->order_status_function($data->suborder_id),
'paid_unpaid_status'=>$this->paid_unpaid_status_function($data->suborder_id),


];

}
// dd($records);
return collect($records);

    }





public function order_status_function($id)
{

$record=DB::table('suborders')->where('id',$id)->first();

return $record->order_status;

}


public function paid_unpaid_status_function($id)
{


$record=DB::table('suborders')->where('id',$id)->first();

return $record->paid_unpaid_status;
}



public function categorys($id)
{

$product=product::find($id);



if (!empty($product->category)) {
    
    return $product->category->product_category;
}else{
    return '';
}


}



public function product_categorys($id)
{

$product=product::find($id);

if (!empty($product->subcategory)) {
    
    return $product->subcategory->product_subcategory;
}else{
    return '';
}


}


public function attributes_funct($id)
{

    // dd($id);

    $attributes=DB::table('product_attributes')
    ->where('product_id',$id)
    ->pluck('attribute_name','attribute_name')
    ->toArray();


    return implode(',',$attributes);

}



    public function headings(): array
    {
        // return ['Date','Order no','Total Item','Weight','Price','Delevery status','Paymnt Status'];


return ['Date','Invoice No.','Item SKU','Category','Sub Category','Product Name','Attributes','Item Weight','Item Price','Quantity','Total Weight','Total Tax','Total Price','Commission','Delevery Status','Payment Status'];


    }

}