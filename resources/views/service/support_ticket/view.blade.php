@extends('service.layouts.app')
@section('title',"All Support Tickit | Service Mande Clan")

<!-- ................custom css................. -->

@section('customStyle')
<style>
    .new-support-ticket{
        margin-bottom:0px !important;
    }
/*.col-md-12, .col-md-6{
margin-bottom: 10px;
}*/
.span-left{
/*float:left;*/
}
.span-right{
    float:right;
}
.span-left,
.span-right .fa-plus,
.span-right .fa-minus{
    cursor:pointer;
}
.span-right .fa-minus{
    display:none;
}
.alert-info{
    font-size:14px;
}
.panel-heading{
    font-size:15px;
}
.checkbox label, .radio label, label{
    display: inline-block;
    max-width: 100%;
    margin-bottom: 10px;
    font-weight: 700;
}
.form-control{
    margin-bottom:1rem;
    border-color: transparent;
    box-shadow: unset;
    border-bottom: 1px solid #555;
    border-radius: 5px;
    border: 1px solid #ccc;
    padding: 6px 12px;height: 38px;
    background-image:unset !important;
}
.form-control:focus {
    border-color: #66afe9;
    outline: 0;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102,175,233,.6);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102,175,233,.6);
}
.nicEdit-main {
    width: 100% !important;
    font-size:15px !important;
}
#checkValidations{
    float:right;
}
.btn-success{
    color: #31708f !important;
    background-color: #d9edf7 !important;
    border: 1px solid #bce8f1 !important;
}
.btn-success:hover{
    color: #276482 !important;
    background-color: #b2d2e3 !important;
    border: 1px solid #7aafba !important;
}
.panel-default>.panel-heading {
    color: #31708f;
    background-color: #d9edf7;
    border-color: #bce8f1;
}


.panel-default>.panel-heading.Admin {
       color: #495057;
    background-color: #ddd;
    border-color: #495057;
}


.panel-heading {
    padding: 10px 15px;
    border-bottom: 1px solid transparent;
    border-top-left-radius: 3px;
    border-top-right-radius: 3px;
}
.panel-heading.message-block{
    padding:4px 10px;
}
.panel-default {
    border: 1px solid #bce8f1 !important;
}
.panel {
    margin-bottom: 20px;
    background-color: #fff;
    border-radius: 4px;
    -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);
    box-shadow: 0 1px 1px rgba(0,0,0,.05);
}
.panel-body {
    padding: 15px;
}
.panel-body.message-form{
    display:none;
}
.nicEdit-panelContain,
.nicEdit-main{
    width:100%;
}
/*.message-textarea div,*/
.message-textarea div div{
/*width:100%;*/
}
.panel-para{
    padding:0;
    margin:0;
    font-size:14px;
    text-transform: capitalize;
}
.panel-para1{
    padding:0;
    margin:0;
    font-size:12px;
    text-transform: capitalize;
}

.profile-order-history .card-padding {
    padding: 20px;
}

.alert-success {
    color: #285b2a;
    background-color: #dbefdc;
    padding: 10px;
    }
</style>
@endsection

<!-- ................Add css link................. -->

@push('style')
@endpush

<!-- ................body................. -->
@section('innercontent')

<main class="content profile-order-history">
    <div class="container-fluid p-0">

        <div class="clearfix">
<a href="{{url('service/support-ticket')}}" class="form-inline float-right mt--1 d-none d-md-flex">
<button class="btn btn-info"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Back</button>
</a>

            <h1 class="h3 mb-3">Support Tickit &nbsp;&nbsp;</h1>
        </div>

        <div class="card">
            <div class="card-body">

                <div class="card">
                    <div class="card-header">
                        <h4>Opened at {{date("d-M-y", strtotime($record->created_at))}} {{date("g:i A", strtotime($record->created_at))}} </h4>
                    </div>
                    <div class="card-padding">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-success" style="text-align:center;">
                                    Your support ticket status is  &nbsp;  <strong> {{$record->status}}</strong> &nbsp; , reply below for more inquiry.
                                </div>
                            </div>
                            <div class="col-md-12">
                                                              @if($record->status=='Open')

<div class="panel panel-default onlyopen">
    <div class="panel-heading"><span class="span-left"><i class="fa fa-edit" style="font-size:20px"></i> Click Me To Reply</span><span class="span-right"><i class="fa fa-plus" style="font-size: 20px; display: none;"></i><i class="fa fa-minus" style="font-size: 20px; display: inline;"></i></span></div>
