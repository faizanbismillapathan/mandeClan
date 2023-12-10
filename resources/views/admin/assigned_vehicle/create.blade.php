@extends('admin.layouts.app')
@section('title',"Create New Assigned Vehicle | Admin Mande Clan")

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
      <a href="{{url('admin/assigned-vehicle')}}" class="form-inline float-right mt--1 d-none d-md-flex">
        <button class="btn btn-info"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Back</button>
      </a>

      <h1 class="h3 mb-3"><b>Assign Vehicle To Rider</b></h1>

    </div>
    <div class="card">

      <div class="card-body">

       <fieldset class="scheduler-border">
        <legend class="scheduler-border">Vehicle Information &nbsp;:</legend>
        <div class="form-row">

         <div class="form-group col-md-4">
          <div class="row">
            <div class="col-md-4"><b>Vehicle Created Date</b></div>
            <div class="col-md-1"><b>:</b></div>
            <div class="col-md-6">12-12-2020</div>
          </div>         
        </div>

        <div class="form-group col-md-4">
          <div class="row">
            <div class="col-md-4"><b>Vehicle Unique Id</b></div>
            <div class="col-md-1"><b>:</b></div>
            <div class="col-md-6">{{$vehicle_record->vehicle_unique_id}}
            </div>
          </div>         
        </div>

        <div class="form-group col-md-4">
          <div class="row">
            <div class="col-md-4"><b>Vehicle Owner Id</b></div>
            <div class="col-md-1"><b>:</b></div>
            <div class="col-md-6">{{$vehicle_record->vehicle_userid}}</div>
          </div>         
        </div>

        <div class="form-group col-md-4">
          <div class="row">
            <div class="col-md-4"><b>Vehicle Type</b></div>
            <div class="col-md-1"><b>:</b></div>
            <div class="col-md-6">{{$vehicle_record->vehicle_type}}</div>
          </div>         
        </div>
        <div class="form-group col-md-4">
          <div class="row">
            <div class="col-md-4"><b>Vehicle Number</b></div>
            <div class="col-md-1"><b>:</b></div>
            <div class="col-md-6">{{$vehicle_record->vehicle_no}} </div>
          </div>         
        </div>
        <div class="form-group col-md-4">
          <div class="row">
            <div class="col-md-4"><b>Vehicle Modal No</b></div>
            <div class="col-md-1"><b>:</b></div>
            <div class="col-md-6">{{$vehicle_record->vehicle_modal_no}} </div>
          </div>         
        </div>


        <div class="form-group col-md-4">
          <div class="row">
            <div class="col-md-4"><b>Vehicle Plan</b></div>
            <div class="col-md-1"><b>:</b></div>
            <div class="col-md-6">{{$vehicle_record->vehicle_package}} </div>
          </div>         
        </div>

        <div class="form-group col-md-4">
          <div class="row">
            <div class="col-md-4"><b>Vehicle Registered No</b></div>
            <div class="col-md-1"><b>:</b></div>
            <div class="col-md-6">{{$vehicle_record->vehicle_registered_no}} </div>
          </div>         
        </div>

        <div class="form-group col-md-4">
          <div class="row">
            <div class="col-md-4"><b>Vehicle Registered Years</b></div>
            <div class="col-md-1"><b>:</b></div>
            <div class="col-md-6">{{$vehicle_record->vehicle_registered_year}} </div>
          </div>         
        </div>

        <div class="form-group col-md-4">
          <div class="row">
            <div class="col-md-4"><b>Vehicle Front Image</b></div>
            <div class="col-md-1"><b>:</b></div>
            <div class="col-md-6"><img src="{{asset('public/images/vehicle_image/'.$vehicle_record->vehicle_front_img)}}" width="80px" height="60px"> </div>
          </div>         
        </div>


        <div class="form-group col-md-4">
          <div class="row">
            <div class="col-md-4"><b>Vehicle Back Image</b></div>
            <div class="col-md-1"><b>:</b></div>
            <div class="col-md-6"><img src="{{asset('public/images/vehicle_image/'.$vehicle_record->vehicle_back_img)}}" width="80px" height="60px"> </div>
          </div>         
        </div>


        <div class="form-group col-md-4">
          <div class="row">
            <div class="col-md-4"><b>Vehicle Side Image</b></div>
            <div class="col-md-1"><b>:</b></div>
            <div class="col-md-6"><img src="{{asset('public/images/vehicle_image/'.$vehicle_record->vehicle_side_img)}}" width="80px" height="60px"> </div>
          </div>         
        </div>


        <div class="form-group col-md-4">
          <div class="row">
            <div class="col-md-4"><b>Vehicle Insurance file</b></div>
            <div class="col-md-1"><b>:</b></div>
            <div class="col-md-6"> <a href="{{asset('public/images/vehicle_image/'.$vehicle_record->vehicle_insurance_file)}}" target="_blank"> {{$vehicle_record->vehicle_insurance_file}}</a> </div>
          </div>         
        </div>


        <div class="form-group col-md-4">
          <div class="row">
            <div class="col-md-4"><b>Vehicle Insurance Expiry date</b></div>
            <div class="col-md-1"><b>:</b></div>
            <div class="col-md-6">{{$vehicle_record->insurance_expiry_date}} </div>
          </div>         
        </div>


        <div class="form-group col-md-4">
          <div class="row">
            <div class="col-md-4"><b>Vehicle Rc book</b></div>
            <div class="col-md-1"><b>:</b></div>
            <div class="col-md-6"><a href="{{asset('public/images/vehicle_image/'.$vehicle_record->vehicle_rc_book_img)}}" width="80px" height="60px" target="_blank"> {{$vehicle_record->vehicle_rc_book_img}}</a> </div>
          </div>         
        </div>



        <div class="form-group col-md-4">
          <div class="row">
            <div class="col-md-4"><b>Vehicle RC No</b></div>
            <div class="col-md-1"><b>:</b></div>
            <div class="col-md-6">{{$vehicle_record->vehicle_rc_no}} </div>
          </div>         
        </div>


        <div class="form-group col-md-4">
          <div class="row">
            <div class="col-md-4"><b>Vehicle Location</b></div>
            <div class="col-md-1"><b>:</b></div>
            <div class="col-md-6">{{$vehicle_record->vehicle_driving_location}} </div>
          </div>         
        </div>




        <div class="form-group col-md-4">
          <div class="row">
            <div class="col-md-4"><b>Vehicle availability</b></div>
            <div class="col-md-1"><b>:</b></div>
            <div class="col-md-6">{{$vehicle_record->vehicle_availability}} </div>
          </div>         
        </div>


        <div class="form-group col-md-4">
          <div class="row">
            <div class="col-md-4"><b>Vehicle Assign Rider Id</b></div>
            <div class="col-md-1"><b>:</b></div>
            <div class="col-md-6">{{$vehicle_record->assign_rider_u_id}} </div>
          </div>         
        </div>


      </div>
    </fieldset>



    <div class="row">
      <div class="col-md-8">
      </div>
      <div class="col-md-4">
        <div class="form-group pull-right">
          {{Form::open(['url'=>['admin/assigned-vehicle/'.$vehicle_record->id],'method'=>'GET'])}}

          <div class="input-group">

            {!!Form::text('search',Request::input('search'),array('class'=>'form-control','placeholder'=>'Search by Name ,Id..','onchange'=>'this.form.submit()','autocomplete'=>'off')) !!}

            <span class="input-group-append">
              <button class="btn btn-secondary" type="button">Enter!</button>
            </span>                         
          </div>
          {{Form::close()}}

        </div>
      </div>
    </div>      <fieldset class="scheduler-border">
      <legend class="scheduler-border">Available Riders &nbsp;:</legend>
      <table class="table table-striped table-hover table-sm table-bordered" >
        <thead>
          <tr>
            <th width="5%">Sr.</th>
            <th width="15%">Rider Name</th>
            <th width="12%">Rider Id</th>
            <th width="12%">Rider Location</th>
            <th width="12%">License Type</th>
            <th width="12%">License Expiry Date</th>
            <th width="12%">Action</th>                         
          </tr>
        </thead>
        <tbody>
          @if(!empty($rider_records))
          @foreach($rider_records as $index=>$data)
          <tr class="deleteRow">
            <td>{{$index+1}}</td>   
            <td>{{$data->rv_user_name}} 
              @if($vehicle_record->vehicle_owner_id==$data->rv_id)
              <span class="badge badge-info">Owner</span>
              @endif
            </td>   
            <td><a href="{{url('admin/delivery-rider/'.$data->rv_id.'/edit')}}">{{$data->rv_user_userid}}</a></td>   
            <td>{{$data->city_name}}</td>   
            <td>{{$data->driving_license_type}}</td>   
            <td>{{date("d-m-Y", strtotime($data->rider_driving_expiry_date))}}</td>   

