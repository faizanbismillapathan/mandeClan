@extends('admin.layouts.app')
@section('title',"Admin Bank Details | Admin Mande Clan")

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
      <h1 class="h3 mb-3"> Admin Bank Details
      </h1>
    </div>

    <div class="card">
      <div class="card-body">

        
  @if(!empty($bank_detail))
  {!! Form::model($bank_detail,array('url' => ['admin/bank_details', $bank_detail->id],'method'=>'PATCH','class'=>'','id' =>'comman_form_id','files'=>'true')) !!}
  @else
  {!!Form::open(['url'=>['admin/bank_details'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}

  @endif


     <div class="form-row">
      <div class="form-group col-md-4 ">                        
       <label>
        Bank Name <span class="text-red">*</span>
      </label>
         {!!Form::text('bankname',null,array('class'=>'form-control','placeholder'=>'Enter bank name','autocomplete'=>'off','required')) !!} 
    </div>

    <div class="form-group col-md-4 ">                        
      <label>
        Branch Name <span class="text-red">*</span>
      </label>

         {!!Form::text('branchname',null,array('class'=>'form-control','placeholder'=>'Enter branch name','autocomplete'=>'off','required')) !!} 

    </div>

    <div class="form-group col-md-4 ">                        
      <label>
        IFSC Code <span class="text-red">*</span>
      </label>

         {!!Form::text('ifsc',null,array('class'=>'form-control','placeholder'=>'Enter IFSC code','autocomplete'=>'off','required')) !!} 

    </div>

    <div class="form-group col-md-4 ">                        
      <label>
        Account Number <span class="text-red">*</span>
      </label>

         {!!Form::text('account',null,array('class'=>'form-control','placeholder'=>'Enter account no','autocomplete'=>'off','required')) !!} 


     <!--  <input placeholder="Enter account no." type="text" id="first-name"
      name="account" class="form-control col-md-7 col-xs-12"
      value="{{$bank->account ?? ''}}"> -->
    </div>

    <div class="form-group col-md-4 ">                        
     <label>
      Account Name <span class="text-red">*</span>
    </label>

         {!!Form::text('acountname',null,array('class'=>'form-control','placeholder'=>'Enter account name','autocomplete'=>'off','required')) !!} 


  </div>

 <div class="form-group col-md-1 ">     
</div>
 <div class="form-group col-md-3 " style="margin-top:27px">     
  @if($configs->bank_enable==1)   

  <input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="Deactive" name="bank_enable" data-onstyle="success" data-offstyle="danger" id="bank_status_setting" class="checkstatus_1" onchange="updateStatusToggle('bank_status_setting','bank_enable')" >

  @else
  <input type="checkbox"  data-toggle="toggle" data-on="Active" data-off="Deactive" name="bank_enable" data-onstyle="success" data-offstyle="danger" id="bank_status_setting" class="checkstatus_1" onchange="updateStatusToggle('bank_status_setting','bank_enable')" >

  @endif
</div>


  <div class="form-group col-md-5 ">                        
   <button type="submit" class="btn full btn-primary">Save</button>

 </div>

</div>



{{Form::close()}}


<!-- .......end......... -->
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

 function updateStatusToggle(type,value) {

     // alert("{{url('admin/')}}/"+type+"?name="+value)
     $.ajax({
       type:"GET",
       url:"{{url('admin/')}}/"+type+"?name="+value,
       dataType: 'json',
       success:function(res){ 

        console.log(res)         
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


      }
    });
   };

</script>
 @endpush