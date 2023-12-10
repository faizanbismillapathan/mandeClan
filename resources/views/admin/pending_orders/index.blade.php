@extends('admin.layouts.app')
@section('title',"All Pending Orders | Admin Mande Clan")

<!-- ................custom css................. -->

@section('customStyle')
<style type="text/css">
    .btn:not(:disabled):not(.disabled){
        color: #fff;
    }
</style>
@endsection

<!-- ................Add css link................. -->

@push('style')
@endpush

<!-- ................body................. -->
@section('innercontent')

<main class="content">
    <div class="container-fluid p-0">

        <div class="clearfix">

            <h1 class="h3 mb-3">Pending Orders &nbsp;&nbsp;@if(!empty($records))({{$records->total()}})@endif</h1>
        </div>



        <div class="contentbar">

            <div class="row no-gutter">

                <div class="col-md-12">

                    <div onclick="orderget('2')" id="orderbox2" class="orderbox">
                        <div class="card mb-3">

                            <div class="card-body servicepartner-order">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h4>#EODD6175302cad557</h4>
                                        <p>22-Nov-2021 | 06:55 AM</p>
                                    </div>
                                    <div class="col-md-8">
                                       <div class="row">
                                        <div class="col-md-2">
                                            <img width="50px" src="https://emart.mediacity.co.in/demo/public/variantimages/variant_1590581678GIzW841e8Z.png" alt="" class="m-t-2 img-responsive" title="GEN 5 SMARTWATCH">

                                        </div>
                                        <div class="col-md-4"   >

                                            GEN 5 SMARTWATCH <b>(x 1)</b>

                                        </div>
                                         <div class="col-md-6 h4">
                                            <i class="fas fa-dollar-sign"></i> 34.20
                                            <!-- <br> -->
                                            <small>(Incl. of Tax &amp; Shipping).</small>
                                        </div>
                                        <!-- <div class="col-md-3">

                                            <span class="pull-right h4" href=""><i class="fas fa-dollar-sign"></i>278.004</span>
                                        </div> -->

                                    </div>
                                </div>

</div>
<div class="row" style="margin-top: 20px;">
    <div class="col-md-4">
        <p><b>Order from</b>: seller03</p>
        <p><i class="fas fa-envelope-square" aria-hidden="true"></i> seller03@mediacity.co.in</p>
        <p><i class="fa fa-phone" aria-hidden="true"></i> 9876543210 </p>
        <p>
            <i class="fa fa-map-marker" aria-hidden="true"></i> Bainbridge, Georgia, United States
        </p>
    </div>
    <div class="col-md-8">

        <div class="row">

            <div class="col-md-4">
                <span><b>Subtotal: </b></span>
                <br>
                <i class="fas fa-dollar-sign"></i> 24.20
            </div>



            <div class="col-md-4">
                <b>Handling charges: </b><br>
                + <i class="fas fa-dollar-sign"></i> 10.00
            </div>

            <div class=" col-md-4">
                <b>Total: </b><br>

                <i class="fas fa-dollar-sign"></i> 34.20

            </div>
        </div>

        <div class="row mt-md-2">
            <div class="col-md-4">
                <p><b>Paid by:</b><br>: COD</p>
                <!-- <p>COD</p> -->


            </div>

            <div class="col-md-4">
                <p><b>Payment received</b><br>: Yes</p>
                <!-- <p>Yes</p> -->

            </div>

        </div>
        <!-- -->
    </div>
    <div class="col-md-12">
        <a disabled="" title="This action is disabled in demo !" class="pull-right  btn btn-md btn-danger ml-2 mb-2">
            <i class="fas fa-window-close"></i> Rejected 
        </a>

        <button type="button" disabled="" title="This action cannot be done in demo !" class="pull-right ml-2 btn btn-md btn-primary mb-2">
            <i class="fas fa-check-square"></i> Deliverd
        </button> 
          <button type="button" disabled="" title="This action cannot be done in demo !" class="pull-right ml-2 btn btn-md btn-info mb-2">
            <i class="fas fa-check-square"></i> Postponed 
        </button> 

    </div>
</div>

</div>
</div>
</div>


<!-- Confirm Order before procced modal -->
<div id="confirm2" class="delete-modal modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <div class="delete-icon"></div>
            </div>
            <div class="modal-body text-center">
                <h4 class="modal-heading">Are You Sure ?</h4>
                <p>Do you really want to confirm this order ? it will confirm the whole order.</p>
            </div>
            <div class="modal-footer">
                <form action="{{url('/')}}/service-partner/quick/confirm/fullorder/2" method="POST">
                    <input type="hidden" name="_token" value="sA7ntz1dHvzRSYy4bJwwLwzAlbimzECl2NkN11rY">                                        <input type="hidden" name="status" value="processed">

                    <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-danger">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End -->

