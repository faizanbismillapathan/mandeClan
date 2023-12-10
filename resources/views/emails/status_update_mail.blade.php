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
		}.center
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
	</style>
</head>
<body>

<div class="invoice-div">
	<div class="logo-img">
		<img src="{{url('/').'/public/img/mandeclan_logo.jpg'}}">
	</div>
	<div class="center">
	<h2>MandeClan {{$enquiry['type']}} Enquiry Feedback By Admin</h2>
	<h4>Dear {{$enquiry['name']}} your sending enquiry for {{$enquiry['category']}} {{$enquiry['status']}} by admin at {{date('d-m-Y H-m-s',strtotime($enquiry['updated_at']))}} </h4>
	
	 <div class="footer">
      <p class="center">Gor For<a href="http://mandeclan.com/vendor-login">www.mandeclan.com</a> And Login BY mobile otp</p>
     </div>
</div>
</div>

</body>
</html>