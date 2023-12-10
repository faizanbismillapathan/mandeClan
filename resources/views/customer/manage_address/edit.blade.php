@extends('customer.layouts.app')
@section('title',"Edit Manage Address | customer Mande Clan")

<!-- ................custom css................. -->

@section('customStyle')
@endsection

<!-- ................Add css link................. -->

@push('style')
<style type="text/css">
#mapCanvas,#map-canvas {
    width: 100%;
    height: 400px;

}
</style>
@endpush

<!-- ................body................. -->
@section('innercontent')

  
<main class="content">
                    <div class="container-fluid p-0">
<div class="clearfix">
    <a href="{{url('customer/manage-address')}}" class="form-inline float-right mt--1 d-none d-md-flex">
    <button class="btn btn-info"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Back</button>
    </a>
        <h1 class="h3 mb-3"><b>Update Manage Address</b></h1>

                    </div>
                                <div class="card">
                                
<div class="card-body">
     @if(!empty($record))
       {!! Form::model($record,array('url' => ['customer/manage-address', $record->id],'method'=>'PATCH','class'=>'','id' =>'customer_location_form','files'=>'true')) !!}
      
       @endif
<div class="form-row">
        <div class="form-group col-md-4">
        <label for="inputEmail4">Name</label>                                                   
        {!!Form::text('name',null,array('class'=>'form-control','placeholder'=>'Enter name','autocomplete'=>'off','required')) !!} 
        </div>

        <div class="form-group col-md-4">
        <label for="inputEmail4">Email Id</label>                                                   
        {!!Form::email('email',null,array('class'=>'form-control emailfull','placeholder'=>'Enter Email Id','autocomplete'=>'off','required')) !!} 
        </div>

        <div class="form-group col-md-4">
        <label for="inputEmail4">Mobile No</label>    
        <div class="input-group ">                                               
        {!!Form::text('mobile',Auth::user()->mobile,array('class'=>'form-control numbersOnly','placeholder'=>'','autocomplete'=>'off','required','id'=>'mobile_id','minlength'=>'10' ,'maxlength'=>'10')) !!} 
<input type="hidden" name="user_country_code" id="phone3" value="">
</div>
        </div>

        <div class="form-group col-md-4">
        <label for="inputEmail4">Phone No</label>                                                   
        {!!Form::text('phone',null,array('class'=>'form-control contact_no_validate','minlength'=>'10' ,'maxlength'=>'13','placeholder'=>'Enter Phone No','autocomplete'=>'off')) !!} 
        </div>

        <div class="form-group col-md-4">
        <label for="inputEmail4">Country</label>
        @if(!empty($countries))
        {!!Form::select('country',$countries,null,array('class'=>'form-control basemap select2 selector','placeholder'=>'','data-toggle'=>'select2','required')) !!}
        @endif
        </div>
        <div class="form-group col-md-4">
        <label for="inputEmail4">State</label>
      @if(!empty($states))

        {!!Form::select('state',$states,null,array('class'=>'form-control basemap select2 state_selector','placeholder'=>'','data-toggle'=>'select2','required')) !!}
@endif
        </div>

        <div class="form-group col-md-4">
        <label for="inputEmail4">City</label> 
              @if(!empty($cities))
                                                  
        {!!Form::select('city',$cities,null,array('class'=>'form-control basemap select2 city_selector','placeholder'=>'','data-toggle'=>'select2','required')) !!}
        @endif
        </div>

        <div class="form-group col-md-4">
        <label for="inputEmail4">Locality</label>  
              @if(!empty($localities))                                                 
        {!!Form::select('locality',$localities,null,array('class'=>'form-control basemap locality_selector select2','placeholder'=>'','data-toggle'=>'select2','required')) !!}
        @endif
        </div>


        <div class="form-group col-md-4">
        <label for="inputEmail4">PinCode</label>                                                   
        {!!Form::text('pincode',null,array('class'=>'form-control basemap','placeholder'=>'','autocomplete'=>'off','required','data-mask'=>'000000')) !!} 
        </div>
