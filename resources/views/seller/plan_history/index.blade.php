@extends('seller.layouts.app')
@section('title',"All Subscriptions | seller  Mande Clan")

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

    <h1 class="h3 mb-3"><b>SERVICE HISTORY
</b></h1>

</div>
    <div class="card">  
  
          <div class="card-body">

                
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                             <div class="col-md-6">
                        <h4>Service history</h4>

                             </div>
                        <div class="col-md-6">
                            @if(empty($records))
                            <div class="pull-right" style="text-align: right;">
                            <a href="{{url('seller/subscriptions')}}">
                            <div class="pull-right">
                                <button type="button" class="btn custom-btn new-plan"><i class="fas fa-paper-plane"></i> new plan</button>
                            </div>
                            </a>
                            </div>
                            @endif
                        </div>
                    </div>
                    </div>
                    <div class="card-padding">
                    <!--  -->
                    <div class="table-responsive job-posting-table">
                                                    @if(count($records)>0)

                        <table class="table table-striped table-bordered">
                          <thead>
                            <tr>
                              <th>Order Date</th>
                              <th>Invoice Id</th>
                              <th>Plan</th>
                              <th>Product Limit</th>
                              <th>Expiry Date</th>
                              <th>status</th>
                              <th>Payment Status</th>
                              <th>Amount</th>
                              <th>Invoice</th>
                              {{-- <th> Invoice</th> --}}
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($records as $index=>$data)
                            <tr>
                              <th>{{date("d-m-Y", strtotime($data->created_at))}}</th>
                              <td>{{$data->store_invoice_id}}</td>
                                                          <td>{{$data->store_plan_name}}</td>

                              <td>{{$data->store_product_limit}}</td>
                             
                              @if(!empty($data->plan_expiry_date))
                              <td>{{date("d-m-Y", strtotime($data->plan_expiry_date))}}</td>
                              @else
                             <td>-</td>
                              @endif
                              <td>
                                @if($data->plan_status=='Active')
                                 <span class="badge badge-success">{{$data->plan_status}}</span>
                                @else
                                 <span class="badge badge-danger">{{$data->plan_status}}</span>
                                 @endif
                              </td>
                               <td>@if($data->invoic_status=='Paid')
 <span class="badge badge-success">Paid</span>
@elseif($data->invoic_status=='Unpaid')
@if($data->status=='Expired')
    @else
  <a href="{{url('seller/store_invoice_pay/'.$data->id)}}"><span class="badge badge-danger">Pay Now</span></a>
  @endif
  
@elseif($data->invoic_status=='Free')
 <span class="badge badge-info">Free</span>

@endif

                               </td>
                              <th><i class="fas fa-rupee-sign"></i> {{$data->store_total_amount}} </th>
                            
                                 <td>
{{-- <a  target="_blank" href="{{url('seller/store-invoice/'.$data->id)}}">  <button class="btn bmd-btn-icon btn-raised btn-info dropdown-toggle pd_post_job" type="button">
<i class="far fa-eye"></i>
</button></a> --}}

<a href="{{url('seller/store-invoice-pdf/'.$data->id)}}"><button class="btn bmd-btn-icon btn-raised btn-secondary" type="button">
<i class="fas fa-download"></i>
</button></a>

                                </td>
                            </tr>
                            @endforeach

                            
                            
                          </tbody>
                        </table>
                        @else

<div class="center ">
    <p style="color:red;font-size: 20px;padding: 10px">You have not purchased our Plan Yet</p>
<a href="{{ url('seller/subscriptions/')}}"><button style="margin-bottom:10px" class="btn btn-primary">Go to Subscription Plan</button>
</a></div>
                            @endif
                    </div>
                    
                    <!--  -->
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