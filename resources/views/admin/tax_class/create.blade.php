@extends('admin.layouts.app')
@section('title',"Create New Tax Class | Admin Mande Clan")

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
    <a href="{{url('admin/tax-class')}}" class="form-inline float-right mt--1 d-none d-md-flex">
    <button class="btn btn-info"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Back</button>
    </a>

        <h1 class="h3 mb-3"><b>Create Tax Class</b></h1>

                    </div>
                                <div class="card">
                                
<div class="card-body">
     
             {!!Form::open(['url'=>['admin/tax-class'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}
    
              
                <input type="hidden" name="_token" value="gwNmYvVUoSEbLYA0Y1PpI4wHVPdbNiaP1Q6ZyZXS">
                <div class="row">
                  <div class="form-group col-md-6">
                    <label>
                      Tax Class Title <span class="required">*</span>
                    </label>
                    <input placeholder="Please enter tax class" type="text" name="title" id="titles" class="form-control">
                  </div>
                 
                  <div class="form-group col-md-6">
                    <label>
                      Description <span class="required">*</span><br>
                    </label>
                    <input placeholder="Please enter tax class description" type="text" name="des" id="des" class="form-control">
                  </div>
                </div>
                
                <fieldset>
                  <h4>Tax Rates :</h4>
                    <table id="full_detail_tables" class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr class="table-heading-row">
                            <th>Tax Rate</th>
                            <th>Based On</th>
                            <th>Priority</th>
                        </tr>
                      </thead>
                      <tbody class="xyz">
                      
                      <tr id="count1"><td><div class="form-group select2"><div class="col-md-12 col-sm-12 col-xs-12"> {!!Form::select('store_category',['United Tax'],null,array('class'=>'form-control select2 ','placeholder'=>'Select Category','data-toggle'=>'select2','required')) !!}</div></div></td><td><div class="form-group"><div class="col-md-12 col-sm-12 col-xs-12 select2"> {!!Form::select('store_category',['Billing Address','Store Address'],null,array('class'=>'form-control select2 ','placeholder'=>'Select Category','data-toggle'=>'select2','required')) !!}</div></div></td> <td><div class="form-group"><div class="col-md-12 col-sm-12 col-xs-12"><input type="text" id="priority1" name="priority" class="form-control col-md-7 col-xs-12"></div></div></td><td><a onclick="removeRow('count1')" class="btn btn-danger owtbtn"><i class="fa fa-minus-circle"></i></a></td></tr><tr id="count2"><td><div class="form-group select2"><div class="col-md-12 col-sm-12 col-xs-12"> {!!Form::select('store_category',['United Tax'],null,array('class'=>'form-control select2 ','placeholder'=>'Select Category','data-toggle'=>'select2','required')) !!}</div></div></td><td><div class="form-group"><div class="col-md-12 col-sm-12 col-xs-12 select2"> {!!Form::select('store_category',['Billing Address','Store Address'],null,array('class'=>'form-control select2 ','placeholder'=>'Select Category','data-toggle'=>'select2','required')) !!}</div></div></td> <td><div class="form-group"><div class="col-md-12 col-sm-12 col-xs-12"><input type="text" id="priority2" name="priority" class="form-control col-md-7 col-xs-12"></div></div></td><td><a onclick="removeRow('count2')" class="btn btn-danger owtbtn"><i class="fa fa-minus-circle"></i></a></td></tr></tbody>
                      <tfoot>
                        <tr>
                          <td colspan="3"></td>
                          <td class="text-left"><button type="button" onclick="addRow();" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Add Rule"><i class="fa fa-plus-circle"></i></button></td>
                        </tr>
                      </tfoot>
                    </table>
                </fieldset>
         
               
            <!-- /.box -->
             
       <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i>   Submit</button>


                                         
<a class="btn" href="{{url('admin/tax-class')}}" style="background-color: #9e9b9b;color: #fff"><i class="fas fa-times"></i>  Cancel</a>
                                            
  {{Form::close()}}
</div>
</div>
</div>
</main>
@endsection

<!-- ................push new js link................. -->

@push('js')
 <script src="{{asset('public/js/validation.js')}}"></script>


@endpush