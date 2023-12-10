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
        <link href="{{ asset('public/frontend/css/our_team1.css') }}" rel="stylesheet">
        <link href="{{ asset('public/frontend/css/our_team2.css') }}" rel="stylesheet">

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
                          <li><i class="fa fa-phone mx-2" aria-hidden="true"></i>{{$admin->admin_mobile}}</li>
                        </a>
                        <a>
                          <li><i class="fa fa-envelope mx-2" aria-hidden="true"></i>{{$admin->admin_email}}</li>
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
            <li class="breadcrumb-item active" aria-current="page" style="text-transform:capitalize;">Our Team</li>
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
  <div class="u-body u-xl-mode">

    <section
      class="u-align-center-lg u-align-center-md u-align-center-sm u-align-center-xs u-align-left-xl u-clearfix u-section-1"
      id="carousel_640e">
      <div class="u-clearfix u-sheet u-sheet-1">
          <h4 class="m-4 text-center title-heading">Our Teams</h4>
          
        <div class="u-expanded-width u-palette-3-base u-shape u-shape-rectangle u-shape-1 m-auto"></div>
        <div class="u-expanded-width-sm u-expanded-width-xs u-list u-list-1">
          <div class="u-repeater u-repeater-1 ml-2">
            <div
              class="u-align-center u-container-style u-custom-item u-grey-5 u-list-item u-repeater-item u-list-item-2">
              <div class="u-container-layout u-similar-container u-valign-top u-container-layout-2">
                <img alt="" src="https://sarfaraztech.com/static/media/user1.8e1a1b6b781f6f870e95.jpg"
                  class="u-image u-image-circle u-image-3" data-image-width="810" data-image-height="1080">
                <h4 class="u-text u-text-default u-text-3">Sarfaraz Khan</h4>
                <h6 class="u-text u-text-default u-text-4">Social Media Manager</h6>
                <h3 class="mt-4"><i class="fa fa-facebook-official m-3" aria-hidden="true"></i><i class="fa fa-instagram m-3" aria-hidden="true"></i><i class="fa fa-twitter-square m-3" aria-hidden="true"></i></h3>
              </div>
            </div>
            <div
              class="u-align-center u-container-style u-custom-item u-grey-5 u-list-item u-repeater-item u-list-item-2">
              <div class="u-container-layout u-similar-container u-valign-top u-container-layout-2">
                <img alt="" src="https://sarfaraztech.com/static/media/user1.8e1a1b6b781f6f870e95.jpg"
                  class="u-image u-image-circle u-image-3" data-image-width="810" data-image-height="1080">
                <h4 class="u-text u-text-default u-text-3">Sarfaraz Khan</h4>
                <h6 class="u-text u-text-default u-text-4">Social Media Manager</h6>
                <h3 class="mt-4"><i class="fa fa-facebook-official m-3" aria-hidden="true"></i><i class="fa fa-instagram m-3" aria-hidden="true"></i><i class="fa fa-twitter-square m-3" aria-hidden="true"></i></h3>
              </div>
            </div>
            <div
              class="u-align-center u-container-style u-custom-item u-grey-5 u-list-item u-repeater-item u-list-item-2">
              <div class="u-container-layout u-similar-container u-valign-top u-container-layout-2">
                <img alt="" src="https://sarfaraztech.com/static/media/user1.8e1a1b6b781f6f870e95.jpg"
                  class="u-image u-image-circle u-image-3" data-image-width="810" data-image-height="1080">
                <h4 class="u-text u-text-default u-text-3">Sarfaraz Khan</h4>
                <h6 class="u-text u-text-default u-text-4">Social Media Manager</h6>
                <h3 class="mt-4"><i class="fa fa-facebook-official m-3" aria-hidden="true"></i><i class="fa fa-instagram m-3" aria-hidden="true"></i><i class="fa fa-twitter-square m-3" aria-hidden="true"></i></h3>
              </div>
            </div>
            
           
           
            

          </div>
        </div>
      </div>
    </section>

