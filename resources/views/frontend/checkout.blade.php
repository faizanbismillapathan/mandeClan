@extends('frontend.layouts.app')
@section('title',"Online Shopping site in US: Shop Online for Mobiles, Books, Watches, Shoes and More - mandeclan.com")
<!-- ................Add meta ................ -->


@section('meta')
@endsection

<!-- ................custom css................. -->

@section('customStyle')
<style type="text/css">

.showWhenCityNot{
    display: block;
}

 @media (max-width: 480px) {
    .showWhenCityNot{
    display: none !important;
    }
  }

 .first-navbar .btn.btn-light ,.mande-main-category.padding{
        display: none !important;
    }
#pageloader
{
  background: rgba( 255, 255, 255, 0.8 );
  display: none;
  height: 100%;
  position: fixed;
  width: 100%;
  z-index: 9999;
}

#pageloader img
{
  left: 50%;
  margin-left: -32px;
  margin-top: -32px;
  position: absolute;
  top: 50%;
}
.guest-User .select-area{
                position:absolute;
                padding:10px !important;
                margin-top:9px;
                border:1px solid #dadada;
                background:#ffffff;
                z-index:999;
              }
              .guest-User .select-area option:first-child{
                padding-top:0px;
              }
              .guest-User .select-area option{
                padding:5px 10px;
                background:#fff;
              }
.product-list-checkout .quantity .span {
font-size: 12px;
    color: #6c757d;
    border: 1px solid #6c757d;
}


 .guest-User .select-area{
                position:absolute;
                padding:10px !important;
                margin-top:9px;
                border:1px solid #dadada;
                background:#ffffff;
                z-index:999;
              }
              .guest-User .select-area option:first-child{
                padding-top:0px;
              }
              .guest-User .select-area option{
                padding:5px 10px;
                background:#fff;
              }
}


.nav-stacked>li>a:focus, .nav-stacked>li>a:hover {
  color: #444;
  background: #f7f7f7;
}
.nav-pills .nav-link.active, .nav-pills .show>.nav-link {
  color: white;
  background-color: orange;
  font-weight: bold;
}

/**/






    .mande-main-category{
      display: none!important;
    }


    :root {
  --card-line-height: 1.2em;
  --card-padding: 1em;
  --card-radius: 0.5em;
  --color-green: #558309;
  --color-gray: #e2ebf6;
  --color-dark-gray: #c4d1e1;
  --radio-border-width: 2px;
  --radio-size: 1.5em;
  
  
     --red: hsl(0, 78%, 62%);
    --cyan: hsl(180, 62%, 55%);
    --orange: hsl(34, 97%, 64%);
    --blue: hsl(212, 86%, 64%);
    --varyDarkBlue: hsl(234, 12%, 34%);
    --grayishBlue: hsl(229, 6%, 66%);
    --veryLightGray: hsl(0, 0%, 98%);
    --weight1: 200;
    --weight2: 400;
    --weight3: 600;
}

/*Adils Css*/
[type="radio"]:checked,
[type="radio"]:not(:checked) {
    position: absolute;
    left: -9999px;
}
[type="radio"]:checked + label,
[type="radio"]:not(:checked) + label
{
    position: relative;
    padding-left: 28px;
    cursor: pointer;
    line-height: 20px;
    display: inline-block;
    color: #666;
    overflow-wrap: anywhere;
}
[type="radio"]:checked + label:before,
[type="radio"]:not(:checked) + label:before {
    content: '';
    position: absolute;
    left: 4px;
    top: 6px;
    width: 18px;
    height: 18px;
    border: 1px solid #ddd;
    border-radius: 100%;
    background: #fff;
}
[type="radio"]:checked + label:after,
[type="radio"]:not(:checked) + label:after {
    content: '';
    width: 12px;
    height: 12px;
    background: #4285f4;
    position: absolute;
    top: 9.2px;
    left: 7.1px;
    border-radius: 100%;
    -webkit-transition: all 0.2s ease;
    transition: all 0.2s ease;
}
[type="radio"]:not(:checked) + label:after {
    opacity: 0;
    -webkit-transform: scale(0);
    transform: scale(0);
}
[type="radio"]:checked + label:after {
    opacity: 1;
    -webkit-transform: scale(1);
    transform: scale(1);
}
.blue {
    border-top: 3px solid var(--blue);
}

.cyan {
    border-top: 3px solid var(--cyan);
}
.red {
    border-top: 3px solid var(--red);
}

.orange {
    border-top: 3px solid var(--orange);
}


.box p {
    color: var(--grayishBlue);
}

.box {
    border-radius: 5px;
    box-shadow: 0px 30px 40px -20px var(--grayishBlue);
    padding: 30px;
    margin: 20px;  
}

/**/
.grid {
  display: grid;
  grid-gap: var(--card-padding);
  margin: 0 auto;
  max-width: 60em;
  padding: 0;
 
  @media (min-width: 42em) {
    grid-template-columns: repeat(3, 1fr);
  }
}

.card {
  background-color: #fff;
  border-radius: var(--card-radius);
  position: relative;
  
  &:hover {
    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.15);
  }
}

