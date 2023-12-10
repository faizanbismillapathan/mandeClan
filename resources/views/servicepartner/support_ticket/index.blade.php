@extends('..servicepartner.layouts.app')
@section('title',"All Support Ticket   | Service-partner Mande Clan")

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




<a href="{{url('service-partner/support-ticket/create')}}" class="form-inline float-right mt--1 d-none d-md-flex">
<button class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create a New Support Ticket  </button>
</a>

<h1 class="h3 mb-3">Support Ticket  &nbsp;&nbsp;@if(!empty($records))({{$records->total()}})@endif</h1>
</div>

<div class="card">
<div class="card-body">
<div class="row">
<div class="col-md">
{{Form::open(['url'=>['service-partner/support-ticket'],'method'=>'GET'])}}

@if(!empty($support_ticket))
{!!Form::select('search',$support_ticket,null,array('class'=>'form-control select2','placeholder'=>'Search','data-toggle'=>'select2','onchange'=>'this.form.submit()')) !!}
@endif


{{Form::close()}}
</div>
<div class="col-md">

</div>
<div class="col-md">
<div class="form-group">
{{Form::open(['url'=>['service-partner/support-ticket'],'method'=>'GET'])}}

<div class="input-group">

{!!Form::text('search',Request::input('search'),array('class'=>'form-control','placeholder'=>'Filter  ..','onchange'=>'this.form.submit()','autocomplete'=>'off')) !!}

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
<th width="10%">Ticket No</th>
<th width="15%">Name</th>
<th width="15%">Subject </th>
<th width="35%">Message</th>
<th width="15%">Status</th>
<th width="15%">Last Update
</th>
</tr>
</thead>
<tbody>

@if(!empty($records))
@foreach($records as $index => $data)
<tr class="deleteRow">
<td><span class="badge badge-info">{{$data->ticket_no}}</span></td>

<td>{{$data->ticket_name}}</td>

<td>{{$data->subject}}</td>
<td>{{$data->message}}</td>

<td>

<a href="{{url('service-partner/support-ticket-msg/'.$data->id)}}"><button class="btn btn-info">{{$data->status}}</button></a>

</td>
<td>                                                    
{{date("d-m-Y", strtotime($data->created_at))}}                            
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