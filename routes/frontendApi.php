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

Route::get('testapi','v1\homeApiController@testapi');
// http://mandeclan.com/v1/frontendApi/testapi/{mobile} (get)

Route::get('terms_and_conditions', 'v1\homeApiController@getTermsConditionsPage');
// http://mandeclan.com/v1/frontendApi/terms_and_conditions (get)

Route::get('about_us', 'v1\homeApiController@getAboutUsPage');
// http://mandeclan.com/v1/frontendApi/about_us (get)



Route::get('append_state','v1\homeApiController@append_state');
Route::get('append_city','v1\homeApiController@append_city');
Route::get('append_locality','v1\homeApiController@append_locality');
Route::get('append_pincode','v1\homeApiController@append_pincode');

 //http://mandeclan.com/v1/frontendApi/append_state
// .................................

Route::get('banners','v1\homeApiController@banners');
// http://mandeclan.com/v1/frontendApi/banners (get)


Route::post('contact_us_store','v1\homeApiController@contact_us_store');
// http://mandeclan.com/v1/frontendApi/contact_us_store (post)


Route::post('career_store','v1\homeApiController@career_store');
// http://mandeclan.com/v1/frontendApi/career_store (post)


Route::post('business_with_us_store','v1\homeApiController@business_with_us_store');
// http://mandeclan.com/v1/frontendApi/business_with_us_store (post)


Route::get('faqs','v1\homeApiController@faqs');
// http://mandeclan.com/v1/frontendApi/faqs (get)



Route::get('policy_pages','v1\homeApiController@policy_pages');
// http://mandeclan.com/v1/frontendApi/policy_pages (get)



// ................................

Route::get('all_cities', 'v1\homeApiController@all_cities');
// http://mandeclan.com/v1/frontendApi/all_cities (get)
Route::get('home_categories', 'v1\homeApiController@home_categories');
// http://mandeclan.com/v1/frontendApi/home_categories (get)

Route::get('service_categories', 'v1\serviceHomeApiController@service_categories');
// http://mandeclan.com/v1/frontendApi/service_categories (get)


Route::get('store_list', 'v1\homeApiController@store_list');
// http://mandeclan.com/v1/frontendApi/store_list?category_id={4}&locality_id={8} (get)

Route::get('service_list', 'v1\serviceHomeApiController@service_list');
// http://mandeclan.com/v1/frontendApi/service_list?category_id=4&locality_id=8 (get)


Route::get('store_detail', 'v1\homeApiController@store_detail');
// http://mandeclan.com/v1/frontendApi/store_detail?store_id={1} (get)

Route::get('service_detail', 'v1\serviceHomeApiController@service_detail');
// http://mandeclan.com/v1/frontendApi/service_detail?service_id=1 (get)
Route::get('service_booking_category', 'v1\serviceHomeApiController@service_booking_category');
// http://mandeclan.com/v1/frontendApi/service_booking_category?service_id=1 (get)


Route::post('store_item_list', 'v1\homeApiController@store_item_list');
// http://mandeclan.com/v1/frontendApi/store_item_list (post)



Route::get('service_item_list', 'v1\serviceHomeApiController@service_item_list');
// http://mandeclan.com/v1/frontendApi/service_item_list?service_id=1 (get)


// store_id
// category_id
// subcategory_id
// brand_id
// sort [new,asc,desc]



Route::post('view_cart', 'v1\homeApiController@view_cart');
// http://mandeclan.com/v1/frontendApi/view_cart (post)


Route::post('view_cart', 'v1\homeApiController@view_cart');
// http://mandeclan.com/v1/frontendApi/token_generate_api (post)




Route::post('token_generate_api', 'v1\homeApiController@token_generate_api');
 // http://mandeclan.com/v1/frontendApi/token_generate_api (post)

Route::group(['middleware' => 'auth:v1'], function(){

// Route::get('store_list', 'v1\homeApiController@store_list');
// http://mandeclan.com/v1/frontendApi/store_list?category_id={4}&locality_id={8} (get)


Route::post('checkout', 'v1\homeApiController@checkout');
// http://mandeclan.com/v1/frontendApi/checkout (post)

Route::post('add_item_to_cart', 'v1\homeApiController@add_item_to_cart');
// http://mandeclan.com/v1/frontendApi/add_item_to_cart (post)

Route::post('orders', 'v1\homeApiController@orders');
// http://mandeclan.com/v1/frontendApi/orders (post)


// Route::get('store_detail', 'v1\homeApiController@store_detail');
// // http://mandeclan.com/v1/frontendApi/store_detail?store_id={1}


// Route::get('service_detail', 'v1\serviceHomeApiController@service_detail');
// // // http://mandeclan.com/v1/frontendApi/service_detail?service_id={1}

Route::post('service_book_enquiry', 'v1\serviceHomeApiController@service_book_enquiry');
// http://mandeclan.com/v1/frontendApi/service_book_enquiry  (post)
});