.radio {
  font-size: inherit;
  margin: 0;
  position: absolute;
  right: calc(var(--card-padding) + var(--radio-border-width));
  top: calc(var(--card-padding) + var(--radio-border-width));
}

@supports(-webkit-appearance: none) or (-moz-appearance: none) { 
  .radio {
    -webkit-appearance: none;
    -moz-appearance: none;
    background: #fff;
    border: var(--radio-border-width) solid var(--color-gray);
    border-radius: 50%;
    cursor: pointer;
    height: var(--radio-size);
    outline: none;
    transition: 
      background 0.2s ease-out,
      border-color 0.2s ease-out;
    width: var(--radio-size); 

    &::after {
      border: var(--radio-border-width) solid #fff;
      border-top: 0;
      border-left: 0;
      content: '';
      display: block;
      height: 0.75rem;
      left: 25%;
      position: absolute;
      top: 50%;
      transform: 
        rotate(45deg)
        translate(-50%, -50%);
      width: 0.375rem;
    }

    &:checked {
      background: var(--color-green)!important;
      border-color: var(--color-green)!important;
    }
  }
  
  .card:hover .radio {
    border-color: var(--color-dark-gray);
    
    &:checked {
      border-color: var(--color-green);
    }
  }
}

.plan-details {
  border: var(--radio-border-width) solid var(--color-gray);
  border-radius: var(--card-radius);
  cursor: pointer;
  display: flex;
  flex-direction: column;
  padding: var(--card-padding);
  transition: border-color 0.2s ease-out;
}

.card:hover .plan-details {
  border-color: var(--color-dark-gray);
}

.radio:checked  {
  border-color: var(--color-green)!important;
}

.radio:focus ~ .plan-details {
  box-shadow: 0 0 0 2px var(--color-dark-gray);
}

.radio:disabled ~ .plan-details {
  color: var(--color-dark-gray);
  cursor: default;
}

.radio:disabled ~ .plan-details .plan-type {
  color: var(--color-dark-gray);
}

.card:hover .radio:disabled ~ .plan-details {
  border-color: var(--color-gray);
  box-shadow: none;
}

.card:hover .radio:disabled {
    border-color: var(--color-gray);
  }

.plan-type {
  color: var(--color-green);
  font-size: 1.5rem;
  font-weight: bold;
  line-height: 1em;
}

.plan-cost {
  font-size: 2.5rem;
  font-weight: bold;
  padding: 0.5rem 0;
}

.slash {
  font-weight: normal;
}

.plan-cycle {
  font-size: 2rem;
  font-variant: none;
  border-bottom: none;
  cursor: inherit;
  text-decoration: none;
}

.hidden-visually {
  border: 0;
  clip: rect(0, 0, 0, 0);
  height: 1px;
  margin: -1px;
  overflow: hidden;
  padding: 0;
  position: absolute;
  white-space: nowrap;
  width: 1px;
}
.buttons {
            margin: 0 5px 0 0;
            padding: 3px 15px;
            font-size: 12px;
            border: 1px solid black;
            background: transparent;
            color: black;
            text-transform: uppercase;
            border-radius: 5px;
            cursor:pointer;
        }
        .selected-day{
            background:black;
            color:white;
        }



.button {
    float: left;
    margin: 0 5px 0 0;
    height: 40px;
    position: relative;
}


.button input[type="radio"] {
    opacity: 0.011;
    z-index: 100;
}

/*
.button label, .button input {
    display: block;
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
}

*/
.btn:not(:disabled):not(.disabled), .custom-file-control:not(:disabled):not(.disabled):before {
    cursor: pointer;
}
.button label {
    background: rgb(255, 255, 255);
    padding: 6px 16px;
    border-radius: 10px;
    border: 1px solid rgb(51, 51, 51);
    margin: 6px 12px 6px 0px;
    min-width: 46px;
    height: 32px;
    display: flex;
    -webkit-box-pack: center;
    justify-content: center;
    -webkit-box-align: center;
    align-items: center;
    position: relative;
    cursor: pointer;
    -webkit-tap-highlight-color: transparent;
}

</style>
@endsection

<!-- ................Add css link................. -->

@push('style')
@endpush

<!-- ................body................. -->
@section('innercontent')  


<nav class="breadcrumb-nav">
   <div class="breadcrumb-padding">
      <div class="container-fluid">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/'.Session::get('locality_url'))}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page" style="text-transform:capitalize;">shopping cart</li>
          </ol>
      </div>
   </div>
</nav>

            <div id="overlay" style="display:none;">
            <div style="display:table;height:100%;width:100%;overflow:hidden;">
                <div style="display:table-cell;vertical-align:middle;">
                    <div class="center">
                        <img src="{{url('/')}}/public/img/demo_wait.gif" width="64" height="64">
                    </div>
                </div>
            </div>
        </div>
       

<div class="padding checkout-page">
  <div class="container-fluid">
<div id="pageloader">
   <img src="http://cdnjs.cloudflare.com/ajax/libs/semantic-ui/0.16.1/images/loader-large.gif" alt="processing..." />
