<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		.center
		{
			text-align: center;
		}
		.logo-img{
	content: center;
      width: 60%;
      height: 50%;
      margin: auto;
    }
    .logo-img img 
    {
      position: absolute;
      width: 100%;
      height: 100%;
      margin: auto;
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
    <table align="center" cellspacing='0' cellpadding='0'>
<div align="center" style="width: 100%">

	<div align="center" class="center">
	<div class="logo-img">
		<img align="center" src="{{url('/').'/public/img/mandeclan_logo.jpg'}}">
	</div>
	<h2>Payment Transaction</h2>
	<h4><span>Thank you!</span> Your transaction is successful</h4>
	
	<p>Your payment using {{$customer_plan_invoice->customer_payment_gateway}} for transaction id {{$customer_plan_invoice->customer_invoice_id}} has been taken on {{date('d-m-Y H-m-s',strtotime($customer_plan_invoice->created_at))}} . We are processing the same and you will be notified for following numbers.</p>
	
	
	<tr class="center">
          <td bgcolor="#F5F8FA" style="padding: 30px 30px;">
              <p class="p1">Thanks,</p>
            <p class="p1"> Best Regards,<br>
             Team Mandeclan - The Power of Belief
            </p>
            <p style="margin:0 0 12px 0; font-size:16px; line-height:24px; color: #99ACC2; font-family:Avenir"> Made with &hearts; <p class="center"><a href="http://mandeclan.com">www.mandeclan.com</a></p> </p>
            <a href="#" style="font-size: 9px; text-transform:uppercase; letter-spacing: 1px; color: #99ACC2;  font-family:Avenir;"> Have any questions so far? Visit Mandeclan Support or contact us. </a>    
            <p class="p1">  </p>
          </td>
          </tr>
</div>
</div>
</table>

</body>
</html>