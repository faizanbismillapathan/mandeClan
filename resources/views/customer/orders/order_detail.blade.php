@extends('customer.layouts.app')
@section('title',"All Orders Detail | customer Mande Clan")

<!-- ................custom css................. -->

@section('customStyle')
<style type="text/css">
    .profile-my-order-details .card-padding h4
{
    font-size: 16px;
}
.profile-my-order-details .outer-div
{
    width: 15px;
    height: 15px;
    margin-right: 6px;
}
.profile-my-order-details .inner-div
{
    width: 5px;
    height: 5px;
}
.profile-my-order-details .rupees-img
{
    width: 15px;
}
.profile-my-order-details .total-amt-div
{
    background-color: rgba(255, 152, 0, 0.07058823529411765);
    padding: 10px;
    margin-top: 10px;
}
.profile-my-order-details .total-amt-div hr
{
    margin-top: 0.6rem;
    margin-bottom: 0.6rem;
    border-top: 1px solid rgba(255, 152, 0, 0.29);
}
.profile-my-order-details .total-amt-div h4,
.profile-my-order-details .total-amt-div p
{
    margin-bottom: 0px;
    margin-top: 0px;
}
.profile-my-order-details .shipping-address 
{
    margin-top: 20px;
    border: 1px solid #f5f5f5;
    padding: 10px;
}
.profile-my-order-details .shipping-address .col-md-3
{
    flex: 0 0 19%;
    max-width: 19%;
}
.profile-my-order-details .shipping-address .col-md-9
{
    flex: 0 0 81%;
    max-width: 81%;
}
.profile-my-order-details .badge-danger, .profile-my-order-details .badge-success
{
    font-size: 10px;
    font-weight: 500;
    margin-left: 6px;
}
.profile-my-order-details .item-list .row
{
    border-bottom: 1px solid #fafafa;
}
.profile-my-order-details .item-list .row:hover
{
    background-color: #fafafa;
}
.profile-my-order-details .item-list .row:last-child
{
    border-bottom: 0px solid transparent
}
.profile-my-order-details .row1 
{
    border: 1px solid #f5f5f5;
    background-color: #fafafa;
    padding: 10px;
}
.profile-my-order-details .row1 p 
{
    margin-bottom: 0px;
}
.profile-my-order-details .row1 p a
{
    text-decoration: underline;
}
.profile-my-order-details .row1 p i 
{
    padding-right: 4px;
}
.profile-my-order-details .total-amt
{
    font-size: 16px;
    font-weight: 600;
    margin-top: 10px;
    margin-bottom: 0px;
    text-transform: uppercase;
}
.profile-my-order-details .btn-danger
{
    margin-top: 20px;
    background-color: red;
}
@media only screen and (max-width: 500px) {
 .content{
    padding:0;
}
}
</style>
@endsection

<!-- ................Add css link................. -->

@push('style')
@endpush

<!-- ................body................. -->

<!-- ................body................. -->
@section('innercontent')


<main class="content">
<div class="container-fluid p-2">
<div class="clearfix">
<a href="{{url('customer/my-orders')}}" class="form-inline float-right mt--1 d-none d-md-flex">
<button class="btn btn-info"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Back</button>
</a>
<h1 class="h3 mb-3"><b>Update Orders Process</b></h1>

</div>
<div class="card">

<div class="card-body">
<div class="contentbar">

<div class="div">
     
     <div class="content">
      <div class="row">
        <div class="col-md-6">


           <p style="color:red"><b>Payment Mode :</b> {{$order->payment_method}}</p>
          <p><b>Delivery Address</b></p>



             @if($order->pickup_type=='Self Pickup')
              <p>{{$users->name}}<br>
            <span class="badge badge-light">
            {{$order->pickup_type}}   
            </span>         
             </p>
            
          <p><b>Mobile No. :</b>{{$users->mobile}}</p>
          <p><b>Email Id :</b> {{$users->email}}</p>
         
          @else

          <p>{{$addressBook->customer_name}}<br>
             @if(!empty($addressBook->localitys)){{$addressBook->localitys->locality_name}} @endif @if(!empty($addressBook->citys)), {{$addressBook->citys->city_name}} @endif  @if(!empty($addressBook->states)), {{$addressBook->states->state_name}} @endif @if(!empty($addressBook->countrys)) ,{{$addressBook->countrys->country_name}} @endif<br>
             {{$addressBook->customer_address}}
             </p>
          <p><b>Mobile No. :</b>{{$addressBook->customer_mobile}}</p>
          <p><b>Email Id :</b> {{$addressBook->customer_email}}</p>

          @endif
        </div>
        <div class="col-md-6">
          <div class="">
            <p><b>Invoice No :</b> <span class="orderno">{{$order->suborder_u_id}}</span></p>
            <p><b>Total Amount </b><span class="total-rupees">{{'$ '.$order->grand_total}}</span></p>
            <p><b>Order Date :</b> {{date('d-M-y',strtotime($order->order_date))}}</p>
            <p><b>Delivery Date :</b> {{date('d-M-y',strtotime($order->delivery_date))}}</p>
            <p><b>Delivery Slot Time :</b>{{$order->delivery_time}}</p>
          </div>
        </div>
      </div>
      <!--  -->
  <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr class="blue">
          <th>Sr. No</th>
          <th>Item</th>
          <th>Price</th>
          <th>Qty</th>
          <th>Weight</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>

         @foreach($order_items as $index=>$data)
        <tr>
           <th>{{ $data->item_u_id}}</th>
          <td>{{$data->product_name}}
@if(!empty($data->addon_details))
<br>
@foreach($data->addon_details as $value)

<span class="badge badge-light">{{$value}}
</span>@endforeach

@endif
          </td>
          <td>{{'$ '.$data->item_selling_price}}

@if($data->item_offer_discount)
           <del>{{ round($data->item_price,2) }}</del> <span class="text-danger">({{ $data->item_offer_discount }}% Off )</span>
@endif
          </td>
          <td>{{$data->item_quantity}}</td>

          @if(isset($data->item_shipping_weight))
            <td><span>{{$data->item_shipping_weight * $data->item_quantity}} {{$data->item_shipping_weight_unit}}</span></td>
          
          @else

          <td></td>
            @endif


          <td>$ {{$data->item_selling_price * $data->item_quantity}}</td>
        </tr>

         @endforeach
        <tr class="lightgray">
          <td colspan="5"><span class="pull-right">Sub Total</span></td>
          <td>{{'$ '.$order->subtotal}}</td>
        </tr>
        <tr class="lightgray">
          <td colspan="5"><span class="pull-right">Shipping Charges</span></td>
          <td>{{'$ '.$order->shipping_charges}}</td>
        </tr>
        <tr class="gray">
          <td colspan="5"><span class="pull-right"><b>Grand Total</b></span></td>
          <td><b>{{'$ '.$order->grand_total}}</b></td>
        </tr>
      </tbody>
    </table>
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
<script src="{{asset('public/js/comman.js')}}"></script>
@endpush