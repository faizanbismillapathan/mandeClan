        <style>
            .scroll::-webkit-scrollbar-track {
              background: white;
            }
            .scroll::-webkit-scrollbar-thumb {
              background-color: rgba(155, 155, 155, 0.5);
              border-radius: 20px;
              border: gray;
            }
            .scroll{
                height: 70vh; 
                overflow-y: scroll;
                overflow: overlay;
                scrollbar-width: thin;
            }
            .scroll::-webkit-scrollbar {
                /*display: none;*/
                width: 5px;
            }
            
            .card .card-header{
                background-color:#51aa1b;
                background-color:#51aa1b !important;
                color:white;
                font-family: Bitter,serif !important;
                font-weight:none !important;
                padding: 1rem !important;
                
            }
            
            .card-header h4{
                background-color:#51aa1b !important;
                color:white;
                font-family: Bitter,serif !important;
                font-weight:none !important;
                
            }
            .shopname{
                margin-top:20px;
                background:#f9eabd;
            }
            .repet-stripe > #cart_items_rows:nth-of-type(odd) {
                background: rgb(247 247 247);
            }
        </style>
        


@if(count($products)>0)
        <div class="row" >
            <div class="col-md-8 order2">
                <div class="product-list">
                    <div class="card card1">
                        <div class="card-header">
                            <h4>Shopping Cart <small>( <span id="sidebar_cart">{{$carts->count()}}</span> Items )</small></h4>
                        </div>

                        <div class="card card1 scroll" style="">
                             
                         @foreach($products as $key=>$products_record)

                        <div class="card-padding repet-stripe">
    
                            <div class="cart-padding list shopname py-2 my-2">
                            <div class="row">
                                <div class="col-9">{{$key}}</div>
                                {{-- <div class="col-3"><div class="float-end pull-right ">Total Tax : $00 </div></div> --}}
                                <div class="col-3"><div class="float-end pull-right ">Shipping Charge : $00 </div></div>
                            </div>
                            </div>


                         @foreach(collect($products_record)->sortByDesc('id') as $index=>$data)

                                <div class="card" id="cart_items_rows">
                                       
                                    <div class="row row1" style="margin-bottom:5px;" id="entryRow1923">
                                        <div class="col-md-2 col-xs-3">
                                            <div class="images">
                                                @if($data->associatedModel->item_img1)
                                                  <img src="{{ asset('public/images/product_items/'.$data->associatedModel->item_img1)}}" alt="dd" />
                                                @else
                                                <img src="{{url('/')}}/public/frontend/img/mandeclan1.jpg" alt="">

                                                @endif
                                            </div>
                                            <div class="addons">
            <strong  class="btn btn-danger btn-sm permanantyremoveitem" data="{{$data->id}}"  data_id="{{$data->id}}"><i class="far fa-trash-alt"></i> Remove</strong>                              
            </div>
                                        </div>
                                        <div class="col-md-10 col-xs-9">
                                            <div class="row ">
                                                <div class="col-md-12">
                                                    <div class="content">
                                                        <h4 class="product-name">{{$data->name}} </h4>
                                                        <p class="category-name">{{$data->associatedModel->product_category}} - {{$data->associatedModel->product_subcategory}}</p>
                                                    </div>
                                                </div>
                                           
                                          
                                                <div class="col-md-6 col-xs-6 order3">
                                                  
                                                    <div class="quantity">
                                                           @foreach($data->attributes as $key=>$value)
                                                        <span class="span">{{$value}}</span>
                                                          @endforeach


                                                    </div>
                                                  
                                                </div>
                                                
            <div class="col-md-6 col-xs-6 order3">
                <div class="pull-right">
                    <div class="content">
                        <p class="rupees">
                            <i class="fa fa-usd mr-2" aria-hidden="true"></i>
    {{$data->price }} USD
    </p>
                    </div>
                </div>
            </div>


                    <div class="col-md-6 col-xs-6 order6">
                    @if($data->associatedModel->item_shipping_weight)
                    <span class="badge badge-success">{{$data->associatedModel->item_shipping_weight }} {{$data->associatedModel->item_shipping_weight_unit}}
                    </span>
                    @endif
                    </div>
                                                   
    <div class="col-md-6 col-xs-6 m-auto">
    <h6 class="float-end pull-right">
        @if(!empty($data->associatedModel->item_offer_discount))
       {{--  <del class="text-muted "><i class="fa fa-usd" aria-hidden="true"></i>
    {{$data->associatedModel->item_price }}</del> --}}
    <span class="jENgNp text-danger" id="item_offer_discount_id"></i>( {{$data->associatedModel->item_offer_discount}} % off )</span>
        @endif
    </h6>
        
    </div>
    <div class="col-md-12 col-xs-6 float-end pull-right">
        <div class="product pull-right">
            <div  class="counter-div list-product " id="counter-div{{$data->id}}"> 
                <div class="d-flex parent_cls">
                    
    <div class="col-md-4">
    <div class="icon-div list-product {{ $data->quantity !=1 ? 'changeitemquantity' : '' }} minus{{$data->id}}" data_id="{{$data->id}}" id="increment{{$data->id}}" data="substraction" > <i class="fas fa-minus"></i>
    </div>
    </div>
    
    <div class="col-md-4">
    <p class="counterm list-product theCount" style="float: right;padding-right: 3px;" id="theCount{{$data->id}}">{{$data->quantity}}</p>
    <input type="hidden" class="qty-input form-control" id="theCountVal{{$data->id}}" maxlength="2" max="10" value="{{$data->quantity}}">
    </div>
    
    <div class="col-md-4">

    <div class="icon-div list-product  changeitemquantity   add{{$data->id}}" data_id="{{$data->id}}" id="decrement{{$data->id}}" data="addition" >
        <i class="fas fa-plus"></i>
    </div>
    </div>
    
