<?php

$categories = DB::table('store_categories')
    ->orderby('sort', 'asc')
    ->where('status', 'Active')
    ->get();

$servic_categories = DB::table('service_categories')
    ->orderby('sort', 'asc')
    ->where('status', 'Active')
    ->get();

$localities = App\locality::where('status', 'Active')->paginate(43);

$fullurl = \Request::fullurl();
$segments_ss = \Request::segment(1);

$cart_count = Cart::getContent()->count();

if (!Auth::guest() && Auth::user()->role == 3) {
}

?>



<div class="laptop-hide mobile-menu">
    <div class="row margin0">
        <div class="col-xs-1 padding0">
            <div class="image menu-bar">
                <img src="http://mandeclan.com/public/frontend/img/mobile-menu.png">
            </div>
        </div>

        <div class="col-xs-10" id="currentlocation_modal">

            <button type="button" class="btn btn-light" data-toggle="modal" data-target="#currentlocation1111"> <i
                    class="fa fa-map-marker pe-2" aria-hidden="true"></i>
                <span>{{ Session::get('locality_name') }}</span> <i class="fas fa-caret-down"></i>
                <div class="ripple-container"></div>
            </button>

        </div>



        <div class="col-xs-1 padding0">
            <div class="pull-right">
                <a href="http://mandeclan.com/view-cart">
                    <div class="card-image">
                        <span class="mobile-cart-count">0</span>
                        <img src="http://mandeclan.com/public/frontend/img/online-supermarket-cart.png">
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<header class="mobile-header" style="display:none">
    <img src="{{ url('/') }}/frontend/img/delete-button.png " class="close-btn laptop-hide">
    <div class="container-fluid">
        <div class="row margin0">
            <div class="col-md-6 col-sm-6 padding0 first-navbar">

                <div class="laptop-hide">
                    <a href="{{ url('/' . Session::get('locality_url')) }}">
                        <div class="logo" style="margin:auto">
                            <img src="{{ asset('/img/mandeclan_black.png') }}">
                        </div>
                    </a>
                </div>
                <a href="{{ url('/' . Session::get('locality_url')) }}" style="display:none" class="showWhenCityNot">
                    <div class="logo-image">
                        <img src="{{ asset('/img/mandeclan_logo.jpg') }}" width="70px">
                    </div>
                    <!-- <h4>Mande Clan</h4> -->
                </a>

                <ul id="currentlocation_modal" style="display:none" class="d-none d-sm-block">

                    <button type="button" class="btn btn-light d-none d-sm-block" data-toggle="modal"
                        data-target="#currentlocation1111"> <i class="fa fa-map-marker pe-2" aria-hidden="true"></i>
                        <span>{{ Session::get('locality_name') }}</span> <i class="fas fa-caret-down"></i>
                        <div class="ripple-container"></div>
                    </button>

                </ul>
            </div>
            <div class="col-md-6 col-sm-6 padding0">
                <div class="pull-right mobile-pull-left">
                    <ul class="inline-block">


                        <a href="{{ url('/about-us') }}">
                            <li class="d-block d-sm-none ">About us</li>
                        </a>
                        <a href="{{ url('/careers') }}">
                            <li class="d-block d-sm-none ">Career</li>
                        </a>
                        <a href="{{ url('/business-with-us') }}">
                            <li class="d-block d-sm-none ">Business with us</li>
                        </a>
                        <a href="{{ url('/faqs') }}">
                            <li class="d-block d-sm-none">FAQ's</li>
                        </a>


                        @if (Auth::guest())
                            <a href="{{ url('/customer-login') }}">
                                <li style="cursor:pointer;">Login/Sign Up</li>
                            </a>
                        @else
                            @if (Auth::user()->role == '1')
                                <a href="{{ url('admin/dashboard') }}">
                                    <li><i class="far fa-user"></i> Admin || {{ strtok(Auth::user()->name, ' ') }}</li>
                                </a>
                            @elseif(Auth::user()->role == '2')
                                <a href="{{ url('seller/dashboard') }}">
                                    <li><i class="far fa-user"></i> Marchant || {{ strtok(Auth::user()->name, ' ') }}
                                    </li>
                                </a>
                            @elseif(Auth::user()->role == '3')
                                <a href="{{ url('customer/dashboard') }}">
                                    <li><i class="far fa-user"></i> Welcome {{ strtok(Auth::user()->name, ' ') }}</li>
                                </a>
                            @elseif(Auth::user()->role == '5')
                                <a href="{{ url('service/dashboard') }}">
                                    <li><i class="far fa-user"></i> Marchant || {{ strtok(Auth::user()->name, ' ') }}
                                    </li>
                                </a>
                            @endif


                        @endif


                        <a href="{{ url('/view-cart') }}">
                            <li id="shopping_cart"><span id="changecartcounter">{{ $cart_count }}</span><img
                                    src="{{ url('/') }}//frontend/img/online-supermarket-cart.png"></li>
                        </a>





                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>


