<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mande</title>
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('/assets/css/bd-coming-soon.css') }}">

</head>
<style>
    .pyro>.before,
    .pyro>.after {
        position: absolute;
        width: 5px;
        height: 5px;
        border-radius: 50%;
        box-shadow: 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff;
        -moz-animation: 1s bang ease-out infinite backwards, 1s gravity ease-in infinite backwards, 5s position linear infinite backwards;
        -webkit-animation: 1s bang ease-out infinite backwards, 1s gravity ease-in infinite backwards, 5s position linear infinite backwards;
        -o-animation: 1s bang ease-out infinite backwards, 1s gravity ease-in infinite backwards, 5s position linear infinite backwards;
        -ms-animation: 1s bang ease-out infinite backwards, 1s gravity ease-in infinite backwards, 5s position linear infinite backwards;
        animation: 1s bang ease-out infinite backwards, 1s gravity ease-in infinite backwards, 5s position linear infinite backwards;
    }

    .pyro>.after {
        -moz-animation-delay: 1.25s, 1.25s, 1.25s;
        -webkit-animation-delay: 1.25s, 1.25s, 1.25s;
        -o-animation-delay: 1.25s, 1.25s, 1.25s;
        -ms-animation-delay: 1.25s, 1.25s, 1.25s;
        animation-delay: 1.25s, 1.25s, 1.25s;
        -moz-animation-duration: 1.25s, 1.25s, 6.25s;
        -webkit-animation-duration: 1.25s, 1.25s, 6.25s;
        -o-animation-duration: 1.25s, 1.25s, 6.25s;
        -ms-animation-duration: 1.25s, 1.25s, 6.25s;
        animation-duration: 1.25s, 1.25s, 6.25s;
    }


    @keyframes bang {
        to {
            box-shadow: -202px -87.6666666667px #00ff4d, 248px 65.3333333333px #0051ff, 216px -344.6666666667px #ff0059, -85px 29.3333333333px #1e00ff, -178px -315.6666666667px #3700ff, -116px -25.6666666667px #66ff00, 149px -112.6666666667px #09ff00, -170px -240.6666666667px #00fff2, -67px -349.6666666667px #f700ff, -115px -30.6666666667px #3700ff, -162px -334.6666666667px #00ff15, -31px 75.3333333333px #a600ff, -120px -279.6666666667px #59ff00, 249px -223.6666666667px #ff5100, -5px -227.6666666667px #ff00bf, -183px -71.6666666667px #ff009d, 189px -114.6666666667px #00ffbb, -57px -341.6666666667px #e600ff, 3px -88.6666666667px #ff00d0, 192px -352.6666666667px #59ff00, 34px -360.6666666667px #ff002b, 105px -12.6666666667px #d0ff00, -73px -37.6666666667px #bfff00, 28px -243.6666666667px #1a00ff, 15px -256.6666666667px #ff0080, -55px -97.6666666667px #00ff99, 25px -406.6666666667px #dd00ff, -196px 79.3333333333px #00ff5e, -28px -312.6666666667px #2b00ff, -146px 70.3333333333px #00ff99, 110px -234.6666666667px #ff3300, 161px 40.3333333333px #00ff55, 14px -0.6666666667px #ff002f, -211px -53.6666666667px red, 170px 6.3333333333px #0900ff, 176px -201.6666666667px #2600ff, 84px -331.6666666667px #0022ff, 68px -154.6666666667px #008cff, -133px 62.3333333333px #00ff1e, 2px 43.3333333333px #00f2ff, 29px 65.3333333333px #0062ff, -229px 9.3333333333px #ff6600, -202px -390.6666666667px #00ffd9, 237px -264.6666666667px #a2ff00, 101px -78.6666666667px #88ff00, 243px -355.6666666667px #0077ff, 166px 50.3333333333px #00ffaa, 185px -354.6666666667px #00ffdd, -236px -116.6666666667px #ff005e, -12px -77.6666666667px #ff4000, 243px -148.6666666667px #ffa600;
        }
    }

    @keyframes gravity {
        to {
            transform: translateY(200px);
            -moz-transform: translateY(200px);
            -webkit-transform: translateY(200px);
            -o-transform: translateY(200px);
            -ms-transform: translateY(200px);
            opacity: 0;
        }
    }

    @-webkit-keyframes position {

        0%,
        19.9% {
            margin-top: 10%;
            margin-left: 40%;
        }

        20%,
        39.9% {
            margin-top: 40%;
            margin-left: 30%;
        }

        40%,
        59.9% {
            margin-top: 20%;
            margin-left: 70%;
        }

        60%,
        79.9% {
            margin-top: 30%;
            margin-left: 20%;
        }

        80%,
        99.9% {
            margin-top: 30%;
            margin-left: 80%;
        }
    }

    @-moz-keyframes position {

        0%,
        19.9% {
            margin-top: 10%;
            margin-left: 40%;
        }

        20%,
        39.9% {
            margin-top: 40%;
            margin-left: 30%;
        }

        40%,
        59.9% {
            margin-top: 20%;
            margin-left: 70%;
        }

        60%,
        79.9% {
            margin-top: 30%;
            margin-left: 20%;
        }

        80%,
        99.9% {
            margin-top: 30%;
            margin-left: 80%;
        }
    }

    @-o-keyframes position {

        0%,
        19.9% {
            margin-top: 10%;
            margin-left: 40%;
        }

        20%,
        39.9% {
            margin-top: 40%;
            margin-left: 30%;
        }

        40%,
        59.9% {
            margin-top: 20%;
            margin-left: 70%;
        }

        60%,
        79.9% {
            margin-top: 30%;
            margin-left: 20%;
        }

        80%,
        99.9% {
            margin-top: 30%;
            margin-left: 80%;
        }
    }

    @-ms-keyframes position {

        0%,
        19.9% {
            margin-top: 10%;
            margin-left: 40%;
        }

        20%,
        39.9% {
            margin-top: 40%;
            margin-left: 30%;
        }

        40%,
        59.9% {
            margin-top: 20%;
            margin-left: 70%;
        }

        60%,
        79.9% {
            margin-top: 30%;
            margin-left: 20%;
        }

        80%,
        99.9% {
            margin-top: 30%;
            margin-left: 80%;
        }
    }

    @keyframes position {

        0%,
        19.9% {
            margin-top: 10%;
            margin-left: 40%;
        }

        20%,
        39.9% {
            margin-top: 40%;
            margin-left: 30%;
        }

        40%,
        59.9% {
            margin-top: 20%;
            margin-left: 70%;
        }

        60%,
        79.9% {
            margin-top: 30%;
            margin-left: 20%;
        }

        80%,
        99.9% {
            margin-top: 30%;
            margin-left: 80%;
        }
    }
    }
