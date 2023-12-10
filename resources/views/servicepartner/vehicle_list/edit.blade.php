@extends('servicepartner.layouts.app')
@section('title',"Update New Vehicle | servicepartner Mande Clan")

<!-- ................custom css................. -->

@section('customStyle')

@endsection

<!-- ................Add css link................. -->

@push('style')
<link rel="stylesheet" href="{{asset('public/css/bootstrap-fileupload.css')}}">

@endpush

<!-- ................body................. -->
@section('innercontent')


<main class="content">
  <div class="container-fluid p-0">
    <div class="clearfix">
      <a href="{{url('servicepartner/vehicles')}}" class="form-inline float-right mt--1 d-none d-md-flex">
        <button class="btn btn-info"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Back</button>
      </a>

      <h1 class="h3 mb-3"><b>Update Vehicle</b></h1>

    </div>
    <div class="card">

      <div class="card-body">

  <fieldset class="scheduler-border">
  <legend class="scheduler-border">Update Vehicle &nbsp;:</legend>

<div class="vehicle_form" > 

 @if(!empty($record_vehicle))
       {!! Form::model($record_vehicle,array('url' => ['service-partner/vehicle-list', $record_vehicle->id],'method'=>'PATCH','class'=>'','id' =>'comman_form_id','files'=>'true')) !!}
      
       @endif

          <input type="hidden" name="id" value="{{$record_vehicle->id}}">

      <div class="form-row" >
        <div class="form-group col-md-4">
          <label for="inputEmail4">Select Type of Vehicle</label>                                                   
          {!!Form::select('vehicle_type',$vehicle_names,null,array('class'=>'form-control select2','placeholder'=>'Select State','id'=>'','data-toggle'=>'select2','autocomplete'=>'off','required')) !!}
        </div>


        <div class="form-group col-md-4">
          <label for="inputEmail4">Vehicle No</label>                                                   
          {!!Form::text('vehicle_no',null,array('class'=>'form-control','placeholder'=>'Enter Vehicle No','autocomplete'=>'off','required')) !!} 
        </div>

        <div class="form-group col-md-4">
          <label for="inputEmail4">Vehicle Modal no</label>                                                   
          {!!Form::text('vehicle_modal_no',null,array('class'=>'form-control','placeholder'=>'Enter Modal no','autocomplete'=>'off','required')) !!} 
        </div>

        <div class="form-group col-md-4">
          <label for="inputEmail4">Vehicle Registered No</label>                                                   
          {!!Form::text('vehicle_registered_no',null,array('class'=>'form-control','placeholder'=>'Enter Registered No','autocomplete'=>'off','required')) !!} 
        </div>

        <div class="form-group col-md-4">
          <label for="inputEmail4">Vehicle Registered Year</label>                        
              {!!Form::text('vehicle_registered_year',null,array('class'=>'form-control','placeholder'=>'YYYY','autocomplete'=>'off','required','data-mask'=>'0000')) !!} 
                           
        </div>



  <div class="form-group col-md-4">
    <label for="inputEmail4">Vehicle Insurance </label>                                                   
    {{ Form::file('vehicle_insurance_file',null, ['class' => 'form-control','required','accept'=>"image/*"]) 
  }}   <a href="{{asset('public/images/vehicle_image/'.$record_vehicle->vehicle_insurance_file)}}" target="_blank"> {{$record_vehicle->vehicle_insurance_file}}</a>

  </div>

  <div class="form-group col-md-4">
    <label for="inputEmail4">Insurance Expiry Date</label>                   {!!Form::text('insurance_expiry_date',null,array('class'=>'datepicker-here form-control createddateformat','placeholder'=>'Enter Role','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd','data-language'=>'en','required')) !!} 
</div>
  <div class="form-group col-md-4">
    <label for="inputEmail4">RC BOOk Image</label>                                                   
    {{ Form::file('vehicle_rc_book_img',null, ['class' => 'form-control','required','accept'=>"image/*"]) }}
 <a href="{{asset('public/images/vehicle_image/'.$record_vehicle->vehicle_rc_book_img)}}" target="_blank"> {{$record_vehicle->vehicle_rc_book_img}}</a>
  </div>

  <div class="form-group col-md-4">
    <label for="inputEmail4">Enter Rc No</label>                                                   
    {!!Form::text('vehicle_rc_no',null,array('class'=>'form-control','placeholder'=>'Enter Rc No','autocomplete'=>'off','required')) !!} 
  </div>


  <div class="form-group col-md-4">
    <label for="inputEmail4"> Select Plan</label>                                                   
    {!!Form::select('vehicle_package',$package_names,null,array('class'=>'form-control select2','placeholder'=>'Select State','id'=>'','data-toggle'=>'select2','autocomplete'=>'off','required')) !!}
  </div>
  <div class="form-group col-md-4">
    <label for="inputEmail4"> Select Plan For</label>                                                   
    {!!Form::select('vehicle_package_for',['Hourly'=>'Hourly','Daily'=>'Daily','Weekly'=>'Weekly','Monthly'=>'Monthly'],null,array('class'=>'form-control select2','placeholder'=>'Select State','id'=>'','data-toggle'=>'select2','autocomplete'=>'off','required')) !!}
  </div>

  <div class="form-group col-md-4">
    <label for="inputEmail4">Select Location</label>                                                   
    {!!Form::select('vehicle_driving_location',$locations,null,array('class'=>'form-control select2','placeholder'=>'Select State','id'=>'','data-toggle'=>'select2','autocomplete'=>'off','required')) !!}
  </div>


