<div class="container-fluid">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3 order-2" >
                        {{-- <div class="rounded border d-flex justify-content-center align-items-center">
                            <img class="big-image"
                                src="https://mandeclan.com/demo/public/images/product_items/09_03_2022_11_13_471.jpg">
                        </div> --}}
                        
                         <div class="xzoom-container rounded border"  id="imgcontainer" >
                         
                              @if(!empty($items->item_img1))
                                <img class="xzoom big-image"  id="xzoom-default" src="{{ asset('public/images/product_items/'.$items->item_img1)}}" width="400px" height="400px" xoriginal="{{ asset('public/images/product_items/'.$items->item_img1)}}" />
                                @else
                                <img class="xzoom big-image"  id="xzoom-default" src="{{ asset('public/img/no-image.png')}}" width="400px" height="400px" xoriginal="{{ asset('public/img/no-image.png')}}" />

                                @endif
                            </div>

                    </div>
                    <div class="col-md-1 order-1">
                        <div class="d-flex flex-column ">
                            {{-- <a class="rounded border small-img-box mb-2">
                                <img class="small-image"
                                    src="https://mandeclan.com/demo/public/images/product_items/09_03_2022_11_13_471.jpg">
                            </a>
                            <a class="rounded border small-img-box mb-2">
                                <img class="small-image"
                                    src="https://mandeclan.com/demo/public/images/product_items/09_03_2022_11_13_471.jpg">
                            </a> --}}
                             <div class="xzoom-container justify-content-center">
                                <div class="xzoom-thumbs " id="img-xzoom-thumbs ">
                                     @if($items->item_img1)
                                      <a href="{{ asset('public/images/product_items/'.$items->item_img1)}} "> <img class="xzoom-gallery rounded border" id="item_img1_id" width="66px" height="70px" src="{{ asset('public/images/product_items/'.$items->item_img1)}}"></a>
                                    @endif

                                     @if($items->item_img2)
                                    <a href="{{ asset('public/images/product_items/'.$items->item_img2)}}"> <img class="xzoom-gallery rounded border" id="item_img2_id" width="66px" height="70px" src="{{ asset('public/images/product_items/'.$items->item_img2)}}"></a>
                                    @endif

                                     @if($items->item_img3)
                                    <a href="{{ asset('public/images/product_items/'.$items->item_img3)}}"> <img class="xzoom-gallery rounded border" id="item_img3_id" width="66px" height="70px" src="{{ asset('public/images/product_items/'.$items->item_img3)}}"></a>
                                    @endif

                                     @if($items->item_img4)
                                    <a href="{{ asset('public/images/product_items/'.$items->item_img4)}}"> <img class="xzoom-gallery rounded border" id="item_img4_id" width="66px" height="70px" src="{{ asset('public/images/product_items/'.$items->item_img4)}}"></a>
                                    @endif
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 order-3 mt-3">
                        <h4>{{$items->product_name}}</h4>
                        
                                   <div class="pricing d-flex">
                            <p>Price: </p>
                            <span class="mx-4"><i class="fa fa-dollar"></i> {{$item_selling_price}}</span>
                  

                        @if(!empty($items->item_offer_discount))
                            <span class="cnLyze hEkmRy bWSOET pl-2" id="item_price_id">  <i class="fa fa-dollar"></i> {{$items->item_price}}</span>
                            
                            <span class="jENgNp pl-3"  id="item_offer_discount_id"></i> {{$items->item_offer_discount}} % off </span>
                              @endif
                        </div>

             

                          <?php
$i = 0;
$len = count($attributes);
                        ?>
        @foreach($attributes as $index=>$data)

                        <div class="row m-auto d-xm-flex justify-content-between align-items-center">
                            <p class="col-md-2 text-capitalize">{{$data->attribute_name}}</p>
                            <div class="col-md-10 btn-box">
                                        @foreach(explode(',',$data->attribute_value) as $key=>$value)
                                {{-- <button type="button" class="buttons">{{$value}}</button> --}}

<div class="button ">
        <input type="radio"   name="{{$data->attribute_name}}[]" value="{{$value}}" data="{{$data->attribute_name}}" product_id="{{$items->id}}" class="onchange_attribute" id="radio_id_{{$value}}" data="{{$value}}" {{in_array($value, $attr_arr) ? 'checked="checked"' : ''}} />
        <label class="btn btn-default" for="radio_id_{{$value}}">{{$value}}</label>
        </div>                                
        @endforeach
                          </div>
                            
                        </div>
                        @endforeach
                        
                        
                        
                        <div class="col-lg-4 m-auto float-left">
                            {{-- <div class="col-md-12">
                           
                                <button type="button" class="btn btn-outline-primary addToCart" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    <i class="fa fa-shopping-cart"></i> Add to cart
                                </button>

                               

                                <div class="customize">customize</div>
                            </div>

                            <div class="mt-2 ms-2 col-md-2 d-flex justify-content-between px-0">
                                <button type="button" class="cart-buttons text-white"><i
                                        class="fa-solid fa-plus"></i></button>
                                <span class="text-black fs-5">1</span>
                                <button type="button" class="cart-buttons text-white"><i
                                        class="fa-solid fa-minus"></i></button>
                            </div>
                            <div class="mt-2 ms-2 col-md-12 d-flex justify-content-between px-0">

                            </div> --}}

