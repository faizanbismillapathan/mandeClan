<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware(['treblle'])->group(function () {

  // YOUR API ROUTES GO HERE
  Route::prefix('customerApi')->group(function () {
Route::get('testapi','v1\customerApiController@testapi');
  });

});