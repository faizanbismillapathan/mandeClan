<style>
    /*.wrapper {*/
    /*    height: 100vh !important;*/
    /*}*/
</style>
@if(!Auth::guest())
  <div class="wrapper">
    <div class="d-flex">
       <nav class="sidebar">
        <div class="sidebar-content">
            <a class="sidebar-brand" href="{{url('/'.Session::get('locality_url'))}}">
               <!--  <i class="align-middle" data-feather="box"></i> -->
                <img class="" src="{{asset('public/img/mandeclan_logo.jpg')}}" alt="" width="100%" height="100px">
                <!-- <span class="align-middle">Mande Clan</span> -->
            </a>

            <ul class="sidebar-nav card example-1 scrollbar-deep-purple bordered-deep-purple thin">

                <li class="sidebar-item {{ Request::is('admin/dashboard*') ? 'active' : '' }}">
                    <a href="{{url('admin/dashboard')}}" class="sidebar-link " id="dashboard">
                        <i class="fas fa-tachometer-alt"></i> <span class="align-middle">Dashboard </span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="#Masters" data-toggle="collapse" class="sidebar-link collapsed">
                      <i class="fas fa-users" data-feather="layout"></i> <span class="align-middle">Masters</span>
                  </a>

                  <ul id="Masters" class="sidebar-dropdown list-unstyled collapse">

                   {{-- <li class="sidebar-item {{ Request::is('admin/roles*') ? 'active' : '' }}" id="roles"><a class="sidebar-link" href="{{url('admin/roles')}}"><i class="fas fa-dot-circle"></i>Roles</a></li> --}}

                   <li class="sidebar-item {{ Request::is('admin/document*') ? 'active' : '' }}" id="document"><a class="sidebar-link" href="{{url('admin/document')}}"><i class="fas fa-dot-circle"></i>Document</a></li>


                   <li class="sidebar-item {{ Request::is('admin/driving-license*') ? 'active' : '' }}" id="driving-license"><a class="sidebar-link" href="{{url('admin/driving-license')}}"><i class="fas fa-dot-circle"></i>Driving License</a></li>

                    <li class="sidebar-item {{ Request::is('admin/vehicle-type*') ? 'active' : '' }}" id="vehicle-type"><a class="sidebar-link" href="{{url('admin/vehicle-type')}}"><i class="fas fa-dot-circle"></i>Vehicle List</a></li>
                   
                    <li class="sidebar-item {{ Request::is('admin/vehicle-rate-chart*') ? 'active' : '' }}" id="vehicle-rate-chart"><a class="sidebar-link" href="{{url('admin/vehicle-rate-chart')}}"><i class="fas fa-dot-circle"></i>Vehicle Rate Chart</a></li>

                        <li class="sidebar-item {{ Request::is('admin/rider-plan*') ? 'active' : '' }}" id="rider-plan"><a class="sidebar-link" href="{{url('admin/rider-plan')}}"><i class="fas fa-dot-circle"></i>Rider Plan</a></li>


 <li class="sidebar-item {{ Request::is('admin/brands*') ? 'active' : '' }}" id="brands"><a class="sidebar-link" href="{{url('admin/brands')}}"><i class="fas fa-dot-circle"></i>Brands</a></li>




 <li class="sidebar-item {{ Request::is('admin/banners*') ? 'active' : '' }}" id="banners"><a class="sidebar-link" href="{{url('admin/banners')}}"><i class="fas fa-dot-circle"></i>Banners</a></li>



 <li class="sidebar-item {{ Request::is('admin/tickets*') ? 'active' : '' }}" id="tickets"><a class="sidebar-link" href="{{url('admin/tickets')}}"><i class="fas fa-dot-circle"></i>Tickets</a></li>

 <li class="sidebar-item {{ Request::is('admin/unit') ? 'active' : '' }}" id="unit"><a class="sidebar-link" href="{{url('admin/unit')}}"><i class="fas fa-dot-circle"></i>Units</a></li>



<li class="sidebar-item {{ Request::is('admin/commission-setting*') ? 'active' : '' }}" id="commission-setting"><a class="sidebar-link" href="{{url('admin/commission-setting')}}"><i class="fas fa-dot-circle"></i>Commission Category Wise</a></li>

