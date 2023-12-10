        <div class="card addToCards" id="cart_items_rows">
                                       
            <div class="row row1" style="margin-bottom:5px;" id="entryRow1923">
                <div class="col-md-2 col-xs-3">
                    <a href="{{url('details/'.$item->product_link)}}?item={{$item->item_unique_id}}">
                     <div class="images">
                                               @if(!empty($item->item_img1))
              <img src="{{ asset('public/images/product_items/'.$item->item_img1)}}" alt="dd" />
              @else
              <img src="{{ asset('public/img/no-image.png')}}" alt="dd" />
              @endif
               </div>
                  </a>
                   </div>
                      <div class="col-md-10 col-xs-9">
                       <div class="row ">
                           <div class="col-md-12">
                            <a href="{{url('details/'.$item->product_link)}}?item={{$item->item_unique_id}}">
                                       <div class="content">
                       <h4 class="product-name">{{$item->product_name}} </h4>
                    <p class="category-name">{{$item->product_category}} - {{$item->product_subcategory}}</p>

                          </div>
                         </a>
                          </div>
                                           
                                          
                    <div class="col-md-6 col-xs-6 order3 ">
                                                  

@if(!empty($item->product_description))
                                <p>  {{substr(strip_tags($item->product_description), 0, 100)}} </p>

@endif
        <div style="display:flex">

               @foreach($item->attributes1 as $ind=>$da)
 <?php

                    if (!empty($item->item_attr_varient)) {
                       
                    
                $a1=explode(',',$da->attribute_value);
                $a2=explode('/',$item->item_attr_varient);
                $newa=array_values(array_intersect($a1,$a2));
                $a3=explode(',',$da->attribute_value);
                $aaaa=array_combine($a3, $a3);

}
                ?>

                @if(!empty($item->item_attr_varient))
        <span class="margin_left">
            <div class="attribute">{{$da->attribute_name}}</div>
          
            {!!Form::select('attributes[]',$aaaa,$newa[0],array('class'=>'custom-select size_dropdown select2 onchange_attribute','data-toggle'=>'select2','autocomplete'=>'off','required','data'=>$da->attribute_name,'product_id'=>$item->id)) !!}

        </span>

         @endif

        @endforeach
</div>

                                                  
                                                </div>
                                                
                                                <div class="col-md-3 col-xs-6 order2">
                                                     <a href="{{url('details/'.$item->product_link)}}?item={{$item->item_unique_id}}">
                                                    <div class="pull-right">
                                                        <div class="content">
                                                         <p class="rupees"><img src="{{url('/')}}/public/frontend/img/dollar.png">{{$item->item_selling_price}}  {{-- @if(!empty($item->item_offer_discount)) <del>  $ {{$item->item_price}}</del> @endif --}}</p>
                                                     </div>
                                                 </div>
                                             </a>
                                             </div>
                                             <div class="col-md-3 col-xs-6 order4">
                                             

                                                <div class="product ">
                                                   
  @if(!empty($item->shopping_cart))
                    <div  class="counter-div list-product " id="counter-div{{$item->item_id}}"> 
                        <div class="d-flex parent_cls" >
                            <div class="col-md-4">
                                <div class="icon-div list-product changeitemquantity minus{{$item->item_id}}" data_id="{{$item->item_id}}" id="increment{{$item->item_id}}" data="substraction" >
                                    <i class="fas fa-minus"></i>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <p class="counterm list-product theCount"   id="theCount{{$item->item_id}}">{{$item->shopping_cart->quantity}}</p>

                             <input type="hidden" class="qty-input form-control" id="theCountVal{{$item->item_id}}" maxlength="2" max="10" value="{{$item->shopping_cart->quantity}}">

                               

                            </div>
                            <div class="col-md-4">
                                <div class="icon-div list-product changeitemquantity add{{$item->item_id}}" data_id="{{$item->item_id}}" id="decrement{{$item->item_id}}" data="addition" >
                                    <i class="fas fa-plus"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @if($item->item_status=='Available')
                    <div class="addtocard_new list-product"  style="display:none;" id="addtocard{{$item->item_id}}" data="{{$item->item_id}}">Add to Cart</div>
                    @else
                
                      <span class="btn btn-sm btn-outline-warning btn-rounded" style="border-radius: 5px; text-align:right;">Out of Stock<div class="ripple-container"></div></span>


                    @endif

                    @else

                     <div  style="display: none;" class="counter-div list-product " id="counter-div{{$item->item_id}}"> 
                        <div class="d-flex parent_cls" >
                            <div class="col-md-4">
                                <div class="icon-div list-product changeitemquantity minus{{$item->item_id}}" data_id="{{$item->item_id}}" id="increment{{$item->item_id}}" data="substraction" >
                                    <i class="fas fa-minus"></i>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <p class="counterm list-product theCount"   id="theCount{{$item->item_id}}">1</p>

                             <input type="hidden" class="qty-input form-control" id="theCountVal{{$item->item_id}}" maxlength="2" max="10" value="1">

                               

                            </div>
                            <div class="col-md-4">
                                <div class="icon-div list-product changeitemquantity add{{$item->item_id}}" data_id="{{$item->item_id}}" id="decrement{{$item->item_id}}" data="addition" >
                                    <i class="fas fa-plus"></i>
                                </div>
                            </div>
                        </div>
                    </div>




                   @if($item->item_status=='Available') 
