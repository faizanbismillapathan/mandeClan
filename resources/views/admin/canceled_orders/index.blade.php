@extends('admin.layouts.app')
@section('title',"All Caceled Orders | admin Mande Clan")

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

            <h1 class="h3 mb-3">Caceled Orders &nbsp;&nbsp;@if(!empty($records))({{$records->total()}})@endif</h1>
        </div>

        <div class="card">
            <div class="card-body">

<div class="contentbar">
  <div class="row">
        <div class="col-lg-12">
        <div class="card m-b-30">
            <div class="card-header">
            <h5>Canceled Orders</h5>
            </div>
            <div class="card-body">
                <div class="card m-b-30">
                    <div class="row">
                        
                        <div class="col-md-12 ">
                            <div class="p-2 rounded mb-2 bg-success text-white">
                            <i class="fa fa-info-circle"></i> Note :
                            <ul>
                                <li>COD Orders are only viewable !</li>
                                <li>For Prepaid canceled orders with refund method choosen Bank You can View Details IF refund is complete.</li>
                                <li>For Prepaid canceled orders with refund method choosen orignal you can track refund status LIVE from respective Payment gateway &amp; Update TXN/REF ID.
                                </li>
                            </ul>
                           </div>
                        </div>
                    </div>
                        
                    
                    
                    
                    
                        <ul class="nav nav-tabs custom-tab-line mb-3" id="defaultTabLine" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab-line" data-content="If order have only 1 item than its count in single canceled orders." data-toggle="tab" href="#home-line" role="tab" aria-controls="home-line" aria-selected="true"><i class="feather icon-truck mr-2"></i>
                                    Single Canceled Orders  </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab-line" data-content="If order have more than 1 item than its count in Bulk canceled orders." data-toggle="tab" href="#profile-line" role="tab" aria-controls="profile-line" aria-selected="false"><i class="feather icon-truck mr-2"></i>
                                    Bulk Canceled Orders </a>
                            </li>
                            
                        </ul>

                        <div class="tab-content" id="defaultTabContentLine">
                            <div class="tab-pane fade active show" id="home-line" role="tabpanel" aria-labelledby="home-tab-line">
                                <div id="full_detail_table_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer"><div class="row"></div><div class="row"><div class="col-md-4"><div class="dataTables_length" id="full_detail_table_length"><label>Show <select name="full_detail_table_length" aria-controls="full_detail_table" class="form-control form-control-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div></div><div class="col-md-4"><div class="dt-buttons btn-group"><a class="btn btn-secondary buttons-print" tabindex="0" aria-controls="full_detail_table" href="#"><span>Print</span></a><a class="btn btn-secondary buttons-csv buttons-html5" tabindex="0" aria-controls="full_detail_table" href="#"><span>CSV</span></a><a class="btn btn-secondary buttons-collection dropdown-toggle buttons-colvis" tabindex="0" aria-controls="full_detail_table" href="#"><span>Column visibility</span></a></div></div><div class="col-md-4"><div id="full_detail_table_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="full_detail_table"></label></div></div></div><table id="full_detail_table" class="w-100 table table-bordered dataTable no-footer dtr-inline collapsed" role="grid" style="width: 982px;">
                                    <thead>

                                        <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="full_detail_table" rowspan="1" colspan="1" style="width: 16.8px;" aria-sort="ascending" aria-label="
                                            #
                                        : activate to sort column descending">
                                            #
                                        </th><th class="sorting" tabindex="0" aria-controls="full_detail_table" rowspan="1" colspan="1" style="width: 84.8px;" aria-label="
                                            Order TYPE
                                        : activate to sort column ascending">
                                            Order TYPE
                                        </th><th class="sorting" tabindex="0" aria-controls="full_detail_table" rowspan="1" colspan="1" style="width: 72.8px;" aria-label="
                                            ORDER ID
                                        : activate to sort column ascending">
                                            ORDER ID
                                        </th><th class="sorting" tabindex="0" aria-controls="full_detail_table" rowspan="1" colspan="1" style="width: 179.8px; display: none;" aria-label="
                                            REASON for Cancellation
                                        : activate to sort column ascending">
                                            REASON for Cancellation
                                        </th><th class="sorting" tabindex="0" aria-controls="full_detail_table" rowspan="1" colspan="1" style="width: 128.8px; display: none;" aria-label="
                                            REFUND METHOD
                                        : activate to sort column ascending">
                                            REFUND METHOD
                                        </th><th class="sorting" tabindex="0" aria-controls="full_detail_table" rowspan="1" colspan="1" style="width: 84.8px; display: none;" aria-label="
                                            CUSTOMER
                                        : activate to sort column ascending">
                                            CUSTOMER
                                        </th><th class="sorting" tabindex="0" aria-controls="full_detail_table" rowspan="1" colspan="1" style="width: 118.8px; display: none;" aria-label="
                                            REFUND STATUS
                                        : activate to sort column ascending">
                                            REFUND STATUS
                                        </th></tr></thead>

                                    <tbody>
                                                                            <tr class="odd"><td valign="top" colspan="7" class="dataTables_empty">No data available in table</td></tr></tbody>
                                </table><div class="row"><div class="col-sm-12"><div class="dataTables_paginate paging_simple_numbers" id="full_detail_table_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="full_detail_table_previous"><a href="#" aria-controls="full_detail_table" data-dt-idx="0" tabindex="0" class="page-link"><i class="fa fa-angle-left"></i></a></li><li class="paginate_button page-item next disabled" id="full_detail_table_next"><a href="#" aria-controls="full_detail_table" data-dt-idx="1" tabindex="0" class="page-link"><i class="fa fa-angle-right"></i></a></li></ul></div></div></div></div>
                            </div>
                                        
                            <div class="tab-pane fade" id="profile-line" role="tabpanel" aria-labelledby="profile-tab-line">
                                <table id="full_detail_table2" class="w-100 table table-striped table-bordered table-responsive">
                                    <thead>
                                        <tr><th>
                                            #
                                        </th>
                                        <th>
                                            Order TYPE
                                        </th>
                                        <th>
                                            Order ID
                                        </th>
                                        <th>
                                            REASON for Cancellation
                                        </th>
                                        <th>
                                            REFUND METHOD
                                        </th>
                                        <th>
                                            CUSTOMER
                                        </th>
                                        <th>
                                            REFUND STATUS
                                        </th>
                                    </tr></thead>

                                    <tbody>
                                                                            </tbody>
                                </table>
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