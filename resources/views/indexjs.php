
<script src="{{url('/')}}/assets/js/input-validations.js" type="text/javascript" charset="utf-8" async="" defer=""></script>

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



..................................................................

<script type="text/javascript">
    $(document).ready(function() {

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $(document).on('click', '.delete', function(){

            var catUrl = $(this).children('.compare-url').text();
            $(document).on('click', '#modal_delete', function(){

                $.ajax({
                    url: '{{url('/')}}/empty-shopping-cart',
                    type: 'GET',
                    beforeSend: function(){
                        $("#overlay").css("display", "block").delay(4000);
                    },
                    dataType: 'JSON',
                    success: function (data) {
                        if(data.status == true){
                            console.log(data);
                            window.location.href = catUrl;
                        }
                    },
                    complete: function(){
                        $("#overlay").css("display", "none");
                    }
                });
            });
        });
// $('#searchInputArea').keyup(function () {
    $(document).on('keyup', '#searchInputArea', function(e) {
        var search = this.value;
        console.log(search.length);
        if(search.length >= 3){
// console.log('okay!');
$.ajax({
    type:"GET",
    url:"{{url('/')}}/get-area-list?search="+search,
    success:function(res){
        console.log(res);
        if(res.length > 0){
            $('#locations').empty();
            $('#getLocations').empty();
            $('#getLocations').append("<div id='searchLocationDiv' class='' style='max-height:120px;overflow-y:scroll;'></div>")
            $.each(res, function(index, element) {
// console.log( element.name );
// $('#locations').append("<option value='"+element.location+"' id='"+element.area_id+"'></option>");
$('#searchLocationDiv').append("<p style='color:#fff;padding:5px 8px;cursor:pointer;' id='location_id"+element.area_id+"' class='location_id1'><i class='fas fa-map-marker-alt'></i> <span>"+element.location+"</span></p></div>");//<i class="fas fa-map-marker-alt"></i>
});
        }else{
            $('#getLocations').empty();
// $('#location_error p').text('Area not found!');
$("#location_error p").fadeIn(function() {
    $(this).text('Area not found!')
}).fadeOut(8000);
}    
}
});
}
});

    $(document).on('click', '.location_id1', function(){
        var localid = $(this).attr('id');
        var locationId1 = $(this).attr('id').substring(11);
        var areanameclick = $(this).children('span').text();
        $('#searchInputArea').val(areanameclick);
// console.log(areanameclick);
$('#getLocations').empty();
});

    $(document).on('keydown', '#passwordId', function(e) {
        if (e.keyCode == 32) return false;
    });

// $('#locations option').click(function(){
    $(document).on('change', '#searchInputArea', function(){
        var locationName=$("#searchInputArea").val(); 
        area_id = $('#locations').find('option[value="' +locationName + '"]').attr('id');
        console.log(area_id);

        if(area_id){
            $.ajax({
                type:"GET",
                url:"{{url('/')}}/store-location-session?area_id="+area_id,
                success:function(res){
                    console.log(res);
                    window.location.assign('{{url('/')}}/locations-wies-stores');
//      if(res.status == true){
//          window.location.assign('{{url('/')}}/locations-wies-stores?city='+res.city+'&area='+area);
//      }else{
//          $('#location_error p').text('');
//          $('#location_error p').text(res.message);
//          $("#location_error p").fadeIn(function() {
//  $(this).text(res.message)
// }).fadeOut(8000);
//          // $('#location_error p').text('').fadeOut(1500);
//      }
}
});
        }
    });

    $('#storeSearchBtn').click(function () {
        var value = $('#searchInputArea').val();
        var area = value.substring(0, value.indexOf(','));
        if(value != ''){
            console.log(area);
            $.ajax({
                type:"GET",
                url:"{{url('/')}}/check-store-list?search="+area,
                beforeSend: function(){
                    $("#overlay").css("display", "block").delay(4000);
                },
                success:function(res){
// console.log(res);
if(res.status == true){
// window.location.assign('{{url('/')}}/locations-wies-stores?city='+res.city+'&area='+area);
window.location.assign("{{url('/')}}/"+res.city.toLowerCase()+'/'+area.toLowerCase()+'/store-list');
}else{
    $('#location_error p').text('');
    $('#location_error p').text(res.message);
    $("#location_error p").fadeIn(function() {
        $(this).text(res.message)
    }).fadeOut(8000);
// $('#location_error p').text('').fadeOut(1500);
}
},
complete: function(){
    $("#overlay").css("display", "none");
}
});
        }else{
            $('#location_error p').text('');
            $('#location_error p').text('Please Enter or Select Location.');
            $("#location_error p").fadeIn(function() {
                $(this).text('Please Enter or Select Location.')
            }).fadeOut(8000);
        }

    });

    $('#findyourlocation').on('click',function(e){

        e.preventDefault();
        navigator.geolocation.getCurrentPosition(function(position) {
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;
            var urlloc = 'https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyBxm3cpfYPdG6Yk3Tv2yIrfBLtiKYlza5A&latlng='+lat+','+lng+'&sensor=false';

            $.ajax({
                type:"GET",
                url:urlloc,
                beforeSend: function(){
                    $("#overlay").css("display", "block").delay(4000);
                },
                success:function(res){ 
//console.log(res.results[0].formatted_address);
var addresscomponents = res.results[0].address_components;
var obj = {};
addresscomponents.forEach(function(address_componentdddd) {
    obj[address_componentdddd.types[0]] = address_componentdddd.long_name;
}); 
console.log(obj);
var areaold = obj.political;
var city = obj.locality; 
var searcharea = areaold.concat(city); 
var area = areaold.concat(' '+city); 
var place = areaold+", "+city;

$("#searchInputArea").val(place);
// $.ajax({
//  type:"GET",
//  url:"{{url('/')}}/homesearch?place_name="+place,
//  success:function(res){ 
//      //console.log(res);
//      var sescityname = res.cityname;
//      var getUrl = "{{url('/')}}/"+sescityname+"/list-of-restaurants";  
//      window.location.href = getUrl;
//  }
// });
},
complete: function(){
    $("#overlay").css("display", "none");
}
});
        });
    });

});

</script>