<div class="padding mande-main-category">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <a href="{{ url('/' . Session::get('locality_url')) }}">
                    <div class="logo-image1">
                        <img src="{{ asset('/img/mandeclan_black.png') }}">
                    </div>
                </a>
            </div>
            <div class="col-md-1">
            </div>
            <div class="col-md-9">
                <div class="row">
                    @if (!empty($categories))
                        @foreach ($categories as $index => $data)
                            @if ($index < 6)
                                <div class="col-md-2">
                                    <a
                                        href="{{ url(Session::get('locality_url') . '/' . $data->category_url . '/store-list') }}">
                                        <div class="div-box-shadow">
                                            <div class="images">
                                                @if (!empty($data->category_thumbnail_img))
                                                    <img
                                                        src="{{ url('//images/category_thumbnail_img/' . $data->category_thumbnail_img) }}">
                                                @else
                                                    <img src="{{ url('/') }}/frontend/img/Mande-Clan.png">
                                                @endif
                                            </div>
                                            <p>{{ $data->category_name }}</p>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    @endif

                    <div class="col-md-2">
                        <a href="#morecategory" data-toggle="modal" data-target="#view_more_category">
                            <div class="div-box-shadow">
                                <!-- <div class="more-product div-box-shadow"> -->

                                <div class="images">
                                    <!-- <img src="{{ url('/') }}//frontend/img/Default-image.png" class="img1"> -->
                                    <img src="{{ url('/') }}/frontend/img/Mande-Clan.png" class="img1">
                                </div>
                                <p>View More</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<style type="text/css">
    .locate-me {
        background-color: rgba(255, 255, 255, 0.3);
    }

    .input-group-text {

        font-weight: 500;
        line-height: 1.5;
        color: #b35218;

    }

    #currentlocation1111 .input-group-text img {
        filter: invert(100%);
        width: 30px;
        height: 30px;
        margin-right: 0px;
        margin-top: 0px;
    }


    #selectcity .modal-dialog-xl,
    #view_more_category .modal-dialog-xl {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
    }

    #selectcity .modal-content,
    #view_more_category .modal-content {
        height: auto;
        min-height: 100%;
        border-radius: 0;
    }

    .fade.show {
        opacity: 1;
        padding-left: 0px !important;
    }

    .view_more_category .modal-body {
        padding: 40px;
    }

    .view_more_category .rowimg {
        padding: 20px;
    }

    .view_more_category p {
        text-transform: capitalize;
        letter-spacing: 0.8px;
        font-size: 14px;
        margin-top: 5px;
    }

    .mandeclanmsg {
        text-align: center;
        maring-top: 10px;
        margin-bottom: 30px;
        font-weight: bold;
        font-size: 20px;
        color: #b35218
    }
</style>





<!-- ......................................... -->



