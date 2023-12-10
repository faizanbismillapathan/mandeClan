@extends('customer.layouts.app')
@section('title',"All Rating & Review | customer Mande Clan")

<!-- ................custom css................. -->

@section('customStyle')
<style type="text/css">
    .container_rat1 li {
        display: inline-block;
        font-size: 15px;
        color: orange;
        cursor: pointer;
    }

    .container_rat1{

        padding: 0px;

    }
    .div1{
        padding: 10px;
        border: 1px solid #ccc;
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

            <h1 class="h3 mb-3">Rating & Review &nbsp;&nbsp;@if(!empty($variable))({{$variable->total()}})@endif</h1>
        </div>

        <div class="card">
            <div class="card-body">
                 <div class="row">


                    @if(!empty($records))
@foreach($records as $index=>$data)
                        <div class="col-md-6">
                <div class="div1">
                    <div class="row">
                        <div class="col-md-12">
                            <h4> <span class="shop-id badge badge-warning">Order No: {{$data->suborder_u_id}}</span></h4>
                        </div>
                        <div class="col-md-4 col-xs-4">
                            <div class="img">
                               
                                @if(!empty($data->store_info->store_cover_photo))
<img src="{{ asset('public/images/store_cover_photo/'.$data->store_info->store_cover_photo)}}" width="150px" height="150px" />
@else
<img src="{{ asset('public/img/no-image.png')}}" width="150px" height="150px" />
@endif


                            </div>
                        </div>
                        <div class="col-md-8 col-xs-8">
                            <h4>{{$data->store_info->store_name}} ({{$data->store_info->category->category_name}})</h4>
                            <p>Delivered on {{date('d-M-y',strtotime($data->delivery_date))}} </p>
                            

                            @if(!empty($data->reviews) && !empty($data->rating)) 
                            <p>{!!$data->reviews!!}</p>

                            <ul class="container_rat1">
                                @for ($x = 1; $x <= $data->rating; $x++)
                                <li class="star"><i class="fa fa-star"></i></li>
                                @endfor                                       
                            </ul>
                         {{--  
                            <a href="{{url('/')}}/customer/rating-review/{{$data->id}}">
<button class="btn  btn-info">
   Add a Review
</button>
</a> --}}


                            @else


                            <a href="{{url('/')}}/customer/rating-review/{{$data->id}}">
<button class="btn  btn-info">
   Add a Review
</button>
</a>

                            @endif

                        </div>
                    </div>
                </div>
</div>

  
@endforeach
@endif

  


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