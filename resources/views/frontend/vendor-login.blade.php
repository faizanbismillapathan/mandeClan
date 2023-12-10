@extends('frontend.layouts.app')
@section('title', 'Online Shopping site in US: Shop Online for Mobiles, Books, Watches, Shoes and More - mandeclan.com')
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
        .hide {
            display: none;
        }

        .error {
            font-size: 0.8rem;
        }

        .vendor-list-page .input-group {
            border-radius: unset;
            border-bottom: 1px solid #BDBDBD;
        }

        .vendor-list-page .input-group img {

            transform: unset;
            width: 22px;
        }




        .iti {

            width: 85%;
        }

        .input_grp {
            border-bottom: 1px solid #BDBDBD;
        }

        .input_grp .form-control {
            background-image: unset;

        }

        .input_grp .input-group-text {
            padding: 10px;
        }

        .login-sign-forg .img img {
            position: absolute;
            width: 100%;
            height: 100%;
        }

        .btn-custome {
            background-color: #f26e21;
            color: #fff;
        }


        .is-invalid {
            box-shadow: none !important;
            border-color: none !important;
        }
    </style>
    <div style="background: beige;" class="row login-sign-forg zar_new_forg">
        <div class="col-md-7 padding0" style="margin: auto;padding:100px 0px 40px 0px;">
            <div class="row" style="border:1px solid #ccc; background: white;">
                <div class="col-md-5 bg_white p-0">
                    <div class="img">
                        <img src="{{ asset('/img/venderImg.png') }}" class="w-100">
                    </div>
                </div>


                <div class="col-md-7 bg_white">
                    <div class="padding py-5">
                        <h2 class="title-heading" style="margin-top:0px">Merchant Sign In/Sign Up</h2>
                        <div class="heading-border"></div>
                        {{-- {{ Session::get('session_client_otp') }} --}}

                        <div class="alert alert-danger" role="alert" id="errorMessage" style="display: none;">

                        </div>

                        <div class="alert alert-success" role="alert" id="sucessMessage" style="display: none;">

                        </div>

                        <form id="first_form" class="change_form_cls px-5">

                            <div class="form-group">
                                <div class="input-group">

                                    {!! Form::text('mobile', null, [
                                        'class' => 'form-control vendor_mobile_input numbersOnly',
                                        'placeholder' => 'Mobile Number',
                                        'id' => 'vendor_mobile_id',
                                        'minlength' => '10',
                                        'maxlength' => '10',
                                    ]) !!}



                                    <input type="hidden" name="user_country_code" id="phone3" value="">


                                    <div class="input-group-append">

                                        <span class="input-group-text hide" id="clears" type="button">
                                            <i class="fas fa-times"></i>
                                        </span>


                                    </div>
                                </div>

                                <span id="valid-msg" class="hide">✓ Valid</span>

                                <span id="error-msg" class="hide"></span>

                            </div>


                            <input type="hidden" name="checkSignSignUp" id="checkSignSignUp" value="">

                            <div class="input-grp otp_show hide otp_ids">
                                <div class="input-group input_grp">

                                    <input type="text" class="form-control numbersOnly" placeholder="Enter OTP "
                                        required="required" id="otp" name="otp" maxlength="4" minlength="4">
                                    <div class="input-group-append">

                                        {{-- ........ --}}
                                        <span class="input-group-text  otp_show hide timer_ids" id="timer_id">
                                            <span class="text-secondary" id="timer">01:00</span>
                                        </span>

                                        {{-- ....... --}}

                                        <span class="input-group-text hide center" id="resend_otps">
                                            <p id="resend_otps_submit " style="cursor: pointer;    margin-bottom: 0px;"
                                                class="contactFormTimer">Resend OTP</p>
                                        </span>



                                        {{-- ..... --}}
                                    </div>
                                </div>


                            </div>

                            <div class="row">


                            </div>





                            <button class=" btn btn-raised btn-custome custom-cheryred ContinueBtn hide" id="td_id"
                                style="margin-top: 10px">Next</button>

                            <button type="button"
                                class=" btn btn-raised btn-custome VerifyOtpFunction custom-cheryred hide" id="td_id"
                                style="margin-top: 10px">Next</button>



                            <p> Register as a Vendor? <a href="{{ url('vendor-signup') }}" style="color: blue">Sign Up</a>
                            </p>


                        </form>

                        <div class="row px-5">
                            <div class="col-md-12 col-xs-12">
                                <div class="">
                                    <h6>Are you a customer ? <a href="{{ url('customer-login') }}"
                                            style="color: blue">Login</a> </h6>
                                </div>
                            </div>

                            <!--<div class="col-md-3 col-xs-3">-->
                            <!--    <div class="center">-->
                            <!--        {{-- <p>Are you a Vendor ?</p> --}}-->
                            <!--    <a href="{{ url('login') }}">Customer Sign In</a>-->
                            <!--    </div>-->
                            <!--</div>-->
                        </div>
                        <div class="pl-5">
                            <span>Login Via Email ?
                            </span>
                            <a href="{{ url('seller/login') }}"><span class="text-info">Click here</span></a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>



    <link rel="stylesheet" type="text/css" href="{{ asset('/build/css/intlTelInput.css') }}">


    <script type="text/javascript" src="{{ asset('/build/js/intlTelInput.js') }}"></script>

    <script>
        var input = document.querySelector("#vendor_mobile_id");
        var iti = window.intlTelInputGlobals.getInstance(input);


        window.intlTelInput(input, {
            allowDropdown: true,

            autoHideDialCode: true,
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
            onlyCountries: ['us', 'in'],
            // placeholderNumberType: "MOBILE",
            preferredCountries: ['in'],
            separateDialCode: true,

            utilsScript: "{{ asset('/build/js/utils.js') }}",

        });


        var iti = window.intlTelInputGlobals.getInstance(input);
        var countryData = iti.getSelectedCountryData();
        $("#phone3").val(countryData.dialCode)


        input.addEventListener("countrychange", function() {

            var countryData = iti.getSelectedCountryData();

            $("#phone3").val(countryData.dialCode)

        });
    </script>




    <script type="text/javascript">
        // var initial;

        $(".contactFormTimer").click(function() {
            document.getElementById('timer').innerHTML =
                01 + ":" + 00;
            startTimerFirst();
        });


        function startTimerFirst() {


            var presentTime = document.getElementById('timer').innerHTML;
            var timeArray = presentTime.split(/[:]+/);
            var m = timeArray[0];
            var s = checkFirst((timeArray[1] - 1));
            if (s == 59) {
                m = m - 1
            }

            //   if (m=='-1') {

            //         setTimeout(startTimerSecond, 1000);

            // }

            console.log(m)
            if (m < 0) {

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
            var initial = setTimeout(startTimerFirst, 1000);

        }


        function checkFirst(sec) {
            if (sec < 10 && sec >= 0) {
                sec = "0" + sec
            }; // add zero in front of numbers < 10
            if (sec < 0) {
                sec = "59"
            };
            return sec;
        }

        function myStopFirstFunction() {
            clearTimeout(initial);
            // window.clearTimeout(initial);

        }
    </script>



    <script>
        $(document).ready(function() {

            $(".hide").hide()
            $(".vendor_mobile_input").keyup(function() {

                var value = $(this).val()



                var newtext = value.replace('91', '');
                var newtext1 = newtext.replace('+', '');


                if (newtext1.length > 1) {

                    $(".ContinueBtn").show();
                    $("#clears").show();

                    $(".VerifyOtpFunction").hide();
                    $("#first_form").attr("data", value);


                } else {
                    $("#clears").hide();

                    $(".ContinueBtn").hide();

                    $(".hide").hide();
                    $(".otp_show").hide();
                    $('#vendor_mobile_id').prop('readonly', false);

                }
            });

        });
    </script>

    <script type="text/javascript">
        jQuery('.numbersOnly').keyup(function() {
            this.value = this.value.replace(/[^0-9\.]+/g, '');
        });

        $("#clears").on("click", function() {
            $("#vendor_mobile_id").val("")

            $(".hide").hide()
            location.reload()
        });
    </script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });




            $.validator.addMethod("email_or_phone_number", function(value, element) {
                return /^[\s()+-]*([0-9][\s()+-]*){6,20}$/.test(value)

                // ||   //Indian Mobile No. Lenth 10
                //     /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(value) //email
            }, "Please enter valid mobile number");




            $(".change_form_cls").validate({

                rules: {

                    vendor_mobile: {
                        required: true,
                        email_or_phone_number: true,
                        minlength: 10,
                        maxlength: 13,
                    },


                },
                messages: {
                    email: {
                        remote: "email must be unique."
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
                    if ($el.hasClass('select2-hidden-accessible') || $el.attr('data-city') ===
                        'tagsinput') {
                        $el.parent().addClass('is-invalid');
                    }
                },

                submitHandler: function(form) {


                    saveFormDatas(form);
                    return false;




                },

            });

        });
    </script>


    <script>
        $('#resend_otps').click(function(e) {
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
                url: "{{ url('send_client_otp') }}",
                type: "POST",

                data: $('#first_form').serialize(),

                success: function(response) {
                    console.log(response, 'send_client_otp');

                    $(".ContinueBtn").prop('disabled', false)
                    $('.ContinueBtn').html('Submit');

                    $(".otp_show").show();
                    console.log(response);
                    $('#vendor_mobile_id').prop('readonly', true);

                    $(".ContinueBtn").hide();
                    $(".VerifyOtpFunction").show();


                    document.getElementById('timer').innerHTML =
                        01 + ":" + 00;
                    startTimerFirst();


                    // $("#td_id").toggleClass('ContinueBtn VerifyOtpFunction');

                    // $("#first_form").toggleClass('change_form_cls new_form_cls');

                },
                error: function(errorMsg) {

                    console.log(errorMsg, 'send_client_otp')

                }
            });


            // // otp = otp.trim();
            // var token = $('meta[name="csrf-token"]').attr('content');
            // console.log($('#first_form').serialize())

            // $.ajax({
            //  url: "{{ url('send_client_otp') }}",
            //  type:"POST",

            //  data: $('#first_form').serialize(),
            //  success:function(response){

            //            // alert('sss')
            //            $(".ContinueBtn").prop('disabled',false)

            //            $(".otp_show").show();
            //            console.log(response);

            //            $('.ContinueBtn').html('Submit');

            //          },
            //        });

        })
    </script>

    <script type="text/javascript">
        function saveFormDatas() {

            // $(".ContinueBtn").click(function() {


            // alert('sss')

            var vendor_mobile_id = '+' + $("#phone3").val() + $("#vendor_mobile_id").val();

            $("#errorMessage").hide();
            $("#sucessMessage").hide();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $('.ContinueBtn').html('Sending..');

            $(".ContinueBtn").prop('disabled', true)
            var ids = '+' + $("#phone3").val() + $("#vendor_mobile_id").val();



            $.ajax({
                url: "{{ url('check_new_vendor_credntial') }}",
                type: "POST",

                // data: {
                //   check_user_name:$("#emailss").val()
                // },

                data: {
                    check_user_name: ids,
                    role: 2
                },

                success: function(response) {


                    $(".ContinueBtn").prop('disabled', false)
                    $('.ContinueBtn').html('Submit');

                    console.log($.trim(response));
                    console.log(response.status);
                    // console.log(response.email);

                    // return 'false';
                    if (response.status == "exist") {




                        $(".otp_show").show();

                        $('#vendor_mobile_id').prop('readonly', true);

                        SendOtpFunction()
                        // $("#td_id").toggleClass('ContinueBtn SendOtpFunction');

                    } else if (response.status == "notexist") {

                        if (response.status == 'Yes') {
                            var msg = 'Email';
                        } else {

                            var msg = 'Mobile';

                        }

                        $('#errorMessage').show();

                        $('#errorMessage').html('Invalid  ' + msg + ' Please Signup First');


                    } else if (response.status == "not_permit") {

                        $('#errorMessage').show();

                        $('#errorMessage').html('Mobile No already registered in some other role');


                    } else if (response.status == "archive") {

                        $('#errorMessage').show();

                        $('#errorMessage').html(
                            'Your Account deleted. for active account contact to admin OR Create account after 30 days'
                        );


                    } else if (response.status == "custome") {

                        $(".otp_show").show();
                        $('#vendor_mobile_id').prop('readonly', true);

                        SendOtpFunction()

                    }


                },
                error: function(errorMsg) {

                    console.log(errorMsg)

                }
            });


        };

        function SendOtpFunction() {

            var vendor_mobile_id = '+' + $("#phone3").val() + $("#vendor_mobile_id").val();


            $('.ContinueBtn').html('Sending..');

            $(".ContinueBtn").prop('disabled', true)

            $.ajax({
                url: "{{ url('send_client_otp') }}",
                type: "POST",

                data: $('#first_form').serialize(),

                success: function(response) {


                    document.getElementById('timer').innerHTML =
                        01 + ":" + 00;
                    startTimerFirst();



                    $(".ContinueBtn").prop('disabled', false)
                    $('.ContinueBtn').html('Submit');

                    $(".otp_show").show();
                    console.log(response);
                    $('#vendor_mobile_id').prop('readonly', true);

                    $(".ContinueBtn").hide();
                    $(".VerifyOtpFunction").show();

                    // $("#td_id").toggleClass('ContinueBtn VerifyOtpFunction');

                    // $("#first_form").toggleClass('change_form_cls new_form_cls');

                },
            });


        };


        $(".VerifyOtpFunction").click(function() {



            var mobile_id = '+' + $("#phone3").val() + $("#vendor_mobile_id").val();

            // alert(mobile_id)

            var otp = $("#otp").val();

            console.log(otp, 'otpotp')

            var clickDisbled = "{{ url('seller/dashboard') }}";

            $('#sucessMessage').hide();

            $('#errorMessage').hide();



            // console.log($('#first_form').serialize())


            if (otp) {
                $.ajax({
                    url: "{{ url('send_client_otp_sigin') }}",
                    type: "POST",

                    data: {
                        mobile: mobile_id,
                        otp: otp
                    },

                    success: function(response) {
                        $(".VerifyOtpFunction").prop('disabled', false)

                        // $(".both_pe_show").hide();
                        // $(".otp_show").show();
                        console.log(response);
                        $(".VerifyOtpFunction").prop('disabled', false)
                        $('.VerifyOtpFunction').html('Submit');



                        if ($.trim(response) == "success") {

                            $('#sucessMessage').show();

                            $('#sucessMessage').html('your otp successfully verified');
                            window.location.replace(clickDisbled);

                        } else if ($.trim(response) == "not_in_same_role") {

                            $('#errorMessage').show();

                            $('#errorMessage').html('Mobile no already registered in some other role');

                        } else {

                            $('#errorMessage').show();

                            $('#errorMessage').html('Sorry your otp is not valid');

                        }

                        $('.VerifyOtpFunction').html('Submit');

                    },
                });


            } else {
                $(".VerifyOtpFunction").prop('disabled', false)
                $('.VerifyOtpFunction').html('Submit');

                $('#errorMessage').show();

                $('#errorMessage').html('Please Enter Otp');

            }


        });
    </script>


@endsection
