@extends('admin.layouts.app')
@section('title',"All Dashboard | Admin Mande Clan")
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
           <a href="{{url('/admin/customers')}}"> 
            <div class="card m-b-30 shadow-sm">
                <div class="card-body">
                  <div class="row">
                    <div class="col-8">
                      <h4>{{$customer}}</h4>
                      <p class="font-14 mb-0 ">Total Users</p>
                    </div>
                    <div class="col-4">
                     <i class="text-success fas fa-users iconsize"></i>
                   
                      </div>
                      
                  </div>
                </div>
            </div>
               </a>
        </div>
     
        <div class="col-md-3 ">
          <a href="{{url('admin/suborders')}}"> 
            <div class="card m-b-30 shadow-sm">
                <div class="card-body">
                  <div class="row">
                    <div class="col-8">
                      <h4>{{$order}}</h4>
                      <p class="font-14 mb-0">Total Orders</p>
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
          <a href="{{url('admin/suborders?search=Cancelled')}}"> 
            <div class="card m-b-30 shadow-sm">
                <div class="card-body">
                  <div class="row">
                    <div class="col-8">
                      <h4>{{$Cancelorder}}</h4>
                      <p class="font-14 mb-0">Cancelled Orders</p>
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
          <a href="{{url('/admin/suborders?search=Delivered')}}"> 
            <div class="card m-b-30 shadow-sm">
                <div class="card-body">
                  <div class="row">
                    <div class="col-8">
                      <h4>{{$Dispatchorder}}</h4>
                      <p class="font-14 mb-0">Deliverd Orders</p>
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
          <a href="{{url('/admin/products')}}"> 
            <div class="card m-b-30 shadow-sm">
                <div class="card-body">
                  <div class="row">
                    <div class="col-8">
                      <h4>{{$product}}</h4>
                      <p class="font-14 mb-0">Total Products</p>
                    </div>
                    <div class="col-4">
                      <i class="text-primary fab fa-product-hunt iconsize"></i>
                      
                      </div>
                      
                  </div>
                </div>
            </div>
            </a>
        </div>


        <div class="col-md-3 ">
          <a href="{{url('/admin/stores')}}"> 
            <div class="card m-b-30 shadow-sm">
                <div class="card-body">
                  <div class="row">
                    <div class="col-8">
                      <h4>{{$store}}</h4>
                      <p class="font-14 mb-0">Total Stores</p>
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
          <a href="{{url('/admin/store-category')}}">
            <div class="card m-b-30 shadow-sm">
                <div class="card-body">
                  <div class="row">
                    <div class="col-8">
                      <h4>{{$category}}</h4>
                      <p class="font-14 mb-0">Total Categories</p>
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