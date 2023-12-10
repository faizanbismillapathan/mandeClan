@extends('admin.layouts.app')
@section('title',"All Stores | Admin Mande Clan")

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




         {{--   <a href="{{url('admin/archive-store/create')}}" class="form-inline float-right mt--1 d-none d-md-flex">
             <button class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create a New Store</button>
         </a> --}}

         <h1 class="h3 mb-3">Stores&nbsp;&nbsp;@if(!empty($records))({{$records->total()}})@endif</h1>
     </div>

     <div class="card">
        <div class="card-body">
                    {{Form::open(['url'=>['admin/archive-store'],'method'=>'GET'])}}

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
            <th width="9%">Status</th>
            <th width="15%">Action</th> 

        </tr>
    </thead>
    <tbody>


        @if(!empty($records))
        @foreach($records as $index => $data)
        <tr class="deleteRow">
            <td>{{$index+1}}</td>  
            <td>{{date("d-m-Y", strtotime($data->created_at))}}</td>

            <td style="color: #e91e63;text-decoration :underline; " data-toggle="tooltip" data-placement="top" title="Go to Store Panel" class=" clickable-row" data-href="{{ URL::to('seller/dashboard/'.$data->id) }}" data-underline>

                {{$data->store_name}}</td>
                        <td>{{$data->category_name}}</td>

            <td>{{$data->store_mobile}}</td>
            <td>{{$data->store_email}}</td>
            <td>{{$data->country_name}},{{$data->city_name}}</td>
            <td>{{$data->store_plan_name}}</td>

{{-- <td><div class="progress">
  <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
</div></td> --}}
            <td>

 <button class="btn btn-danger click_disbled_status"  data-toggle="tooltip" data-placement="top" title="Recover"  data="{{$data->id}}">Recover</button>  

             {{--   @if($data->status ==  'Active')

               <input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="Archive" data-onstyle="success" data-offstyle="danger" id="{{$data->id}}" class="checkstatus" onchange="updateToggle({{$data->id}})">
               @elseif($data->status ==  'Archive')
               <input type="checkbox" data-toggle="toggle" data-on="Active" data-off="Archive" data-onstyle="success" data-offstyle="danger" id="{{$data->id}}" class="checkstatus" onchange="updateToggle({{$data->id}})">
               @endif --}}

           </td>
           <td> 

               <button class="btn btn-danger click_disbled"  data-toggle="tooltip" data-placement="top" title="Delete"  data="{{$data->id}}"><i class="fas fa-trash-alt"></i></button>                                 
                                            
            <a href="{{ URL::to('admin/archive-store/'.$data->id.'/edit') }}"><button class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></button></a>

                                          
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
     $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });



 $(".click_disbled_status").click(function(){


   var data=$(this).attr('data');

   var clickDisbled = $(this);

 var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
swal({
  title: 'Are you sure?',
  text: "You want to Recover Account this record! ",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, Recover Account it!'
},
     function() {
                  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});

    $.ajax({
           type:"POST",
           
           url:"{{url('admin/archive-store-recorver')}}",
           data:{_token: CSRF_TOKEN, id:data},
           dataType:'JSON',
        
            
            complete: function(){
        
                     clickDisbled.parents('.deleteRow').fadeOut(1500);
                
             swal(
      'Recover Account!',
      'Your record has been recover Account.',
      'success'
    );
             },

             error: function (data) {

console.log(data)

             }


        });
  });
  });
</script>
@endpush