<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<style type="text/css">
*
{
	font-family: sans-serif;
}
.table-bordered, .table-bordered td, .table-bordered th {
    border: 1px solid rgba(0,0,0,.06);
}
.table {
    width: 100%;
    max-width: 100%;
    margin-bottom: 1rem;
    background-color: transparent;
}
table {
    border-collapse: collapse;
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
.table thead th {
    font-size: .95rem;
    font-weight: 500;
    color: rgba(0,0,0,.54);
    border-top-width: 0;
    border-bottom-width: 1px;
}
.table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid rgba(0,0,0,.06);
}
.table-bordered, .table-bordered td, .table-bordered th {
    border: 1px solid rgba(0,0,0,.06);
}
.table td, .table th {
    padding: .75rem;
}
tbody {
    display: table-row-group;
    vertical-align: middle;
    border-color: inherit;
}
.table-responsive {
    display: block;
    width: 100%;
    overflow-x: auto;
}
/*....................*/
.invoice
{
	width: 100%;
	margin: 0px auto;
	background-color: #ffffff;
	padding: 10px;
	border: 1px solid #f5f5f5;
}
.pull-right
{
	float: right;
}
.table td
{
	font-size: 14px;
}
.table-striped tbody tr:nth-of-type(odd)
{
	background-color: transparent;
}
.table-striped tbody tr:nth-of-type(even)
{
	background-color: rgba(0,0,0,.05);
}
.table-primary, .table-primary>td, .table-primary>th
{
	background-color: #ec228d;
	color: #ffffff;
}
.table .table-primary th
{
	color: #ffffff;
	padding: 15px .75rem;
}
.table1 th
{
	width: 50%;
}
.table1 h2
{
	margin-top: 20px;
	font-size: 40px;
	font-weight: 600;
	color: #ec228d;
	text-transform: uppercase;
	margin-bottom: 5px;
}
.table1.table td, .table1.table th, .table4.table td, .table4.table th
{
	border-top: 0px solid transparent;
}
.table1 p 
{
	margin-bottom: 0px;
	color: #000;
}
.table1 img
{
	width: 180px;
	margin-top: 20px;
}
.table2 tr th
{
  width: 50%;
}
.table2 p
{
	margin-bottom: 8px;
}
.table2 .th1
{
	width: 50%;
}
.table2 .th2
{
	width: 50%;
}
.table3
{
	margin-top: 15px;
}
.table4 h2
{
	margin-top: 20px;
	font-size: 35px;
	font-weight: 600;
	color: #4a6406;
	margin-bottom: 5px;
}
.table4 td
{
	padding: 8px .75rem;
}
.table .rupees-img 
{
	width: 14px;
}
.dark-primary 
{
	background-color: #960552;
}
.border-bottom {
    border-bottom: 1px solid #dee2e6!important;
}
p
{
	margin-bottom: 0px;
	margin-top: 0px;
	font-size: 14px;
}
td {
    display: table-cell;
    vertical-align: top;
}

.paid_status{
float: right;
background-color: green;
padding:2px 10px;
color: #fff;
}


.unpaid_status{
float: right;
background-color: red;
padding:2px 10px;
color: #fff;

}

</style>
<!--  -->
<div class="invoice">

<table class="table table1">
  <tbody>
      <tr>
          <td>
             <div class="pull-right">
                  {{$service_plan_invoice->status}}
                  
             </div>
          </td>
      </tr>
   </tbody>
</table>
<table class="table table1">
  <tbody>
    <tr>
      <td>
        <h2>Invoice</h2>
        <p>Invoice ID : {{$service_plan_invoice->service_invoice_id}}</p>
        <p>Invoice Date : {{date('d-m-Y', strtotime($service_plan_invoice->created_at))}}</p>
        
      </td>
      

      <td>
        <div class="pull-right">
          <img src="{{url('/').'/public/img/mandeclan_logo.jpg'}}">
        </div>
      </td>
    
    </tr>
  </tbody>
</table>

<div class="border-bottom"></div>
<table class="table table2">
   <tbody>
 <tr>
      <td class="th1">
        <p><b>Invoice To</b></p>
        @if(!empty($service_plan_invoice->service_name))<p> 
          Company : {{$service_plan_invoice->service_name}} </p>@endif

  @if(!empty($service_plan_invoice->admin_mobile))<p> 
          Contact No : {{$service_plan_invoice->admin_mobile}} </p>@endif

            @if(!empty($service_plan_invoice->service_email))<p> 
          Email Id : {{$service_plan_invoice->service_email}} </p>@endif

            @if(!empty($service_plan_invoice->service_owner_name))<p> 
          Contact Person : {{$service_plan_invoice->service_owner_name}} </p>@endif


       <!--  @if(!empty($service_plan_invoice->service_gst))<p> 
          GST No : {{$service_plan_invoice->service_gst}} </p>@endif -->

        @if(!empty($service_plan_invoice->service_address))<p> 
          Address :  {{$service_plan_invoice->service_address}} @endif
        ,
         @if(!empty($service_plan_invoice->service_locality)){{$service_plan_invoice->service_locality}} @endif
           @if(!empty($service_plan_invoice->service_city)){{$service_plan_invoice->service_city}} @endif
