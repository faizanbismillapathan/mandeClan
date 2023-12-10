@extends('customer.layouts.app')
@section('title',"All WishList Product | customer Mande Clan")

<!-- ................custom css................. -->

@section('customStyle')
<style type="text/css">
.list-of-shops .img img {
/*position: absolute;*/
width: 100%;
height: 100%;
}
.list-of-shops .content-div {
/*background-color: #ffffff;*/
padding: 5px;
}

.shop-name {
font-size: 14px !important;
margin-bottom: 5px !important;
text-transform: capitalize;
font-weight: 500;
color: #9e9e9e;

}

.list-of-shops .content-div .p1 {
margin-bottom: 8px;
font-size: 13px;
color: #000;
}

.content-div .col-md-3,.content-div .col-md-4,.content-div .col-md-12,.content-div .col-md-10,.content-div .col-md-2,.content-div .col-md-9{
    margin-top: 5px;
}

#heart_dislike{
color: red;
font-size: 20px;
}
#heart_dislike, #heart_like {

font-size: 20px;
}

.list-of-shops .img img{
    height: 270px;
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

<h1 class="h3 mb-3">WishList Product &nbsp;&nbsp;@if(!empty($records))({{$records->total()}})@endif</h1>
</div>

<div class="card">
<div class="card-body">
<div class="row  list-of-shops">
<div class="col-md-3 col-xs-6 ">
<a href="{{ url('#') }}">
    <div class="card card1" id="111">
        <div class="shop-div">

            <div class="img">
                <img src="{{url('public/img/demo1.jpg')}}">

            </div>

            <div class="content-div row">
                                <div class="col-md-12">
<h5 class="shop-name">Trendy Rayon Tops For Women
                </h5></div>
                <div class="col-md-3">
                     <b class="text-dark">₹161</b>
                </div>
                  <div class="col-md-3">
                     <del class="text-muted">₹230</del>
                  </div>
                    <div class="col-md-4">
                        <span class="text-success">30% off
                    </span> 
                </div>

                <div class="col-md-9">
                    <span class="badge badge-warning"><i class="fas fa-star"></i> 3.4</span>
                  
                </div>
                <div class="col-md-3 like">

                   <i class="fas fa-heart"  id="heart_dislike" data=""></i>

                   <i class="far fa-heart" id="heart_like" style="display:none" data=""></i>

               </div>

               <div class="col-md-12">
                     <span class="text-dark">400 Ratings, 71 Reviews
                    </span>
               </div>

           </div>
       </div>
   </div>
</a>
</div>
<div class="col-md-3 col-xs-6 ">
<a href="{{ url('#') }}">
    <div class="card card1" id="111">
        <div class="shop-div">

            <div class="img">
                <img src="{{url('public/img/demo1.jpg')}}">

            </div>

            <div class="content-div row">
                                <div class="col-md-12">
<h5 class="shop-name">Trendy Rayon Tops For Women
                </h5></div>
                <div class="col-md-3">
                     <b class="text-dark">₹161</b>
                </div>
                  <div class="col-md-3">
                     <del class="text-muted">₹230</del>
                  </div>
                    <div class="col-md-4">
                        <span class="text-success">30% off
                    </span> 
                </div>

                <div class="col-md-9">
                    <span class="badge badge-warning"><i class="fas fa-star"></i> 3.4</span>
                  
                </div>
                <div class="col-md-3 like">

                   <i class="fas fa-heart"  id="heart_dislike" data=""></i>

                   <i class="far fa-heart" id="heart_like" style="display:none" data=""></i>

               </div>

               <div class="col-md-12">
                     <span class="text-dark">400 Ratings, 71 Reviews
                    </span>
               </div>

           </div>
       </div>
   </div>
</a>
</div>
<div class="col-md-3 col-xs-6 ">
<a href="{{ url('#') }}">
    <div class="card card1" id="111">
        <div class="shop-div">

            <div class="img">
                <img src="{{url('public/img/demo1.jpg')}}">

            </div>

            <div class="content-div row">
                                <div class="col-md-12">
<h5 class="shop-name">Trendy Rayon Tops For Women
                </h5></div>
                <div class="col-md-3">
                     <b class="text-dark">₹161</b>
                </div>
                  <div class="col-md-3">
                     <del class="text-muted">₹230</del>
                  </div>
                    <div class="col-md-4">
                        <span class="text-success">30% off
                    </span> 
                </div>

                <div class="col-md-9">
                    <span class="badge badge-warning"><i class="fas fa-star"></i> 3.4</span>
                  
                </div>
                <div class="col-md-3 like">

                   <i class="fas fa-heart"  id="heart_dislike" data=""></i>

                   <i class="far fa-heart" id="heart_like" style="display:none" data=""></i>

               </div>

               <div class="col-md-12">
                     <span class="text-dark">400 Ratings, 71 Reviews
                    </span>
               </div>

           </div>
       </div>
   </div>
</a>
</div>
<div class="col-md-3 col-xs-6 ">
<a href="{{ url('#') }}">
    <div class="card card1" id="111">
        <div class="shop-div">

            <div class="img">
                <img src="{{url('public/img/demo1.jpg')}}">

            </div>

            <div class="content-div row">
                                <div class="col-md-12">
<h5 class="shop-name">Trendy Rayon Tops For Women
                </h5></div>
                <div class="col-md-3">
                     <b class="text-dark">₹161</b>
                </div>
                  <div class="col-md-3">
                     <del class="text-muted">₹230</del>
                  </div>
                    <div class="col-md-4">
                        <span class="text-success">30% off
                    </span> 
                </div>

                <div class="col-md-9">
                    <span class="badge badge-warning"><i class="fas fa-star"></i> 3.4</span>
                  
                </div>
                <div class="col-md-3 like">

                   <i class="fas fa-heart"  id="heart_dislike" data=""></i>

                   <i class="far fa-heart" id="heart_like" style="display:none" data=""></i>

               </div>

               <div class="col-md-12">
                     <span class="text-dark">400 Ratings, 71 Reviews
                    </span>
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