<input type="hidden" name="map_address" id="search-txt" value="">

        <div class="form-group col-md-3">
                        <label for="inputEmail4">Address 1</label>
                        {!!Form::text('address',null,array('class'=>'form-control basemap','placeholder'=>'Enter
                        Address','autocomplete'=>'off','required','id'=>'shopaddress')) !!}
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputEmail4">Address 2</label>
                        {!!Form::text('address_2',null,array('class'=>'form-control basemap','placeholder'=>
                        'Enter Address','autocomplete'=>'off','required','id'=>'shopaddress')) !!}
                    </div>

                     <div class="form-group col-md-1">

<button type="button" class="btn btn-info viewmodelwithmap "  id="search-btn" style="margin-top: 25px;" data-toggle="modal" data-target="#mainmapmodal"><i class="fa fa-map-marker"></i></button>
</div>
<div class="form-group col-md-2">
                          <label for="inputPassword2">Longitude</label>
                          {!!Form::text('longitude',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','id'=>'latitude')) !!} 
                        </div>

                        <div class="form-group col-md-2">
                          <label for="inputPassword2">Latitude</label>
                          {!!Form::text('latitude',null,array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','id'=>'langitude')) !!} 
                        </div>

        </div>

        <button type="submit" class="btn btn-primary"><i class="far fa-edit"></i>  Update</button>


                                         
<a class="btn" href="{{url('customer/manage-address')}}" style="background-color: #9e9b9b;color: #fff"><i class="fas fa-times"></i>  Cancel</a>
                                            
  {{Form::close()}}
</div>
</div>
</div>
</main>


 <div class="modal fade comman-modal" id="mainmapmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header no-modal-header">
             <h5>Select Longitude & Latitude</h5>
                <div class="close-btn">
                    <i class="far fa-times-circle" data-dismiss="modal" aria-label="Close"></i>
                </div>
          </div>
          <div class="modal-body"  id="bodyofmapmodal">
              {{-- <div id="mapCanvas"></div>
       <div id="infoPanel">
            <b>Marker status:</b>
            <div id="markerStatus"><i>Click and drag the marker.</i></div>
            <b>Current position:</b>
            <div id="info"></div>
            <b>Closest matching address:</b>
            <div id="address"></div>
           </div> --}}

<div id="map-canvas"></div>
<div id="map-output"></div>

          </div>
          <div class="modal-footer">
             <button type="button"  class="btn btn-info confirm_address_set_field" data-dismiss="modal">Address Set</button >
            <button type="button" class="btn btn-raised btn-danger" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>


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
          url: "{{url('customer/append_state')}}",
          type: "post",
          data: {id:countryID},
                    dataType: "json",
                    success:function(data) {
                        console.log(data);
                   $('select[name="state"]').empty();
              $('select[name="city"]').empty();
                $('select[name="locality"]').empty();
                $('input[name="pincode"]').val('');                
                  $('select[name="state"]').append('<option value="'+''+'">'+'None'+'</option>');
                   $.each(data, function(key, value) { 
                  $('select[name="state"]').append('<option value="'+ key +'">'+value+'</option>');
                 });
                }

                });
                    }
            else{
                $('select[name="state"]').empty();
              $('select[name="city"]').empty();
                $('select[name="locality"]').empty();
                $('input[name="pincode"]').empty();

            }

        });

// ...............................
        $('.state_selector').on('change', function() {
            var stateID = $(this).val();
            console.log(stateID);

            var data;
           if(stateID) {  
              $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});
                 $.ajax({
          url: "{{url('customer/append_city')}}",
          type: "post",
          data: {id:stateID},
                    dataType: "json",
                    success:function(data) {
                        console.log(data);
              $('select[name="city"]').empty();
                $('select[name="locality"]').empty();
                $('input[name="pincode"]').empty();

                  $('select[name="city"]').append('<option value="'+''+'">'+'None'+'</option>');
                   $.each(data, function(key, value) { 
                  $('select[name="city"]').append('<option value="'+ key +'">'+value+'</option>');
                 });
                }

                });
                    }
            else{
                             $('select[name="city"]').empty();
                $('select[name="locality"]').empty();
                $('input[name="pincode"]').empty();
            }

        });

