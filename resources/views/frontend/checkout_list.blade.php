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
                height: 50vh; 
                overflow-y: scroll;
                overflow: overlay;
                scrollbar-width: thin;
            }
            .scroll::-webkit-scrollbar {
                /*display: none;*/
                width: 5px;
            }
            
            .card .card-header{
                
                
                color:white;
                font-family: Bitter,serif;
                font-weight:none;
                padding: 1rem;
                
            }
            
            .card-header h4{
                
                color:white;
                font-family: Bitter,serif;
                font-weight:none;
                
            }
            .totalweight{
                font-weight:bold;
                background:rgba(155, 155, 155, 0.5);
                color:black;
            }
            .repet-stripe > #cart_items_rows:nth-of-type(odd) {
                background: rgb(247 247 247);
            }
        </style>
        
@if(count($products)>0)
<div class="product-list-checkout" id="myCheckputCart">
    <div class="card card4 ">
  
                    
        
        <div class="total-weight mb-0">
            <h6 class="h6">Payment Details  ( <span id="sidebar_cart">{{$products->count()}}</span> Items ) </h6>
        </div>
      <!---->
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
                                        @if(isset($total_main_price))
                                        <p>+<i class="fa fa-usd" aria-hidden="true"></i> <span id="sideCart_subtotal">{{$total_main_price}}</span></p>
                                        @endif
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

                                       @if(isset($discount_price))
                                        <p>-<i class="fa fa-usd" aria-hidden="true"></i> <span id="sideCart_delivery">{{$discount_price}}</span></p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            

                                <div class="row">
                                <div class="col-md-6 col-xs-6">
                                    <p>SubTotal</p>
                                </div>
                                <div class="col-md-1 col-xs-1">
                                    <p>:</p>
                                </div>
                                <div class="col-md-5 col-xs-5">
                                    <div class="pull-right">

                                       @if(isset($total_price))
                                        <p>-<i class="fa fa-usd" aria-hidden="true"></i> <span id="sideCart_delivery">{{$total_price}}</span></p>
                                        @endif
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
                            
                         
    </div>
    </div>
           
            </div>
        </div>
        @else
        
<div class="card-body sidecart-empty">
<div class="row row1">
<div class="col-md-12 center">
<img src="{{url('/')}}/public/frontend/img/empty-cart-icon.png">
<h4 class="center">No items in your cart</h4>
<p class="center">Please Add Something in Your Cart</p>
<a href="/" class="mx-2">
<button class="btn btn-raised btn-success width100" data-toggle="modal" data-target="#loginsignup">Go to Dashboard </button>
</a>
<a href="{{url('/'.Session::get('locality_url'))}}" class="mx-2">
<button class="btn btn-raised btn-success width100" data-toggle="modal" data-target="#loginsignup">Start Shopping</button>
</a>
</div>
</div>
</div>
    @endif