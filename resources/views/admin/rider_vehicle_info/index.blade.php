@extends('admin.layouts.app')
@section('title',"All Rider / Vehicle | Admin Mande Clan")

<!-- ................custom css................. -->

@section('customStyle')
@endsection

<!-- ................Add css link................. -->

@push('style')
<style type="text/css">
    .default_cls{

    background-color: #ccc!important;

}
</style>
@endpush

<!-- ................body................. -->
@section('innercontent')

<main class="content">
    <div class="container-fluid p-0">

        <div class="clearfix">

           <a href="{{url('admin/rider-vehicle-info/create')}}" class="form-inline float-right mt--1 d-none d-md-flex">
             <button class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create a New Rider / Vehicle</button>
         </a>

         <h1 class="h3 mb-3"> Rider / Vehicle &nbsp;&nbsp;@if(!empty($records))({{$records->total()}})@endif</h1>
     </div>

     <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md">
                    {{Form::open(['url'=>['admin/rider-vehicle-info'],'method'=>'GET'])}}
                    
                    @if(!empty($delivery_riders))
                    {!!Form::select('search',$delivery_riders,Request::input('search'),array('class'=>'form-control select2','placeholder'=>'Search','data-toggle'=>'select2','onchange'=>'this.form.submit()','id'=>'test_skill')) !!}

                    @endif

                    
                    {{Form::close()}}
                </div>
                <div class="col-md">
                    
                </div>
                <div class="col-md">
                    <div class="form-group">
                        {{Form::open(['url'=>['admin/rider-vehicle-info'],'method'=>'GET'])}}

                        <div class="input-group">

                          {!!Form::text('search',Request::input('search'),array('class'=>'form-control','placeholder'=>'Search by Rider / Vehicle..','onchange'=>'this.form.submit()','autocomplete'=>'off')) !!}
                          
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
            <th width="10%">Id</th>
            <th width="12%">Name</th>
            <th width="10%">Mobile</th>
            <!-- <th width="10%">Email</th> -->
            <th width="10%">Gender</th>
            <th width="10%">City</th>
            <th width="10%">Type</th>
              <th width="9%">Kyc Status</th>
            <th width="10%">Status</th> <th width="15%">Action</th>                         
        </tr>
    </thead>
    <tbody>
        
        
        @if(!empty($records))
        @foreach($records as $index => $data)
        <tr class="deleteRow  {{ $data->user_status=='Default' ? 'default_cls' : '' }}">
            <td>{{$index+1}}</td>   
            <td>{{date("d-m-Y", strtotime($data->created_at))}}</td>
            <td>{{$data->rv_user_userid}}</td>

            <td >  {{$data->rv_user_name}}</td>


            <td>{{$data->rv_user_mobile}}</td>
            <!-- <td>{{$data->rv_user_email}}</td> -->
            <td>{{$data->rv_user_gender}}</td>
                        <td>{{$data->city_name}} ,({{$data->locality_name}})</td>

            <td><span class="badge badge-info">{{$data->rv_user_type}}</span></td>

            <td>


@if($data->kyc_status ==  'Active' && $data->user_status !='Default')

<input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="Deactive" data-onstyle="success" data-offstyle="danger" id="{{$data->id}}" class="checkstatus_kyc" onchange="updateToggle1({{$data->id}})">
@elseif($data->kyc_status ==  'Deactive' && $data->user_status !='Default')
<input type="checkbox" data-toggle="toggle" data-on="Active" data-off="Deactive" data-onstyle="success" data-offstyle="danger" id="{{$data->id}}" class="checkstatus_kyc" onchange="updateToggle1({{$data->id}})">
@else

<span class="badge badge-info">{{$data->kyc_status}}</span>

@endif

</td>

@if($data->user_status=='Default')

<td><span class="badge badge-success"> Demo Account</span> </td>

@else
            <td>
                
               @if($data->status ==  'Active')

               <input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="Deactive" data-onstyle="success" data-offstyle="danger" id="{{$data->id}}" class="checkstatus" onchange="updateToggle({{$data->id}})">
               @elseif($data->status ==  'Deactive')
               <input type="checkbox" data-toggle="toggle" data-on="Active" data-off="Deactive" data-onstyle="success" data-offstyle="danger" id="{{$data->id}}" class="checkstatus" onchange="updateToggle({{$data->id}})">
               @endif

           </td>
           @endif
           <td>                                                    
            <a href="{{ URL::to('admin/rider-vehicle-info/'.$data->id.'/edit') }}"><button class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></button></a>
            
         @if($data->user_status!='Default')     <button class="btn btn-danger click_disbled"  data-toggle="tooltip" data-placement="top" title="Delete"  data="{{$data->id}}"><i class="fas fa-trash-alt"></i></button>   @endif                                
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