<div class="modal bd-example-modal-xl selectcity-modal view_more_category" id="view_more_category" tabindex="-1"
    role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="padding-right: 0px!important;">
    <div class="modal-dialog-xl modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <p class="select-city">Categories</p>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <div class="pull-right">

                            <h4><i class="fa fa-times-circle close-img2 text-secondary" aria-hidden="true"
                                    data-dismiss="modal"></i></h4>

                            <!--<img src="{{ url('/frontend/img/close-icon2.png') }}" class="close-img2" data-dismiss="modal">-->
                        </div>
                    </div>
                </div>
                <div class="input-grp">
                    <div class="input-group">
                        <div class="input-group-append">
                            <img src="{{ url('/frontend/img/searching.png') }}">
                        </div>
                        <input type="text" class="form-control selector_categorys" placeholder="Search">
                    </div>
                </div>

                <div class="row rowimg cat_img_append">
                    @if (!empty($categories))
                        @foreach ($categories as $index => $data)
                            <div class="col-md-2">
                                <a
                                    href="{{ url(Session::get('locality_url') . '/' . $data->category_url . '/store-list') }}">
                                    <div class="div-box-shadow">
                                        <div class="images">
                                            @if (!empty($data->category_thumbnail_img))
                                                <img
                                                    src="{{ url('/images/category_thumbnail_img/' . $data->category_thumbnail_img) }}">
                                            @else
                                                <img src="{{ url('/') }}/frontend/img/Mande-Clan.png">
                                            @endif
                                        </div>
                                        <p>{{ $data->category_name }}</p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @endif

                    @if (!empty($servic_categories))
                        @foreach ($servic_categories as $index => $data)
                            <div class="col-md-2">
                                <a
                                    href="{{ url(Session::get('locality_url') . '/' . $data->category_url . '/vendor-service-list') }}">
                                    <div class="div-box-shadow">
                                        <div class="images">
                                            @if (!empty($data->category_thumbnail_img))
                                                <img
                                                    src="{{ url('/images/category_thumbnail_img/' . $data->category_thumbnail_img) }}">
                                            @else
                                                <img src="{{ url('/') }}/frontend/img/Mande-Clan.png">
                                            @endif
                                        </div>
                                        <p>{{ $data->category_name }}</p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @endif


                </div>

            </div>
        </div>
    </div>
</div>


@if (empty(Request::segment(1)))
    <script>
        $(window).on('load', function() {
            $('#currentlocation1111').modal('show');
        });
    </script>
@endif


<script>
    $(document).ready(function() {




        $('#findyourlocation').on('click', function(e) {
            e.preventDefault();

            // alert(e)
            navigator.geolocation.getCurrentPosition(function(position) {
                var lat = position.coords.latitude;
                var lng = position.coords.longitude;

                var urlloc =
                    'https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyBxm3cpfYPdG6Yk3Tv2yIrfBLtiKYlza5A&latlng=' +
                    lat + ',' + lng + '&sensor=false';

                $.ajax({
                    type: "GET",
                    url: urlloc,
                    beforeSend: function() {
                        $("#loader").show();
                    },
                    success: function(res) {
                        // console.log(res.results[0].formatted_address);
                        var addresscomponents = res.results[0].address_components;
                        var obj = {};
                        addresscomponents.forEach(function(address_componentdddd) {
                            obj[address_componentdddd.types[0]] =
                                address_componentdddd.long_name;
                        });
                        console.log(obj, 'objj');
                        var area = obj.political;
                        var city = obj.locality;
                        var pincode = obj.postal_code;
                        var country = obj.country;
                        var state = obj.administrative_area_level_1;
                        var searcharea = area.concat(city);

                        $('.CurrentLocationCls').val(area + ', ' + city + ', ' +
                            state);
                        $('.CurrentLocationCls').html(area + ', ' + city + ', ' +
                            state);


                        var place = area + "," + city + "," + pincode;


                        var newlocality = area.replace(" ", "-").toLowerCase();

                        // var getUrl = "{{ url('/') }}/"+newlocality;
                        //                 window.location.href = getUrl;


                        // alert(newlocality)
                        $.ajax({
                            type: "GET",
                            url: "{{ url('/homesearch') }}?place_name=" +
                                newlocality,
                            success: function(res) {
                                if (res == 1) {

                                    $(".mandeclanmsg").show();


                                } else {

                                    var sescityname = res;
                                    var getUrl =
                                        "{{ url('/') }}/" +
                                        sescityname;
                                    window.location.href = getUrl;
                                }

                            }
                        });


                        // $('#currentlocation1111').modal('toggle');

                    },
                    complete: function(data) {
                        $("#loader").hide();
                    }
                });
            });
        });


        $(".selectors").keyup(function() {

            var searchValue = $(this).val();

            // alert(searchValue)
            console.log(searchValue);
            var data;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $.ajax({
                url: "{{ url('append_search_localities') }}",
                type: "post",
                data: {
                    searchValue: searchValue
                },
                dataType: "json",
                success: function(data) {
                    console.log(data, 'filter');
                    $('.append_location').empty()

                    $.each(data, function(key, val) {


                        var link = val.locality_name.replace(' ', '-')
                            .toLowerCase();

                        $(document.body).find('.append_location').append(
                            '<div class="col-md-3"><a href="' + link +
                            '"><div class="row"><div class="col-md-1"><img src="{{ url('/') }}/frontend/img/current-location.png" class="black-image" width="17px"></div><div class="col-md-9"><h5>' +
                            val.locality_name + '</h5><p>' + val.city_name +
                            ', ' + val.state_name + ', ' + val.country_name +
                            '.</p></div></div></a></div>');
                    });
                }

            });


        });


        $(".selector_categorys").keyup(function() {

            var searchCat = $(this).val();

            // alert(searchCat)
            console.log(searchCat);
            var data;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ url('append_search_categories') }}",
                type: "post",
                data: {
                    searchCat: searchCat
                },
                dataType: "json",
                success: function(data) {
                    console.log(data, 'filter');
                    $('.cat_img_append').empty()

                    $.each(data, function(key, val) {
                        let link = val.category_name.toLowerCase();

                        var img =
                            "{{ url('/') }}/frontend/img/Mande-Clan.png";

                        if (val.category_thumbnail_img) {

                            var img =
                                "{{ url('/') }}/images/category_thumbnail_img/" +
                                val.category_thumbnail_img;

                        }

                        var url = "{{ url('/') }}/" +
                            "{{ Session::get('locality_url') }}" + "/" + link +
                            "/store-list";


                        $(document.body).find('.cat_img_append').append(
                            '<div class="col-md-2"><a href="' + url +
                            '"><div class="div-box-shadow"><div class="images"><img src="' +
                            img + '"></div><p>' + val.category_name +
                            '</p></div></a></div>');
                    });
                }

            });


        });

    });