<!-- Full order cancel modal-->
<!-- Modal -->
<div data-backdrop="static" data-keyboard="false" class="modal fade" id="cancelFULLOrder2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Cancel Order: #EODD6175302cad557</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

            </div>
            <div class="modal-body">
                <form method="POST" action="{{url('/')}}/order/complete/cancel/eyJpdiI6ImxtbmpCR2htZTVpR2h0c2lCV1ErUmc9PSIsInZhbHVlIjoid3lpaUpQV1IrYWxjVkVMRnhmR3VGQT09IiwibWFjIjoiMTM2NjgxMmVhZDdmYjIyNmQ4YWJlNDI5NTBiMTk0MDBhODE4MDI1ZDNmZDNkZmU2OTFmNGI1Nzk5NTZjODc4NiIsInRhZyI6IiJ9">
                    <input type="hidden" name="_token" value="sA7ntz1dHvzRSYy4bJwwLwzAlbimzECl2NkN11rY">
                    <div class="form-group">
                        <label for="">Choose Reason <span class="required">*</span></label>
                        <select class="form-control select2 select2-hidden-accessible" required="" name="comment" data-select2-id="1" tabindex="-1" aria-hidden="true">
                            <option value="" data-select2-id="3">Please Choose Reason</option>
                            <option value="Requested by User">Requested by User</option>
                            <option value="Order Placed Mistakely">Order Placed Mistakely</option>
                            <option value="Shipping cost is too much">Shipping cost is too much</option>
                            <option value="Wrong Product Ordered">Wrong Product Ordered</option>
                            <option value="Product is not match to my expectations">Product is not match to my expectations</option>
                            <option value="Other">My Reason is not listed here</option>
                        </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="2" style="width: auto;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2--container"><span class="select2-selection__rendered" id="select2--container" role="textbox" aria-readonly="true" title="Please Choose Reason">Please Choose Reason</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                    </div>


                    <div class="form-group">

                        <label for="">Choose Refund Method:</label>
                        <label><input required="" class="source_check" type="radio" value="orignal" name="source">Orignal Source [Paytm] </label>&nbsp;&nbsp;
                        <label><input required="" class="source_check" type="radio" value="bank" name="source"> In Bank</label>

                        <select name="bank_id" id="bank_id" class="display-none form-control">
                            <option value="2">DEMO BANK (7894561230)</option>
                        </select>

                    </div>




                    <div class="alert alert-info">
                        <h5><i class="fa fa-info-circle"></i> Important !</h5>

                        <ol class="ol">
                            <li>IF Original source is choosen than amount will be reflected to your orignal source in 1-2 days(approx).
                            </li>

                            <li>
                                IF Bank Method is choosen than make sure you added a bank account else refund will not procced. IF already added than it will take 14 days to reflect amount in your bank account (Working Days*).
                            </li>

                            <li>Amount will be paid in original currency which used at time of placed order.</li>

                        </ol>
                    </div>

                    <button type="submit" class="btn btn-md btn-primary">
                        Procced...
                    </button>
                </form>
                <p class="help-block">This action cannot be undone !</p>
                <p class="help-block">It will take time please do not close or refresh window !</p>
            </div>

        </div>
    </div>
</div>
<!--END-->


<div onclick="orderget('1')" id="orderbox1" class="orderbox">
    <div class="card mb-3">

        <div class="card-body servicepartner-order">
             <div class="row">
                                    <div class="col-md-4">
                                        <h4>#EODD6175302cad557</h4>
                                        <p>22-Nov-2021 | 06:55 AM</p>
                                    </div>
                                    <div class="col-md-8">
                                       <div class="row">
                                        <div class="col-md-2">
                                            <img width="50px" src="https://emart.mediacity.co.in/demo/public/images/simple_products/thum_dgp_60c34d8be914b.png" alt="" class="m-t-2 img-responsive" title="GEN 5 SMARTWATCH">

                                        </div>
                                        <div class="col-md-4"   >

                                            GEN 5 SMARTWATCH <b>(x 1)</b>

                                        </div>
                                        <div class="col-md-6 h4">
                                            <i class="fas fa-dollar-sign"></i> 34.20
                                            <!-- <br> -->
                                            <small>(Incl. of Tax &amp; Shipping).</small>
                                        </div>
                                        <!-- <div class="col-md-3">

                                            <span class="pull-right h4" href=""><i class="fas fa-dollar-sign"></i>278.004</span>
                                        </div> -->

                                    </div>
                                </div>

