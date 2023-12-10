@extends('admin.layouts.app')
@section('title',"Update My Profile | admin Mande Clan")

<!-- ................custom css................. -->

@section('customStyle')
<style type="text/css">
    .field-icon {
  float: right;
  margin-left: -25px;
  margin-top: -25px;
  position: relative;
  z-index: 2;
}
</style>
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
   {{--  <a href="{{url('admin/profile')}}" class="form-inline float-right mt--1 d-none d-md-flex">
    <button class="btn btn-info"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Back</button>
    </a> --}}
        <h1 class="h3 mb-3"><b>Update My Profile</b></h1>

                    </div>
                                <div class="card">
                                
<div class="card-body password_contact">
     @if(!empty($record))
       {!! Form::model($record,array('url' => ['admin/profile', $record->id],'method'=>'PATCH','class'=>'','id' =>'seprate_form_id','files'=>'true')) !!}
      
                  <!-- <form method="POST" action="http://localhost/mandeclan/admin/profile/1" accept-charset="UTF-8" class="" id="seprate_form_id" enctype="multipart/form-data"><input name="_method" type="hidden" value="PATCH"><input name="_token" type="hidden" value="OjjWPQ5FC4mjBNO40MFPqARTrtjHOe28jPd1IItP"> -->

            <!-- <form method="POST" action="http://localhost/mandeclan/admin/profile/1" accept-charset="UTF-8" class="" id="seprate_form_id" enctype="multipart/form-data"><input name="_method" type="hidden" value="PATCH"><input name="_token" type="hidden" value="OjjWPQ5FC4mjBNO40MFPqARTrtjHOe28jPd1IItP"> -->


       @endif
                                            

               <fieldset class="scheduler-border">
                  <legend class="scheduler-border">Personal Information &nbsp;:</legend>
                  <div class="form-row">

                      <div class="col-md-8">
                         <div class="form-row">

                            <div class="form-group col-md-6">
                              <label for="inputEmail6">Contact Person</label>
                              {!!Form::text('admin_name',null,array('class'=>'form-control onlyAlphabet','placeholder'=>'','autocomplete'=>'off','required')) !!} 
                          </div>
                          <div class="form-group col-md-6">
                              <label for="inputPassword6">Email</label>
                              {!!Form::text('admin_email',null,array('class'=>'form-control emailfull','placeholder'=>'','autocomplete'=>'off','required')) !!} 
                          </div>
                          <div class="form-group col-md-6">
                              <label for="inputPassword6">Mobile</label>
                              {!!Form::text('admin_mobile',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','required')) !!} 
                          </div>

                          <div class="form-group col-md-6">
                              <label for="inputPassword6">Phone</label>
                              {!!Form::text('admin_phone',null,array('class'=>'form-control contact_no_validate','minlength'=>'10' ,'maxlength'=>'13','placeholder'=>'','autocomplete'=>'off','required')) !!} 
                          </div>



                          <div class="form-group col-md-6">
                              <label for="inputPassword6">Date Of birth</label>
                              {!!Form::text('admin_dob',null,array('class'=>'form-control','placeholder'=>'YYYY-DD-MM','autocomplete'=>'off','required','data-mask'=>'0000-00-00')) !!} 
                          </div>


                          <div class="form-group col-md-6">
                              <label for="inputPassword6">Gender</label>
                              <div class="row">
                                  <div class="col-md-6">
                                   <label class="custom-control custom-radio">
                                    {{ Form::radio('admin_gender', 'Male' , true,array('class'=>'custom-control-input')) }}

                                    <span class="custom-control-label">Male</span>
                                </label>                             
                            </div>
                            <div class="col-md-6"> <label class="custom-control custom-radio">
                                {{ Form::radio('admin_gender', 'Female' , false,array('class'=>'custom-control-input')) }}                    <span class="custom-control-label">Female</span>
                            </label></div>

                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-1">
            </div>
            <div class="col-md-3">


               <div class="form-group author-img-bx">

                <label>Logo</label>             

                <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-new img-thumbnail" style="width: 180px; height: 120px;">
  @if(!empty($record->admin_img))
                   <img src="{{ asset('public/images/admin_img/'.$record->admin_img)}}" alt="dd" />
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

                            {{ Form::file('admin_img',null, ['class' => 'form-control','required']) }}</span>

                            <a class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a></button>

                        </div>

                    </div>
                </div>
            </div>

        </div>


    </fieldset>     

     <fieldset class="scheduler-border">
  <legend class="scheduler-border">admin Locations &nbsp;:</legend>
   <div class="form-row">


                        <div class="form-group col-md-4">
                          <label for="inputEmail4">Country</label>
                          @if(!empty($countries))
                          {!!Form::select('admin_country',$countries,null,array('class'=>'form-control select2 selector','placeholder'=>'Select Country','data-toggle'=>'select2','required')) !!}
                          @endif
                        </div>
<div class="form-group col-md-4">
                          <label for="inputEmail4">State</label>
                         
                          @if(!empty($states))
      {!!Form::select('admin_state',$states,null,array('class'=>'form-control select2 state_selector','placeholder'=>'Select Country','data-toggle'=>'select2','required')) !!}
      @else
      {!!Form::select('admin_state',[],null,array('class'=>'form-control select2 state_selector','placeholder'=>'Select Country','data-toggle'=>'select2','required')) !!}
      @endif               


                        </div>

                         <div class="form-group col-md-4">
                          <label for="inputEmail4">City</label>
                        
   @if(!empty($cities))
      {!!Form::select('admin_city',$cities,null,array('class'=>'form-control select2 city_selector','placeholder'=>'Select City','data-toggle'=>'select2','required')) !!}
      @else
      {!!Form::select('admin_city',[],null,array('class'=>'form-control select2 city_selector','placeholder'=>'Select City','data-toggle'=>'select2','required')) !!}
      @endif    
                        </div>

                           <div class="form-group col-md-4">
                          <label for="inputEmail4">Locality</label>
                   
                    @if(!empty($localities))
      {!!Form::select('admin_locality',$localities,null,array('class'=>'form-control locality_selector select2','placeholder'=>'Select Country','data-toggle'=>'select2','required')) !!}
      @else
      {!!Form::select('admin_locality',[],null,array('class'=>'form-control locality_selector select2','placeholder'=>'Select Country','data-toggle'=>'select2','required')) !!}
      @endif  

                     
                        </div>


                         <div class="form-group col-md-4">
                          <label for="inputPassword4">Pin Code</label>
                          {!!Form::text('admin_pincode',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','required','data-mask'=>'000000')) !!} 
                        </div>


                     <div class="form-group col-md-7">
                          <label for="inputPassword4">Address</label>
                          {!! Form::textarea('admin_address',null,['class'=>'form-control textarea', 'rows' => 2, 'cols' => 50,'id'=>'']) !!}
                        </div>

                 

   </div>
   </fieldset>


<fieldset class="scheduler-border">
  <legend class="scheduler-border">Login Information &nbsp;:</legend>
   <div class="form-row">
     <div class="form-group col-md-4">
                          <label for="inputEmail4">Login Email</label>
                         {!!Form::text('admin_login_email',null,array('class'=>'form-control emailfull','placeholder'=>'','autocomplete'=>'off','required')) !!}


                        </div>
                  <div class="form-group col-md-4">
                          <label for="inputEmail4">Password</label>
                        
<input id="password-field" type="password" class="form-control" name="admin_password" value="{{$record->admin_password}}">
 <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>

               
                        </div>


                     
              </div>
            </fieldset>



        <button type="submit" class="btn btn-primary"><i class="far fa-edit"></i>  Update</button>


                                         
<!-- <a class="btn" href="{{url('admin/profile')}}" style="background-color: #9e9b9b;color: #fff"><i class="fas fa-times"></i>  Cancel</a> -->
                                            
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


 <script>
 document.addEventListener("DOMContentLoaded", function(event) {

    $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

    // alert('ddd')
$('#seprate_form_id').validate({

     rules: {
                    'admin_login_email': {
                      required: true,
                      
          remote: {
                    url: "{{url('admin/check_edit_login_email')}}",
                    type: "post",

                    data: {
                        check_edit_login_email: function () {
                            return $("input[name='admin_login_email']").val();
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
     

             admin_login_email:{
            remote:"This email is already registered"                  
        }  
    },


                   });

                 });
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
                   $('select[name="admin_state"]').empty();
              $('select[name="admin_city"]').empty();
                $('select[name="admin_locality"]').empty();
                $('select[name="admin_pincode"]').val('');                
                  $('select[name="admin_state"]').append('<option value="'+''+'">'+'None'+'</option>');
                   $.each(data, function(key, value) { 
                  $('select[name="admin_state"]').append('<option value="'+ key +'">'+value+'</option>');
                 });
                }

                });
                    }
            else{
                $('select[name="admin_state"]').empty();
              $('select[name="admin_city"]').empty();
                $('select[name="admin_locality"]').empty();
                $('select[name="admin_pincode"]').empty();

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
              $('select[name="admin_city"]').empty();
                $('select[name="admin_locality"]').empty();
                $('select[name="admin_pincode"]').empty();

                  $('select[name="admin_city"]').append('<option value="'+''+'">'+'None'+'</option>');
                   $.each(data, function(key, value) { 
                  $('select[name="admin_city"]').append('<option value="'+ key +'">'+value+'</option>');
                 });
                }

                });
                    }
            else{
                             $('select[name="admin_city"]').empty();
                $('select[name="admin_locality"]').empty();
                $('select[name="admin_pincode"]').empty();
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
            
                $('select[name="admin_locality"]').empty();
                $('select[name="admin_pincode"]').val(''); 

                  $('select[name="admin_locality"]').append('<option value="'+''+'">'+'None'+'</option>');
                   $.each(data, function(key, value) { 
                  $('select[name="admin_locality"]').append('<option value="'+ key +'">'+value+'</option>');
                 });
                }

                });
                    }
            else{
                          $('select[name="admin_locality"]').empty();
                $('select[name="admin_pincode"]').val(''); 
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
                                $('input[name="admin_pincode"]').val(data);

                }

                });
                    }
            else{
                $('input[name="admin_pincode"]').empty();
            }

        });

 $('.password_contact').on('click','.toggle-password', function(){
  // alert('ss')
  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));


  if (input.attr("type") == "password") {

    input.attr("type", "text");
}
else {
    input.attr("type", "password");

}
});

        });
</script>

@endpush