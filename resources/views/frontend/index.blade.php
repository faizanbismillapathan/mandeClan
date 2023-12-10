@extends('frontend.layouts.app')
@section('title',"Online Shopping site in US: Shop Online for Mobiles, Books, Watches, Shoes and More - mandeclan.com")
<!-- ................Add meta ................ -->


@section('meta')
@endsection

<!-- ................custom css................. -->

@section('customStyle')
<style type="text/css">
    .title-heading-new{
        text-align: center;
        font-family: 'Bitter', serif;
        text-align: center;
    }
      #currentlocation_modal{
        display: block!important;
    }
     .online-mande .btn
    {
        box-shadow: unset;
        width: 60%;
    }
    .mandeclan-upload-steps span{
        font-size: .813rem;
        width: 1.8rem;
        height: 1.8rem;
        border: solid 2px #fff;
        color: #fff;
        text-align: center;
        border-radius: 100%;
        line-height: 1.375rem;
        font-weight: 500;
        margin-right: 1rem;
        margin-bottom: .563rem;
    }
</style>
@endsection

<!-- ................Add css link................. -->

@push('style')
@endpush

<!-- ................body................. -->
@section('innercontent')


<!--  -->
<div class="banner home-banner">
    <div class="banner-overlay">
        <h4>USA's Biggest Saving Online Marketplace.</h4>
    </div>
</div>
<!--  -->
<div class="about-mande-clan d-block d-sm-block">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="img">
                    <img class="mw-100" src="{{url('/')}}/public/frontend/img/mande.jpg">
                </div>
            </div>
            <div class="col-md-6 col2">
                <div class="padding p-2">
                    <h4>Mande Clan</h4>
                    <p>Shopping with Mande Clan is very simple, easy and convenient. Now get a hassle-free service by sitting at your home or office, no need to carry heavy bags or get in the dilemma of Store's/Malls shopping parking.</p>
                    <p class="p2">Customers can choose from a wide range of products at a discounted price from different shops. Just select a time slot for home delivery and your order will be delivered at your doorstep, anywhere in Nagpur. You can choose from online payment or cash on delivery. We guarantee on-time delivery and the best quality products! Happy Shopping with Mande Clan!</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!--  -->


<nav class="breadcrumb-nav">
 <div class="breadcrumb-padding">
  <div class="container-fluid">
      <div class="breadcrumb">
          <!-- <h4 style="margin: 0 auto;" class="title-heading-new">How it works</h4> -->
          
      </div>
  </div>
</div>
</nav>


<div class="row">

        <!--<img style="margin-left: 50px" src="{{asset('public/frontend/img/frontend_img.png')}}" width="">-->
        <div class="container py-4">
        <div class="row text-center align-center py-4">
            <div class="col-3">
                <div>
                    <h1>
                        <i class="fa fa-users text-warning" aria-hidden="true"></i>
                    </h1>
                    <h6>1 lakh+ </h6>
                    <small class="text-muted d-none d-sm-block">Suppliers are selling
                        commission-free
                    </small>
                </div>
            </div>
            <div class="col-3">
                <div>
                    <h1>
                        <i class="fa fa-map-marker text-warning" aria-hidden="true"></i>
                    </h1>
                    <h6>24000+ </h6>
                    <small class="text-muted d-none d-sm-block">
                        Pincodes supported
                        for delivery

                    </small>
                </div>
            </div>
            <div class="col-3">
                <div>
                    <h1>
                        <i class="fa fa-shopping-cart text-warning" aria-hidden="true"></i>
                    </h1>
                    <h6>Crores of </h6>
                    <small class="text-muted d-none d-sm-block">
                        Customers buy
                        accross India

                    </small>
                </div>
            </div>
            <div class="col-3">
                <div>
                    <h1>
                        <i class="fa fa-th-large text-warning" aria-hidden="true"></i>
                    </h1>
                    <h6>700+ </h6>
                    <small class="text-muted d-none d-sm-block">Categories to sell

                    </small>
                </div>
            </div>
        </div>

    </div>

    

    
