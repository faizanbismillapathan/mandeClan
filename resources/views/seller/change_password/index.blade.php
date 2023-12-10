@extends('seller.layouts.app')
@section('title',"All Change Password | seller Mande Clan")

<!-- ................custom css................. -->

@section('customStyle')
<style type="text/css">
  .field-icon {
    float: right;
    margin-left: -25px;
    margin-top: -25px;
    position: relative;
    z-index: 2;
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

            <h1 class="h3 mb-3">Change Password &nbsp;&nbsp;@if(!empty($records))({{$records->total()}})@endif</h1>
        </div>

        <div class="card">
                                            <div class="card-body">

<div class="change-email">
             {!!Form::open(['url'=>['seller/change-password'],'files' => true, 'class' => ' form-bordered form-row-stripped','id'=>'change_password_form'])!!}

             <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label class="bmd-label-floating">Current Password</label>
                  {{-- {!!Form::password('current_password',array('class'=>'form-control','autocomplete'=>'off','required')) !!}  --}}


 <input id="password-field1" type="password" class="form-control" name="new_password" value="" required>
                  <span toggle="#password-field1" class="fa fa-fw fa-eye field-icon toggle-password"></span>

                </div>
                <div class="form-group">
                  <label class="bmd-label-floating">New Password</label>
                  {{-- {!!Form::password('new_password',array('class'=>'form-control','autocomplete'=>'off','required','id'=>'password')) !!}  --}}


 <input id="password-field2" type="password" class="form-control" name="new_password" value="" required>
                  <span toggle="#password-field2" class="fa fa-fw fa-eye field-icon toggle-password"></span>


                </div>
                <div class="form-group">
                  <label class="bmd-label-floating"> Confirm Password </label>
{{--                   {!!Form::password('confirm_password',array('class'=>'form-control','autocomplete'=>'off','required')) !!} 
 --}} 

 <input id="password-field3" type="password" class="form-control" name="confirm_password" value="" required>
                  <span toggle="#password-field3" class="fa fa-fw fa-eye field-icon toggle-password"></span>

                </div>

                 

                                      <button class="btn btn-primary">Change Password</button>

                  {{--  @if($allows=='Yes')
                      <button class="btn btn-primary">Change Password</button>
                      @else
<button class="btn btn-primary"  type="button"   data-toggle="modal" data-target="#delete">Change Password</button>
                      @endif --}}

              </div>
              <div class="col-md-6">
               
              </div>
            </div>
            {{Form::close()}}
            <input type="hidden" name="test" id="test" value="{{$record->store_password}}">
          </div>

</div>

</div>
 </div>


</main> 


@endsection

<!-- ................push new js link................. -->

@push('js')
<script src="{{asset('public/js/comman.js')}}"></script>

<script>
  $(document).ready(function () {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $('#change_password_form').validate({

     rules: {
                // new_password: "required",
                new_password: {
                  required: true,
                  minlength:6,
                  maxlength:20
                },
                confirm_password: {
                  equalTo: "#password",

                },
                current_password: {
                  equalTo: "#test"
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
         

                     messages: {  // <-- you must declare messages inside of "messages" option
                     new_password:{
                      required:" Enter Password."                  
                    }    ,  
                    confirm_password:{
                      equalTo:" Enter Confirm Password Same as Password."                  
                    }   ,
                    current_password:{
                      equalTo:"Your Current Password Does not Match."                  
                    }    
                  },


                });

  });


   $('.change-email').on('click','.toggle-password', function(){
  // alert('ss')
  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));


  if (input.attr("type") == "password") {

    input.attr("type", "text");
}
else {
    input.attr("type", "password");

}
});


</script>
@endpush