<html>
    <style>
        

{
	border: 0;
	box-sizing: content-box;
	color: inherit;
	font-family: inherit;
	font-size: inherit;
	font-style: inherit;
	font-weight: inherit;
	line-height: inherit;
	list-style: none;
	margin: 0;
	padding: 0;
	text-decoration: none;
	vertical-align: top;
}

/* content editable */

*[contenteditable] { border-radius: 0.25em; min-width: 1em; outline: 0; }

*[contenteditable] { cursor: pointer; }

*[contenteditable]:hover, *[contenteditable]:focus, td:hover *[contenteditable], td:focus *[contenteditable], img.hover { background: #DEF; box-shadow: 0 0 1em 0.5em #DEF; }

span[contenteditable] { display: inline-block; }

/* heading */

h1 { font: bold 100% sans-serif; letter-spacing: 0.5em; text-align: center; text-transform: uppercase; }

/* table */

table { font-size: 75%; table-layout: fixed; width: 100%; }
table { border-collapse: separate; border-spacing: 2px; }
th, td { border-width: 1px; padding: 0.5em; position: relative; text-align: left; }
th, td { border-radius: 0.25em; border-style: solid; }
th { background: #EEE; border-color: #BBB; }
td { border-color: #DDD; }

/* page */

html { font: 16px/1 'Open Sans', sans-serif; overflow: auto; padding: 0.5in; }
/*html { background: #999; cursor: default; }*/
body {  padding: 0.5in;}
/*body { box-sizing: border-box; height: 11in; margin: 0 auto; overflow: hidden; padding: 0.5in; width: 8.5in; }*/
/*body { background: #FFF; border-radius: 1px; box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5); }*/

/* header */

header { margin: 0 0 3em; }
header:after { clear: both; content: ""; display: table; }

header h1 { background: #000; border-radius: 0.25em; color: #FFF; margin: 0 0 1em; padding: 0.5em 0; }
header address { float: left; font-size: 75%; font-style: normal; line-height: 1.25; margin: 0 1em 1em 0; }
header address p { margin: 0 0 0.25em; }
header span, header img { display: block; float: right; }
header span { margin: 0 0 1em 1em; max-height: 25%; max-width: 60%; position: relative; }
header img { max-height: 100%; max-width: 100%; } 
header input { cursor: pointer; -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)"; height: 100%; left: 0; opacity: 0; position: absolute; top: 0; width: 100%; }

/* article */

article, article address, table.meta, table.inventory { margin: 0 0 3em; }
article:after { clear: both; content: ""; display: table; }
article h1 { clip: rect(0 0 0 0); position: absolute; }

article address { float: left; font-size: 125%; font-weight: bold; }

/* table meta & balance */

table.meta, table.balance { float: right; width: 36%; }
table.meta:after, table.balance:after { clear: both; content: ""; display: table; }

/* table meta */

table.meta th { width: 40%; }
table.meta td { width: 60%; }

/* table items */

table.inventory { clear: both; width: 100%; }
table.inventory th { font-weight: bold; text-align: center; }

table.inventory td:nth-child(1) { width: 26%; }
table.inventory td:nth-child(2) { width: 38%; }
table.inventory td:nth-child(3) { text-align: right; width: 12%; }
table.inventory td:nth-child(4) { text-align: right; width: 12%; }
table.inventory td:nth-child(5) { text-align: right; width: 12%; }

/* table balance */

table.balance th, table.balance td { width: 50%; }
table.balance td { text-align: right; }

/* aside */

aside h1 { border: none; border-width: 0 0 1px; margin: 0 0 1em; }
aside h1 { border-color: #999; border-bottom-style: solid; }

/* javascript */

.add, .cut
{
	border-width: 1px;
	display: block;
	font-size: .8rem;
	padding: 0.25em 0.5em;	
	float: left;
	text-align: center;
	width: 0.6em;
}

.add, .cut
{
	background: #9AF;
	box-shadow: 0 1px 2px rgba(0,0,0,0.2);
	background-image: -moz-linear-gradient(#00ADEE 5%, #0078A5 100%);
	background-image: -webkit-linear-gradient(#00ADEE 5%, #0078A5 100%);
	border-radius: 0.5em;
	border-color: #0076A3;
	color: #FFF;
	cursor: pointer;
	font-weight: bold;
	text-shadow: 0 -1px 2px rgba(0,0,0,0.333);
}

.add { margin: -2.5em 0 0; }

.add:hover { background: #00ADEE; }

.cut { opacity: 0; position: absolute; top: 0; left: -1.5em; }
.cut { -webkit-transition: opacity 100ms ease-in; }

tr:hover .cut { opacity: 1; }

@media print {
	* { -webkit-print-color-adjust: exact; }
	html { background: none; padding: 0; }
	body { box-shadow: none; margin: 0; }
	span:empty { display: none; }
	.add, .cut { display: none; }
}
.orderadd {
    border-radius: none; 
    border-style: none; 
    background: none;
    font-size:12px;
    font-weight: unset;
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


@page { margin: 0; }
    </style>
	<head>
		<meta charset="utf-8">
		<title>Invoice</title>
	</head>
	<body>
		<header>
			<h1> Invoice </h1>
			<address contenteditable>
				  @if($order->pickup_type=='Self Pickup')
				<p>{{$users->name}}</p>
				<p>{{$users->email}}</p>
				<p>{{$users->mobile}}</p>
				@else

				<p>{{$addressBook->name}}</p>
				<p>{{$addressBook->email}}</p>
				<p>{{$addressBook->mobile}}</p>

				@endif
			</address>
			<img width="100px" height="100px" src="{{url('/').'/resources/assets/image/logo-iamfresh.png'}}">
		</header>
		<article style="border: 1px solid #9999997d;padding: 3px;">
		    <table>
		        <tr>
		            <td> <table>
		            	  <tr>
		                    <th class="orderadd" style="font-weight:bold" >INVOICE NO :
@if(isset($order->order_u_id))
 {{$order->order_u_id}}
@elseif(isset($order->suborder_id))
 {{$order->suborder_id}}

@endif
		                 </th>
		                </tr>

		                <tr>
		                    <th class="orderadd" style="color:red" >Payment Mode : {{$order->payment_method}}</th>
		                </tr>
		                 <tr>
		                    <th class="orderadd">Order Date : {{date('d-M-y',strtotime($order->order_date))}}</th>
		                </tr>
		                 <tr>
		                    <th class="orderadd">Delivery Date : {{date('d-M-y',strtotime($order->delivery_date))}} </th>
		                </tr>
		                 <tr>
		                    <th class="orderadd">Delivery Slot : {{$order->delivery_time}}</th>
		                </tr>
		                </table>
		            </td>
		            <td>
		                 <table>
		                <tr>
		                    <th class="orderadd" style="font-weight:bold">Shipping Address</th>
		                </tr>
		                 @if($order->pickup_type=='Self Pickup')
		                 <tr>
		                    <th class="orderadd">  <span class="badge badge-light">
            {{$order->pickup_type}}   
            </span></th>
		                </tr>
		                
		                @else

		                 <tr>
		                    <th class="orderadd">{{$addressBook->address}}</th>
		                </tr>
		                 <tr>
		                    <th class="orderadd">@if(!empty($addressBook->localitys)){{$addressBook->localitys->locality_name}} @endif @if(!empty($addressBook->citys)), {{$addressBook->citys->city_name}} @endif  @if(!empty($addressBook->states)), {{$addressBook->states->state_name}} @endif @if(!empty($addressBook->countrys)) ,{{$addressBook->countrys->country_name}} @endif</th>
		                </tr>

		                @endif
		                
		                </table>
		            </td>
		        </tr>
		    </table>      
	
			
			<table class="inventory">
				<thead>
					<tr>

						<th width="50%"><span contenteditable>Item</span></th>
						<th width="20%"><span contenteditable>Price</span></th>
						<th width="15%"><span contenteditable>Quantity</span></th>
						<th width="15%"><span contenteditable>Weight</span></th>
						<th width="15%"><span contenteditable>Total</span></th>
					</tr>
				</thead>
				<tbody>
				 @foreach($order_items as $data)
					<tr>
						<td width="50%"><span contenteditable>{{$data->product_name}}</span>


@if(!empty($data->addon_name_price))
<br>
@foreach(unserialize($data->addon_name_price) as $value)

<span class="badge badge-light">{{$value}} 
</span>@endforeach

@endif
						</td>
						<td width="20%"><span contenteditable>$ {{$data->item_selling_price}}
@if($data->item_offer_discount)
           <del>{{ round($data->item_price,2) }}</del> <span class="text-danger">({{ $data->item_offer_discount }}% Off )</span>
@endif
						</span></td>
						<td width="15%"><span contenteditable>{{$data->item_quantity}}</span></td>
						@if(isset($data->item_shipping_weight))
						<td width="10%"><span contenteditable>{{$data->item_shipping_weight * $data->item_quantity}} {{$data->item_shipping_weight_unit}}</span></td>
					@else

          <td></td>
						@endif
						<td width="15%"><span contenteditable>$ {{$data->item_selling_price * $data->item_quantity}}</span></td>
					</tr>
				 @endforeach
				</tbody>
			</table>
			
			<table class="balance">
				<tr>
					<th><span contenteditable>Total</span></th>
					<td align="right"><span contenteditable>$ {{$order->subtotal}}</span></td>
				</tr>
				<tr>
					<th><span contenteditable>Tax ({{ $order->total_tax }}%)</span></th>
					<td align="right"><span contenteditable>$ {{$order->tax_price}}</span></td>
				</tr>

				<tr>
					<th><span contenteditable>Shipping Charges</span></th>
					<td align="right"><span contenteditable>$ {{$order->shipping_charges}}</span></td>
				</tr>
				<tr>
					<th><span contenteditable>Payable Amount</span></th>
					<td align="right"><span contenteditable>$ {{$order->grand_total}}</span></td>
				</tr>
			</table>
		</article>
		<aside>
			<h1><span contenteditable></span></h1>
			<div contenteditable>
				<p align="center">Thank you for making business with us.</p>
                <p align="center">We are always happy to serve you.</p>
			</div>
		</aside>
	</body>
</html>