@extends('admin.layouts.app')
@section('title',"All Reviews| Admin Mande Clan")

<!-- ................custom css................. -->

@section('customStyle')
<style type="text/css">
    .container_rat1 li {
    display: inline-block;
    font-size: 12px;
    color: orange;
    cursor: pointer;
}

.container_rat1{

        padding: 0px;

}
</style>
@endsection

<!-- ................Add css link................. -->

@push('style')
@endpush

<!-- ................body................. -->
@section('innercontent')

  <main class="content">
                    <div class="container-fluid p-0">

                        <div class="clearfix">




                             <a href="{{url('admin/reviews/create')}}" class="form-inline float-right mt--1 d-none d-md-flex">
                                       <button class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create a New Review</button>
                                    </a>

                            <h1 class="h3 mb-3">Reviews&nbsp;&nbsp;@if(!empty($records))({{$records->total()}})@endif</h1>
                        </div>

                        <div class="card">
                                <div class="card-body">
                                        <div class="row">
                                            <div class="col-md">
                                            {{Form::open(['url'=>['admin/reviews'],'method'=>'GET'])}}
                                            
@if(!empty($review_names))
                                                {!!Form::select('search',$review_names,null,array('class'=>'form-control select2','placeholder'=>'Search','data-toggle'=>'select2','onchange'=>'this.form.submit()')) !!}
@endif

                                            
                                            {{Form::close()}}
                                            </div>
                                            <div class="col-md">
                                                
                                            </div>
                                            <div class="col-md">
                                                <div class="form-group">
                                                    {{Form::open(['url'=>['admin/reviews'],'method'=>'GET'])}}

                                                    <div class="input-group">

      {!!Form::text('search',Request::input('search'),array('class'=>'form-control','placeholder'=>'Search by Review..','onchange'=>'this.form.submit()','autocomplete'=>'off')) !!}
               
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
                                

                                    <table class="table table-striped table-hover table-sm table-bordered" >
                                        <thead>
                                            <tr>
                                                <th width="2%">Sr.</th>
                                                <th width="10%">Store Name</th>
                                                <th width="10%">Store Id</th>
                                                <th width="10%">Customer Name</th>
                                                <th width="10%">Customer Id</th>
                                                <th width="10%">Rating</th>
                                                <th width="20%">Reviews</th>
                                                <th width="10%">Status</th> <th width="10%">Action</th>                         
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                            
                                            @if(!empty($records))
                                            @foreach($records as $index => $data)
                                            <tr class="deleteRow">
                                                <td>{{$index+1}}</td>   
                                                <td>{{$data->store_name}}</td>
                                                <td>{{$data->store_unique_id}}</td>
                                                <td>{{$data->persone_name}}</td>                                     
                                                <td>{{$data->persone_unique_id}}</td>
                                                <td>
<ul class="container_rat1">
    @for ($x = 1; $x <= $data->rating; $x++)
      <li class="star"><i class="fa fa-star"></i></li>
             @endfor                                       
</ul>
</td>
                                                  
                                                <td>{!!$data->reviews!!}</td>
                                                <td>
                                    
                 @if($data->status ==  'Active')

                  <input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="Deactive" data-onstyle="success" data-offstyle="danger" id="{{$data->id}}" class="checkstatus" onchange="updateToggle({{$data->id}})">
 @elseif($data->status ==  'Deactive')
<input type="checkbox" data-toggle="toggle" data-on="Active" data-off="Deactive" data-onstyle="success" data-offstyle="danger" id="{{$data->id}}" class="checkstatus" onchange="updateToggle({{$data->id}})">
   @endif

                                                </td>
                                                <td>                                                    
                                                <a href="{{ URL::to('admin/reviews/'.$data->id.'/edit') }}"><button class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></button></a>
                                                
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