@if(!Auth::guest())
<?php

   if(Auth::user()->role == "1"){

       $result=DB::table('rv_user_registrations')
       ->select('rv_user_name','id','kyc_status','status','user_id')
       ->where('id',Session::get('servicepartner_id'))
       ->first();

       $users=DB::table('users')->where('id',$result->user_id)->first();

   }elseif(Auth::user()->role == "4"){

       $result=DB::table('rv_user_registrations')
       ->select('rv_user_name','id','kyc_status','status')
       ->where('user_id',Auth::user()->id)
       ->first();


              $users=DB::table('users')->where('id',Auth::user()->id)->first();

   }





?>
<div class="wrapper">
    <div class="d-flex">
       <nav class="sidebar">
        <div class="sidebar-content">
            <a class="sidebar-brand" href="{{url('/'.Session::get('locality_url'))}}">
               <img class="" src="{{asset('public/img/mandeclan_logo.jpg')}}" alt="" width="100%" height="100px">
           </a>

           <ul class="sidebar-nav">

            <li class="sidebar-item {{ Request::is('service-partner/dashboard*') ? 'active' : '' }}">
                <a href="{{url('service-partner/dashboard')}}" class="sidebar-link " id="dashboard">
                    <i class="fas fa-tachometer-alt"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>


            <li class="sidebar-item {{ Request::is('service-partner/profile*') ? 'active' : '' }}">
                <a href="{{url('service-partner/profile')}}" class="sidebar-link " id="profile">
                    <i class="fas fa-user"></i><span class="align-middle">My Account</span>
                </a>
            </li>

 @if($result->kyc_status=='Active')
<li class="sidebar-item {{ Request::is('service-partner/vehicle-list*') ? 'active' : '' }}">
    <a href="{{url('service-partner/vehicle-list')}}" class="sidebar-link " id="vehicle-list">
     <i class="fas fa-truck"></i> <span class="align-middle">Vehicle List </span>
 </a>
</li>
@else

<li class="sidebar-item {{ Request::is('service-partner/vehicle-list*') ? 'active' : '' }}" data-toggle="modal" data-target="#verifyModal">
    <a  class="sidebar-link " id="vehicle-list">
     <i class="fas fa-truck"></i> <span class="align-middle">Vehicle List </span>
 </a>
</li>

@endif



          <!--  <li class="sidebar-item {{ Request::is('service-partner/sim-registration*') ? 'active' : '' }}">
                <a href="{{url('service-partner/sim-registration')}}" class="sidebar-link " id="sim-registration">
                    <i class="fab fa-simplybuilt"></i><span class="align-middle"> Sim Registration</span>
                </a>
            </li>-->

 @if($result->kyc_status=='Active')
         <!--<li class="sidebar-item {{ Request::is('service-partner/live-gps-location*') ? 'active' : '' }}">
            <a href="{{url('service-partner/live-gps-location')}}" class="sidebar-link " id="live-gps-location">
             <i class="fas fa-map-marker-alt"></i><span class="align-middle">Live GPS Location</span>
         </a>
     </li>-->
     @else

<!--  <li class="sidebar-item {{ Request::is('service-partner/live-gps-location*') ? 'active' : '' }}"  data-toggle="modal" data-target="#verifyModal">
            <a class="sidebar-link " id="live-gps-location">
             <i class="fas fa-map-marker-alt"></i><span class="align-middle">Live GPS Location</span>
         </a>
     </li>
-->
@endif


 @if($result->kyc_status=='Active')

     <li class="sidebar-item">
        <a href="#Orders" data-toggle="collapse" class="sidebar-link collapsed">
          <i class="fa fa-cart-plus"></i> <span class="align-middle"> Orders</span>
      </a>

      <ul id="Orders" class="sidebar-dropdown list-unstyled collapse">

       <li class="sidebar-item {{ Request::is('service-partner/today-orders*') ? 'active' : '' }}" id="today-orders"><a class="sidebar-link" href="{{url('service-partner/today-orders')}}"><i class="fa fa-cart-plus"></i>Today Orders</a></li>


       <li class="sidebar-item {{ Request::is('service-partner/deliverd-orders*') ? 'active' : '' }}" id="delivered-orders"><a class="sidebar-link" href="{{url('service-partner/delivered-orders')}}"><i class="fas fa-dot-circle"></i>Delivered Orderd</a></li>

       <li class="sidebar-item {{ Request::is('service-partner/canceled-orders*') ? 'active' : '' }}" id="canceled-orders"><a class="sidebar-link" href="{{url('service-partner/canceled-orders')}}"><i class="fas fa-dot-circle"></i>Canceled Orders</a></li>


   </ul>
</li>  

