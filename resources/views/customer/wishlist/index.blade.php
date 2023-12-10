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



.heart_dislike{
color: red;
    font-size: 20px;

}
.heart_dislike, .heart_like {
    /*position: absolute;
    top: 2px;
    right: 2px;*/
    font-size: 20px;
}

.badge-warning {
    color: #fff;
    background-color: #fcc100;
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

                <div class="row  list-of-shops whishlist">
  @if(!empty($stores))
            @foreach($stores as $index=>$data)

 <div class="col-md-4 col-xs-6 ">

                            <a href="{{ url('#') }}">
                                <div class="card card1" id="111">
                                    <div class="shop-div">
                                        <div class="img">
                                            @if(!empty($data['store_cover_photo']))
            <img src="{{ asset('public/images/store_cover_photo/'.$data['store_cover_photo'])}}" alt="dd" />
            @else
            <img src="{{url('/')}}/public/frontend/img/mandeclan1.jpg">
            @endif
                                        </div>
                                         <div class="content-div row">
                                            <h5 class="shop-name">{{substr($data['store_name'],0,31)}}
@if(strlen($data['store_name'])>31)
...
@endif</h5>
                                            <div class="col-md-8">
                                                
                                            <p class="p1"><span class="shop-city3">{{$data['locality']->locality_name}}</span>, <span class="shop-city3">{{$data['city']->city_name}}</p>
                                            </div>


                                         <div class="col-md-3 like"  >
                                             <span class="badge badge-warning"><i class="fas fa-star"></i> {{$data['store_rating']}}</span>
<i class="fas fa-heart heart_dislike" id="heart_dislike_{{$data['id']}}" data="{{$data['id']}}" 
store_id="{{$data['id']}}" store_user_id="{{$data['user_id']}}"></i>

<i class="far fa-heart heart_like"  id="heart_like_{{$data['id']}}" style="display:none" data="{{$data['id']}}" 
store_id="{{$data['id']}}" store_user_id="{{$data['user_id']}}"></i>
</div>



                                        </div>
                                    </div>
                                </div>
                            </a>
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