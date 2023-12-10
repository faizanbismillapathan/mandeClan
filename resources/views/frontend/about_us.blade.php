@extends('frontend.layouts.app')
@section('title',"Online Shopping site in US: Shop Online for Mobiles, Books, Watches, Shoes and More - mandeclan.com")
<!-- ................Add meta ................ -->


@section('meta')
@endsection

<!-- ................custom css................. -->

@section('customStyle')
<style type="text/css">
	.profile-path.padding {
    padding-top: 30px;
    padding-bottom: 30px;
}

.profile-path {
    background-color: #000;
}
.width {
    width: 80%;
    margin: 0 auto;
    max-width: 80%;
}
.heading {
    text-align: center;
    text-transform: uppercase;
}
.border-bottom {
    width: 100px;
    height: 2px;
    margin: 0 auto;
    background-color: #6eb925;
    margin-bottom: 50px;
    margin-top: 15px;
}
</style>
@endsection

<!-- ................Add css link................. -->

@push('style')
@endpush

<!-- ................div................. -->
@section('innercontent')

<div style="width:100%;padding-right:0px;" data-new-gr-c-s-check-loaded="14.1040.0" data-gr-ext-installed=""><div class="laptop-hide mobile-menu">
    <div class="row margin0">
        <div class="col-xs-6 padding0">
            <div class="image menu-bar">
                <img src="{{url('/')}}/public/frontend/img/mobile-menu.png">
            </div>
        </div>
        <div class="col-xs-6 padding0">
            <div class="pull-right">
                <div class="card-image">
                    <img src="{{url('/')}}/public/frontend/img/online-supermarket-cart.png">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mobile-header-overlay"></div>
<header class="checkout-header mobile-header">
    <img src="{{url('/')}}/public/frontend/img/delete-button.png" class="close-btn laptop-hide">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <a href="{{url('/'.Session::get('locality_url'))}}">
                    <div class="logo-image">
                      <img src="{{asset('public/img/mandeclan_logo.jpg')}}" width="70px">
                    </div>
                    <!-- <h4>Mande Clan</h4> -->
                </a>
            </div>
            <div class="col-md-9">
                <div class="pull-right mobile-pull-left">
                    <ul class="inline-block">
                        <a>
                          <li><img src="{{url('/')}}/public/frontend/img/phone-call.png">{{$admin->admin_mobile}}</li>
                        </a>
                        <a>
                          <li><img src="{{url('/')}}/public/frontend/img/help.png"> {{$admin->admin_email}}</li>
                        </a>
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
<!--  -->
<nav class="breadcrumb-nav">
   <div class="breadcrumb-padding">
      <div class="container-fluid">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/'.Session::get('locality_url'))}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page" style="text-transform:capitalize;">ABOUT US
</li>
          </ol>
      </div>
   </div>
