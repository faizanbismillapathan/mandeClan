@extends('admin.layouts.app')
@section('title',"Edit Requeste store | Admin Mande Clan")

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
    <a href="{{url('admin/requested-store')}}" class="form-inline float-right mt--1 d-none d-md-flex">
    <button class="btn btn-info"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Back</button>
    </a>
        <h1 class="h3 mb-3"><b>Update Requeste store</b></h1>

                    </div>
                                <div class="card">
                                
<div class="card-body">
     @if(!empty($record))
       {!! Form::model($record,array('url' => ['admin/requested-store', $record->id],'method'=>'PATCH','class'=>'','id' =>'comman_form_id','files'=>'true')) !!}
      
       @endif

                                        <fieldset class="scheduler-border">
  <legend class="scheduler-border">Store Locations &nbsp;:</legend>


    <div class="form-row">

                                             <div class="form-group col-md-4 ">
          <label for="inputEmail4">Select Category</label>
          {!!Form::select('store_category',$categories,null,array('class'=>'form-control select2 ','placeholder'=>'Select Category','data-toggle'=>'select2','required')) !!}

      </div>

      <div class="form-group col-md-4">
          <label for="inputEmail4">Store Name</label>
          {!!Form::text('store_name',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','required')) !!} 
      </div>

      <div class="form-group col-md-4">
          <label for="inputPassword4">Store Mobile</label>
          {!!Form::text('store_mobile',null,array('class'=>'form-control contact_no_validate','minlength'=>'10' ,'maxlength'=>'13','placeholder'=>'','autocomplete'=>'off','required')) !!} 
      </div>

     
      <div class="form-group col-md-4">
          <label for="inputPassword4">Store Email</label>
          {!!Form::text('store_email',null,array('class'=>'form-control emailfull','placeholder'=>'','autocomplete'=>'off','required')) !!} 
      </div>

       <div class="form-group col-md-10">
                          <label for="inputPassword4">Store description</label>
                          {!! Form::textarea('store_description',null,['class'=>'form-control textarea', 'rows' => 6, 'cols' => 50,'id'=>'']) !!}
                        </div>

                    </div>

</fieldset>
                         <fieldset class="scheduler-border">
  <legend class="scheduler-border">Store Locations &nbsp;:</legend>
   <div class="form-row">


                        <div class="form-group col-md-4">
                          <label for="inputEmail4">Country</label>
                          @if(!empty($countries))
                          {!!Form::select('store_country',$countries,null,array('class'=>'form-control select2 selector','placeholder'=>'Select Country','data-toggle'=>'select2','required')) !!}
                          @endif
                        </div>
<div class="form-group col-md-4">
                          <label for="inputEmail4">State</label>
                         
  @if(!empty($states))
      {!!Form::select('store_state',$states,null,array('class'=>'form-control select2 state_selector','placeholder'=>'Select Country','data-toggle'=>'select2','required')) !!}
      @else
      {!!Form::select('store_state',[],null,array('class'=>'form-control select2 state_selector','placeholder'=>'Select Country','data-toggle'=>'select2','required')) !!}
      @endif                           
                        </div>

                         <div class="form-group col-md-4">
                          <label for="inputEmail4">City</label>
                        
@if(!empty($cities))
      {!!Form::select('store_city',$cities,null,array('class'=>'form-control select2 city_selector','placeholder'=>'Select City','data-toggle'=>'select2','required')) !!}
      @else
      {!!Form::select('store_city',[],null,array('class'=>'form-control select2 city_selector','placeholder'=>'Select City','data-toggle'=>'select2','required')) !!}
      @endif                        
                        </div>

                           <div class="form-group col-md-4">
                          <label for="inputEmail4">Locality</label>
                        
   @if(!empty($localities))
      {!!Form::select('store_locality',$localities,null,array('class'=>'form-control locality_selector select2','placeholder'=>'Select Country','data-toggle'=>'select2','required')) !!}
      @else
      {!!Form::select('store_locality',[],null,array('class'=>'form-control locality_selector select2','placeholder'=>'Select Country','data-toggle'=>'select2','required')) !!}
      @endif                           
                        </div>


                         <div class="form-group col-md-4">
                          <label for="inputPassword4">Pin Code</label>
                          {!!Form::text('store_pincode',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','required','data-mask'=>'000000')) !!} 
                        </div>


                     <div class="form-group col-md-12">
                          <label for="inputPassword4">Address</label>
                         {!! Form::text('store_address',null,['class'=>'form-control','id'=>'shopaddress']) !!}
                        </div>

       


   </div>
   </fieldset>


        <button type="submit" class="btn btn-primary"><i class="far fa-edit"></i>  Update</button>

                                         
<a class="btn" href="{{url('admin/requested-store')}}" style="background-color: #9e9b9b;color: #fff"><i class="fas fa-times"></i>  Cancel</a>
                                            
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
        CKEDITOR.replace( 'store_description');
    </script>

<script type="text/javascript">  

    $(document).ready(function() {

        $('.selector').on('change', function() {
            var countryID = $(this).val();
            console.log(countryID);
            //console.log("myform/ajax/"+countryID);
            var data;
           if(countryID) {  
              $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});
                 $.ajax({
          url: "{{url('admin/append_state')}}",
          type: "post",
          data: {id:countryID},
                    dataType: "json",
                    success:function(data) {
                        console.log(data);
                   $('select[name="store_state"]').empty();
              $('select[name="store_city"]').empty();
                $('select[name="store_locality"]').empty();
                $('input[name="store_pincode"]').val('');                
                  $('select[name="store_state"]').append('<option value="'+''+'">'+'None'+'</option>');
                   $.each(data, function(key, value) { 
                  $('select[name="store_state"]').append('<option value="'+ key +'">'+value+'</option>');
                 });
                }

                });
                    }
            else{
                $('select[name="store_state"]').empty();
              $('select[name="store_city"]').empty();
                $('select[name="store_locality"]').empty();
                $('select[name="store_pincode"]').empty();

            }

        });


        $('.state_selector').on('change', function() {
            var stateID = $(this).val();
            console.log(stateID);

            var data;
           if(stateID) {  
              $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});
                 $.ajax({
          url: "{{url('admin/append_city')}}",
          type: "post",
          data: {id:stateID},
                    dataType: "json",
                    success:function(data) {
                        console.log(data);
              $('select[name="store_city"]').empty();
                $('select[name="store_locality"]').empty();
                $('select[name="store_pincode"]').empty();

                  $('select[name="store_city"]').append('<option value="'+''+'">'+'None'+'</option>');
                   $.each(data, function(key, value) { 
                  $('select[name="store_city"]').append('<option value="'+ key +'">'+value+'</option>');
                 });
                }

                });
                    }
            else{
                             $('select[name="store_city"]').empty();
                $('select[name="store_locality"]').empty();
                $('select[name="store_pincode"]').empty();
            }

        });




        $('.city_selector').on('change', function() {
            var stateID = $(this).val();
            console.log(stateID);

            var data;
           if(stateID) {  
              $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});
                 $.ajax({
          url: "{{url('admin/append_locality')}}",
          type: "post",
          data: {id:stateID},
                    dataType: "json",
                    success:function(data) {
                        console.log(data);
            
                $('select[name="store_locality"]').empty();
                $('select[name="store_pincode"]').val(''); 

                  $('select[name="store_locality"]').append('<option value="'+''+'">'+'None'+'</option>');
                   $.each(data, function(key, value) { 
                  $('select[name="store_locality"]').append('<option value="'+ key +'">'+value+'</option>');
                 });
                }

                });
                    }
            else{
                          $('select[name="store_locality"]').empty();
                $('select[name="store_pincode"]').val(''); 
            }

        });




        $('.locality_selector').on('change', function() {
            var locality_id = $(this).val();
            console.log(locality_id);

            var data;
           if(locality_id) {  
              $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});
                 $.ajax({
          url: "{{url('admin/append_pincode')}}",
          type: "post",
          data: {id:locality_id},
                    dataType: "json",
                    success:function(data) {
                        console.log(data);
                                $('input[name="store_pincode"]').val(data);

                }

                });
                    }
            else{
                $('input[name="store_pincode"]').empty();
            }

        });

        });
</script>
@endpush