@extends('customer.layouts.app')
@section('title',"All Track Order | customer Mande Clan")

<!-- ................custom css................. -->

@section('customStyle')

@endsection

<!-- ................Add css link................. -->

@push('style')
@endpush

<!-- ................body................. -->
@section('innercontent')

<style>
    @media only screen and (max-width: 500px) {
 .content{
    padding:0;
    }
    .mobile-header{
        display:none !important;
    }
}
</style>

<main class="content profile-order-history">
<div class="container-fluid p-2">

<div class="clearfix">



<!-- 
<a href="{{url('customer/orders/create')}}" class="form-inline float-right mt--1 d-none d-md-flex">
<button class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create a New orders</button>
</a> -->

<h1 class="h3 mb-3">Track Order &nbsp;&nbsp;@if(!empty($records))({{$records->total()}})@endif</h1>
</div>

<div class="card">
<div class="card-body">

<div class="order-history">
<div class="div1">
<div class="row">
<div class="col-md-5 col-xs-6">
<p>Order No.: <span class="badge badge-warning"> ORDH</span></p>
</div>
<div class="col-md-7 col-xs-6">
<div class="pull-right">
<p class="p5">Oct 27, 2021 at 05:34 PM</p>
</div>
</div>
</div>
</div>
<div class="div2">
<div class="row row1">
<div class="col-md-2 col-xs-3">
<div class="image-thumbanail">
<img src="{{url('assets/front/img/banner1.jpg')}}">
</div>
</div>
<div class="col-md-10 col-xs-9">
<h6>Shafique Kirana Dukan</h6>
<p class="p4">Sadar, Nagpur - 440001</p>
</div>
</div>
<div class="row row1">
<div class="col-md-12" style="padding:0;">
<table class="table table-striped" style="">
<thead>
<tr>
    <th>Sub Total</th>
    <th>Shipping</th>
    <th>Total</th>
</tr>
</thead>
<tbody>
<tr>
    <td><img src="{{url('/')}}/public/img/dollar.png" class="rupees-img"> 498</td>
    <td><img src="{{url('/')}}/public/img/dollar.png" class="rupees-img"> 39</td>
    <td><img src="{{url('/')}}/public/img/dollar.png" class="rupees-img"> 537</td>
</tr>
</tbody>
</table>
</div>
<div class="col-md-12" style="padding:0;">
    <span style="font-size:0.9rem;font-weight:bold;text-align:left;">Delivery By:
        Home Delivery
    </span>
    <span style="font-size:0.9rem;font-weight:bold;text-align:right;float: right;">Time Slot : 09:00 am To 12:00 pm</span>

</div>
</div>
</div>
<div class="div3">
<div class="row">

<div class="col-md-9 col-xs-10">
<button class="btn  btn-danger cancel-btn" data-toggle="modal" data-target="#cancel" id="cancel_ord_i">
Cancel order
</button>
<a href="{{url('/')}}/track-order">
<button class="btn  btn-success">
    Track order
</button>
</a>
<a href="{{url('/')}}/order-detail">
<button class="btn  btn-secondary">
    View Details
</button>
</a>
</div>

<div class="col-md-3 col-xs-2">
    <div class="pull-right">

<p class="p4">
<i class="fas fa-hourglass-half text-warning"></i>
<b style="font-size:10px;">
Process
</b>
</p> 
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="card">
<div class="card-body">
<div class="order-history">
<div class="div1">
<div class="row">
<div class="col-md-5 col-xs-6">
<p>Order No.: <span class="badge badge-warning"> ORDHM428</span></p>
</div>
<div class="col-md-7 col-xs-6">
<div class="pull-right">
<p class="p5">May 3, 2020 at 06:01 PM</p>
</div>
</div>
</div>
</div>
<div class="div2">
<div class="row row1">
<div class="col-md-2 col-xs-3">
<div class="image-thumbanail">
<img src="{{url('assets/front-end/img')}}">
</div>
</div>
<div class="col-md-10 col-xs-9">
<h6>Amit Kirana Dukan</h6>
<p class="p4">Sadar, Nagpur - 440001</p>
</div>
</div>
<div class="row row1">
<div class="col-md-12" style="padding:0;">
<table class="table table-striped" style="">
<thead>
<tr>
    <th>Sub Total</th>
    <th>Shipping</th>
    <th>Total</th>
