@extends('admin.layouts.app')
@section('title',"Edit Tax Class | Admin Mande Clan")

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
        <h1 class="h3 mb-3"><b>Update Tax Class</b></h1>

                    </div>
                                <div class="card">
                                
<div class="card-body">
     @if(!empty($record))
       {!! Form::model($record,array('url' => ['admin/tax-class', $record->id],'method'=>'PATCH','class'=>'','id' =>'comman_form_id','files'=>'true')) !!}
      
       @endif
                                            
                                            <div class="row">
    <div class="col-lg-12">
        <div class="card m-b-30">
            <div class="card-header">
              <h5 class="card-title"> Edit Tax Classes</h5>
            </div>
            <div class="card-body">
              <h4>Tax Class :</h4>
              <form class="form-horizontal form-label-left" method="post">
                <input type="hidden" name="_token" value="gwNmYvVUoSEbLYA0Y1PpI4wHVPdbNiaP1Q6ZyZXS">
                <div class="row">
                  <div class="form-group col-md-6">
                    <label>
                      Tax Class Title <span class="required">*</span>
                    </label>
                  
                      <input placeholder="Please enter Tax class" value="US Tax" type="text" name="title" id="titles" class="form-control">
                    
                  </div>
                  <div class="form-group col-md-6">
                    <label>
                      Description <span class="required">*</span>
                    </label>
                     
                        <input placeholder="Please enter Tax class" value="United States Tax" type="text" name="des" id="des" class="form-control">
                        
                      
                  </div>
                </div>
                      
                  
                        
                     

                          
                        
              
                <fieldset>
                  <h4>Tax Rates : </h4>
                  <table id="full_detail_tables" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr class="table-heading-row">
                          <th>Tax Rate <span type="button" class="text-danger i-iconsize" data-toggle="tooltip" data-placement="top" title="" data-original-title="You Want to Choose Tax Class Then Apply same Tax Class And Tax Rate .">
                              <i class="feather icon-alert-circle"></i>
                            </span>
                          </th>

                       
                            
                                
                            
                           


                          <th>Based On
                            <span type="button" class="text-danger i-iconsize" data-toggle="tooltip" data-placement="top" title="" data-original-title="You Want To Choose Billing address.. 
                            Then Billing Address And Zone Address Are Same Then Tax Will Be Applied,And You Will Be Choose Store Address then Store Addrss And User Billing Address Is Same Then Tax Will Be Apply  .">
                              <i class="feather icon-alert-circle"></i>
                            </span> 
                          </th>
                            
                            
                          <th>Priority 
                            <span type="button" class="text-danger i-iconsize" data-toggle="tooltip" data-placement="top" title="" data-original-title="1 Priority Is Higher Priority And All Numeric Number Is Lowest Priority,
                            Priority Are Accept Is Numeric Number.">
                              <i class="feather icon-alert-circle"></i>
                            </span> 
                           </th>
                    </tr>
                  </thead>
                  <tbody class="xyz">
                    
                 
                            
                                            
                      
                        <tr id="count1">
                          <td>

                            <div class="form-group">
                              <div class="col-12">
                                              {!!Form::select('store_category',['United Tax'],null,array('class'=>'form-control select2 ','placeholder'=>'Select Category','data-toggle'=>'select2','required')) !!}

                              </div>
                            </div>
                          </td>
                          
                                
                            <td>
                            
                          
                              
                              <div class="form-group">
                                <div class="col-md-12">
                                                   {!!Form::select('store_category',['Billing Address','Store Address'],null,array('class'=>'form-control select2 ','placeholder'=>'Select Category','data-toggle'=>'select2','required')) !!}

                                </div>
                              </div>
                              
                            </td>
                            <input type="hidden" id="ids" value="3">
                            <td>
                              <div class="form-group">
                                <div class="col--12">
                                  <input type="text" id="priority1" value="1" name="priority" class="form-control">
                                </div>

                              </div>
                            </td>
                            <td>
                              <a onclick="removeRow('count1')" class="btn btn-danger owtbtn"><i class="fa fa-minus-circle"></i></a>
                            </td>
                          </tr>
                                                        
                                                  
                      
                        <tr id="count2">
                          <td>

                            <div class="form-group">
                              <div class="col-12">
                                         {!!Form::select('store_category',['United Tax'],null,array('class'=>'form-control select2 ','placeholder'=>'Select Category','data-toggle'=>'select2','required')) !!}

                              </div>
                            </div>
                          </td>
                          
                                
                            <td>
                            
                          
                              
                              <div class="form-group">
                                <div class="col-md-12">
                                                   {!!Form::select('store_category',['Billing Address','Store Address'],null,array('class'=>'form-control select2 ','placeholder'=>'Select Category','data-toggle'=>'select2','required')) !!}

                                </div>
                              </div>
                              
                            </td>
                            <input type="hidden" id="ids" value="3">
                            <td>
                              <div class="form-group">
                                <div class="col--12">
                                  <input type="text" id="priority2" value="2" name="priority" class="form-control">
                                </div>

                              </div>
                            </td>
                            <td>
                              <a onclick="removeRow('count2')" class="btn btn-danger owtbtn"><i class="fa fa-minus-circle"></i></a>
                            </td>
                          </tr>
                                                        
                                                                                  
                          </tbody>
                          <tfoot>
                            <tr>
                              <td colspan="3"></td>
                              <td class="text-left"><button type="button" onclick="addRow();" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Add Rule"><i class="fa fa-plus-circle"></i></button></td>
                            </tr>
                          </tfoot>
                            </table>
                  
                      
                      
                            
                        </fieldset>
                        <button type="reset" class="btn btn-danger mr-1"><i class="fa fa-ban"></i> Reset</button>
                        <!-- <a onclick="UpdateFormData();" class="btn btn-primary">
                          <i class="fa fa-check-circle mr-2"></i>Update
                        </a> -->
                                <button type="submit" class="btn btn-primary"><i class="far fa-edit"></i>  Update</button>

                        <div id="msg"></div>
                        </form>
                      <!-- /.box -->
                      </div>
                  </div>
     </div>
     <!-- End col -->
 </div>



                                         
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