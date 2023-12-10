@extends('admin.layouts.app')
@section('title',"All Products | admin Mande Clan")

<!-- ................custom css................. -->

@section('customStyle')
@endsection

<!-- ................Add css link................. -->

@push('style')
@endpush

<!-- ................body................. -->
@section('innercontent')

<style>
    .content{
        display:block;
        width:100%;
        height:180vh;
            
    -ms-overflow-style: none; /* for Internet Explorer, Edge */
    scrollbar-width: none; /* for Firefox */
    overflow-y: scroll; 
    }
    
    .content::-webkit-scrollbar {
    display: none; /* for Chrome, Safari, and Opera */
}
</style>

  <main class="content">
                    <div class="container-fluid p-0">

                        <div class="clearfix">




                             <a href="{{url('admin/products/create')}}" class="form-inline float-right mt--1 d-none d-md-flex">
                                       <button class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create a New Product</button>
                                    </a>

                            <h1 class="h3 mb-3">Products &nbsp;&nbsp;@if(!empty($records))({{$records->total()}})@endif</h1>
                        </div>

                        <div class="card">
                                <div class="card-body">
                                        <div class="row">
                                            <div class="col-md">
                                            {{Form::open(['url'=>['admin/products'],'method'=>'GET'])}}
                                            
@if(!empty($products_names))
                                                {!!Form::select('search',$products_names,null,array('class'=>'form-control select2','placeholder'=>'Search','data-toggle'=>'select2','onchange'=>'this.form.submit()')) !!}
@endif

                                            
                                            {{Form::close()}}
                                            </div>
                                            <div class="col-md">
                                                
                                            </div>
                                            <div class="col-md">
                                                <div class="form-group">
                                                    {{Form::open(['url'=>['admin/products'],'method'=>'GET'])}}

                                                    <div class="input-group">

      {!!Form::text('search',Request::input('search'),array('class'=>'form-control','placeholder'=>'Search by Products..','onchange'=>'this.form.submit()','autocomplete'=>'off')) !!}
               
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
                            <th width="10%">Store Category</th>
                            <th width="10%">Product Category</th>
                            <th width="10%">Sub Category</th>
                            {{-- <th width="10%">Add items</th> --}}
                            {{-- <th width="10%">Assign Addon</th>    --}}

                            <th width="10%">Brand</th>  
                               
                            <th width="10%">Status</th>
                            <th width="10%">Action</th>                         
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                            
                                            @if(!empty($records))
                                            @foreach($records as $index => $data)
                                            <tr class="deleteRow">
                                                <td>{{$index+1}}</td>   
                                                 <td>{{$data->product_name}}</td>
                                                  <td> @if(!empty($data->product_cover_photo))
             <img src="{{ asset('public/images/product_cover_photo/'.$data->product_cover_photo)}}" alt="dd" width="50px" />
             @else
  <img src="{{ asset('public/img/no-image.png')}}" alt="dd" width="50px"/>
             @endif</td>
                                        <td>{{$data->category_name}}</td>

                                                <td>{{$data->product_category}}</td>
                                                <td>{{$data->product_subcategory}}</td>
                                                  {{-- <td><a href="{{url('admin/products/'.$data->id.'/items')}}"><button class="btn-info">Add Items</button></a></td>
                                                    <td><a href="{{url('admin/products/'.$data->id.'/addon')}}"><button class="btn-secondary">AddOn</button></a></td> --}}
                                              
                                               
                                                <td>{{$data->brand_name}}</td>
                                                <td>
                                    
                 @if($data->product_status ==  'Active')

                                                    <input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="Deactive" data-onstyle="success" data-offstyle="danger" id="{{$data->id}}" class="checkstatus" onchange="updateToggle({{$data->id}})">
 @elseif($data->product_status ==  'Deactive')
<input type="checkbox" data-toggle="toggle" data-on="Active" data-off="Deactive" data-onstyle="success" data-offstyle="danger" id="{{$data->id}}" class="checkstatus" onchange="updateToggle({{$data->id}})">
   @endif

                                                </td>
                                                <td>                                                    
                                                <a href="{{ URL::to('admin/products/'.$data->id.'/edit') }}"><button class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></button></a>
                                                
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