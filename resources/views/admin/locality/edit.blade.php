@extends('admin.layouts.app')
@section('title',"Edit locality | Admin Mande Clan")

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
    <a href="{{url('admin/locality')}}" class="form-inline float-right mt--1 d-none d-md-flex">
    <button class="btn btn-info"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Back</button>
    </a>
        <h1 class="h3 mb-3"><b>Update locality</b></h1>

                    </div>
                                <div class="card">
                                
<div class="card-body">
     @if(!empty($record))
       {!! Form::model($record,array('url' => ['admin/locality', $record->id],'method'=>'PATCH','class'=>'','id' =>'comman_form_id','files'=>'true')) !!}
      
       @endif

                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail4">Select Country</label>
                                                    @if(!empty($countries))
                                                    {!!Form::select('country_id',$countries,null,array('class'=>'form-control selector select2','placeholder'=>'Select Country','data-toggle'=>'select2','autocomplete'=>'off','required')) !!}
                                                    @else
                                                     {!!Form::select('country_id',[],null,array('class'=>'form-control selector select2','placeholder'=>'Select Country','data-toggle'=>'select2','autocomplete'=>'off','required')) !!}
                                                    @endif
                                                </div>
                                                
                                          </div>

                                           <div class="form-row">
                                            
                                                <div class="form-group col-md-4">
                                                <label for="inputEmail4"> Select State</label>
                                                    @if(!empty($states))
                                                    {!!Form::select('state_id',$states,null,array('class'=>'form-control state_selector select2','placeholder'=>'Select State','id'=>'','data-toggle'=>'select2','autocomplete'=>'off','required')) !!}
                                                    @else
                                                    {!!Form::select('state_id',[],null,array('class'=>'form-control state_selector select2','placeholder'=>'Select State','id'=>'','data-toggle'=>'select2','autocomplete'=>'off','required')) !!}
                                                    @endif
                                                </div>
                                          </div>

                                        <div class="form-row">                                          
                                                <div class="form-group col-md-4">
                                                <label for="inputEmail4"> Select City</label>
                                                    @if(!empty($cities))
                                                    {!!Form::select('city_id',$cities,null,array('class'=>'form-control city_selector select2','placeholder'=>'Select city','id'=>'','data-toggle'=>'select2','autocomplete'=>'off','required')) !!}

                                                    @else
                                                    {!!Form::select('city_id',[],null,array('class'=>'form-control city_selector select2','placeholder'=>'Select city','id'=>'','data-toggle'=>'select2','autocomplete'=>'off','required')) !!}

                                                    @endif
                                                </div>
                                          </div>


                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail4">Enter Locality</label>                                                  
                                                    {!!Form::text('locality_name',null,array('class'=>'form-control','placeholder'=>'Enter locality','autocomplete'=>'off','required')) !!} 
                                                </div>
                                          </div>
                                              <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail4">Enter Pin/Zip or postal code</label>                                                  
                                                    {!!Form::text('pincode',null,array('class'=>'form-control','placeholder'=>'Enter locality','autocomplete'=>'off','required')) !!} 
                                                </div>
                                          </div>

        <button type="submit" class="btn btn-primary"><i class="far fa-edit"></i>  Update</button>

                                         
<a class="btn" href="{{url('admin/locality')}}" style="background-color: #9e9b9b;color: #fff"><i class="fas fa-times"></i>  Cancel</a>
                                            
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
                  $('select[name="state_id"]').empty();                 
                  $('select[name="state_id"]').append('<option value="'+''+'">'+'None'+'</option>');
                   $.each(data, function(key, value) { 
                  $('select[name="state_id"]').append('<option value="'+ key +'">'+value+'</option>');
                 });
                }

                });
                    }
            else{
                $('select[name="state_id"]').empty();
            }

        });
        });
   
</script>

@endpush