@extends('service.layouts.app')
@section('title',"All Category List| service Mande Clan")

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


       <h1 class="h3 mb-3">Service Category </h1>
   </div>

   <div class="card">
    <div class="card-header">
        <h4 class="card-title">
            {{  $services->service_name }} 
        </h4>
    </div>
    <div class="card-body">
     {!!Form::open(['url'=>['service/categories'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}

     <div class="card-content" style="padding:20px 0px">
        <div class="row margin0" id="move-selected">


           @if(count($shop_categories) > 0)
           @foreach($shop_categories as $index=>$data)  


           <div class="col-md-2 padding0"><div class="checkbox"><label><input type="checkbox" values="{{$data->service_subcategory}}" ids="{{$data->id}}" name="category_id[]" value="{{$data->id}}" checked> {{$data->service_subcategory}}</label></div></div>


           @endforeach
          @endif
             @foreach($categories as $index=>$data)  


           <div class="col-md-2 padding0"><div class="checkbox"><label><input type="checkbox" values="{{$data->service_subcategory}}" ids="{{$data->id}}" name="category_id[]" value="{{$data->id}}" > {{$data->service_subcategory}}</label></div></div>


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


 {!!Form::open(['url'=>['service/store_custom_category'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}



<div class="row">
<div class="col-md-4" >


                               
                                        <label for="inputEmail4">Create Custome Category</label>                                                   
                                        {!!Form::text('service_subcategory',null,array('class'=>'form-control','placeholder'=>'Enter Custome Category','autocomplete'=>'off','required')) !!} 
                                    
<input type="hidden" name="service_category" value="{{$services->service_category}}">
</div>
       <div class="col-md-6" style="margin-top:30PX">

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

<!-- <script type="text/javascript">

 

function displaySelected() {
  var selectedValues = $('input[name="selected"]:checked').map(function() {
    return this.value;
  }).get().join(', ');
  $("#move-selected").html(
    // '<label for='chk_" + selectedValues + "'>" + val + "</label><input id='chk_" + selectedValues + "' type='checkbox' value='" + val + "' />'
    );
}
$(".new_checkbox").change(displaySelected);
// displaySelected();


</script> -->

<script type="text/javascript">
    $(document).ready(function() {

        $('#select_category_id').change(function() {
          $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
          var catId = $(this).val();
// alert(catId)
$.ajax({
  url: "{{url('service/append_category_checkbox')}}",
  type: "post",
  data: {id:catId},
  dataType: "json",
  success:function(data) {
    console.log(data);
    $('#append_checkbox_id').empty();

    $.each(data, function(key, value) { 
      $('#append_checkbox_id').append('<div class="col-md-2 padding0" id="hide_'+ value.id +'" ><div class="checkbox"><label><input type="checkbox" values="'+ value.service_subcategory +'" ids="'+ value.id +'" class="appendagain" name="category_id" value="'+ value.id +'"> '+ value.service_subcategory +'</label></div></div>');
  });

    $('.appendagain').change(function() {

        var value=$(this).attr('values');
        var id=$(this).attr('ids');

        // alert(id)
        // alert(value)


        $('#move-selected').append('<div class="col-md-2 padding0" id="show_'+id+'"><div class="checkbox"><label><input type="checkbox" name="category_id[]" value="'+ id +'" class="removeagain"  values="'+ value +'" ids="'+ id +'"  checked> '+ value +'</label></div></div>');

 $("#hide_"+id).hide()


   $('.removeagain').change(function() {

        var value=$(this).attr('values');
        var id=$(this).attr('ids');

        // alert(id)
        // alert(value)


        $('#append_checkbox_id').append('<div class="col-md-2 padding0" id="hide_'+ value +'" ><div class="checkbox"><label><input type="checkbox" values="'+ value +'" ids="'+ value +'" class="appendagain" name="category_id" value="'+ value +'"> '+ value +'</label></div></div>');

 $("#show_"+id).hide()


    })

    })



 



}

});


});


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
@endpush