</div>

<div class="padding gray category-list morecategory" id="morecategory">
    <div class="container-fluid">
        <h4 class="title-heading">Categories <br class="p-4">
    <div class="border justify-center text-center align-center bg-secondary border-secondary m-auto" style="width: 8%;">

    </div>
        </h4>

        <div class="row">

                @if(!empty($categories))
                    @foreach($categories as $index=>$data)
            <div class="col-md-3">

                                    <a href="{{url(Session::get('locality_url').'/'.$data->category_url.'/store-list')}}">

                    <div class="category-main-div card">
                        <div class="row margin0">
                            <div class="main-image-div col-md-12 col-xs-4 padding0">
                                <div class="images">
                                    @if(!empty($data->category_img))
                                     <img src="{{url('/public/images/category_img/'.$data->category_img)}}" class="image">
                                     @else
                                    <img src="{{url('/')}}/public/frontend/img/mandeclan1.jpg" class="image">
                                    @endif
                                </div>
                                <div class="overlay">
                                    <div class="text">
                                        <img src="{{url('/')}}/public/frontend/img/tap.png">
                                    </div>
                                </div>
                            </div>
                            <div class="details col-md-12 col-xs-8 padding0">
                                <h5>{{$data->category_name}}</h5>
                                <p class="text-truncate">{{$data->category_title}}</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
             @endforeach
            @endif
         
            
        </div>
    </div>
</div>



        <div class="container-fluid py-4">
          <h4 style="margin: 0 auto;" class="title-heading-new">How it works</h4>
          <div class="border justify-center text-center align-center bg-secondary border-secondary m-auto" style="width: 10%;">

    </div>
          
        <div class="row text-center align-center py-4">
            <div class="col-1"></div>
            <div class="col-2 col-xs-12">
                <div>
                    <h1>
                        <i class="fa fa-pencil-square-o text-warning" aria-hidden="true"></i>
                    </h1>
                    <h6>Create account</h6>
                    <small class="text-muted  d-none d-sm-block">
                        <ul class="text-left pl-5">
                            All you need is
                            <li>GSTIN</li>
                            <li>Bank Account</li>
                        </ul>
                    </small>
                </div>
            </div>
            <div class="col-2 col-xs-12">
                <div>
                    <h1>
                        <i class="fa fa-upload text-warning" aria-hidden="true"></i>
                    </h1>
                    <h6>List product</h6>
                    <small class="text-muted d-none d-sm-block">List the products you
                        want to sell in your
                        supplier panel
                    </small>
                </div>
            </div>
            <div class="col-2 col-xs-12">
                <div>
                    <h1>
                        <i class="fa fa-list text-warning" aria-hidden="true"></i>
                    </h1>
                    <h6>Get Orders</h6>
                    <small class="text-muted d-none d-sm-block">
                        Start getting orders
                        with over 1 crore
                        Indians actively
                        shopping on our
                        platform

                    </small>
                </div>
            </div>
            <div class="col-2 col-xs-12">
                <div>
                    <h1>
                        <i class="fa fa-shopping-bag text-warning" aria-hidden="true"></i>
                    </h1>
                    <h6>Lowest cost shipping</h6>
                    <small class="text-muted d-none d-sm-block">
                        Products are shipped
                        to the customer at
                        the lowest costs

                    </small>
                </div>
            </div>
            <div class="col-2 col-xs-12">
                <div>
                    <h1>
                        <i class="fa fa-money text-warning" aria-hidden="true"></i>
                    </h1>
                    <h6>Receive payments</h6>
                    <small class="text-muted d-none d-sm-block">Payments are
                        deposited safely to
                        your bank account in
                        15 days of ordered
                        delivery.

                    </small>
                </div>
            </div>
            <div class="col-1"></div>
        </div>
</div>