@else

<li class="sidebar-item" data-toggle="modal" data-target="#verifyModal" data-toggle="modal" data-target="#verifyModal">
    <a  class="sidebar-link " id="vehicle-list">
     <i class="fas fa-truck"></i> <span class="align-middle">Vehicle List </span>
 </a>
</li>

@endif            


<li class="sidebar-item {{ Request::is('service-partner/Documents*') ? 'active' : '' }}">
    <a href="#Documents" data-toggle="collapse" class="sidebar-link collapsed">

     <i class="fas fa-file-word"></i><span class="align-middle">Documents</span>

 </a>

 <ul id="Documents" class="sidebar-dropdown list-unstyled collapse">

    <li class="sidebar-item {{ Request::is('service-partner/document*') ? 'active' : '' }}" id="document"><a class="sidebar-link" href="{{url('service-partner/document')}}"><i class="fas fa-dot-circle"></i>My document</a></li>

    <li class="sidebar-item {{ Request::is('service-partner/bank-detail*') ? 'active' : '' }}" id="bank-detail"><a class="sidebar-link" href="{{url('service-partner/bank-detail')}}"><i class="fas fa-dot-circle"></i>Bank Detail</a></li>



</ul>
</li>


 @if($result->kyc_status=='Active')
<li class="sidebar-item {{ Request::is('service-partner/today-earning*') ? 'active' : '' }}">
    <a href="{{url('service-partner/today-earning')}}" class="sidebar-link " id="today-earning">
        <i class="fas fa-chalkboard-teacher"></i><span class="align-middle">Today Earning</span>
    </a>
</li>
@else

<li class="sidebar-item {{ Request::is('service-partner/today-earning*') ? 'active' : '' }}"  data-toggle="modal" data-target="#verifyModal">
    <a  class="sidebar-link " id="today-earning">
        <i class="fas fa-chalkboard-teacher"></i><span class="align-middle">Today Earning</span>
    </a>
</li>

@endif


 @if($result->kyc_status=='Active')

<!--<li class="sidebar-item {{ Request::is('service-partner/payout-history*') ? 'active' : '' }}">
    <a href="{{url('service-partner/payout-history')}}" class="sidebar-link " id="payout-history">
      <i class="fas fa-shopping-bag"></i> <span class="align-middle">PayOut history
      </span>
  </a>
</li>-->

@else

<!--<li class="sidebar-item {{ Request::is('service-partner/payout-history*') ? 'active' : '' }}"  data-toggle="modal" data-target="#verifyModal">
    <a class="sidebar-link " id="payout-history">
      <i class="fas fa-shopping-bag"></i> <span class="align-middle">PayOut history
      </span>
  </a>
</li>-->

@endif

<!--<li class="sidebar-item {{ Request::is('service-partner/support-ticket*') ? 'active' : '' }}">
    <a href="{{url('service-partner/support-ticket')}}" class="sidebar-link " id="support-ticket">
     <i class="fas fa-clipboard-check"></i><span class="align-middle">Support and Tickts
     </span>
 </a>
</li>-->


@if($result->kyc_status=='Active' && $result->status=='Active')

<li class="sidebar-item" data-toggle="modal" data-target="#deactiveAccount">
<a  class="sidebar-link " id="deactive-account" style="color:red">
<i class="fas fa-box-open"></i><span class="align-middle">Deactive Account</span>
</a>
</li>



@elseif($result->kyc_status=='Active' && $result->status=='Deactive')

<li class="sidebar-item" data-toggle="modal" data-target="#ActiveAccount">
<a  class="sidebar-link " id="Active-account"  style="color:#37c937">
<i class="fas fa-box-open"></i><span class="align-middle">Active Account</span>
</a>
</li>

@endif



@if(!$users->email_verified_at)
<li class="sidebar-item"  data-toggle="modal" data-target="#EmailVerifyAccount">
    <a  class="sidebar-link " id="deactivate-account">
        <i class="fas fa-box-open"></i><span class="align-middle">Email Verify</span>
    </a>
</li>
@endif
<li class="sidebar-item {{ Request::is('service-partner/deactivate-account*') ? 'active' : '' }}">
    <a href="{{url('service-partner/deactivate-account')}}" class="sidebar-link " id="deactivate-account">
        <i class="fas fa-box-open"></i><span class="align-middle">Delete Account</span>
    </a>
</li>


 
</ul>


           @if(!Auth::guest()) 

@if(Auth::user()->role == "1")

<div class="sidebar-bottom d-none d-lg-block">
    <div class="media">
        <div class="media-body">
          
<a href="{{url('admin/delivery-rider')}}">
<button class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back To Admin</button></a>

    </div>
