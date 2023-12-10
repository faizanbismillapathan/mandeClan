<!DOCTYPE html>
<html>
<head>
	<title></title>
	
	<style type="text/css">
    body
    {
      background-color: #cccccc78;
      padding: 5px;
    }
    *
    {
      font-family: 'Lato', sans-serif;
      font-weight: 500;
    }
    .logo-img
    {
      position: relative;
      width: 100px;
      height: 100px;
      margin: 0 auto;
    }
    .logo-img img 
    {
      position: absolute;
      width: 100%;
      height: 100%;
    }
    .content
    {
      background-color: #fff;
      /*padding: 15px;*/
      /*width: 60%;*/
      margin: 0 auto;
    }
    .panel-header{
        padding: 15px;
        width: 60%;
        margin: 0 auto;
        margin-top: 40px;
        background: #fff;
        margin-bottom: 5px;
    }
    .center
    {
      text-align: center;
    }
    .btn-success
    {
        color: #fff !important;
        background: unset;
        text-transform: capitalize;
        padding: 8px 16px;
        font-size: 18px;
        margin-bottom: 0px;
        border-radius: 6px;
        background-image: linear-gradient(253deg,#1a73e8 0,#093d82 100%);
    }
        
    div {
        display: block;
    }
    a 
    {
      color: #ec248e;
      text-decoration: none;
      font-size: 18;
    }
    h5
    {
        text-transform: uppercase;
        text-align: center;
        margin-bottom: 30px;
        font-size: 16px;
        color: orange;
    }
    .user-name
    {
        font-weight: 600;
        font-size: 16px;
        margin-bottom: 15px;
    }
    .p1
    {
        color: #564b4b;
        line-height: 25px;
    }
    .congratulations-text
    {
      font-size: 22px;
      font-weight: 600;
      margin-bottom: 20px;
      text-align: center;
      color: #b52260;
    }
    .content-body
    {
backgroung-color: gray;
    }
  </style>
  
	<style type="text/css">
		.center
		{
			text-align: center;
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
      color: gray;
      font-size: 15px;
    }
    .footer
    {
      padding: 10px;
    }
	</style>
</head>
<body>

<div class="invoice-div">
	<div class="logo-img">
		<img src="{{url('/').'/public/img/mandeclan_logo.jpg'}}">
	</div>
   <h3>{{$enquiry['subject']}}</h3>
	<h4><p class="user-name">Hi, {{$enquiry['name']}}</p></h4>
	<h4>Message : <p class="p1">{{$enquiry['message']}}</p></h4>
	
	<div class="center">
	    <p class="p1">Thank You...</p>
            <p class="p1"> Best Regards,<br>
             Team Mandeclan - The Power of Belief
            </p>
            
             <p class="">Have any questions so far? Visit Mandeclan Support or contact us.  
</p>
	 <div class="footer">
      <p class="center"><a href="http://mandeclan.com">www.mandeclan.com</a></p>
     </div>
</div>
</div>

</body>
</html>