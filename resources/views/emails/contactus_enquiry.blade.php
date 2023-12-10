<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
      width: 70%;
      height: 50%;
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
      width: 100%;
      /*margin: 0 auto;*/
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
    
 
<table align="center" style='border: 3px solid #ccc' cellspacing='0' cellpadding='0'>
<div align="center" style="width: 100%">
       
      <div class="panel-header">
      <div class="logo-img">

                 <img src="{{url('/').'/public/img/mandeclan_logo.jpg'}}">
      </div>
    </div>
 
 

    <tr style="width: 100%">
        <td style='width: 100%'>
            <table style='padding: 10px;'>
                
                <tr style="font-size: 16px">
                    <td>Name</td>
                    <td>:</td>
                    <td> {{$contact_us->name}}</td>
                </tr>
                <tr style="font-size: 16px">
                    <td>Mobile no. </td>
                    <td>:</td>
                    <td>{{$contact_us->mobile_no}}</td>
                </tr>
                <tr style="font-size: 16px">
                    <td>Email Id </td>
                    <td>:</td>
                    <td>{{$contact_us->email}}</td>
                </tr>
                 <tr style="font-size: 16px">
                    <td>Message</td>
                    <td>:</td>
                    <td>{{$contact_us->message}}</td>
                </tr>
             
                 <tr style="font-size: 16px">
                    <td>Date</td>
                    <td>:</td>
                    <td>
{{date('d-M-Y',strtotime($contact_us->created_at))}}</td>
                </tr>
               
                
            </table>
        </td>
     
    </tr>
   

<tr class="center" style="width: 100%">
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
</table>
 </body>
</html>