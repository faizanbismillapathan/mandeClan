<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;
use DotenvEditor;
use App\bank_detail;

class bank_detailController extends Controller
{

	        protected $config;
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    { 
        $this->middleware('auth');
       $this->middleware(function ($request, $next) {
          $uspermit = \Auth::user();
          if($uspermit->role != '1'){
              return redirect()->action('frontend\frontendController@index',['id' => 'Nagpur']);  
          }

           $this->config = config::first();
          return $next($request);
      });
    }
    


        public function index(Request $request)
    {
       
       
        $configs = config::first();

        $bank_detail = bank_detail::first();

return view('admin.bank_detail.index',compact('configs','bank_detail'));
   
    }


}

