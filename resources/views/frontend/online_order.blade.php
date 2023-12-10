@extends('frontend.layouts.app')
@section('title',"Online Shopping site in US: Shop Online for Mobiles, Books, Watches, Shoes and More - mandeclan.com")
<!-- ................Add meta ................ -->


@section('meta')
@endsection

<!-- ................custom css................. -->

@section('customStyle')
<style type="text/css">
    .showWhenCityNot{
    display: block !important;
}

@media (max-width: 480px) {
    .showWhenCityNot{
    display: none !important;
    }
  }

.first-navbar .btn.btn-light ,.mande-main-category.padding{
    display: none !important;
}
    /*........siddique start..........*/

 #footer-card-head1 {
            background-color: #efeff2;
        }

        #footer-card-head2 {
            background-color: #efeff2;
        }

        #modal-dialog {
            height: 60%;
        }

        #modal-content {
            height: 100%;
        }

        #modal-body {
            max-height: 550px;
            overflow-y: scroll;
        }

        #modal-footer {
            border-top: 1px solid #ccc;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: #fff;
        }

        .addtocartBtn {

            width: 100%;
            border: 1px solid #0070eb;
            background-color: #0070eb;
            border-radius: 4px;
            color: #fff;
            padding: 8px 16px 7px;
            vertical-align: middle;
            white-space: nowrap;
        }


       .setbutton button:disabled,
.setbutton button[disabled]{
 border: 1px solid #999999;
            background-color: #999999;
}



        .addtocartText {
            margin-right: 12px;
        }

        .dollar-img {
            width: 14px;
        }

        .dollar-cost {
            font-size: 17px;
            font-weight: 600;
        }

        /*.......end sidique.......*/
.product .addtocard, .cartcounter .addtocard, .cartcounter .addtocard2, .product .addtocard_new{
    text-align: center;
    height: 40px;
    border-color: orange;
    /* background: #ff9800; */
    /* color: #fff; */
    text-transform: capitalize;
    border-radius: 15px;
    padding: 10px;
    font-size: 12px;
border: 1px solid #f26e21;
color: #f26e21;
}

}
.size_dropdown{
   
    padding:-10px;
    height:35px;
    border-radius:8px;
    border-color:orange;
    box-shadow:none;
width: auto;

}

.margin_left{
        margin-right:20px;

}

.price{
    display:flex;
    align-items:center;
    justify-content:flex-end;
}

.product_category_cls a, .product_category_cls li
{
    cursor: pointer;
}

