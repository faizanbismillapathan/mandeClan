@extends('customer.layouts.app')
@section('title',"customer name Dashboard | Admin Mande Clan")

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
          <a href="{{url('/customer/my-orders')}}"> 
            <div class="card m-b-30 shadow-sm">
                <div class="card-body">
                  <div class="row">
                    <div class="col-8">
                      <h4>{{$order}}</h4>
                      <p class="font-14 mb-0 ">My Orders

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
          <a href="{{url('/customer/my-orders')}}"> 
            <div class="card m-b-30 shadow-sm">
                <div class="card-body">
                  <div class="row">
                    <div class="col-8">
                      <h4>{{$followed}}</h4>
                      <p class="font-14 mb-0">Followed Store</p>
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
          <a href="{{url('/customer/wishlist')}}"> 
            <div class="card m-b-30 shadow-sm">
                <div class="card-body">
                  <div class="row">
                    <div class="col-8">
                      <h4>{{$wishlist}}</h4>
                      <p class="font-14 mb-0">My Wishlist</p>
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
          <a href="{{url('/customer/rating-review')}}"> 
            <div class="card m-b-30 shadow-sm">
                <div class="card-body">
                  <div class="row">
                    <div class="col-8">
                      <h4>{{$reviews}}</h4>
                      <p class="font-14 mb-0">Rating Review</p>
                    </div>
                    <div class="col-4">
                      <i class="text-primary fas fa-users iconsize"></i>
                     
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