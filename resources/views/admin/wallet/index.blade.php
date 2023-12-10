@extends('admin.layouts.app')
@section('title',"All Wallet | admin Mande Clan")

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

            <h1 class="h3 mb-3">Wallet &nbsp;&nbsp;@if(!empty($records))({{$records->total()}})@endif</h1>
        </div>

        <div class="card">
            <div class="card-body">

<div class="contentbar">   
  <div class="card mb-5">
    <div class="card-body">
      <div class="row">
        <div class="form-group col-md-12">
          <label>Enable Wallet: </label>
          <br>
                                          <input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="Deactive" data-onstyle="success" data-offstyle="danger" id="1111" class="checkstatus" onchange="updateToggle(1111)">

          <br>
          <small class="text-muted"><i class="fa fa-question-circle"></i> It will activate the wallet on
              portal
          </small>
        </div>
        <div class="wallet-dashboard ">
          <h5 class="ml-md-3">Wallet States:</h5>
           
           
          <div class="row ml-1 mr-1">
            
            

            <div class="col-lg-12 col-xl-4 col-12">
              <div class="card m-b-30 bg-success-rgba shadow-sm">
                  <div class="card-body">
                      <div class="row">
                          <div class="col-9">
                              <h4>4</h4>
                              <p class="font-14 mb-0">Active Wallet Users</p>
                              
                          </div>
                          <div class="col-md-3 col-3">
                           <i class="text-success iconsize feather icon-bar-chart-line- "></i>
                          </div>
                          <div class="col-md-12 col-12">
                            <small class="text-muted">(Counted active wallet users ONLY)</small>
                          </div>
                          
                         
                        </div>
                        
                         
                        
                      </div>
                  </div>
            </div>
            <div class="col-md-4">
              <div class="card m-b-30 bg-danger-rgba shadow-sm">
                  <div class="card-body">
                      <div class="row align-items-center">
                          <div class="col-9">
                              <h4>4</h4>
                              <p class="font-14 mb-0">Total Wallet Users</p>
                            
                          </div>
                          <div class="col-md-3 col-3">
                             <i class="text-danger iconsize feather icon-users"></i>
                          </div>
                          <div class="col-md-12">
                            <small class="text-muted">(Counted active and deactive wallet users)</small>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card m-b-30 bg-warning-rgba shadow-sm">
                  <div class="card-body">
                      <div class="row align-items-center">
                          <div class="col-7">
                              <h4>46</h4>
                              <p class="font-14 mb-0">Wallet Transcations</p>
                            
                          </div>
                          <div class="col-5 text-right">
                            <i class=" text-warning iconsize feather icon-bar-chart-line"></i>
                        
                          </div>
                          <div class="col-md-12">
                            <small class="text-muted">(No of user wallet transcations made on mandeclan)</small>
                          </div>
        
                      </div>
                  </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card m-b-30 bg-primary-rgba shadow-sm">
                  <div class="card-body">
                      <div class="row align-items-center">
                          <div class="col-7">
                              <h4 class=" text-danger"><i class="fas fa-dollar-sign"></i> -876.13</h4>
                              <p class="font-14 mb-0">Overall Wallet balance</p>
                            
                          </div>
                          <div class="col-5 text-right">
                            <i class="text-primary iconsize feather icon-credit-card"></i>
                        
                          </div>
                          <div class="col-md-12">
                            <small class="text-muted">(Overall wallet balance of active wallet users)</small>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card m-b-30 bg-info-rgba shadow-sm">
                  <div class="card-body">
                      <div class="row align-items-center">
                          <div class="col-8">
                              <h4>0</h4>
                              <p class="font-14 mb-0">Total Wallet Orders</p>
                       
                          </div>
                          <div class="col-4 text-right">
                            <i class="text-info iconsize feather icon-shopping-cart"></i>
                        
                          </div>
                          <div class="col-md-12">
                            <small class="text-muted">(Total no. of orders made by wallet)</small>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
           
            <div class="col-lg-12">
              <hr>
              <h5 class="card-title">Order Wallet Report:</h5>
              <div class="table-responsive">
                <div id="wallet_logs_table_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer"><div id="wallet_logs_table_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="wallet_logs_table"></label></div><div id="wallet_logs_table_processing" class="dataTables_processing card" style="display: none;">Processing...</div><table id="wallet_logs_table" class="w-100 table table-bordered table-striped dataTable no-footer" role="grid" aria-describedby="wallet_logs_table_info" style="width: 975px;">
                  <thead>
                      <tr role="row"><th class="sorting" tabindex="0" aria-controls="wallet_logs_table" rowspan="1" colspan="1" aria-sort="descending" aria-label="#: activate to sort column ascending" style="width: 8.8px;">#</th><th class="sorting" tabindex="0" aria-controls="wallet_logs_table" rowspan="1" colspan="1" aria-label="TXN ID: activate to sort column ascending" style="width: 116.8px;">TXN ID</th><th class="sorting" tabindex="0" aria-controls="wallet_logs_table" rowspan="1" colspan="1" aria-label="Note: activate to sort column ascending" style="width: 204.8px;">Note</th><th class="sorting" tabindex="0" aria-controls="wallet_logs_table" rowspan="1" colspan="1" aria-label="Type: activate to sort column ascending" style="width: 28.8px;">Type</th><th class="sorting" tabindex="0" aria-controls="wallet_logs_table" rowspan="1" colspan="1" aria-label="Amount: activate to sort column ascending" style="width: 49.8px;">Amount</th><th class="sorting" tabindex="0" aria-controls="wallet_logs_table" rowspan="1" colspan="1" aria-label="Balance: activate to sort column ascending" style="width: 46.8px;">Balance</th><th class="sorting" tabindex="0" aria-controls="wallet_logs_table" rowspan="1" colspan="1" aria-label="Transcation Date: activate to sort column ascending" style="width: 90.8px;">Transcation Date</th><th class="sorting" tabindex="0" aria-controls="wallet_logs_table" rowspan="1" colspan="1" aria-label="Transcation Time: activate to sort column ascending" style="width: 91.8px;">Transcation Time</th></tr></thead>
                <tbody><tr role="row" class="odd"><td class="sorting_1">1</td><td><b>cashback_xacpjwPG</b></td><td><b>Cashback received on order 614c162b49f9d</b></td><td><p class="text-green"><b>Credit</b></p></td><td><p class="text-green"><b> + <i class="fas fa-dollar-sign"></i> 3.04 </b></p></td><td><p class="text-info"><b><i class="fas fa-dollar-sign"></i> 87.67 </b></p></td><td><b>30/09/2021</b></td><td><b>03:47 AM</b></td></tr><tr role="row" class="even"><td class="sorting_1">2</td><td><b>cashback_M8eG155E</b></td><td><b>Cashback received on order 6114eb71f167e</b></td><td><p class="text-green"><b>Credit</b></p></td><td><p class="text-green"><b> + <i class="fas fa-dollar-sign"></i> 8.42 </b></p></td><td><p class="text-info"><b><i class="fas fa-dollar-sign"></i> 84.63 </b></p></td><td><b>12/08/2021</b></td><td><b>12:23 PM</b></td></tr><tr role="row" class="odd"><td class="sorting_1">3</td><td><b>cashback_4mxgyAWU</b></td><td><b>Cashback received on order 6114a94a4fa39</b></td><td><p class="text-green"><b>Credit</b></p></td><td><p class="text-green"><b> + <i class="fas fa-dollar-sign"></i> 1.59 </b></p></td><td><p class="text-info"><b><i class="fas fa-dollar-sign"></i> 76.21 </b></p></td><td><b>12/08/2021</b></td><td><b>06:54 AM</b></td></tr><tr role="row" class="even"><td class="sorting_1">4</td><td><b>cashback_dGODx9iQ</b></td><td><b>Cashback received on order 6114a8c1d3b9c</b></td><td><p class="text-green"><b>Credit</b></p></td><td><p class="text-green"><b> + <i class="fas fa-dollar-sign"></i> 15 </b></p></td><td><p class="text-info"><b><i class="fas fa-dollar-sign"></i> 74.62 </b></p></td><td><b>12/08/2021</b></td><td><b>06:52 AM</b></td></tr><tr role="row" class="odd"><td class="sorting_1">5</td><td><b>cashback_EEwUkPw3</b></td><td><b>Cashback received on order 6113a9c70d339</b></td><td><p class="text-green"><b>Credit</b></p></td><td><p class="text-green"><b> + <i class="fas fa-dollar-sign"></i> 0.2 </b></p></td><td><p class="text-info"><b><i class="fas fa-dollar-sign"></i> 59.62 </b></p></td><td><b>11/08/2021</b></td><td><b>12:44 PM</b></td></tr><tr role="row" class="even"><td class="sorting_1">6</td><td><b>cashback_iWXgzjJu</b></td><td><b>Cashback received on order 611374a535511</b></td><td><p class="text-green"><b>Credit</b></p></td><td><p class="text-green"><b> + <i class="fas fa-dollar-sign"></i> 1.42 </b></p></td><td><p class="text-info"><b><i class="fas fa-dollar-sign"></i> 59.42 </b></p></td><td><b>11/08/2021</b></td><td><b>12:38 PM</b></td></tr><tr role="row" class="odd"><td class="sorting_1">7</td><td><b>cashback_KdOxid0L</b></td><td><b>Cashback received on order 611374a535511</b></td><td><p class="text-green"><b>Credit</b></p></td><td><p class="text-green"><b> + <i class="fas fa-dollar-sign"></i> 15 </b></p></td><td><p class="text-info"><b><i class="fas fa-dollar-sign"></i> 58 </b></p></td><td><b>11/08/2021</b></td><td><b>09:58 AM</b></td></tr><tr role="row" class="even"><td class="sorting_1">8</td><td><b>cashback_NNsqiKsC</b></td><td><b>Cashback received on order 611374a535511</b></td><td><p class="text-green"><b>Credit</b></p></td><td><p class="text-green"><b> + <i class="fas fa-dollar-sign"></i> 15 </b></p></td><td><p class="text-info"><b><i class="fas fa-dollar-sign"></i> 43 </b></p></td><td><b>11/08/2021</b></td><td><b>09:56 AM</b></td></tr><tr role="row" class="odd"><td class="sorting_1">9</td><td><b>cashback_kVag1Egz</b></td><td><b>Cashback received on order 611374a535511</b></td><td><p class="text-green"><b>Credit</b></p></td><td><p class="text-green"><b> + <i class="fas fa-dollar-sign"></i> 15 </b></p></td><td><p class="text-info"><b><i class="fas fa-dollar-sign"></i> 28 </b></p></td><td><b>11/08/2021</b></td><td><b>09:53 AM</b></td></tr><tr role="row" class="even"><td class="sorting_1">10</td><td><b>cashback_vNAaKp9K</b></td><td><b>Cashback received on order 610a656c17bb6</b></td><td><p class="text-green"><b>Credit</b></p></td><td><p class="text-green"><b> + <i class="fas fa-dollar-sign"></i> 3 </b></p></td><td><p class="text-info"><b><i class="fas fa-dollar-sign"></i> 13 </b></p></td><td><b>10/08/2021</b></td><td><b>02:27 PM</b></td></tr></tbody></table><div class="dataTables_info" id="wallet_logs_table_info" role="status" aria-live="polite">Showing 1 to 10 of 12 entries</div><div class="dataTables_paginate paging_simple_numbers" id="wallet_logs_table_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="wallet_logs_table_previous"><a href="#" aria-controls="wallet_logs_table" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li><li class="paginate_button page-item active"><a href="#" aria-controls="wallet_logs_table" data-dt-idx="1" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item "><a href="#" aria-controls="wallet_logs_table" data-dt-idx="2" tabindex="0" class="page-link">2</a></li><li class="paginate_button page-item next" id="wallet_logs_table_next"><a href="#" aria-controls="wallet_logs_table" data-dt-idx="3" tabindex="0" class="page-link">Next</a></li></ul></div></div>
              </div>
            </div>
          </div>
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
@endpush