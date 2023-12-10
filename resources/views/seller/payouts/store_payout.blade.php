@extends('seller.layouts.app')
@section('title',"Store Payout List | seller Mande Clan")

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



             {{Form::open(['url'=>['seller/store-payout/'.Request::segment(3).'?from_date='.Request::Input('from_date').'&to_date='.Request::Input('to_date')],'method'=>'GET'])}}

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
</div>

<div class="col-md">
              <div class="float-right">

                <a href="{{ url('seller/store-item-wise-payout?from_date='.Request::Input('from_date').'&to_date='.Request::Input('to_date').'&store_id='.$record->id) }}">
                    <button class="btn btn-success" type="button">
                        View All
                    </button>
                </a>
            </div>
        </div>
    </div>

    {{ Form::close() }}



                </div>

                <table class="table table-bordered table-striped table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>Date</th>
                            <th>Order no.</th>
                            <th>Total Item</th>
                            <th>Weight</th>
                            <th>Price</th>
                            <th>Delevery</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        @if(!empty($records))
                        @foreach($records as $index=>$data)
                        <tr>
                        <td>{{date("d-m-Y", strtotime($data->created_at))}}</td>
                        <th scope="row">{{ $data->suborder_u_id }}</th>
                        <td><a href="{{ url('seller/store-item-wise-payout/'.$data->id.'?from_date='.Request::Input('from_date').'&to_date='.Request::Input('to_date').'&store_id='.$data->store_id) }}">{{ $data->total_item }}</a></td>
                        <td>{{ $data->total_item_weight }} kg</td>
                        <td>{{ $data->total_item_price }} $</td>
                        <td>{{ $data->delevery_status }}</td>
                        <td>
@if($data->Status=='Paid')

<span class="badge badge-success"> {{ $data->Status }}</span>
@else
<span class="badge badge-danger"> {{ $data->Status }}</span>

@endif                           </td>
                        <td>
                        {{-- <i class="fa fa-download mx-1 text-secondary" aria-hidden="true"></i>
                        <i class="fa fa-eye mx-1 text-info" aria-hidden="true" data-toggle="modal"
                        data-target=".bd-example-modal-lg"></i>
                        <i class="fa fa-file-excel mx-1 text-success" aria-hidden="true"></i> --}}




<a href="{{ url('seller/store-item-wise-pdf-payout/'.$data->id.'?from_date='.Request::Input('from_date').'&to_date='.Request::Input('to_date').'&store_id='.$data->store_id) }}"><button class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-download mx-1 text-secondar"></i></button></a>
<a href="{{ url('seller/store-item-wise-payout/'.$data->id.'?from_date='.Request::Input('from_date').'&to_date='.Request::Input('to_date').'&store_id='.$data->store_id) }}"><button class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-eye mx-1 text-secondar"></i></button></a>
<a href="{{url('seller/store-item-wise-excel-payout/'.$data->id.'?from_date='.Request::Input('from_date').'&to_date='.Request::Input('to_date').'&store_id='.$data->store_id)}}"><button class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-file-excel mx-1 text-secondar"></i></button></a>



                        </td>
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