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



{{-- 
                             <a href="{{url('admin/service-document/create')}}" class="form-inline float-right mt--1 d-none d-md-flex">
                                       <button class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create a New Service Document</button>
                                    </a>
 --}}
                            <h1 class="h3 mb-3">Service Document &nbsp;&nbsp;@if(!empty($records))({{$records->total()}})@endif</h1>
                        </div>

                        <div class="card">
                                <div class="card-body">

                                      <div class="form-row">
                        
                         <div class="form-group col-md-4">
                          <div class="row">
                            <div class="col-md-4"><b>Service Name</b></div>
                            <div class="col-md-1"><b>:</b></div>
                            <div class="col-md-6">{{$record->service_name}}</div>
                          </div>         
                        </div>
                        
                         <div class="form-group col-md-4">
                          <div class="row">
                            <div class="col-md-4"><b>Category</b></div>
                            <div class="col-md-1"><b>:</b></div>
                            <div class="col-md-6">{{$record->category_name}} </div>
                          </div>         
                        </div>
                        <div class="form-group col-md-4">
                          <div class="row">
                            <div class="col-md-4"><b>Mobile</b></div>
                            <div class="col-md-1"><b>:</b></div>
                            <div class="col-md-6">{{$record->service_mobile}}</div>
                          </div>         
                        </div>
                        <div class="form-group col-md-4">
                          <div class="row">
                            <div class="col-md-4"><b>Email
</b></div>
                            <div class="col-md-1"><b>:</b></div>
                            <div class="col-md-6">{{$record->service_email}} </div>
                          </div>         
                        </div>
                        <div class="form-group col-md-4">
                          <div class="row">
                            <div class="col-md-4"><b>Location</b></div>
                            <div class="col-md-1"><b>:</b></div>
                            <div class="col-md-6">{{$record->city_name}},{{$record->locality_name}} </div>
                          </div>         
                        </div>                                          
                                       
                       
                                                
                        </div>

                                       
                                    </div>
                                    
                                    <div class="col-md-6 ajax_response" style="display: none;">
        <div class="alert alert-success">
      <b id="success_message" style="padding: 8px"></b>
     
    </div>
   </div>
                                


                                    <table class="table table-striped table-hover table-sm table-bordered" >
                                        <thead>
                                            <tr>
                                                <th width="10%">Sr.</th>
                                                <th width="20%">Date</th>
                                                <th width="20%">Document Name</th>
                                                <th width="20%">Document Image</th>
                                                <th width="20%">Status</th> <th width="20%">Action</th>                         
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                            
                                            @if(!empty($records))
                                            @foreach($records as $index => $data)
                                            <tr class="deleteRow">
                                                <td>{{$index+1}}</td>   
                                                 <td>{{date("d-m-Y", strtotime($data->created_at))}}</td>
                                                <td>{{$data->document_name}}</td>
                                                <td>
@if(!empty($data->document_file))
     <a href="{{asset('public/images/service_document/'.$data->document_file)}}" target="_blank"> {{$data->document_file}}</a> 
    
@else
@endif
</td>
                                               
                                                <td>
                                    
@if($data->status ==  'Pending')
<input type="checkbox" checked data-toggle="toggle" data-on="Pending" data-off="Approved" data-onstyle="warning" data-offstyle="success" id="{{$data->id}}" class="checkstatus" onchange="updateToggle1({{$data->id}})">
@elseif($data->status ==  'Approved')
<input type="checkbox" data-toggle="toggle" data-on="Pending" data-off="Approved" data-onstyle="warning" data-offstyle="success" id="{{$data->id}}" class="checkstatus" onchange="updateToggle1({{$data->id}})">
@endif

                                                </td>
                                                <td>                                                    
                                                <a href="{{ URL::to('admin/service-document/'.$data->id.'/edit') }}"><button class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></button></a>
                                                
                                                <button class="btn btn-danger click_disbled111"  data-toggle="tooltip" data-placement="top" title="Delete"  data="{{$data->id}}"><i class="fas fa-trash-alt"></i></button>                                 
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

 <script type="text/javascript">
     
 $(".click_disbled111").click(function(){


   var data=$(this).attr('data');

alert(data)
   var clickDisbled = $(this);

 var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
swal({
  title: 'Are you sure?',
  text: "You want to delete this record! ",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
},
     function() {
                  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});

    $.ajax({
           type:"POST",
           
           url:"{{url('/admin/service-document/delete')}}",
           data:{_token: CSRF_TOKEN, id:data},
           dataType:'JSON',
        
            
            complete: function(){
        
                     clickDisbled.parents('.deleteRow').fadeOut(1500);
                
             swal(
      'Deleted!',
      'Your record has been deleted.',
      'success'
    );
             },

             error: function (data) {

console.log(data)

             }


        });
  });
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
           url:"{{url('/admin/service-document/status_update')}}",
           data:{_token: CSRF_TOKEN, user_id:userid},
           dataType:'JSON',
           dataType: 'json',
           success:function(res){ 


            swal(
      'Updated!',
      'Your record has been updated.',
      'success'
    );


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
    });

}

 </script>
@endpush