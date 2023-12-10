@extends('admin.layouts.app')
@section('title',"Edit Seller Document | seller Mande Clan")

<!-- ................custom css................. -->

@section('customStyle')
@endsection

<!-- ................Add css link................. -->

@push('style')
       <link rel="stylesheet" href="{{asset('public/css/bootstrap-fileupload.css')}}">

@endpush

<!-- ................body................. -->
@section('innercontent')

  
<main class="content">
                    <div class="container-fluid p-0">
<div class="clearfix">
    <a href="{{ url()->previous() }}" class="form-inline float-right mt--1 d-none d-md-flex">
    <button class="btn btn-info"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Back</button>
    </a>
        <h1 class="h3 mb-3"><b>Update Seller Document</b></h1>

                    </div>
                                <div class="card">
                                
<div class="card-body">
     <div class="form-row">
                        
                         <div class="form-group col-md-4">
                          <div class="row">
                            <div class="col-md-4"><b>Stores Name</b></div>
                            <div class="col-md-1"><b>:</b></div>
                            <div class="col-md-6">{{$result->store_name}}</div>
                          </div>         
                        </div>
                        
                         <div class="form-group col-md-4">
                          <div class="row">
                            <div class="col-md-4"><b>Category</b></div>
                            <div class="col-md-1"><b>:</b></div>
                            <div class="col-md-6">{{$result->category_name}} </div>
                          </div>         
                        </div>
                        <div class="form-group col-md-4">
                          <div class="row">
                            <div class="col-md-4"><b>Mobile</b></div>
                            <div class="col-md-1"><b>:</b></div>
                            <div class="col-md-6">{{$result->store_mobile}}</div>
                          </div>         
                        </div>
                        <div class="form-group col-md-4">
                          <div class="row">
                            <div class="col-md-4"><b>Email
</b></div>
                            <div class="col-md-1"><b>:</b></div>
                            <div class="col-md-6">{{$result->store_email}} </div>
                          </div>         
                        </div>
                        <div class="form-group col-md-4">
                          <div class="row">
                            <div class="col-md-4"><b>Location</b></div>
                            <div class="col-md-1"><b>:</b></div>
                            <div class="col-md-6">{{$result->city_name}},{{$result->locality_name}} </div>
                          </div>         
                        </div>                                          
                                       
                       
                                                
                        </div>

<hr>
     @if(!empty($record))
       {!! Form::model($record,array('url' => ['admin/seller-document', $record->id],'method'=>'PATCH','class'=>'','id' =>'comman_form_id','files'=>'true')) !!}
      
       @endif
              <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputEmail6">Select document Name</label>                                                                 {!!Form::select('document_name',$documents,null,array('class'=>'form-control select2 ','placeholder'=>'Select Category','data-toggle'=>'select2','required')) !!}
                                   
                    </div>
                        <div class="form-group col-md-1">
</div>
                    <div class="form-group col-md-4">
                        <label for="inputEmail6">Upload File</label><br>                                                   
                        {!!Form::file('document_file',array('class'=>'form-control','placeholder'=>'Enter Seller Document','autocomplete'=>'off')) !!} 

                                                                      <td>
@if(!empty($record->document_file))
     <a href="{{asset('public/images/seller_document/'.$record->document_file)}}" > {{$record->document_file}}</a> 
    
@endif
                    </div>

                </div>
            


        <button type="submit" class="btn btn-primary"><i class="far fa-edit"></i>  Update</button>


                                         
<a class="btn" href="{{url('admin/seller-document')}}" style="background-color: #9e9b9b;color: #fff"><i class="fas fa-times"></i>  Cancel</a>
                                            
  {{Form::close()}}
</div>
</div>
</div>
</main>
@endsection

<!-- ................push new js link................. -->

@push('js')
 <script src="{{asset('public/js/validation.js')}}"></script>
<script type="text/javascript" src="{{ asset('public/js/bootstrap-fileupload.min.js') }}"></script>

@endpush