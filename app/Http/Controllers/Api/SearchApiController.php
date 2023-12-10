<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\city;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Toast;
use App\user;



class SearchApiController extends Controller
{



  public function append_locality(Request $request)    
    {

 $data = city::select("city_name as name",'id')
                ->where("city_name","LIKE","%{$request->keyword}%")
                ->get();
   
        return response()->json($data);


    }




}