<li class="sidebar-item {{ Request::is('admin/commission-item-wise*') ? 'active' : '' }}" id="commission-item-wise"><a class="sidebar-link" href="{{url('admin/commission-item-wise')}}"><i class="fas fa-dot-circle"></i>Commission Item Wise</a></li>


                </ul>
            </li>


            <li class="sidebar-item {{ Request::is('admin/location*') ? 'active' : '' }}">
                <a href="#location" data-toggle="collapse" class="sidebar-link collapsed">
                  <i class="fas fa-map-marker-alt" data-feather="layout"></i> <span class="align-middle">Location</span>

              </a>

              <ul id="location" class="sidebar-dropdown list-unstyled collapse">
                <li class="sidebar-item {{ Request::is('admin/country*') ? 'active' : '' }}" id="country"><a class="sidebar-link" href="{{url('admin/country')}}"><i class="fas fa-dot-circle"></i>Country</a></li>

                <li class="sidebar-item {{ Request::is('admin/state*') ? 'active' : '' }}" id="state"><a class="sidebar-link" href="{{url('admin/state')}}"><i class="fas fa-dot-circle"></i>State</a></li>

                <li class="sidebar-item {{ Request::is('admin/city*') ? 'active' : '' }}" id="city"><a class="sidebar-link" href="{{url('admin/city')}}"><i class="fas fa-dot-circle"></i>City</a></li>

                <li class="sidebar-item {{ Request::is('admin/locality*') ? 'active' : '' }}" id="locality"><a class="sidebar-link" href="{{url('admin/locality')}}"><i class="fas fa-dot-circle"></i>Locality</a></li>


            </ul>
        </li>


        <li class="sidebar-item {{ Request::is('admin/Stores*') ? 'active' : '' }}">
            <a href="#Stores" data-toggle="collapse" class="sidebar-link collapsed">
                <i class="fa fa-shopping-basket" data-feather="layout"></i> <span class="align-middle">Stores</span>
            </a>

            <ul id="Stores" class="sidebar-dropdown list-unstyled collapse">

              <li class="sidebar-item {{ Request::is('admin/stores*') ? 'active' : '' }}" id="stores"><a class="sidebar-link" href="{{url('admin/stores')}}"><i class="fas fa-dot-circle"></i>Stores</a></li>

              <li class="sidebar-item {{ Request::is('admin/store-category*') ? 'active' : '' }}" id="store-category"><a class="sidebar-link" href="{{url('admin/store-category')}}"><i class="fas fa-dot-circle"></i>Store Category</a></li>

              <li class="sidebar-item {{ Request::is('admin/product-category*') ? 'active' : '' }}" id="product-category"><a class="sidebar-link" href="{{url('admin/product-category')}}"><i class="fas fa-dot-circle"></i>Product Category</a></li>


              <li class="sidebar-item {{ Request::is('admin/product-subcategory*') ? 'active' : '' }}" id="product-subcategory"><a class="sidebar-link" href="{{url('admin/product-subcategory')}}"><i class="fas fa-dot-circle"></i>Product subCategory</a></li>


            
            <li class="sidebar-item {{ Request::is('admin/archive-store*') ? 'active' : '' }}" id="archive-store"><a class="sidebar-link" href="{{url('admin/archive-store')}}"><i class="fas fa-dot-circle"></i>Archive Stores </a></li>

          </ul>
      </li>




        <li class="sidebar-item {{ Request::is('admin/services*') ? 'active' : '' }}">
            <a href="#services1" data-toggle="collapse" class="sidebar-link collapsed">
                <i class="fa fa-shopping-basket" data-feather="layout"></i> <span class="align-middle">Services</span>
            </a>

            <ul id="services1" class="sidebar-dropdown list-unstyled collapse">

              <li class="sidebar-item {{ Request::is('admin/services*') ? 'active' : '' }}" id="services"><a class="sidebar-link" href="{{url('admin/services')}}"><i class="fas fa-dot-circle"></i>Services</a></li>


              <li class="sidebar-item {{ Request::is('admin/service-category*') ? 'active' : '' }}" id="service-category"><a class="sidebar-link" href="{{url('admin/service-category')}}"><i class="fas fa-dot-circle"></i>Service Category</a></li>


              <li class="sidebar-item {{ Request::is('admin/service-subcategory*') ? 'active' : '' }}" id="service-subcategory"><a class="sidebar-link" href="{{url('admin/service-subcategory')}}"><i class="fas fa-dot-circle"></i>Service subCategory</a></li>


             <li class="sidebar-item {{ Request::is('admin/archive-service*') ? 'active' : '' }}" id="archive-service"><a class="sidebar-link" href="{{url('admin/archive-service')}}"><i class="fas fa-dot-circle"></i>Archive Services </a></li>
          </ul>
      </li>




      <li class="sidebar-item {{ Request::is('admin/Store-subscription-PLan*') ? 'active' : '' }}">
        <a href="#Store-subscription-PLan" data-toggle="collapse" class="sidebar-link collapsed">
          <i class="fas fa-box-open"></i> <span class="align-middle">Subscriptions</span>

      </a>

      <ul id="Store-subscription-PLan" class="sidebar-dropdown list-unstyled collapse">                         

       <li class="sidebar-item {{ Request::is('admin/store-subscription*') ? 'active' : '' }}" id="store-subscription"><a class="sidebar-link" href="{{url('admin/store-subscription')}}"><i class="fas fa-dot-circle"></i>Store subscription </a></li>

     <li class="sidebar-item {{ Request::is('admin/customer-subscription*') ? 'active' : '' }}" id="customer-subscription"><a class="sidebar-link" href="{{url('admin/customer-subscription')}}"><i class="fas fa-dot-circle"></i>Customer subscription </a></li>

       <li class="sidebar-item {{ Request::is('admin/service-subscription*') ? 'active' : '' }}" id="service-subscription"><a class="sidebar-link" href="{{url('admin/service-subscription')}}"><i class="fas fa-dot-circle"></i>Service subscription </a></li>
      


   </ul>
