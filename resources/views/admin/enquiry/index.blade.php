@extends('admin.layouts.app')
@section('title',"All Enquiry | Admin Mande Clan")

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




                             {{-- <a href="{{url('admin/enquiry/create')}}" class="form-inline float-right mt--1 d-none d-md-flex">
                                       <button class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create a New Enquiry</button>
                                    </a> --}}

                            <h1 class="h3 mb-3">Enquiry &nbsp;&nbsp;@if(!empty($records))({{$records->total()}})@endif</h1>
                        </div>

                        <div class="card">
                                <div class="card-body">
                                        <div class="row">
                                            <div class="col-md">
                                            {{Form::open(['url'=>['admin/enquiry'],'method'=>'GET'])}}
                                            
@if(!empty($enquiry))
                        {!!Form::select('search',$enquiry,Request::input('search'),array('class'=>'form-control select2','placeholder'=>'Search','data-toggle'=>'select2','onchange'=>'this.form.submit()','id'=>'test_skill')) !!}

                        
@endif

                                            
                                            {{Form::close()}}
                                            </div>
                                            <div class="col-md">
                                                
                                            </div>
                                            <div class="col-md">
                                                <div class="form-group">
                                                    {{Form::open(['url'=>['admin/enquiry'],'method'=>'GET'])}}

                                                    <div class="input-group">

      {!!Form::text('search',Request::input('search'),array('class'=>'form-control','placeholder'=>'Search..','onchange'=>'this.form.submit()','autocomplete'=>'off')) !!}
               
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
                                                <th width="15%">Name</th>
                                                <th width="15%">Mobile</th>
                                                 <th width="15%">Email</th>
                                                  <th width="25%">Message</th>
                                                  <th width="15%">Status</th> 

                                                 <th width="5%">Action</th>                         
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                            
                                            @if(!empty($records))
                                            @foreach($records as $index => $data)
                                            <tr class="deleteRow">
                                                <td>{{$index+1}}</td>   
                                               <td>{{$data->name}}</td>
                                               <td>{{$data->mobile_no}}</td>
                                               <td>{{$data->email}}</td>
                                                <td>{!!$data->message!!}</td>
                                                
                                                     <td>

                 {!!Form::select('status',['Pending'=>'Pending','Approved'=>'Approved','Rejected'=>'Rejected'],$data->status,array('class'=>'form-control checkstatus_new select2','placeholder'=>'Select Status','data-toggle'=>'select2','required','data'=>$data->id)) !!}
            

           </td>

                                                <td>                                                    
{{--                                                 <a href="{{ URL::to('admin/enquiry/'.$data->id.'/edit') }}"><button class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></button></a>
 --}}                                                
                                                <button class="btn btn-danger click_disbled"  data-toggle="tooltip" data-placement="top" title="Delete"  data="{{$data->id}}"><i class="fas fa-trash-alt"></i></button>                                 
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
        $(document).ready(function () {

    $('.checkstatus_new').change(function() {
      var userid=$(this).attr("data");
      var status=$(this).val();
      // alert(userid+status)
       $.ajax({
           type:"GET",
           url:"{{url('admin/request_status_update')}}?user_id="+userid+"&status="+status,
           dataType: 'json',
           success:function(res){ 

console.log(res);
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
    });
    });

</script>
@endpush