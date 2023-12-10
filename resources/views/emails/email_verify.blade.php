<!DOCTYPE html>
<html>
<head>
	<title></title>
<style type="text/css">
    body
    {
      background-color: #cccccc78;
      padding: 30px;
    }
    *
    {
      font-family: 'Lato', sans-serif;
      font-weight: 500;
    }
    .logo-img
    {
      position: relative;
      width: 99px;
      height: 77px;
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
      padding: 15px;
      width: 60%;
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
        color: #000 !important;
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
    }
    h1
    {
        text-transform: uppercase;
        text-align: center;
        margin-bottom: 30px;
        font-size: 20px;
        color: #000;
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
      padding-left: 20px;
      padding-right: 20px;
    }
  </style>
</head>
<body>

 <div class="panel-header">
      <div class="logo-img">
<img src="{{url('/').'/public/img/mandeclan_logo.jpg'}}">
      </div>
    </div>
<div class="content">
       <h1>Confirm Your Mandeclan Email</h1>
       <div class="content-body">
            <p class="user-name">Hi, {!! $enquiry['name'] !!}</p>
            <p class="p1">Verify your email address so we know it’s really you—and so we can send you important information about your Mandeclan account.</p>
            <p class="p1 center"><a href="{{url('/verify/'.$enquiry['user_id'])}}" class="btn btn-success">verify email address</a></p>
           
            <p class="p1">Have any questions so far? Visit Mandeclan Support or contact us.  
</p>
            <p class="p1">Thanks,</p>
            <p class="p1"> Best Regards,<br>
             Team Mandeclan - The Power of Belief
            </p>
         </div>
   </div>


{{--   <div class="content">
	
	

      <div class="logo-img">
		<img src="{{url('/').'/public/img/mandeclan_logo.jpg'}}">
	    </div>
       <h1>Verify Your Mandeclan Email</h1>
       <div class="content-body">
            <p class="user-name">Hi, {!! $enquiry['name'] !!}</p>
            <p class="p1">Verify your email address so we know it’s really you—and so we can send you important information about your Mandeclan account.</p>
            <p class="p1 center"><a href="{{url('/vendor-login?verify='.$enquiry['user_id'])}}" class="btn btn-success">verify  {{url('/verify/'.$enquiry['user_id'])}}
            <p class="p1 center"><a href="{{url('/verify/'.$enquiry['user_id'])}}" class="btn btn-success">verify email address</a></p>
          
        </div>
            


<tr style="width: 100%" class="center" align="center">
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

</div> --}}

</body>
</html>