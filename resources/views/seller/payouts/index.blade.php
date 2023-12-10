@extends('seller.layouts.app')
@section('title',"All Payouts | seller  Mande Clan")

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




                             <a href="{{url('seller/payouts/create')}}" class="form-inline float-right mt--1 d-none d-md-flex">
                                       <button class="btn btn-primary"><i class="fa fa-plus-circle"></i> Upgrade Plan</button>
                                    </a>

                            <h1 class="h3 mb-3">Payouts &nbsp;&nbsp;@if(!empty($records))({{$records->total()}})@endif</h1>
                        </div>

                        <div class="card">
                                <div class="card-body">
                                     
                                

                                    <table class="table table-striped table-hover table-sm table-bordered" >
                                        <thead>
                                            <tr>
                                                <th width="5%">Sr.</th>
                                                <th width="12%">Transfer Type</th>
                                                <th width="12%">Order Id</th>
                                                <th width="12%">Amount</th>
                                                <th width="12%">Seller Detail</th>
                                                <th width="12%">Paid On</th>
                                                <th width="12%">Status</th>                   
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
<tr class="deleteRow">
<td>1</td>
<td>Silver</td>
<td>    INR 0</td>                                             
<td>60f17da4be1a9</td>
<td>16-07-2021 | 02:37 AM</td>
<td>16-07-2022 | 02:37 AM</td> 
<td><input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="Deactive" data-onstyle="success" data-offstyle="danger" id="" class="checkstatus" onchange="updateToggle()"></td>

</tr>
                                           @if(!empty($records))
                                            @foreach($records as $index => $data)
                                            <tr class="deleteRow">
                                                <td>{{$index+1}}</td>   
                                                <td>{{$data->payouts_name}}</td>
                                                <td>
                                    
                 @if($data->status ==  'Active')

                                                    <input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="Deactive" data-onstyle="success" data-offstyle="danger" id="{{$data->id}}" class="checkstatus" onchange="updateToggle({{$data->id}})">
 @elseif($data->status ==  'Deactive')
<input type="checkbox" data-toggle="toggle" data-on="Active" data-off="Deactive" data-onstyle="success" data-offstyle="danger" id="{{$data->id}}" class="checkstatus" onchange="updateToggle({{$data->id}})">
   @endif

                                                </td>
                                                <td>                                                    
                                                <a href="{{ URL::to('seller/payouts/'.$data->id.'/edit') }}"><button class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></button></a>
                                                
                                                <button class="btn btn-danger click_disbled"  data-toggle="tooltip" data-placement="top" title="Delete"  data="{{$data->id}}"><i class="fas fa-trash-alt"></i></button>                                 
                                               </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                            
                                        </tbody>
                                    </table>
 <div class="card-body">
    @if(!empty($records))
       {!! $records->appends(request()->query())->render() !!}
@endif
 </div>





                                </div>
                    </div>

                </main> 

@endsection

<!-- ................push new js link................. -->

@push('js')
 <script src="{{asset('public/js/comman.js')}}"></script>
@endpush