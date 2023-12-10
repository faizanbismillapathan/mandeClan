@extends('admin.layouts.app')
@section('title',"All Shipping | Admin Mande Clan")

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




                             <a href="{{url('admin/shipping/create')}}" class="form-inline float-right mt--1 d-none d-md-flex">
                                       <button class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create a New Shipping</button>
                                    </a>

                            <h1 class="h3 mb-3">Shipping &nbsp;&nbsp;@if(!empty($records))({{$records->total()}})@endif</h1>
                        </div>

                        <div class="card">
                                <div class="card-body">
                                        <div class="row">
                                            <div class="col-md">
                                            {{Form::open(['url'=>['admin/shipping'],'method'=>'GET'])}}
                                            
@if(!empty($shipping_names))
                                                {!!Form::select('search',$shipping_names,null,array('class'=>'form-control select2','placeholder'=>'Search','data-toggle'=>'select2','onchange'=>'this.form.submit()')) !!}
@endif

                                            
                                            {{Form::close()}}
                                            </div>
                                            <div class="col-md">
                                                
                                            </div>
                                            <div class="col-md">
                                                <div class="form-group">
                                                    {{Form::open(['url'=>['admin/shipping'],'method'=>'GET'])}}

                                                    <div class="input-group">

      {!!Form::text('search',Request::input('search'),array('class'=>'form-control','placeholder'=>'Search by Shipping..','onchange'=>'this.form.submit()','autocomplete'=>'off')) !!}
               
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

    <table id="datatable-buttons" class="table table-striped table-bordered">
              <thead>
                <th>Default</th>
                <th>Shipping Title</th>
                <th>Price</th>
                <th>Status</th>
                <th></th>
              </thead>
              <tbody>
                                <tr>
                <td><input  type="radio" class="kk" id="1"  name="radio"></td>
                <td>Free Shipping</td>
                <td>---</td>
                <td>
                                        Yes
                                        </td><td>
                  <a disabled href=" {{url('/')}}/admin/shipping/1/edit " class="btn btn-primary-rgba btn-sm">
                  <i class="fas fa-cog"></i>
                  </a>
                </td>
                
                </tr>
                                <tr>
                <td><input disabled type="radio" class="kk" id="2"  name="radio"></td>
                <td>Local Pickup</td>
                <td>50</td>
                <td>
                                        Yes
                                        </td><td>
                  <a  href=" {{url('/')}}/admin/shipping/2/edit " class="btn btn-primary-rgba btn-sm">
                  <i class="fas fa-cog"></i>
                  </a>
                </td>
                
                </tr>
                                <tr>
                <td><input  type="radio" class="kk" id="3"  name="radio"></td>
                <td>Flat Rate</td>
                <td>12</td>
                <td>
                                        Yes
                                        </td><td>
                  <a  href=" {{url('/')}}/admin/shipping/3/edit " class="btn btn-primary-rgba btn-sm">
                  <i class="fas fa-cog"></i>
                  </a>
                </td>
                
                </tr>
                                <tr>
                <td><input disabled type="radio" class="kk" id="4"  name="radio"></td>
                <td>UPS Shipping</td>
                <td>5000</td>
                <td>
                                        Yes
                                        </td><td>
                  <a disabled href=" {{url('/')}}/admin/shipping/4/edit " class="btn btn-primary-rgba btn-sm">
                  <i class="fas fa-cog"></i>
                  </a>
                </td>
                
                </tr>
                                <tr>
                <td><input  type="radio" class="kk" id="5" checked name="radio"></td>
                <td>Shipping Price</td>
                <td>---</td>
                <td>
                                        Yes
                                        </td><td>
                  <a  href=" {{url('/')}}/admin/shipping/5/edit " class="btn btn-primary-rgba btn-sm">
                  <i class="fas fa-cog"></i>
                  </a>
                </td>
                
                </tr>
                              </tbody>
            </table>   
                                

                                    <!-- <table class="table table-striped table-hover table-sm table-bordered" >
                                        <thead>
                                            <tr>
                                                <th width="10%">Sr.</th>
                                                <th width="60%">Shipping Name</th>
                                                <th width="15%">Status</th> <th width="15%">Action</th>                         
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                            
                                            @if(!empty($records))
                                            @foreach($records as $index => $data)
                                            <tr class="deleteRow">
                                                <td>{{$index+1}}</td>   
                                                <td>{{$data->shipping_name}}</td>
                                                <td>
                                    
                 @if($data->status ==  'Active')

                                                    <input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="Deactive" data-onstyle="success" data-offstyle="danger" id="{{$data->id}}" class="checkstatus" onchange="updateToggle({{$data->id}})">
 @elseif($data->status ==  'Deactive')
<input type="checkbox" data-toggle="toggle" data-on="Active" data-off="Deactive" data-onstyle="success" data-offstyle="danger" id="{{$data->id}}" class="checkstatus" onchange="updateToggle({{$data->id}})">
   @endif

                                                </td>
                                                <td>                                                    
                                                <a href="{{ URL::to('admin/shipping/'.$data->id.'/edit') }}"><button class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></button></a>
                                                
                                                <button class="btn btn-danger click_disbled"  data-toggle="tooltip" data-placement="top" title="Delete"  data="{{$data->id}}"><i class="fas fa-trash-alt"></i></button>                                 
                                               </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                            
                                        </tbody>
                                    </table> -->
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