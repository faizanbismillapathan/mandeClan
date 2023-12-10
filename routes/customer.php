<?php


// Route::get('/login', function () {
//     return view('auth.login');
// });
// Route::get('/', 'dashboardController@index');
 Route::get('/login', 'HomeController@index');


Auth::routes(['verify' => true]);

// php artisan make:model store -mcr

Route::resources([
        'dashboard' => 'dashboardController',
        'profile' => 'profileController',
        'wishlist' => 'wishlistController',
        'manage-address' => 'manage_addressController',
        'order-history' => 'order_historyController',
        'followed-store' => 'followed_storeController',
        'order-rating' => 'order_ratingController',
        'support-&-help' => 'support_and_helpController',
        'wallet' => 'walletController',
        'support-ticket' => 'support_ticketController',
        'bank-detail' => 'bank_detailController',
        'change-password' => 'change_passwordController',
        'shared-product' => 'shared_productController',
        'my-orders'=>'my_ordersController',
        'rating-review'=>'rating_reviewController',
        'payment-history'=>'payment_historyController',
        'subscriptions'=>'subscriptionsController',
        'plan-history'=>'plan_historyController',
        'service-enquiry' => 'service_enquiryController',
'deactivate-account' => 'deactivate_accountController',

]);

Route::post('verify_and_deactivate', 'deactivate_accountController@verify_and_deactivate');

 Route::get('profiles/delete', 'profileController@status_update')->name('customer.profile.delete');
 Route::get('customer/email_verify', 'profileController@status_email_verify')->name('customers.profile.email_verify');


Route::get('store-invoice-pdf/{id}','plan_historyController@store_invoice_pdf');
Route::post('unsubscribe_plan', 'subscriptionsController@unsubscribe_plan');
Route::post('paypal_transection', 'subscriptionsController@paypalPost');
Route::post('stripe_transection', 'subscriptionsController@stripePost');



Route::get('order-invoice-pdf/{id}','order_historyController@order_invoice_pdf');

Route::get('/cancelled-order', 'order_historyController@cancelled_order');

Route::get('/rating-review/{store_id}', 'rating_reviewController@store_reviews');
Route::post('store_review_add','rating_reviewController@store_review_add');

Route::get('support-ticket-msg/{ticket_id}', 'support_ticketController@support_ticket_msg');
Route::get('/track-order/{suborder_id}', 'my_ordersController@track_order');
Route::post('/reply-support-ticket', 'support_ticketController@reply_support_ticket');

Route::post('append_state','commanController@append_state');
Route::post('append_city','commanController@append_city');
Route::post('append_locality','commanController@append_locality');
Route::post('append_pincode','commanController@append_pincode');

Route::get('/order-detail/{suborder_id}', 'my_ordersController@order_detail');
Route::post('change_suborder_status','my_ordersController@status_update');

Route::post(Request::segment(2).'/status_update',str_replace('-', '_', Request::segment(2)).'Controller@status_update');

Route::post(Request::segment(2).'/delete', str_replace('-', '_', Request::segment(2)).'Controller@destroy');
Route::post(Request::segment(2).'/unique_name',str_replace('-', '_', Request::segment(2)).'Controller@check_unique_name');

Route::get('/{name}', function () {
    return view('customer.underconstruction');
});