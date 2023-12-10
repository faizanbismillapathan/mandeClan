@extends('admin.layouts.app')
@section('title',"Edit Vehicle Type | Admin Mande Clan")

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
    <a href="{{url('admin/vehicle-rate-chart')}}" class="form-inline float-right mt--1 d-none d-md-flex">
    <button class="btn btn-info"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Back</button>
    </a>
        <h1 class="h3 mb-3"><b>Update Vehicle Rate Chart</b></h1>

                    </div>
                                <div class="card">
                                
<div class="card-body">
     @if(!empty($record))
       {!! Form::model($record,array('url' => ['admin/vehicle-rate-chart', $record->id],'method'=>'PATCH','class'=>'','id' =>'comman_form_id','files'=>'true')) !!}
      
       @endif

            <div class="form-row">

                   <div class="form-group col-md-4">
                    <label for="inputEmail4">Vehicle Id</label>  
                    {!! Form::text('vehicle_rate_chart_id',null,array('class'=>'form-control','readonly'=>'readonly')) !!}
                </div>

                     <div class="form-group col-md-4">
                    <label for="inputEmail4">Package Name</label>  
                    {!! Form::text('package_name',null,array('class'=>'form-control','placeholder'=>'Enter package name')) !!}
                </div>


                <div class="form-group col-md-4">
                    <label for="inputEmail4">Vehicle Name</label>  
                    {!!Form::select('vehicle_name',$vehicle_types,null,array('class'=>'form-control select2 selector','placeholder'=>'Select Country','data-toggle'=>'select2','required')) !!}
                </div>

                <div class="form-group col-md-4">
                    <label for="inputEmail4">Vehicle no of Wheel</label>  
                    {!!Form::select('vehicle_wheel',$vehicle_wheels,null,array('class'=>'form-control select2','placeholder'=>'Select Country','data-toggle'=>'select2','required')) !!}
                </div>



                <div class="form-group col-md-4">
                    <label for="inputEmail4">Vehicle Fuel</label>  
                    {!!Form::select('vehicle_fuel',['Petrol'=>'Petrol','Gas'=>'Gas','Diesel'=>'Diesel','Electric'=>'Electric'],null,array('class'=>'form-control select2','placeholder'=>'Select Country','data-toggle'=>'select2','required')) !!}
                </div>


                
<!-- 

<div class="form-group col-md-6">
  <label for="inputPassword4">Gender</label>
                             <div class="row">
                              <div class="col-md-3">
                                 <label class="custom-control custom-radio">
                                    {{ Form::radio('vehicle_time_slote', 'Hourly' , true,array('class'=>'custom-control-input')) }}

                    <span class="custom-control-label">Hourly</span>
                  </label>                             
                              </div>
                              <div class="col-md-3">
                                 <label class="custom-control custom-radio">
                                    {{ Form::radio('vehicle_time_slote', 'Per Day' , true,array('class'=>'custom-control-input')) }}

                    <span class="custom-control-label">Per Day</span>
                  </label>                             
                              </div>

                               <div class="col-md-3">
                                 <label class="custom-control custom-radio">
                                    {{ Form::radio('vehicle_time_slote', 'Monthly' , true,array('class'=>'custom-control-input')) }}

                    <span class="custom-control-label">Monthly</span>
                  </label>                             
                              </div>

                               <div class="col-md-3">
                                 <label class="custom-control custom-radio">
                                    {{ Form::radio('vehicle_time_slote', 'Yearly' , true,array('class'=>'custom-control-input')) }}

                    <span class="custom-control-label">Yearly</span>
                  </label>                             
                              </div>
                               
                             </div>
                              
                            </div> -->


 <div class="form-group col-md-4">
                    <label for="inputEmail4">Vehicle Hourly Price</label>


<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text">$</span>
  </div>
{!! Form::text('vehicle_hourly_price',null,array('class'=>'form-control numbersOnly','placeholder'=>'','required')) !!}  
</div>


                    <!--  -->
                </div>

                 <div class="form-group col-md-4">
                    <label for="inputEmail4">Vehicle Day Price</label>  
                    <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text">$</span>
  </div>
                    {!! Form::text('vehicle_daily_price',null,array('class'=>'form-control numbersOnly','placeholder'=>'','required')) !!}
                </div>
                </div>

 <div class="form-group col-md-4">
                    <label for="inputEmail4">Vehicle Weekly Price</label> 
                    <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text">$</span>
  </div> 
                    {!! Form::text('vehicle_weekly_price',null,array('class'=>'form-control numbersOnly','placeholder'=>'','required')) !!}
                </div>
                </div>

                 <div class="form-group col-md-4">
                    <label for="inputEmail4">Vehicle Monthly Price</label> 
                    <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text">$</span>
  </div> 
                    {!! Form::text('vehicle_monthly_price',null,array('class'=>'form-control numbersOnly','placeholder'=>'','required')) !!}
                </div>
                </div>

                

            </div>



        <button type="submit" class="btn btn-primary"><i class="far fa-edit"></i>  Update</button>


                                         
<a class="btn" href="{{url('admin/vehicle-rate-chart')}}" style="background-color: #9e9b9b;color: #fff"><i class="fas fa-times"></i>  Cancel</a>
                                            
  {{Form::close()}}
</div>
</div>
</div>
</main>
@endsection

<!-- ................push new js link................. -->

@push('js')
 <script src="{{asset('public/js/validation.js')}}"></script>
<script type="text/javascript" src="{{ asset('public/js/bootstrap-fileupload.min.js') }}"></script>

 <script type="text/javascript">
    $(document).ready(function() {

        $('.selector').on('change', function() {
            var vehicleId = $(this).val();
            console.log(vehicleId);
            //console.log("myform/ajax/"+vehicleId);
            var data;
           if(vehicleId) {  
              $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});
                 $.ajax({
          url: "{{url('admin/append_vehicle_type')}}",
          type: "post",
          data: {id:vehicleId},
                    dataType: "json",
                    success:function(data) {
                        console.log(data);
                   $('select[name="vehicle_wheel"]').empty();
              $('select[name="vehicle_fuel"]').empty();   

                  $('select[name="vehicle_wheel"]').append('<option value="'+''+'">'+'None'+'</option>');

                  $('select[name="vehicle_fuel"]').append('<option value="'+''+'">'+'None'+'</option>');

                  
                   $.each(data, function(key, value) { 
                  $('select[name="vehicle_fuel"]').append('<option value="'+ key +'">'+key+'</option>');

                    $('select[name="vehicle_wheel"]').append('<option value="'+ value +'">'+value+'</option>');


                 });
                }

                });
                    }
            else{
                $('select[name="vehicle_wheel"]').empty();
              // $('select[name="vehicle_fuel"]').empty();
            }

        });


     })
 </script>

@endpush