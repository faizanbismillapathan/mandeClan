@extends('seller.layouts.app')
@section('title',"Create New Products Items | seller Mande Clan")

<!-- ................custom css................. -->

@section('customStyle')

<style type="text/css">
    .badge-dark{
        margin-right: 10px;
        font-size: 13px ;
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
                <div class="clearfix" style="margin-bottom:10px">




         <div class="form-inline float-right mt--1 d-none d-md-flex">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
Create New Attributes
</button>
                                    </div>

                        </div>


      

        <table class="table table-striped table-hover table-sm table-bordered" >
                                        <thead>
                                            <tr>
                                                <th width="10%">Sr.</th>
                                                <th width="20%">Attribute</th>
                                                <th width="50%">Values</th> <th width="15%">Action</th>                         
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                            
                                            @if(!empty($records))
                                            @foreach($records as $index => $data)
                                              
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
                                                
                                                                                
                                               </td>
                                            </tr>
                                          @endforeach
                                            @endif
                                            
                                        </tbody>
                                    </table>

</div>

    
<!-- Modal -->
<div class="modal fade" id="editexampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    
    <div class="modal-content">
         {!!Form::open(['url'=>['seller/product-items-update'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_ids'])!!}

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <input type="hidden" name="id" id="appendid">

   <div class="form-row">
 <div class="form-group col-md-8">
         {!!Form::select('attribute_name',['Size'=>'Size','Color'=>'Color','Material'=>'Material','Style'=>'Style'],null,array('class'=>'form-control ','placeholder'=>'Select Option','required','id'=>'attribute_name_id')) !!}

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
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
          {{Form::close()}}

    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    
    <div class="modal-content">
         {!!Form::open(['url'=>['seller/product-items'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       

   <div class="form-row">
 <div class="form-group col-md-8">
         {!!Form::select('attribute_name',['Size'=>'Size','Color'=>'Color','Material'=>'Material','Style'=>'Style'],null,array('class'=>'form-control select2 ','placeholder'=>'Select Option','data-toggle'=>'select2','required')) !!}

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
            <button id="addRow" type="submit" class="btn btn-info">Add Row</button>
        </div>
        </div>





      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
          {{Form::close()}}

    </div>
  </div>
</div>




            


</div>
</main>
@endsection

<!-- ................push new js link................. -->

@push('js')
<script type="text/javascript">
    // add row
        $(".modaleditclick").click(function () {

var attribute_value=$(this).attr('attribute_value');
var attribute_name=$(this).attr('attribute_name');
var id=$(this).attr('id');

// alert(attribute_name)
// alert(id)
$("#appendid").val(id)
$("#attribute_name_id").val(attribute_name).trigger('change');



const arr=attribute_value.split(',');


   $.each(arr, function(key, value) { 

 var html = '';
        html += '<div id="inputFormRow">';
        html += '<div class="input-group mb-3">';
        html += '<input type="text" name="attribute_value[]" value="'+value+'" class="form-control onchangekey" placeholder="Enter Value" autocomplete="off" required="required" >';
        html += '<div class="input-group-append">';
        html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
        html += '</div>';
        html += '</div>';


console.log(value)


                $('#newEditRow').append(html);


    })
})

    $("#addRow").click(function () {
        var html = '';
        html += '<div id="inputFormRow">';
        html += '<div class="input-group mb-3">';
        html += '{!!Form::text('attribute_value[]',null,array('class'=>'form-control onchangekey','placeholder'=>'Enter Value','autocomplete'=>'off','required')) !!}';
        html += '<div class="input-group-append">';
        html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
        html += '</div>';
        html += '</div>';

        $('#newRow').append(html);
    });

    // remove row
    $(document).on('click', '#removeRow', function () {
        $(this).closest('#inputFormRow').remove();
    });


     $("#editAddRow").click(function () {
        var html = '';
        html += '<div id="inputFormRow">';
        html += '<div class="input-group mb-3">';
        html += '{!!Form::text('attribute_value[]',null,array('class'=>'form-control onchangekey','placeholder'=>'Enter Value','autocomplete'=>'off','required')) !!}';
        html += '<div class="input-group-append">';
        html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
        html += '</div>';
        html += '</div>';

        $('#editNewRow').append(html);
    });

    // remove row
    $(document).on('click', '#editRemoveRow', function () {
        $(this).closest('editInputFormRow').remove();
    });

</script>

 
@endpush