<!--   <div class="form-group col-md-4">
  </div>
 -->
 <div class="form-group col-md-4 ">
         <div class="form-group author-img-bx">

          <label>Front Vehicle Image</label>             

          <div class="fileupload fileupload-new" data-provides="fileupload">
            <div class="fileupload-new img-thumbnail" style="width: 180px; height: 120px;">
              @if(!empty($record_vehicle->vehicle_front_img))
             <img src="{{ asset('public/images/vehicle_image/'.$record_vehicle->vehicle_front_img)}}" alt="dd" />

              @else
             <img src="{{ asset('public/img/no-image.png')}}" alt="dd" />

              @endif
           </div>
           <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 180px; max-height: 120px; line-height: 20px;"></div>
           <div class="row">
             <div class="col-md-12">
              <button type="button" class="btn btn-secondary" style="padding: 0px; background-color: #fff;"><span class="btn btn-default btn-file">
                <span class="btn btn-secondary fileupload-new">Choose image</span>
                <span  class="btn btn-secondary fileupload-exists">Change</span>

                {{ Form::file('vehicle_front_img',null, ['class' => 'form-control','required']) }}</span>

                <a class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a></button>

              </div>

            </div>
          </div>
        </div>

      </div>



      <div class="form-group col-md-4 ">
       <div class="form-group author-img-bx">

        <label>Back Vehicle Image</label>             

        <div class="fileupload fileupload-new" data-provides="fileupload">
          <div class="fileupload-new img-thumbnail" style="width: 180px; height: 120px;">
             @if(!empty($record_vehicle->vehicle_back_img))
             <img src="{{ asset('public/images/vehicle_image/'.$record_vehicle->vehicle_back_img)}}" alt="dd" />

              @else
             <img src="{{ asset('public/img/no-image.png')}}" alt="dd" />

              @endif
         </div>
         <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 180px; max-height: 120px; line-height: 20px;"></div>
         <div class="row">
           <div class="col-md-12">
            <button type="button" class="btn btn-secondary" style="padding: 0px; background-color: #fff;"><span class="btn btn-default btn-file">
              <span class="btn btn-secondary fileupload-new">Choose image</span>
              <span  class="btn btn-secondary fileupload-exists">Change</span>

              {{ Form::file('vehicle_back_img',null, ['class' => 'form-control','required']) }}</span>

              <a class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a></button>

            </div>

          </div>
        </div>
      </div>

    </div>




    <div class="form-group col-md-4 ">
     <div class="form-group author-img-bx">

      <label>Side Vehicle Image</label>             

      <div class="fileupload fileupload-new" data-provides="fileupload">
        <div class="fileupload-new img-thumbnail" style="width: 180px; height: 120px;">
           @if(!empty($record_vehicle->vehicle_side_img))
             <img src="{{ asset('public/images/vehicle_image/'.$record_vehicle->vehicle_side_img)}}" alt="dd" />

              @else
             <img src="{{ asset('public/img/no-image.png')}}" alt="dd" />

              @endif
       </div>
       <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 180px; max-height: 120px; line-height: 20px;"></div>
       <div class="row">
         <div class="col-md-12">
          <button type="button" class="btn btn-secondary" style="padding: 0px; background-color: #fff;"><span class="btn btn-default btn-file">
            <span class="btn btn-secondary fileupload-new">Choose image</span>
            <span  class="btn btn-secondary fileupload-exists">Change</span>

            {{ Form::file('vehicle_side_img',null, ['class' => 'form-control','required']) }}</span>

            <a class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a></button>

          </div>

        </div>
      </div>
    </div>

  </div>


</div>
<button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i>   Submit</button>

<a class="btn" href="{{url('servicepartner/vehicles')}}" style="background-color: #9e9b9b;color: #fff"><i class="fas fa-times"></i>  Cancel</a>

  {{form::close()}}


</div>
</fieldset>

</div>
</div>
</div>
</main>
@endsection

<!-- ................push new js link................. -->

@push('js')
<script src="{{asset('public/js/comman.js')}}"></script>

 <script src="{{asset('public/js/validation.js')}}"></script>
   <script type="text/javascript" src="{{ asset('public/js/bootstrap-fileupload.min.js') }}"></script>


<script type="text/javascript">


 function updateToggle1(userid) {
    // alert(userid)

 var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');


       $.ajax({
           type:"post",
         url:"{{url('servicepartner/vehicles/status_update')}}",
           data:{_token: CSRF_TOKEN, user_id:userid},
           dataType:'JSON',
           dataType: 'json',
           success:function(res){ 

  var data= "your status is "+res;       


                  var message = data;
                  var title = $('#toastr-title').val() || '';
                  if (res=='Deactive') {
                    var type = 'error';
                  }else if(res=='Active'){
                        var type = 'success';
                  }
                  toastr[type](message, title, {
                    positionClass: $('input[name="toastr-position"]:checked').val(),
                    closeButton: 'true',
                    progressBar:'true',
                    newestOnTop: 'true',
                    rtl: $('body').attr('dir') === 'rtl' || $('html').attr('dir') === 'rtl',
                    timeOut: $('#toastr-duration').val()
                  });
               
         }
       });
    };


      $(document).ready(function() {
        $('.add_new_vehcle').on('click', function() {
$('.vehicle_form').toggle()
$('#add').toggle()
$('#remove').toggle()



      });

  
 });
</script>

@endpush