</div>
<div class="row" style="margin-top: 20px;">
    <div class="col-md-4">
        <p><b>Order from</b>: seller03</p>
        <p><i class="fas fa-envelope-square" aria-hidden="true"></i> seller03@mediacity.co.in</p>
        <p><i class="fa fa-phone" aria-hidden="true"></i> 9876543210 </p>
        <p>
            <i class="fa fa-map-marker" aria-hidden="true"></i> Bainbridge, Georgia, United States
        </p>
    </div>
    <div class="col-md-8">

        <div class="row">

            <div class="col-md-4">
                <span><b>Subtotal: </b></span>
                <br>
                <i class="fas fa-dollar-sign"></i> 24.20
            </div>



            <div class="col-md-4">
                <b>Handling charges: </b><br>
                + <i class="fas fa-dollar-sign"></i> 10.00
            </div>

            <div class=" col-md-4">
                <b>Total: </b><br>

                <i class="fas fa-dollar-sign"></i> 34.20

            </div>
        </div>

        <div class="row mt-md-2">
            <div class="col-md-4">
                <p><b>Paid by:</b><br>: COD</p>
                <!-- <p>COD</p> -->


            </div>

            <div class="col-md-4">
                <p><b>Payment received</b><br>: Yes</p>
                <!-- <p>Yes</p> -->

            </div>

        </div>
        <!-- -->
    </div>
    <div class="col-md-12">
        <a disabled="" title="This action is disabled in demo !" class="pull-right  btn btn-md btn-danger ml-2 mb-2">
            <i class="fas fa-window-close"></i> Rejected
        </a>

        <button type="button" disabled="" title="This action cannot be done in demo !" class="pull-right ml-2 btn btn-md btn-primary mb-2">
            <i class="fas fa-check-square"></i> Deliverd
        </button> 

        <button type="button" disabled="" title="This action cannot be done in demo !" class="pull-right ml-2 btn btn-md btn-info mb-2">
            <i class="fas fa-check-square"></i> Postponed 
        </button> 

    </div>
</div>


        </div>
    </div>
</div>


<!-- Confirm Order before procced modal -->
<div id="confirm1" class="delete-modal modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <div class="delete-icon"></div>
            </div>
            <div class="modal-body text-center">
                <h4 class="modal-heading">Are You Sure ?</h4>
                <p>Do you really want to confirm this order ? it will confirm the whole order.</p>
            </div>
            <div class="modal-footer">
                <form action="{{url('/')}}/service-partner/quick/confirm/fullorder/1" method="POST">
                    <input type="hidden" name="_token" value="sA7ntz1dHvzRSYy4bJwwLwzAlbimzECl2NkN11rY">                                        <input type="hidden" name="status" value="processed">

                    <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-danger">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End -->

<!-- Full order cancel modal-->
<!-- Modal -->
<div data-backdrop="static" data-keyboard="false" class="modal fade" id="cancelFULLOrder1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Cancel Order: #EODD617529fb3c5b3</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

            </div>
            <div class="modal-body">
                <form method="POST" action="{{url('/')}}/order/complete/cancel/eyJpdiI6InRpOGc5VVI0RzF6dXZHQWlQckF3VWc9PSIsInZhbHVlIjoiREtrNzI5bVdSb0lXT2NjK3dCSU96UT09IiwibWFjIjoiOWViODllNTUwNGNjN2VhYWRmMzNlZjZmM2Y4OTg2YjRkNGZhNjg1NTcwNmUyMjA2NmJhNGUxY2I3NjM3MjU5YyIsInRhZyI6IiJ9">
                    <input type="hidden" name="_token" value="sA7ntz1dHvzRSYy4bJwwLwzAlbimzECl2NkN11rY">
                    <div class="form-group">
                        <label for="">Choose Reason <span class="required">*</span></label>
                        <select class="form-control select2 select2-hidden-accessible" required="" name="comment" id="" data-select2-id="4" tabindex="-1" aria-hidden="true">
                            <option value="" data-select2-id="6">Please Choose Reason</option>
                            <option value="Requested by User">Requested by User</option>
                            <option value="Order Placed Mistakely">Order Placed Mistakely</option>
                            <option value="Shipping cost is too much">Shipping cost is too much</option>
                            <option value="Wrong Product Ordered">Wrong Product Ordered</option>
                            <option value="Product is not match to my expectations">Product is not match to my expectations</option>
                            <option value="Other">My Reason is not listed here</option>
                        </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="5" style="width: auto;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2--container"><span class="select2-selection__rendered" id="select2--container" role="textbox" aria-readonly="true" title="Please Choose Reason">Please Choose Reason</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                    </div>


                    <div class="form-group">

                        <label for="">Choose Refund Method:</label>
                        <label><input required="" class="source_check" type="radio" value="orignal" name="source">Orignal Source [Paypal] </label>&nbsp;&nbsp;
                        <label><input required="" class="source_check" type="radio" value="bank" name="source"> In Bank</label>

                        <select name="bank_id" id="bank_id" class="display-none form-control">
                            <option value="2">DEMO BANK (7894561230)</option>
                        </select>

                    </div>




                    <div class="alert alert-info">
                        <h5><i class="fa fa-info-circle"></i> Important !</h5>

                        <ol class="ol">
                            <li>IF Original source is choosen than amount will be reflected to your orignal source in 1-2 days(approx).
                            </li>

                            <li>
                                IF Bank Method is choosen than make sure you added a bank account else refund will not procced. IF already added than it will take 14 days to reflect amount in your bank account (Working Days*).
                            </li>

                            <li>Amount will be paid in original currency which used at time of placed order.</li>

                        </ol>
                    </div>

                    <button type="submit" class="btn btn-md btn-primary">
                        Procced...
                    </button>
                </form>
                <p class="help-block">This action cannot be undone !</p>
                <p class="help-block">It will take time please do not close or refresh window !</p>
            </div>

        </div>
    </div>
</div>
<!--END-->

</div>



<div class="quickorderview col-md-4">

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