@extends('seller.layouts.app')
@section('title',"All Category List| seller Mande Clan")

<!-- ................custom css................. -->

@section('customStyle')
<style type="text/css">
    input[type="checkbox"][readonly] {
  pointer-events: none;
}
</style>
@endsection

<!-- ................Add css link................. -->

@push('style')
@endpush

<!-- ................body................. -->
@section('innercontent')

<main class="content">
    <div class="container-fluid p-0">

        <div class="clearfix">



<!-- 
         <a href="{{url('seller/categories/create')}}" class="form-inline float-right mt--1 d-none d-md-flex">
           <button class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create a New Category</button>
       </a>
 -->
       <h1 class="h3 mb-3">Store Category </h1>
   </div>

   <div class="card">
    <div class="card-header">
        <h4 class="card-title">
            {{  $stores->store_name }} 
        </h4>
    </div>
    <div class="card-body masterCls">
     {!!Form::open(['url'=>['seller/categories'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}

     <div class="card-content" style="padding:20px 0px">
        <div class="row margin0" id="move-selected">


           @if(count($shop_categories) > 0)
           @foreach($shop_categories as $index=>$data)  


@if($data->permission=='Yes')


           <div class="col-md-2 padding0"><div class="checkbox" ><label ><input type="checkbox" values="{{$data->product_category}}" ids="{{$data->id}}" name="category_id[]" value="{{$data->id}}"  data-toggle="modal" data-target="#notPermissionForRemove" class="checkstatus_not_allow" checked > {{$data->product_category}}</label></div></div>

{{-- @elseif(!empty($data->store_id))


           <div class="col-md-2 padding0"><div class="checkbox" ><label ><input type="checkbox" values="{{$data->product_category}}" ids="{{$data->id}}" name="category_id[]" value="{{$data->id}}"  data-toggle="modal" data-target="#notPermissionForRemove" class="checkstatus_not_allow" checked > {{$data->product_category}}</label></div></div>


 --}}
@else
           <div class="col-md-2 padding0"><div class="checkbox"><label><input type="checkbox" values="{{$data->product_category}}" ids="{{$data->id}}" name="category_id[]" value="{{$data->id}}" checked> {{$data->product_category}}</label></div></div>


@endif
           @endforeach
          @endif
             @foreach($categories as $index=>$data)  


           <div class="col-md-2 padding0"><div class="checkbox"><label><input type="checkbox" values="{{$data->product_category}}" ids="{{$data->id}}" name="category_id[]" value="{{$data->id}}" > {{$data->product_category}}</label></div></div>


           @endforeach
          




       </div>  
   </div>

   <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i>   Submit</button>

{{Form::close()}}

   <div class="card" style="margin-top:30px">

       <div class="card-header" style="border-bottom:1px solid #ccc">
         <div class="row margin0" >
            <div class="col-md-6">

                <label for="inputEmail4">Choose Category:</label>
            </div>
            <div class="col-md-6">
               
            </div>
        </div>
    </div>
    <div class="card-content" style="padding:20px ">
      <div class="row">
          <div class="col-md-4">
             @if(!empty($store_categorys))
             {!!Form::select('search',$store_categorys,null,array('class'=>'form-control select2','placeholder'=>'Search','data-toggle'=>'select2','id'=>'select_category_id')) !!}


             @endif

         </div>
     </div>

     <div class="row " style="margin-top:30px" id="append_checkbox_id">






</div>  

</div>

</div>


  <div class="card" style="margin-top:30px">

       <div class="card-header" style="border-bottom:1px solid #ccc">
         <div class="row margin0" >
            <div class="col-md-6">

                <label for="inputEmail4">Add Custome Category:</label>
            </div>
            <div class="col-md-6">
              
            </div>
        </div>
    </div>
<div class="card-content" style="padding:20px ">


 {!!Form::open(['url'=>['seller/store_custom_category'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_validation_id'])!!}



<div class="row">
<div class="col-md-4" >


                               
                                        {!!Form::text('product_category',null,array('class'=>'form-control','placeholder'=>'Enter Custome Category','autocomplete'=>'off','required')) !!} 
                                    
<input type="hidden" name="store_category" value="{{$stores->store_category}}">
</div>
       <div class="col-md-6" style="margin-top:0px">

               <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i>   Add</button>

</div>


</div>


{{Form::close()}}

</div>

</div>


</div>






</div>
</div>


<!-- <div>
  <h2>Selected</h2>
  <ul id="selected">
    <li><input type="checkbox" id="number" name="selected" value="Number"><label for="number">Number</label></li>
    <li><input type="checkbox" id="author" name="selected" value="Author"><label for="author">Author</label></li>
    <li><input type="checkbox" id="category" name="selected" value="Category"><label for="category">Category</label></li>
  </ul>
  <button id="move-selected"></button>
</div> -->
<!-- 
<div id="cblist">
    <input type="checkbox" value="first checkbox" id="cb1" /> <label for="cb1">first checkbox</label>
</div>

<input type="text" id="txtName" />
<input type="button" value="ok" id="btnSave" />
-->
</main> 

@endsection

<!-- ................push new js link................. -->

@push('js')
<script src="{{asset('public/js/comman.js')}}"></script>



<script type="text/javascript">
    $(document).ready(function() {

                       $('.masterCls').on('change','.checkstatus_not_allow',function(){

$(this).prop('checked', true);;

})




               $('.masterCls').on('change','#select_category_id',function(){

          $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
          var catId = $(this).val();
// alert(catId)
$.ajax({
  url: "{{url('seller/append_category_checkbox')}}",
  type: "post",
  data: {id:catId},
  dataType: "json",
  success:function(data) {
    console.log(data);
    $('#append_checkbox_id').empty();

    $.each(data, function(key, value) { 
      $('#append_checkbox_id').append('<div class="col-md-2 padding0 hide_'+ value.id +'" id="hide_'+ value.id +'" ><div class="checkbox"><label><input type="checkbox" values="'+ value.product_category +'" ids="'+ value.id +'" class="appendagain" name="category_id" value="'+ value.id +'"> '+ value.product_category +'</label></div></div>');
  });

  

}

});


});


   $('.masterCls').on('change','.appendagain',function(){
        var value=$(this).attr('values');
        var id=$(this).attr('ids');

        console.log(id,'id1')
        console.log(value,'value1')

 $(".hide_"+id).hide()

        $('#move-selected').append('<div class="col-md-2 padding0 show_'+id+'" id="show_'+id+'"><div class="checkbox"><label><input type="checkbox" name="category_id[]" value="'+ id +'" class="removeagain"  values="'+ value +'" ids="'+ id +'"  checked> '+ value +'</label></div></div>');



    })


   $('.masterCls').on('change','.removeagain',function(){


        var value=$(this).attr('values');
        var id=$(this).attr('ids');

        console.log(id,'id2')
        console.log(value,'value2')


 $(".show_"+id).hide()


        $('#append_checkbox_id').append('<div class="col-md-2 padding0 hide_'+id+'" id="hide_'+id+'"><div class="checkbox"><label><input type="checkbox" name="category_id[]" value="'+ id +'" class="appendagain"  values="'+ value +'" ids="'+ id +'"  checked> '+ value +'</label></div></div>');



    })



// ............


})
</script>
<!-- <script type="text/javascript">
$(document).ready(function() {
    $('#btnSave').click(function() {
        addCheckbox($('#txtName').val());
    });
});

function addCheckbox(name) {
   var container = $('#cblist');
   var inputs = container.find('input');
   var id = inputs.length+1;

   $('<input />', { type: 'checkbox', id: 'cb'+id, value: name }).appendTo(container);
   $('<label />', { 'for': 'cb'+id, text: name }).appendTo(container);
}
</script> -->


<div class="modal fade comman-modal" id="notPermissionForRemove" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">
    <div class="modal-content">
    
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Alert</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <div class="modal-body">
      <div id="infoPanel">
        <p>WantS to remove thIs subcategory, first delete this subcategory products item list.  </p>
       
    </div>

</div>
<div class="modal-footer">
   <button type="button" class="btn btn-raised btn-danger" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
@endpush