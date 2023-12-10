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

    .first-navbar .btn.btn-light ,.mande-main-category.padding{
        display: none !important;
    }
    /*........siddique start..........*/
    .btn.custom-btn {
       text-transform: capitalize;
       padding: 10px 20px;
       font-weight: 500;
       color: #fff;
       background: #f26e21;
       border-radius: 18px;
   }
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
.service .addtocard, .cartcounter .addtocard, .cartcounter .addtocard2, .service .addtocard_new{
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

.service_category_cls a, .service_category_cls li
{
    cursor: pointer;
}

.theCount{
    text-align: center;

}

.forceflow{

    max-height: 330px;
    overflow: overlay;
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


.service-box .service .img
{
    position: relative;
    width: 100%;
    height: 150px;
    border-bottom: 1px solid #EEEEEE;
}
.service-box 
{
    margin-top: 20px;
}
.service-box .service .img img 
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
.service
{
    margin-bottom: 25px;
    cursor: pointer;
}
.service-box .col-md-3
{
    flex: 0 0 33.33%;
    max-width: 33.33%;
}
.service .row
{
    margin-left: 0px;
    margin-right: 0px;
}
.service .row .col-md-6, .service .row .col-md-4
{
    padding-right: 0px;
    padding-left: 0px;
}
.service .service-padding
{
    padding: 10px;
}
.service h6
{
    font-weight: 600;
}
/*.service .icon-div, .cartcounter .icon-div
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
.service .icon-div .fas, .cartcounter .icon-div .fas
{
    color: #f26e21;
    font-size: 12px;
}
.service .counter, .cartcounter .counter
{
    text-align: center;
    padding-top: 5px;
}
.service .row1
{
    margin-top: 8px;
}
.service .selling-price
{
    font-weight: 600;
}
.service .pricing
{
    padding-top: 5px;
}

.service .addtocard,
.cartcounter .addtocard,
.cartcounter .addtocard2,
.service .addtocard_new,
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
/*.service .counter-div, .cartcounter .counter-div2
{
    display: none;
}*/
.service .bachat
{
    width: 17px;
    height: 17px;
}
.service del 
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

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

<link href="{{ asset('public/css/daterangepicker.css') }}" rel="stylesheet">

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
             <li class="breadcrumb-item active" aria-current="page">{{$record->service_name}}</li>
         </ol>
     </div>
 </div>
</nav>
<!--  -->


<!--sarfaraz-->

<div class="black shop-details-page">
    <div class="container-fluid">
        <div class="row py-lg-3">
            <div class="col-md-12">
                <div class="row">
                 <div class="col-md-4 col-sm-12">
                  <div class="shop-banner">

                    @if(!empty($record->service_cover_photo))
                    <img src="{{ asset('public/images/service_cover_photo/'.$record->service_cover_photo)}}" alt="dd" />
                    @else
                    <img src="{{url('/')}}/public/frontend/img/mandeclan1.jpg" alt="dd" />
                    @endif

                </div>
            </div>
            <div class="col-md-7 mx-1">
              <h4 style="color: orange;" >{{$record->service_name}}</h4>
              <p class="p1"><i class="fas fa-map-marker-alt"></i> {{$record->locality->locality_name}}, {{$record->city->city_name}}, {{$record->state->state_name}}, {{$record->country->country_name}}.</p>
              <div class="row row1" style="margin: auto;margin-top: 20px; padding-top: 20px; border-radius: 3px;padding-bottom: 15px;" >

               <div class="col-md-4 col-xs-3">
                <b><i class="fas fa-star"></i> {{$avg_rating}}</b>
                <p>{{$reviews_count}}+ Rating</p>
            </div>
            @if(!empty($record->service_open_time))
            <div class="col-md-4 col-xs-5">
                <b>{{$record->service_open_time}} to {{$record->service_close_time}}</b>
                <p>Open & Close Time</p>
            </div>
            @endif
            
            <div class="col-md-2 col-xs-1 whishlist">
              
                @if(!Auth::guest())

                @if($like_dislike=='Like')

                <button type="button" class="btn btn-outline-light likes heart_dislike" id="heart_dislike_{{$record->id}}" data="{{$record->id}}" service_id="{{$record->id}}" service_user_id="{{$record->user_id}}"><i class="fas fa-heart"></i> <span>Liked</span><div class="ripple-container"></div></button>


                <button  type="button" class="btn btn-outline-light unlike heart_like" style="display:none"  id="heart_like_{{$record->id}}"  data="{{$record->id}}" 
                    service_id="{{$record->id}}" service_user_id="{{$record->user_id}}"><i class="far fa-heart"></i> <span>Like</span></button>

                    
                    
                    @else
                    <button type="button" class="btn btn-outline-light likes heart_dislike" style="display:none" id="heart_dislike_{{$record->id}}" data="{{$record->id}}" service_id="{{$record->id}}" service_user_id="{{$record->user_id}}"><i class="fas fa-heart"></i> <span>Liked</span><div class="ripple-container"></div></button>
                    
                    
                    <button  type="button" class="btn btn-outline-light unlike heart_like" id="heart_like_{{$record->id}}"  data="{{$record->id}}" 
                        service_id="{{$record->id}}" service_user_id="{{$record->user_id}}"><i class="far fa-heart"></i> <span>Like</span></button>


                        @endif

                        @else

                        <a href="{{url('customer-login')}}">
                            <button  type="button" class="btn btn-outline-light unlike heart_like"   id="heart_like_{{$record->id}}"  data="{{$record->id}}" 
                                service_id="{{$record->id}}" service_user_id="{{$record->user_id}}"><i class="far fa-heart"></i> <span>Like</span></button>
                            </a>

                            @endif

                        </div>
                        
                        
                        @if(!Auth::guest())
                        <div class="col-md-2 col-xs-12 m-auto pt-lg-0 pt-3" style="float:right;">
                            <a data-toggle="modal" data-target="#defaultModalopen" >
                                <button type="button" class="btn custom-btn" value="">Book Now</button>
                            </a>
                        </div>
                        
                        @else
                        <div class="col-md-2 col-xs-12 m-auto pt-lg-0 pt-3" style="float:right;">
                         <a href="{{url('customer-login')}}" >
                            <button type="button" class="btn custom-btn" value="">Book Now</button>
                        </a>
                    </div>
                    
                    @endif
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>



<div class="modal fade"  data-keyboard="false" data-backdrop="static" id="defaultModalopen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 id="exampleModalLabel">Book Service Now</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

         {!!Form::open(['url'=>['service-booking'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'booking_form'])!!}

         
         <input type="hidden" name="service_user_id" value="{{$record->user_id}}">


         <div class="form-row ">

            <div class="form-group col-md-12">
              <label for="inputEmail4">Service Title</label>     
              {!!Form::text('title',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','required')) !!}  
          </div>


         {{--  <div class="form-group col-md-12">
              <label for="inputEmail4">Booking Date</label>     
              {!!Form::text('booking_date',null,array('class'=>'form-control daterange','placeholder'=>'','autocomplete'=>'off','required')) !!}  
          </div> --}}

           <div class="form-group col-md-6">
                              <label for="inputEmail4">Booking Satrt Date</label>     
                              {!!Form::text('start_date',null,array('class'=>'form-control daterange','placeholder'=>'','autocomplete'=>'off','required')) !!}  
                            </div>

                            <div class="form-group col-md-6">
                              <label for="inputEmail4">Booking End Date</label>     
                              {!!Form::text('end_date',null,array('class'=>'form-control daterange','placeholder'=>'','autocomplete'=>'off','required')) !!}  
                            </div>


                        <div class=" col-md-12">
        <div class="form-group">
          <label class="">Booking For</label>
                       {!!Form::select('booking_subcategory[]',$categories,null,array('class'=>'form-control select2 selectcategory ','placeholder'=>'Select category','data-toggle'=>'select2','required','multiple')) !!}

      </div>
  </div>

{{-- 
                            <div class="form-group col-md-6">
                              <label for="inputEmail4">booking Amount</label>     
                              {!!Form::text('booking_amount',null,array('class'=>'form-control numbersOnly','placeholder'=>'','autocomplete'=>'off','required')) !!}  
                            </div>

                            <div class="form-group col-md-6">
                              <label for="inputEmail4">Advance Amount</label>     
                              {!!Form::text('advance_amount',null,array('class'=>'form-control numbersOnly','placeholder'=>'','autocomplete'=>'off','required')) !!}  
                          </div> --}}

                           {{--  <div class="form-group col-md-6">
                              <label for="inputEmail4">Payment Mode</label>     

                              {!!Form::select('payment_mode',['Stripe'=>'Stripe','Paypal'=>'Paypal','COD'=>'COD'],null,array('class'=>'form-control select2','data-toggle'=>'select2','autocomplete'=>'off','required')) !!}


                            </div>
                            --}}


                            <div class="form-group col-md-12">
                              <label for="inputEmail4">Service Details</label>                         
                              {!! Form::textarea('description',null,['class'=>'form-control textarea', 'rows' => 4, 'cols' => 50,'id'=>'message']) !!}
                          </div>
                      </div>

                  </div>
                  <div class="modal-footer">
                      
                      <button type="submit" class="btn btn-primary">Submit</button>

                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                  </div>
                  {{Form::close()}}

              </div>
          </div>
      </div>


      <div class="modal" id="moreserviceCategory" role="dialog">
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

                   @if(count($service_subcategory) > 0)

                   <div class="border-div">
                    <div class="category-heading">
                        <h5>
                            Category
                        </h5>
                    </div>
                    
                    <div id="accordion" class="accordion scrollbar scrollbar-primary forceflow">
                        <div class="card-body " style="padding-top:0px" id="qual_checkbox">
                            @foreach($service_subcategory as $index=>$data)
                            <div class="screen-txt">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input service_subcategory_cls filter_checkbox" data="{{$data->id}}" id="{{$data->service_subcategory}}" name="category" value="{{$data->id}}" {{\Request::input('category') == $data->id ? 'checked' : ''}}>
                                    <label class="custom-control-label" for="{{$data->service_subcategory}}">{{$data->service_subcategory}}</label>
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
                                <h6>{{$service_cat_name}} {{$record->category->category_name}}</h6>
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
             @foreach($services as $index=>$item)

             
             <div class="col-md-12 add-to-card" id="mydiv{{$item->id}}">
                 <div class="card addToCards" id="cart_items_rows">
                     
                    <div class="row row1" style="margin-bottom:5px;" id="entryRow1923">
                        <div class="col-md-2 col-xs-3">
                            {{-- <a href="{{url('details/'.$item->service_link)}}?item={{$item->service_unique_id}}"></a> --}}
                            <div class="images">
                             @if(!empty($item->service_img))
                             <img src="{{ asset('public/images/service_img/'.$item->service_img)}}" alt="dd" />
                             @else
                             <img src="{{ asset('public/img/no-image.png')}}" alt="dd" />
                             @endif
                         </div>
                         
                     </div>
                     <div class="col-md-10 col-xs-9">
                        
                        <div class="row ">
                            <div class="col-md-8 col-xs-8 order2">

                                <div class="content">
                                    <h4 class="product-name">{{$item->service_name}} </h4>
                                    <p class="category-name">{{$item->service_subcategory}}</p>
                                    <p class="category-name">{{$item->brand_name}}</p>
                                </div>

                            </div>



                            <div class="col-md-4 col-xs-4 order2" style="padding:10px">

                                <div class="pull-right">
                                    <div class="content">
                                        <p class="rupees"><img src="{{url('/')}}/public/frontend/img/dollar.png">{{$item->service_selling_price}} $  {{-- @if(!empty($item->service_offer_discount)) <del>{{$item->service_price}}</del> @endif --}}</p>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-12 col-xs-12 order2" style="padding-right: 15px;padding-top: 15px;
                            padding-left: 15px;">
                            <div class="content">
                                {{substr(strip_tags($item->service_description), 0, 100).'....'}}
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            


            
        </div>





        <div class="modal fade comman-modal newmodal add-to-Newcard" id="AddonsShow{{$item->id}}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <span class="cancel-this-order" style="display:none;"></span>
            <div class="vertical-align-outer-div">
                <div class="vertical-align-inner-div">
                  
                    <div class="modal-dialog" id="modal-dialog" role="document">
                        <div class="modal-content" id="modal-content">
                            <div class="modal-header modal-header-padding">
                                <!-- style="border-bottom: 1px solid #ccc; position: fixed; top: 0; left: 0; right: 0;"-->
                                <h5>Addons</h5>
                                <div class="close-btn">
                                    <i class="far fa-times-circle" data-dismiss="modal" aria-label="Close"></i>
                                </div>
                            </div>
                            <div class="modal-body" id="modal-body">

                              @if(!empty($item->addons))
                              @foreach($item->addons as $index=>$data)

                              <div class="card">
                                <div class="card-header" id="footer-card-head1">
                                    {{$data['addon_group_name']}}

                                </div>
                                <div class="card-body">


                                    
                                   @foreach($data['group_list'] as $index1=>$data1)

                                   <p>
                                    @if($data['addon_group_type']=='Single')

                                    <label>   

                                        <input type="radio" value="{{$data1->id}}" code="{{$data1->addon_price}}" id="{{$data['id']}}" class="calpriceclass addone_name{{$data['id']}}" name="{{$data1->addon_group_id}}"  {{$data['addon_group_validation'] =='Compulsory' ? 'required' : ''}}> {{$data1->addon_name}}</label>
                                        
                                        


                                        @else

                                        <label>    <input type="checkbox" value="{{$data1->id}}" codecheck="{{$data1->addon_price}}" id="{{$data['id']}}" class="calpriceclass extramulticheckbox addone_names{{$data['id']}}" {{$data['addon_group_validation'] =='Compulsory' ? 'required' : ''}} name="{{$data1->addon_group_id}}[]"  >
                                         {{$data1->addon_name}}</label>


                                         @endif


                                         
                                         <span class="pull-right dollar-cost">
                                          <img src="{{url('public/img/dollar.png')}}" class="dollar-img"> {{$data1->addon_price}}
                                      </span>
                                  </p>
                                  @endforeach
                                  

                              </div>


                          </div>

                          @endforeach
                          @endif


                      </div>
                      <div class="modal-footer" id="modal-footer">

                        <div class="row" style="width:100%">
                           <div class="col-md-5">
                            
                            <div class="service ">


                                <div  class="counter-div list-service " id="counter-div0{{$item->service_id}}"> 
                                    <div class="row d-flex parent_cls modal_parent_cls">
                                        <div class="col-md-4 col-1">
                                            <div class="icon-div list-service changeitemquantity1 minus{{$item->service_id}}" ddd="{{$item->id}}" data_id="{{$item->service_id}}" id="incremen1{{$item->service_id}}" data="substraction" >
                                                <i class="fas fa-minus"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-2">
                                          @if(!empty($item->shopping_cart))
                                          <p class="counterm list-service theCount"   id="theCount0{{$item->service_id}}">{{$item->shopping_cart->quantity}}</p>

                                          <input type="hidden" class="qty-input form-control" id="theCountVal0{{$item->service_id}}" maxlength="2" max="10" value="{{$item->shopping_cart->quantity}}">
                                          @else
                                          <p class="counterm list-service theCount"   id="theCount0{{$item->service_id}}">1</p>

                                          <input type="hidden" class="qty-input form-control" id="theCountVal0{{$item->service_id}}" maxlength="2" max="10" value="1">

                                          @endif


                                      </div>
                                      <div class="col-md-4 col-1">
                                        <div class="icon-div list-service changeitemquantity1 add{{$item->service_id}}" ddd="{{$item->id}}" data_id="{{$item->service_id}}" id="decrement1{{$item->service_id}}" data="addition" >
                                            <i class="fas fa-plus"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-7 setbutton">

                        <input type="hidden" name="basic_price" value="{{$item->service_price}}" class="basic_price{{$item->id}}">
                        <input type="hidden" name="addon_price" value="0" class="addon_price{{$item->id}}">
                        <input type="hidden" name="all_check_id" class="all_check_id{{$item->id}}">
                        <input type="hidden" name="quantity" value="1" class="quantity_id{{$item->id}}">


                        <button type="button" name="submit" class="addtocardbtn addtocartBtn" id="additemincart{{$item->id}}"  idd="{{$item->id}}" data_id="{{$item->service_id}}">
                            <div class="d-flex justify-content-between align-atems-center">
                                <span>Add to Cart</span>
                                <div class="d-flex align-atems-center">
                                    <span class="addtocartText">  Total</span> 
                                    $   <span class="final_price{{$item->id}}">{{$item->service_price}}  </span>
                                </div>
                            </div>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</div>
</div>
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
<script src="{{asset('public/js/validation.js')}}"></script>
<script src="{{asset('public/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{ asset('public/js/mande_app.js') }}"></script>
<script src="{{ asset('public/js/forms.js') }}"></script>
<!--<script src="{{ asset('public/js/bootstrap.min.js') }}"></script>-->

<script src="{{ asset('public/js/daterangepicker.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {


      

  $('.select2').select2({
              maximumSelectionLength: 2

        });


// .............
$(".calpriceclass").change(function(){

  var serviceid = $(this).attr('id'); 



  var radioamount = 0;
  var addon_id = 0;
  var extrasingle = $(".addone_name"+serviceid+":checked").map(function(){
      radioamount += parseFloat($(this).attr('code'));
      return this.value;
      
  }).get();




  console.log(extrasingle)

  var checkboxamount = 0;

  var extramultiple = $(".addone_names"+serviceid+":checked").map(function() {
     checkboxamount += parseFloat($(this).attr('codecheck'));
     return this.value;
 }).get();

  
  console.log(extramultiple)







  var pay = getNumber(radioamount,0) + getNumber(checkboxamount,0) ;

      // console.log(pay)
      var final_price=$(".basic_price"+serviceid).val();


      var all_check_id = $(".calpriceclass:checked").map(function() {
        return this.value;
    }).get().join(",");


// console.log(all_check_id)





console.log(extramultiple)


// if(extrasingle.length != 0 && extramultiple.length != 0) {

// $('#additemincart'+serviceid).prop('disabled', false);
// }else{

//     $('#additemincart'+serviceid).prop('disabled', true);

// }






$(".addon_price"+serviceid).val(pay);
$(".all_check_id"+serviceid).val(all_check_id);

var sellprice=parseFloat(final_price)+pay;

var quantity=$(".quantity_id"+serviceid).val();



$(".final_price"+serviceid).html(sellprice*quantity);
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

     var seturl = "{{url('updatecartserviceajax')}}?item_id="+item_id+"&mainqty="+1;

}
 }else{


  if(priquantity != 1){

    var quantity = parseInt(priquantity) - 1;

    $("#theCount"+item_id).text(quantity);
    $(this).parents('.parent_cls').find('.qty-input').val(quantity);


    var seturl = "{{url('updatecartserviceajax')}}?item_id="+item_id+"&mainqty="+-1;


}else{

// alert(item_id)
$("#counter-div"+item_id).hide();
$("#addtocard"+item_id).show();


$("#theCount"+item_id).text(quantity);
$(this).parents('.parent_cls').find('.qty-input').val(quantity);



var seturl = "{{url('removecartservice')}}?item_id="+item_id;

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

var serviceid = $(this).attr('ddd'); 

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



var final_price=$(".basic_price"+serviceid).val();

var addon_price=$(".addon_price"+serviceid).val();
$(".quantity_id"+serviceid).val(quantity);


var sellprice=parseFloat(final_price)+parseFloat(addon_price);
$(".final_price"+serviceid).html(sellprice*quantity);


});
// ............................item_id



$('.add-to-card').on('click','.addtocardbtn',function(){

   
    var serviceid=$(this).attr('idd');
    var item_id=$(this).attr('data_id');
    var priquantity = $('#theCount0'+item_id).text();
    var price = $('#theCount0'+item_id).text();
    var addon_price=$(".addon_price"+serviceid).text();

    var all_check_id=$(".all_check_id"+serviceid).val();


    $("#counter-div"+item_id).show();

    $("#addtocard_no"+item_id).hide();



// alert(priquantity)serviceid 

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

    $("#AddonsShow"+serviceid).modal('toggle');

// location.reload();


  // $("#mydiv"+serviceid).html('');
  //        $("#mydiv"+serviceid).html(res.loadbutton);



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


            var service_id=$(this).attr('service_id');
// alert(service_id)

var attr_val = $(".onchange_attribute").map(function(){
  return $(this).val();
}).get();

var attr_name = $(".onchange_attribute").map(function(){
  return $(this).attr('data');
}).get();

console.log({attr_val:attr_val,attr_name:attr_name,service_id:service_id})


var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

$.ajax({
    type:"POST",
    url:"{{url('attr_base_change_item')}}",
    data:{_token: CSRF_TOKEN, attr_val:attr_val,attr_name:attr_name,service_id:service_id},
    dataType:'JSON',


    beforeSend: function(){
      $("#loader").show();
  },
  success:function(res){ 
    console.log(res,'response');
    
    $("#mydiv"+service_id).html('');
    $("#mydiv"+service_id).html(res.loadbutton);

    
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

  var service_id=$(this).attr('service_id');
  var service_user_id=$(this).attr('service_user_id');

  $("#heart_dislike_"+service_id).show();
  $("#heart_like_"+service_id).hide();

  
  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

  $.ajax({
     type:"POST",
     url:"{{url('like_update')}}",
     data:{_token: CSRF_TOKEN, id:userid,store_id:service_id,store_user_id:service_user_id},
     dataType:'JSON',

     success:function(res){ 
// console.log(res);

}
});
});
// ...................


$('.add-to-card').on('click','.heart_dislike',function(){


  
  var userid=$(this).attr('data');
  var service_id=$(this).attr('service_id');
  var service_user_id=$(this).attr('service_user_id');
  
  console.log(userid,'dislike_id')

// $(".fas.fa-heart").hide();
// $(".far.fa-heart").show();

$("#heart_dislike_"+service_id).hide();
$("#heart_like_"+service_id).show();

var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

$.ajax({
 type:"POST",
 url:"{{url('dislike_update')}}",
 data:{_token: CSRF_TOKEN, id:userid,store_id:service_id,store_user_id:service_user_id},
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
// $(document).on('click', '.service_category_cls', function(e) {


//      var service_cat_id = $(this).attr('data');

//             var category = '{{ \Request::input('category') }}';


//             if(service_cat_id){
//               var category_cls = service_cat_id;
//             }else{
//               var category_cls = '{{ \Request::input('category') }}';
//             }


//             if($('.service_subcategory_cls').is(':checked')){
//               var subcategory_cls = $('input[name=subcategory]:checked').val();
//             }
//             else{
//               var subcategory_cls = '{{ \Request::input('subcategory') }}';
//             }


//                if($('.brand_cls').is(':checked')){
//               var brand_cls = $('input[name=brand]:checked').val();
//             }
//             else{
//               var brand_cls = '{{ \Request::input('brand') }}';
//             }



// var sorting_cls = $('.sorting_cls').val()

// if (!sorting_cls) {
// var sorting_cls = '{{ \Request::input('sort') }}';
// }


// var keyword_cls = $('.keyword_cls').val();

//           if(!keyword_cls){
//                 var keyword_cls = '{{ \Request::input('keyword') }}';
//               }



//   var postParam = {
                // 'category': category_cls,
//                 'category': subcategory_cls,
//                 'brand': brand_cls,
//                 'keyword':keyword_cls,
//                 'sort':sorting_cls,

// }
//     var querystring = encodeQuery(postParam);


// // var urls= {!! json_encode(url('/')) !!} +'/' +'{{ \Request::segment(1) }}' +'/' +'{{ \Request::segment(2) }}'+'?'+querystring;
// var urls = @json(url('/book/'.Request::segment(2)))+'?'+querystring;

// urls=urls.toLowerCase(urls);

// history.pushState('', '', urls)
// location.href =urls;

// })



// ....................
$(document).on('click', '.service_subcategory_cls', function(e) {

 

   if($(this).is(':checked')){
      var subcategory_cls = $(this).val();
  }else{
      var subcategory_cls = '';
  }


  var category_cls = $('#service_cats_id').val();


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
                // 'category': category_cls,
                'category': subcategory_cls,
                'brand': brand_cls,
                'keyword':keyword_cls,
                'sort':sorting_cls,

            }
            var querystring = encodeQuery(postParam);


// var urls= {!! json_encode(url('/')) !!} +'/' +'{{ \Request::segment(1) }}' +'/' +'{{ \Request::segment(2) }}'+'?'+querystring;

var urls = @json(url('/book/'.Request::segment(2)))+'?'+querystring;

urls=urls.toLowerCase(urls);

history.pushState('', '', urls)
location.href =urls;

})




// ....................
$(document).on('click', '.brand_cls', function(e) {


    var data=$(this).attr('data')
    
    var category_cls = $('#service_cats_id').val();

    if(!category_cls){
        var category_cls = '{{ \Request::input('category') }}';
    }


    if($('.service_subcategory_cls').is(':checked')){
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
                // 'category': category_cls,
                'category': subcategory_cls,
                'brand': brand_cls,
                'keyword':keyword_cls,
                'sort':sorting_cls,

            }
            var querystring = encodeQuery(postParam);


// var urls= {!! json_encode(url('/')) !!} +'/' +'{{ \Request::segment(1) }}' +'/' +'{{ \Request::segment(2) }}'+'?'+querystring;

var urls = @json(url('/book/'.Request::segment(2)))+'?'+querystring;

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


if($('.service_subcategory_cls').is(':checked')){
  var subcategory_cls = $('input[name=subcategory]:checked').val();
}else{
  var subcategory_cls = '';
}


var category_cls = $('#service_cats_id').val();


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
                // 'category': category_cls,
                'category': subcategory_cls,
                'brand': brand_cls,
                'keyword':keyword_cls,
                'sort':sorting_cls,

            }
            var querystring = encodeQuery(postParam);


            {{-- var urls= {!! json_encode(url('/')) !!} +'/' +'{{ \Request::segment(1) }}' +'/' +'{{ \Request::segment(2) }}'+'?'+querystring; --}}

            var urls = @json(url('/book/'.Request::segment(2)))+'?'+querystring;

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


if($('.service_subcategory_cls').is(':checked')){
  var subcategory_cls = $('input[name=subcategory]:checked').val();
}else{
  var subcategory_cls = '';
}


var category_cls = $('#service_cats_id').val();


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
    'category': subcategory_cls,
    'brand': brand_cls,
    'keyword':keyword_cls,
    'sort':sorting_cls,

}
var querystring = encodeQuery(postParam);


{{-- var urls= {!! json_encode(url('/')) !!} +'/' +'{{ \Request::segment(1) }}' +'/' +'{{ \Request::segment(2) }}'+'?'+querystring; --}}



var urls = @json(url('/book/'.Request::segment(2)))+'?'+querystring;

urls=urls.toLowerCase(urls);

history.pushState('', '', urls)

location.href =urls;


})


// ....................




})

</script>


<script type="text/javascript">
  $(document).ready(function() {

   $(".daterange").daterangepicker({
      // opens: "left",
       singleDatePicker: true,

      locale: {
        format: 'YYYY-MM-DD'
    },
});

   $('.whishlist').on('click','.heart_like',function(){





      var service_id=$(this).attr('service_id');
      var service_user_id=$(this).attr('service_user_id');

      $("#heart_dislike_"+service_id).show();
      $("#heart_like_"+service_id).hide();

      
      var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');


      console.log({_token: CSRF_TOKEN,store_id:service_id,store_user_id:service_user_id},'likeid')

      $.ajax({
         type:"POST",
         url:"{{url('like_update')}}",
         data:{_token: CSRF_TOKEN,store_id:service_id,store_user_id:service_user_id},
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


  
    var service_id=$(this).attr('service_id');
    var service_user_id=$(this).attr('service_user_id');
    
     // console.log(userid,'dislike_id')

// $(".fas.fa-heart").hide();
// $(".far.fa-heart").show();

$("#heart_dislike_"+service_id).hide();
$("#heart_like_"+service_id).show();

var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
console.log({_token: CSRF_TOKEN,store_id:service_id,store_user_id:service_user_id},'likeid')

$.ajax({
 type:"POST",
 url:"{{url('dislike_update')}}",
 data:{_token: CSRF_TOKEN,store_id:service_id,store_user_id:service_user_id},
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


