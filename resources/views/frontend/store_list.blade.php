@extends('frontend.layouts.app')
@section('title',"Online Shopping site in US: Shop Online for Mobiles, Books, Watches, Shoes and More - mandeclan.com")
<!-- ................Add meta ................ -->


@section('meta')
@endsection

<!-- ................custom css................. -->

@section('customStyle')
<style type="text/css">
      #currentlocation_modal{
        display: block!important;
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
		    <li class="breadcrumb-item"><a href="{{url('/'.Session::get('locality_url'))}}">Home</a></li>
		    	
             <li class="breadcrumb-item">
                    {{$category->category_name}} in {{Session::get('locality_name')}}
                    </li>
		    		  </ol>
   	  </div>
   </div>
</nav>
<!--  -->
<div class="padding shop-list">


	<div class="container-fluid">
        <div class="row margin0 padding-0-15 bmw">
        <div class="col-md-8 padding0">
          <p class="vendor-title">{{$category->category_name}} Stores in {{Session::get('locality_name')}}</p>
          <p class="vendor-counter">Showing <b>@if(!empty($stor))({{$stor->total()}})@endif results</b> as per your search criteria</p>
        </div>
        <div class="col-md-4 padding0">
          {{Form::open(['url'=>[\Request::path()],'method'=>'GET'])}}

          <span class="bmd-form-group"><div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <img src="{{url('public/frontend/img/searching.png')}}">
              </span>
            </div>
            
                        {!!Form::text('search',\Request::input('search'),array('class'=>'form-control','placeholder'=>'Search Stores from '.Session::get('locality_name').'...','onkeyup'=>'this.form.submit()')) !!}


          </div></span>
      {{Form::close()}}
        </div>
      </div>

		<div class="row whishlist">
            @if(!empty($stores))
            @foreach($stores as $index=>$data)
            <div class="col-md-3 col-xs-12">
            <div class="card card1" id="store3">
               
            <div class="img">
                  <a href="{{url('profile/'.$data['store_link'])}}">
            @if(!empty($data['store_cover_photo']))
            <img src="{{ asset('public/images/store_cover_photo/'.$data['store_cover_photo'])}}" alt="dd" />
            @else
            <img src="{{url('/')}}/public/frontend/img/mandeclan1.jpg">
            @endif
        </a>

            <div style="">


  {{--     @if(!Auth::guest())
           
 @if($data['like_dislike']=='Like')

<div class="like"  >
<i class="fas fa-heart heart_dislike" id="heart_dislike_{{$data['id']}}" data="{{$data['id']}}" 
store_id="{{$data['id']}}" store_user_id="{{$data['user_id']}}"></i>

<i class="far fa-heart heart_like"  id="heart_like_{{$data['id']}}" style="display:none" data="{{$data['id']}}" 
store_id="{{$data['id']}}" store_user_id="{{$data['user_id']}}"></i>
</div>


@else
<div class="like"  >
<i class="fas fa-heart heart_dislike" id="heart_dislike_{{$data['id']}}" style="display:none" data="{{$data['id']}}" 
store_id="{{$data['id']}}" store_user_id="{{$data['user_id']}}"></i>

<i class="far fa-heart heart_like"  id="heart_like_{{$data['id']}}"  data="{{$data['id']}}" 
store_id="{{$data['id']}}" store_user_id="{{$data['user_id']}}"></i>
</div>

@endif

@else

<a href="{{url('customer-login')}}">
<div class="like"  >
<i class="far fa-heart heart_like"  id="heart_like_{{$data['id']}}"  data="{{$data['id']}}" 
store_id="{{$data['id']}}" store_user_id="{{$data['user_id']}}"></i>
</div>
</a>

@endif --}}
</div>
            </div>
              <a href="{{url('profile/'.$data['store_link'])}}">
            <div class="restaurants-div">
           

            <div class="content-div">
            <h5 class="shop-name shop-name3">{{substr($data['store_name'],0,31)}}
@if(strlen($data['store_name'])>31)
...
@endif
            </h5>
            <div class="row">
            <div class="col-md-8 col-xs-8">
            <p class="p1"><span class="shop-area3">{{$data['locality']->locality_name}}</span>, <span class="shop-city3">{{$data['city']->city_name}}</span></p>
            </div>
            <div class="col-md-4 col-xs-4">
            <div class="pull-right">
            <span class="badge badge-warning"><i class="fas fa-star"></i> {{$data['store_rating']}}</span>
            </div>
            </div>
            </div>
            
            <hr>
            <div class="">
            <div class="row">
            <div class="col-md-10 col-xs-10">
            <p class="p2 text-success"><i class="fas fa-eye"></i> View Shop </p>
            </div>
            <div class="col-md-2 col-xs-2">
            <div class="pull-right">
            <i class="fas fa-chevron-right text-success"></i>
            </div>
            </div>
            </div>
            </div>
            </div>
      
            </div>
        </a>
            </div>
            </div>
            @endforeach
            @endif
						
						
					</div>

                    <div class="card-body">
    @if(!empty($stor))
       {{$stor->links()}}
@endif
 </div>

	</div>
	
</div>



<!--  -->
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


