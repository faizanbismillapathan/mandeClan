@extends('customer.layouts.app')
@section('title',"All Manage Address | customer Mande Clan")

<!-- ................custom css................. -->

@section('customStyle')
<style type="text/css">
    .address_book_div .book-heading
{
  padding: 10px 15px;
  background-color: #fafafa;
  border-bottom: 1px solid #F5F5F5;
}
.address_book_div .book-heading h5
{
  margin-bottom: 0px;
  margin-top: 0px;
  text-transform: uppercase;
  font-size: 16px;
  color: #ef3b23;
}
.address_book_div .book-content
{
  padding: 15px;
}
.address_book_div .book-content h5
{
  margin-bottom: 10px;
}
.address_book_div .book-content p
{
  margin-top: 5px;
  margin-bottom: 5px;
}
/*.address_book_div .book-heading .fa-pen
{
  color: #8bc34a;
  padding-left: 8px;
  font-size: 25px;
}*/
.address_book_div .book-heading .fa-trash
{
  color: #ef3b23;
  padding-left: 8px;
}
.address_book_div .card
{
  margin-bottom: 0px;
}
.address_book_div a, .address_book_div a:hover
{
  color: #000;
}
.pull-right{
    float: right;
}
 
    @media only screen and (max-width: 500px) {
  .content{
        padding:0 !important;
    }
}
</style>
@endsection

<!-- ................Add css link................. -->

@push('style')
@endpush

<!-- ................body................. -->
@section('innercontent')

<main class="content profile-order-history">
    <div class="container-fluid p-2">

        <div class="clearfix">

<a href="{{url('customer/manage-address/create')}}" class="form-inline float-right mt--1 d-none d-md-flex">
<button class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create a New Address</button>
</a>
            <h1 class="h3 mb-3">Manage Address &nbsp;&nbsp;@if(!empty($records))({{(count($records))}})@endif</h1>
        </div>

        <div class="card">
            <div class="card-body">

<div class="address_book_div">
                        <div class="row" >

                            @if(!empty($records))
                            @foreach($records as $index=>$data)
                            <div class="col-md-12 deleteRow">
                                
                                <div class="card">
                                    <div class="book-heading">
                                        <div class="row">
                                            <div class="col-md-10 col-xs-8">
                                                <h5>ADDRESS {{$index+1}}</h5>
                                            </div>
                                            <div class="col-md-1 col-xs-2">

                                                <a class="click_disbled" title="Delete"   data="{{$data->id}}" id="{{$data->id}}">
                                                <div class="pull-right" style="color: red;">
                                                   <button class="btn btn-danger "> <i class="fas fa-trash-alt"></i></button>
                                                </div>
                                            </a>
                                            </div>
                                           
                                            <div class="col-md-1 col-xs-2">
                                              <a href="{{url('customer/manage-address/'.$data->id.'/edit')}}">
                                                <div class="pull-right">
                                                   <button class="btn btn-info ">    <i class="fas fa-pen"></i> </button>
                                                </div>
                                            </a>
                                        </div>
                                       
                                        
                                        </div>
                                    </div>
                                    <div class="book-content">
                                        <h5>{{$data->name}}</h5>
                                        <div class="row mob-margin0">
                                            <div class="col-md-3 col-xs-3 mob-padding0">
                                                <p>Mobile No.</p>
                                            </div>
                                            <div class="col-md-1 col-xs-1 mob-padding0">
                                                <p>:</p>
                                            </div>
                                            <div class="col-md-5 col-xs-6 mob-padding0">
                                                <p>{{$data->mobile}}</p>
                                            </div>
                                        </div>
                                        @if(!empty($data->phone))
                                        <div class="row mob-margin0">
                                            <div class="col-md-3 col-xs-3 mob-padding0">
                                                <p>Alternate Mobile No.</p>
                                            </div>
                                            <div class="col-md-1 col-xs-1 mob-padding0">
                                                <p>:</p>
                                            </div>
                                            <div class="col-md-5 col-xs-6 mob-padding0">
                                                <p>{{$data->phone}}</p>
                                            </div>
                                        </div>
                                        @endif

                                           <div class="row mob-margin0">
                                            <div class="col-md-3 col-xs-3 mob-padding0">
                                                <p>Address.</p>
                                            </div>
                                            <div class="col-md-1 col-xs-1 mob-padding0">
                                                <p>:</p>
                                            </div>
                                            <div class="col-md-5 col-xs-6 mob-padding0">
                                                 <p>@if(!empty($data->localitys)){{$data->localitys->locality_name}} @endif @if(!empty($data->citys)), {{$data->citys->city_name}} @endif  @if(!empty($data->states)), {{$data->states->state_name}} @endif @if(!empty($data->countrys)) ,{{$data->countrys->country_name}} @endif</p>
                                            </div>
                                        </div>




                                       
                                    </div>
                                </div>
                               
                            </div>
                            @endforeach
                            @endif


                            {{-- <div class="col-md-6">
                                <a href="{{url('customer/manage-address/1/edit')}}">
                                <div class="card">
                                    <div class="book-heading">
                                        <div class="row">
                                            <div class="col-md-6 col-xs-10">
                                                <h5>ADDRESS 1</h5>
                                            </div>
                                            <div class="col-md-6 col-xs-2">
                                                <div class="pull-right">
                                                    <i class="fas fa-pen"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="book-content">
                                        <h5>zareena</h5>
                                        <div class="row mob-margin0">
                                            <div class="col-md-5 col-xs-5 mob-padding0">
                                                <p>Primary Mobile No.</p>
                                            </div>
                                            <div class="col-md-1 col-xs-1 mob-padding0">
                                                <p>:</p>
                                            </div>
                                            <div class="col-md-5 col-xs-6 mob-padding0">
                                                <p>+91 9673259597</p>
                                            </div>
                                        </div>
                                        <div class="row mob-margin0">
                                            <div class="col-md-5 col-xs-5 mob-padding0">
                                                <p>Alternate Mobile No.</p>
                                            </div>
                                            <div class="col-md-1 col-xs-1 mob-padding0">
                                                <p>:</p>
                                            </div>
                                            <div class="col-md-5 col-xs-6 mob-padding0">
                                                <p>+91 </p>
                                            </div>
                                        </div>
                                        <p>sadar nagpur Ajni nagpur 440003 Maharashtra</p>
                                    </div>
                                </div>
                                </a>
                            </div> --}}
                            
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