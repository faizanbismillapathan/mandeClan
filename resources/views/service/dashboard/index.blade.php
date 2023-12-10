@extends('service.layouts.app')
@section('title',"Service Dashboard | service Mande Clan")
@section('customStyle')

<style type="text/css">
  .shadow-sm {
    box-shadow: 0 .125rem .25rem rgba(0,0,0,.075)!important;
  }
  .iconsize{
    font-size: 40px;
  }
  .padding10{
    padding: 0 10px;
  }
</style>
@endsection


@section('innercontent')
<main class="content">
  <div class="container-fluid p-0">

   <div class="clearfix">

    <h1 class="h3 mb-3">Dashboard</h1>
  </div>

  <div class=" dashboard-padding">

    <div class="row">
      <div class="col-md-3 padding10 ">
        <a href="{{url('/service/services')}}">
          <div class="card m-b-30 shadow-sm">
            <div class="card-body">
              <div class="row">
                <div class="col-8">
                  <h4>{{$total_services}}</h4>
                  <p class="font-14 mb-0 ">Total Products

                  </p>
                </div>
                <div class="col-4">
                  <i class="text-success fas fa-users iconsize"></i>

                </div>

              </div>
            </div>
          </div>
        </a>
      </div>

      <div class="col-md-3 padding10 ">
        <a href="{{url('/service/orders')}}">
          <div class="card m-b-30 shadow-sm">
            <div class="card-body">
              <div class="row">
                <div class="col-8">
                  <h4>{{$total_booking}}</h4>
                  <p class="font-14 mb-0">Total Booking</p>
                </div>
                <div class="col-4">
                  <i class="text-warning fas fa-users iconsize"></i>

                </div>

              </div>
            </div>
          </div>
        </a>
      </div>

      <div class="col-md-3 padding10 ">
        <a href="{{url('/service/service/booking')}}/canceled">
          <div class="card m-b-30 shadow-sm">
            <div class="card-body">
              <div class="row">
                <div class="col-8">
                  <h4>{{$total_cancelled}}</h4>
                  <p class="font-14 mb-0">Total Cancelled Booking</p>
                </div>
                <div class="col-4">
                <i class="text-danger fas fa-users iconsize"></i>

                  </div>

                </div>
              </div>
            </div>
          </a>
        </div>

        <div class="col-md-3 padding10 ">
          <a href="{{url('/service/service/booking')}}">
            <div class="card m-b-30 shadow-sm">
              <div class="card-body">
                <div class="row">
                  <div class="col-8">
                    <h4>{{$total_completed}}</h4>
                    <p class="font-14 mb-0">Total Completed Booking</p>
                  </div>
                  <div class="col-4">
                    <i class="text-primary fas fa-users iconsize"></i>
                    
                  </div>

                </div>
              </div>
            </div>
          </a>
        </div>

        <div class="col-md-3 padding10 ">
          <a href="#">
            <div class="card m-b-30 shadow-sm">
              <div class="card-body">
                <div class="row">
                  <div class="col-8">
                    <h4>10</h4>
                    <p class="font-14 mb-0">Total Earning

                    </p>
                  </div>
                  <div class="col-4">
                    <i class="text-info fa fa-shopping-basket iconsize"></i>
                    
                  </div>

                </div>
              </div>
            </div>
          </a>
        </div>



        <div class="col-md-3 padding10 ">
          <a href="#">
            <div class="card m-b-30 shadow-sm">
              <div class="card-body">
                <div class="row">
                  <div class="col-8">
                    <h4>00</h4>
                    <p class="font-14 mb-0">Received Payouts</p>
                  </div>
                  <div class="col-4">
                    <i class="text-secondary fas fa-users iconsize"></i>
                    
                  </div>

                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection