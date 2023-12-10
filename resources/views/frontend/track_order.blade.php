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
<body style="width:100%;padding-right:0px;" data-new-gr-c-s-check-loaded="14.1039.0" data-gr-ext-installed=""><div class="laptop-hide mobile-menu">
<div class="row margin0">
<div class="col-xs-6 padding0">
<div class="image menu-bar">
<img src="{{url('/')}}/public/frontend/img/mobile-menu.png">
</div>
</div>
<div class="col-xs-6 padding0">
<div class="pull-right">
<a href="{{url('/')}}/shopping-cart">
<div class="card-image">
<span class="mobile-cart-count">0</span>
<img src="{{url('/')}}/public/frontend/img/online-supermarket-cart.png">
</div>
</a>
</div>
</div>
</div>
</div>

<style>
    @media only screen and (max-width: 500px) {
 
    .mobile-header{
        display:none !important;
    }
}
</style>


<div class="mobile-header-overlay"></div>
<header class="mobile-header">
<img src="{{url('/')}}/public/frontend/img/delete-button.png " class="close-btn laptop-hide">
<div class="container-fluid">
<div class="row margin0">
<div class="col-md-6 col-sm-6 padding0">
<div class="row margin0">
<div class="col-md-4 padding0">
<a href="{{url('/')}}/">
<!-- <h4>Mande Clan</h4> -->
<div class="logo-image">
    <img src="{{asset('public/img/mandeclan_logo.jpg')}}" width="100px" height="50px">
</div>
</a>
</div>
<div class="col-md-8 padding0">
            </div>
</div>
</div>
<div class="col-md-6 col-sm-6 padding0">
<div class="pull-right mobile-pull-left">
<ul class="inline-block">
<!-- <a href="profile-dashboard.php"><li><i class="far fa-user"></i> Kavita Menake</li></a> -->
                                <a href="">
</a><li><a href="">
    </a><div class="dropdown"><a href="">
        </a><button class="dropbtn"><a href="">
            </a><a href="{{url('/')}}/profile-dashboard">
                <i class="far fa-user"></i>
                ahmed shaikh
            </a>
        </button>
        
    </div>
</li>

<a href="{{url('/')}}/shopping-cart"><li id="shopping_cart"><span>0</span><img src="{{url('/')}}/public/frontend/img/online-supermarket-cart.png"></li></a>
        </ul>
</div>
</div>
</div>
</div>
</header>
<!-- Current Location  -->
<div class="modal fade comman-modal" id="currentlocation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<div class="close-btn">
<i class="far fa-times-circle" data-dismiss="modal" aria-label="Close"></i>
</div>
</div>
<div class="modal-body">
<div class="row">
<div class="col-md-12">
<div class="input-group">
<input type="text" class="form-control" placeholder="Search for area, street name">
<div class="input-group-append">
<span class="input-group-text">
<img src="{{url('/')}}/public/frontend/img/search.png">
</span>
</div>
</div>
</div>
</div>
<div class="card">
<div class="row" onclick="getLocation()">
<div class="col-md-1">
<img src="{{url('/')}}/public/frontend/img/target.png" class="black-image">
</div>
<div class="col-md-11">
<h5>Get Current Location</h5>
<p>Using GPS</p>
</div>
</div>
</div>
<div class="list">
<div class="item-list">
<div class="row">
<div class="col-md-1">
<img src="{{url('/')}}/public/frontend/img/current-location.png" class="black-image">
</div>
<div class="col-md-11">
<h5>Sadar Bazar</h5>
<p>Nagpur, Maharashtra, India.</p>
</div>
</div>
</div>
<div class="item-list">
<div class="row">
<div class="col-md-1">
<img src="{{url('/')}}/public/frontend/img/current-location.png" class="black-image">
</div>
<div class="col-md-11">
<h5>Sadar Bazar</h5>
<p>Nagpur, Maharashtra, India.</p>
</div>
</div>
</div>
<div class="item-list">
<div class="row">
<div class="col-md-1">
<img src="{{url('/')}}/public/frontend/img/current-location.png" class="black-image">
</div>
<div class="col-md-11">
<h5>Sadar Bazar</h5>
<p>Nagpur, Maharashtra, India.</p>
</div>
</div>
</div>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-raised btn-secondary" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
<!-- Modal -->
<div class="modal fade comman-modal login-signup-popup" id="loginsignup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="vertical-align-outer-div">
<div class="vertical-align-inner-div">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="row row1">
<div class="col-md-6 col6">
<div class="login-signup-div">
      <div>
          <div class="images">
              <img src="{{url('/')}}/public/frontend/img/basket.png">
          </div>
          <h4 class="center">Login For My Shopping Account</h4>
      </div>
