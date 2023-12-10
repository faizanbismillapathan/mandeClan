@extends('admin.layouts.app')
@section('title',"All Invoice Design | admin Mande Clan")

<!-- ................custom css................. -->

@section('customStyle')
@endsection

<!-- ................Add css link................. -->

@push('style')
@endpush

<!-- ................body................. -->
@section('innercontent')

<main class="content profile-order-history">
    <div class="container-fluid p-0">

        <div class="clearfix">

            <h1 class="h3 mb-3">Invoice Design &nbsp;&nbsp;@if(!empty($records))({{$records->total()}})@endif</h1>
        </div>

        <div class="card">
            <div class="card-body">
<div class="contentbar">
    <div class="row">

        <div class="col-lg-12">
                        <div class="card m-b-30">
               
                <div class="card-body">
                   
                       <form action="{{url('/')}}/admin/invoice/design" method="POST">
                           <input type="hidden" name="_token" value="sA7ntz1dHvzRSYy4bJwwLwzAlbimzECl2NkN11rY">
                           <div class="form-group">
                                <label>Show Logo in invoice :</label>
                                <br>
                                <input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="Deactive" data-onstyle="success" data-offstyle="danger" id="1111" class="checkstatus" onchange="updateToggle(1111)">

                          </div>

                          <div class="form-group">
                            <label>Show QR in invoice :</label>
                            <br>
                            <input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="Deactive" data-onstyle="success" data-offstyle="danger" id="1111" class="checkstatus" onchange="updateToggle(1111)">

                          </div>

                          <div class="form-group">
                            <label>Show VAT NO. in invoice :</label>
                            <br>
                           <input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="Deactive" data-onstyle="success" data-offstyle="danger" id="1111" class="checkstatus" onchange="updateToggle(1111)">

                          </div>

                          <div class="form-group">
                            <label>Print default in Landscape mode :</label>
                            <br>
                           <input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="Deactive" data-onstyle="success" data-offstyle="danger" id="1111" class="checkstatus" onchange="updateToggle(1111)">

                          </div>

                          <div class="form-row">
                            <div class="col-4 form-group">
                                <label>
                                    Border Radius:
                                </label>
                                <div class="input-group">
                                   <input value="2" class="form-control" type="number" min="0" name="border_radius">
                                    <div class="input-group-text">
                                        px
                                    </div>
                                </div>
                            </div>

                            <div class="col-4 form-group">
                                <label>
                                    Border Color:
                                </label>
                                <div class="input-group initial-color colorpicker-element" title="Choose border color" data-colorpicker-id="1">
                                    <input value="#141EE3" type="color" class="form-control input-lg" name="border_color" placeholder="#000000">
                                    <span class="input-group-append">
                                        <span class="input-group-text colorpicker-input-addon" data-original-title="" title="" tabindex="0"><i style="background: rgb(20, 30, 227);"></i></span>
                                    </span>
                                </div>
                            </div>

                            <div class="col-4 form-group">
                                <label>
                                    Border Style:
                                </label>
                   {!!Form::select('store_category',['Dashed','Solid'],null,array('class'=>'form-control select2 ','placeholder'=>'Choose border style','data-toggle'=>'select2','required')) !!}
                                 
                                
                            </div>

                            <div class="col-4 form-group">
                                <label>
                                    Invoice date format:
                                </label>
                      {!!Form::select('store_category',['Choose date format','Y-m-d','d-m-Y','d/m/Y','d M, Y','jS M Y'],null,array('class'=>'form-control select2 ','placeholder'=>'Choose border style','data-toggle'=>'select2','required')) !!}

                                    
                                
                            </div>

                          </div>

                          <div class="form-group col-12">
                            <button disabled="" title="This operation is disabled is demo !" class="btn btn-danger"><i class="fa fa-ban"></i> Reset</button>
                            <button disabled="" title="This operation is disabled is demo !" class="btn btn-primary"><i class="fa fa-check-circle"></i>
                                Update</button>
                        </div>

                       </form>


                </div>

                
            </div>
        </div>
    </div>
</div>
            </div>
        </div>


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