@if(!empty($item->addons))

                    <div data-toggle="modal" data-target="#AddonsShow{{$item->id}}"  class="addtocard_new list-product"  id="addtocard_no{{$item->item_id}}" data="{{$item->item_id}}">Add to Cart</div>

                    @else
                    <div   class="addtocard list-product"  id="addtocard{{$item->item_id}}" data="{{$item->item_id}}">Add to Cart</div>

                    @endif


                     @else
                     <span class="btn btn-sm btn-outline-warning btn-rounded" style="border-radius: 5px; text-align:right;">Out of Stock<div class="ripple-container"></div></span>
                    @endif

                    
                    @endif

@if(!empty($item->addons))
                 <a style="color:#aaa;font-size:12px;float: right;">Customize</a>

@else
                 @endif

                                            </div>


                                            </div>

                                              {{-- <div class="col-md-6 col-xs-6 order4">
                                               </div>
                                                
                                                <div class="col-md-6 col-xs-6">



                                                    <div class="pull-right quantity">
                                                      
                                       <a data-toggle="modal" data-target="#exampleModal" style="color:#aaa;font-size:12px">Customize</a>


                                                 </div>
                                             </div> --}}
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
                                    
<div class="product ">


<div  class="counter-div list-product " id="counter-div0{{$item->item_id}}"> 
<div class="row d-flex parent_cls modal_parent_cls">
    <div class="col-md-4 col-1">
        <div class="icon-div list-product changeitemquantity1 minus{{$item->item_id}}" ddd="{{$item->id}}" data_id="{{$item->item_id}}" id="incremen1{{$item->item_id}}" data="substraction" >
            <i class="fas fa-minus"></i>
        </div>
    </div>
    <div class="col-md-4 col-2">
      @if(!empty($item->shopping_cart))
      <p class="counterm list-product theCount"   id="theCount0{{$item->item_id}}">{{$item->shopping_cart->quantity}}</p>

      <input type="hidden" class="qty-input form-control" id="theCountVal0{{$item->item_id}}" maxlength="2" max="10" value="{{$item->shopping_cart->quantity}}">
      @else
      <p class="counterm list-product theCount"   id="theCount0{{$item->item_id}}">1</p>

      <input type="hidden" class="qty-input form-control" id="theCountVal0{{$item->item_id}}" maxlength="2" max="10" value="1">

      @endif


  </div>
  <div class="col-md-4 col-1">
    <div class="icon-div list-product changeitemquantity1 add{{$item->item_id}}" ddd="{{$item->id}}" data_id="{{$item->item_id}}" id="decrement1{{$item->item_id}}" data="addition" >
        <i class="fas fa-plus"></i>
    </div>
</div>
</div>
</div>

</div>
</div>
<div class="col-md-7 setbutton">

        <input type="hidden" name="basic_price" value="{{$item->item_selling_price}}" class="basic_price{{$item->id}}">
        <input type="hidden" name="addon_price" value="0" class="addon_price{{$item->id}}">
        <input type="hidden" name="all_check_id" class="all_check_id{{$item->id}}">
        <input type="hidden" name="quantity" value="1" class="quantity_id{{$item->id}}">


        <button type="button" name="submit" class="addtocardbtn addtocartBtn" id="additemincart{{$item->id}}"  idd="{{$item->id}}" data_id="{{$item->item_id}}">
            <div class="d-flex justify-content-between align-atems-center">
                        <span>Add to Cart</span>
                <div class="d-flex align-atems-center">
                    <span class="addtocartText">  Total</span> 
                  $   <span class="final_price{{$item->id}}">{{$item->item_selling_price}}  </span>
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