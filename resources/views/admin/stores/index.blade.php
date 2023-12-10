@extends('admin.layouts.app')
@section('title',"All Stores | Admin Mande Clan")

<!-- ................custom css................. -->

@section('customStyle')
@endsection

<!-- ................Add css link................. -->

@push('style')
<style type="text/css">
    .default_cls{

    background-color: #ccc!important;

}
</style>
@endpush

<!-- ................body................. -->
@section('innercontent')

<main class="content">
    <div class="container-fluid p-0">

        <div class="clearfix">




           <a href="{{url('admin/stores/create')}}" class="form-inline float-right mt--1 d-none d-md-flex">
             <button class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create a New Store</button>
         </a>

         <h1 class="h3 mb-3">Stores&nbsp;&nbsp;@if(!empty($records))({{$records->total()}})@endif</h1>
     </div>

     <div class="card">
        <div class="card-body">
                    {{Form::open(['url'=>['admin/stores'],'method'=>'GET'])}}

            <div class="row">
              <div class="col-md-3">

                @if(!empty($packages))
                {!!Form::select('package',$packages,Request::input('package'),array('class'=>'form-control select2','placeholder'=>'Search','data-toggle'=>'select2','onchange'=>'this.form.submit()','id'=>'test_skill')) !!}
                @endif


               

          </div>
          <div class="col-md-3">

            @if(!empty($cities))
            {!!Form::select('city',$cities,Request::input('city'),array('class'=>'form-control select2','placeholder'=>'Search','data-toggle'=>'select2','onchange'=>'this.form.submit()','id'=>'test_city')) !!}
            @endif


         
      </div>

      <div class="col-md-3">

         <div class="form-group">



            @if(!empty($categories))
            {!!Form::select('category',$categories,Request::input('category'),array('class'=>'form-control select2','placeholder'=>'Search','data-toggle'=>'select2','onchange'=>'this.form.submit()','id'=>'test_category')) !!}
            @endif


 
      </div>
  </div>


  <div class="col-md-3">
    <div class="form-group">

        <div class="input-group">

          {!!Form::text('search',Request::input('search'),array('class'=>'form-control','placeholder'=>'Search by stores..','onchange'=>'this.form.submit()','autocomplete'=>'off')) !!}

          <span class="input-group-append">
              <button class="btn btn-secondary" type="button">Enter!</button>
          </span>                         
      </div>

  </div>
</div>                                          
</div>

      {{Form::close()}}

</div>

<div class="col-md-6 ajax_response" style="display: none;">
    <div class="alert alert-success">
      <b id="success_message" style="padding: 8px"></b>

  </div>
</div>


<table class="table table-striped table-hover table-sm table-bordered table-responsive" >
    <thead>
        <tr>                                             

            <th width="3%">Sr.</th>
            <th  width="9%">Date</th>
            <th width="12%">Stores Name</th>
            <th width="9%">Category</th>
            <th width="9%">Mobile</th>
            <th width="9%">Email</th>
            <th width="8%">Location</th>
            <th width="9%">Package</th>
            {{-- <th width="9%">Progress</th> --}}
                        <th width="9%">Kyc Status</th>

            <th width="9%">Status</th>
            <th width="9%">Action</th> 

        </tr>
    </thead>
    <tbody>


        @if(!empty($records))
        @foreach($records as $index => $data)

        


        <tr class="deleteRow  {{ $data->user_status=='Default' ? 'default_cls' : '' }}">
            <td>{{$index+1}}</td>  
            <td>{{date("d-m-Y", strtotime($data->created_at))}}</td>

            <td style="color: #e91e63;text-decoration :underline; " data-toggle="tooltip" data-placement="top" title="Go to Store Panel" class=" clickable-row" data-href="{{ URL::to('seller/dashboard/'.$data->id) }}" data-underline>

                {{$data->store_name}}</td>
                        <td>{{$data->category_name}}</td>

            <td>{{$data->store_mobile}}</td>
            <td>
@if($data->email_verified_at)
               <span class="badge badge-success" data-toggle="tooltip" data-placement="top" title="{{$data->store_email}}">Verified</span>
@else
               <span class="badge badge-danger" data-toggle="tooltip" data-placement="top" title="{{$data->store_email}}">Not verify</span>

@endif
            </td>
<td>{{$data->city_name}},{{$data->locality_name}}</td>
            <td>{{$data->store_plan_name}}</td>



                     <td>
                       
                                    
                 @if($data->kyc_status ==  'Active' && $data->user_status !='Default')

<input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="Deactive" data-onstyle="success" data-offstyle="danger" id="{{$data->id}}" class="checkstatus_kyc" onchange="updateToggle1({{$data->id}})">
 @elseif($data->kyc_status ==  'Deactive' && $data->user_status !='Default')
<input type="checkbox" data-toggle="toggle" data-on="Active" data-off="Deactive" data-onstyle="success" data-offstyle="danger" id="{{$data->id}}" class="checkstatus_kyc" onchange="updateToggle1({{$data->id}})">
@else

<span class="badge badge-info">{{$data->kyc_status}}</span>

   @endif

                                                </td>
@if($data->user_status=='Default')

<td><span class="badge badge-success"> Demo Account</span> </td>

@else
<td>

               @if($data->status ==  'Active')

               <input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="Deactive" data-onstyle="success" data-offstyle="danger" id="{{$data->id}}" class="checkstatus" onchange="updateToggle({{$data->id}})">
               @elseif($data->status ==  'Deactive')
               <input type="checkbox" data-toggle="toggle" data-on="Active" data-off="Deactive" data-onstyle="success" data-offstyle="danger" id="{{$data->id}}" class="checkstatus" onchange="updateToggle({{$data->id}})">
               @endif

           </td>
@endif
   
           <td>     

            <a href="{{ URL::to('admin/stores/'.$data->id.'/edit') }}"><button class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></button></a>

         @if($data->user_status!='Default')   <button class="btn btn-danger click_disbled"  data-toggle="tooltip" data-placement="top" title="Delete"  data="{{$data->id}}"><i class="fas fa-trash-alt"></i></button>  @endif                               
        </td>
    </tr>
    @endforeach
    @endif

</tbody>
</table>
<div class="card-body">
    @if(!empty($records))
    {!! $records->appends(request()->query())->render() !!}
    @endif
</div>





</div>
</div>

</main> 

@endsection

<!-- ................push new js link................. -->

@push('js')
<script src="{{asset('public/js/comman.js')}}"></script>

 <script>
                    $(document).ready(function() {
                      $selectElement = $('#test_skill').select2({
                        placeholder: "Choose Subscription Plan",
                        allowClear: true
                    });

                     
                  $selectElement = $('#test_city').select2({
                    placeholder: "Choose City",
                    allowClear: true
                });
             
                  $selectElement = $('#test_category').select2({
                    placeholder: "Choose category",
                    allowClear: true
                });
              });
          </script>


              </script>

<script type="text/javascript">
     $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });



 function updateToggle1(userid) {

 var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
swal({
  title: 'Are you sure?',
  text: "You want to update this record! ",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, update it!'
},
  function() {
                  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});



       $.ajax({
           type:"post",
           url:"{{url('/admin/kyc_status_update')}}",
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
               
         }, error:function(res){ 
          
          console.log(res)
         }
       });

        });
    };

</script>
@endpush