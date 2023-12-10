@extends('admin.layouts.app')
@section('title',"Edit Rider / Vehicle | Admin Mande Clan")

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
            <a href="{{url('admin/rider-vehicle-info')}}" class="form-inline float-right mt--1 d-none d-md-flex">
                <button class="btn btn-info"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Back</button>
            </a>
            <h1 class="h3 mb-3"><b>Update Rider / Vehicle</b></h1>

        </div>
        <div class="card">

            <div class="card-body password_contact">
               @if(!empty($record))
               {!! Form::model($record,array('url' => ['admin/rider-vehicle-info', $record->id],'method'=>'PATCH','class'=>'','id' =>'seprate_form_id','files'=>'true')) !!}

               @endif


               <fieldset class="scheduler-border">
                  <legend class="scheduler-border">Personal Information &nbsp;:</legend>
                  <div class="form-row">

                      <div class="col-md-8">
                       <div class="form-row">
                         <div class="form-group col-md-6">

                            {{ Form::label('User Id', 'User Id') }}

                            {!! Form::text('rv_user_userid',null,array('class'=>'form-control','readonly'=>'readonly')) !!}
                        </div>


                        <div class="form-group col-md-6">
                          <label for="inputEmail6">Contact Person</label>
                          {!!Form::text('rv_user_name',null,array('class'=>'form-control onlyAlphabet','placeholder'=>'','autocomplete'=>'off','required')) !!} 
                      </div>
                      <div class="form-group col-md-6">
                          <label for="inputPassword6">Email</label>
                          {!!Form::text('rv_user_email',null,array('class'=>'form-control emailfull','placeholder'=>'','autocomplete'=>'off','required')) !!} 
                      </div>


                      <div class="form-group col-md-6">
                          <label for="inputPassword6">Phone</label>
                          {!!Form::text('rv_user_phone',null,array('class'=>'form-control contact_no_validate','minlength'=>'10' ,'maxlength'=>'13','placeholder'=>'','autocomplete'=>'off','required')) !!} 
                      </div>




                      <div class="form-group col-md-6">
                          <label for="inputPassword6">Date Of birth</label>
                          {!!Form::text('rv_user_dob',null,array('class'=>'form-control','placeholder'=>'YYYY-DD-MM','autocomplete'=>'off','data-mask'=>'0000-00-00')) !!} 
                      </div>


                      <div class="form-group col-md-6">
                          <label for="inputPassword6">Gender</label>
                          <div class="row">
                              <div class="col-md-6">
                                 <label class="custom-control custom-radio">
                                    {{ Form::radio('rv_user_gender', 'Male' , true,array('class'=>'custom-control-input')) }}

                                    <span class="custom-control-label">Male</span>
                                </label>                             
                            </div>
                            <div class="col-md-6"> <label class="custom-control custom-radio">
                                {{ Form::radio('rv_user_gender', 'Female' , false,array('class'=>'custom-control-input')) }}                    <span class="custom-control-label">Female</span>
                            </label></div>

                        </div>

                    </div>


                    <div class="form-group col-md-6">
                      <label for="inputPassword6">Type</label>
                      <div class="row">

                        @php 

                        $arr=explode(',',$record->rv_user_type);
                        @endphp                                 <div class="col-md-6">
                         <label class="custom-control custom-checkbox">
                            {{ Form::checkbox('rv_user_type[]', 'Rider' , in_array('Rider',$arr),array('class'=>'custom-control-input rv_user_type_cls')) }}

                            <span class="custom-control-label">Rider</span>
                        </label>                             
                    </div>
                    <div class="col-md-6"> <label class="custom-control custom-checkbox">
                        {{ Form::checkbox('rv_user_type[]', 'Vehicle Owner' , in_array('Vehicle Owner',$arr),array('class'=>'custom-control-input rv_user_type_cls')) }}                    <span class="custom-control-label">Vehicle Owner</span>
                    </label></div>

                </div>

            </div>

