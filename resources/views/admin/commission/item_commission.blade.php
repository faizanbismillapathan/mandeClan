@extends('admin.layouts.app')
@section('title',"Create New Commission | Admin Mande Clan")

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
   
        <h1 class="h3 mb-3"><b>Category Commission Setting</b></h1>

                    </div>
                                <div class="card">
                                
<div class="card-body">
     
          @if(!empty($record))
       {!! Form::model($record,array('url' => ['admin/commission-item-wise', $record->id],'method'=>'PATCH','class'=>'','id' =>'seprate_form_id','files'=>'true')) !!}
      
       @endif
    
          
{{--  <div class="form-row">
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

       <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i>   Update</button>
                                     
                                            
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