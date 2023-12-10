@extends('servicepartner.layouts.app')
@section('title',"All Sim Registration | Service Partner Mande Clan")

<!-- ................custom css................. -->

@section('customStyle')
@endsection

<!-- ................Add css link................. -->

@push('style')
@endpush

<!-- ................body................. -->
@section('innercontent')

<main class="content profile-order-history">
    <div class="container-fluid p-0">

        <div class="clearfix">

            <h1 class="h3 mb-3">Sim Registration &nbsp;&nbsp;@if(!empty($records))({{$records->total()}})@endif</h1>
        </div>

        <div class="card">
            <div class="card-body">
  @if(!empty($record))
       {!! Form::model($record,array('url' => ['service-partner/sim-registration', $record->id],'method'=>'PATCH','class'=>'','id' =>'comman_form_id','files'=>'true')) !!}
      @else
 {!!Form::open(['url'=>['service-partner/sim-registration'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}
      
       @endif

    
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail4">Sim Slot Index</label>                                                   
                                                    {!!Form::text('sim_slot_index',null,array('class'=>'form-control','placeholder'=>'Enter Sim Slot Index','autocomplete'=>'off','required')) !!} 
                                                    
                                                </div>
                                                
                                          </div>

                                          <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail4">Sim Carrier Name</label>                                                   
                                                    {!!Form::text('sim_carrier_name',null,array('class'=>'form-control','placeholder'=>'Enter Sim Carrier Name','autocomplete'=>'off','required')) !!} 
                                                    
                                                </div>
                                                
                                          </div>

                                          <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail4">IMEI Code</label>                                                   
                                                    {!!Form::text('sim_imei_code',null,array('class'=>'form-control','placeholder'=>'Enter IMEI Code','autocomplete'=>'off','required')) !!} 
                                                    
                                                </div>
                                                
                                          </div>


                                          <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail4">Sim Serial Number</label>                                                   
                                                    {!!Form::text('sim_serial_name',null,array('class'=>'form-control','placeholder'=>'Enter city','autocomplete'=>'off','required')) !!} 
                                                    
                                                </div>
                                                
                                          </div>


                                          <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail4">Mobile Number</label>                                                   
                                                    {!!Form::text('sim_mobile_name',null,array('class'=>'form-control','placeholder'=>'Enter city','autocomplete'=>'off','required')) !!} 
                                                    
                                                </div>
                                                
                                          </div>

                                              <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i>   Submit</button>


            </div>
        </div>


    </div>     

</main> 


@endsection

<!-- ................push new js link................. -->

@push('js')
<script src="{{asset('public/js/comman.js')}}"></script>
@endpush