<div class="padding gray category-list morecategory" id="morecategory">
    <div class="container-fluid">
        <h4 class="title-heading">Services <br class="p-4">
    <div class="border justify-center text-center align-center bg-secondary border-secondary m-auto" style="width: 8%;">

    </div>
        </h4>

        <div class="row">

                @if(!empty($servic_categories))
                    @foreach($servic_categories as $index=>$data)
            <div class="col-md-3">
 <a href="{{url(Session::get('locality_url').'/'.$data->category_url.'/vendor-service-list')}}">
                    <div class="category-main-div card">
                        <div class="row margin0">
                            <div class="main-image-div col-md-12 col-xs-4 padding0">
                                <div class="images">
                                    @if(!empty($data->category_img))
                                     <img src="{{url('/public/images/category_img/'.$data->category_img)}}" class="image">
                                     @else
                                    <img src="{{url('/')}}/public/frontend/img/mandeclan1.jpg" class="image">
                                    @endif
                                </div>
                                <div class="overlay">
                                    <div class="text">
                                        <img src="{{url('/')}}/public/frontend/img/tap.png">
                                    </div>
                                </div>
                            </div>
                            <div class="details col-md-12 col-xs-8 padding0">
                                <h5>{{$data->category_name}}</h5>
                                <p class="text-truncate">{{$data->category_title}}</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
             @endforeach
            @endif
         
            
        </div>
    </div>
</div>


<nav class="breadcrumb-nav">
 <div class="breadcrumb-padding">
  <div class="container-fluid">
      <ol class="breadcrumb">
        
      </ol>
  </div>
