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
    <div class="panel-header">
      <div class="logo-img">

                 <img src="{{url('/').'/public/img/mandeclan_logo.jpg'}}">
      </div>
    </div>
    
   <div class='content'>
      
<table style='width: 100%; border: 1px solid #ccc' cellspacing='0' cellpadding='0'>
 
 

    <tr style='border: 1px solid #ccc'>
        <td style='width: 50%; border-right: 1px solid #ccc;'>
            <table style='padding: 10px;'>
                
                <tr>
                    <td>Name</td>
                    <td>:</td>
                    
                    <td> {{$service['store_owner_name']}}</td>
                </tr>
                <tr>
                    <td>Email Id</td>
                    <td>:</td>
                    
                    <td>{{$service['store_email']}}</td>
                   
                </tr>
                <tr>
                    <td>Mobile</td>
                    <td>:</td>
                    
                    <td>{{$service['store_owner_mobile']}}</td>
                   
                </tr>
                 <tr>
                    <td>Gender</td>
                    <td>:</td>
                    
                    <td>{{$service['store_owner_gendor']}}</td>
                   
                </tr>
                 <tr>
                    <td>Category</td>
                    <td>:</td>

                        
                        <td>{{$service['category_name']}}</td>
                       
                       
                </tr>
                 <tr>
                    <td>Store Name</td>
                    <td>:</td>
                    
                    <td>{{$service['store_name']}}</td>
                   
                </tr>
                 <tr>
                    <td>Date</td>
                    <td>:</td>
                    
                    <td>{{date('d-M-Y',strtotime($service['created_at']))}}</td>
                    
                </tr>
                 <tr>
                    <td>Website</td>
                    <td>:</td>
                     <td>{{$service['store_website']}}</td>
                   
                </tr>

                {{-- <tr>
                    <td>Description</td>
                    <td>:</td>
                    <td>
{{$service['store_description']}}</td>
                </tr> --}}
                   <tr>
                    <td>City</td>
                    <td>:</td>
                    
                    <td>{{$service['city_name']}}</td>
                   
                </tr>
                  <tr>
                    <td>Locality</td>
                    <td>:</td>
                    
                    <td>{{$service['locality_name']}}</td>
                   
                </tr> <tr>
                    <td>Pincode</td>
                    <td>:</td>
                    
                    <td>{{$service['store_pincode']}}</td>
                   
                </tr>
                
            </table>
        </td>
     
    </tr>
</table>
     
   </div>

 </body>
</html>