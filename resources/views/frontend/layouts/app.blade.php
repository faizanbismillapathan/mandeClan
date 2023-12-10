<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    @yield('meta')

    <link rel="icon" type="image/png" href="{{ asset('/frontend/img/favicon.jpg') }}" sizes="16x16" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    @stack('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('/frontend/css/bootstrap-material-design.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/frontend/css/bootstrap-material-design.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/frontend/css/all.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/frontend/css/lightgallery.css') }}">
    <!--     <link rel="stylesheet" type="text/css" href="{{ asset('/frontend/fontawesome-stars.css') }}">
 -->
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Bitter" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('/frontend/css/stylesheet.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/frontend/css/media-query.css') }}">
    <script src="https://code.jquery.com/jquery-3.4.0.js" integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo="
        crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('/frontend/css/custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/frontend/css/all-custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/frontend/css/all-media-query.css') }}">


    @yield('customStyle')

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/6245803e2abe5b455fc296b7/1fvfnptes';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!--End of Tawk.to Script-->


</head>
@if (empty($header_not_display))
    @include('frontend.layouts.header')
@endif

<body style="width:100%;padding-right:0px;">
    <div id="overlay" style="display:none;">
        <div style="display:table;height:100%;width:100%;overflow:hidden;">
            <div style="display:table-cell;vertical-align:middle;">
                <div class="center">
                    <img src="{{ url('/') }}//img/demo_wait.gif" width="64" height="64" />
                </div>
            </div>
        </div>
    </div>
    @yield('innercontent')
    <div id='loader' class="loadingoverlay loading gifload" style="display: none;">
        <div style="display: table; height: 100%; width: 100%; overflow: hidden;">
            <div style="display: table-cell; vertical-align: middle;">
                <div class="center">
                    <img src='https://iamfresh.in/uploads/image/gear-loading.gif' width='100px' height='100px'>
                </div>
            </div>
        </div>
    </div>




    <script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js"
        integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous">
    </script>
    <script async src="{{ asset('/frontend/js/bootstrap-material-design.min.js') }}"></script>

    <script async src="{{ asset('/frontend/js/lightgallery-all.min.js') }}"></script>
    <!-- <script async src="{{ asset('/frontend/jquery.barrating.js') }}"></script> -->
    <!-- <script async src="{{ asset('/frontend/examples.js') }}"></script> -->

    @stack('js')


    <script>
        var baseUrl = @json(url('/customer/' . Request::segment(2)));
        var appname = @json(config('app.name'));
    </script>

    <script async src="{{ asset('/frontend/js/jquery.js') }}"></script>


</body>

</html>
