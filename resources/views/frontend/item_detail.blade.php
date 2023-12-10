@extends('frontend.layouts.app')
@section('title',"Online Shopping site in US: Shop Online for Mobiles, Books, Watches, Shoes and More - mandeclan.com")
<!-- ................Add meta ................ -->


@section('meta')
@endsection

<!-- ................custom css................. -->

@section('customStyle')
<style type="text/css">
     .small-img-box {
            width: 65px;
            height: 65px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .small-image {
            width: 100%;
        }

        .big-image {
            width: 100%;
            height: 275px;
        }

        .dollars {
            font-size: 32px;
            font-weight: 500;
        }

        .dollars-cancel {
            font-size: 16px;
            color: #ccc;
            text-decoration: line-through;
        }

        .dollars-offer {
            font-size: 18px;
        }

        .buttons {
            margin: 0 5px 0 0;
            padding: 3px 15px;
            font-size: 14px;
            border: 1px solid black;
            background: transparent;
            color: black;
            text-transform: uppercase;
            border-radius: 5px;
        }

        .cart-buttons {
            padding: 5px 12px;
            font-size: 14px;
            border-radius: 5px;
            border: none;
            background: #f26e21;
        }

        .addToCart {
            color: #f26e21 !important;
            border-color: #f26e21!important;
        }

        .addToCart:hover {
            background: #f26e21!important;
            border-color: #f26e21!important;
            color: #fff;
        }

.xzoom-gallery {
    border :1 px solid
}
        .btn:focus {
            outline: none;
            box-shadow: none;
        }

        .customize {
            width: 18%;
            text-align: center;
            color: #aaa;
            font-size: 12px;
        }

.mande-main-category{
display: none!important;
}

.counter-div{

    width: 150px;
    text-align: center;
}
.progress{
height: 7px;
border-radius: 5px;
background: rgb(240, 240, 240);
margin: 0px 12px 0px 5px;
display: flex;
flex-wrap: wrap;
flex: 1 1 0%;
}

/*gAAUDP*/
.button {
float: left;
margin: 0 5px 0 0;
width: 100px;
height: 40px;
position: relative;
}

.button label,
.button input {
display: block;
position: absolute;
top: 0;
left: 0;
right: 0;
bottom: 0;
}

.button input[type="radio"] {
opacity: 0.011;
z-index: 100;

}

.addToCart {
    color: #f26e21;
    border-color: #f26e21;
}
.button label {

  background: rgb(255, 255, 255);
  padding: 6px 16px;
  border-radius: 10px;
  border: 1px solid rgb(51, 51, 51);
  margin: 6px 12px 6px 0px;
  min-width: 46px;
  height: 32px;
  display: flex;
  -webkit-box-pack: center;
  justify-content: center;
  -webkit-box-align: center;
  align-items: center;
  position: relative;
  cursor: pointer;
  -webkit-tap-highlight-color: transparent;

}

.border {
    border: 1px solid #dee2e6 !important;
}

.button input[type="radio"]:checked + label {

background: rgb(253, 233, 242);
padding: 6px 16px!important;
border-radius: 10px!important;
border: 1px solid rgb(244, 51, 151)!important;
margin: 6px 12px 6px 0px;
min-width: 46px;
height: 32px;
display: flex!important;
-webkit-box-pack: center;
justify-content: center;
-webkit-box-align: center;
align-items: center;
position: relative;
cursor: pointer;
-webkit-tap-highlight-color: transparent;
color: rgb(244, 51, 151);
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
<link rel="stylesheet" type="text/css" href="https://raw.githubusercontent.com/bbbootstrap/libraries/main/xzoom.css" media="all" />

<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/css/item_detail.css') }}">
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


<!--<div class="padding black shop-details-page">-->
<!--    <div class="container-fluid">-->
<!--        <div class="row">-->
<!--            <div class="col-md-12">-->
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
<!--                 <div class="row">-->
<!--                 	<div class="col-md-9">-->
<!--                 	 <h4>{{$record->store_name}}</h4>-->
<!--                  <p class="p1"><i class="fas fa-map-marker-alt"></i> {{$record->locality->locality_name}}, {{$record->city->city_name}}, {{$record->state->state_name}}, {{$record->country->country_name}}.</p>-->
<!--                 </div>-->
<!--                 {{-- <div class="col-md-3">-->
<!--                 	  <div class="ckKqnW">-->
<!--                                <button class="jFyqGp">-->
<!--                                    <span class="bvjca-D">View Shop</span>-->
<!--                                </button>-->
<!--                            </div>-->
<!--                 </div> --}}-->

<!--                 <div class="col-md-2 whishlist">-->
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
                 	
<!--                 </div>-->
<!--                  <div class="row row1">-->
<!--                     <div class="col-md-4 col-xs-4">-->
<!--                        <b><i class="fas fa-star"></i> {{$avg_rating}}</b>-->
<!--                        <p>{{$reviews_count}}+ Rating</p>-->
<!--                    </div>-->
<!--                    @if(!empty($record->store_open_time))-->
<!--                    <div class="col-md-3 col-xs-3">-->
<!--                        <b>{{$record->store_open_time}} to {{$record->store_close_time}}</b>-->
<!--                        <p>Open & Close Time</p>-->
<!--                    </div>-->
<!--                    @endif-->

           
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!-- </div>-->
<!--</div>-->
<!--</div>-->


<!-- sarfaraz -->
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


 <div class="container">
        <div class="row addTocart">
   @include('frontend.item_detail_list')

        </div>
    </div>


     <!-- MODAL RIGHT SIDE -->
    <div class="modal modal_outer right_modal fade" id="information_modal" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel2">
        <div class="modal-dialog" role="document">
            <form method="post" id="get_quote_frm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title">Costomer Reviews & Comments</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body get_quote_view_modal_body">
                        <!-- data -->
                        <div color="white" class="iBCjCr">
                            <div class="iBCjCr dvSnjI dvSnjI" color="white"><svg width="20" height="20" fill="blueT2"
                                    xmlns="http://www.w3.org/2000/svg" stroke="blueT2" iconSize="24"
                                    class="Icon-sc-1iwi4w1-0 dbskvy">
                                    <path
                                        d="M18.955 17.921c0-.018-.009-.045-.009-.063-.387-3.123-2.871-5.697-6.201-6.624a4.92 4.92 0 01-2.745.837 4.992 4.992 0 01-2.745-.837c-3.33.927-5.814 3.501-6.201 6.624 0 .018-.009.045-.009.063a7.297 7.297 0 00-.045.774C1 19.424 1.702 20 2.521 20h14.958c.819 0 1.521-.576 1.521-1.305 0-.261-.018-.522-.045-.774zM10 11.134c2.598 0 4.707-2.048 4.707-4.567S12.597 2 10 2 5.294 4.048 5.294 6.567c0 2.528 2.11 4.567 4.706 4.567z"
                                        fill="#F43397"></path>
                                </svg><span color="greyT1" font-size="16px" font-weight="demi" class="cwTMA-d">Manali
                                    nikam</span></div>
                            <div class="iFldjF dvSnjI dvSnjI" color="white"><span label="5" class="cLCHWA"><span
                                        color="#ffffff" font-size="16px" font-weight="demi"
                                        class="gYxLUd">5.0</span><svg width="8" height="8" viewBox="0 0 20 20"
                                        fill="#ffffff" xmlns="http://www.w3.org/2000/svg" ml="4" iconSize="10"
                                        class="Icon-sc-1iwi4w1-0 ejrYQc">
                                        <g clip-path="url(#star_svg__clip0)">
                                            <path
                                                d="M19.54 6.85L13.62 5.5 10.51.29a.596.596 0 00-1.02 0L6.38 5.5.46 6.85a.599.599 0 00-.31.98l3.99 4.57-.55 6.04c-.02.21.07.41.24.54.17.12.39.15.59.07L10 16.64l5.58 2.39c.08.03.16.05.23.05h.01c.3.01.6-.26.6-.6 0-.06-.01-.12-.03-.17l-.54-5.93 3.99-4.57c.14-.16.18-.38.12-.58a.544.544 0 00-.42-.38z"
                                                fill="#666"></path>
                                        </g>
                                        <defs>
                                            <clipPath id="star_svg__clip0">
                                                <path fill="#fff" d="M0 0h20v19.08H0z"></path>
                                            </clipPath>
                                        </defs>
                                    </svg></span>
                                <div color="greyT3Divider" class="ifPMxh bbBtST bbBtST">
                                </div><span color="greyT2" font-size="12px" font-weight="demi" class="fMjoAc">Posted on
                                    10 Jan 2022</span>
                            </div>
                            <div class="cYShFR dvSnjI dvSnjI" color="white"><span color="greyBase"
                                    class="gKkBjb kFZtes kFZtes" font-size="16px" font-weight="book"></span></div>
                            <div class="cYShFR dvSnjI dvSnjI" color="white"></div>
                            <div class="iFldjF dvSnjI dvSnjI" color="white">
                                <!-- Discripation -->
                                <p color="greyT1" font-size="16px" font-weight="book" class="fCJVtz">Lorem ipsum dolor
                                    sit amet consectetur adipisicing elit. Qui, et saepe quas quibusdam eveniet nesciunt
                                    magnam debitis sequi a laborum ipsum odit distinctio quasi esse? Ipsam adipisci
                                    eaque saepe porro sint ipsum repellat odit, hic maiores harum consequuntur fuga
                                    iusto vitae vel tenetur quis ad similique itaque perferendis repellendus labore?</p>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal"> Close </button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal"> Save Details </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

<!-- ................push new js link................. -->

@push('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/xzoom.min.js"></script>
<script type='text/javascript'
        src='https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js'></script>

         
<script type="text/javascript">
     $(document).ready(function() {



    $('.addTocart').on('click','.addtocard',function(){
            var id=$(this).attr('data');

            // alert(id)
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
                // console.log(res);

 $('#changecartcounter').text('');
              $('#changecartcounter').text(res.counter);           },
           complete:function(data){
                $("#loader").hide();
           }
         });


            });

// .......................................................................
        $('.addTocart').on('click','.changeitemquantity',function(){


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

console.log(quantity,'quantity')


var seturl = "{{url('updatecartproductajax')}}?item_id="+item_id+"&mainqty="+-1;


          }else{

 $("#counter-div"+item_id).hide();
            $("#addtocard"+item_id).show();
              // $("#mydiv"+item_id).load(location.href + " #mydiv"+item_id);

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
// ............................item_id

                    $('.addTocart').on('change','.onchange_attribute',function(){


var product_id=$(this).attr('product_id');


  var attr_val = $(".onchange_attribute:checked").map(function(){
      return $(this).val();
    }).get();

    var attr_name = $(".onchange_attribute:checked").map(function(){
      return $(this).attr('data');
    }).get();

console.log({attr_val:attr_val,attr_name:attr_name,product_id:product_id})


         var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

 $.ajax({
            type:"POST",
           url:"{{url('attr_base_change_item_details')}}",
            data:{_token: CSRF_TOKEN, attr_val:attr_val,attr_name:attr_name,product_id:product_id},
           dataType:'JSON',


           beforeSend: function(){
              $("#loader").show();
            },
           success:function(res){ 
                console.log(res.item_id,'response');
           
  $(".addTocart").html('');
         $(".addTocart").html(res.loadbutton);

         var urls = @json(url('/details/'.Request::segment(2)))+'?item='+res.item_id;


history.pushState('', '', urls)




              
           },
           complete:function(data){
            $("#loader").hide();
           },

             error:function(error){ 
            
            console.log(error,'errors')

           }
         });

            })


        // ..................................................


// $(".radio_attribute").click(function(){

//             var radioSize = $("input[name='Size']:checked").val();
//             var radioColor = $("input[name='Color']:checked").val();
//             var radioStyle = $("input[name='Style']:checked").val();
//             var radioMaterial = $("input[name='Material']:checked").val();
// var product_id='{{$items->id}}';



//   $.ajaxSetup({
//       headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//       }
//     });
//     var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
//                 $.ajax({
//      type:"POST",           
//      url:"{{url('append_item_img')}}",
//      data:{_token: CSRF_TOKEN,size:radioSize,color:radioColor,style:radioStyle,material:radioMaterial,product_id:product_id},
//  dataType:'JSON',
//            dataType: 'json',

//      success: function(response){

// console.log(response.items,'iamgespath')

//  // $('.parentcls').find('#append_id').html(response.items.loadbutton);

// var img1='{{ asset('public/images/product_items/')}}/'+response.items.item_img1;
// var img2='{{ asset('public/images/product_items/')}}/'+response.items.item_img2;
// var img3='{{ asset('public/images/product_items/')}}/'+response.items.item_img3;
// var img4='{{ asset('public/images/product_items/')}}/'+response.items.item_img4;
// var img5='{{ asset('public/images/product_items/')}}/'+response.items.item_img5;


// $("#product_name_id").text(response.items.product_name)
// $("#item_selling_price_id").text(response.item_selling_price)
// $("#item_price_id").text(response.items.item_price)
// $("#item_offer_discount_id").text(response.items.item_offer_discount)

//      $("#xzoom-default").attr("src",img1);

//      $("#item_img1_id").attr("src",img1);
//      $("#item_img2_id").attr("src",img2);
//      $("#item_img3_id").attr("src",img3);
//      $("#item_img4_id").attr("src",img4);
//      $("#item_img5_id").attr("src",img5);

//      $("#item_img1_id").attr("href",img1);
//      $("#item_img2_id").attr("href",img2);
//      $("#item_img3_id").attr("href",img3);
//      $("#item_img4_id").attr("href",img4);
//      $("#item_img5_id").attr("href",img5);

//      },

//        error: function(error){

// console.log(error,'errorss')


//      }


//    });





//     });

// ............................................................
    });
</script>


     <script>



        function myFunction(imgs) {
            // Get the expanded image
            var expandImg = document.getElementById("expandedImg");
            // Get the image text
            var imgText = document.getElementById("imgtext");
            // Use the same src in the expanded image as the image being clicked on from the grid
            expandImg.src = imgs.src;
            // Use the value of the alt attribute of the clickable image as text inside the expanded image
            imgText.innerHTML = imgs.alt;
            // Show the container element (hidden with CSS)
            expandImg.parentElement.style.display = "block";
        }

    //       $(document).ready(function() {
    // var $easyzoom = $('.easyzoom').easyZoom();
    // });

          (function ($) {
  $(document).ready(function () {
    $(".xzoom, .xzoom-gallery").xzoom({
      zoomWidth: 400,
      title: true,
      tint: "#333",
      Xoffset: 15,
    });
    $(".xzoom2, .xzoom-gallery2").xzoom({
      position: "#xzoom2-id",
      tint: "#ffa200",
    });
    $(".xzoom3, .xzoom-gallery3").xzoom({
      position: "lens",
      lensShape: "circle",
      sourceClass: "xzoom-hidden",
    });
    $(".xzoom4, .xzoom-gallery4").xzoom({ tint: "#006699", Xoffset: 15 });
    $(".xzoom5, .xzoom-gallery5").xzoom({ tint: "#006699", Xoffset: 15 });

    //Integration with hammer.js
    var isTouchSupported = "ontouchstart" in window;

    if (isTouchSupported) {
      //If touch device
      $(".xzoom, .xzoom2, .xzoom3, .xzoom4, .xzoom5").each(function () {
        var xzoom = $(this).data("xzoom");
        xzoom.eventunbind();
      });

      $(".xzoom, .xzoom2, .xzoom3").each(function () {
        var xzoom = $(this).data("xzoom");
        $(this)
          .hammer()
          .on("tap", function (event) {
            event.pageX = event.gesture.center.pageX;
            event.pageY = event.gesture.center.pageY;
            var s = 1,
              ls;

            xzoom.eventmove = function (element) {
              element.hammer().on("drag", function (event) {
                event.pageX = event.gesture.center.pageX;
                event.pageY = event.gesture.center.pageY;
                xzoom.movezoom(event);
                event.gesture.preventDefault();
              });
            };

            xzoom.eventleave = function (element) {
              element.hammer().on("tap", function (event) {
                xzoom.closezoom();
              });
            };
            xzoom.openzoom(event);
          });
      });

      $(".xzoom4").each(function () {
        var xzoom = $(this).data("xzoom");
        $(this)
          .hammer()
          .on("tap", function (event) {
            event.pageX = event.gesture.center.pageX;
            event.pageY = event.gesture.center.pageY;
            var s = 1,
              ls;

            xzoom.eventmove = function (element) {
              element.hammer().on("drag", function (event) {
                event.pageX = event.gesture.center.pageX;
                event.pageY = event.gesture.center.pageY;
                xzoom.movezoom(event);
                event.gesture.preventDefault();
              });
            };

            var counter = 0;
            xzoom.eventclick = function (element) {
              element.hammer().on("tap", function () {
                counter++;
                if (counter == 1) setTimeout(openfancy, 300);
                event.gesture.preventDefault();
              });
            };

            function openfancy() {
              if (counter == 2) {
                xzoom.closezoom();
                $.fancybox.open(xzoom.gallery().cgallery);
              } else {
                xzoom.closezoom();
              }
              counter = 0;
            }
            xzoom.openzoom(event);
          });
      });

      $(".xzoom5").each(function () {
        var xzoom = $(this).data("xzoom");
        $(this)
          .hammer()
          .on("tap", function (event) {
            event.pageX = event.gesture.center.pageX;
            event.pageY = event.gesture.center.pageY;
            var s = 1,
              ls;

            xzoom.eventmove = function (element) {
              element.hammer().on("drag", function (event) {
                event.pageX = event.gesture.center.pageX;
                event.pageY = event.gesture.center.pageY;
                xzoom.movezoom(event);
                event.gesture.preventDefault();
              });
            };

            var counter = 0;
            xzoom.eventclick = function (element) {
              element.hammer().on("tap", function () {
                counter++;
                if (counter == 1) setTimeout(openmagnific, 300);
                event.gesture.preventDefault();
              });
            };

            function openmagnific() {
              if (counter == 2) {
                xzoom.closezoom();
                var gallery = xzoom.gallery().cgallery;
                var i,
                  images = new Array();
                for (i in gallery) {
                  images[i] = { src: gallery[i] };
                }
                $.magnificPopup.open({
                  items: images,
                  type: "image",
                  gallery: { enabled: true },
                });
              } else {
                xzoom.closezoom();
              }
              counter = 0;
            }
            xzoom.openzoom(event);
          });
      });
    } else {
      //If not touch device

      //Integration with fancybox plugin
      $("#xzoom-fancy").bind("click", function (event) {
        var xzoom = $(this).data("xzoom");
        xzoom.closezoom();
        $.fancybox.open(xzoom.gallery().cgallery, {
          padding: 0,
          helpers: { overlay: { locked: false } },
        });
        event.preventDefault();
      });

      //Integration with magnific popup plugin
      $("#xzoom-magnific").bind("click", function (event) {
        var xzoom = $(this).data("xzoom");
        xzoom.closezoom();
        var gallery = xzoom.gallery().cgallery;
        var i,
          images = new Array();
        for (i in gallery) {
          images[i] = { src: gallery[i] };
        }
        $.magnificPopup.open({
          items: images,
          type: "image",
          gallery: { enabled: true },
        });
        event.preventDefault();
      });
    }
  });
})(jQuery);







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
