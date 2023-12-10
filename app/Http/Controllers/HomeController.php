<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd('dd');
       if (!\Auth::guest()) {
          $role = \Auth::user()->role;
          //dd('+1');
            switch ($role) {
                case '1':
                return redirect::to('/admin/dashboard');
                break;
                case '2':
                return redirect::to('/seller/dashboard');
                break;
                case '3':
                return redirect::back();
                break;
                case '4':
                return redirect::to('/service-partner/dashboard');
                break;
                case '5':
                return redirect::to('/service/dashboard');
                break;
                default:
                return view('auth.login');;
                break;
            }
        }
        //         if (\Auth::user()->role == "1") {
        //      return view('admin.dashboard.index');
        //      elseif (\Auth::user()->role == "2") {
        //           return view('seller.dashboard.index');
        //      }
        //       elseif (\Auth::user()->role == "3") {
        //           return view('customer.dashboard.index');
        //      }
        //      elseif (\Auth::user()->role == "4") {
        //           return view('rider.dashboard.index');
        //      }
        //      elseif (\Auth::user()->role == "5") {
        //           return view('vehicle.dashboard.index');
        //      }
        // }
    }
}
