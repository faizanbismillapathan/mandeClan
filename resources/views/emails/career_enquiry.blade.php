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
      /*padding: 15px;*/
      width: 100%;
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
      /*padding-left: 20px;*/
      /*padding-right: 20px;*/
    }
  </style>
</head>
<body>
    
    <!-- Header --> 
  <table role="presentation" border="0" width="100%" cellspacing="0" style="margin-bottom: 5px; ">
  <tr>
    <td bgcolor="black" align="center" style="color: white; padding-top: 20px;">
      <img alt="Logo" src="{{url('/').'/public/img/mandeclan_logo.jpg'}}" width="200px">
      <h1 style="font-size: 18px; margin:0 0 20px 0; color: white;"> USA's Biggest Saving Online Marketplace.</h1>
    </tr>
      </td>
  </table>
    
   <div class='content'>
       <h2 class="center" style="margin-top:15; margin-bottom:10; font-size:20px;line-height:24px;font-family:Avenir;color:#FF7A59"> Career enquiry Details</h2>
         
         
      
<table style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Avenir" cellspacing='0' cellpadding='0'>
 
 

    <tr width="600px" class="" style='border: 1px solid #ccc'>
        <td>
            <table style='padding: 20px;'>
                
                <tr>
                    <td>Name</td>
                    <td>:</td>
                    
                    <td> {{$career->name}}</td>
                    
                </tr>
                <tr>
                    <td>Mobile</td>
                    <td>:</td>
                    
                    <td>{{$career->mobile_no}}</td>
                    
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    
                    <td>{{$career->email}}</td>
                    
                </tr>
                 <tr>
                    <td>message</td>
                    <td>:</td>
                    
                    <td>{{$career->message}}</td>
                    
                </tr>
                 <tr>
                 
                 <tr>
                    <td>Apply For</td>
                    <td>:</td>
                    
                    <td>{{$career->apply_for}}</td>
                    
                </tr>
                 <tr>
                    <td>Date</td>
                    <td>:</td>
                    <td>
                        
{{date('d-M-Y',strtotime($career->created_at))}}
                     </td>
                </tr>
               
            </table>
        </td>
     
    </tr>
</table>

</div>
<table  class="center" width="100%">
<tr>
          <td bgcolor="#F5F8FA" style="padding: 30px 30px;">
              <p class="p1">Thanks,</p>
            <p class="p1"> Best Regards,<br>
             Team Mandeclan - The Power of Belief
            </p>
            <p style="margin:0 0 12px 0; font-size:16px; line-height:24px; color: #99ACC2; font-family:Avenir"> Made with &hearts; <p class="center"><a href="http://mandeclan.com">www.mandeclan.com</a></p> </p>
            <a href="#" style="font-size: 9px; text-transform:uppercase; letter-spacing: 1px; color: #99ACC2;  font-family:Avenir;"> Have any questions so far? Visit Mandeclan Support or contact us. </a>    
            <p class="p1">  
</p>
          </td>
          </tr>
     </table>
   
 </body>
</html>