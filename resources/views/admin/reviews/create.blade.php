@extends('admin.layouts.app')
@section('title',"Create New Review| Admin Mande Clan")

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
    <a href="{{url('admin/reviews')}}" class="form-inline float-right mt--1 d-none d-md-flex">
    <button class="btn btn-info"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Back</button>
    </a>

        <h1 class="h3 mb-3"><b>Create Reviews</b></h1>

                    </div>
                                <div class="card">
                                
<div class="card-body">
     
             {!!Form::open(['url'=>['admin/reviews'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}
    
                                            <div class="form-row">
                                              <div class="form-group col-md-4 ">
          <label for="inputEmail4">Select Store</label>
          {!!Form::select('store_id',$stores,null,array('class'=>'form-control select2 selectcategory ','placeholder'=>'Select Category','data-toggle'=>'select2','required')) !!}

      </div>

      <div class="form-group col-md-4 ">
          <label for="inputEmail4">Select Customer</label>
          {!!Form::select('customer_id',$customers,null,array('class'=>'form-control select2 selectcategory ','placeholder'=>'Select Category','data-toggle'=>'select2','required')) !!}

      </div>

      <div class="form-group col-md-4 ">
          <label for="inputEmail4">Select Rating</label>
          {!!Form::select('rating',['1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5'],null,array('class'=>'form-control select2 selectcategory ','placeholder'=>'Select Category','data-toggle'=>'select2','required')) !!}

      </div>


         <div class="form-group col-md-10">
                          <label for="inputPassword4">Store description</label>
                          {!! Form::textarea('reviews',null,['class'=>'form-control textarea', 'rows' => 6, 'cols' => 50,'id'=>'']) !!}
                        </div>
                                          </div>

       <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i>   Submit</button>


                                         
<a class="btn" href="{{url('admin/reviews')}}" style="background-color: #9e9b9b;color: #fff"><i class="fas fa-times"></i>  Cancel</a>
                                            
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
CKEDITOR.replace( 'reviews');
</script>
@endpush