@extends('admin.layouts.app')
@section('title',"All Customer | Admin Mande Clan")

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




           <a href="{{url('admin/customers/create')}}" class="form-inline float-right mt--1 d-none d-md-flex">
             <button class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create a New Customer</button>
         </a>

         <h1 class="h3 mb-3">Customer &nbsp;&nbsp;@if(!empty($records))({{$records->total()}})@endif</h1>
     </div>

     <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md">
                    {{Form::open(['url'=>['admin/customers'],'method'=>'GET'])}}
                    
                    @if(!empty($customers))
                    {!!Form::select('search',$customers,Request::input('search'),array('class'=>'form-control select2','placeholder'=>'Search','data-toggle'=>'select2','onchange'=>'this.form.submit()','id'=>'test_skill')) !!}

                    @endif

                    
                    {{Form::close()}}
                </div>
                <div class="col-md">
                    
                </div>
                <div class="col-md">
                    <div class="form-group">
                        {{Form::open(['url'=>['admin/customers'],'method'=>'GET'])}}

                        <div class="input-group">

                          {!!Form::text('search',Request::input('search'),array('class'=>'form-control','placeholder'=>'Search by Customer..','onchange'=>'this.form.submit()','autocomplete'=>'off')) !!}
                          
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
            <th width="3%">Sr.</th>
            <th width="10%">Date</th>
            <th width="10%">Id</th>
            <th width="12%">Name</th>
            <th width="10%">Mobile</th>
            <th width="10%">Email</th>
            <th width="10%">Gender</th>
            <th width="10%">City</th>
            <th width="8%">TotalOrder</th>
            <th width="10%">Status</th> <th width="15%">Action</th>                         
        </tr>
    </thead>
    <tbody>
        
        
        @if(!empty($records))
        @foreach($records as $index => $data)
        <tr class="deleteRow  {{ $data->user_status=='Default' ? 'default_cls' : '' }}">
            <td>{{$index+1}}</td>   
            <td>{{date("d-m-Y", strtotime($data->created_at))}}</td>
            <td>{{$data->customer_userid}}</td>

            <td style="color: #e91e63;text-decoration :underline; " data-toggle="tooltip" data-placement="top" title="Go to Customer Panel" class=" clickable-row" data-href="{{ URL::to('customer/dashboard/'.$data->id) }}" data-underline>  {{$data->customer_name}}</td>


            <td>{{$data->customer_mobile}}</td>
            {{-- <td>{{$data->customer_email}}</td> --}}

            <td>
                @if($data->email_verified_at)
               <span class="badge badge-success" data-toggle="tooltip" data-placement="top" title="{{$data->customer_email}}">Verified</span>
@else
               <span class="badge badge-danger" data-toggle="tooltip" data-placement="top" title="{{$data->customer_email}}">Not verify</span>

@endif
            </td>
            <td>{{$data->customer_gender}}</td>
                        <td>{{$data->city_name}}</td>

            <td><span class="badge badge-success">00</span></td>


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
            <a href="{{ URL::to('admin/customers/'.$data->id.'/edit') }}"><button class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></button></a>
            
           @if($data->user_status!='Default')  <button class="btn btn-danger click_disbled"  data-toggle="tooltip" data-placement="top" title="Delete"  data="{{$data->id}}"><i class="fas fa-trash-alt"></i></button> @endif                                
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
</script>
@endpush