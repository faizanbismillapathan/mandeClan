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
        <link href="https://weddingduty.com/public/css/style.css" rel="stylesheet">

@endpush

<!-- ................body................. -->
@section('innercontent')

<main class="content">
  <div class="container-fluid p-0">

    <div class="clearfix">

    
      <h1 class="h3 mb-3">Service Enquiry </h1>
    </div>

 



    

                  <div class="card">

                                    
<div class="card-body">

<div class="row" style="padding: 20px">
  

    <div class="col-md-12" >
     <i class="fas fa-calendar-alt"></i> Event:
@if(!empty($event_records->start_date))
      {{$event_records->start_date}} -  {{$event_records->end_date}}
@endif
    </div>

   
  </div>
<div class="container111">
<div class="messaging">
      <div class="inbox_msg">
     
        <div class="mesgs">
          <div class="msg_history">
        <div class="zareena">
              @if(!empty($chat_message))
            @foreach($chat_message as $index=>$data)
            @if($data->identifier=='Customer')
            <div class="incoming_msg">
              <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
              <div class="received_msg">
                <div class="received_withd_msg">
                  <p>{!!$data->message!!}</p>
                  <span class="time_date"> 
                    <?php 
                  $temp = explode(' ',$data->created_at);
                echo date('h:i a', strtotime($data->created_at));
                ?>   | 
        <?php
$date = $data->created_at;
$date = date('F, d', strtotime($date));
echo $date;
?></span></div>
              </div>

            </div>
            @elseif($data->identifier=='Service')
            <div class="outgoing_msg">
              <div class="sent_msg">
                <p>{!!$data->message!!}</p>
                <span class="time_date">  <?php 
                  $temp = explode(' ',$data->created_at);
                echo date('h:i a', strtotime($data->created_at));
                ?>   | 
        <?php
$date = $data->created_at;
$date = date('F, d', strtotime($date));
echo $date;
?></span> </div>
            </div>
            @endif
         @endforeach
         @endif
       
        </div>
          </div>
       
          {!!Form::open(['url'=>['service/service-enquiry'],'files' => true, 'class' => ' form-bordered form-row-stripped','method' =>'post'])!!}
   @if(!empty($id))
            <input type="hidden" name="service_booking_id" value="{{$id}}"> 

  @endif
              <input type="hidden" name="customer_user_id" value="{{$event_records->user_id}}"> 

          <div class="type_msg">
            <div class="input_msg_write">
              <input type="text" name="user_message" class="write_msg" placeholder="Type a message" onchange="this.form.submit()"/>
              <button class="msg_send_btn" type="button"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
            </div>
          </div>
          {{Form::close()}}
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
              <script src="{{asset('public/js/comman.js')}}"></script>
              <script src="{{asset('public/js/validation.js')}}"></script>

                
<script>
  $(document).ready(function(){
    /* ................ */
    var height = 0;
    $('.mesgs .msg_history .zareena').each(function(i, value){
        height += parseInt($(this).height());
    });
    
    height += '';
    
    $('.msg_history').animate({scrollTop: height});

 }); 
</script>


@endpush