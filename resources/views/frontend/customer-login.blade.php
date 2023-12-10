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
@endpush

<!-- ................body................. -->
@section('innercontent')

<style type="text/css">
 .hide{
display:none;
}
.invalid-feedback{
    color: red;
}
#timer{
    color: #000;
}

#resend_otps_submit{
    cursor: pointer;
    color: red;
    background: #000;
    margin: auto;
    font-size: 12px;
    padding: 6px;
}
  .error{
        font-size: 0.8rem;
  }

  .vendor-list-page .input-group{
    border-radius:unset;
        border-bottom: 1px solid #BDBDBD;
  }

  .vendor-list-page .input-group img{

    transform:unset;
    width:22px;
  }
.login-sign-forg .img img {
    position: absolute;
    width: 100%;
    height: 100%;
}

.login-sign-forg{

  background: beige;
}
.iti{

  width: 85%;
}

    .input_grp
    {
        border-bottom: 1px solid #BDBDBD;
    }
    .input_grp .form-control
    {
        background-image: unset;
       
    }
    .input_grp .input-group-text
    {
        padding: 10px;
    }

    .btn-custome{
          background-color: #f26e21;
          color: #fff;
    }
    
    .is-invalid {
        box-shadow:none !important;
        border-color: none !important;
    }
</style>
<div class="row login-sign-forg zar_new_forg py-5">
  <div class="col-md-7 shadow-lg bg-white rounded m-auto">
   <div class="row p-lg-5 py-5 r-3" style="border:2px solid">
    <div class="col-md-5" >
      <div class="img w-100">
        <img class="d-lg-block d-none" src="{{asset('public/img/signImg.png')}}">
      </div>
    </div>
    <div class="col-md-7 padding0" style="background-color: #fff">

 

<div class="padding">
  <h3 class="title-heading"  style="margin-top:0px">Customer Sign In/Sign Up</h3>
  <!--<div class="heading-border"></div>-->
  {{-- {{ Session::get('session_client_otp') }} --}}

  <div class="alert alert-danger mx-5" role="alert" id="errorMessage" style="display: none;">

  </div>

  <div class="alert alert-success mx-5" role="alert" id="sucessMessage" style="display: none;">

  </div>

    <div class="alert alert-danger mx-5" role="alert" id="errorMessage" style="display: none;">

 </div>

                  <div class="alert alert-success" role="alert" id="sucessMessage" style="display: none;">

                  </div>

                  <form id="first_form" class="change_form_cls px-5">

                      <div class="form-group">
                          <div class="input-group ">

                            {!!Form::text('mobile',null,array('class'=>'form-control mobile_input numbersOnly','placeholder'=>'Enter Mobile Number','id'=>'mobile_id','minlength'=>'10' ,'maxlength'=>'10')) !!}
      <input type="hidden" name="user_country_code" id="phone3" value="">

                            <div class="input-group-append" >

                            <span class="input-group-text hide" id="clears" type="button">
                                <i class="fas fa-times" style="margin-left: 0px;color: #000;"></i>
                            </span>

                        </div>
                    </div>
                </div>

                <span id="valid-msg" class="hide ">✓ Valid</span>
                
        

                <span id="error-msg" class="hide "></span>
                <div class="form-group both_pe_show hide ">
                  <label class="">Name</label>
                  <input type="text" class="form-control"  name="user_name" required="required" autocomplete="off" id="user_name_id">
                </div>


              <div class="form-group contact_pe_show hide ">
                  <label class="">Email</label>
                  <input type="email" class="form-control" name="email" required="required" autocomplete="off" id="email_id">
              </div>





              <input type="hidden" name="checkSignSignUp " id="checkSignSignUp" value="">




              <div class="input-grp otp_show hide otp_ids">
                  <div class="input-group input_grp">

                      <input type="text" class="form-control numbersOnly" placeholder="Enter OTP " required="required" id="otp" name="otp" maxlength="4" minlength="4" >
                      <div class="input-group-append">

                        {{-- ........ --}}
                    <span class="input-group-text  otp_show hide timer_ids"  id="timer_id">
                          <span  id="timer">01:00</span>
                     </span>

                      {{-- ....... --}}

                      <span class="input-group-text hide center" id="resend_otps">
                          <p id="resend_otps_submit " style="cursor: pointer;  margin-bottom: 0px;" class="contactFormTimer">Resend OTP</p>
                      </span>


                      {{-- ..... --}}
                  </div>
              </div>

              {{ Form::hidden('mobile',Session::get('vendor_enquiry_contact'),['class'=>'vendor_enquiry_contact']) }}
              {{ Form::hidden('id',Session::get('vendor_enquiry_id'),['class'=>'vendor_enquiry_id']) }}

          </div>


          <button  style="display: none;margin-top: 10px;" class="btn btn-raised btn-custome ContinueBtn hide" id="td_id">Next</button>

          <button style="display:none;margin-top: 10px;" type="button" class="btn btn-raised btn-custome VerifyOtpFunction hide" id="td_id">Next</button>

          </form>
             <div class="pl-5">
               <span>Are you a Merchant ?
               </span>
               <a href="{{ url('vendor-login') }}"><span class="text-success">Click here</span></a>
             </div>
              <div class="pl-5">
               <span>Login Via Email ?
               </span>
               <a href="{{ url('customer/login') }}"><span class="text-info">Click here</span></a>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>



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
$(".email_pe_show").hide();
$(".contact_pe_show").hide();
$(".both_pe_show").hide();