</li>


 <li class="sidebar-item {{ Request::is('admin/products*') ? 'active' : '' }}">
        <a href="#products" data-toggle="collapse" class="sidebar-link collapsed">
          <i class="fas fa-box-open"></i> <span class="align-middle">Products</span>

      </a>

      <ul id="products" class="sidebar-dropdown list-unstyled collapse">                         

       <li class="sidebar-item {{ Request::is('admin/products*') ? 'active' : '' }}" id="products"><a class="sidebar-link" href="{{url('admin/products')}}"><i class="fas fa-dot-circle"></i>Products Master</a></li>

     <li class="sidebar-item {{ Request::is('admin/seller-products*') ? 'active' : '' }}" id="seller-products"><a class="sidebar-link" href="{{url('admin/seller-products')}}"><i class="fas fa-dot-circle"></i>Products List </a></li>

       <li class="sidebar-item {{ Request::is('admin/seller-product-items*') ? 'active' : '' }}" id="seller-product-items"><a class="sidebar-link" href="{{url('admin/seller-product-items')}}"><i class="fas fa-dot-circle"></i>Products Item List</a></li>
      


   </ul>
</li>


{{-- <li class="sidebar-item {{ Request::is('admin/products*') ? 'active' : '' }}">
    <a href="{{url('admin/products')}}" class="sidebar-link " id="products">
        <i class="fas fa-users"></i> <span class="align-middle">products</span>
    </a>
</li> --}}



{{-- <li class="sidebar-item {{ Request::is('admin/customers*') ? 'active' : '' }}">
    <a href="{{url('admin/customers')}}" class="sidebar-link " id="customers">
        <i class="fas fa-users"></i> <span class="align-middle">Customers</span>
    </a>
</li>
 --}}


 <li class="sidebar-item {{ Request::is('admin/customer1*') ? 'active' : '' }}">
    <a href="#customer1" data-toggle="collapse" class="sidebar-link collapsed">

   
       <i class="fas fa-truck-monster"></i><span class="align-middle">Customers</span>

   </a>

   <ul id="customer1" class="sidebar-dropdown list-unstyled collapse">

    <li class="sidebar-item {{ Request::is('admin/customers*') ? 'active' : '' }}" id="customers"><a class="sidebar-link" href="{{url('admin/customers')}}"><i class="fas fa-dot-circle"></i>Customers</a></li>


    <li class="sidebar-item {{ Request::is('admin/archive-customer*') ? 'active' : '' }}" id="archive-customer"><a class="sidebar-link" href="{{url('admin/archive-customer')}}"><i class="fas fa-dot-circle"></i>Archive Customer</a></li>


</ul>
</li>




<li class="sidebar-item {{ Request::is('admin/Documents*') ? 'active' : '' }}">
    <a href="#Documents" data-toggle="collapse" class="sidebar-link collapsed">
   
       <i class="fas fa-file"></i><span class="align-middle">Document Approval</span>

   </a>

   <ul id="Documents" class="sidebar-dropdown list-unstyled collapse">
    <li class="sidebar-item {{ Request::is('admin/seller-document*') ? 'active' : '' }}" id="seller-document"><a class="sidebar-link" href="{{url('admin/seller-document')}}"><i class="fas fa-dot-circle"></i>Seller Document</a></li>

    <li class="sidebar-item {{ Request::is('admin/service-document*') ? 'active' : '' }}" id="service-document"><a class="sidebar-link" href="{{url('admin/service-document')}}"><i class="fas fa-dot-circle"></i>Service Document</a></li>

    <li class="sidebar-item {{ Request::is('admin/rv-document*') ? 'active' : '' }}" id="rv-document"><a class="sidebar-link" href="{{url('admin/rv-document')}}"><i class="fas fa-dot-circle"></i>Rider/Vehicle Document</a></li>

</ul>
</li>




