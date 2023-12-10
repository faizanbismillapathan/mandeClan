@extends('admin.layouts.app')
@section('title',"Edit Zones | Admin Mande Clan")

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
    <a href="{{url('admin/zones')}}" class="form-inline float-right mt--1 d-none d-md-flex">
    <button class="btn btn-info"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Back</button>
    </a>
        <h1 class="h3 mb-3"><b>Update Zones</b></h1>

                    </div>
                                <div class="card">
                                
<div class="card-body">
     @if(!empty($record))
       {!! Form::model($record,array('url' => ['admin/zones', $record->id],'method'=>'PATCH','class'=>'','id' =>'comman_form_id','files'=>'true')) !!}
      
       @endif
                                              <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputEmail4">Zone Name: *</label>                                                   
                    {!!Form::text('zone_name',null,array('class'=>'form-control','placeholder'=>'Ex. North Zone','autocomplete'=>'off','required')) !!} 
                </div>
            </div>
            <div class="form-row">

             <div class="form-group col-md-4">
                <label for="inputEmail4">Country: * </label>                                                   
                @if(!empty($countries))
                {!!Form::select('zone_country',$countries,null,array('class'=>'form-control select2 selector','placeholder'=>'Select Country','data-toggle'=>'select2','required')) !!}
            @endif                                                </div>
        </div>
        <div class="form-row">
         <div class="form-group col-md-6">
            <label for="inputEmail6">Select Zone: * </label>

@if(!empty($record->zone_state))
@php $arr=explode(',',$record->zone_state)  @endphp
            {!!Form::select('zone_state[]',$states,$arr,array('class'=>'form-control select2','placeholder'=>'Select State','data-toggle'=>'select2','required','multiple','id'=>'upload_id')) !!}

@else
            {!!Form::select('zone_state[]',$states,null,array('class'=>'form-control select2','placeholder'=>'Select State','data-toggle'=>'select2','required','multiple','id'=>'upload_id')) !!}

@endif


        </div>

        
        <div class="form-group col-md-4" style="margin-top:30px">

            <button type="button"  onclick="SelectAllCountry2()" id="btn_sel"class="btn btn-info display-none" isSelected="no">
             Select All <i class="far fa-check-square"></i></button>

             <button type="button"   onclick="RemoveAllCountry2()" id="btn_rem"class="btn btn-danger display-none" isSelected="yes">
                 Remove All <i class="far fa-trash-alt"></i></button>
             </div>
         </div>
         <div class="form-row">
            



             <div class="form-group col-md-4">
                <label for="inputEmail4">Code: *</label>                                                   
                {!!Form::text('zone_code',null,array('class'=>'form-control','placeholder'=>'Enter Zones','autocomplete'=>'off','required')) !!} 
            </div>

        </div>
        

        <button type="submit" class="btn btn-primary"><i class="far fa-edit"></i>  Update</button>


                                         
<a class="btn" href="{{url('admin/zones')}}" style="background-color: #9e9b9b;color: #fff"><i class="fas fa-times"></i>  Cancel</a>
                                            
  {{Form::close()}}
</div>
</div>
</div>
</main>
@endsection

<!-- ................push new js link................. -->

@push('js')

<script src="{{asset('public/js/validation.js')}}"></script>
<script type="text/javascript">
    
    function RemoveAllCountry2() {
      var cou2 = $('#btn_rem').attr('isSelected');
      $(this).attr('isSelected', 'no');
      $('#upload_id').find('option').prop("selected", "");
      $('#upload_id').find('option').trigger("change");
  }

  function SelectAllCountry2() {
      var cou2 = $('#btn_sel').attr('isSelected');
  // alert(cou2)
  if(cou2 == 'no') {
    $(this).attr('isSelected', 'yes');
    $('#upload_id').find('option').prop("selected", "selected");
    $('#upload_id').find('option').trigger("change");
    $('#upload_id').find('option').on('click');
} else {
    $(this).attr('isSelected', 'no');
    $('#upload_id').find('option').prop("selected", "");
    $('#upload_id').find('option').trigger("change");
}
}


$(document).ready(function() {

    $('.selector').on('change', function() {
        var countryID = $(this).val();
        console.log(countryID);
            //console.log("myform/ajax/"+countryID);
            var data;
            if(countryID) {  
              $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
              $.ajax({
                  url: "{{url('admin/append_state')}}",
                  type: "post",
                  data: {id:countryID},
                  dataType: "json",
                  success:function(data) {
                    console.log(data);
                    $('select[name="zone_state[]"]').empty();
                    
                    $('select[name="zone_state[]"]').append('<option value="'+''+'">'+'None'+'</option>');
                    $.each(data, function(key, value) { 
                      $('select[name="zone_state[]"]').append('<option value="'+ key +'">'+value+'</option>');
                  });
                }

            });
          }
          else{
            $('select[name="zone_state[]"]').empty();
            

        }

    });
});


</script>
@endpush