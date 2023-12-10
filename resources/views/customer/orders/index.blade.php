@extends('customer.layouts.app')
@section('title',"All Orders | customer Mande Clan")

<!-- ................custom css................. -->

@section('customStyle')
<style type="text/css">

.table{
margin-top: 1rem;
border:1px dashed #999;
}
.table th,.table td{
padding:0.4rem !important;
text-align:center;
}
.table tbody tr td img{
width:0.7rem;
}


.profile-order-history .order-history {
border: 1px dashed #ccc;
}
.profile-order-history .div1 {
border-bottom: 1px solid #f5f5f5;
padding: 10px 20px;
}
.profile-order-history .div1 .row {
margin-left: -5px;
margin-right: -5px;
}
.profile-order-history .div1 .row .col-md-5, .profile-order-history .div1 .row .col-md-7 {
padding-left: 5px;
padding-right: 5px;
}
.profile-order-history .div1 p {
margin-bottom: 0px;
}
.badge-warning {
background-color: #ff9800;
}
.profile-order-history .div1 .p5 {
font-size: 13px;
}
.profile-order-history .image-thumbanail {
position: relative;
width: 100%;
height: 40px;
border-radius: 4px;
}
.profile-order-history .image-thumbanail img {
position: absolute;
height: 100%;
border-radius: 4px;
}
.profile-order-history .div2 h6 {
margin-top: 0px;
margin-bottom: 5px;
}
.profile-order-history .p4 {
margin-bottom: 0px;
}
.profile-order-history .div3 {
border-top: 1px solid #f5f5f5;
padding: 10px 20px;
}
.profile-order-history .p4 {
margin-bottom: 0px;
}
.profile-order-history .btn.btn-danger, .profile-order-history .btn.btn-success, .profile-order-history .btn.btn-secondary {
text-transform: capitalize;
font-size: 12px;
padding: 4px 6px;
margin-bottom: 0px;
}
.profile-order-history .row1 {
margin-left: -5px;
margin-right: -5px;
}
.profile-order-history .row1 .col-md-2, .profile-order-history .row1 .col-md-8 {
padding-left: 5px;
padding-right: 5px;
}
.profile-order-history .div2 {
padding: 0px 20px;
}
.profile-order-history .green {
color: green;
}
.profile-order-history .text-success {
color: #038103 !important;
cursor: pointer;
text-decoration: underline;
}
.profile-order-history .p3 {
margin-bottom: 0px;
margin-top: 10px;
}
.pull-right {
float: right;
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
@section('innercontent')

<main class="content profile-order-history">
<div class="container-fluid p-2">

<div class="clearfix">

<h1 class="h3 mb-3">Orders &nbsp;&nbsp;@if(!empty($record))({{$record->total()}})@endif</h1>
</div>

<div class="card">
<div class="card-body">
<div class="row">
        
   
@if(!empty($records))
@foreach($records as $index=>$data)
    <div class="col-md-6">



<div class="order-history">
<div class="div1">
<div class="row">
<div class="col-md-5 col-xs-6">
<p>Order No.: <span class="badge badge-warning"> {{$data->suborder_u_id}}</span></p>
</div>
<div class="col-md-7 col-xs-6">
<div class="pull-right">
<p class="p5">{{date('d-M-y',strtotime($data->order_date))}} {{date('h:i a',strtotime($data->order_date))}}</p>
</div>
</div>
</div>
</div>
<div class="div2">
<div class="row row1">
<div class="col-md-2 col-xs-3">
<div class="image-thumbanail">
@if(!empty($data->store_info->store_cover_photo))
<img src="{{ asset('public/images/store_cover_photo/'.$data->store_info->store_cover_photo)}}" alt="dd" />
@else
<img src="{{ asset('public/img/no-image.png')}}" alt="dd" />
@endif

            </div>
</div>
<div class="col-md-10 col-xs-9">
<h6>{{$data->store_info->store_name}} ({{$data->store_info->category->category_name}})</h6>
<p class="p4">{{$data->store_info->locality->locality_name}}, {{$data->store_info->city->city_name}}, {{$data->store_info->state->state_name}}, {{$data->store_info->country->country_name}}</p>
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
    <td><img src="{{url('/')}}/public/img/dollar.png" class="rupees-img"> {{$data->subtotal}}</td>
    <td><img src="{{url('/')}}/public/img/dollar.png" class="rupees-img"> {{$data->shipping_charges}}</td>
    <td><img src="{{url('/')}}/public/img/dollar.png" class="rupees-img"> {{$data->grand_total}}</td>
</tr>
</tbody>
</table>
</div>


<div class="col-md-12" style="padding:0;">
    <span style="font-size:0.9rem;font-weight:bold;text-align:left;">Delivery By:
        {{$data->pickup_type}}
    </span>
    <span style="font-size:0.9rem;font-weight:bold;text-align:right;float: right;">{{date('d-M-y',strtotime($data->delivery_date))}} {{$data->delivery_time}}</span>

</div>
</div>
</div>
<div class="div3">
<div class="row">

<div class="col-md-9 col-xs-10">

@if($data->order_status=='Pending')
<button class="btn  btn-danger cancel-btn" data="{{$data->id}}" data-toggle="modal" data-target="#cancel" id="cancel_ord_i">
Cancel order
</button>
@endif

{{-- <button class="btn  btn-danger cancel-btn" data="{{$data->id}}" data-toggle="modal" data-target="#cancel" id="cancel_ord_{{$data->id}}">
Cancel order
</button> --}}


<a href="{{url('/customer/track-order/'.$data->id)}}">
<button class="btn  btn-success">
    Track order
</button>
</a>
<a href="{{url('/')}}/customer/order-detail/{{$data->id}}">
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
<span class="badge badge-success">{{$data->order_status}}</span>
</b>
</p> 
</div>
</div>
</div>
</div>
</div>
</div>
@endforeach
@endif
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

<input type="hidden" name="suborder_id" value="" class="suborders_cls">
<div class="close-btn">
<i class="far fa-times-circle" data-dismiss="modal" aria-label="Close"></i>
</div>
</div>
<div class="modal-body">
<p>Are you sure ,You want to cancel order ?</p>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-raised btn-danger order-yes" id="modal_delete">Yes</button>
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

<script type="text/javascript">
    
              $(document).ready(function() {


       $('.cancel-btn').on('click',function(){

var id = $(this).attr('data')
// alert(id)
$(".suborders_cls").val(id)



})
       $('#modal_delete').on('click',function(){
        
var id = $(".suborders_cls").val();

          
            var value = 'Cancelled';
            console.log(value);

            var data;
           if(value) {  
              $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});
                 $.ajax({
          url: "{{url('customer/change_suborder_status')}}",
          type: "post",
          data: {value:value,id:id},
                    dataType: "json",
                    success:function(res) {
                        var data= "your status is "+res;       


                  var message = data;
                  var title = $('#toastr-title').val() || '';
                     var type = 'success';
                  toastr[type](message, title, {
                    positionClass: $('input[name="toastr-position"]:checked').val(),
                    closeButton: 'true',
                    progressBar:'true',
                    newestOnTop: 'true',
                    rtl: $('body').attr('dir') === 'rtl' || $('html').attr('dir') === 'rtl',
                    timeOut: $('#toastr-duration').val()
                  });


                  location.reload();
                  
                },

                error:function(error) {
                        console.log(error);
                  
                }

                });
                    }
          


            });

            });
</script>
@endpush