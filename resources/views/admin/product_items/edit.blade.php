@extends('admin.layouts.app')
@section('title',"Edit Products | seller Mande Clan")

<!-- ................custom css................. -->

@section('customStyle')

<style>
 .label-info{
    background-color: #424242;
    padding: 0.4em 0.8em;
    font-size: 85%;
    font-weight: 700;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: 0.25em

}
.bootstrap-tagsinput input{
    width: 300px!important;
}
.nav-link{
        padding: 0.5rem 0.1rem;
}

.card-body {

    padding: 1rem;
    }

    .nav-pills .nav-link{
            color: #000;
    }
</style>
@endsection

<!-- ................Add css link................. -->

@push('style')
<link rel="stylesheet" href="{{asset('public/css/bootstrap-fileupload.css')}}">
<link href="{{ asset('public/css/bootstrap-tagsinput.css') }}" rel="stylesheet" />

@endpush


<!-- ................body................. -->
@section('innercontent')


<main class="content">
    <div class="container-fluid p-0">
        <div class="clearfix">
            <a href="{{url('admin/products/'.$record->product_id.'/items')}}" class="form-inline float-right mt--1 d-none d-md-flex">
                <button class="btn btn-info"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Back</button>
            </a>
            <h1 class="h3 mb-3"><b>Update Products</b></h1>

        </div>

         <div class="card">
           <div class="card-body">

                    <div class="form-row">

 <div class="form-group col-md-3">
 @if(!empty($record->product_cover_photo))
             <img src="{{ asset('public/images/product_cover_photo/'.$record->product_cover_photo)}}" height="70px" alt="dd" />
             @else
  <img src="{{ asset('public/img/no-image.png')}}" height="70px" alt="dd" />
             @endif

         </div>
  {{-- <div class="form-group col-md-1">
<p>2 variants</p>
</div>
 --}}
 <div class="form-group col-md-3">
  <div class="row">
    <div class="col-md-10"><b>Product Name</b></div>
{{--     <div class="col-md-1"><b>:</b></div> --}}
    <div class="col-md-12">{{$record->product_name}}</div>
  </div>         
</div>

<div class="form-group col-md-3">
  <div class="row">
    <div class="col-md-10"><b>Category</b></div>
{{--     <div class="col-md-1"><b>:</b></div> --}}
    <div class="col-md-12">{{$record->product_category}}</div>
  </div>         
</div>
<div class="form-group col-md-3">
  <div class="row">
    <div class="col-md-10"><b>SubCategory</b></div>
{{--     <div class="col-md-1"><b>:</b></div> --}}
    <div class="col-md-12">{{$record->product_subcategory}}</div>
  </div>         
</div>
 
</div>

</div>
        </div>

        <div class="card">

            <div class="card-body">
 <div class="row">
             <div class="col-md-3 mb-3">
                <div class="card">
                  <div class="card-body">
                    <ul class="nav nav-pills flex-column" id="myTab" role="tablist">
                      <!-- ......... -->

@foreach($records as $index=>$data)
                      <li class="nav-item">

                        <a  href="{{ URL::to('admin/seller-product-items/'.$data->id.'/edit') }}" class="nav-link  {{$data->id ==\Request::segment(3)  ? 'active' : ''}}"> &nbsp;&nbsp;
                         <i class="fa fa-circle " ></i>&nbsp;&nbsp;&nbsp;   {{$data->item_attr_varient}} </a>
                    </li>

@endforeach

                 

                </ul>
            </div>
        </div>
        
    </div>

    {{-- '''''''''''''''''''''''' --}}

    <div class="col-md-9">

        <div class="card">
          <div class="card-body">
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="id_tab_addon_groups" role="tabpanel" aria-labelledby="tab_addon_groups">
                  <div class="group_create_cls" >

                   @if(!empty($record))
                   {!! Form::model($record,array('url' => ['admin/seller-product-items', $record->id],'method'=>'PATCH','class'=>'','id' =>'comman_form_id','files'=>'true')) !!}
                   
                   @endif

                   <div class="card table-content">
                      <div class="card-header" style="background-color:#ccc;">
                        <div class="row">
                          <div class="col-md-6">
                            <h4> {{$record->item_attr_varient}}</h4>
                        </div>
                        <div class="col-md-6">

                        </div>

                    </div>
                </div>

                <div class="card-content" style="padding:20px">
                   
                 <div class="row">

                  <div class="form-group col-md-4">
                    <label for="inputEmail4">Item Identification id</label>                                                                 {!! Form::text('item_unique_id',null,array('class'=>'form-control','readonly'=>'readonly')) !!}

                </div>

                

             {{--    <div class="form-group col-md-4">
                    <label for="inputEmail4">Item Stock Quantity</label>                                                                 {!!Form::text('item_quantity',null,array('class'=>'form-control numbersOnly','placeholder'=>'','autocomplete'=>'off')) !!} 

                </div> --}}

                

                

                

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
                    @if(!empty($record->item_img1))
                    <img src="{{ asset('public/images/product_items/'.$record->item_img1)}}" alt="dd" />
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
               @if(!empty($record->item_img2))
               <img src="{{ asset('public/images/product_items/'.$record->item_img2)}}" alt="dd" />
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
           @if(!empty($record->item_img3))
           <img src="{{ asset('public/images/product_items/'.$record->item_img3)}}" alt="dd" />
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
           @if(!empty($record->item_img4))
           <img src="{{ asset('public/images/product_items/'.$record->item_img4)}}" alt="dd" />
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





</div>

<button type="submit" class="btn btn-primary"><i class="far fa-edit"></i>  Update</button>

{{Form::close()}}

</div>
</div>

{{Form::close()}}

</div>

<div class="group_update_cls" style="display:none">

    {!!Form::open(['url'=>['admin/product-addon-group-update'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}

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
</div>
</div>
</div>

<!-- .......end......... -->
</div>
</div>
</div>
</div>
</div>
</main>
@endsection

<!-- ................push new js link................. -->

@push('js')

<script src="{{asset('public/js/validation.js')}}"></script>
<script type="text/javascript" src="{{ asset('public/js/bootstrap-fileupload.min.js') }}"></script>
<script src="{{asset('public/basic-ckeditor/ckeditor.js')}}"></script>
<script>
    CKEDITOR.replace( 'item_description');
</script>

<script src="{{ asset('public/js/bootstrap-tagsinput.min.js') }}"></script>


@endpush