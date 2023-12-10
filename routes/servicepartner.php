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
    'sim-registration' => 'sim_registrationController',
    'assigned-vehicle' => 'assigned_vehicleController',
    'live-gps-location' => 'live_gps_locationController',
    'today-assigned-vehicle' => 'today_assigned_vehicleController',
    'today-orders'=>'today_ordersController',
    'pending-orders'=>'pending_ordersController',
    'delivered-orders'=>'delivered_ordersController',
    'canceled-orders'=>'canceled_ordersController',
    'document'=>'documentController',
    'bank-detail'=>'bank_detailController',
    'today-earning'=>'today_earningController',
    'payout-history'=>'payout_historyController',
    'change-password'=>'change_passwordController',
    'payout-history'=>'payout_historyController',
    'support-ticket'=>'support_ticketController',
    'vehicle-list'=>'vehicle_listController',
    'deactivate-account' => 'deactivate_accountController',

]);


 Route::get('profiles/delete', 'profileController@status_update')->name('servicepartner.profile.delete');


Route::post('verify_and_deactivate', 'deactivate_accountController@verify_and_deactivate');

Route::post('change_suborders_status','today_ordersController@status_update');

Route::get('/support-ticket-msg/{id}', 'support_ticketController@support_ticket_msg');


 Route::get('profiles/email_verify', 'profileController@status_email_verify')->name('servicepartners.profile.email_verify');


Route::post(Request::segment(2).'/status_update',str_replace('-', '_', Request::segment(2)).'Controller@status_update');

Route::post(Request::segment(2).'/delete', str_replace('-', '_', Request::segment(2)).'Controller@destroy');
Route::post(Request::segment(2).'/unique_name',str_replace('-', '_', Request::segment(2)).'Controller@check_unique_name');

Route::get('/{name}', function () {
    return view('seller.underconstruction');
});
