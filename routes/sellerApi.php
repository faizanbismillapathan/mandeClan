<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::get('check_seller_auth/{mobile}', 'v1\sellerApiController@check_seller_auth');
// https://mandeclan.com/v1/sellerApi/check_seller_auth/{mobile} (get)

Route::post('seller_sigin_otp_verify', 'v1\sellerApiController@seller_sigin_otp_verify');
// https://mandeclan.com/v1/sellerApi/seller_sigin_otp_verify (post)

// Route::post('resendOtp','v1\sellerApiController@resendOtp');
// // https://mandeclan.com/v1/sellerApi/resendOtp (post)

Route::get('resendOtp/{mobile}', 'v1\sellerApiController@resendOtp');
// https://mandeclan.com/v1/sellerApi/resendOtp/{mobile} (get)

Route::post('request_for_signup_otp', 'v1\sellerApiController@request_for_signup_otp');
// https://mandeclan.com/v1/sellerApi/request_for_signup_otp (post)

Route::post('seller_sigup_otp_verify', 'v1\sellerApiController@seller_sigup_otp_verify');
// https://mandeclan.com/v1/sellerApi/seller_sigup_otp_verify (post)


Route::post('seller_signup', 'v1\sellerApiController@seller_signup');
// https://mandeclan.com/v1/sellerApi/seller_signup (post)


Route::get('seller-signup-form', 'v1\sellerApiController@seller_sign_up_form');