<li class="sidebar-item {{ Request::is('admin/vehicle_rider*') ? 'active' : '' }}">
    <a href="#vehicle_rider" data-toggle="collapse" class="sidebar-link collapsed">

   
       <i class="fas fa-truck-monster"></i><span class="align-middle">Vehicle / Riders </span>

   </a>

   <ul id="vehicle_rider" class="sidebar-dropdown list-unstyled collapse">

    <li class="sidebar-item {{ Request::is('admin/rider-vehicle-info*') ? 'active' : '' }}" id="rider-vehicle-info"><a class="sidebar-link" href="{{url('admin/rider-vehicle-info')}}"><i class="fas fa-dot-circle"></i>Rider/Vehicle Info</a></li>


    <li class="sidebar-item {{ Request::is('admin/delivery-rider*') ? 'active' : '' }}" id="delivery-rider"><a class="sidebar-link" href="{{url('admin/delivery-rider')}}"><i class="fas fa-dot-circle"></i>Delivery Riders</a></li>

    <li class="sidebar-item {{ Request::is('admin/vehicles*') ? 'active' : '' }}" id="vehicles"><a class="sidebar-link" href="{{url('admin/vehicles')}}"><i class="fas fa-dot-circle"></i>Vehicles</a></li>

            <li class="sidebar-item {{ Request::is('admin/archive-rv*') ? 'active' : '' }}" id="archive-rv"><a class="sidebar-link" href="{{url('admin/archive-rv')}}"><i class="fas fa-dot-circle"></i>Archive Rider/Vehicle </a></li>


</ul>
</li>


<li class="sidebar-item {{ Request::is('admin/vehicle_assignment*') ? 'active' : '' }}">
    <a href="#vehicle_assignment" data-toggle="collapse" class="sidebar-link collapsed">

       <i class="fas fa-truck-moving"></i><span class="align-middle">Assignment </span>

   </a>

   <ul id="vehicle_assignment" class="sidebar-dropdown list-unstyled collapse">

    <li class="sidebar-item {{ Request::is('admin/assigned-vehicle*') ? 'active' : '' }}" id="assigned-vehicle"><a class="sidebar-link" href="{{url('admin/assigned-vehicle')}}"><i class="fas fa-dot-circle"></i>Assigned Vehicle</a></li>


   <!--  <li class="sidebar-item {{ Request::is('admin/available-vehicle*') ? 'active' : '' }}" id="available-vehicle"><a class="sidebar-link" href="{{url('admin/available-vehicle')}}"><i class="fas fa-dot-circle"></i>Available Vehicle</a></li>

    <li class="sidebar-item {{ Request::is('admin/unregisterd-vehicle*') ? 'active' : '' }}" id="unregisterd-vehicle"><a class="sidebar-link" href="{{url('admin/unregisterd-vehicle')}}"><i class="fas fa-dot-circle"></i>Unregisterd Vehicles</a></li>
 -->
</ul>
</li>




{{-- 
<li class="sidebar-item {{ Request::is('admin/attribute*') ? 'active' : '' }}">
    <a href="#attribute" data-toggle="collapse" class="sidebar-link collapsed">

       <i class="fas fa-sitemap"></i><span class="align-middle">Product Attribute</span>

   </a>

   <ul id="attribute" class="sidebar-dropdown list-unstyled collapse">

    <li class="sidebar-item {{ Request::is('admin/unit*') ? 'active' : '' }}" id="unit"><a class="sidebar-link" href="{{url('admin/unit')}}"><i class="fas fa-dot-circle"></i>Units</a></li>

    <li class="sidebar-item {{ Request::is('admin/product-attribute*') ? 'active' : '' }}" id="product-attribute"><a class="sidebar-link" href="{{url('admin/product-attribute')}}"><i class="fas fa-dot-circle"></i>Product Attribute</a></li>

</ul>
</li> --}}



<li class="sidebar-item {{ Request::is('admin/Settings*') ? 'active' : '' }}">
    <a href="#Settings" data-toggle="collapse" class="sidebar-link collapsed">
        <i class="fa fa-cog" data-feather="layout"></i> <span class="align-middle">Settings</span>

    </a>

    <ul id="Settings" class="sidebar-dropdown list-unstyled collapse">

      <li class="sidebar-item {{ Request::is('admin/payment-setting*') ? 'active' : '' }}" id="payment-setting"><a class="sidebar-link" href="{{url('admin/payment-setting')}}"><i class="fas fa-dot-circle"></i>Payment Gateway</a></li>

      {{-- <li class="sidebar-item {{ Request::is('admin/offline-payment*') ? 'active' : '' }}" id="offline-payment"><a class="sidebar-link" href="{{url('admin/offline-payment')}}"><i class="fas fa-dot-circle"></i>Offline Payment</a></li> --}}


      <!-- <li class="sidebar-item {{ Request::is('admin/invoice-setting*') ? 'active' : '' }}" id="invoice-setting"><a class="sidebar-link" href="{{url('admin/invoice-setting')}}"><i class="fas fa-dot-circle"></i>Invoice Settin<span class="sidebar-badge badge badge-primary">00</span></a></li> -->


      <li class="sidebar-item {{ Request::is('admin/currency-setting*') ? 'active' : '' }}" id="currency-setting"><a class="sidebar-link" href="{{url('admin/currency-setting')}}"><i class="fas fa-dot-circle"></i>Currency Setting</a></li>



    {{-- <li class="sidebar-item {{ Request::is('admin/default-credential*') ? 'active' : '' }}" id="default-credential"><a class="sidebar-link" href="{{url('admin/default-credential')}}"><i class="fas fa-dot-circle"></i>Default Credential </a></li> --}}



      {{-- <li class="sidebar-item {{ Request::is('admin/return-policy*') ? 'active' : '' }}" id="return-policy"><a class="sidebar-link" href="{{url('admin/return-policy')}}"><i class="fas fa-dot-circle"></i>Return Policy Setting</a></li> --}}

  </ul>