</style>

<body class="min-vh-100 d-flex flex-column">
    <div class="pyro">
        <div class="before"></div>
        <div class="after"></div>
    </div>
    <main class="my-auto">
        <div class="container justify-content-center">
            <div class="row">
                <div class="col-md-6">
                    <div class="text-center">
                        <img src="{{ asset('/assets/images/logo1.png') }} "class="img-fluid" alt=""
                            style="height: 150px; ">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 section-left">
                        <h2 class="page-title ">We are launching our new website</h2>
                        <h3>Coming Soon</h3>
                        <div id="timer" class="bd-cd-timer">
                            <div class="time-card">
                                <span class="time-count" id="days"></span>
                                <span class="time-label">DAYS</span>
                            </div>
                            <div class="time-card">
                                <span class="time-count" id="hours"></span>
                                <span class="time-label">HOURS</span>
                            </div>
                            <div class="time-card">
                                <span class="time-count" id="minutes"></span>
                                <span class="time-label">MINUTES</span>
                            </div>
                            <div class="time-card">
                                <span class="time-count" id="seconds"></span>
                                <span class="time-label">SECONDS</span>
                            </div>
                        </div>
                        <form class="form-subscribe">


                        </form>
                    </div>
                    <div class="col-md-6 align-items-center section-right">
                        <img src="{{ asset('/assets/images/coming-soon.png') }}" alt="coming soon" class="img-fluid">
                    </div>
                </div>
            </div>
    </main>

    <footer class="text-center">
        <!-- <nav class="footer-social-links">
            <a href="#!" class="social-link"><i class="mdi mdi-facebook-box"></i></a>
            <a href="#!" class="social-link"><i class="mdi mdi-twitter"></i></a>
            <a href="#!" class="social-link"><i class="mdi mdi-google"></i></a>
        </nav>-->

        <p class="footer-text mb-20">
        <h4> For Further Details Please Contact</h4>
        <h4>+91 227 272 865</h4>
        </p>
    </footer>

    <script src="{{ asset('/assets/js/bd-timer.js') }}"></script>

</body>

</html>
