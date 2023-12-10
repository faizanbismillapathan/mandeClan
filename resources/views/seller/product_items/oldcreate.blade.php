@extends('seller.layouts.app')
@section('title',"Create New Products Items | seller Mande Clan")

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
    width: 700px!important;
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
            <a href="{{url('seller/product-items')}}" class="form-inline float-right mt--1 d-none d-md-flex">
                <button class="btn btn-info"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Back</button>
            </a>

            <h1 class="h3 mb-3"><b>Create Products Items</b></h1>

        </div>
        <div class="card">

            <div class="card-body">

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
<hr>
</div>
        

            <div class="card-body">
             {!!Form::open(['url'=>['seller/product-items'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}

             <div class="row">

  <div class="form-group col-md-4">
                    <label for="inputEmail4">Item Identification id</label>                                                                 {!! Form::text('item_unique_id',$keydata,array('class'=>'form-control','readonly'=>'readonly')) !!}

                </div>

                <div class="form-group col-md-4">
                    <label for="inputEmail4">Item Name</label>                                                                 {!!Form::text('item_name',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','required')) !!} 

                </div>

                  <div class="form-group col-md-4">
                    <label for="inputEmail4">Item Available Quantity</label>                                                                 {!!Form::text('item_quantity',null,array('class'=>'form-control numbersOnly','placeholder'=>'','autocomplete'=>'off')) !!} 

                </div>

              

              

         

            <div class="form-group col-md-4">
                <label for="inputEmail4">Model Number:</label>                                                                 {!!Form::text('item_modal_number',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off')) !!} 

            </div>


            <div class="form-group col-md-4">
                <label for="inputEmail4">HSN/SAC Code:</label>                                                                 {!!Form::text('item_hsn_sac_code',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off')) !!} 

            </div>


            <div class="form-group col-md-4">
                <label for="inputEmail4">SKU :</label>                                                                 {!!Form::text('item_sku',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off')) !!} 

            </div>


        


            <div class="form-group col-md-4">
                <label for="inputEmail4">Price : * (Price you entering is IN USD)</label>
                 {!!Form::text('item_price',null,array('class'=>'form-control numbersOnly numbersOnly','placeholder'=>'','autocomplete'=>'off','required')) !!} 
            </div>


          {{--   <div class="form-group col-md-4">
                <label for="inputEmail4">Offer Price : (Offer Price you entering is IN USD)</label>                                                                 {!!Form::text('item_offer_price',null,array('class'=>'form-control numbersOnly','placeholder'=>'','autocomplete'=>'off','maxlength'=>'4')) !!} 
            </div>

 --}}
            <div class="form-group col-md-4">
                <label for="inputEmail4">Offer Discount (%) :</label>                                                                 {!!Form::text('item_offer_discount',null,array('class'=>'form-control numbersOnly','placeholder'=>'','autocomplete'=>'off','maxlength'=>'2')) !!} 
            </div>

    

            <div class="form-group col-md-12">
                <label for="inputEmail4">Item tags : </label><br>
  
                        {!!Form::text('item_tags',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','data-role'=>'tagsinput','id'=>'item_tag_id')) !!} 
            </div>



            <div class="col-md-3">
              <div class="form-group author-img-bx">

                <label>Item Image :*
</label>             

                <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-new img-thumbnail" style="width: 180px; height: 120px;">
                     <img src="{{ asset('public/img/no-image.png')}}" alt="dd" />
                 </div>
                 <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 180px; max-height: 120px; line-height: 20px;"></div>
                 <div class="row">
                     <div class="col-md-12">
                      <button type="button" class="btn btn-secondary" style="padding: 0px; background-color: #fff;"><span class="btn btn-default btn-file">
                        <span class="btn btn-secondary fileupload-new">Choose image</span>
                        <span  class="btn btn-secondary fileupload-exists">Change</span>

                        {{ Form::file('item_img',null, ['class' => 'form-control','required']) }}</span>

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
                     <img src="{{ asset('public/img/no-image.png')}}" alt="dd" />
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
                     <img src="{{ asset('public/img/no-image.png')}}" alt="dd" />
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
                     <img src="{{ asset('public/img/no-image.png')}}" alt="dd" />
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

    @if(!empty($attributs))

  <div class="form-group col-md-12">

<div class="card">
    <div class="card-header">
        <div class="card-title">
            Attributes
        </div>
    </div>
    <div class="card-body">
        <div class="form-group col-md-12">
    @foreach($attributs as $index=>$data)

<input type="hidden" name="unit_id" value="{{$data['unit_id']}}">
<input type="hidden" name="attr_id" value="{{$data['attr_id']}}">
<input type="hidden" name="unit_name" value="{{$data['unit_name']}}">

<label for="inputEmail4"><b>{{$data['unit_name']}} :</b></label>
<div class="row">
@foreach($data['attribut_value'] as $index1=>$data1)
<div class="col-md-2 padding0"><div class="checkbox"><label><input type="checkbox" values="{{$data1->unit_value}}" ids="{{$data1->id}}" name="attr_value_id[{{$data1->unit_value}}]" value="{{$data1->id}}" > {{$data1->unit_value}}</label></div></div>
@endforeach
</div>

@endforeach

</div>
    </div>
    
</div>
</div>
@endif


  <div class="form-group col-md-12">
                  <label for="inputEmail4">Key Features :</label>
                  {!!Form::textarea('item_features',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','maxlength'=>'1000')) !!} 
              </div>   

              <div class="form-group col-md-12">
                  <label for="inputEmail4">Description :</label>
                  {!!Form::textarea('item_description',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','maxlength'=>'1000')) !!} 
              </div>   

</div>

<button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i>   Submit</button>



<!-- <a class="btn" href="{{url('seller/product-items')}}" style="background-color: #9e9b9b;color: #fff"><i class="fas fa-times"></i>  Cancel</a> -->

{{Form::close()}}
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
        CKEDITOR.replace( 'item_features');
    </script>

    <script>
        CKEDITOR.replace( 'item_description');
    </script>

    <script src="{{ asset('public/js/bootstrap-tagsinput.min.js') }}"></script>

<script type="text/javascript">
    $('#item_tag_id').tagsinput({
  maxTags: 5
});
   
</script>


 
@endpush