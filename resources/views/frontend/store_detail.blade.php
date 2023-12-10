@extends('frontend.layouts.app')
@section('title',"Online Shopping site in US: Shop Online for Mobiles, Books, Watches, Shoes and More - mandeclan.com")
<!-- ................Add meta ................ -->


@section('meta')
@endsection

<!-- ................custom css................. -->

@section('customStyle')
<style type="text/css">
     .mande-main-category{
        display: none!important;
    }
    .padding{
        padding: 20px;
    }
   .upload-image .card1{
    box-shadow:unset;
}
.section-inner-view{
    text-align:center;
}
.section-inner-view h4{
    font-size: 1rem;
    text-align:center;
    font-weight:normal;
    margin-bottom:20px;
}
.section-inner-view .btn-primary{
    color:#fff;
    background:#f26e21;
    padding:12px 20px;
}
.section-inner-view .btn-primary:hover{
    color:#fff;
    background:#f88c4e;
    padding:12px 20px;
}
.section-inner-view1{
    width:85%;
    margin:auto;
    margin-top:5%;
}
.section-inner-view1 .mandeclan-upload-h2{
    font-size:1.5rem;
    color:#ab4408;
}
.section-inner-view1 .mandeclan-upload-steps{

}
.section-inner-view1 .mandeclan-upload-h3{
    font-size:1.4rem;
    color:#ab4408;
}
.section-inner-view1 span{
    font-size: .813rem;
    width: 1.5rem;
    height: 1.5rem;
    border: solid 2px #ff7300;
    color: #ff7300;
    text-align: center;
    border-radius: 100%;
    line-height: 1.375rem;
    font-weight: 500;
    margin-right: 1rem;
    margin-bottom: .563rem;
}
.upload-mande-list-h4{
    font-family: Roboto;
    font-size: 1.125rem;
    font-weight: 500;
    font-style: normal;
    font-stretch: normal;
    line-height: normal;
    letter-spacing: normal;
    text-align: center;
    color: #333;
}
.browse-gallery{
    width:15.5rem;
    text-transform:uppercase;
    background:transparent;
    border:solid 1px #134f70;
    color:#134f70;
    outline:0;
    -webkit-box-shadow:none;
    box-shadow:none;
    text-align:center;
    height:2.25rem;
    font-size:.75rem;
    border-radius:.25rem;
    font-weight:500;
    cursor:pointer;
    padding:.68rem;
}
.upload_part{
    width:100%;
    text-align:center;
}
.input-buttons-sty{
    width:100%;
    text-align: center;
}
.browse-gallery-para{
    font-size: .6rem;
}
.whitePanel{
    border:1px dashed #777;
}
.image-upload-points{
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: justify;
    -ms-flex-pack: justify;
    justify-content: space-between;
}
.image-upload-points li{
    -webkit-box-flex: 1;
    -ms-flex: 1;
    flex: 1;
    list-style: none;
}
.image-upload-points li .div1{
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    border-color: #ff7300;
    color: #ff7300;
    border-width: .063rem;
    width: 2.5rem;
    height: 2.5rem;
    border-radius: 50%;
    border-style: solid;
    margin: auto;
}
.image-upload-points li .div2{
    font-family: Roboto;
    font-size: .75rem;
    font-weight: 500;
    font-style: normal;
    font-stretch: normal;
    line-height: normal;
    letter-spacing: normal;
    text-align: center;
    color: #666;
    margin-top: .625rem;
}
.three-step-para{
    text-align: center;
    font-weight: bold;
    margin-top: 15px;
    margin-bottom: 10px;
}
.btn-custom{
    color: #fff;
    background: #ef9967;
}
.row.otpfield{
    margin-bottom:15px;
}
.row.otpfield .otpfield1{
    display: inline-block;
    width: 23.5%;
    margin-right: 0.5%;
    padding-top: 0.75rem;
    padding-bottom: 1rem;
    background: unset;
    border: unset;
    border-bottom: 2px solid #fff;
    color: #fff;
    margin: auto;
}
.btn.custom-btn {
       text-transform: capitalize;
    padding: 10px 20px;
    font-weight: 500;
    color: #fff;
    background: #f26e21;
    border-radius: 18px;
}
  .stars {
    display: inline-block;
    font-size: 12px;
    color: orange;
    cursor: pointer;
}

