@extends('servicepartner.layouts.app')
@section('title',"All Today Earning | Service Partner Mande Clan")

<!-- ................custom css................. -->

@section('customStyle')
<style type="text/css">
    .h4{
 font-size: 35px;   
}
</style>
@endsection

<!-- ................Add css link................. -->

@push('style')
@endpush

<!-- ................body................. -->
@section('innercontent')

<main class="content profile-order-history">
    <div class="container-fluid p-0">

        <div class="clearfix">

            <h1 class="h3 mb-3">Today Earning &nbsp;&nbsp;@if(!empty($records))({{$records->total()}})@endif</h1>
        </div>

        <div class="card">
            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h4>22-Nov-2021 | 06:55 AM</h4>
                                    
                                    </div>
                                    <div class="col-md-4">
                                        <span class="pull-right h4" href=""><sup><i class="fas fa-dollar-sign"></i>150</span>

                                    </div>
                                </div>
                                 <div class="row">
                                    <div class="col-md-8">
                                <div class="row">
                                    
                                    <div class="col-md-6"><h4>Today Delivered Orders: <span class="badge badge-success">12 </span></h4></div>
                                        <div class="col-md-6"><h4>Today Canceled by Me: <span class="badge badge-danger">2 </span></h4></div>
                                        <div class="col-md-6"><h4>Today Canceled by Customer: <span class="badge badge-danger">2 </span></h4></div>

                                        <div class="col-md-6"><h4>Today Pending Orders: <span class="badge badge-info">3 </span></h4></div>
                                        <p></p>
                                    
                                    </div>
                                </div>
                                    <div class="col-md-4">
                                     <!--   <button type="button" disabled="" title="This action cannot be done in demo !" class="pull-right ml-2 btn btn-md btn-primary mb-2">
            <i class="fas fa-check-square"></i> Deliverd
        </button>  -->
          <button type="button" disabled="" title="This action cannot be done in demo !" class="pull-right ml-2 btn btn-md btn-info mb-2">
            <i class="fas fa-check"></i>   Paid 
        </button> 
                                    </div>
                                </div>
                                

                                 

                            </div>

</div>

<div class="card">
    <div class="card-body">
        <table class="table table-striped table-hover table-sm table-bordered table-responsive" >
                                        <thead>
                                            <tr>
                                                <th width="5%">Sr.</th>
                                                <th width="12%">Delivery Time</th>
                                                <th width="12%">OrderId</th>
                                                 <th width="12%">Total Distance</th>
                                                 <th width="12%">Commision/Tip</th>
                                                 <th width="12%">Payment Method</th>
                                                 <th width="12%">Payment Status</th>
                                                <th width="12%">Status</th>                         
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                                                  <tr class="deleteRow">
<td>1</td>
<td>22-Nov-2021 | 06:55 AM</td>
<td>#sdfwete6356rgr</td>
<td>12km</td>
<td>$ 10</td>
<td><span class="badge badge-success">Rezerpay</span></td>
<td><span class="badge badge-success">Paid</span></td>
<td><span class="badge badge-dark">Deliverd</span></td>
</tr>      

        <tr class="deleteRow">
<td>2</td>
<td>22-Nov-2021 | 06:55 AM</td>
<td>#sdfwete6356rgr</td>
<td>17km</td>
<td>$ 10</td>
<td><span class="badge badge-info">COD</span></td>
<td><span class="badge badge-danger">UnPaid</span></td>
<td><span class="badge badge-danger">Canceled</span></td>
</tr>                      
        <tr class="deleteRow">
<td>3</td>
<td>22-Nov-2021 | 06:55 AM</td>
<td>#sdfwete6356rgr</td>
<td>22km</td>
<td>$ 10</td>
<td><span class="badge badge-dark">Stripe</span></td>
<td><span class="badge badge-success">Paid</span></td>
<td><span class="badge badge-dark">Deliverd</span></td>
</tr>      
        <tr class="deleteRow">
<td>4</td>
<td>22-Nov-2021 | 06:55 AM</td>
<td>#sdfwete6356rgr</td>
<td>28km</td>
<td>$ 10</td>
<td><span class="badge badge-info">COD</span></td>
<td><span class="badge badge-success">Paid</span></td>
<td><span class="badge badge-info">Pending</span></td>
</tr>      
        <tr class="deleteRow">
<td>5</td>
<td>22-Nov-2021 | 06:55 AM</td>
<td>#sdfwete6356rgr</td>
<td>11km</td>
<td>$ 10</td>
<td><span class="badge badge-info">Paytm</span></td>
<td><span class="badge badge-success">Paid</span></td>
<td><span class="badge badge-dark">Deliverd</span></td>
</tr>      
                                        
                                            
                                        </tbody>
                                    </table>
    </div>
</div>
 


    </div>     

</main> 


@endsection

<!-- ................push new js link................. -->

@push('js')
<script src="{{asset('public/js/comman.js')}}"></script>
@endpush