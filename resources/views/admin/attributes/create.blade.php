@extends('admin.layouts.app')
@section('title',"Create New Attribute | Admin Mande Clan")

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
            <a href="{{url('admin/product-attribute')}}" class="form-inline float-right mt--1 d-none d-md-flex">
                <button class="btn btn-info"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Back</button>
            </a>

            <h1 class="h3 mb-3"><b>Create Attribute</b></h1>

        </div>
        <div class="card">

            <div class="card-body">

               {!!Form::open(['url'=>['admin/product-attribute'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}

               <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputEmail4">Select Unit Type</label>
                    @if(!empty($units))
                    {!!Form::select('unit_id',$units,null,array('class'=>'form-control select2','placeholder'=>'Select Unit','data-toggle'=>'select2','autocomplete'=>'off','required')) !!}                                                   
                    @endif
                </div>

            </div>
           <!--  <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputEmail4">Enter Attribute Name</label>                                                   
                    {!!Form::text('attr_name',null,array('class'=>'form-control onlyAlphabet','placeholder'=>'Enter product-attribute','autocomplete'=>'off','required')) !!} 
                </div>
            </div> -->


      

                  <div class="form-row">
                    <div class="form-group col-md-12">
                              <div class="card">

                     <div class="card-header" style="border-bottom:1px solid #ccc">
                       <div class="row margin0" >
                        <div class="col-md-6">

                            <label for="inputEmail4">Choose Category:</label>
                        </div>
                            <div class="col-md-6">
                                <label class="pull-right">
                                    <input type="checkbox" class="selectallbox"> Select All
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="card-content" style="padding:20px">
                        <div class="row margin0">


                         @if(!empty($categories))
                         @foreach($categories as $index=>$data)  
                         <div class="col-md-2 padding0">
                           <div class="checkbox">
                              <label>
                                @if(!empty($array_checkbox))
                                {{ Form::checkbox('category_id[]',$data->id,in_array($data->product_category, $array_checkbox) ? true : false, array('id'=>'category_id1')) }} {{ $data->product_category }}
                                @else
                                {{ Form::checkbox('category_id[]',$data->id,null,['id'=>'ssss']) }} {{ $data->product_category }}

                                @endif
                            </label>
                        </div>
                    </div>
                    @endforeach
                    @endif


                </div>                                
            </div>
        </div>

    </div>
</div>
<button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i>   Submit</button>



<a class="btn" href="{{url('admin/product-attribute')}}" style="background-color: #9e9b9b;color: #fff"><i class="fas fa-times"></i>  Cancel</a>

 {{Form::close()}}
</div>
</div>
</div>
</main>
@endsection

<!-- ................push new js link................. -->

@push('js')

<script src="{{asset('public/js/validation.js')}}"></script>

<script>
        $('.selectallbox').on('click',function(){
            if($(this).is(':checked')){
                $('input:checkbox').prop('checked', this.checked);
            }else{
                $('input:checkbox').prop('checked', false);
            }
        });
    </script>

@endpush