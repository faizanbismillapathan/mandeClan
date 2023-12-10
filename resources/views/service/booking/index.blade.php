@extends('service.layouts.app')
@section('title',"All Category List| service Mande Clan")

<!-- ................custom css................. -->

@section('customStyle')
<style type="text/css">
  .fc td{
    background: #e6e6e6;
  }   
  .fc th {

    background: #fff;
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

      <a class="form-inline float-right mt--1 d-none d-md-flex">
        <button data-toggle="modal" data-target="#defaultModalopen" class="btn btn-info"><i class="fas fa-plus"></i>&nbsp;&nbsp; Add Event</button>
      </a>
      <h1 class="h3 mb-3">Service Booking </h1>
    </div>

    <div class="card">

      <div class="card-body">
        <div class="container">
          <div class="row">
            <div class="col-md-8 col-md-offset-4">
              <div class="panel panel-default">

                <div class="panel-body">
                  {!! $calendar->calendar() !!}
                </div>
              </div>
            </div>
           {{--  <div class="col-md-2">
              <div class="row">
                <div class="col-md-12"  style="color: #569c02">
                  <i class="fas fa-circle"></i>&nbsp;&nbsp;Booked

                </div>
                <div class="col-md-12" style="color: #ff9800">
                  <i class="fas fa-circle"></i>&nbsp;&nbsp;Tentative

                </div>
                <div class="col-md-12"  style="color: #9E9E9E;">
                  <i class="fas fa-circle"></i>&nbsp;&nbsp;Available

                </div>
              </div>

            </div> --}}
          </div>
        </div>
      </div>
    </div>
    {!! $calendar->script() !!}



    <div class="modal fade"  data-keyboard="false" data-backdrop="static" id="defaultModalopen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
              <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Event</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


           {!!Form::open(['url'=>['service/booking'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'booking_form'])!!}

           <div class="form-row">

            <div class="form-group col-md-8">
              <label for="inputEmail4">Mobile No</label>     
              {!!Form::text('customer_mobile',null,array('class'=>'form-control onchanges','placeholder'=>'','autocomplete'=>'off')) !!}  
            </div>

            <div class="col-md-2" style="margin-top:30px">
             <button type="button" class="btn btn-primary findmoresuppliermodel" value="">Search</button>
           </div>
         </div>
         <div class="form-row customer_cls1" style="display:none;" >

          <div class="form-group col-md-4">
            <b>Name :</b>     
            <span class="name_cls"></span>
          </div>

          <input type="hidden" name="user_id" value="" class="user_id_cls">


          <div class="form-group col-md-4">
            <b>Mobil No :</b>     
            <span class="mobile_cls"></span>
          </div>

          <div class="form-group col-md-4">
            <b>Email Id :</b>     
            <span class="email_cls"></span>
          </div>

          <div class="form-group col-md-4">
            <b>City :</b>     
            <span class="city_cls"></span>
          </div>

          <div class="form-group col-md-8">
            <b>Full Address :</b>     
            <span class="address_cls"></span>
          </div>
        </div>
        <div class="form-row customer_cls2" style="display:none;">


          <div class="form-group col-md-6">
            <label for="inputEmail6">Contact Person</label>
            {!!Form::text('customer_name',null,array('class'=>'form-control onlyAlphabet','placeholder'=>'','autocomplete'=>'off')) !!} 
          </div>
          <div class="form-group col-md-6">
            <label for="inputPassword6">Email</label>
            {!!Form::text('customer_email',null,array('class'=>'form-control emailfull','placeholder'=>'','autocomplete'=>'off')) !!} 
          </div>
                          {{-- <div class="form-group col-md-6">
                              <label for="inputPassword6">Mobile</label>
                              {!!Form::text('customer_mobile',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off')) !!} 
                            </div> --}}

                            <div class="form-group col-md-4">
                              <label for="inputEmail4">State</label>

                              {!!Form::select('customer_state',$states,null,array('class'=>'form-control select2 state_selector','placeholder'=>'Select Country','data-toggle'=>'select2')) !!}

                            </div>
                            <div class="form-group col-md-4">
                              <label for="inputEmail4">City</label>

                              {!!Form::select('customer_city',[],null,array('class'=>'form-control select2 city_selector','placeholder'=>'Select City','data-toggle'=>'select2')) !!}

                            </div>

                            <div class="form-group col-md-4">
                              <label for="inputEmail4">Locality</label>

                              {!!Form::select('customer_locality',[],null,array('class'=>'form-control locality_selector select2','placeholder'=>'Select Country','data-toggle'=>'select2')) !!}

          <input type="hidden" name="customer_pincode" value="" >



                            </div>


                            <div class="form-group col-md-12">
                              <label for="inputPassword4">Address</label>
                              {!! Form::textarea('customer_address',null,['class'=>'form-control textarea', 'rows' => 2, 'cols' => 50,'id'=>'']) !!}
                            </div>

                          </div>

                          <div class="form-row ">

                            <div class="form-group col-md-12">
                              <label for="inputEmail4">Service Title</label>     
                              {!!Form::text('title',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off')) !!}  
                            </div>


                            <div class="form-group col-md-6">
                              <label for="inputEmail4">Booking Date</label>     
                              {!!Form::text('start_date',null,array('class'=>'form-control daterange','placeholder'=>'','autocomplete'=>'off')) !!}  
                            </div>

                            <div class="form-group col-md-6">
                              <label for="inputEmail4">Booking Date</label>     
                              {!!Form::text('end_date',null,array('class'=>'form-control daterange','placeholder'=>'','autocomplete'=>'off')) !!}  
                            </div>

                            <div class="form-group col-md-6">
                              <label for="inputEmail4">booking Amount</label>     
                              {!!Form::text('booking_amount',null,array('class'=>'form-control numbersOnly','placeholder'=>'','autocomplete'=>'off')) !!}  
                            </div>

                            <div class="form-group col-md-6">
                              <label for="inputEmail4">Advance Amount</label>     
                              {!!Form::text('advance_amount',null,array('class'=>'form-control numbersOnly','placeholder'=>'','autocomplete'=>'off')) !!}  
                            </div>

                            <div class="form-group col-md-6">
                              <label for="inputEmail4">Payment Mode</label>     

                              {!!Form::select('payment_mode',['Stripe'=>'Stripe','Paypal'=>'Paypal','COD'=>'COD'],null,array('class'=>'form-control select2','data-toggle'=>'select2','autocomplete'=>'off','required')) !!}


                            </div>



                            <div class="form-group col-md-6">
                              <label for="inputEmail4">Select status</label>                       
                              {!!Form::select('status',['Pending'=>'Pending','Booked'=>'Booked','Cancelled'=>'Cancelled','Completed'=>'Completed'],null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','placeholder'=>'Select status')) !!}  
                            </div>
                            <div class="form-group col-md-12">
                              <label for="inputEmail4">Service Details</label>                         
                              {!! Form::textarea('description',null,['class'=>'form-control textarea', 'rows' => 4, 'cols' => 50,'id'=>'message']) !!}
                            </div>
                          </div>

                        </div>
                        <div class="modal-footer">
                          @if(!empty($record))
                          <button type="submit" class="btn btn-primary">Update</button>
                          @else
                          <button type="submit" class="btn btn-primary">Submit</button>

                          @endif
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        </div>
                        {{Form::close()}}

                      </div>
                    </div>
                  </div>


                  <div class="card">

                    <div class="card-body">

                      <table class="table table-striped table-hover table-sm table-bordered" id="display">
                        <thead>
                          <tr>
                            <th width="5%">Sr.</th>
                            <th width="10%">Start Date</th>
                            <th width="10%">End Date</th>
                            <th width="10%">Create Date</th>
                            <th width="10%">Client Detail</th>
                            <th width="15%">Title</th>
                            <th width="15%">Vendor Name</th>
                            <th width="10%">Status</th> 
                            <th width="20%">Action</th>             
                          </tr>
                        </thead>
                        <tbody>


                          @if(!empty($event_records))
                          @foreach($event_records as $index => $data)
                          <tr class="deleteRow">
                            <td>{{$index+1}}</td> 
                            <td>{{date('d-m-Y', strtotime($data->start_date))}}</td>
                            <td>{{date('d-m-Y', strtotime($data->end_date))}}</td>
                            <td>{{date('d-m-Y', strtotime($data->created_at))}}</td>
                            {{-- <td>{{date('d-m-Y', strtotime($data->updated_at))}}</td> --}}

                            <td>{{$data->customer_userid}} <br>
{{$data->customer_name}} <br>
{{$data->customer_email}} <br>
{{$data->customer_mobile}} <br>
</td>


                            <td>{{$data->title}}</td>
                            <td>{{$vendords->service_name}}</td>

                            <td style="color: #569c02">{{$data->status}}</td>
                            <td>                          
                              <a href="{{ URL::to('service/booking/'.$data->id.'/edit') }}" class="modaleditclick" data-toggle="modal" data-target="#edit_category_modal" id="{{$data->id}}" start_date="{{$data->start_date}}"  end_date="{{$data->end_date}}"  title="{{$data->title}}"  status="{{$data->status}}"  description="{{$data->description}}"  booking_amount="{{$data->booking_amount}}"  advance_amount="{{$data->advance_amount}}"  payment_mode="{{$data->payment_mode}}"  user_id="{{$data->user_id}}"  name="{{$data->name}}"  mobile="{{$data->mobile}}"  email="{{$data->email}}"  city_name="{{$data->city_name}}"  customer_address="{{$data->customer_address}}" ><button class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></button></a>


                               <a href="{{ URL::to('service/booking/'.$data->id) }}" ><button class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Edit">Chat</button></a>

                            </td>
                          </tr>
                          @endforeach
                          @endif

                        </tbody>
                      </table>
                      <div class="card-body">
                        @if(!empty($event_records))
                        {!! $event_records->appends(request()->query())->render() !!}
                        @endif
                      </div>
                     
                    </div>
                  </div>

                </div>


              </main> 

<div class="modal fade" id="edit_category_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
     {!!Form::open(['url'=>['service/booking-update'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}

     <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Update Booking</h5>
      <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">


     <div class="form-row ">


      <div class="form-group col-md-4">
        <b>Name :</b>     
        <span class="name_cls"></span>
      </div>

      <input type="hidden" name="user_id" value="" class="user_id_cls">

      <input type="hidden" name="id" value="" class="id_cls">

      <div class="form-group col-md-4">
        <b>Mobil No :</b>     
        <span class="mobile_cls"></span>
      </div>

      <div class="form-group col-md-4">
        <b>Email Id :</b>     
        <span class="email_cls"></span>
      </div>

      <div class="form-group col-md-4">
        <b>City :</b>     
        <span class="city_cls"></span>
      </div>

      <div class="form-group col-md-8">
        <b>Full Address :</b>     
        <span class="address_cls"></span>
      </div>

      <div class="form-group col-md-12">
        <label for="inputEmail4">Service Title</label>     
        {!!Form::text('title',null,array('class'=>'form-control title_cls','placeholder'=>'','autocomplete'=>'off')) !!}  
      </div>


   {{--    <div class="form-group col-md-6">
        <label for="inputEmail4">Booking Date</label>     
        {!!Form::text('booking_date',null,array('class'=>'form-control daterange booking_date_cls','placeholder'=>'','autocomplete'=>'off')) !!}  
      </div>
 --}}

                   <div class="form-group col-md-6">
                              <label for="inputEmail4">Booking Date</label>     
                              {!!Form::text('start_date',null,array('class'=>'form-control daterange start_date_cls','placeholder'=>'','autocomplete'=>'off')) !!}  
                            </div>

                            <div class="form-group col-md-6">
                              <label for="inputEmail4">Booking Date</label>     
                              {!!Form::text('end_date',null,array('class'=>'form-control daterange end_date_cls','placeholder'=>'','autocomplete'=>'off')) !!}  
                            </div>


      <div class="form-group col-md-6">
        <label for="inputEmail4">booking Amount</label>     
        {!!Form::text('booking_amount',null,array('class'=>'form-control numbersOnly booking_amount_cls','placeholder'=>'','autocomplete'=>'off')) !!}  
      </div>

      <div class="form-group col-md-6">
        <label for="inputEmail4">Advance Amount</label>     
        {!!Form::text('advance_amount',null,array('class'=>'form-control numbersOnly advance_amount_cls','placeholder'=>'','autocomplete'=>'off')) !!}  
      </div>

      <div class="form-group col-md-6">
        <label for="inputEmail4">Payment Mode</label>     

        {!!Form::select('payment_mode',['Stripe'=>'Stripe','Paypal'=>'Paypal','COD'=>'COD'],null,array('class'=>'form-control select2 payment_mode_cls','data-toggle'=>'select2','autocomplete'=>'off','required')) !!}

      </div>

      <div class="form-group col-md-6">
        <label for="inputEmail4">Select status</label>                       
        {!!Form::select('status',['Pending'=>'Pending','Booked'=>'Booked','Cancelled'=>'Cancelled','Completed'=>'Completed'],null,array('class'=>'form-control status_cls','placeholder'=>'','autocomplete'=>'off','placeholder'=>'Select status')) !!}  
      </div>
      <div class="form-group col-md-12">
        <label for="inputEmail4">Service Details</label>                         
        {!! Form::textarea('description',null,['class'=>'form-control textarea description_cls', 'rows' => 4, 'cols' => 50,'id'=>'message']) !!}
      </div>
    </div>

  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-success">Update</button>

  </div>

  {{Form::close()}}


</div>
</div>
</div>
              @endsection

              <!-- ................push new js link................. -->

              @push('js')
              <script src="{{asset('public/js/comman.js')}}"></script>
              <script src="{{ asset('public/js/daterangepicker.min.js') }}"></script>
              <script src="{{asset('public/js/validation.js')}}"></script>

              <script type="text/javascript">
                $(document).ready(function () {


 function encodeQuery(data) {
            let ret = [];
            for (let d in data)
            if (data[d]) {
                ret.push(encodeURIComponent(d) + '=' + encodeURIComponent(data[d]));
            }
            return ret.join('&');
        }
                  function changecall(data){
                    var date=data;

                    $.ajaxSetup({
                      headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      }
                    });
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');



 var postParam = {
                'date': data,
              

}
    var querystring = encodeQuery(postParam);




var urls = @json(url('/service/'.Request::segment(2)))+'?'+querystring;

// alert(urls)
urls=urls.toLowerCase(urls);

history.pushState('', '', urls)

location.href =urls;



}
$(".fc-past").click(function(){
  var data=$(this).attr('data-date');
   // alert(data)
   changecall(data);

 });
$(".fc-future").click(function(){
 var data=$(this).attr('data-date');
   // alert(data)
   changecall(data);

 });
$(".fc-today").click(function(){
  var data=$(this).attr('data-date');
   // alert(data)
   changecall(data);

 });


$(".daterange").daterangepicker({
 singleDatePicker: true,
   locale: {
    format: 'YYYY-MM-DD'
  },
});


// ....................................data
$('.onchanges').on('change', function() {
  var values = $(this).val();
  console.log(values);
  var data;
  if(values) {  
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: "{{url('service/append_user_info')}}",
      type: "post",
      data: {mobile:values},
      dataType: "json",
      success:function(data) {
        console.log(data);

        if(data){

          $(".customer_cls1").show();
          $(".customer_cls2").hide();

          $(".user_id_cls").val(data.id);
          $(".name_cls").text(data.name);
          $(".mobile_cls").text(data.mobile);
          $(".email_cls").text(data.email);
          $(".city_cls").text(data.city_name);
          $(".address_cls").text(data.customer_address);


        }else{

          $(".customer_cls2").show();
          $(".customer_cls1").hide();

        }






                 //  $('select[name="state_id"]').empty();                 
                 //  $('select[name="state_id"]').append('<option value="'+''+'">'+'None'+'</option>');
                 //   $.each(data, function(key, value) { 
                 //  $('select[name="state_id"]').append('<option value="'+ key +'">'+value+'</option>');
                 // });
               }

             });
  }
  else{
    $('select[name="state_id"]').empty();
  }

});

// ......................text

$('.modaleditclick').on('click', function(e) {
  var id=$(this).attr('id');

  var booking_date=$(this).attr('booking_date');
  var title=$(this).attr('title');
  var status=$(this).attr('status');
  var description=$(this).attr('description');
  var booking_amount=$(this).attr('booking_amount');
  var advance_amount=$(this).attr('advance_amount');
  var payment_mode=$(this).attr('payment_mode');

  var user_id=$(this).attr('user_id');
  var name=$(this).attr('name');
  var mobile=$(this).attr('mobile');
  var email=$(this).attr('email');
  var city_name=$(this).attr('city_name');
  var customer_address=$(this).attr('customer_address');

  var start_date=$(this).attr('start_date');
  var end_date=$(this).attr('end_date');



  $(".start_date_cls").val(start_date)
  $(".end_date_cls").val(end_date)

  $(".booking_date_cls").val(booking_date)
  $(".title_cls").val(title)
  $(".status_cls").val(status)
  $(".description_cls").val(description)
  $(".booking_amount_cls").val(booking_amount)
  $(".advance_amount_cls").val(advance_amount)
  $(".payment_mode_cls").val(payment_mode)

  $(".id_cls").val(id);

  $(".user_id_cls").val(user_id);
  $(".name_cls").text(name);
  $(".mobile_cls").text(mobile);
  $(".email_cls").text(email);
  $(".city_cls").text(city_name);
  $(".address_cls").text(customer_address);



})
// ...............customer_address

  $('.state_selector').on('change', function() {
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
          url: "{{url('append_city')}}",
          type: "post",
          data: {id:stateID},
                    dataType: "json",
                    success:function(data) {
                        console.log(data);
              $('select[name="customer_city"]').empty();
                $('select[name="customer_locality"]').empty();
                $('select[name="customer_pincode"]').empty();

                  $('select[name="customer_city"]').append('<option value="'+''+'">'+'None'+'</option>');
                   $.each(data, function(key, value) { 
                  $('select[name="customer_city"]').append('<option value="'+ key +'">'+value+'</option>');
                 });
                }

                });
                    }
            else{
                             $('select[name="customer_city"]').empty();
                $('select[name="customer_locality"]').empty();
                $('select[name="customer_pincode"]').empty();
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
            
                $('select[name="customer_locality"]').empty();
                $('input[name="customer_pincode"]').val(''); 

                  $('select[name="customer_locality"]').append('<option value="'+''+'">'+'None'+'</option>');
                   $.each(data, function(key, value) { 
                  $('select[name="customer_locality"]').append('<option value="'+ key +'">'+value+'</option>');
                 });
                }

                });
                    }
            else{
                          $('select[name="customer_locality"]').empty();
                $('input[name="customer_pincode"]').val(''); 
            }

        });




        $('.locality_selector').on('change', function() {
            var locality_id = $(this).val();
            console.log(locality_id);

            var data;
           if(locality_id) {  
              $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});
                 $.ajax({
          url: "{{url('append_pincode')}}",
          type: "post",
          data: {id:locality_id},
                    dataType: "json",
                    success:function(data) {
                        console.log(data);
                                $('input[name="customer_pincode"]').val(data);

                }

                });
                    }
            else{
                $('input[name="customer_pincode"]').empty();
            }

        });

});

</script>



@endpush