</div>
</div>

    <div class="addtocard list-product" style="display:none;" id="addtocard{{$data->id}}" data="{{$data->id}}">Add to Cart</div>
</div>
</div>
    <!--</div>-->

                                              @if(isset($data->associatedModel->addon_list))

                                                <div class="col-md-6 col-xs-6 order3">
            <div class="addons">

                                                           @foreach($data->associatedModel->addon_list as $key1=>$val)
                                                        <span class="span">{{$val}}</span>
                                                          @endforeach

                                    </div>
</div>
@endif
                                        </div>
                                    </div>
                                </div>
                               


                            
                        </div>
                          @endforeach
                         
                    </div>
                     @endforeach
                       
                                
                </div>
                    <div class="compare-item-shop" style="color:#fff;width:100%;background: #51aa1b;line-height:4em;padding-left:15px;padding-right:15px;text-align:center;">
                        <div class="row">
                            <div class="col-md-3">Cart ( <span class="shop-compare-item-count">{{$carts->count()}}</span> Items )</div>
                            <div class="col-md-3">Total Weight : <span class="shop-compare-item-weight">{{$all_kg}} Kg</span></div>
                            <div class="col-md-3">Product Price: <span class="shop-compare-item-price">{{$total_main_price}} $</span> </div>
                            <div class="col-md-3">Total Payment: <span class="shop-compare-item-price">{{$subtotal}} $</span> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 order1 mb-3">
            <div class="product-list-checkout shopping-chackout">
                <div class="card card4">
                    <div class="card-header">
                        <h4>Payment Information</h4>
                    </div>
                    <div class="card-body sidecart-not-empty" style="">
                        
                        <!--  -->
                        <div class="total-cost">
                            <div class="row">
                                <div class="col-md-6 col-xs-6">
                                    <p>Product Price</p>
                                </div>
                                <div class="col-md-1 col-xs-1">
                                    <p>:</p>
                                </div>
                                <div class="col-md-5 col-xs-5">
                                    <div class="pull-right">
                                        <p>+<i class="fa fa-usd" aria-hidden="true"></i> <span id="sideCart_subtotal">{{$total_main_price}}</span></p>
                                    </div>
                                </div>
                            </div>

                              <div class="row">
                                <div class="col-md-6 col-xs-6">
                                    <p>Save Price</p>
                                </div>
                                <div class="col-md-1 col-xs-1">
                                    <p>:</p>
                                </div>
                                <div class="col-md-5 col-xs-5">
                                    <div class="pull-right">
                                        <p>-<i class="fa fa-usd" aria-hidden="true"></i> <span id="sideCart_delivery">{{$discount_price}}</span></p>
                                    </div>
                                </div>
                            </div>
                            

                            
                            <div class="row">
                                <div class="col-md-6 col-xs-6">
                                    <p>Sub Total</p>
                                </div>
                                <div class="col-md-1 col-xs-1">
                                    <p>:</p>
                                </div>
                                <div class="col-md-5 col-xs-5">

                                    <div class="pull-right">
                                        <p><i class="fa fa-usd" aria-hidden="true"></i> <span id="sideCart_delivery">{{$total_price}}</span></p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 col-xs-6">
                                    <p>Taxes (18% +)</p>
                                </div>
                                <div class="col-md-1 col-xs-1">
                                    <p>:</p>
                                </div>
                                <div class="col-md-5 col-xs-5">
                                    <div class="pull-right">
                                        <p>+<i class="fa fa-usd" aria-hidden="true"></i> <span id="sideCart_delivery">{{ $total_tax_price }}</span></p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 col-xs-6">
                                    <p>Shipping Charges (+)</p>
                                </div>
                                <div class="col-md-1 col-xs-1">
                                    <p>:</p>
                                </div>
                                <div class="col-md-5 col-xs-5">
                                    <div class="pull-right">
                                        <p><i class="fa fa-usd" aria-hidden="true"></i> <span id="sideCart_delivery">00.00</span></p>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6 col-xs-6">
                                    <h5 style="color:green"><b>Total Payment</b></h5>
                                </div>
                                <div class="col-md-1 col-xs-1">
                                    <p></p>
                                </div>
                                <div class="col-md-5 col-xs-5">
                                    <div class="pull-right">
                                        <h5 style="color:green"><i class="fa fa-usd" aria-hidden="true"></i> <span id="sideCart_total"><b>{{$subtotal}}</b></span></h5>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="total-weight">
                            <div class="row">
                                <div class="col-md-5 col-xs-5">
                                    <h6 class="h6">Total Weight</h6>
                                </div>
                                <div class="col-md-1 col-xs-1">
                                    <div class="pull-right">
                                        <h6></h6>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-6">
                                    <div class="pull-right">
                                        <h6>
                                            <span id="sideCart_weigth">
                                                {{$all_kg}} Kg
                                            </span>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                    <!--<div class="card-header">-->
                    <!--    <h5>Coupon Code</h5>-->
                    <!--</div>-->
                        
              
              <div class="padding10">
                   <div  class="row" style="align-items:center">
                                            <div class="col-md-7 col-xs-7">
                                               <input type="text" id="fname" name="firstname" placeholder="Coupon Code">
                                            </div>
                                             <div class="col-md-1 col-xs-1">
                                              
                                            </div>
    <div class="col-md-4 col-xs-4 " >
        <a class="apply" style="background-color: green;padding: 12px 22px;border-radius: 5px;color: #fff;font-size: 15px;" href="#">Apply</a>
    </div>
        <p>Coupon ABCD123 applied! </p>
    </div>
    </div>
    <style>
        @media only screen and (max-width: 500px) {
            .apply{padding:12px 24px !important;}
        }
    </style>

                     
                        <div class="padding10">
                            @if(!Auth::guest() && Auth::user()->role==3)
                            <a href="{{url('/checkout')}}">
                                <button class="btn btn-raised btn-success width100" data-toggle="modal" data-target="#loginsignup">Proceed To Checkout</button>
                            </a>
                            @else

                            <a href="{{url('customer-login')}}">
                                                                <button class="btn btn-raised btn-success width100" data-toggle="modal" data-target="#loginsignup">Proceed To Checkout</button>

                            </a>

                            @endif
                        </div>
                        </div>

                        <!--  <div class="padding10" style="padding-top:0px">-->
                       
                        <!--        <button class="btn btn-raised btn-success width100" data-toggle="modal" data-target="#deleteModal">Empty Cart</button>-->
                         
                        <!--</div>-->


                       
