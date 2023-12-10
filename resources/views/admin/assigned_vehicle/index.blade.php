@extends('admin.layouts.app')
@section('title',"All Assigned Vehicle | Admin Mande Clan")

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
                    {{Form::open(['url'=>['admin/assigned-vehicle'],'method'=>'GET'])}}

                    @if(!empty($assignedvehicle_names))
                    {!!Form::select('search',$assignedvehicle_names,null,array('class'=>'form-control select2','placeholder'=>'Search','data-toggle'=>'select2','onchange'=>'this.form.submit()')) !!}
                    @endif


                    {{Form::close()}}
                </div>
                <div class="col-md">

                </div>
                <div class="col-md">
                    <div class="form-group">
                        {{Form::open(['url'=>['admin/assigned-vehicle'],'method'=>'GET'])}}

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


        <table class="table table-striped table-hover table-sm table-bordered table-responsive" >
            <thead>
                <tr>
                    <th width="5%">Sr.</th>
                    <th width="12%">Date</th>
                    <th width="12%">Vehicle Id</th>
                    <th width="12%">Type Of Vehicle</th>
                    <th width="12%">Vehicle Owner Id</th>
                    <th width="12%">Assign Rider Id</th>
                    <th width="12%">Vehicle Location</th>
                    <th width="12%">Vehicle Rent Plan</th>
                    
                <!-- <th width="12%">Action</th>                          -->
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
        <td>
            @if($data->vehicle_availability=='Available')
            <a href="{{url('admin/assigned-vehicle/'.$data->id)}}">Assign Now</a>
            @else
{{$data->assign_rider_u_id}}

            @endif
        </td>
                    <td>{{$data->vehicle_driving_location}}</td>   
                    <td>{{$data->vehicle_package}}</td>   
                

                    <td>  <a href="{{ URL::to('admin/assigned-vehicle/'.$data->id.'/edit') }}"><button class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></button></a>

                   <!--      <button class="btn btn-danger click_disbled"  data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash-alt"></i></button></td>   --> </tr>
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