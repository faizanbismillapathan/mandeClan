@extends('servicepartner.layouts.app')
@section('title',"servicepartner name Dashboard | Admin Mande Clan")

@section('customStyle')
<style type="text/css">
    .shadow-sm {
    box-shadow: 0 .125rem .25rem rgba(0,0,0,.075)!important;
}
.iconsize{
    font-size: 40px;
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
        <div class="col-md-3 ">
          <a href="{{url('/service-partner/today-orders')}}">
            <div class="card m-b-30 shadow-sm">
                <div class="card-body">
                  <div class="row">
                    <div class="col-8">
                      <h4>{{$today_ordrs}}</h4>
                      <p class="font-14 mb-0 ">Total Today Orders</p>
                    </div>
                    <div class="col-4">
                       <i class="text-success fas fa-truck-pickup iconsize"></i>
                     
                      </div>
                      
                  </div>
                </div>
            </div>
             </a>
        </div>
     
        <div class="col-md-3 ">
          <a href="{{url('/service-partner/delivered-orders')}}">
            <div class="card m-b-30 shadow-sm">
                <div class="card-body">
                  <div class="row">
                    <div class="col-8">
                      <h4>{{$delivered_ordrs}}</h4>
                      <p class="font-14 mb-0">Total Deliverd Orders</p>
                    </div>
                    <div class="col-4">
                       <i class="text-warning fas fa-shopping-cart iconsize"></i>
                     
                      </div>
                      
                  </div>
                </div>
            </div>
             </a>
        </div>

        <div class="col-md-3 ">
          <a href="{{url('/service-partner/canceled-orders')}}">
            <div class="card m-b-30 shadow-sm">
                <div class="card-body">
                  <div class="row">
                    <div class="col-8">
                      <h4>{{$canceled_ordrs}}</h4>
                      <p class="font-14 mb-0">Total Cancelled Orders</p>
                    </div>
                    <div class="col-4">
                       <i class="text-danger fas fa-times iconsize"></i>
                     
                      </div>
                      
                  </div>
                </div>
            </div>
             </a>
        </div>


        <div class="col-md-3 ">
          <a href="#">
            <div class="card m-b-30 shadow-sm">
                <div class="card-body">
                  <div class="row">
                    <div class="col-8">
                      <h4>0</h4>
                      <p class="font-14 mb-0">Total Earning</p>
                    </div>
                    <div class="col-4">
                       <i class="text-info fab fa-product-hunt iconsize"></i>
                     
                      </div>                      
                  </div>
                </div>
            </div>      
         </a>
  </div>


        <div class="col-md-3 ">
          <a href="#">
            <div class="card m-b-30 shadow-sm">
                <div class="card-body">
                  <div class="row">
                    <div class="col-8">
                      <h4>0</h4>
                      <p class="font-14 mb-0">Total Payout History</p>
                    </div>
                    <div class="col-4">
                       <i class="text-secondary fas fa-sitemap iconsize"></i>
                     
                      </div>
                      
                  </div>
                </div>
            </div>
             </a>
        </div>

         </div>
       </main>  
@endsection