$('#mobile_id').prop('readonly', true);


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




<script type="text/javascript">
jQuery('.numbersOnly').keyup(function () { this.value = this.value.replace(/[^0-9\.]+/g,''); });

$("#clears").on("click", function() {
$("#mobile_id").val("")

$(".hide").hide()

location.reload()

});
</script>
<script>
$(document).ready(function() {


$(".hide").hide()
$(".mobile_input").keyup(function() {

var  value =$(this).val()

var newtext=value.replace('91', '');
var newtext1=newtext.replace('+', '');

if (newtext1.length > 1) {
$(".ContinueBtn").show();
$("#clears").show();

$(".VerifyOtpFunction").hide();
$("#first_form").attr("data",value);


}else{
$("#clears").hide();
$(".hide").hide();

$(".ContinueBtn").hide();
$(".otp_show").hide();
$('#mobile_id').prop('readonly', false);

}
});

});
</script>

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script>
$(document).ready(function () {
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});




$.validator.addMethod("email_or_phone_number", function(value, element) {
return /^[\s()+-]*([0-9][\s()+-]*){6,20}$/.test(value) 
// ||   //Indian Mobile No. Lenth 10 
// /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(value) //email
}, "Please enter valid mobile number");


$.validator.addMethod("numbersss", function(value, element) {
return /^[\s()+-]*([0-9][\s()+-]*){6,20}$/.test(value) //email
}, "Please enter valid mobile number");



$( ".change_form_cls" ).validate({

rules: {

// mobile: {
// required: true,
// email_or_phone_number: true,
// },

mobile: {
required: true,
numbersss: true,
minlength:10,
maxlength:13,

//         remote: {
//       url: "{{url('check_vendor_contactno')}}",
//       type: "post",

//       data: {
//         check_vendor_contactno: function () {
//           return '+'+$("#phone3").val()+$("#mobile_id").val();
//         }
//       },
//       dataFilter: function (data) {
//         console.log($.trim(data));
//         if($.trim(data) == "exist"){
//           return 'false';
//         }else if($.trim(data) == "notexist"){
//           return 'true';
//         }
//     }
// }

}, 


email: {
required: true,
email: true,
remote: {
url: "{{url('check_user_name')}}",
type: "post",

data: {
check_user_name: function () {
return $("#email_id").val();
}
},
dataFilter: function (data) {
console.log($.trim(data));
  // console.log("{{url('check_user_name')}}")
  if($.trim(data) == "exist"){
    return 'false';
}else if($.trim(data) == "notexist"){
    return 'true';
}
}
}
},

},      messages: { 
email:{
remote:"this email must be unique."                  
}       
,

vendor_contactno:{
mobile:"Mobile number must be unique."                  
} 

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
        if ($el.hasClass('select2-hidden-accessible') || $el.attr('data-city') === 'tagsinput') {
          $el.parent().addClass('is-invalid');
      }
  },

  submitHandler: function(form) {  
// $("#professionalinfo_edit").modal('hide');
// $(this).parent().find(".modal").modal("hide");
// $(".ContinueBtn").hide();
// $(".both_pe_show").show();
// $("#ContinueBtn").hide();

// var formData = new FormData(form);

// alert(formData)
// console.log(formData);

saveFormDatas(form);
return false;
// someFunction();
// $(".contact_pe_show").show();
// $(".email_pe_show").show();

},

});

});
</script>


