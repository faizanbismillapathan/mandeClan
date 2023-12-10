@extends('admin.layouts.app')
@section('title',"Edit Return Policy | Admin Mande Clan")

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
    <a href="{{url('admin/return-policy')}}" class="form-inline float-right mt--1 d-none d-md-flex">
    <button class="btn btn-info"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Back</button>
    </a>
        <h1 class="h3 mb-3"><b>Update Return Policy</b></h1>

                    </div>
                                <div class="card">
                                
<div class="card-body">
     @if(!empty($record))
       {!! Form::model($record,array('url' => ['admin/return-policy', $record->id],'method'=>'PATCH','class'=>'','id' =>'comman_form_id','files'=>'true')) !!}
      
       @endif
                                          
                                             <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail4">Policy Category </label>                                                   
                                                  {!!Form::select('policy_category',$categories,null,array('class'=>'form-control select2 ','placeholder'=>'Select Category','data-toggle'=>'select2','required')) !!}
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail4">Policy Name </label>                
                                                       @if(!empty($record->policy_name))
                  <?php $arr=explode(',', $record->policy_name);  ?>
     {!!Form::select('policy_name[]',['Refund'=>'Refund','Replacement'=>'Replacement','Exchange'=>'Exchange'],$arr,array('class'=>'form-control select2 ','data-toggle'=>'select2','required','multiple')) !!}
                  @else
     {!!Form::select('policy_name[]',['Refund'=>'Refund','Replacement'=>'Replacement','Exchange'=>'Exchange'],null,array('class'=>'form-control select2 ','data-toggle'=>'select2','required','multiple')) !!}
                  @endif                                   
                                             
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail4">Return days</label>                                                   
                                                    {!!Form::text('return_days',null,array('class'=>'form-control numbersOnly','placeholder'=>'Enter Return Policy','autocomplete'=>'off','required','maxlength'=>'1')) !!} 
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail4">Deduction (%)</label>                                                   
                                                    {!!Form::text('deduction_percent',null,array('class'=>'form-control','placeholder'=>'Enter Return Policy','autocomplete'=>'off','required','maxlength'=>'1')) !!} 
                                                </div>

                                            
                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail4">Policy Accepted by </label>                                                   
                                                  {!!Form::select('return_accepted_by',['Auto'=>'Auto','Admin'=>'Admin','Vendor'=>'Vendor'],null,array('class'=>'form-control select2 ','placeholder'=>'Select Category','data-toggle'=>'select2','required')) !!}
                                                </div>

    <div class="form-group col-md-10">
                                                    <label for="inputEmail4">Description</label>                                                   
                          {!! Form::textarea('policy_description',null,['class'=>'form-control textarea', 'rows' => 6, 'cols' => 50,'id'=>'']) !!}
                                                </div>

                                          </div>
        <button type="submit" class="btn btn-primary"><i class="far fa-edit"></i>  Update</button>


                                         
<a class="btn" href="{{url('admin/return-policy')}}" style="background-color: #9e9b9b;color: #fff"><i class="fas fa-times"></i>  Cancel</a>
                                            
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
        CKEDITOR.replace( 'policy_description');
    </script>

@endpush