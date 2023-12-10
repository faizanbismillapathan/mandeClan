@extends('seller.layouts.app')
@section('title',"All Subscriptions | seller  Mande Clan")

<!-- ................custom css................. -->

@section('customStyle')
<style type="text/css">
    .card-padding{
        padding: 20px;
    }
    .hide{
        display: none;
    }
    .alert {
    padding: 10px;
}
</style>
@endsection

<!-- ................Add css link................. -->

@push('style')
@endpush

<!-- ................body................. -->
@section('innercontent')


<main class="content">
    <div class="container-fluid p-0">
        <div class="clearfix">

            <h1 class="h3 mb-3"><b>Change Email
            </b></h1>

        </div>
        <div class="card">  

          <div class="card-body">


            <div class="card">
                <div class="card-header">
                    <div class="row">
                       <div class="m-auto">
                        <h4>Update Email</h4>

                    </div>

                </div>
            </div>
            <div class="card-padding">
   <div class="alert alert-danger mx-5" role="alert" id="errorMessage" style="display: none;">

  </div>

  <div class="alert alert-success mx-5" role="alert" id="sucessMessage" style="display: none;">

  </div>

    <div class="alert alert-danger mx-5" role="alert" id="errorMessage" style="display: none;">

 </div>



  </div>

  <div class="card-padding">



    <div class="account-deactivate">
        <div>
{{ Session::get('email_otp') }}

                                       <h3 class="center">{{$record->email}}</h3>
            <h5 class="center py-3">Remember! This action will update your email</h5>

              <form id="first_form" class="change_form_cls px-5 otp_show hide otp_ids">


              <div class="row">
                  <div class="col-md-3 m-auto">
                       <div class="input-grp m-auto">
                  <div class="input-group input_grp">

                      <input type="text" class="form-control numbersOnly" placeholder="Enter OTP " required="required" id="otp" name="otp" maxlength="6" minlength="6" >
                      <div class="input-group-append" >
                        <span class="input-group-text  otp_show hide timer_ids" id="timer_id">
                          <span class="text-secondary" id="timer">01:00</span>
                      </span>

                      <span class="input-group-text hide center" id="resend_otps">
                          <p id="resend_otps_submit " style="cursor: pointer;    margin-bottom: 0px;" class="contactFormTimer">Resend OTP</p>
                      </span>
                  </div>
              </div>


          </div>
<div class="center">
   
          <button  class="m-3 center btn btn-success btn-custome custom-cheryred ContinueBtn hide" id="td_id" style="margin-top: 10px">Verify</button>

          <button type="button" class="m-3 center btn btn-success btn-custome VerifyOtpFunction custom-cheryred hide" id="td_id" style="margin-top: 10px">Verify</button>
          
           
</div>

                  </div>
              </div>

      </form>
      <!--  -->


            {!!Form::open(['url'=>['seller/deactivate-account'],'files' => true, 'class' => ' form-bordered form-row-stripped SendOtpFunction ','id' =>'comman_form_id'])!!}
           
           <div class="center">



            <button type="button" class="btn btn-info submits center"><i class="fab fa-telegram-plane"></i> Send Email</button>
           </div>

                           
            {{Form::close()}}



            <div class="change-emails" style="display:none;" >
             {!!Form::open(['url'=>['seller/seller-update-email'],'files' => true, 'class' => ' form-bordered form-row-stripped','id'=>'change_email_form'])!!}

             <div class="row">
              <div class="col-md-6">
               
                <div class="form-group">
                  <label class="bmd-label-floating">Enter New Email</label>
                  {!!Form::text('store_email',null,array('class'=>'form-control emailfull','autocomplete'=>'off','required','id'=>'email_new')) !!} 
                </div>
              
                                      <button  class="btn custom-btn submits_new">Change Email</button>

                               </div>
             
            </div>
            {{Form::close()}}
          </div>



        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</main>

@endsection

<!-- ................push new js link................. -->

