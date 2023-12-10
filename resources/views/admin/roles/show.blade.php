@extends('admin.layouts.app')

<!-- ................custom css................. -->

@section('customStyle')
@endsection

<!-- ................Add css link................. -->

@push('style')
@endpush

<!-- ................body...............    .. -->
@section('innercontent')

  <main class="content">
     <div class="container-fluid p-0">
<div class="clearfix">
    <a href="{{url('admin/roles')}}" class="form-inline float-right mt--1 d-none d-md-flex">
    <button class="btn btn-info"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Back</button>
    </a>
        <h1 class="h3 mb-3"><b>Roles</b></h1>

                    </div>
                   <div class="card">
  <div class="card-body">
    <fieldset class="scheduler-border">
  <legend class="scheduler-border">Role Information &nbsp;:</legend>
                      <div class="form-row">
                        
                         <div class="form-group col-md-4">
                          <div class="row">
                            <div class="col-md-4"><b>Created Date</b></div>
                            <div class="col-md-1"><b>:</b></div>
                            <div class="col-md-6">12-12-2020</div>
                          </div>         
                        </div>
                        
                         <div class="form-group col-md-4">
                          <div class="row">
                            <div class="col-md-4"><b>Last login</b></div>
                            <div class="col-md-1"><b>:</b></div>
                            <div class="col-md-6"> </div>
                          </div>         
                        </div>
                        <div class="form-group col-md-4">
                          <div class="row">
                            <div class="col-md-4"><b>Vendor Type</b></div>
                            <div class="col-md-1"><b>:</b></div>
                            <div class="col-md-6">11111</div>
                          </div>         
                        </div>
                        <div class="form-group col-md-4">
                          <div class="row">
                            <div class="col-md-4"><b>Shop Name</b></div>
                            <div class="col-md-1"><b>:</b></div>
                            <div class="col-md-6">22222 </div>
                          </div>         
                        </div>
                        <div class="form-group col-md-4">
                          <div class="row">
                            <div class="col-md-4"><b>Name</b></div>
                            <div class="col-md-1"><b>:</b></div>
                            <div class="col-md-6">2321312 </div>
                          </div>         
                        </div>
                                               
                        <div class="form-group col-md-4">
                          <div class="row">
                            <div class="col-md-4"><b>Contact No</b></div>
                            <div class="col-md-1"><b>:</b></div>
                            <div class="col-md-6">23221421 </div>
                          </div>         
                        </div>
                        <div class="form-group col-md-4">
                          <div class="row">
                            <div class="col-md-4"><b>Package</b></div>
                            <div class="col-md-1"><b>:</b></div>
                            <div class="col-md-6">23423424 </div>
                          </div>         
                        </div>
                         <div class="form-group col-md-4">
                          <div class="row">
                            <div class="col-md-4"><b>Login Id</b></div>
                            <div class="col-md-1"><b>:</b></div>
                            <div class="col-md-6">2432142 </div>
                          </div>         
                        </div>
                        <div class="form-group col-md-4">
                          <div class="row">
                            <div class="col-md-4"><b>City</b></div>
                            <div class="col-md-1"><b>:</b></div>
                            <div class="col-md-6">244234</div>
                          </div>         
                        </div>
                         <div class="form-group col-md-4">
                          <div class="row">
                            <div class="col-md-4"><b>Address</b></div>
                            <div class="col-md-1"><b>:</b></div>
                            <div class="col-md-6">42423</div>
                          </div>         
                        </div>
                       
                       
                                                
                        </div>
                 </fieldset>

</div></div>
</div>

                </main> 

@endsection

<!-- ................push new js link................. -->

@push('js')
@endpush