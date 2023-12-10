@extends('seller.layouts.app')
@section('title',"All Product Items | seller Mande Clan")

<!-- ................custom css................. -->

@section('customStyle')
@endsection

<!-- ................Add css link................. -->

@push('style')
<link rel="stylesheet" href="{{asset('public/css/bootstrap-fileupload.css')}}">

@endpush

<!-- ................body................. -->
@section('innercontent')

<main class="content">
    <div class="container-fluid p-0">

        <div class="clearfix">

          <a href="{{url('seller/products')}}" class="form-inline float-right mt--1 d-none d-md-flex">
            <button class="btn btn-info"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Back</button>
        </a>
    </div>

    <div class="card">

      <div class="card-body" >

        <div class="form-row">

           <div class="form-group col-md-4">
              <div class="row">
                <div class="col-md-4"><b>Product Name</b></div>
                <div class="col-md-1"><b>:</b></div>
                <div class="col-md-6">{{$record->product_name}}</div>
            </div>         
        </div>

        <div class="form-group col-md-4">
          <div class="row">
            <div class="col-md-4"><b>Category</b></div>
            <div class="col-md-1"><b>:</b></div>
            <div class="col-md-6">{{$record->product_category}}</div>
        </div>         
    </div>
    <div class="form-group col-md-4">
      <div class="row">
        <div class="col-md-4"><b>SubCategory</b></div>
        <div class="col-md-1"><b>:</b></div>
        <div class="col-md-6">{{$record->product_subcategory}}</div>
    </div>         
</div>

