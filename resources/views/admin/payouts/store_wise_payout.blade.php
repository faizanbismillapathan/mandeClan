@extends('admin.layouts.app')
@section('title',"Store Wise Payout | Admin Mande Clan")

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



{{-- 
           <a href="{{url('admin/roles/create')}}" class="form-inline float-right mt--1 d-none d-md-flex">
             <button class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create a New Role</button>
         </a> --}}

         <h1 class="h3 mb-3">Store Wise Payout &nbsp;&nbsp;@if(!empty($view))({{$view->total()}})@endif</h1>
     </div>

     <div class="card">
        <div class="card-body">
                                {{Form::open(['url'=>['admin/store-wise-payout'],'method'=>'GET'])}}

            <div class="row">
                <div class="col-md">
<label>From Date :</label>

                                   {!!Form::text('from_date',Request::input('from_date'),array('class'=>'datepicker-here form-control createddateformat','placeholder'=>'Enter From Date','data-language'=>'en','data-date-format'=>'yyyy-mm-dd','autocomplete'=>'off','required')) !!}

                </div>
                <div class="col-md">
<label>To Date :</label>

                      {!!Form::text('to_date',Request::input('to_date'),array('class'=>'datepicker-here form-control createddateformat','placeholder'=>'Enter To Date','data-language'=>'en','data-date-format'=>'yyyy-mm-dd','autocomplete'=>'off','required')) !!}


                </div>
                <div class="col-md">
                    <label>City :</label>

              {!!Form::select('city',$cities,Request::Input('city'),array('class'=>'form-control select2','placeholder'=>'Search','data-toggle'=>'select2')) !!}

              </div>  

                <div class="col-md">
<br>
                                            <button type="submit" class="btn btn-primary">Search</button>
              </div>  

                       {{--        <div class="col-md">
              {!!Form::select('search',[],null,array('class'=>'form-control select2','placeholder'=>'Search','data-toggle'=>'select2')) !!}

              </div>  


                <div class="col-md">
              {!!Form::select('search',[],null,array('class'=>'form-control select2','placeholder'=>'Search','data-toggle'=>'select2')) !!}

              </div>   --}}


                                        
          </div>

                              {{Form::close()}}

      </div>

      <div class="col-md-6 ajax_response" style="display: none;">
        <div class="alert alert-success">
          <b id="success_message" style="padding: 8px"></b>

      </div>
  </div>


  <table class="table table-striped table-hover table-sm table-bordered" >
    <thead>
        <tr>
         <th>Store Id</th>
         <th>Store Name</th>
         <th>Start </th>
         <th>End</th>
         <th>Order</th>
         <th>Locality</th>
         <th>Store Payment</th>
         <th>Store Tax</th>
         <th>Tax Price</th>
         <th>Vender Price</th>
         <th>UnPaid</th>
         <th>Paid</th>
         <th>Action</th>                         
     </tr>
 </thead>
 <tbody>


    @if(!empty($records))
    @foreach($records as $index => $data)
    <tr class="deleteRow">
       <td>{{ $data->store_unique_id }}</td>
       <th scope="row"><a href="{{ url('admin/store-payout-list/'.$data->id.'?from_date='.Request::Input('from_date').'&to_date='.Request::Input('to_date')) }}">{{ $data->store_name }}</a></th>
       <td>{{ $data->start_date }} </td>
       <td>{{ $data->end_date }}</td>
       <td>{{ $data->total_order }}</td>
       <td>{{ $data->locality }}</td>
       <td>{{ $data->store_total_payment }} $</td>
       <td>{{ $data->store_tax }} %</td>
       <td>{{ $data->store_tax_price }} $</td>
       <td> {{ $data->store_price }} $ </td>
       <td>@if(!empty($data->store_paid_price)){{ $data->store_paid_price }} $  @else
        {{ $data->store_paid_price }}
@endif</td>
       <td>@if(!empty($data->store_unpaid_price))
        {{ $data->store_unpaid_price }} $

    @else
        {{ $data->store_unpaid_price }}
@endif</td>


<td>                                                    
    <a href="{{url('admin/store-wise-pdf-payout/'.$data->id.'?from_date='.Request::Input('from_date').'&to_date='.Request::Input('to_date'))}}"><button class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-download mx-1 text-secondar"></i></button></a>
    <a href="{{ url('admin/store-payout-list/'.$data->id.'?from_date='.Request::Input('from_date').'&to_date='.Request::Input('to_date')) }}"><button class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-eye mx-1 text-secondar"></i></button></a>
    <a href="{{url('admin/store-wise-excel-payout/'.$data->id.'?from_date='.Request::Input('from_date').'&to_date='.Request::Input('to_date'))}}"><button class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-file-excel mx-1 text-secondar"></i></button></a>




</td>
</tr>
@endforeach
@endif

</tbody>
</table>
<div class="card-body">
    @if(!empty($view))
    {!! $view->appends(request()->query())->render() !!}
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