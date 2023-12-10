@extends('seller.layouts.app')
@section('title',"Create New Subscriptions | seller  Mande Clan")

<!-- ................custom css................. -->

@section('customStyle')
<style type="text/css">
    h1 {
     color: #000; 
     margin-bottom: 10px; 
     font-size: 30px;
}
</style>
@endsection

<!-- ................Add css link................. -->

@push('style')
@endpush

<!-- ................body................. -->
@section('innercontent')

  
<main class="content">
                    <div class="container-fluid p-0">
<div class="clearfix">
    <a href="{{url('seller/subscriptions')}}" class="form-inline float-right mt--1 d-none d-md-flex">
    <button class="btn btn-info"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Back</button>
    </a>

        <h1 class="h3 mb-3"><b>Create Subscriptions</b></h1>

                    </div>
                                <div class="card">
                                
<div class="card-body">
     <!-- ..............-->

<div class="body-content">

    <div class="container">
        
        <section class="pricing py-5">
            <div class="container">
                <div class="row">
                                            <div class="mt-2 col-lg-3">
                            <div class="card mb-5 mb-lg-0">
                                <div class="card-body">
                                    <h5 class="card-title text-muted text-uppercase text-center">
                                        Basic 
                                    </h5>
                                    <h1 class="display-5 text-center"> <i class="fas fa-dollar-sign"></i> 10.00<span class="period">/year</span></h1>
                                    <hr>
                                    <p style="text-align: center;"><span style="font-size: 12pt; color: #000000;">♦ 101 Product Upload limit</span></p>
<p style="text-align: center;"><span style="font-size: 12pt; color: #000000;">♦ 1 day support time</span></p>
<p style="text-align: center;"><span style="font-size: 12pt; color: #000000;">♦ 1 day payout</span></p>
<p style="text-align: center;"><span style="font-size: 12pt; color: #000000;">♦ 1 day store request approval time</span></p>
<p style="text-align: center;"><span style="font-size: 12pt; color: #000000;">♦ No CSV Upload</span></p>
<p style="text-align: center;"><span style="font-size: 12pt; color: #000000;">♦ 1 year validity&nbsp;</span></p>
                                    
                                     
                                             <form >

                                               {{--  action="https://emart.mediacity.co.in/demo/public/seller/payforplans">
                                                <input type="hidden" name="_token" value="lX1D94kM2p5LJaKBQNLyxxVc3BQbk5NOKWReY6yP">                                                <input type="hidden" name="planid" value="eyJpdiI6IklhT3N3NjlsQlZxMkVuZ2ZmMjREV2c9PSIsInZhbHVlIjoiYzNPZlI5cFdqcVNjRUdiT3hiSmZBZGg2SnIyeUZOc1NwSGNuS3ZRU0k5NUpnMk1ZcFNkaUxuUkRpbk9Cb3N3RyIsIm1hYyI6IjM5Y2RhYzVlYjhhZDA2N2NjNzBhMDg4ZWEzOWI1NTEwYzJhMmUxNTM5OGY3YzM1MmViYWMyZDI2MmQ2MTVjZTAiLCJ0YWciOiIifQ==" --}}
                                               
                                                <button type="submit" class="btn btn-block btn-primary text-uppercase">Get Started with Basic </button>
                                            </form>
                                                                            
                                    
                                </div>
                            </div>
                        </div>
                                            <div class="mt-2 col-lg-3">
                            <div class="card mb-5 mb-lg-0">
                                <div class="card-body">
                                    <h5 class="card-title text-muted text-uppercase text-center">
                                        Silver 
                                    </h5>
                                    <h1 class="display-5 text-center"> <i class="fas fa-dollar-sign"></i> 50.00<span class="period">/year</span></h1>
                                    <hr>
                                    <p style="text-align: center;"><span style="font-size: 12pt; color: #000000;">♦ 1000 Product Upload limit</span></p>
<p style="text-align: center;"><span style="font-size: 12pt; color: #000000;">♦ Instant support same day</span></p>
<p style="text-align: center;"><span style="font-size: 12pt; color: #000000;">♦ 1 day payout</span></p>
<p style="text-align: center;"><span style="font-size: 12pt; color: #000000;">♦ 1 day store request approval time</span></p>
<p style="text-align: center;"><span style="font-size: 12pt; color: #000000;">♦ NO CSV Upload</span></p>
<p style="text-align: center;"><span style="font-size: 12pt; color: #000000;">♦ 1 year validity&nbsp;</span></p>
                                    
                                                                                <button type="button" class="btn btn-block btn-success text-uppercase">
                                                    <i class="fa fa-check-circle"></i> Subscribed
                                            </button>
                                                                            
                                    
                                </div>
                            </div>
                        </div>
                                            <div class="mt-2 col-lg-3">
                            <div class="card mb-5 mb-lg-0">
                                <div class="card-body">
                                    <h5 class="card-title text-muted text-uppercase text-center">
                                        Diamond 
                                    </h5>
                                    <h1 class="display-5 text-center"> <i class="fas fa-dollar-sign"></i> 100.00<span class="period">/year</span></h1>
                                    <hr>
                                    <p style="text-align: center;"><span style="font-size: 12pt; color: #000000;">♦ 10000 Product Upload limit</span></p>
