@extends('admin.layouts.app')
@section('title',"Create New City | Admin Mande Clan")

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
    <a href="{{url('admin/city')}}" class="form-inline float-right mt--1 d-none d-md-flex">
    <button class="btn btn-info"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Back</button>
    </a>

        <h1 class="h3 mb-3"><b>Create City</b></h1>

                    </div>
                                <div class="card">
                                
<div class="card-body">
     
             {!!Form::open(['url'=>['admin/city'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}
    
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
                                                    
                                                    {!!Form::select('state_id',[],null,array('class'=>'form-control select2','placeholder'=>'Select State','id'=>'','data-toggle'=>'select2','autocomplete'=>'off','required')) !!}
                                                </div>
                                          </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail4">Enter City</label>                                                   
                                                    {!!Form::text('city_name',null,array('class'=>'form-control','placeholder'=>'Enter city','autocomplete'=>'off','required')) !!} 
                                                </div>
                                          </div>

       <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i>   Submit</button>


                                         
<a class="btn" href="{{url('admin/city')}}" style="background-color: #9e9b9b;color: #fff"><i class="fas fa-times"></i>  Cancel</a>
                                            
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