@if(!empty($service_plan_invoice->service_state)){{$service_plan_invoice->service_state}} @endif           @if(!empty($service_plan_invoice->service_country)) ,
        {{$service_plan_invoice->service_country}} @endif

        @if(!empty($service_plan_invoice->service_pincode))-
          {{$service_plan_invoice->service_pincode}}</p> @endif
      </td>

      <td class="th2">
        <p><b>Pay To</b></p>
        <p> 
          Company : MandeClan </p>

      
       <!--  @if(!empty($admin_info->admin_gstin))<p> 
          GSTIN : {{$admin_info->admin_gstin}}
           </p>@endif
         
        @if(!empty($admin_info->admin_pan_card))<p> 
          PAN : {{$admin_info->admin_pan_card}}
           </p>@endif -->
          
        @if(!empty($admin_info->admin_email))<p> 
         Email : {{$admin_info->admin_email}} </p>@endif

        @if(!empty($admin_info->admin_mobile))<p> 
         Contact No : {{$admin_info->admin_mobile}} </p>@endif

       <!--  @if(!empty($admin_info->admin_website_url))<p> 
          Website :{{$admin_info->admin_website_url}} </p>@endif
        -->


        
        
      </td>
    </tr>
   </tbody>
</table>
<div class="border-bottom"></div>
<table class="table table3 table-bordered table-striped">
  <thead class="table-primary">
    <tr>
      <td style="width: 77%">Package Description</td>
        <td style="width: 10%">QTY</td>
      <td style="width: 13%"><div class="pull-right">Amount</div></td>
    </tr>
  </thead>
  <tbody>
   <tr>
      <td>{{$plans->service_plan_name}}&nbsp;{{$plans->service_product_limit}} Post &nbsp; </td>
      <td>1</td>
      <td><div class="pull-right"> {{number_format((float)$plans->service_plan_price, 2, '.', '')}}</div></td>
    </tr>
  </tbody>
</table>
<table class="table table4">
   <tbody>
  <tr>
    <td rowspan="5" style="width: 77%">
      <h3>Invoice Total</h3>
      <h2>$ {{number_format((float)$service_plan_invoice->service_total_amount, 2, '.', '')}} </h2>
    </td>
    {{-- <td style="width: 10%">Subtotal</td>
    <td style="width: 13%">:<div class="pull-right"> 00.00</div></td> --}}
  </tr>
  @if(!empty($service_plan_invoice->service_discount))
  <tr>
    <td>Discount ({{$service_plan_invoice->service_discount}}%)</td>
    <td>:<div class="pull-right">-{{number_format((float)$service_plan_invoice->service_discount_amount, 2, '.', '')}}</div></td>
  </tr>
  @endif
    @if(!empty($service_plan_invoice->service_subtotal))
  <tr>
    <td>Subtotal </td>
    <td>:<div class="pull-right">{{number_format((float)$service_plan_invoice->service_subtotal, 2, '.', '')}}</div></td>
  </tr>
  @endif
   @if(!empty($service_plan_invoice->admin_gst))
  <tr>
    <td>GST ({{$service_plan_invoice->admin_gst}}%)</td>

    <td>:<div class="pull-right">+ {{number_format((float)$service_plan_invoice->service_gst_amount, 2, '.', '')}} </div></td>
  </tr>
  @endif

  <tr>
    <td>Total</td>

    <td>:<div class="pull-right">{{number_format((float)$service_plan_invoice->service_total_amount, 2, '.', '')}}
</div></td>
  </tr>
   </tbody>
</table>


@if($service_plan_invoice->status=='Paid')
<table class="table table-bordered table-striped">
  <thead class="table-primary dark-primary">
    <tr>
      <td>Transaction Date</td>
      <td>Gateway</td>
      <td>Transaction ID</td>
      <td>Status</td>
      <td><div class="pull-right">Amount</div></td>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>{{date('d-m-Y', strtotime($service_plan_invoice->transaction_date))}}</td>
      <td>{{$service_plan_invoice->service_payment_gateway}}</td>
      <td>{{$plans->plan_transaction_id}}</td>
      <td>{{$service_plan_invoice->status}}</td>
      <td><div class="pull-right"> {{number_format((float)$service_plan_invoice->paid_amount, 2, '.', '')}}</div></td>
    </tr>
   {{--  <tr>
      <td colspan="4">Balance</td>
      <td><div class="pull-right"> 00.00</div></td>
    </tr> --}}
  </tbody>
</table>
@endif
</div>
<!--  -->
<style type="text/css">
@media only screen and (max-width: 600px) {
  body {
    background-color: lightblue;
  }
}
</style>
</body>
</html>