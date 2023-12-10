@extends('admin.layouts.app')
@section('title',"Payment setting | Admin Mande Clan")

<!-- ................custom css................. -->

@section('customStyle')
<style>
.field_icon {
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
      <h1 class="h3 mb-3">SMS Settings</h1>
    </div>
    <div class="card">
      <div class="card-body">

        <div class="row">
          <div class="form-group col-md-12">


              {{--   <div class="row">
                    <div class="col-md-12  ">
                        <div class="p-2 mb-2 bg-info rounded text-white">
                        <i class="fa fa-info-circle"></i> Default SMS Send By : 
                          {{env('DEFAULT_SMS_CHANNEL')}}
                    </div>
                    </div>
                </div> --}}

                                                     <!-- {!!Form::select('DEFAULT_SMS_CHANNEL',['Twillo'=>'Twillo','MSG-91'=>'MSG-91','MimSMS'=>'MimSMS'],null,array('class'=>'form-control msg_channel select2','placeholder'=>'Select Country','data-toggle'=>'select2','autocomplete'=>'off','required')) !!} -->
     <label for="inputPassword4">SMS</label>
                            {{--  <div class="row">
                              <div class="col-md-2">


                                 <label class="custom-control custom-radio">
<!--                                     {{ Form::radio('DEFAULT_SMS_CHANNEL', 'Twillo' , env('DEFAULT_SMS_CHANNEL'),array('class'=>'custom-control-input msg_channel')) }}
 -->
 <input type="radio"  class ="custom-control-input msg_channel" name="DEFAULT_SMS_CHANNEL" value="Twillo"  {{ (env('DEFAULT_SMS_CHANNEL')=="Twillo")? "checked" : "" }} >
                    <span class="custom-control-label">Twillo</span>
                  </label>                             
                              </div>
                              <div class="col-md-2"> <label class="custom-control custom-radio">
 <input type="radio"  class ="custom-control-input msg_channel" name="DEFAULT_SMS_CHANNEL" value="MSG-91"  {{ (env('DEFAULT_SMS_CHANNEL')=="MSG-91")? "checked" : "" }} >                  <span class="custom-control-label">MSG-91</span>
                  </label></div>
                               

                                 <div class="col-md-2"> <label class="custom-control custom-radio">
 <input type="radio"  class ="custom-control-input msg_channel" name="DEFAULT_SMS_CHANNEL" value="MimSMS"  {{ (env('DEFAULT_SMS_CHANNEL')=="MimSMS")? "checked" : "" }} >                    <span class="custom-control-label">MimSMS</span>
                  </label></div>
                               
                             </div> --}}

          </div>
 <div class="form-group col-md-12">
          <div style="display: block;" id="twilloBox">
    {{-- 
                <div class="row">
                    <div class="col-md-12  ">
                        <div class="p-2 mb-2 bg-success rounded text-white">
                        <i class="fa fa-info-circle"></i> Important note :
                        <ul>
                            <li>Twillo Only send SMS if user did not opt for DND Services.</li>
                            <li>Twillo trail will send sms only to verified no.</li>
                           
                        </ul>
                    </div>
                    </div>
                </div>
 --}}
               
    
                             {!!Form::open(['url'=>['admin/twillo_setting'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}

                      <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-dark">TWILIO SID :<span class="text-danger">*</span></label>
                                <input required name="TWILIO_SID" type="text" value="{{env('TWILIO_SID')}}" class="form-control">
                            </div>
                      </div>
                      <div class="col-md-6">
                         <div class="form-group">
                            <label class="text-dark">TWILIO AUTH TOKEN :<span class="text-danger">*</span></label>
                            <input required name="TWILIO_AUTH_TOKEN" type="text" value="{{env('TWILIO_AUTH_TOKEN')}}" class="form-control">
                         </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label class="text-dark">TWILIO NUMBER :<span class="text-danger">*</span></label>
                            <input required name="TWILIO_NUMBER" type="text" value="{{env('TWILIO_NUMBER')}}" class="form-control">
                        </div>
                     </div>
    
                     <div class="col-md-12">
                        <div class="form-group">
                            <button type="reset" class="btn btn-danger mr-1"><i class="fa fa-ban"></i> Reset</button>
                            <button  type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i> Save</button>
                        </div> 
                     </div>

                  </div>
                {{Form::close()}}
           
            <div style="display: none;" id="msg91Box">
                <div class="row">
                    <div class="col-md-12  ">
                        <div class="p-2 mb-2 bg-success rounded text-white">
                        <i class="fa fa-info-circle"></i> Important note :
                        <ul>
                            <li>MSG91 Only send SMS if user did not opt for DND Services.</li>
                            <li>If msg not delivering to customer than make sure he/she updated phonecode in his/her profile.</li>
                           
                           
                        </ul>
                    </div>
                    </div>
                </div>
           
        
                            {!!Form::open(['url'=>['admin/msg91_setting'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}
      
                    <div class="row">
        
                        <div class="col-md-12">
                            <div class="form-group eyeCy">
                                <label class="text-dark">MSG91 Auth Key :<span class="text-danger">*</span></label>
                                
                                <input id="MSG91_AUTH_KEY" type="text" placeholder="enter secret key" class="form-control"  name="MSG91_AUTH_KEY" value="{{env('MSG91_AUTH_KEY')}}" >
                                
                            </div>
                        </div>
        
                    </div>
        
                   <!--                      <h4>Orders SMS Settings :</h4>
                    <hr>
        
                    <input type="hidden" name="keys" value="orders">
        
                    <div class="row">
                                
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-dark">Enter SENDER ID: (Max char length 6) <span class="text-danger">*</span></label>
                                <input placeholder="eg. SMSIND" maxlength="6" type="text" class="form-control" value=""
                                    name="sender_id">
                            </div>
                        </div>
        
                               
                       <div class="col-md-4">
        
                            <div class="form-group eyeCy">
                                <label class="text-dark">MSG91 Flow ID : <span class="text-danger">*</span></label>
                               
                                <input id="flow_id" type="text" placeholder="Enter secret key" class="form-control"  name="flow_id" value="" >
                              
                            </div>
        
                       </div>
        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-dark">Enable emoji in Msg : <span class="text-danger">*</span></label>
                                <br>
                                 <label class="switch">
                                    <input id="login_unicode" checked type="checkbox" name="unicode[1]">
                                    <span class="knob"></span>
                                </label>
                           <input type="checkbox" checked data-toggle="toggle" data-on="Enable" data-off="Disable" data-onstyle="success" data-offstyle="danger" id="1111" class="checkstatus" name="unicode[1]" onchange="updateToggle(1111)">


                            </div>
                        </div>
                        
                        
                    </div> -->
                            
                    <div class="form-group">
                        <label class="text-dark" for="">Enable MSG91 </label>
                        <br>
                      <!--   <label class="switch">
                            <input id="msg91_enable" checked type="checkbox" name="msg91_enable">
                            <span class="knob"></span>
                        </label>
                        <br>
                        <small class="text-muted">
                            <i class="fa fa-question-circle"></i> Toggle to activate the MSG-91.
                        </small> -->
                <input type="checkbox" checked data-toggle="toggle" data-on="Enable" data-off="Disable" data-onstyle="success" data-offstyle="danger" id="msg91_enable" class="checkstatus" onchange="updateToggle('msg91_setting','msg91_enable')" name="msg91_enable">

                    </div>

                            <div class="form-group">
                                <button type="reset" class="btn btn-danger-rgba mr-1"><i class="fa fa-ban"></i> Reset</button>
                                <button  type="submit" class="btn btn-primary-rgba"><i class="fa fa-check-circle"></i> Save settings</button>
                            </div>
                {{Form::close()}}
            </div>
            
                            <div style="display: none;" id="mimSMSBox">
                                    {!!Form::open(['url'=>['admin/mimsms_setting'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}

                        <div class="form-group">
                            <label class="text-dark">MIM SMS API Key : <span class="text-danger">*</span></label>
                            <input value="qweqqqqqqqqqq" type="text" class="form-control" required name="MIM_SMS_API_KEY">
                        </div>

                        <div class="form-group">
                            <label class="text-dark">MIM SMS SENDER ID : <span class="text-danger">*</span></label>
                            <input value="ewqqqqqqqqqqqqqqqqqqqqqw" type="text" class="form-control" required name="MIM_SMS_SENDER_ID">
                        </div>

                        <div class="form-group">
                            <label class="text-dark">Enable OTP Confirmation on Login / Register : <span class="text-danger">*</span></label>
                            <br>
                          <!--   <label class="switch">
                                <input name="MIM_SMS_OTP_ENABLE" class="MIM_SMS_OTP_ENABLE" id="MIM_SMS_OTP_ENABLE" checked type="checkbox">
                                <span class="knob"></span>
                            </label> -->
                                            <input type="checkbox" checked data-toggle="toggle" data-on="Enable" data-off="Disable" data-onstyle="success" data-offstyle="danger" id="MIM_SMS_OTP_ENABLE" class="checkstatus" onchange="updateToggle('mim_setting','MIM_SMS_OTP_ENABLE')">

                        </div>

                        <!-- Create and reset button -->
                        <div class="form-group">
                            <button type="reset" class="btn btn-danger-rgba mr-1"><i class="fa fa-ban"></i> Reset</button>
                            <button  type="submit" class="btn btn-primary-rgba"><i class="fa fa-check-circle"></i> Save settings</button>
                        </div>
                      
                    {{Form::close()}}
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


<!-- 
<script>
    var sms_channel = function () {
        if ($("#location_check_id").is(":checked")) {
            $("#work_location").hide();

        }else{
            $("#work_location").show();
        }
        
    };
    $(sms_channel);
    $("#location_check_id").change(sms_channel);
</script>
 -->

 <script>


        // $('.msg_channel').on('change',function(){
             var sms_channel = function () {

            var val = $('.msg_channel:checked').val();

// alert(val)
            if(val == 'Twillo'){
                $('#twilloBox').show();
                $('#msg91Box').hide();
                $('#mimSMSBox').hide();
            }else if(val == 'MSG-91'){
                $('#twilloBox').hide();
                $('#msg91Box').show();
                $('#mimSMSBox').hide();
            }else if(val == 'MimSMS'){
                $('#mimSMSBox').show();
                $('#twilloBox').hide();
                $('#msg91Box').hide();
            }

            // axios.post("{{url('admin/default_sms_channel')}}",{
            //     channel : val
            // }).then(res => {
            //     console.log(res.data);
            // }).catch(err => console.log(err));

// alert(val)
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

               $.ajax({
          url: "{{url('admin/default_sms_channel')}}",
          type: "post",
          data: {_token: CSRF_TOKEN,channel:val},
                    dataType: "json",
                    success:function(res) {
                  console.log(res.data);
                }

                });

        };


$(sms_channel);
    $(".msg_channel").change(sms_channel);

  

 function updateToggle(type,value) {

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


    
 </script>
 @endpush