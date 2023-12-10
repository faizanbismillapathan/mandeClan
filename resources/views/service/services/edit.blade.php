@extends('service.layouts.app')
@section('title',"Edit Services | service Mande Clan")

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
    width: 300px!important;
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
    <a href="{{url('service/services')}}" class="form-inline float-right mt--1 d-none d-md-flex">
    <button class="btn btn-info"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Back</button>
    </a>
        <h1 class="h3 mb-3"><b>Update Services</b></h1>

                    </div>
                                <div class="card">
                                
<div class="card-body">
     @if(!empty($record))
       {!! Form::model($record,array('url' => ['service/services', $record->id],'method'=>'PATCH','class'=>'','id' =>'comman_form_id','files'=>'true')) !!}
      
       @endif

          
        
         <div class="row">

                <div class="col-md-9">

                    <div class="row">
                      <div class="form-group col-md-6">
                        <label for="inputEmail6">Service Identification id</label>                                                               
                          {!! Form::text('service_unique_id',null,array('class'=>'form-control','readonly'=>'readonly')) !!}

                    </div>

                    <div class="form-group col-md-4">
                        <label for="inputEmail6">Service Name</label>                                                   
                        {!!Form::text('service_name',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','required')) !!} 
                    </div>


<input type="hidden" name="service_category" value="{{$record->service_category}}">


                    <div class="form-group col-md-4">
                        <label for="inputEmail6">Service Category</label>    
                          {!!Form::select('service_subcategory',$categories,null,array('class'=>'form-control select2 selector','placeholder'=>'','data-toggle'=>'select2','required')) !!}

                    </div>

                

                <div class="form-group col-md-4">
                    <label for="inputEmail6">Service Brand</label>      
                    {!!Form::select('service_brand',$brands,null,array('class'=>'form-control select2 ','placeholder'=>'','data-toggle'=>'select2')) !!}

                </div>

                <div class="form-group col-md-4">
                    <label for="inputEmail4">SKU :</label>
                      {!!Form::text('service_sku',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off')) !!} 

                </div>

                <div class="form-group col-md-4">
                    <label for="inputEmail4">Price : * (Enter IN USD)</label>                                                               
                      {!!Form::text('service_price',null,array('class'=>'form-control numbersOnly numbersOnly','placeholder'=>'','autocomplete'=>'off','required')) !!} 
                </div>


                <div class="form-group col-md-4">
                    <label for="inputEmail4">Offer Discount (%) :</label>                                                             
                        {!!Form::text('service_offer_discount',null,array('class'=>'form-control numbersOnly','placeholder'=>'','autocomplete'=>'off','maxlength'=>'2')) !!} 
                </div>

                 <div class="form-group col-md-4">
                    <label for="inputEmail4">Payment Mode</label>     


                     {!!Form::select('service_payment_mode[]',['Online'=>'Online','COD'=>'COD'],explode(",",$record->service_payment_mode),array('class'=>'form-control select2','data-toggle'=>'select2','autocomplete'=>'off','required','multiple')) !!}
                </div>

            </div>
        </div>
        <div class="col-md-3">
           <div class="form-group author-img-bx">

            <label>Service Cover Photo</label>             

            <div class="fileupload fileupload-new" data-provides="fileupload">
                <div class="fileupload-new img-thumbnail" style="width: 180px; height: 120px;">
                    @if($record->service_img)
                   <img src="{{ asset('public/images/service_img/'.$record->service_img)}}" alt="dd" />
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

                        {{ Form::file('service_img',null, ['class' => 'form-control','required']) }}</span>

                        <a class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a></button>

                    </div>

                </div>
            </div>
        </div>

    </div>

</div>
<div class="row">



  <div class="form-group col-md-12">
      <label for="inputEmail4">Description :</label>
      {!!Form::textarea('service_description',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','maxlength'=>'1000')) !!} 
  </div>   









  


</div>

        <button type="submit" class="btn btn-primary"><i class="far fa-edit"></i>  Update</button>


                                         
<a class="btn" href="{{url('service/services')}}" style="background-color: #9e9b9b;color: #fff"><i class="fas fa-times"></i>  Cancel</a>
                                            
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
    CKEDITOR.replace( 'service_key_features');
</script>

<script>
    CKEDITOR.replace( 'service_description');
</script>

<script src="{{ asset('public/js/bootstrap-tagsinput.min.js') }}"></script>

<script type="text/javascript">
    $('#service_tag_id').tagsinput({
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
                  url: "{{url('service/append_service_category')}}",
                  type: "post",
                  data: {id:subcatID},
                  dataType: "json",
                  success:function(data) {
                    console.log(data);
                    // $('select[name="service_subcategory"]').empty();              
                    // $('select[name="service_subcategory"]').append('<option value="'+''+'">'+'None'+'</option>');
                    $('select[name="service_brand"]').empty();              
                    $('select[name="service_brand"]').append('<option value="'+''+'">'+'None'+'</option>');

                  //   $.each(data.subcategories, function(key, value) { 
                  //     $('select[name="service_subcategory"]').append('<option value="'+ key +'">'+value+'</option>');
                  // });

                    $.each(data, function(key, value) { 
                      $('select[name="service_brand"]').append('<option value="'+ key +'">'+value+'</option>');
                  });


                }

            });
          }
          else{
            // $('select[name="service_subcategory"]').empty();
            $('select[name="service_brand"]').empty();
        }

    });
    });
</script>
@endpush