</div>
</div>

@endif
@endif

<!-- <div class="sidebar-bottom d-none d-lg-block">
    <div class="media">
        <img class="rounded-circle mr-3" src="{{asset('public/img/mandeclan_logo.jpg')}}" alt="" width="40" height="40">
        <div class="media-body">
           @if(!Auth::guest()) 
@if(Auth::user()->role == "1")
<a href="{{url('admin/delivery-rider')}}">
<button class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back To Admin</button></a>
@elseif(Auth::user()->role == "4")
{{ $result->rv_user_name }}
<div class="text-light">
<i class="fas fa-circle text-success"></i> Online
</div>
@endif
@endif
    </div>
</div>
</div> -->

</div>
</nav>

<div class="main">
    <nav class="navbar navbar-expand navbar-light bg-white">
        <a class="sidebar-toggle d-flex mr-2">
            <i class="hamburger align-self-center"></i>
        </a>

   <a title="Visit site" href="{{url('/'.Session::get('locality_url'))}}" target="_blank">
           Visit Site <i class="fas fa-external-link-alt"></i>
       </a>


        <div class="navbar-collapse collapse">

          <h4 style="margin: 0 auto;color: #495057"><b>Service Partner  @if(!empty(Session::get('rv_user_name')))
             {{Session::get('rv_user_name')}}
             @elseif(!Auth::guest())

             @if(Auth::user()->role == "4")
             {{  $result->rv_user_name }} 
             @endif

             

         @endif</b></h4>


         <ul class="navbar-nav ml-auto">

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" data-toggle="dropdown">
                  <span class="d-inline-block d-md-none">
                    <i class="align-middle" data-feather="settings"></i>
                </span>
                <span class="d-none d-sm-inline-block">
                 <!-- <img src="{{asset('public/img/mandeclan_logo.jpg')}}" class="avatar img-fluid rounded-circle mr-1" alt="" /> <span class="text-dark">  -->
                    {{-- zareena --}}
                  @if (Auth::guest())                  
                  @else
                  @if(Auth::user()->role == "1" || Auth::user()->role == "4" )
                  {{ Auth::user()->name }} 
                  @endif
              @endif</span>
          </span>
      </a>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="{{url('service-partner/profile')}}"><i class="align-middle mr-1" data-feather="user"></i> Profile</a>

        <!-- <a class="dropdown-item" href="#">Settings & Privacy</a> -->


        <a class="dropdown-item" href="{{ url('service-partner/logout') }}" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
    Sign out</a>


    <form id="logout-form" action="{{ url('service-partner/logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
</div>
</li>
</ul>
</div>
</nav>
<main class="py-4">
   @yield('innercontent')                    
</main>
</div>
</div>
</div>
@endif



<div class="modal fade comman-modal" id="deactiveAccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">
    <div class="modal-content">
    
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Deactive Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <div class="modal-body">
      <div id="infoPanel">
        <p>Are You Sure You Want to Deactive Account  </p>
       
    </div>

</div>
<div class="modal-footer">
   <a href="{{route('servicepartner.profile.delete')}} "><button type="button"  class="btn btn-info confirm_address_set_field">Deactive Now</button ></a>
   <button type="button" class="btn btn-raised btn-danger" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>



<div class="modal fade comman-modal" id="ActiveAccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">
    <div class="modal-content">
    
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Active Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <div class="modal-body">
      <div id="infoPanel">
        <p>Are You Sure You Want to Active Account  </p>
       
    </div>

</div>
<div class="modal-footer">
   <a href="{{route('servicepartner.profile.delete')}} "><button type="button"  class="btn btn-info confirm_address_set_field">Active Now</button ></a>
   <button type="button" class="btn btn-raised btn-danger" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>

<div class="modal fade comman-modal" id="verifyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">
    <div class="modal-content">
    
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Alert</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <div class="modal-body">
      <div id="infoPanel">
        <p>Please Add required documents and wait for the approval. </p>
       
    </div>

</div>
<div class="modal-footer">
   <a href="{{url('service-partner/document')}}"><button type="button"  class="btn btn-info confirm_address_set_field" >Go to Document</button ></a>
   <button type="button" class="btn btn-raised btn-danger" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>



<div class="modal fade comman-modal" id="EmailVerifyAccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">
    <div class="modal-content">
    
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Verify Email</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <div class="modal-body">
      <div id="infoPanel">
        <p>Are You Sure You Want to send email for verify  </p>
       
    </div>

</div>
<div class="modal-footer">
   <a href="{{route('servicepartners.profile.email_verify')}} "><button type="button"  class="btn btn-info">Send Email</button ></a>
   <button type="button" class="btn btn-raised btn-danger" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>