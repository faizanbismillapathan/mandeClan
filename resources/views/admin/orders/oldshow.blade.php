@extends('admin.layouts.app')
@section('title',"Edit Orders Process | Admin Mande Clan")

<!-- ................custom css................. -->

@section('customStyle')
<style type="text/css">
.text-muted{
background: #f8f9fa;
}
</style>
@endsection

<!-- ................Add css link................. -->

@push('style')
<link rel="stylesheet" href="{{asset('public/css/bootstrap-fileupload.css')}}">

@endpush

<!-- ................body................. -->
@section('innercontent')


<main class="content">
<div class="container-fluid p-0">
<div class="clearfix">
<a href="{{url('admin/offline-payment')}}" class="form-inline float-right mt--1 d-none d-md-flex">
<button class="btn btn-info"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Back</button>
</a>
<h1 class="h3 mb-3"><b>Update Orders Process</b></h1>

</div>
<div class="card">

<div class="card-body">
<div class="contentbar">

<div class="row">
&ZeroWidthSpace;
&ZeroWidthSpace;
<div class="col-lg-12">
<div class="card m-b-30">

<div class="card-header">
<h5>View Order #EODD61753832753b0</h5>
</div>
<div class="card-body">
<div class="card m-b-30">
&ZeroWidthSpace;





<table class="table table-striped">
<thead>
<tr>
<th>Customer Information</th>
<th>Shipping Address</th>
<th>Billing Address</th>
</tr>
</thead>

<tbody>
<tr>
<td>

<p><b>CustomerName</b></p>
<p><i class="fas fa-envelope-square"></i>admin@mediacity.co.in</p>
<p><i class="fa fa-phone"></i> 1645787953</p>

<p><i class="fa fa-map-marker" aria-hidden="true"></i>
Bhilwara,
Rajasthan,
India
</p>


</td>
<td>
<p><b>John Doe, 7894561230</b></p>
<p class="font-weight600">Sector -62 , RCM Area,</p>
<p class="font-weight600">Bhilwara, Rajasthan, Bhilwara</p>
<p class="font-weight600">311001</p>
</td>
<td>
<p><b>John Doe,
7894561230</b>
</p>
<p class="font-weight600">Sector -62 , RCM Area,
</p>
<p class="font-weight600">Bhilwara, Rajasthan, Bhilwara</p>
<p class="font-weight600">
311001
</p>
</td>
</tr>
</tbody>
</table>


<table class="table table-striped">
<thead>
<tr><th>
Order Summary
</th>
<th></th>

<th></th>
</tr></thead>

<tbody>
<tr>
<td>
<p><b>Store Name:</b> Zareena Mart</p>
<p><b>Total Qty:</b> 4</p>
<p><b>Order Total: <i class="fas fa-dollar-sign"></i>19719.45</b>
</p>
</td>

<td>
<p><b>Payment Method: </b> Cashfree
</p><p><b>Transcation ID:</b> <b><i>1130877</i></b></p>
<p><b>Payment Recieved:</b> <span class="badge badge-info">Paid</span></p>


</td>

<td>
	<p><b>Tip:</b> <span class="badge badge-success">$ 10</span></p>

<p><b>Order Date:</b> 24/10/2021 @ 07:11 am
<p><b>Delivery Date:</b> 27/10/2021
</p>
</td>
</tr>
</tbody>
</table>


<hr>
<table class="table table-striped">
<thead>
<tr><th>Order Details</th>
</tr></thead>
</table>

<table class="table table-striped table-bordered">
<thead>
<tr>
<th>Invoice No</th>
<th>Item Name</th>
<th>Qty</th>
<th>Status</th>
<th>Pricing &amp; Tax</th>
<th>Total</th>
<th>#</th>
</tr>
</thead>
<tbody>
<tr>
<td>
<i>EMRT103MRTE2019</i>
</td>

<td>
<div class="row">
<div class="col-md-4">

<img width="60px" class="object-fit" src="{{url('public/img/mobile.png')}}" alt="">
</div>

<div class="col-md-8">

<a class="text-justify mleft22" href="{{url('/')}}/products/1/itab" target="_blank">
<b>iTab</b>
</a>

<br>

<small class="mleft22"><b>Sold By:</b>
mandeclan</small>
<br>
<small class="mleft22"><b>Price: </b> <i class="fas fa-dollar-sign"></i>

7722.96

</small>

<br>

<small class="mleft22"><b>Tax:</b> <i class="fas fa-dollar-sign"></i>1695.28

