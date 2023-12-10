@extends('frontend.layouts.app')
@section('title',"Online Shopping site in US: Shop Online for Mobiles, Books, Watches, Shoes and More - mandeclan.com")
<!-- ................Add meta ................ -->


@section('meta')
@endsection

<!-- ................custom css................. -->

@section('customStyle')
<style type="text/css">
    .padding.mande-main-category{

        display: none!important;
    }
</style>
@endsection

<!-- ................Add css link................. -->

@push('style')
@endpush

<!-- ................body................. -->
@section('innercontent')

<div class="thank-u"></div>
        <div class="thank-u-content text-center m-auto p-5">
            <h1 class="text-success">Thank You</h1>
            <div class="image p-2">
                
            
            <h4 class="text-warning"> <img style="width:30px" src="{{ asset('public/frontend/img/checked.png') }}"> Order Successfully Placed 
            </h4>
            </div>
            <hr>
           
          @if(!Auth::guest())

   @if(Auth::user()->role == "2")
               <a href="{{ url('/seller/plan-history') }}">

   @elseif(Auth::user()->role == "3")
               <a href="{{ url('/customer/plan-history') }}">

   @elseif(Auth::user()->role == "5")
               <a href="{{ url('/service/plan-history') }}">

@endif

@endif

            <a href="{{ url('/customer/my-orders') }}">
                <div class="center">
                    <button class="btn btn-raised btn-success mt-3">Go  &nbsp; To &nbsp; History</button>
                </div>
            </a>
        </div>
@endsection

<!-- ................push new js link................. -->

@push('js')
<script src="{{asset('public/js/comman.js')}}"></script>
@endpush


