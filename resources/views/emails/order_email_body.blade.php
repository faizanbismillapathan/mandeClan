<!DOCTYPE html>
<html>
<head>
  <title></title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <style type="text/css">
      *
      {
        font-family: sans-serif;
      }
    .div
    {
      width: 80%;
      margin: 0 auto;
      border: 1px solid #f5f5f5;
    }
    .logo-img
    {
      position: relative;
      width: 120px;
      height: 120px;
    }
    .logo-img img 
    {
      position: absolute;
      width: 100%;
      height: 100%;
    }
    .row {
        display: flex;
        flex-wrap: wrap;
        margin-right: -15px;
        margin-left: -15px;
    }
    .col-md-6 {
        flex: 0 0 50%;
        max-width: 50%;
    }
    .col-md-4 {
        flex: 0 0 33.33%;
        max-width: 33.33%;
    }
    .col-md-5 {
        flex: 0 0 41.66667%;
        max-width: 41.66667%;
    }
    .col-md-7 {
        flex: 0 0 58.33333%;
        max-width: 58.33333%;
    }
    .col-md-6, .col-md-4, .col-md-5, .col-md-7
    {    
      position: relative;
        width: 100%;
        min-height: 1px;
        padding-right: 15px;
        padding-left: 15px;
    }
    div {
        display: block;
    }
    *, :after, :before {
        box-sizing: border-box;
    }
    .pull-right
    {
      float: right;
    }
    .header
    {
      padding: 10px;
      border-bottom: 1px solid #f5f5f5;
      background-color: rgba(248, 201, 195, 0.07);
    }
    .header .pull-right p, .content p 
    {
      margin-top: 8px;
      margin-bottom: 8px;
    }
    .content
    {
      padding: 30px 10px;
    }
    .total-rupees img 
    {
      width: 22px;
    }
    .total-rupees 
    {
      font-size: 18px;
      font-weight: 600;
      color: #ee3b23;
    }
    .pull-right .col-md-5
    {
      padding-right: 0px;
    }
    .pull-right .col-md-7
    {
      padding-left: 0px;
    }
    .pull-right .col-md-5 p 
    {
      padding-top: 5px;
    }
    .border-bottom
    {
      border-bottom: 1px solid #f5f5f5;
      padding-bottom: 15px;
    }
    .table-bordered {
        border: 1px solid #dee2e6;
    }
    .table {
        width: 100%;
        margin-bottom: 1rem;
        background-color: transparent;
    }
    table {
        border-collapse: collapse;
        display: table;
        border-spacing: 2px;
        margin-top: 15px;
    }
    thead {
        display: table-header-group;
        vertical-align: middle;
        border-color: inherit;
    }
    tr {
        display: table-row;
        vertical-align: inherit;
        border-color: inherit;
    }
    .table-bordered thead td, .table-bordered thead th {
        border-bottom-width: 2px;
    }
    .table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #dee2e6;
    }
    .table-bordered td, .table-bordered th {
        border: 1px solid #dee2e6;
    }
    .table td, .table th {
        padding: .75rem;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
    }
    th {
        text-align: inherit;
    }
    tbody {
        display: table-row-group;
        vertical-align: middle;
        border-color: inherit;
    }
    .center
    {
      text-align: center;
    }
    .footer p 
    {
      margin-top: 0px;
      margin-bottom: 0px;
      color: #ee3b23;
      font-weight: 600;
      font-size: 18px;
    }
    .footer
    {
      padding: 10px;
      background: rgba(248, 201, 195, 0.07);
      border-top: 1px solid #f5f5f5;
    }
    .thanku
    {
      line-height: 180%;
    }
    .blue
    {
      background: rgba(0, 170, 226, 0.12);
    }
    .gray
    {
      background: #f5f5f5;
    }
    .lightgray
    {
      background: #fafafa;
    }
    .orderno 
    {
      color: #ee3b23;
      font-weight: 600;
    }
    .table-responsive 
    {
      display: block;
      width: 100%;
      overflow-x: auto;
    }

    @media screen and (max-width: 768px) and (orientation: portrait)
    {
      .div
      {
        width: 100%;
      }
      .table td, .table th {
        padding: .75rem 4px;
      }
    }

    .badge-light {
    color: #212529;
    background-color: #eee;
}

.badge {
    display: inline-block;
    padding: 0.3em 0.45em;
    font-size: 80%;
    font-weight: 600;
    line-height: 1;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: 0.2rem;
}

  </style>
