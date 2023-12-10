@if(!Auth::guest())

<?php

if(!Auth::guest()) {
    if(Auth::user()->role == "1"){

       $result=DB::table('stores')
       ->select('store_name','id','store_category','kyc_status','status','user_id')
       ->where('id',Session::get('store_id'))
       ->first();


       $users=DB::table('users')->where('id',$result->user_id)->first();


   }elseif(Auth::user()->role == "2"){

       $result=DB::table('stores')
       ->select('store_name','id','store_category','kyc_status','status')
       ->where('user_id',Auth::user()->id)
       ->first();


       $users=DB::table('users')->where('id',Auth::user()->id)->first();
   }

}

$category=DB::table('store_categories')
->select('category_name','id')
->where('id',$result->store_category)
->first();

$category_name=$category->category_name;


?>
<div class="wrapper">
    <div class="d-flex">
     <nav class="sidebar">
        <div class="sidebar-content">
            <a class="sidebar-brand" href="{{url('/'.Session::get('locality_url'))}}">
               <img class="" src="{{asset('public/img/mandeclan_logo.jpg')}}" alt="" width="100%" height="100px">
           </a>

           <ul class="sidebar-nav">


@if(!$users->email_verified_at)

            <li class="sidebar-item {{ Request::is('seller/dashboard*') ? 'active' : '' }}" data-toggle="modal" data-target="#EmailVerifyAccount">
                <a class="sidebar-link " id="dashboard">
                    <i class="fas fa-tachometer-alt"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>
@else
 <li class="sidebar-item {{ Request::is('seller/dashboard*') ? 'active' : '' }}" >
                <a href="{{url('seller/dashboard')}}" class="sidebar-link " id="dashboard">
                    <i class="fas fa-tachometer-alt"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>
@endif

@if(!$users->email_verified_at)

            <li class="sidebar-item {{ Request::is('seller/profile*') ? 'active' : '' }}" data-toggle="modal" data-target="#EmailVerifyAccount">
                <a class="sidebar-link " id="profile">
                    <i class="fas fa-user"></i><span class="align-middle">My Account</span>
                </a>
            </li>
@else

            <li class="sidebar-item {{ Request::is('seller/profile*') ? 'active' : '' }}" >
                <a href="{{url('seller/profile')}}" class="sidebar-link " id="profile">
                    <i class="fas fa-user"></i><span class="align-middle">My Account</span>
                </a>
            </li>
@endif



            @if($result->kyc_status=='Active')
            <li class="sidebar-item {{ Request::is('seller/categories*') ? 'active' : '' }}">
                <a href="{{url('seller/categories')}}" class="sidebar-link " id="categories">
                    <i class="fas fa-user"></i><span class="align-middle">Categories</span>
                </a>
            </li>
            @else

 <li class="sidebar-item {{ Request::is('seller/categories*') ? 'active' : '' }}" data-toggle="modal" data-target="#verifyModal">
                <a  class="sidebar-link " id="categories">
                    <i class="fas fa-user"></i><span class="align-middle">Categories</span>
                </a>
            </li>
            

            @endif

            @if($result->kyc_status=='Active')


            <li class="sidebar-item {{ Request::is('seller/Products*') ? 'active' : '' }}">
                <a href="#Products" data-toggle="collapse" class="sidebar-link collapsed">

                   <i class="far fa-address-card"></i><span class="align-middle">Products</span>
               </a>

               <ul id="Products" class="sidebar-dropdown list-unstyled collapse">



                <li class="sidebar-item {{ Request::is('seller/product-master*') ? 'active' : '' }}" id="product-master"><a class="sidebar-link" href="{{url('seller/product-master')}}"><i class="fas fa-dot-circle"></i>Master Products</a></li>


              


@if(!$users->email_verified_at)

  <li class="sidebar-item {{ Request::is('seller/products*') ? 'active' : '' }}" id="products" data-toggle="modal" data-target="#EmailVerifyAccount"><a class="sidebar-link" ><i class="fas fa-dot-circle"></i>My Products</a></li>


