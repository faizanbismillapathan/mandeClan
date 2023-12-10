@extends('customer.layouts.app')
@section('title',"All Subscriptions | customer  Mande Clan")

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

            <h1 class="h3 mb-3"><b>Deactivated Account
            </b></h1>

        </div>
        <div class="card">  

          <div class="card-body">


            <div class="card">
                <div class="card-header">
                    <div class="row">
                       <div class="col-md-6">
                        <h4>Deactivated Account</h4>

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

                            <h3 class="center">{{$users->mobile}}</h3>

            <h5 class="center">REMEMBER! THIS ACTION WILL DELETE ALL YOUR PERSONAL DATA.</h5>
            <p class="center">Please remember that by cancelling your account, you will no longer be able to benefit from our customers. If you have any questions, please contact our Customer customer Departments</p>



              <form id="first_form" class="change_form_cls px-5 otp_show hide otp_ids">


              <div class="row">
                  <div class="col-md-5">
                       <div class="input-grp ">
                  <div class="input-group input_grp">

                      <input type="text" class="form-control numbersOnly" placeholder="Enter OTP " required="required" id="otp" name="otp" maxlength="4" minlength="4" >
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


          <button  class=" btn btn-raised btn-custome custom-cheryred ContinueBtn hide" id="td_id" style="margin-top: 10px">Verify</button>

          <button type="button" class=" btn btn-raised btn-custome VerifyOtpFunction custom-cheryred hide" id="td_id" style="margin-top: 10px">Verify</button>
                  </div>
              </div>

      </form>
      <!--  -->


            {!!Form::open(['url'=>['customer/deactivate-account'],'files' => true, 'class' => ' form-bordered form-row-stripped SendOtpFunction','id' =>'comman_form_id'])!!}
           


            <label class="label">Reasons for cancelling your account</label>

            <label class="custom-control custom-radio">
                {{ Form::radio('status_reason', 'I have already found a job' , true,array('class'=>'custom-control-input radio_cls')) }}

                <span class="custom-control-label"> I have already found a job</span>
            </label>  

            <label class="custom-control custom-radio">
                {{ Form::radio('status_reason', 'I am not satisfied with your Customer customer' , false,array('class'=>'custom-control-input radio_cls')) }}

                <span class="custom-control-label"> I am not satisfied with your Customer customer</span>
            </label>  


            <label class="custom-control custom-radio">
                {{ Form::radio('status_reason', 'I am not satisfied with the quality of the jobs posted on your site' , false,array('class'=>'custom-control-input radio_cls')) }}

                <span class="custom-control-label"> I am not satisfied with the quality of the jobs posted on your site</span>
            </label>  

            <label class="custom-control custom-radio">
                {{ Form::radio('status_reason', 'I apply for jobs on your site but I am never hired' , false,array('class'=>'custom-control-input radio_cls')) }}

                <span class="custom-control-label"> I apply for jobs on your site but I am never hired</span>
            </label>  
            <label class="custom-control custom-radio">
                {{ Form::radio('status_reason', 'I don not need this customer' , false,array('class'=>'custom-control-input radio_cls')) }}

                <span class="custom-control-label"> I don not need this customer</span>
            </label>  
            <label class="custom-control custom-radio">
                {{ Form::radio('status_reason', 'Other' , false,array('class'=>'custom-control-input radio_cls')) }}

                <span class="custom-control-label"> Other</span>
            </label>  


<div class="form-group" id="other_id" style="display:none">
                <label class="bmd-label-floating">Other Resone</label>
                {!! Form::text('status_reason',null,['class'=>'form-control','required']) !!}
            </div>


            <div class="form-group">
                <label class="bmd-label-floating">Comment</label>
                {!! Form::textarea('status_comment',null,['class'=>'form-control', 'rows' => 2, 'cols' => 40,'id'=>'','required','pattern'=>'[A-Za-z\\s]*', 'title'=>'Please enter the alphabet only']) !!}
            </div>


            <button type="button" class="btn custom-btn submits"><i class="fab fa-telegram-plane"></i> Submit</button>
            {{Form::close()}}
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

<script type="text/javascript">

  $(".submits").click(function() {

    console.log($('.SendOtpFunction').serialize())

$('.ContinueBtn').html('Sending..');

$(".ContinueBtn").prop('disabled',true)

    $.ajax({
      url: "{{ url('customer/deactivate-account') }}",
      type:"POST",
      
      data: $('.SendOtpFunction').serialize(),

      success:function(response){


          document.getElementById('timer').innerHTML =
    01 + ":" + 00;
  startTimerFirst();



       $(".ContinueBtn").prop('disabled',false)
       $('.ContinueBtn').html('Submit');

       $(".otp_show").show();
       console.log(response);
$('#vendor_mobile_id').prop('readonly', true);

$(".ContinueBtn").hide();
$(".VerifyOtpFunction").show();
$(".SendOtpFunction").hide();



     },
   });

});


  $(".VerifyOtpFunction").click(function() {


  // alert('send_client_otp_sigin')


var otp =$("#otp").val();

console.log(otp,'otpotp')

var clickDisbled = "{{ url('/') }}";

              $('#sucessMessage').hide();

              $('#errorMessage').hide();



    console.log($('.SendOtpFunction').serialize())


if (otp) {
    $.ajax({
      url: "{{ url('customer/verify_and_deactivate') }}",
      type:"POST",
      
    data: {otp:otp},

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
 window.location.replace(clickDisbled);

}else if($.trim(response)=="not_in_same_role"){

   $('#errorMessage').show();

              $('#errorMessage').html('Email already registered in some other role');

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

  $('#vendor_mobile_id').prop('readonly', true);

    $("#resend_otps").hide();


$("#timer_id").show();
// $(".VerifyOtpFunction").hide();
    $("#errorMessage").hide();
    $("#sucessMessage").hide();

    // SendOtpFunction()


    $.ajax({
      url: "{{ url('customer/deactivate-account') }}",
      type:"POST",
      
      data: $('#first_form').serialize(),

      success:function(response){
       console.log(response,'send_client_otp');

       $(".ContinueBtn").prop('disabled',false)
       $('.ContinueBtn').html('Submit');

       $(".otp_show").show();
       console.log(response);
$('#vendor_mobile_id').prop('readonly', true);

$(".ContinueBtn").hide();
$(".VerifyOtpFunction").show();
$(".SendOtpFunction").hide();


 document.getElementById('timer').innerHTML =
    01 + ":" + 00;
  startTimerFirst();


// $("#td_id").toggleClass('ContinueBtn VerifyOtpFunction');

// $("#first_form").toggleClass('change_form_cls new_form_cls');

     },error:function(errorMsg){

console.log(errorMsg,'send_client_otp')

}
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
$('#vendor_mobile_id').prop('readonly', true);


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