<div class="modal fade comman-modal" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="vertical-align-outer-div">
        <div class="vertical-align-inner-div">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header modal-header-padding" style="background-color:#f26e21">
                        <h5>Empty Carts</h5>
                        <div class="close-btn">
                            <i class="far fa-times-circle" data-dismiss="modal" aria-label="Close"></i>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="trash-image">
                            <img src="{{url('/')}}/public/frontend/img/trash-can.png">
                        </div>
                        <p id="item_delete_message">Are you sure want to Empty Carts ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-raised btn-danger" id="modal_delete">Delete</button>
                        <button type="button" class="btn btn-raised btn-secondary" data-dismiss="modal" id="modal_cancel">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

                        <!--  -->
                    </div>
                    
                    
                    <script>
                        $(document).ready(function() {
                            var cart_count = 0;
                            if(cart_count === 0){
                                $('.sidecart-not-empty').show();
                                $('.sidecart-empty').show();
                            }else{
                                $('.sidecart-not-empty').show();
                                $('.sidecart-empty').hide();
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
        <!--  -->
    </div>

    @else
        
<div class="card-body sidecart-empty">
<div class="row row1">
<div class="col-md-12 center">
<img src="{{url('/')}}/public/frontend/img/empty-cart-icon.png">
<h4 class="center">No items in your cart</h4>
<p class="center">Please Add Something in Your Cart</p>
<a href="{{url('customer-login')}}" class="mx-2">
<button class="btn btn-raised btn-success width100" data-toggle="modal" data-target="#loginsignup">Go to Home </button>
</a>
<a href="{{url('/')}}" class="mx-2">
<button class="btn btn-raised btn-success width100" data-toggle="modal" data-target="#loginsignup">Start Shopping</button>
</a>
</div>
</div>
</div>
    @endif
</div>
</div>
