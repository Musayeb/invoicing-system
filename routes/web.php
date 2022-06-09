<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Crypt;

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

Route::group(['middleware' => 'auth:sanctum','verified'], function () {
    Route::group(['middleware' => ['verified']], function () {


        Route::get('/', 'HomeController@index')->name('dashboard');


        // client
        Route::resource('clients', 'admin\clientsController');
        Route::post('client_update','admin\clientsController@update');
        
        // Projects 
        Route::resource('projects', 'admin\ProjectsController');
        Route::post('project_update','admin\ProjectsController@update');
        // Route::get('project/information/{id}','admin\ProjectsController@info');
        
         // Invoice
        Route::resource('invoice', 'admin\InvoiceController');
        Route::get('invoices/{id?}/{invoice_number?}','admin\InvoiceController@add');

        Route::resource('invoice_info', 'admin\InvoiceDescriptionController');
        Route::post('invoice_info_update', 'admin\InvoiceDescriptionController@update');
        Route::get('sendInvoice/{id}','admin\InvoiceController@sendInvoice');

        
        
        // Incomes
        Route::resource('incomes', 'admin\IncomesController');
        // 
        // Users
        Route::resource('users', 'admin\UserController');
        Route::post('user_update','admin\UserController@update');
        Route::post('resetPassword', 'admin\UserController@reset_password');

        // User Profile
        Route::get('profile', 'admin\ProfileController@index');
        Route::post('ChangePassword', 'admin\ProfileController@ChangePassword');
        Route::post('ChangePhoto', 'admin\ProfileController@ChangePhoto');

        // Activity Logs
        Route::resource('activity-logs', 'admin\ActivityLogsController');
        Route::get('access-rights', 'admin\ActivityLogsController@accessRights');

        // Notifications
        Route::resource('notifications', 'admin\NotificationsController');
        Route::get('notifications_readAll', 'admin\NotificationsController@ReadAll');

    });
});



// Stripe Route
Route::get('checkout/{id}', 'StripePaymentController@index');
Route::post('stripe', 'StripePaymentController@stripePost')->name('stripe.post');
Route::get('payment-success', function () {
    return view('success');
});

// Paypal Route
Route::get('paypal/{id?}/{total?}', 'PayPalController@payment')->name('payment');
Route::get('cancel', 'PayPalController@cancel')->name('payment.cancel');
Route::get('payment/success/{id?}', 'PayPalController@success')->name('payment.success');
   