.btn.btn-outline-light.likes {
    color: #d54b3d;
    border: 1px solid #d54b3d;
    background: #ffffff;
}

.btn.btn-outline-light.unlike {
    color: #d54b3d;
    border: 1px solid #d54b3d;
    background: #ffffff;
}

.first-navbar .btn.btn-light ,.mande-main-category.padding{
    display: none !important;
}

.showWhenCityNot{
    display: block !important;
}

@media (max-width: 480px) {
    .showWhenCityNot{
    display: none !important;
    }
  }

</style>
@endsection

<!-- ................Add css link................. -->

@push('style')
@endpush

<!-- ................body................. -->
@section('innercontent')
<body style="width:100%;padding-right:0px;" data-new-gr-c-s-check-loaded="14.1039.0" data-gr-ext-installed="">


    <nav class="breadcrumb-nav">
        <div class="breadcrumb-padding">
            <div class="container-fluid">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{url('/'.Session::get('locality_url'))}}">Home</a>
                    </li>
                  
                    <li class="breadcrumb-item">
                     <a href="{{url(Session::get('locality_url').'/'.$record->category->category_url.'/store-list')}}">{{$record->category->category_name}} in {{Session::get('locality_name')}}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{$record->store_name}}</li>
                </ol>
            </div>
        </div>
    </nav>
    <!--  -->
    <div class="black shop-details-page">
        <div class="container-fluid">
            <div class="row py-lg-3">
                <div class="col-md-10">
                    <div class="row">
                     <div class="col-md-4 col-sm-12">
                      <div class="shop-banner">

                @if(!empty($record->store_cover_photo))
                <img src="{{ asset('public/images/store_cover_photo/'.$record->store_cover_photo)}}" alt="dd" />
                @else
                <img src="{{url('/')}}/public/frontend/img/mandeclan1.jpg" alt="dd" />
                @endif

                      </div>
                  </div>
                  <div class="col-md-7 mx-1">
                      <h4 style="color: orange;" >{{$record->store_name}}</h4>
                      <p class="p1"><i class="fas fa-map-marker-alt"></i> {{$record->locality->locality_name}}, {{$record->city->city_name}}, {{$record->state->state_name}}, {{$record->country->country_name}}.</p>
                      <div class="row row1" style="margin: auto;margin-top: 20px; padding-top: 20px; border-radius: 3px;padding-bottom: 15px;" >
                          
                       <div class="col-md-4 col-xs-3">
                        <b><i class="fas fa-star"></i> {{$avg_rating}}</b>
                        <p>{{$reviews_count}}+ Rating</p>
                    </div>
                    @if(!empty($record->store_open_time))
                    <div class="col-md-4 col-xs-5">
                        <b>{{$record->store_open_time}} to {{$record->store_close_time}}</b>
                        <p>Open & Close Time</p>
                    </div>
                    @endif
                    
                     <div class="col-md-1 col-xs-1 whishlist">
         <div>
       {{--  <a href="{{url('order/'.$record->store_link)}}">
            <button type="button" class="btn custom-btn" value="">Order Now<div class="ripple-container"></div></button>
        </a> --}}

        @if(!Auth::guest())
           
             @if($like_dislike=='Like')
            
            <button type="button" class="btn btn-outline-light likes heart_dislike" id="heart_dislike_{{$record->id}}" data="{{$record->id}}" store_id="{{$record->id}}" store_user_id="{{$record->user_id}}"><i class="fas fa-heart"></i> <span>Liked</span><div class="ripple-container"></div></button>
            
            
            <button  type="button" class="btn btn-outline-light unlike heart_like" style="display:none"  id="heart_like_{{$record->id}}"  data="{{$record->id}}" 
            store_id="{{$record->id}}" store_user_id="{{$record->user_id}}"><i class="far fa-heart"></i> <span>Like</span></button>
                
            
            
            @else
            <button type="button" class="btn btn-outline-light likes heart_dislike" style="display:none" id="heart_dislike_{{$record->id}}" data="{{$record->id}}" store_id="{{$record->id}}" store_user_id="{{$record->user_id}}"><i class="fas fa-heart"></i> <span>Liked</span><div class="ripple-container"></div></button>
            
            
            <button  type="button" class="btn btn-outline-light unlike heart_like" id="heart_like_{{$record->id}}"  data="{{$record->id}}" 
            store_id="{{$record->id}}" store_user_id="{{$record->user_id}}"><i class="far fa-heart"></i> <span>Like</span></button>
            
            
            @endif
            
            @else
            
            <a href="{{url('customer-login')}}">
            <button  type="button" class="btn btn-outline-light unlike heart_like"   id="heart_like_{{$record->id}}"  data="{{$record->id}}" 
            store_id="{{$record->id}}" store_user_id="{{$record->user_id}}"><i class="far fa-heart"></i> <span>Like</span></button>
            </a>
            
            @endif

        </div>
   
    </div>
                 
                </div>
            </div>
        </div>
    </div>
   
