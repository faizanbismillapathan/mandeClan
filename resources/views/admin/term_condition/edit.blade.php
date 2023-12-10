@extends('admin.layouts.app')
@section('title',"Edit Term & Conditions | Admin Mande Clan")

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
    <a href="{{url('admin/term-condition')}}" class="form-inline float-right mt--1 d-none d-md-flex">
    <button class="btn btn-info"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Back</button>
    </a>
        <h1 class="h3 mb-3"><b>Update Term & Conditions</b></h1>

                    </div>
                                <div class="card">
                                
<div class="card-body">
     @if(!empty($record))
       {!! Form::model($record,array('url' => ['admin/term-condition', $record->id],'method'=>'PATCH','class'=>'','id' =>'comman_form_id','files'=>'true')) !!}
      
       @endif
                                          <div class="form-row">
                     <div class="form-group col-md-4">
                        <label for="inputEmail4">Role</label> @if(!empty($roles))
{!!Form::select('role',$roles,null,array('class'=>'form-control select2 selector','placeholder'=>'Select Country','data-toggle'=>'select2','required')) !!}
@endif
                    </div>

                    <div class="form-group col-md-8">
                        <label for="inputEmail4">Title</label>                                                   
                        {!!Form::text('title',null,array('class'=>'form-control','placeholder'=>'Enter Term & Conditions','autocomplete'=>'off','required')) !!} 
                    </div>

                      <div class="form-group col-md-12">
                          <label for="inputPassword4">Description</label>
                          {!! Form::textarea('description',null,['class'=>'form-control textarea', 'rows' => 20, 'cols' => 100,'id'=>'']) !!}
                        </div>
              </div>
        <button type="submit" class="btn btn-primary"><i class="far fa-edit"></i>  Update</button>


                                         
<a class="btn" href="{{url('admin/term-condition')}}" style="background-color: #9e9b9b;color: #fff"><i class="fas fa-times"></i>  Cancel</a>
                                            
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
        CKEDITOR.replace( 'description');
    </script>
@endpush