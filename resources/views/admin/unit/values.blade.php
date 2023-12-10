@extends('admin.layouts.app')
@section('title',"Option values for : {{$record->unit_title}} | Admin Mande Clan")

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
    <a href="{{url('admin/unit')}}" class="form-inline float-right mt--1 d-none d-md-flex">
    <button class="btn btn-info"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Back</button>
    </a>

        <h1 class="h3 mb-3"><b>Option values for : {{$record->unit_title}}</b></h1>

                    </div>
                                <div class="card">
                                
<div class="card-body">

                                                <div class="row">
<div class="col-md-4">
                        <h5>Add New Value for <b>{{$record->unit_title}}</b></h5>

    {!!Form::open(['url'=>['admin/unit_value_store'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}

            <div class="form-row">
<!-- 
                   <div class="form-group col-md-12">
                    <label for="inputEmail4">Select Category</label>
         {!!Form::select('unit_category',$product_categories,null,array('class'=>'form-control selector select2','placeholder'=>'Select Country','data-toggle'=>'select2','autocomplete'=>'off','required')) !!}
                                                   
           </div> -->


                <div class="form-group col-md-12">
                    <label for="inputEmail4">{{$record->unit_title}} Value</label>                                                   
                    {!!Form::text('unit_value',null,array('class'=>'form-control','placeholder'=>'Enter unit Options','autocomplete'=>'off','required')) !!} 
                </div>

                   <div class="form-group col-md-12">
                    <label for="inputEmail4">{{$record->unit_title}} Short Code</label>                                                   
                    {!!Form::text('unit_short_code',null,array('class'=>'form-control','placeholder'=>'Enter unit','autocomplete'=>'off','required')) !!} 

                    <input type="hidden" name="unit_id" value="{{$record->id}}">
                </div>
          </div>


<button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i>   Submit</button>


         
<a class="btn" href="{{url('admin/unit')}}" style="background-color: #9e9b9b;color: #fff">Back</a>
            
{{Form::close()}}

</div>
<div class="col-md-8">

 <table class="table table-striped table-hover table-sm table-bordered table-responsive" >
                                        <thead>
                                            <tr>
                                                <th width="5%">Sr.</th>
                                                  <th width="20%">Category</th>
                                                <th width="20%">Value</th>
                                                 <th width="20%">Short Code </th>
                                                <th width="15%">Status</th> <th width="15%">Action</th>                         
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                            
                                            @if(!empty($records))
                                            @foreach($records as $index => $data)
                                            <tr class="deleteRow">
                                                <td>{{$index+1}}</td>   
                                                <td>{{$data->unit_value}}</td>
                                                <td>{{$data->unit_short_code}}</td>

                                                <td>
                                    
                 @if($data->status ==  'Active')

                                                    <input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="Deactive" data-onstyle="success" data-offstyle="danger" id="{{$data->id}}" class="checkstatus" onchange="updateToggle({{$data->id}})">
 @elseif($data->status ==  'Deactive')
<input type="checkbox" data-toggle="toggle" data-on="Active" data-off="Deactive" data-onstyle="success" data-offstyle="danger" id="{{$data->id}}" class="checkstatus" onchange="updateToggle({{$data->id}})">
   @endif

                                                </td>
                                                <td>                                                    
                                              <button  data-target="#edit{{ $data->id }}" data-toggle="modal"  class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></button>
                                                
                                                <button  class="btn btn-danger click_disbled"  data-toggle="tooltip" data-placement="top" title="Delete"  data="{{$data->id}}"><i class="fas fa-trash-alt"></i></button>                                 
                                               </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                            
                                        </tbody>
                                    </table>

    </div>

</div>


     

</div>
</div>

                                            @if(!empty($records))

 @foreach($records as $index => $data)


  <div class="modal fade comman-modal" id="edit{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header no-modal-header">
            Edit {{$data->unit_value}}

                <div class="close-btn">
                    <i class="far fa-times-circle" data-dismiss="modal" aria-label="Close"></i>
                </div>
          </div>

                   {!! Form::model($data,array('url' => ['admin/unit_value', $data->id],'method'=>'PATCH','class'=>'','id' =>'comman_form_id','files'=>'true')) !!}

          <div class="modal-body">
      

            <div class="form-row">

                  <!--   <div class="form-group col-md-12">
                    <label for="inputEmail4">Select Category</label>
         {!!Form::select('unit_category',$product_categories,null,array('class'=>'form-control selector select2','placeholder'=>'Select Country','data-toggle'=>'select2','autocomplete'=>'off','required')) !!}
                                                   
           </div> -->


                <div class="form-group col-md-12">
                    <label for="inputEmail4">{{$record->unit_title}} Value</label>                                                   
                    {!!Form::text('unit_value',null,array('class'=>'form-control','placeholder'=>'Enter unit Options','autocomplete'=>'off','required')) !!} 
                </div>

                   <div class="form-group col-md-12">
                    <label for="inputEmail4">{{$record->unit_title}} Short Code</label>                                                   
                    {!!Form::text('unit_short_code',null,array('class'=>'form-control','placeholder'=>'Enter unit','autocomplete'=>'off','required')) !!} 
                </div>
          </div>



          </div>
          <div class="modal-footer">
<button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i>   Submit</button>


         
            <button type="button" class="btn btn-raised btn-danger" data-dismiss="modal">Close</button>
            
{{Form::close()}}          </div>
        </div>
      </div>
    </div>

@endforeach
@endif

</div>
</main>

@endsection

<!-- ................push new js link................. -->

@push('js')
 <script src="{{asset('public/js/validation.js')}}"></script>
 <script src="{{asset('public/js/comman.js')}}"></script>


@endpush