<script>
$('#resend_otps').click(function(e){
event.preventDefault();


$(".VerifyOtpFunction").prop('disabled',false)
$('.VerifyOtpFunction').html('Varify & Login');


$(".otp_show").show();
$('#mobile_id').prop('readonly', true);


$("#resend_otps").hide();


$("#timer_id").show();
// $(".VerifyOtpFunction").hide();
$("#errorMessage").hide();
$("#sucessMessage").hide();


// SendOtpFunction()

var mobile_id ='+'+$("#phone3").val()+$("#mobile_id").val();
var user_name_id =$("#user_name_id").val();

// alert(mobile_id)
// alert(user_name_id)

$('.ContinueBtn').html('Sending..');

$(".ContinueBtn").prop('disabled',true)

console.log($('#first_form').serialize())

$.ajax({
url: "{{ url('send_client_otp') }}",
type:"POST",

data: {user_name:user_name_id,mobile:mobile_id},

success:function(response){


document.getElementById('timer').innerHTML =
01 + ":" + 00;
startTimerFirst();



$(".ContinueBtn").prop('disabled',false)
$('.ContinueBtn').html('Submit');

$(".otp_show").show();
$('#mobile_id').prop('readonly', true);

console.log(response);

$(".ContinueBtn").hide();
$(".VerifyOtpFunction").show();

// $("#td_id").toggleClass('ContinueBtn VerifyOtpFunction');

// $("#first_form").toggleClass('change_form_cls new_form_cls');

},
});

})
</script>

<script type="text/javascript">

function saveFormDatas() {

// $(".ContinueBtn").click(function() {


// alert('sss')

var mobile_id ='+'+$("#phone3").val()+$("#mobile_id").val();
var user_name_id =$("#user_name_id").val();

$("#errorMessage").hide();
$("#sucessMessage").hide();

$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});


$('.ContinueBtn').html('Sending..');

$(".ContinueBtn").prop('disabled',true)
var ids='+'+$("#phone3").val()+$("#mobile_id").val();

if (user_name_id) {

SendOtpFunction()

}else{


$.ajax({
url: "{{ url('check_new_user_name') }}",
type:"POST",

// data: {
//   check_user_name:$("#emailss").val()
// },

data: {check_user_name:ids,role:3},

success:function(response){


$(".ContinueBtn").prop('disabled',false)
$('.ContinueBtn').html('Submit');

// console.log($.trim(response));
// console.log(response.status);
console.log(response);

    // return 'false';
    if(response.status == "exist"){

      $(".otp_show").show();
      $('#mobile_id').prop('readonly', true);

      $(".email_pe_show").hide();
      $(".contact_pe_show").hide();
      $(".both_pe_show").hide();


      SendOtpFunction()
      // $("#td_id").toggleClass('ContinueBtn SendOtpFunction');

  }else if(response.status == "notexist"){

    if (response.email=='Yes') {
// var msg='Email';
$(".email_pe_show").show();


}else{

// var msg='Mobile';
$(".contact_pe_show").show();



}
$(".both_pe_show").show();

// alert(response.status)

$("#checkSignSignUp").val(response.status)



}

else if(response.status == "not_permit"){

$('#errorMessage').show();

$('#errorMessage').html('Mobile no already registered in some other role');


}

else if(response.status == "archive"){

  $('#errorMessage').show();

              $('#errorMessage').html('Your Account deleted. for active account contact to admin OR Create account after 30 days');


                }

                
else if(response.status == "custome"){

      $(".otp_show").show();
      $(".email_pe_show").hide();
      $(".contact_pe_show").hide();
      $(".both_pe_show").hide();
$('#mobile_id').prop('readonly', true);


      SendOtpFunction()
      // $("#td_id").toggleClass('ContinueBtn SendOtpFunction');

  }


},

error:function(errorMsg){

console.log(errorMsg)

}
});


}

};

