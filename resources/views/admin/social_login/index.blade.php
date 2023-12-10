@extends('admin.layouts.app')
@section('title',"Social Login Settings | Admin Mande Clan")

<!-- ................custom css................. -->

@section('customStyle')
<style type="text/css">
.nav-stacked>li {
  border-bottom: 1px solid #f4f4f4;
  margin: 0;
}

.nav-stacked>li>a {
  border-radius: 0;
  border-top: 0;
  border-left: 3px solid transparent;
  color: #157ed2;
  position: relative;
  display: block;
  padding: 10px 15px;
}



.text-red {
  color: #dd4b39!important;
  float: right;
}


.text-green {
  color: green!important;
  float: right;
}

.nav-stacked>li>a:focus, .nav-stacked>li>a:hover {
  color: #444;
  background: #f7f7f7;
}
.nav-pills .nav-link.active, .nav-pills .show>.nav-link {
  color: #000;
  background-color: #ebebeb;
}

.text-info{
      color: #3d9bfb !important;
}
.alert-success{
  padding: 20px;
}

a{
  color: #000;
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
      <h1 class="h3 mb-3">Social Login Settings</h1>
    </div>


        <div class="row">
          <div class="col-md-4 mb-3">

    <div class="card">
      <div class="card-body password_contact">
            <ul class="nav nav-pills flex-column" id="myTab" role="tablist">
              <!-- ......... -->

              <li class="nav-item">
              
                <a class="nav-link" id="tab_paypal" data-toggle="tab" href="#id_tab_paypal" role="tab" aria-controls="id_tab_paypal" aria-selected="true">    <i class="fab fa-facebook"></i>   <i class="fa fa-circle {{ $configs->paypal_enable==1 ? "text-green" : "text-red" }}"" ></i>
                Facebook Login Settings </a>
              </li>

              <!-- ......... -->

              <li class="nav-item">
                <a class="nav-link  {{ $configs->stripe_enable==1 ? "Active" : "Deactive" }}" id="tab_stripe" data-toggle="tab" href="#id_tab_stripe" role="tab" aria-controls="id_tab_stripe" aria-selected="true"><i class="fab fa-google"></i>  <i class="fa fa-circle {{ $configs->stripe_enable==1 ? "text-green" : "text-red" }}"" ></i>Google Login Settings</a>
              </li>


              <!-- ......... -->

              <li class="nav-item">
                <a class="nav-link " id="tab_paytm" data-toggle="tab" href="#id_tab_paytm" role="tab" aria-controls="id_tab_paytm" aria-selected="true">   <i class="fab fa-twitter"></i>  <i class="fa fa-circle {{ $configs->paytm_enable==1 ? "text-green" : "text-red" }}"" ></i>Twitter Login Settings</a>
              </li>


              <!-- ......... -->

              <li class="nav-item">
                <a class="nav-link " id="tab_razorPay" data-toggle="tab" href="#id_tab_razorPay" role="tab" aria-controls="id_tab_razorPay" aria-selected="true">   <i class="fab fa-amazon"></i>  <i class="fa fa-circle {{ $configs->razorpay==1 ? "text-green" : "text-red" }}"" ></i>Amazon Login Settings</a>
              </li>


              <!-- ......... -->

              <li class="nav-item">
                <a class="nav-link " id="tab_skrill" data-toggle="tab" href="#id_tab_skrill" role="tab" aria-controls="id_tab_skrill" aria-selected="true">   <i class="fab fa-gitlab"></i>  <i class="fa fa-circle {{ $configs->paypal_enable==1 ? "text-green" : "text-red" }}"" ></i>Gitlab Login Settings</a>
              </li>


              <!-- ......... -->

              <li class="nav-item">
                <a class="nav-link " id="tab_braintree" data-toggle="tab" href="#id_tab_braintree" role="tab" aria-controls="id_tab_braintree" aria-selected="true">   <i class="fab fa-linkedin"></i>  <i class="fa fa-circle {{ $configs->skrill_enable==1 ? "text-green" : "text-red" }}"" ></i>Linkedin Login Settings</a>
              </li>


              <!-- ......... -->

            </ul>
          </div>
        </div>
          </div>
          <!-- .................................. -->
          <div class="col-md-8">

    <div class="card">
      <div class="card-body">
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="id_tab_paypal" role="tabpanel" aria-labelledby="tab_paypal">

                {!!Form::open(['url'=>['admin/facebook_setting'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}


                <div class="card table-content">
                  <div class="card-header" style="background-color:#ccc;">
                    <div class="row">
                      <div class="col-md-6">
                        <h4>Facebook Login Settings</h4>
                      </div>
                      <div class="col-md-6">

                      </div>

                    </div>
                  </div>

                  <div class="card-content" style="padding:20px">
                   <div class="form-row">

                    <div class="form-group col-md-8 ">                        
                     <label for="">Client ID:</label>
                     <input type="text" placeholder="enter client ID" class="form-control"
                     name="FACEBOOK_CLIENT_ID" value="{{ env('FACEBOOK_CLIENT_ID') }}">
                   </div>

                   <div class="form-group col-md-8 ">                        
                     <label for="">Client Secret Key:</label>
                     <input type="password" placeholder="enter secret key" class="form-control"
                     id="fb_secret" name="FACEBOOK_CLIENT_SECRET"
                     value="{{ env('FACEBOOK_CLIENT_SECRET') }}">


                   </div>



                   <div class="form-group col-md-8 ">  
                    <label for="">Callback URL:</label>
                    <div class="input-group">                      
                      <input value="" type="text"
                      placeholder="https://yoursite.com/public/login/facebook/callback"
                      name="FB_CALLBACK_URL" value="{{ env('FB_CALLBACK_URL') }}"
                      class="callback-url form-control">
                      <span class="input-group-addon" id="basic-addon2">
                        <button title="Copy" type="button" class="copy btn btn-xs btn-default">
                          <i class="fa fa-clipboard" aria-hidden="true"></i>
                        </button>
                      </span>
                    </div>
                      <small class="text-muted">
                    <i class="fa fa-question-circle"></i> Copy the callback url and paste in your app
                  </small>

                  </div>
                
                  <div class="form-group col-md-5 ">                        

                   <button type="submit" class="btn full btn-primary">Save</button>

                 </div>
                 <div class="form-group col-md-4 ">     
                  @if($configs->paypal_enable==1)   

                  <input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="Deactive" name="paypal_enable" data-onstyle="success" data-offstyle="danger" id="paypal_status_setting" class="checkstatus_1" onchange="updateStatusToggle('paypal_status_setting','paypal_enable')" >

                  @else
                  <input type="checkbox"  data-toggle="toggle" data-on="Active" data-off="Deactive" name="paypal_enable" data-onstyle="success" data-offstyle="danger" id="paypal_status_setting" class="checkstatus_1" onchange="updateStatusToggle('paypal_status_setting','paypal_enable')" >

                  @endif
                </div>
              </div>

            </div>
          </div>

          {{Form::close()}}
        </div>


        <!-- ........................... -->

        <div class="tab-pane fade show" id="id_tab_stripe" role="tabpanel" aria-labelledby="tab_stripe">

         {!!Form::open(['url'=>['admin/google_setting'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}


         <div class="card table-content">
          <div class="card-header" style="background-color:#ccc;">
            <div class="row">
              <div class="col-md-6">
                <h4>Google Login Settings</h4>
              </div>
              <div class="col-md-6">

              </div>

            </div>
          </div>

          <div class="card-content" style="padding:20px">
           <div class="form-row">


            <div class="form-group col-md-8 ">                        
              <label for="">Client ID:</label>
              <input name="GOOGLE_CLIENT_ID" type="text" placeholder="enter client ID"
              class="form-control" value="{{ env('GOOGLE_CLIENT_ID') }}">
            </div>

            <div class="form-group col-md-8 ">                        
              <label for="">Client Secret Key:</label>
              <input type="password" name="GOOGLE_CLIENT_SECRET"
              value="{{ env('GOOGLE_CLIENT_SECRET') }}" placeholder="enter secret key"
              class="form-control" id="gsecret">

            </div>

            <div class="form-group col-md-8 ">                        
              <label for="">Callback URL:</label>
              <div class="input-group">
                <input type="text" placeholder="https://yoursite.com/login/public/google/callback"
                name="GOOGLE_CALLBACK_URL" value=""
                class="callback-url form-control">
                <span class="input-group-addon" id="basic-addon2">
                  <button title="Copy" type="button" class="copy btn btn-xs btn-default">
                    <i class="fa fa-clipboard" aria-hidden="true"></i>
                  </button>
                </span>
              </div>
              <small class="text-muted">
                <i class="fa fa-question-circle"></i> Copy the callback url and paste in your app
              </small>
            </div>


            <div class="form-group col-md-5 ">                        
             <button type="submit" class="btn full btn-primary">Save Setting</button>

           </div>

           <div class="form-group col-md-4 ">     
            @if($configs->stripe_enable==1)   

            <input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="Deactive" name="stripe_enable" data-onstyle="success" data-offstyle="danger" id="paypal_status_setting" class="checkstatus_1" onchange="updateStatusToggle('paypal_status_setting','stripe_enable')" >

            @else
            <input type="checkbox"  data-toggle="toggle" data-on="Active" data-off="Deactive" name="stripe_enable" data-onstyle="success" data-offstyle="danger" id="paypal_status_setting" class="checkstatus_1" onchange="updateStatusToggle('paypal_status_setting','stripe_enable')" >

            @endif
          </div>


        </div>

      </div>
    </div>

    {{Form::close()}}
  </div>



  <!-- ........................... -->

  <div class="tab-pane fade show" id="id_tab_paytm" role="tabpanel" aria-labelledby="tab_paytm">
    {!!Form::open(['url'=>['admin/twitter_setting'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}


    <div class="card table-content">
      <div class="card-header" style="background-color:#ccc;">
        <div class="row">
          <div class="col-md-6">
            <h4>Twitter Login Settings</h4>
          </div>
          <div class="col-md-6">

          </div>

        </div>
      </div>

      <div class="card-content" style="padding:20px">
       <div class="form-row">


        <div class="form-group col-md-8 ">                        
          <label for="">Client ID:</label>
          <input type="text" placeholder="enter client ID" class="form-control"
          name="TWITTER_API_KEY" value="{{ env('TWITTER_API_KEY') }}">
        </div>

        <div class="form-group col-md-8 ">                        
          <label for="">Client Secret Key:</label>
          <input type="password" placeholder="enter secret key" class="form-control"
          id="tw_secret" name="TWITTER_SECRET_KEY"
          value="{{ env('TWITTER_SECRET_KEY') }}">

        </div>

        <div class="form-group col-md-8 ">                        
          <label for="">Callback URL:</label>
          <div class="input-group">
            <input value="" type="text"
            placeholder="https://yoursite.com/public/login/twitter/callback"
            name="FB_CALLBACK_URL" value="{{ env('FB_CALLBACK_URL') }}"
            class="callback-url form-control">
            <span class="input-group-addon" id="basic-addon2">
              <button title="Copy" type="button" class="copy btn btn-xs btn-default">
                <i class="fa fa-clipboard" aria-hidden="true"></i>
              </button>
            </span>
          </div>
          <small class="text-muted">
            <i class="fa fa-question-circle"></i> Copy the callback url and paste in your app
          </small>
        </div>
        <div class="form-group col-md-5 ">                        
         <button type="submit" class="btn full btn-primary">Save</button>

       </div>

       <div class="form-group col-md-4 ">     
        @if($configs->paytm_enable==1)   

        <input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="Deactive" name="paytm_enable" data-onstyle="success" data-offstyle="danger" id="paypal_status_setting" class="checkstatus_1" onchange="updateStatusToggle('paypal_status_setting','paytm_enable')" >

        @else
        <input type="checkbox"  data-toggle="toggle" data-on="Active" data-off="Deactive" name="paytm_enable" data-onstyle="success" data-offstyle="danger" id="paypal_status_setting" class="checkstatus_1" onchange="updateStatusToggle('paypal_status_setting','paytm_enable')" >

        @endif
      </div>


    </div>

  </div>
</div>

{{Form::close()}}
</div>

<!-- ........................... -->

<div class="tab-pane fade show" id="id_tab_razorPay" role="tabpanel" aria-labelledby="tab_razorPay">
 {!!Form::open(['url'=>['admin/amazon_setting'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}


 <div class="card table-content">
  <div class="card-header" style="background-color:#ccc;">
    <div class="row">
      <div class="col-md-6">
        <h4>Amazon Login Settings</h4>
      </div>
      <div class="col-md-6">

      </div>

    </div>
  </div>

  <div class="card-content" style="padding:20px">
   <div class="form-row">


    <div class="form-group col-md-8 ">                        
     <label for="">Client ID:</label>
     <input type="text" placeholder="enter client ID" class="form-control"
     name="AMAZON_LOGIN_ID" value="{{ env('AMAZON_LOGIN_ID') }}">
   </div>

   <div class="form-group col-md-8 ">                        
    <label for="">Client Secret Key:</label>
    <input type="password" placeholder="enter secret key" class="form-control"
    id="amz_secret" name="AMAZON_LOGIN_SECRET"
    value="{{ env('AMAZON_LOGIN_SECRET') }}">
  </div>

  <div class="form-group col-md-8 ">                        
    <label for="">Callback URL:</label>
    <div class="input-group">
      <input value="" type="text"
      placeholder="https://yoursite.com/public/login/amazon/callback"
      name="AMAZON_LOGIN_CALLBACK" value="{{ env('AMAZON_LOGIN_CALLBACK') }}"
      class="callback-url form-control">
      <span class="input-group-addon" id="basic-addon2">
        <button title="Copy" type="button" class="copy btn btn-xs btn-default">
          <i class="fa fa-clipboard" aria-hidden="true"></i>
        </button>
      </span>
    </div>
    <small class="text-muted">
      <i class="fa fa-question-circle"></i> Copy the callback url and paste in your app
    </small>
  </div>
  <div class="form-group col-md-5 ">                        
   <button type="submit" class="btn full btn-primary">Save</button>

 </div>

 <div class="form-group col-md-4 ">     
  @if($configs->razorpay==1)   

  <input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="Deactive" name="razorpay" data-onstyle="success" data-offstyle="danger" id="paypal_status_setting" class="checkstatus_1" onchange="updateStatusToggle('paypal_status_setting','razorpay')" >

  @else
  <input type="checkbox"  data-toggle="toggle" data-on="Active" data-off="Deactive" name="razorpay" data-onstyle="success" data-offstyle="danger" id="paypal_status_setting" class="checkstatus_1" onchange="updateStatusToggle('paypal_status_setting','razorpay')" >

  @endif
</div>


</div>

</div>
</div>

{{Form::close()}}
</div>


<!-- ........................... -->

<div class="tab-pane fade show" id="id_tab_skrill" role="tabpanel" aria-labelledby="tab_skrill">

 {!!Form::open(['url'=>['admin/gitlab_setting'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}


 <div class="card table-content">
  <div class="card-header" style="background-color:#ccc;">
    <div class="row">
      <div class="col-md-6">
        <h4>Gitlab Login Settings</h4>
      </div>
      <div class="col-md-6">

      </div>

    </div>
  </div>

  <div class="card-content" style="padding:20px">


    <div class="form-row">


      <div class="form-group col-md-8 ">                        
        <label for="">Gitlab Client ID:</label>
        <input type="text" placeholder="enter gitlab client ID" class="form-control"
        name="GITLAB_CLIENT_ID" value="{{ env('GITLAB_CLIENT_ID') }}">
      </div>

      <div class="form-group col-md-8 ">                        
       <label for="">Gitlab Client Secret Key:</label>
       <input type="password" placeholder="enter gitlab client secret key"
       class="form-control" id="gitlab_secret" name="GITLAB_CLIENT_SECRET"
       value="{{ env('GITLAB_CLIENT_SECRET') }}">

     </div>
     <div class="form-group col-md-8 ">                        
      <label for="">Gitlab Callback URL:</label>
      <div class="input-group">
        <input type="text" placeholder="https://yoursite.com/public/login/gitlab/callback"
        name="GITLAB_CALLBACK_URL" value=""
        class="callback-url form-control">
        <span class="input-group-addon" id="basic-addon2">
          <button title="Copy" type="button" class="copy btn btn-xs btn-default">
            <i class="fa fa-clipboard" aria-hidden="true"></i>
          </button>
        </span>

      </div>
      <small class="text-muted">
        <i class="fa fa-question-circle"></i> Copy the callback url and paste in your app
      </small>
    </div>

    <div class="form-group col-md-5 ">                        
     <button type="submit" class="btn full btn-primary">Save</button>

   </div>

   <div class="form-group col-md-4 ">     
    @if($configs->skrill_enable==1)   

    <input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="Deactive" name="skrill_enable" data-onstyle="success" data-offstyle="danger" id="paypal_status_setting" class="checkstatus_1" onchange="updateStatusToggle('paypal_status_setting','skrill_enable')" >

    @else
    <input type="checkbox"  data-toggle="toggle" data-on="Active" data-off="Deactive" name="skrill_enable" data-onstyle="success" data-offstyle="danger" id="paypal_status_setting" class="checkstatus_1" onchange="updateStatusToggle('paypal_status_setting','skrill_enable')" >

    @endif
  </div>


</div>

</div>
</div>

{{Form::close()}}
</div>

<!-- ........................... -->

<div class="tab-pane fade show" id="id_tab_braintree" role="tabpanel" aria-labelledby="tab_braintree">
 {!!Form::open(['url'=>['admin/linkedin_setting'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}


 <div class="card table-content">
  <div class="card-header" style="background-color:#ccc;">
    <div class="row">
      <div class="col-md-6">
        <h4>Linkedin Login Settings</h4>
      </div>
      <div class="col-md-6">

      </div>

    </div>
  </div>

  <div class="card-content" style="padding:20px">
   <div class="form-row">


    <div class="form-group col-md-8 ">                        
      <label for="">LINKEDIN Client ID:</label>
      <input type="text" placeholder="enter gitlab client ID" class="form-control"
      name="LINKEDIN_CLIENT_ID" value="{{ env('LINKEDIN_CLIENT_ID') }}">
    </div>

    <div class="form-group col-md-8 ">                        
      <label for="">LINKEDIN  Client Secret Key:</label>
      <input type="password" placeholder="enter LINKEDIN  client secret key"
      class="form-control" id="LINKEDIN_SECRET" name="LINKEDIN_SECRET"
      value="{{ env('LINKEDIN_SECRET') }}">
    </div>

    <div class="form-group col-md-8 ">                        
      
        <label for="">LINKEDIN Callback URL:</label>
        <div class="input-group">
          <input type="text" placeholder="https://yoursite.com/public/login/linkedin/callback"
          name="LINKEDIN_CALLBACK" value=""
          class="callback-url form-control">
          <span class="input-group-addon" id="basic-addon2">
            <button title="Copy" type="button" class="copy btn btn-xs btn-default">
              <i class="fa fa-clipboard" aria-hidden="true"></i>
            </button>
          </span>

        </div>
        <small class="text-muted">
          <i class="fa fa-question-circle"></i> Copy the callback url and paste in your app
        </small>

      </div>

      
      <div class="form-group col-md-5 ">                        
       <button type="submit" class="btn full btn-primary">Save</button>

     </div>

     <div class="form-group col-md-4 ">     
      @if($configs->braintree_enable==1)   

      <input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="Deactive" name="braintree_enable" data-onstyle="success" data-offstyle="danger" id="paypal_status_setting" class="checkstatus_1" onchange="updateStatusToggle('paypal_status_setting','braintree_enable')" >

      @else
      <input type="checkbox"  data-toggle="toggle" data-on="Active" data-off="Deactive" name="braintree_enable" data-onstyle="success" data-offstyle="danger" id="paypal_status_setting" class="checkstatus_1" onchange="updateStatusToggle('paypal_status_setting','braintree_enable')" >

      @endif
    </div>


  </div>

</div>
</div>

{{Form::close()}}
</div>

<!-- ........................... -->


<!-- ............ -->
</div>
</div>
</div>

<!-- .......end......... -->
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

 function updateStatusToggle(type,value) {

     // alert("{{url('admin/')}}/"+type+"?name="+value)
     $.ajax({
       type:"GET",
       url:"{{url('admin/')}}/"+type+"?name="+value,
       dataType: 'json',
       success:function(res){ 

        console.log(res)         
        var data= "your status is "+res;



        var message = data;
        var title = $('#toastr-title').val() || '';

        var type = 'success';

        toastr[type](message, title, {
          positionClass: $('input[name="toastr-position"]:checked').val(),
          closeButton: 'true',
          progressBar:'true',
          newestOnTop: 'true',
          rtl: $('body').attr('dir') === 'rtl' || $('html').attr('dir') === 'rtl',
          timeOut: $('#toastr-duration').val()
        });


      }
    });
   };


   $(document).ready(function() {

 $('.password_contact').on('click','.toggle-password', function(){
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
   });

 </script>
 @endpush