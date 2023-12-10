<?php

namespace App\Http\Controllers\service\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Redirect;

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
    // protected $redirectTo = '/service/dashboard';
public function redirectTo(){
        
    // User role
    $role = \Auth::user()->role; 
     //dd('+6');

    // Check user role
    switch ($role) {
        case '1':
          // dd($role);
                return '/admin/dashboard';
            break;
        case '2':
          // dd('sss');
                return '/service/dashboard';
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