<div class="panel-body message-form" style="display: block;">
   
 {!! Form::open(array('url' => 'service/reply-support-ticket','files'=>'true','method'=>'POST', 'class'=>'new-support-ticket')) !!}

        <div class="row">
            <div class="col-md-4">
                <label for="name">Name</label>
                  {!! Form::text('vendor_name', $record->vendor_name, array('class' => 'form-control', 'disabled'=>'')) !!}
            </div>
            <div class="col-md-4">
                <label for="email">Email</label>
               {!! Form::email('vendor_email',  $record->vendor_email, array('class' => 'form-control', 'disabled'=>'')) !!}
            </div>

              <div class="col-md-4">
                <label for="file">Attachment</label>
               {!! Form::file('attachment', array('class' => 'form-control')) !!}
            </div>

            <div class="col-md-12 message-textarea" style="margin-bottom: 25px;">
                <label for="user-message">Message</label>
                {!!Form::textarea('message',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','required','maxlength'=>'600')) !!} 

<input type="hidden" name="ticket_id" value="{{$record->id}}">
<input type="hidden" name="name" value="{{$record->vendor_name}}">
            </div>

          

            <hr class="mobile-hide">

            <div class="col-md-12">
                <div class="mobile-hide">

                    <button type="submit" id="clickSubmitBtn" class="btn btn-success">Send</button>
                </div>
            </div>
        </div>
{{form::close()}}
</div>
</div>
@endif

@if(!empty($records))
@foreach($records as $index=>$data)
                                <div class="panel panel-default">
                                    <div class="panel-heading message-block {{$data->message_by}}">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row mobile-margin0">
                                                    <div class="col-md-1 col-xs-12 mobile-padding0">
                                                        <div class="mobile-center">
                                                            <i class="fa fa-user" style="font-size:35px"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-11 col-xs-12 mobile-padding0 mobile-center">
                                                        <p class="panel-para">{{$data->name}}</p>
                                                        <p class="panel-para1">{{$data->message_by}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xs-12">
                                                <div class="row">
                                                    <div class="col-md-12" style="text-align:right;">
                                                        {{date("d-M-y", strtotime($data->created_at))}} {{date("g:i A", strtotime($data->created_at))}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-10">
                                                {!!$data->message!!}
                                            </div>
                                            <div class="col-md-2">
                                                @if(!empty($data->attachment))
<a href="{{url('public/images/tickets/'.$data->attachment)}}" target="_blank"><button type="button" class="btn btn-primary"><i class="fa fa-eye"></i> View</button>@endif
</a>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>

                                @endforeach
                                @endif
                                

                            </div>
                        </div>
                        <div class="modal fade" id="myModal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="alert alert-warning modal-body" style="margin-bottom:0;text-align:center;">
                                        <span id="error_message">Error happend!</span>
                                        <button type="button" class="close" data-dismiss="modal">×</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <span data-toggle="modal" data-target="#myModal" id="errorModalBtn"></span>
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
<script src="{{asset('public/basic-ckeditor/ckeditor.js')}}"></script>
{{-- <script>
    CKEDITOR.replace( 'message');
</script> --}}

<script type="text/javascript" charset="utf-8" async defer>
    $(document).ready(function () {
        $(document).on('click', '.fa-plus', function() {
            $('.message-textarea').css('margin-bottom','25px');
            $('.message-textarea > div:nth-child(2)').css('width','100%');
            $('.message-textarea .nicEdit-main').parent().css('width','100%');
            $('.panel-body.message-form').slideDown( "slow", function() {});
            $('.fa-plus').toggle();
            $('.fa-minus').toggle();
        });
        $(document).on('click', '.fa-minus', function() {
            $('.panel-body.message-form').slideUp( "slow", function() {});
            $('.fa-minus').toggle();
            $('.fa-plus').toggle();
        });

        $(document).on('click', '.span-left', function(){
            $('.message-textarea').css('margin-bottom','25px');
            $('.message-textarea > div:nth-child(2)').css('width','100%');
            $('.message-textarea .nicEdit-main').parent().css('width','100%');
            $('.panel-body.message-form').slideToggle('slow');
        });

        $(document).on('click', '#checkValidations', function() {

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var message = $('.nicEdit-main').text();

            // console.log(checkState);
            if(message == ''){
                $('body').css('width', '100%')
                $('#error_message').empty();
                $('#error_message').text('Please Enter Support Ticket Message.');
                $('#errorModalBtn').click();
                return;
            }else{
                $('#clickSubmitBtn').click();
            }
        });
    });
</script>
@endpush