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
                
            
            <h4 class="text-warning"> <img style="width:30px" src="{{ asset('public/frontend/img/checked.png') }}">Your Enquiry has been Successfully Submitted .Please Wait for the approval.
            </h4>
            </div>
            <hr>
           
         
                <div class="center">
                       <a href="{{ url('/') }}">
                    <button class="btn btn-raised btn-success mt-3">Go  &nbsp; To &nbsp; Home</button>
                     </a>
                </div>
           
        </div>
@endsection

<!-- ................push new js link................. -->

@push('js')
<script src="{{asset('public/js/comman.js')}}"></script>
@endpush


