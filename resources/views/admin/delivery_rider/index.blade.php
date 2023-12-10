@extends('admin.layouts.app')
@section('title',"All Delivery Rider | Admin Mande Clan")

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

 <a href="{{url('admin/delivery-rider/create')}}"  class="form-inline float-right mt--1 d-none d-md-flex">
             <button class="btn btn-info"><i class="fa fa-plus-circle"></i> Create new Rider</button>
         </a>

           <!-- <a href="{{url('admin/delivery-rider/create')}}" class="form-inline float-right mt--1 d-none d-md-flex">
             <button class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create a New Delivery Rider</button>
         </a> -->

         <h1 class="h3 mb-3"> Delivery Rider &nbsp;&nbsp;@if(!empty($records))({{$records->total()}})@endif</h1>
     </div>

     <div class="card">
        <div class="card-body">
                     
            <div class="row">
                <div class="col-md">
                    {{Form::open(['url'=>['admin/delivery-riders'],'method'=>'GET'])}}
                    
                    @if(!empty($delivery_riders))
                    {!!Form::select('search',$delivery_riders,Request::input('search'),array('class'=>'form-control select2','placeholder'=>'Search','data-toggle'=>'select2','onchange'=>'this.form.submit()','id'=>'test_skill')) !!}

                    @endif

                    
                    {{Form::close()}}
                </div>
                <div class="col-md">
                    
                </div>
                <div class="col-md">
                    <div class="form-group">
                        {{Form::open(['url'=>['admin/delivery-rider'],'method'=>'GET'])}}

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
            <th width="10%">UserId</th>
            <th width="12%">LicenceNo</th>
            <th width="10%">Licence Expiry</th>
            <th width="10%">Localtion</th>
            <th width="10%">Total Order</th>
            <th width="10%">Status</th> <th width="15%">Action</th>                         
        </tr>
    </thead>
    <tbody>
        
        
        @if(!empty($records))
        @foreach($records as $index => $data)
        <tr class="deleteRow">
            <td>{{$index+1}}</td>   
            <td>{{date("d-m-Y", strtotime($data->created_at))}}</td>
           <td style="color: #e91e63;text-decoration :underline; " data-toggle="tooltip" data-placement="top" title="Go to Delivery Rider Panel" class=" clickable-row" data-href="{{ URL::to('service-partner/dashboard/'.$data->id) }}" data-underline>{{$data->rider_userid}} <br> {{$data->rv_user_name}} <br>{{$data->rv_user_mobile}} </td>

<td>{{$data->rider_driving_license_no}}</td>
<td>{{$data->rider_driving_expiry_date}}</td>



         
                        <td>{{$data->city_name}}</td>

            <td><span class="badge badge-success">00</span></td>
            <td>
                
               @if($data->status ==  'Active')

               <input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="Deactive" data-onstyle="success" data-offstyle="danger" id="{{$data->id}}" class="checkstatus" onchange="updateToggle({{$data->id}})">
               @elseif($data->status ==  'Deactive')
               <input type="checkbox" data-toggle="toggle" data-on="Active" data-off="Deactive" data-onstyle="success" data-offstyle="danger" id="{{$data->id}}" class="checkstatus" onchange="updateToggle({{$data->id}})">
               @endif

           </td>
           <td>                                                    
            <a href="{{ URL::to('admin/delivery-rider/'.$data->id.'/edit') }}"><button class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></button></a>
            
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
<script type="text/javascript">
     $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
</script>
@endpush