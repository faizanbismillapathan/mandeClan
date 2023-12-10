@extends('frontend.layouts.app')
@section('title',"Online Shopping site in US: Shop Online for Mobiles, Books, Watches, Shoes and More - mandeclan.com")
<!-- ................Add meta ................ -->


@section('meta')
@endsection

<!-- ................custom css................. -->

@section('customStyle')
<style type="text/css">
	  .padding.mande-main-category{
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
}
[type="radio"]:checked + label:before,
[type="radio"]:not(:checked) + label:before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
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
    top: 4px;
    left: 4px;
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


h4 {
    color: var(--varyDarkBlue);
    font-weight: var(--weight3);
}

h5 {
    color: var(--varyDarkBlue);
    font-weight: var(--weight3);
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

\
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
<!--  -->                
            <div id="overlay" style="display:none;">
            <div style="display:table;height:100%;width:100%;overflow:hidden;">
                <div style="display:table-cell;vertical-align:middle;">
                    <div class="center">
                        <img src="{{url('/')}}/public/img/demo_wait.gif" width="64" height="64">
                    </div>
                </div>
            </div>
        </div>
        <!--  -->
<!--  -->
<!--  -->
<div class="padding checkout-page">
	<div class="container-fluid">
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
                        
                         <div class="form-group col-md-6">
                          <div class="row">
                            <div class="col-md-4"><b>Created Date</b></div>
                            <div class="col-md-1"><b>:</b></div>
                            <div class="col-md-6">12-12-2020</div>
                          </div>         
                        </div>
                        
                         <div class="form-group col-md-6">
                          <div class="row">
                            <div class="col-md-4"><b>Last login</b></div>
                            <div class="col-md-1"><b>:</b></div>
                            <div class="col-md-6"> </div>
                          </div>         
                        </div>
                        <div class="form-group col-md-6">
                          <div class="row">
                            <div class="col-md-4"><b>Vendor Type</b></div>
                            <div class="col-md-1"><b>:</b></div>
                            <div class="col-md-6">11111</div>
                          </div>         
                        </div>
                        <div class="form-group col-md-6">
                          <div class="row">
                            <div class="col-md-4"><b>Shop Name</b></div>
                            <div class="col-md-1"><b>:</b></div>
                            <div class="col-md-6">22222 </div>
                          </div>         
                        </div>
                        <div class="form-group col-md-6">
                          <div class="row">
                            <div class="col-md-4"><b>Name</b></div>
                            <div class="col-md-1"><b>:</b></div>
                            <div class="col-md-6">2321312 </div>
                          </div>         
                        </div>
                                               
                        <div class="form-group col-md-6">
                          <div class="row">
                            <div class="col-md-4"><b>Contact No</b></div>
                            <div class="col-md-1"><b>:</b></div>
                            <div class="col-md-6">23221421 </div>
                          </div>         
                        </div>
                        <div class="form-group col-md-6">
                          <div class="row">
                            <div class="col-md-4"><b>Package</b></div>
                            <div class="col-md-1"><b>:</b></div>
                            <div class="col-md-6">23423424 </div>
                          </div>         
                        </div>
                        
                       
                       
                                                
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
							<label class="btn btn-secondary selfpickup">
								<input type="radio" name="pickup_type" id="self_pickup" autocomplete="off" value="self_pickup" class="pickup_type"> <i class="far fa-check-square"></i> Self Pickup
							</label>
							<label class="btn btn-secondary home-delivery">
								<input type="radio" name="pickup_type" id="delivery_pickup" autocomplete="off" value="delivery_pickup" class="pickup_type"> <i class="far fa-check-square"></i> Home Delivery
							</label>
						</div>
					</div>
					<hr>
					<div class="self-pickup-btn">
						<div class="row">
							<div class="col-md-12">
								<button class="btn btn-raised btn-success margin-top20" id="nextTwo">Next</button>
							</div>
						</div>
					</div>
					<!--  -->
					<div class="shipping-address-div">

						{{-- '''''''''''''''''' --}}

						<div class="grid">

{{-- ........adil task ........... --}}
									<div class="row">


								

						<div class="col-md-6 col-xs-6">
 <div class="box box-down blue">
     <div style="display:flex;justify-content:space-between"> 
     
     <h4>Imran</h4>
        <p>
    <input type="radio" id="test1" name="radio-group" checked>
    <label for="test1"></label>
  </p>
         
     </div>
   
      <p>Raskunj, Sadar Bazar, Nagpur, India</p>
    </div>

</div>

						<div class="col-md-6 col-xs-6">
 <div class="box box-down cyan">
      <div style="display:flex;justify-content:space-between"> 
      <h4>Siddique</h4>
        <p>
    <input type="radio" id="test2" name="radio-group">
    <label for="test2"></label>
  </p>
  </div>
      <p>Shabana Bakery, Chaonni , Nagpur</p>
    </div>

</div>

	<div class="col-md-6 col-xs-6">
 <div class="box box-down orange">
    <div style="display:flex;justify-content:space-between"> 
      <h4>Adil</h4>
        <p>
    <input type="radio" id="test3" name="radio-group">
    <label for="test3"></label>
  </p>
  </div>
      <p>Shabana Bakery, Chaonni , Nagpur</p>
    </div>

</div>

	<div class="col-md-6 col-xs-6">
 <div class="box box-down red">
     <div style="display:flex;justify-content:space-between"> 
      <h4>Ahmed</h4>
        <p>
    <input type="radio" id="test4" name="radio-group">
    <label for="test4"></label>
  </p>
  </div>
      <p>Raskunj, Sadar Bazar, Nagpur, India</p>
    </div>

</div>


</div>
 
 {{-- ........adil task end........... --}}

</div>
						{{-- <div class="width60">
							<div class="btn-group btn-group-toggle" data-toggle="buttons">
								<div class="row">
									<div class="col-md-6 col-xs-6">
										<label class="btn btn-secondary address-book-tab address-type radio_address_books active">
											<input type="radio" name="address_type" autocomplete="off" value="address_book" class="address_type"> <i class="far fa-check-circle"></i> Address Book
										</label>
									</div>
									<div class="col-md-6 col-xs-6">
										<label class="btn btn-secondary guest-user-tab address-type">
											<input type="radio" name="address_type" autocomplete="off" value="guest_book" class="address_type"> <i class="far fa-check-circle"></i> Guest User
										</label>
									</div>
								</div>
							</div>
						</div> --}}
						{{-- <div class="address-book">
															<div class="no-address">
									<img src="{{url('/')}}/public/frontend/img/no-address.png">
								</div>
								<h4 class="center">Soory, Your address book is empty</h4>
								<p class="center">Please add address in <a href="{{url('/')}}/my-address-book"><span>address book</span></a></p>
								<div class="row width60">
									<div class="col-md-5 col-xs-5">
										<div class="left-line"></div>
									</div>
									<div class="col-md-2 col-xs-2">
										<div class="or">
											<span>OR</span>
										</div>
									</div>
									<div class="col-md-5 col-xs-5">
										<div class="right-line"></div>
									</div>
								</div>
								<p class="center">Please order as<span class="guest-user-tab-link">Guest User</span></p>
													</div> --}}
						<!--  -->
						<style>
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
						</style>
						<div class="guest-User">
							<div class="row">
								<div class="col-md-3">
									<div class="static-label">
										<label>State</label>
										<p id="guestStateName">Maharashtra</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="static-label">
										<label>City</label>
										<p id="guestCityName">Nagpur</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group bmd-form-group is-filled">
										<label class="bmd-label-floating">Area</label>
										<select class="form-control select-area" name="area_name" id="guestAreaName" required="" onfocus="this.size=8;" onblur="this.size=1;" onchange="this.size=1; this.blur();" style="padding:10px;">
											<option disabled="" selected="" value="">Select Area</option>
																							<option value="Ashok Nagar" id="guestAreaId21">Ashok Nagar</option>
																							<option value="Bajaj Nagar" id="guestAreaId12">Bajaj Nagar</option>
																							<option value="Chaoni" id="guestAreaId18">Chaoni</option>
																							<option value="Civil Lines" id="guestAreaId14">Civil Lines</option>
																							<option value="Dhantoli" id="guestAreaId13">Dhantoli</option>
																							<option value="Dharampeth" id="guestAreaId6">Dharampeth</option>
																							<option value="Hingna T Point" id="guestAreaId7">Hingna T Point</option>
																							<option value="Jaripatka" id="guestAreaId1">Jaripatka</option>
																							<option value="Mohan Nagar" id="guestAreaId16">Mohan Nagar</option>
																							<option value="Mominpura" id="guestAreaId10">Mominpura</option>
																							<option value="New Indora, Jariptaka." id="guestAreaId19">New Indora, Jariptaka.</option>
																							<option value="Pachpaoli" id="guestAreaId11">Pachpaoli</option>
																							<option value="Ravi Nagar" id="guestAreaId17">Ravi Nagar</option>
																							<option value="Sadar" id="guestAreaId4">Sadar</option>
																							<option value="Seminary Hills" id="guestAreaId15">Seminary Hills</option>
																							<option value="Sitabuldi" id="guestAreaId9">Sitabuldi</option>
																							<option value="Vaishali Nagar" id="guestAreaId22">Vaishali Nagar</option>
																							<option value="Wardha Road" id="guestAreaId8">Wardha Road</option>
																					</select>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group static-label">
										<label class="bmd-label-floating" style="top:1rem!important;">Zip Code</label>
										
										<p id="guestPincode">******</p>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group bmd-form-group">
										<label class="bmd-label-floating" style="top:1rem!important;">Landmark</label>
										<input class="form-control" placeholder="Enter the Landmark." id="guestLandmark">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group bmd-form-group">
										<label class="bmd-label-floating" style="top:1rem!important;">Address</label>
										<textarea class="form-control" rows="3" placeholder="Enter your address to for dlivery." id="guestAddress"></textarea>
									</div>
								</div>
								<div class="col-md-12">
									<button class="btn btn-raised btn-success margin-top20" id="nextThree">Next</button>
								</div>
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
					Pickup Time
				</div>
			</div>
			<div id="collapseTen" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
				<div class="card-body shipping-address">
					<!--  -->
					<div class="delivery-method">
					    <div class="row mb-3">
					        <h5 class="col-md-2 text-capitalize">day</h5>
					        <div class="col-md-10 d-flex justify-content-start align-items-center">
					            <button type="button" class="buttons d-flex flex-column align-items-center selected-day"><span>today</span><span>(11 Mar)</span></button>
                                <button type="button" class="buttons d-flex flex-column align-items-center"><span>tomorrow</span><span>(12 Mar)</span></button>
                                <button type="button" class="buttons d-flex flex-column align-items-center"><span>today</span><span>(13 Mar)</span></button>
					        </div>
					    </div>
					    <div class="row">
					        <h5 class="col-md-2 text-capitalize">time</h5>
					        <div class="col-md-10 d-flex justify-content-start align-items-center">
					            <button type="button" class="buttons">10:00 A.M to 02:00 P.M</button>
                                <button type="button" class="buttons">02:00 P.M to 05:00 P.M</button>
                                <button type="button" class="buttons">05:00 P.M to 08:00 P.M</button>
					        </div>
					    </div>
						<!--<div class="btn-group btn-group-toggle" data-toggle="buttons" id="radio_delivery_by">-->
						<!--	<label class="btn btn-secondary selfpickup">-->
						<!--		<input type="radio" name="pickup_type" id="self_pickup" autocomplete="off" value="self_pickup" class="pickup_type"> <i class="far fa-check-square"></i> Self Pickup-->
						<!--	</label>-->
						<!--	<label class="btn btn-secondary home-delivery">-->
						<!--		<input type="radio" name="pickup_type" id="delivery_pickup" autocomplete="off" value="delivery_pickup" class="pickup_type"> <i class="far fa-check-square"></i> Home Delivery-->
						<!--	</label>-->
						<!--</div>-->
					</div>
					<hr>
					<div class="self-pickup-btn">
						<div class="row">
							<div class="col-md-12">
								<button class="btn btn-raised btn-success margin-top20" id="nextTwo">Next</button>
							</div>
						</div>
					</div>
					<!--  -->
					<div class="shipping-address-div">

						{{-- '''''''''''''''''' --}}

						<div class="grid">

{{-- ........adil task ........... --}}
									<div class="row">


								

						<div class="col-md-6 col-xs-6">
 <div class="box box-down blue">
     <div style="display:flex;justify-content:space-between"> 
     
     <h4>Imran</h4>
        <p>
    <input type="radio" id="test1" name="radio-group" checked>
    <label for="test1"></label>
  </p>
         
     </div>
   
      <p>Raskunj, Sadar Bazar, Nagpur, India</p>
    </div>

</div>

						<div class="col-md-6 col-xs-6">
 <div class="box box-down cyan">
      <div style="display:flex;justify-content:space-between"> 
      <h4>Siddique</h4>
        <p>
    <input type="radio" id="test2" name="radio-group">
    <label for="test2"></label>
  </p>
  </div>
      <p>Shabana Bakery, Chaonni , Nagpur</p>
    </div>

</div>

	<div class="col-md-6 col-xs-6">
 <div class="box box-down orange">
    <div style="display:flex;justify-content:space-between"> 
      <h4>Adil</h4>
        <p>
    <input type="radio" id="test3" name="radio-group">
    <label for="test3"></label>
  </p>
  </div>
      <p>Shabana Bakery, Chaonni , Nagpur</p>
    </div>

</div>

	<div class="col-md-6 col-xs-6">
 <div class="box box-down red">
     <div style="display:flex;justify-content:space-between"> 
      <h4>Ahmed</h4>
        <p>
    <input type="radio" id="test4" name="radio-group">
    <label for="test4"></label>
  </p>
  </div>
      <p>Raskunj, Sadar Bazar, Nagpur, India</p>
    </div>

</div>


</div>
 
 {{-- ........adil task end........... --}}

</div>
						{{-- <div class="width60">
							<div class="btn-group btn-group-toggle" data-toggle="buttons">
								<div class="row">
									<div class="col-md-6 col-xs-6">
										<label class="btn btn-secondary address-book-tab address-type radio_address_books active">
											<input type="radio" name="address_type" autocomplete="off" value="address_book" class="address_type"> <i class="far fa-check-circle"></i> Address Book
										</label>
									</div>
									<div class="col-md-6 col-xs-6">
										<label class="btn btn-secondary guest-user-tab address-type">
											<input type="radio" name="address_type" autocomplete="off" value="guest_book" class="address_type"> <i class="far fa-check-circle"></i> Guest User
										</label>
									</div>
								</div>
							</div>
						</div> --}}
						{{-- <div class="address-book">
															<div class="no-address">
									<img src="{{url('/')}}/public/frontend/img/no-address.png">
								</div>
								<h4 class="center">Soory, Your address book is empty</h4>
								<p class="center">Please add address in <a href="{{url('/')}}/my-address-book"><span>address book</span></a></p>
								<div class="row width60">
									<div class="col-md-5 col-xs-5">
										<div class="left-line"></div>
									</div>
									<div class="col-md-2 col-xs-2">
										<div class="or">
											<span>OR</span>
										</div>
									</div>
									<div class="col-md-5 col-xs-5">
										<div class="right-line"></div>
									</div>
								</div>
								<p class="center">Please order as<span class="guest-user-tab-link">Guest User</span></p>
													</div> --}}
						<!--  -->
						<style>
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
						</style>
						<div class="guest-User">
							<div class="row">
								<div class="col-md-3">
									<div class="static-label">
										<label>State</label>
										<p id="guestStateName">Maharashtra</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="static-label">
										<label>City</label>
										<p id="guestCityName">Nagpur</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group bmd-form-group is-filled">
										<label class="bmd-label-floating">Area</label>
										<select class="form-control select-area" name="area_name" id="guestAreaName" required="" onfocus="this.size=8;" onblur="this.size=1;" onchange="this.size=1; this.blur();" style="padding:10px;">
											<option disabled="" selected="" value="">Select Area</option>
																							<option value="Ashok Nagar" id="guestAreaId21">Ashok Nagar</option>
																							<option value="Bajaj Nagar" id="guestAreaId12">Bajaj Nagar</option>
																							<option value="Chaoni" id="guestAreaId18">Chaoni</option>
																							<option value="Civil Lines" id="guestAreaId14">Civil Lines</option>
																							<option value="Dhantoli" id="guestAreaId13">Dhantoli</option>
																							<option value="Dharampeth" id="guestAreaId6">Dharampeth</option>
																							<option value="Hingna T Point" id="guestAreaId7">Hingna T Point</option>
																							<option value="Jaripatka" id="guestAreaId1">Jaripatka</option>
																							<option value="Mohan Nagar" id="guestAreaId16">Mohan Nagar</option>
																							<option value="Mominpura" id="guestAreaId10">Mominpura</option>
																							<option value="New Indora, Jariptaka." id="guestAreaId19">New Indora, Jariptaka.</option>
																							<option value="Pachpaoli" id="guestAreaId11">Pachpaoli</option>
																							<option value="Ravi Nagar" id="guestAreaId17">Ravi Nagar</option>
																							<option value="Sadar" id="guestAreaId4">Sadar</option>
																							<option value="Seminary Hills" id="guestAreaId15">Seminary Hills</option>
																							<option value="Sitabuldi" id="guestAreaId9">Sitabuldi</option>
																							<option value="Vaishali Nagar" id="guestAreaId22">Vaishali Nagar</option>
																							<option value="Wardha Road" id="guestAreaId8">Wardha Road</option>
																					</select>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group static-label">
										<label class="bmd-label-floating" style="top:1rem!important;">Zip Code</label>
										
										<p id="guestPincode">******</p>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group bmd-form-group">
										<label class="bmd-label-floating" style="top:1rem!important;">Landmark</label>
										<input class="form-control" placeholder="Enter the Landmark." id="guestLandmark">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group bmd-form-group">
										<label class="bmd-label-floating" style="top:1rem!important;">Address</label>
										<textarea class="form-control" rows="3" placeholder="Enter your address to for dlivery." id="guestAddress"></textarea>
									</div>
								</div>
								<div class="col-md-12">
									<button class="btn btn-raised btn-success margin-top20" id="nextThree">Next</button>
								</div>
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
                  </div>

                  <div class="dashed-border"></div>
                  <div class="row">
                  	<div class="col-md-2 col-xs-2">
						<div class="step-counter">
							<p>4</p>
						</div>
                  	</div>
                  	<div class="col-md-10 col-xs-10">
	                  <div class="card card-checkout">
					    <div class="card-header" id="headingFour">
					        <div class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour" id="clickFour">
					          Payment Mode
					        </div>
					    </div>
					    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
					      <div class="card-body">
					        <div class="payment-mode">

{{-- 
<div class="card">
<div class="card-body">
<div style="display:flex;">
<p>
<input type="radio" id="testA" name="radio-group1" checked>
<label for="testA"></label>
</p>
<h6>Paypal</h6>

</div>
</div>
</div> --}}

 <div class="card">
      <div class="card-body">

        <div class="row">
          <div class="col-md-4 mb-3">
            <ul class="nav nav-pills flex-column" id="myTab" role="tablist">
              <!-- ......... -->

@if($configs->paypal_enable==1)
              <li class="nav-item">
                <a class="nav-link" id="tab_paypal" data-toggle="tab" href="#id_tab_paypal" role="tab" aria-controls="id_tab_paypal" aria-selected="true">    
                Pay Via Paypal </a>
              </li>
              @endif

              <!-- ......... -->
@if($configs->stripe_enable==1)

              <li class="nav-item"> <a class="nav-link  {
              { $configs->stripe_enable==1 ? "Active" : "Deactive" }}"
              id="tab_stripe" data-toggle="tab" href="#id_tab_stripe"
              role="tab" aria-controls="id_tab_stripe"
              aria-selected="true">Pay Via Stripe</a> </li>
              @endif


              <!-- ......... -->