</div>
</div>
</div>
<!--  -->
<div class="shop-details-div pt-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <div class="">
                    <div class="">
                     <ul class="nav nav-tabs">
                         <li><a href="#overview" data-toggle="tab" class="active show">Overview</a></li>
                         <li>
                                 
  <a href="{{url('order/'.$record->store_link.'?category='.$cat_id)}}">
Order Now</a>
                        </li>
                        <li><a href="#reviews" data-toggle="tab">Reviews</a></li>
                        <li><a href="#photos" data-toggle="tab">Photo Gallery</a></li>
                        
                    </ul>
                </div>
                
                <div class="tab-content" id="tabs">
                 <div class="tab-pane overview active show" id="overview" tabindex="-1">
                  <!--  -->
                  <div class="contact-info">
                    <ul>
                        @if(!empty($record->store_mobile))
                     <li class="contactno"> <i class="fa fa-phone-square" aria-hidden="true"></i>   {{$record->store_mobile}}</li>
                     @endif
                       @if(!empty($record->store_phone))
                     <li class="contactno"> <i class="fa fa-phone-square" aria-hidden="true"></i> {{$record->store_phone}}</li>
                     @endif

                     @if(!empty($record->store_email))
                     <li class="email contactno"><i class="fa fa-envelope" aria-hidden="true"></i> {{$record->store_email}}</li>
                       @endif
                    
                 </ul>
             </div>
             <hr>
             
             <div class="row">
                <div class="col-md-6">
                 <div class="shop-open">
                    <h5 >Open Now</h5>  <span class="p1">{{$record->store_open_time}} - {{$record->store_close_time}} (Today)</span>
                   
                    
     </div>
     
 </div>
 <div class="col-md-6">
     <h5>Address</h5>
     <p class="current-address">
        <img src="{{url('/')}}/public/frontend/img/placeholder (1).png"> 
{{$record->store_address}}

{{$record->locality->locality_name}}, {{$record->city->city_name}}, {{$record->state->state_name}}, {{$record->country->country_name}}
    </p>
     
 </div>
 <div class="col-md-12">
 <h5>Description</h5>
    {!!$record->store_description!!} 
 </div>
</div>
</div>
<div class="tab-pane reviews" id="reviews">
  <!--  -->
  <div class="card card1">
   @if(!empty($reviews))
      <h4>Reviews</h4>

@foreach($reviews as $index=>$data)
   <div class="div1">
     <div class="row">
       <div class="col-md-2 col-xs-2">
          <div class="img">
            <span class="textcolor">{{strtoupper(substr($data->persone_name,0,1))}}</span>

   </div>
   </div>
   <div class="col-md-10 col-xs-10"> 
  
    <div class="reviews-rating" style="pointer-events:none;">
          <h5>{{$data->persone_name}}</h5>
     <ul>
      <li><span class="badge badge-success" style="font-size:12px"><i style="font-size:11px" class="fas fa-star"></i>{{$data->rating}}</span></li>

      
        @for ($x = 1; $x <= $data->rating; $x++)
      <li class="stars"><i class="fa fa-star"></i></li>
             @endfor  
</ul>
</div>
<p>{{$data->reviews}}</p>


</div>
</div>
</div>
@endforeach
@else
    <h4>No Reviews Yet</h4>
@endif