</div>

    {{-- <div class="overlay loader"  id="gif">
              <div class="vertical-align-outer-div">
                <div class="vertical-align-inner-div" style="vertical-align: middle;">
                  <div class="image">
                    <img src="{{asset('public/img/pd-loader.gif')}}">
                  </div>
                </div>
              </div>
            </div>

 --}}
                         
             {!! Form::open(['url'=>['checkout_order'], 'class' => '','method' => 'POST','id' =>'comman_form_id']) !!}



    <div class="row">
        
        
      <div class="col-md-8">
        <!--  -->
        <div id="accordion">
          <div class="dashed-border"></div>
          <div class="row">
            <div class="col-md-2 col-xs-2">
            <div class="step-counter">
              <p>1</p>
            </div>
            </div>
            <div class="col-md-10 col-xs-10">
            <div class="card card-checkout">
              <div class="card-header" id="headingOne">
                  <div class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Personal Information
                  </div>
              </div>

              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                   <div class="form-row">
                                                        @if(!empty($customer->customer_userid))               

                         <div class="form-group col-md-6">
                         
                            <div class="d-flex"><b class="pull-left">User Id</b> <b class="mx-2">:</b> <p class="">{{$customer->customer_userid}}</p>
                            </div>
                                  
                        </div>
                        @endif
                                                        @if(!empty($customer->customer_name))               

                         <div class="form-group col-md-6">
                         
                            <div class="d-flex"><b class="pull-left">Name</b>
                            <b class="mx-2">:</b> <p class="">{{$customer->customer_name}}</p>
                          
                          </div>         
                        </div>
                        @endif
                                                        @if(!empty($customer->customer_mobile))               

                        <div class="form-group col-md-6">
                           <div class="d-flex"><b class="pull-left">Mobile No</b> <b class="mx-2">:</b> <p class="">{{$customer->customer_mobile}}</p>
                            </div>
                            
                        </div>
                        @endif

                                                        @if(!empty($customer->customer_email))               

                        <div class="form-group col-md-6">
                           <div class="d-flex"><b class="pull-left">Email</b> <b class="mx-2">:</b> <p class="">{{$customer->customer_email}}</p>
                            </div>
                              
                        </div>
                        @endif

                                                        @if(!empty($customer->customer_gender))               

                        <div class="form-group col-md-6">
                           <div class="d-flex"><b class="pull-left">Genders</b> <b class="mx-2">:</b> <p class="">{{$customer->customer_gender}}</p>
                            </div>
                              
                        </div>
                        @endif
                                

                                @if(!empty($customer->locality))               
                        <div class="form-group col-md-6">

                           <div class="d-flex"><b class="pull-left">Address</b>
                            <b class="mx-2">:</b> <p class="">@if(!empty($customer->locality)){{$customer->locality->locality_name}} @endif @if(!empty($customer->city)), {{$customer->city->city_name}} @endif  @if(!empty($customer->state)), {{$customer->state->state_name}} @endif @if(!empty($customer->country)) ,{{$customer->country->country_name}} @endif </p>
                          
                          </div>  

                             
                        </div>

                        @endif
                        
                       
                       
                                                
                        </div>

                </div>
              </div>
            </div>
            </div>
          </div>

<div class="dashed-border"></div>
<div class="row">
  <div class="col-md-2 col-xs-2">
    <div class="step-counter">
      <p>2</p>
    </div>
  </div>
  <div class="col-md-10 col-xs-10">
    <div class="card card-checkout">
      <div class="card-header" id="headingTwo">
        <div class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" id="clickTwo">
          Delivery By
        </div>
      </div>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
        <div class="card-body shipping-address">
          <!--  -->
          <div class="delivery-method">
            <div class="btn-group btn-group-toggle" data-toggle="buttons" id="radio_delivery_by">
              
 <label class="btn btn-secondary home-delivery active">
                <input type="radio" name="pickup_type" id="delivery_pickup" autocomplete="off" value="Home Delivery" class="pickup_type_checked" checked> <i class="far fa-check-square"></i> Home Delivery
              </label>


              <label class="btn btn-secondary selfpickup">
                <input type="radio" name="pickup_type" id="self_pickup" autocomplete="off" value="Self Pickup" class="pickup_type_checked"> <i class="far fa-check-square"></i> Self Pickup
              </label>
             
            </div>
            <!--addressbtn-->
          
            
          </div>
          <hr>
          {{-- <div class="self-pickup-btn">
            <div class="row">
              <div class="col-md-12">
                <button class="btn btn-raised btn-success margin-top20" id="nextTwo">Next</button>
              </div>
            </div>
          </div> --}}
          <!--  -->
          <div class="shipping-address-div" style="display: block;">

            <div class="grid">

                  <div class="row">


                
@if(count($addressBook) > 0)
@foreach($addressBook as $key=>$value)
<div class="col-md-6 col-xs-12">
<div class="box box-down blue">
<div style="justify-content:space-between"> 


<div class="">
<input type="radio" id="test{{$value->id}}" class="check_radio_vals" name="address_book" value="{{$value->id}}" checked>
<label for="test{{$value->id}}">{{$value->name}}<br> {{$value->mobile}} <br>{{$value->email}} <br> @if(!empty($value->localitys)){{$value->localitys->locality_name}} @endif @if(!empty($value->citys)), {{$value->citys->city_name}} @endif  @if(!empty($value->states)), {{$value->states->state_name}} @endif @if(!empty($value->countrys)) ,{{$value->countrys->country_name}} @endif</label>
</div>