@if($configs->paytm_enable==1)

              <li class="nav-item"> <a class="nav-link " id="tab_paytm"
              data-toggle="tab" href="#id_tab_paytm" role="tab"
              aria-controls="id_tab_paytm" aria-selected="true">   Pay Via
              Paytm</a> </li>
@endif

              <!-- ......... -->

@if($configs->razorpay==1)

              <li class="nav-item"> <a class="nav-link " id="tab_razorPay"
              data-toggle="tab" href="#id_tab_razorPay" role="tab"
              aria-controls="id_tab_razorPay" aria-selected="true">   Pay Via
              RazorPay</a> </li>

              @endif


              <!-- ......... -->
@if($configs->skrill_enable==1)

              <li class="nav-item"> <a class="nav-link " id="tab_skrill"
              data-toggle="tab" href="#id_tab_skrill" role="tab"
              aria-controls="id_tab_skrill" aria-selected="true">   Pay Via
              Skrill</a> </li>
@endif

              <!-- ......... -->
@if($configs->braintree_enable==1)

              <li class="nav-item"> <a class="nav-link " id="tab_braintree"
              data-toggle="tab" href="#id_tab_braintree" role="tab"
              aria-controls="id_tab_braintree" aria-selected="true">   Pay
              Via Braintree</a> </li>
