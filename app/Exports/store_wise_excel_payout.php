<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;
use App\suborder;



class store_wise_excel_payout implements FromCollection, WithHeadings
{



// protected $id;

 function __construct($id,$from,$to) {
        $this->id = $id;
        $this->from = $from;
        $this->to = $to;
 }

 
    public function collection()
    {
        

$suborders=suborder::where('suborders.store_id',$this->id)
->whereBetween(DB::raw('DATE(order_date)'), [$this->from, $this->to])
->get();

$records=[];

foreach($suborders as $index=>$data){

$records[]=(object)[
// 'store_id'=>$data->store_id,
// 'id'=>$data->id,
'created_at'=>$data->created_at,
'suborder_u_id'=>$data->suborder_u_id,
'total_item'=>$data->total_item,
'total_item_weight'=>$this->total_item_weights($data->id),
'total_item_price'=>$this->total_item_prices($data->id),
'delevery_status'=>$data->order_status,
'Status'=>$data->paid_unpaid_status,
];

}

// dd($records);
return collect($records);

    }

public function total_item_weights($suborder_id)
    {
                 $view=DB::table('order_items')->where('suborder_id',$suborder_id)->sum('item_shipping_weight');

        return $view;
    }




   public function total_item_prices($suborder_id)
    {
                               $view=DB::table('order_items')->where('suborder_id',$suborder_id)->sum('item_selling_price');


        return $view;
    }



    public function headings(): array
    {
        return ['Date','Order no','Total Item','Weight','Price','Delevery status','Paymnt Status'];
    }

}