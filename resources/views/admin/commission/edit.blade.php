@extends('admin.layouts.app')
@section('title',"Edit Commission | Admin Mande Clan")

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
    <a href="{{url('admin/commission-setting')}}" class="form-inline float-right mt--1 d-none d-md-flex">
    <button class="btn btn-info"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Back</button>
    </a>
        <h1 class="h3 mb-3"><b>Update Commission Setting</b></h1>

                    </div>
                                <div class="card">
                                
<div class="card-body">
     @if(!empty($record))
       {!! Form::model($record,array('url' => ['admin/commission-setting', $record->id],'method'=>'PATCH','class'=>'','id' =>'comman_form_id','files'=>'true')) !!}
      
       @endif

           
<div class="form-row">
<div class="form-group col-md-4">
<label for="inputEmail4">Store Category</label>                                                   
{!!Form::select('commission_store_id',$categories,null,array('class'=>'form-control selector select2 ','placeholder'=>'Select Country','data-toggle'=>'select2','autocomplete'=>'off','required')) !!}
</div>
</div>




                                        {{--      <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail4">Commission Type</label>                                                   
                                                     {!!Form::select('commission_type',['Percentage'=>'Percentage','Fixed Amount'=>'Fixed Amount'],null,array('class'=>'form-control selector select2','placeholder'=>'Select Country','data-toggle'=>'select2','autocomplete'=>'off','required')) !!}
                                                </div>
                                          </div>
 --}}
                                           <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail4">Commission (%)</label>                                                   
                                                    {!!Form::text('commission_rate',null,array('class'=>'form-control numbersOnly','placeholder'=>'Enter commission','autocomplete'=>'off','required','minlength'=>'1','maxlength'=>'3')) !!} 
                                                </div>
                                          </div>


        <button type="submit" class="btn btn-primary"><i class="far fa-edit"></i>  Update</button>


                                         
<a class="btn" href="{{url('admin/commission-setting')}}" style="background-color: #9e9b9b;color: #fff"><i class="fas fa-times"></i>  Cancel</a>
                                            
  {{Form::close()}}
</div>
</div>
</div>
</main>
@endsection

<!-- ................push new js link................. -->

@push('js')
 <script src="{{asset('public/js/validation.js')}}"></script>

@endpush