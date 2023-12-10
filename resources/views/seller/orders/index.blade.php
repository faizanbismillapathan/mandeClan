@extends('seller.layouts.app')
@section('title',"All Orders Process | Seller Mande Clan")

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


<h1 class="h3 mb-3">{{Request::input('search')}} Orders &nbsp;&nbsp;@if(!empty($records))({{$records->total()}})@endif</h1>
</div>

<div class="card">
<div class="card-body">
<div class="row">
<div class="col-md py-1">
{{Form::open(['url'=>['seller/orders'],'method'=>'GET'])}}

@if(!empty($status))
{!!Form::select('search',$status,Request::input('search'),array('class'=>'form-control select2','placeholder'=>'Search','data-toggle'=>'select2','onchange'=>'this.form.submit()','id'=>'test_skill')) !!}


@endif


{{Form::close()}}
</div>
<div class="col-md py-1">

</div>
<div class="col-md py-1">
<div class="form-group">
{{Form::open(['url'=>['seller/orders'],'method'=>'GET'])}}

<div class="input-group">

{!!Form::text('search',Request::input('search'),array('class'=>'form-control','placeholder'=>'Search by Orders..','onchange'=>'this.form.submit()','autocomplete'=>'off')) !!}

<span class="input-group-append">
<button class="btn btn-secondary" type="button">Enter!</button>
</span>                         
</div>
{{Form::close()}}

</div>
</div>                                          
</div>
</div>

<div class="col-md-6 ajax_response" style="display: none;">
<div class="alert alert-success">
<b id="success_message" style="padding: 8px"></b>

</div>
</div>




<table class="table table-striped table-hover table-sm table-bordered table-responsive" >
<thead>
<tr>
<th width="1%">Sr.</th>
<th width="10%" Style="white-space: nowrap;
">Order Date</th>
<th width="10%" Style="whIte-space: nowrap;
">delivery date</th>
<th width="10%">SubOrder Id</th>
<th width="10%">User Id	</th>
<th width="10%">Total Items</th>

<th width="10%">Delivery Area	</th>
<th width="15%">Status</th>
<th width="10%">P. Mode	</th>
<th width="10%">Payment	Status</th>
<th width="10%">Invoice</th>

<th width="15%">Action</th>                         
</tr>
</thead>
<tbody>


@if(!empty($records))
@foreach($records as $index => $data)
<tr class="deleteRow">
<td>{{$index+1}}</td>   
<td>{{date('d-m-y',strtotime($data->order_date))}} {{date('h:i a',strtotime($data->order_date))}}</td>
<td> {{date('d-M-y',strtotime($data->delivery_date))}} {{$data->delivery_time}}</td>
<td><a href="{{url('seller/suborder_items/'.$data->id)}}">{{$data->suborder_u_id}}</a>@if(date('d-m-Y',strtotime(Carbon\Carbon::today())) == date('d-m-Y',strtotime($data->created_at)))
<span class="badge badge-danger">New</span>
@endif</td>
<td>{{$data->customer_u_id}} <br>
{{$data->customer_name}} <br>
{{$data->customer_email}} <br>
{{$data->customer_mobile}} <br>
</td>
<td>{{$data->total_item}}</td>


<td>@if($data->pickup_type=='Self Pickup')
	<span class="badge badge-light">
            {{$data->pickup_type}}   
            </span> 
@else
	{{$data->customer_address}}

@endif</td>
<td>$ {{$data->grand_total}}</td>
<td><span class="badge badge-dark">{{$data->payment_method}}</span></td>
<td><span class="badge badge-success">{{$data->order_status}}</span></td>

<td>
<a href="{{url('seller/order-invoice-pdf/'.$data->id)}}"><button class="btn bmd-btn-icon btn-raised btn-secondary" type="button">
<i class="fas fa-download"></i>
</button></a></td>
<td>                                                    
{{-- <a href="{{ URL::to('seller/orders/'.$data->id.'/edit') }}"><button class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></button></a> --}}

<button class="btn btn-danger click_disbled"  data-toggle="tooltip" data-placement="top" title="Delete"  data="{{$data->id}}"><i class="fas fa-trash-alt"></i></button>                                 
</td>
</tr>
@endforeach
@endif

</tbody>
</table>
<div class="card-body">
@if(!empty($records))
{!! $records->appends(request()->query())->render() !!}
@endif
</div>





</div>
</div>

</main> 

@endsection

<!-- ................push new js link................. -->

@push('js')
<script src="{{asset('public/js/comman.js')}}"></script>

@endpush