</div>
</nav>
<div class="container-fluid">
    <div class="footerflip p-2 text-justify"><h1>MandeClan: The One-stop Shopping Destination</h1>E-commerce is revolutionizing the way we all shop in India. Why do you want to hop from one store to another in search of the latest phone when you can find it on the Internet in a single click? Not only mobiles. MandeClan houses everything you can possibly imagine, from trending electronics like laptops, tablets, smartphones, and mobile accessories to in-vogue fashion staples like shoes, clothing and lifestyle accessories; from modern furniture like sofa sets, dining tables, and wardrobes to appliances that make your life easy like washing machines, TVs, ACs, mixer grinder juicers and other time-saving kitchen and small appliances; from home furnishings like cushion covers, mattresses and bedsheets to toys and musical instruments, we got them all covered. You name it, and you can stay assured about finding them all here. For those of you with erratic working hours, MandeClan is your best bet. Shop in your PJs, at night or in the wee hours of the morning. This e-commerce never shuts down. <br><br>What's more, with our year-round shopping festivals and events, our prices are irresistible. We're sure you'll find yourself picking up more than what you had in mind. If you are wondering why you should shop from MandeClan when there are multiple options available to you, well, the below will answer your question. <br><br><h2>MandeClan Plus</h2>A world of limitless possibilities awaits you - MandeClan Plus was kickstarted as a loyalty reward programme for all its regular customers at zero subscription fee. All you need is 500 supercoins to be a part of this service. For every 100 rupees spent on MandeClan order, Plus members earns 4 supercoins &amp; non-plus members earn 2 supercoins. Free delivery, early access during sales and shopping festivals, exchange offers and priority customer service are the top benefits to a MandeClan Plus member. In short, earn more when you shop more! <br><br>What's more, you can even use the MandeClan supercoins for a number of exciting services, like:<br>An annual Zomato Gold membership<br>An annual Hotstar Premium membership<br>6 months Gaana plus subscription<br>Rupees 550 instant discount on flights on ixigo<br>Check out https://www.MandeClan.com/plus/all-offers for the entire list. Terms and conditions apply.<br><br><h2>No Cost EMI</h2>In an attempt to make high-end products accessible to all, our No Cost EMI plan enables you to shop with us under EMI, without shelling out any processing fee. Applicable on select mobiles, laptops, large and small appliances, furniture, electronics and watches, you can now shop without burning a hole in your pocket. If you've been eyeing a product for a long time, chances are it may be up for a no cost EMI. Take a look ASAP! Terms and conditions apply.<br><br> <h2>EMI on Debit Cards</h2>Did you know debit card holders account for 79.38 crore in the country, while there are only 3.14 crore credit card holders? After enabling EMI on Credit Cards, in another attempt to make online shopping accessible to everyone, MandeClan introduces EMI on Debit Cards, empowering you to shop confidently with us without having to worry about pauses in monthly cash flow. At present, we have partnered with Axis Bank, HDFC Bank, State Bank of India and ICICI Bank for this facility. More power to all our shoppers! Terms and conditions apply. <br><br><h2>Mobile Exchange Offers</h2>Get an instant discount on the phone that you have been eyeing on. Exchange your old mobile for a new one after the MandeClan experts calculate the value of your old phone, provided it is in a working condition without damage to the screen. If a phone is applicable for an exchange offer, you will see the 'Buy with Exchange' option on the product description of the phone. So, be smart, always opt for an exchange wherever possible. Terms and conditions apply. <br><br><h2>What Can You Buy From MandeClan?</h2><h2>Mobile Phones</h2>From budget phones to state-of-the-art smartphones, we have a mobile for everybody out there. Whether you're looking for larger, fuller screens, power-packed batteries, blazing-fast processors, beautification apps, high-tech selfie cameras or just large internal space, we take care of all the essentials. Shop from top brands in the country like Samsung, Apple, Oppo, Xiaomi, Realme, Vivo, and Honor to name a few. Rest assured, you're buying from only the most reliable names in the market. What's more, with MandeClan's Complete Mobile Protection Plan, you will never again find the need to run around service centres. This plan entails you to a number of post-purchase solutions, starting at as low as Rupees 99 only! Broken screens, liquid damage to phone, hardware and software glitches, and replacements - <b>the MandeClan Complete Mobile Protection</b> covers a comprehensive range of post-purchase problems, with door-to-door services. <br><br><h2>Electronic Devices and Accessories</h2>When it comes to laptops, we are not far behind. Filter among dozens of super-fast operating systems, hard disk capacity, RAM, lifestyle, screen size and many other criterias for personalized results in a flash. All you students out there, confused about what laptop to get? Our <b>Back To College Store</b> segregates laptops purpose wise (gaming, browsing and research, project work, entertainment, design, multitasking) with recommendations from top brands and industry experts, facilitating a shopping experience that is quicker and simpler.<br><br>Photography lovers, you couldn't land at a better page than ours. Cutting-edge DSLR cameras, ever reliable point-and-shoot cameras, millennial favourite instant cameras or action cameras for adventure junkies: our range of cameras is as much for beginners as it is for professionals. Canon, Nikon, GoPro, Sony, and Fujifilm are some big names you'll find in our store. Photography lovers, you couldn't land at a better page than ours. Cutting-edge DSLR cameras, ever reliable point-and-shoot cameras, millennial favourite instant cameras or action cameras for adventure junkies: our range of cameras is as much for beginners as it is for professionals. Canon, Nikon, GoPro, Sony, and Fujifilm are some big names you'll find in our store. <br><br>Turn your home into a theatre with a stunning surround sound system. Choose from our elaborate range of Sony home theatres, JBL soundbars and Philips tower speakers for an experience to remember.<br><br>How about jazzing up your phone with our quirky designer cases and covers? Our wide-ranging mobile accessories starting from headphones, power banks, memory cards, mobile chargers, to selfie sticks can prove to be ideal travel companions for you and your phone; never again worry about running out of charge or memory on your next vacation.<br><br><h2>Large Appliances</h2>Sleek TVs, power-saving refrigerators, rapid-cooling ACs, resourceful washing machines - discover everything you need to run a house under one roof. Our <b>Dependable TV and Appliance Store</b> ensures zero transit damage, with a replacement guarantee if anything goes wrong; delivery and installation as per your convenience and a double warranty (Official Brand Warranty along with an extended MandeClan Warranty) - rest assured, value for money is what is promised and delivered. Shop from market leaders in the country like Samsung, LG, Whirlpool, Midea, Mi, Vu, Panasonic, Godrej, Sony, Daikin, and Hitachi among many others. <br><br><h2>Small Home Appliances</h2>Find handy and practical home appliances designed to make your life simpler: electric kettles, OTGs, microwave ovens, sandwich makers, hand blenders, coffee makers, and many more other time-saving appliances that are truly crafted for a quicker lifestyle. Live life king size with these appliances at home.<br><br><h2>Lifestyle</h2>MandeClan, <b>'India ka Fashion Capital'</b>, is your one-stop fashion destination for anything and everything you need to look good. Our exhaustive range of Western and Indian wear, summer and winter clothing, formal and casual footwear, bridal and artificial jewellery, long-lasting make-up, grooming tools and accessories are sure to sweep you off your feet. Shop from crowd favourites like Vero Moda, Forever 21, Only, Arrow, Woodland, Nike, Puma, Revlon, Mac, and Sephora among dozens of other top-of-the-ladder names. From summer staple maxi dresses, no-nonsense cigarette pants, traditional Bandhani kurtis to street-smart biker jackets, you can rely on us for a wardrobe that is up to date. Explore our in-house brands like Metronaut, Anmi, and Denizen, to name a few, for carefully curated designs that are the talk of the town. Get ready to be spoiled for choice.Festivals, office get-togethers, weddings, brunches, or nightwear - MandeClan will have your back each time.<br><br><h2>Home and Furniture</h2>Moving to a new place is never easy, especially if you're buying new furniture. Beds, sofa sets, dining tables, wardrobes, and TV units - it's not easy to set up everything again. With the hundreds of options thrown at you, the ride could be overwhelming. What place is reliable, what furniture will stand the test of time? These are questions you must ask before you choose a store. Well, our <b>Durability Certified Furniture Store</b> has not only curated a range of furniture keeping in mind the modern Indian consumer but furniture that comes with a lab certification, ensuring they last you for up to 10 years. Yes, all our furniture has gone through 35 stability and load tests so that you receive only the best-quality furniture. <b>Be FurniSure</b>, always. Names to look out for are Nilkamal, Godrej Interio, Urban Ladder, HomeTown, Durian and Perfect Homes. <br><br>You may have your furniture all set up, but they could end up looking flat and incomplete without complementary decor. Curtains, cushion covers, bed sheets, wall shelves, paintings, floor lamps - find everything that turns a house to an inviting home under one roof at MandeClan. <br><br><h2>Baby and Kids</h2>Your kids deserve only the best. From bodysuits, booties, diapers to strollers, if you're an expecting mother or a new mother, you will find everything you need to set sail on a smooth parenting journey with the help of our baby care collection. When it comes to safety, hygiene and comfort, you can rely on us without a second thought. Huggies, Pampers, MamyPoko, and Johnson &amp; Johnson: we host only the most-trusted names in the business for your baby.<br><br><h2>Books, Sports and Games</h2>Work hard and no play? We don't believe in that. Get access to best-selling fiction and non-fiction books by your favourite authors, thrilling English and Indian blockbusters, most-wanted gaming consoles, and a tempting range of fitness and sports gadgets and equipment bound to inspire you to get moving. <br><br><h2>Grocery/Supermart</h2>Launching into the grocery vertical, MandeClan introduces <b>Supermart</b> that is out to bring everyday essentials close to you. From pulses, spices, dairy, personal and sanitary care, breakfast essentials, health drinks, spreads, ready to cook, grooming to cleaning agents, we are happy to present everything you need to run a house. Now buy Grocery products for as low as 1 Rupee only - our <b>1 Rupee Store</b> presents new products every day for a nominal price of 1 Rupee only. Terms and conditions apply.</div></div>




