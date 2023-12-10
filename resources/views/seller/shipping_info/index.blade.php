@extends('seller.layouts.app')
@section('title',"All Available Shipping Methods
 | seller Mande Clan")

<!-- ................custom css................. -->

@section('customStyle')
@endsection

<!-- ................Add css link................. -->

@push('style')
       <link rel="stylesheet" href="{{asset('public/css/bootstrap-fileupload.css')}}">

@endpush

<!-- ................body................. -->
@section('innercontent')

<main class="content profile-order-history">
    <div class="container-fluid p-0">

        <div class="clearfix">

            <h1 class="h3 mb-3">Available Shipping Methods
 &nbsp;&nbsp;@if(!empty($records))({{$records->total()}})@endif</h1>
        </div>

<div class="contentbar">                
  <!-- Start row -->
  <div class="row">
            <div class="mb-2 col-lg-6">
      <div class="card">
        <div class="card-body">
          <div class="row">
            
            <div class="col-lg-12">
              <h5>Free Shipping :-
                                <span class="badge badge-primary float-right">
                  Default
                </span>
            </h5>
              
              
              
              <div class="text-center">
                
                                  <h6>
                    <p class="text-muted">
                      Free Shipping not need any price changes when item is shipped  with this method there is no shipping charge will apply.
                    </p>
                  </h6>
                
                              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
                  <div class="mb-2 col-lg-6">
      <div class="card">
        <div class="card-body">
          <div class="row">
            
            <div class="col-lg-12">
              <h5>Local Pickup :-
                </h5>
              
              
              
              <div class="text-center">
                                  <h6>
                    <p class="text-muted">Price:
                    <i class="fa fa fa-dollar"></i>
                    50</p>
                    
                    <p class="text-muted"><i class="feather icon-alert-circle"></i> Price Can be changed by seller.</p>
                                          <p class="text-muted"><i class="feather icon-alert-circle"></i> Localpick up will choosen by user at time of order review.</p>
                                                          </h6>
                
                
                              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
                  <div class="mb-2 col-lg-6">
      <div class="card">
        <div class="card-body">
          <div class="row">
            
            <div class="col-lg-12">
              <h5>Flat Rate :-
                </h5>
              
              
              
              <div class="text-center">
                                  <h6>
                    <p class="text-muted">Price:
                    <i class="fa fa fa-dollar"></i>
                    12</p>
                    
                    <p class="text-muted"><i class="feather icon-alert-circle"></i> Price Can be changed by seller.</p>
                                                              <p class="text-muted"><i class="feather icon-alert-circle"></i> Any item shipped with this method means global shipping charge will apply on all products.</p>
                                      </h6>
                
                
                              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
                            <div class="mb-2 col-lg-6">
      <div class="card">
        <div class="card-body">
          <div class="row">
            
            <div class="col-lg-12">
              <h5>Shipping Price :-
                </h5>
              
              
              
              <div class="text-center">
                
                
                                  <h6 class="text-muted">
                    Shipping Price mean Shipping price by weight
                  </h6>

                  <div class="box-footer">
                    <a role="button" class="pointer" data-toggle="modal" data-target=".bd-example-modal-lg">
                      View more here shipping price by weight
                    </a>
                  </div>
                              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
            
    <!-- End col -->
    <!-- Start col -->
    
    
  </div>
  <!-- End row -->
</div>
    <!--     <div class="card">
            <div class="card-body">
<div class="row">
        
        

            </div>
  <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i>   Submit</button>


                                         
                         
            </div>
        </div>
 -->

    </div>     

</main> 


@endsection

<!-- ................push new js link................. -->

@push('js')
<script src="{{asset('public/js/comman.js')}}"></script>
<script src="{{asset('public/basic-ckeditor/ckeditor.js')}}"></script>
<script>
CKEDITOR.replace( 'store_description');
</script>
@endpush