<?php

$categories = DB::table('store_categories')
    ->orderby('sort', 'asc')
    ->where('status', 'Active')
    ->get();

$pages = DB::table('pages')
    ->orderby('id', 'asc')
    ->where('status', 'Active')
    ->get();
?>

<style type="text/css">
    .footertop,
    .diva {
        background-color: #646464;
        color: #fff;
    }

    .footertop .aboutwd .linkinner ul {
        list-style-type: none;
        width: 100%;
    }

    .footertop .aboutwd .linkinner ul li {
        padding: 2px 0px;
    }

    .footertop .aboutwd .linkinner ul li a {
        /*    color: #6c6c6c;
*/
        font-size: 13px;
        letter-spacing: 0.3px;
    }

    .footerflip {
        clear: both;
        line-height: 18px;
        font-size: 14px;
        /*margin: 30px 0 15px;*/
        padding: 40px 70px;
    }

    .footerflip h1 {
        font-size: 16px;
        margin-bottom: 10px;
        font-weight: bold;
    }

    .footerflip h2,
    .footerflip h3,
    .footerflip h4 {
        font-size: 14px;
        margin-bottom: 10px;
        font-weight: bold;
    }

    .caption-text {
        text-align: center;
        font-size: 14px;
        font-weight: 400;
        line-height: 20px;
        max-width: 140px;
        margin: auto;
        color: #787878;
    }

    .supply-text {
        font-weight: 500;
        font-size: 18px;
        text-align: center;
        margin-bottom: 4px;
    }

    .green {
        font-size: 14px;
    }


    h5 {
        font-weight: bold;
    }

    a:hover {
        color: orange;
        font-size: 14px !important;

    }
</style>

<nav class="breadcrumb-nav">
    <div class="breadcrumb-padding">
        <div class="container-fluid">
            <ol class="breadcrumb">

            </ol>
        </div>
    </div>
</nav>
<footer class="">

    <div class="footertop padding">
        <div class="container-fluid">

            <div class="row margin0 footer_row2">




                <div class="col-md-2 d-none d-sm-block">
                    <div class="aboutwd">
                        <h5>Categories</h5>
                        <div class="linkinner">
                            <ul class="row margin0">

                                @foreach ($categories as $index => $data)
                                    @if ($index < 6)
                                        <li class="col-md-12 col-xs-6 padding0"><a
                                                href="{{ url(Session::get('locality_url') . '/' . $data->category_url . '/store-list') }}    ">
                                                <span>{{ $data->category_name }}</span></a></li>
                                    @endif
                                @endforeach




                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-2 d-none d-sm-block">
                    <div class="aboutwd">
                        {{-- <h5>Categories</h5> --}}

                        <br>
                        <div class="linkinner" style="margin-top: .5rem;">
                            <ul class="row margin0">


                                @foreach ($categories as $index => $data)
                                    @if ($index >= 6 && $index < 11)
                                        <li class="col-md-12 col-xs-6 padding0"><a
                                                href="{{ url(Session::get('locality_url') . '/' . $data->category_url . '/store-list') }}    ">
                                                <span>{{ $data->category_name }}</span></a></li>
                                    @endif
                                @endforeach




                            </ul>
                        </div>
                    </div>
                </div>



                <div class="col-md-2 d-none d-sm-block">
                    <div class="aboutwd">
                        <h5>About</h5>
                        <div class="linkinner">
                            <ul class="row margin0">

                                <li class="col-md-12 col-xs-6 padding0"><a href="{{ url('/contact-us') }}">
                                        <span>Contact us</span></a></li>
                                <li class="col-md-12 col-xs-6 padding0"><a href="{{ url('/careers') }}">
                                        <span>Career</span></a></li>
                                <li class="col-md-12 col-xs-6 padding0"><a href="{{ url('/business-with-us') }}">
                                        <span>Business with us</span></a></li>
                                <li class="col-md-12 col-xs-6 padding0"><a href="{{ url('/faqs') }}">
                                        <span>FAQ's</span></a></li>
                                <li class="col-md-12 col-xs-6 padding0"><a href="{{ url('/our-team') }}"> <span>Our
                                            Team</span></a></li>


                            </ul>
                        </div>
                    </div>
                </div>





                <div class="col-md-2 d-none d-sm-block">
                    <div class="aboutwd">
                        <h5>Policy</h5>
                        <div class="linkinner">
                            <ul class="row margin0">


                                @if (!empty($pages))
                                    @foreach ($pages as $index => $data)
                                        <li class="col-md-12 col-xs-6 padding0"><a href="{{ url($data->page_slug) }}">
                                                <span>{{ $data->page_name }}</span></a></li>
                                    @endforeach
                                @endif

                                {{-- <li class="col-md-12 col-xs-6 padding0"><a href="{{url('/privacy-policy')}}"> <span>Return Policy</span></a></li>
<li class="col-md-12 col-xs-6 padding0"><a href="{{url('/terms-and-conditions')}}"> <span>Terms & Conditions</span></a></li>
<li class="col-md-12 col-xs-6 padding0"><a href="{{url('/security')}}"> <span>Security</span></a></li>
<li class="col-md-12 col-xs-6 padding0"><a href="{{url('/about-us')}}"> <span>About Us</span></a></li>
 --}}
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-2 d-none d-sm-block">
                    <div class="aboutwd">
                        <h5>Social Media</h5>
                        <div class="linkinner">
                            <ul class="row margin0">


                                <li class="col-md-12 col-xs-6 padding0"><a href="#"> </i>
                                        <span>Facebook</span></a></li>
                                <li class="col-md-12 col-xs-6 padding0"><a href="#"> </i><span>Twitter</span></a>
                                </li>
                                <li class="col-md-12 col-xs-6 padding0"><a href="#"> </i> <span>YouTube</span></a>
                                </li>


                            </ul>
                        </div>
                    </div>
                </div>




                <div class="col-md-2">
                    <div class="aboutwd">
                        <h5>Download</h5>
                        <div class="linkinner">
                            <ul class="row margin0">

                                <li>
                                    <img src="{{ url('/') }}/frontend/img/apple-store.png">
                                </li>
                                <div class="p-2">

                                </div>
                                <li>
                                    <img src="{{ url('/') }}/frontend/img/goggle-play-store.png">
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>







            </div>
        </div>
    </div>

    <!-- ................................... -->
    <div class="footer diva">
        <div class="container-fluid">


        </div>
    </div>
    <div class="padding green divb">
        <div class="container-fluid">
            <p> <i class="fa fa-copyright" aria-hidden="true"></i> 2020 All rights reserved by MandeClan</p>
        </div>
    </div>
</footer>