</head>
<body>
   <div class="div">
     <div class="header">
      <div class="row">
        <div class="col-md-6">
          <div class="logo-img">
            <img src="{{url('/').'/public/img/mandeclan_logo.jpg'}}">
          </div>
        </div>
        <div class="col-md-6">
          <div class="pull-right">
            <a href="#"><img width="150px" height="50px" src="{{url('/').'/public/frontend/img/apple-store.png'}}" alt="image" class="android-img"></a>
                  <a href="#" target="_blank"><img width="150px" height="50px" src="{{url('/').'/public/frontend/img/goggle-play-store.png'}}" alt="image" class="app-img"></a>
          </div>
        </div>
      </div>
     </div>
     <div class="content">
      <div class="row">
        <div class="col-md-6">
           <p style="color:red"><b>Payment Mode :</b> {{$order->payment_method}}</p>
          <p><b>Delivery Address</b></p>
          @if($order->pickup_type=='Self Pickup')
          <p>{{$users->name}}<br>
            <span class="badge badge-light">
            {{$order->pickup_type}}   
            </span>         
             </p>
            
          <p><b>Mobile No. :</b>{{$users->mobile}}</p>
          <p><b>Email Id :</b> {{$users->email}}</p>
         
          @else
 <p>{{$addressBook->name}}<br>
             @if(!empty($addressBook->localitys)){{$addressBook->localitys->locality_name}} @endif @if(!empty($addressBook->citys)), {{$addressBook->citys->city_name}} @endif  @if(!empty($addressBook->states)), {{$addressBook->states->state_name}} @endif @if(!empty($addressBook->countrys)) ,{{$addressBook->countrys->country_name}} @endif<br>
             {{$addressBook->address}}
             </p>
          <p><b>Mobile No. :</b>{{$addressBook->mobile}}</p>
          <p><b>Email Id :</b> {{$addressBook->email}}</p>

          @endif
        </div>
        <div class="col-md-6">
          <div class="">
       <p><b>Invoice No :</b> <span class="orderno">
   @if(isset($order->order_u_id))  
        {{$order->order_u_id}}
@else
        {{$order->suborder_u_id}}

@endif
      </span></p>
            <p><b>Total Amount </b><span class="total-rupees">{{'$ '.$order->grand_total}}</span></p>
            <p><b>Order Date :</b> {{date('d-M-y',strtotime($order->order_date))}}</p>
            <p><b>Delivery Date :</b> {{date('d-M-y',strtotime($order->delivery_date))}}</p>
            <p><b>Delivery Slot Time :</b>{{$order->delivery_time}}</p>
          </div>
        </div>
      </div>
      <!--  -->
  <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr class="blue">
          <th>Item</th>
          <th>Price</th>
          <th>Qty</th>
          <th>Weight</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>

         @foreach($order_items as $index=>$data)
        <tr>
          <td>{{$data->product_name}}

@if(!empty($data->addon_name_price))
<br>
@foreach(unserialize($data->addon_name_price) as $value)

<span class="badge badge-light">{{$value}} 
</span>@endforeach

@endif
          </td>
          <td>{{'$ '.$data->item_selling_price}}

@if($data->item_offer_discount)
           <del>{{ round($data->item_price,2) }}</del> <span class="text-danger">({{ $data->item_offer_discount }}% Off )</span>
@endif
          </td>
          <td>{{$data->item_quantity}}</td>

          @if(isset($data->item_shipping_weight))
            <td><span>{{$data->item_shipping_weight * $data->item_quantity}} {{$data->item_shipping_weight_unit}}</span></td>
          
          @else

          <td></td>
            @endif


          <td>$ {{$data->item_selling_price * $data->item_quantity}}</td>
        </tr>

         @endforeach
        <tr class="lightgray">
          <td colspan="4"><span class="pull-right">Sub Total</span></td>
          <td>{{'$ '.$order->subtotal}}</td>
        </tr>
           <tr class="lightgray">
          <td colspan="4"><span class="pull-right">Tax ({{ $order->total_tax }}%)</span></td>
          <td>{{'$ '.$order->tax_price}}</td>
        </tr>
        <tr class="lightgray">
          <td colspan="4"><span class="pull-right">Shipping Charges</span></td>
          <td>{{'$ '.$order->shipping_charges}}</td>
        </tr>
        <tr class="gray">
          <td colspan="4"><span class="pull-right"><b>Grand Total</b></span></td>
          <td><b>{{'$ '.$order->grand_total}}</b></td>
        </tr>
      </tbody>
    </table>
  </div>
      <!--  -->
      <h4 class="center thanku">Thank you for making business with us.<br>
            We are always happy to serve you.
      </h4>
      <!--  -->
     </div>
     <div class="footer">
      <p class="center"><a href="https://mandeclan.com/">www.mandeclan.com</a></p>
     </div>
   </div>
</body>
</html>