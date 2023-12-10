@extends('seller.layouts.app')
@section('title',"All Product Addons | seller Mande Clan")

<!-- ................custom css................. -->

@section('customStyle')
<style type="text/css">
  .newmodal h6 {
    font-size: 16px;
    margin-bottom: 25px;
    text-transform: uppercase;
}

/*.newmodal p {
    padding: 15px;
    margin: 0px;
}
*/
.newmodal .pull-right img {
    width: 15px;
}

.card-header{
  background-color: #f7f7f7;
}

.modal-footer{
  display: unset;
}

.modal-footer p {
    margin-bottom: 0px;
    color: #000;
    font-weight: 600;
    margin-top: 0px;
}

 .addtocardbtn {
    text-align: center;
    height: 30px;
    background: #3f51b5;
    color: #ffffff;
    text-transform: uppercase;
    border-radius: 15px;
    padding: 5px 0px;
    font-size: 11px;
    border: 2px solid #ff9800;
    width: 100px;
}
.modal-header {
  background: #ccc;
}

.modal-header h5{
font-size: 18px;

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
             <a data-toggle="modal" data-target="#AddonsShow" class="form-inline float-right mt--1 d-none d-md-flex">
               <button class="btn btn-warning"><i class="fa fa-eye"></i> View</button>
             </a>

                 <a href="{{url('seller/products')}}" class="form-inline float-right mt--1 d-none d-md-flex">
    <button class="btn btn-info"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Back</button>
    </a>


             <h1 class="h3 mb-3">Addons</h1>
           </div>



        <div class="row">
          <div class="col-md-3 mb-3">

    <div class="card">
      <div class="card-body">
            <ul class="nav nav-pills flex-column" id="myTab" role="tablist">
              <!-- ......... -->

              <li class="nav-item">
              
                <a class="nav-link {{ Session::get('addon_group')==1 ? "active" : "" }}  {{ Session::get('addon_group')=='' && Session::get('addon_list')=='' ? "active" : "" }}" id="tab_addon_groups" data-toggle="tab" href="#id_tab_addon_groups" role="tab" aria-controls="id_tab_addon_groups" aria-selected="true">      <i class="fa fa-circle " ></i>&nbsp;&nbsp;&nbsp;   Addons Groups  </a>
              </li>

              <!-- ......... -->

              <li class="nav-item">
                <a class="nav-link {{ Session::get('addon_list')==1 ? "active" : "" }}"  id="tab_addon_list" data-toggle="tab" href="#id_tab_addon_list" role="tab" aria-controls="id_tab_addon_list" aria-selected="true">  <i class="fa fa-circle"></i>&nbsp;&nbsp;&nbsp;   Addons List </a>
              </li>             

            </ul>
          </div>
      </div>
       <div class="card">
           <div class="card-body">

                    <div class="form-row">

 <div class="form-group col-md-12">
  <div class="row">
    <div class="col-md-10"><b>Product Name</b></div>
    <div class="col-md-1"><b>:</b></div>
    <div class="col-md-12">{{$record->product_name}}</div>
  </div>         
</div>

<div class="form-group col-md-12">
  <div class="row">
    <div class="col-md-10"><b>Category</b></div>
    <div class="col-md-1"><b>:</b></div>
    <div class="col-md-12">{{$record->product_category}}</div>
  </div>         
</div>
<div class="form-group col-md-12">
  <div class="row">
    <div class="col-md-10"><b>SubCategory</b></div>
    <div class="col-md-1"><b>:</b></div>
    <div class="col-md-12">{{$record->product_subcategory}}</div>
  </div>         
</div>
 
</div>

</div>
        </div>
          </div>
          <!-- .................................. -->
          <div class="col-md-9">

    <div class="card">
      <div class="card-body">
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show {{ Session::get('addon_group')==1 ? "active" : "" }} {{ Session::get('addon_group')=='' && Session::get('addon_list')=='' ? "active" : "" }}" id="id_tab_addon_groups" role="tabpanel" aria-labelledby="tab_addon_groups">
          <div class="group_create_cls" >

                {!!Form::open(['url'=>['seller/product-addon-group'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}

                <div class="card table-content">
                  <div class="card-header" style="background-color:#ccc;">
                    <div class="row">
                      <div class="col-md-6">
                        <h4>Create Addons Group</h4>
                      </div>
                      <div class="col-md-6">

                      </div>

                    </div>
                  </div>

                  <div class="card-content" style="padding:20px">
                   <div class="form-row">

                    <div class="form-group col-md-4 ">                        
                     <label for="">Group Name:</label>
                      {!!Form::text('addon_group_name',null,array('class'=>'form-control','placeholder'=>'Enter Role','autocomplete'=>'off','required')) !!} 

                   </div>
                   <input type="hidden" name="product_id" value="{{$id}}">

                   <div class="form-group col-md-3 ">                        
                     <label for="">Select Group Type:</label>
                     {!!Form::select('addon_group_type',['Single'=>'Single','Multiple'=>'Multiple'],null,array('class'=>'form-control','placeholder'=>'Group Type','data-toggle'=>'select2','autocomplete'=>'off','required')) !!}

                   </div>

                   <div class="form-group col-md-3 ">                        
                     <label for="">Validation:</label>
                     {!!Form::select('addon_group_validation',['Compulsory'=>'Compulsory','Not Compulsory'=>'Not Compulsory'],null,array('class'=>'form-control','data-toggle'=>'select2','autocomplete'=>'off','required')) !!}

                   </div>



                
                  <div class="form-group col-md-2 " style="margin-top:30px">                        

                   <button type="submit" class="btn full btn-primary">Save</button>

                 </div>
              
              </div>

            </div>
          </div>

          {{Form::close()}}

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

                    <div class="form-group col-md-3 ">                        
                     <label for="">Group Name:</label>
                      {!!Form::text('addon_group_name',null,array('class'=>'form-control','placeholder'=>'Enter Role','autocomplete'=>'off','required','id'=>'addon_group_name_id')) !!} 

                   </div>
                   <input type="hidden" name="product_id" value="{{$id}}">

                   <div class="form-group col-md-3 ">                        
                     <label for="">Select Group Type:</label>
                     {!!Form::select('addon_group_type',['Single'=>'Single','Multiple'=>'Multiple'],null,array('class'=>'form-control select2','placeholder'=>'Group Type','data-toggle'=>'select2','autocomplete'=>'off','required','id'=>'addon_group_type_id')) !!}

                   </div>
                    <div class="form-group col-md-3 ">                        
                     <label for="">Validation:</label>
                     {!!Form::select('addon_group_validation',['Compulsory'=>'Compulsory','Not Compulsory'=>'Not Compulsory'],null,array('class'=>'form-control','data-toggle'=>'select2','autocomplete'=>'off','required')) !!}

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


           <table class="table table-striped table-hover table-sm table-bordered" >
                                        <thead>
                                            <tr>
                                                <th width="10%">Sr.</th>
                                                <th width="30%">Group Name</th>
                                                <th width="30%">Group Type</th>
                                                 <th width="30%">Validation</th>
                                                <th width="15%">Status</th> 
                                                <th width="15%">Action</th>                         
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                            
                                            @if(!empty($addon_groups))
                                            @foreach($addon_groups as $index => $data)
                                            <tr class="deleteRow">
                                                <td>{{$index+1}}</td>   
                                                <td>{{$data->addon_group_name}}</td>
                                                 <td>{{$data->addon_group_type}}</td>
                                                   <td>{{$data->addon_group_validation}}</td>
                                                <td>
                                    
                 @if($data->status ==  'Active')

                                                    <input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="Deactive" data-onstyle="success" data-offstyle="danger" id="{{$data->id}}" class="checkstatus" onchange="updateToggle({{$data->id}})">
 @elseif($data->status ==  'Deactive')
<input type="checkbox" data-toggle="toggle" data-on="Active" data-off="Deactive" data-onstyle="success" data-offstyle="danger" id="{{$data->id}}" class="checkstatus" onchange="updateToggle({{$data->id}})">
   @endif

                                                </td>
                                                <td>                                                    
                                                <button type="button" class="btn btn-info show_update_group_form" addon_group_name="{{$data->addon_group_name}}"
addon_group_type="{{$data->addon_group_type}}" addon_group_update="{{$data->id}}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></button>
                                                
                                                <button class="btn btn-danger click_disbled"  data-toggle="tooltip" data-placement="top" title="Delete"  data="{{$data->id}}"><i class="fas fa-trash-alt"></i></button>                                 
                                               </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                            
                                        </tbody>
                                    </table>
        </div>


        <!-- ........................... -->

        <div class="tab-pane fade show {{ Session::get('addon_list')==1 ? "active" : "" }}" id="id_tab_addon_list" role="tabpanel" aria-labelledby="tab_addon_list">

       <div class="list_create_cls">
           
                {!!Form::open(['url'=>['seller/product-addon'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}


                <div class="card table-content">
                  <div class="card-header" style="background-color:#ccc;">
                    <div class="row">
                      <div class="col-md-6">
                        <h4>Create Addons List</h4>
                      </div>
                      <div class="col-md-6">

                      </div>

                    </div>
                  </div>

                  <div class="card-content" style="padding:20px">
                   <div class="form-row">

                    <div class="form-group col-md-5 ">                        
                     <label for="">Select Group:</label>
                     {!!Form::select('addon_group_id',$addon_groups_arr,null,array('class'=>'form-control select2','placeholder'=>'Group Type','data-toggle'=>'select2','autocomplete'=>'off','required')) !!}

                   </div>

                   <div class="form-group col-md-6 ">                        
                     <label for="">Addon Name:</label>
                      {!!Form::text('addon_name',null,array('class'=>'form-control','placeholder'=>'Enter Role','autocomplete'=>'off','required')) !!} 

                   </div>
                                      <input type="hidden" name="product_id" value="{{$id}}">


                   <div class="form-group col-md-5 ">                        
                     <label for="">Addon Price:</label>
                      {!!Form::text('addon_price',null,array('class'=>'form-control numbersOnly','placeholder'=>'Enter Role','autocomplete'=>'off','required','maxlength'=>'5')) !!} 

                   </div>



                
                  <div class="form-group col-md-5 " style="margin-top:30px">                        

                   <button type="submit" class="btn full btn-primary">Save</button>

                 </div>
              
              </div>

            </div>
          </div>

          {{Form::close()}}
       </div>


       <div class="list_update_cls" style="display:none">
           

 {!!Form::open(['url'=>['seller/product-addon-list-update'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}


                <div class="card table-content">
                  <div class="card-header" style="background-color:#ccc;">
                    <div class="row">
                      <div class="col-md-6">
                        <h4>Update Addons List</h4>
                      </div>
                      <div class="col-md-6">

                      </div>

                    </div>
                  </div>

                  <div class="card-content" style="padding:20px">
                   <div class="form-row">

                    <div class="form-group col-md-5 ">                        
                     <label for="">Select Group:</label>
                     {!!Form::select('addon_group_id',$addon_groups_arr,null,array('class'=>'form-control select2','placeholder'=>'Group Type','data-toggle'=>'select2','autocomplete'=>'off','required','id'=>'addon_group_id_id')) !!}

                   </div>

                   <div class="form-group col-md-6 ">                        
                     <label for="">Addon Name:</label>
                      {!!Form::text('addon_name',null,array('class'=>'form-control','placeholder'=>'Enter Role','autocomplete'=>'off','required','id'=>'addon_name_id')) !!} 

                   </div>

                                                         <input type="hidden" name="product_id" value="{{$id}}">


                   <div class="form-group col-md-5 ">                        
                     <label for="">Addon Price:</label>
                      {!!Form::text('addon_price',null,array('class'=>'form-control numbersOnly','placeholder'=>'Enter Role','autocomplete'=>'off','required','id'=>'addon_price_id','maxlength'=>'5')) !!} 

                   </div>
<input type="hidden" name="id" id="addon_list_id_id">



                
                  <div class="form-group col-md-5 " style="margin-top:30px">                        

                   <button type="submit" class="btn full btn-primary">Update</button>
                    <button type="button" class="btn full show_add_list_form" style="background-color: #9e9b9b;color: #fff" >Go Back</button>


                 </div>
              
              </div>

            </div>
          </div>

          {{Form::close()}}
       </div>



           <table class="table table-striped table-hover table-sm table-bordered" >
                                        <thead>
                                            <tr>
                                                <th width="10%">Sr.</th>
                                                <th width="20%">Group Name</th>
                                                <th width="20%">Addon Name</th>
                                                <th width="20%">Price</th>
                                                <th width="15%">Status</th> 
                                                <th width="15%">Action</th>                         
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                            
                                            @if(!empty($addon_group_list))
                                            @foreach($addon_group_list as $index => $data)
                                            <tr class="deleteRow">
                                                <td>{{$index+1}}</td>   
                                                <td>{{$data->addon_group_name}}</td>
                                                 <td>{{$data->addon_name}}</td>
                                                 <td>{{$data->addon_price}} $</td>
                                                 <td>
                                    
                 @if($data->status ==  'Active')

                                                    <input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="Deactive" data-onstyle="success" data-offstyle="danger" id="{{$data->id}}" class="checkstatus" onchange="updateToggle_2({{$data->id}})">
 @elseif($data->status ==  'Deactive')
<input type="checkbox" data-toggle="toggle" data-on="Active" data-off="Deactive" data-onstyle="success" data-offstyle="danger" id="{{$data->id}}" class="checkstatus" onchange="updateToggle_2({{$data->id}})">
   @endif

                                                </td>
                                                <td>                                                    
<button type="button" class="btn btn-info show_update_list_form" addon_group_id="{{$data->addon_group_id}}"
addon_name="{{$data->addon_name}}" addon_price="{{$data->addon_price}}" addon_list_id="{{$data->id}}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></button>
                                                                                                
                                                <button class="btn btn-danger click_disbled_2"  data-toggle="tooltip" data-placement="top" title="Delete"  data="{{$data->id}}"><i class="fas fa-trash-alt"></i></button>                                 
                                               </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                            
                                        </tbody>
                                    </table>
  </div>

<!-- ............ -->
</div>
</div>
</div>

<!-- .......end......... -->
</div>
</div>

</div>
                </main> 

@endsection

<!-- ................push new js link................. -->

@push('js')
 <script src="{{asset('public/js/comman.js')}}"></script>
 <script src="{{asset('public/js/validation.js')}}"></script>
 <script type="text/javascript">
    $(document).ready(function() {

var location=window.location.origin;

var pathname= window.location.pathname;

var base_url=location+pathname+'/';


 $(".click_disbled_2").click(function(){


   var data=$(this).attr('data');
   // alert(base_url+'delete')

   var clickDisbled = $(this);

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
           
           url:base_url+'delete_2',
           data:{_token: CSRF_TOKEN, id:data},
           dataType:'JSON',
        
            
            complete: function(){
        
                     clickDisbled.parents('.deleteRow').fadeOut(1500);
                
             swal(
      'Deleted!',
      'Your record has been deleted.',
      'success'
    );
             }


        });
  });
  });


 $(".show_add_group_form").click(function(){
  $(".group_create_cls").show();
    $(".group_update_cls").hide();

});

 $(".show_update_group_form").click(function(){

  $(".group_create_cls").hide();

  var addon_group_name= $(this).attr('addon_group_name')
var addon_group_type= $(this).attr('addon_group_type')
var addon_group_update= $(this).attr('addon_group_update')

// alert(addon_group_name)
// alert(addon_group_type)
$("#addon_group_name_id").val(addon_group_name)
$("#addon_group_update_id").val(addon_group_update)

 $('#addon_group_type_id').val(addon_group_type).trigger('change');


      $(".group_update_cls").show();


});



$(".show_add_list_form").click(function(){
  $(".list_create_cls").show();
    $(".list_update_cls").hide();

});

 $(".show_update_list_form").click(function(){

  $(".list_create_cls").hide();

  var addon_group_id= $(this).attr('addon_group_id')
var addon_name= $(this).attr('addon_name')
var addon_price= $(this).attr('addon_price')
var addon_list_id= $(this).attr('addon_list_id')


$("#addon_list_id_id").val(addon_list_id)
$("#addon_name_id").val(addon_name)
$("#addon_price_id").val(addon_price)

 $('#addon_group_id_id').val(addon_group_id).trigger('change');


      $(".list_update_cls").show();


});



 


});

function updateToggle_2(userid) {
    // alert(window.location.origin+window.location.pathname+"/status_update")

 var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');


       $.ajax({
           type:"post",
           url:window.location.origin+window.location.pathname+"/status_update_list",
           data:{_token: CSRF_TOKEN, user_id:userid},
           dataType:'JSON',
           dataType: 'json',
           success:function(res){ 

  var data= "your status is "+res;       


                  var message = data;
                  var title = $('#toastr-title').val() || '';
                  if (res=='Deactive') {
                    var type = 'error';
                  }else if(res=='Active'){
                        var type = 'success';
                  }
                  toastr[type](message, title, {
                    positionClass: $('input[name="toastr-position"]:checked').val(),
                    closeButton: 'true',
                    progressBar:'true',
                    newestOnTop: 'true',
                    rtl: $('body').attr('dir') === 'rtl' || $('html').attr('dir') === 'rtl',
                    timeOut: $('#toastr-duration').val()
                  });
               
         }
       });
    };

</script>

<div class="modal fade comman-modal newmodal" id="AddonsShow" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<span class="cancel-this-order" style="display:none;"></span>
<div class="vertical-align-outer-div">
<div class="vertical-align-inner-div">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header modal-header-padding">
<h5>Addons</h5>
<div class="close-btn">
<i class="far fa-times-circle" data-dismiss="modal" aria-label="Close"></i>
</div>
</div>
<div class="modal-body">

  @if(!empty($viewarray))
  @foreach($viewarray as $index=>$data)
  <div class="card" >
      <div class="card-header">
    {{$data['addon_group_name']}}
  </div>
<div class="card-body">

    @foreach($data['group_list'] as $index1=>$data1)

  <p>
@if($data['addon_group_type']=='Single')
    <label><input type="radio" value="{{$data1->id}}" code="{{$data1->addon_price}}" id="{{$data1->id}}" class="calpriceclass" name="mainattr" >{{$data1->addon_name}}</label>
   

@else


    <label><input type="checkbox" value="{{$data1->id}}" codecheck="{{$data1->addon_price}}" id="{{$data1->id}}" class="calpriceclass extramulticheckbox" name="checkbox_group[]" >{{$data1->addon_name}}</label>

@endif


             
            <span class="pull-right">
              <img src="{{url('public/img/dollar.png')}}"> {{$data1->addon_price}}
            </span>
            </p>
@endforeach

           
          </div>


</div>
@endforeach
@endif


</div>
<div class="modal-footer">

<div class="row">
    <div class="col-md-7">
      <p><span class="inline-block">Total</span> <img src="{{url('public/img/dollar.png')}}" class="inline-chan"><span class="final_price">00.00</span></p>
    </div>
    <div class="col-md-5">  
      <div class="pull-right">
          <button type="button" name="submit" class="addtocard addtocardbtn" id="additemincart" iddd="264">Add to Cart</button>
      </div>
    </div>
  </div>

</div>
</div>
</div>
</div>
</div>
</div>


<script type="text/javascript">
$(".calpriceclass").change(function(){


      var productid = $(this).attr('id'); 
      var extramacustom = $("input[type='radio'][name='mainattr']").attr('code');

      // alert(extramacustom)
      var radioamount = 0;
      var extrasingle = $("input[type='radio'][name='mainattr']:checked").map(function(){
                          radioamount += parseInt($(this).attr('code'));
                        }).get();

      console.log(radioamount)

      var checkboxamount = 0;

      var extramultiple = $("input[name='checkbox_group[]']:checked").map(function() {
                       checkboxamount += parseInt($(this).attr('codecheck'));
                        return this.value;
                       }).get().join("-");
      
            console.log(checkboxamount)

      var pay = getNumber(radioamount,0) + getNumber(checkboxamount,0) ;

      console.log(pay)
      // $("#AddonsShow").find(".final_price").html('');
      $("#AddonsShow").find(".final_price").html(pay);
  });

 function getNumber(number, defaultNumber) {
    return isNaN(parseInt(number, 10)) ? defaultNumber : parseInt(number, 10);
  }

//   $(".calpriceclass").click(function(){
// var final=$('.final_price').text();

// var radio_price=$("input[type='radio'][name='mainattr']:checked").attr('code');

// // alert(radio_price)

// // var price=$(this).attr('code');

// var total=parseFloat(final)+parseFloat(radio_price);

// $('.final_price').html(total);



//   })


//   $(".calpriceclass11").click(function(){
// var final=$('.final_price').text();

// // var radio_price=$("input[type='radio'][name='mainattr']:checked").attr('code');

// var price = $("input[name='checkbox_group[]']:checked")
//               .map(function(){
//                 return $(this).attr('code');

//               }).get();

//     alert(price)

// // var price=$(this).attr('code');

// var total=parseFloat(final)+parseFloat(price);

// $('.final_price').html(total);



//   })

</script>
@endpush