<div style="
/*background-image:  url('{{asset('public/img/background2.jpg')}}')!important;
    background-repeat: no-repeat ;
    background-size: cover;*/
    height: 100%;
    width: 100%;
    overflow: hidden;
    border: 0px solid red;
background: #fff;

    ">
@extends('layouts.app')

@section('content')


<style>
.maindivtop {
    background-color: red;
    height:400px;
}
    .navbar .navbar-expand-md .navbar-light .navbar-laravel
    {
        display: none!important;
    }
    .navbar-laravel{
        display: none;
    }
   
}

</style>
<main class="main h-100 w-100">
        <div class="container h-100">
            <div class="row h-100">
                <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">

                        <div class="text-center mt-4">
                            <h1 class="h2">Signin</h1>
                        
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="m-sm-4">
                                    <div class="text-center">
  <img src="{{asset('public/img/mandeclan_logo.jpg')}}" alt="Chris Wood" class="img-fluid" width="132" height="100" />
                                    </div>
         

                               <form method="POST" action="{{ route('login') }}">
                        @csrf

{{ csrf_field() }}

                               <input type="hidden" name="type" value="{{Request::segment(1)}}">      
                                <div class="form-group">
                                <label for="email">Email</label>

                                <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" autocomplete="off" required autofocus>

                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                                </div>

                                        <div class="form-group">
                                            <label for="password">Password</label>
                                           <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" autocomplete="off" required>
                                              @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                            <small>
            <a href="{{ route('password.request') }}">Forgot password?</a>
          </small>
                                        </div>

                                        
                      



                                        <div>
                                             <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>

                                    
                                        </div>

                     

                                        <div class="text-center mt-3 ">
                                            <button type="submit" class="btn btn-primary  btn-block">
                                    Sign in
                                </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function(event) {

    $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
$('#login_validation').validate({

     rules: {
                 'email': {
                      required: true,
                      
          
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

                        // alert(username)

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
        'country_name':{
            remote:"This name is already used ,please choos another name."                  
        }   }, 

            });
                 });
</script>
@endsection
