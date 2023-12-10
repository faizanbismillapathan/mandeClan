@extends('admin.layouts.app')
@section('title',"Edit Shipping | Admin Mande Clan")

<!-- ................custom css................. -->

@section('customStyle')
@endsection

<!-- ................Add css link................. -->

@push('style')
@endpush

<!-- ................body................. -->
@section('innercontent')

  
<main class="content">
                    <div class="container-fluid p-0">
<div class="clearfix">
    <a href="{{url('admin/shipping')}}" class="form-inline float-right mt--1 d-none d-md-flex">
    <button class="btn btn-info"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Back</button>
    </a>
        <h1 class="h3 mb-3"><b>Update Shipping</b></h1>

                    </div>
                                <div class="card">
                                
<div class="card-body">
     @if(!empty($record))
       {!! Form::model($record,array('url' => ['admin/shipping', $record->id],'method'=>'PATCH','class'=>'','id' =>'comman_form_id','files'=>'true')) !!}
      
       @endif

       @if($id==5)

                                            <div class="form-row">
                            <div class="form-group col-md-3">
                                <label>Weight From:</label>
                                <input type="text" name="weight_from_0" placeholder="0" class="form-control" value="0">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Weight To:</label>
                                <input type="text" name="weight_to_0" placeholder="20" class="form-control" value="10">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Weight Price:</label>
                                <input type="text" name="weight_price_0" placeholder="10" class="form-control" value="10">
                            </div>
        
                            <div class="form-group col-md-3">
                                <label>Per Order/Quantity:</label>
                                <select class="form-control" name="per_oq_0" id="">
                                    <option selected="" value="po">Per Order</option>
                                    <option value="pq">Per Quantity</option>
                                </select>
                            </div>
                        </div>
        
                        <div class="last_btn row">
                            <div class="form-group col-md-3">
                                <label>Weight From:</label>
                                <input type="text" name="weight_from_1" placeholder="21" class="form-control" value="21">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Weight To:</label>
                                <input type="text" name="weight_to_1" placeholder="40" class="form-control" value="40">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Weight Price:</label>
                                <input type="text" name="weight_price_1" placeholder="20" class="form-control" value="50">
                            </div>
        
                            <div class="form-group col-md-3">
                                <label>Per Order/Quantity:</label>
                                <select class="form-control" name="per_oq_1" id="">
                                    <option selected="" value="po">Per Order</option>
                                    <option value="pq">Per Quantity</option>
                                </select>
                            </div>
                        </div>
        
                        <div class="last_btn row">
                            <div class="form-group col-md-3">
                                <label>Weight From:</label>
                                <input type="text" name="weight_from_2" placeholder="41" class="form-control" value="41">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Weight To:</label>
                                <input type="text" name="weight_to_2" placeholder="60" class="form-control" value="60">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Weight Price:</label>
                                <input type="text" name="weight_price_2" placeholder="30" class="form-control" value="30">
                            </div>
        
                            <div class="form-group col-md-3">
                                <label>Per Order/Quantity:</label>
                                <select class="form-control" name="per_oq_2" id="">
                                    <option selected="" value="po">Per Order</option>
                                    <option value="pq">Per Quantity</option>
                                </select>
                            </div>
                        </div>
        
                        <div class="last_btn row">
                            <div class="form-group col-md-3">
                                <label>Weight From:</label>
                                <input type="text" name="weight_from_3" placeholder="61" class="form-control" value="61">
                            </div>
        
                            <div class="form-group col-md-3">
                                <label>Weight To:</label>
                                <input type="text" name="weight_to_3" placeholder="80" class="form-control" value="80">
                            </div>
        
                            <div class="form-group col-md-3">
                                <label>Weight Price:</label>
                                <input type="text" name="weight_price_3" placeholder="40" class="form-control" value="40">
                            </div>
        
                            <div class="form-group col-md-3">
                                <label>Per Order/Quantity:</label>
                                <select class="form-control" name="per_oq_3" id="">
                                    <option value="po">Per Order</option>
                                    <option selected="" value="pq">Per Quantity</option>
                                </select>
                            </div>
                        </div>
        
                        <div class="last_btn row">
                            <div class="form-group col-md-3">
                                <label>Limit From Than:</label>
                                <input type="text" name="weight_from_4" placeholder="61" class="form-control" value="81">
                            </div>
                            <div class="form-group col-md-3">
                                
                            </div>
                            <div class="form-group col-md-3">
                                <label>Weight Price:</label>
                                <input type="text" name="weight_price_4" placeholder="40" class="form-control" value="40">
                            </div>
        
                            <div class="form-group col-md-3">
                                <label>Per Order/Quantity:</label>
                                <select class="form-control" name="per_oq_4" id="">
                                    <option value="po">Per Order</option>
                                    <option selected="" value="pq">Per Quantity</option>
                                </select>
                            </div>
                        </div>
        
                     
                
       @else
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail4">Shipping Title</label>                                                   
                                                    {!!Form::text('shipping_name',null,array('class'=>'form-control','placeholder'=>'Enter UPS Shipping','autocomplete'=>'off','required')) !!} 
                                                </div>
                                          </div>

                                           <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail4">Shipping Price </label>                                                   
                                                    {!!Form::text('shipping_name',null,array('class'=>'form-control','placeholder'=>'Enter UPS Shipping','autocomplete'=>'off','required')) !!} 
                                                </div>
                                          </div>
                                          @endif

        <button type="submit" class="btn btn-primary"><i class="far fa-edit"></i>  Update</button>


                                         
<a class="btn" href="{{url('admin/shipping')}}" style="background-color: #9e9b9b;color: #fff"><i class="fas fa-times"></i>  Cancel</a>
                                            
  {{Form::close()}}
</div>
</div>
</div>
</main>
@endsection

<!-- ................push new js link................. -->

@push('js')
 <script src="{{asset('public/js/validation.js')}}"></script>

@endpush