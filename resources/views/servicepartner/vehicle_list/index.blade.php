@extends('servicepartner.layouts.app')
@section('title',"All Vehicles | Service Partner Mande Clan")

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

      
@if($records->total() < 1)
                                 <a href="{{url('service-partner/vehicle-list/create')}}" class="form-inline float-right mt--1 d-none d-md-flex">
                                       <button class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create a Vehicle</button>
                                    </a>
@endif
         <h1 class="h3 mb-3"> Vehicles &nbsp;&nbsp;@if(!empty($records))({{$records->total()}})@endif</h1>
     </div>

     <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="col-md">
                    {{Form::open(['url'=>['service-partner/vehicle-list'],'method'=>'GET'])}}
                    
                    @if(!empty($delivery_Vehicles))
                    {!!Form::select('search',$delivery_Vehicles,Request::input('search'),array('class'=>'form-control select2','placeholder'=>'Search','data-toggle'=>'select2','onchange'=>'this.form.submit()','id'=>'test_skill')) !!}

                    @endif

                    
                    {{Form::close()}}
                </div>
                <div class="col-md">

                </div>
                <div class="col-md">
                    <div class="form-group">
                        {{Form::open(['url'=>['service-partner/vehicle-list'],'method'=>'GET'])}}

                        <div class="input-group">

                          {!!Form::text('search',Request::input('search'),array('class'=>'form-control','placeholder'=>'Search..','onchange'=>'this.form.submit()','autocomplete'=>'off')) !!}
                          
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
            <th width="3%">Sr.</th>
            <th width="10%">Date</th>
            <th width="10%">User Id</th>
            <th width="10%">Vehicle Type</th>
            <th width="10%">Vehicle No</th>
            <th width="10%">Vehicle Modal No</th>
            <th width="10%">Vehicle Id</th>
            <th width="10%">Insurence Expiry</th>
            <th width="10%">Plan Name</th>
            <th width="10%">Status</th> <th width="15%">Action</th>                         
        </tr>
    </thead>
    <tbody>


        @if(!empty($records))
        @foreach($records as $index => $data)
        <tr class="deleteRow">
            <td>{{$index+1}}</td>   
            <td>{{date("d-m-Y", strtotime($data->created_at))}}</td>
            <td>{{$data->vehicle_userid}}</td>

            <td >  {{$data->vehicle_type}}</td>

            <td>{{$data->vehicle_no}}</td>
            <td>{{$data->vehicle_modal_no}}</td>
            <td>{{$data->vehicle_unique_id}}</td>
            <td>{{$data->insurance_expiry_date}}</td>

            <td>{{$data->vehicle_package}} ({{$data->vehicle_package_for}})</td>
            <td>

             @if($data->status ==  'Active')
<span class="badge badge-success">Approved</span>
{{--              <input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="Deactive" data-onstyle="success" data-offstyle="danger" id="{{$data->id}}" class="checkstatus" onchange="updateToggle({{$data->id}})">
 --}}             @elseif($data->status ==  'Deactive')
{{--              <input type="checkbox" data-toggle="toggle" data-on="Active" data-off="Deactive" data-onstyle="success" data-offstyle="danger" id="{{$data->id}}" class="checkstatus" onchange="updateToggle({{$data->id}})">
 --}}  

<span class="badge badge-danger">Pending</span>

            @endif

         </td>
         <td>                                                    
                       <a href="{{ URL::to('service-partner/vehicle-list/'.$data->id.'/edit') }}"><button class="btn btn-info" data-toggle="tooltip" data-placement="top" title="edit"><i class="fas fa-edit"></i></button></a>
                                
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
<script type="text/javascript">
   $(".clickable-row").click(function() {
    window.location = $(this).data("href");
});
</script>
@endpush