<!-- 
  <div class="form-group col-md-6 hideon_vehicle">
                              <label for="inputPassword6">Qualification</label>
                              {!!Form::text('rv_user_qulification',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off')) !!} 
                          </div>

                          <div class="form-group col-md-6 hideon_vehicle">
                              <label for="inputPassword6">Deposit Amount</label>
                              {!!Form::text('deposit_amount',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off')) !!} 
                          </div> -->





                          <!-- <div class="form-group col-md-6">
                              <label for="inputPassword6">Gender</label>
                              <div class="row">
                                  <div class="col-md-6">
                                   <label class="custom-control custom-checkbox">
                                    {{ Form::checkbox('rv_user_type', 'Rider' , true,array('class'=>'custom-control-input')) }}

                                    <span class="custom-control-label">Rider</span>
                                </label>                             
                            </div>
                            <div class="col-md-6"> <label class="custom-control custom-checkbox">
                                {{ Form::checkbox('rv_user_type', 'Vehicle' , false,array('class'=>'custom-control-input')) }}                    <span class="custom-control-label">Vehicle</span>
                            </label>
                        </div>
                        </div>
                    </div> -->
                </div>
            </div>

            <div class="col-md-1">
            </div>
            <div class="col-md-3">


             <div class="form-group author-img-bx">

                <label>Profile Photo</label>             

                <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-new img-thumbnail" style="width: 180px; height: 120px;">
                      @if(!empty($record->rv_user_img))
                      <img src="{{ asset('public/images/delivery_img/'.$record->rv_user_img)}}" alt="dd" />
                      @else
                      <img src="{{ asset('public/img/no-image.png')}}" alt="dd" />
                  @endif                   </div>
                  <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 180px; max-height: 120px; line-height: 20px;"></div>
                  <div class="row">
                     <div class="col-md-12">
                      <button type="button" class="btn btn-secondary" style="padding: 0px; background-color: #fff;"><span class="btn btn-default btn-file">
                        <span class="btn btn-secondary fileupload-new">Choose image</span>
                        <span  class="btn btn-secondary fileupload-exists">Change</span>

                        {{ Form::file('rv_user_img',null, ['class' => 'form-control','required']) }}</span>

                        <a class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a></button>

                    </div>

                </div>
            </div>
        </div>

<!-- 
   <div class="form-group author-img-bx">

<label>Marksheet</label>             
   
    <div class="fileupload fileupload-new" data-provides="fileupload">
            <div class="fileupload-new img-thumbnail" style="width: 180px; height: 120px;">
 @if(!empty($record->rv_user_marksheet))
                   <img src="{{ asset('public/images/delivery_img/'.$record->rv_user_marksheet)}}" alt="dd" />
                   @else
                   <img src="{{ asset('public/img/no-image.png')}}" alt="dd" />
                   @endif            </div>
           <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 180px; max-height: 120px; line-height: 20px;"></div>
           <div class="row">
             <div class="col-md-12">
              <button type="button" class="btn btn-secondary" style="padding: 0px; background-color: #fff;"><span class="btn btn-default btn-file">
                <span class="btn btn-secondary fileupload-new">Choose image</span>
                <span  class="btn btn-secondary fileupload-exists">Change</span>

                {{ Form::file('rv_user_marksheet',null, ['class' => 'form-control']) }}</span>

                <a class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a></button>

              </div>

            </div>
          </div>
                 </div>
             -->

         </div>


     </fieldset>     

     <fieldset class="scheduler-border">
      <legend class="scheduler-border">Locations &nbsp;:</legend>
      <div class="form-row">


        <div class="form-group col-md-4">
          <label for="inputEmail4">Country</label>
          @if(!empty($countries))
          {!!Form::select('rv_user_country',$countries,null,array('class'=>'form-control select2 selector','placeholder'=>'Select Country','data-toggle'=>'select2','required')) !!}
          @endif
      </div>
      <div class="form-group col-md-4">
          <label for="inputEmail4">State</label>

          @if(!empty($states))
          {!!Form::select('rv_user_state',$states,null,array('class'=>'form-control select2 state_selector','placeholder'=>'Select Country','data-toggle'=>'select2','required')) !!}
          @else
          {!!Form::select('rv_user_state',[],null,array('class'=>'form-control select2 state_selector','placeholder'=>'Select Country','data-toggle'=>'select2','required')) !!}
          @endif                             
      </div>

      <div class="form-group col-md-4">
          <label for="inputEmail4">City</label>


          @if(!empty($cities))
          {!!Form::select('rv_user_city',$cities,null,array('class'=>'form-control select2 city_selector','placeholder'=>'Select City','data-toggle'=>'select2','required')) !!}
          @else
          {!!Form::select('rv_user_city',[],null,array('class'=>'form-control select2 city_selector','placeholder'=>'Select City','data-toggle'=>'select2','required')) !!}
          @endif                   
      </div>

      <div class="form-group col-md-4">
          <label for="inputEmail4">Locality</label>

          @if(!empty($localities))
          {!!Form::select('rv_user_locality',$localities,null,array('class'=>'form-control locality_selector select2','placeholder'=>'Select Country','data-toggle'=>'select2','required')) !!}
          @else
          {!!Form::select('rv_user_locality',[],null,array('class'=>'form-control locality_selector select2','placeholder'=>'Select Country','data-toggle'=>'select2','required')) !!}
          @endif                       
      </div>


      <div class="form-group col-md-4">
          <label for="inputPassword4">Pin Code</label>
          {!!Form::text('rv_user_pincode',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','required','data-mask'=>'000000')) !!} 
      </div>


      <div class="form-group col-md-7">
          <label for="inputPassword4">Address</label>
          {!! Form::textarea('rv_user_address',null,['class'=>'form-control textarea', 'rows' => 2, 'cols' => 50,'id'=>'']) !!}
      </div>



  </div>
</fieldset>


<fieldset class="scheduler-border">
  <legend class="scheduler-border">Login Information &nbsp;:</legend>
   @if($users->status=='Default')

  <div class="form-row">
                        
                         <div class="form-group col-md-4">
                          <div class="row">
                            <div class="col-md-4"><b>Store Mobile</b></div>
                            <div class="col-md-1"><b>:</b></div>
                            <div class="col-md-6">{{$users->mobile}}</div>
                          </div>         
                        </div>
                        
                         <div class="form-group col-md-4">
                          <div class="row">
                            <div class="col-md-4"><b>login Email</b></div>
                            <div class="col-md-1"><b>:</b></div>
                            <div class="col-md-6"> {{$users->email}}</div>
                          </div>         
                        </div>
                        <div class="form-group col-md-4">
                          <div class="row">
                            <div class="col-md-4"><b>Password</b></div>
                            <div class="col-md-1"><b>:</b></div>
                            <div class="col-md-6">{{$users->password}}</div>
                          </div>         
                        </div>

 </div>
@else
  <div class="form-row">

      <div class="form-group col-md-4">
                      <label for="inputPassword4">Mobile</label>

          <div class="input-group ">

              {!!Form::text('rv_user_mobile',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','required','id'=>'mobile_id','minlength'=>'10' ,'maxlength'=>'10')) !!} 
          </div>
      </div>

      <div class="form-group col-md-4">
          <label for="inputEmail4">Login Email</label>
          {!!Form::text('rv_user_login_email',null,array('class'=>'form-control emailfull','placeholder'=>'','autocomplete'=>'off')) !!}


      </div>
      <div class="form-group col-md-4">
          <label for="inputEmail4">Password</label>

          <input id="password-field" type="password" class="form-control" name="rv_user_password" value="{{$record->rv_user_password}}">
          <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>


      </div>



  </div>
  @endif
</fieldset>





<button type="submit" class="btn btn-primary"><i class="far fa-edit"></i>  Update</button>



<a class="btn" href="{{url('admin/rider-vehicle-info')}}" style="background-color: #9e9b9b;color: #fff"><i class="fas fa-times"></i>  Cancel</a>

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


jQuery.validator.addMethod("mobile_country_code", function(value, element) {    
// var isSuccess = $("input[name='rv_user_mobile']").val();
// if(isSuccess.indexOf(+91) == 1){
// return true;

// }else if(isSuccess.indexOf(+1) == 1){
// return false;
// }

var isSuccess = $("#phone3").val();
console.log(isSuccess)
if (isSuccess !='') {

  return true;
}else{

  return false;
}

}, "Please enter the  valid number with country code");


    $('#seprate_form_id').validate({

       rules: {


         'rv_user_login_email': {
                      required: true,
                      
          remote: {
                    url: "{{url('check_user_name')}}",
                    type: "post",

                    data: {
                        check_user_name_edit: function () {
                            return $("input[name='rv_user_login_email']").val();
                        },user_id:{{$user_id}}
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



                    'rv_user_mobile': {
                      required: true,
                        minlength:10,
                      
          remote: {
                    url: "{{url('check_store_owner_mobile')}}",
                    type: "post",

                    data: {
                        check_store_owner_mobile_edit: function () {
                            return $("input[name='rv_user_mobile']").val();
                        },user_id:{{$user_id}}
                    },
                    dataFilter: function (data) {
              console.log($.trim(data));
                       if($.trim(data) == "exist"){
                 return 'false';
                }else if($.trim(data) == "notexist"){
                 return 'true';
                }
                    }
                },
                mobile_country_code : true
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


                     rv_user_login_email:{
                        remote:"This email is already registered"                  
                    }  ,
                       rv_user_mobile:{
                       remote:"this mobile no is already registered",
                    minlength:"This field is required."                  
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
                    $('select[name="rv_user_state"]').empty();
                    $('select[name="rv_user_city"]').empty();
                    $('select[name="rv_user_locality"]').empty();
                    $('input[name="rv_user_pincode"]').val('');                
                    $('select[name="rv_user_state"]').append('<option value="'+''+'">'+'None'+'</option>');
                    $.each(data, function(key, value) { 
                      $('select[name="rv_user_state"]').append('<option value="'+ key +'">'+value+'</option>');
                  });
                }

            });
          }
          else{
            $('select[name="rv_user_state"]').empty();
            $('select[name="rv_user_city"]').empty();
            $('select[name="rv_user_locality"]').empty();
            $('select[name="rv_user_pincode"]').empty();

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
                    $('select[name="rv_user_city"]').empty();
                    $('select[name="rv_user_locality"]').empty();
                    $('select[name="rv_user_pincode"]').empty();

                    $('select[name="rv_user_city"]').append('<option value="'+''+'">'+'None'+'</option>');
                    $.each(data, function(key, value) { 
                      $('select[name="rv_user_city"]').append('<option value="'+ key +'">'+value+'</option>');
                  });
                }

            });
          }
          else{
           $('select[name="rv_user_city"]').empty();
           $('select[name="rv_user_locality"]').empty();
           $('select[name="rv_user_pincode"]').empty();
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

                    $('select[name="rv_user_locality"]').empty();
                    $('select[name="rv_user_pincode"]').val(''); 

                    $('select[name="rv_user_locality"]').append('<option value="'+''+'">'+'None'+'</option>');
                    $.each(data, function(key, value) { 
                      $('select[name="rv_user_locality"]').append('<option value="'+ key +'">'+value+'</option>');
                  });
                }

            });
          }
          else{
              $('select[name="rv_user_locality"]').empty();
              $('select[name="rv_user_pincode"]').val(''); 
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
                    $('input[name="rv_user_pincode"]').val(data);

                }

            });
          }
          else{
            $('input[name="rv_user_pincode"]').empty();
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



<link rel="stylesheet" type="text/css" href="{{ asset('public/build/css/intlTelInput.css') }}">


<script type="text/javascript" src="{{ asset('public/build/js/intlTelInput.js') }}"></script>


<script>


var input = document.querySelector("#mobile_id");
var iti = window.intlTelInputGlobals.getInstance(input);


window.intlTelInput(input, {
allowDropdown: true,

autoHideDialCode: false,
autoPlaceholder: "off",
// dropdownContainer: document.body,
// excludeCountries: ["us"],
formatondIsPlay: false,
// geoIpLookup: function(callback) {
//   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
//     var countryCode = (resp && resp.country) ? resp.country : "";
//     callback(countryCode);
//   });
// },
// hiddenInput: "full_number",
// initialCountry: "auto",
// localizedCountries: { 'de': 'Deutschland' },
nationalMode: false,
// onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
// placeholderNumberType: "MOBILE",
preferredCountries: ['in'],
separateDialCode: true,

utilsScript: "{{asset('public/build/js/utils.js')}}",

});
var iti = window.intlTelInputGlobals.getInstance(input);
var countryData = iti.getSelectedCountryData();
$("#phone3").val(countryData.dialCode)


input.addEventListener("countrychange", function() {

var countryData = iti.getSelectedCountryData();

$("#phone3").val(countryData.dialCode)

});
// ................................errorMsg



</script>

@endpush