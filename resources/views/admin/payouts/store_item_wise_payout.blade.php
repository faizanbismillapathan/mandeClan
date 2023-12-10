@extends('admin.layouts.app')
@section('title',"Create Store Wise Payout | Admin Mande Clan")

<!-- ................custom css................. -->

@section('customStyle')
@endsection

<!-- ................Add css link................. -->

@push('style')
@endpush

<!-- ................body................. -->
@section('innercontent')


<main class="content">
    <div class="container-fluid p-0">
        <div class="clearfix">
            <a href="{{url()->previous()}}" class="form-inline float-right mt--1 d-none d-md-flex">
                <button class="btn btn-info"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Back</button>
            </a>

            <h1 class="h3 mb-3"><b>Commission Items Vise</b></h1>

        </div>
        <div class="card">

            <div class="card-body">

             <div class="row mx-1">
                    <div class="col-md-3 d-flex">
                    <b>Store Id</b><b class="mx-2">:</b>
                    <p>{{ $record->store_unique_id }}</p>
                </div>
                <div class="col-md-3 d-flex">

                    <b>Store Name</b><b class="mx-2">:</b>
                    <p>{{ $record->store_name }}</p>
                </div>
                <div class="col-md-3 d-flex">
                    <b>Store Category</b><b class="mx-2">:</b>
                    <p>{{ $record->category->category_name }}</p>
                </div>
                <div class="col-md-3 d-flex">
                    <b>Store Contact No</b><b class="mx-2">:</b>
                    <p>{{ $record->store_mobile }}</p>
                </div>
               
                <div class="col-md-4 d-flex">
                    <b>Location</b><b class="mx-2">:</b>
                    <p>{{ $record->city->city_name }},{{ $record->locality->locality_name }}</p>
                </div>
                
            </div>

            <div class="table-responsive p-4">

               {{--  {{ \Request::segment(1) }} --}}

{{-- {{ 'admin/store-item-wise-payout/'.Request::segment(3).'?from_date='.Request::Input('from_date').'&to_date='.Request::Input('to_date').'&store_id='.Request::Input('store_id') }} --}}


            {{Form::open(['url'=>['admin/store-item-wise-payout/'.Request::segment(3).'?from_date='.Request::Input('from_date').'&to_date='.Request::Input('to_date').'&store_id='.Request::Input('store_id')],'method'=>'GET'])}}

             <div class="row">
                <div class="col-md">


                 {!!Form::text('from_date',Request::input('from_date'),array('class'=>'datepicker-here form-control createddateformat','placeholder'=>'Enter From Date','data-language'=>'en','data-date-format'=>'yyyy-mm-dd','autocomplete'=>'off','required')) !!}

             </div>
             <div class="col-md">

              {!!Form::text('to_date',Request::input('to_date'),array('class'=>'datepicker-here form-control createddateformat','placeholder'=>'Enter To Date','data-language'=>'en','data-date-format'=>'yyyy-mm-dd','autocomplete'=>'off','required')) !!}


          </div>

         {{--   --}}

        <div class="col-md">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>  

        

<div class="col-md">
                <a href="{{ url('admin/store-item-wise-pdf-payout?from_date='.Request::Input('from_date').'&to_date='.Request::Input('to_date').'&store_id='.$record->id) }}"><button type="button" class="btn btn-info"><i class="fa fa-download mx-1 text-secondar"></i></button></a>

                   <a href="{{ url('admin/store-item-wise-excel-payout?from_date='.Request::Input('from_date').'&to_date='.Request::Input('to_date').'&store_id='.$record->id) }}"><button type="button" class="btn btn-success"><i class="fa fa-file-excel mx-1 text-secondar"></i></button></a>



</div>

    </div>

{{ Form::close() }}

            

                </div>

                <table class="table table-bordered table-striped table-hover">
                    <thead class="thead-light">
                        <tr>
                           <th>Date</th>
                            <th>Invoice No.</th>
                            <th>Item SKU</th>
                            <th>Category</th>
                            <th>Sub Category</th>
                            <th>Product Name</th>
                            <th>Attributes</th>
                            <th>Item Weight</th>
                            <th>Item Price</th>
                            <th>Qnty.</th>
                            <th>Total Weight</th>
                            <th>Total Tax</th>
                            <th>Total Price</th>
                            <th>Commission</th>
                            <th>Delevery</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        @if(!empty($records))
                        @foreach($records as $index=>$data)
                        
 <tr class="deleteRow">
<td>{{date("d-m-Y", strtotime($data->created_at))}}</td>
<td scope="row">{{ $data->item_u_id }}</td>
<td>{{ $data->item_sku }}</td>
<td>{{ $data->category_name }}</td>
<td>{{ $data->product_category }}</td>
<td>{{ $data->product_name }}</td>
<td>{{ $data->product_attributes }}</td>
<td>{{ $data->item_shipping_weight }} {{ $data->item_shipping_weight_unit }}</td>
{{-- 
<td>{{ $data->item_shipping_weight }}</td>
 --}}
<td>{{ $data->item_selling_price }} $</td>
<td>{{ $data->item_quantity }} $</td>
<td>{{ $data->total_Weight }}</td>
<td>@if($data->item_tax_price){{ $data->item_tax_price }}%@endif</td>

<td>@if($data->total_price){{ $data->total_price }}@endif</td>

<td>@if($data->commission_amount){{ $data->commission_amount }} ({{ $data->commission_percent }}%)@endif</td>
<td>{{ $data->order_status }}</td>
<td>
@if($data->paid_unpaid_status=='Paid')

<span class="badge badge-success"> {{ $data->paid_unpaid_status }}</span>
@else
<span class="badge badge-danger"> {{ $data->paid_unpaid_status }}</span>

@endif                           </td>
</tr>
                        @endforeach
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</main>
@endsection

<!-- ................push new js link................. -->

@push('js')

<script src="{{asset('public/js/validation.js')}}"></script>

@endpush