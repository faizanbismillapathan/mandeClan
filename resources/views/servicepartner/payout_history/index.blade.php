@extends('servicepartner.layouts.app')
@section('title',"All Payout History | Service Partner Mande Clan")

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

            <h1 class="h3 mb-3">Payout History &nbsp;&nbsp;@if(!empty($records))({{$records->total()}})@endif</h1>
        </div>

        
 
<div class="card">
    <div class="card-body">

        <div class="row">
                                            <div class="col-md py-1">
                                            {{Form::open(['url'=>['admin/city'],'method'=>'GET'])}}
                                            

                        {!!Form::select('search',[7,15,30,60,90],Request::input('search'),array('class'=>'form-control select2','placeholder'=>'Search','data-toggle'=>'select2','onchange'=>'this.form.submit()','id'=>'test_skill')) !!}

                        


                                            
                                            {{Form::close()}}
                                            </div>
                                            <div class="col-md py-1">
                                                
                                            </div>
                                            <div class="col-md py-1">
                                                <div class="form-group">
                                                    {{Form::open(['url'=>['admin/city'],'method'=>'GET'])}}

                                                    <div class="input-group">

      {!!Form::text('search',Request::input('search'),array('class'=>'form-control','placeholder'=>'Search name..','onchange'=>'this.form.submit()','autocomplete'=>'off')) !!}
               
                            <span class="input-group-append">
                  <button class="btn btn-secondary" type="button">Enter!</button>
                </span>                         
                                                    </div>
                                                     {{Form::close()}}

                                                </div>
                                            </div>                                          
                                        </div>

        <table class="table table-striped table-hover table-sm table-bordered table-responsive" >
                                        <thead>
                                            <tr>
                                                <th width="5%">Sr.</th>
                                                <th width="10%" Style="whIte-space: nowrap;
">delivery date</th>
                                                <th width="10%">OrderId</th>
                                                 <th width="10%">Total Delivered</th>
                                                 <th width="10%">Total Canceled</th>
                                                  <th width="10%">Commision</th>
                                                  <th width="10%">Deduction Amount</th>
                                                   <th width="10%">Tip/Bonus</th>

                                                            <th width="10%">Payout Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                                                  <tr class="deleteRow">
<td>1</td>
<td>22-Nov-2021</td>
<td style="color: #e91e63;text-decoration :underline; " data-toggle="tooltip" data-placement="top" title="Go to Store Panel" class=" clickable-row" data-href="{{ URL::to('service-partner/payout-history/1') }}" data-underline>#sdfwete6356rgr</td>
<td>12</td>
<td>3</td>
<td>$10</td>
<td>$5</td>
<td>$3</td>
<td><span class="badge badge-success">Paid</span></td>
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
<script type="text/javascript">
     $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
</script>
@endpush