.theCount{
    text-align: center;

}

 .forceflow{
    max-height: 330px;
    overflow: overlay;
    overflow-y: scroll;
    scrollbar-width: none;
}
            
    .list-of-shops .img{
        height: 250px;
    }

    .heart_dislike {
        color: red;
        font-size: 20px;
    }

    .heart_like {
        color: #000;
        font-size: 20px;
    }

    .mande-main-category{
        display: none!important;
    }
    .padding{
        padding: 20px;
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



    @media  only screen and (max-width:640px) {
        .closeicon-btn
        {
            top: 0px;
        }
        .closeicon-btn
        {
            display: none;
        }
        .mobile-filter
        {
            overflow: auto;
        }
    }

/* width */
::-webkit-scrollbar {
  width: 5px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #f1f1f1; 
}

/* Handle */
::-webkit-scrollbar-thumb {
  background: #888; 
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555; 
}


.product-box .product .img
{
    position: relative;
    width: 100%;
    height: 150px;
    border-bottom: 1px solid #EEEEEE;
}
.product-box 
{
    margin-top: 20px;
}
.product-box .product .img img 
{
     position: absolute;
     width: auto;
     height: auto;
     max-width: 100%;
     max-height: 100%;
     top: 0;
     bottom: 0;
     left: 0;
     right: 0;
     margin: auto;
}
.product
{
    margin-bottom: 25px;
    cursor: pointer;
}
.product-box .col-md-3
{
    flex: 0 0 33.33%;
    max-width: 33.33%;
}
.product .row
{
    margin-left: 0px;
    margin-right: 0px;
}
.product .row .col-md-6, .product .row .col-md-4
{
    padding-right: 0px;
    padding-left: 0px;
}
.product .product-padding
{
    padding: 10px;
}
.product h6
{
    font-weight: 600;
}
/*.product .icon-div, .cartcounter .icon-div
{
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background-color: #ff9800;
    text-align: center;
    padding: 5px;
    margin: 0 auto;
}*/
.cartcounter .icon-div{
  padding:2px;
}
.product .icon-div .fas, .cartcounter .icon-div .fas
{
    color: #f26e21;
    font-size: 12px;
}
.product .counter, .cartcounter .counter
{
    text-align: center;
    padding-top: 5px;
}
.product .row1
{
    margin-top: 8px;
}
.product .selling-price
{
    font-weight: 600;
}
.product .pricing
{
    padding-top: 5px;
}

.product .addtocard,
.cartcounter .addtocard,
.cartcounter .addtocard2,
.product .addtocard_new,
{

        text-align: center;
    height: 40px;
    border-color: orange;
    
    text-transform: capitalize;
    border-radius: 15px;
    padding: 10px;
    font-size: 12px;


  /*  text-align: center;
    height: 30px;
    background: #ff9800;
    color: #fff;
    text-transform: capitalize;
    border-radius: 15px;
    padding: 6px;
    font-size: 12px;*/
}
/*.product .counter-div, .cartcounter .counter-div2
{
    display: none;
}*/
.product .bachat
{
    width: 17px;
    height: 17px;
}
.product del 
{
    color: #9E9E9E;
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


<!--sarfaraz-->



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


<!--<div class="padding black shop-details-page">-->
<!--    <div class="container-fluid">-->
<!--        <div class="row">-->
<!--            <div class="col-md-10">-->
<!--                <div class="row">-->
<!--                   <div class="col-md-4">-->
<!--                      <div class="shop-banner">-->

<!--                        @if(!empty($record->store_cover_photo))-->
<!--                        <img src="{{ asset('public/images/store_cover_photo/'.$record->store_cover_photo)}}" alt="dd" />-->
<!--                        @else-->
<!--                        <img src="{{url('/')}}/public/frontend/img/mandeclan1.jpg" alt="dd" />-->
<!--                        @endif-->

<!--                    </div>-->
<!--                </div>-->
<!--                <div class="col-md-8">-->
<!--                  <h4>{{$record->store_name}}</h4>-->
<!--                  <p class="p1"><i class="fas fa-map-marker-alt"></i> {{$record->locality->locality_name}}, {{$record->city->city_name}}, {{$record->state->state_name}}, {{$record->country->country_name}}.</p>-->
<!--                  <div class="row row1">-->
<!--                     <div class="col-md-4 col-xs-4">-->
<!--                        <b><i class="fas fa-star"></i> {{$avg_rating}}</b>-->
<!--                        <p>{{$reviews_count}}+ Rating</p>-->
<!--                    </div>-->
<!--                    @if(!empty($record->store_open_time))-->
<!--                    <div class="col-md-4 col-xs-4">-->
<!--                        <b>{{$record->store_open_time}} to {{$record->store_close_time}}</b>-->
<!--                        <p>Open & Close Time</p>-->
<!--                    </div>-->
<!--                    @endif-->

<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--   <div class="col-md-2 whishlist">-->
<!--         <div style="margin-top: 50px;">-->
     

<!--        @if(!Auth::guest())-->
           
<!-- @if($like_dislike=='Like')-->

<!--<button type="button" class="btn btn-outline-light likes heart_dislike" id="heart_dislike_{{$record->id}}" data="{{$record->id}}" store_id="{{$record->id}}" store_user_id="{{$record->user_id}}"><i class="fas fa-heart"></i> <span>Liked</span><div class="ripple-container"></div></button>-->


<!--<button  type="button" class="btn btn-outline-light unlike heart_like" style="display:none"  id="heart_like_{{$record->id}}"  data="{{$record->id}}" -->
<!--store_id="{{$record->id}}" store_user_id="{{$record->user_id}}"><i class="far fa-heart"></i> <span>Like</span></button>-->
    


<!--@else-->
<!--<button type="button" class="btn btn-outline-light likes heart_dislike" style="display:none" id="heart_dislike_{{$record->id}}" data="{{$record->id}}" store_id="{{$record->id}}" store_user_id="{{$record->user_id}}"><i class="fas fa-heart"></i> <span>Liked</span><div class="ripple-container"></div></button>-->


<!--<button  type="button" class="btn btn-outline-light unlike heart_like" id="heart_like_{{$record->id}}"  data="{{$record->id}}" -->
<!--store_id="{{$record->id}}" store_user_id="{{$record->user_id}}"><i class="far fa-heart"></i> <span>Like</span></button>-->


<!--@endif-->

<!--@else-->

<!--<a href="{{url('customer-login')}}">-->
<!--<button  type="button" class="btn btn-outline-light unlike heart_like"   id="heart_like_{{$record->id}}"  data="{{$record->id}}" -->
<!--store_id="{{$record->id}}" store_user_id="{{$record->user_id}}"><i class="far fa-heart"></i> <span>Like</span></button>-->
<!--</a>-->

<!--@endif-->

<!--</div>-->
   
<!--</div>-->
<!--</div>-->
<!--</div>-->
<!--</div>-->
<!--  -->
<div class="sub-header" style="position: static; top: 0px; width: 100%; z-index: 99999; background-color: rgb(234, 245, 227);">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="category-listing">
                    <ul>


                        @if(!empty($product_category))
                        @foreach($product_category as $index=>$data)


@if(\Request::input('category')==$data->id)
<a  class="active product_category_cls" data="{{$data->id}}">
                            <li>{{$data->product_category}}
                                <div class="arrow-up"></div>
                            </li>
                        </a>


@elseif($index==0 && empty(\Request::input('category')))

<a  class="active product_category_cls" data="{{$data->id}}">
                            <li>{{$data->product_category}}
                                <div class="arrow-up"></div>
                            </li>
                        </a>
@endif

                         @endforeach

                                                 @foreach($product_category as $index=>$data)

@if(\Request::input('category')==$data->id)

@elseif($index==0 && empty(\Request::input('category')))


@else
  <a  class="product_category_cls" data="{{$data->id}}">
                            <li>{{$data->product_category}}
                            </li>
                        </a>

@endif
                        @endforeach




                        @endif

                                   <input type="hidden" name="product_cat_id" id="product_cats_id" value="{{\Request::input('category')}}">



@if($break_key !=100)
<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   More
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

 @if(!empty($product_category))
                               @foreach($product_category as $index=>$data)
                               @if($index >= $break_key)
                               <a class="dropdown-item product_category_cls" data="{{$data->id}}" >{{$data->product_category}} </a>
                               @endif
                               @endforeach
                               @endif

      </div>
</div>
   @endif
                      
                   </ul>
               </div>
           </div>
       </div>
   </div>
</div>
<!-- -->




 <div class="modal" id="moreProductCategory" role="dialog">
     <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header" style="padding:6px 12px 0;">
            <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        <div class="modal-body" style="text-align:center;">
            <img src="{{url('/')}}/public/img/Thank-you-for-registering1.png" alt="thankyou-image-for-shop-vendor" style="width:85%">
            <div id="dvCountDown" style="display:none">
                You will be redirected after <span id="lblCount"></span>&nbsp;seconds.
            </div>
            <p style="margin-top:1.5rem;color:#af7171;">This page is automatically redirect you to login page.</p>
        </div>
        <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

        </div>
      </div>
      
    </div>
  </div>


<!-- ......................................... -->

<script type="text/javascript">
    $(document).ready(function(){
        $(".mobile-filter-fab").click(function(){
            $(".closeicon-btn").show();
        });
        $(".closeicon-btn").click(function(){
            $(".mobile-filter, .closeicon-btn, .filter-overlay").hide();
            $("body").css("overflow", "auto")
        });
    });
</script>
<!--  -->

<style type="text/css">
    .wrapper{
  width:70%;
}
@media(max-width:992px){
 .wrapper{
  width:100%;
} 
}
.panel-heading {
  padding: 0;
    border:0;
}
.panel-title>a, .panel-title>a:active{
    display:block;
    padding:15px;
  color:#555;
  font-size:16px;
  font-weight:bold;
    text-transform:uppercase;
    letter-spacing:1px;
  word-spacing:3px;
    text-decoration:none;
}
.panel-heading  a:before {
   font-family: 'Glyphicons Halflings';
   content: "\e114";
   float: right;
   transition: all 0.5s;
}
.panel-heading.active a:before {
    -webkit-transform: rotate(180deg);
    -moz-transform: rotate(180deg);
    transf orm: rotate(180deg);
} 
</style>
<div class="pt-5 category-listing-div">
    <div class="container-fluid">
        <div class="row">
            <div class="filter-overlay"></div>
                <img src="{{url('/')}}/public/frontend/img/delete-button.png" class="closeicon-btn laptop-hide">
                <div class="col-md-3 mobile-filter mobile-padding0 jobsearch">



                    <div class="cat-side-bar">

                         @if(count($product_category) > 0)

                        <div class="border-div">
                            <div class="category-heading">
                                <h5>
                                    Category
                                </h5>
                            </div>
                           
                            <div id="accordion" class="accordion scrollbar scrollbar-primary forceflow">

<div class="card-body " style="padding-top:0px" id="qual_checkbox">

@foreach($product_category as $index=>$data)
<div class="screen-txt">
<div class="custom-control custom-checkbox">
<input type="checkbox" class="custom-control-input product_category_cls filter_checkbox" data="{{$data->id}}" id="{{$data->product_category}}" name="category" value="{{$data->id}}" {{\Request::input('category') == $data->id ? 'checked' : ''}}>
<label class="custom-control-label" for="{{$data->product_category}}">{{$data->product_category}}</label>
</div>
</div>

@endforeach
  
            
    </div>
                            </div>
                            
                        </div>

                        @endif  



                        @if(count($product_subcategories) > 0)

                        <div class="border-div">
                            <div class="category-heading">
                                <h5>
                                    SubCategory
                                </h5>
                            </div>
                           
                            <div id="accordion" class="accordion scrollbar scrollbar-primary forceflow">

<div class="card-body " style="padding-top:0px" id="qual_checkbox">

@foreach($product_subcategories as $index=>$data)
<div class="screen-txt">
<div class="custom-control custom-checkbox">
<input type="checkbox" class="custom-control-input subcategory_cls filter_checkbox" data="{{$data->id}}" id="{{$data->product_subcategory}}" name="subcategory" value="{{$data->id}}" {{\Request::input('subcategory') == $data->id ? 'checked' : ''}}>
<label class="custom-control-label" for="{{$data->product_subcategory}}">{{$data->product_subcategory}}</label>
</div>
</div>

@endforeach
  
            
    </div>
                            </div>
                            
                        </div>

                        @endif  
                        
                        @if(count($brands) > 0)

                        <div class="border-div Brands">
                            <div class="category-heading">
                                <h5>Brands</h5>
                            </div>
                            

<div id="accordion" class="accordion scrollbar scrollbar-primary forceflow">

<div class="card-body " style="padding-top:0px" id="qual_checkbox">

@foreach($brands as $index=>$data)
<div class="screen-txt">
<div class="custom-control custom-checkbox">
<input type="checkbox" class="custom-control-input brand_cls filter_checkbox" data="{{$data->id}}" id="{{$data->id}}_b" name="brand" value="{{$data->id}}" {{\Request::input('brand') == $data->id ? 'checked' : ''}}>
<label class="custom-control-label" for="{{$data->id}}_b">{{$data->brand_name}}</label>
</div>
</div>

@endforeach

            
    </div>
                            </div>

                        </div>
                        @endif    
                        <!--  -->
                    </div>


                </div>
                <div class="col-md-9">
                    <div class="product-list">
                       
                        <div class="card card1">
                            <div class="card-header">

    <div class="row  align-items-center">
        <div class="col-6">
            {{-- <p class="dbevPN">Showing 1-{{$produc->perPage()}} out of {{$produc->total()}} Products</p> --}}
            <h6>{{$product_cat_name}} {{$record->category->category_name}}</h6>
        </div>
        <div class="col-6">
            <div class="pull-right">
                <div class="">
                   

                   {!!Form::select('sorting',['asc'=>'Price (Low to High)','desc'=>'Price (High to Low)','new'=>'New Arrivals'],Request::input('sort'),array('class'=>'custom-select sorting_cls','placeholder'=>'Sort By','data-toggle'=>'select2','autocomplete'=>'off','required')) !!}

               </div>
           </div>
       </div>

   </div>
</li>
</ul>

</div>

<div class="card-padding">



    <div class="row  list-of-shops">
       @foreach($products as $index=>$item)

    
<div class="col-md-12 add-to-card" id="mydiv{{$item->id}}">
   @include('frontend.item_list')
</div>


@endforeach

</div>



</div>

</div>
</div>
</div>
</div>
</div>
</div>


@endsection

<!-- ................push new js link................. -->

@push('js')
<script src="{{asset('public/js/comman.js')}}"></script>


<script type="text/javascript">

  
var perfEntries = performance.getEntriesByType("navigation");

if (perfEntries[0].type === "back_forward") {
    location.reload(true);
}



          $(document).ready(function() {


  
//       window.onpopstate = function(event) {
 
//         alert('1')

//   // location.reload()
// };



// .............
$(".calpriceclass").change(function(){

      var productid = $(this).attr('id'); 



      var radioamount = 0;
      var addon_id = 0;
      var extrasingle = $(".addone_name"+productid+":checked").map(function(){
                          radioamount += parseFloat($(this).attr('code'));
  return this.value;
                
                        }).get();




      console.log(extrasingle)

      var checkboxamount = 0;

      var extramultiple = $(".addone_names"+productid+":checked").map(function() {
                       checkboxamount += parseFloat($(this).attr('codecheck'));
                        return this.value;
                       }).get();

      
            console.log(extramultiple)







      var pay = getNumber(radioamount,0) + getNumber(checkboxamount,0) ;

      // console.log(pay)
 var final_price=$(".basic_price"+productid).val();


      var all_check_id = $(".calpriceclass:checked").map(function() {
                        return this.value;
                       }).get().join(",");


// console.log(all_check_id)




      
            console.log(extramultiple)


// if(extrasingle.length != 0 && extramultiple.length != 0) {

// $('#additemincart'+productid).prop('disabled', false);
// }else{

//     $('#additemincart'+productid).prop('disabled', true);

// }






      $(".addon_price"+productid).val(pay);
      $(".all_check_id"+productid).val(all_check_id);

      var sellprice=parseFloat(final_price)+pay;

      var quantity=$(".quantity_id"+productid).val();



      $(".final_price"+productid).html(sellprice*quantity);
  });

 function getNumber(number, defaultNumber) {
    return isNaN(parseFloat(number, 10)) ? defaultNumber : parseFloat(number, 10);
  }




        $('.add-to-card').on('click','.addtocard',function(){

            var id=$(this).attr('data');
            
            $("#counter-div"+id).show();
            $("#addtocard"+id).hide();

$("#theCount"+id).text(1);
$("#theCountVal"+id).val(1);

// alert(1)

            $.ajax({
           type:"GET",
           url:"{{url('addcartitembyajax')}}?item_id="+id+"&quantity="+1,
           beforeSend: function(){
              $("#loader").show();
           },
           success:function(res){ 
                console.log(res);

 $('#changecartcounter').text('');
              $('#changecartcounter').text(res.counter);           },
           complete:function(data){
                $("#loader").hide();
           },

              error:function(data){
                console.log(data)
           }
         });


            });

// .......................................................................
        $('.add-to-card').on('click','.changeitemquantity',function(){


        var attribute = $(this).attr('data'); 
            var item_id = $(this).attr('data_id');
            var element = $(this).parent().closest('form').serialize();

            var priquantity = $(this).parents('.parent_cls').find('.theCount').text();

           console.log(priquantity,'priquantity')


         if(attribute == 'addition'){


if(parseInt(priquantity) < 10 )
{
           var quantity = parseInt(priquantity) + 1;


$("#theCount"+item_id).text(quantity);
$(this).parents('.parent_cls').find('.qty-input').val(quantity);

console.log(quantity,'quantity')

           var seturl = "{{url('updatecartproductajax')}}?item_id="+item_id+"&mainqty="+1;
}

         }else{


          if(priquantity != 1){

            var quantity = parseInt(priquantity) - 1;

$("#theCount"+item_id).text(quantity);
$(this).parents('.parent_cls').find('.qty-input').val(quantity);


var seturl = "{{url('updatecartproductajax')}}?item_id="+item_id+"&mainqty="+-1;


          }else{

// alert(item_id)
 $("#counter-div"+item_id).hide();
            $("#addtocard"+item_id).show();

          
$("#theCount"+item_id).text(quantity);
$(this).parents('.parent_cls').find('.qty-input').val(quantity);



            var seturl = "{{url('removecartproduct')}}?item_id="+item_id;

          } 


         }


if(parseInt(priquantity) < 10 )
{
         $.ajax({
           type:"GET",
           url:seturl,
           beforeSend: function(){
              $("#loader").show();
            },
           success:function(res){ 
                // console.log(res,'res');
           
              $('#changecartcounter').text('');
              $('#changecartcounter').text(res.counter);
           },
           complete:function(data){
            $("#loader").hide();
           }
         });

     }
      });



// .......................................................................
        $('.add-to-card').on('click','.changeitemquantity1',function(){
// alert('i ma here')

        var attribute = $(this).attr('data'); 
            var item_id = $(this).attr('data_id');
            var element = $(this).parent().closest('form').serialize();

            var priquantity = $(this).parents('.parent_cls').find('.theCount').text();

        var productid = $(this).attr('ddd'); 

           console.log(priquantity,'priquantity')



         if(attribute == 'addition'){


if(parseInt(priquantity) < 10 )
{
           var quantity = parseInt(priquantity) + 1;


$("#theCount0"+item_id).text(quantity);
$(this).parents('.parent_cls').find('.qty-input').val(quantity);

}else{

    var quantity=10;
}


         }else{


          if(priquantity != 1){

            var quantity = parseInt(priquantity) - 1;

$("#theCount0"+item_id).text(quantity);
$(this).parents('.parent_cls').find('.qty-input').val(quantity);



          }else{

            var quantity=1;
          }




         }

// alert("#theCount"+item_id)
$("#theCount"+item_id).text(quantity);
$("#theCountVal"+item_id).val(quantity);



 var final_price=$(".basic_price"+productid).val();
      
 var addon_price=$(".addon_price"+productid).val();
      $(".quantity_id"+productid).val(quantity);

      
      var sellprice=parseFloat(final_price)+parseFloat(addon_price);
      $(".final_price"+productid).html(sellprice*quantity);


      });
// ............................item_id



        $('.add-to-card').on('click','.addtocardbtn',function(){

         
var productid=$(this).attr('idd');
var item_id=$(this).attr('data_id');
var priquantity = $('#theCount0'+item_id).text();
var price = $('#theCount0'+item_id).text();
var addon_price=$(".addon_price"+productid).text();

 var all_check_id=$(".all_check_id"+productid).val();


  $("#counter-div"+item_id).show();

            $("#addtocard_no"+item_id).hide();



// alert(priquantity)productid 

            $.ajax({
           type:"GET",
           url:"{{url('addcartcustomiseitembyajax')}}?item_id="+item_id+"&quantity="+priquantity+"&addon_price="+addon_price+"&all_check_id="+all_check_id,
           beforeSend: function(){
              $("#loader").show();
           },
           success:function(res){ 
                console.log(res);

 $('#changecartcounter').text('');
              $('#changecartcounter').text(res.counter);

$("#AddonsShow"+productid).modal('toggle');

// location.reload();

           
  // $("#mydiv"+productid).html('');
  //        $("#mydiv"+productid).html(res.loadbutton);



                         },
           complete:function(data){
                $("#loader").hide();
           },

              error:function(data){
                console.log(data)
           }
         });


            });


        // ................................

                    $('.add-to-card').on('change','.onchange_attribute',function(){


var product_id=$(this).attr('product_id');
// alert(product_id)

  var attr_val = $(".onchange_attribute").map(function(){
      return $(this).val();
    }).get();

    var attr_name = $(".onchange_attribute").map(function(){
      return $(this).attr('data');
    }).get();

console.log({attr_val:attr_val,attr_name:attr_name,product_id:product_id})


         var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

 $.ajax({
            type:"POST",
           url:"{{url('attr_base_change_item')}}",
            data:{_token: CSRF_TOKEN, attr_val:attr_val,attr_name:attr_name,product_id:product_id},
           dataType:'JSON',


           beforeSend: function(){
              $("#loader").show();
            },
           success:function(res){ 
                console.log(res,'response');
           
  $("#mydiv"+product_id).html('');
         $("#mydiv"+product_id).html(res.loadbutton);

              
           },
           complete:function(data){
            $("#loader").hide();
           },

             error:function(error){ 
            
            console.log(error,'errors')

           }
         });

            })

// ....................................................................

        $('.add-to-card').on('click','.heart_like',function(){


      var userid=$(this).attr('data');

console.log(userid,'likeid')

      var product_id=$(this).attr('product_id');
var store_user_id=$(this).attr('store_user_id');

$("#heart_dislike_"+product_id).show();
$("#heart_like_"+product_id).hide();

     
         var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

       $.ajax({
           type:"POST",
           url:"{{url('like_update')}}",
           data:{_token: CSRF_TOKEN, id:userid,product_id:product_id,store_user_id:store_user_id},
           dataType:'JSON',

           success:function(res){ 
// console.log(res);
         
         }
       });
    });
// ...................


        $('.add-to-card').on('click','.heart_dislike',function(){


  
      var userid=$(this).attr('data');
var product_id=$(this).attr('product_id');
var store_user_id=$(this).attr('store_user_id');
     
     console.log(userid,'dislike_id')

// $(".fas.fa-heart").hide();
// $(".far.fa-heart").show();

$("#heart_dislike_"+product_id).hide();
$("#heart_like_"+product_id).show();

         var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

       $.ajax({
           type:"POST",
           url:"{{url('dislike_update')}}",
           data:{_token: CSRF_TOKEN, id:userid,product_id:product_id,store_user_id:store_user_id},
           dataType:'JSON',

           success:function(res){ 
// console.log(res);
         
         }
       });
    });



// ....................................

$(".filter_checkbox").click(function(){
        var checkboxgroup = "input:checkbox[name='"+$(this).attr("name")+"']";

        console.log(checkboxgroup)
        $(checkboxgroup).prop("checked",false);
        $(this).prop("checked",true);
    });

// ..............


     function encodeQuery(data) {
            let ret = [];
            for (let d in data)
            if (data[d]) {
                ret.push(encodeURIComponent(d) + '=' + encodeURIComponent(data[d]));
            }
            return ret.join('&');
        }


// ....................
$(document).on('click', '.product_category_cls', function(e) {

    // alert('product_category_cls')

     var product_cat_id = $(this).attr('data');

            var category = '{{ \Request::input('category') }}';


            if(product_cat_id){
              var category_cls = product_cat_id;
            }else{
              var category_cls = '{{ \Request::input('category') }}';
            }


            if($('.subcategory_cls').is(':checked')){
              var subcategory_cls = $('input[name=subcategory]:checked').val();
            }
            else{
              var subcategory_cls = '{{ \Request::input('subcategory') }}';
            }


               if($('.brand_cls').is(':checked')){
              var brand_cls = $('input[name=brand]:checked').val();
            }
            else{
              var brand_cls = '{{ \Request::input('brand') }}';
            }



var sorting_cls = $('.sorting_cls').val()

if (!sorting_cls) {
var sorting_cls = '{{ \Request::input('sort') }}';
}


var keyword_cls = $('.keyword_cls').val();

          if(!keyword_cls){
                var keyword_cls = '{{ \Request::input('keyword') }}';
              }



  var postParam = {
                'category': category_cls,
                'subcategory': subcategory_cls,
                'brand': brand_cls,
                'keyword':keyword_cls,
                'sort':sorting_cls,

}
    var querystring = encodeQuery(postParam);


// var urls= {!! json_encode(url('/')) !!} +'/' +'{{ \Request::segment(1) }}' +'/' +'{{ \Request::segment(2) }}'+'?'+querystring;
var urls = @json(url('/order/'.Request::segment(2)))+'?'+querystring;

urls=urls.toLowerCase(urls);

history.pushState('', '', urls)
location.href =urls;

})



// ....................
$(document).on('click', '.subcategory_cls', function(e) {

    // alert('product_category_cls')

     // var product_cat_id = $(this).attr('data');

     //        var category = '{{ \Request::input('category') }}';


             if($(this).is(':checked')){
              var subcategory_cls = $(this).val();
            }else{
              var subcategory_cls = '';
            }


          var category_cls = $('#product_cats_id').val();


// alert(category_cls)
              if(!category_cls){
                var category_cls = '{{ \Request::input('category') }}';
              }



               if($('.brand_cls').is(':checked')){
              var brand_cls = $('input[name=brand]:checked').val();
            }
            else{
              var brand_cls = '{{ \Request::input('brand') }}';
            }



var sorting_cls = $('.sorting_cls').val()

if (!sorting_cls) {
var sorting_cls = '{{ \Request::input('sort') }}';
}


var keyword_cls = $('.keyword_cls').val();

          if(!keyword_cls){
                var keyword_cls = '{{ \Request::input('keyword') }}';
              }


  var postParam = {
                'category': category_cls,
                'subcategory': subcategory_cls,
                'brand': brand_cls,
                'keyword':keyword_cls,
                'sort':sorting_cls,

}
    var querystring = encodeQuery(postParam);


// var urls= {!! json_encode(url('/')) !!} +'/' +'{{ \Request::segment(1) }}' +'/' +'{{ \Request::segment(2) }}'+'?'+querystring;

var urls = @json(url('/order/'.Request::segment(2)))+'?'+querystring;

urls=urls.toLowerCase(urls);

history.pushState('', '', urls)
location.href =urls;

})




// ....................
$(document).on('click', '.brand_cls', function(e) {


var data=$(this).attr('data')
  
             var category_cls = $('#product_cats_id').val();

              if(!category_cls){
                var category_cls = '{{ \Request::input('category') }}';
              }


            if($('.subcategory_cls').is(':checked')){
              var subcategory_cls = $('input[name=subcategory]:checked').val();
            }
            else{
              var subcategory_cls = '{{ \Request::input('subcategory') }}';
            }

    //                 $(".brand_cls").prop( "checked", false );

    // $("#"+data+"_b").prop( "checked", true );

 if($(this).is(':checked')){

               var brand_cls = $(this).val();
            }
            else{

              var brand_cls = '';
            }





var sorting_cls = $('.sorting_cls').val()

if (!sorting_cls) {
var sorting_cls = '{{ \Request::input('sort') }}';
}


var keyword_cls = $('.keyword_cls').val();

          if(!keyword_cls){
                var keyword_cls = '{{ \Request::input('keyword') }}';
              }


  var postParam = {
                'category': category_cls,
                'subcategory': subcategory_cls,
                'brand': brand_cls,
                'keyword':keyword_cls,
                'sort':sorting_cls,

}
    var querystring = encodeQuery(postParam);


// var urls= {!! json_encode(url('/')) !!} +'/' +'{{ \Request::segment(1) }}' +'/' +'{{ \Request::segment(2) }}'+'?'+querystring;

var urls = @json(url('/order/'.Request::segment(2)))+'?'+querystring;

urls=urls.toLowerCase(urls);

history.pushState('', '', urls)
location.href =urls;

})


// ....................

$(".keyword_cls").keyup(function() {


       var keyword_cls = $(this).val();

          if(!keyword_cls){
                var keyword_cls = '{{ \Request::input('keyword') }}';
              }


// alert(keyword_cls);


            if($('.subcategory_cls').is(':checked')){
              var subcategory_cls = $('input[name=subcategory]:checked').val();
            }else{
              var subcategory_cls = '';
            }


          var category_cls = $('#product_cats_id').val();


// alert(category_cls)
              if(!category_cls){
                var category_cls = '{{ \Request::input('category') }}';
              }

               if($('.brand_cls').is(':checked')){
              var brand_cls = $('input[name=brand]:checked').val();
            }
            else{
              var brand_cls = '{{ \Request::input('brand') }}';
            }




var sorting_cls = $('.sorting_cls').val()

if (!sorting_cls) {
var sorting_cls = '{{ \Request::input('sort') }}';
}


  var postParam = {
                'category': category_cls,
                'subcategory': subcategory_cls,
                'brand': brand_cls,
                'keyword':keyword_cls,
                'sort':sorting_cls,

}
    var querystring = encodeQuery(postParam);


{{-- var urls= {!! json_encode(url('/')) !!} +'/' +'{{ \Request::segment(1) }}' +'/' +'{{ \Request::segment(2) }}'+'?'+querystring; --}}

var urls = @json(url('/order/'.Request::segment(2)))+'?'+querystring;

urls=urls.toLowerCase(urls);

history.pushState('', '', urls)

location.href =urls;


})


// ....................

$(document).on('change', '.sorting_cls', function(e) {



var sorting_cls = $(this).val()

if (!sorting_cls) {
var sorting_cls = '{{ \Request::input('sort') }}';
}

       var keyword_cls = $('.keyword_cls').val();

          if(!keyword_cls){
                var keyword_cls = '{{ \Request::input('keyword') }}';
              }


// alert(keyword_cls);


            if($('.subcategory_cls').is(':checked')){
              var subcategory_cls = $('input[name=subcategory]:checked').val();
            }else{
              var subcategory_cls = '';
            }


          var category_cls = $('#product_cats_id').val();


// alert(category_cls)
              if(!category_cls){
                var category_cls = '{{ \Request::input('category') }}';
              }

               if($('.brand_cls').is(':checked')){
              var brand_cls = $('input[name=brand]:checked').val();
            }
            else{
              var brand_cls = '{{ \Request::input('brand') }}';
            }


  var postParam = {
                'category': category_cls,
                'subcategory': subcategory_cls,
                'brand': brand_cls,
                'keyword':keyword_cls,
                'sort':sorting_cls,

}
    var querystring = encodeQuery(postParam);


{{-- var urls= {!! json_encode(url('/')) !!} +'/' +'{{ \Request::segment(1) }}' +'/' +'{{ \Request::segment(2) }}'+'?'+querystring; --}}



var urls = @json(url('/order/'.Request::segment(2)))+'?'+querystring;

urls=urls.toLowerCase(urls);

history.pushState('', '', urls)

location.href =urls;


})


// ....................




})

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