@push('js')
<script src="{{asset('public/js/comman.js')}}"></script>
<script src="{{asset('public/js/validation.js')}}"></script>

 <script>
 document.addEventListener("DOMContentLoaded", function(event) {

    $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

    // alert('ddd')


$('#change_email_form').validate({

     rules: {

        'store_email': {
                      required: true,
                      
          remote: {
                    url: "{{url('check_user_name')}}",
                    type: "post",

                    data: {
                        check_user_name: function () {
                            return $("input[name='store_email']").val();
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
     

             store_email:{
            remote:"This email is already registered"                  
        }  
    },

      submitHandler: function(form) {  
saveFormDatas(form);
return false;
},



                   });

                 });
            </script>
            
<script type="text/javascript">

  $(".submits").click(function() {


var email="{{$record->email}}";

$('.submits').html('Sending..');

$(".submits").prop('disabled',true)

    $.ajax({
      url: "{{ url('seller/change-email') }}",
      type:"POST",
      
      data: {email:email},

      success:function(response){


          document.getElementById('timer').innerHTML =
    01 + ":" + 00;
  startTimerFirst();



       $(".submits").prop('disabled',false)
       $('.submits').html('Submit');

       $(".otp_show").show();
       console.log(response);

$(".submits").hide();
$(".VerifyOtpFunction").show();
$(".SendOtpFunction").hide();
$(".change-emails").hide();

    $("#resend_otps").hide();


     },
           error:function(data){

console.log(data)
}


   });

});


function saveFormDatas() {

   // $(".submits_new").click(function() {

var email=$("#email_new").val();


$('.submits').html('Sending..');

$(".submits").prop('disabled',true)

    $.ajax({
      url: "{{ url('seller/change-email') }}",
      type:"POST",
      
      data: {email:email},

      success:function(response){


          document.getElementById('timer').innerHTML =
    01 + ":" + 00;
  startTimerFirst();



       $(".submits").prop('disabled',false)
       $('.submits').html('Submit');

       $(".otp_show").show();
       console.log(response);
       $("#otp").val('');
              $('.change-emails').show();

$(".submits").hide();
$(".VerifyOtpFunction").show();
$(".SendOtpFunction").hide();
$(".change-emails").hide();

    $("#resend_otps").hide();


     },
           error:function(data){

console.log(data)
}


   });

};


  $(".VerifyOtpFunction").click(function() {


  // alert('send_client_otp_sigin')


var otp =$("#otp").val();
var email=$("#email_new").val();

// alert(email)
console.log(otp,'otpotp')

var clickDisbled = "{{ url('/') }}";

              $('#sucessMessage').hide();

              $('#errorMessage').hide();
// $(".change-emails").hide();


    console.log($('.SendOtpFunction').serialize())


if (otp) {
    $.ajax({
      url: "{{ url('seller/verify_seller_email') }}",
      type:"POST",
      
    data: {otp:otp,email:email},

      success:function(response){
        $(".VerifyOtpFunction").prop('disabled',false)

           // $(".both_pe_show").hide();
            // $(".otp_show").show();
            console.log(response);
            $(".VerifyOtpFunction").prop('disabled',false)
            $('.VerifyOtpFunction').html('Submit');



            if ($.trim(response)=="success") {

              $('#sucessMessage').show();
              $('#sucessMessage').html('your otp successfully verified');

              $('.change-emails').show();
       $(".otp_show").hide();


}
else if($.trim(response)=="success1"){

  window.location.replace(clickDisbled);


            }else{

              $('#errorMessage').show();

              $('#errorMessage').html('Sorry your otp is not valid');

            }

            $('.VerifyOtpFunction').html('Submit');

          },error:function(response){

console.log(response)
          }

        });


}else{
     $(".VerifyOtpFunction").prop('disabled',false)
            $('.VerifyOtpFunction').html('Submit');

    $('#errorMessage').show();

              $('#errorMessage').html('Please Enter Otp');

}


});
       $(".radio_cls").click(function(){

var value = $("input[name='status_reason']:checked").val();


if (value=='Other') {

    $("#other_id").show();

}else{
    $("#other_id").hide();


}
})

   $(".click_disbled_account").click(function(){


     var data=$(this).attr('data');
     console.log(base_url+'delete')

     var clickDisbled = $(this);

     var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
     swal({
      title: 'Are you sure?',
      text: "You want to delete this record! ",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
  },
  function() {
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

      $.ajax({
         type:"POST",

         url:base_url+'delete',
         data:{_token: CSRF_TOKEN, id:data},
         dataType:'JSON',


         complete: function(){

           clickDisbled.parents('.deleteRow').fadeOut(1500);

           swal(
              'Deleted!',
              'Your record has been deleted.',
              'success'
              );
       },

       error: function (data) {

        console.log(data)

    }


});
  });
 });


    $('#resend_otps').click(function(e){
    event.preventDefault();


// alert('i click')

    $(".otp_show").show();

  
    $("#resend_otps").hide();


$("#timer_id").show();
// $(".VerifyOtpFunction").hide();
    $("#errorMessage").hide();
    $("#sucessMessage").hide();
    // $(".change-emails").hide();

    // SendOtpFunction()
var email="{{$record->email}}";



    $.ajax({
      url: "{{ url('seller/change-email') }}",
      type:"POST",
      
    data: {email:email},


  success:function(response){


          document.getElementById('timer').innerHTML =
    01 + ":" + 00;
  startTimerFirst();



       $(".resend_otps").prop('disabled',false)
       $('.resend_otps').html('Submit');

       $(".otp_show").show();
       console.log(response);

$(".resend_otps").hide();
$(".VerifyOtpFunction").show();
$(".SendOtpFunction").hide();
$(".change-emails").hide();
    $("#resend_otps").hide();



     },
           error:function(data){

console.log(data)
}



//       success:function(response){
//        console.log(response,'send_client_otp');

//        $(".ContinueBtn").prop('disabled',false)
//        $('.ContinueBtn').html('Submit');

//        $(".otp_show").show();
//        console.log(response);

// $(".ContinueBtn").hide();
// $(".VerifyOtpFunction").show();
// $(".SendOtpFunction").hide();


//  document.getElementById('timer').innerHTML =
//     01 + ":" + 00;
//   startTimerFirst();


// // $("#td_id").toggleClass('ContinueBtn VerifyOtpFunction');

// // $("#first_form").toggleClass('change_form_cls new_form_cls');

//      },error:function(errorMsg){

// console.log(errorMsg,'send_client_otp')

// }
   });



})
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