@else

  <li class="sidebar-item {{ Request::is('seller/products*') ? 'active' : '' }}" id="products"><a class="sidebar-link" href="{{url('seller/products')}}"><i class="fas fa-dot-circle"></i>Product List</a></li>


  <li class="sidebar-item {{ Request::is('seller/product-items*') ? 'active' : '' }}" id="products"><a class="sidebar-link" href="{{url('seller/product-items')}}"><i class="fas fa-dot-circle"></i>Product Item List</a></li>



@endif




            </ul>
        </li>

        @else


    <li class="sidebar-item {{ Request::is('seller/Products*') ? 'active' : '' }}" data-toggle="modal" data-target="#verifyModal">
                <a href="#Products" data-toggle="collapse" class="sidebar-link collapsed">

                   <i class="far fa-address-card"></i><span class="align-middle">Products</span>
               </a>

               <ul id="Products" class="sidebar-dropdown list-unstyled collapse">


            </ul>
        </li>

{{--  <li class="sidebar-item {{ Request::is('seller/Products*') ? 'active' : '' }}" data-toggle="modal" data-target="#verifyModal">
                <a  class="sidebar-link " id="Products">
                    <i class="fas fa-user"></i><span class="align-middle">Products</span>
                </a>
            </li> --}}

        @endif

        <li class="sidebar-item {{ Request::is('seller/Documents*') ? 'active' : '' }}">
            <a href="#Documents" data-toggle="collapse" class="sidebar-link collapsed">

               <i class="fas fa-file-word"></i><span class="align-middle">Documents</span>

           </a>

           <ul id="Documents" class="sidebar-dropdown list-unstyled collapse">

            <li class="sidebar-item {{ Request::is('seller/seller-document*') ? 'active' : '' }}" id="seller-document"><a class="sidebar-link" href="{{url('seller/seller-document')}}"><i class="fas fa-dot-circle"></i>My document</a></li>

            <li class="sidebar-item {{ Request::is('seller/bank-detail*') ? 'active' : '' }}" id="bank-detail"><a class="sidebar-link" href="{{url('seller/bank-detail')}}"><i class="fas fa-dot-circle"></i>Bank Detail</a></li>



        </ul>
    </li>

    @if($result->kyc_status=='Active')

    <li class="sidebar-item {{ Request::is('seller/Orders*') ? 'active' : '' }}" >
        <a href="#Orders" data-toggle="collapse" class="sidebar-link collapsed">

         <i class="fa fa-cart-plus"></i><span class="align-middle">Orders</span>

     </a>

     <ul id="Orders" class="sidebar-dropdown list-unstyled collapse">

        <li class="sidebar-item {{ Request::is('seller/orders*') ? 'active' : '' }}" id="orders"><a class="sidebar-link" href="{{url('seller/orders')}}"><i class="fas fa-dot-circle"></i>All Orderes</a></li>


        <li class="sidebar-item {{ str_contains(Request::fullUrl(), 'seller/orders?search=Pending') ? 'active' : '' }}" id="suborders"><a class="sidebar-link" href="{{url('seller/orders?search=Pending')}}"><i class="fas fa-dot-circle"></i>Pending Order</a></li>

        <li class="sidebar-item {{ str_contains(Request::fullUrl(), 'seller/orders?search=Cancelled') ? 'active' : '' }}" id="suborders"><a class="sidebar-link" href="{{url('seller/orders?search=Cancelled')}}"><i class="fas fa-dot-circle"></i>Canceled Order</a></li>

        <li class="sidebar-item {{ str_contains(Request::fullUrl(), 'seller/orders?search=Approved') ? 'active' : '' }}" id="suborders"><a class="sidebar-link" href="{{url('seller/orders?search=Approved')}}"><i class="fas fa-dot-circle"></i>Approved Order</a></li>

        <li class="sidebar-item {{ str_contains(Request::fullUrl(), 'seller/orders?search=Ready To Pickup') ? 'active' : '' }}" id="suborders"><a class="sidebar-link" href="{{url('seller/orders?search=Ready To Pickup')}}"><i class="fas fa-dot-circle"></i>Ready To Pickup</a></li>

        <li class="sidebar-item {{ str_contains(Request::fullUrl(), 'seller/orders?search=Dispatch') ? 'active' : '' }}" id="suborders"><a class="sidebar-link" href="{{url('seller/orders?search=Dispatch')}}"><i class="fas fa-dot-circle"></i>Dispatch Order</a></li>


        <li class="sidebar-item {{ str_contains(Request::fullUrl(), 'seller/orders?search=Delivered') ? 'active' : '' }}" id="suborders"><a class="sidebar-link" href="{{url('seller/orders?search=Delivered')}}"><i class="fas fa-dot-circle"></i>Delivered Order</a></li>


    </ul>