@endif

              <!-- ......... -->

            {{--   <li class="nav-item">
                <a class="nav-link " id="tab_bank" data-toggle="tab" href="#id_tab_bank" role="tab" aria-controls="id_tab_bank" aria-selected="true">Bank Transfer
                </a>
              </li> --}}


  <li class="nav-item">
                <a class="nav-link " id="tab_bank" data-toggle="tab" href="#id_tab_bank" role="tab" aria-controls="id_tab_bank" aria-selected="true">Pay On Delivery
                </a>
              </li>



              


              <!-- ......... -->

            </ul>
          </div>
          <!-- .................................. -->
          <div class="col-md-8">
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="id_tab_paypal" role="tabpanel" aria-labelledby="tab_paypal">

                  <a class="btn btn-primary m-3" href="{{ route('processTransaction') }}">Pay $1000</a>
    @if(\Session::has('error'))
        <div class="alert alert-danger">{{ \Session::get('error') }}</div>
        {{ \Session::forget('error') }}
    @endif
    @if(\Session::has('success'))
        <div class="alert alert-success">{{ \Session::get('success') }}</div>
        {{ \Session::forget('success') }}
    @endif
          </div>


          <!-- ........................... -->

          <div class="tab-pane fade show" id="id_tab_stripe" role="tabpanel" aria-labelledby="tab_stripe">
            @if(!empty($record))
            {!! Form::model($record,array('url' => ['admin/stripe_setting', $record->id],'method'=>'PATCH','class'=>'','id' =>'comman_form_id','files'=>'true')) !!}
            @else
            {!!Form::open(['url'=>['admin/stripe_setting'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}

            @endif

          <div class="row">
            <div class="col-md-12 col-md-offset-6">
               <div class="panel panel-default credit-card-box">
                  <div class="panel-heading display-table" >
                     <div class="row display-tr" >
                        <h3 class="panel-title display-td" >Payment Details</h3>
                        <div class="display-td" >                            
                           <img class="img-responsive pull-right" src="{{url('public/frontend/img/stripe-payment-icon.png')}}" width="150px" height="50px">
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
                     {!!Form::open(['route'=>['stripe.post'],'method' =>'POST', 'role'=>'form','class' =>'require-validation form-bordered form-row-stripped','id'=>'comman_form_id','data-cc-on-file'=>'false','data-stripe-publishable-key'=>env('STRIPE_KEY')])!!}
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
                {!!Form::email('user_email',Auth::user()->email,array('class'=>'form-control custom_form_control com_episo emailfull','id'=>'exampleInputEmail1','aria-describedby'=>'emailHelp')) !!} 
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form_group form-group">
               <label>Card Number</label>
                {!!Form::text('card_number',null,array('class'=>'form-control custom_form_control com_episo card-inputs card-numbers numbersOnly','autocomplete'=>'off','required', 'placeholder'=>'1234 1234 1234 1234','minlength'=>'12','maxlength'=>'18')) !!}
            </div>
          </div>
        </div>
        
        <div class="row">
        <div class="col-md-6">
          <div class="form_group form-group">
                        <label>Cvv</label>
                        {!!Form::text('ccv',null,array('class'=>'form-control custom_form_control com_episo  card-inputs numbersOnly card-cvc','autocomplete'=>'off','required','placeholder'=>'123','minlength'=>'3','maxlength'=>'3')) !!}
             
          </div>
        </div>
        <div class="col-md-6">
          <div class="form_group form-group">
                        <label>Expiry Date</label>
                        {!!Form::text('expiration_date',null,array('class'=>'form-control custom_form_control com_episo card-inputs atm_mask_date','autocomplete'=>'off','placeholder'=>'MM/YY')) !!} 
             
          </div>
        </div>
      </div>
        <p>&nbsp;</p>
        <input type="hidden" name="invoice_id" value="{{Session::get('episode_invoice_id')  }}">
        <input type="hidden" name="transection_id" value="{{Session::get('episode_transaction_id')  }}">
        <div class="row">
          <div class="col-md-6">
               <button type="submit" class="btn btn-raised btn-secondary">Pay $ {{ Session::get('total_amount') }}</button>
            </div>
        </div>
            {{ Form::close() }}
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
             

            </div>
          </div>

          <div class="card-content" style="padding:20px">
           <div class="form-row">


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
          

         </div>
       </div>

       <div class="card-content" style="padding:20px">
         <div class="form-row">



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
            

          </div>
        </div>

        <div class="card-content" style="padding:20px">

      
        <div class="form-row">

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
         

        </div>
      </div>

      <div class="card-content" style="padding:20px">
       <div class="form-row">


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
					        
					          <button class="btn btn-raised btn-success" id="placeOrderCheckout">Place Order</button>
					        
					      </div>
					    </div>
					  </div>
                  	</div>
                  	
                  </div>

				</div>
				<!--  -->
			</div>
			<div class="col-md-4">
				<div class="product-list-checkout">
				    <div class="card card4">
				        <div class="card-header">
				            <h5>Cart <small>( <span id="sidebar_cart">2</span> Items )</small></h5>
				        </div>
				        <div class="card-body sidecart-not-empty" style="">
				        	<span id="cart_items_rows">
				        					            <div class="row row1" id="row_1923">
				                <div class="col-md-11">
				                    <p class="p1">Aashirvaad Multigrain Atta</p>
				                </div>
				                <div class="col-md-1">
								<div class="pull-right">
									<img src="{{url('/')}}/public/frontend/img/delete-item.png" class="trash-img delete" data-toggle="modal" data-target="#delete" id="delete_1923">
								</div>
							</div>
				                <div class="col-md-3">
				                    <div class="add-to-card" style="width: 100%; float: unset;">
				                        <div class="product">
				                            <div class="counter-div counter-div1923">
				                                <div class="row">
				                                    <div class="col-md-4">
				                                        <div class="icon-div minus" id="minus1923">
				                                            <i class="fas fa-minus"></i>
				                                        </div>
				                                    </div>
				                                    <div class="col-md-4">
				                                        <p class="counter" id="theCount1923">1</p>
				                                    </div>
				                                    <div class="col-md-4">
				                                        <div class="pull-right">
				                                            <div class="icon-div add" id="add1923">
				                                                <i class="fas fa-plus"></i>
				                                            </div>
				                                        </div>
				                                    </div>
				                                </div>
				                            </div>
				                            
				                        </div>
				                    </div>
				                </div>
				                <div class="col-md-5">
				                    <div class="center margin-top7">
				                        <span class="span">1 kg</span>
				                    </div>
				                </div>
				                <div class="col-md-4">
				                    <div class="pull-right">
				                        <p class="p2"><img src="{{url('/')}}/public/frontend/img/dollar.png"> 50</p>
				                    </div>
				                </div>
				            </div>
				            				            <div class="row row1" id="row_3131">
				                <div class="col-md-11">
				                    <p class="p1">Aashirvaad Select Superior Sharbati Whole Wheat Atta</p>
				                </div>
				                <div class="col-md-1">
								<div class="pull-right">
									<img src="{{url('/')}}/public/frontend/img/delete-item.png" class="trash-img delete" data-toggle="modal" data-target="#delete" id="delete_3131">
								</div>
							</div>
				                <div class="col-md-3">
				                    <div class="add-to-card" style="width: 100%; float: unset;">
				                        <div class="product">
				                            <div class="counter-div counter-div3131">
				                                <div class="row">
				                                    <div class="col-md-4">
				                                        <div class="icon-div minus" id="minus3131">
				                                            <i class="fas fa-minus"></i>
				                                        </div>
				                                    </div>
				                                    <div class="col-md-4">
				                                        <p class="counter" id="theCount3131">1</p>
				                                    </div>
				                                    <div class="col-md-4">
				                                        <div class="pull-right">
				                                            <div class="icon-div add" id="add3131">
				                                                <i class="fas fa-plus"></i>
				                                            </div>
				                                        </div>
				                                    </div>
				                                </div>
				                            </div>
				                            
				                        </div>
				                    </div>
				                </div>
				                <div class="col-md-5">
				                    <div class="center margin-top7">
				                        <span class="span">5 kg</span>
				                    </div>
				                </div>
				                <div class="col-md-4">
				                    <div class="pull-right">
				                        <p class="p2"><img src="{{url('/')}}/public/frontend/img/dollar.png"> 275</p>
				                    </div>
				                </div>
				            </div>
				            				            <!--  -->
				            <div class="total-weight">
				            	<div class="row">
				            		<div class="col-md-5 col-xs-5">
				            			<h6 class="h6">Total Weight</h6>
				            		</div>
				            		<div class="col-md-1 col-xs-1">
				            			<div class="pull-right">
				            			  <h6>:</h6>
				                 		</div>
				            		</div>
				            		<div class="col-md-6 col-xs-6">
				            			<div class="pull-right">
					            			<h6>
					            			 	<span id="sideCart_weigth">
								                	6 Kg
								            	</span>
								            </h6>
				            			</div>
				            		</div>
				            	</div>
				            </div>
				            <!--  -->
				            <div class="total-cost">
				                <div class="row">
				                    <div class="col-md-6 col-xs-6">
				                        <p>Sub Total</p>
				                    </div>
				                    <div class="col-md-1 col-xs-1">
				                        <p>:</p>
				                    </div>
				                    <div class="col-md-5 col-xs-5">
				                        <div class="pull-right">
				                            <p><img src="{{url('/')}}/public/frontend/img/dollar.png"> <span id="sideCart_subtotal">325.00</span></p>
				                        </div>
				                    </div>
				                </div>
				                <div class="row">
				                    <div class="col-md-6 col-xs-6">
				                        <p>Delivery Charges</p>
				                    </div>
				                    <div class="col-md-1 col-xs-1">
				                        <p>:</p>
				                    </div>
				                    <div class="col-md-5 col-xs-5">
				                        <div class="pull-right">
				                            <p><img src="{{url('/')}}/public/frontend/img/dollar.png"> <span id="sideCart_delivery">39.00</span></p>
				                        </div>
				                    </div>
				                </div>
				                <hr>
				                <div class="row">
				                    <div class="col-md-6 col-xs-6">
				                        <p>Total</p>
				                    </div>
				                    <div class="col-md-1 col-xs-1">
				                        <p>:</p>
				                    </div>
				                    <div class="col-md-5 col-xs-5">
				                        <div class="pull-right">
				                            <p><img src="{{url('/')}}/public/frontend/img/dollar.png"> <span id="sideCart_total">364.00</span></p>
				                        </div>
				                    </div>
				                </div>
				            </div>
				        	</span>
				        </div>
				        <div class="card-body sidecart-empty" style="display:none;">
							<div class="row row1">
								<div class="col-md-12 center">
									<img src="{{url('/')}}/public/frontend/img/empty-cart-icon.png">
									<h4 class="center">No items in your cart</h4>
									<p class="center">Please Add Something in Your Cart</p>
								</div>
							</div>
						</div>
						<script>
							$(document).ready(function() {
								var cart_count = 2;
								if(cart_count != 0){
									$('.sidecart-not-empty').show();
									$('.sidecart-empty').hide();
								}else{
									$('.sidecart-not-empty').hide();
									$('.sidecart-empty').show();
								}
							});
						</script>
				    </div>
				</div>
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
				<span id="error_message">Error happend!</span>
				<button type="button" class="close" data-dismiss="modal">×</button>
			</div>
		</div>
	</div>
</div>
<span data-toggle="modal" data-target="#myModal" id="errorModalBtn"></span>
<!--  -->

<script type="text/javascript">
	$(document).ready(function() {

		// $(".minus").click(function(){
		$(document).on('click', '.minus', function(){

			if($(this).attr('id')){

				var thisId = $(this).attr('id');
				var optionId = thisId.substr(5);
				var count = $("#theCount"+optionId).text();
				var minimumOrder = '450';
				var storeName = 'Shafique Kirana Dukan';
				var storeArea = 'Sadar';
				var storeCity = 'Nagpur';
				var url = ""+storeCity.replace(/\s+/g, '-').toLowerCase()+"/"+storeArea.replace(/\s+/g, '-').toLowerCase()+"/"+storeName.replace(/\s+/g, '-').toLowerCase()+"/details";
				if(count == 1){
					$('#error_message').empty();
					$('#error_message').text('Item quantity is minimum 1, you cannot decrease this item quantity.');
					$('#errorModalBtn').click();
				}else{
					count--;
					$("#theCount"+optionId).text(count);
					$.ajax({
		                url: '{{url('/')}}/minus-product-count',
		                type: 'POST',
		                beforeSend: function(){
		                    $("#overlay").css("display", "block").delay(4000);
		                },
		                data: {
		                	_token: CSRF_TOKEN,
		                	id: optionId,
		                	qty: count
		                },
		                dataType: 'JSON',
		                success: function (data) {
		                    console.log(data);
		                    var cartCount = data.cartCount;
		                    var kgm = data.kgm;

			            	$('#shopping_cart span').empty();
			            	$('#shopping_cart span').text( cartCount );
			            	$('.mobile-cart-count').empty();
			            	$('.mobile-cart-count').text( cartCount );
			            	$('#sidebar_cart').text( cartCount );
		            		$('#sideCart_subtotal').empty();
				            $('#sideCart_subtotal').text(data.subtotal);
				            $('#sideCart_delivery').empty();
				            $('#sideCart_delivery').text(data.delivery_charges);
				            $('#sideCart_total').empty();
				            $('#sideCart_total').text(data.grand_total);
				            $('#sideCart_weigth').empty();
				            $('#sideCart_weigth').text(kgm);
				            if(data.subtotal < minimumOrder){
				            	$('.minimum-amount-warning-msg').empty();
				            	$('.minimum-amount-warning-msg').append("<div class='alert alert-warning' style='text-align:center;'><strong>Warning!</strong> You should have to incrise your cart value, <a href='#' class='alert-link'>Minimum purchase subtotal is "+minimumOrder+"</a> By <a href='"+url+"' class='alert-link'>"+storeName+"</a>.</div>");
				            	$('html, body').animate({scrollTop : 0},360);
				            }

		                },
		                complete: function(){
		                    $("#overlay").css("display", "none");
		                }
		            });
				}

			}
	    });
	    // adding product Qty to cart and showing the selected product with Qty
		// $('.add').click(function(){
		$(document).on('click', '.add', function(){

			if($(this).attr('id')){

				var thisId = $(this).attr('id');
				var optionId = thisId.substr(3);
				console.log(optionId);
				var count = $("#theCount"+optionId).text();
				var minimumOrder = '450';
				if(count <= 9){
					count++;
					$("#theCount"+optionId).text(count);
					console.log(count);
		            $.ajax({
		                url: '{{url('/')}}/plus-product-count',
		                type: 'POST',
		                beforeSend: function(){
		                    $("#overlay").css("display", "block").delay(4000);
		                },
		                data: {
		                	_token: CSRF_TOKEN,
		                	id: optionId,
		                	qty: count
		                },
		                dataType: 'JSON',
		                success: function (data) {
		                    console.log(data.weight);
		            		var cartCount = data.cartCount;
		                    var kgm = data.kgm;
		                	$('#shopping_cart span').empty();
		            		$('#shopping_cart span').text( cartCount );
			            	$('.mobile-cart-count').empty();
			            	$('.mobile-cart-count').text( cartCount );
		            		$('#sidebar_cart').text( cartCount );
		            		$('#sideCart_subtotal').empty();
				            $('#sideCart_subtotal').text(data.subtotal);
				            $('#sideCart_delivery').empty();
				            $('#sideCart_delivery').text(data.delivery_charges);
				            $('#sideCart_total').empty();
				            $('#sideCart_total').text(data.grand_total);
				            $('#sideCart_weigth').empty();
				            $('#sideCart_weigth').text(kgm);
				            if(data.subtotal >= minimumOrder){
				            	$('.minimum-amount-warning-msg').empty();
				            }
		                },
		                complete: function(){
		                    $("#overlay").css("display", "none");
		                }
		            });
				}else{
					console.log('you can not add more than 10');
					$('#error_message').empty();
					$('#error_message').text('Item quantity is maximum 10, you cannot increase this item quantity.');
					$('#errorModalBtn').click();
				}

			}
		});

		// $('.delete').on('click', function() {
		$(document).on('click', '.delete', function(){

			var thisId = $(this).attr('id');
			var optionId = thisId.substr(7);
			console.log(optionId);
            $.ajax({
                type:"GET",
                beforeSend: function(){
                    $("#overlay").css("display", "block").delay(4000);
                },
                url:"{{url('/')}}/get-front-cart-item-detail?id="+optionId,
                success:function(res){
					console.log('Responce: ',res);
					$('#item_delete_message').empty();
					$('#item_delete_message').text('Are you sure, want to delete '+res.name+' - '+res.option_name +' product ?');
				},
                complete: function(){
                    $("#overlay").css("display", "none");
                }
			});

			$(document).on('click', '#modal_delete', function(){

				$.ajax({
	                url: '{{url('/')}}/remove-product-count',
	                type: 'POST',
	                beforeSend: function(){
	                    $("#overlay").css("display", "block").delay(4000);
	                },
	                data: {
	                	_token: CSRF_TOKEN,
	                	id: optionId
	                },
	                dataType: 'JSON',
	                success: function (data) {
	                    console.log(data);
	                    var cartCount = data.cartCount;
	                    var kgm = data.kgm;
	                    if(cartCount == 0){
	                    	$('.sidecart-not-empty').hide();
	                    	$('.sidecart-empty').show();
	                    	location.reload();
	                    }else{
	                    	$('.sidecart-not-empty').show();
	                    	$('.sidecart-empty').hide();
		                	$('#shopping_cart span').empty();
			            	$('#shopping_cart span').text( cartCount );
			            	$('.mobile-cart-count').empty();
			            	$('.mobile-cart-count').text( cartCount );
			            	$('#sidebar_cart').text( cartCount );
		            		$('#sideCart_subtotal').empty();
				            $('#sideCart_subtotal').text(data.subtotal);
				            $('#sideCart_delivery').empty();
				            $('#sideCart_delivery').text(data.delivery_charges);
				            $('#sideCart_total').empty();
				            $('#sideCart_total').text(data.grand_total);
							$('#modal_cancel').click();
							$("#theCount"+optionId).text(0);
							$(".counter-div"+optionId).hide();
							$(".addtocard"+optionId).show();
							$("#cart_items_rows #row_"+optionId).remove();
				            $('#sideCart_weigth').empty();
				            $('#sideCart_weigth').text(kgm);
	                    }
						//
	                },
	                complete: function(){
	                    $("#overlay").css("display", "none");
	                }
	            });
			});
		});

		// for checkout
		var pickupType = $("input[name='pickup_type']:checked").val();
		var addressType = $("input[name='address_type']:checked").val();
					var addressOne = '';
			var addressTwo = '';
				var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

		$('#nextOne').click(function(){
			$('#clickTwo').click();
		});

		$('#radio_delivery_by').click(function(){
			$('.shipping-address-div .radio_address_books').click();
			$('.first-lable').click();
		});

		$('.selfpickup').click(function(){
			$('#clickThree').attr('data-target', '#collapseThree');
		});

		$('.home-delivery').click(function(){
			$('#clickThree').removeAttr('data-target');
		});

		$('#nextTwo').click(function(){
			var pickupType = $("input[name='pickup_type']:checked").val();
			if(pickupType == null || pickupType == undefined || pickupType == ''){
				$('#error_message').empty();
				$('#error_message').text('Please select the delivery by option.');
				$('#errorModalBtn').click();
			}else if(pickupType == 'self_pickup'){
				$('#clickThree').click();
			}
		});

		$('#guestAreaName').change(function(){
			var id = $(this).children(":selected").attr("id");
			// console.log('area_id: ',id);
            var areaId = id.substr(11);

            // console.log('Area id: ', areaId);

            if(areaId){
                $.ajax({
                    type:"GET",
                    url:"{{url('/')}}/get-pincode?ar_id="+areaId,
                    success:function(res){
                        console.log('Responce: ',res);
                        $('#guestPincode').empty();
                        $('#guestPincode').text(res.pincode);
                    }
                });
            }

        });

		$('#addessBookNext').click(function(){
			var addressbook = $("input[name='addressbook']:checked").val();
			if(addressbook == '' || addressbook == undefined){
				$('#error_message').empty();
				$('#error_message').text('Please select Your Address Book');
				$('#errorModalBtn').click();
			}else{
				console.log(addressbook);
				$('#clickThree').removeAttr('data-target');
				$('#clickThree').attr('data-target', '#collapseThree');
				$('#clickThree').click();
			}
		});

		$('#clickThree').click(function(){
			var pickupType = $("input[name='pickup_type']:checked").val();
			if(pickupType == '' || pickupType == undefined){
				console.log('undefined hai bhai');

				$('#error_message').empty();
				$('#error_message').text('Please select the delivery by option.');
				$('#errorModalBtn').click();

			}else if(pickupType == 'delivery_pickup'){

				var addressType = $("input[name='address_type']:checked").val();
				var addressbook = $("input[name='addressbook']:checked").val();

				if(addressType == '' || addressType == null || addressType == undefined){
					$('#error_message').empty();
					$('#error_message').text('Please select address type.');
					$('#errorModalBtn').click();
				}else if(addressType == 'address_book'){
					if(addressOne == '' || addressOne == null || addressOne == undefined){
						$('#error_message').empty();
						$('#error_message').text('Your address books are empty.');
						$('#errorModalBtn').click();
					}/*else{
						addressOne = addressbook;
					}*/
				}else if(addressType == 'guest_book'){
					var guestAreaName = $('#guestAreaName').val();
					var guestPincode = $('#guestPincode').text();
					var guestLandmark = $('#guestLandmark').val();
					var guestAddress = $('#guestAddress').val();
					// console.log(guestLandmark);
					if(guestAreaName == '' || guestAreaName == null){
						$('#error_message').empty();
						$('#error_message').text('Please select Your delivery Area.');
						$('#errorModalBtn').click();
					}else if(guestLandmark == ''){
						$('#error_message').empty();
						$('#error_message').text('Please select Your delivery Landmark.');
						$('#errorModalBtn').click();
					}else if(guestAddress == ''){
						$('#error_message').empty();
						$('#error_message').text('Please select Your delivery Address.');
						$('#errorModalBtn').click();
					}else{
						$('#clickThree').removeAttr('data-target');
						$('#clickThree').attr('data-target', '#collapseThree');
						// $('#clickThree').click();
					}
				}
				// console.log(addressType);
			}
		});

		$('#nextThree').click(function(){
			var guestAreaName = $('#guestAreaName').val();
			var guestPincode = $('#guestPincode').text();
			var guestLandmark = $('#guestLandmark').val();
			var guestAddress = $('#guestAddress').val();
			console.log(guestAreaName);
			if(guestAreaName == '' || guestAreaName == null){
				$('#error_message').empty();
				$('#error_message').text('Please select Your delivery Area.');
				$('#errorModalBtn').click();
			}else if(guestLandmark == ''){
				$('#error_message').empty();
				$('#error_message').text('Please select Your delivery Landmark.');
				$('#errorModalBtn').click();
			}else if(guestAddress == ''){
				$('#error_message').empty();
				$('#error_message').text('Please select Your delivery Address.');
				$('#errorModalBtn').click();
			}
			if(guestAreaName!='' && guestLandmark != '' && guestAddress != ''){
				$('#clickThree').removeAttr('data-target');
				$('#clickThree').attr('data-target', '#collapseThree');
				$('#clickThree').click();
			}
		});

		$('#deliveryDate').change(function(){
            var dateId = $(this).val();
            console.log('Delivery Date: ', dateId);

            if(dateId){
                $.ajax({
                    type:"GET",
                    url:"{{url('/')}}/get-front-delivery-slot-time?date="+dateId,
                    success:function(res){
                        console.log('Responce: ',res);
                        $('#deliverySlotTime').empty();
                        $('#deliverySlotTime').append('<option value="" selected="selected" disabled> Select Time Slot</option>');
                         $.each(res, function(index, element) {
                        //     // console.log( element.name );
                             $('#deliverySlotTime').append("<input type='hidden' velue='"+element.id+"' /><option value='"+element.id+"'>" + element.min +" To "+ element.max + "</option>");
                        });
                    }
                });
            }

        });

        $('#nextFour').click(function(){
			var deliveryDate = $('#deliveryDate').val();
			var deliverySlotTime = $('#deliverySlotTime').val();

			if(deliveryDate == '' || deliveryDate == null){
				$('#error_message').empty();
				$('#error_message').text('Please Select the delivery date.');
				$('#errorModalBtn').click();
			}else if(deliverySlotTime == '' || deliverySlotTime == null){
				$('#error_message').empty();
				$('#error_message').text('Please Select the delivery slot time.');
				$('#errorModalBtn').click();
			}else{
				$('#clickFour').click();
			}
		});

		$('#placeOrderCheckout').click(function(){

			if($('.payment_method').is(':checked')) {
				console.log("paymentMethod checked");
				var payment_method = $("input[name='payment_method']:checked").val();
				console.log(payment_method);
				var pickup_type = $("input[name='pickup_type']:checked").val();
				if(pickup_type == 'delivery_pickup'){
					var address_type = $("input[name='address_type']:checked").val();
					if(address_type == 'address_book'){
						var addressbook = $("input[name='addressBook']:checked").val();
						$addressOne = 'address_book_one';
						console.log(addressOne);
												var delivery_date = $('#deliveryDate').val();
						var slot_time = $('#deliverySlotTime').val();

						$.ajax({
		                    /* the route pointing to the post function */
		                    url: '{{url('/')}}/confirm-checkout',
		                    type: 'POST',
					        beforeSend: function(){
					            $("#overlay").css("display", "block").delay(4000);
					        },
		                    /* send the csrf-token and the input to the controller */
		                    data: {
		                    	_token: CSRF_TOKEN,
		                    	payment_method: payment_method,
		                    	pickup_type: pickup_type,
		                    	address_type: address_type,
		                    	area_name: area_name,
		                    	city_name: city_name,
		                    	state_name: state_name,
		                    	area_pin: area_pin,
		                    	landmark:landmark,
		                    	address:address,
		                    	delivery_date:delivery_date,
		                    	slot_time:slot_time,
		                    },
		                    dataType: 'JSON',
		                    /* remind that 'data' is the response of the AjaxController */
		                    success: function (data) {
		                        console.log(data);
		                        if(data.status == true){
		                        	window.location.assign('{{url('/')}}/thank-you?city='+data.city+'&order_id='+data.order_id);
		                        }else if(data.status == false){
		                        	$('html, body').animate({scrollTop : 0},360);
		                        }
		                    },
					        complete: function(){
					            $("#overlay").css("display", "none");
					        }
		                });

					}else if(address_type == 'guest_book'){
						console.log('guest-book');
						var area_name = $('#guestAreaName').val();
						var city_name = $('#guestCityName').text();
						var state_name = $('#guestStateName').text();
						var area_pin = $('#guestPincode').text();
						var landmark = $('#guestLandmark').val();
						var address = $('#guestAddress').val();

						var delivery_date = $('#deliveryDate').val();
						var slot_time = $('#deliverySlotTime').val();

						$.ajax({
		                    /* the route pointing to the post function */
		                    url: '{{url('/')}}/confirm-checkout',
		                    type: 'POST',
					        beforeSend: function(){
					            $("#overlay").css("display", "block").delay(4000);
					        },
		                    /* send the csrf-token and the input to the controller */
		                    data: {
		                    	_token: CSRF_TOKEN,
		                    	payment_method: payment_method,
		                    	pickup_type: pickup_type,
		                    	address_type: address_type,
		                    	area_name: area_name,
		                    	area_pin: area_pin,
		                    	city_name:city_name,
		                    	state_name:state_name,
		                    	landmark:landmark,
		                    	address:address,
		                    	delivery_date:delivery_date,
		                    	slot_time:slot_time,
		                    },
		                    dataType: 'JSON',
		                    /* remind that 'data' is the response of the AjaxController */
		                    success: function (data) {
		                        console.log(data);
		                        if(data.status == true){
		                        	window.location.assign('{{url('/')}}/thank-you?city='+data.city+'&order_id='+data.order_id);
		                        }else if(data.status == false){
		                        	$('html, body').animate({scrollTop : 0},360);
		                        }
		                    },
					        complete: function(){
					            $("#overlay").css("display", "none");
					        }
		                });
					}
				}else{
					// $('#error_message').empty();
					// $('#error_message').text('Please Select the delivery slot time.');
					// $('#errorModalBtn').click();
					console.log('self-pickup');
											var city_name = '---';
						var state_name = '---';
						var area_name = '---';
						var area_pin = '---';
						var landmark = '---';
						var address = '---';
					
					var delivery_date = $('#deliveryDate').val();
					var slot_time = $('#deliverySlotTime').val();

					$.ajax({
	                    /* the route pointing to the post function */
	                    url: '{{url('/')}}/confirm-checkout',
	                    type: 'POST',
				        beforeSend: function(){
				            $("#overlay").css("display", "block").delay(4000);
				        },
	                    /* send the csrf-token and the input to the controller */
	                    data: {
	                    	_token: CSRF_TOKEN,
	                    	payment_method: payment_method,
	                    	pickup_type: pickup_type,
	                    	address_type: address_type,
	                    	area_name: area_name,
	                    	area_pin: area_pin,
	                    	city_name:city_name,
	                    	state_name:state_name,
	                    	landmark:landmark,
	                    	address:address,
	                    	delivery_date:delivery_date,
	                    	slot_time:slot_time,
	                    },
	                    dataType: 'JSON',
	                    /* remind that 'data' is the response of the AjaxController */
	                    success: function (data) {
	                        console.log(data);
	                        if(data.status == true){
	                        	window.location.assign('{{url('/')}}/thank-you?city='+data.city+'&order_id='+data.order_id);
	                        }else if(data.status == false){
	                        	$('html, body').animate({scrollTop : 0},360);
	                        }
	                    },
				        complete: function(){
				            $("#overlay").css("display", "none");
				        }
	                });
				}

			}else{
				$('#error_message').empty();
				$('#error_message').text('Please Select the Payemt Method for delivery.');
				$('#errorModalBtn').click();
			}
		});



	});
</script>
<!--  -->
<script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script>
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
@endpush


