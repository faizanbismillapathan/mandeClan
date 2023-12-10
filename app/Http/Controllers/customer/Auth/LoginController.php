<?php

namespace App\Http\Controllers\customer\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
   
public function redirectTo(){
        
    // User role
    $role = \Auth::user()->role; 
    //dd('+4');

    // Check user role
    switch ($role) {
        case '1':
          // dd($role);
                return '/admin/dashboard';
            break;
        case '2':
          // dd('sss');
                return '/seller/dashboard';
            break; 
           case '3':
                 return redirect::back();
            break;
             case '4':
                return '/service-partner/dashboard';
            break;

             case '5':
                return '/service/dashboard';
            break;
        default:
                return '/'; 
            break;
    }
}
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    //  public function username(){
    //     return 'username';
    // }
}