</li>



{{-- 
<li class="sidebar-item {{ Request::is('admin/Shipping-Taxes*') ? 'active' : '' }}">
    <a href="#Shipping-Taxes" data-toggle="collapse" class="sidebar-link collapsed">
        <i class="fa fa-fighter-jet" data-feather="layout"></i> <span class="align-middle">Shipping & Taxes</span>

    </a>

    <ul id="Shipping-Taxes" class="sidebar-dropdown list-unstyled collapse">

      <li class="sidebar-item {{ Request::is('admin/zones*') ? 'active' : '' }}" id="zones"><a class="sidebar-link" href="{{url('admin/zones')}}"><i class="fas fa-dot-circle"></i>Zones</a></li>


      <li class="sidebar-item {{ Request::is('admin/tax-rate*') ? 'active' : '' }}" id="tax-rate"><a class="sidebar-link" href="{{url('admin/tax-rate')}}"><i class="fas fa-dot-circle"></i>Tax Rates</a></li>

      <li class="sidebar-item {{ Request::is('admin/tax-class*') ? 'active' : '' }}" id="tax-class"><a class="sidebar-link" href="{{url('admin/tax-class')}}"><i class="fas fa-dot-circle"></i>Tax Clasess</a></li>


      <li class="sidebar-item {{ Request::is('admin/shipping*') ? 'active' : '' }}" id="shipping"><a class="sidebar-link" href="{{url('admin/shipping')}}"><i class="fas fa-dot-circle"></i>Shipping</a></li>


  </ul>
</li>

 --}}

<!-- <li class="sidebar-item {{ Request::is('admin/Customers*') ? 'active' : '' }}">
    <a href="#Customers" data-toggle="collapse" class="sidebar-link collapsed">
        <i class="fas fa-motorcycle"></i> <span class="align-middle">Customer</span>
    </a>

    <ul id="Customers" class="sidebar-dropdown list-unstyled collapse">

     <li class="sidebar-item {{ Request::is('admin/users*') ? 'active' : '' }}" id="active-rider"><a class="sidebar-link" href="{{url('admin/active-rider')}}"><i class="fas fa-dot-circle"></i>All Customer <span class="sidebar-badge badge badge-primary">00</span></a></li>


<li class="sidebar-item {{ Request::is('admin/Customer-subscription*') ? 'active' : '' }}" id="Customer-subscription"><a class="sidebar-link" href="{{url('admin/Customer-subscription')}}"><i class="fas fa-dot-circle"></i>Customer subscription <span class="sidebar-badge badge badge-primary">00</span></a></li>
</ul>

</li>
-->



<!-- <li class="sidebar-item {{ Request::is('admin/Buyer-Management*') ? 'active' : '' }}">
    <a href="#Buyer-Management" data-toggle="collapse" class="sidebar-link collapsed">
        <i class="fas fa-motorcycle"></i> <span class="align-middle">Delivery rider</span>
    </a>

    <ul id="Buyer-Management" class="sidebar-dropdown list-unstyled collapse">

     <li class="sidebar-item {{ Request::is('admin/registration-rider*') ? 'active' : '' }}" id="registration-rider"><a class="sidebar-link" href="{{url('admin/registration-rider')}}"><i class="fas fa-dot-circle"></i>Registration <span class="sidebar-badge badge badge-primary">00</span></a></li>

     <li class="sidebar-item {{ Request::is('admin/users*') ? 'active' : '' }}" id="pending-rider"><a class="sidebar-link" href="{{url('admin/pending-rider')}}"><i class="fas fa-dot-circle"></i>Pending <span class="sidebar-badge badge badge-primary">00</span></a></li>


     <li class="sidebar-item {{ Request::is('admin/users*') ? 'active' : '' }}" id="active-rider"><a class="sidebar-link" href="{{url('admin/active-rider')}}"><i class="fas fa-dot-circle"></i>Active <span class="sidebar-badge badge badge-primary">00</span></a></li>

     <li class="sidebar-item {{ Request::is('admin/users*') ? 'active' : '' }}" id="unsubscribe-rider"><a class="sidebar-link" href="{{url('admin/unsubscribe-rider')}}"><i class="fas fa-dot-circle"></i>Unsubscribe <span class="sidebar-badge badge badge-primary">00</span></a></li>

 </ul>
</li> -->