</small>

</div>

</div>
</td>

<td>
2
</td>

<td>
<span class="badge badge-pill badge-default"></span>
</td>

<td>
<b>Total Price:</b> <i class="fas fa-dollar-sign"></i>

15445.91

<p></p>
<b>Total Tax:</b> <i class="fas fa-dollar-sign"></i>3390.56
<p></p>
<b>Shipping Charges:</b> <i class="fas fa-dollar-sign"></i>882.96
<p></p>


<small class="help-block">(Price &amp; TAX Multiplied with Quantity)</small>
<p></p>


</td>


<td>
<i class="fas fa-dollar-sign"></i>

19719.43

<br>

<small>(Incl. of TAX &amp; Shipping)</small>
</td>

<th>
<div class="dropdown">
<button class="btn btn-round btn-outline-primary" type="button" id="CustomdropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>
<div class="dropdown-menu" aria-labelledby="CustomdropdownMenuButton1">
<a href="{{url('/')}}/order/61753832753b0/invoice/3" class="dropdown-item" target="__blank">
<i class="fas fa-print"></i>Print
</a>
</div>
</div>

</th>
</tr>


<tr>
<td>
<i>EMRT103MRTE2019</i>
</td>

<td>
<div class="row">
<div class="col-md-4">

<img width="60px" class="object-fit" src="{{url('public/img/mobile.png')}}" alt="">
</div>

<div class="col-md-8">

<a class="text-justify mleft22" href="{{url('/')}}/products/1/itab" target="_blank">
<b>iTab</b>
</a>

<br>

<small class="mleft22"><b>Sold By:</b>
mandeclan</small>
<br>
<small class="mleft22"><b>Price: </b> <i class="fas fa-dollar-sign"></i>

7722.96

</small>

<br>

<small class="mleft22"><b>Tax:</b> <i class="fas fa-dollar-sign"></i>1695.28

</small>

</div>

</div>
</td>

<td>
2
</td>

<td>
<span class="badge badge-pill badge-default"></span>
</td>

<td>
<b>Total Price:</b> <i class="fas fa-dollar-sign"></i>

15445.91

<p></p>
<b>Total Tax:</b> <i class="fas fa-dollar-sign"></i>3390.56
<p></p>
<b>Shipping Charges:</b> <i class="fas fa-dollar-sign"></i>882.96
<p></p>


<small class="help-block">(Price &amp; TAX Multiplied with Quantity)</small>
<p></p>


</td>


<td>
<i class="fas fa-dollar-sign"></i>

19719.43

<br>

<small>(Incl. of TAX &amp; Shipping)</small>
</td>

<th>
<div class="dropdown">
<button class="btn btn-round btn-outline-primary" type="button" id="CustomdropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>
<div class="dropdown-menu" aria-labelledby="CustomdropdownMenuButton1">
<a href="{{url('/')}}/order/61753832753b0/invoice/3" class="dropdown-item" target="__blank">
<i class="fas fa-print"></i>Print
</a>
</div>
</div>

</th>
</tr>

<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td><b>Subtotal</b></td>
<td><b><i class="fas fa-dollar-sign"></i>19719.45</b>
</td>
<td></td>
</tr>

<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td><b>Coupon Discount</b></td>
<td><b>- <i class="fas fa-dollar-sign"></i>0</b>
()</td>
<td></td>
</tr>

<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td><b>Gift Packaging Charge</b></td>
<td><b>+ <i class="fas fa-dollar-sign"></i>0</b>
</td>
<td></td>
</tr>

<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td><b>Handling Charge</b></td>
<td><b>+ <i class="fas fa-dollar-sign"></i>735.8</b>
</td>
<td></td>
</tr>

<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td><b>Grand Total</b></td>
<td><b><i class="fas fa-dollar-sign"></i>

20455.25

</b></td>
<td></td>
</tr>
</tbody>
</table>

<hr>

<hr>

<h4>Order Activity Logs</h4>

<small>
<b>#EODD61753832753b0</b></small>
<br>
<span id="logs">




<small>18-11-2021 | 07:18:am • For Order Item
<b>iTab</b>                                     <span class="text-danger"><b>Admin</b> (Admin)</span> changed status
to
<b></b>
</small>

<p></p>
</span>
<!-- ============================== -->

</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</main>
@endsection

<!-- ................push new js link................. -->

@push('js')
<script src="{{asset('public/js/validation.js')}}"></script>

@endpush