</script>




<div class="modal bd-example-modal-xl selectcity-modal" id="currentlocation1111" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true" style="padding-right: 0px!important;">
    <div class="modal-dialog-xl modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <h4 class="select-city">Select City</h4>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <div class="pull-right">
                            <i class="fa fa-times-circle" aria-hidden="true" data-dismiss="modal"></i>

                        </div>
                    </div>
                </div>

                <div id='loader' style="display:none">
                    <div class="overlay">
                        <div class='loading gifload'>
                            <img src='<?= URL::to('/') ?>/frontend/img/loadera.gif' width='80px' height='80px'>
                        </div>
                    </div>
                </div>

                <div class="input-grp">
                    <div class="input-group">
                        <div class="input-group-append">
                            <img src="{{ url('/frontend/img/searching.png') }}">
                        </div>
                        <input type="text" class="form-control selectors CurrentLocationCls" placeholder="Search">
                        <div class="input-group-append">

                            <span class="input-group-text locate-me" id="findyourlocation"><img
                                    src="{{ url('/frontend/img/target.png') }}"> Get Current Location</span>

                        </div>

                    </div>
                </div>
                <div class="mandeclanmsg" style="display:none">Your current location cannot be determined with
                    Mandeclan stores!</div>
                <div class=" row item-list margin0 append_location">


                    @if (!empty($localities))
                        @foreach ($localities as $index => $data)
                            @php
                                if (empty($segments_ss)) {
                                    $var = url($data->locality_url);
                                } else {
                                    $var = str_replace($segments_ss, $data->locality_url, $fullurl);
                                }
                            @endphp

                            <div class="col-md-3">
                                <a href=" {{ $var }}">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <img src="{{ url('/') }}/frontend/img/current-location.png"
                                                class="black-image" width="17px">
                                        </div>
                                        <div class="col-md-9">
                                            <h5>{{ $data->locality_name }}</h5>
                                            <p>
                                                @if ($data->state)
                                                    {{ $data->city->city_name }}
                                                    @endif @if ($data->state)
                                                        , {{ $data->state->state_name }}
                                                        @endif @if ($data->country)
                                                            ,{{ $data->country->country_name }}
                                                        @endif.
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
