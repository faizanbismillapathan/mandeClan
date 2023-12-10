@extends('frontend.layouts.app')
@section('title',"Online Shopping site in US: Shop Online for Mobiles, Books, Watches, Shoes and More - mandeclan.com")
<!-- ................Add meta ................ -->


@section('meta')
@endsection

<!-- ................custom css................. -->

@section('customStyle')
<style type="text/css">
	.error{
    color: red;
  }
</style>
@endsection

<!-- ................Add css link................. -->

@push('style')
@endpush

<!-- ................div................. -->
@section('innercontent')

<div style="width:100%;padding-right:0px;" data-new-gr-c-s-check-loaded="14.1040.0" data-gr-ext-installed=""><div class="laptop-hide mobile-menu">
    <div class="row margin0">
        <div class="col-xs-6 padding0">
            <div class="image menu-bar">
                <img src="{{url('/')}}/public/frontend/img/mobile-menu.png">
            </div>
        </div>
        <div class="col-xs-6 padding0">
            <div class="pull-right">
                <div class="card-image">
                    <img src="{{url('/')}}/public/frontend/img/online-supermarket-cart.png">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mobile-header-overlay"></div>
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
                          <li><img src="{{url('/')}}/public/frontend/img/phone-call.png">{{$admin->admin_mobile}}</li>
                        </a>
                        <a>
                          <li><img src="{{url('/')}}/public/frontend/img/help.png"> {{$admin->admin_email}}</li>
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
            <li class="breadcrumb-item active" aria-current="page" style="text-transform:capitalize;">contact us</li>
          </ol>
      </div>
   </div>
</nav>
<!--  -->                
            <div id="overlay" style="display:none;">
            <div style="display:table;height:100%;width:100%;overflow:hidden;">
                <div style="display:table-cell;vertical-align:middle;">
                    <div class="center">
                        <img src="{{url('/')}}/public/img/demo_wait.gif" width="64" height="64">
                    </div>
                </div>
            </div>
        </div>
        <!-- content -->
<!--  -->
<div class="padding contact-us">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8">
				<div class="enquery-form">
					<div class="row">
						<div class="col-md-12">
							<h4>Send us a Message</h4>
							   {!!Form::open(['url'=>['careers'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'first_form111'])!!}
							<div class="row">
								<div class="col-md-6">
								  <div class="form-group">
								    <label class=""> Name</label>

								    {!!Form::text('name',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','required')) !!} 

								  </div>
								</div>
								<div class="col-md-6">
								  <div class="form-group">
								    <label class="">Contact No</label><br>
								    {!!Form::text('mobile_no',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','required','id'=>'mobile_ids')) !!} 

								    
								  </div>								</div>
								<div class="col-md-6">
								  <div class="form-group">
								    <label class="">Email Id</label>
								  
								      {!!Form::text('email',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','required','id'=>'store_emails1')) !!} 
								  </div>
								</div>

								 <div class="form-group col-md-6 ">
          <label class="">Select Store Category</label>
          {!!Form::select('apply_for',['Delivery Boy'=>'Delivery Boy','Rider'=>'Rider','Vehicle Owner'=>'Vehicle Owner','Customer Service'=>'Customer Service','Business Intelligence'=>'Business Intelligence'],null,array('class'=>'form-control select2 selectcategory ','placeholder'=>'Select Category','data-toggle'=>'select2','required')) !!}

      </div>


								<div class="col-md-12">
								  <div class="form-group">
								    <label class="">Your Message</label>
								    <textarea class="form-control" rows="3" name="message" required=""></textarea>
								  </div>
								</div>
							</div>
							<button class="btn btn-raised btn-success" id="sendMessage" type="submit"><i class="fab fa-telegram-plane"></i> Send Message</button>

							{{Form::close()}}
						</div>
						
					</div>
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
<!--  -->  

</div>

@endsection

<!-- ................push new js link................. -->

@push('js')
 <script src="{{asset('public/js/validation.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('public/build/css/intlTelInput.css') }}">


<script type="text/javascript" src="{{ asset('public/build/js/intlTelInput.js') }}"></script>
<script>

var input = document.querySelector("#mobile_ids");
var iti = window.intlTelInputGlobals.getInstance(input);


window.intlTelInput(input, {
allowDropdown: true,

autoHideDialCode: false,
autoPlaceholder: "off",
// dropdownContainer: document.div,
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



// ................................errorMsg

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


    $( "#first_form111" ).validate({

      rules: {

        name: {
          required: true,
          required: true


      }, 
      mobile_no: {
          required: true,
          numbersss: true,
          // minlength:10,
          // maxlength:10,

          remote: {
            url: "{{url('check_careere_mobile')}}",
            type: "post",

            data: {
              check_user_mobile: function () {
                return $("#mobile_ids").val();
            }
        },
        dataFilter: function (data) {
          console.log($.trim(data));
              // console.log("{{url('check_user_mobile')}}")
              if($.trim(data) == "exist"){
                return 'false';
            }else if($.trim(data) == "notexist"){
                return 'true';
            }
        }
    }

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
      email: {
          required: true,
          email: true,
          remote: {
            url: "{{url('check_careere_email')}}",
            type: "post",

            data: {
              check_user_email: function () {
              
                return $("#store_emails1").val();
            }
        },
        dataFilter: function (data) {
          console.log($.trim(data));
              // console.log("{{url('check_user_email')}}")
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

  },      messages: { 
   // <-- you must declare messages inside of "messages" option
  email:{
    remote:"From this email no already enquiry send."                  
}  ,

mobile_no:{
    remote:"From this Mobile no already enquiry send."                  
}       
},


// submitHandler: function(form) {  

//   $( "#first_form111" ).submit();
  


// },

});

});
</script>


@endpush