@endsection

<!-- ................push new js link................. -->

@push('js')
<script src="{{asset('public/js/comman.js')}}"></script>
@if(empty($locality))

<script type="text/javascript">
    $(window).on('load', function() {
        $('#currentlocation').modal('show');
    });
</script>
    @endif
<script type="text/javascript">
   

$( document ).ready(function() { 


//     $(".geo_selector").keyup(function() {

//  var searchValue = $(this).val();

// // alert(searchValue)
// console.log(searchValue);
// var data;
// $.ajaxSetup({
//     headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     }
// });

// $.ajax({
//     url: "{{url('append_search_localities')}}",
//     type: "post",
//     data: {searchValue:searchValue},
//     dataType: "json",
//     success:function(data) {
//         console.log(data,'filter');
//         $('.append_location').empty()

//               $.each(data, function( key, val ) {

//             $(document.body).find('.append_location').append('<div class="item-list"><div class="row"><div class="col-md-1"><img src="{{url('/')}}/public/frontend/img/current-location.png" class="black-image"></div><div class="col-md-11"><h5>'+val.locality_name+'</h5><p>'+val.city_name+', '+val.state_name+', '+val.country_name+'.</p></div></div></div>');
//         });
//     }

// });


// });
//     $('#findyourlocation').on('click',function(e){
//       e.preventDefault();
//       navigator.geolocation.getCurrentPosition(function(position) {
//        var lat = position.coords.latitude;
//        var lng = position.coords.longitude;
//        var urlloc = 'https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyBxm3cpfYPdG6Yk3Tv2yIrfBLtiKYlza5A&latlng='+lat+','+lng+'&sensor=false';

//         $.ajax({
//            type:"GET",
//            url:urlloc,
//            beforeSend: function(){
//                $("#loader").show();
//             },
//            success:function(res){ 
//             // console.log(res.results[0].formatted_address);
//              var addresscomponents = res.results[0].address_components;
//              var obj = {};
//              addresscomponents.forEach(function(address_componentdddd) {
//                 obj[address_componentdddd.types[0]] = address_componentdddd.long_name;
//              }); 
//              //console.log(obj);
//              var area = obj.political;
//              var city = obj.locality; 
//              var searcharea = area.concat(city); 
//              $('#modalsearchrestaurant #locations').prepend("<option value='" + searcharea + "'>");
//              $("#locations option:first").attr('selected','selected'); 
//              $('#modalsearchrestaurant #place_name').val(area+' '+city);
//              $(".modalsearchrestaurantbutton").trigger("click");
             
//            },
//            complete:function(data){
//              $("#loader").hide();
//            }
//        });
//      });
//     });

      });
