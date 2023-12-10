@extends('admin.layouts.app')
@section('title',"All Rider Plan | Admin Mande Clan")

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




                             <a href="{{url('admin/rider-plan/create')}}" class="form-inline float-right mt--1 d-none d-md-flex">
                                       <button class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create a New Plan</button>
                                    </a>

                            <h1 class="h3 mb-3">Rider Plan&nbsp;&nbsp;@if(!empty($records))({{$records->total()}})@endif</h1>
                        </div>

                        <div class="card">
                                <div class="card-body">
                                        <div class="row">
                                            <div class="col-md">
                                            {{Form::open(['url'=>['admin/rider-plan'],'method'=>'GET'])}}
                                            
@if(!empty($rider_plans))
                        {!!Form::select('search',$rider_plans,Request::input('search'),array('class'=>'form-control select2','placeholder'=>'Search','data-toggle'=>'select2','onchange'=>'this.form.submit()','id'=>'test_skill')) !!}

                        
@endif

                                            
                                            {{Form::close()}}
                                            </div>
                                            <div class="col-md">
                                                
                                            </div>
                                            <div class="col-md">
                                                <div class="form-group">
                                                    {{Form::open(['url'=>['admin/rider-plan'],'method'=>'GET'])}}

                                                    <div class="input-group">

      {!!Form::text('search',Request::input('search'),array('class'=>'form-control','placeholder'=>'Search by rider-plan..','onchange'=>'this.form.submit()','autocomplete'=>'off')) !!}
               
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
                                                <th width="15%">Plan Name /Code</th>
                                                <th width="10%">Plan Price</th>
                                                <th width="10%">Plan Validity</th>
                                                         <th width="10%">Plan Discount</th>
                                                             <!-- <th width="10%">Product Limit</th> -->
                                                <th width="10%">Status</th> <th width="10%">Action</th>                         
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                            
                                            @if(!empty($records))
                                            @foreach($records as $index => $data)
                                            <tr class="deleteRow">
                                                <td>{{$index+1}}</td>  
                                       <td>{{$data->rider_plan_name}} ({{$data->rider_plan_id}})</td>
 
                                               <td>{{$data->rider_plan_price}}</td>
                                                   <td>{{$data->rider_plan_validity}}</td>
                                                       <td>{{$data->rider_plan_discount}}</td>
                                                       <!-- <td>{{$data->rider_product_limit}}</td> -->
                                               <td>
                                    
                 @if($data->status ==  'Active')

                                                    <input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="Deactive" data-onstyle="success" data-offstyle="danger" id="{{$data->id}}" class="checkstatus" onchange="updateToggle({{$data->id}})">
 @elseif($data->status ==  'Deactive')
<input type="checkbox" data-toggle="toggle" data-on="Active" data-off="Deactive" data-onstyle="success" data-offstyle="danger" id="{{$data->id}}" class="checkstatus" onchange="updateToggle({{$data->id}})">
   @endif

                                                </td>
                                                <td>                                                    
                                                <a href="{{ URL::to('admin/rider-plan/'.$data->id.'/edit') }}"><button class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></button></a>
                                                
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

@endpush