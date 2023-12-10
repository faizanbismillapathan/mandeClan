@extends('admin.layouts.app')
@section('title',"Create New subscription Plan | Admin Mande Clan")
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
    <a href="{{url('admin/service-subscription')}}" class="form-inline float-right mt--1 d-none d-md-flex">
    <button class="btn btn-info"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Back</button>
    </a>

        <h1 class="h3 mb-3"><b>Create Service subscription Plan</b></h1>

                    </div>
                                <div class="card">
                                
<div class="card-body">
     
             {!!Form::open(['url'=>['admin/service-subscription'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}
    
          <div class="form-row">
                 <div class="form-group col-md-4">
                          <label for="inputEmail4">Plan Name</label>
                         {!!Form::text('service_plan_name',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','required')) !!} 
                        </div>
                             <div class="form-group col-md-4">
                          <label for="inputEmail4">Price</label>
                         {!!Form::text('service_plan_price',null,array('class'=>'form-control numbersOnly','placeholder'=>'','autocomplete'=>'off','required','minlength'=>'1','maxlength'=>'5')) !!} 
                        </div>
                             <div class="form-group col-md-4">
                          <label for="inputEmail4">Plan Id</label>
                         {!!Form::text('service_plan_id',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','required')) !!} 
                        </div>

<div class="form-group col-md-4">
                          <label for="inputEmail4">Discount (%)</label>
                         {!!Form::text('service_plan_discount',null,array('class'=>'form-control numbersOnly','placeholder'=>'','autocomplete'=>'off','required','minlength'=>'1','maxlength'=>'2')) !!} 
                        </div>
                        <div class="form-group col-md-4">
                          <label for="inputEmail4">Plan Validity (Days)</label>
                         {!!Form::text('service_plan_validity',null,array('class'=>'form-control numbersOnly','placeholder'=>'','autocomplete'=>'off','required','minlength'=>'1','maxlength'=>'3')) !!} 
                        </div>
                        <div class="form-group col-md-4">
                          <label for="inputEmail4">Plan Product Limit</label>
                         {!!Form::text('service_product_limit',null,array('class'=>'form-control numbersOnly','placeholder'=>'','autocomplete'=>'off','required','minlength'=>'1','maxlength'=>'7')) !!} 
                        </div>
                        <div class="form-group col-md-12">
                          <label for="inputEmail4">Plan Features</label>
                         {!!Form::textarea('service_plan_features',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','required','maxlength'=>'600')) !!} 
                        </div>                        
                                               
                                          </div>


       <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i>   Submit</button>


                                         
<a class="btn" href="{{url('admin/service-subscription')}}" style="background-color: #9e9b9b;color: #fff"><i class="fas fa-times"></i>  Cancel</a>
                                            
  {{Form::close()}}
</div>
</div>
</div>
</main>
@endsection

<!-- ................push new js link................. -->

@push('js')
 <script src="{{asset('public/js/validation.js')}}"></script>
   <script src="{{asset('public/basic-ckeditor/ckeditor.js')}}"></script>
  <script>
        CKEDITOR.replace( 'service_plan_features');
    </script>

@endpush