</script>

<script type="text/javascript">

    var x = document.getElementById("demo");

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else { 
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition(position) {
        alert("Latitude: " + position.coords.latitude + 
        "<br>Longitude: " + position.coords.longitude);
        // this.initMap();
    }
      function initMap() {
        var map = new google.maps.Map(document.getElementById('demo'), {
          zoom: 8,
          center: {lat: 40.731, lng: -73.997}
        });
        var geocoder = new google.maps.Geocoder;
        var infowindow = new google.maps.InfoWindow;

        document.getElementById('submit').addEventListener('click', function() {
          geocodeLatLng(geocoder, map, infowindow);
        });
      }

      function geocodeLatLng(geocoder, map, infowindow) {
        var input = document.getElementById('latlng').value;
        var latlngStr = input.split(',', 2);
        var latlng = {lat: parseFloat(latlngStr[0]), lng: parseFloat(latlngStr[1])};
        geocoder.geocode({'location': latlng}, function(results, status) {
          if (status === 'OK') {
            if (results[0]) {
              map.setZoom(11);
              var marker = new google.maps.Marker({
                position: latlng,
                map: map
              });
              infowindow.setContent(results[0].formatted_address);
              infowindow.open(map, marker);
            } else {
              window.alert('No results found');
            }
          } else {
            window.alert('Geocoder failed due to: ' + status);
          }
        });
      }
    </script>
@endpush

