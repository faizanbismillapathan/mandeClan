<?php


// Route::get('/login', function () {
//     return view('auth.login');
// });

 Route::get('/login', 'HomeController@index');


// Route::get('/', 'dashboardController@index');

Auth::routes(['verify' => true]);

// php artisan make:model store -mcr

Route::resources([
'dashboard' => 'dashboardController',
'profile' => 'profileController',
'categories' => 'categoriesController',
'services' => 'vendor_servicesController',
'service-document' => 'service_documentController',
'bank-detail'=>'service_bank_detailController',
'orders'=>'ordersController',
'pending-orders' => 'pending_ordersController',
'canceled-orders' => 'canceled_ordersController',
'returned-orders' => 'returned_ordersController',
'invoice-setting' => 'invoice_settingController',
'shipping-info'=>'shipping_infoController',
'subscriptions'=>'subscriptionsController',
'payouts'=>'payoutsController',
'commission'=>'commissionController',
'support-ticket'=>'support_ticketController',
'photo-gallery' => 'photo_galleryController',
'plan-history'=>'plan_historyController',
'booking'=>'service_bookingController',
'deactivate-account' => 'deactivate_accountController',


'change-password' => 'change_passwordController',
'change-email' => 'change_emailController',
'change-contactno' => 'change_contactnoController',

]);


Route::post('verify_service_email', 'change_emailController@verify_service_email');
Route::post('service-update-email', 'change_emailController@service_update_email');

Route::post('verify_service_mobile', 'change_contactnoController@verify_service_mobile');
Route::post('service-update-mobile', 'change_contactnoController@service_update_mobile');


Route::post('verify_and_deactivate', 'deactivate_accountController@verify_and_deactivate');

 Route::get('profiles/delete', 'profileController@status_update')->name('service.profile.delete');

Route::post('service-enquiry','service_bookingController@service_enquiry');

Route::post('append_user_info','service_bookingController@append_user_info');
Route::post('booking-update','service_bookingController@booking_update');

Route::post('append_service_category','vendor_servicesController@append_service_category');

Route::post('store_custom_category','categoriesController@store_custom_category');

Route::get('store-invoice-pdf/{id}','plan_historyController@store_invoice_pdf');

Route::post('unsubscribe_plan', 'subscriptionsController@unsubscribe_plan');
Route::post('paypal_transection', 'subscriptionsController@paypalPost');
Route::post('stripe_transection', 'subscriptionsController@stripePost');


Route::post('change_order_status','ordersController@status_update');
Route::post('suborder_assign_rider', 'ordersController@suborder_assign_rider');
Route::get('find_riders', 'ordersController@find_riders');

Route::get('order_items/{id}', 'ordersController@order_items');
Route::get('suborder_items/{id}', 'ordersController@suborder_items');



Route::get('order-invoice-pdf/{id}','ordersController@order_invoice_pdf');


Route::post('product-items-update','product_itemsController@attr_update');

Route::post('master_product_store','product_mastersController@master_product_store');

Route::post('product-items-store','product_itemsController@attr_store');
Route::get('order_manage/{id}', 'ordersController@manageOrder');


Route::post('create_product_items','product_itemsController@Create_Items');

Route::post('append_category_checkbox','categoriesController@append_category_checkbox');

Route::post('product-addon-group-update','product_addon_groupController@update');
Route::post('product-addon-list-update','product_addonController@update');


Route::get('/support-ticket-msg/{ticket_id}', 'support_ticketController@support_ticket_msg');

Route::post('/reply-support-ticket', 'support_ticketController@reply_support_ticket');



Route::patch('/store_profile/{id}/update/', ['as' => 'store_profile.update', 'uses' => 'profileController@update']);

Route::post('append_product_category','vendor_servicesController@append_product_category');

Route::post('check_edit_login_email','dashboardController@check_edit_login_email');
 Route::get('profiles/email_verify', 'profileController@status_email_verify')->name('services.profile.email_verify');



Route::post(Request::segment(2).'/status_update',str_replace('-', '_', Request::segment(2)).'Controller@status_update');

Route::post(Request::segment(2).'/delete', str_replace('-', '_', Request::segment(2)).'Controller@destroy');
Route::post(Request::segment(2).'/unique_name',str_replace('-', '_', Request::segment(2)).'Controller@check_unique_name');

Route::post('services/status_update','vendor_servicesController@status_update');
Route::post('services/delete','vendor_servicesController@destroy');


Route::get('/{name}', function () {
    return view('service.underconstruction');
});