function SendOtpFunction() {

var mobile_id ='+'+$("#phone3").val()+$("#mobile_id").val();
var user_name_id =$("#user_name_id").val();
var email_id =$("#email_id").val();
var otp =$("#otp").val();


$('.ContinueBtn').html('Sending..');

$(".ContinueBtn").prop('disabled',true)


console.log($('#first_form').serialize())
$.ajax({
url: "{{ url('send_client_otp') }}",
type:"POST",

data: {user_name:user_name_id,mobile:mobile_id,email:email_id,otp:otp},

success:function(response){


document.getElementById('timer').innerHTML =
01 + ":" + 00;
startTimerFirst();



$(".ContinueBtn").prop('disabled',false)
$('.ContinueBtn').html('Submit');

$(".otp_show").show();
$('#mobile_id').prop('readonly', true);

$(".email_pe_show").hide();
$(".contact_pe_show").hide();
$(".both_pe_show").hide();


console.log(response);

$(".ContinueBtn").hide();
$(".VerifyOtpFunction").show();

// $("#td_id").toggleClass('ContinueBtn VerifyOtpFunction');

// $("#first_form").toggleClass('change_form_cls new_form_cls');

},
});


};


$(".VerifyOtpFunction").click(function() {

var mobile_id ='+'+$("#phone3").val()+$("#mobile_id").val();
var user_name_id =$("#user_name_id").val();
var otp =$("#otp").val();
var checkSignSignUp =$("#checkSignSignUp").val();
var email_id =$("#email_id").val();

$(".VerifyOtpFunction").prop('disabled',true)
$('.VerifyOtpFunction').html('waiting...');

var clickDisbled = "{{ url()->previous() }}";

$('#sucessMessage').hide();

$('#errorMessage').hide();


// alert(checkSignSignUp)

if (checkSignSignUp) {


// console.log($('#first_form').serialize())
if (otp) {

$.ajax({
url: "{{ url('send_client_otp_signup') }}",
type:"POST",

// data: $('#first_form').serialize(),
data: {user_name:user_name_id,mobile:mobile_id,email:email_id,otp:otp},

success:function(response){

console.log(response,'check');

$(".VerifyOtpFunction").prop('disabled',false)
$('.VerifyOtpFunction').html('Varify & Login');

// $(".both_pe_show").hide();
// $(".otp_show").show();


if ($.trim(response)=="success") {

  $('#sucessMessage').show();

  $('#sucessMessage').html('your otp successfully verified');
  window.location.replace(clickDisbled);
// history.go(-1);
}else if($.trim(response)=="not_in_same_role"){

 $('#errorMessage').show();

 $('#errorMessage').html('Mobile no already registered in some other role');

}else{

$('#errorMessage').show();

$('#errorMessage').html('Sorry your OTP is not valid');

}



},
});

}else{

  $(".VerifyOtpFunction").prop('disabled',false)
$('.VerifyOtpFunction').html('Varify & Login');

    $('#errorMessage').show();

              $('#errorMessage').html('Please Enter Otp');

}




}else{

if (otp) {

$.ajax({
url: "{{ url('send_client_otp_sigin') }}",
type:"POST",

data: {user_name:user_name_id,mobile:mobile_id,email:email_id,otp:otp},

success:function(response){
$(".VerifyOtpFunction").prop('disabled',false)

// $(".both_pe_show").hide();
// $(".otp_show").show();
console.log(response);
$(".VerifyOtpFunction").prop('disabled',false)
$('.VerifyOtpFunction').html('Varify & Login');



if ($.trim(response)=="success") {

  $('#sucessMessage').show();

  $('#sucessMessage').html('your otp successfully verified');
 window.location.replace(clickDisbled);
 
 // history.go(-1);

}else if($.trim(response)=="not_in_same_role"){

 $('#errorMessage').show();

 $('#errorMessage').html('Email already registered in some other role');

}else{

$('#errorMessage').show();

$('#errorMessage').html('Sorry your OTP is not valid');

}

$('.VerifyOtpFunction').html('Varify & Login');

},
});

}else{


$(".VerifyOtpFunction").prop('disabled',false)
$('.VerifyOtpFunction').html('Varify & Login');

    $('#errorMessage').show();

              $('#errorMessage').html('Please Enter Otp');

}


}

});

</script>


@endsection