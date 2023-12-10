@extends('customer.layouts.app')
@section('title',"All Follower Stores | customer Mande Clan")

<!-- ................custom css................. -->

@section('customStyle')
<style type="text/css">
    .list-of-shops .img img {
    /*position: absolute;*/
    width: 100%;
    height: 100%;
}
.list-of-shops .content-div {
    background-color: #ffffff;
    padding: 5px;
}

.shop-name {
    font-size: 14px !important;
    margin-bottom: 5px !important;
    text-transform: capitalize;
    font-weight: 500;
    color: #212529;
    padding-left: 13px;
}

.list-of-shops .content-div .p1 {
    margin-bottom: 8px;
    font-size: 13px;
    color: #9E9E9E;
}



#heart_dislike{
color: red;
    font-size: 20px;

}
#heart_dislike, #heart_like {
    /*position: absolute;
    top: 2px;
    right: 2px;*/
    font-size: 20px;
}
</style>
@endsection

<!-- ................Add css link................. -->

@push('style')
@endpush

<!-- ................body................. -->
@section('innercontent')

<main class="content profile-order-history">
    <div class="container-fluid p-0">

        <div class="clearfix">

            <h1 class="h3 mb-3">Follower Stores &nbsp;&nbsp;@if(!empty($records))({{$records->total()}})@endif</h1>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row  list-of-shops">
 <div class="col-md-4 col-xs-6 ">
                            <a href="{{ url('#') }}">
                                <div class="card card1" id="111">
                                    <div class="shop-div">
                                        
                                        <div class="img">
                    <img src="{{url('public/img/mandeclan1.jpg')}}">

                                        </div>
                                        
                                        <div class="content-div row">
                                            <h5 class="shop-name">zareena kirana store</h5>
                                            <div class="col-md-10">
                                                
                                            <p class="p1">Nagpur Sadar</p>
                                            </div>

                                            <div class="col-md-2 like">
                                            
 <i class="fas fa-heart"  id="heart_dislike" data=""></i>

<i class="far fa-heart" id="heart_like" style="display:none" data=""></i>

                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
</div>
 <div class="col-md-4 col-xs-6 ">

                            <a href="{{ url('#') }}">
                                <div class="card card1" id="111">
                                    <div class="shop-div">
                                        <div class="img">
                                            <img src="{{url('public/img/mandeclan1.jpg')}}">
                                        </div>
                                         <div class="content-div row">
                                            <h5 class="shop-name">zareena kirana store</h5>
                                            <div class="col-md-10">
                                                
                                            <p class="p1">Nagpur Sadar</p>
                                            </div>

                                            <div class="col-md-2 like">
                                            
 <i class="fas fa-heart"  id="heart_dislike" data=""></i>

<i class="far fa-heart" id="heart_like" style="display:none" data=""></i>

                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
</div>
 <div class="col-md-4 col-xs-6 ">

                            <a href="{{ url('#') }}">
                                <div class="card card1" id="111">
                                    <div class="shop-div">
                                        <div class="img">
                                            <img src="{{url('public/img/mandeclan1.jpg')}}">
                                        </div>
                                         <div class="content-div row">
                                            <h5 class="shop-name">zareena kirana store</h5>
                                            <div class="col-md-10">
                                                
                                            <p class="p1">Nagpur Sadar</p>
                                            </div>

                                            <div class="col-md-2 like">
                                            
 <i class="fas fa-heart"  id="heart_dislike" data=""></i>

<i class="far fa-heart" id="heart_like" style="display:none" data=""></i>

                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
</div>
 <div class="col-md-4 col-xs-6 ">

                            <a href="{{ url('#') }}">
                                <div class="card card1" id="111">
                                    <div class="shop-div">
                                        <div class="img">
                                            <img src="{{url('public/img/mandeclan1.jpg')}}">
                                        </div>
                                         <div class="content-div row">
                                            <h5 class="shop-name">zareena kirana store</h5>
                                            <div class="col-md-10">
                                                
                                            <p class="p1">Nagpur Sadar</p>
                                            </div>

                                            <div class="col-md-2 like">
                                            
 <i class="fas fa-heart"  id="heart_dislike" data=""></i>

<i class="far fa-heart" id="heart_like" style="display:none" data=""></i>

                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
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