<li class="sidebar-item {{ Request::is('admin/Orders*') ? 'active' : '' }}">
    <a href="#Orders" data-toggle="collapse" class="sidebar-link collapsed">

       <i class="fa fa-cart-plus"></i><span class="align-middle">Orders</span>

   </a>

   <ul id="Orders" class="sidebar-dropdown list-unstyled collapse">

    <li class="sidebar-item {{ Request::is('admin/orders*') ? 'active' : '' }}" id="orders"><a class="sidebar-link" href="{{url('admin/orders')}}"><i class="fas fa-dot-circle"></i>All Orderes</a></li>

    <li class="sidebar-item {{ Request::is('admin/suborders') ? 'active' : '' }}" id="suborders"><a class="sidebar-link" href="{{url('admin/suborders')}}"><i class="fas fa-dot-circle"></i>All Sub Orders</a></li>



  <li class="sidebar-item {{ str_contains(Request::fullUrl(), 'admin/suborders?search=Pending') ? 'active' : '' }}" id="suborders"><a class="sidebar-link" href="{{url('admin/suborders?search=Pending')}}"><i class="fas fa-dot-circle"></i>Pending SubOrder</a></li>

  <li class="sidebar-item {{ str_contains(Request::fullUrl(), 'admin/suborders?search=Cancelled') ? 'active' : '' }}" id="suborders"><a class="sidebar-link" href="{{url('admin/suborders?search=Cancelled')}}"><i class="fas fa-dot-circle"></i>Canceled SubOrder</a></li>

  <li class="sidebar-item {{ str_contains(Request::fullUrl(), 'admin/suborders?search=Approved') ? 'active' : '' }}" id="suborders"><a class="sidebar-link" href="{{url('admin/suborders?search=Approved')}}"><i class="fas fa-dot-circle"></i>Approved SubOrder</a></li>

  <li class="sidebar-item {{ str_contains(Request::fullUrl(), 'admin/suborders?search=Ready To Pickup') ? 'active' : '' }}" id="suborders"><a class="sidebar-link" href="{{url('admin/suborders?search=Ready To Pickup')}}"><i class="fas fa-dot-circle"></i>Ready To Pickup</a></li>

 <li class="sidebar-item {{ str_contains(Request::fullUrl(), 'admin/suborders?search=Dispatch') ? 'active' : '' }}" id="suborders"><a class="sidebar-link" href="{{url('admin/suborders?search=Dispatch')}}"><i class="fas fa-dot-circle"></i>Dispatch SubOrder</a></li>


 <li class="sidebar-item {{ str_contains(Request::fullUrl(), 'admin/suborders?search=Delivered') ? 'active' : '' }}" id="suborders"><a class="sidebar-link" href="{{url('admin/suborders?search=Delivered')}}"><i class="fas fa-dot-circle"></i>Delivered SubOrder</a></li>

</ul>
</li>



<li class="sidebar-item {{ Request::is('seller/Invoice*') ? 'active' : '' }}">
    <a href="#Invoice" data-toggle="collapse" class="sidebar-link collapsed">

       <i class="fas fa-file-invoice"></i><span class="align-middle">Invoice</span>

   </a>

   <ul id="Invoice" class="sidebar-dropdown list-unstyled collapse">

    <li class="sidebar-item {{ Request::is('admin/invoice-setting*') ? 'active' : '' }}" id="invoice-setting"><a class="sidebar-link" href="{{url('admin/invoice-setting')}}"><i class="fas fa-dot-circle"></i>Invoice Setting</a></li>

    <!-- <li class="sidebar-item {{ Request::is('admin/invoice-design*') ? 'active' : '' }}" id="invoice-design"><a class="sidebar-link" href="{{url('admin/invoice-design')}}"><i class="fas fa-dot-circle"></i>Invoice Design</a></li> -->


</ul>
</li>



     <li class="sidebar-item {{ Request::is('admin/rating-reviews*') ? 'active' : '' }}">
        <a href="#rating-reviews" data-toggle="collapse" class="sidebar-link collapsed">
          <i class="fas fa-star-half-alt"></i> <span class="align-middle">Rating & Reviews</span>

      </a>

      <ul id="rating-reviews" class="sidebar-dropdown list-unstyled collapse">

       <li class="sidebar-item {{ Request::is('admin/reviews*') ? 'active' : '' }}" id="reviews"><a class="sidebar-link" href="{{url('admin/reviews')}}"><i class="fas fa-dot-circle"></i>All Reviews</a></li>
       {{-- <li class="sidebar-item {{ Request::is('admin/review-approval*') ? 'active' : '' }}" id="review-approval"><a class="sidebar-link" href="{{url('admin/review-approval')}}"><i class="fas fa-dot-circle"></i>Reviews For Approval </a></li> --}}

   </ul>
</li>






