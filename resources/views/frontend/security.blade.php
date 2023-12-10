@extends('frontend.layouts.app')
@section('title',"Online Shopping site in US: Shop Online for Mobiles, Books, Watches, Shoes and More - mandeclan.com")
<!-- ................Add meta ................ -->


@section('meta')
@endsection

<!-- ................custom css................. -->

@section('customStyle')
@endsection

<!-- ................Add css link................. -->

@push('style')
@endpush

<!-- ................body................. -->
@section('innercontent')

<div style="width:100%;padding-right:0px;" data-new-gr-c-s-check-loaded="14.1040.0" data-gr-ext-installed=""><div class="laptop-hide mobile-menu">
    <div class="row margin0">
        <div class="col-xs-6 padding0">
            <div class="image menu-bar">
                <img src="{{url('/')}}/public/frontend/img/mobile-menu.png">
            </div>
        </div>
        <div class="col-xs-6 padding0">
            <div class="pull-right">
                <div class="card-image">
                    <img src="{{url('/')}}/public/frontend/img/online-supermarket-cart.png">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mobile-header-overlay"></div>
<header class="checkout-header mobile-header">
    <img src="{{url('/')}}/public/frontend/img/delete-button.png" class="close-btn laptop-hide">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <a href="{{url('/'.Session::get('locality_url'))}}">
                    <div class="logo-image">
                      <img src="{{asset('public/img/mandeclan_logo.jpg')}}" width="70px">
                    </div>
                    <!-- <h4>Mande Clan</h4> -->
                </a>
            </div>
            <div class="col-md-9">
                <div class="pull-right mobile-pull-left">
                   <ul class="inline-block">
                        <a>
                          <li><img src="{{url('/')}}/public/frontend/img/phone-call.png">{{$admin->admin_mobile}}</li>
                        </a>
                        <a>
                          <li><img src="{{url('/')}}/public/frontend/img/help.png"> {{$admin->admin_email}}</li>
                        </a>
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
<!--  -->
<nav class="breadcrumb-nav">
   <div class="breadcrumb-padding">
      <div class="container-fluid">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/'.Session::get('locality_url'))}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page" style="text-transform:capitalize;">Security</li>
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
        <!-- content -->
<!--  -->
<div class="padding terms-condition">
	<div class="container-fluid">
		<h4 class="title-heading">Privacy Policy</h4>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
	</div>
</div>
<!--  -->
        <div class="mobile-device">
	<h4 class="logo">Mande-Clan</h4>
	<h4 class="h4">Buy Online Grocery from Grocery Shop Near by You</h4>
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
                  
</div>
@endsection

<!-- ................push new js link................. -->

@push('js')
<script src="{{asset('public/js/comman.js')}}"></script>
@endpush