</div>
</div>

</div>
@endforeach
@else

<div class="center">
   <a href="{{url('customer/manage-address/create')}}"> <div type="submit" class="bg-success text-white btn btn-border border-gray shadow btn-rounded pull-right">Address<i class="fa fa-plus pl-2" aria-hidden="true"></i> </div></a>
</div>
@endif

          


</div>
 

</div>
           
          
          
          </div>
          <!--  -->
        </div>
      </div>
    </div>
  </div>
</div>

<div class="dashed-border"></div>
<div class="row">
  <div class="col-md-2 col-xs-2">
    <div class="step-counter">
      <p>3</p>
    </div>
  </div>
  <div class="col-md-10 col-xs-10">
    <div class="card card-checkout">
      <div class="card-header" id="headingTwo">
        <div class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTen" aria-expanded="false" aria-controls="collapseTwo" id="clickTwo">
          Pickup Time / Delivery Time
        </div>
      </div>
      <div id="collapseTen" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
        <div class="card-body shipping-address">
          <div class="delivery-method">
              <div class="row mb-3">
                  <h5 class="col-md-2 text-capitalize">day</h5>
                  <div class="col-md-10 d-lg-flex xm-block justify-content-start align-items-center">

                    <div class="button ">
        <input type="radio" name="delivery_date" value="{{ Carbon\Carbon::now()}}"  class="delivery_today_date_vals coman" id="radio_id" data="today" checked>
        <label class="btn btn-default" for="radio_id">{{ Carbon\Carbon::now()->format('d-m-Y')}}</label>
        </div>

        <div class="button ">
        <input type="radio" name="delivery_date" value="{{ Carbon\Carbon::now()->addDays(1)}}"  class="delivery_date_vals coman"  data="" id="radio_id_1">
        <label class="btn btn-default" for="radio_id_1">{{ Carbon\Carbon::now()->addDays(1)->format('d-m-Y')}}</label>
        </div>

        <div class="button ">
        <input type="radio" name="delivery_date" value="{{ Carbon\Carbon::now()->addDays(2)}}"  class="delivery_date_vals coman"  data="" id="radio_id_2">
        <label class="btn btn-default" for="radio_id_2">{{ Carbon\Carbon::now()->addDays(2)->format('d-m-Y')}}</label>
        </div>


  <div class="button ">
        <input type="radio" name="delivery_date" value="{{ Carbon\Carbon::now()->addDays(3)}}" class="delivery_date_vals coman"  data="" product_id="6" id="radio_id_3">
        <label class="btn btn-default" for="radio_id_3">{{ Carbon\Carbon::now()->addDays(3)->format('d-m-Y')}}</label>
        </div>

                  </div>
              </div>
              <div class="row">
                  <h5 class="col-md-2 text-capitalize">time</h5>
              <div class="col-md-10 d-lg-flex xm-block justify-content-start align-items-center" id="onlytody_date" >
               



@if(date('H',strtotime(Carbon\Carbon::now())) < 16)
@if(date('H',strtotime(Carbon\Carbon::now())) > "1"  && date('H',strtotime(Carbon\Carbon::now())) < "10" ) 

<div class="button ">
<input type="radio" name="delivery_time" class="delivery_time_vals" value="10:00 A.M to 02:00 P.M"  id="radio_id_morning" checked>
<label class="btn btn-default" for="radio_id_morning">10:00 A.M to 02:00 P.M</label>
</div>

@endif
@if(date('H',strtotime(Carbon\Carbon::now())) > "1"  && date('H',strtotime(Carbon\Carbon::now())) < "13" ) 
<div class="button ">
<input type="radio" name="delivery_time" class="delivery_time_vals" value="02:00 P.M to 05:00 P.M"  id="radio_id_aftern">
<label class="btn btn-default" for="radio_id_aftern">02:00 P.M to 05:00 P.M</label>
</div>
@endif

@if(date('H',strtotime(Carbon\Carbon::now())) > "1"  && date('H',strtotime(Carbon\Carbon::now())) < "16" ) 
<div class="button ">
<input type="radio" name="delivery_time" class="delivery_time_vals" value="05:00 P.M to 08:00 P.M"  id="radio_id_evening">
<label class="btn btn-default" for="radio_id_evening">05:00 P.M to 08:00 P.M</label>
</div>

@endif

@else

<div class="button ">
<input type="radio" name="delivery_time" class="delivery_time_vals" value="10:00 A.M to 02:00 P.M"  id="radio_id_morning"  disabled>
<label class="btn btn-default" for="radio_id_morning">10:00 A.M to 02:00 P.M</label>
</div>

