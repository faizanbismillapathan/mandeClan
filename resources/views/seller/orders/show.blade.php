@extends('seller.layouts.app')
@section('title',"Edit SubOrders Process | Seller Mande Clan")

<!-- ................custom css................. -->

@section('customStyle')
<style type="text/css">
.text-muted{
background: #f8f9fa;
}

input[type="checkbox"]{
  width: 20px; 
  height: 20px; 
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
<a href="{{url('seller/orders')}}" class="form-inline float-right mt--1 d-none d-md-flex">
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
     
<div class="card">
  <div class="card-header">
    Manage Delivery Status

</div>
<div class="card-body">
            <div class="row">
               


      <div class="col-md-2">
        <label><input type="checkbox" name="suborder_id" value="Pending" class="selector Pending_cls" id="{{$order->id}}" {{$pending !=null ? 'checked disabled' : ''}} >  Pending</label>
        @if(!empty($order->order_date))
        <p>{{date("d-M-y", strtotime($order->order_date))}} {{date("g:i A", strtotime($order->order_date))}}</p>
        @endif
      </div>
       <div class="col-md-2">
        <label><input type="checkbox" name="suborder_id" value="Approval" class="selector Approval_cls" id="{{$order->id}}" {{$approval !=null ? 'checked disabled' : ''}}>  Approval</label>
        @if(!empty($approval_status_date))
        <p>{{date("d-M-y", strtotime($approval_status_date))}} {{date("g:i A", strtotime($approval_status_date))}}</p>
        @endif
      </div>
      {{--  <div class="col-md-2">
        <label><input type="checkbox" name="suborder_id" value="Cancel" class="selector Cancel_cls" id="{{$order->id}}" {{$cancel !=null ? 'checked disabled' : ''}}>  Cancel</label>
        @if(!empty($cancel_status_date))
        <p>{{date("d-M-y", strtotime($cancel_status_date))}} {{date("g:i A", strtotime($cancel_status_date))}}</p>
        @endif
      </div> --}}
       <div class="col-md-2">
        <label><input type="checkbox" name="suborder_id" value="Ready To Pickup"  class=" selector Pickup_cls" id="{{$order->id}}" {{$ready_to_pickup !=null ? 'checked disabled' : ''}}> Ready To Pickup</label>
        @if(!empty($ready_to_pickup_status_date))
        <p>{{date("d-M-y", strtotime($ready_to_pickup_status_date))}} {{date("g:i A", strtotime($ready_to_pickup_status_date))}}</p>
        @endif
      </div>
       <div class="col-md-2">
        <label><input type="checkbox" name="suborder_id" value="Dispatch" class="selector Dispatch_cls" id="{{$order->id}}" {{$dispatch !=null ? 'checked disabled' : ''}}>  Dispatch</label>
        @if(!empty($dispatch_status_date))
        <p>{{date("d-M-y", strtotime($dispatch_status_date))}} {{date("g:i A", strtotime($dispatch_status_date))}}</p>
        @endif
      </div>

      <div class="col-md-2">
        <label><input type="checkbox" name="suborder_id" value="Delivered" class=" Delivered_cls" id="{{$order->id}}" {{$delivered !=null ? 'checked disabled' : ''}} disabled>  Delivered</label>
        @if(!empty($delivered_status_date))
        <p>{{date("d-M-y", strtotime($delivered_status_date))}} {{date("g:i A", strtotime($delivered_status_date))}}</p>
        @endif
      </div>


     {{--  <div class="col-md-4">
          <strong class="btn btn-sm btn-info"  data-toggle="modal" data-target="#exampleModal" >View Supplier</strong>
      </div> --}}
            </div> 
          </div>
        </div>
   </div>



<div class="modal fade" id="exampleModalDemo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Assign Order To delivery Rider</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

            <div class="processingsuborder">

              <div class="row" >
                  <div class="col-md-5">
                      {!!Form::select('city',$cities,null,array('class'=>'form-control select2 city_selector','data-toggle'=>'select2','id'=>$order->id)) !!}
                     <span class="msgchoosecity"></span>
                  </div>
                   <div class="col-md-5">
 {!!Form::select('locality',[],null,array('class'=>'form-control locality_selector select2','placeholder'=>'Select locality','data-toggle'=>'select2','required')) !!}
                   </div>
                    <div class="col-md-2">
                     <button type="submit" class="btn btn-primary findmoresuppliermodel" >Search</button >
                   </div>
              </div> 
           
              <div class="moresupplier">


              </div> 
            </div> 

            <br>
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
             
                
          
             <tbody id="append_new_rider">

@if(!empty($match_riders))
@foreach($match_riders as $index=>$data)
             {!!Form::open(['url'=>['seller/suborder_assign_rider'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}

            <tr class="deleteRow append_new_rider">
            <td>{{$data->rider_userid}}</td>
            <td>{{$data->rv_user_name}}</td>
            <td>{{$data->rv_user_mobile}}</td>
            <td>{{$data->locality_name}}</td>
<input type="hidden" name="rider_regis_id" class="rider_regis_id_{{$data->rider_userid}}" value="{{$data->id}}">
<input type="hidden" name="suborder_id" class="suborder_id_{{$data->rider_userid}}" value="{{$order->id}}">
<input type="hidden" name="rider_userid" class="rider_userid_{{$data->rider_userid}}" value="{{$data->rider_userid}}">

<td><button type="submit" class="btn btn-primary assign_submit" data={{$data->rider_userid}}>Assign</button ></td>
            </tr>

            
            {{Form::close()}}

          
  @endforeach
  @endif
</tbody>
</table>




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
          url: "{{url('seller/change_order_status')}}",
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
          url: "{{url('append_locality')}}",
          type: "post",
          data: {id:stateID},
                    dataType: "json",
                    success:function(data) {
                        console.log(data);
            
                $('select[name="locality"]').empty();

                  $('select[name="locality"]').append('<option value="'+''+'">'+'None'+'</option>');
                   $.each(data, function(key, value) { 
                  $('select[name="locality"]').append('<option value="'+ key +'">'+value+'</option>');
                 });
                }

                });
                    }
            else{
                          $('select[name="locality"]').empty();
            }

        });


         $('.findmoresuppliermodel').on('click',function(){
   var city_id = $('.city_selector').val();
   var locality_id = $('.locality_selector').val();
  

   var suborder_id = "{{$order->id}}";



       $.ajax({
          type:"GET",
          url:"{{url('seller/find_riders')}}?city_id="+city_id+"&locality_id="+locality_id,
          beforeSend: function(){
            $("#loader").show();
         },
          success:function(data){
            console.log(data);
           
                  $('.append_new_rider').html('');

            $.each(JSON.parse(data), function(index, element) {
             $('.append_new_rider').append("<td>" + element.rider_userid + "</td><td>" + element.rv_user_name + "</td><td>" + element.rv_user_mobile + "</td><td>" + element.locality_name + "</td><td> <input type='hidden' name='rider_regis_id' value='"+element.id+"'><input type='hidden' name='suborder_id' value='"+suborder_id+"'><input type='hidden' name='rider_userid' value='"+element.rider_userid+"'><button type='submit' class='btn btn-primary' >Assign</button ></td></form>");
            });
          },


             


          complete:function(data){
              $("#loader").hide();
         }
      });
   
}); 


      });

    // ..............trim


