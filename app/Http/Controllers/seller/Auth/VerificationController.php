<?php

namespace App\Http\Controllers\seller\Auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be resent if the user did not receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware(function ($request, $next) {
          $uspermit = \Auth::user();
          if($usp public function __construct()
    { 
        $this->middleware('auth');


        $this->middleware(function ($request, $next) {
          $uspermit = \Auth::user();


          if ( !in_array($uspermit->role, array('1','2'), false ) ) {

              return redirect()->action('frontend\frontendController@index'); 

          }else{

            if($uspermit->role != '1'  && empty(session::get('store_id'))){

              return redirect()->action('frontend\frontendController@index'); 

          }

      }
      return $next($request);
  });
        

        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
}
