@extends('admin.layouts.app')
@section('title',"Payment setting | Admin Mande Clan")

<!-- ................custom css................. -->

@section('customStyle')
<style type="text/css">
.nav-stacked>li {
  border-bottom: 1px solid #f4f4f4;
  margin: 0;
}
.nav>li>a {
  color: #157ed2;
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

.field-icon {
  float: right;
  margin-left: -25px;
  margin-top: -25px;
  position: relative;
  z-index: 2;
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
      <h1 class="h3 mb-3">Payment Settings
      </h1>
    </div>

    <div class="card">
      <div class="card-body password_contact">

        <div class="row">
          <div class="col-md-4 mb-3">
            <ul class="nav nav-pills flex-column" id="myTab" role="tablist">
              <!-- ......... -->

              <li class="nav-item">
                <a class="nav-link" id="tab_paypal" data-toggle="tab" href="#id_tab_paypal" role="tab" aria-controls="id_tab_paypal" aria-selected="true">    <i class="fa fa-circle {{ $configs->paypal_enable==1 ? "text-green" : "text-red" }}"" ></i>
                Paypal Payment Settings </a>
              </li>

              <!-- ......... -->

              <li class="nav-item">
                <a class="nav-link  {{ $configs->stripe_enable==1 ? "Active" : "Deactive" }}" id="tab_stripe" data-toggle="tab" href="#id_tab_stripe" role="tab" aria-controls="id_tab_stripe" aria-selected="true"><i class="fa fa-circle {{ $configs->stripe_enable==1 ? "text-green" : "text-red" }}"" ></i>Stripe Payment Settings</a>
              </li>


              <!-- ......... -->
{{-- 
              <li class="nav-item">
                <a class="nav-link " id="tab_paytm" data-toggle="tab" href="#id_tab_paytm" role="tab" aria-controls="id_tab_paytm" aria-selected="true">   <i class="fa fa-circle {{ $configs->paytm_enable==1 ? "text-green" : "text-red" }}"" ></i>Paytm API Setting</a>
              </li>


              <!-- ......... -->

              <li class="nav-item">
                <a class="nav-link " id="tab_razorPay" data-toggle="tab" href="#id_tab_razorPay" role="tab" aria-controls="id_tab_razorPay" aria-selected="true">   <i class="fa fa-circle {{ $configs->razorpay==1 ? "text-green" : "text-red" }}"" ></i>RazorPay API Setting</a>
              </li>


              <!-- ......... -->

              <li class="nav-item">
                <a class="nav-link " id="tab_skrill" data-toggle="tab" href="#id_tab_skrill" role="tab" aria-controls="id_tab_skrill" aria-selected="true">   <i class="fa fa-circle {{ $configs->skrill_enable==1 ? "text-green" : "text-red" }}"" ></i>Skrill Payment Settings</a>
              </li>


              <!-- ......... -->

              <li class="nav-item">
                <a class="nav-link " id="tab_braintree" data-toggle="tab" href="#id_tab_braintree" role="tab" aria-controls="id_tab_braintree" aria-selected="true">   <i class="fa fa-circle {{ $configs->braintree_enable==1 ? "text-green" : "text-red" }}"" ></i>Braintree Payment Settings</a>
              </li>


              <!-- ......... -->

              <li class="nav-item">
                <a class="nav-link " id="tab_bank" data-toggle="tab" href="#id_tab_bank" role="tab" aria-controls="id_tab_bank" aria-selected="true">Bank Payment Settings
                </a>
              </li> --}}


              <!-- ......... -->

            </ul>
          </div>
          <!-- .................................. -->
          <div class="col-md-8">
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="id_tab_paypal" role="tabpanel" aria-labelledby="tab_paypal">

                {!!Form::open(['url'=>['admin/savePaypal'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}


                <div class="card table-content">
                  <div class="card-header" style="background-color:#ccc;">
                    <div class="row">
                      <div class="col-md-6">
                        <h4>Paypal Payment Settings</h4>
                      </div>
                      <div class="col-md-6">
                        <div class="pull-right" style="text-align: right;">
                          <a target="__blank"
                          title="Get Your Keys From here"
                          href="https://developer.paypal.com/home/" style="color:#fff" > <i class="fa fa-key"
                          aria-hidden="true"></i> Get Your Keys From here</a>
                        </div>
                      </div>

                    </div>
                  </div>

                  <div class="card-content" style="padding:20px">
                   <div class="form-row">

                    <div class="form-group col-md-8 ">                        
                      <label for="PAYPAL_CLIENT_ID">PAYPAL CLIENT ID :</label>
                      <input type="text" name="PAYPAL_CLIENT_ID"
                      value="{{ env('PAYPAL_CLIENT_ID') }}" class="form-control">
                    </div>

                    <div class="form-group col-md-8 ">                        
                     <label for="PAYPAL_SECRET">PAYPAL SECRET ID :</label>
                     <input type="text" value="{{ env('PAYPAL_SECRET') }}"
                     name="PAYPAL_SECRET" id="pps" class="form-control" id="paypl_secret">

                     <span toggle="#pps" class="fa fa-fw fa-eye field-icon toggle-password"></span>


                   </div>



                   <div class="form-group col-md-8 ">                        
                     <label for="MAIL_ENCRYPTION">PAYPAL MODE :</label>
                     <input type="text" value="{{ env('PAYPAL_MODE') }}" name="PAYPAL_MODE"
                     class="form-control">
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
            @if(!empty($record))
            {!! Form::model($record,array('url' => ['admin/stripe_setting', $record->id],'method'=>'PATCH','class'=>'','id' =>'comman_form_id','files'=>'true')) !!}
            @else
            {!!Form::open(['url'=>['admin/stripe_setting'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}

            @endif

            <div class="card table-content">
              <div class="card-header" style="background-color:#ccc;">
                <div class="row">
                  <div class="col-md-6">
                    <h4>Stripe Payment Settings</h4>
                  </div>
                  <div class="col-md-6">
                    <div class="pull-right" style="text-align: right;">
                      <a target="__blank"
                      title="Get Your Keys From here"
                      href="https://developer.paypal.com/home/"> <i class="fa fa-key"
                      aria-hidden="true"></i> Get Your Keys From here</a>
                    </div>
                  </div>

                </div>
              </div>

              <div class="card-content" style="padding:20px">
               <div class="form-row">


                <div class="form-group col-md-8 ">                        
                  <label for="MAIL_FROM_NAME">STRIPE KEY :</label>
                  <input type="text" name="STRIPE_KEY" value="{{  env('STRIPE_KEY') }}"
                  class="form-control">
                </div>

                <div class="form-group col-md-8 ">                        
                  <label for="MAIL_FROM_ADDRESS">STRIPE SECRET :</label>
                  <input type="text" name="STRIPE_SECRET"
                  value="{{ env('STRIPE_SECRET') }}" class="form-control" id="strip_sec">
                </div>


                <div class="form-group col-md-5 ">                        
                 <button type="submit" class="btn full btn-primary">Save</button>

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
        @if(!empty($record))
        {!! Form::model($record,array('url' => ['admin/paytm_setting', $record->id],'method'=>'PATCH','class'=>'','id' =>'comman_form_id','files'=>'true')) !!}
        @else
        {!!Form::open(['url'=>['admin/paytm_setting'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}

        @endif

        <div class="card table-content">
          <div class="card-header" style="background-color:#ccc;">
            <div class="row">
              <div class="col-md-6">
                <h4>Paytm API Setting</h4>
              </div>
              <div class="col-md-6">
                <div class="pull-right" style="text-align: right;">
                  <a target="__blank"
                  title="Get Your Keys From here" href="https://developer.paytm.com/docs/"><i
                  class="fa fa-key" aria-hidden="true"></i> Get Your Keys From here</a>
                </div>
              </div>

            </div>
          </div>

          <div class="card-content" style="padding:20px">
           <div class="form-row">


            <div class="form-group col-md-8 ">                        
              <label for="PAYTM_ENVIRONMENT"> PAYTM ENVIRONMENT: <span
                class="required">*</span></label>
                <input type="text" value="{{ env('PAYTM_ENVIRONMENT') }}"
                name="PAYTM_ENVIRONMENT" id="PAYTM_ENVIRONMENT" 
                class="form-control">
              </div>

              <div class="form-group col-md-8 ">                        
               <label for="PAYTM_MERCHANT_ID">PAYTM MERCHANT ID: <span
                class="required">*</span></label>
                <input  value="{{ env('PAYTM_MERCHANT_ID') }}"
                name="PAYTM_MERCHANT_ID" id="PAYTM_MERCHANT_ID" type="text"
                class="form-control">
              </div>

              <div class="form-group col-md-8 ">                        
               <label for="PAYTM_MERCHANT_KEY">PAYTM MERCHANT KEY: <span
                class="required">*</span></label>
                <input  value="{{ env('PAYTM_MERCHANT_KEY') }}"
                name="PAYTM_MERCHANT_KEY" id="PAYTM_MERCHANT_KEY" type="text"
                class="form-control">
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
      @if(!empty($record))
      {!! Form::model($record,array('url' => ['admin/razorpay_setting', $record->id],'method'=>'PATCH','class'=>'','id' =>'comman_form_id','files'=>'true')) !!}
      @else
      {!!Form::open(['url'=>['admin/razorpay_setting'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}

      @endif

      <div class="card table-content">
        <div class="card-header" style="background-color:#ccc;">
          <div class="row">
            <div class="col-md-6">
              <h4>RazorPay API Setting</h4>
            </div>
            <div class="col-md-6">
              <div class="pull-right" style="text-align: right;">
               <a target="__blank"
               title="Get Your Keys From here" href="https://razorpay.com/docs/"><i
               class="fa fa-key" aria-hidden="true"></i> Get Your Keys From here</a>
             </div>
           </div>

         </div>
       </div>

       <div class="card-content" style="padding:20px">
         <div class="form-row">


          <div class="form-group col-md-8 ">                        
            <label for="RAZOR_PAY_KEY"> RazorPay Key: <span
              class="required">*</span></label>
              <input type="text" value="{{ env('RAZOR_PAY_KEY') }}"
              name="RAZOR_PAY_KEY" id="RAZOR_PAY_KEY" 
              class="form-control">
            </div>

            <div class="form-group col-md-8 ">                        
              <label for="RAZOR_PAY_SECRET"> RazorPay Secret Key: <span
                class="required">*</span></label>
                <input  value="{{ env('RAZOR_PAY_SECRET') }}"
                name="RAZOR_PAY_SECRET" id="RAZOR_PAY_SECRET" type="text"
                class="form-control">
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
      @if(!empty($record))
      {!! Form::model($record,array('url' => ['admin/skrill_setting', $record->id],'method'=>'PATCH','class'=>'','id' =>'comman_form_id','files'=>'true')) !!}
      @else
      {!!Form::open(['url'=>['admin/skrill_setting'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}

      @endif

      <div class="card table-content">
        <div class="card-header" style="background-color:#ccc;">
          <div class="row">
            <div class="col-md-6">
              <h4>Skrill Payment Settings</h4>
            </div>
            <div class="col-md-6">
              <div class="pull-right" style="text-align: right;">
                <a target="__blank" title="Get Your Keys From here"
                href="https://www.skrill.com/fileadmin/content/pdf/Skrill_Quick_Checkout_Guide.pdf"><i class="fa fa-key"
                aria-hidden="true"></i> Get Your Keys From here</a>
              </div>
            </div>

          </div>
        </div>

        <div class="card-content" style="padding:20px">

          <div class="alert alert-success">
            <p><i class="fa fa-info-circle"></i> Important Note:</p>
            <ul>
             <li>
              Skrill recommends that you open a merchant test account to help you become familiar with the Automated Payments Interface. Test accounts operate in the live environment, but funds cannot be sent from a test account to a live account.


            </li>
            <li>
              To obtain a test account, please register a personal account at   <a href="http://www.skrill.com" target="__blank">http://www.skrill.com</a>  , and then contact the Merchant Services team with the account details so that they can enable it.
            </li>
          </ul>
        </div>

        <div class="form-row">


          <div class="form-group col-md-8 ">                        
           <label for="my-input">SKRILL MERCHANT EMAIL: <span
            class="text-danger">*</span></label>
            <input value="{{ env('SKRILL_MERCHANT_EMAIL') }}" id="my-input"
            class="form-control" type="text" name="SKRILL_MERCHANT_EMAIL">
          </div>

          <div class="form-group col-md-8 ">                        
            <label for="my-input">SKRILL API PASSWORD: <span
              class="text-danger">*</span></label>
              <input id="SKRILL_API_PASSWORD" class="form-control" type="text"
              name="SKRILL_API_PASSWORD" value="{{ env('SKRILL_API_PASSWORD') }}">

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
    @if(!empty($record))
    {!! Form::model($record,array('url' => ['admin/braintree_setting', $record->id],'method'=>'PATCH','class'=>'','id' =>'comman_form_id','files'=>'true')) !!}
    @else
    {!!Form::open(['url'=>['admin/braintree_setting'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}

    @endif

    <div class="card table-content">
      <div class="card-header" style="background-color:#ccc;">
        <div class="row">
          <div class="col-md-6">
            <h4>Braintree Payment Settings</h4>
          </div>
          <div class="col-md-6">
            <div class="pull-right" style="text-align: right;">
              <a target="__blank"
              title="Get Your Keys From here"
              href="https://developers.braintreepayments.com/"><i class="fa fa-key"
              aria-hidden="true"></i> Get Your Keys From here</a>
            </div>
          </div>

        </div>
      </div>

      <div class="card-content" style="padding:20px">
       <div class="form-row">


        <div class="form-group col-md-8 ">                        
         <label for="BRAINTREE_ENV">BRAINTREE ENVIRONMENT :</label>
         <input type="text" name="BRAINTREE_ENV" value="{{  env('BRAINTREE_ENV') }}"
         class="form-control">
       </div>

       <div class="form-group col-md-8 ">                        
         <label for="BRAINTREE_MERCHANT_ID">BRAINTREE MERCHANT ID :</label>
         <input type="text" name="BRAINTREE_MERCHANT_ID"
         value="{{  env('BRAINTREE_MERCHANT_ID') }}" class="form-control">
       </div>

       <div class="form-group col-md-8 ">                        
         <label for="BRAINTREE_MERCHANT_ID">BRAINTREE MERCHANT ACCOUNT ID :</label>
         <input type="text" name="BRAINTREE_MERCHANT_ACCOUNT_ID"
         value="{{  env('BRAINTREE_MERCHANT_ACCOUNT_ID') }}"
         class="form-control">

         <small class="text-muted"><i class="fa fa-question-circle"></i> Enter your
          <a target="__blank"
          href="https://articles.braintreepayments.com/control-panel/important-gateway-credentials#merchant-account-id-versus-merchant-id">BRAINTREE
        MERCHANT ACCOUNT ID</a> Key</small>
      </div>

      <div class="form-group col-md-8 ">                        
       <label for="BRAINTREE_PUBLIC_KEY">BRAINTREE PUBLIC KEY :</label>
       <input type="text" name="BRAINTREE_PUBLIC_KEY"
       value="{{ env('BRAINTREE_PUBLIC_KEY') }}" class="form-control"
       id="BRAINTREE_PUBLIC_KEY">
     </div>

     <div class="form-group col-md-8 ">        
       <label for="BRAINTREE_PRIVATE_KEY">BRAINTREE PRIVATE KEY :</label>
       <input type="text" name="BRAINTREE_PRIVATE_KEY"
       value="{{ env('BRAINTREE_PRIVATE_KEY') }}" class="form-control"
       id="BRAINTREE_PRIVATE_KEY">
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

<div class="tab-pane fade show" id="id_tab_bank" role="tabpanel" aria-labelledby="tab_bank">
  @if(!empty($bank_detail))
  {!! Form::model($bank_detail,array('url' => ['admin/bank_details', $bank_detail->id],'method'=>'PATCH','class'=>'','id' =>'comman_form_id','files'=>'true')) !!}
  @else
  {!!Form::open(['url'=>['admin/bank_details'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}

  @endif

  <div class="card table-content">
    <div class="card-header" style="background-color:#ccc;">
      <div class="row">
        <div class="col-md-6">
          <h4>Bank Payment Settings</h4>
        </div>
        <div class="col-md-6">

        </div>

      </div>
    </div>

    <div class="card-content" style="padding:20px">
     <div class="form-row">
      <div class="form-group col-md-8 ">                        
       <label>
        Bank Name <span class="text-red">*</span>
      </label>
         {!!Form::text('bankname',null,array('class'=>'form-control','placeholder'=>'Enter bank name','autocomplete'=>'off','required')) !!} 
    </div>

    <div class="form-group col-md-8 ">                        
      <label>
        Branch Name <span class="text-red">*</span>
      </label>

         {!!Form::text('branchname',null,array('class'=>'form-control','placeholder'=>'Enter branch name','autocomplete'=>'off','required')) !!} 

    </div>

    <div class="form-group col-md-8 ">                        
      <label>
        IFSC Code <span class="text-red">*</span>
      </label>

         {!!Form::text('ifsc',null,array('class'=>'form-control','placeholder'=>'Enter IFSC code','autocomplete'=>'off','required')) !!} 

    </div>

    <div class="form-group col-md-8 ">                        
      <label>
        Account Number <span class="text-red">*</span>
      </label>

         {!!Form::text('account',null,array('class'=>'form-control','placeholder'=>'Enter account no','autocomplete'=>'off','required')) !!} 


     <!--  <input placeholder="Enter account no." type="text" id="first-name"
      name="account" class="form-control col-md-7 col-xs-12"
      value="{{$bank->account ?? ''}}"> -->
    </div>

    <div class="form-group col-md-8 ">                        
     <label>
      Account Name <span class="text-red">*</span>
    </label>

         {!!Form::text('acountname',null,array('class'=>'form-control','placeholder'=>'Enter account name','autocomplete'=>'off','required')) !!} 


  </div>

  <div class="form-group col-md-5 ">                        
   <button type="submit" class="btn full btn-primary">Save</button>

 </div>

 <div class="form-group col-md-4 ">     
  @if($configs->bank_enable==1)   

  <input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="Deactive" name="bank_enable" data-onstyle="success" data-offstyle="danger" id="bank_status_setting" class="checkstatus_1" onchange="updateStatusToggle('bank_status_setting','bank_enable')" >

  @else
  <input type="checkbox"  data-toggle="toggle" data-on="Active" data-off="Deactive" name="bank_enable" data-onstyle="success" data-offstyle="danger" id="bank_status_setting" class="checkstatus_1" onchange="updateStatusToggle('bank_status_setting','bank_enable')" >

  @endif
</div>
</div>

</div>
</div>

{{Form::close()}}
</div>

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