</li>
  @else

 <li class="sidebar-item {{ Request::is('seller/orders*') ? 'active' : '' }}" data-toggle="modal" data-target="#verifyModal">
                <a  class="sidebar-link " id="orders">
                    <i class="fas fa-user"></i><span class="align-middle">Orders</span>
                </a>
            </li>
@endif

@if($result->kyc_status=='Active')

<li class="sidebar-item {{ Request::is('seller/photo-gallery*') ? 'active' : '' }}" >
    <a href="{{url('seller/photo-gallery')}}" class="sidebar-link " id="photo-gallery">
        <i class="fas fa-user"></i><span class="align-middle">Photo Gallery</span>
    </a>
</li>
  @else
<li class="sidebar-item {{ Request::is('seller/photo-gallery*') ? 'active' : '' }}" data-toggle="modal" data-target="#verifyModal">
    <a class="sidebar-link " id="photo-gallery">
        <i class="fas fa-user"></i><span class="align-middle">Photo Gallery</span>
    </a>
</li>
@endif


<li class="sidebar-item {{ Request::is('seller/support-ticket*') ? 'active' : '' }}">
    <a href="{{url('seller/support-ticket')}}" class="sidebar-link " id="support-ticket">
        <i class="fas fa-wallet"></i> <span class="align-middle">Support Ticket</span>
    </a>
</li>

@if($result->kyc_status=='Active')


<li class="sidebar-item {{ Request::is('seller/subscriptions*') ? 'active' : '' }}" >
    <a href="{{url('seller/subscriptions')}}" class="sidebar-link " id="subscriptions">
        <i class="fas fa-box-open"></i><span class="align-middle">Subscription Plan</span>
    </a>
</li>
  @else


<li class="sidebar-item {{ Request::is('seller/subscriptions*') ? 'active' : '' }}" data-toggle="modal" data-target="#verifyModal">
    <a  class="sidebar-link " id="subscriptions">
        <i class="fas fa-box-open"></i><span class="align-middle">Subscription Plan</span>
    </a>
</li>
@endif

@if($result->kyc_status=='Active')


<li class="sidebar-item {{ Request::is('seller/plan-history*') ? 'active' : '' }}" >
    <a href="{{url('seller/plan-history')}}" class="sidebar-link " id="plan-history">
        <i class="fas fa-box-open"></i><span class="align-middle">Plan History</span>
    </a>
</li>
  @else

<li class="sidebar-item {{ Request::is('seller/plan-history*') ? 'active' : '' }}"  data-toggle="modal" data-target="#verifyModal">
    <a  class="sidebar-link " id="plan-history">
        <i class="fas fa-box-open"></i><span class="align-middle">Plan History</span>
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


<li class="sidebar-item {{ Request::is('seller/deactivate-account*') ? 'active' : '' }}">
    <a href="{{url('seller/deactivate-account')}}" class="sidebar-link " id="deactivate-account">
        <i class="fas fa-box-open"></i><span class="align-middle">Delete Account</span>
    </a>
</li>


  <li class="sidebar-item {{ Request::is('seller/Account-Setting*') ? 'active' : '' }}">
            <a href="#Account-Setting" data-toggle="collapse" class="sidebar-link collapsed">

               <i class="fas fa-file-word"></i><span class="align-middle">Account Setting</span>

           </a>

           <ul id="Account-Setting" class="sidebar-dropdown list-unstyled collapse">

            <li class="sidebar-item {{ Request::is('seller/change-password*') ? 'active' : '' }}" id="change-password"><a class="sidebar-link" href="{{url('seller/change-password')}}"><i class="fas fa-dot-circle"></i>Change Password</a></li>

            <li class="sidebar-item {{ Request::is('seller/change-email*') ? 'active' : '' }}" id="change-email"><a class="sidebar-link" href="{{url('seller/change-email')}}"><i class="fas fa-dot-circle"></i>Change Email</a></li>

            <li class="sidebar-item {{ Request::is('seller/change-contactno*') ? 'active' : '' }}" id="change-contactno"><a class="sidebar-link" href="{{url('seller/change-contactno')}}"><i class="fas fa-dot-circle"></i>Change Contact No</a></li>


        </ul>
    </li>





