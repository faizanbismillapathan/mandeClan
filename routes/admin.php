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
'roles' => 'rolesController',
'banners' => 'bannersController',
'vehicle-type' => 'vehicle_typeController',
'vehicle-rate-chart' => 'vehicle_rate_chartController',
'driving-license' => 'driving_licenseController',
'users' => 'usersController',
'country' => 'countryController',
'state' => 'stateController',
'city' => 'cityController',
'locality' => 'localityController',
'unit' => 'unitController',
'product-attribute'=>'product_attributeController',
'store-category' => 'store_categoryController',
'stores' => 'storesController',
'archive-store' => 'archive_storeController',
'archive-service' => 'archive_serviceController',
'archive-rv' => 'archive_rvController',
'archive-customer' => 'archive_customerController',

'product-category' => 'product_categoryController',
'profile' => 'profileController',
'store-subscription' => 'store_subscriptionController',
'requested-store' => 'requested_storeController',
'payment-setting' => 'payment_settingController',
'offline-payment'=>'offline_paymentController',
'currency-setting' => 'currency_settingController',
'commission-setting' => 'commission_settingController',
'return-policy' => 'return_policyController',
'zones' => 'zonesController', 
'tax-rate' => 'tax_rateController',
'tax-class' => 'tax_classController',
'customers' => 'customersController',
'delivery-rider' => 'delivery_riderController',
'vehicles' => 'vehiclesController',
'rider-vehicle-info' => 'rider_vehicle_infoController',
'review-approval'=>'review_approvalController',
'reviews'=>'reviewsController',
'faqs'=>'faqsController',
'blog' => 'blogController',
'pages' => 'pagesController',
'mail-setting' => 'mail_settingController',
'social-login'=>'social_loginController',
'sms-setting' => 'sms_settingController',
'bank-detail'=>'bank_detailController',
'term-condition'=>'term_conditionController',
'push-notification' => 'push_notificationController',
'product-subcategory' => 'product_subcategoryController',
'document' => 'documentController',
'assigned-vehicle' => 'assigned_vehicleController',
'brands' => 'brandsController',
'tickets' => 'ticketsController',
'products' => 'productsController',
'orders'=>'ordersController',
'shipping' => 'shippingController',
'invoice-setting' => 'invoice_settingController',
'invoice-design' => 'invoice_designController',
'pending-orders' => 'pending_ordersController',
'canceled-orders' => 'canceled_ordersController',
'returned-orders' => 'returned_ordersController',
'wallet' => 'walletController',
'rider-plan'=>'rider_planController',
'support-tickets'=>'support_ticketsController',
'suborders' => 'subordersController',
'default-credential' => 'default_credentialController',
'seller-document'=>'seller_documentController',
'service-document'=>'service_documentController',
'rv-document'=>'rv_documentController',
'enquiry' => 'enquiryController',
'careers' => 'careersController',
'customer-subscription' => 'customer_subscriptionController',
'services' => 'servicesController',
'service-category' => 'service_categoryController',
'service-subcategory' => 'service_subcategoryController',
'service-subscription' => 'service_subscriptionController',

'seller-products' => 'seller_productsController',
'seller-product-items' => 'seller_product_itemsController',
// 'store-payout'=>'store_payoutController',
]);


Route::get('store-wise-payout','store_payoutController@store_wise_payout');

Route::get('store-wise-pdf-payout/{id}','store_payoutController@store_wise_pdf_payout');

Route::get('store-wise-excel-payout/{id}','store_payoutController@store_wise_excel_payout');

Route::get('store-payout-list/{id}','store_payoutController@store_payout_list');

Route::get('store-item-wise-payout/{id?}','store_payoutController@store_item_wise_payout');

Route::get('store-item-wise-pdf-payout/{id?}','store_payoutController@store_item_wise_pdf_payout');

Route::get('store-item-wise-excel-payout/{id?}','store_payoutController@store_item_wise_excel_payout');




// Route::get('store-all-item-pdf-payout/{id?}','store_payoutController@store_all_item_pdf_payout');

// Route::get('store-all-item-excel-payout/{id?}','store_payoutController@store_all_item_excel_payout');



Route::post('kyc_status_update','seller_documentController@kyc_status_update');
Route::post('service_kyc_status_update','service_documentController@service_kyc_status_update');
Route::post('rv_kyc_status_update','rv_documentController@rv_kyc_status_update');


Route::post('archive-store-recorver','archive_storeController@stores_status_archive');
Route::post('archive-service-recorver','archive_serviceController@services_status_archive');
Route::post('archive-rv-recorver','archive_rvController@rvs_status_archive');
Route::post('archive-customer-recorver','archive_customerController@archive_customers_recorver');

Route::get('commission-item-wise','commission_settingController@commission_item_wise');
Route::post('commission-item-wise','commission_settingController@item_wise_commision_update');

Route::patch('commission-item-wise/{id}','commission_settingController@item_wise_commision_update');


