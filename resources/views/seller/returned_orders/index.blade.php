@extends('seller.layouts.app')
@section('title',"All Returned Orders | seller Mande Clan")

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

            <h1 class="h3 mb-3">Returned Orders &nbsp;&nbsp;@if(!empty($records))({{$records->total()}})@endif</h1>
        </div>

        <div class="card">
            <div class="card-body">

<div class="contentbar">
    <div class="row">
          
   
        <div class="col-lg-12">
        
            <div class="card m-b-30">
        
                    <div class="card-header">
                        <h5 class="card-box">Retured Orders</h5>
                    </div> 
                
                
                    <div class="card-body">
                        <ul class="nav nav-tabs custom-tab-line mb-3" id="defaultTabLine" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab-line" data-content="If order have only 1 item than its count in single canceled orders." data-toggle="tab" href="#home-line" role="tab" aria-controls="home-line" aria-selected="true"><i class="feather icon-truck mr-2"></i>
                                    Return Completed </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab-line" data-content="If order have more than 1 item than its count in Bulk canceled orders." data-toggle="tab" href="#profile-line" role="tab" aria-controls="profile-line" aria-selected="false"><i class="feather icon-truck mr-2"></i>
                                    Pending Returns </a>
                            </li>
                            
                        </ul>
                        <div class="tab-content" id="defaultTabContentLine">
                            <div class="tab-pane fade show active" id="home-line" role="tabpanel" aria-labelledby="home-tab-line">
                                <div class="table-responsive">
                                    <table id="full_detail_table2" class="table table-striped table-bordered">
                                        <thead>
                                        
                                            <tr><th>
                                                #
                                            </th>
                                            <th>
                                                Order ID
                                            </th>
                                            <th>
                                                Item
                                            </th>
                                            <th>
                                                Refunded Amount
                                            </th>
                                            <th>
                                                Refund Status
                                            </th>
                
                                        </tr></thead>
                                        <tbody>
                                                    
                                        </tbody>
                                    </table>                  
                                </div><!-- table-responsive div end -->
                            </div><!-- card body end -->
                    
                            <div class="tab-pane fade" id="profile-line" role="tabpanel" aria-labelledby="profile-tab-line">
        
                                <div class="table-responsive">
                                    <div id="full_detail_table_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer"><div class="row"></div><div class="row"><div class="col-md-4"><div class="dataTables_length" id="full_detail_table_length"><label>Show <select name="full_detail_table_length" aria-controls="full_detail_table" class="form-control form-control-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div></div><div class="col-md-4"><div class="dt-buttons btn-group"><a class="btn btn-secondary buttons-print" tabindex="0" aria-controls="full_detail_table" href="#"><span>Print</span></a><a class="btn btn-secondary buttons-csv buttons-html5" tabindex="0" aria-controls="full_detail_table" href="#"><span>CSV</span></a><a class="btn btn-secondary buttons-collection dropdown-toggle buttons-colvis" tabindex="0" aria-controls="full_detail_table" href="#"><span>Column visibility</span></a></div></div><div class="col-md-4"><div id="full_detail_table_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="full_detail_table"></label></div></div></div><table id="full_detail_table" class="w-100 table table-striped table-bordered dataTable no-footer dtr-inline" role="grid" style="width: 0px;">
                                        <thead>
                                            <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="full_detail_table" rowspan="1" colspan="1" style="width: 0px;" aria-sort="ascending" aria-label="
                                                #
                                            : activate to sort column descending">
                                                #
                                            </th><th class="sorting" tabindex="0" aria-controls="full_detail_table" rowspan="1" colspan="1" style="width: 0px;" aria-label="
                                                Order TYPE
                                            : activate to sort column ascending">
                                                Order TYPE
                                            </th><th class="sorting" tabindex="0" aria-controls="full_detail_table" rowspan="1" colspan="1" style="width: 0px;" aria-label="
                                                OrderID
                                            : activate to sort column ascending">
                                                OrderID
                                            </th><th class="sorting" tabindex="0" aria-controls="full_detail_table" rowspan="1" colspan="1" style="width: 0px;" aria-label="
                                                Pending Amount
                                            : activate to sort column ascending">
                                                Pending Amount
                                            </th><th class="sorting" tabindex="0" aria-controls="full_detail_table" rowspan="1" colspan="1" style="width: 0px;" aria-label="
                                                Requested By
                                            : activate to sort column ascending">
                                                Requested By
                                            </th><th class="sorting" tabindex="0" aria-controls="full_detail_table" rowspan="1" colspan="1" style="width: 0px;" aria-label="
                                                Requested on
                                            : activate to sort column ascending">
                                                Requested on
                                            </th></tr></thead>
                                        
                                        <tbody>
                                                                                    <tr class="odd"><td valign="top" colspan="6" class="dataTables_empty">No data available in table</td></tr></tbody>
                                    
                                    </table><div class="row"><div class="col-sm-12"><div class="dataTables_paginate paging_simple_numbers" id="full_detail_table_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="full_detail_table_previous"><a href="#" aria-controls="full_detail_table" data-dt-idx="0" tabindex="0" class="page-link"><i class="fa fa-angle-left"></i></a></li><li class="paginate_button page-item next disabled" id="full_detail_table_next"><a href="#" aria-controls="full_detail_table" data-dt-idx="1" tabindex="0" class="page-link"><i class="fa fa-angle-right"></i></a></li></ul></div></div></div></div>                  
                                </div>
                            </div>
                    </div>
            </div>
        </div>
    </div>
</div>

    

         <!-- Start Footerbar -->
    <div class="footerbar">
        <footer class="footer">
            <p class="mb-0">
                © 2021 | mandeclan | All Right Reserved
                <span class="pull-right"><b>v 2.9 (release 2.9.1)</b>
            </span></p>
        </footer>
    </div>
       
  
  
    
    <!-- End Footerbar -->
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