</div>
</div>
<div class="col-md-6 col6">
<div class="col6-padding">
    <div class="login-div">
        <h5>Login/Sign Up</h5>
        <div class="close-btn">
            <i class="far fa-times-circle" data-dismiss="modal" aria-label="Close"></i>
        </div>
        <div>
            <div class="form-group">
                <label class="bmd-label-floating">Enter Mobile No.</label>
                <input type="text" class="form-control indian-mobile-series" maxlength="10" id="myinput2">
            </div>
            <div class="form-group name">
                <label class="bmd-label-floating">Enter Your Name</label>
                <input type="text" class="form-control char-spcs-validation three-space-validation" id="regName">
            </div>
            <div class="form-group name">
                <label class="bmd-label-floating">Enter Email Id</label>
                <input type="email" class="form-control three-space-validation" id="userEmailId">
            </div>
            <p id="emptyMob" style="display:none;color:#fff;">Please Enter your mobile number.</p>
            <p id="lengthMob" style="display:none;color:#fff;">Please Enter 10 digite mobile number.</p>
            <p id="emptyName" style="display:none;color:#fff;">You have to enter Name.</p>
            <p id="validName" style="display:none;color:#fff;">Please Enter valid, full Name.</p>
            <p id="emptyEmail" style="display:none;color:#fff;">You have to enter email.</p>
            <p id="incorrectEmail" style="display:none;color:#fff;">Please Enter valid email.</p>
            <p id="emailAlready" style="display:none;color:#fff;">Email address is already exists.</p>
            <p id="lengthName" style="display:none;color:#fff;">Name may be 6 to 30 character log.</p>
            <p id="validNumber" style="display:none;color:#fff;">Please, Enter Valid Mobile number start from 9, 8, 7 and 6 in India.</p>
            <button type="button" class="btn btn-raised btn-light" id="login_otp" style="display:none;">Next</button>
            <button type="button" class="btn btn-raised btn-light" id="register_otp" style="display:none;">Next</button>
        </div>
    </div>
    <div class="sign-up-div" style="display:none;">
        
        <h5>Login/Sign Up</h5>
        <div class="close-btn">
            <i class="far fa-times-circle" data-dismiss="modal" aria-label="Close"></i>
        </div>
        <p class="p2">Enter 4 digit code sent to your phone</p>
        <h4>+91 - <span id="MobileNumber"></span></h4>
        <style>
            /*.row.otpfield .bmd-form-group{
                display:inline-block;
                width:23.5%;margin-right: 0.5%;
                padding-top: 0.75rem;
                padding-bottom: 1rem;
            }*/
            .row.otpfield{
                margin-bottom:15px;
            }
            .row.otpfield .otpfield1{
                display: inline-block;
                width: 23.5%;
                margin-right: 0.5%;
                padding-top: 0.75rem;
                padding-bottom: 1rem;
                background: unset;
                border: unset;
                border-bottom: 2px solid #fff;
                color: #fff;
                margin: auto;
            }
            /*.row.otpfield .bmd-form-group .otpfield{
                width:90%;
                background:unset;
                border:unset;
                border-bottom:2px solid #fff;
                color:#fff;
                margin:auto;
            }*/
        </style>
        <div class="row otpfield">
            <input type="tel" maxlength="1" style="text-align:center;" id="otpfield1" class="otpfield otpfield1">
            <input type="tel" maxlength="1" style="text-align:center;" id="otpfield2" class="otpfield otpfield1">
            <input type="tel" maxlength="1" style="text-align:center;" id="otpfield3" class="otpfield otpfield1">
            <input type="tel" maxlength="1" style="text-align:center;" id="otpfield4" class="otpfield otpfield1">
        </div>
        <div class="col-md-12">
            <p id="invalidOtp" style="display:none;color:#fff;">OTP Code Is Incorrect, Please Try Again.</p>
        </div>
        <button type="button" class="btn btn-raised btn-light varify-reg" id="verify_login" style="display:none;">Varify &amp; Login</button>
        <button type="button" class="btn btn-raised btn-light varify-reg" id="verify_register" style="display:none;">Varify &amp; Register</button>
    </div>
    <div class="successfully-login successfully-login-div" style="display: none;">
        <div class="close-btn">
            <a href="#">
               <!-- <i class="far fa-times-circle" data-dismiss="modal" aria-label="Close"></i> -->
               <i class="far fa-times-circle"></i>
            </a>
        </div>
        <p>You are successfully Login</p>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<div class="modal fade" id="userNotLogedInModal">
