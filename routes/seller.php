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
'products' => 'productsController',
'product-items' => 'product_itemsController',
'seller-document' => 'seller_documentController',
'bank-detail'=>'seller_bank_detailController',
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
'product-addon'=>'product_addonController',
'product-addon-group'=>'product_addon_groupController',
'photo-gallery' => 'photo_galleryController',
'product-master' => 'product_mastersController',
'plan-history'=>'plan_historyController',
'deactivate-account' => 'deactivate_accountController',

'change-password' => 'change_passwordController',
'change-email' => 'change_emailController',
'change-contactno' => 'change_contactnoController',

]);



Route::post('store_custom_category','categoriesController@store_custom_category');

Route::get('store-payout','store_payoutController@store_payout');
// Route::get('store-invoices','store_payoutController@store_invoices');
Route::get('store-item-wise-payout','store_payoutController@store_item_wise_payout');


Route::get('store-item-wise-payout/{id?}','store_payoutController@store_item_wise_payout');

Route::get('store-item-wise-pdf-payout/{id?}','store_payoutController@store_item_wise_pdf_payout');

Route::get('store-item-wise-excel-payout/{id?}','store_payoutController@store_item_wise_excel_payout');



Route::post('verify_seller_email', 'change_emailController@verify_seller_email');
Route::post('seller-update-email', 'change_emailController@seller_update_email');

Route::post('verify_seller_mobile', 'change_contactnoController@verify_seller_mobile');
Route::post('seller-update-mobile', 'change_contactnoController@seller_update_mobile');

Route::post('verify_and_deactivate', 'deactivate_accountController@verify_and_deactivate');

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

Route::get('products/{id}/items', 'product_itemsController@itemsView');
Route::get('products/{id}/addonView', 'product_addonController@addonView');

Route::get('products/{id}/addon', 'product_addonController@index');
Route::get('/support-ticket-msg/{ticket_id}', 'support_ticketController@support_ticket_msg');

Route::post('/reply-support-ticket', 'support_ticketController@reply_support_ticket');



Route::patch('/store_profile/{id}/update/', ['as' => 'store_profile.update', 'uses' => 'profileController@update']);

Route::post('append_product_category','productsController@append_product_category');



Route::post('check_edit_login_email','dashboardController@check_edit_login_email');

 Route::get('profiles/email_verify', 'profileController@status_email_verify')->name('sellers.profile.email_verify');

 Route::get('profiles/delete', 'profileController@status_update')->name('seller.profile.delete');

 Route::get('product_items/{id}/delete', 'product_itemsController@delete');

Route::post('products/{id}/items/status_update','product_itemsController@status_update');
Route::post('products/{id}/addon/status_update_list','product_addonController@status_update');
Route::post('products/{id}/addon/delete','product_addon_groupController@destroy');

Route::post('products/{id}/addon/delete_2','product_addonController@destroy');

Route::post('products/{id}/items/delete','product_itemsController@destroy');

Route::post(Request::segment(2).'/status_update',str_replace('-', '_', Request::segment(2)).'Controller@status_update');

Route::post(Request::segment(2).'/delete', str_replace('-', '_', Request::segment(2)).'Controller@destroy');
Route::post(Request::segment(2).'/unique_name',str_replace('-', '_', Request::segment(2)).'Controller@check_unique_name');

Route::get('/{name}', function () {
    return view('seller.underconstruction');
});
