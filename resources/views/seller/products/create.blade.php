@extends('seller.layouts.app')
@section('title',"Create New Products | seller Mande Clan")

<!-- ................custom css................. -->

@section('customStyle')

<style>
 .label-info{
    background-color: #424242;
    padding: 0.4em 0.8em;
        font-size: 85%;
    font-weight: 700;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: 0.25em

 }
.bootstrap-tagsinput input{
    width: 700px!important;
}
</style>
@endsection

<!-- ................Add css link................. -->

@push('style')
<link rel="stylesheet" href="{{asset('public/css/bootstrap-fileupload.css')}}">
<link href="{{ asset('public/css/bootstrap-tagsinput.css') }}" rel="stylesheet" />

@endpush

<!-- ................body................. -->
@section('innercontent')


<main class="content">
    <div class="container-fluid p-0">
        <div class="clearfix">
            <a href="{{url('seller/products')}}" class="form-inline float-right mt--1 d-none d-md-flex">
                <button class="btn btn-info"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Back</button>
            </a>

            <h1 class="h3 mb-3"><b>Create Products</b></h1>

        </div>
        <div class="card">

            <div class="card-body">

             {!!Form::open(['url'=>['seller/products'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}

             <div class="row">

                <div class="col-md-9">
                    
<div class="row">
  <div class="form-group col-md-6">
                    <label for="inputEmail6">Product Identification id</label>                                                                 {!! Form::text('product_unique_id',$keydata,array('class'=>'form-control','readonly'=>'readonly')) !!}

                </div>

                <div class="form-group col-md-6">
                    <label for="inputEmail6">Product Name</label>                                                   
                    {!!Form::text('product_name',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','required')) !!} 
                </div>
                

                <div class="form-group col-md-6">
                    <label for="inputEmail6">Product Category</label>                                                                 {!!Form::select('product_category',$categories,null,array('class'=>'form-control select2 selector','placeholder'=>'','data-toggle'=>'select2','required')) !!}

                </div>

 <div class="form-group col-md-6">
                    <label for="inputEmail6">Product SubCategory</label>                                                                 {!!Form::select('product_subcategory',[],null,array('class'=>'form-control select2 ','placeholder'=>'','data-toggle'=>'select2')) !!}

                </div>

                

                <div class="form-group col-md-6">
                    <label for="inputEmail6">Product Brand</label>     
                      {!!Form::select('product_brand',$brands,null,array('class'=>'form-control select2 ','placeholder'=>'','data-toggle'=>'select2')) !!}

                </div>

                </div>
            </div>
                <div class="col-md-3">
                     <div class="form-group author-img-bx">

<label>Product Cover Photo</label>             
   
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

                {{ Form::file('product_cover_photo',null, ['class' => 'form-control','required']) }}</span>

                <a class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a></button>

              </div>

            </div>
          </div>
                 </div>
          
                </div>

</div>
              <div class="row">

                <div class="form-group col-md-12">
                  <label for="inputEmail4">Key Features :</label>
                  {!!Form::textarea('product_key_features',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','maxlength'=>'1000')) !!} 
              </div>   

              <div class="form-group col-md-12">
                  <label for="inputEmail4">Description :</label>
                  {!!Form::textarea('product_description',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','maxlength'=>'1000')) !!} 
              </div>   



         
           

            {{-- <div class="form-group col-md-4">
                <label for="inputEmail4"> 
                Type :</label>                                                                 {!!Form::select('product_wg_type',['Guarantee'=>'Guarantee','Warranty'=>'Warranty'],null,array('class'=>'form-control select2 ','placeholder'=>'','data-toggle'=>'select2')) !!}

            </div>
 <div class="form-group col-md-4">
                <label for="inputEmail4">Days/Months/Year :</label>                                                                 {!!Form::select('product_wg_dmy',['Day'=>'Day','Month'=>'Month','Year'=>'Year'],null,array('class'=>'form-control select2 ','placeholder'=>'','data-toggle'=>'select2')) !!}

            </div>

               <div class="form-group col-md-4">
                <label for="inputEmail4">Warranty (Duration) :</label>                                                                 {!!Form::select('product_wg_duration',$warranty,null,array('class'=>'form-control select2 ','placeholder'=>'','data-toggle'=>'select2')) !!}

            </div>


              <div class="form-group col-md-4">
                <label for="inputEmail4">Product Video social media Url :</label>                                                                                     {!!Form::url('product_video_url',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off')) !!} 


            </div>

           
         

            <div class="form-group col-md-8">
                <label for="inputEmail4">Product tags : </label><br>
  
                        {!!Form::text('product_tags',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','required','data-role'=>'tagsinput','id'=>'product_tag_id')) !!} 
            </div>

         
        


            <div class="form-group col-md-4">
                <label for="inputEmail4">Free Shipping :
                </label>  <br>                                                                     <input type="checkbox" data-toggle="toggle" data-on="Enable" data-off="Disable" data-onstyle="success" data-offstyle="danger" id="11" class="checkstatus"  name="product_free_shipping">


            </div> --}}


         

            <div class="form-group col-md-4">
                <label for="inputEmail4">Status</label> <br>
                 <input type="checkbox" data-toggle="toggle" data-on="Active" data-off="Deactive" data-onstyle="success" data-offstyle="danger" class="checkstatus"  name="product_status">


            </div>


            <div class="form-group col-md-4">
                <label for="inputEmail4">Cancel Available :</label> <br>                                                                       <input type="checkbox" checked data-toggle="toggle" data-on="Enable" data-off="Disable" data-onstyle="success" data-offstyle="danger" id="11" class="checkstatus"  name="product_cancel_available">


            </div>

            <div class="form-group col-md-4">
                <label for="inputEmail4">Cash On Delivery :</label> <br>                                                                       <input type="checkbox" data-toggle="toggle" data-on="Enable" data-off="Disable" data-onstyle="success" data-offstyle="danger" id="11" class="checkstatus"  name="product_cod">


            </div>

        

  


</div>

<button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i>   Submit</button>



<a class="btn" href="{{url('seller/products')}}" style="background-color: #9e9b9b;color: #fff"><i class="fas fa-times"></i>  Cancel</a>

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
 <script src="{{asset('public/basic-ckeditor/ckeditor.js')}}"></script>
  <script>
        CKEDITOR.replace( 'product_key_features');
    </script>

    <script>
        CKEDITOR.replace( 'product_description');
    </script>

    <script src="{{ asset('public/js/bootstrap-tagsinput.min.js') }}"></script>

<script type="text/javascript">
    $('#product_tag_id').tagsinput({
  maxTags: 5
});
   
</script>


 <script type="text/javascript">
    $(document).ready(function() {

        $('.selector').on('change', function() {
            var subcatID = $(this).val();
            console.log(subcatID);
            var data;
           if(subcatID) {  
              $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});
                 $.ajax({
          url: "{{url('seller/append_product_category')}}",
          type: "post",
          data: {id:subcatID},
                    dataType: "json",
                    success:function(data) {
                        console.log(data);
                   $('select[name="product_subcategory"]').empty();              
                  $('select[name="product_subcategory"]').append('<option value="'+''+'">'+'None'+'</option>');
                   $('select[name="product_brand"]').empty();              
                  $('select[name="product_brand"]').append('<option value="'+''+'">'+'None'+'</option>');


                   $.each(data.subcategories, function(key, value) { 
                  $('select[name="product_subcategory"]').append('<option value="'+ key +'">'+value+'</option>');
                 });


                   
                   $.each(data.brands, function(key, value) { 
                  $('select[name="product_brand"]').append('<option value="'+ key +'">'+value+'</option>');
                 });


                }

                });
                    }
            else{
                $('select[name="product_subcategory"]').empty();
 $('select[name="product_brand"]').empty();
            }

        });
});
</script>

@endpush