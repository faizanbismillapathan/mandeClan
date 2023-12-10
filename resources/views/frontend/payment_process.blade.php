@extends('frontend.layouts.app')
@section('title',"Online Shopping site in US: Shop Online for Mobiles, Books, Watches, Shoes and More - mandeclan.com")
<!-- ................Add meta ................ -->


@section('meta')
@endsection

<!-- ................custom css................. -->

@section('customStyle')
<style type="text/css">
</style>
@endsection

<!-- ................Add css link................. -->

@push('style')
@endpush

<!-- ................body................. -->
@section('innercontent')  


<nav class="breadcrumb-nav">
   <div class="breadcrumb-padding">
      <div class="container-fluid">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/'.Session::get('locality_url'))}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page" style="text-transform:capitalize;">Payment Process</li>
          </ol>
      </div>
   </div>
</nav>

     @endsection

@push('js')
<script src="{{asset('public/js/comman.js')}}"></script>
@endpush