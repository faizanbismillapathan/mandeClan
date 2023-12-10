@extends('admin.layouts.app')
@section('title',"Edit Store | Admin Mande Clan")

<!-- ................custom css................. -->

@section('customStyle')
<style>
  .field-icon {
    float: right;
    margin-left: -25px;
    margin-top: -25px;
    position: relative;
    z-index: 2;
  }

  .container{
    padding-top:50px;
    margin: auto;
  }
  .svg-inline--fa.fa-fw {
    width: 2.25em;
  }

  #mapCanvas,#map-canvas {
    width: 100%;
    height: 400px;

  }
  #infoPanel {
    float: left;
    margin-left: 10px;
  }
  #infoPanel div {
    margin-bottom: 5px;
  }

  .fileupload_second .img-thumbnail > img{

    width: 220px;
    height: 180px;
  }
</style>
@endsection

<!-- ................Add css link................. -->

@push('style')
<link rel="stylesheet" href="{{asset('public/css/bootstrap-fileupload.css')}}">
<link
href=
"https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css"
rel="stylesheet">
@endpush

<!-- ................body................. -->
@section('innercontent')


<main class="content">
  <div class="container-fluid p-0">
    <div class="clearfix">
      <a href="{{url('admin/stores')}}" style="margin-left: 17px;" class="form-inline float-right mt--1 d-none d-md-flex margin">
        <button class="btn btn-info"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Back</button>
      </a>



      <h1 class="h3 mb-3"><b>Update Stores <span class="badge badge-danger">            {{$record->store_unique_id}}
      </span></b></h1>

    </div>
    <div class="card">

      <div class="card-body password_contact">

       @if(!empty($record))
       {!! Form::model($record,array('url' => ['admin/stores', $record->id],'method'=>'PATCH','class'=>'','id' =>'seprate_form_id','files'=>'true')) !!}

       @endif
       <fieldset class="scheduler-border">
        <legend class="scheduler-border">Owner Information &nbsp;:</legend>
        <div class="form-row">



          <div class="form-group col-md-4">
            <label for="inputEmail4">Contact Person</label>
            {!!Form::text('store_owner_name',null,array('class'=>'form-control onlyAlphabet','placeholder'=>'','autocomplete'=>'off','required')) !!} 
          </div>
        {{--   <div class="form-group col-md-4">
              <label for="inputPassword4">Email</label>
              {!!Form::text('store_email',null,array('class'=>'form-control emailfull','placeholder'=>'','autocomplete'=>'off','required')) !!} 
            </div> --}}




            <div class="form-group col-md-4">
              <label for="inputPassword4">Gender</label>
              <div class="row">
                <div class="col-md-4">
                 <label class="custom-control custom-radio">
                  {{ Form::radio('store_owner_gendor', 'Male' , true,array('class'=>'custom-control-input')) }}

                  <span class="custom-control-label">Male</span>
                </label>                             
              </div>
              <div class="col-md-6"> <label class="custom-control custom-radio">
                {{ Form::radio('store_owner_gendor', 'Female' , false,array('class'=>'custom-control-input')) }}                    <span class="custom-control-label">Female</span>
              </label></div>

            </div>

          </div>






        </div>


      </fieldset>
      <fieldset class="scheduler-border">
        <legend class="scheduler-border">Store Information &nbsp;:</legend>
        <div class="form-row">
          <div class="form-group col-md-4 ">
            <label for="inputEmail4">Select Store Category</label>
            {!!Form::select('store_category',$categories,null,array('class'=>'form-control select2 ','placeholder'=>'Select Category','data-toggle'=>'select2','required','disabled')) !!}

          </div>

      <!--  <div class="form-group col-md-4 ">
          <label for="inputEmail4">Select Product Category</label>
          {!!Form::select('store_product_category[]',$product_category,explode(',',$record->store_product_category),array('class'=>'form-control select2 ','placeholder'=>'Select Category','data-toggle'=>'select2','required','multiple','disabled')) !!}

        </div> -->

        <div class="form-group col-md-4">
          <label for="inputEmail4">Store Name</label>
          {!!Form::text('store_name',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','required','readonly')) !!} 
        </div>

        <div class="form-group col-md-4">
          <label for="inputPassword4">Store Contact No</label>
          {!!Form::text('store_owner_mobile',null,array('class'=>'form-control contact_no_validate','minlength'=>'10' ,'maxlength'=>'13','placeholder'=>'','autocomplete'=>'off','required')) !!} 
        </div>


        <div class="form-group col-md-4">
          <label for="inputPassword4">Store Email</label>
          {!!Form::text('store_owner_email',null,array('class'=>'form-control emailfull','placeholder'=>'','autocomplete'=>'off','required')) !!} 
        </div>


        <div class="form-group col-md-4">
          <label for="inputPassword4">VAT/GSTIN No</label>
          {!!Form::text('store_gstin_no',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off')) !!} 
        </div>

        <div class="form-group col-md-4">
          <label for="inputPassword4">Website</label>
          {!!Form::url('store_website',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off')) !!} 
        </div>

        <div class="form-group col-md-4">
          <label for="inputPassword4">Store Open Time</label>
          {!!Form::text('store_open_time',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','id'=>'store_open_time_id')) !!} 
        </div>

        <div class="form-group col-md-4">
          <label for="inputPassword4">Store Close Time</label>
          {!!Form::text('store_close_time',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','id'=>'store_close_time_id')) !!} 

        </div>

        <div class="form-group col-md-4">
          <label for="inputPassword4">Facebook URL</label>
          {!!Form::url('store_facebook_url',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off')) !!} 
        </div>
        <div class="form-group col-md-4">
          <label for="inputPassword4">Instagram URL</label>
          {!!Form::url('store_instagram_url',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off')) !!} 
        </div>
        <div class="form-group col-md-4">
          <label for="inputPassword4">You tube URL</label>
          {!!Form::url('store_you_tube_url',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off')) !!} 
        </div>
        <div class="form-group col-md-4">
          <label for="inputPassword4">Twitter URL</label>
          {!!Form::url('store_twitter_url',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off')) !!} 
        </div>

        <div class="form-group col-md-4">
          <label for="inputPassword4">Verified Store</label>
          <div class="row">
            <div class="col-md-4">
             <label class="custom-control custom-radio">
              {{ Form::radio('str_verified_status', 'Verified' , true,array('class'=>'custom-control-input')) }}

              <span class="custom-control-label">Verified</span>
            </label>                             
          </div>
          <div class="col-md-6"> <label class="custom-control custom-radio">
            {{ Form::radio('str_verified_status', 'Unverified' , false,array('class'=>'custom-control-input')) }}                    <span class="custom-control-label">Unverified</span>
          </label></div>

        </div>

      </div>



      <div class="form-group col-md-4">
        <label for="inputPassword4">Email Verification  {{ $users->email_verified_at }}</label>
        <div class="row">
          <div class="col-md-4">
           <label class="custom-control custom-radio">
            @if(!$users->email_verified_at)

            {{ Form::radio('email_verified_at', 'Verified' , false,array('class'=>'custom-control-input')) }}
            @else
            {{ Form::radio('email_verified_at', 'Verified' , true,array('class'=>'custom-control-input')) }}

            @endif
            <span class="custom-control-label">Verified</span>
          </label>                             
        </div>
        <div class="col-md-6"> <label class="custom-control custom-radio">
                 @if(!$users->email_verified_at)

          {{ Form::radio('email_verified_at', 'Unverified' , true,array('class'=>'custom-control-input')) }}    
@else
          {{ Form::radio('email_verified_at', 'Unverified' , false,array('class'=>'custom-control-input')) }}    

@endif
                        <span class="custom-control-label">Unverified</span>
        </label></div>

      </div>

    </div>



    <div class="form-group col-md-10">
      <label for="inputPassword4">Store description</label>
      {!! Form::textarea('store_description',null,['class'=>'form-control textarea', 'rows' => 6, 'cols' => 50,'id'=>'']) !!}
    </div>
  </div>
</fieldset>


<fieldset class="scheduler-border">
  <legend class="scheduler-border">Store Locations &nbsp;:</legend>
  <div class="form-row">


    <div class="form-group col-md-4">
      <label for="inputEmail4">Country</label>
      @if(!empty($countries))
      {!!Form::select('store_country',$countries,null,array('class'=>'form-control basemap select2 selector','placeholder'=>'Select Country','data-toggle'=>'select2','required')) !!}
      @endif
    </div>
    <div class="form-group col-md-4">
      <label for="inputEmail4">State</label>

      @if(!empty($states))
      {!!Form::select('store_state',$states,null,array('class'=>'form-control basemap select2 state_selector','placeholder'=>'Select Country','data-toggle'=>'select2','required')) !!}
      @else
      {!!Form::select('store_state',[],null,array('class'=>'form-control basemap select2 state_selector','placeholder'=>'Select Country','data-toggle'=>'select2','required')) !!}
      @endif                     
    </div>

    <div class="form-group col-md-4">
      <label for="inputEmail4">City</label>

      @if(!empty($cities))
      {!!Form::select('store_city',$cities,null,array('class'=>'form-control basemap select2 city_selector','placeholder'=>'Select City','data-toggle'=>'select2','required')) !!}
      @else
      {!!Form::select('store_city',[],null,array('class'=>'form-control basemap select2 city_selector','placeholder'=>'Select City','data-toggle'=>'select2','required')) !!}
      @endif                  
    </div>

    <div class="form-group col-md-4">
      <label for="inputEmail4">Locality</label>      
      @if(!empty($localities))
      {!!Form::select('store_locality',$localities,null,array('class'=>'form-control basemap locality_selector select2','placeholder'=>'Select Country','data-toggle'=>'select2','required')) !!}
      @else
      {!!Form::select('store_locality',[],null,array('class'=>'form-control basemap locality_selector select2','placeholder'=>'Select Country','data-toggle'=>'select2','required')) !!}
      @endif                     
    </div>


    <div class="form-group col-md-4">
      <label for="inputPassword4">Pin Code</label>
      {!!Form::text('store_pincode',null,array('class'=>'form-control basemap','placeholder'=>'','autocomplete'=>'off','required','data-mask'=>'000000')) !!} 
    </div>

    <input type="hidden" name="map_address" id="search-txt" value="">

    <div class="form-group col-md-7">
      <label for="inputPassword4">Address</label>
      {!! Form::text('store_address',null,['class'=>'form-control basemap','id'=>'shopaddress']) !!}
    </div>

    <div class="form-group col-md-1">

     <button type="button" class="btn btn-info viewmodelwithmap"  id="search-btn" style="margin-top: 25px;" data-toggle="modal" data-target="#mainmapmodal"><i class="fa fa-map-marker"></i></button></div>
     <div class="form-group col-md-4">
      <label for="inputPassword4">Longitude</label>
      {!!Form::text('store_longitude',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','id'=>'latitude')) !!} 
    </div>

    <div class="form-group col-md-4">
      <label for="inputPassword4">Latitude</label>
      {!!Form::text('store_latitude',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','id'=>'langitude')) !!} 
    </div>


  </div>
</fieldset>


<fieldset class="scheduler-border">
  <legend class="scheduler-border">Store Cover Photo &nbsp;:</legend>
  <div class="form-row">
       {{--  <div class="form-group col-md-4 ">
           <div class="form-group author-img-bx">

            <label>Logo</label>             

            <div class="fileupload fileupload-new" data-provides="fileupload">
                <div class="fileupload-new img-thumbnail" style="width: 180px; height: 120px;">

                   @if(!empty($record->store_logo))
                   <img src="{{ asset('public/images/store_logo/'.$record->store_logo)}}" alt="dd" />
                   @else
                   <img src="{{ asset('public/img/no-image.png')}}" alt="dd" />
                   @endif


               </div>
               <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 180px; max-height: 120px; line-height: 20px;"></div>
               <div class="row">
                   <div class="col-md-12">
                      <button type="button" class="btn btn-secondary" style="padding: 0px; background-color: #fff;"><span class="btn btn-default btn-file">
                        <span class="btn btn-secondary fileupload-new">Choose image</span>
                        <span  class="btn btn-secondary fileupload-exists">Change</span>

                        {{ Form::file('store_logo',null, ['class' => 'form-control']) }}</span>

                        <a class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a></button>

                    </div>

                </div>
            </div>
        </div>

    </div>

    --}}

    <div class="form-group col-md-8 ">
     <div class="form-group author-img-bx">

      <label>Store Cover Photo</label>             

      <div class="fileupload fileupload_second fileupload-new" data-provides="fileupload">
        <div class="fileupload-new img-thumbnail" style="width: 220px; height: 180px;">
          @if(!empty($record->store_cover_photo))
          <img src="{{ asset('public/images/store_cover_photo/'.$record->store_cover_photo)}}" alt="dd" />
          @else
          <img src="{{ asset('public/img/no-image.png')}}" alt="dd" />

          @endif
        </div>
        <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 220px; max-height: 180px; line-height: 20px;"></div>
        <div class="row">
         <div class="col-md-12">
          <button type="button" class="btn btn-secondary" style="padding: 0px; background-color: #fff;"><span class="btn btn-default btn-file">
            <span class="btn btn-secondary fileupload-new">Choose image</span>
            <span  class="btn btn-secondary fileupload-exists">Change</span>

            {{ Form::file('store_cover_photo',null, ['class' => 'form-control']) }}</span>

            <a class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a></button>

          </div>

        </div>
      </div>
    </div>

  </div>
</div>



</fieldset>


{{-- <fieldset class="scheduler-border">
    <legend class="scheduler-border">Store Bank Details &nbsp;:</legend>
    <div class="form-row">
     <div class="form-group col-md-4">
      <label for="inputPassword4">Prefered Payout Option</label>
      {!!Form::select('store_payout_option',['Paypal'=>'Paypal','Paytm'=>'Paytm','Bank Transfer'=>'Bank Transfer'],null,array('class'=>'form-control','placeholder'=>' Select payout option')) !!}
  </div>
  <div class="form-group col-md-4">
      <label for="inputPassword4">Paypal Email </label>
      {!!Form::text('store_paypal_email',null,array('class'=>'form-control emailfull','placeholder'=>'','autocomplete'=>'off')) !!} 
  </div>
  <div class="form-group col-md-4">
      <label for="inputPassword4">Paytm Mobile No (APPLICABLE ONLY IN INDIA)</label>
      {!!Form::text('store_paytm_mobile',null,array('class'=>'form-control paytm_mobile','placeholder'=>'','autocomplete'=>'off')) !!} 
  </div>
  <div class="form-group col-md-4">
      <label for="inputPassword4">Account Number</label>
      {!!Form::text('str_bank_account_no',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off')) !!} 
  </div>
  <div class="form-group col-md-4">
      <label for="inputPassword4">Account Name:</label>
      {!!Form::text('str_bank_account_name',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off')) !!} 
  </div>
  <div class="form-group col-md-4">
      <label for="inputPassword4">Bank Name:</label>
      {!!Form::text('str_bank_bank_name',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off')) !!} 
  </div>
  <div class="form-group col-md-4">
      <label for="inputPassword4">IFSC Code:</label>
      {!!Form::text('str_bank_ifsc_code',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off')) !!} 
  </div>
  <div class="form-group col-md-4">
      <label for="inputPassword4">Branch</label>
      {!!Form::text('str_bank_branch',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off')) !!} 
  </div>
  <div class="form-group col-md-4">
      <label for="inputPassword4">Branch Address:</label>
      {!!Form::text('str_bank_branch_addr',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off')) !!} 
  </div>
  <div class="form-group col-md-4">
      <label for="inputPassword4">Account Type</label>
      {!!Form::select('str_bank_account_type',['Saving'=>'Saving','Current'=>'Current','Bank Transfer'=>'Bank Transfer'],null,array('class'=>'form-control','placeholder'=>' Select payout option')) !!}

  </div>

</div>
</fieldset> --}}


{{-- 
<fieldset class="scheduler-border">
    <legend class="scheduler-border">Store Settings &nbsp;:</legend>
    <div class="form-row">
        <div class="form-group col-md-4">
          <label for="inputPassword4">Store Commission</label>
          {!!Form::select('store_commission_id',$commissions,null,array('class'=>'form-control','placeholder'=>'Select Commission')) !!}

      </div>
     

       <div class="form-group col-md-4">
                          <label for="inputPassword4">Store Open Time</label>
                          {!!Form::text('store_open_time',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','id'=>'store_open_time_id')) !!} 
                        </div>

                        <div class="form-group col-md-4">
                          <label for="inputPassword4">Store Close Time</label>
                            {!!Form::text('store_close_time',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','id'=>'store_close_time_id')) !!} 

                        </div>

      <div class="form-group col-md-4">
          <label for="inputPassword4">Email Order</label>
          {!!Form::select('store_email_option',['Yes'=>'Yes','No'=>'No'],null,array('class'=>'form-control','placeholder'=>'Select Plan')) !!}
      </div>
      <div class="form-group col-md-4">
          <label for="inputPassword4">SMS Option</label>
          {!!Form::select('store_sms_option',['Yes'=>'Yes','No'=>'No'],null,array('class'=>'form-control','placeholder'=>'Select Plan')) !!}
      </div>
      <div class="form-group col-md-4">
          <label for="inputPassword4">Stock Management</label>
          {!!Form::select('store_stock_management',['Able To Handle Stock Management'=>'Able To Handle Stock Management','Unable To Handle Stock Management'=>'Unable To Handle Stock Management'],null,array('class'=>'form-control','placeholder'=>'Select Plan')) !!}
      </div>
      <div class="form-group col-md-4">
          <label for="inputPassword4">Invoice Period</label>
          {!!Form::select('store_invoice_period',['15 Days'=>'15 Days','30 Days'=>'30 Days'],null,array('class'=>'form-control','placeholder'=>'Select Plan')) !!}
      </div>

  </div>
</fieldset> --}}

<button type="submit" class="btn btn-primary"><i class="far fa-edit"></i>  Update</button>



<a class="btn" href="{{url('admin/stores')}}" style="background-color: #9e9b9b;color: #fff"><i class="fas fa-times"></i>  Cancel</a>

{{Form::close()}}

</div>
<div class="card-body">
  <fieldset class="scheduler-border">
    <legend class="scheduler-border">Login Information &nbsp;:</legend>

    <div class="form-row">

     <div class="form-group col-md-4">
      <div class="row">
        <div class="col-md-4"><b>Store Mobile</b></div>
        <div class="col-md-1"><b>:</b></div>
        <div class="col-md-6">{{$users->mobile}} 
          {{-- <button type="button" class="btn btn-info">Change Mobile</button> --}}
        </div>
      </div>         
    </div>

    <div class="form-group col-md-4">
      <div class="row">
        <div class="col-md-3"><b>login Email</b></div>
        <div class="col-md-1"><b>:</b></div>
        <div class="col-md-7"> {{$users->email}}

          {{-- <button type="button" class="btn btn-info">Change Email</button> --}}
          @if(!$users->email_verified_at)
          {{-- <button type="button" class="btn btn-danger"  data-toggle="modal" data-target="#EmailVerifyAccount">Verify Now</button> --}}
          <i class="fas fa-times-circle" data-toggle="tooltip" data-placement="top" title="Not Verify" style="color: red;" ></i>

          @else
          {{-- <button type="button" class="badge badge-success" ><i class="fas fa-envelope"></i></button> --}}
          <i class="fa fa-check-square"  data-toggle="tooltip" data-placement="top" title="Verified" style="color: green;"></i>

          @endif
        </div>
      </div>         
    </div>
    <div class="form-group col-md-4">
      <div class="row">
        <div class="col-md-4"><b>Password</b></div>
        <div class="col-md-1"><b>:</b></div>
        <div class="col-md-6">{{$record->store_password}}
          {{-- <button type="button" class="btn btn-info">Change Password</button> --}}
        </div>
      </div>         
    </div>
  </div>
   {{-- @if($users->status=='Default')

@else
 <div class="form-row">
     <div class="form-group col-md-4">
          <label for="inputPassword4">Store Mobile</label>
           <div class="input-group ">
          {!!Form::text('store_mobile',str_replace(' ','',$record->store_mobile),array('class'=>'form-control numbersOnly','placeholder'=>'','autocomplete'=>'off','required','id'=>'mobile_id','minlength'=>'10' ,'maxlength'=>'10')) !!} 
            <input type="hidden" name="user_country_code" id="phone3" value="">
        </div>
      </div>


   <div class="form-group col-md-4">
      <label for="inputEmail4">Login Email</label>
      {!!Form::text('store_email',null,array('class'=>'form-control emailfull','placeholder'=>'','autocomplete'=>'off')) !!}


  </div>
  <div class="form-group col-md-4">
      <label for="inputEmail4">Password</label>

      <input id="password-field" type="password" class="form-control" value="{{$record->store_password}}">
      <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password" id="toggle-password"></span>


  </div>
</div>
@endif --}}
</fieldset>





</div>
</div>
</div>
</main>


@endsection

<!-- ................push new js link................. -->

@push('js')

<script src="{{asset('public/js/validation.js')}}"></script>



<script>
 document.addEventListener("DOMContentLoaded", function(event) {

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

    // alert('ddd')
    jQuery.validator.addMethod("mobile_country_code", function(value, element) {    
      var isSuccess = $("#phone3").val();
      console.log(isSuccess)
      if (isSuccess !='') {

        return true;
      }else{

        return false;
      }
// if(isSuccess.indexOf(+91) == 1){
// return true;

// }else if(isSuccess.indexOf(+1) == 1){
// return false;
// }
}, "Please enter the  valid number with country code");



    $('#seprate_form_id').validate({

     rules: {
      'store_email': {
        required: true,

        remote: {
          url: "{{url('check_user_name')}}",
          type: "post",

          data: {
            check_user_name_edit: function () {
              return $("input[name='store_email']").val();
            },user_id:{{$user_id}}
          },
          dataFilter: function (data) {
            console.log($.trim(data));
            if($.trim(data) == "exist"){
             return 'false';
           }else if($.trim(data) == "notexist"){
             return 'true';
           }
         }
       }
     },



     'store_mobile': {
      required: true,
      minlength:10,
      remote: {
        url: "{{url('check_store_owner_mobile')}}",
        type: "post",

        data: {
          check_store_owner_mobile_edit: function () {
            return $("input[name='store_mobile']").val();
          },user_id:{{$user_id}}
        },
        dataFilter: function (data) {
          console.log($.trim(data));
          if($.trim(data) == "exist"){
           return 'false';
         }else if($.trim(data) == "notexist"){
           return 'true';
         }
       }
     },

     mobile_country_code : true

   },

 },

 errorPlacement: function errorPlacement(error, element) {
  var $parent = $(element).parents('.form-group');
                    // Do not duplicate errors
                    if ($parent.find('.jquery-validation-error').length) {
                      return;
                    }
                    $parent.append(
                      error.addClass('jquery-validation-error small form-text invalid-feedback')
                      );
                  },
                  highlight: function(element) {
                    var $el = $(element);
                    var $parent = $el.parents('.form-group');
                    $el.addClass('is-invalid');
                    // Select2 and Tagsinput
                    if ($el.hasClass('select2-hidden-accessible') || $el.attr('data-role') === 'tagsinput') {
                      $el.parent().addClass('is-invalid');
                    }
                  },
                  unhighlight: function(element) {
                    $(element).parents('.form-group').find('.is-invalid').removeClass('is-invalid');
                  },
                     messages: {  // <-- you must declare messages inside of "messages" option


                     store_email:{
                      remote:"This email is already registered"                  
                    }   ,
                    store_mobile:{
                      remote:"This mobile no  is already registered" ,
                      minlength:"This field is required."                    
                    }
                  },


                });

  });
</script>

<script type="text/javascript" src="{{ asset('public/js/bootstrap-fileupload.min.js') }}"></script>
{{-- <script type="text/javascript" src="https://maps.google.com/maps/api/js?Key=aIzasybxM3cPfYpdG6yk3tv2YirFBltikYlza5a&sensor=false"></script> --}}
<script type="text/javascript" src=
"https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js">
</script>



<script src=
"https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js">
</script>
<script src="{{asset('public/basic-ckeditor/ckeditor.js')}}"></script>
<script>
  CKEDITOR.replace( 'store_description');
</script>


<script type="text/javascript">


  $('#store_open_time_id').datetimepicker({
    format: 'hh:mm a'
  });

  $('#store_close_time_id').datetimepicker({
    format: 'hh:mm a'
  });



  $(document).ready(function() {

    $('.selector').on('change', function() {
      var countryID = $(this).val();
      console.log(countryID);
            //console.log("myform/ajax/"+countryID);
            var data;
            if(countryID) {  
              $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });
              $.ajax({
                url: "{{url('admin/append_state')}}",
                type: "post",
                data: {id:countryID},
                dataType: "json",
                success:function(data) {
                  console.log(data);
                  $('select[name="store_state"]').empty();
                  $('select[name="store_city"]').empty();
                  $('select[name="store_locality"]').empty();
                  $('input[name="store_pincode"]').val('');                
                  $('select[name="store_state"]').append('<option value="'+''+'">'+'None'+'</option>');
                  $.each(data, function(key, value) { 
                    $('select[name="store_state"]').append('<option value="'+ key +'">'+value+'</option>');
                  });
                }

              });
            }
            else{
              $('select[name="store_state"]').empty();
              $('select[name="store_city"]').empty();
              $('select[name="store_locality"]').empty();
              $('select[name="store_pincode"]').empty();

            }

          });


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
          url: "{{url('admin/append_city')}}",
          type: "post",
          data: {id:stateID},
          dataType: "json",
          success:function(data) {
            console.log(data);
            $('select[name="store_city"]').empty();
            $('select[name="store_locality"]').empty();
            $('select[name="store_pincode"]').empty();

            $('select[name="store_city"]').append('<option value="'+''+'">'+'None'+'</option>');
            $.each(data, function(key, value) { 
              $('select[name="store_city"]').append('<option value="'+ key +'">'+value+'</option>');
            });
          }

        });
      }
      else{
       $('select[name="store_city"]').empty();
       $('select[name="store_locality"]').empty();
       $('select[name="store_pincode"]').empty();
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

            $('select[name="store_locality"]').empty();
            $('select[name="store_pincode"]').val(''); 

            $('select[name="store_locality"]').append('<option value="'+''+'">'+'None'+'</option>');
            $.each(data, function(key, value) { 
              $('select[name="store_locality"]').append('<option value="'+ key +'">'+value+'</option>');
            });
          }

        });
      }
      else{
        $('select[name="store_locality"]').empty();
        $('select[name="store_pincode"]').val(''); 
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
          url: "{{url('admin/append_pincode')}}",
          type: "post",
          data: {id:locality_id},
          dataType: "json",
          success:function(data) {
            console.log(data);
            $('input[name="store_pincode"]').val(data);

          }

        });
      }
      else{
        $('input[name="store_pincode"]').empty();
      }

    });




    $('.password_contact').on('click','.toggle-password', function(){
  // alert('ss')
  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));


  if (input.attr("type") == "password") {

    input.attr("type", "text");
  }
  else {
    input.attr("type", "password");

  }
});




  });


</script>


</script>


<div class="modal fade comman-modal" id="mainmapmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header no-modal-header">
       <h5>Select Longitude & Latitude</h5>
       <div class="close-btn">
        <i class="far fa-times-circle" data-dismiss="modal" aria-label="Close"></i>
      </div>
    </div>
    <div class="modal-body"  id="bodyofmapmodal">
     {{--  <div id="mapCanvas"></div>
      <div id="infoPanel">
        <b>Marker status:</b>
        <div id="markerStatus"><i>Click and drag the marker.</i></div>
        <b>Current position:</b>
        <div id="info"></div>
        <b>Closest matching address:</b>
        <div id="address"></div>
      </div> --}}
      <div id="map-canvas"></div>

      <div id="map-output"></div>

    </div>
    <div class="modal-footer">
     <button type="button"  class="btn btn-info confirm_address_set_field" data-dismiss="modal">Address Set</button >
     <button type="button" class="btn btn-raised btn-danger" data-dismiss="modal">Close</button>
   </div>
 </div>
</div>
</div>

<link rel="stylesheet" type="text/css" href="{{ asset('public/build/css/intlTelInput.css') }}">


<script type="text/javascript" src="{{ asset('public/build/js/intlTelInput.js') }}"></script>


<script>


  var input = document.querySelector("#mobile_id");
  var iti = window.intlTelInputGlobals.getInstance(input);


  window.intlTelInput(input, {
    allowDropdown: true,

    autoHideDialCode: false,
    autoPlaceholder: "off",
// dropdownContainer: document.body,
// excludeCountries: ["us"],
// formatondIsPlay: true,
// geoIpLookup: function(callback) {
//   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
//     var countryCode = (resp && resp.country) ? resp.country : "";
//     callback(countryCode);
//   });
// },
// hiddenInput: "full_number",
// initialCountry: "auto",
// localizedCountries: { 'de': 'Deutschland' },
nationalMode: false,
// onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
// placeholderNumberType: "MOBILE",
preferredCountries: ['in'],
separateDialCode: true,

utilsScript: "{{asset('public/build/js/utils.js')}}",

});

// ................................errorMsg

var iti = window.intlTelInputGlobals.getInstance(input);
var countryData = iti.getSelectedCountryData();
$("#phone3").val(countryData.dialCode)


input.addEventListener("countrychange", function() {

  var countryData = iti.getSelectedCountryData();

  $("#phone3").val(countryData.dialCode)

});
</script>

<script type="text/javascript">

  $(function () {

    $('.password_contact .basemap').on('change', maping_address)

    maping_address(); 

  });



  function maping_address() {


    var store_country=$('select[name="store_country"]').select2('data');
    var store_state=$('select[name="store_state"]').select2('data');
    var store_city=$('select[name="store_city"]').select2('data');
    var store_locality= $('select[name="store_locality"]').select2('data');
    var store_pincode= $('input[name="store_pincode"]').val(); 

// $("#search-txt").val('');

// console.log(store_country[0].text,'store_country')
// console.log(store_state[0].text,'store_state')
// console.log(store_city[0].text,'store_city')
// console.log(store_locality[0].text,'store_locality')
// console.log(store_pincode[0].text,'store_pincode')

var final=store_locality[0].text+', '+store_city[0].text+', '+store_state[0].text+' '+store_pincode+', '+store_country[0].text;

console.log(final,'final')

$("#search-txt").val(final);

loadmap(final); 


}

function loadmap(final) {

        // alert(final)
      // initialize map
      var map = new google.maps.Map(document.getElementById("map-canvas"), {
        center: new google.maps.LatLng($('#latitude').val(), $('#langitude').val()),
        zoom: 13,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      });
      // initialize marker
      var marker = new google.maps.Marker({
        position: map.getCenter(),
        draggable: true,
        map: map
      });
      // intercept map and marker movements
      google.maps.event.addListener(map, "idle", function() {
        marker.setPosition(map.getCenter());
        document.getElementById("map-output").innerHTML = "Latitude:  " + map.getCenter().lat().toFixed(6) + "<br>Longitude: " + map.getCenter().lng().toFixed(6) + "<a href='https://www.google.com/maps?q=" + encodeURIComponent(map.getCenter().toUrlValue()) + "' target='_blank'>Go to maps.google.com</a>";


        $('#latitude').val( map.getCenter().lat().toFixed(6));
        $('#langitude').val(map.getCenter().lng().toFixed(6));


      });
      google.maps.event.addListener(marker, "dragend", function(mapEvent) {
        map.panTo(mapEvent.latLng);
      });
      // initialize geocoder
      var geocoder = new google.maps.Geocoder();

      google.maps.event.addDomListener(document.getElementById("search-btn"), "click", function() {

        // alert(1)
        geocoder.geocode({ address: document.getElementById("search-txt").value }, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
            var result = results[0];
            document.getElementById("shopaddress").value = result.formatted_address;
            if (result.geometry.viewport) {
              map.fitBounds(result.geometry.viewport);
            } else {
              map.setCenter(result.geometry.location);
            }
          } else if (status == google.maps.GeocoderStatus.ZERO_RESULTS) {
            alert("Sorry, geocoder API failed to locate the address.");
          } else {
            alert("Sorry, geocoder API failed with an error.");
          }
        });
      });
      google.maps.event.addDomListener(document.getElementById("search-txt"), "change", function(domEvent) {
        if (domEvent.which === 13 || domEvent.keyCode === 13) {
          google.maps.event.trigger(document.getElementById("search-btn"), "click");
        }
      });
      // initialize geolocation
      if (navigator.geolocation) {
        google.maps.event.addDomListener(document.getElementById("detect-btn"), "click", function() {
          navigator.geolocation.getCurrentPosition(function(position) {
            map.setCenter(new google.maps.LatLng(position.coords.latitude, position.coords.longitude));
          }, function() {
            alert("Sorry, geolocation API failed to detect your location.");
          });
        });
        document.getElementById("detect-btn").disabled = false;
      }
    }

  </script>

  <script src="//maps.googleapis.com/maps/api/js?v=3&amp;sensor=false&amp;key=AIzaSyBxm3cpfYPdG6Yk3Tv2yIrfBLtiKYlza5A&amp;callback=loadmap" defer></script>
  @endpush