<!--    @if(!empty($data->assign_rider_u_id))
  <td class="text-success">Assigned</td>
            @else
    <td><button  class="btn btn-success click_assign_now" rv_id="{{$data->rv_id}}" rider_id="{{$data->id}}" vehicle_id="{{$vehicle_record->id}}"  rider_u_id="{{$data->rv_user_userid}}"  rider_plan_id="{{$data->rider_plan_id}}">Assign Now</button></td>

            @endif -->

 <td>
             @if($data->rider_availability ==  'Available')
<input type="checkbox" checked data-toggle="toggle" data-on="Assign Now" data-off="UnAssign Now" data-onstyle="success" data-offstyle="danger"  class="click_assign_now" onchange="updateToggleNew({{$data->rv_id}} ,{{$data->id}},{{$vehicle_record->id}} ,'{{$data->rv_user_userid}}' ,{{$data->rider_plan_id}},'Un Assign' )">

@elseif($data->rider_availability ==  'Not Available')
<input type="checkbox" data-toggle="toggle" data-on="Assign Now" data-off="UnAssign Now" data-onstyle="success" data-offstyle="danger"  class="click_assign_now" onchange="updateToggleNew({{$data->rv_id}} ,{{$data->id}},{{$vehicle_record->id}} ,'{{$data->rv_user_userid}}' ,{{$data->rider_plan_id}},'Assign')">
@endif

 </td>


          </tr>  
          @endforeach
          @endif

        </tbody>
      </table>
    </fieldset>

  </div>
</div>
</div>
</main>
@endsection

<!-- ................push new js link................. -->

@push('js')

<script src="{{asset('public/js/validation.js')}}"></script>
<script type="text/javascript">

 function updateToggleNew(rv_id,rider_id,vehicle_id,rider_u_id,rider_plan_id,status) {




   var clickDisbled = $(this);

   var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
   swal({
    title: 'Are you sure?',
    text: "You want to "+status+" it! ",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, '+status+' it!'
  },
  function() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
     type:"POST",           
     url:"{{url('admin/assigned_vehicle_to_rider')}}",
     data:{_token: CSRF_TOKEN,rider_id:rider_id,vehicle_id:vehicle_id,rv_id:rv_id,rider_u_id:rider_u_id,rider_plan_id:rider_plan_id},
 dataType:'JSON',
           dataType: 'json',

     success: function(neww){

console.log(neww)
       // clickDisbled.parents('.deleteRow').fadeOut(1500);

       swal(
        ''+status+'!',
        'Your record has been '+status+'.',
        'success'
        );
     }


   });
  });
 
 }

</script>


@endpush