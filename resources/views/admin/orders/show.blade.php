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
<a href="{{url('admin/orders')}}" class="form-inline float-right mt--1 d-none d-md-flex">
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
            <p><b>Invoice No :</b> <span class="orderno">{{$order->order_u_id}}</span></p>
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
          <th>Invoice No</th>
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
          <td colspan="5"><span class="pull-right">Tax ({{ $order->total_tax }}%)</span></td>
          <td>{{'$ '.$order->tax_price}}</td>
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


     
            {{-- <div class="row">
                   <div class="col-md-4">

        {!!Form::select('suborder_id',['Pending'=>'Pending','Approval'=>'Approval','Cancel'=>'Cancel','Ready To Pickup'=>'Ready To Pickup','Dispatch'=>'Dispatch'],$order->order_status,array('class'=>'form-control select2 selector','data-toggle'=>'select2','id'=>$order->id)) !!}
      </div>
      <div class="col-md-4">
          <strong class="btn btn-sm btn-info"  data-toggle="modal" data-target="#exampleModal" >View Supplier</strong>
      </div>
            </div>  --}}
   </div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <input type="hidden" name="modal_supplier_id" id="modal_supplier_id" value="">
            <table class="table table-hover" id="availablesuppliertable">
              <thead>
                <tr>
                  <th>Unique Id</th>
                  <th>Name</th>
                  <th>Mobile</th>
                  <th>Area</th>
                  <th>Assign</th>
                </tr>
              </thead>
              <tbody>
                
               </tbody>
            </table> 
            <div class="processingsuborder">
              <div class="row" >
                  <div class="col-md-5">
                     {{-- {{ Form::select('city_id',$cities, null,['class' => 'form-control','id'=>'modelcityid']) }}
                     <span class="msgchoosecity"></span> --}}

                 {!!Form::select('city',$cities,$order->order_status,array('class'=>'form-control select2 city_selector','data-toggle'=>'select2','id'=>$order->id)) !!}



                  </div>
                   <div class="col-md-5">
 {!!Form::select('locality',[],null,array('class'=>'form-control locality_selector select2','placeholder'=>'Select Country','data-toggle'=>'select2','required')) !!}
                   </div>
                    <div class="col-md-2">
                     <strong class="btn btn-primary findmoresuppliermodel" >Search</strong >
                   </div>
              </div> 
              <div class="moresupplier">
              </div> 
            </div>   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
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


 <script type="text/javascript">

    
    $(document).ready(function() {




        $('.selector').on('change', function() {
            var value = $(this).val();
            var id = $(this).attr('id');
            console.log(value);

            var data;
           if(value) {  
              $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});
                 $.ajax({
          url: "{{url('admin/change_order_status')}}",
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
                  
                },

                error:function(error) {
                        console.log(error);
                  
                }

                });
                    }
          

        });

        // .......................error

         $('.city_selector').on('change', function() {
            var stateID = $(this).val();
            console.log(stateID);

            var data;
           if(stateID) {  
              $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});
                 $.ajax({
          url: "{{url('admin/append_locality')}}",
          type: "post",
          data: {id:stateID},
                    dataType: "json",
                    success:function(data) {
                        console.log(data);
            
                $('select[name="store_locality"]').empty();

                  $('select[name="store_locality"]').append('<option value="'+''+'">'+'None'+'</option>');
                   $.each(data, function(key, value) { 
                  $('select[name="store_locality"]').append('<option value="'+ key +'">'+value+'</option>');
                 });
                }

                });
                    }
            else{
                          $('select[name="store_locality"]').empty();
            }

        });
      });
    </script>
@endpush