@extends('servicepartner.layouts.app')
@section('title',"All Assigned Vehicle | Service Partner Mande Clan")

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




        <h1 class="h3 mb-3">Assign Vehicle to Rider &nbsp;&nbsp;@if(!empty($records))({{$records->total()}})@endif</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md">
                    {{Form::open(['url'=>['service-partner/assigned-vehicle'],'method'=>'GET'])}}

                    @if(!empty($assignedvehicle_names))
                    {!!Form::select('search',$assignedvehicle_names,null,array('class'=>'form-control select2','placeholder'=>'Search','data-toggle'=>'select2','onchange'=>'this.form.submit()')) !!}
                    @endif


                    {{Form::close()}}
                </div>
                <div class="col-md">

                </div>
                <div class="col-md">
                    <div class="form-group">
                        {{Form::open(['url'=>['service-partner/assigned-vehicle'],'method'=>'GET'])}}

                        <div class="input-group">

                            {!!Form::text('search',Request::input('search'),array('class'=>'form-control','placeholder'=>'Search by Assigned Vehicle..','onchange'=>'this.form.submit()','autocomplete'=>'off')) !!}

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


        <table class="table table-striped table-hover table-sm table-bordered" >
            <thead>
                <tr>
                    <th width="5%">Sr.</th>
                    <th width="12%">Date</th>
                    <th width="12%">Vehicle Id</th>
                    <th width="12%">Type Of Vehicle</th>
                    <th width="12%">Vehicle Owner Id</th>
                    <th width="12%">Vehicle Number</th>
                    <th width="12%">Vehicle Location</th>
                    <th width="12%">Modal No</th>
                    
                </tr>
            </thead>
            <tbody>
                                @if(!empty($records))
                @foreach($records as $index => $data)
        <tr class="deleteRow">
            <td>{{$index+1}}</td>   
            <td>{{date("d-m-Y", strtotime($data->created_at))}}</td>
            <td>{{$data->vehicle_unique_id}}</td>
            <td>{{$data->vehicle_type}}</td>
            <td>{{$data->vehicle_userid}}</td>
            <td>{{$data->vehicle_no}}</td>

                    <td>{{$data->vehicle_driving_location}}</td>   
                    <td>{{$data->vehicle_modal_no}}</td>   
                

                    <td>  <a href="{{ URL::to('service-partner/assigned-vehicle/'.$data->id.'/edit') }}"><button class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="View"><i class="fas fa-eye"></i></button></a>

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