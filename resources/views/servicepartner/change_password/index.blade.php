@extends('servicepartner.layouts.app')
@section('title',"All Change Password | Service Partner Mande Clan")

<!-- ................custom css................. -->

@section('customStyle')
@endsection

<!-- ................Add css link................. -->

@push('style')
@endpush

<!-- ................body................. -->
@section('innercontent')

<main class="content profile-order-history">
    <div class="container-fluid p-0">

        <div class="clearfix">

            <h1 class="h3 mb-3">Change Password &nbsp;&nbsp;@if(!empty($records))({{$records->total()}})@endif</h1>
        </div>

        <div class="card">
            <div class="card-body">
<div class="row">   

<div class="form-group col-md-4">
<label for="inputEmail4">Current Password</label>                                                   
{!!Form::password('support_name',array('class'=>'form-control','placeholder'=>'Enter Support Ticket  ','autocomplete'=>'off','required')) !!} 
</div>
</div>
<div class="row">   

<div class="form-group col-md-4">
<label for="inputEmail4">New Password</label>                                                   
{!!Form::password('support_name',array('class'=>'form-control','placeholder'=>'Enter Support Ticket  ','autocomplete'=>'off','required')) !!} 
</div>
</div>
<div class="row">   

<div class="form-group col-md-4">
<label for="inputEmail4">Confirm Password</label>                                                   
{!!Form::password('support_name',array('class'=>'form-control','placeholder'=>'Enter Support Ticket  ','autocomplete'=>'off','required')) !!} 
</div>
</div>
<button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i>   Submit</button>


</div>


</div>

</div>

            </div>
        </div>


    </div>     

</main> 


@endsection

<!-- ................push new js link................. -->

@push('js')
<script src="{{asset('public/js/comman.js')}}"></script>
@endpush