Route::group(['middleware' => 'auth:v1'], function () {


    Route::get('kyc_status', 'v1\sellerApiController@kyc_status');
    // https://mandeclan.com/v1/sellerApi/kyc_status (get)

    Route::get('product_status_update', 'v1\sellerApiController@product_status_update');
    // http://mandeclan.com/v1/sellerApi/product_status_update

    Route::post('seller_add_bank_detail', 'v1\sellerApiController@seller_add_bank_detail');
    // http://mandeclan.com/v1/sellerApi/seller_add_bank_detail


    Route::get('seller_bank_detail_view', 'v1\sellerApiController@seller_bank_detail_view');
    // http://mandeclan.com/v1/sellerApi/seller_bank_detail_view



    Route::get('seller_subs_plan_view', 'v1\sellerApiController@seller_subs_plan_view');
    // https://mandeclan.com/v1/sellerApi/seller_subs_plan_view (get)

    Route::post('seller_purchase_plan', 'v1\sellerApiController@seller_purchase_plan');
    // https://mandeclan.com/v1/sellerApi/seller_purchase_plan (post)



    Route::get('seller_subs_plan_history', 'v1\sellerApiController@seller_subs_plan_history');
    // https://mandeclan.com/v1/sellerApi/seller_subs_plan_history (get)


    Route::post('seller_plan_invoice_download', 'v1\sellerApiController@seller_plan_invoice_download');
    // https://mandeclan.com/v1/sellerApi/seller_plan_invoice_download (post)



    Route::get('seller_dashboard', 'v1\sellerApiController@seller_dashboard');
    // https://mandeclan.com/v1/sellerApi/seller_dashboard (get)


    Route::get('seller_profile_view', 'v1\sellerApiController@seller_profile_view');
    // https://mandeclan.com/v1/sellerApi/seller_profile_view (get)


    Route::get('seller_profile_view_only', 'v1\sellerApiController@seller_profile_view_only');
    // https://mandeclan.com/v1/sellerApi/seller_profile_view_only (get)


    //Route::post('seller_profile_update','v1\sellerApiController@seller_profile_update');
    // https://mandeclan.com/v1/sellerApi/seller_profile_update (post)

    Route::post('seller_detail_update', 'v1\sellerApiController@seller_detail_update');
    // https://mandeclan.com/v1/sellerApi/seller_detail_update (post)

    Route::post('seller_location_update', 'v1\sellerApiController@seller_location_update');
    // https://mandeclan.com/v1/sellerApi/seller_location_update (post)

    Route::get('seller_categories', 'v1\sellerApiController@seller_categories');
    // https://mandeclan.com/v1/sellerApi/seller_categories (get)


    Route::post('seller_add_new_category', 'v1\sellerApiController@seller_add_new_category');
    // https://mandeclan.com/v1/sellerApi/seller_add_new_category (post)

    Route::get('append_product_category', 'v1\sellerApiController@append_product_category');
    // https://mandeclan.com/v1/sellerApi/append_product_category (get)



    Route::get('seller_append_category', 'v1\sellerApiController@seller_append_category');
    // https://mandeclan.com/v1/sellerApi/seller_append_category (get)


    Route::get('master_product_list', 'v1\sellerApiController@master_product_list');
    // https://mandeclan.com/v1/sellerApi/master_product_list (get)


    Route::post('master_product_store', 'v1\sellerApiController@master_product_store');
    // https://mandeclan.com/v1/sellerApi/master_product_store (post)


    Route::get('seller_product_view', 'v1\sellerApiController@seller_product_view');
    // https://mandeclan.com/v1/sellerApi/seller_product_view (get)

    Route::get('seller_product_form', 'v1\sellerApiController@seller_product_form');
    // https://mandeclan.com/v1/sellerApi/seller_product_form (get)


    Route::post('seller_product_add', 'v1\sellerApiController@seller_product_add');
    // https://mandeclan.com/v1/sellerApi/seller_product_add (post)

    Route::get('seller_product_edit_form/{id}', 'v1\sellerApiController@seller_product_edit_form');
    // https://mandeclan.com/v1/sellerApi/seller_product_edit_form/{id} (get)


    Route::post('seller_product_update', 'v1\sellerApiController@seller_product_update');
    // https://mandeclan.com/v1/sellerApi/seller_product_update (get)


    Route::post('product_item_add', 'v1\sellerApiController@product_item_add');
    // https://mandeclan.com/v1/sellerApi/product_item_add (post)

    Route::get('product_item_form/{product_id}', 'v1\sellerApiController@product_item_form');
    // https://mandeclan.com/v1/sellerApi/product_item_form/{product_id} (get)

    Route::post('product_item_update', 'v1\sellerApiController@product_item_update');
    // https://mandeclan.com/v1/sellerApi/product_item_update (post)



    Route::post('product_add_options', 'v1\sellerApiController@product_add_options');
    // https://mandeclan.com/v1/sellerApi/product_add_options (post)


    Route::post('product_update_options', 'v1\sellerApiController@product_update_options');
    // https://mandeclan.com/v1/sellerApi/product_update_options (post)


    Route::post('product_add_varient', 'v1\sellerApiController@product_add_varient');
    // https://mandeclan.com/v1/sellerApi/product_add_varient (post)



    Route::get('seller_document_view', 'v1\sellerApiController@seller_document_view');
    // https://mandeclan.com/v1/sellerApi/seller_document_view (get)

    Route::post('seller_document_add', 'v1\sellerApiController@seller_document_add');
    // https://mandeclan.com/v1/sellerApi/seller_document_add (post)

    Route::get('seller_document_form{id?}', 'v1\sellerApiController@seller_document_form');
    // https://mandeclan.com/v1/sellerApi/seller_document_form (get)

    Route::post('seller_document_update', 'v1\sellerApiController@seller_document_update');
    // https://mandeclan.com/v1/sellerApi/seller_document_update (post)


    Route::get('seller_orders_list', 'v1\sellerApiController@seller_orders_list');
    // https://mandeclan.com/v1/sellerApi/seller_orders_list (get)



    Route::get('seller_orders_detail/{id}', 'v1\sellerApiController@seller_orders_detail');
    // https://mandeclan.com/v1/sellerApi/seller_orders_detail (get)


    Route::get('order_status_update', 'v1\sellerApiController@order_status_update');
    // http://mandeclan.com/v1/sellerApi/order_status_update


    Route::get('seller_photo_gallery', 'v1\sellerApiController@seller_photo_gallery');
    // https://mandeclan.com/v1/sellerApi/seller_photo_gallery (get)


    Route::post('seller_photo_gallery_add', 'v1\sellerApiController@seller_photo_gallery_add');
    // https://mandeclan.com/v1/sellerApi/seller_photo_gallery_add (post)


    Route::post('seller_photo_gallery_update', 'v1\sellerApiController@seller_photo_gallery_update');
    // https://mandeclan.com/v1/sellerApi/seller_photo_gallery_update (post)



    Route::get('seller_support_ticket_view', 'v1\sellerApiController@seller_support_ticket_view');
    // https://mandeclan.com/v1/sellerApi/seller_support_ticket_view (get)

    Route::get('ticket_list', 'v1\sellerApiController@ticket_list');
    // https://mandeclan.com/v1/sellerApi/ticket_list (get)

    Route::post('seller_support_ticket_add', 'v1\sellerApiController@seller_support_ticket_add');
    // https://mandeclan.com/v1/sellerApi/seller_support_ticket_add (post)

    Route::get('seller_support_ticket_msg_show/{ticket_id}', 'v1\sellerApiController@seller_support_ticket_msg_show');
    // https://mandeclan.com/v1/sellerApi/seller_support_ticket_msg_show (get)

    Route::post('seller_support_ticket_send_msg', 'v1\sellerApiController@seller_support_ticket_send_msg');
    // https://mandeclan.com/v1/sellerApi/seller_support_ticket_send_msg (post)

    Route::post('seller_profile_update', 'v1\sellerApiController@seller_profile_update');
    // https://mandeclan.com/v1/sellerApi/seller_profile_update (post)



    // .....................

    Route::get('seller_change_password_view', 'v1\sellerApiController@seller_change_password_view');
    // https://mandeclan.com/v1/sellerApi/seller_change_password_view (get)

    Route::get('seller_change_password', 'v1\sellerApiController@seller_change_password');
    // https://mandeclan.com/v1/sellerApi/seller_change_password (get)

    Route::get('seller_change_email_view', 'v1\sellerApiController@seller_change_email_view');
    // https://mandeclan.com/v1/sellerApi/seller_change_email_view (get)

    Route::post('seller_send_email', 'v1\sellerApiController@seller_send_email');
    // https://mandeclan.com/v1/sellerApi/seller_send_email (post)

    Route::post('verify_seller_email', 'change_emailController@verify_seller_email');
    // https://mandeclan.com/v1/sellerApi/verify_seller_email (post)

    Route::post('seller_update_email', 'change_emailController@seller_update_email');
    // https://mandeclan.com/v1/sellerApi/seller_update_email (post)

    Route::get('seller_change_mobile_view', 'v1\sellerApiController@seller_change_mobile_view');
    // https://mandeclan.com/v1/sellerApi/seller_change_mobile_view (get)

    Route::post('seller_send_mobile', 'v1\sellerApiController@seller_send_mobile');
    // https://mandeclan.com/v1/sellerApi/seller_send_mobile (post)

    Route::post('verify_seller_mobile', 'v1\sellerApiController@verify_seller_mobile');
    // https://mandeclan.com/v1/sellerApi/verify_seller_mobile (post)

    Route::get('seller_acount_deactivate', 'v1\sellerApiController@seller_acount_deactivate');
    // https://mandeclan.com/v1/sellerApi/seller_acount_deactivate (get)

    Route::get('send_delete_account_otp', 'v1\sellerApiController@send_delete_account_otp');
    // https://mandeclan.com/v1/sellerApi/send_delete_account_otp (get)

    Route::post('delete_account_otp_verify', 'v1\sellerApiController@delete_account_otp_verify');
    // https://mandeclan.com/v1/sellerApi/delete_account_otp_verify (post)

    Route::get('store_payout', 'v1\sellerApiController@store_payout');
    // https://mandeclan.com/v1/sellerApi/store_payout (get)

    Route::get('store_item_wise_payout', 'v1\sellerApiController@store_item_wise_payout');
    // https://mandeclan.com/v1/sellerApi/store_item_wise_payout (get)


    Route::get('store_item_wise_payout/{id?}', 'v1\sellerApiController@store_item_wise_payout');
    // https://mandeclan.com/v1/sellerApi/store_item_wise_payout/{id?} (get)

    Route::get('store_item_wise_pdf_payout/{id?}', 'v1\sellerApiController@store_item_wise_pdf_payout');
    // https://mandeclan.com/v1/sellerApi/store_item_wise_pdf_payout/{id?} (get)

    Route::get('store_item_wise_excel_payout/{id?}', 'v1\sellerApiController@store_item_wise_excel_payout');
    // https://mandeclan.com/v1/sellerApi/store_item_wise_excel_payout/{id?} (get)




});
