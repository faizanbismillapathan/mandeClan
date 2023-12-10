@extends('servicepartner.layouts.app')
@section('title',"Create New Document | Service Partner Mande Clan")

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
            <a href="{{url('service-partner/document')}}" class="form-inline float-right mt--1 d-none d-md-flex">
                <button class="btn btn-info"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Back</button>
            </a>

            <h1 class="h3 mb-3"><b>Create Document</b></h1>

        </div>
        <div class="card">

            <div class="card-body">

               {!!Form::open(['url'=>['service-partner/document'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}


                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputEmail6">Select document Name</label>                                                                 {!!Form::select('document_name',$documents,null,array('class'=>'form-control select2 ','placeholder'=>'Select Category','data-toggle'=>'select2','required')) !!}
                                   
                    </div>
                        <div class="form-group col-md-1">
</div>
                    <div class="form-group col-md-4">
                        <label for="inputEmail6">Upload File</label><br>                                                   
                        {!!Form::file('document_file',null,array('class'=>'form-control','placeholder'=>'Enter Document','autocomplete'=>'off','required')) !!} 
                    </div>

                </div>
            




    <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i>   Submit</button>



    <a class="btn" href="{{url('service-partner/document')}}" style="background-color: #9e9b9b;color: #fff"><i class="fas fa-times"></i>  Cancel</a>

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