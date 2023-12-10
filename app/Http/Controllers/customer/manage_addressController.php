<?php

namespace App\Http\Controllers\customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\customer_address_book;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Toast;
use Auth;

class manage_addressController extends Controller
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

      // dd(!in_array($uspermit->role, array(1,2)));

      if (!in_array($uspermit->role, array('1', '3'), false)) {

        // dd('1');
        return redirect()->action('frontend\frontendController@index');

      } else {

        if ($uspermit->role == '1' && empty(Session::get('customer_id'))) {

          // dd('2');
          return redirect()->action('frontend\frontendController@index');

        }

      }


      if (\auth::user()->role == "3") {
        $customer_id = db::table('customers')
          ->where('user_id', \auth::user()->id)
          ->select('id', 'user_id')
          ->first();

        $this->id = $customer_id->id;
        $this->user_id = $customer_id->user_id;

      } elseif (\auth::user()->role == "1") {

        $this->id = session::get('customer_id');
        $this->user_id = session::get('customer_user_id');
      }


      return $next($request);
    });


  }


  public function index()
  {

    // dd($this->user_id);


    $records = customer_address_book::where('user_id', $this->user_id)->get();



    return view('customer.manage_address.index', compact('records'));
  }





  public function create()
  {
    $countries = DB::table('countries')
      ->select('country_name', 'id')
      ->where('status', 'Active')
      ->orderBy('country_name', 'asc')->pluck('country_name', 'id');


    return view('customer.manage_address.create', compact('countries'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $data = array(
      'user_id' => $this->user_id,
      'name' => $request->input('name'),
      'email' => $request->input('email'),
      'mobile' => '+' . $request->user_country_code . $request->input('mobile'),
      'phone' => $request->input('phone'),
      'country' => $request->input('country'),
      'city' => $request->input('city'),
      'locality' => $request->input('locality'),
      'pincode' => $request->input('pincode'),
      'address' => $request->input('address'),
      'address_2' => $request->input('address_2'),
      'latitude' => $request->input('latitude'),
      'longitude' => $request->input('longitude'),
      'state' => $request->input('state'),

    );

    // dd($data);

    $customer_address_book = new customer_address_book($data);
    $customer_address_book->save();



    $notification = array(
      'message' => 'Your form was successfully submit!',
      'alert-type' => 'success'
    );

    return Redirect::to('customer/manage-address')->with($notification);

  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $view = '';

    return view('customer.manage_address.show', compact('view'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {

    $record = customer_address_book::find($id);

    // dd($record->id);

    $countries = DB::table('countries')
      ->select('country_name', 'id')
      ->where('status', 'Active')
      ->orderBy('country_name', 'asc')->pluck('country_name', 'id');


    $states = DB::table('states')
      ->where('states.country_id', '=', $record->country)
      ->where("states.status", 'Active')
      ->pluck('states.state_name', 'states.id');

    $cities = DB::table('cities')
      ->where('cities.state_id', '=', $record->state)
      ->where("cities.status", 'Active')
      ->pluck('cities.city_name', 'cities.id');


    $localities = DB::table('localities')
      ->where('localities.city_id', '=', $record->city)
      ->where("localities.status", 'Active')
      ->pluck('localities.locality_name', 'localities.id');


    // dd($record->state);

    return view('customer.manage_address.edit', compact('record', 'countries', 'states', 'cities', 'localities'));

  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */

  public function update(Request $request, $id)
  {

    $customer_address_book = customer_address_book::find($id);

    $data = array(
      'name' => $request->input('name'),
      'email' => $request->input('email'),
      'mobile' => '+' . $request->user_country_code . $request->input('mobile'),
      'phone' => $request->input('phone'),
      'country' => $request->input('country'),
      'city' => $request->input('city'),
      'locality' => $request->input('locality'),
      'pincode' => $request->input('pincode'),
      'address' => $request->input('address'),
      'address_2' => $request->input('address_2'),
      'latitude' => $request->input('latitude'),
      'longitude' => $request->input('longitude'),
      'state' => $request->input('state'),

    );
    $customer_address_book->update($data);



    $notification = array(
      'message' => 'Your form was successfully Update!',
      'alert-type' => 'success'
    );

    return Redirect::to('customer/manage-address')->with($notification);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request)
  {

    $role = customer_address_book::find($request->id);
    $role->delete();

    return $role;
  }

  public function status_update(Request $request)
  {

    $record = customer_address_book::find($request->user_id);

    if ($record['status'] == 'Active') {
      $updatevender = \DB::table('customer_address_books')->where('id', $request->user_id)
        ->update([
          'status' => 'Deactive',
        ]);
      return json_encode('Deactive');
    } else {
      $updateuser = \DB::table('customer_address_books')->where('id', $request->user_id)
        ->update([
          'status' => 'Active',
          // 'updated_at' => date('Y-m-d H:i:s') 
        ]);
      return json_encode("Active");

    }
  }
}