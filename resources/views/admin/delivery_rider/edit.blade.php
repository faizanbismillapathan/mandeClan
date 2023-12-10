@extends('admin.layouts.app')
@section('title',"Update New Delivery Rider | Admin Mande Clan")

<!-- ................custom css................. -->

@section('customStyle')

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
      <a href="{{url('admin/delivery-rider')}}" class="form-inline float-right mt--1 d-none d-md-flex">
        <button class="btn btn-info"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Back</button>
      </a>

      <h1 class="h3 mb-3"><b>Update Rider</b></h1>

    </div>
    <div class="card">

      <div class="card-body">

       


      <div class="card">
          <div class="card-body">
            <h4>Selected Vendor Information</h4>
            <hr>


            <div class="form-row">

             <div class="form-group col-md-4">
              <div class="row">
                <div class="col-md-4"><b>Created Date</b></div>
                <div class="col-md-1"><b>:</b></div>
                <div class="col-md-6">{{date("d-m-Y", strtotime($record->created_at))}}</div>
              </div>         
            </div>

            <div class="form-group col-md-4">
              <div class="row">
                <div class="col-md-4"><b>UserID</b></div>
                <div class="col-md-1"><b>:</b></div>
                <div class="col-md-6">{{$record->rv_user_userid}}</div>
              </div>         
            </div>

            <div class="form-group col-md-4">
              <div class="row">
                <div class="col-md-4"><b>Name</b></div>
                <div class="col-md-1"><b>:</b></div>
                <div class="col-md-6">{{$record->rv_user_name}}</div>
              </div>         
            </div>
            <div class="form-group col-md-4">
              <div class="row">
                <div class="col-md-4"><b>Email</b></div>
                <div class="col-md-1"><b>:</b></div>
                <div class="col-md-6">{{$record->rv_user_email}}</div>
              </div>         
            </div>
            <div class="form-group col-md-4">
              <div class="row">
                <div class="col-md-4"><b>Mobile</b></div>
                <div class="col-md-1"><b>:</b></div>
                <div class="col-md-6">{{$record->rv_user_mobile}}</div>
              </div>         
            </div>
            <div class="form-group col-md-4">
              <div class="row">
                <div class="col-md-4"><b>Phone</b></div>
                <div class="col-md-1"><b>:</b></div>
                <div class="col-md-6">{{$record->rv_user_phone}}</div>
              </div>         
            </div>
            <div class="form-group col-md-4">
              <div class="row">
                <div class="col-md-4"><b>Qualification</b></div>
                <div class="col-md-1"><b>:</b></div>
                <div class="col-md-6">{{$record->rv_user_qulification}}</div>
              </div>         
            </div>

     

            <div class="form-group col-md-4">
              <div class="row">
                <div class="col-md-4"><b>Created By</b></div>
                <div class="col-md-1"><b>:</b></div>
                <div class="col-md-6">{{$record->created_by}}</div>
              </div>         
            </div>

            <div class="form-group col-md-4">
              <div class="row">
                <div class="col-md-4"><b>DOB</b></div>
                <div class="col-md-1"><b>:</b></div>
                <div class="col-md-6">{{$record->rv_user_dob}}</div>
              </div>         
            </div>

            <div class="form-group col-md-4">
              <div class="row">
                <div class="col-md-4"><b>Gender</b></div>
                <div class="col-md-1"><b>:</b></div>
                <div class="col-md-6">{{$record->rv_user_gender}}</div>
              </div>         
            </div>


            <div class="form-group col-md-4">
              <div class="row">
                <div class="col-md-4"><b>Country</b></div>
                <div class="col-md-1"><b>:</b></div>
                <div class="col-md-6">{{$record->country_name}}</div>
              </div>         
            </div>
            <div class="form-group col-md-4">
              <div class="row">
                <div class="col-md-4"><b>State</b></div>
                <div class="col-md-1"><b>:</b></div>
                <div class="col-md-6">{{$record->state_name}}</div>
              </div>         
            </div>
            <div class="form-group col-md-4">
              <div class="row">
                <div class="col-md-4"><b>City</b></div>
                <div class="col-md-1"><b>:</b></div>
                <div class="col-md-6">{{$record->city_name}}</div>
              </div>         
            </div>
            <div class="form-group col-md-4">
              <div class="row">
                <div class="col-md-4"><b>Locality</b></div>
                <div class="col-md-1"><b>:</b></div>
                <div class="col-md-6">{{$record->locality_name}}</div>
              </div>         
            </div>
            <div class="form-group col-md-4">
              <div class="row">
                <div class="col-md-4"><b>Address</b></div>
                <div class="col-md-1"><b>:</b></div>
                <div class="col-md-6">{{$record->rv_user_address}}</div>
              </div>         
            </div>
            <div class="form-group col-md-4">
              <div class="row">
                <div class="col-md-4"><b>Pin Code/Zip Code</b></div>
                <div class="col-md-1"><b>:</b></div>
                <div class="col-md-6">{{$record->rv_user_pincode}}</div>
              </div>         
            </div>
            <div class="form-group col-md-4">
              <div class="row">
                <div class="col-md-4"><b>Login Email</b></div>
                <div class="col-md-1"><b>:</b></div>
                <div class="col-md-6">{{$record->rv_user_login_email}}</div>
              </div>         
            </div>
            <div class="form-group col-md-4">
              <div class="row">
                <div class="col-md-4"><b>Password</b></div>
                <div class="col-md-1"><b>:</b></div>
                <div class="col-md-6">{{$record->rv_user_password}}</div>
              </div>         
            </div>


            <div class="form-group col-md-4">
              <div class="row">
                <div class="col-md-4"><b>Profile Img</b></div>
                <div class="col-md-1"><b>:</b></div>
                <div class="col-md-6" style="margin-top:-20px"><img src="{{asset('public/images/delivery_img/'.$record->rv_user_img)}}" width="80px" height="80px"></div>
              </div>         
            </div>
          
          </div>

       {!! Form::model($record,array('url' => ['admin/delivery-rider', $record->id],'method'=>'PATCH','class'=>'','id' =>'comman_form_id','files'=>'true')) !!}