<div class="modal-dialog">
<div class="modal-content">
<div class="alert alert-warning modal-body" style="margin-bottom:0;">
<span id="error_message_header">Error happend!</span>
<button type="button" class="close" data-dismiss="modal">×</button>
</div>
</div>
</div>
</div>
<span data-toggle="modal" data-target="#userNotLogedInModal" id="errorHeaderModalBtn"></span>

<script src="{{url('/')}}/assets/js/input-validations.js" type="text/javascript" charset="utf-8" async="" defer=""></script>
<!-- javascript for login or registration section-->
<script type="text/javascript">
$(document).ready(function() {

$('#userNotLogedIn').click(function(){
$('#error_message_header').empty();
$('#error_message_header').text('Please, Login first to view cart & checkout.');
$('#errorHeaderModalBtn').click();
});

// $(document).on('click', '.modal.fade.show', function(){
//     $("#popupBtnLogSign").click();
// });

$(document).on('click', '#userNotLogedInModal .close', function(){
$("#popupBtnLogSign").click();
});

$( "#checkoutLoginSignup" ).click(function() {
$("#popupBtnLogSign").click();
});

$('#myinput2').on("input", function() {
var mob1 = this.value;
console.log(mob1);
var filter = /^[7-9][0-9]{10}$/;
if (mob1.length == 10) {
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$.ajax({
/* the route pointing to the post function */
url: '{{url('/')}}/check-mobile-number',
type: 'POST',
/* send the csrf-token and the input to the controller */
data: {_token: CSRF_TOKEN, mob1:mob1},
dataType: 'JSON',
/* remind that 'data' is the response of the AjaxController */
success: function (data) {
// console.log(data);
if(data == true){
    $("#MobileNumber").text( mob1 );
    $("#lengthMob").css('display', 'none')
    $("#emptyMob").css('display', 'none')
    $("#register_otp").css('display', 'none')
    $(".name").css('display', 'none')
    $("#login_otp").css('display', 'block')
    $("#validNumber").css('display', 'none');
}else if(data == false){
    $(".name").css('display', 'block')
    $("#lengthMob").css('display', 'none')
    $("#emptyMob").css('display', 'none')
    $("#login_otp").css('display', 'none')
    $("#register_otp").css('display', 'block')
    $("#validNumber").css('display', 'none');
}else{
    $(".name").css('display', 'none')
    $("#login_otp").css('display', 'none')
    $("#register_otp").css('display', 'none')
    $("#lengthMob").css('display', 'none')
    $("#emptyMob").css('display', 'none')
    $("#validNumber").css('display', 'none');
}
}
});
}else if(mob1 >= 1 && mob1 >= 9){
$(".name").css('display', 'none')
$("#login_otp").css('display', 'none')
$("#register_otp").css('display', 'none')
$("#lengthMob").css('display', 'block')
$("#emptyMob").css('display', 'none')
$("#validNumber").css('display', 'none');
}else if(mob1 == ''){
$(".name").css('display', 'none')
$("#login_otp").css('display', 'none')
$("#register_otp").css('display', 'none')
$("#lengthMob").css('display', 'none')
$("#emptyMob").css('display', 'block')
$("#validNumber").css('display', 'none');
}
});

$( "#login_otp" ).click(function() {
var mob1 = $('#myinput2').val();
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
console.log('loging in');
// var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$.ajax({
/* the route pointing to the post function */
url: '{{url('/')}}/otp-for-login',
headers: {
'Accept': 'application/json',
'Content-Type':'application/json'
},
type: 'GET',
beforeSend: function(){
$("#overlay").css("display", "block").delay(4000);
},
/* send the csrf-token and the input to the controller */
data: {_token: CSRF_TOKEN, mob1: mob1},
dataType: 'JSON',
/* remind that 'data' is the response of the AjaxController */
success: function (data) {
console.log(data);
if(data.status == true){
$(".div3hide").show();
$(".div2hide").hide();
$(".div1 span").show();
$("#verify_login").show();
$("#verify_register").hide();
$(".sign-up-div").show('slow, 200');
$(".login-div").hide('slow, 200');
}else if(data.status == false){
$("#verify_login").hide();
}else{
$("#verify_login").hide();
// $("#showMessage").show();
// $( "#showMessage" ).append("<p>"+data.message+"</p>");
}
},
complete: function(){
$("#overlay").css("display", "none");
}
});
});

