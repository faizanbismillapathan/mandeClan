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

Route::get('testapi','v1\rvApiController@testapi');
// https://localhost/mandeclan/v1/rvApi/testapi (get)


Route::get('check_rv_auth/{mobile}','v1\rvApiController@check_rv_auth');
// https://mandeclan.com/v1/rvApi/check_rv_auth/{mobile} (get)

Route::post('rv_sigin_otp_verify','v1\rvApiController@rv_sigin_otp_verify');
// https://mandeclan.com/v1/rvApi/rv_sigin_otp_verify (post)

Route::post('request_for_signup_otp','v1\rvApiController@request_for_signup_otp');
// https://mandeclan.com/v1/rvApi/request_for_signup_otp (post)

Route::post('rv_sigup_otp_verify','v1\rvApiController@rv_sigup_otp_verify');
// https://mandeclan.com/v1/rvApi/rv_sigup_otp_verify (post)

Route::group(['middleware' => 'auth:v1'], function(){


Route::get('rv_dashboard','v1\rvApiController@rv_dashboard');
// https://mandeclan.com/v1/rvApi/rv_dashboard (get)

Route::get('rv_profile_view','v1\rvApiController@rv_profile_view');
// https://mandeclan.com/v1/rvApi/rv_profile_view (get)

Route::post('rv_profile_update','v1\rvApiController@rv_profile_update');
// https://mandeclan.com/v1/rvApi/rv_profile_update (post)

Route::post('rv_add_bank_detail','v1\rvApiController@rv_add_bank_detail');
// https://mandeclan.com/v1/rvApi/rv_add_bank_detail (post)




Route::get('rv_vehicle_list','v1\rvApiController@rv_vehicle_list');
// https://mandeclan.com/v1/rvApi/rv_vehicle_list (get)


Route::get('rv_vehicle_view','v1\rvApiController@rv_vehicle_view');
// https://mandeclan.com/v1/rvApi/rv_vehicle_view (get)

Route::post('rv_vehicle_add','v1\rvApiController@rv_vehicle_add');
// https://mandeclan.com/v1/rvApi/rv_vehicle_add (post)

Route::post('rv_vehicle_update','v1\rvApiController@rv_vehicle_update');
// https://mandeclan.com/v1/rvApi/rv_vehicle_update (post)


Route::get('rv_sim_registration_detail','v1\rvApiController@rv_sim_registration_detail');
// https://mandeclan.com/v1/rvApi/rv_sim_registration_detail (get)

Route::post('rv_sim_registration','v1\rvApiController@rv_sim_registration');
// https://mandeclan.com/v1/rvApi/rv_sim_registration (post)


Route::get('rv_today_assign_orders','v1\rvApiController@rv_today_assign_orders');
// https://mandeclan.com/v1/rvApi/rv_today_assign_orders (get)

Route::post('rv_assign_order_status_update','v1\rvApiController@rv_assign_order_status_update');
// https://mandeclan.com/v1/rvApi/rv_assign_order_status_update (post)


Route::get('rv_delivered_orders','v1\rvApiController@rv_delivered_orders');
// https://mandeclan.com/v1/rvApi/rv_delivered_orders (get)

Route::get('rv_canceled_orders','v1\rvApiController@rv_canceled_orders');
// https://mandeclan.com/v1/rvApi/rv_canceled_orders (get)



Route::get('rv_document_view','v1\rvApiController@rv_document_view');
// https://mandeclan.com/v1/rvApi/rv_document_view (get)

Route::post('rv_document_add','v1\rvApiController@rv_document_add');
// https://mandeclan.com/v1/rvApi/rv_document_add (post)

Route::post('rv_document_form{id?}','v1\rvApiController@rv_document_form');
// https://mandeclan.com/v1/rvApi/rv_document_form (post)

Route::post('rv_document_update','v1\rvApiController@rv_document_update');
// https://mandeclan.com/v1/rvApi/rv_document_update (post)


// ...............................................

Route::get('rv_support_ticket_view','v1\rvApiController@rv_support_ticket_view');
// https://mandeclan.com/v1/rvApi/rv_support_ticket_view (get)

Route::get('ticket_list','v1\rvApiController@ticket_list');
// https://mandeclan.com/v1/rvApi/ticket_list (get)

Route::post('rv_support_ticket_add','v1\rvApiController@rv_support_ticket_add');
// https://mandeclan.com/v1/rvApi/rv_support_ticket_add (post)

Route::get('rv_support_ticket_msg_show/{ticket_id}','v1\rvApiController@rv_support_ticket_msg_show');
// https://mandeclan.com/v1/rvApi/rv_support_ticket_msg_show/15 (get)

Route::post('rv_support_ticket_send_msg','v1\rvApiController@rv_support_ticket_send_msg');
// https://mandeclan.com/v1/rvApi/rv_support_ticket_send_msg (post)

});