<p style="text-align: center;"><span style="font-size: 12pt; color: #000000;">♦ Instant support time same day</span></p>
<p style="text-align: center;"><span style="font-size: 12pt; color: #000000;">♦ Same day payout if any.</span></p>
<p style="text-align: center;"><span style="font-size: 12pt; color: #000000;">♦ Instant store request approval time</span></p>
<p style="text-align: center;"><span style="font-size: 12pt; color: #000000;">♦<strong> Excel CSV Product Uploads.</strong></span></p>
<p style="text-align: center;"><span style="font-size: 12pt; color: #000000;">♦ 1 year validity&nbsp;</span></p>
                                    
                                      <form >
                                          {{--    <form action="https://emart.mediacity.co.in/demo/public/seller/payforplans">
                                                <input type="hidden" name="_token" value="lX1D94kM2p5LJaKBQNLyxxVc3BQbk5NOKWReY6yP">                                                <input type="hidden" name="planid" value="eyJpdiI6IkUyRlo3UzBVNlp6UUozRFhlV2czUnc9PSIsInZhbHVlIjoiSnRQR2RPZGJwYjBFVUpPSEM1T1hLYTNGTGtheUNhdWZDd2hRU25iaGFuMUdiWGVncXhpTmFxVSsxeDByWld6TCIsIm1hYyI6ImUwMjA1YTM2ZjYxMDZjZGQxMzhmNTVhODQ2NzQ4NzdlZDMxNTMxZDQxY2IxZjdlZjYyNjRhN2YwZmJlMmU2NzQiLCJ0YWciOiIifQ=="> --}}
                                               
                                                <button type="submit" class="btn btn-block btn-primary text-uppercase">Get Started with Diamond </button>
                                            </form>
                                                                            
                                    
                                </div>
                            </div>
                        </div>
                                            <div class="mt-2 col-lg-3">
                            <div class="card mb-5 mb-lg-0">
                                <div class="card-body">
                                    <h5 class="card-title text-muted text-uppercase text-center">
                                        Enterprise 
                                    </h5>
                                    <h1 class="display-5 text-center"> <i class="fas fa-dollar-sign"></i> 200.00<span class="period">/year</span></h1>
                                    <hr>
                                    <p style="text-align: center;"><span style="font-size: 12pt; color: #000000;">♦ 10000 Product Upload limit</span></p>
<p style="text-align: center;"><span style="font-size: 12pt; color: #000000;">♦ Instant support time same day</span></p>
<p style="text-align: center;"><span style="font-size: 12pt; color: #000000;">♦ Same day payout if any.</span></p>
<p style="text-align: center;"><span style="font-size: 12pt; color: #000000;">♦ Instant store request approval time</span></p>
<p style="text-align: center;"><span style="font-size: 12pt; color: #000000;">♦<strong> Excel CSV Product Uploads.</strong></span></p>
<p style="text-align: center;"><span style="font-size: 12pt; color: #000000;">♦ 1 year validity&nbsp;</span></p>
                                    
                                      <form >
                                             {{-- <form action="https://emart.mediacity.co.in/demo/public/seller/payforplans">
                                                <input type="hidden" name="_token" value="lX1D94kM2p5LJaKBQNLyxxVc3BQbk5NOKWReY6yP">                                                <input type="hidden" name="planid" value="eyJpdiI6IjZ1TlJlRFZkRG5FT0Robm5CZkpITGc9PSIsInZhbHVlIjoiczd1ditpL3JNMzhpTXZ3LytrSWtBbGJtT0ZZdDgwREx5dmxBTXo3aElXc2EvOGFyVXJIYytrazREbVZjMWtkcCIsIm1hYyI6IjE2YTI2ZTE2ZDM0YTc5NDVhMjcwYzBjNzdkYThjZGFlNzYxMDljOTJhNDlkMDg0YjkwNmEwNGI0ZGM3NzQ4OGEiLCJ0YWciOiIifQ=="> --}}
                                               
                                                <button type="submit" class="btn btn-block btn-primary text-uppercase">Get Started with Enterprise </button>
                                            </form>
                                                                            
                                    
                                </div>
                            </div>
                        </div>
                                        
                </div>
            </div>
        </section>
    </div>

</div>

     <!-- ................ -->
</div>
</div>
</div>
</main>
@endsection

<!-- ................push new js link................. -->

@push('js')

 <script src="{{asset('public/js/validation.js')}}"></script>

@endpush