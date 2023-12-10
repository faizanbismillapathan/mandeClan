<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		.center
		{
			text-align: center;
		}
		.logo-img
		{
			position: relative;
    width: 200px;
    height: 56px;
    margin: 0 auto;
		}
		.logo-img img
		{
			position: absolute;
    width: 100%;
    height: 100%;
		}
		.invoice-div
		{
			border: 1px solid #f5f5f5;
			width: 80%;
			margin: 0 auto;
			padding: 40px
		}
		h4
		{
			color: #b51269;
		}
		h4 span
		{
			text-transform: capitalize;
		}
		h2
		{
			text-transform: uppercase;
		}
	</style>
</head>
<body>

<div class="invoice-div">
	<div class="logo-img">
		<img src="{{url('/').'/public/img/mandeclan_logo.jpg'}}">
	</div>
	<div class="center">
	<h2>Payment Transaction</h2>
	<h4><span>Thank you!</span> Your transaction is successful</h4>
	<p>Your payment using {{$store_plan_invoice->store_payment_gateway}} for transaction id {{$store_plan_invoice->store_invoice_id}} has been taken on {{date('d-m-Y H-m-s',strtotime($store_plan_invoice->created_at))}} . We are processing the same and you will be notified for following numbers.</p>
</div>
</div>

</body>
</html>