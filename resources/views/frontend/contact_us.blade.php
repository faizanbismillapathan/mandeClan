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
							   {!!Form::open(['url'=>['contact-us'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}
							<div class="row">
								<div class="col-md-4">
								  <div class="form-group">
								    <label class="bmd-label-floating"> Name</label>
								    <input type="text" class="form-control" name="name" required="">
								  </div>
								</div>
								<div class="col-md-4">
								  <div class="form-group">
								    <label class="bmd-label-floating">Contact No</label><br>
								    <input type="text" class="form-control" name="mobile_no" required="" id="mobile_ids">
								    
								  </div>
								</div>
								<div class="col-md-4">
								  <div class="form-group">
								    <label class="bmd-label-floating">Email Id</label>
								    <input type="email" class="form-control" name="email" required="">
								  </div>
								</div>
								<div class="col-md-12">
								  <div class="form-group">
								    <label class="bmd-label-floating">Your Message</label>
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

@endpush


