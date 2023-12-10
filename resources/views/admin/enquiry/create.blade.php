@extends('admin.layouts.app')
@section('title',"Create New Faq's | Admin Mande Clan")

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
    <a href="{{url('admin/enquiry')}}" class="form-inline float-right mt--1 d-none d-md-flex">
    <button class="btn btn-info"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Back</button>
    </a>

        <h1 class="h3 mb-3"><b>Create Faq's</b></h1>

                    </div>
                                <div class="card">
                                
<div class="card-body">
     
             {!!Form::open(['url'=>['admin/enquiry'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}
    
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="inputEmail12">Question</label>                                                   
                                                    {!!Form::text('question',null,array('class'=>'form-control','placeholder'=>'Enter Question','autocomplete'=>'off','required')) !!} 
                                                </div>


                                                 <div class="form-group col-md-12">
                                                    <label for="inputEmail12">Answer</label>                                                   
                                                  {!! Form::textarea('answer',null,['class'=>'form-control textarea', 'rows' => 6, 'cols' => 50,'id'=>'']) !!}
                                                </div>

                                          </div>

       <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i>   Submit</button>


                                         
<a class="btn" href="{{url('admin/enquiry')}}" style="background-color: #9e9b9b;color: #fff"><i class="fas fa-times"></i>  Cancel</a>
                                            
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
        CKEDITOR.replace( 'answer');
  </script>

@endpush