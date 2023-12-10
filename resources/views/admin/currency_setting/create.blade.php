@extends('admin.layouts.app')
@section('title',"Create New currency-setting | Admin Mande Clan")

<!-- ................custom css................. -->

@section('customStyle')
@endsection

<!-- ................Add css link................. -->

@push('style')

        <link href="{{ asset('public/css/fontawesome-iconpicker.min.css') }}" rel="stylesheet">


@endpush

<!-- ................body................. -->
@section('innercontent')

  
<main class="content">
                    <div class="container-fluid p-0">
<div class="clearfix">
    <a href="{{url('admin/currency-setting')}}" class="form-inline float-right mt--1 d-none d-md-flex">
    <button class="btn btn-info"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Back</button>
    </a>

        <h1 class="h3 mb-3"><b>Create currency setting</b></h1>

                    </div>
                                <div class="card">
                                
<div class="card-body">
     
             {!!Form::open(['url'=>['admin/currency-setting'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}
    
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail6">Currency Code: *</label>                                                   
                                                    {!!Form::text('currency_code',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','required')) !!} 
                                                </div>

                                                 <div class="form-group col-md-6">
                                                    <label for="inputEmail6">Exchange Rate in Doller:</label>                                                   
                                                    {!!Form::text('currency_exchange_rate',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','required')) !!} 
                                                </div>

                                                 <div class="form-group col-md-6">
                                                    <label for="inputEmail6">Currency Position: * </label>                                                   
                                                    {!!Form::text('currency_position',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','required')) !!} 
                                                </div>

                                                 <div class="form-group col-md-6">
                                                    <label for="inputEmail6">Currency Symbol: *
</label>                                                   
   <!-- <div class="input-group iconpicker-container">
                            <input placeholder="Please select currency symbol" data-placement="bottomRight" class="form-control showcur icp icp-auto iconpicker-element iconpicker-input" name="currency_symbol" value="{{ old('currency_symbol') }}" type="text">
                            <span class="input-group-addon"><i class="far fa-grin-tongue-squint"></i></span>
                          </div> -->
                                                    <div class="input-group iconpicker-container">
                                                    {!!Form::text('currency_symbol',null,array('class'=>'form-control  iconpicker-element iconpicker-input','placeholder'=>'','autocomplete'=>'off','required')) !!} 
                                                      </div>
                                                </div>
                                          </div>

       <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i>   Submit</button>


                                         
<a class="btn" href="{{url('admin/currency-setting')}}" style="background-color: #9e9b9b;color: #fff"><i class="fas fa-times"></i>  Cancel</a>
                                            
  {{Form::close()}}
</div>
</div>
</div>
</main>
@endsection

<!-- ................push new js link................. -->

@push('js')
 <script src="{{asset('public/js/validation.js')}}"></script>
    <script src="{{asset('public/js/fontawesome-iconpicker.js')}}"></script>


@endpush