<!-- <li class="sidebar-item {{ Request::is('seller/subscription*') ? 'active' : '' }}">
    <a href="#subscription" data-toggle="collapse" class="sidebar-link collapsed">

     <i class="fas fa-box-open"></i><span class="align-middle">My subscription Plan</span>

 </a>

 <ul id="subscription" class="sidebar-dropdown list-unstyled collapse">

    <li class="sidebar-item {{ Request::is('seller/upgrade-plan*') ? 'active' : '' }}" id="upgrade-plan"><a class="sidebar-link" href="{{url('seller/upgrade-plan')}}"><i class="fas fa-dot-circle"></i>Upgrade Plan</a></li>

    <li class="sidebar-item {{ Request::is('seller/plan-history*') ? 'active' : '' }}" id="plan-history"><a class="sidebar-link" href="{{url('seller/plan-history')}}"><i class="fas fa-dot-circle"></i>Plan History</a></li>


</ul>
</li> -->


{{-- 
<li class="sidebar-item {{ Request::is('seller/Account-Management*') ? 'active' : '' }}">
    <a href="#Account-Management" data-toggle="collapse" class="sidebar-link collapsed">
     <i class="fas fa-tasks"></i><span class="align-middle">Account Management</span>

 </a>

 <ul id="Account-Management" class="sidebar-dropdown list-unstyled collapse">

    <li class="sidebar-item {{ Request::is('seller/payouts*') ? 'active' : '' }}" id="payouts"><a class="sidebar-link" href="{{url('seller/payouts')}}"><i class="fas fa-dot-circle"></i>Payout</a></li>

    <li class="sidebar-item {{ Request::is('seller/commission*') ? 'active' : '' }}" id="commission"><a class="sidebar-link" href="{{url('seller/commission')}}"><i class="fas fa-dot-circle"></i>Commission</a></li>


</ul>
</li>
--}}

{{-- <li class="sidebar-item {{ Request::is('seller/change-password*') ? 'active' : '' }}">
    <a href="{{url('seller/change-password')}}" class="sidebar-link " id="change-password">
        <i class="fas fa-key"></i> <span class="align-middle"> Change Password</span>
    </a>
</li>

--}}

 <!-- <li class="sidebar-item {{ Request::is('seller/wallet*') ? 'active' : '' }}">
    <a href="{{url('seller/wallet')}}" class="sidebar-link" id="wallet">
        <i class="fa fa-folder" data-feather="sliders"></i> <span class="align-middle">Wallet</span>
    </a>
</li> -->

{{-- 
<li class="sidebar-item {{ Request::is('seller/invoice-setting*') ? 'active' : '' }}">
    <a href="{{url('seller/invoice-setting')}}" class="sidebar-link " id="invoice-setting">
        <i class="fas fa-file-invoice"></i> <span class="align-middle">Invoice Setting</span>
    </a>
</li>
--}}

{{-- <li class="sidebar-item {{ Request::is('seller/shipping-info*') ? 'active' : '' }}">
    <a href="{{url('seller/shipping-info')}}" class="sidebar-link " id="shipping-info">
        <i class="fa fa-cubes"></i> <span class="align-middle">Shipping Information</span>
    </a>
</li> --}}

 <li class="sidebar-item {{ Request::is('seller/store-payouts*') ? 'active' : '' }}">
                <a href="#store-payouts" data-toggle="collapse" class="sidebar-link collapsed">
                  <i class="fab fa-cc-amazon-pay"></i> <span class="align-middle">Store Payouts</span>

              </a>
              <ul id="store-payouts" class="sidebar-dropdown list-unstyled collapse">

               <li class="sidebar-item {{ Request::is('seller/store-payout*') ? 'active' : '' }}" id="store-payout"><a class="sidebar-link" href="{{url('seller/store-payout')}}"><i class="fas fa-dot-circle"></i>Store Payout<span class="sidebar-badge badge badge-primary">00</span></a></li>



           </ul>
       </li>


