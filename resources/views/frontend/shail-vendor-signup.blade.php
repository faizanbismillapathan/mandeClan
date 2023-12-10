@extends('frontend.layouts.app')
@section('title',"Online Shopping site in US: Shop Online for Mobiles, Books, Watches, Shoes and More - mandeclan.com")
<!-- ................Add meta ................ -->


@section('meta')
@endsection

<!-- ................custom css................. -->

@section('customStyle')
@endsection

<!-- ................Add css link................. -->

@push('style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

@endpush

<!-- ................body................. -->
@section('innercontent')
<style type="text/css">

.iti__selected-flag{

  height: 70%!important;
}
  .error{
    color: red;
  }
  .login-sign-forg .img img {
    position: absolute;
    width: 100%;
    height: 100%;
  }

  .btn-custome{
    background-color: #f26e21;
    color: #fff;
  }


  .typeahead.dropdown-menu
  {
    transform: unset !important;
    width: 100% !important;
    opacity: 1 !important;
  }
  .typeahead.dropdown-menu .dropdown-item
  {
    min-width: 100%;
  }
  .typeahead.dropdown-menu .dropdown-item
  {
    font-weight: lighter;
  }
  .typeahead.dropdown-menu .dropdown-item 
  {
    color: #616161;
    white-space: break-spaces;
  }
  .typeahead.dropdown-menu .dropdown-item strong
  {
    font-weight: 600;
    color: #000000;
  }
  
  
  
  .is-invalid {
    box-shadow:none !important;
    border-color: none !important;
  }
</style>

<script>


  $(document).ready(function(){
    $(".selectpicker").change(function(){

      if ($('.selectpicker option').is(":selected")) {
          // console.log('ff',$(this).val())
          var  check=$(this).val();
          if (check.length !=0) {
            $(this).closest(".multiselect-option").addClass("intro");

          }else{
            $(this).closest(".multiselect-option").removeClass("intro");
            $(this).parent().parent().children('label').css({"top": "2.3rem","font-size": "14px"})
            $(this).parent().parent().parent().children('label').css({"top": "2.3rem","font-size": "14px"})
          }
        }
        else
        {
      // console.log('sss',$(this))
      $(this).closest(".multiselect-option").removeClass("intro");
      $(this).parent().parent().children('label').css({"top": "2.3rem","font-size": "14px"})
    }
  });
    
    $('.selectpicker option').each(function() {
      if($(this).is(':selected')){
// console.log('ttt',$(this))
$(this).parent().parent().parent().children('.').css({"top": "1rem","font-size": "12px"})

$(this).parent().parent().children('label').css({"top": "1rem","font-size": "12px"})
}
});
    /* ........ */
  });
</script>

{{-- {{ Form::text('session_vendor_otp',Session::get('session_vendor_otp'),['class'=>'session_vendor_otp']) }} --}}

<div style="background: beige;" class="row margin0 login-sign-forg zar_new_forg">
  <div class="col-md-6 padding0" style="margin: 0 auto;padding:50px 0px 40px 0px;">
    <div class="row margin0" style="border:1px solid #ccc">
      <!--<div class="col-md-5 padding0">-->
        <!--  <div class="img">-->
          <!--  <img src="{{asset('public/img/mandeclan_black1.png')}}">-->
          <!--  </div>-->
          <!--</div>-->
          <div style="background: white;" class="col-md-12 bg_white px-5 py-3">
            <div class="px-lg-5 p-0">

              <div class="alert alert-danger" role="alert" id="errorMessage" style="display: none;">

              </div>

              <div class="alert alert-success" role="alert" id="sucessMessage" style="display: none;">
              </div>
              
              <h2 class="title-heading">Merchant Sign Up</h2>
              <div class="heading-border"></div>
              {{-- {!!Form::open(['url'=>['vendor_ragister'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'vendor_master_form'])!!}

                              <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" class="form-control" placeholder="Enter your name" name="store_owner_name" required="required" autocomplete="off" value="{{ Session::get('store_owner_name') }}">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Store Name</label>
                      <input type="text" class="form-control" placeholder="Enter your store name" name="store_name" required="required" autocomplete="off" value="{{ Session::get('store_name') }}">
                    </div>
                  </div>
                </div>
                <div class="row">


                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" class="form-control" placeholder="Enter your email" name="store_owner_email" id="store_owner_emailss" required="required" autocomplete="off" value="{{ Session::get('store_owner_email') }}">
                    </div>
                  </div>


                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Contact No.</label>
                      <input type="text" name="store_owner_mobile" class="form-control" placeholder="Enter contact number" required="required" autocomplete="off" id="store_owner_mobiles" value="{{ Session::get('store_owner_mobile') }}">
                    </div>
                  </div>

<div class="form-group col-md-5">
                    <label class="">Gender</label>
                    <div class="row">
                      <div class="col-md-6">
                       <label class="custom-control custom-radio">
                        {{ Form::radio('store_owner_gendor', 'Male' , true,array('class'=>'custom-control-input')) }}

                        <span class="custom-control-label"> Male</span>
                      </label>                             
                    </div>
                    <div class="col-md-6"> <label class="custom-control custom-radio">
                      {{ Form::radio('store_owner_gendor', 'Female' , false,array('class'=>'custom-control-input')) }}                    <span class="custom-control-label">Female</span>
                    </label></div>

                  </div>

                </div>


                  <div class="form-group col-md-7">
                    <label class="">Type</label>
                    <div class="row">
                      <div class="col-md-6">
                       <label class="custom-control custom-radio">
                        {{ Form::radio('type', 'Store' , true,array('class'=>'custom-control-input service_type_cls')) }}

                        <span class="custom-control-label">Physical Store</span>
                      </label>                             
                    </div>
                    <div class="col-md-6"> <label class="custom-control custom-radio">
                      {{ Form::radio('type', 'Service' , false,array('class'=>'custom-control-input service_type_cls')) }}                    <span class="custom-control-label">Service Store</span>
                    </label></div>

                  </div>

                </div>




                <div class="form-group col-md-6 select_store_category">
                 <div class="multiselect-option">
                  <div class="form-group">
                    <label class="">Select Store Category</label>
                    {!!Form::select('store_category',$categories,null,array('class'=>'form-control select2  ','placeholder'=>'Select Category','data-toggle'=>'select2')) !!}
                  </div>
                </div>
              </div>


              <div class="form-group col-md-6 select_service_category" style="display:none">
               <div class="multiselect-option">
                <div class="form-group">
                  <label class="">Select Service Category</label> <br>
                  {!!Form::select('service_category',$servic_categories,null,array('class'=>'form-control select2  ','placeholder'=>'Select Category','data-toggle'=>'select2')) !!}
                </div>
              </div>
            </div>
                


                  <div class="form-group col-md-6">
                    <label class="">Website</label>
                    {!!Form::url('store_website',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off')) !!} 
                  </div>

                  <div class="form-group col-md-6">
                   <div class="multiselect-option">
                    <div class="form-group">
                      <label for="inputEmail6">City</label>

                      {!!Form::select('store_city',$cities,null,array('class'=>'form-control select2 city_selector','placeholder'=>'Select City','data-toggle'=>'select2','required')) !!}
                    </div>
                  </div>
                </div>

                <div class="form-group col-md-6">
                 <div class="multiselect-option">
                  <div class="form-group">
                    <label for="inputEmail6">Locality</label>

                    {!!Form::select('store_locality',[],null,array('class'=>'form-control locality_selector select2','placeholder'=>'Select Country','data-toggle'=>'select2','required')) !!}
                  </div>
                </div>
              </div>


              <div class="form-group col-md-6">
                <label for="inputPassword6">Pin Code</label>
                {!!Form::text('store_pincode',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','required','data-mask'=>'000000')) !!} 
              </div>

            </div>

            

            <button type="submit" class="btn btn-success btn-raised custom-cheryred r-3">Submit</button>
            {{Form::close()}} --}}

            <form id="first_form" class="change_form_cls">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" placeholder="Enter your name" name="store_owner_name" required="required" autocomplete="off" value="{{ Session::get('store_owner_name') }}">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Store Name</label>
                    <input type="text" class="form-control" placeholder="Enter your store name" name="store_name" required="required" autocomplete="off" value="{{ Session::get('store_name') }}">
                  </div>
                </div>
              </div>
              <div class="row">


                <div class="col-md-6">
                  <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control emailfull" placeholder="Enter your email" name="store_owner_email" id="store_owner_emailss" required="required" autocomplete="off" value="{{ Session::get('store_owner_email') }}">
                  </div>
                </div>


                <div class="col-md-6">
                  <div class="form-group">
                    <label>Contact No.</label>

                    {{-- <input type="text" name="store_owner_mobile" class="form-control numbersOnly" placeholder="Enter contact number" required="required" autocomplete="off" id="store_owner_mobiles" minlength="10" maxlength="13" value="{{ str_replace(' ', '', Session::get('store_owner_mobile')) }}"> --}}

<div class="input-group">

                            {!!Form::text('store_owner_mobile',str_replace(' ', '', Session::get('store_owner_mobile')),array('class'=>'form-control mobile_input numbersOnly','placeholder'=>'Mobile Number','id'=>'store_owner_mobiles','minlength'=>'10' ,'maxlength'=>'10')) !!}



                          <input type="hidden" name="user_country_code" id="phone3" value="">
</div>
                  </div>
                </div>



                <div class="form-group col-md-5">
                  <label class="">Gender</label>
                  <div class="row">
                    <div class="col-md-6">
                     <label class="custom-control custom-radio">
                  
                  @if(!empty(Session::get('store_owner_gendor')))
<input type="radio"  name="store_owner_gendor" class="custom-control-input " value="Male"  {{ Session::get('store_owner_gendor') == 'Male' ? 'checked' : '' }}>
@else
<input type="radio"  name="store_owner_gendor" class="custom-control-input " value="Male" checked>

@endif

                      <span class="custom-control-label"> Male</span>
                    </label>                             
                  </div>
                  <div class="col-md-6"> <label class="custom-control custom-radio">


                    <input type="radio"  name="store_owner_gendor" class="custom-control-input " value="Female"  {{ Session::get('store_owner_gendor') == 'Female' ? 'checked' : '' }}>


                  <span class="custom-control-label">Female</span>
                  </label></div>

                </div>

              </div>


              <div class="form-group col-md-7">
                <label class="">Type</label>
                <div class="row">
                  <div class="col-md-6">
                   <label class="custom-control custom-radio">
                                      @if(!empty(Session::get('type')))

<input type="radio"  name="type" class="custom-control-input service_type_cls" value="Store"  {{ Session::get('type') == 'Store' ? 'checked' : '' }}>
@else
<input type="radio"  name="type" class="custom-control-input service_type_cls" value="Store" checked>

@endif
                    <span class="custom-control-label">Physical Store</span>
                  </label>                             
                </div>
                <div class="col-md-6"> <label class="custom-control custom-radio">

                  <input type="radio"  name="type" class="custom-control-input service_type_cls" value="Service"  {{ Session::get('type') == 'Service' ? 'checked' : '' }}>

                    <span class="custom-control-label">Service Store</span>
                </label></div>

              </div>

            </div>





            <div class="form-group col-md-6 select_store_category">
             <div class="multiselect-option">
              <div class="form-group">
                <label class="">Select Store Category</label>
                {!!Form::select('store_category',$categories, Session::get('store_category'),array('class'=>'form-control select2  ','placeholder'=>'Select Category','data-toggle'=>'select2')) !!}
              </div>
            </div>
          </div>


          <div class="form-group col-md-6 select_service_category" style="display:none">
           <div class="multiselect-option">
            <div class="form-group">
              <label class="">Select Service Category</label> <br>
              {!!Form::select('service_category',$servic_categories,Session::get('service_category'),array('class'=>'form-control select2  ','placeholder'=>'Select Category','data-toggle'=>'select2')) !!}
            </div>
          </div>
        </div>


        <div class="form-group col-md-6">
         <div class="multiselect-option">
          <div class="form-group">
            <label for="inputEmail6">City</label>

            {!!Form::select('store_city',$cities,Session::get('store_city'),array('class'=>'form-control select2 city_selector','placeholder'=>'Select City','data-toggle'=>'select2','required')) !!}
          </div>
        </div>
      </div>

      <div class="form-group col-md-6">
       <div class="multiselect-option">
        <div class="form-group">
          <label for="inputEmail6">Locality</label>

          {!!Form::select('store_locality',$localities,Session::get('store_locality'),array('class'=>'form-control locality_selector select2','placeholder'=>'Select Locality','data-toggle'=>'select2','required')) !!}
        </div>
      </div>
    </div>


    <div class="form-group col-md-6">
      <label for="inputPassword6">Pin Code</label>
      {!!Form::text('store_pincode',Session::get('store_pincode'),array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','required','data-mask'=>'000000')) !!} 
    </div>

    <div class="col-md-6">
      <div class="form-group">
        <label class="">Website</label>
        {!!Form::url('store_website',Session::get('store_website'),array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off')) !!} 
      </div>
    </div>


    <div class="col-md-6">
      <div class="form-group">
        <label class="">Password</label>
        {!!Form::text('store_password',Session::get('store_password'),array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off')) !!} 
      </div>
    </div>



  </div>


  <button type="submit" class="btn btn-success btn-raised custom-cheryred r-3">Submit</button>

</form>


<div class="">
  <form id="otp_form" class="otp_form_cls " style="display: none;">




   <div class="row">
    <div class="col-md-10">
      <p>An OTP has been sent to</p>
      <h6 class="change_contact_cls"><b class="store_owner_mobile">{{ Session::get('store_owner_mobile') }}</b></h6>
      <p style="font-size: 12px">Please enter it below for a one time verification.</p>
    </div>
    <div class="col-md-2 " id="again_click_show" style="color: #6c757d" >
     <i class="fas fa-edit"></i> edit
   </div>

 </div>




 <div class="input-grp otp_show hide otp_ids">
  <div class="input-group input_grp">

    <input type="text" class="form-control numbersOnly" placeholder="Enter OTP " required="required" id="otp" name="otp" maxlength="4" minlength="4" >
    <div class="input-group-append" >

      {{-- ........ --}}
      <span class="input-group-text  otp_show hide timer_ids" id="timer_id">
        <span class="text-secondary" id="timer">01:00</span>
      </span>

      {{-- ....... --}}

      <span class="input-group-text hide center" id="resend_otps">
        <p id="resend_otps_submit " style="cursor: pointer;" class="contactFormTimer">Resend OTP</p>
      </span>



      {{-- ..... --}}
    </div>
  </div>


</div>


{{ Form::hidden('store_owner_mobile',Session::get('store_owner_mobile'),['class'=>'store_owner_mobile']) }}
{{ Form::hidden('store_owner_email',Session::get('store_owner_email'),['class'=>'store_owner_email']) }}
{{ Form::hidden('store_owner_name',Session::get('store_owner_name'),['class'=>'store_owner_name']) }}
{{ Form::hidden('store_name',Session::get('store_name'),['class'=>'store_name']) }}
{{ Form::hidden('store_category',Session::get('store_category'),['class'=>'store_category']) }}
{{ Form::hidden('store_city',Session::get('store_city'),['class'=>'store_city']) }}
{{ Form::hidden('service_category',Session::get('service_category'),['class'=>'service_category']) }}

{{ Form::hidden('store_owner_gendor',Session::get('store_owner_gendor'),['class'=>'store_owner_gendor']) }}
{{ Form::hidden('type',Session::get('type'),['class'=>'type']) }}
{{ Form::hidden('store_website',Session::get('store_website'),['class'=>'store_website']) }}
{{ Form::hidden('store_locality',Session::get('store_locality'),['class'=>'store_locality']) }}
{{ Form::hidden('store_pincode',Session::get('store_pincode'),['class'=>'store_pincode']) }}
{{ Form::hidden('store_password',Session::get('store_password'),['class'=>'store_password']) }}



<button  class="btn-raised btn btn-success custom-cheryred ContinueOtpBtn mt-3" id="td_id">Verify OTP</button>


</form>

<div class="row">
  <div class="col-md-12">
    <div class="center footer-div">
      <p>Already Register ? <a href="{{ url('vendor-login') }}" style="color: blue;">Login here</a></p>

    </div>
  </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<script src="{{asset('public/js/validation.js')}}"></script> 


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

<link rel="stylesheet" type="text/css" href="{{ asset('public/build/css/intlTelInput.css') }}">


<script type="text/javascript" src="{{ asset('public/build/js/intlTelInput.js') }}"></script>

<script>


var input = document.querySelector("#store_owner_mobiles");
var iti = window.intlTelInputGlobals.getInstance(input);


window.intlTelInput(input, {
allowDropdown: true,

autoHideDialCode: false,
autoPlaceholder: "off",
// dropdownContainer: document.body,
excludeCountries: ["us"],
formatOnDisplay: false,
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
      onlyCountries: ['us', 'in'],
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




      <script type="text/javascript">

      // var initial;

      $(".contactFormTimer").click(function(){
        document.getElementById('timer').innerHTML =
        01 + ":" + 00;
        startTimerFirst();
      });


      function startTimerFirst() {

        var presentTime = document.getElementById('timer').innerHTML;
        var timeArray = presentTime.split(/[:]+/);
        var m = timeArray[0];
        var s = checkFirst((timeArray[1] - 1));
        if(s==59){m=m-1}

//   if (m=='-1') {

//         setTimeout(startTimerSecond, 1000);

// }

console.log(m)
if(m<0){

  $("#resend_otps").show();
  $(".timer_ids").hide();
  $(".otp_ids").show();
  $(".both_pe_show").hide();


// $(".ContinueBtn").show();
// $(".VerifyOtpFunction").hide();

  // window.clearTimeout(timer);

  myStopFirstFunction()



}

document.getElementById('timer').innerHTML =
m + ":" + s;
var initial= setTimeout(startTimerFirst, 1000);

}


function checkFirst(sec) {
    if (sec < 10 && sec >= 0) {sec = "0" + sec}; // add zero in front of numbers < 10
    if (sec < 0) {sec = "59"};
    return sec;
  }
  function myStopFirstFunction() {
    clearTimeout(initial);
    // window.clearTimeout(initial);

  }
</script>


<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script>
  $(document).ready(function () {

  $('#store_owner_mobiles').on('change', function() {
                    $(".store_owner_mobile").text("+"+$("#phone3").val()+$(this).val())

})


    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });



    $.validator.addMethod("numbersss", function(value, element) {
        return /^[\s()+-]*([0-9][\s()+-]*){6,20}$/.test(value) //email
      }, "Please enter valid mobile no");



jQuery.validator.addMethod("mobile_country_code", function(value, element) {    
// var isSuccess = $("input[name='store_mobile']").val();
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




    $( "#first_form" ).validate({

      rules: {

        store_owner_name: {
          required: true,
          required: true


        }, 
        store_owner_mobile: {
          required: true,
          numbersss: true,
     

          remote: {
            url: "{{url('check_store_owner_mobile')}}",
            type: "post",

            data: {
              check_store_owner_mobile: function () {

                $(".store_owner_mobile").text("+"+$("#phone3").val()+$("#store_owner_mobiles").val())
console.log("+"+$("#phone3").val()+$("#store_owner_mobiles").val())

                return "+"+$("#phone3").val()+$("#store_owner_mobiles").val();
              }
            },
            dataFilter: function (data) {
              console.log($.trim(data));
              // console.log("{{url('check_store_owner_mobile')}}")
              if($.trim(data) == "exist"){
                return 'false';
              }else if($.trim(data) == "notexist"){
                return 'true';
              }
            }
          },
               mobile_country_code : true


        }, 
        //   user_email: {
        //   required: true,
        //  email: true

        // }, 
        gendor: {
          required: true,
          required: true

        }, 
        store_name: {
          required: true,
          required: true

        }, 
        store_owner_email: {
          required: true,
          email: true,
          remote: {
            url: "{{url('check_user_name')}}",
            type: "post",

            data: {
              check_user_name: function () {
                return $("#store_owner_emailss").val();
              }
            },
            dataFilter: function (data) {


              console.log($.trim(data));
              // console.log("{{url('check_user_name')}}")
              if($.trim(data) == "exist"){
                // $(".iti__selected-flag").css("margin-top", "-10px");

                return 'false';
              }else if($.trim(data) == "notexist"){
                return 'true';
              }
            }
          }
        },
        password: {
          required: true,
          required: true

        },

  },  

      messages: {  // <-- you must declare messages inside of "messages" option
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



  store_owner_email:{
    remote:"Email must be unique."                  
  }  ,

  store_owner_mobile:{
    remote:"Mobile no must be unique."                  
  }       
},


submitHandler: function(form) {  

// alert('dddd')
  saveFormDatas(form);
  return false;


},

});

  });
</script>



<script>
  jQuery('.numbersOnly').keyup(function () { this.value = this.value.replace(/[^0-9\.]+/g,''); });

  $('#resend_otps').click(function(e){
    event.preventDefault();


// alert('i click')

$(".otp_show").show();


$("#resend_otps").hide();


$("#timer_id").show();

$("#errorMessage").hide();
$("#sucessMessage").hide();




$('.ContinueBtn').html('Sending..');

$(".ContinueBtn").prop('disabled',true)

$.ajax({
  url: "{{ url('vendor_ragister') }}",
  type:"POST",

  data: $('#first_form').serialize(),

  success:function(response){


    $(".ContinueBtn").prop('disabled',false)
    $('.ContinueBtn').html('Submit');

    $("#otp_form").show();
    console.log(response);
    $("#resend_otps").hide();
    $(".otp_form_cls").show();
    $("#first_form").hide();


// store_owner_gendor
// type
// service_category
// store_website
// store_locality
// store_pincode


$(".store_owner_mobile").val(response.owner_mobile)
$(".store_owner_email").val(response.owner_email)
$(".store_owner_name").val(response.owner_name)
$(".store_name").val(response.store_name)
$(".store_category").val(response.category)
$(".store_city").val(response.store_city)

$(".store_owner_gendor").val(response.store_owner_gendor)
$(".type").val(response.type)
$(".service_category").val(response.service_category)
$(".store_website").val(response.store_website)
$(".store_locality").val(response.store_locality)
$(".store_pincode").val(response.store_pincode)
$(".store_password").val(response.store_password)




},

error:function(error){
  console.log(error)
}


});



})
</script>


<script type="text/javascript">

  $('#again_click_show').click(function(e){
    event.preventDefault();

    $("#first_form").show();
    $("#otp_form").hide();

    $(".ContinueBtn").prop('disabled',false)
    $('.ContinueBtn').html('Submit');

  })


  function saveFormDatas() {



    $('.ContinueBtn').html('Sending..');

    $(".ContinueBtn").prop('disabled',true)

    $.ajax({
      url: "{{ url('vendor_ragister') }}",
      type:"POST",

      data: $('#first_form').serialize(),

      success:function(response){

        $(".ContinueBtn").prop('disabled',false)
        $('.ContinueBtn').html('Submit');

        $("#otp_form").show();
        console.log(response,'saveFormDatas');
        $("#resend_otps").hide();
        $(".otp_form_cls").show();

        $("#first_form").hide();


        $(".store_owner_mobile").val(response.owner_mobile)
        $(".store_owner_email").val(response.owner_email)
        $(".store_owner_name").val(response.owner_name)
        $(".store_name").val(response.store_name)
        $(".store_category").val(response.category)
        $(".store_city").val(response.store_city)



        $(".store_owner_gendor").val(response.store_owner_gendor)
        $(".type").val(response.type)
        $(".service_category").val(response.service_category)
        $(".store_website").val(response.store_website)
        $(".store_locality").val(response.store_locality)
        $(".store_pincode").val(response.store_pincode)
        $(".store_password").val(response.store_password)



// alert('saveFormDatas01')

startTimerFirst();

document.getElementById('timer').innerHTML =
01 + ":" + 00;



      },
    });


  };




  $(".ContinueOtpBtn").click(function() {

    var otp =$("#otp").val();

    console.log($('#otp_form').serialize());
    $('.ContinueOtpBtn').html('Sending..');

    $(".ContinueOtpBtn").prop('disabled',true)

    var clickDisbled="{{ url('seller/dashboard') }}"
    $.ajax({
      url: "{{ url('send_vendor_otp_signup') }}",
      type:"POST",
      
      data: $('#otp_form').serialize(),

      success:function(response){

           // $(".both_pe_show").hide();
            // $(".otp_show").show();
            console.log(response,'send_vendor_otp_signup');
            $(".ContinueOtpBtn").prop('disabled',false)
            $('.ContinueOtpBtn').html('Submit');



            if ($.trim(response)=="success") {

              $('#sucessMessage').show();

              $('#sucessMessage').html('your otp successfully verified');
              window.location.replace(clickDisbled);

            }else if($.trim(response)=="not_in_same_role"){

             $('#errorMessage').show();

             $('#errorMessage').html('Email already registered in some other role');

           }else{

            $('#errorMessage').show();

            $('#errorMessage').html('Sorry your OTP is not valid !');

          }

          $('.VerifyOtpFunction').html('Submit');

        },
        error:function(errorMsg){

          console.log(errorMsg)
        }

      });






  });

</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<style>
  .filter-option-inner-inner {
    color: #9E9E9E;
    font-size: 13px;
    text-transform: capitalize;
  }
  .multiselect-option .btn
  {
    padding: 10px 0;
    background-color: transparent;
  }
  .multiselect-option .bs-searchbox .form-control {
    border: 1px solid #ccc;
    background-image: unset;
    padding-left: 10px;
    border-radius: 4px;
  }
  .multiselect-option .dropdown-menu .dropdown-item {
    min-width: 100%;
    max-width: 100%;
  }
  .multiselect-option  li {
    position: relative;
  }
  .multiselect-option li a {
    min-height: 1rem !important;
    padding: 0.5rem 1rem;
    display: flex;
    font-size: 12px;
  }
  .multiselect-option li a:hover
  {
    background-color: #fafafa;
  }
</style>


<script type="text/javascript">
  var path = "{{ url('api/append_locality') }}";
  $('input.typeahead').typeahead({

    source:  function (keyword, process) {

      return $.get(path, { keyword: keyword }, function (data) {
          // console.log(data)
          return process(data);
        });
    }
  });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>


<script type="text/javascript">
  $(document).ready(function(){ 
    $(".service_type_cls").click(function() {

        var test = $(this).val();
        // alert('test')


        if(test=='Store'){
          $(".select_store_category").show();
          $(".select_service_category").hide();
        }else {

         $(".select_store_category").hide();
         $(".select_service_category").show();
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
          url: "{{url('append_locality')}}",
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
          url: "{{url('append_pincode')}}",
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

    $('.select2').select2({
      closeOnSelect: false
    });

  });
</script>
@endsection