<div class="button ">
<input type="radio" name="delivery_time" class="delivery_time_vals" value="02:00 P.M to 05:00 P.M"  id="radio_id_aftern" disabled>
<label class="btn btn-default" for="radio_id_aftern">02:00 P.M to 05:00 P.M</label>
</div>
<div class="button ">
<input type="radio" name="delivery_time" class="delivery_time_vals" value="05:00 P.M to 08:00 P.M"  id="radio_id_evening" disabled>
<label class="btn btn-default" for="radio_id_evening">05:00 P.M to 08:00 P.M</label>
</div>



@endif

                  </div>


     <div class="col-md-10 d-lg-flex xm-block justify-content-start align-items-center" id="excepttody_date" style="display:none!important">



<div class="button ">
<input type="radio" name="delivery_time" class="delivery_time_vals" value="10:00 A.M to 02:00 P.M"  id="radio_id_morning0" checked>
<label class="btn btn-default" for="radio_id_morning0">10:00 A.M to 02:00 P.M</label>
</div>
<div class="button ">
<input type="radio" name="delivery_time" class="delivery_time_vals" value="02:00 P.M to 05:00 P.M"  id="radio_id_morning1">
<label class="btn btn-default" for="radio_id_morning1">02:00 P.M to 05:00 P.M</label>
</div>
<div class="button ">
<input type="radio" name="delivery_time" class="delivery_time_vals" value="05:00 P.M to 08:00 P.M"  id="radio_id_morning2">
<label class="btn btn-default" for="radio_id_morning2">05:00 P.M to 08:00 P.M</label>
</div>

     
{{-- 
          <div class="button ">
        <input type="radio" name="delivery_time" class="delivery_time_vals" value="02:00 P.M to 05:00 P.M"  id="radio_id_aftern">
        <label class="btn btn-default" for="radio_id_aftern">02:00 P.M to 05:00 P.Ms</label>
        </div>

          <div class="button ">
        <input type="radio" name="delivery_time" class="delivery_time_vals" value="05:00 P.M to 08:00 P.M"  id="radio_id_evening">
        <label class="btn btn-default" for="radio_id_evening">05:00 P.M to 08:00 P.Ms</label>
        </div> --}}
                  </div>


              </div>
            
          </div>
         {{--  <hr>
          <div class="self-pickup-btn">
            <div class="row">
              <div class="col-md-12">
                <button class="btn btn-raised btn-success margin-top20" id="nextTwo">Next</button>
              </div>
            </div>
          </div> --}}
        
                </div>
      </div>
    </div>
  </div>
</div>

                 {{-- <div class="dashed-border"></div>
                  <div class="row">
                    <div class="col-md-2 col-xs-2">
                  <div class="step-counter">
              <p>3</p>
            </div>
                    </div>
                    <div class="col-md-10 col-xs-10">
                    <div class="card card-checkout">
              <div class="card-header" id="headingThree">
                  <div class="btn btn-link collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="collapseThree" id="clickThree">
                    Delivery Slot
                  </div>
              </div>
              <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group bmd-form-group is-filled">
                    <label class="bmd-label-floating">Delivery Date</label>
                    <select class="form-control" id="deliveryDate">
                      <option disabled="" selected="" value="">Select Delivery Date</option>
                                              <option value="2021-11-13">13th November 2021</option>
                                              <option value="2021-11-14">14th November 2021</option>
                                              <option value="2021-11-15">15th November 2021</option>
                                          </select>
                  </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group bmd-form-group is-filled">
                    <label class="bmd-label-floating">Delivery Time</label>
                    <select class="form-control" id="deliverySlotTime">
                      <option selected="">Select Delivery Date First</option>
                    </select>
                  </div>
                    </div>
                    <div class="col-md-12">
                      <button class="btn btn-raised btn-success" id="nextFour">Next</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
                    </div>
                  </div> --}}

                  <div class="dashed-border"></div>
                  <div class="row">
                    <div class="col-md-2 col-xs-2">
            <div class="step-counter">
              <p>4</p>
            </div>
                    </div>



                    <div class="col-md-10 col-xs-10">
                    <div class="card card-checkout">

                      @if(count($addressBook) > 0)

              <div class="card-header" id="headingFour">

                @else
              <div class="card-header" id="headingFour1" data-toggle="modal" data-target="#myModal">

                @endif
                  <div class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour" id="clickFour">
                    Payment Mode
                  </div>
              </div>
              <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                <div class="card-body">
                  <div class="payment-mode">


 <div class="">
      <div class="card-body">

        <div class="row">
            
            
            <!--sarfarazbhai-->
            
            
            
            
            
        <!--     
            <div class=col-12>
                
                <div class="button">
        <input type="radio" name="pay" value="pay1"  class=""  data="" id="radio_id_1">
        <label class="btn btn-default" for="radio_id_1">Cash on delevery</label>

        <input type="radio" name="pay" value="pay2"  class=""  data="" id="radio_id_1">
        <label class="btn btn-default" for="radio_id_1">Online Payment</label>
        </div>
        
                    </div> -->
                
                <!-- <div class="pull-right m-3">
                    
                
            
                   <a href="{{url('/checkout')}}">
                                <button class="btn btn-raised btn-success width100" data-toggle="modal" data-target="#loginsignup">Proceed To Checkout</button>
                            </a>
            
            

            </div>
 -->            
        <div class="col-md-4 mb-3">
          <ul class="nav nav-pills flex-column" id="myTab" role="tablist">
              <!-- ......... -->