// $(function() {
// var charLimit = 1;
// $(".otpfield").keydown(function(e) {

//     var keys = [8, 9, /*16, 17, 18,*/ 19, 20, 27, 33, 34, 35, 36, 37, 38, 39, 40, 45, 46, 144, 145];

//     if (e.which == 8 && $(this).val().length == 0) {
//         $(this).prev('.otpfield').focus();
//     } else if ($.inArray(e.which, keys) >= 0) {
//         return true;
//     } else if ($(this).val().length >= charLimit) {
//         $(this).next('.otpfield').focus();
//         return false;
//     } else if (e.shiftKey || e.which <= 48 || e.which >= 58) {
//         return false;
//     }
// }).keyup(function () {
//     if ($(this).val().length >= charLimit) {
//         $(this).next('.otpfield').focus();
//         return false;
//     }
// });
// });

$(".otpfield1").keyup(function () {
if ($(this).val().length == $(this).attr('maxlength')) {
$(this).next('.otpfield1').focus();
// $(this).parent().next('.bmd-form-group').children('.otpfield').focus();
$("#invalidOtp").hide();
}
});
$('.otpfield1').keyup(function(e) {
if (e.which == 8 || e.which == 46) {
$(this).prev('.otpfield1').focus();
// $(this).parent().prev('.bmd-form-group').children('.otpfield').focus();
$("#invalidOtp").hide();
}
else {
// $(this).parent().next('.bmd-form-group').children('.otpfield').focus();
$(this).next('.otpfield1').focus();
$("#invalidOtp").hide();
}
});

$("#verify_login").click(function() {
var name  = $("#regName").val();
// if(name != ''){ console.log('error');return; }
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
var mob1 = $('#myinput2').val();
let otp1 = $("#otpfield1").val();
let otp2 = $("#otpfield2").val();
let otp3 = $("#otpfield3").val();
let otp4 = $("#otpfield4").val();
let otp = otp1+otp2+otp3+otp4;
// console.log(otp);
$.ajax({
/* the route pointing to the post function */
url: '{{url('/')}}/verify-login-otp',
type: 'GET',
beforeSend: function(){
$("#overlay").css("display", "block").delay(4000);
},
/* send the csrf-token and the input to the controller */
data: {_token: CSRF_TOKEN, mob1:mob1, otp:otp},
dataType: 'JSON',
/* remind that 'data' is the response of the AjaxController */
success: function (data) { 
console.log(data);
if(data.status == true){
// $("#MobileNumber").text( mob1 );
$(".div1, .div3hide").hide();
$('#dataTarget').click();
setTimeout(function() {
    window.location.reload();
}, 1000);

}else{
$("#invalidOtp").show();
// $(".validation").hide();
}
},
complete: function(){
$("#overlay").css("display", "none");
}
});
});

});   

$( "#regName" ).on("input", function() {
let name  = $("#regName").val();
if(name != ''){
$('#lengthName').hide();
if(name.length <= 30 && name.length >= 6){
var regName = new RegExp("^[a-zA-Z ]+$");
$('#emptyName').hide();
$('#lengthName').hide();
if (regName.test(name)) {
$('#validName').hide();
$('#lengthName').hide();
$('#emptyName').hide();
// Send OTP to user
} else {
$('#validName').show();
}
}else{
$('#lengthName').show();
}
}else{
$('#emptyName').show();
}

});

