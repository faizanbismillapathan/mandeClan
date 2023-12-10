@extends('admin.layouts.app')
@section('title',"All Satat | Admin Mande Clan")
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




                             <a href="{{url('admin/product-category/create')}}" class="form-inline float-right mt--1 d-none d-md-flex">
                                       <button class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create a New Product Category</button>
                                    </a>

                            <h1 class="h3 mb-3">Product Categorys &nbsp;&nbsp;@if(!empty($records))({{$records->total()}})@endif</h1>
                        </div>

                        <div class="card">
                                <div class="card-body">
                                        <div class="row">
                                            <div class="col-md">
                                            {{Form::open(['url'=>['admin/product-category'],'method'=>'GET'])}}
                                            
@if(!empty($product_categorys))
                        {!!Form::select('search',$product_categorys,Request::input('search'),array('class'=>'form-control select2','placeholder'=>'Search','data-toggle'=>'select2','onchange'=>'this.form.submit()','id'=>'test_skill')) !!}

                        
<!--                                                 {!!Form::select('search',$product_categorys,null,array('class'=>'form-control select2','placeholder'=>'Search','data-toggle'=>'select2','onchange'=>'this.form.submit()')) !!}
 -->@endif

                                            
                                            {{Form::close()}}
                                            </div>
                                            <div class="col-md">
                                                
                                            </div>
                                            <div class="col-md">
                                                <div class="form-group">
                                                    {{Form::open(['url'=>['admin/product-category'],'method'=>'GET'])}}

                                                    <div class="input-group">

      {!!Form::text('search',Request::input('search'),array('class'=>'form-control','placeholder'=>'Search category ..','onchange'=>'this.form.submit()','autocomplete'=>'off')) !!}
               
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
                                                <th width="10%">Sr.</th>
                                                <th width="30%">Store Category</th>
                                                 <th width="30%">Product Category</th>
                                                <th width="15%">Status</th> <th width="15%">Action</th>                         
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                            
                                            @if(!empty($records))
                                            @foreach($records as $index => $data)
                                            <tr class="deleteRow">
                                                <td>{{$index+1}}</td>   
                                                <td>{{$data->category_name}}</td>
                                                <td>{{$data->product_category}}</td>

                                                <td>
                                    
                 @if($data->status ==  'Active')

                                                    <input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="Deactive" data-onstyle="success" data-offstyle="danger" id="{{$data->id}}" class="checkstatus" onchange="updateToggle({{$data->id}})">
 @elseif($data->status ==  'Deactive')
<input type="checkbox" data-toggle="toggle" data-on="Active" data-off="Deactive" data-onstyle="success" data-offstyle="danger" id="{{$data->id}}" class="checkstatus" onchange="updateToggle({{$data->id}})">
   @endif

                                                </td>
                                                <td>                                                    
                                                <a href="{{ URL::to('admin/product-category/'.$data->id.'/edit') }}"><button class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></button></a>
                                                

                                                @if(!empty($data->not_prmit))

                                                 <button class="btn btn-danger" data-toggle="modal" data-target="#EmailVerifyAccount"  data-toggle="tooltip" data-placement="top" title="Delete" ><i class="fas fa-trash-alt"></i></button>   


                                                @else
                                                <button class="btn btn-danger click_disbled"  data-toggle="tooltip" data-placement="top" title="Delete"  data="{{$data->id}}"><i class="fas fa-trash-alt"></i></button>     

                                                @endif      
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

<div class="modal fade comman-modal" id="EmailVerifyAccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">
    <div class="modal-content">
    
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Not Allow To delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <div class="modal-body">
      <div id="infoPanel">
        <p>For Delete This Catgeory ... First Delete this category products </p>
       
    </div>

</div>
<div class="modal-footer">
   <button type="button" class="btn btn-raised btn-danger" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>

@endsection

<!-- ................push new js link................. -->

@push('js')
 <script src="{{asset('public/js/comman.js')}}"></script>

@endpush