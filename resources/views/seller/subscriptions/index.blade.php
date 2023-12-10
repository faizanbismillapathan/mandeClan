@extends('seller.layouts.app')
@section('title',"Create New Subscriptions | seller  Mande Clan")

<!-- ................custom css................. -->

@section('customStyle')
<style type="text/css">
    h1 {
     color: #000; 
     margin-bottom: 10px; 
     font-size: 30px;
}

.period {
    font-size: 18px;
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
   {{--  <a href="{{url('seller/subscriptions')}}" class="form-inline float-right mt--1 d-none d-md-flex">
    <button class="btn btn-info"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Back</button>
    </a> --}}

        <h1 class="h3 mb-3"><b>Subscription Plan</b></h1>

                    </div>
                                <div class="card">
                                
<div class="card-body">
     <!-- ..............-->
 <div class="row">
    <div class="col-md-4">
      <div class="row">
        <div class="col-md-6">
          <b>Current Package</b>
        </div>
        <div class="col-md-6">
         @if(!empty($inform->store_plan_name))
          <span>{{$inform->store_plan_name}}</span>

          <input type="hidden" name="id" value="{{$inform->id}}" id="purchase_plan_id">

          @else
<span>Free</span>
          @endif
        </div>        
      </div>
    </div>

    <div class="col-md-3">
      <div class="row">
        <div class="col-md-6">
          <b>Purchase Date</b>
        </div>
        <div class="col-md-6">
          @if(!empty($inform->created_at))
          <span><?php echo date("d-m-Y", strtotime($inform->created_at)); 
     ?></span>
          @else
<span>------</span>
          @endif
        </div>        
      </div>
    </div>

    <div class="col-md-3">
        <div class="row">
        <div class="col-md-6">
          <b>Valid Untill</b>
        </div>
        <div class="col-md-6">
            @if(!empty($inform->plan_expiry_date))
          <span><?php echo date("d-m-Y", strtotime($inform->plan_expiry_date)); 
      ?></span>
          @else
<span>------</span>
          @endif
        </div>        
      </div>
    </div>

      <div class="col-md-2">
        <div class="row">
        <div class="col-md-6">
          <b>Status</b>
        </div>
        <div class="col-md-6">
            @if(!empty($inform->plan_status))
          <span class="badge badge-info">{{$inform->plan_status}}</span>
          @else
<span>------</span>
          @endif
        </div>        
      </div>
    </div>


       
  </div>
<div class="body-content">

    <div class="container">
        
        <section class="pricing my-5 py-5 ">
            <div class="container-fluid">
                <div class="row">
                    @if(!empty($store_plans))
                    @foreach($store_plans as $index=>$data)
                <div class="mt-3 col-lg-4">
                <div class="card border rounded border-rounded mb-5">
@if( !empty($inform) && $inform->store_plan_name==$data->store_plan_name && $inform->plan_status=='Active')            
                <div class="card-body " style="background-color: #fff2b3 ">

                                    @else
                <div class="card-body" style="background-color : #ececece8">

                                    @endif
    <h3 style="font-size: 23px;" class="card-title text-uppercase text-center pb-3 my-3 text-primary">
                                        {{$data->store_plan_name}} 
                </h3>
 <h1 class="display-5 text-center text-white bg-primary p-3"> <i class="fas fa-dollar-sign text-white"></i> {{$data->store_plan_price}} <span class="period"> / {{$data->store_plan_validity}} Days</span></h1>
                                    <hr>
                                    {!!$data->store_plan_features!!}
                   
</div>
                   @if(!empty($inform))                 
@if($inform->store_plan_name==$data->store_plan_name && $inform->plan_status=='Active')            

<div class="card-footer" style="background-color : #fff2b3">
<button type="button" class="btn btn-block btn-success text-uppercase m-1"  data-toggle="modal" data="{{$data->id}}" data-target="#UnSubscribealertmesg">
<i class="fa fa-check-circle"> </i> UnSubscribe</button>
    </div>
    @else
<div class="card-footer" style="background-color : #ececece8">
      <button type="submit"  data-toggle="modal" data="{{$data->id}}" data-target="#alertmesg" class="btn btn-block btn-primary text-uppercase m-1">Subscribe</button>          
</div>
@endif
@else
<div class="card-footer" style="background-color : #ececece8">
  <button type="submit"  data-toggle="modal" data="{{$data->id}}" data-target="#defaultModalPrimary1" class="btn btn-block btn-primary text-uppercase purchase_plan_modal m-1" plan_id="{{$data->id}}" totalAmount="{{$data->store_plan_price}}">Subscribe   </button>
</div>
  @endif
                                                                            
                                    
                                
                            </div>
                        </div>
                        @endforeach
                        @endif
                                           
                                        
                </div>
            </div>
        </section>
    </div>

</div>


<div class="modal fade comman-modal" id="UnSubscribealertmesg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <span class="cancel-this-order" style="display:none;"></span>
    <div class="vertical-align-outer-div">
        <div class="vertical-align-inner-div">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header modal-header-padding">
                        <h5>Alert</h5>
                        <div class="close-btn">
                            <i class="far fa-times-circle" data-dismiss="modal" aria-label="Close"></i>
                        </div>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure want to UnSubscribe the @if(!empty($inform)){{$inform->store_plan_name}} @endif?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-raised btn-danger order-yes" id="modal_delete">Yes</button>
                        <button type="button" class="btn btn-raised btn-secondary order-no" data-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade comman-modal" id="alertmesg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <span class="cancel-this-order" style="display:none;"></span>
    <div class="vertical-align-outer-div">
        <div class="vertical-align-inner-div">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header modal-header-padding">
                        <h5>Alert</h5>
                        <div class="close-btn">
                            <i class="far fa-times-circle" data-dismiss="modal" aria-label="Close"></i>
                        </div>
                    </div>
                    <div class="modal-body">
                        <p>First Unsubscribe current @if(!empty($inform)) {{$inform->store_plan_name}} @endif plan  For subscribe New plan !!</p>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-raised btn-danger order-yes" id="modal_delete">Yes</button> --}}
                        <button type="button" class="btn btn-raised btn-secondary order-no" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

 <div class="modal fade" id="defaultModalPrimary1" tabindex="-1" role="dialog" aria-hidden="true">
                      <div class="modal-dialog" role="document" >

                         {!!Form::open(['url'=>['admins/vendor_plan_checkout'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'get_permission_form11'])!!}
                        <div class="modal-content"  style="background-color: #F5F5F5">
                          <div class="modal-header" style=" background-color: #19242f;">
                            <h5 class="modal-title" style="color: #fff">subscription plan</h5>
                            <button type="button" class="close" style="color: #fff" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                          </div>
                          <div class="modal-body m-3"  style="background-color: #F5F5F5">        <div class="row">
          <div class="col-md-4 mb-3">
            <ul class="nav nav-pills flex-column" id="myTab" role="tablist">
              <!-- ......... -->

 

{{-- .................... --}}



              <li class="nav-item">
                <a class="nav-link" id="tab_paypal" data-toggle="tab" href="#id_tab_paypal" role="tab" aria-controls="id_tab_paypal" aria-selected="true">    
                Pay Via Paypal </a>
              </li>
             

              <!-- ......... -->


              <li class="nav-item"> <a class="nav-link"
              id="tab_stripe" data-toggle="tab" href="#id_tab_stripe"
              role="tab" aria-controls="id_tab_stripe"
              aria-selected="true">Pay Via Stripe</a> </li>
             


            </ul>
          </div>
          <!-- .................................. -->
          <div class="col-md-8">
            <div class="tab-content" id="myTabContent">
            

<!-- ........................... -->


{{Form::close()}}

  <div class="tab-pane fade show " id="id_tab_paypal" role="tabpanel" aria-labelledby="tab_paypal">

                {!!Form::open(['url'=>['seller/paypal_transection'],'method' =>'post', 'role'=>'form','class' =>'require-validationsss form-bordered form-row-stripped','id'=>'comman_form_id','data-cc-on-file'=>'false'])!!}   


                             {!!Form::open(['url'=>['admin/city'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}

                  
                  <div class="text-left px-2 align-center">

    <h5>
            Pay $ {{\Cart::getTotal()}}
    </h5>
        <hr>
    <input type="hidden" name="payment_method" value="PayPal">
       <input type="hidden" name="subscription_plan_id" class="subscription_plan_cls" value="">
       <input type="hidden" name="totalAmount" class="paid_amount_cls" value="">






     <button type="submit" class="bg-info text-white  btn pmd-btn-raised btn-info border border-gray shadow rounded " >Pay $ {{\Cart::getTotal()}}  <i class="fa fa-paypal pl-2" aria-hidden="true"></i></button>






     </div>
    
    
    {{Form::close()}}
   
          </div>


          <!-- ........................... -->

          <div class="tab-pane fade show active" id="id_tab_stripe" role="tabpanel" aria-labelledby="tab_stripe">


 @if (Session::has('success'))
                     <div class="alert alert-success text-center">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <p>{{ Session::get('success') }}</p>
                     </div>
                     @endif


              {!!Form::open(['url'=>['seller/stripe_transection'],'method' =>'POST', 'role'=>'form','class' =>'require-validation form-bordered form-row-stripped','id'=>'comman_form_id','data-cc-on-file'=>'false','data-stripe-publishable-key'=>env('STRIPE_KEY')])!!}
      

          <div class="row">
            <div class="col-md-12 col-md-offset-6">
               <div class="panel panel-default credit-card-box">
                  <div class="panel-heading display-table" >
                     <div class="row display-tr" >
                        <h3 class="panel-title display-td" >Payment Details</h3>
                        <div class="display-td" >                            
                           <img class="img-responsive pull-right pl-4" src="{{url('public/frontend/img/stripe-payment-icon.png')}}" width="200px" >
                        </div>
                     </div>
                  </div>
                  <div class="panel-body">
                     @if (Session::has('success'))
                     <div class="alert alert-success text-center">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <p>{{ Session::get('success') }}</p>
                     </div>
                     @endif
      {{ csrf_field() }}
        <div class="row">
          <div class="col-md-12">
          @if (Session::has('success'))
              <div class="alert alert-success text-center">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                  <p>{{ Session::get('success') }}</p>
              </div>
          @endif
          @if (Session::has('error'))
              <div class="alert alert-error text-center">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                  <p>{{ Session::get('error') }}</p>
              </div>
          @endif

          <div class='error alert-danger alert' style="display: none;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <p> Please correct the errors and try again.</p>
          </div>
          </div>
        </div>  
          <div class="row">
          <div class="col-md-12">
            <div class="form_group form-group">
                <label>Email Address</label>
                {!!Form::email('user_email',Auth::user()->email,array('class'=>'form-control custom_form_control com_episo','id'=>'exampleInputEmail1','aria-describedby'=>'emailHelp')) !!} 
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form_group form-group">
               <label>Card Number</label>
                {!!Form::text('card_number','4242424242424242',array('class'=>'form-control custom_form_control com_episo card-inputs card-numbers  numbersOnly','autocomplete'=>'off','required', 'placeholder'=>'1234 1234 1234 1234','minlength'=>'12','maxlength'=>'18')) !!}
            </div>
          </div>
        </div>
        
        <div class="row">
        <div class="col-md-6">
          <div class="form_group form-group">
                        <label>Cvv</label>
                        {!!Form::text('ccv','123',array('class'=>'form-control custom_form_control com_episo  card-inputs numbersOnly card-cvc','autocomplete'=>'off','required','placeholder'=>'123','minlength'=>'3','maxlength'=>'3')) !!}
             
          </div>
        </div>
        <div class="col-md-3">
          <div class="form_group form-group">
                        <label> Month</label>
                        {!!Form::text('expiry_month','12',array('class'=>'form-control custom_form_control com_episo card-inputs card-expiry-month atm_mask_date','autocomplete'=>'off','placeholder'=>'MM','size'=>'2')) !!} 
             
          </div>
        </div>

         <div class="col-md-3">
          <div class="form_group form-group">
                        <label> Date</label>
                        {!!Form::text('expiry_year','2022',array('class'=>'form-control custom_form_control com_episo card-inputs atm_mask_date card-expiry-year','autocomplete'=>'off','placeholder'=>'YYYY','size'=>'4')) !!} 
             
          </div>
        </div>


      </div>
        <p>&nbsp;</p>
       <input type="hidden" name="payment_method" value="Stripe">
       <input type="hidden" name="subscription_plan_id" class="subscription_plan_cls" value="">
<input type="hidden" name="totalAmount" class="paid_amount_cls" value="">
        <div class="row">
          <div class="col-md-6">
               <button type="submit" class="btn btn-raised btn-primary">Pay $ {{\Cart::getTotal()}} <i class="fa fa-cc-visa pl-2" aria-hidden="true"></i></button>
            </div>
        </div>
                  </div>
               </div>
            </div>
         </div>
{{Form::close()}}
      </div>



     

</div>
</div>

<!-- .......end......... -->
</div>                                  
                          </div>
                         {{--  <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="subm" class="btn btn-primary">Purchase Plane</button>
                          </div> --}}
                        </div>

                        {{Form::close()}}
                      </div>

                    </div>

     <!-- ................ -->
</div>
</div>
</div>
</main>
@endsection

<!-- ................push new js link................. -->

@push('js')

 <script src="{{asset('public/js/validation.js')}}"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

   <script>
// 

    $(document).ready(function() {



               $('.purchase_plan_modal').on('click',function(){

var plan_id=$(this).attr('plan_id');
var amount=$(this).attr('totalAmount');

$(".subscription_plan_cls").val(plan_id)
$(".paid_amount_cls").val(amount)

    })



    $('#modal_delete').on('click',function(){
        
var id = $("#purchase_plan_id").val();

          
            var status = 'Expired';
            console.log(status);

// alert(id)
            var data;
           if(status) {  
              $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});
                 $.ajax({
          url: "{{url('seller/unsubscribe_plan')}}",
          type: "post",
          data: {status:status,id:id},
                    dataType: "json",
                    success:function(res) {
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


                  location.reload();
                  
                },

                error:function(error) {
                        console.log(error);
                  
                }

                });
                    }
          


            });


  })

$(function() {
    var $form         = $(".require-validation");
  $('form.require-validation').bind('submit', function(e) {
    var $form         = $(".require-validation"),
        inputSelector = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs       = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid         = true;
        $errorMessage.addClass('hide');
 
        $('.has-error').removeClass('has-error');
    $inputs.each(function(i, el) {
      var $input = $(el);
      if ($input.val() === '') {
        $input.parent().addClass('has-error');
        $errorMessage.removeClass('hide');
        e.preventDefault();
      }
    });
  
    if (!$form.data('cc-on-file')) {
      e.preventDefault();
      Stripe.setPublishableKey($form.data('stripe-publishable-key'));
      Stripe.createToken({
        number: $('.card-numbers').val(),
        cvc: $('.card-cvc').val(),
        exp_month: $('.card-expiry-month').val(),
        exp_year: $('.card-expiry-year').val()
      }, stripeResponseHandler);
    }
  
  });
  
  function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            // token contains id, last4, and card type
            var token = response['id'];
            // insert the token into the form so it gets submitted to the server
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='token' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }
  
});


      </script>


@endpush