</nav>
<div class="padding">
		<div class="container-fluid width privacy-policy">
			<h4 class="heading">About Us</h4>
			<div class="border-bottom"></div>
			<div class="pp-content">
				<!--  -->
			    <h4>Personal Information</h4>
	            <p> Mande Clan is a Registered Proprietorship Firm registered under MSME. The domain name www.mandeclan.com is owned by the firm. </p>
	            <p>It is strongly recommended that you read and understand these ‘Terms of Use’ carefully, as by accessing this site (hereinafter the “Marketplace”), you agree to be bound by the same and acknowledge that it constitutes an agreement between you and the Company (hereinafter the “User Agreement”). If you do not agree with this User Agreement, you should not use or access the Marketplace for any purpose whatsoever. </p>
	            <p>This document is published in accordance with the provisions of Rule 3 of the Information Technology (Intermediaries Guidelines) Rules, 2011. The User Agreement may be updated from time to time by the Company without notice. It is therefore strongly recommended that you review the User Agreement, as available on the Marketplace, each time you access and/or use the Marketplace.</p>
	            <p>The terms ‘visitor(s)’, ‘user(s)’, ‘you’ hereunder refer to the person visiting, accessing, browsing through and/or using the Marketplace at any point in time.</p>
	            <p>The collection, Storage and Use of Information Related to You</p>
	            <p>We collect and store personal information provided by you from time to time on the website. We only collect and use such information from you that we consider necessary for achieving a seamless, efficient and safe experience, customized to your needs including:</p>
	            <ul class="ul-list1">
	                <li>To enable the provision of services opted for by you;</li>
	                <li>To communicate necessary account and product/service related information from time to time;</li>
	                <li>To allow you to receive quality customer care services;</li>
	                <li>To undertake necessary fraud and money laundering prevention checks, and comply with the highest security standards;</li>
	                <li>To comply with applicable laws, rules and regulations; and</li>
	                <li>To provide you with information and offers on products and services, on updates, on promotions, on related, affiliated or associated service providers and partners, that we believe would be of interest to you.</li>
	            </ul>
	            <p>Where any service requested by you involves a third party, such information as is reasonably necessary by the Company to carry out your service request may be shared with such third party.</p>
	            <p>We also do use your contact information to send you offers based on your interests and prior activity. The Company may also use contact information internally to direct its efforts for product improvement, to contact you as a survey respondent, to notify you if you win any contest; and to send you promotional materials from its contest sponsors or advertisers.</p>
	            <p>Further, you may from time to time choose to provide payment related financial information (credit card, debit card, bank account details, billing address etc.) on the website. We are committed to keeping all such sensitive data/information safe at all times and ensure that such data/information is only transacted over secure website of approved payment gateways which are digitally encrypted, and provide the highest possible degree of care available under the technology presently in use.</p>
	            <p>The Company will not use your financial information for any purpose other than to complete a transaction with you.</p>
	            <p>To the extent possible, we provide you the option of not divulging any specific information that you wish for us not to collect, store or use. You may also choose not to use a particular service or feature on the website, and opt out of any non-essential communications from the Company.</p>
	            <p>Further, transacting over the internet has inherent risks which can only be avoided by you following security practices yourself, such as not revealing account/login related information to any other person and informing our customer care team about any suspicious activity or where your account has/may have been compromised.</p>
	            <p>If you send us personal correspondence, such as emails or letters, or if other users or third parties send us correspondence about your activities on the website, we may collect such information into a file specific to you.</p>
	            <p>We do not retain any information collected for any longer than is reasonably considered necessary by us, or such period as may be required by applicable laws. The Company may be required to disclose any information that is lawfully sought from it by a judicial or other competent div pursuant to applicable laws.</p>
	            <p>The website may contain links to other websites. We are not responsible for the privacy practices of such websites which we do not manage and control.</p>
	            <h4>Eligibility</h4>
	            <p>Person who are 'incompetent to contract' within the meaning of the Indian Contract Act, 1872 including minors, un-discharged insolvents etc.are not eligible to use/access the Marketplace.</p>
	            <p>However, if you are minor, i.e. under the age of 18 years you may use/access the Marketplace under the supervision of an adult parents or legal guardian who agrees to be bounded by Terms of use. You are however prohibited from purchasing any product(s) which is for adult consumption, the sole of which to minors is prohibited.</p>
	            <p>The Marketplace is intended to be a platform for end-consumers desirous of purchasing product(s) for domestic self-consumption. If you are a retailer, institution, wholesaler or any other business user, you are not eligible to use the Marketplace to purchase products from third party sellers, who have been granted access to the Marketplace to display and offer their products for sale through the Marketplace.</p>
	            <p>We have the sole discretion and without liability, reserves the right to terminate or refuse your registration, or refuse to permit use/access to the Marketplace, if:</p>
	            <ul class="ul-list2">
	                <li>it is discovered or brought to notice that you do not conform to the eligibility criteria, or</li>
	                <li>the Company has reason to believe (including through evaluating usage patterns) that the eligibility criteria is not met/is violated by a user, or</li>
	                <li>may breach the terms of this User Agreement.</li>
	            </ul>
	            <h4>Services Overview</h4>
	            <p>The Marketplace is a platform for domestic consumers to transact with third party sellers, who have been granted access to the Marketplace to display and offer products for sale through the Marketplace. For abundant clarity, the Mande Clan does not provide any services to users other than providing the Marketplace as a platform to transact at their own cost and risk, and other services as may be specifically be notified in writing.</p>
	            <p>Mande Clan is not and cannot be a party to any transaction between you and the third party sellers, or have any control, involvement or influence over the products purchased by you from such third party sellers or the prices of such products charged by such third-party sellers. Mande Clan therefore disclaims all warranties and liabilities associated with any products offered on the Marketplace.</p>
	            <p>Services on the Marketplace are available to only select geographies in India, and are subject to restrictions based on business hours and days of third party sellers.</p>
	            <p>Transactions through the Marketplace may be subject to a delivery charge where the minimum order size is not met. You will be informed of such delivery charge at the stage of check-out for a transaction through the Marketplace.</p>
				<!--  -->
			</div>
		</div>
	</div>
@endsection

<!-- ................push new js link................. -->

@push('js')
<script src="{{asset('public/js/comman.js')}}"></script>
@endpush


