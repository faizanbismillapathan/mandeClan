<?php

namespace App\Http\Controllers\customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\customer;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Toast;


class commanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    
      public function __construct()
    { 
        $this->middleware('auth');

// dd('4');

        $this->middleware(function ($request, $next) {
          $uspermit = \Auth::user();

// dd(!in_array($uspermit->role, array(1,3)));

          if ( !in_array($uspermit->role, array('1','3'), false ) ) {

// dd('1');
              return redirect()->action('frontend\frontendController@index'); 

          }else{

            if($uspermit->role == '1' && empty(Session::get('customer_id'))){

// dd('2');
              return redirect()->action('frontend\frontendController@index'); 

          }

      }
 

        if (\auth::user()->role == "3") {
      $customer_id=db::table('customers')
             ->where('user_id',\auth::user()->id)
             ->select('id','user_id')
             ->first();

            $this->id=$customer_id->id; 
$this->user_id=$customer_id->user_id;  

   }elseif (\auth::user()->role == "1") {

                    $this->id=session::get('customer_id');
 $this->user_id=session::get('customer_user_id');
}


      return $next($request);
  });


    }


  public function append_state(Request $request)
    {   
             $countryId= $request->id;
         $disticts =\DB::table('states')
                      ->join('countries', 'states.country_id', '=', 'countries.id')
                      ->select('states.*','countries.country_name')
                       ->where("states.country_id",$countryId)
                       ->where("states.status",'Active')
                      ->pluck('states.state_name','states.id');

        

        return json_encode($disticts);
    }

     public function append_city(Request $request)
    {   
             $stateId= $request->id;
         $disticts =\DB::table('cities')
                      ->join('states', 'cities.state_id', '=', 'states.id')
                       ->where("cities.state_id",$stateId)
                       ->where("cities.status",'Active')
                      ->pluck('cities.city_name','cities.id');
                      
        return json_encode($disticts);
    }



     public function append_locality(Request $request)
    {   
             $cityId= $request->id;
         $disticts =\DB::table('localities')
                      ->join('cities', 'localities.city_id', '=', 'cities.id')
                       ->where("localities.city_id",$cityId)
                       ->where("localities.status",'Active')
                      ->pluck('localities.locality_name','localities.id');
                      
        return json_encode($disticts);
    }



     public function append_pincode(Request $request)
    {   
             $Id= $request->id;
         $disticts =\DB::table('localities')
                     ->where("localities.id",$Id)
                      ->select('localities.pincode','localities.id')->first();
                      
        return json_encode($disticts->pincode);
    }



}