$(".login-signup-popup .col6-padding #register_otp").click(function() {
var mob1 = $('#myinput2').val();
let name  = $("#regName").val();
let emailId = $('#userEmailId').val();
var emailReg = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
if(name == '' ){
$('#emptyName').css('display', 'block');
$('#lengthName').css('display', 'none');
}else if(name.length < 7){
$('#emptyName').css('display', 'none');
$('#lengthName').css('display', 'block');
}else if(emailId == '' ){
$('#emptyEmail').css('display', 'block');
$('#incorrectEmail').css('display', 'none');
}else if(!emailReg.test(emailId)){
$('#emptyEmail').css('display', 'none');
$('#incorrectEmail').css('display', 'block');
}

});


$( "#register_otp" ).click(function() {

var mob1 = $('#myinput2').val();
let name  = $("#regName").val();
let emailId = $('#userEmailId').val();
var emailReg = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
if(name == '' ){
$('#emptyName').css('display', 'block');
$('#lengthName').css('display', 'none');
}else if(name.length < 7){
$('#emptyName').css('display', 'none');
$('#lengthName').css('display', 'block');
}else if(emailId == '' ){
$('#emptyEmail').css('display', 'block');
$('#incorrectEmail').css('display', 'none');
}else if(!emailReg.test(emailId)){
$('#emptyEmail').css('display', 'none');
$('#incorrectEmail').css('display', 'block');
}else{

$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});

$.ajax({
/* the route pointing to the post function */
url: '{{url('/')}}/chech-email-address',
type: 'POST',
/* send the csrf-token and the input to the controller */
data: {_token: CSRF_TOKEN, email: emailId},
dataType: 'JSON',
/* remind that 'data' is the response of the AjaxController */
success: function (data) {
console.log(data);
if(data.status == true){

$.ajax({
    /* the route pointing to the post function */
    url: '{{url('/')}}/otp-for-registration',
    type: 'POST',
    /* send the csrf-token and the input to the controller */
    data: {_token: CSRF_TOKEN, mob1: mob1, name: name, email: emailId},
    dataType: 'JSON',
    /* remind that 'data' is the response of the AjaxController */
    success: function (data) {
        console.log(data);
        if(data.status == true){
            $(".sign-up-div").show('slow, 200');
            $(".login-div").hide('slow, 200');
            $("#verify_register").show();
            $(".div3hide").show();
            $(".div2hide").hide();
            $(".div1 span").show();
            $("#MobileNumber").text( mob1 );
            $("#verify_login").hide();
        }else{
            $("#verify_register").hide();
        }
    }
});
}else{
$('#emailAlready').show();
$("#verify_register").hide();
}
}
});
}


$("#verify_register").click(function() {

var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
var mob1 = $('#myinput2').val();
var name  = $("#regName").val();
let emailId = $('#userEmailId').val();
let otp1 = $("#otpfield1").val();
let otp2 = $("#otpfield2").val();
let otp3 = $("#otpfield3").val();
let otp4 = $("#otpfield4").val();
let otp = otp1+otp2+otp3+otp4;
console.log(otp);
$.ajax({
/* the route pointing to the post function */
url: '{{url('/')}}/verify-registration-otp',
type: 'GET',
beforeSend: function(){
$("#overlay").css("display", "block").delay(4000);
},
/* send the csrf-token and the input to the controller */
data: {_token: CSRF_TOKEN, mob1:mob1, otp:otp, name:name, email: emailId},
dataType: 'JSON',
/* remind that 'data' is the response of the AjaxController */
success: function (data) { 
console.log(data);
if(data.status == true){
// $("#MobileNumber").text( mob1 );
$(".div1, .div3hide").hide();
$('#dataTarget').click();
setTimeout(function() {
    window.location.reload();
}, 1000);

}else{
// $(".name").show();
// $(".validation").hide();
}
},
complete: function(){
$("#overlay").css("display", "none");
}
});
});
});
</script>
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
<!-- Body Content Start -->
<style type="text/css">
body
{
background-color: #fafafa;
}
.col-md-2{
flex:1 0 16.66667%;
max-width:20.66667%;
}
</style>
<nav class="breadcrumb-nav">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">
Order
Placed
</li>
</ol>
</nav>
<!--  -->
<div class="padding order-processing">
<div class="container-fluid">
<div class="border-div"></div>
<div class="row row1 process-list">
<div class="col-md-2">
<div class="row unset-row">
<div class="col-xs-5">
<div>
                                    <div class="icon-image disable">
                                    <img src="{{url('/')}}/public/frontend/img/placed.png">
                                            <div class="counter  {{$pending !=null ? 'green' : ''}}">
                                                @if($pending)<i class="fas fa-check"></i>@else