function checkboxStatus() {

    
 if($('.Dispatch_cls').is(':checked')){
             $(this).prop("disabled",true);
             
            }


      else if($('.Pickup_cls').is(':checked')){
             $(".Dispatch_cls").prop("disabled",false);
             
            }
            

            // else if($('.Cancel_cls').is(':checked')){
            //  $(".Pickup_cls").prop("disabled",false);
            //   $(".Dispatch_cls").prop("disabled",true);
               
               
            // }
            
            else if($('.Approval_cls').is(':checked')){
             // $(".Cancel_cls").prop("disabled",false);
              $(".Pickup_cls").prop("disabled",false);
               $(".Dispatch_cls").prop("disabled",true);
             
               
            }
            
            else if($('.Pending_cls').is(':checked')){
             $(".Approval_cls").prop("disabled",false);
              // $(".Cancel_cls").prop("disabled",true);
               $(".Pickup_cls").prop("disabled",true);
                $(".Dispatch_cls").prop("disabled",true);
               
            }
            
            

}

checkboxStatus();



    // $("input:checkbox").click(function(){
    //     var checkboxgroup = "input:checkbox[name='"+$(this).attr("data")+"']";

    //     console.log(checkboxgroup)
    //     $(checkboxgroup).prop("checked",false);
    //     $(this).prop("checked",true);
    // });
    </script>
@endpush