// ...............................



        $('.city_selector').on('change', function() {
            var stateID = $(this).val();
            console.log(stateID);

            var data;
           if(stateID) {  
              $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});
                 $.ajax({
          url: "{{url('customer/append_locality')}}",
          type: "post",
          data: {id:stateID},
                    dataType: "json",
                    success:function(data) {
                        console.log(data);
            
                $('select[name="locality"]').empty();
                $('input[name="pincode"]').val(''); 

                  $('select[name="locality"]').append('<option value="'+''+'">'+'None'+'</option>');
                   $.each(data, function(key, value) { 
                  $('select[name="locality"]').append('<option value="'+ key +'">'+value+'</option>');
                 });
                }

                });
                    }
            else{
                          $('select[name="locality"]').empty();
                $('input[name="pincode"]').val(''); 
            }

        });



// ...............................

        $('.locality_selector').on('change', function() {
            var locality_id = $(this).val();
            console.log(locality_id);

            var data;
           if(locality_id) {  
              $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});
                 $.ajax({
          url: "{{url('customer/append_pincode')}}",
          type: "post",
          data: {id:locality_id},
                    dataType: "json",
                    success:function(data) {
                        console.log(data);
                                $('input[name="pincode"]').val(data);

                }

                });
                    }
            else{
                $('input[name="pincode"]').empty();
            }

        });




});



</script>


<link rel="stylesheet" type="text/css" href="{{ asset('public/build/css/intlTelInput.css') }}">


<script type="text/javascript" src="{{ asset('public/build/js/intlTelInput.js') }}"></script>


<script>


var input = document.querySelector("#mobile_id");
var iti = window.intlTelInputGlobals.getInstance(input);


window.intlTelInput(input, {
allowDropdown: true,

autoHideDialCode: false,
autoPlaceholder: "off",
// dropdownContainer: document.body,
// excludeCountries: ["us"],
formatondIsPlay: false,
// geoIpLookup: function(callback) {
//   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
//     var countryCode = (resp && resp.country) ? resp.country : "";
//     callback(countryCode);
//   });
// },
// hiddenInput: "full_number",
// initialCountry: "auto",
// localizedCountries: { 'de': 'Deutschland' },
nationalMode: false,
// onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
// placeholderNumberType: "MOBILE",
preferredCountries: ['in'],
separateDialCode: true,

utilsScript: "{{asset('public/build/js/utils.js')}}",

});

var iti = window.intlTelInputGlobals.getInstance(input);
var countryData = iti.getSelectedCountryData();
$("#phone3").val(countryData.dialCode)


input.addEventListener("countrychange", function() {

var countryData = iti.getSelectedCountryData();

$("#phone3").val(countryData.dialCode)

});

// ................................errorMsg
</script>


<script type="text/javascript">

    $(function () {

    $('.password_contact .basemap').on('change', maping_address)

  maping_address(); 

});



