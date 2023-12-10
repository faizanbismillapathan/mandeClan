@extends('customer.layouts.app')
@section('title',"All Category List| service Mande Clan")

<!-- ................custom css................. -->

@section('customStyle')
<style type="text/css">
  .fc td{
    background: #e6e6e6;
  }   
  .fc th {

    background: #fff;
  } 
</style>
@endsection

<!-- ................Add css link................. -->

@push('style')

@endpush

<!-- ................body................. -->
@section('innercontent')

<main class="content">
  <div class="container-fluid p-0">

    <div class="clearfix">

    
      <h1 class="h3 mb-3">Service Enquiry </h1>
    </div>

 



    

                  <div class="card">

                    <div class="card-body">

                      <table class="table table-striped table-hover table-sm table-bordered" id="display">
                        <thead>
                          <tr>
                            <th width="5%">Sr.</th>
                            <th width="10%">Enquiry Date</th>
                            <th width="10%">Booking Date</th>
                            <th width="10%">Title</th>
                            <th width="20%">Service Details</th>
                            <th width="15%">Vendor Details</th>
                            <th width="10%">Status</th> 
                            <th width="15%">Action</th>             
                          </tr>
                        </thead>
                        <tbody>


                          @if(!empty($event_records))
                          @foreach($event_records as $index => $data)
                          <tr class="deleteRow">
                            <td>{{$index+1}}</td> 
                            <td>{{date('d-m-Y', strtotime($data->created_at))}}</td>
                         {{--    <td>{{date('d-m-Y', strtotime($data->start_date))}}</td>
                            <td>{{date('d-m-Y', strtotime($data->end_date))}}</td> --}}

<td>{{$data->start_date}} to {{$data->end_date}}</td>
<td>{{$data->title}}</td>
<td>{{$data->description}}</td>
<td>{{$data->service_name}}<br>
{{$data->service_mobile}}<br>
{{$data->service_email}}<br>
{{$data->city_name}}<br>
                            </td>

<td>
  <span class="badge badge-success">{{$data->status}}</span>
</td>
                            <td style="color: #569c02"> <a href="{{ URL::to('customer/service-enquiry/'.$data->id) }}" class="modaleditclick"><button class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Edit">Chat Now</button></a></td>
                           
                          </tr>
                          @endforeach
                          @endif

                        </tbody>
                      </table>
                      <div class="card-body">
                        @if(!empty($event_records))
                        {!! $event_records->appends(request()->query())->render() !!}
                        @endif
                      </div>
                      <table class="table table-striped table-hover table-sm table-bordered" id="display_defoult" style="display: none;" >
                        <thead>
                          <tr>
                            <th width="5%">Sr.</th>
                            <th width="10%">Select Date</th>
                            <th width="10%">Create Date</th>
                            <th width="10%">Update Date</th>
                            <th width="10%">Start Date</th>
                            <th width="10%">End Date</th>
                            <th width="10%">Title</th>
                            <th width="10%">Vendor Name</th>
                            <th width="10%">Status</th> 
                            <th width="10%">Action</th>             
                          </tr>
                        </thead>
                        <tbody id="swapzarin">

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
              <script src="{{asset('public/js/validation.js')}}"></script>

                


@endpush