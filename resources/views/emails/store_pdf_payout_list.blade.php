<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> <style type="text/css">

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

        .col-md-3 {
            flex: 0 0 25%;
            max-width: 25%;
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
        .col-md-6, .col-md-4, .col-md-5, .col-md-7, .col-md-3
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

.d-flex {
    display: -ms-flexbox !important;
    display: flex !important;
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

.d-flex {
    display: flex !important;
}

table .new_border {border: none!important;}

.padding {
    padding: 10px;
}

</style></title>
</head>
<body>
  <div class="div">

   <div class="header">


<table class="new_border" >

<tbody>
<tr>

<td> <div class="logo-img">
<img src="{{url('/').'/public/img/mandeclan_logo.jpg'}}">
</div></td>
<td></td>
<td></td>
<td></td>
<td  class="pull-right"> <a href="#"><img width="150px" height="50px" src="{{url('/').'/public/frontend/img/apple-store.png'}}" alt="image" class="android-img"></a>
<a href="#" target="_blank"><img width="150px" height="50px" src="{{url('/').'/public/frontend/img/goggle-play-store.png'}}" alt="image" class="app-img"></a></td>
</tr>


</tbody>
</table>
</div>
<div class="content">

<table class="new_border" >
      
        <tbody>
            <tr>
                <th class="padding">Store Id :</th>
               <td class="padding">  {{ $record->store_unique_id }}</td>
            </tr>
            <tr>
               <th class="padding">Store Name :</th>
                <td class="padding">  {{ $record->store_name }}</td>
            </tr>
            <tr>
                <th class="padding">Store Category :</th>
                 <td class="padding">  {{ $record->category->category_name }}</td>
            </tr>
            <tr>
                <th class="padding">Store Contact No :</th> 
                 <td class="padding">  {{ $record->store_mobile }}</td>
            </tr>

             <tr>
                <th class="padding">Location :</th> 
                 <td class="padding">  {{ $record->city->city_name}} </td>
            </tr>


        </tbody>
    </table>






<div class="table-responsive">
    <table class="table table-bordered">                    <thead class="thead-light">
        <tr>
            <th>Date</th>
            <th>Order no.</th>
            <th>Total Item</th>
            <th>Weight</th>
            <th>Price</th>
            <th>Delevery</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody class="">
        @foreach($records as $index=>$data)
        <tr width="600px" class="" style='border: 1px solid #ccc'>
            <td>{{date("d-m-Y", strtotime($data->created_at))}}</td>
            <th scope="row">{{ $data->suborder_u_id }}</th>
            <td><a href="{{ url('admin/store-item-wise-payout/'.$data->id.'?from_date='.Request::Input('from_date').'&to_date='.Request::Input('to_date').'&store_id='.$data->store_id) }}">{{ $data->total_item }}</a></td>
            <td>{{ $data->total_item_weight }} kg</td>
            <td>{{ $data->total_item_price }} $</td>
            <td>{{ $data->delevery_status }}</td>
            <td>
                @if($data->Status=='Paid')

                <span class="badge badge-light"> {{ $data->Status }}</span>
                @else
                <span class="badge badge-light"> {{ $data->Status }}</span>

            @endif                           </td>

        </tr>
        @endforeach

    </tbody>
</table>
</div>



</div>

</body>
</html>