</ul>

@if(Auth::user()->role == "1")
<div class="sidebar-bottom d-none d-lg-block">
    <div class="media">
        <div class="media-body">
           @if(!Auth::guest()) 
           @if(Auth::user()->role == "1")
           <a href="{{url('admin/stores')}}">
            <button class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back To seller</button></a>
            @elseif(Auth::user()->role == "2")
            {{ $result->store_name }}
            <div class="text-light">
                <i class="fas fa-circle text-success"></i> Online
            </div>
            @endif
            @endif
        </div>
    </div>
</div>
@elseif(Auth::user()->role == "2")

@endif
<!-- 
<div class="sidebar-bottom d-none d-lg-block">
    <div class="media">
        <img class="rounded-circle mr-3" src="{{asset('public/img/mandeclan_logo.jpg')}}" alt="" width="40" height="40">
        <div class="media-body">
         @if(!Auth::guest()) 
         @if(Auth::user()->role == "1")
         <a href="{{url('seller/stores')}}">
            <button class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back To seller</button></a>
            @elseif(Auth::user()->role == "2")
            {{ $result->store_name }}
            <div class="text-light">
                <i class="fas fa-circle text-success"></i> Online
            </div>
            @endif
            @endif
        </div>
    </div>
</div>
-->
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

      <h4 style="margin: 0 auto;color: #495057"><b>@if(!empty(Session::get('store_name')))

       {{Session::get('store_name')}} 
       @elseif(!Auth::guest())

       @if(Auth::user()->role == "2")
       {{  $result->store_name }} 
       @endif 
       @endif

       ({{$category_name}})


   </b></h4>


   <ul class="navbar-nav ml-auto">

    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" data-toggle="dropdown">
          <span class="d-inline-block d-md-none">
            <i class="align-middle" data-feather="settings"></i>
        </span>
        <span class="d-none d-sm-inline-block">
         <!-- <img src="{{asset('public/img/mandeclan_logo.jpg')}}" class="avatar img-fluid rounded-circle mr-1" alt="" /> <span class="text-dark">  -->
          @if (Auth::guest())                  
          @else
          @if(Auth::user()->role == "1" || Auth::user()->role == "2" )
          {{ Auth::user()->name }} 
          @endif
      @endif</span>
  </span>
</a>
<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
    <a class="dropdown-item" href="{{url('seller/profile')}}"><i class="align-middle mr-1" data-feather="user"></i> Profile</a>

    <!-- <a class="dropdown-item" href="#">Settings & Privacy</a> -->


    <a class="dropdown-item" href="{{ url('seller/logout') }}" onclick="event.preventDefault();
    document.getElementById('logout-form').submit();">
Sign out</a>


<form id="logout-form" action="{{ url('seller/logout') }}" method="POST" style="display: none;">
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
        <p>Please Verify your Email For further process.  </p>
       
    </div>

</div>
<div class="modal-footer">
   <a href="{{route('sellers.profile.email_verify')}} "><button type="button"  class="btn btn-info">Send Email</button ></a>
   <button type="button" class="btn btn-raised btn-danger" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>

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
   <a href="{{route('seller.profile.delete')}} "><button type="button"  class="btn btn-info confirm_address_set_field">Deactive Now</button ></a>
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
   <a href="{{route('seller.profile.delete')}} "><button type="button"  class="btn btn-info confirm_address_set_field">Active Now</button ></a>
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
        <p>Please Add required documents and wait for the approval.</p>
       
    </div>

</div>
<div class="modal-footer">
   <a href="{{url('seller/seller-document')}}"><button type="button"  class="btn btn-info confirm_address_set_field" >Go to Document</button ></a>
   <button type="button" class="btn btn-raised btn-danger" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>




{{-- <div class="modal fade comman-modal" id="verifyEmailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

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
        <p>Please Verify your Email For further process</p>
       
    </div>

</div>
<div class="modal-footer">
   <a href="{{url('seller/seller-document')}}"><button type="button"  class="btn btn-info confirm_address_set_field" ></button ></a>
   <button type="button" class="btn btn-raised btn-danger" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div> --}}