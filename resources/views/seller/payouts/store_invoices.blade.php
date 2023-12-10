@extends('seller.layouts.app')
@section('title',"All Payouts | seller  Mande Clan")

<!-- ................custom css................. -->

@section('customStyle')
@endsection

<!-- ................Add css link................. -->

@push('style')

@endpush

<!-- ................body................. -->
@section('innercontent')

  <main>
     <div class="container-fluid">
        <div class="card mt-5">
            <div class="card-header">
                <div class="d-flex justify-content-between m-3">
                    <div class="float-left">
                        <h3 class="text-secondary">Commission Items Vise</h3>
                    </div>
                    <!--<div class="float-right">-->
                    <!--    <div class="btn-group btn-group-toggle mx-5" data-toggle="buttons">-->
                    <!--        <label class="btn btn-outline-success">-->
                    <!--            <input type="radio" name="options" id="option1" autocomplete="off" checked />-->
                    <!--            Enable-->
                    <!--        </label>-->
                    <!--        <label class="btn btn-outline-danger">-->
                    <!--            <input type="radio" name="options" id="option2" autocomplete="off" />-->
                    <!--            Disable-->
                    <!--        </label>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <div class="float-right">
                    <div class="btn-group btn-group-toggle" style="mix-blend-mode: luminosity;" >
                    <a href="{{url('seller/store-payout')}}" class="btn btn-outline-primary">
                     Go Back 
                    </a>
                    </div>
            </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row mx-1">
                    <div class="col-md-3 d-flex">
                        <b>Store Name</b><b class="mx-2">:</b>
                        <p>BJ fashion</p>
                    </div>
                    <div class="col-md-3 d-flex">
                        <b>Store Category</b><b class="mx-2">:</b>
                        <p>Menswere</p>
                    </div>
                    <div class="col-md-3 d-flex">
                        <b>Store Contact No</b><b class="mx-2">:</b>
                        <p>8554843915</p>
                    </div>
                    <div class="col-md-3 d-flex">
                        <b>Category</b><b class="mx-2">:</b>
                        <p>Fashion</p>
                    </div>
                    <div class="col-md-3 d-flex">
                        <b>Location</b><b class="mx-2">:</b>
                        <p>Nagpur,Bardi</p>
                    </div>
                    <div class="col-md-3 d-flex">
                        <b>Store Id</b><b class="mx-2">:</b>
                        <p>Str02050105</p>
                    </div>
                </div>

                <div class="table-responsive p-4">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="d-flex col-md-4 pb-3 align-items-baseline">
                                <label for="">Date: </label>
                                <p class="form-control mx-3">02/05/2002</p>
                                to
                                <p class="form-control mx-3">02/05/2002</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="float-right">
                                <a href="{{ url('/seller/store-item-wise-payout') }}">
                                    <button class="btn btn-success" type="submit">
                                        View All
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>

                    <table class="table table-bordered table-striped table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>Date</th>
                                <th>Order no.</th>
                                <th>Total Item</th>
                                <th>Weight</th>
                                <th>Price</th>
                                <th>Delevery</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="">
                            <tr>
                                <td>21-07-2022</td>
                                <th scope="row">INV12322c822715l1333</th>
                                <td>05</td>
                                <td>25.00 kg</td>
                                <td>256.00 $</td>
                                <td>Cancled</td>
                                <td>Paid</td>
                                <td>
                                    <i class="fa fa-download mx-1 text-secondary" aria-hidden="true"></i>
                                    <i class="fa fa-eye mx-1 text-info" aria-hidden="true" data-toggle="modal"
                                        data-target=".bd-example-modal-lg"></i>
                                    <i class="fa fa-file-excel mx-1 text-success" aria-hidden="true"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>21-07-2022</td>
                                <th scope="row">INV12322c822715l1333</th>
                                <td>05</td>
                                <td>25.00 kg</td>
                                <td>256.00 $</td>
                                <td>Cancled</td>
                                <td>Paid</td>
                                <td>
                                    <i class="fa fa-download mx-1 text-secondary" aria-hidden="true"></i>
                                    <i class="fa fa-eye mx-1 text-info" aria-hidden="true" data-toggle="modal"
                                        data-target=".bd-example-modal-lg"></i>
                                    <i class="fa fa-file-excel mx-1 text-success" aria-hidden="true"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>21-07-2022</td>
                                <th scope="row">INV12322c822715l1333</th>
                                <td>05</td>
                                <td>25.00 kg</td>
                                <td>256.00 $</td>
                                <td>Cancled</td>
                                <td>Paid</td>
                                <td>
                                    <i class="fa fa-download mx-1 text-secondary" aria-hidden="true"></i>
                                    <i class="fa fa-eye mx-1 text-info" aria-hidden="true" data-toggle="modal"
                                        data-target=".bd-example-modal-lg"></i>
                                    <i class="fa fa-file-excel mx-1 text-success" aria-hidden="true"></i>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>




    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Products Details</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="content">
                    <div class="row">
                        <div class="col-md-6">
                            <p style="color:red"><b>
                                    Order no. :</b> INV12322c822715l1333 </p>
                            <p>
                                <b>Location</b>
                            </p>
                            <p>
                                N.M.C. Complex(J.B), 1, Mangalwari, Koradi Colony, Nagpur, Maharashtra 440001, India
                            </p>
                            <p><b>Mobile No. :</b>+919673259597</p>
                            <p><b>Email Id :</b> zareena@gmail.com</p>
                        </div>
                        <div class="col-md-6">
                            <div class="">
                                <p><b>Invoice No :</b> <span class="orderno">INV002275111</span></p>
                                <p><b>Total Amount </b><span class="total-rupees">$ 94</span></p>
                                <p><b>Order Date :</b> 06-Jul-22</p>
                                <p><b>Delivery Date :</b> 01-Jan-70</p>
                                <p><b>Delivery Slot Time :</b>10:00 A.M to 02:00 P.M</p>
                            </div>
                        </div>
                    </div>
                    <!--  -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="thead-light">
                                <tr style="white-space: nowrap;">
                                    <th>Date</th>
                                    <th>Invoice No.</th>
                                    <th>Item SKU</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Product Name</th>
                                    <th>Attributes</th>
                                    <th>Item Weight</th>
                                    <th>Item Price</th>
                                    <th>Qnty.</th>
                                    <th>Total Weight</th>
                                    <th>Gst Tax</th>
                                    <th>Total Tax</th>
                                    <th>Total Price</th>
                                    <th>Commission</th>
                                    <th>Delevery</th>
                                    <th>Status</th>
                                    <!-- <th>Action</th> -->
                                </tr>
                            </thead>
                            <tbody class="" style="white-space: nowrap;">
                                <tr>
                                    <td>21-07-2022</td>
                                    <td scope="row">INV12322c822715l1333</td>
                                    <td></td>
                                    <td>Mens</td>
                                    <td>Mens Were</td>
                                    <td>T-shirt</td>
                                    <td>Small</td>
                                    <td>10g</td>
                                    <td>100.00 $</td>
                                    <td>3</td>
                                    <td>100g</td>
                                    <td>2%</td>
                                    <td>18%</td>
                                    <td>250 $</td>
                                    <td>20.00 $</td>
                                    <td>Cancled</td>
                                    <td>Paid</td>

                                </tr>
                                <tr>
                                    <td>21-07-2022</td>
                                    <td scope="row">INV12322c822715l1333</td>
                                    <td></td>
                                    <td>Mens</td>
                                    <td>Mens Were</td>
                                    <td>T-shirt</td>
                                    <td>Small</td>
                                    <td>10g</td>
                                    <td>100.00 $</td>
                                    <td>3</td>
                                    <td>100g</td>
                                    <td>2%</td>
                                    <td>18%</td>
                                    <td>250 $</td>
                                    <td>20.00 $</td>
                                    <td>Cancled</td>
                                    <td>Paid</td>

                                </tr>

                                <tr>
                                    <td>21-07-2022</td>
                                    <td scope="row">INV12322c822715l1333</td>
                                    <td></td>
                                    <td>Mens</td>
                                    <td>Mens Were</td>
                                    <td>T-shirt</td>
                                    <td>Small</td>
                                    <td>10g</td>
                                    <td>100.00 $</td>
                                    <td>3</td>
                                    <td>100g</td>
                                    <td>2%</td>
                                    <td>18%</td>
                                    <td>250 $</td>
                                    <td>20.00 $</td>
                                    <td>Cancled</td>
                                    <td>Paid</td>

                                </tr>
                                <tr>
                                    <td>21-07-2022</td>
                                    <td scope="row">INV12322c822715l1333</td>
                                    <td></td>
                                    <td>Mens</td>
                                    <td>Mens Were</td>
                                    <td>T-shirt</td>
                                    <td>Small</td>
                                    <td>10g</td>
                                    <td>100.00 $</td>
                                    <td>3</td>
                                    <td>100g</td>
                                    <td>2%</td>
                                    <td>18%</td>
                                    <td>250 $</td>
                                    <td>20.00 $</td>
                                    <td>Cancled</td>
                                    <td>Paid</td>

                                </tr>

                                <tr>
                                    <td>21-07-2022</td>
                                    <td scope="row">INV12322c822715l1333</td>
                                    <td></td>
                                    <td>Mens</td>
                                    <td>Mens Were</td>
                                    <td>T-shirt</td>
                                    <td>Small</td>
                                    <td>10g</td>
                                    <td>100.00 $</td>
                                    <td>3</td>
                                    <td>100g</td>
                                    <td>2%</td>
                                    <td>18%</td>
                                    <td>250 $</td>
                                    <td>20.00 $</td>
                                    <td>Cancled</td>
                                    <td>Paid</td>

                                </tr>

                            </tbody>
                        </table>
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