</tr>
</thead>
<tbody>
<tr>
    <td><img src="{{url('/')}}/public/img/dollar.png" class="rupees-img"> 815</td>
    <td><img src="{{url('/')}}/public/img/dollar.png" class="rupees-img"> 19</td>
    <td><img src="{{url('/')}}/public/img/dollar.png" class="rupees-img"> 834</td>
</tr>
</tbody>
</table>
</div>


<div class="col-md-12" style="padding:0;">
    <span style="font-size:0.9rem;font-weight:bold;text-align:left;">Delivery By:
        Self Pickup
    </span>
    <span style="font-size:0.9rem;font-weight:bold;text-align:right;float: right;">Time Slot : 09:00 am To 12:00 pm</span>

</div>



</div>
</div>
<div class="div3">
<div class="row">
<div class="col-md-3 col-xs-2">
<p class="p4">
<i class="fas fa-hourglass-half text-warning"></i>
<b style="font-size:10px;">
Process
</b>
</p> 
</div>
<div class="col-md-9 col-xs-10">
<div class="pull-right">
<button class="btn  btn-danger cancel-btn" data-toggle="modal" data-target="#cancel" id="cancel_ord_id428">
Cancel order
</button>
<a href="{{url('/')}}/track-order/">
<button class="btn  btn-success">
    Track order
</button>
</a>
<a href="{{url('/')}}/order-detail">
<button class="btn  btn-secondary">
    View Details
</button>
</a>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="card">
<div class="card-body">
<div class="order-history">
<div class="div1">
<div class="row">
<div class="col-md-5 col-xs-6">
<p>Order No.: <span class="badge badge-warning"> ORDHM402</span></p>
</div>
<div class="col-md-7 col-xs-6">
<div class="pull-right">
<p class="p5">Apr 11, 2020 at 05:29 PM</p>
</div>
</div>
</div>
</div>
<div class="div2">
<div class="row row1">
<div class="col-md-2 col-xs-3">
<div class="image-thumbanail">
<img src="{{url('assets/front-end/img')}}">
</div>
</div>
<div class="col-md-10 col-xs-9">
<h6>Shafique Kirana Dukan</h6>
<p class="p4">Sadar, Nagpur - 440001</p>
</div>
</div>
<div class="row row1">
<div class="col-md-12" style="padding:0;">
<table class="table table-striped" style="">
<thead>
<tr>
    <th>Sub Total</th>
    <th>Shipping</th>
    <th>Total</th>
</tr>
</thead>
<tbody>
<tr>
    <td><img src="{{url('/')}}/public/img/dollar.png" class="rupees-img"> 705</td>
    <td><img src="{{url('/')}}/public/img/dollar.png" class="rupees-img"> 19</td>
    <td><img src="{{url('/')}}/public/img/dollar.png" class="rupees-img"> 724</td>
</tr>
</tbody>
</table>
</div>
<div class="col-md-12" style="padding:0;">
    <span style="font-size:0.9rem;font-weight:bold;text-align:left;">Delivery By:
        Home Delivery
    </span>
    <span style="font-size:0.9rem;font-weight:bold;text-align:right;float: right;">Time Slot : 09:00 am To 12:00 pm</span>

</div>
</div>
</div>
<div class="div3">
<div class="row">
<div class="col-md-3 col-xs-2">
<p class="p4">
<i class="fas fa-hourglass-half text-warning"></i>
<b style="font-size:10px;">
Process
</b>
</p> 
</div>
<div class="col-md-9 col-xs-10">
<div class="pull-right">
<a href="{{url('/')}}/track-order/">
<button class="btn  btn-success">
    Track order
</button>
</a>
<a href="{{url('/')}}/order-detail">
<button class="btn  btn-secondary">
    View Details
</button>
</a>
</div>
</div>
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



<div class="modal fade comman-modal" id="cancel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<span class="cancel-this-order" style="display:none;"></span>
<div class="vertical-align-outer-div">
<div class="vertical-align-inner-div">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header modal-header-padding">
<h5>Cancel order</h5>
<div class="close-btn">
<i class="far fa-times-circle" data-dismiss="modal" aria-label="Close"></i>
</div>
</div>
<div class="modal-body">
<p>Are you sure want to cancel order ?</p>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-raised btn-danger order-yes">Yes</button>
<button type="button" class="btn btn-raised btn-secondary order-no" data-dismiss="modal">No</button>
</div>
</div>
</div>
</div>
</div>
</div>

@endsection

<!-- ................push new js link................. -->

@push('js')
<script src="{{asset('public/js/comman.js')}}"></script>
@endpush