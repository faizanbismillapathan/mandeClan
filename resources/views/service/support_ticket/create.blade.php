@extends('service.layouts.app')
@section('title',"Create New Support Ticket   | Service Mande Clan")

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
<a href="{{url('service/support-ticket')}}" class="form-inline float-right mt--1 d-none d-md-flex">
<button class="btn btn-info"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Back</button>
</a>

<h1 class="h3 mb-3"><b>Create Support Ticket  </b></h1>

</div>
<div class="card">

<div class="card-body">

{!!Form::open(['url'=>['service/support-ticket'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}

<div class="form-row">
<div class="form-group col-md-4">
<label for="inputEmail4">Support Ticket  Name</label>              

   {!!Form::select('ticket_name',$tickets,null,array('class'=>'form-control','placeholder'=>'Enter Support Ticket  ','autocomplete'=>'off','required')) !!} 
                                  
<!-- {!!Form::text('support_name',null,array('class'=>'form-control','placeholder'=>'Enter Support Ticket  ','autocomplete'=>'off','required')) !!}  -->
</div>

<div class="form-group col-md-4">
<label for="inputEmail4">Your  Name</label>                                                   
{!!Form::text('vendor_name',Auth::user()->name,array('class'=>'form-control','placeholder'=>'Enter Support Ticket  ','autocomplete'=>'off','required','readonly')) !!} 
</div>

<div class="form-group col-md-4">
<label for="inputEmail4">Email</label>                                                   
{!!Form::text('vendor_email',Auth::user()->email,array('class'=>'form-control','placeholder'=>'Enter Support Ticket  ','autocomplete'=>'off','required','readonly')) !!} 
</div>


              <div class="col-md-4">
                <label for="file">Attachment</label>
               {!! Form::file('attachment', array('class' => 'form-control')) !!}
            </div>


<div class="form-group col-md-8">
<label for="inputEmail8">Subject</label>                                                   
{!!Form::text('subject',null,array('class'=>'form-control','placeholder'=>'Enter Support Ticket  ','autocomplete'=>'off','required')) !!} 
</div>


<div class="form-group col-md-12">
<label for="inputEmail4">Message</label>                                                   
{!!Form::textarea('message',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','required','maxlength'=>'600')) !!}
</div>

</div>


<button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i>   Submit</button>



<a class="btn" href="{{url('service/support-ticket')}}" style="background-color: #9e9b9b;color: #fff"><i class="fas fa-times"></i>  Cancel</a>

{{Form::close()}}
</div>
</div>
</div>
</main>
@endsection

<!-- ................push new js link................. -->

@push('js')

<script src="{{asset('public/js/validation.js')}}"></script>
   <script src="{{asset('public/basic-ckeditor/ckeditor.js')}}"></script>
  <script>
        CKEDITOR.replace( 'service_plan_features');
    </script>
@endpush