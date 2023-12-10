@extends('admin.layouts.app')
@section('title',"All currency setting | Admin Mande Clan")

<!-- ................custom css................. -->

@section('customStyle')
@endsection

<!-- ................Add css link................. -->

@push('style')
@endpush

<!-- ................body................. -->
@section('innercontent')

<main class="content">
    <div class="container-fluid p-0">

        <div class="clearfix">

         <h1 class="h3 mb-3">Push Notification Manager</h1>
     </div>

     <!--   <div class="card">
        <div class="card-body">

        </div>
    </div> -->

    <div class="row">
      <div class="col-12">
        <div class="tab">
          <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item"><a class="nav-link active" href="#tab-1" data-toggle="tab" role="tab" style="font-weight: bold;"><i class="fas fa-bell-slash"></i> Push Notification Manager</a></li>
            <li class="nav-item "  style="font-weight: bold;"><a class="nav-link " href="#tab-2" data-toggle="tab" role="tab"><i class="fas fa-key"></i> Onesignal Keys</a></li>
        </ul>


        <div class="tab-content">
         <div class="tab-pane active" id="tab-1" role="tabpanel">
           {!!Form::open(['url'=>['admin/push-notification'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id','autocomplete'=>'off'])!!}

           <div class="form-row">
            <div class="form-group col-md-4">
                <label for="inputEmail4">Select User Group: * </label>                                                   
                {!!Form::select('user_group',['all_customers'=>'All Customers','all_sellers'=>'All Sellers','all_admins'=>'All Admins','all_users'=>'All Users (Seller + Customers + Admins)'],null,array('class'=>'form-control select2 ','placeholder'=>'Select Category','data-toggle'=>'select2','required')) !!}
            </div>

            <div class="form-group col-md-8">
                <label for="inputEmail4">Subject: *</label>                                                   
                {!!Form::text('subject',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','required')) !!} 
            </div>

            <div class="form-group col-md-12">
                <label for="inputEmail4">Notification Body: *</label>                                                   
                {!!Form::textarea('message',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','required')) !!} 
            </div>

            <div class="form-group col-md-4">
                <label for="inputEmail4">Target URL:</label>                                                   
                {!!Form::text('target_url',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','required')) !!} 
            </div>

            <div class="form-group col-md-4">
                <label for="inputEmail4">Notification Icon:</label>                                                   
                {{ Form::file('icon',null, ['class' => 'form-control','required']) }}   
<!-- <small class="text-muted">
                    <i class="fa fa-question-circle"></i> If not enter than default icon will use which you upload at time of Create one signal app.
                </small> -->
            </div>

            <div class="form-group col-md-4">
                <label for="inputEmail4">Notification Image:</label>                                                   
                {{ Form::file('image',null, ['class' => 'form-control','required']) }}    </div>

                <div class="form-group col-md-4">

                  <input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="Deactive" data-onstyle="success" data-offstyle="danger" id="11" class="checkstatus" onchange="updateToggle(11)" name="show_button">

              </div>

              <div class="form-group col-md-4">
                <label for="inputEmail4">Button Text: *</label>                                                   
                {!!Form::text('btn_text',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','required')) !!} 


            </div>

            <div class="form-group col-md-4">
                <label for="inputEmail4">Button Target URL:</label>                                                   
                {!!Form::text('btn_url',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','required')) !!} 
            </div>


        </div>


        <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i>   Submit</button>

        <a class="btn" href="{{url('admin/push-notification')}}" style="background-color: #9e9b9b;color: #fff"><i class="fas fa-times"></i>  Cancel</a>

        {{Form::close()}}

    </div>

    <div class="tab-pane" id="tab-2" role="tabpanel">

       {!!Form::open(['url'=>['admin/push-notification-key'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id','autocomplete'=>'off'])!!}

       <div class="form-row">
                <div class="form-group col-md-12">

           <a title="Get one signal keys" href="https://onesignal.com/" class="pull-right" target="__blank">
                       <i class="fa fa-key"></i> Get your keys from here
                   </a>
               </div>
        <div class="form-group col-md-4">
            <label for="inputEmail4">ONESIGNAL APP ID: *</label>                                                   
            {!!Form::text('ONESIGNAL_APP_ID',env('ONESIGNAL_APP_ID'),array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','required')) !!} 
        </div>

        <div class="form-group col-md-4">
            <label for="inputEmail4">ONESIGNAL REST API KEY: *</label>                                                   
            {!!Form::text('ONESIGNAL_REST_API_KEY',env('ONESIGNAL_REST_API_KEY'),array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','required')) !!} 
        </div>
    </div>

    <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i>   Submit</button>

    <a class="btn" href="{{url('admin/push-notification')}}" style="background-color: #9e9b9b;color: #fff"><i class="fas fa-times"></i>  Cancel</a>
</div>

{{Form::close()}}


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