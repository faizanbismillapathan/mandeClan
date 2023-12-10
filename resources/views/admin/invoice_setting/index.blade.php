@extends('admin.layouts.app')
@section('title',"All Invoice Setting | admin Mande Clan")

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

      <h1 class="h3 mb-3">Invoice Setting &nbsp;&nbsp;@if(!empty($records))({{$records->total()}})@endif</h1>
    </div>

    <div class="card">
      <div class="card-body">
        <div class="contentbar">
          <div class="row">
            <div class="col-lg-12">
              <div class="card m-b-30">
                <div class="card-header">
                  <h5 class="box-title">Edit Invoice Setting</h5>
                </div>
                <div class="card-body">
                  @if(!empty($record))
       {!! Form::model($record,array('url' => ['admin/invoice-setting', $record->id],'method'=>'PATCH','class'=>'','id' =>'comman_form_id','files'=>'true')) !!}
                  @else
                  {!!Form::open(['url'=>['admin/invoice-setting'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}
                  @endif


                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label" for="first-name">
                          Order Id Prefix:
                        </label>

                        {!!Form::text('order_id_prefix',null,array('class'=>'form-control','placeholder'=>'Enter Order Id Prefix','autocomplete'=>'off','required')) !!} 


                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label" for="first-name">
                          Order Id Postfix:
                        </label>

                        {!!Form::text('order_id_postfix',null,array('class'=>'form-control','placeholder'=>'Enter Order Id Prefix','autocomplete'=>'off','required')) !!} 


                      </div>
                    </div>


                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label" for="first-name">
                          Store Wise Order Id Prefix:
                        </label>

                        {!!Form::text('suborder_id_prefix',null,array('class'=>'form-control','placeholder'=>'Enter Order Id Prefix','autocomplete'=>'off','required')) !!} 


                      </div>
                    </div>



                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label" for="first-name">
                          Store Wise Order Id Postfix:
                        </label>

                        {!!Form::text('suborder_id_postfix',null,array('class'=>'form-control','placeholder'=>'Enter Order Id Prefix','autocomplete'=>'off','required')) !!} 


                      </div>
                    </div>



                 


    
                         <div class="form-group col-md-10">
                          <label for="inputPassword4">Store description</label>
                          {!! Form::textarea('invoice_terms',null,['class'=>'form-control textarea', 'rows' => 6, 'cols' => 50,'id'=>'']) !!}
                        </div>


                 <div class="form-group col-md-4 ">
                   <div class="form-group author-img-bx">

                    <label>Invoice Logo</label>             

                    <div class="fileupload fileupload-new" data-provides="fileupload">
                      <div class="fileupload-new img-thumbnail" style="width: 180px; height: 120px;">
                       @if(!empty($record->invoice_logo))
                                      <img src="{{ asset('public/images/invoice_setting/'.$record->invoice_logo)}}" alt="dd" />
    @else
                     <img src="{{ asset('public/img/no-image.png')}}" alt="dd" />

                     @endif
                     </div>
                     <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 180px; max-height: 120px; line-height: 20px;"></div>
                     <div class="row">
                       <div class="col-md-12">
                        <button type="button" class="btn btn-secondary" style="padding: 0px; background-color: #fff;"><span class="btn btn-default btn-file">
                          <span class="btn btn-secondary fileupload-new">Choose image</span>
                          <span  class="btn btn-secondary fileupload-exists">Change</span>

                          {{ Form::file('invoice_logo',null, ['class' => 'form-control','required']) }}</span>

                          <a class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a></button>

                        </div>

                      </div>
                    </div>
                  </div>

                </div>  


                <div class="form-group col-md-4 ">
                 <div class="form-group author-img-bx">

                  <label>Invoice Sign</label>             

                  <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-new img-thumbnail" style="width: 180px; height: 120px;">
                      @if(!empty($record->invoice_signature))
                                        <img src="{{ asset('public/images/invoice_setting/'.$record->invoice_signature)}}" alt="dd" />
  @else
                     <img src="{{ asset('public/img/no-image.png')}}" alt="dd" />

                     @endif
                   </div>
                   <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 180px; max-height: 120px; line-height: 20px;"></div>
                   <div class="row">
                     <div class="col-md-12">
                      <button type="button" class="btn btn-secondary" style="padding: 0px; background-color: #fff;"><span class="btn btn-default btn-file">
                        <span class="btn btn-secondary fileupload-new">Choose image</span>
                        <span  class="btn btn-secondary fileupload-exists">Change</span>

                        {{ Form::file('invoice_signature',null, ['class' => 'form-control','required']) }}</span>

                        <a class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a></button>

                      </div>

                    </div>
                  </div>
                </div>

              </div>


            </div>

   <button type="submit" class="btn btn-primary"><i class="far fa-edit"></i>  Update</button>


                                         
<a class="btn" href="{{url('admin/city')}}" style="background-color: #9e9b9b;color: #fff"><i class="fas fa-times"></i>  Cancel</a>
               

            {{Form::close()}}

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
<script type="text/javascript" src="{{ asset('public/js/bootstrap-fileupload.min.js') }}"></script>
<script src="{{asset('public/basic-ckeditor/ckeditor.js')}}"></script>
<script>
CKEDITOR.replace( 'invoice_terms');
</script>
@endpush