<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'frontend\frontendController@index');

Route::get('/testmail', 'frontend\frontendController@testmail');

Route::get('/testsms', 'frontend\frontendController@testsms');

Route::get('/home', 'HomeController@index');
Route::get('/login', 'HomeController@index');
Route::get('/thanku', 'frontend\addToCartController@thanku');
Route::get('/thank-u', 'frontend\addToCartController@thank_u');

Route::get('/verify/{token}', 'frontend\footerController@verification');

Route::get('/our-team', 'frontend\footerController@our_team');

Route::get('/customer-login', 'frontend\addToCartController@customer_login');
Route::get('vendor-login', 'frontend\addToCartController@vendor_login');
Route::post('check_new_vendor_credntial', 'frontend\addToCartController@check_new_vendor_credntial');

Route::get('vendor-signup', 'frontend\addToCartController@vendor_sign_up');

Route::post('check_careere_mobile', 'frontend\addToCartController@check_careere_mobile');
Route::post('check_careere_email', 'frontend\addToCartController@check_careere_email');


Route::post('check_store_owner_mobile', 'frontend\addToCartController@check_store_owner_mobile');
Route::post('vendor_ragister', 'frontend\addToCartController@vendor_store');
Route::post('send_vendor_otp_signup', 'frontend\addToCartController@send_vendor_otp_signup');

Auth::routes(['verify' => true]);

Route::post('checkout_order', 'frontend\checkoutController@checkout_order');

Route::post('service-booking', 'frontend\checkoutController@service_booking');

Route::get('/homesearch', 'frontend\frontendController@homesearch');

Route::get('/product-item', 'frontend\frontendController@product_item');


Route::post('like_update', 'frontend\frontendController@like_update');
Route::post('dislike_update', 'frontend\frontendController@dislike_update');


// Route::get('/track-order', 'frontend\my_ordersController@track_order');

// Route::get('/store-list', 'frontend\frontendController@store_list');
// Route::get('/store-detail', 'frontend\frontendController@store_detail');
Route::get('/online-order', 'frontend\frontendController@online_order');
Route::get('/view-cart', 'frontend\frontendController@view_cart');
Route::get('/checkout', 'frontend\checkoutController@checkout');

Route::post('append_search_cities', 'frontend\frontendController@append_search_cities');
Route::post('append_search_categories', 'frontend\frontendController@append_search_categories');

Route::post('append_search_localities', 'frontend\frontendController@append_search_localities');

Route::post('attr_base_change_item_details', 'frontend\frontendController@attr_base_change_item_details');

Route::get('updatecartviewproductajax', 'frontend\addToCartController@updatecartviewproductajax');

Route::get('updatecartproductajax', 'frontend\addToCartController@UpdateCartProductAjax');
Route::get('removecartproduct', 'frontend\addToCartController@RemoveCartProduct');

Route::get('removecarts', 'frontend\addToCartController@removecarts');

Route::post('send_client_otp', 'frontend\addToCartController@send_client_otp');
Route::post('check_new_user_name', 'frontend\addToCartController@check_new_user_name');
Route::post('send_client_otp_signup', 'frontend\addToCartController@send_client_otp_signup');
Route::post('send_client_otp_sigin', 'frontend\addToCartController@send_client_otp_sigin');
Route::post('check_vendor_contactno', 'frontend\addToCartController@check_vendor_contactno');
Route::post('check_user_name', 'frontend\addToCartController@check_user_name');



Route::post('change-product-option', 'frontend\addToCartController@changeProductOption');
Route::post('add-product-to-cart', 'frontend\addToCartController@addProductToCart');
Route::post('minus-product-count', 'frontend\addToCartController@productQtyDecrement');
Route::post('plus-product-count', 'frontend\addToCartController@productQtyIncrement');
Route::post('remove-product-count', 'frontend\addToCartController@removeProductFromCart');

Route::post('attr_base_change_item', 'frontend\frontendController@attr_base_change_item');

Route::get('addcartitembyajax', 'frontend\addToCartController@addcartitembyajax');
Route::get('addcartcustomiseitembyajax', 'frontend\addToCartController@addcartcustomiseitembyajax');

Route::get('faqs', 'frontend\footerController@getFaqsPage');
Route::get('about-us', 'frontend\footerController@getAboutUsPage');
Route::get('contact-us', 'frontend\footerController@getContactUsPage');
Route::get('privacy-policy', 'frontend\footerController@getPrivacyPolicyPage');
Route::get('terms-and-conditions', 'frontend\footerController@getTermsConditionsPage');
Route::post('contact-us', 'frontend\footerController@contact_us_store');
Route::get('security', 'frontend\footerController@getsecurityPage');
Route::get('return-policy', 'frontend\footerController@getReturnPolicyPage');

Route::get('business-with-us', 'frontend\footerController@business_with_us');
Route::post('business-with-us', 'frontend\footerController@business_with_us_store');

Route::get('careers', 'frontend\footerController@getcareersPage');
Route::post('careers', 'frontend\footerController@careers_store');


Route::get('create-transaction', 'frontend\checkoutController@createTransaction')->name('createTransaction');
Route::get('process-transaction', 'frontend\checkoutController@processTransaction')->name('processTransaction');
Route::get('success-transaction', 'frontend\checkoutController@successTransaction')->name('successTransaction');
Route::get('cancel-transaction', 'frontend\checkoutController@cancelTransaction')->name('cancelTransaction');


Route::post('stripe', 'frontend\checkoutController@stripePost')->name('stripe.post');

Route::get('payment', 'frontend\checkoutController@payment')->name('payment');
Route::get('cancel', 'frontend\checkoutController@cancel')->name('payment.cancel');
Route::get('payment/success', 'frontend\checkoutController@success')->name('payment.success');

Route::get('payment-process', 'frontend\frontendController@payment_process');

Route::get('stripes', 'frontend\checkoutController@stripePost')->name('stripes');

// Route::post('append_locality','frontend\footerController@append_locality');
// Route::post('append_pincode','frontend\footerController@append_pincode');


Route::post('append_state', 'frontend\frontendController@append_state');
Route::post('append_city', 'frontend\frontendController@append_city');
Route::get('append_locality', 'frontend\frontendController@append_locality');
Route::post('append_pincode', 'frontend\frontendController@append_pincode');



Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

// .........................................................
Route::get('order/{link}', 'frontend\frontendController@online_order');

Route::get('/details/{link}', 'frontend\frontendController@product_detail');
Route::get('book/{link}', 'frontend\frontendController@online_book');

Route::get('/profile/{link}', 'frontend\frontendController@store_detail');

Route::get('/service-profile/{link}', 'frontend\frontendController@service_detail');

Route::get('/{locality}/{category}/store-list', 'frontend\frontendController@store_list');
Route::get('/{locality}/{category}/vendor-service-list', 'frontend\frontendController@vendor_service_list');

Route::get('/{locality?}', 'frontend\frontendController@index');