<li class="sidebar-item {{ Request::is('admin/Marketing-Tools*') ? 'active' : '' }}">
    <a href="#Marketing-Tools" data-toggle="collapse" class="sidebar-link collapsed">
       <i class="fas fa-chart-line"></i> <span class="align-middle">Marketing Tools</span>

   </a>

   <ul id="Marketing-Tools" class="sidebar-dropdown list-unstyled collapse">                         

       <li class="sidebar-item {{ Request::is('admin/push-notification*') ? 'active' : '' }}" id="push-notification"><a class="sidebar-link" href="{{url('admin/push-notification')}}"><i class="fas fa-dot-circle"></i>Push Notification </a></li>


       <!-- <li class="sidebar-item {{ Request::is('admin/offer-popup-setting*') ? 'active' : '' }}" id="offer-popup-setting"><a class="sidebar-link" href="{{url('admin/offer-popup-setting')}}"><i class="fas fa-dot-circle"></i>Offer Popup Setting </a></li> -->



   </ul>
</li>



<li class="sidebar-item {{ Request::is('admin/Front-Setting*') ? 'active' : '' }}">
    <a href="#Front-Setting" data-toggle="collapse" class="sidebar-link collapsed">
      <i class="fas fa-user-cog"></i> <span class="align-middle">Front Setting</span>

  </a>

  <ul id="Front-Setting" class="sidebar-dropdown list-unstyled collapse">                         

   <li class="sidebar-item {{ Request::is('admin/faqs*') ? 'active' : '' }}" id="faqs"><a class="sidebar-link" href="{{url('admin/faqs')}}"><i class="fas fa-dot-circle"></i>FAQ's </a></li>




   <li class="sidebar-item {{ Request::is('admin/blog*') ? 'active' : '' }}" id="blog"><a class="sidebar-link" href="{{url('admin/blog')}}"><i class="fas fa-dot-circle"></i>Blogs </a></li>


  {{--  <li class="sidebar-item {{ Request::is('admin/enquiry*') ? 'active' : '' }}" id="enquiry"><a class="sidebar-link" href="{{url('admin/enquiry')}}"><i class="fas fa-dot-circle"></i>Enquiries </a></li> --}}


   <li class="sidebar-item {{ Request::is('admin/careers*') ? 'active' : '' }}" id="careers"><a class="sidebar-link" href="{{url('admin/careers')}}"><i class="fas fa-dot-circle"></i>Careers </a></li>


{{--    <li class="sidebar-item {{ Request::is('admin/careers*') ? 'active' : '' }}" id="careers"><a class="sidebar-link" href="{{url('admin/careers')}}"><i class="fas fa-dot-circle"></i>Careers </a></li>
 --}}
              <li class="sidebar-item {{ Request::is('admin/requested-store*') ? 'active' : '' }}" id="requested-store"><a class="sidebar-link" href="{{url('admin/requested-store')}}"><i class="fas fa-dot-circle"></i>Business Request </a></li>


</ul>
</li>


<li class="sidebar-item {{ Request::is('admin/Site-Setting*') ? 'active' : '' }}">
    <a href="#Site-Setting" data-toggle="collapse" class="sidebar-link collapsed">
        <i class="fas fa-cogs"></i> <span class="align-middle">Site Setting</span>
    </a>

    <ul id="Site-Setting" class="sidebar-dropdown list-unstyled collapse">                         


   

       <li class="sidebar-item {{ Request::is('admin/mail-setting*') ? 'active' : '' }}" id="mail-setting"><a class="sidebar-link" href="{{url('admin/mail-setting')}}"><i class="fas fa-dot-circle"></i>Mail Setting </a></li>


       <li class="sidebar-item {{ Request::is('admin/social-login*') ? 'active' : '' }}" id="social-login"><a class="sidebar-link" href="{{url('admin/social-login')}}"><i class="fas fa-dot-circle"></i>Social login Settings </a></li>


       <li class="sidebar-item {{ Request::is('admin/sms-setting*') ? 'active' : '' }}" id="sms-setting"><a class="sidebar-link" href="{{url('admin/sms-setting')}}"><i class="fas fa-dot-circle"></i>SMS Setting </a></li>

       <li class="sidebar-item {{ Request::is('admin/bank-detail*') ? 'active' : '' }}" id="bank-detail"><a class="sidebar-link" href="{{url('admin/bank-detail')}}"><i class="fas fa-dot-circle"></i>Bank Detail </a></li>

       <li class="sidebar-item {{ Request::is('admin/term-condition*') ? 'active' : '' }}" id="term-condition"><a class="sidebar-link" href="{{url('admin/term-condition')}}"><i class="fas fa-dot-circle"></i>Terms & Conditions </a></li>


       <li class="sidebar-item {{ Request::is('admin/pages*') ? 'active' : '' }}" id="pages"><a class="sidebar-link" href="{{url('admin/pages')}}"><i class="fas fa-dot-circle"></i>Pages </a></li>
   </ul>
</li>

 