1
                                            @endif</div>
                                    </div>
    <p class="order-heading">Order Has Placed.</p>
</div>
</div>
<div class="col-xs-7">
<div class="main-div">
    <div class="arrow-up"></div>
    <div class="card">
        {{-- <h5>Order By {{$record->customer_name}}</h5> --}}
        <p><p>{{date("d-M-y", strtotime($pending_status_date))}} {{date("g:i A", strtotime($pending_status_date))}}</p></p>
    </div>
</div>
</div>
</div>
</div>
<div class="col-md-2">
<div class="row unset-row">
<div class="col-xs-5">
<div>
                                    <div class="icon-image {{$pending !=null ? 'disable' : ''}}" >
                                    <img src="{{url('/')}}/public/frontend/img/restaurant.png">
                                            <div class="counter {{$approval !=null ? 'green' : ''}}">
                                                @if($approval)<i class="fas fa-check"></i>@else
2
                                            @endif</div>
                                    </div>
    <p class="order-heading">Order Accepted by Shops</p>
</div>
</div>
<div class="col-xs-7">
    @if(!empty($approval))
<div class="main-div">
    <div class="arrow-up"></div>
    <div class="card">
        {{-- <h5>Order By {{$record->customer_name}}</h5> --}}
        <p><p>{{date("d-M-y", strtotime($approval_status_date))}} {{date("g:i A", strtotime($approval_status_date))}}</p></p>
    </div>
</div>
@endif
</div>
</div>
</div>
<div class="col-md-2">
<div class="row unset-row">
<div class="col-xs-5">
<div>
                                    <div class="icon-image {{$ready_to_pickup !=null ? 'disable' : ''}}" >
                                    <img src="{{url('/')}}/public/frontend/img/pickup.png">
                                            <div class="counter {{$ready_to_pickup !=null ? 'green' : ''}}">
                                                @if($ready_to_pickup)<i class="fas fa-check"></i>@else
3
                                            @endif</div>
                                    </div>
    <p class="order-heading">Ready For Pick up</p>
</div>
</div>
<div class="col-xs-7">
    @if(!empty($ready_to_pickup))
<div class="main-div">
    <div class="arrow-up"></div>
    <div class="card">
        <p><p>{{date("d-M-y", strtotime($ready_to_pickup_status_date))}} {{date("g:i A", strtotime($ready_to_pickup_status_date))}}</p></p>
    </div>
</div>
@endif
</div>
</div>
</div>
<div class="col-md-2">
<div class="row unset-row">
<div class="col-xs-5">
<div>
                                    <div class="icon-image {{$dispatch !=null ? 'disable' : ''}}" >
                                    <img src="{{url('/')}}/public/frontend/img/deliver-boy.png">
                                            <div class="counter {{$dispatch !=null ? 'green' : ''}}">
                                                @if($dispatch)<i class="fas fa-check"></i>@else
4
                                            @endif</div>
                                    </div>
    <p class="order-heading">
        Pick up by
                                            Delivery Boy
                                    </p>
</div>
</div>
<div class="col-xs-7">
        @if(!empty($dispatch))

<div class="main-div">
    <div class="arrow-up"></div>
    <div class="card">
        {{-- <h5>Order By {{$record->customer_name}}</h5> --}}
        <p><p>{{date("d-M-y", strtotime($dispatch_status_date))}} {{date("g:i A", strtotime($dispatch_status_date))}}</p></p>
    </div>
