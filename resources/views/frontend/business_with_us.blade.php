@extends('frontend.layouts.app')
@section('title',"Online Shopping site in US: Shop Online for Mobiles, Books, Watches, Shoes and More - mandeclan.com")
<!-- ................Add meta ................ -->


@section('meta')
@endsection

<!-- ................custom css................. -->

@section('customStyle')
<style type="text/css">
	legend.scheduler-border {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
        width: auto;
        padding: 2px 10px;
        border-bottom: none;
        background-color: #4d606e;
        color: #fff;
    }

    fieldset.scheduler-border {
        border: 1px groove #ddd !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        margin: 0 0 3em 0 !important;
        -webkit-box-shadow: 0px 0px 0px 0px #000;
        box-shadow: 0px 0px 0px 0px #000;
    }
     .error{
    color: red;
  }
</style>
@endsection

<!-- ................Add css link................. -->

@push('style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endpush

<!-- ................body................. -->
@section('innercontent')


<header class="checkout-header mobile-header">
    <img src="{{url('/')}}/public/frontend/img/delete-button.png" class="close-btn laptop-hide">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <a href="{{url('/'.Session::get('locality_url'))}}">
                    <div class="logo-image">
                      <img src="{{asset('public/img/mandeclan_logo.jpg')}}" width="70px">
                  </div>
                  <!-- <h4>Mande Clan</h4> -->
              </a>
          </div>
          <div class="col-md-9">
            <div class="pull-right mobile-pull-left">
                <ul class="inline-block">
                    <a>
                      <li><img src="{{url('/')}}/public/frontend/img/phone-call.png"> +91 7507231555</li>
                  </a>
                  <a>
                      <li><img src="{{url('/')}}/public/frontend/img/help.png"> mandeclandotcom@gmail.com</li>
                  </a>

              </ul>
          </div>
      </div>
  </div>
</div>
</header>
<!--  -->
<nav class="breadcrumb-nav">
   <div class="breadcrumb-padding">
      <div class="container-fluid">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/'.Session::get('locality_url'))}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page" style="text-transform:capitalize;">business with us</li>
        </ol>
    </div>
</div>
</nav>


<div class="padding contact-us">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8">

                <div class="enquery-form">
                 {!!Form::open(['url'=>['business-with-us'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'first_form','autocomplete'=>'off'])!!}

                 <fieldset class="scheduler-border">
                  <legend class="scheduler-border">Owner Information &nbsp;:</legend>
                  <div class="form-row">

                     <div class=" col-md-4">
                        <div class="form-group">
                          <label class="">Contact Person</label>
                          {!!Form::text('store_owner_name',null,array('class'=>'form-control onlyAlphabet','placeholder'=>'','autocomplete'=>'off','required')) !!} 
                      </div>
                  </div>
                  <div class=" col-md-4">
                    <div class="form-group">
                      <label class="">Email</label>
                      {!!Form::text('store_email',null,array('class'=>'form-control emailfull','placeholder'=>'','autocomplete'=>'off','required','id'=>'store_emailss')) !!} 
                  </div>
              </div>
              <div class=" col-md-4">
                <div class="form-group">
                  <label class="">Mobile</label>
                  {!!Form::text('store_owner_mobile',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','required','id'=>'store_owner_mobiles')) !!} 
                          <input type="hidden" name="user_country_code" id="phone3" value="">

              </div>
          </div>




          <div class=" col-md-4">
            <div class="form-group">
              <label class="">Gender</label>
              <div class="row">
                  <div class="col-md-4">
                     <label class="custom-control custom-radio">
                        {{ Form::radio('store_owner_gendor', 'Male' , true,array('class'=>'custom-control-input')) }}

                        <span class="custom-control-label">Male</span>
                    </label>                             
                </div>
                <div class="col-md-6"> <label class="custom-control custom-radio">
                    {{ Form::radio('store_owner_gendor', 'Female' , false,array('class'=>'custom-control-input')) }}                    <span class="custom-control-label">Female</span>
                </label></div>

            </div>

        </div>









    </div>


</fieldset>
<fieldset class="scheduler-border">
    <legend class="scheduler-border">Store Information &nbsp;:</legend>
    <div class="form-row">

        <div class=" col-md-6">
            <div class="form-group">
              <label class="">Type</label>
              <div class="row">
                  <div class="col-md-6">
                     <label class="custom-control custom-radio">
                        {{ Form::radio('store_type', 'Store' , true,array('class'=>'custom-control-input service_type_cls')) }}

                        <span class="custom-control-label">Physical Store</span>
                    </label>                             
                </div>
                <div class="col-md-6"> <label class="custom-control custom-radio">
                    {{ Form::radio('store_type', 'Service' , false,array('class'=>'custom-control-input service_type_cls')) }}                    <span class="custom-control-label">Service Store</span>
                </label></div>

            </div>

        </div>
    </div>


    <div class=" col-md-6 select_store_category">
        <div class="form-group">
          <label class="">Select Store Category</label>
          {!!Form::select('store_category',$categories,null,array('class'=>'form-control select2  ','placeholder'=>'Select Category','data-toggle'=>'select2')) !!}

      </div>
  </div>

  <div class=" col-md-6 select_service_category" style="display:none">
    <div class="form-group">
      <label class="">Select Service Category</label> <br>
      {!!Form::select('service_category',$servic_categories,null,array('class'=>'form-control select2  ','placeholder'=>'Select Category','data-toggle'=>'select2')) !!}

  </div>
</div>


<div class=" col-md-6">
    <div class="form-group">
      <label class="">Store Name</label>
      {!!Form::text('store_name',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','required')) !!} 
  </div>
</div>

<div class=" col-md-6">
    <div class="form-group">
      <label class="">Website</label>
      {!!Form::url('store_website',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off')) !!} 
  </div>
</div>
<div class=" col-md-4">
    <div class="form-group">
      <label for="inputEmail4">City</label>

      {!!Form::select('store_city',$cities,null,array('class'=>'form-control select2 city_selector','placeholder'=>'Select City','data-toggle'=>'select2','required')) !!}

  </div>
</div>
<div class=" col-md-4">
    <div class="form-group">
      <label for="inputEmail4">Locality</label>

      {!!Form::select('store_locality',[],null,array('class'=>'form-control locality_selector select2','placeholder'=>'Select Locality','data-toggle'=>'select2','required')) !!}

  </div>
</div>

<div class=" col-md-4">
    <div class="form-group">
      <label for="inputPassword4">Pin Code</label>
      {!!Form::text('store_pincode',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','required','data-mask'=>'000000')) !!} 
  </div>
</div>


<div class=" col-md-12">
    <div class="form-group">
      <label class="">Message</label>
      {!! Form::textarea('store_description',null,['class'=>'form-control textarea', 'rows' => 6, 'cols' => 50,'id'=>'']) !!}
  </div>
</div>


</div>
</fieldset>




<button type="submit" class="btn btn-raised btn-primary"><i class="fas fa-plus"></i>   Submit</button>




{{Form::close()}}
</div>
</div>
<div class="col-md-4">
    <div class="box-shadow company-info">
     <h4 class="h4">Drop In Our Office</h4>
     <div class="row">
      <div class="col-md-3">
       <div class="icon-border">
        <img src="{{url('/')}}/public/frontend/img/phone-call.png">
    </div>
</div>
<div class="col-md-9">
   <a href="tel:{{$admin->admin_mobile}}">
    <h5>{{$admin->admin_mobile}}</h5>
</a>
</div>
</div>
<div class="row">
  <div class="col-md-3">
   <div class="icon-border">
    <img src="{{url('/')}}/public/frontend/img/mail.png">
</div>
</div>
<div class="col-md-9">
   <a href="mailto:{{$admin->admin_email}}">
    <h5>{{$admin->admin_email}}</h5>
</a>
</div>
</div>
<div class="row">
  <div class="col-md-3">
   <div class="icon-border">
    <img src="{{url('/')}}/public/frontend/img/current-location.png">
</div>
</div>
<div class="col-md-9">
   <h5>{{$admin->locality->locality_name}}, {{$admin->city->city_name}}, {{$admin->state->state_name}}, {{$admin->country->country_name}}.</h5>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

@endsection

<!-- ................push new js link................. -->

@push('js')
<script src="{{asset('public/js/comman.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>


<script type="text/javascript">
    $(document).ready(function(){ 
        $(".service_type_cls").click(function() {

        // alert('service_type_cls')
        var test = $(this).val();


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
            console.log(stateID,'{{url('append_locality')}}');

  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

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

                   data: {_token: CSRF_TOKEN, id:stateID},


                  dataType: "json",
                  success:function(data) {
                    console.log(data,'append');

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

                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

              $.ajax({
                  url: "{{url('append_pincode')}}",
                  type: "post",
                  data: {_token: CSRF_TOKEN,id:locality_id},
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



<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script>
  $(document).ready(function () {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});



    $.validator.addMethod("numbersss", function(value, element) {
        return /^[\s()+-]*([0-9][\s()+-]*){6,20}$/.test(value) //email
    }, "Please enter valid mobile no");



jQuery.validator.addMethod("mobile_country_code", function(value, element) {    
// var isSuccess = "+"+$("#phone3").val()+$("#store_owner_mobiles").val();
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
          // minlength:10,
          // maxlength:10,

          remote: {
            url: "{{url('check_store_owner_mobile')}}",
            type: "post",

            data: {
              check_store_owner_mobile: function () {
                return "+"+$("#phone3").val()+$("#store_owner_mobiles").val();
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
      store_email: {
          required: true,
          email: true,
          remote: {
            url: "{{url('check_user_name')}}",
            type: "post",

            data: {
              check_user_name: function () {
                return $("#store_emailss").val();
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
password: {
  required: true,
  required: true

},

  },      messages: {  // <-- you must declare messages inside of "messages" option
  store_email:{
    remote:"email must be unique."                  
}  ,

store_owner_mobile:{
    remote:"Mobile no must be unique."                  
}       
},




});

});
</script>


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
      // separateDialCode: true,

      utilsScript: "{{asset('public/build/js/utils.js')}}",

    });

  var iti = window.intlTelInputGlobals.getInstance(input);
  var countryData = iti.getSelectedCountryData();
        // console.log("ddd",countryData)

        $("#phone2_user").val(countryData.dialCode)
        input.addEventListener("countrychange", function() {
// var countryData = iti.getSelectedCountryData();
        // console.log('zzz',iti.getSelectedCountryData())


        var countryData = iti.getSelectedCountryData();

        console.log('zzz',countryData)
        $("#phone2_user").val(countryData.dialCode)


      });

        errorMsg = document.querySelector("#error-msg"),
        validMsg = document.querySelector("#valid-msg");

        var errorMap = ["Please enter the  valid number with country code", "Invalid country code", "Too short number", "Too long number", "Please enter the  valid number with country code"];

        var reset = function() {
          input.classList.remove("error");
          errorMsg.innerHTML = "";
          errorMsg.classList.add("hide");
          validMsg.classList.add("hide");
        };
        input.addEventListener('blur', function() {
          reset();
          if (input.value.trim()) {
            if (iti.isValidNumber()) {
              validMsg.classList.remove("hide");
            } else {
              input.classList.add("error");
              var errorCode = iti.getValidationError();
              errorMsg.innerHTML = errorMap[errorCode];
              errorMsg.classList.remove("hide");
            }
          }
        });

        input.addEventListener('change', reset);
        input.addEventListener('keyup', reset);
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

@endpush


