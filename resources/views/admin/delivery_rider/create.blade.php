@extends('admin.layouts.app')
@section('title',"Create New Delivery Rider | Admin Mande Clan")

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

      <h1 class="h3 mb-3"><b>Create Rider</b></h1>

    </div>
    <div class="card">

      <div class="card-body">

        {{Form::open(['url'=>['admin/delivery-rider/create'],'method'=>'GET'])}}

        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="inputEmail4">Search By UserID</label>                                                   
            {!!Form::text('search',Request::input('search'),array('class'=>'form-control','placeholder'=>'Enter User Id','autocomplete'=>'off','required')) !!} 
          </div>
          <div class="col-md-2" style="margin-top:30px">
            <button type="submit" class="btn btn-primary">Search</button>
          </div>
        </div>

        {{Form::close()}}


        @if(!empty($record))

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

       <!--      <div class="form-group col-md-4">
              <div class="row">
                <div class="col-md-4"><b>Deposit Amount</b></div>
                <div class="col-md-1"><b>:</b></div>
                <div class="col-md-6">{{$record->deposit_amount}}</div>
              </div>         
            </div>
 -->
            <div class="form-group col-md-4">
              <div class="row">
                <div class="col-md-4"><b>Role</b></div>
                <div class="col-md-1"><b>:</b></div>
                <div class="col-md-6">{{$record->rv_user_type}}</div>
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
            <!-- <div class="form-group col-md-4">
              <div class="row">
                <div class="col-md-4"><b>Marksheet</b></div>
                <div class="col-md-1"><b>:</b></div>
                <div class="col-md-6" style="margin-top:-20px"><img src="{{asset('public/images/delivery_img/'.$record->rv_user_marksheet)}}" width="80px" height="80px"></div>
              </div>         
            </div> -->




          </div>

          {!!Form::open(['url'=>['admin/delivery-rider'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}
<div class="row">
  <div class="form-group col-md-4">
       <label for="inputEmail4">Select License Type</label>

         {!!Form::select('driving_license_type[]',$license_type,null,array('class'=>'form-control select2','data-toggle'=>'select2','multiple','required')) !!}

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
@if(!empty($record->driving_license_type))
  {!!Form::select('rider_plan_id',$rider_plans,explode(',',$record->driving_license_type),array('class'=>'form-control select2','data-toggle'=>'select2','required')) !!}
@else
  {!!Form::select('rider_plan_id',$rider_plans,null,array('class'=>'form-control select2','data-toggle'=>'select2','required')) !!}

@endif
</div>


<div class="form-group col-md-4 ">
             <div class="form-group author-img-bx">

<label>License Front Photo</label>             
   
    <div class="fileupload fileupload-new" data-provides="fileupload">
            <div class="fileupload-new img-thumbnail" style="width: 180px; height: 120px;">
             <img src="{{ asset('public/img/no-image.png')}}" alt="dd" />
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
             <img src="{{ asset('public/img/no-image.png')}}" alt="dd" />
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

          <button type="submit" class="btn btn-primary">Create</button>
          <a class="btn" href="{{url('admin/delivery-rider')}}" style="background-color: #9e9b9b;color: #fff"><i class="fas fa-times"></i>  Cancel</a>


          {{Form::close()}}

        </div>
      </div>

       <!-- <table class="table table-striped table-hover table-sm table-bordered" >
        <thead>
          <tr>
            <th width="20%">File Type</th>
            <th width="20%"> Registration No</th>
            <th width="20%">Attach Image</th>
            <th width="15%">Action</th>                         
          </tr>
        </thead>
        <tbody class="input_fields_wrap">


          <tr class="deleteRow">
            <td>{!!Form::select('state_id[]',$documents,null,array('class'=>'form-control select2','placeholder'=>'Select State','id'=>'','data-toggle'=>'select2','autocomplete'=>'off','required')) !!}</td>   
            <td>{!!Form::text('photo_keyword[]',null,array('class'=>'form-control','placeholder'=>'Enter Search Keyword','autocomplete'=>'off')) !!}</td>
            <td>   {{ Form::file('store_logo[]',null, ['class' => 'form-control','required']) }}</td>
            <td><button class="btn btn-success add_field_button" data="" title="Add" data=""><i class="fas fa-plus"></i></button></td>

        </tr>


      </tbody>
    </table> -->
    @elseif(!empty($new_msg))
     <div class="card">
        <div class="card-body center">
          <h4>{{$new_msg}}</h4>

          <a href="{{url('admin/rider-vehicle-info')}}">
            <button class="btn btn-success">Go Back</button>

          </a>
        </div>
      </div>

      @else
      <div class="card">
        <div class="card-body center">
          <h4>No matching Records Found</h4>

          <a href="{{url('admin/rider-vehicle-info/create')}}">
            <button class="btn btn-success">Create New Rider</button>

          </a>
        </div>
      </div>
      @endif

<!-- 
<div class=" input_fields_wrap">
<div class="row">
<div class="col-md-3" style="padding-top: 10px">
 {!!Form::select('state_id[]',$documents,null,array('class'=>'form-control select2','placeholder'=>'Select State','id'=>'','data-toggle'=>'select2','autocomplete'=>'off','required')) !!}</div>


<div class="col-md-3" style="padding-top: 10px">
{!!Form::text('photo_keyword[]',null,array('class'=>'form-control','placeholder'=>'Enter Search Keyword','autocomplete'=>'off')) !!}
</div>


<div class="col-md-3" style="padding-top: 10px">
        {{ Form::file('store_logo[]',null, ['class' => 'form-control','required']) }}
</div>



<div class="col-md-2" style="padding-top: 10px;padding-left: 0;">
<button class="btn btn-success add_field_button" data="" title="Add" data=""><i class="fas fa-plus"></i></button>
</div>  
</div>
</div> -->
      <!-- <table class="table table-striped table-hover table-sm table-bordered" >
        <thead>
          <tr>
            <th width="20%">File Type</th>
            <th width="20%"> Registration No</th>
            <th width="20%">Attach Image</th>
            <th width="15%">Action</th>                         
          </tr>
        </thead>
        <tbody class="input_fields_wrap">


          <tr class="deleteRow">
            <td>{!!Form::select('state_id[]',$documents,null,array('class'=>'form-control select2','placeholder'=>'Select State','id'=>'','data-toggle'=>'select2','autocomplete'=>'off','required')) !!}</td>   
            <td>{!!Form::text('photo_keyword[]',null,array('class'=>'form-control','placeholder'=>'Enter Search Keyword','autocomplete'=>'off')) !!}</td>
            <td>   {{ Form::file('store_logo[]',null, ['class' => 'form-control','required']) }}</td>
            <td><button class="btn btn-success add_field_button" data="" title="Add" data=""><i class="fas fa-plus"></i></button></td>

        </tr>


      </tbody>
    </table>
 -->

  </div>
</div>
</div>
</main>
@endsection

<!-- ................push new js link................. -->

@push('js')

<script type="text/javascript" src="{{ asset('public/js/bootstrap-fileupload.min.js') }}"></script>

<script>
  $(document).ready(function() {
  var max_fields      = 10; //maximum input boxes allowed
  var wrapper       = $(".input_fields_wrap"); //Fields wrapper
  var add_button      = $(".add_field_button"); //Add button ID
  
  var x = 1; //initlal text box count
  $(add_button).click(function(e){ //on add input button click
    e.preventDefault();
    if(x < max_fields){ //max input box allowed
      x++; //text box increment
      // $(wrapper).prepend('<div class="row"><div class="col-md-3" style="padding-top: 10px"> {!!Form::select("state_id[]",["Adhar cart"=>"Adhar cart"],null,array("class"=>"form-control select2","placeholder"=>"Select State","id"=>"","data-toggle"=>"select2","autocomplete"=>"off","required")) !!}</div><div class="col-md-3" style="padding-top: 10px">{!!Form::text("photo_keyword[]",null,array("class"=>"form-control","placeholder"=>"Enter Search Keyword","autocomplete"=>"off")) !!}</div><div class="col-md-3" style="padding-top: 10px"> {{ Form::file("store_logo[]",null, ["class" => "form-control","required"]) }}</div><div class="col-md-2"><div  style="margin-top:10px" class="btn btn-danger remove_field" title="Remove"  data=""><i class="fas fa-minus"></i></div></div></div>'); //add input box

$(wrapper).prepend('<tr class="deleteRow"><td>{!!Form::select("state_id[]",$documents,null,array("class"=>"form-control select2","placeholder"=>"Select State","id"=>"","data-toggle"=>"select2","autocomplete"=>"off","required")) !!}</td> <td>{!!Form::text("photo_keyword[]",null,array("class"=>"form-control","placeholder"=>"Enter Search Keyword","autocomplete"=>"off")) !!}</td><td>   {{ Form::file("store_logo[]",null, ["class" => "form-control","required"]) }}</td>  <td><div  style="margin-top:10px" class="btn btn-danger remove_field" title="Remove"  data=""><i class="fas fa-minus"></i></div></td> </tr>'); //add input box

    }
  });
  
  $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
    e.preventDefault(); $(this).parent().parent().remove() ;$(this).parent('div').remove(); x--;
  })
});
</script>

@endpush