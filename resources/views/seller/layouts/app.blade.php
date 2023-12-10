    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- <title>Mande</title> -->
          <title>@yield('title')</title>

        <link rel="icon" href="{{asset('public/img/favicon.jpg')}}"/>     

          @stack('style')


        <link href="{{ asset('public/css/bootstrap-toggle.min.css') }}" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="{{ asset('public/sweetalert-master/dist/sweetalert.css') }}">
        <link href="{{ asset('public/css/toastr.min.css') }}" rel="stylesheet">

        <link href="{{ asset('public/css/mande_app.css') }}" rel="stylesheet">
        <link href="{{ asset('public/css/index.css') }}" rel="stylesheet">

         @yield('customStyle')


    </head>
    <body>

      @include('seller.layouts.sidemenu')  

<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
      <script src="{{asset('public/js/jquery-3.3.1.min.js')}}"></script>
      <!-- <script src="{{asset('public/js/comman.js')}}"></script> -->
      <script src="{{asset('public/js/plagin.js')}}"></script>
      <script src="{{asset('public/js/validation.js')}}"></script>
      <script src="{{asset('public/js/toastr.min.js')}}"></script>
            <script src="{{ asset('public/js/bootstrap-toggle.min.js') }}"></script>

            @stack('js')

      <script src="{{ asset('public/js/bootstrap.min.js') }}"></script>
      <script src="{{ asset('public/sweetalert-master/dist/sweetalert.min.js') }}"></script>
      <script src="{{ asset('public/js/mande_app.js') }}"></script>
        <script src="{{ asset('public/js/forms.js') }}"></script>
  

<script>
        var baseUrl = @json(url('/seller/'.Request::segment(2)));
    var appname = @json(config('app.name'));

  @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch(type){
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;
        
        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;

        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
  @endif
</script>



  </body>

  </html>
