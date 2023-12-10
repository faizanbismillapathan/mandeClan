@extends('admin.layouts.app')
@section('title',"Create New Brands | admin Mande Clan")

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
            <a href="{{url('admin/brands')}}" class="form-inline float-right mt--1 d-none d-md-flex">
                <button class="btn btn-info"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Back</button>
            </a>

            <h1 class="h3 mb-3"><b>Create Brands</b></h1>

        </div>
        <div class="card">

            <div class="card-body">

               {!!Form::open(['url'=>['admin/brands'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}

               <div class="row">

                <div class="col-md-7">



                    <div class="form-row">

                        <div class="form-group col-md-9">
  <label for="inputPassword4">Type</label>
                             <div class="row">
                              <div class="col-md-4">
                                 <label class="custom-control custom-radio">
                                    {{ Form::radio('brand_type', 'service' , true,array('class'=>'custom-control-input')) }}

                    <span class="custom-control-label">Service</span>
                  </label>                             
                              </div>
                              <div class="col-md-4"> <label class="custom-control custom-radio">
{{ Form::radio('brand_type', 'store' , false,array('class'=>'custom-control-input')) }}                    <span class="custom-control-label">Store</span>
                  </label></div>

                   <div class="col-md-4"> <label class="custom-control custom-radio">
{{ Form::radio('brand_type', 'both' , false,array('class'=>'custom-control-input')) }}                    <span class="custom-control-label">Both</span>
                  </label></div>
                               
                             </div>
                              
                            </div>


   



                    <div class="form-group col-md-9">
                        <label for="inputEmail9">Brand Name</label>                                                   
                        {!!Form::text('brand_name',null,array('class'=>'form-control','placeholder'=>'Enter Brands','autocomplete'=>'off','required')) !!} 
                    </div>

                </div>
            </div>

            <div class="col-md-4">
              <div class="form-group author-img-bx">

                <label>Logo</label>             

                <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-new img-thumbnail" style="width: 180px; height: 120px;">
                       <img src="{{ asset('public/img/no-image.png')}}" alt="dd" />
                   </div>
                   <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 180px; max-height: 120px; line-height: 20px;"></div>
                   <div class="row">
                       <div class="col-md-12">
                          <button type="button" class="btn btn-secondary" style="padding: 0px; background-color: #fff;"><span class="btn btn-default btn-file">
                            <span class="btn btn-secondary fileupload-new">Choose image</span>
                            <span  class="btn btn-secondary fileupload-exists">Change</span>

                            {{ Form::file('brand_logo',null, ['class' => 'form-control','required']) }}</span>

                            <a class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a></button>

                        </div>

                    </div>
                </div>
            </div>
        </div>


    </div>

    <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i>   Submit</button>



    <a class="btn" href="{{url('admin/brands')}}" style="background-color: #9e9b9b;color: #fff"><i class="fas fa-times"></i>  Cancel</a>

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