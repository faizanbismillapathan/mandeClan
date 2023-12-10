@extends('servicepartner.layouts.app')
@section('title',"All Pending Orders | Service Partner Mande Clan")

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

            <h1 class="h3 mb-3">Today Assign Orders &nbsp;&nbsp;</h1>
        </div>



        <div class="contentbar">

            <div class="row no-gutter">

                <div class="col-md-12">

@if(!empty($records))

@foreach($records as $index=>$data)

                    <div id="orderbox2" class="orderbox">
                        <div class="card mb-3">

                            <div class="card-body servicepartner-order">
                                <div class="row">
                                    <div class="col-md-4">
                                       <h5><b>Invoice Id :</b> {{$data->suborder_u_id}}
                                       </h5>
                                   </div>
                                        <div class="col-md-4">

                                        <h5><b>Order Date :</b>{{date("d-M-y", strtotime($data->order_date))}} {{date("g:i A", strtotime($data->order_date))}}</h5>
                                    </div>

                                    <div class="col-md-4">

                                        <h5><b>Delivery Date :</b>{{date("d-M-y", strtotime($data->delivery_date))}} {{date("g:i A", strtotime($data->delivery_date))}}</h5>
                                    </div>

                                       <div class="col-md-4">

                                        <h5><b>Ready to Pickup Date :</b>{{date("d-M-y", strtotime($data->ready_to_pickup_status_date))}} {{date("g:i A", strtotime($data->ready_to_pickup_status_date))}}</h5>
                                    </div>

@if(!empty($dispatch_status))
                                     <div class="col-md-4">

                                        <h5><b>Dispatch Date :</b>{{date("d-M-y", strtotime($data->dispatch_status->status_date))}} {{date("g:i A", strtotime($data->dispatch_status->status_date))}}</h5>
                                    </div>

                                    @endif


  <div class="col-md-12">

@if(empty($data->rider_accept_order_status) || $data->rider_accept_order_status=='Pending')
        <a   class=" btn btn-md btn-danger ml-2 mb-2 selector" suborder_id="{{$data->id}}" status="Rejected">
            <i class="fas fa-window-close"></i> Reject 
        </a>

        <button suborder_id="{{$data->id}}" status="Accepted" type="button"  class="ml-2 btn btn-md btn-primary mb-2 selector">
            <i class="fas fa-check-square"></i> Accept 
        </button> 
@else
@if($data->rider_accept_order_status=='Accepted')
<span class="badge badge-success">{{$data->rider_accept_order_status}}</span>
@else
<span class="badge badge-danger">{{$data->rider_accept_order_status}}</span>

@endif

@if($data->rider_status_updated_by)({{$data->rider_status_updated_by}}) @endif At {{date('d-M-Y',strtotime($data->rider_status_update_date))}}
@endif
                                   
          

    </div>
</div>
<div class="row" style="margin-top: 20px;">
    <div class="col-md-6">
@if($data->rider_accept_order_status=='Accepted')
        <p><b>Order from</b>: {{$data->store_name}}</p>
        <p><i class="fas fa-envelope-square" aria-hidden="true"></i> {{$data->store_email}}</p>
        <p><i class="fa fa-phone" aria-hidden="true"></i> {{$data->store_mobile}} </p>
        <p>
            <i class="fa fa-map-marker" aria-hidden="true"></i>  {{$data->store_locality}}, {{$data->store_city}}, {{$data->store_state}}, {{$data->store_country}}
        </p>

        <a  title="This action is disabled in demo !" class="  btn btn-md btn-primary ml-2 mb-2">
            <i class="fas fa-map-marker-alt"></i> Navigation 
        </a>
@endif
    </div>
  
@if(!empty($data->dispatch_status))
                   <div class="col-md-6">
           <p style="color:red"><b>Payment Status :</b> <span class="badge badge-success">{{$data->paid_unpaid_status}}</span></p>
          <p><b>Delivery Address</b></p>
            @if($data->pickup_type=='Self Pickup')
          <p>{{$users->name}}<br>
            <span class="badge badge-light">
            {{$data->pickup_type}}   
            </span>         
             </p>
            
          <p><b>Mobile No. :</b>{{$users->mobile}}</p>
          <p><b>Email Id :</b> {{$users->email}}</p>
         
          @else

          <p>{{$data->addressBook->customer_name}}<br>
             @if(!empty($data->addressBook->localitys)){{$data->addressBook->localitys->locality_name}} @endif @if(!empty($data->addressBook->citys)), {{$data->addressBook->citys->city_name}} @endif  @if(!empty($data->addressBook->states)), {{$data->addressBook->states->state_name}} @endif @if(!empty($data->addressBook->countrys)) ,{{$data->addressBook->countrys->country_name}} @endif<br>
             {{$data->addressBook->customer_address}}
             </p>
          <p><b>Mobile No. :</b>{{$data->addressBook->customer_mobile}}</p>
          <p><b>Email Id :</b> {{$data->addressBook->customer_email}}</p>
          @endif
        </div>

        @endif


 {{--    <div class="col-md-12">
        <a  title="This action is disabled in demo !" class="  btn btn-md btn-danger ml-2 mb-2">
            <i class="fas fa-window-close"></i> Cancel 
        </a>

        <button type="button"  title="This action cannot be done in demo !" class=" ml-2 btn btn-md btn-primary mb-2">
            <i class="fas fa-check-square"></i> Deliverd
        </button> 
          <button type="button"  title="This action cannot be done in demo !" class=" ml-2 btn btn-md btn-info mb-2">
            <i class="fas fa-check-square"></i> Re-Schedule 
        </button> 

    </div> --}}
</div>

</div>
</div>
</div>

@endforeach
@endif


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


 <script type="text/javascript">

    
    $(document).ready(function() {

        $('.selector').on('click', function() {
            var suborder_id = $(this).attr('suborder_id');
            var status = $(this).attr('status');


            console.log(status);

            var data;
           if(status) {  
              $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});
                 $.ajax({
          url: "{{url('service-partner/change_suborders_status')}}",
          type: "post",
          data: {status:status,suborder_id:suborder_id},
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