</div>
<!--  -->
</div>
<div class="tab-pane photos" id="photos">
  <!--  -->
  <section>
   <div class="demo-gallery">
    <ul id="lightgallery" class="list-unstyled row">
        @if(!empty($store_galleries))
        @foreach($store_galleries as $index=>$data)
     <li class="col-xs-4 col-sm-3 col-md-4 col-mb-12" data-responsive="{{url('/public/images/store_photo_gallery/'.$data->gallery_img)}}" data-src="{{url('/public/images/store_photo_gallery/'.$data->gallery_img)}}" data-sub-html="<h4>image heading</p>">
        <a href="">
           <div class="img-div">
            <img class="img-responsive" src="{{url('/public/images/store_photo_gallery/'.$data->gallery_img)}}">
        </div>
    </a>
</li>
@endforeach
@endif
</ul>
</div>
</section>
<!--  -->
</div>

</div>
</div>
</div>
<div class="col-md-3">
    
<div class="nearby-restaurants">
                    <div class="card">
                        <div class="card-header">
                            <h5>Nearby Shop</h5>
                        </div>
                        <div class="card-body">
                            <div class="list-of-shops row">
@if(!empty($stores))
@foreach($stores as $index=>$data)

<div class="col-md-12">
<div class="card card1">
<div class="shop-div row margin0">
<a href="{{url('profile/'.$data->store_link)}}">
<div class="img">
@if(!empty($data->store_cover_photo))
<img src="{{ asset('public/images/store_cover_photo/'.$data->store_cover_photo)}}" alt="dd" />
@else
<img src="{{url('/')}}/public/frontend/img/mandeclan1.jpg">
@endif
</div>
</a>
<div class="content-div col-xs-9 padding0">
<h5 class="shop-name">{{substr($data->store_name,0,31)}}
@if(strlen($data->store_name)>31)
...
@endif</h5>
<p class="p1">{{$data->locality->locality_name}}, {{$data->city->city_name}}</p>
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

</div>

</div>


{{-- ........................................ --}}

{{-- .............................................. --}}
</div>
</div>
<div class="mobile-device">
    <h4 class="logo">Mande-Clan</h4>
    <h4 class="h4">Buy Online Marketplace from Online Marketplace Shop Near by You</h4>
    <div class="center">
        <button class="btn btn-raised btn-light">Download Today</button>
    </div>
    <div class="app-link-img">
        <img src="{{url('/')}}/public/frontend/img/goggle-play-store.png">
        <img src="{{url('/')}}/public/frontend/img/apple-store.png">
    </div>
    <div class="mobile-footer">
        <p>All rights reserved @ 2019 Mande Clan</p>
    </div>
</div>                           
</body>

@endsection

<!-- ................push new js link................. -->

@push('js')
<script src="{{asset('public/js/comman.js')}}"></script>
<script type="text/javascript">
    $(document).ready(() => {
  $("#lightgallery").lightGallery({
    pager: true
  });
});
</script>


<script type="text/javascript">
              $(document).ready(function() {

    $('.whishlist').on('click','.heart_like',function(){





      var store_id=$(this).attr('store_id');
var store_user_id=$(this).attr('store_user_id');

$("#heart_dislike_"+store_id).show();
$("#heart_like_"+store_id).hide();

     
         var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');


console.log({_token: CSRF_TOKEN,store_id:store_id,store_user_id:store_user_id},'likeid')

       $.ajax({
           type:"POST",
           url:"{{url('like_update')}}",
           data:{_token: CSRF_TOKEN,store_id:store_id,store_user_id:store_user_id},
           dataType:'JSON',

           success:function(res){ 
console.log(res);
         
         },error:function(error){ 
            console.log(error)
         }
       });
    });
// ...................


        $('.whishlist').on('click','.heart_dislike',function(){


  
var store_id=$(this).attr('store_id');
var store_user_id=$(this).attr('store_user_id');
     
     // console.log(userid,'dislike_id')

// $(".fas.fa-heart").hide();
// $(".far.fa-heart").show();

$("#heart_dislike_"+store_id).hide();
$("#heart_like_"+store_id).show();

         var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
console.log({_token: CSRF_TOKEN,store_id:store_id,store_user_id:store_user_id},'likeid')

       $.ajax({
           type:"POST",
           url:"{{url('dislike_update')}}",
           data:{_token: CSRF_TOKEN,store_id:store_id,store_user_id:store_user_id},
           dataType:'JSON',

           success:function(res){ 
console.log(res);
         
         },error:function(error){ 
            console.log(error)
         }
       });
    });


  });



</script>
@endpush


