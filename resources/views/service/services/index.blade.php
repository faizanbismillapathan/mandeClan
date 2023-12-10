@extends('service.layouts.app')
@section('title',"All Services | service Mande Clan")

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




         <a href="{{url('service/services/create')}}" class="form-inline float-right mt--1 d-none d-md-flex">
           <button class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create a New Services</button>
       </a>

       <h1 class="h3 mb-3">Services &nbsp;&nbsp;@if(!empty($records))({{$records->total()}})@endif</h1>
   </div>

   <div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md">
                {{Form::open(['url'=>['service/services'],'method'=>'GET'])}}

                @if(!empty($services_names))
                {!!Form::select('search',$services_names,null,array('class'=>'form-control select2','placeholder'=>'Search','data-toggle'=>'select2','onchange'=>'this.form.submit()')) !!}
                @endif


                {{Form::close()}}
            </div>
            <div class="col-md">

            </div>
            <div class="col-md">
                <div class="form-group">
                    {{Form::open(['url'=>['service/services'],'method'=>'GET'])}}

                    <div class="input-group">

                      {!!Form::text('search',Request::input('search'),array('class'=>'form-control','placeholder'=>'Search by Services..','onchange'=>'this.form.submit()','autocomplete'=>'off')) !!}

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

<!--   @if(Auth::user()->role=='1')
       <a href="{{ URL::to('admin/orders/1/dummy') }}"><button class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Edit">Ordernow</button></a>
       @endif  -->

       <table class="table table-striped table-hover table-sm table-bordered table-responsive" >
        <thead>
            <tr>
                <th width="5%">Sr.</th>
                <th width="15%">Name</th>
                <th width="10%">Cover Photo</th>
                <th width="10%">Category</th>
                <th width="10%">Sub Category</th>
                <th width="10%">Price   </th>

                <th width="10%">Brand</th>  
                <th width="5%">Craeted By</th>  

                <th width="10%">Status</th>
                <th width="10%">Action</th>                         
            </tr>
        </thead>
        <tbody>


            @if(!empty($records))
            @foreach($records as $index => $data)
            <tr class="deleteRow">
                <td>{{$index+1}}</td>   
                <td>{{$data->service_name}}</td>
                <td> @if(!empty($data->service_img))
                 <img src="{{ asset('public/images/service_img/'.$data->service_img)}}" alt="dd" width="50px" />
                 @else
                 <img src="{{ asset('public/img/no-image.png')}}" alt="dd" width="50px"/>
             @endif</td>
             <td>{{$data->category_name}}</td>
             <td>{{$data->service_subcategory}}</td>
             <td>{{$data->service_price}} ₹</td>
             <td>{{$data->brand_name}}</td>
             <td>{{$data->created_by}}</td>

             <td>

                 @if($data->status ==  'Active')
                 <input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="Deactive" data-onstyle="success" data-offstyle="danger" id="{{$data->id}}" class="checkstatus" onchange="updateToggle({{$data->id}})">
                 @elseif($data->status ==  'Deactive')
                 <input type="checkbox" data-toggle="toggle" data-on="Active" data-off="Deactive" data-onstyle="success" data-offstyle="danger" id="{{$data->id}}" class="checkstatus" onchange="updateToggle({{$data->id}})">
                 @endif

             </td>
             <td>  

                <a href="{{ URL::to('service/services/'.$data->id.'/edit') }}"><button class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></button></a>


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

 $(".checkbox_choose_service").click(function(){


   var data=$(this).attr('id');
   // alert(base_url+'delete')

   var clickDisbled = $(this);

   var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
   swal({
      title: 'Are you sure?',
      text: "You want to Remove this Service From Service List! ",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Remove it!'
  },
  function() {
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

      $.ajax({
       type:"POST",
       url: "{{url('service/services/delete')}}",

       data:{_token: CSRF_TOKEN, id:data},
       dataType:'JSON',


       complete: function(){

         clickDisbled.parents('.deleteRow').fadeOut(1500);

         swal(
          'Deleted!',
          'Your Services has been Removed.',
          'success'
          );
     }


 });
  });


});
</script>
@endpush