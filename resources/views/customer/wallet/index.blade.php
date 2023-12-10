@extends('customer.layouts.app')
@section('title',"All Wallet | customer Mande Clan")

<!-- ................custom css................. -->

@section('customStyle')
<style type="text/css">
   .text-red {
    color: red;
}

.text-green {
    color: #2ec42e;
}
.amountbox {
    border: none;
    border-bottom: 2px solid #ff7878;
    border-radius: 0;
    height: 50px;
    text-align: center;
}.amountbox, .wallet-cur-symbol {
    background: transparent;
    font-size: 30px;
}

 
    @media only screen and (max-width: 500px) {
  .content{
        padding:0 !important;
    }
}

</style>
@endsection

<!-- ................Add css link................. -->

@push('style')
@endpush

<!-- ................body................. -->
@section('innercontent')

<main class="content profile-order-history">
    <div class="container-fluid p-2">

        <div class="clearfix">

            <h1 class="h3 mb-3">Wallet &nbsp;&nbsp;@if(!empty($records))({{$records->total()}})@endif</h1>
        </div>

        <div class="card">
            <div class="card-body">
<div class="bg-white2">

        <h4 class="user_m2">My Wallet</h4>
        <h4 class="user_m2 text-green">Current Balance :
          <i class="fas fa-dollar-sign"></i>
                     -945.62  
                  </h4>
          <hr>
        <div class="row">




          <div class="col-6">

            <form id="mainform" action="https://emart.mediacity.co.in/demo/public/wallet/payment" method="POST">
              <input type="hidden" name="_token" value="hfV0DHXI3GYPVl4YI1iwGGV8OuuGFdiwQP5OAYb6">
              <div class="input-group">
                <span class="input-group-addon wallet-cur-symbol" id="basic-addon1">
                  <i class="fas fa-dollar-sign"></i>
                </span>
                <input name="amount" required="" type="number" class="amountbox form-control" value="1.00" placeholder="0.00" min="1" step="0.01" aria-describedby="basic-addon1">
              </div>
              <br>
              <div>


                <button type="submit" class="pull-left btn btn-primary">
                  Procced To Pay...
                </button>


              </div>

            </form>

          </div>

          <div class="col-6">

            <p class="text-muted">
              <i class="fa fa-lock"></i> Once the money is added in wallet its non refundable.
            </p>

            <p class="text-muted">
              <i class="fa fa-star"></i> You can use this money to purchase product on this portal.
            </p>

            <p class="text-muted">
              <i class="fa fa-info-circle"></i> Money will expire after 1 year from credited date.
            </p>

            <p class="text-muted">
              <i class="fa fa-info-circle"></i> Wallet amount will always added in default currency which is:  <b>USD</b>
            </p>
          </div>


        </div>

        <div class="walletlogs">
                    <hr>
          <h4>Wallet History</h4>
          <hr>

          
          <h6>
            <span class="pull-right text-red">  -  <i class="fas fa-dollar-sign"></i> 1000.00
                          </span>
            Points expired
            <br>
            <small class="text-muted font-size-12 wallet-log-history-block">
                            <b>Debited ON: </b> 01/01/1970 | 12:00 AM |
              <b>Ref ID:</b> WALLET_POINT_EXPIRED_6063162ca9792
                          </small>
          </h6>
          <hr>
          
          <h6>
            <span class="pull-right text-red">  -  <i class="fas fa-dollar-sign"></i> 1395.62
                          </span>
            Payment for order 5f2f96e0d4cd2
            <br>
            <small class="text-muted font-size-12 wallet-log-history-block">
                            <b>Debited ON: </b> 09/08/2020 | 08:25 AM |
              <b>Ref ID:</b> WALLET_PAYMENT_5f2f96ef30e1e
                          </small>
          </h6>
          <hr>
          
          <h6>
            <span class="pull-right text-green">  +  <i class="fas fa-dollar-sign"></i> 100.00
                          </span>
            Added Amount via Stripe
            <br>
            <small class="text-muted font-size-12 wallet-log-history-block">
                            <b>Credited ON: </b> 09/08/2020 | 08:25 AM |
              <b>Ref ID:</b> ch_1HE7y7GBj6eLM2HWQ9cMfg1Z | <b>Expire ON:</b>
              08/08/2021 | 08:30 PM
                          </small>
          </h6>
          <hr>
          
          <h6>
            <span class="pull-right text-green">  +  <i class="fas fa-dollar-sign"></i> 100.00
                          </span>
            Added Amount via Stripe
            <br>
            <small class="text-muted font-size-12 wallet-log-history-block">
                            <b>Credited ON: </b> 09/08/2020 | 08:24 AM |
              <b>Ref ID:</b> ch_1HE7x6GBj6eLM2HWtnHQKtIx | <b>Expire ON:</b>
              08/08/2021 | 08:30 PM
                          </small>
          </h6>
          <hr>
          
          <h6>
            <span class="pull-right text-green">  +  <i class="fas fa-dollar-sign"></i> 250.00
                          </span>
            Added Amount via Stripe
            <br>
            <small class="text-muted font-size-12 wallet-log-history-block">
                            <b>Credited ON: </b> 09/08/2020 | 08:22 AM |
              <b>Ref ID:</b> ch_1HE7v5GBj6eLM2HWD5egqJMF | <b>Expire ON:</b>
              08/08/2021 | 08:30 PM
                          </small>
          </h6>
          <hr>
          
          <h6>
            <span class="pull-right text-green">  +  <i class="fas fa-dollar-sign"></i> 298.04
                          </span>
            Refund Payment for order #5f2f9545ef2fa
            <br>
            <small class="text-muted font-size-12 wallet-log-history-block">
                            <b>Credited ON: </b> 09/08/2020 | 08:20 AM |
              <b>Ref ID:</b> WALLETRLl94rzobm | <b>Expire ON:</b>
              01/01/1970 | 12:00 AM
                          </small>
          </h6>
          <hr>
          
          <h6>
            <span class="pull-right text-red">  -  <i class="fas fa-dollar-sign"></i> 298.04
                          </span>
            Payment for order 5f2f9545ef2fa
            <br>
            <small class="text-muted font-size-12 wallet-log-history-block">
                            <b>Debited ON: </b> 09/08/2020 | 08:19 AM |
              <b>Ref ID:</b> WALLET_PAYMENT_5f2f9556cf20f
                          </small>
          </h6>
          <hr>
                    
                    <div class="mx-auto width200px">
            <nav>
        <ul class="pagination">
            
                            <li class="page-item disabled" aria-disabled="true" aria-label="« Previous">
                    <span class="page-link" aria-hidden="true">‹</span>
                </li>
            
            
                            
                
                
                                                                                        <li class="page-item active" aria-current="page"><span class="page-link">1</span></li>
                                                                                                <li class="page-item"><a class="page-link" href="https://emart.mediacity.co.in/demo/public/mywallet?page=2">2</a></li>
                                                                        
            
                            <li class="page-item">
                    <a class="page-link" href="https://emart.mediacity.co.in/demo/public/mywallet?page=2" rel="next" aria-label="Next »">›</a>
                </li>
                    </ul>
    </nav>

          </div>
                  </div>

      </div>

            </div>
        </div>


    </div>     

</main> 

@endsection

<!-- ................push new js link................. -->

@push('js')
<script src="{{asset('public/js/comman.js')}}"></script>
@endpush