<li class="nav-item">
              <a class="nav-link " id="tab_bank" data-toggle="tab" href="#id_tab_bank" role="tab" aria-controls="id_tab_bank" aria-selected="true">Pay On Delivery
              </a>
            </li>

<!--{{-- .................... --}}-->


<!-- @if($configs->paypal_enable==1)
            <li class="nav-item">
              <a class="nav-link" id="tab_paypal" data-toggle="tab" href="#id_tab_paypal" role="tab" aria-controls="id_tab_paypal" aria-selected="true">    
              Pay Via Paypal </a>
            </li>
            @endif -->

              <!-- ......... -->
@if($configs->stripe_enable==1)

            <li class="nav-item"> <a class="nav-link"
            id="tab_stripe" data-toggle="tab" href="#id_tab_stripe"
            role="tab" aria-controls="id_tab_stripe"
            aria-selected="true">Pay Via Stripe</a> </li>
            @endif


              <!-- ......... -->
<!-- @if($configs->paytm_enable==1)

              <li class="nav-item"> <a class="nav-link " id="tab_paytm"
              data-toggle="tab" href="#id_tab_paytm" role="tab"
              aria-controls="id_tab_paytm" aria-selected="true">   Pay Via
              Paytm</a> </li>
@endif -->

              <!-- ......... -->

<!--@if($configs->razorpay==1)-->

<!--              <li class="nav-item"> <a class="nav-link " id="tab_razorPay"-->
<!--              data-toggle="tab" href="#id_tab_razorPay" role="tab"-->
<!--              aria-controls="id_tab_razorPay" aria-selected="true">   Pay Via-->
<!--              RazorPay</a> </li>-->

<!--              @endif-->


              <!-- ......... -->
<!--@if($configs->skrill_enable==1)-->

<!--              <li class="nav-item"> <a class="nav-link " id="tab_skrill"-->
<!--              data-toggle="tab" href="#id_tab_skrill" role="tab"-->
<!--              aria-controls="id_tab_skrill" aria-selected="true">   Pay Via-->
<!--              Skrill</a> </li>-->
<!--@endif-->

              <!-- ......... -->
<!--@if($configs->braintree_enable==1)-->

<!--              <li class="nav-item"> <a class="nav-link " id="tab_braintree"-->
<!--              data-toggle="tab" href="#id_tab_braintree" role="tab"-->
<!--              aria-controls="id_tab_braintree" aria-selected="true">   Pay-->
<!--              Via Braintree</a> </li>-->
<!--@endif-->

              <!-- ......... -->

<!--            {{--   <li class="nav-item">-->
<!--                <a class="nav-link " id="tab_bank" data-toggle="tab" href="#id_tab_bank" role="tab" aria-controls="id_tab_bank" aria-selected="true">Bank Transfer-->
<!--                </a>-->
<!--              </li> --}}-->



              


              <!-- ......... -->

<!--            </ul>-->
          </div>
          <!-- .................................. -->
          <div class="col-md-8">
            <div class="tab-content" id="myTabContent">
            

<!-- ........................... -->

<div class="tab-pane fade show " id="id_tab_bank" role="tabpanel" aria-labelledby="tab_bank">
 

  
     <div class="text-left px-2 align-center">

    <h5>
            Pay $ {{$subtotal}}
    </h5>
        <hr>
<input type="hidden" name="payment_method" value="COD">
    <button type="submit" class="bg-success text-white  btn pmd-btn-raised btn-info border border-gray shadow rounded " style="text-transform: capitalize;">  Cash on delivery <i class="fa fa-money pl-2" aria-hidden="true"> </i> </button>

        <hr>
    <p class="text-muted"><i class="fa fa-money" aria-hidden="true"> </i> Pay with cash when your product is at your door.</p>
    </div>

     
    <input type="hidden" name="store_id" value="{{implode(',',$store_ids)}}"  class="store_id_cls">

</div>

<!-- ............ -->

