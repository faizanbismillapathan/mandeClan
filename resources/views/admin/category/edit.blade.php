@extends('admin.layouts.app')
@section('title',"Edit Category | Admin Mande Clan")

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
    <a href="{{url('admin/store-category')}}" class="form-inline float-right mt--1 d-none d-md-flex">
    <button class="btn btn-info"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Back</button>
    </a>
        <h1 class="h3 mb-3"><b>Update Store Category</b></h1>

                    </div>
                                <div class="card">
                                
<div class="card-body">
     @if(!empty($record))
       {!! Form::model($record,array('url' => ['admin/store-category', $record->id],'method'=>'PATCH','class'=>'','id' =>'comman_form_id','files'=>'true')) !!}
      
       @endif
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail4">Store Category</label>                                                   
                                                    {!!Form::text('category_name',null,array('class'=>'form-control','placeholder'=>'Enter category','autocomplete'=>'off','required')) !!} 
                                                </div>

                                               <div class="form-group col-md-7">
                                                    <label for="inputEmail4">Store Title</label>                                                   
                                                    {!!Form::text('category_title',null,array('class'=>'form-control','placeholder'=>'Enter category','autocomplete'=>'off','maxlength'=>'60','minlength'=>'5')) !!} 
                                                </div>


                                                <!-- <div class="form-group col-md-1"></div> -->
                                                <div class="form-group col-md-4 ">
             <div class="form-group author-img-bx">

<label>Category Face Image</label>           
   
    <div class="fileupload fileupload-new" data-provides="fileupload">
            <div class="fileupload-new img-thumbnail" style="width: 180px; height: 120px;">
              @if(!empty($record->category_img))
                                              <img src="{{url('public/images/category_img/'.$record->category_img)}}" >
                                                @else
<img src="{{ asset('public/img/no-image.png')}}" alt="dd"  />
                                                @endif
           </div>
           <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 180px; max-height: 120px; line-height: 20px;"></div>
           <div class="row">
             <div class="col-md-12">
              <button type="button" class="btn btn-secondary" style="padding: 0px; background-color: #fff;"><span class="btn btn-default btn-file">
                <span class="btn btn-secondary fileupload-new">Choose image</span>
                <span  class="btn btn-secondary fileupload-exists">Change</span>

                {{ Form::file('category_img',null, ['class' => 'form-control','required']) }}</span>

                <a class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a></button>

              </div>

            </div>
          </div>
                 </div>
          
</div>
               


<div class="form-group col-md-4 ">
             <div class="form-group author-img-bx">

<label>Category Thumbnail Image</label>             
   
    <div class="fileupload fileupload-new" data-provides="fileupload">
            <div class="fileupload-new img-thumbnail" style="width: 180px; height: 120px;">
              @if(!empty($record->category_thumbnail_img))
                                              <img src="{{url('public/images/category_thumbnail_img/'.$record->category_thumbnail_img)}}" >
                                                @else
<img src="{{ asset('public/img/no-image.png')}}" alt="dd"  />
                                                @endif
           </div>
           <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 180px; max-height: 120px; line-height: 20px;"></div>
           <div class="row">
             <div class="col-md-12">
              <button type="button" class="btn btn-secondary" style="padding: 0px; background-color: #fff;"><span class="btn btn-default btn-file">
                <span class="btn btn-secondary fileupload-new">Choose image</span>
                <span  class="btn btn-secondary fileupload-exists">Change</span>

                {{ Form::file('category_thumbnail_img',null, ['class' => 'form-control','required']) }}</span>

                <a class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a></button>

              </div>

            </div>
          </div>
                 </div>
          
</div>
                                          </div>

        <button type="submit" class="btn btn-primary"><i class="far fa-edit"></i>  Update</button>


                                         
<a class="btn" href="{{url('admin/store-category')}}" style="background-color: #9e9b9b;color: #fff"><i class="fas fa-times"></i>  Cancel</a>
                                            
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

@endpush