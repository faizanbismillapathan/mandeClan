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
      width: 261px;
      height: 50px;
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

 <style>
    table, td, div, h1, p {font-family: Arial, sans-serif;}
  </style>


  <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
    <tr>
      <td align="center" style="padding:0;">
        <table role="presentation" style="width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
          <tr>
            <td align="center" style="padding:40px 0 30px 0;background:#77c7e726">
              <img src="{{url('/').'/public/img/mandeclan_logo.jpg'}}" alt="" width="300" style="height:auto;display:block;" />
            </td>
          </tr>
          <tr>
            <td style="margin:20px;" class="center" >
              <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0; background:#77c7e726">
                <tr>
                  <td style="padding:0 0 36px 0;color:#153643;">
                      <p style="padding:30px" class="user-name">Hi, {!! $enquiry['name'] !!}</p>
                    <h1 style="font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;">Email Verification OTP</h1>
                  <p style="margin:0 0 12px 0;font-size:36px;line-height:25px;font-family:Arial,sans-serif; color: darkblue">{{$enquiry['otp']}}</p>
                    <p style="margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;"><a href="" style="color: green ;text-decoration:none;">Verification</a></p>
                  </td>
                </tr>
                
              </table>
            </td>
          </tr>
          <tr>
           
            
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
              <table role="presentation" bgcolor="black" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Arial,sans-serif;">
                <tr>
                  <td style="padding:0;width:50%;" align="left">
                    <p style="margin:0;font-size:14px;line-height:16px;font-family:Arial,sans-serif;color:#ffffff;">
                      &reg; Copy Right mande clan | 2021<br/>
                    </p>
                  </td>
                  <td style="padding:0;width:50%;" align="right">
                    <table role="presentation" style="border-collapse:collapse;border:0;border-spacing:0;">
                      <tr>
                        <td style="padding:0 0 0 10px;width:38px;">
                          <a href="http://www.twitter.com/" style="color:#ffffff;"><img src="https://assets.codepen.io/210284/tw_1.png" alt="Twitter" width="38" style="height:auto;display:block;border:0;" /></a>
                        {{-- Facebook |   --}}
                        </td>
                        <td style="padding:0 0 0 10px;width:38px;">
                              {{-- Instagram --}}
                          <a href="http://www.facebook.com/" style="color:#ffffff;"><img src="https://assets.codepen.io/210284/fb_1.png" alt="Facebook" width="38" style="height:auto;display:block;border:0;" /></a>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>







</body>
</html>