@extends('admin.layouts.app')
@section('title',"Edit Blog | Admin Mande Clan")

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
    <a href="{{url('admin/blog')}}" class="form-inline float-right mt--1 d-none d-md-flex">
    <button class="btn btn-info"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Back</button>
    </a>
        <h1 class="h3 mb-3"><b>Update Blog</b></h1>

                    </div>
                                <div class="card">
                                
<div class="card-body">
     @if(!empty($record))
       {!! Form::model($record,array('url' => ['admin/blog', $record->id],'method'=>'PATCH','class'=>'','id' =>'comman_form_id','files'=>'true')) !!}
      
       @endif
                                                  <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="inputEmail12">Heading </label>                                                   
                                                    {!!Form::text('blog_heading',null,array('class'=>'form-control','placeholder'=>'Enter Question','autocomplete'=>'off','required')) !!} 
                                                </div>


                                                 <div class="form-group col-md-12">
                                                    <label for="inputEmail12">Description </label>                                                 
                                                {!! Form::textarea('blog_description',null,['class'=>'form-control textarea', 'rows' => 6, 'cols' => 50,'id'=>'']) !!}
                                                </div>

                                                 <div class="form-group col-md-4">
                                                    <label for="inputEmail4">Author Name </label>                                                   
                                                    {!!Form::text('author_name',null,array('class'=>'form-control','placeholder'=>'Enter Question','autocomplete'=>'off','required')) !!} 
                                                </div>

                                                 <div class="form-group col-md-4">
                                                    <label for="inputEmail4">Author Designation </label>                                                   
                                                    {!!Form::text('author_designation',null,array('class'=>'form-control','placeholder'=>'Enter Question','autocomplete'=>'off','required')) !!} 
                                                </div>

                                                  <div class="form-group col-md-8">
                                                    <label for="inputEmail12">About Author </label>                                                   
                                                  {!! Form::textarea('about_author',null,['class'=>'form-control textarea', 'rows' => 6, 'cols' => 50,'id'=>'']) !!}
                                                </div>


<div class="form-group col-md-1 ">
</div>
<div class="form-group col-md-3 ">
             <div class="form-group author-img-bx">

<label>Blog Img</label>             
   
    <div class="fileupload fileupload-new" data-provides="fileupload">
            <div class="fileupload-new img-thumbnail" style="width: 180px; height: 120px;">
@if(!empty($record->blog_image))

             <img src="{{asset('public/images/blog_image/'.$record->blog_image)}}" alt="dd" />

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

                {{ Form::file('blog_image',null, ['class' => 'form-control','required']) }}</span>

                <a class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a></button>

              </div>

            </div>
          </div>
                 </div>
          
</div>

                                          </div>

        <button type="submit" class="btn btn-primary"><i class="far fa-edit"></i>  Update</button>


                                         
<a class="btn" href="{{url('admin/blog')}}" style="background-color: #9e9b9b;color: #fff"><i class="fas fa-times"></i>  Cancel</a>
                                            
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
   <script type="text/javascript" src="{{ asset('public/js/bootstrap-fileupload.min.js') }}"></script>

  <script>
        CKEDITOR.replace( 'blog_description');
  </script>
 <script>
        CKEDITOR.replace( 'about_author');
  </script>
@endpush