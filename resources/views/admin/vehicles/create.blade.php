@extends('admin.layouts.app')
@section('title',"Create New Vehicle | Admin Mande Clan")

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
      <a href="{{url('admin/vehicles')}}" class="form-inline float-right mt--1 d-none d-md-flex">
        <button class="btn btn-info"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Back</button>
      </a>

      <h1 class="h3 mb-3"><b>Create Vehicle</b></h1>

    </div>
    <div class="card">

      <div class="card-body">

        {{Form::open(['url'=>['admin/vehicles/create'],'method'=>'GET'])}}

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

            <div class="form-group col-md-4">
              <div class="row">
                <div class="col-md-4"><b>Created</b></div>
                <div class="col-md-1"><b>:</b></div>
                <div class="col-md-6">{{$record->deposit_amount}}</div>
              </div>         
            </div>

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
                <div class="col-md-6">{{$record->rv_user_country}}</div>
              </div>         
            </div>
            <div class="form-group col-md-4">
              <div class="row">
                <div class="col-md-4"><b>State</b></div>
                <div class="col-md-1"><b>:</b></div>
                <div class="col-md-6">{{$record->rv_user_state}}</div>
              </div>         
            </div>
            <div class="form-group col-md-4">
              <div class="row">
                <div class="col-md-4"><b>City</b></div>
                <div class="col-md-1"><b>:</b></div>
                <div class="col-md-6">{{$record->rv_user_city}}</div>
              </div>         
            </div>
            <div class="form-group col-md-4">
              <div class="row">
                <div class="col-md-4"><b>Locality</b></div>
                <div class="col-md-1"><b>:</b></div>
                <div class="col-md-6">{{$record->rv_user_locality}}</div>
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
                <div class="col-md-4"><b>Created</b></div>
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
            <div class="form-group col-md-4">
              <div class="row">
                <div class="col-md-4"><b>Marksheet</b></div>
                <div class="col-md-1"><b>:</b></div>
                <div class="col-md-6" style="margin-top:-20px"><img src="{{asset('public/images/delivery_img/'.$record->rv_user_marksheet)}}" width="80px" height="80px"></div>
              </div>         
            </div>




          </div>

        
          <button type="button" class="btn btn-primary add_new_vehcle" id="add">Add New Vehicle</button>

          <button type="button" class="btn btn-danger add_new_vehcle" id="remove" style="display:none">Hide Vehicle Form</button>

          <!-- <a class="btn" href="{{url('admin/vehicles')}}" style="background-color: #9e9b9b;color: #fff"><i class="fas fa-times"></i>  Cancel</a> -->

<hr>