</div>
@endif
</div>
</div>
</div>
<div class="col-md-2">
<div class="row unset-row">
<div class="col-xs-5">
<div>
                                    <div class="icon-image {{$delivered !=null ? 'disable' : ''}}" >
                                    <img src="{{url('/')}}/public/frontend/img/delivered.png">
                                            <div class="counter {{$delivered !=null ? 'green' : ''}}">
                                                @if($delivered)<i class="fas fa-check"></i>@else
5
                                            @endif</div>
                                    </div>
    <p class="order-heading">Delivered</p>
</div>
</div>
<div class="col-xs-7">
    @if(!empty($delivered))
<div class="main-div">
    <div class="arrow-up"></div>
    <div class="card">
        {{-- <h5>Order By {{$record->customer_name}}</h5> --}}
        <p><p>{{date("d-M-y", strtotime($delivered_status_date))}} {{date("g:i A", strtotime($delivered_status_date))}}</p></p>
    </div>
</div>
@endif
</div>
</div>
</div>
</div>
<!-- ................................... -->
<!--         <div class="row row1">
<div class="col-md-2">
<div class="main-div">
<div class="arrow-up"></div>
<div class="card">
<h5>Order By ahmed shaikh</h5>
<p>2021-10-27 | 17:34:14</p>
</div>
</div>
</div>
                                </div> -->

</div>
</div>
{{-- <script type="text/javascript" charset="utf-8" async="" defer="">
$(document).ready(function() {
setTimeout(function(){
window.location.reload();
}, 20000);
});
</script> --}}
<!-- Body Content End -->
<div class="mobile-device">
<h4 class="logo">Mande-Clan</h4>
<h4 class="h4">Buy Online Grocery from Grocery Shop Near by You</h4>
<div class="center">
<button class="btn btn-raised btn-light">Download Today</button>
</div>
<div class="app-link-img">
<img src="{{url('/')}}/public/frontend/img/goggle-play-store.png">
<img src="{{url('/')}}/public/frontend/img/apple-store.png">
</div>
<div class="mobile-footer">
<p>All rights reserved @ 2019 Mande Clan</p>
</div>
</div>                                             <script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js" integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous"></script>
<script async="" src="{{url('/')}}/public/frontendjs/bootstrap-material-design.min.js"></script>

<script async="" src="{{url('/')}}/public/frontendjs/lightgallery-all.min.js"></script>
<script async="" src="{{url('/')}}/public/frontendrating/jquery.barrating.js"></script>
<script async="" src="{{url('/')}}/public/frontendrating/examples.js"></script>
<script type="text/javascript">

var x = document.getElementById("demo");

function getLocation() {
if (navigator.geolocation) {
navigator.geolocation.getCurrentPosition(showPosition);
} else { 
x.innerHTML = "Geolocation is not supported by this browser.";
}
}

function showPosition(position) {
alert("Latitude: " + position.coords.latitude + 
"<br>Longitude: " + position.coords.longitude);
// this.initMap();
}
function initMap() {
var map = new google.maps.Map(document.getElementById('demo'), {
zoom: 8,
center: {lat: 40.731, lng: -73.997}
});
var geocoder = new google.maps.Geocoder;
var infowindow = new google.maps.InfoWindow;

document.getElementById('submit').addEventListener('click', function() {
geocodeLatLng(geocoder, map, infowindow);
});
}

function geocodeLatLng(geocoder, map, infowindow) {
var input = document.getElementById('latlng').value;
var latlngStr = input.split(',', 2);
var latlng = {lat: parseFloat(latlngStr[0]), lng: parseFloat(latlngStr[1])};
geocoder.geocode({'location': latlng}, function(results, status) {
if (status === 'OK') {
if (results[0]) {
map.setZoom(11);
var marker = new google.maps.Marker({
position: latlng,
map: map
});
infowindow.setContent(results[0].formatted_address);
infowindow.open(map, marker);
} else {
window.alert('No results found');
}
} else {
window.alert('Geocoder failed due to: ' + status);
}
});
}
</script>
<script async="" src="{{url('/')}}/public/frontendjs/jquery.js"></script>    

</body>

@endsection

<!-- ................push new js link................. -->

@push('js')
<script src="{{asset('public/js/comman.js')}}"></script>
@endpush


