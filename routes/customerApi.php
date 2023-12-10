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


Route::get('testapi','v1\customerApiController@testapi');
// http://mandeclan.com/v1/customerApi/testapi/{mobile} (get)

Route::get('token_check','v1\customerApiController@token_check');
// http://mandeclan.com/v1/customerApi/token_check

Route::get('check_customer_auth/{mobile}','v1\customerApiController@check_customer_auth');
// http://mandeclan.com/v1/customerApi/check_customer_auth/{mobile} (get)

Route::post('customer_sigin_otp_verify','v1\customerApiController@customer_sigin_otp_verify');
// http://mandeclan.com/v1/customerApi/customer_sigin_otp_verify (post)

Route::post('request_for_signup_otp','v1\customerApiController@request_for_signup_otp');
// http://mandeclan.com/v1/customerApi/request_for_signup_otp (post)

Route::post('customer_sigup_otp_verify','v1\customerApiController@customer_sigup_otp_verify');
// http://mandeclan.com/v1/customerApi/customer_sigup_otp_verify (post)


Route::group(['middleware' => 'auth:v1'], function(){



Route::get('customer_subs_plan_history','v1\customerApiController@customer_subs_plan_history');
// https://mandeclan.com/v1/customerApi/customer_subs_plan_history (get)


Route::post('customer_plan_invoice_download','v1\customerApiController@customer_plan_invoice_download');
// https://mandeclan.com/v1/customerApi/customer_plan_invoice_download (post)


Route::get('customer_subs_plan_view','v1\customerApiController@customer_subs_plan_view');
// https://mandeclan.com/v1/customerApi/customer_subs_plan_view (get)

Route::post('customer_purchase_plan','v1\customerApiController@customer_purchase_plan');
// https://mandeclan.com/v1/customerApi/customer_purchase_plan (post)


Route::get('customer_dashboard','v1\customerApiController@customer_dashboard');
// http://mandeclan.com/v1/customerApi/customer_dashboard (get)

Route::get('customer_profile_view','v1\customerApiController@customer_profile_view');
// http://mandeclan.com/v1/customerApi/customer_profile_view (get)


Route::post('customer_profile_update','v1\customerApiController@customer_profile_update');
// http://mandeclan.com/v1/customerApi/customer_profile_update (post)


Route::get('customer_current_order','v1\customerApiController@customer_current_order');
// http://mandeclan.com/v1/customerApi/customer_current_order (get)


Route::get('customer_order_details/{suborder_id}','v1\customerApiController@customer_order_details');
// http://mandeclan.com/v1/customerApi/customer_order_details/{suborder_id} (get)


Route::get('customer_track_order/{suborder_id}','v1\customerApiController@customer_track_order');
// http://mandeclan.com/v1/customerApi/customer_track_order/{suborder_id} (get)


Route::get('customer_cancelled_order','v1\customerApiController@customer_cancelled_order');
// http://mandeclan.com/v1/customerApi/customer_cancelled_order (get)




Route::post('cancelled_order_by_customer','v1\customerApiController@cancelled_order_by_customer');
// http://mandeclan.com/v1/customerApi/cancelled_order_by_customer (post)


Route::get('customer_delivered_order','v1\customerApiController@customer_delivered_order');
// http://mandeclan.com/v1/customerApi/customer_delivered_order (get)


Route::get('customer_wishlist_stores','v1\customerApiController@customer_wishlist_stores');
// http://mandeclan.com/v1/customerApi/customer_wishlist_stores (get)

Route::post('customer_like_store','v1\customerApiController@customer_like_store');
// http://mandeclan.com/v1/customerApi/customer_like_store (post)

Route::post('customer_dislike_store','v1\customerApiController@customer_dislike_store');
// http://mandeclan.com/v1/customerApi/customer_dislike_store (post)





Route::get('customer_rating_review','v1\customerApiController@customer_rating_review');
// http://mandeclan.com/v1/customerApi/customer_rating_review (get)

Route::post('customer_add_rating_review','v1\customerApiController@customer_add_rating_review');
// http://mandeclan.com/v1/customerApi/customer_add_rating_review (post)


Route::get('customer_addressbook_view','v1\customerApiController@customer_addressbook_view');
// http://mandeclan.com/v1/customerApi/customer_addressbook_view (get)


Route::post('customer_addressbook_add','v1\customerApiController@customer_addressbook_add');
// http://mandeclan.com/v1/customerApi/customer_addressbook_add (post)


Route::post('customer_addressbook_update','v1\customerApiController@customer_addressbook_update');
// http://mandeclan.com/v1/customerApi/customer_addressbook_update (post)


Route::post('customer_addressbook_delete','v1\customerApiController@customer_addressbook_delete');
// http://mandeclan.com/v1/customerApi/customer_addressbook_delete (post)

Route::post('customer_addressbooks','v1\customerApiController@customer_addressbooks');
// http://mandeclan.com/v1/customerApi/customer_addressbooks (post)


Route::post('customer_add_bank_detail','v1\customerApiController@customer_add_bank_detail');
// http://mandeclan.com/v1/customerApi/customer_add_bank_detail


Route::get('customer_support_ticket_view','v1\customerApiController@customer_support_ticket_view');
// http://mandeclan.com/v1/customerApi/customer_support_ticket_view (get)

Route::get('ticket_list','v1\customerApiController@ticket_list');
// http://mandeclan.com/v1/customerApi/ticket_list (get)

Route::post('customer_support_ticket_add','v1\customerApiController@customer_support_ticket_add');
// http://mandeclan.com/v1/customerApi/customer_support_ticket_add (post)


Route::get('customer_support_ticket_msg_show/{ticket_id}','v1\customerApiController@customer_support_ticket_msg_show');
// http://mandeclan.com/v1/customerApi/customer_support_ticket_msg_show (get)

Route::post('customer_support_ticket_send_msg','v1\customerApiController@customer_support_ticket_send_msg');
// http://mandeclan.com/v1/customerApi/customer_support_ticket_send_msg (post)

});