<li class="sidebar-item {{ Request::is('admin/wallet*') ? 'active' : '' }}">
    <a href="{{url('admin/wallet')}}" class="sidebar-link" id="wallet">
        <i class="fa fa-folder" data-feather="sliders"></i> <span class="align-middle">Wallet</span>
    </a>
</li>






<!-- 
<li class="sidebar-item {{ Request::is('admin/orders-invoices*') ? 'active' : '' }}">
    <a href="#orders-invoices" data-toggle="collapse" class="sidebar-link collapsed">
        <i class="fa fa-list-alt" data-feather="layout"></i> <span class="align-middle">Orders & Invoices</span>

    </a>

    <ul id="orders-invoices" class="sidebar-dropdown list-unstyled collapse">


     <li class="sidebar-item {{ Request::is('admin/all-order*') ? 'active' : '' }}" id="all-order"><a class="sidebar-link" href="{{url('admin/all-order')}}"><i class="fas fa-dot-circle"></i>All Orders <span class="sidebar-badge badge badge-primary">00</span></a></li>


     <li class="sidebar-item {{ Request::is('admin/pending-order*') ? 'active' : '' }}" id="pending-order"><a class="sidebar-link" href="{{url('admin/pending-order')}}"><i class="fas fa-dot-circle"></i>Pending Order <span class="sidebar-badge badge badge-primary">00</span></a></li>

     <li class="sidebar-item {{ Request::is('admin/process-order*') ? 'active' : '' }}" id="process-order"><a class="sidebar-link" href="{{url('admin/process-order')}}"><i class="fas fa-dot-circle"></i>Process Order <span class="sidebar-badge badge badge-primary">00</span></a></li> 

     <li class="sidebar-item {{ Request::is('admin/canceled-order*') ? 'active' : '' }}" id="canceled-order"><a class="sidebar-link" href="{{url('admin/canceled-order')}}"><i class="fas fa-dot-circle"></i>Canceled Order <span class="sidebar-badge badge badge-primary">00</span></a></li>

     <li class="sidebar-item {{ Request::is('admin/returned-order*') ? 'active' : '' }}" id="returned-order"><a class="sidebar-link" href="{{url('admin/returned-order')}}"><i class="fas fa-dot-circle"></i> Returned Orders<span class="sidebar-badge badge badge-primary">00</span></a></li>

     <li class="sidebar-item {{ Request::is('admin/delivered-order*') ? 'active' : '' }}" id="delivered-order"><a class="sidebar-link" href="{{url('admin/delivered-order')}}"><i class="fas fa-dot-circle"></i> Delivered Orders<span class="sidebar-badge badge badge-primary">00</span></a></li>

 </ul>
</li> -->






       <li class="sidebar-item {{ Request::is('admin/store-wise-payouts*') ? 'active' : '' }}">
                <a href="#store-wise-payouts" data-toggle="collapse" class="sidebar-link collapsed">
                  <i class="fab fa-cc-amazon-pay"></i> <span class="align-middle">Store Payouts</span>

              </a>
              <ul id="store-wise-payouts" class="sidebar-dropdown list-unstyled collapse">

               <li class="sidebar-item {{ Request::is('admin/store-wise-payout*') ? 'active' : '' }}" id="store-wise-payout"><a class="sidebar-link" href="{{url('admin/store-wise-payout')}}"><i class="fas fa-dot-circle"></i>Store Payout<span class="sidebar-badge badge badge-primary">00</span></a></li>



           </ul>
       </li>


      


<li class="sidebar-item {{ Request::is('admin/support-tickets*') ? 'active' : '' }}">
    <a href="{{url('admin/support-tickets')}}" class="sidebar-link" id="dashboard">
        <i class="fa fa-bullhorn" data-feather="sliders"></i> <span class="align-middle">Support Tickets</span>
    </a>
</li>











</ul>

<!-- 
<div class="sidebar-bottom d-none d-lg-block">
    <div class="media">
        <img class="rounded-circle mr-3" src="{{asset('public/img/mandeclan_logo.jpg')}}" alt="" width="40" height="40">
        <div class="media-body">
            <h5 class="mb-1 text-white">
                @if (Auth::guest())                  
                @else
                @if(Auth::user()->role == "1" || Auth::user()->role == "2" )
                {{ Auth::user()->name }} 
                @endif
                @endif
            </h5>
            <div class="text-light">

             <div class="text-light">
                <i class="fas fa-circle text-success"></i> Online
            </div>
        </div>
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

        <a title="Visit site" href="{{url('/'.session::get('locality_url'))}}" target="_blank">
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
            <a class="dropdown-item" href="{{url('admin/profile')}}"><i class="align-middle mr-1" data-feather="user"></i> Profile</a>

            <!-- <a class="dropdown-item" href="#">Settings & Privacy</a> -->


            <a class="dropdown-item" href="{{ url('admin/logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
        Sign out</a>


        <form id="logout-form" action="{{ url('admin/logout') }}" method="POST" style="display: none;">
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