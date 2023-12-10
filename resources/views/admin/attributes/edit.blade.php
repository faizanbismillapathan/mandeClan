@extends('admin.layouts.app')
@section('title',"Edit Attributes | Admin Mande Clan")

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
    <a href="{{url('admin/product-attribute')}}" class="form-inline float-right mt--1 d-none d-md-flex">
    <button class="btn btn-info"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Back</button>
    </a>
        <h1 class="h3 mb-3"><b>Update Attributes</b></h1>

                    </div>
                                <div class="card">
                                
<div class="card-body">
     @if(!empty($record))
       {!! Form::model($record,array('url' => ['admin/product-attribute', $record->id],'method'=>'PATCH','class'=>'','id' =>'comman_form_id','files'=>'true')) !!}
      
       @endif

                                           
               <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputEmail4">Select Unit Type</label>
                    @if(!empty($units))
                    {!!Form::select('unit_id',$units,null,array('class'=>'form-control select2','placeholder'=>'Select Unit','data-toggle'=>'select2','autocomplete'=>'off','disabled')) !!}                                                   
                    @endif
                </div>

            </div>
           <!--  <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputEmail4">Enter Attribute Name</label>                                                   
                    {!!Form::text('attr_name',null,array('class'=>'form-control','placeholder'=>'Enter product-attribute','autocomplete'=>'off','required')) !!} 
                </div>
            </div> -->


      

                  <div class="form-row">
                    <div class="form-group col-md-12">
                              <div class="card">

                     <div class="card-header" style="border-bottom:1px solid #ccc">
                       <div class="row margin0" >
                        <div class="col-md-6">

                            <label for="inputEmail4">Choose Category:</label>
                        </div>
                            <div class="col-md-6">
                                <label class="pull-right">
                                    <input type="checkbox" class="selectallbox"> Select All
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="card-content" style="padding:20px">
                        <div class="row margin0">


                         @if(!empty($categories))
                         @foreach($categories as $index=>$data)  
                         <div class="col-md-2 padding0">
                           <div class="checkbox">
                              <label>
                                @if(!empty($record->category_id))
                                {{ Form::checkbox('category_id[]',$data->id,in_array($data->id, explode(',',$record->category_id)) ? true : false, array('id'=>'category_id1')) }} {{ $data->product_category }}
                                @else
                                {{ Form::checkbox('category_id[]',$data->id,null,['id'=>'ssss']) }} {{ $data->product_category }}

                                @endif
                            </label>
                        </div>
                    </div>
                    @endforeach
                    @endif


                </div>                                
            </div>
        </div>

    </div>
</div>

        <button type="submit" class="btn btn-primary"><i class="far fa-edit"></i>  Update</button>


                                         
<a class="btn" href="{{url('admin/product-attribute')}}" style="background-color: #9e9b9b;color: #fff"><i class="fas fa-times"></i>  Cancel</a>
                                            
  {{Form::close()}}
</div>
</div>
</div>
</main>
@endsection

<!-- ................push new js link................. -->

@push('js')
 <script src="{{asset('public/js/validation.js')}}"></script>

@endpush