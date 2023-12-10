@extends('admin.layouts.app')
@section('title',"All Service Document | service Mande Clan")

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




                             <a href="{{url('admin/service-document/create')}}" class="form-inline float-right mt--1 d-none d-md-flex">
                                       <button class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create a New Service Document</button>
                                    </a>

                            <h1 class="h3 mb-3">Service Document &nbsp;&nbsp;@if(!empty($records))({{count($records)}})@endif</h1>
                        </div>

                        <div class="card">
                                <div class="card-body">
                                        <div class="row">
                                            <div class="col-md">
                                            {{Form::open(['url'=>['admin/service-document'],'method'=>'GET'])}}
                                            
@if(!empty($service_documents))
                                                {!!Form::select('search',$service_documents,null,array('class'=>'form-control select2','placeholder'=>'Search','data-toggle'=>'select2','onchange'=>'this.form.submit()')) !!}
@endif

                                            
                                            {{Form::close()}}
                                            </div>
                                            <div class="col-md">
                                                
                                            </div>
                                            <div class="col-md">
                                                <div class="form-group">
                                                    {{Form::open(['url'=>['admin/service-document'],'method'=>'GET'])}}

                                                    <div class="input-group">

      {!!Form::text('search',Request::input('search'),array('class'=>'form-control','placeholder'=>'Search by Service Document..','onchange'=>'this.form.submit()','autocomplete'=>'off')) !!}
               
                            <span class="input-group-append">
                  <button class="btn btn-secondary" type="button">Enter!</button>
                </span>                         
                                                    </div>
                                                     {{Form::close()}}

                                                </div>
                                            </div>                                          
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 ajax_response" style="display: none;">
        <div class="alert alert-success">
      <b id="success_message" style="padding: 8px"></b>
     
    </div>
   </div>
                                

                                    <table class="table table-striped table-hover table-sm table-bordered table-responsive" >
                                        <thead>
                                            <tr>
                                                <th width="5%">Sr.</th>
                                                <th class="10">Date</th>
                                                                                                <th width="20%">services Name</th>

                                                <th width="10%">Category</th>
                                                  <th width="10%">Total Add / Add Document</th>
                                                  <th width="10%">Pending /Approved Document</th>
                                                <th width="10%">Mobile</th>
                                                <th width="10%">Email</th>
                                                <th width="20%">Location</th>
                                                <th width="10%">Kyc Status</th>
                                                 {{-- <th width="15%">Action</th>                          --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                            
                                            @if(!empty($records))
                                            @foreach($records as $index => $data)
                                            <tr class="deleteRow">
                                                <td>{{$index+1}}</td>  
                                                            <td>{{date("d-m-Y", strtotime($data->created_at))}}</td>
 
                                                    <td> {{$data->service_name}}</td>
<td>{{$data->category_name}}</td>


  <td style="color: #e91e63;text-decoration :underline; " data-toggle="tooltip" data-placement="top" title="Total Add / Add Document" class=" clickable-row" data-href="{{ URL::to('admin/service-document/'.$data->id) }}" data-underline>{{$data->count}} / {{$data->total_document}}</td>
  <td style="color: green;text-decoration :underline; " data-toggle="tooltip" data-placement="top" title="Pending /Approved Document" class=" clickable-row" data-href="{{ URL::to('admin/service-document/'.$data->id) }}" data-underline>{{$data->total_pending}} / {{$data->total_approved}}</td>

<td>{{$data->service_mobile}}</td>
<td>{{$data->service_email}}</td>
<td>{{$data->city_name}},{{$data->locality_name}}</td>


{{--  <td>
@if(!empty($data->document_file))
     <a href="{{asset('public/images/service_document/'.$data->document_file)}}" target="_blank"> {{$data->document_file}}</a> @else
@endif --}}
</td>
                                           
                                                <td>
                                    
                 @if($data->kyc_status ==  'Active')

<input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="Deactive" data-onstyle="warning" data-offstyle="success" id="{{$data->id}}" class="checkstatus_kyc" onchange="updateToggle1({{$data->id}})" >
 @elseif($data->kyc_status ==  'Deactive')
<input type="checkbox" data-toggle="toggle" data-on="Active" data-off="Deactive" data-onstyle="warning" data-offstyle="success" id="{{$data->id}}" class="checkstatus_kyc" onchange="updateToggle1({{$data->id}})" >
   @endif

                                                </td>
                                                     {{--<td>                                                    
                                                <a href="{{ URL::to('admin/service-document/'.$data->id.'/edit') }}"><button class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></button></a>
                                                
                                                <button class="btn btn-danger click_disbled"  data-toggle="tooltip" data-placement="top" title="Delete"  data="{{$data->id}}"><i class="fas fa-trash-alt"></i></button>                                 
                                               </td> --}}
                                            </tr>
                                            @endforeach
                                            @endif
                                            
                                        </tbody>
                                    </table>





                                </div>
                    </div>

                </main> 

@endsection

<!-- ................push new js link................. -->

@push('js')
 <script src="{{asset('public/js/comman.js')}}"></script>
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
           url:"{{url('/admin/service_kyc_status_update')}}",
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