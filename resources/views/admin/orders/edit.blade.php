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
<div class="col-lg-12">
<div class="card m-b-30">
<div class="card-header">
    <h5 class="box-title">Edit Order 6175302cad557</h5>
</div>
<div class="card-body ml-2">
    <!-- main content start -->

    <!-- form start -->
    <!-- Checking Mnaual payment -->


    <!-- Printing order cancel logs-->


    <!-- Printing refund logs if any -->



    <div class="row">
        <!-- ----------------------- -->
        <div class="col-md-6">
            <div class="card m-b-30 bg-primary-rgba text-muted rounded p-2 mt-2">
                <div class="card-body">
                    <p class="card-text"><b>Order Placed On :</b> {{date("Y-m-d", strtotime($order->order_date))}} @ {{date("g:i A", strtotime($order->order_date))}}</p>
                    <p class="card-text"><b>Order ID :</b> {{$order->order_u_id}}</p>

                    <p class="card-text"><b>Total qty. :</b> {{$order->total_order_qty}}</p>
                    <p class="card-text"><b>Order Total :</b> {{$order->total_store_wise_order}}</p>
                    <p class="card-text"><b>Tip :</b> $ {{$order->total_tip_price}}</p>

                </div>
            </div>  
        </div>

        <div class="col-md-6 ">
            <div class="card m-b-30 bg-primary-rgba text-muted rounded p-2 mt-2">
                <div class="card-body">
                                        <p class="card-text"><b>Store Name :</b> XYZ Shop Name</p>

                    <p class="card-text"><b>Payment method :</b> Paytm</p>
                    <p class="card-text"><b>Transcation ID :</b> 20211024111212800110168958503102263</p>
                    <p class="card-text"><b>Payment Received</b>
                    </p>

                    <p>Yes</p>

                </div>
            </div>  
        </div>
        <!-- ----------------------- -->

        <!-- ------ Delivery Address start ----------------- -->
        <div class="col-md-6">
            <div class="card m-b-30 bg-primary-rgba text-muted rounded p-2 mt-2">
                <div class="card-header">
                    <h5 class="card-title">Delivery Address</h5>
                </div>
                <div class="card-body">
                    <p><b>John Doe</b></p>
                    <p><i class="fas fa-envelope-square"></i>
                        <a href="mailto:sam.curran@test.com">
                            sam.curran@test.com
                        </a>
                    </p>
                    <p><i class="fa fa-phone"></i>
                        <a href="tel:7894561230">7894561230</a>
                    </p>
                    <p><i class="fa fa-map-marker" aria-hidden="true"></i> 
                        Bhilwara, 
                        Rajasthan, 
                        India,
                        311001
                    </p>

                </div>
            </div>  
        </div>
        <!-- -------- Delivery Address end --------------- -->

        <!-- ------ Billing Address start ----------------- -->
        <div class="col-md-6">
            <div class="card m-b-30 bg-primary-rgba text-muted rounded p-2 mt-2">
                <div class="card-header">
                    <h5 class="card-title">Billing Address</h5>
                </div>
                <div class="card-body">
                    <p><b>John Doe</b></p>
                    <p><i class="fas fa-envelope-square"></i> 
                        <a href="mailto:sam.curran@test.com">
                            sam.curran@test.com
                        </a>
                    </p>
                    <p><i class="fa fa-phone"></i>
                        <a href="tel:7894561230">
                            7894561230
                        </a>
                    </p>


                    <p><i class="fa fa-map-marker" aria-hidden="true"></i> 
                        Bhilwara, 
                        Rajasthan, 
                        India,
                        311001
                    </p>

                </div>
            </div>  
        </div>
        <!-- -------- Billing Address end --------------- -->


        <div class="col-md-12">


        </div>

        <!-- Order Summary -->
        <div class="col-md-12">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Invoice No</th>
                        <th>Item Name</th>
                        <th>Qty</th>
                        <th>Status</th>
                        <th>Pricing &amp; Tax</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr></thead>

                    <tbody>
                        <tr>

                            <td>
                                <i>EMRT102MRTE2019</i>
                            </td>

                            <td>
                                <div class="row">
                                    <div class="col-md-4">

                                        <img width="60px" class="object-fit" src="{{url('public/img/mobile.png')}}" alt="">
                                    </div>

                                    <div class="col-md-8">

                                        <a class="text-justify" href="{{url('/')}}/products/1/itab" target="_blank">
                                            <b>iTab</b>
                                        </a>
                                        <br>

                                        <small><b>Sold By:</b> mandeclan</small>
                                        <br>
                                        <small><b>Price:</b>
                                            <i class="fas fa-dollar-sign"></i>

                                            104.96

                                        </small>
                                        <br>
                                        <small><b>Tax:</b> <i class="fas fa-dollar-sign"></i>23.04</small>

                                    </div>
                                </div>
                            </td>

                            <td>
                                2
                            </td>

                            <td>    
                                <div id="singleorderstatus2">
                                    <span class="badge badge-pill badge-default">Pending</span>

                                </div>

                                <br>

            {!!Form::select('store_country',['Change order status','Pending','Processed','Ready To Pickup','Dispatch'],null,array('class'=>'form-control select2 selector','placeholder'=>'Select Country','data-toggle'=>'select2','required')) !!}

                            </td>

                            <td>
                                <b>Total Price:</b> <i class="fas fa-dollar-sign"></i>

                                209.92

                                <p></p>
                                <b>Total Tax:</b> <i class="fas fa-dollar-sign"></i>23.04
                                <p></p>
                                <b>Shipping Charges:</b> <i class="fas fa-dollar-sign"></i>12
                                <p></p>


                                <small class="help-block">(Price &amp; TAX Multiplied with Quantity)</small>
                                <p></p>
                            </td>

                            <td>
                                <i class="fas fa-dollar-sign"></i>

                                268

                                <br>
                                <small>
                                    (Incl. of TAX &amp; Shipping)
                                </small>
                            </td>

                            <td>
                                <!-- ------------------------------ -->
                                <div class="dropdown">
                                    <button class="btn btn-round btn-outline-primary" type="button" id="CustomdropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>
                                    <div class="dropdown-menu" aria-labelledby="CustomdropdownMenuButton1">

                                        <li role="presentation">
                                            <a class="dropdown-item" href="{{url('/')}}/update/order/2">
                                                <i class="fa fa-truck"></i> Ship
                                            </a>
                                        </li>




                                        <div class="divider"></div>
                                        <li role="presentation">

                                            <a role="button" class="dropdown-item" id="canbtn2" data-toggle="modal" data-target="#singleordercancel2" title="Cancel this order?">
                                                <i class="fa fa-ban"></i> Cancel
                                            </a>

                                        </li>



                                    </div>
                                </div>
                                <!-- ------------------------------ -->

                            </td>
                        </tr>

                          <tr>

                            <td>
                                <i>EMRT102MRTE2019</i>
                            </td>

                            <td>
                                <div class="row">
                                    <div class="col-md-4">

                                        <img width="60px" class="object-fit" src="{{url('public/img/mobile.png')}}" alt="">
                                    </div>

                                    <div class="col-md-8">

                                        <a class="text-justify" href="{{url('/')}}/products/1/itab" target="_blank">
                                            <b>iTab</b>
                                        </a>
                                        <br>

                                        <small><b>Sold By:</b> mandeclan</small>
                                        <br>
                                        <small><b>Price:</b>
                                            <i class="fas fa-dollar-sign"></i>

                                            104.96

                                        </small>
                                        <br>
                                        <small><b>Tax:</b> <i class="fas fa-dollar-sign"></i>23.04</small>

                                    </div>
                                </div>
                            </td>

                            <td>
                                2
                            </td>

                            <td>    
                                <div id="singleorderstatus2">
                                    <span class="badge badge-pill badge-default">Pending</span>

                                </div>

                                <br>

            {!!Form::select('store_country',['Change order status','Pending','Processed','Ready To Pickup','Dispatch'],null,array('class'=>'form-control select2 selector','placeholder'=>'Select Country','data-toggle'=>'select2','required')) !!}

                            </td>

                            <td>
                                <b>Total Price:</b> <i class="fas fa-dollar-sign"></i>

                                209.92

                                <p></p>
                                <b>Total Tax:</b> <i class="fas fa-dollar-sign"></i>23.04
                                <p></p>
                                <b>Shipping Charges:</b> <i class="fas fa-dollar-sign"></i>12
                                <p></p>


                                <small class="help-block">(Price &amp; TAX Multiplied with Quantity)</small>
                                <p></p>
                            </td>

                            <td>
                                <i class="fas fa-dollar-sign"></i>

                                268

                                <br>
                                <small>
                                    (Incl. of TAX &amp; Shipping)
                                </small>
                            </td>

                            <td>
                                <!-- ------------------------------ -->
                                <div class="dropdown">
                                    <button class="btn btn-round btn-outline-primary" type="button" id="CustomdropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>
                                    <div class="dropdown-menu" aria-labelledby="CustomdropdownMenuButton1">

                                        <li role="presentation">
                                            <a class="dropdown-item" href="{{url('/')}}/update/order/2">
                                                <i class="fa fa-truck"></i> Ship
                                            </a>
                                        </li>




                                        <div class="divider"></div>
                                        <li role="presentation">

                                            <a role="button" class="dropdown-item" id="canbtn2" data-toggle="modal" data-target="#singleordercancel2" title="Cancel this order?">
                                                <i class="fa fa-ban"></i> Cancel
                                            </a>

                                        </li>



                                    </div>
                                </div>
                                <!-- ------------------------------ -->

                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <div class="col-md-12 ml-2">
        <h4>
            Order Activity Logs
        </h4>


        <small><b>#EODD6175302cad557</b><br></small>

        <span id="logs">
            <small>22-09-2021 | 09:24:am • For Order
                <b>Yoga Matt (Yellow) </b>
                :                       <span class="text-danger"><b>Admin</b> (Admin)</span> changed status to
                <b>Processed</b>

            </small>


            <p></p>
        </span>
    </div>

    <!-- main content end -->
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