<hr>

    <section
      class="u-align-center-lg u-align-center-md u-align-center-sm u-align-center-xs u-align-left-xl u-clearfix u-section-1"
      id="carousel_640e">
      <div class="u-clearfix u-sheet u-sheet-1">
          <h4 class="m-4 text-center title-heading">Our Investers Member</h4>
        <div class="u-expanded-width u-palette-3-base u-shape u-shape-rectangle u-shape-1"></div>
        <div class="u-expanded-width-sm u-expanded-width-xs u-list u-list-1">
          <div class="u-repeater u-repeater-1">
            <div class="u-align-center u-container-style u-custom-item u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-valign-top u-container-layout-3">
                <img alt="" src="https://sarfaraztech.com/static/media/user1.8e1a1b6b781f6f870e95.jpg"
                  class="u-image u-image-circle u-image-3" data-image-width="810" data-image-height="1080">
                <h5 class="u-text u-text-default u-text-5">Sarfaraz Khan</h5>
                <h6 class="u-text u-text-default u-text-6">Designer</h6>
                <h6 class="mt-4"><i class="fa fa-facebook-official m-2" aria-hidden="true"></i><i class="fa fa-instagram m-2" aria-hidden="true"></i><i class="fa fa-twitter-square m-2" aria-hidden="true"></i></h6>
              </div>
            </div>
            <div class="u-align-center u-container-style u-custom-item u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-valign-top u-container-layout-3">
                <img alt="" src="https://sarfaraztech.com/static/media/user1.8e1a1b6b781f6f870e95.jpg"
                  class="u-image u-image-circle u-image-3" data-image-width="810" data-image-height="1080">
                <h5 class="u-text u-text-default u-text-5">Sarfaraz Khan</h5>
                <h6 class="u-text u-text-default u-text-6">Designer</h6>
                <h6 class="mt-4"><i class="fa fa-facebook-official m-2" aria-hidden="true"></i><i class="fa fa-instagram m-2" aria-hidden="true"></i><i class="fa fa-twitter-square m-2" aria-hidden="true"></i></h6>
              </div>
            </div>
            <div class="u-align-center u-container-style u-custom-item u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-valign-top u-container-layout-3">
                <img alt="" src="https://sarfaraztech.com/static/media/user1.8e1a1b6b781f6f870e95.jpg"
                  class="u-image u-image-circle u-image-3" data-image-width="810" data-image-height="1080">
                <h5 class="u-text u-text-default u-text-5">Sarfaraz Khan</h5>
                <h6 class="u-text u-text-default u-text-6">Designer</h6>
                <h6 class="mt-4"><i class="fa fa-facebook-official m-2" aria-hidden="true"></i><i class="fa fa-instagram m-2" aria-hidden="true"></i><i class="fa fa-twitter-square m-2" aria-hidden="true"></i></h6>
              </div>
            </div>
            <div class="u-align-center u-container-style u-custom-item u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-valign-top u-container-layout-3">
                <img alt="" src="https://sarfaraztech.com/static/media/user1.8e1a1b6b781f6f870e95.jpg"
                  class="u-image u-image-circle u-image-3" data-image-width="810" data-image-height="1080">
                <h5 class="u-text u-text-default u-text-5">Sarfaraz Khan</h5>
                <h6 class="u-text u-text-default u-text-6">Designer</h6>
                <h6 class="mt-4"><i class="fa fa-facebook-official m-2" aria-hidden="true"></i><i class="fa fa-instagram m-2" aria-hidden="true"></i><i class="fa fa-twitter-square m-2" aria-hidden="true"></i></h6>
              </div>
            </div>
            <div class="u-align-center u-container-style u-custom-item u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-valign-top u-container-layout-3">
                <img alt="" src="https://sarfaraztech.com/static/media/user1.8e1a1b6b781f6f870e95.jpg"
                  class="u-image u-image-circle u-image-3" data-image-width="810" data-image-height="1080">
                <h5 class="u-text u-text-default u-text-5">Sarfaraz Khan</h5>
                <h6 class="u-text u-text-default u-text-6">Designer</h6>
                <h6 class="mt-4"><i class="fa fa-facebook-official m-2" aria-hidden="true"></i><i class="fa fa-instagram m-2" aria-hidden="true"></i><i class="fa fa-twitter-square m-2" aria-hidden="true"></i></h6>
              </div>
            </div>

            
          </div>
        </div>
      </div>
    </section>
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