Route::post('assign_order_status_update','subordersController@assign_order_status_update');

Route::post('re_assign_order','subordersController@re_assign_order');

Route::get('user-invoice/{id}','subordersController@user_invoice_view');

Route::get('order-invoice-pdf/{id}','subordersController@order_invoice_pdf');

Route::get('suborder-invoice-pdf/{id}','subordersController@suborder_invoice_pdf');

Route::post('ticket_status_update','support_ticketsController@status_update');

Route::post('/reply-support-ticket', 'support_ticketsController@reply_support_ticket');

Route::post('change_suborder_status','subordersController@status_update');
Route::post('change_order_status','ordersController@status_update');
Route::post('suborder_assign_rider', 'subordersController@suborder_assign_rider');
Route::get('find_riders', 'subordersController@find_riders');

Route::get('order_items/{id}', 'ordersController@order_items');
Route::get('suborder_items/{id}', 'subordersController@suborder_items');

Route::post('append_product_category','productsController@append_product_category');
Route::post('append_product_subcategory','productsController@append_product_subcategory');

// dd(Request::segment(2));

Route::post('push-notification-key','push_notificationController@updateKeys');
Route::post('assigned_vehicle_to_rider','assigned_vehicleController@assigned_vehicle_to_rider');
Route::post('unassigned_vehicle_to_rider','assigned_vehicleController@unassigned_vehicle_to_rider');


Route::post(Request::segment(2).'/status_update',str_replace('-', '_', Request::segment(2)).'Controller@status_update');

Route::post(Request::segment(2).'/delete', str_replace('-', '_', Request::segment(2)).'Controller@destroy');
Route::post(Request::segment(2).'/unique_name',str_replace('-', '_', Request::segment(2)).'Controller@check_unique_name');



Route::post('unit/'.Request::segment(3).'/values/status_update','unitController@value_status_update');

Route::post('unit/'.Request::segment(3).'/values/delete','unitController@value_destroy');


Route::get('request_status_update','requested_storeController@status_update');
Route::get('career_status_update','careersController@status_update');

Route::get('unit/{id}/values','unitController@unit_values');


Route::get('orders/{id}/dummy','ordersController@dummy_orders');

Route::patch('/unit_value/{id}/update/', ['as' => 'unit_value.update', 'uses' => 'unitController@unit_value_update']);
Route::patch('unit_value/{id}','unitController@unit_value_update');

Route::post('unit_value_store','unitController@unit_value_store');


Route::post('append_state','cityController@append_state');
Route::post('append_city','localityController@append_city');
Route::post('append_locality','localityController@append_locality');
Route::post('append_pincode','localityController@append_pincode');
Route::post('append_vehicle_type','vehicle_rate_chartController@append_vehicle_type');


Route::post('savePaypal','payment_settingController@savePaypal');
Route::post('config_status_update','payment_settingController@config_status_update');
Route::get('{type}_status_setting','payment_settingController@status_setting');

Route::post('bank_details','payment_settingController@bank_details');
Route::post('braintree_setting','payment_settingController@saveBraintree');
Route::post('skrill_setting','payment_settingController@updateSkrill');
Route::post('paytm_setting','payment_settingController@updatePaytm');
Route::post('razorpay_setting','payment_settingController@updaterazorpay');
Route::post('stripe_setting','payment_settingController@saveStripe');
Route::patch('/bank_details/{id}/update/', ['as' => 'bank_details.update', 'uses' => 'payment_settingController@bank_details_update']);


Route::post('facebook_setting','social_loginController@facebookSettings');
Route::post('google_setting','social_loginController@googleSettings');
Route::post('twitter_setting','social_loginController@twitterSettings');
Route::post('amazon_setting','social_loginController@amazonSettings');
Route::post('gitlab_setting','social_loginController@gitlabSettings');
Route::post('linkedin_setting','social_loginController@linkedinSettings');


// dd(str_replace('-', '_', Request::segment(2)));

Route::post('twillo_setting','sms_settingController@twillo_setting');
Route::post('msg91_setting','sms_settingController@msg91_setting');
Route::post('mimsms_setting','sms_settingController@mimsms_setting');

Route::post('default_sms_channel','sms_settingController@default_sms_channel');

Route::post('check_login_email','dashboardController@check_login_email');
Route::post('check_edit_login_email','dashboardController@check_edit_login_email');
Route::post('check_unique_'.Request::segment(2),str_replace('-', '_', Request::segment(2)).'Controller@check_unique_name');

// Route::post('check_unique_state','stateController@check_unique_name');

// "check_unique_state"
// "stateController@check_unique_name"


Route::post('check_edit_unique_'.Request::segment(2),str_replace('-', '_', Request::segment(2)).'Controller@check_unique_name');

// Route::get('assigned-vehicle/rider-allotment','assigned_vehicleController@rider_allotment');


// Route::get('/{name}', function () {
//     return view('admin.underconstruction');
// });