function maping_address() {


var country=$('select[name="country"]').select2('data');
var state=$('select[name="state"]').select2('data');
var city=$('select[name="city"]').select2('data');
var locality= $('select[name="locality"]').select2('data');
var pincode= $('input[name="pincode"]').val(); 

// $("#search-txt").val('');

// console.log(country[0].text,'country')
// console.log(state[0].text,'state')
// console.log(city[0].text,'city')
// console.log(locality[0].text,'locality')
// console.log(pincode[0].text,'pincode')

// var final=country[0].text+' '+state[0].text+' '+city[0].text+' '+locality[0].text+' '+pincode;

var final=locality[0].text+', '+city[0].text+', '+state[0].text+' '+pincode+', '+country[0].text;

console.log(final,'final')

$("#search-txt").val(final);

  loadmap(final); 


}

  function loadmap(final) {

        // alert(final)
      // initialize map
      var map = new google.maps.Map(document.getElementById("map-canvas"), {
        center: new google.maps.LatLng($('#latitude').val(), $('#langitude').val()),
        zoom: 13,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      });
      // initialize marker
      var marker = new google.maps.Marker({
        position: map.getCenter(),
        draggable: true,
        map: map
      });
      // intercept map and marker movements
      google.maps.event.addListener(map, "idle", function() {
        marker.setPosition(map.getCenter());
        document.getElementById("map-output").innerHTML = "Latitude:  " + map.getCenter().lat().toFixed(6) + "<br>Longitude: " + map.getCenter().lng().toFixed(6) + "<a href='https://www.google.com/maps?q=" + encodeURIComponent(map.getCenter().toUrlValue()) + "' target='_blank'>Go to maps.google.com</a>";


         $('#latitude').val( map.getCenter().lat().toFixed(6));
         $('#langitude').val(map.getCenter().lng().toFixed(6));


      });
      google.maps.event.addListener(marker, "dragend", function(mapEvent) {
        map.panTo(mapEvent.latLng);
      });
      // initialize geocoder
      var geocoder = new google.maps.Geocoder();

      google.maps.event.addDomListener(document.getElementById("search-btn"), "click", function() {

        // alert(1)
        geocoder.geocode({ address: document.getElementById("search-txt").value }, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
            var result = results[0];
            document.getElementById("shopaddress").value = result.formatted_address;
            if (result.geometry.viewport) {
              map.fitBounds(result.geometry.viewport);
            } else {
              map.setCenter(result.geometry.location);
            }
          } else if (status == google.maps.GeocoderStatus.ZERO_RESULTS) {
            alert("Sorry, geocoder API failed to locate the address.");
          } else {
            alert("Sorry, geocoder API failed with an error.");
          }
        });
      });
      google.maps.event.addDomListener(document.getElementById("search-txt"), "change", function(domEvent) {
        if (domEvent.which === 13 || domEvent.keyCode === 13) {
          google.maps.event.trigger(document.getElementById("search-btn"), "click");
        }
      });
      // initialize geolocation
      if (navigator.geolocation) {
        google.maps.event.addDomListener(document.getElementById("detect-btn"), "click", function() {
          navigator.geolocation.getCurrentPosition(function(position) {
            map.setCenter(new google.maps.LatLng(position.coords.latitude, position.coords.longitude));
          }, function() {
            alert("Sorry, geolocation API failed to detect your location.");
          });
        });
        document.getElementById("detect-btn").disabled = false;
      }
    }

</script>

<script src="//maps.googleapis.com/maps/api/js?v=3&amp;sensor=false&amp;key=AIzaSyBxm3cpfYPdG6Yk3Tv2yIrfBLtiKYlza5A&amp;callback=loadmap" defer></script>




 <script>
 document.addEventListener("DOMContentLoaded", function(event) {

    $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

    // alert('ddd')

    jQuery.validator.addMethod("mobile_country_code", function(value, element) {    
// var isSuccess = $("input[name='mobile']").val();
// if(isSuccess.indexOf(+91) == 1){
// return true;

// }else if(isSuccess.indexOf(+1) == 1){
// return false;
// }

var isSuccess = $("#phone3").val();
console.log(isSuccess)
if (isSuccess !='') {

  return true;
}else{

  return false;
}
}, "Please enter the  valid number with country code");
$('#customer_location_form').validate({

     rules: {
                  

                    'mobile': {
                      required: true,
                        minlength:10,
       
                 mobile_country_code : true

                    },
                    },

                    errorPlacement: function errorPlacement(error, element) {
                    var $parent = $(element).parents('.form-group');
                    // Do not duplicate errors
                    if ($parent.find('.jquery-validation-error').length) {
                      return;
                    }
                    $parent.append(
                      error.addClass('jquery-validation-error small form-text invalid-feedback')
                    );
                  },
                  highlight: function(element) {
                    var $el = $(element);
                    var $parent = $el.parents('.form-group');
                    $el.addClass('is-invalid');
                    // Select2 and Tagsinput
                    if ($el.hasClass('select2-hidden-accessible') || $el.attr('data-role') === 'tagsinput') {
                      $el.parent().addClass('is-invalid');
                    }
                  },
                  unhighlight: function(element) {
                    $(element).parents('.form-group').find('.is-invalid').removeClass('is-invalid');
                  },
                     messages: {  // <-- you must declare messages inside of "messages" option
     
          mobile:{
            minlength:"This field is required."                  
        }
    },


                   });

                 });
            </script>
@endpush