</div>

  @if(count($attributs) == 0)

            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="id_tab_addon_groups" role="tabpanel" aria-labelledby="tab_addon_groups">
                  <div class="group_create_cls" >


                   @if(!empty($record_edit))
                   {!! Form::model($record_edit,array('url' => ['seller/product-items', $record_edit->id],'method'=>'PATCH','class'=>'','id' =>'comman_form_id','files'=>'true')) !!}
                   @else
                     {!!Form::open(['url'=>['seller/product-items-store'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}
                   @endif

            


                   <div class="card table-content">
              

                <div class="card-content" style="padding:20px">
                   
                 <div class="row">

                  <div class="form-group col-md-4">
                    <label for="inputEmail4">Item Identification id</label>                                                                 {!! Form::text('item_unique_id',$keydata,array('class'=>'form-control','readonly'=>'readonly')) !!}

                </div>

                

                {{-- <div class="form-group col-md-4">
                    <label for="inputEmail4">Item Stock Quantity</label>                                                                 {!!Form::text('item_quantity',null,array('class'=>'form-control numbersOnly','placeholder'=>'','autocomplete'=>'off')) !!} 

                </div>
 --}}
                

                

                

                <div class="form-group col-md-4">
                    <label for="inputEmail4">Barcode (ISBN, UPC, GTIN, etc.):</label>                                                                 {!!Form::text('item_barcode',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off')) !!} 

                </div>


                <div class="form-group col-md-4">
                    <label for="inputEmail4">HSN/SAC Code:</label>                                                                 {!!Form::text('item_hsn_sac_code',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off')) !!} 

                </div>


                <div class="form-group col-md-4">
                    <label for="inputEmail4">SKU :</label>                                                                 {!!Form::text('item_sku',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off')) !!} 

                </div>


                


                <div class="form-group col-md-4">
                    <label for="inputEmail4">Price : * (Enter IN USD)</label>                                                                 {!!Form::text('item_price',null,array('class'=>'form-control numbersOnly numbersOnly','placeholder'=>'','autocomplete'=>'off','required')) !!} 
                </div>


            {{-- <div class="form-group col-md-4">
                <label for="inputEmail4">Offer Price : (Offer Price you entering is IN USD)</label>                                                                 {!!Form::text('item_offer_price',null,array('class'=>'form-control numbersOnly','placeholder'=>'','autocomplete'=>'off','maxlength'=>'4')) !!} 
            </div> --}}


            <div class="form-group col-md-4">
                <label for="inputEmail4">Offer Discount (%) :</label>                                                                 {!!Form::text('item_offer_discount',null,array('class'=>'form-control numbersOnly','placeholder'=>'','autocomplete'=>'off','maxlength'=>'2')) !!} 
            </div>
            <div class="form-group col-md-4">
                <label for="inputEmail4">Shipping Weight :</label> 

                <div class="input-group">
                   {!!Form::text('item_shipping_weight',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','maxlength'=>'6','required')) !!} 

                   <div class="input-group-append">
                    {!!Form::select('item_shipping_weight_unit',['kg'=>'kg','g'=>'g','lb'=>'lb','oz'=>'oz'],null,array('class'=>'form-control select2','data-toggle'=>'select2','autocomplete'=>'off','required','id'=>'addon_group_type_id','required')) !!}
                </div>
            </div>


        </div>

    </div>


    <div class="row">
        <div class="col-md-3">
          <div class="form-group author-img-bx">

            <label>Item Image :*
            </label>             

            <div class="fileupload fileupload-new" data-provides="fileupload">
                <div class="fileupload-new img-thumbnail" style="width: 180px; height: 120px;">
                    @if(!empty($record_edit->item_img1))
                    <img src="{{ asset('public/images/product_items/'.$record_edit->item_img1)}}" alt="dd" />
                    @else
                    <img src="{{ asset('public/img/no-image.png')}}" alt="dd" />
                    @endif
                </div>
                <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 180px; max-height: 120px; line-height: 20px;"></div>
                <div class="row">
                   <div class="col-md-12">
                      <button type="button" class="btn btn-secondary" style="padding: 0px; background-color: #fff;"><span class="btn btn-default btn-file">
                        <span class="btn btn-secondary fileupload-new">Choose image</span>
                        <span  class="btn btn-secondary fileupload-exists">Change</span>

                        {{ Form::file('item_img1',null, ['class' => 'form-control','required']) }}</span>

                        <a class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a></button>

                    </div>

                </div>
            </div>
        </div>
    </div>


    

    <div class="col-md-3">
      <div class="form-group author-img-bx">

        <label>Other Item Images : *

        </label>             

        <div class="fileupload fileupload-new" data-provides="fileupload">
            <div class="fileupload-new img-thumbnail" style="width: 180px; height: 120px;">
               @if(!empty($record_edit->item_img2))
               <img src="{{ asset('public/images/product_items/'.$record_edit->item_img2)}}" alt="dd" />
               @else
               <img src="{{ asset('public/img/no-image.png')}}" alt="dd" />
               @endif
           </div>
           <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 180px; max-height: 120px; line-height: 20px;"></div>
           <div class="row">
               <div class="col-md-12">
                  <button type="button" class="btn btn-secondary" style="padding: 0px; background-color: #fff;"><span class="btn btn-default btn-file">
                    <span class="btn btn-secondary fileupload-new">Choose image</span>
                    <span  class="btn btn-secondary fileupload-exists">Change</span>

                    {{ Form::file('item_img2',null, ['class' => 'form-control','required']) }}</span>

                    <a class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a></button>

                </div>

            </div>
        </div>
    </div>
</div>


<div class="col-md-3">
  <div class="form-group author-img-bx">

    <label>Other Item Images : *

    </label>             

    <div class="fileupload fileupload-new" data-provides="fileupload">
        <div class="fileupload-new img-thumbnail" style="width: 180px; height: 120px;">
           @if(!empty($record_edit->item_img3))
           <img src="{{ asset('public/images/product_items/'.$record_edit->item_img3)}}" alt="dd" />
           @else
           <img src="{{ asset('public/img/no-image.png')}}" alt="dd" />
           @endif
       </div>
       <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 180px; max-height: 120px; line-height: 20px;"></div>
       <div class="row">
           <div class="col-md-12">
              <button type="button" class="btn btn-secondary" style="padding: 0px; background-color: #fff;"><span class="btn btn-default btn-file">
                <span class="btn btn-secondary fileupload-new">Choose image</span>
                <span  class="btn btn-secondary fileupload-exists">Change</span>

                {{ Form::file('item_img3',null, ['class' => 'form-control']) }}</span>

                <a class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a></button>

            </div>

        </div>
    </div>
</div>
</div>


<div class="col-md-3">
  <div class="form-group author-img-bx">

    <label>Other Item Images : *

    </label>             

    <div class="fileupload fileupload-new" data-provides="fileupload">
        <div class="fileupload-new img-thumbnail" style="width: 180px; height: 120px;">
           @if(!empty($record_edit->item_img4))
           <img src="{{ asset('public/images/product_items/'.$record_edit->item_img4)}}" alt="dd" />
           @else
           <img src="{{ asset('public/img/no-image.png')}}" alt="dd" />
           @endif
       </div>
       <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 180px; max-height: 120px; line-height: 20px;"></div>
       <div class="row">
           <div class="col-md-12">
              <button type="button" class="btn btn-secondary" style="padding: 0px; background-color: #fff;"><span class="btn btn-default btn-file">
                <span class="btn btn-secondary fileupload-new">Choose image</span>
                <span  class="btn btn-secondary fileupload-exists">Change</span>

                {{ Form::file('item_img4',null, ['class' => 'form-control']) }}</span>

                <a class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a></button>

            </div>

        </div>
    </div>
</div>
</div>



<div class="form-group col-md-12">
  <label for="inputEmail4">Description :</label>
  {!!Form::textarea('item_description',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','maxlength'=>'1000')) !!} 
</div>   


<div class="form-group col-md-6">
  <label for="inputPassword4">Status</label>
                             <div class="row">
                              <div class="col-md-4">
                                 <label class="custom-control custom-radio">
                                    {{ Form::radio('item_status', 'Available' , true,array('class'=>'custom-control-input')) }}

                    <span class="custom-control-label">Available</span>
                  </label>                             
                              </div>
                              <div class="col-md-6"> <label class="custom-control custom-radio">
{{ Form::radio('item_status', 'Not Available' , false,array('class'=>'custom-control-input')) }}                    <span class="custom-control-label">Not Available</span>
                  </label></div>
                               
                             </div>
                              
                            </div>




</div>

<button type="submit" class="btn btn-primary"><i class="far fa-edit"></i>  Update</button>

{{Form::close()}}

</div>
</div>


</div>


<div class="group_update_cls" style="display:none">

    {!!Form::open(['url'=>['seller/product-addon-group-update'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}

    <div class="card table-content">
      <div class="card-header" style="background-color:#ccc;">
        <div class="row">
          <div class="col-md-6">
            <h4>Update Addons Group</h4>
        </div>
        <div class="col-md-6">

        </div>

    </div>
</div>

<div class="card-content" style="padding:20px">
   <div class="form-row">

    <div class="form-group col-md-5 ">                        
     <label for="">Group Name:</label>
     {!!Form::text('addon_group_name',null,array('class'=>'form-control','placeholder'=>'Enter Role','autocomplete'=>'off','required','id'=>'addon_group_name_id')) !!} 

 </div>

 <div class="form-group col-md-4 ">                        
     <label for="">Select Group Tyep:</label>
     {!!Form::select('addon_group_type',['Single'=>'Single','Multiple'=>'Multiple'],null,array('class'=>'form-control select2','placeholder'=>'Group Tyep','data-toggle'=>'select2','autocomplete'=>'off','required','id'=>'addon_group_type_id')) !!}

 </div>

 <input type="hidden" name="id" id="addon_group_update_id">


 <div class="form-group col-md-3 " style="margin-top:30px">                        

   <button type="submit" class="btn full btn-primary">Update</button>

   <button type="button" class="btn full show_add_group_form" style="background-color: #9e9b9b;color: #fff" >Go Back</button>
</div>

</div>

</div>
</div>

{{Form::close()}}
</div>



</div>


<!-- ........................... -->



<!-- ............ -->
@if(empty($record_edit))

<div class="custom-control custom-checkbox">
<input type="checkbox" class="custom-control-input checkbox_cls"  name="product_item_status" value="Yes"  id="checkbox_id" >
<label class="custom-control-label" for="checkbox_id">This product has options, like size or color</label>
</div>
@else
<div class="custom-control custom-checkbox">
<input type="checkbox" class="custom-control-input"  name="product_item_status" value="Yes"  id="checkbox_id"  data-toggle="modal" data-target="#exampleCheckboxModalCenter">
<label class="custom-control-label" for="checkbox_id">This product has options, like size or color</label>
</div>
@endif

</div>
</div>
@endif




</div>



<div class="modal fade" id="exampleCheckboxModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleCheckboxModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">

    <div class="modal-content">
     {!!Form::open(['url'=>['seller/product-items'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id','onsubmit'=>'myAttrButton.disabled = true; return true;'])!!}


     
     <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Alert Message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">


<h6>If You Want to add Variant then first we need to delete this item</h6>

<h4 class="text-danger">Are you sure you want to delete this product item</h4>

</div>
<div class="modal-footer">


    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

@if(!empty($record_edit))
    <a href="{{url('seller/product_items/'.$record_edit->id.'/delete')}}"><input type="button" name="myAttrButton"  class="btn btn-danger" value="Delete"></a>
@endif
</div>
{{Form::close()}}

</div>
</div>
</div>

@if(count($attributs)==0)
  <div class="attribute_tab" style="display: none;" >
    @else
      <div class="attribute_tab" >

@endif
<div class="card ">
    <div class="card-body">
    @if(count($attributs) < 3)

    <div class="clearfix" style="margin-bottom:10px">
                <h1 class="h3 mb-3">Attribute    &nbsp;&nbsp;({{count($attributs)}})</h1>

     <div class="form-inline float-right mt--1 d-none d-md-flex">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
            Create New Attributes
        </button>
    </div>
</div>
@endif




<table class="table table-striped table-hover table-sm table-bordered" >
    <thead>
        <tr>
            <th width="10%">Sr.</th>
            <th width="20%">Attribute</th>
            <th width="50%">Values</th> <th width="15%">Action</th>                         
        </tr>
    </thead>
    <tbody>


        @if(!empty($attributs))
        @foreach($attributs as $index => $data)
        
        <tr class="deleteRow">
            <td>{{$index+1}}</td>   
            <td>{{$data->attribute_name}}</td>
            <td>
                @foreach(explode(',', $data->attribute_value) as $key=>$value) 
                <span class="badge badge-dark">{{$value}}</span>
                @endforeach
            </td>
            <td>                                                    
                <button type="button" class="btn btn-info modaleditclick" data-toggle="modal" data-target="#editexampleModalCenter" class="btn btn-info" data-toggle="tooltip" attribute_value="{{$data->attribute_value}}" attribute_name="{{$data->attribute_name}}" id="{{$data->id}}"  data-placement="top" title="Edit"><i class="fas fa-edit"></i></button>

                {{--  <button class="btn btn-danger click_disbled1"  data-toggle="tooltip" data-placement="top" title="Delete"  data="{{$data->id}}"><i class="fas fa-trash-alt"></i></button>   --}}        
                
                
            </td>
        </tr>
        @endforeach
        @endif
        
    </tbody>
</table>
<!-- Modal -->
<div class="modal fade" id="editexampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">

    <div class="modal-content">
     {!!Form::open(['url'=>['seller/product-items-update'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_ids','onsubmit'=>'myAttrEditButton.disabled = true; return true;'])!!}

     <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Update Options</h5>


        <button type="button" class="btn btn-danger click_disbled1"  data-toggle="tooltip" data-placement="top" title="Delete"  data="1"><i class="fas fa-trash-alt"></i></button>  
    </div>
    <div class="modal-body">
       <input type="hidden" name="id" class="appendid">

       <div class="form-row">
         <div class="form-group col-md-8">
             {!!Form::select('attribute_name',$dynamics,null,array('class'=>'form-control ','required','id'=>'attribute_name_id')) !!}

         </div>
     </div>
     <div class="form-row">

        <div class="form-group col-md-8">

         <div id="newEditRow">

         </div>

         <div id="editInputFormRow">
            <div class="input-group mb-3">

                {!!Form::text('attribute_value[]',null,array('class'=>'form-control onchangekey','placeholder'=>'Enter Value','autocomplete'=>'off')) !!} 


                <div class="input-group-append">                
                    <button id="editRemoveRow" type="button" class="btn btn-danger">Remove</button>
                </div>
            </div>


        </div>

        <div id="editNewRow">

        </div>
        <button id="editAddRow" type="button" class="btn btn-info">Add Row</button>
    </div>
</div>





</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" name="myAttrEditButton"  class="btn btn-primary" value="Save">

</div>
{{Form::close()}}

</div>
</div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">

    <div class="modal-content">
     {!!Form::open(['url'=>['seller/product-items'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id','onsubmit'=>'myAttrButton.disabled = true; return true;'])!!}


     
     <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Options</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">


   <div class="form-row">
     <div class="form-group col-md-8">
         {!!Form::select('attribute_name',$dynamics,null,array('class'=>'form-control select2 ','placeholder'=>'Select Option','data-toggle'=>'select2','required')) !!}

     </div>
 </div>
 <div class="form-row">

    <div class="form-group col-md-8" >
        <div id="inputFormRow">
            <div class="input-group mb-3">

                {!!Form::text('attribute_value[]',null,array('class'=>'form-control onchangekey','placeholder'=>'Enter Value','autocomplete'=>'off','required')) !!} 


                <div class="input-group-append">                
                    <button id="removeRow" type="button" class="btn btn-danger">Remove</button>
                </div>
            </div>

            
        </div>

        <div id="newRow">

        </div>
        <button id="addRow" type="button" class="btn btn-info">Add Row</button>
    </div>
</div>





</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

    <input type="submit" name="myAttrButton"  class="btn btn-primary" value="Save">

</div>
{{Form::close()}}

</div>
</div>
</div>

</div>
</div>


{{-- ........................................................................................... --}}

<div class="card">
    <div class="card-body">

        <div class="clearfix" style="margin-bottom:10px">
         <div class="form-inline float-right mt--1 d-none d-md-flex">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#createVarientAlert">
                Add Varient
            </button>
        </div>

        <h1 class="h3 mb-3">Variants &nbsp;&nbsp;@if(!empty($records))({{$records->total()}})@endif</h1>


        <div class="modal fade" id="createVarientAlert" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">

            <div class="modal-content">
             {!!Form::open(['url'=>['seller/create_product_items'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_ids','onsubmit'=>'myButton.disabled = true; return true;'])!!}




             <div class="modal-header">
                {{-- <h5 class="modal-title" id="exampleModalLongTitle"></h5> --}}
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
           <input type="hidden" name="id" class="appendid">

           <h4>Are You Sure You want to Create/Update Variant of this Options</h4>
       </div>
       <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>

        <input type="submit" name="myButton"  class="btn btn-primary" value="Yes">

    </div>
    {{Form::close()}}

</div>
</div>
</div>

</div>



        @if(count($records)>0)

<table class="table table-striped table-hover table-sm table-bordered" >
    <thead>
        <tr>
            <th width="5%">Sr.</th>
            <th width="13%">Image</th>
            <th width="13%">Variant</th>
            <th width="13%">Price</th>
            <th width="13%">SKU</th>                   
            <th width="13%">Status</th>
            <th width="13%">Action</th>                         
        </tr>
    </thead>
    <tbody>


        @foreach($records as $index => $data)

        <tr class="deleteRow">
            <td>{{$index+1}}</td> 
            <td>
                @if(!empty($data->item_img1))
                <img  width="80px" height="50px" src="{{asset('public/images/product_items/'.$data->item_img1)}}" >
                @else
                <img  width="80px" height="50px" src="{{ asset('public/img/no-image.png')}}" >
                @endif
            </td>  

            <td>{{$data->item_attr_varient}}</td>

            <td>@if(round($data->item_price,2))
                $ {{round($data->item_price,2)}}@endif </td>

                <td>{{$data->item_sku}}</td>



                <td>

                   @if($data->item_status ==  'Available')

                   <input type="checkbox" checked data-toggle="toggle" data-on="Available" data-off="Not Available" data-onstyle="success" data-offstyle="danger" id="{{$data->id}}" class="checkstatus" onchange="updateToggle({{$data->id}})">
                   @elseif($data->item_status ==  'Not Available')
                   <input type="checkbox" data-toggle="toggle" data-on="Available" data-off="Not Available" data-onstyle="success" data-offstyle="danger" id="{{$data->id}}" class="checkstatus" onchange="updateToggle({{$data->id}})">
                   @endif

               </td>
               <td>                                                    
                <a href="{{ URL::to('seller/product-items/'.$data->id.'/edit') }}"><button class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></button></a>

                {{--      <button class="btn btn-danger click_disbled1"  data-toggle="tooltip" data-placement="top" title="Delete"  data="{{$data->id}}"><i class="fas fa-trash-alt"></i></button> --}}                                 
            </td>
        </tr>
        @endforeach

    </tbody>
</table>
<div class="card-body">
    @if(!empty($records))
    {!! $records->appends(request()->query())->render() !!}
    @endif
</div>
        @endif


</div>
</div>

</div>

</main> 

@endsection

<!-- ................push new js link................. -->

@push('js')
<script src="{{asset('public/js/comman.js')}}"></script>
<script type="text/javascript" src="{{ asset('public/js/bootstrap-fileupload.min.js') }}"></script>
<script src="{{asset('public/js/validation.js')}}"></script>

<script src="{{asset('public/basic-ckeditor/ckeditor.js')}}"></script>
<script>
    CKEDITOR.replace( 'item_description');
</script>

<script type="text/javascript">
   $(".click_disbled1").click(function(){


     var data=$(this).attr('data');
   // alert(base_url+'delete')

   var clickDisbled = $(this);
   var location=window.location.origin;

   var pathname= window.location.pathname;

   var base_url=location+pathname+'/';


   var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
   swal({
      title: 'Are you sure?',
      text: "You want to delete this record! ",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
  },
  function() {
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

      $.ajax({
         type:"POST",

         url:base_url+'delete',
         data:{_token: CSRF_TOKEN, id:data},
         dataType:'JSON',


         complete: function(){
             window.location.reload();

                     // clickDisbled.parents('.deleteRow').fadeOut(1500);

                     swal(
                      'Deleted!',
                      'Your record has been deleted.',
                      'success'
                      );

                 }


             });
  });
});
</script>

<script type="text/javascript">
    // add row
    $('.modaleditclick').on('click', function(e) {

        var attribute_value=$(this).attr('attribute_value');
        var attribute_name=$(this).attr('attribute_name');
        var id=$(this).attr('id');

// alert(attribute_name)
// alert(id)
$(".appendid").val(id)
$(".click_disbled1").attr("data",id)

$('#attribute_name_id').empty();

$('#attribute_name_id').append('<option value="'+ attribute_name +'">'+attribute_name+'</option>');
$("#attribute_name_id").val(attribute_name).trigger('change');


const arr=attribute_value.split(',');

$('#newEditRow').empty();

$.each(arr, function(key, value) { 

   var html = '';
   html += '<div id="inputFormRow">';
   html += '<div class="input-group mb-3">';
   html += '<input type="text" name="attribute_value[]" value="'+value+'" class="form-control onchangekey" placeholder="Enter Value" autocomplete="off" readonly="readonly" >';
   html += '<div class="input-group-append">';
   html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
   html += '</div>';
   html += '</div>';


   console.log(value)


   $('#newEditRow').append(html);


})
})

    var maxLimit  = 11;
    var x = 1;

    $("#addRow").click(function () {

      if(x < maxLimit){ 
        var html = '';
        html += '<div id="inputFormRow">';
        html += '<div class="input-group mb-3">';
        html += '{!!Form::text('attribute_value[]',null,array('class'=>'form-control onchangekey','placeholder'=>'Enter Value','autocomplete'=>'off','required')) !!}';
        html += '<div class="input-group-append">';
        html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
        html += '</div>';
        html += '</div>';

        $('#newRow').append(html);

        x++;

    }
});

    // remove row
    $(document).on('click', '#removeRow', function () {
        $(this).closest('#inputFormRow').remove();
        x--;
    });



    var maxLimit  = 11;
    var yy = 1;

    $("#editAddRow").click(function () {

                // $('#editNewRow').empty();
                if(yy < maxLimit){ 

                    var html = '';
                    html += '<div id="inputFormRow">';
                    html += '<div class="input-group mb-3">';
                    html += '{!!Form::text('attribute_value[]',null,array('class'=>'form-control onchangekey','placeholder'=>'Enter Value','autocomplete'=>'off','required')) !!}';
                    html += '<div class="input-group-append">';
                    html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
                    html += '</div>';
                    html += '</div>';

                    $('#editNewRow').append(html);

                    yy++;

                }
            });

    // remove row
    $(document).on('click', '#editRemoveRow', function () {
        $(this).closest('editInputFormRow').remove();

        yy--;

    });


    $(document).ready(function() {
      // add multiple select / deselect functionality
      $("#selectall").click(function() {
        $('.case').attr('checked', this.checked);
    });
     // if all checkbox are selected, check the selectall checkbox  also        

     $(".case").click(function() {
        if ($(".case").length == $(".case:checked").length) {
            $("#selectall").attr("checked", "checked");
        }
        else {
            $("#selectall").removeAttr("checked");
        }      
    });
 });


    $(".click_disbled1").click(function(){


     var data=$(this).attr('data');
   // alert(base_url+'delete')

   var clickDisbled = $(this);
   var location=window.location.origin;

   var pathname= window.location.pathname;

   var base_url=location+pathname+'/';


   var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
   swal({
      title: 'Are you sure?',
      text: "You want to delete this record! ",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
  },
  function() {
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

      $.ajax({
         type:"POST",

         url:base_url+'delete',
         data:{_token: CSRF_TOKEN, id:data},
         dataType:'JSON',


         complete: function(){
                // window.location.reload();
                window.location.reload();
         // $("#editexampleModalCenter").modal('hide');
                     // clickDisbled.parents('.deleteRow').fadeOut(1500);

                     swal(
                      'Deleted!',
                      'Your record has been deleted.',
                      'success'
                      );



                 }


             });
  });
});


</script>


<script>
    var update_checkbox = function () {
        
        if ($(".checkbox_cls").is(":checked")) {
            
$(".attribute_tab").show();
// $("#myTabContent").hide();
}
else {

   $(".attribute_tab").hide();
// $("#myTabContent").show();

}
};



// $(update_checkbox);
$(".checkbox_cls").change(update_checkbox);
</script>

@endpush