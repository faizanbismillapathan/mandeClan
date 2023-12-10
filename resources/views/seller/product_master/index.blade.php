@extends('seller.layouts.app')
@section('title',"All Products | seller Mande Clan")

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




                           {{--   <a href="{{url('seller/products/create')}}" class="form-inline float-right mt--1 d-none d-md-flex">
                                       <button class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create a New Products</button>
                                    </a> --}}

                            <h1 class="h3 mb-3">Products &nbsp;&nbsp;@if(!empty($records))({{$records->total()}})@endif</h1>
                        </div>

                        <div class="card">
                                <div class="card-body">
                                        <div class="row">
                                            <div class="col-md">
                                            {{Form::open(['url'=>['seller/products'],'method'=>'GET'])}}
                                            
@if(!empty($products_names))
                                                {!!Form::select('search',$products_names,null,array('class'=>'form-control select2','placeholder'=>'Search','data-toggle'=>'select2','onchange'=>'this.form.submit()')) !!}
@endif

                                            
                                            {{Form::close()}}
                                            </div>
                                            <div class="col-md">
                                                
                                            </div>
                                            <div class="col-md">
                                                <div class="form-group">
                                                    {{Form::open(['url'=>['seller/products'],'method'=>'GET'])}}

                                                    <div class="input-group">

      {!!Form::text('search',Request::input('search'),array('class'=>'form-control','placeholder'=>'Search by Products name','onchange'=>'this.form.submit()','autocomplete'=>'off')) !!}
               
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



                                    <table class="table table-striped table-hover table-sm table-bordered table-responsive" >
                                        <thead>
                                            <tr>
                            <th width="5%">Sr.</th>
                            <th width="15%">Name</th>
                            <th width="10%">Cover Photo</th>
                            <th width="10%">Store Category</th>
                            <th width="10%">Product Category</th>
                            <th width="10%">Sub Category</th>
                            {{-- <th width="10%">Add items</th> --}}
                            {{-- <th width="10%">Assign Addon</th>    --}}

                            <th width="10%">Brand</th>  
                               
                            <th width="10%">Choose Product</th>
                            {{-- <th width="10%">Action</th>  --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                            
                                            @if(!empty($records))
                                            @foreach($records as $index => $data)
                                            <tr class="deleteRow">
                                                <td>{{$index+1}}</td>   
                                                 <td>{{$data->product_name}}</td>
                                                  <td> @if(!empty($data->product_cover_photo))
             <img src="{{ asset('public/images/product_cover_photo/'.$data->product_cover_photo)}}" alt="dd" width="50px" />
             @else
  <img src="{{ asset('public/img/no-image.png')}}" alt="dd" width="50px"/>
             @endif</td>
                                        <td>{{$data->category_name}}</td>

                                                <td>{{$data->product_category}}</td>
                                                <td>{{$data->product_subcategory}}</td>
                                                  {{-- <td><a href="{{url('seller/products/'.$data->id.'/items')}}"><button class="btn-info">Add Items</button></a></td>
                                                    <td><a href="{{url('seller/products/'.$data->id.'/addon')}}"><button class="btn-secondary">AddOn</button></a></td> --}}
                                              
                                               
                                                <td>{{$data->brand_name}}</td>
                                                <td>
                                    
              <input type="checkbox"  id="{{$data->id}}" class="checkbox_choose_product" >


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

 <script type="text/javascript">
     
 $(".checkbox_choose_product").click(function(){

    // alert('aa')

 var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

var id=$(this).attr('id');
   var clickDisbled = $(this);

swal({
  title: 'Are you sure?',
  text: "You want to Add this Product From Product List! ",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, Add it!'
},

 function() {
                  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});

       $.ajax({
           type:"post",
          url: "{{url('seller/master_product_store')}}",
           data:{_token: CSRF_TOKEN, id:id},
           dataType:'JSON',
           dataType: 'json',
           success:function(res){ 


 clickDisbled.parents('.deleteRow').fadeOut(1500);


  var data= "Successfully add the product in your product list";       


                  var message = data;
                  var title = $('#toastr-title').val() || '';
                   var type = 'success';
         
                  toastr[type](message, title, {
                    positionClass: $('input[name="toastr-position"]:checked').val(),
                    closeButton: 'true',
                    progressBar:'true',
                    newestOnTop: 'true',
                    rtl: $('body').attr('dir') === 'rtl' || $('html').attr('dir') === 'rtl',
                    timeOut: $('#toastr-duration').val()
                  });
               
         },
          error:function(error){ 

console.log(error)
          }

       });
           });
    });
 </script>
@endpush