<div id="" class="product" style="margin-top:30px">

 @if(!empty($shopping_cart))
                   
                @if($items->item_status=='Available') 

                 <div  class="counter-div list-product " id="counter-div{{$items->item_id}}"> 
                        <div class="d-flex parent_cls">
                            <div class="col-md-4">
                                <div class="icon-div list-product changeitemquantity minus{{$items->item_id}}" data_id="{{$items->item_id}}" id="increment{{$items->item_id}}" data="substraction" >
                                    <i class="fas fa-minus"></i>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="counterm list-product theCount"   id="theCount{{$items->item_id}}">{{$shopping_cart->quantity}}</div>

                             <input type="hidden" class="qty-input form-control" id="theCountVal{{$items->item_id}}" maxlength="2" max="10" value="{{$shopping_cart->quantity}}">

                               

                            </div>
                            <div class="col-md-4">
                                <div class="icon-div list-product changeitemquantity add{{$items->item_id}}" data_id="{{$items->item_id}}" id="decrement{{$items->item_id}}" data="addition" >
                                    <i class="fas fa-plus"></i>
                                </div>
                            </div>
                        </div>
                    </div>


                <div class="addtocard list-product" style="display:none;" id="addtocard{{$items->item_id}}" data="{{$items->item_id}}"><i class="fa fa-shopping-cart"></i> Add to Cart</div>

                @else
                <span class="btn btn-sm btn-outline-warning btn-rounded" style="border-radius: 5px; text-align:right;">Out of Stock<div class="ripple-container"></div></span>
                @endif



                    @else

                    

@if($items->item_status=='Available') 

 <div  style="display: none;" class="counter-div list-product " id="counter-div{{$items->item_id}}"> 
                        <div class="row parent_cls">
                            <div class="col-md-4">
                                <div class="icon-div list-product changeitemquantity minus{{$items->item_id}}" data_id="{{$items->item_id}}" id="increment{{$items->item_id}}" data="substraction" >
                                    <i class="fas fa-minus"></i>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <p class="counterm list-product theCount"   id="theCount{{$items->item_id}}"></p>

                             <input type="hidden" class="qty-input form-control" id="theCountVal{{$items->item_id}}" maxlength="2" max="10" value="">

                               

                            </div>
                            <div class="col-md-4">
                                <div class="icon-div list-product changeitemquantity add{{$items->item_id}}" data_id="{{$items->item_id}}" id="decrement{{$items->item_id}}" data="addition" >
                                    <i class="fas fa-plus"></i>
                                </div>
                            </div>
                        </div>
                    </div>
<div class="addtocard list-product" id="addtocard{{$items->item_id}}" data="{{$items->item_id}}"><i class="fa fa-shopping-cart"></i> Add to Cart</div>
                @else
                <span class="btn btn-sm btn-outline-warning btn-rounded" style="border-radius: 5px; text-align:right;">Out of Stock<div class="ripple-container"></div></span>
                @endif

                    
                    @endif



                    </div> 
                        </div>
                    </div>
                </div>
            </div>

@if(!empty($items->product_description) && !empty($items->product_key_features))
            <div class="col-md-12 mt-4">
                   {!!$items->product_description!!}
                        {!!$items->product_key_features!!}
            </div>
            @endif
        </div>
    </div>
 

 {{-- .................................. --}}
  <div class="modal fade" id="exampleModal" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title" id="exampleModalLabel">Shreeshivam Wedding
                                                    Fashion & Lifestyle Clothing Shop</h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="fs-6 text-uppercase">quantity</div>
                                                <div class="border-bottom pb-2 mb-2">
                                                    <div
                                                        class="form-check ms-2 mt-2 d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <input class="form-check-input" type="radio"
                                                                name="flexRadioDefault" id="flexRadioDefault1">
                                                            <label class="form-check-label" for="flexRadioDefault1">
                                                                Half
                                                            </label>
                                                        </div>

                                                        <div class="fs-6 text-secondary"><i
                                                                class="fa fa-dollar"></i> 39</div>
                                                    </div>
                                                    <div
                                                        class="form-check ms-2 mt-2 d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <input class="form-check-input" type="radio"
                                                                name="flexRadioDefault" id="flexRadioDefault2">
                                                            <label class="form-check-label" for="flexRadioDefault2">
                                                                Full
                                                            </label>
                                                        </div>

                                                        <div class="fs-6 text-secondary"><i
                                                                class="fa fa-dollar"></i> 75</div>
                                                    </div>
                                                </div>

                                                <div class="fs-6 text-uppercase">free extra</div>
                                                <div class="pb-2">
                                                    <div
                                                        class="form-check  ms-2 mt-2 d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <input class="form-check-input" type="checkbox" value=""
                                                                id="flexCheckDefault">
                                                            <label class="form-check-label" for="flexCheckDefault">
                                                                Default checkbox
                                                            </label>
                                                        </div>
                                                        <div class="fs-6 text-secondary"><i
                                                                class="fa fa-dollar"></i> 10</div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="modal-footer d-flex justify-content-between align-items-center">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="fw-bold">Total <i class="fa fa-dollar"></i>
                                                        39 </div>
                                                </div>
                                                <div>
                                                    <button type="button" class="btn addToCart text-uppercase"
                                                        data-bs-dismiss="modal"><i
                                                            class="fa-solid text-uppercase fa-cart-shopping"></i> add to
                                                        cart</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>