{{Form::close()}}

  <div class="tab-pane fade show " id="id_tab_paypal" role="tabpanel" aria-labelledby="tab_paypal">

                {!!Form::open(['route'=>['processTransaction'],'method' =>'GET', 'role'=>'form','class' =>'require-validationsss form-bordered form-row-stripped','id'=>'comman_form_id','data-cc-on-file'=>'false'])!!}   
                  
                  <div class="text-left px-2 align-center">

    <h5>
            Pay $ {{$subtotal}}
    </h5>
        <hr>
    <input type="hidden" name="payment_method" value="PayPal">
    <input type="hidden" name="store_id" value="{{implode(',',$store_ids)}}"  class="store_id_cls">
    <input type="hidden" name="address_book" value="" class="address_book_cls">
    <input type="hidden" name="delivery_date" value="" class="delivery_date_cls">
    <input type="hidden" name="delivery_time" value="" class="delivery_time_cls">
    <input type="hidden" name="pickup_type" value="" class="pickup_type_cls">





     <button type="submit" class="bg-info text-white  btn pmd-btn-raised btn-info border border-gray shadow rounded " >Pay $ {{$subtotal}}  <i class="fa fa-paypal pl-2" aria-hidden="true"></i></button>






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


             {!!Form::open(['route'=>['stripe.post'],'method' =>'POST', 'role'=>'form','class' =>'require-validation form-bordered form-row-stripped','id'=>'comman_form_id','data-cc-on-file'=>'false','data-stripe-publishable-key'=>env('STRIPE_KEY')])!!}
      

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
<input type="hidden" name="payment_method" value="Stripe">


     </div>
       <p>&nbsp;</p>
      <input type="hidden" name="payment_method" value="Stripe">
   <input type="hidden" name="store_id" value="{{implode(',',$store_ids)}}"  class="store_id_cls">
   <input type="hidden" name="address_book" value="" class="address_book_cls">
   <input type="hidden" name="delivery_date" value="" class="delivery_date_cls">
   <input type="hidden" name="delivery_time" value="" class="delivery_time_cls">
   <input type="hidden" name="pickup_type" value="" class="pickup_type_cls">

       <div class="row">
         <div class="col-md-6">
              <button type="submit" class="btn btn-raised btn-primary">Pay $ {{$subtotal}} <i class="fa fa-cc-visa pl-2" aria-hidden="true"></i></button>
           </div>
       </div>
                 </div>
              </div>
           </div>
        </div>
{{Form::close()}}
     </div>



      <!-- ........................... -->

      <div class="tab-pane fade show" id="id_tab_paytm" role="tabpanel" aria-labelledby="tab_paytm">
        
    </div>

    <!-- ........................... -->

    <div class="tab-pane fade show" id="id_tab_razorPay" role="tabpanel" aria-labelledby="tab_razorPay">
      
    </div>


    <!-- ........................... -->

    <div class="tab-pane fade show" id="id_tab_skrill" role="tabpanel" aria-labelledby="tab_skrill">
     
  </div>

  <!-- ........................... -->

  <div class="tab-pane fade show" id="id_tab_braintree" role="tabpanel" aria-labelledby="tab_braintree">
    
</div>

</div>
</div>

<!-- .......end......... -->
</div>
</div>

                  </div>
                  
                    {{-- <button class="btn btn-raised btn-success" id="placeOrderCheckout">Place Order</button> --}}
                  
                </div>
              </div>
            </div>
                    </div>
                    
                  </div>

        </div>
          
      </div>

      </div>
      <div class="col-md-4 addToCards">
        @include('frontend.checkout_list')
      </div>
    </div>

  </div>
</div>
<!--  -->
<!-- Modal -->
<div class="modal fade comman-modal" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="vertical-align-outer-div">
        <div class="vertical-align-inner-div">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header modal-header-padding">
                        <h5>Delete Item</h5>
                        <div class="close-btn">
                            <i class="far fa-times-circle" data-dismiss="modal" aria-label="Close"></i>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="trash-image">
                            <img src="{{url('/')}}/public/frontend/img/trash-can.png">
                        </div>
                        <p id="item_delete_message">Are you sure want to delete this product ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-raised btn-danger" id="modal_delete">Delete</button>
                        <button type="button" class="btn btn-raised btn-secondary" data-dismiss="modal" id="modal_cancel">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="alert alert-warning modal-body" style="margin-bottom:0;">

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <p id="error_message">Error happend!</p>

        <p id="error_message">Please Add Delivery Address</p>

        <div class="center">
   <a href="{{url('customer/manage-address/create')}}"> <div type="submit" class="bg-success text-white btn btn-border border-gray shadow btn-rounded pull-right">Address<i class="fa fa-plus pl-2" aria-hidden="true"></i> </div></a>
</div>
      </div>
    </div>
  </div>
</div>

<span data-toggle="modal" data-target="#myModal" id="errorModalBtn"></span>
<!--  -->

<!--  -->
        <div class="mobile-device">
  <h4 class="logo">Mande-Clan</h4>
  <h4 class="h4">Buy Online Marketplace from Shop Near by You</h4>
  <div class="center">
    <button class="btn btn-raised btn-light">Download Today</button>
  </div>
  <div class="app-link-img">
    <img src="{{url('/')}}/public/frontend/img/goggle-play-store.png">
    <img src="{{url('/')}}/public/frontend/img/apple-store.png">
  </div>
  <div class="mobile-footer">
    <p>All rights reserved @ 2019 Mande Clan</p>
  </div>
</div>     



</body>
@endsection

<!-- ................push new js link................. -->

@push('js')
<script src="{{asset('public/js/comman.js')}}"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>


