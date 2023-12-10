@extends('seller.layouts.app')
@section('title',"All product-items | seller Mande Clan")

<!-- ................custom css................. -->

@section('customStyle')
@endsection

<!-- ................Add css link................. -->

@push('style')
@endpush

<!-- ................body................. -->
@section('innercontent')

<style>
    .content{
        display:block;
        width:100%;
        height:180vh;

        -ms-overflow-style: none; /* for Internet Explorer, Edge */
        scrollbar-width: none; /* for Firefox */
        overflow-y: scroll; 
    }
    
    .content::-webkit-scrollbar {
        display: none; /* for Chrome, Safari, and Opera */
    }
</style>


<main class="content">
    <div class="container-fluid p-0">

        <div class="clearfix">





            <h1 class="h3 mb-3">Seller Product Item &nbsp;&nbsp;@if(!empty($records))({{$records->total()}})@endif</h1>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md">

                    </div>
                    <div class="col-md">

                    </div>
                    <div class="col-md">
                        <div class="form-group">
                            {{Form::open(['url'=>['seller/product-items'],'method'=>'GET'])}}

                            <div class="input-group">

                              {!!Form::text('search',Request::input('search'),array('class'=>'form-control','placeholder'=>'Search by role..','onchange'=>'this.form.submit()','autocomplete'=>'off')) !!}
                              
                              <span class="input-group-append">
                                  <button class="btn btn-secondary" type="button">Enter!</button>
                              </span>                         
                          </div>
                          {{Form::close()}}

                      </div>
                  </div>                                          
              </div>
          </div>
          
          <div class="col-md-6 ajax_response" style="display: none;">
            <div class="alert alert-success">
              <b id="success_message" style="padding: 8px"></b>
              
          </div>
      </div>
      

      <table class="table table-striped table-responsive table-hover table-sm table-bordered " >
        <thead>
            <tr>
                <th width="5%">Sr.</th>
                <th width="10%">Item ID</th>
                
                <th width="10%">Store Name</th>
                <th width="10%">Product Name</th>
                <th width="10%">Category</th>
                <th width="10%">SubCategory</th>
                <th width="10%">Item SKU</th>                                                   
                <th width="10%">Main Price</th>
                <th width="10%">Discount</th>                                                   

                <th width="10%">commission Price</th>

                <th width="10%">Selling Price</th>
                <th width="10%">variation</th>
                <th width="10%">Image</th>
                <th width="10%">Status</th> <th width="15%">Action</th>                         
            </tr>
        </thead>
        <tbody>




            @if(!empty($records))
            @foreach($records as $index => $data)
            <tr class="deleteRow">
                <td>{{$index+1}}</td> 
                <td>{{$data->item_unique_id}}</td>
                
                <td>{{$data->store_name}}</td>
                <td>{{$data->product_name}}</td>
                <td>{{$data->product_category}}</td>
                <td>{{$data->product_subcategory}}</td>
                <td>{{$data->item_sku}}</td>
                <td>{{round($data->item_price,2)}} $</td>



                <?php


                $percents=DB::table('commission_settings')->where('commission_store_id',$data->cat_id)->first();

                $percentage1=0;


                if (!empty($percents)) {
                    $percentage1=$percents->commission_rate;
                }

                $record=DB::table('commission_settings')->first();

                $percentage2=$record->commission_rate;

                $percentage=$percentage1+$percentage2;




                if (!empty($data->item_offer_discount)) {
                    $price = round($data->item_price,2) - (round($data->item_price,2) * ($data->item_offer_discount / 100));

                }else{
                    $price=round($data->item_price,2);
                }

                $item_prices=($percentage / 100) * $price; 

                $selling_price=$price+round($item_prices,2);



            ?>
            <td>{{$data->item_offer_discount}} %</td>

            <td>{{ round($item_prices,2) }} $</td>

            <td> {{round($selling_price,2)}} $</td>
            <td><span class="badge badge-dark">{{$data->item_attr_varient}}</span></td>

            <td>
                @if(!empty($data->item_img1))
                <img  width="80px" height="50px" src="{{asset('public/images/product_items/'.$data->item_img1)}}" >
                @else
                <img  width="80px" height="50px" src="{{ asset('public/img/no-image.png')}}" >
                @endif
            </td>  



            <td>

               @if($data->item_status ==  'Available')

               <input type="checkbox" checked data-toggle="toggle" data-on="Available" data-off="Not Available" data-onstyle="success" data-offstyle="danger" id="{{$data->id}}" class="checkstatus" onchange="updateToggle({{$data->id}})">
               @elseif($data->item_status ==  'Not Available')
               <input type="checkbox" data-toggle="toggle" data-on="Available" data-off="Not Available" data-onstyle="success" data-offstyle="danger" id="{{$data->id}}" class="checkstatus" onchange="updateToggle({{$data->id}})">
               @endif

           </td>


           <td>                                                    
            <a href="{{ URL::to('seller/product-items/'.$data->id.'/edit') }}"><button class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></button></a>

            {{-- <button class="btn btn-danger click_disbled"  data-toggle="tooltip" data-placement="top" title="Delete"  data="{{$data->id}}"><i class="fas fa-trash-alt"></i></button>                                  --}}
        </td>
    </tr>
    @endforeach
    @endif

</tbody>
</table>
<div class="card-body">
    @if(!empty($records))
    {!! $records->appends(request()->query())->render() !!}
    @endif
</div>





</div>
</div>

</main> 

@endsection

<!-- ................push new js link................. -->

@push('js')
<script src="{{asset('public/js/comman.js')}}"></script>
@endpush