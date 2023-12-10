<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/bootstrap-material-design.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/all.css') }}">
        <link href="https://fonts.googleapis.com/css?family=Marcellus&display=swap" rel="stylesheet">
    <style type="text/css">
        .error-page-body
{
background-color: #ffffff;
}
.error-pages h1
{
color: #f01f8e;
    text-align: center;
    font-size: 150px;
    font-family: 'Marcellus', serif;
    margin-bottom: 10px;
}
.error-pages .vertical-align-outer-div
{
display: table;
    height: 100vh;
    width: 100%;
    overflow: hidden;
}
.error-pages .vertical-align-inner-div
{
    display: table-cell;
    vertical-align: middle;
}
.error-pages .p1
{
text-align: center;
color: #000000;
font-size: 30px;
}
.error-pages .p2
{
color: #777777;
text-align: center;
font-size: 16px;
margin-top: 30px;
font-family: 'Marcellus', serif;
}
.error-pages .largr-text
{
color: #ffffff;
text-transform: uppercase;
font-size: 80px;
letter-spacing: 4px;
font-family: 'Marcellus', serif;
}
.error-pages .btn i
{
padding-right: 6px;
}
.error-pages .btn
{
border-radius: 25px;
padding: 9px 20px;
margin-top: 20px;
font-size: 14px;
text-transform: capitalize;
}
.bg-img
{
background-image: url('{{asset('public/img/error-page-backgroud.png')}}');
background-size: contain;
background-position: center;
}
.center
{
    text-align: center;
}
    </style>

    </head>

<body class="error-page-body">
    <!--  -->
    <div class="error-bg-color">
        <div class="row margin0">
            <div class="col-md-6 padding0">
                <div class="error-pages">
                    <div class="vertical-align-outer-div">
                       <div class="vertical-align-inner-div">
                             <h1>403</h1>
                           <p class="p1">Forbidden</p>
                           <p class="p2">You do not have permission to access thid Page.</p>
                           <div class="center">
                                <a href="{{url('/'.Session::get('locality_url'))}}">
                                   <button type="button" class="btn btn-outline-light"><i class="fas fa-home"></i> Go to Home Page</button>
                                </a>
                           </div>
                       </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 padding0 bg-img"></div>
        </div>
    </div>
</body>
</html>