<div class="row">
  <div class="form-group col-md-4">
       <label for="inputEmail4">Select License Type</label>

  {!!Form::select('driving_license_type[]',$license_type,explode(',',$record->driving_license_type),array('class'=>'form-control select2','data-toggle'=>'select2','multiple','required')) !!}

</div>
  <div class="form-group col-md-4">
       <label for="inputEmail4">Enter Driving License No</label>
{!!Form::text('rider_driving_license_no',null,array('class'=>'form-control','placeholder'=>'Enter Search Keyword','autocomplete'=>'off','required')) !!}
  </div>

<div class="form-group col-md-4">
       <label for="inputEmail4">Enter Driving Expiry Date</label>

        {!!Form::text('rider_driving_expiry_date',null,array('class'=>'datepicker-here form-control createddateformat','placeholder'=>'Enter Role','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd','data-language'=>'en','required')) !!} 
  </div>


  <div class="form-group col-md-4">
       <label for="inputEmail4">Select Rider Plan</label>

  {!!Form::select('rider_plan_id[]',$rider_plans,null,array('class'=>'form-control select2','data-toggle'=>'select2','required')) !!}

</div>


<div class="form-group col-md-4 ">
             <div class="form-group author-img-bx">

<label>License Front Photo</label>             
   
    <div class="fileupload fileupload-new" data-provides="fileupload">
            <div class="fileupload-new img-thumbnail" style="width: 180px; height: 120px;">
              @if($record->rider_license_front_img)
               <img src="{{ asset('public/images/delivery_img/'.$record->rider_license_front_img)}}" alt="dd" />
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

                {{ Form::file('rider_license_front_img',null, ['class' => 'form-control','required']) }}</span>

                <a class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a></button>

              </div>

            </div>
          </div>
                 </div>
          
</div>



<div class="form-group col-md-4 ">
   <div class="form-group author-img-bx">
<label>License Back Photo</label>             
   
    
    <div class="fileupload fileupload-new" data-provides="fileupload">
            <div class="fileupload-new img-thumbnail" style="width: 180px; height: 120px;">
                @if($record->rider_license_back_img)
               <img src="{{ asset('public/images/delivery_img/'.$record->rider_license_back_img)}}" alt="dd" />
              @else
             <img src="{{ asset('public/img/no-image.png')}}" alt="dd" />
             @endif

             <!-- <img src="{{ asset('public/img/no-image.png')}}" alt="dd" /> -->
           </div>
           <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 180px; max-height: 120px; line-height: 20px;"></div>
           <div class="row">
             <div class="col-md-12">
              <button type="button" class="btn btn-secondary" style="padding: 0px; background-color: #fff;"><span class="btn btn-default btn-file">
                <span class="btn btn-secondary fileupload-new">Choose image</span>
                <span  class="btn btn-secondary fileupload-exists">Change</span>

                {{ Form::file('rider_license_back_img',null, ['class' => 'form-control','required']) }}</span>

                <a class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a></button>

              </div>

            </div>
          </div>
                 </div>
          
</div>
</div>

          <input type="hidden" name="id" value="{{$record->id}}">

          <button type="submit" class="btn btn-primary"><i class="far fa-edit"></i>  Update</button>
          <a class="btn" href="{{url('admin/delivery-rider')}}" style="background-color: #9e9b9b;color: #fff"><i class="fas fa-times"></i>  Cancel</a>


          {{Form::close()}}

        </div>
      </div>

    

  </div>
</div>
</div>
</main>
@endsection

<!-- ................push new js link................. -->

@push('js')

<script type="text/javascript" src="{{ asset('public/js/bootstrap-fileupload.min.js') }}"></script>

@endpush