<script type="text/javascript">
          $(document).ready(function() {


    $( "form" ).submit(function( event ) {
// alert('1')
    $("#pageloader").fadeIn();
  });//submit

    //           var arrys = $(".hidden_store_id").map(function(){
    //   return $(this).val();
    // }).get();




$(".address_book_cls").val($(".check_radio_vals:checked").val());
$(".delivery_date_cls").val($(".coman:checked").val());
$(".delivery_time_cls").val($(".delivery_time_vals:checked").val());
$(".pickup_type_cls").val($(".pickup_type_checked:checked").val());



// $(".store_id_cls").val(arrys)


        $('.pickup_type_checked').change(function() {
$(".pickup_type_cls").val($(this).val())
})


              $('.check_radio_vals').change(function() {
$(".address_book_cls").val($(this).val())
})


// 


        $('.coman').change(function() {

// alert('1')
$("#radio_id_morning0").prop('checked', true);

$("#onlytody_date").attr("style", "display: none !important");;
$("#excepttody_date").attr("style", "display: block !important");;


$(".delivery_date_cls").val($(this).val())
})


        $('.delivery_today_date_vals').change(function() {

// alert('2')

$("#onlytody_date").attr("style", "display: block !important");;
$("#excepttody_date").attr("style", "display: none !important");;


});




        $('.delivery_time_vals').change(function() {

// alert(1)
$(".delivery_time_cls").val($(this).val())
})


        $('.addToCards').on('click','.addtocard',function(){

            var id=$(this).attr('data');
            
            $("#counter-div"+id).show();
            $("#addtocard"+id).hide();

$("#theCount"+id).text(1);
$("#theCountVal"+id).val(1);

// alert(1)


            $.ajax({
           type:"GET",
           url:"{{url('addcartitembyajax')}}?item_id="+id+"&quantity="+1,
           beforeSend: function(){
              $("#loader").show();
           },
           success:function(res){ 
                // console.log(res);
              // $("#mydiv"+id).load(location.href + " #mydiv"+id);

 $('#changecartcounter').text('');
              $('#changecartcounter').text(res.counter);           },
           complete:function(data){
                $("#loader").hide();
           }
         });


            });
// ..........................

       $('#modal_delete').on('click',function(){
        

            $.ajax({
           type:"GET",
           url:"{{url('removecarts')}}",
           beforeSend: function(){
              $("#loader").show();
           },
           success:function(res){ 
               var getUrl = "{{url('/'.Session::get('locality_url'))}}";  
     window.location.href = getUrl;

        },
           complete:function(data){
                $("#loader").hide();
           }
         });


            });

// .................

        $('.addToCards').on('click','.permanantyremoveitem',function(){

            var item_id = $(this).attr('data_id');

            var priquantity = $(this).parents('.parent_cls').find('.theCount').text();


$("#theCount"+item_id).text(0);
$(this).parents('.parent_cls').find('.qty-input').val(0);

var seturl = "{{url('removecartproduct')}}?item_id="+item_id;

 $.ajax({
           type:"GET",
           url:seturl,
           beforeSend: function(){
              $("#loader").show();
            },
           success:function(res){ 
                // console.log(res,'res');
           
              $('#changecartcounter').text('');
              $('#changecartcounter').text(res.counter);

              location.reload();

           },
           complete:function(data){
            $("#loader").hide();
           }
         });


})
// .......................................................................
        $('.addToCards').on('click','.changeitemquantity',function(){


        var attribute = $(this).attr('data'); 
            var item_id = $(this).attr('data_id');
            var element = $(this).parent().closest('form').serialize();

            var priquantity = $(this).parents('.parent_cls').find('.theCount').text();

           console.log(priquantity,'priquantity')


         if(attribute == 'addition'){


if(parseInt(priquantity) < 10 )
{
           var quantity = parseInt(priquantity) + 1;


$("#theCount"+item_id).text(quantity);
$(this).parents('.parent_cls').find('.qty-input').val(quantity);

console.log(quantity,'quantity')

           var seturl = "{{url('updatecartviewproductajax')}}?item_id="+item_id+"&mainqty="+1;
}

         }else{


          if(priquantity != 1){

            var quantity = parseInt(priquantity) - 1;

$("#theCount"+item_id).text(quantity);
$(this).parents('.parent_cls').find('.qty-input').val(quantity);


var seturl = "{{url('updatecartviewproductajax')}}?item_id="+item_id+"&mainqty="+-1;


          }else{

// alert(item_id)
$("#counter-div"+item_id).hide();
$("#addtocard"+item_id).show();


$("#theCount"+item_id).text(quantity);
$(this).parents('.parent_cls').find('.qty-input').val(quantity);



var seturl = "{{url('removecartproduct')}}?item_id="+item_id;

          } 


         }

         
if(parseInt(priquantity) < 10 )
{
         $.ajax({
           type:"GET",
           url:seturl,
           beforeSend: function(){
              $("#loader").show();
            },
           success:function(res){ 
                // console.log(res,'res');
           
             // $("#myCheckputCart").html('');
         $("#myCheckputCart").html(res.loadCheckoutbutton);




              $('#changecartcounter').text('');
              $('#changecartcounter').text(res.counter);
           },
           complete:function(data){
            $("#loader").hide();
           },
           error:function(err){
           console.log(err)
           }
         });

       }
      });
 });


$(".nav-item").click(function() {
    $('html,body').animate({
        scrollTop: $(".payment-mode").offset().top},
        'slow');
});

// ................................id



  
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
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }
  
});


var perfEntries = performance.getEntriesByType("navigation");

if (perfEntries[0].type === "back_forward") {
    // location.reload(true);\
            window.location.href = "{{url('/')}}";

}



      </script>




@endpush


