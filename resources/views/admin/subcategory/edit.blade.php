@extends('admin.layouts.app')
@section('title',"Edit Product Category | Admin Mande Clan")

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
    <a href="{{url('admin/product-category')}}" class="form-inline float-right mt--1 d-none d-md-flex">
    <button class="btn btn-info"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Back</button>
    </a>
        <h1 class="h3 mb-3"><b>Update Product Category</b></h1>

                    </div>
                                <div class="card">
                                
<div class="card-body">
     @if(!empty($record))
       {!! Form::model($record,array('url' => ['admin/product-category', $record->id],'method'=>'PATCH','class'=>'','id' =>'comman_form_id','files'=>'true')) !!}
      
       @endif

                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail4">Select Category</label>
                                                    @if(!empty($store_categories))
                                                    {!!Form::select('store_category',$store_categories,null,array('class'=>'form-control select2','placeholder'=>'Select Category','data-toggle'=>'select2','autocomplete'=>'off','required')) !!}
                                                    @else
                                                     {!!Form::select('store_category',[],null,array('class'=>'form-control select2','placeholder'=>'Select Category','data-toggle'=>'select2','autocomplete'=>'off','required')) !!}
                                                    @endif
                                                </div>
                                                
                                          </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail4">Enter Product Category</label>                                                   
                                                    {!!Form::text('product_category',null,array('class'=>'form-control','placeholder'=>'Enter Product Category','autocomplete'=>'off','required')) !!} 
                                                </div>
                                          </div>

        <button type="submit" class="btn btn-primary"><i class="far fa-edit"></i>  Update</button>


                                         
<a class="btn" href="{{url('admin/product-category')}}" style="background-color: #9e9b9b;color: #fff"><i class="fas fa-times"></i>  Cancel</a>
                                            
  {{Form::close()}}
</div>
</div>
</div>
</main>
@endsection

<!-- ................push new js link................. -->

@push('js')
 <script src="{{asset('public/js/validation.js')}}"></script>



 <script>
 document.addEventListener("DOMContentLoaded", function(event) {

    $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

    // alert('ddd')
$('#comman_form_id').validate({

     rules: {
                    'product_category': {
                      required: true,
                      
          remote: {
                    url: "{{url('admin/check_edit_unique_product-category')}}",
                    type: "post",

                    data: {
                        check_product-category_edit: function () {
                            return $("input[name='product_category']").val();
                        }
                    },
                    dataFilter: function (data) {
              console.log($.trim(data));
                       if($.trim(data) == "exist"){
                 return 'false';
                }else if($.trim(data) == "notexist"){
                 return 'true';
                }
                    }
                }
                    },
                    },

                    errorPlacement: function errorPlacement(error, element) {
                    var $parent = $(element).parents('.form-group');
                    // Do not duplicate errors
                    if ($parent.find('.jquery-validation-error').length) {
                      return;
                    }
                    $parent.append(
                      error.addClass('jquery-validation-error small form-text invalid-feedback')
                    );
                  },
                  highlight: function(element) {
                    var $el = $(element);
                    var $parent = $el.parents('.form-group');
                    $el.addClass('is-invalid');
                    // Select2 and Tagsinput
                    if ($el.hasClass('select2-hidden-accessible') || $el.attr('data-role') === 'tagsinput') {
                      $el.parent().addClass('is-invalid');
                    }
                  },
                  unhighlight: function(element) {
                    $(element).parents('.form-group').find('.is-invalid').removeClass('is-invalid');
                  },
                     messages: {  // <-- you must declare messages inside of "messages" option
     

             check_login_email:{
            remote:"This email is already registered"                  
        }  
    },


                   });

                 });
            </script>



@endpush