<div class="vehicle_form" style="display:none;" > 

  {!!Form::open(['url'=>['admin/vehicles'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}

          <input type="hidden" name="id" value="{{$record->id}}">

      <div class="form-row" >
        <div class="form-group col-md-4">
          <label for="inputEmail4">Select Type of Vehicle</label>                                                   
          {!!Form::select('vehicle_type',$vehicle_names,null,array('class'=>'form-control select2','placeholder'=>'Select State','id'=>'','data-toggle'=>'select2','autocomplete'=>'off','required')) !!}
        </div>


        <div class="form-group col-md-4">
          <label for="inputEmail4">Vehicle No</label>                                                   
          {!!Form::text('vehicle_no',null,array('class'=>'form-control','placeholder'=>'Enter Vehicle No','autocomplete'=>'off','required')) !!} 
        </div>

        <div class="form-group col-md-4">
          <label for="inputEmail4">Vehicle Modal no</label>                                                   
          {!!Form::text('vehicle_modal_no',null,array('class'=>'form-control','placeholder'=>'Enter Modal no','autocomplete'=>'off','required')) !!} 
        </div>

        <div class="form-group col-md-4">
          <label for="inputEmail4">Vehicle Registered No</label>                                                   
          {!!Form::text('vehicle_registered_no',null,array('class'=>'form-control','placeholder'=>'Enter Registered No','autocomplete'=>'off','required')) !!} 
        </div>

        <div class="form-group col-md-4">
          <label for="inputEmail4">Vehicle Registered Year</label>                        
              {!!Form::text('vehicle_registered_year',null,array('class'=>'form-control','placeholder'=>'YYYY','autocomplete'=>'off','required','data-mask'=>'0000')) !!} 
                           
        </div>



  <div class="form-group col-md-4">
    <label for="inputEmail4">Vehicle Insurance </label>                                                   
    {{ Form::file('vehicle_insurance_file',null, ['class' => 'form-control','required','accept'=>"image/*"]) }}
  </div>

  <div class="form-group col-md-4">
    <label for="inputEmail4">Insurance Expiry Date</label>                   {!!Form::text('insurance_expiry_date',null,array('class'=>'datepicker-here form-control createddateformat','placeholder'=>'Enter Role','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd','data-language'=>'en','required')) !!} 
</div>
  <div class="form-group col-md-4">
    <label for="inputEmail4">RC BOOk Image</label>                                                   
    {{ Form::file('vehicle_rc_book_img',null, ['class' => 'form-control','required','accept'=>"image/*"]) }}
  </div>

  <div class="form-group col-md-4">
    <label for="inputEmail4">Enter Rc No</label>                                                   
    {!!Form::text('vehicle_rc_no',null,array('class'=>'form-control','placeholder'=>'Enter Rc No','autocomplete'=>'off','required')) !!} 
  </div>


  <div class="form-group col-md-4">
    <label for="inputEmail4"> Select Plan</label>                                                   
    {!!Form::select('vehicle_package',$package_names,null,array('class'=>'form-control select2','placeholder'=>'Select State','id'=>'','data-toggle'=>'select2','autocomplete'=>'off','required')) !!}
  </div>

  <div class="form-group col-md-4">
    <label for="inputEmail4"> Select Plan For</label>                                                   
    {!!Form::select('vehicle_package_for',['Hourly'=>'Hourly','Daily'=>'Daily','Weekly'=>'Weekly','Monthly'=>'Monthly'],null,array('class'=>'form-control select2','placeholder'=>'Select State','id'=>'','data-toggle'=>'select2','autocomplete'=>'off','required')) !!}
  </div>


  <div class="form-group col-md-4">
    <label for="inputEmail4">Select Location</label>                                                   
    {!!Form::select('vehicle_driving_location',$locations,null,array('class'=>'form-control select2','placeholder'=>'Select State','id'=>'','data-toggle'=>'select2','autocomplete'=>'off','required')) !!}
  </div>
<!-- 
  <div class="form-group col-md-4">
  </div> -->

 <div class="form-group col-md-4 ">
         <div class="form-group author-img-bx">

          <label>Fronte Vehicle Image</label>             

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

                {{ Form::file('vehicle_front_img',null, ['class' => 'form-control','required']) }}</span>

                <a class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a></button>

              </div>

            </div>
          </div>
        </div>

      </div>



      <div class="form-group col-md-4 ">
       <div class="form-group author-img-bx">

        <label>Back Vehicle Image</label>             

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

              {{ Form::file('vehicle_back_img',null, ['class' => 'form-control','required']) }}</span>

              <a class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a></button>

            </div>

          </div>
        </div>
      </div>

    </div>




    <div class="form-group col-md-4 ">
     <div class="form-group author-img-bx">

      <label>Side Vehicle Image</label>             

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

            {{ Form::file('vehicle_side_img',null, ['class' => 'form-control','required']) }}</span>

            <a class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a></button>

          </div>

        </div>
      </div>
    </div>

  </div>


</div>
<button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i>   Submit</button>

  
</div>
<hr>


  <table class="table table-striped table-hover table-sm table-bordered" >
    <thead>
        <tr>
            <th width="3%">Sr.</th>
            <th width="10%">Date</th>
            <th width="10%">User Id</th>
            <th width="12%">Vehicle Type</th>
            <th width="12%">Vehicle No</th>
            <th width="12%">Vehicle Modal No</th>
            <th width="12%">Vehicle Id</th>
            <th width="10%">Insurence Expiry</th>
            <th width="10%">Plan Name</th>
            <th width="10%">Status</th> 
            <th width="15%">Action</th>                         
        </tr>
    </thead>
    <tbody>


        @if(!empty($records))
        @foreach($records as $index => $data)
        <tr class="deleteRow">
            <td>{{$index+1}}</td>   
            <td>{{date("d-m-Y", strtotime($data->created_at))}}</td>
            <td>{{$data->vehicle_userid}}</td>

            <td style="color: #e91e63;text-decoration :underline; " data-toggle="tooltip" data-placement="top" title="Go to Vehicle Panel" class=" clickable-row" data-href="{{ URL::to('vehicle/dashboard/'.$data->id) }}" data-underline>  {{$data->vehicle_type}}</td>

            <td>{{$data->vehicle_no}}</td>
            <td>{{$data->vehicle_modal_no}}</td>
            <td>{{$data->vehicle_unique_id}}</td>
            <td>{{$data->insurance_expiry_date}}</td>

            <td>{{$data->vehicle_package}}</td>
            <td>

             @if($data->status ==  'Active')

             <input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="Deactive" data-onstyle="success" data-offstyle="danger" id="{{$data->id}}" class="checkstatus" onchange="updateToggle1({{$data->id}})">
             @elseif($data->status ==  'Deactive')
             <input type="checkbox" data-toggle="toggle" data-on="Active" data-off="Deactive" data-onstyle="success" data-offstyle="danger" id="{{$data->id}}" class="checkstatus" onchange="updateToggle1({{$data->id}})">
             @endif

         </td>
         <td>                                                    
            <a href="{{ URL::to('admin/vehicles/'.$data->id.'/edit') }}"><button class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></button></a>
            
            <button class="btn btn-danger click_disbled"  data-toggle="tooltip" data-placement="top" title="Delete"  data="{{$data->id}}"><i class="fas fa-trash-alt"></i></button>                                 
        </td>
    </tr>
    @endforeach
    @endif
    
</tbody>
</table>


</div>


        </div>
        


<a class="btn" href="{{url('admin/vehicles')}}" style="background-color: #9e9b9b;color: #fff"><i class="fas fa-times"></i>  Cancel</a>

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
      <button class="btn btn-success">Create New Vehicle</button>

    </a>
  </div>
</div>
@endif
</div>
</div>
</div>
</main>
@endsection

<!-- ................push new js link................. -->

@push('js')
<script src="{{asset('public/js/comman.js')}}"></script>

 <script src="{{asset('public/js/validation.js')}}"></script>
   <script type="text/javascript" src="{{ asset('public/js/bootstrap-fileupload.min.js') }}"></script>

<script type="text/javascript">


 function updateToggle1(userid) {
    // alert(userid)

 var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');


       $.ajax({
           type:"post",
           // url:window.location.origin+window.location.pathname+"/status_update",
         url:"{{url('admin/vehicles/status_update')}}",

           data:{_token: CSRF_TOKEN, user_id:userid},
           dataType:'JSON',
           dataType: 'json',
           success:function(res){ 

  var data= "your status is "+res;       


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
        $('.add_new_vehcle').on('click', function() {
$('.vehicle_form').toggle()
$('#add').toggle()
$('#remove').toggle()



      });

  
 });
</script>

@endpush