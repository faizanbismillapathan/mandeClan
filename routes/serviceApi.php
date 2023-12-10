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


Route::get('check_service_auth/{mobile}','v1\serviceApiController@check_service_auth');
// https://mandeclan.com/v1/serviceApi/check_service_auth/{mobile} (get)

Route::post('service_sigin_otp_verify','v1\serviceApiController@service_sigin_otp_verify');
// https://mandeclan.com/v1/serviceApi/service_sigin_otp_verify (post)

Route::post('request_for_signup_otp','v1\serviceApiController@request_for_signup_otp');
// https://mandeclan.com/v1/serviceApi/request_for_signup_otp (post)

Route::post('service_sigup_otp_verify','v1\serviceApiController@service_sigup_otp_verify');
// https://mandeclan.com/v1/serviceApi/service_sigup_otp_verify (post)


Route::group(['middleware' => 'auth:v1'], function(){

Route::get('testapi','v1\serviceApiController@testapi');
// https://mandeclan.com/v1/serviceApi/testapi (get)


Route::get('service_dashboard','v1\serviceApiController@service_dashboard');
// https://mandeclan.com/v1/serviceApi/service_dashboard (get)


Route::get('service_profile_view','v1\serviceApiController@service_profile_view');
// https://mandeclan.com/v1/serviceApi/service_profile_view (get)


Route::get('service_profile_view_only','v1\serviceApiController@service_profile_view_only');
// https://mandeclan.com/v1/serviceApi/service_profile_view_only (get)


Route::post('service_profile_update','v1\serviceApiController@service_profile_update');
// https://mandeclan.com/v1/serviceApi/service_profile_update (post)


Route::get('service_selected_categories','v1\serviceApiController@service_selected_categories');
// https://mandeclan.com/v1/serviceApi/service_selected_categories (get)


Route::post('service_add_new_category','v1\serviceApiController@service_add_new_category');
// https://mandeclan.com/v1/serviceApi/service_add_new_category (post)

Route::post('service_add_new_custome_category','v1\serviceApiController@service_add_new_custome_category');
// https://mandeclan.com/v1/serviceApi/service_add_new_custome_category (post)



Route::get('service_item_view','v1\serviceApiController@service_item_view');
// https://mandeclan.com/v1/serviceApi/service_item_view?search={search by name} (get)

Route::get('service_item_form_view','v1\serviceApiController@service_item_form_view');
// https://mandeclan.com/v1/serviceApi/service_item_form_view (get)

Route::post('service_item_add','v1\serviceApiController@service_item_add');
// https://mandeclan.com/v1/serviceApi/service_item_add (post)

Route::post('service_item_update','v1\serviceApiController@service_item_update');
// https://mandeclan.com/v1/serviceApi/service_item_update (post)

Route::post('service_item_delete','v1\serviceApiController@service_item_delete');
// https://mandeclan.com/v1/serviceApi/service_item_delete (post)




Route::get('service_booking_view','v1\serviceApiController@service_booking_view');
// https://mandeclan.com/v1/serviceApi/service_booking_view (get)



Route::post('append_booking_user_info','v1\serviceApiController@append_booking_user_info');
// https://mandeclan.com/v1/serviceApi/append_booking_user_info (post)

Route::post('service_booking_add','v1\serviceApiController@service_booking_add');
// https://mandeclan.com/v1/serviceApi/service_booking_add (post)

Route::post('service_booking_update','v1\serviceApiController@service_booking_update');
// https://mandeclan.com/v1/serviceApi/service_booking_update (post)

Route::post('service_booking_delete','v1\serviceApiController@service_booking_delete');
// https://mandeclan.com/v1/serviceApi/service_booking_delete (post)

Route::post('service_booking_send_enquiry','v1\serviceApiController@service_booking_send_enquiry');
// https://mandeclan.com/v1/serviceApi/service_booking_send_enquiry (post)


Route::get('service_booking_view_enquiry','v1\serviceApiController@service_booking_view_enquiry');
// https://mandeclan.com/v1/serviceApi/service_booking_view_enquiry (get)



Route::get('service_document_view','v1\serviceApiController@service_document_view');
// https://mandeclan.com/v1/serviceApi/service_document_view (get)

Route::post('service_document_add','v1\serviceApiController@service_document_add');
// https://mandeclan.com/v1/serviceApi/service_document_add (post)

Route::post('service_document_form{id?}','v1\serviceApiController@service_document_form');
// https://mandeclan.com/v1/serviceApi/service_document_form (post)

Route::post('service_document_update','v1\serviceApiController@service_document_update');
// https://mandeclan.com/v1/serviceApi/service_document_update (post)

Route::get('service_photo_gallery','v1\serviceApiController@service_photo_gallery');
// https://mandeclan.com/v1/serviceApi/service_photo_gallery (get)

Route::post('service_photo_gallery_add','v1\serviceApiController@service_photo_gallery_add');
// https://mandeclan.com/v1/serviceApi/service_photo_gallery_add (post)

Route::post('service_photo_gallery_update','v1\serviceApiController@service_photo_gallery_update');
// https://mandeclan.com/v1/serviceApi/service_photo_gallery_update (post)



Route::get('service_support_ticket_view','v1\serviceApiController@service_support_ticket_view');
// https://mandeclan.com/v1/serviceApi/service_support_ticket_view (get)

Route::get('ticket_list','v1\serviceApiController@ticket_list');
// https://mandeclan.com/v1/serviceApi/ticket_list (get)

Route::post('service_support_ticket_add','v1\serviceApiController@service_support_ticket_add');
// https://mandeclan.com/v1/serviceApi/service_support_ticket_add (post)

Route::get('service_support_ticket_msg_show/{ticket_id}','v1\serviceApiController@service_support_ticket_msg_show');
// https://mandeclan.com/v1/serviceApi/service_support_ticket_msg_show (get)

Route::post('service_support_ticket_send_msg','v1\serviceApiController@service_support_ticket_send_msg');
// https://mandeclan.com/v1/serviceApi/service_support_ticket_send_msg (post)

Route::get('service_subs_plan_view','v1\serviceApiController@service_subs_plan_view');
// https://mandeclan.com/v1/serviceApi/service_subs_plan_view (get)

Route::post('service_purchase_plan','v1\serviceApiController@service_purchase_plan');
// https://mandeclan.com/v1/serviceApi/service_purchase_plan (post)


Route::get('service_subs_plan_history','v1\serviceApiController@service_subs_plan_history');
// https://mandeclan.com/v1/serviceApi/service_subs_plan_history (get)

Route::post('service_plan_invoice_download','v1\serviceApiController@service_plan_invoice_download');
// https://mandeclan.com/v1/serviceApi/service_plan_invoice_download (post)

Route::post('service_add_bank_detail','v1\serviceApiController@service_add_bank_detail');
// http://mandeclan.com/v1/serviceApi/service_add_bank_detail (post)


});