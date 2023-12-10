<style>
    body{
        width: 176vh !important;
    }
</style>
@extends('admin.layouts.app')
@section('title',"Edit SubOrders Process | Admin Mande Clan")

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


.wrapper{
    width: 176vh !important;
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
<a href="{{ URL::previous() }}" class="form-inline float-right mt--1 d-none d-md-flex">
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
    <table class="table table-bordered table-responsive">
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

       @if($order->pickup_type=='Self Pickup')
<div class="col-md-2">
        <label><input type="checkbox" name="suborder_id" value="Ready To Pickup" class="selector Pickup_cls" id="{{$order->id}}" {{$ready_to_pickup !=null ? 'checked disabled' : ''}}>  Ready To Pickup</label>
        @if(!empty($ready_to_pickup_status_date))
        <p>{{date("d-M-y", strtotime($ready_to_pickup_status_date))}} {{date("g:i A", strtotime($ready_to_pickup_status_date))}}</p>
        @endif
      </div>
       @else
       <div class="col-md-2">
        <label><input type="checkbox" name="suborder_id" value="Ready To Pickup" data-toggle="modal" data-target="#exampleModalDemo" class=" Pickup_cls" id="{{$order->id}}" {{$ready_to_pickup !=null ? 'checked disabled' : ''}}> Ready To Pickup</label>
        @if(!empty($ready_to_pickup_status_date))
        <p>{{date("d-M-y", strtotime($ready_to_pickup_status_date))}} {{date("g:i A", strtotime($ready_to_pickup_status_date))}}</p>
       {{--  @foreach($assigns as $data)
        @if(!empty($data))
        <h6>Assign Rider : <br><span class="badge badge-success">{{$data->rv_user_name}}</span> </h6>
        @if($data->rider_accept_order_status=='Accepted')
        <span class="badge badge-info">{{$data->rider_accept_order_status}}</span>
        @elseif($data->rider_accept_order_status)
        <span class="badge badge-danger">{{$data->rider_accept_order_status}}</span>
<button class="btn btn-info" data-toggle="modal" data-target="#exampleModalDemo" >Assign to another Rider</button>
        @endif
        @endif

        @endforeach --}}
        @endif
      </div>
      @endif
       <div class="col-md-2">
        <label><input type="checkbox" name="suborder_id" value="Dispatch" class="selector Dispatch_cls" id="{{$order->id}}" {{$dispatch !=null ? 'checked disabled' : ''}}>  Dispatch</label>
        @if(!empty($dispatch_status_date))
        <p>{{date("d-M-y", strtotime($dispatch_status_date))}} {{date("g:i A", strtotime($dispatch_status_date))}}</p>
        @endif
      </div>

      <div class="col-md-2">
        <label><input type="checkbox" name="suborder_id" value="Delivered" class="selector Delivered_cls" id="{{$order->id}}" {{$delivered !=null ? 'checked disabled' : ''}} >  Delivered</label>
        @if(!empty($delivered_status_date))
        <p>{{date("d-M-y", strtotime($delivered_status_date))}} {{date("g:i A", strtotime($delivered_status_date))}}</p>
        @endif
      </div>

@if(count($assigns) > 0)
@if(empty($assigns_only))
 <button class="btn btn-info" data-toggle="modal" data-target="#exampleModalDemo" style="    margin: 1rem 0 !important;float: right!important;">Assign to Another Rider</button><br><br>
 @endif
                                    <table class="table table-striped table-hover table-sm table-bordered" style=" margin: 1rem 0 !important">
                                        <thead>
                                            <tr>
                                                <th width="10%">Assign Date.</th>
                                                <th width="20%">Rider Name</th>
                                                <th width="20%">Status</th>
                                      @if(empty($assigns_only))       

                                                <th width="15%">Action</th>  
                                                @endif                       
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                            
                                            @if(!empty($assigns))
                                            @foreach($assigns as $index => $data)
                                            <tr class="deleteRow">
                                                <td> {{date('d-M-y',strtotime($data->created_at))}}</td>   
                                                <td>{{$data->rv_user_name}}</td>
                                                 <td>
@if($data->rider_accept_order_status=='Accepted')
                                                  <span class="badge badge-success">{{$data->rider_accept_order_status}}</span>
@else
                                                  <span class="badge badge-danger">{{$data->rider_accept_order_status}}</span>

@endif

@if($data->rider_status_updated_by)({{$data->rider_status_updated_by}}) @endif At {{date('d-M-Y',strtotime($data->rider_status_update_date))}}
                                                </td>

                                        @if(empty($assigns_only))       
                                    <td>
                                       @if($data->rider_accept_order_status ==  'Rejected')
<input type="checkbox" checked data-toggle="toggle" data-on="Accepted Now" data-off="Rejected Now" data-onstyle="success" data-offstyle="danger" id="{{$data->id}}" class="checkstatus" onchange="updateToggle({{$data->id}})">
@elseif($data->rider_accept_order_status ==  'Accepted')
<input type="checkbox" data-toggle="toggle" data-on="Accepted Now" data-off="Rejected Now" data-onstyle="success" data-offstyle="danger" id="{{$data->id}}" class="checkstatus" onchange="updateToggle({{$data->id}})">

@else
<input type="checkbox" checked data-toggle="toggle" data-on="Accepted Now" data-off="Rejected Now" data-onstyle="success" data-offstyle="danger" id="{{$data->id}}" class="checkstatus" onchange="updateToggle({{$data->id}})">

@endif
                                    </td>

                                    @endif
 {{-- <button class="btn btn-info re_assign_cls"  id="{{$data->id}}">Re-Assign</button> --}}

                                                {{-- <button class="btn btn-danger click_disbled"  data-toggle="tooltip" data-placement="top" title="Delete"  data="{{$data->id}}"><i class="fas fa-trash-alt"></i></button> --}}

 {{--  {!!Form::open(['url'=>['admin/suborder_assign_rider'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}

<input type="hidden" name="rider_regis_id" class="rider_regis_id_{{$data->rider_userid}}" value="{{$data->id}}">
<input type="hidden" name="suborder_id" class="suborder_id_{{$data->rider_userid}}" value="{{$order->id}}">
<input type="hidden" name="rider_userid" class="rider_userid_{{$data->rider_userid}}" value="{{$data->rider_userid}}">
 <button class="btn btn-info re_assign_cls"  id="{{$data->id}}">Re-Assign</button>
  {{Form::close()}} --}}

                                               
                                            </tr>
                                            @endforeach
                                            @endif
                                            
                                        </tbody>
                                    </table>

@endif
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
            <table class="table table-hover table-responsive" id="availablesuppliertable">
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
             {!!Form::open(['url'=>['admin/suborder_assign_rider'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}

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


 function updateToggle(userid) {
    // alert(window.location.origin+window.location.pathname+"/status_update")

 var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

// alert(userid)
       $.ajax({
           type:"post",
           url:"{{url('admin/assign_order_status_update')}}",
           data:{_token: CSRF_TOKEN, user_id:userid},
           dataType:'JSON',
           dataType: 'json',
           success:function(res){ 

  var data= "your status is "+res;       

// console.log(res)

location.reload()
                  var message = data;
                  var title = $('#toastr-title').val() || '';
                  if (res=='Deactive') {
                    var type = 'error';
                  }else if(res=='Active'){
                        var type = 'success';
                  }
                  toastr[type](message, title, {
                    positionClass: $('input[name="toastr-position"]:checked').val(),
                    closeButton: 'true',
                    progressBar:'true',
                    newestOnTop: 'true',
                    rtl: $('body').attr('dir') === 'rtl' || $('html').attr('dir') === 'rtl',
                    timeOut: $('#toastr-duration').val()
                  });
               
         }
       });
    };


    
    $(document).ready(function() {


//         $('.re_assign_cls').on('click', function() {

//  var id = $(this).attr('id');
// // alert(id)

//   $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
// });
//                  $.ajax({
//           url: "{{url('admin/re_assign_order')}}",
//           type: "post",
//           data: {id:id},
//                     dataType: "json",
//                     success:function(res) {

//                       console.log(res)
//                         var data= "Assign Rider successfully";       


//                   var message = data;
//                   var title = $('#toastr-title').val() || '';
//                      var type = 'success';
//                   toastr[type](message, title, {
//                     positionClass: $('input[name="toastr-position"]:checked').val(),
//                     closeButton: 'true',
//                     progressBar:'true',
//                     newestOnTop: 'true',
//                     rtl: $('body').attr('dir') === 'rtl' || $('html').attr('dir') === 'rtl',
//                     timeOut: $('#toastr-duration').val()
//                   });


//                   location.reload();
                  
//                 },

//                 error:function(error) {
//                         console.log(error);
                  
//                 }

//                 });

// })

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
          url: "{{url('admin/change_suborder_status')}}",
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
          url: "{{url('admin/append_locality')}}",
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
          url:"{{url('admin/find_riders')}}?city_id="+city_id+"&locality_id="+locality_id,
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
                          $(".Delivered_cls").prop("disabled",false);

            }


      else if($('.Pickup_cls').is(':checked')){
             $(".Dispatch_cls").prop("disabled",false);
                          $(".Delivered_cls").prop("disabled",true);

            }
            

            // else if($('.Cancel_cls').is(':checked')){
            //  $(".Pickup_cls").prop("disabled",false);
            //   $(".Dispatch_cls").prop("disabled",true);
               
               
            // }
            
            else if($('.Approval_cls').is(':checked')){
              $(".Pickup_cls").prop("disabled",false);
               $(".Dispatch_cls").prop("disabled",true);
             
                                         $(".Delivered_cls").prop("disabled",true);

            }
            
            else if($('.Pending_cls').is(':checked')){
             $(".Approval_cls").prop("disabled",false);
               $(".Pickup_cls").prop("disabled",true);
                $(".Dispatch_cls").prop("disabled",true);
                                         $(".Delivered_cls").prop("disabled",true);

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