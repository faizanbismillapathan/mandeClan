@if(!Auth::guest())
<?php
if (!Auth::guest()) {
 
   if(Auth::user()->role == "1"){

       $result=DB::table('customers')
       ->select('customer_name','id','status','user_id')
       ->where('id',Session::get('customer_id'))
       ->first();

       $users=DB::table('users')->where('id',$result->user_id)->first();

   }elseif(Auth::user()->role == "3"){

       $result=DB::table('customers')
       ->select('customer_name','id','status')
       ->where('user_id',Auth::user()->id)
       ->first();

             $users=DB::table('users')->where('id',Auth::user()->id)->first();


   }


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

                <li class="sidebar-item {{ Request::is('customer/dashboard*') ? 'active' : '' }}">
                    <a href="{{url('customer/dashboard')}}" class="sidebar-link " id="dashboard">
                        <i class="fas fa-tachometer-alt"></i> <span class="align-middle">Dashboard</span>
                    </a>
                </li>


                <li class="sidebar-item {{ Request::is('customer/profile*') ? 'active' : '' }}">
                    <a href="{{url('customer/profile')}}" class="sidebar-link " id="profile">
                        <i class="fas fa-user"></i><span class="align-middle">My Account</span>
                    </a>
                </li>

                  {{--  <li class="sidebar-item {{ Request::is('customer/my-orders*') ? 'active' : '' }} {{ Request::is('customer/order-detail*') ? 'active' : '' }}">
                    <a href="{{url('customer/my-orders')}}" class="sidebar-link " id="my-orders">
                        <i class="fa fa-cart-plus"></i> <span class="align-middle">My Orders</span>
                    </a>
                </li>
 


                <li class="sidebar-item {{ Request::is('customer/order-history*') ? 'active' : '' }}">
                    <a href="{{url('customer/order-history')}}" class="sidebar-link " id="order-history">
                        <i class="fas fa-shopping-basket"></i> <span class="align-middle">Order History</span>
                    </a>
                </li> --}}


<li class="sidebar-item {{ Request::is('customer/Orders*') ? 'active' : '' }}">
<a href="#Orders" data-toggle="collapse" class="sidebar-link collapsed">
<i class="fa fa-cart-plus"></i><span class="align-middle">Orders</span>
</a>

<ul id="Orders" class="sidebar-dropdown list-unstyled collapse">

<li class="sidebar-item {{ Request::is('customer/my-orders*') ? 'active' : '' }}" id="my-orders"><a class="sidebar-link" href="{{url('customer/my-orders')}}"><i class="fas fa-dot-circle"></i>My Orderes</a></li>


<li class="sidebar-item {{ Request::is('customer/cancelled-order') ? 'active' : '' }}" id="cancelled-order"><a class="sidebar-link" href="{{url('customer/cancelled-order')}}"><i class="fas fa-dot-circle"></i>Cancelled Order</a></li>

<li class="sidebar-item {{ Request::is('customer/order-history') ? 'active' : '' }}" id="order-history"><a class="sidebar-link" href="{{url('customer/order-history')}}"><i class="fas fa-dot-circle"></i>Delivered Order</a></li>


</ul>
</li>




                 <li class="sidebar-item {{ Request::is('customer/wishlist*') ? 'active' : '' }}">
                    <a href="{{url('customer/wishlist')}}" class="sidebar-link " id="wishlist">
                       <i class="fas fa-heart"></i><span class="align-middle">Wishlist Store</span>
                    </a>
                </li>

                <li class="sidebar-item {{ Request::is('customer/rating-review*') ? 'active' : '' }}">
                    <a href="{{url('customer/rating-review')}}" class="sidebar-link " id="rating-review">
                        <i class="fas fa-star-half-alt"></i> <span class="align-middle">Reviews & Rating</span>
                    </a>
                </li>


{{-- <li class="sidebar-item {{ Request::is('customer/shared-product*') ? 'active' : '' }}">
                    <a href="{{url('customer/shared-product')}}" class="sidebar-link " id="shared-product">
                        <i class="fas fa-share-alt"></i> <span class="align-middle">Shared Product</span>
                    </a>
                </li> --}}
             

                <li class="sidebar-item {{ Request::is('customer/manage-address*') ? 'active' : '' }}">
                    <a href="{{url('customer/manage-address')}}" class="sidebar-link " id="manage-address">
                      <i class="fas fa-map-marker-alt"></i> <span class="align-middle">Manage  Address</span>
                    </a>
                </li>

                <!--<li class="sidebar-item {{ Request::is('customer/wallet*') ? 'active' : '' }}">
                    <a href="{{url('customer/wallet')}}" class="sidebar-link " id="wallet">
                        <i class="fas fa-wallet"></i> <span class="align-middle">My Wallet</span>
                    </a>
                </li>-->

  <!--  <li class="sidebar-item {{ Request::is('customer/support-&-help*') ? 'active' : '' }}">
                    <a href="{{url('customer/support-&-help')}}" class="sidebar-link " id="support-&-help">
                        <i class="fas fa-hands-helping"></i> <span class="align-middle">Support & Help</span>
                    </a>
                </li> -->

                <!--<li class="sidebar-item {{ Request::is('customer/bank-detail*') ? 'active' : '' }}">
                    <a href="{{url('customer/bank-detail')}}" class="sidebar-link " id="bank-detail">
                        <i class="fas fa-university"></i><span class="align-middle">Bank Detail</span>
                    </a>
                </li>-->

                                <li class="sidebar-item {{ Request::is('customer/support-ticket*') ? 'active' : '' }}">
                    <a href="{{url('customer/support-ticket')}}" class="sidebar-link " id="support-ticket">
                        <i class="fas fa-wallet"></i> <span class="align-middle">Support Ticket</span>
                    </a>
                </li>



<li class="sidebar-item {{ Request::is('customer/subscriptions*') ? 'active' : '' }}">
    <a href="{{url('customer/subscriptions')}}" class="sidebar-link " id="subscriptions">
        <i class="fas fa-box-open"></i><span class="align-middle">Subscription Plan</span>
    </a>
</li>

<li class="sidebar-item {{ Request::is('customer/plan-history*') ? 'active' : '' }}">
    <a href="{{url('customer/plan-history')}}" class="sidebar-link " id="plan-history">
        <i class="fas fa-box-open"></i><span class="align-middle">Plan History</span>
    </a>
</li>

<li class="sidebar-item {{ Request::is('customer/service-enquiry*') ? 'active' : '' }}">
    <a href="{{url('customer/service-enquiry')}}" class="sidebar-link " id="service-enquiry">
        <i class="fas fa-box-open"></i><span class="align-middle">Service Enquiry</span>
    </a>
</li>

<!--@if($result->status=='Active')

<li class="sidebar-item" data-toggle="modal" data-target="#deactiveAccount">
    <a  class="sidebar-link " id="deactive-account" style="color:red">
        <i class="fas fa-box-open"></i><span class="align-middle">Deactive Account</span>
    </a>
</li>
@elseif($result->status=='Deactive')

<li class="sidebar-item" data-toggle="modal" data-target="#ActiveAccount">
    <a  class="sidebar-link " id="Active-account" style="color:#37c937">
        <i class="fas fa-box-open"></i><span class="align-middle">Active Account</span>
    </a>
</li>
@endif-->


@if(!$users->email_verified_at)
<li class="sidebar-item"  data-toggle="modal" data-target="#EmailVerifyAccount">
    <a  class="sidebar-link " id="deactivate-account">
        <i class="fas fa-box-open"></i><span class="align-middle">Email Verify</span>
    </a>
</li>
@endif

<!--
<li class="sidebar-item {{ Request::is('customer/deactivate-account*') ? 'active' : '' }}">
    <a href="{{url('customer/deactivate-account')}}" class="sidebar-link " id="deactivate-account">
        <i class="fas fa-box-open"></i><span class="align-middle">Delete Account</span>
    </a>
</li>
-->




        </ul>

 @if(!Auth::guest()) 
@if(Auth::user()->role == "1")
<div class="sidebar-bottom d-none d-lg-block">
    <div class="media">
        <div class="media-body">
           @if(!Auth::guest()) 
@if(Auth::user()->role == "1")
<a href="{{url('admin/customers')}}">
<button class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back To Admin</button></a>

@endif
@endif
    </div>
</div>
</div>
@endif
@endif
<!-- 
<div class="sidebar-bottom d-none d-lg-block">
    <div class="media">
        <img class="rounded-circle mr-3" src="{{asset('public/img/mandeclan_logo.jpg')}}" alt="" width="40" height="40">
        <div class="media-body">
           @if(!Auth::guest()) 
@if(Auth::user()->role == "1")
<a href="{{url('customer/customers')}}">
<button class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back To Admin</button></a>
@elseif(Auth::user()->role == "2")
{{ $result->customer_name }}
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
   <a title="Visit site" href="{{url('/'.Session::get('locality_url'))}}" target="_self">
           Visit Site <i class="fas fa-external-link-alt"></i>
       </a>



        <div class="navbar-collapse collapse">

            <ul class="navbar-nav ml-auto">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" data-toggle="dropdown">
                      <span class="d-inline-block d-md-none">
                        <i class="align-middle" data-feather="settings"></i>
                    </span>
                    <span class="d-none d-sm-inline-block">
                        <!-- <img src="{{asset('public/img/mandeclan_logo.jpg')}}" class="avatar img-fluid rounded-circle mr-1" alt="" /> <span class="text-dark">   -->
                            
                          @if (Auth::guest()) 
                                           
                          @else
                          @if(Auth::user()->role == "1" || Auth::user()->role == "3" )
                          {{ Auth::user()->name }} 
                          @endif
                      @endif</span>
                  </span>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{url('customer/profile')}}"><i class="align-middle mr-1" data-feather="user"></i> Profile</a>

                <!-- <a class="dropdown-item" href="#">Settings & Privacy</a> -->


                <a class="dropdown-item" href="{{ url('customer/logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
            Sign out</a>


            <form id="logout-form" action="{{ url('customer/logout') }}" method="POST" style="display: none;">
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
   <a href="{{route('customer.profile.delete')}} "><button type="button"  class="btn btn-info confirm_address_set_field">Deactive Now</button ></a>
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
   <a href="{{route('customers.profile.email_verify')}} "><button type="button"  class="btn btn-info">Send Email</button ></a>
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
   <a href="{{route('customer.profile.delete')}} "><button type="button"  class="btn btn-info confirm_address_set_field">Active Now</button ></a>
   <button type="button" class="btn btn-raised btn-danger" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
