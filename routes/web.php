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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'Web\WebstiteController@homepage')->name('homepage');
Route::get('/category/{catid?}/product/{prodid?}', 'Web\WebstiteController@product')->name('product_page');
Route::get('/category/{catid?}', 'Web\WebstiteController@category')->name('category_page');
Route::get('/about-us', 'Web\WebstiteController@about')->name('about_us');
Route::get('/contact-us', 'Web\WebstiteController@contact')->name('contact_us');
Route::post('/contact-us-form-submit', 'Web\WebstiteController@contactformsubmit')->name('contact_us_form_submit');
Route::post('/email-subscription-form-submit', 'Web\WebstiteController@subscriptionemailformsubmit')->name('email_subscription_form_submit');

//Access by admin
Route::prefix('admin')->namespace('Admin')->group(function () {
    Route::get('/admin-logout','AdminController@logout')->name('admin_log_out');
    Route::group(['middleware' => ['auth']], function () {
        Route::get('/dashboard','AdminController@dashboard')->name('admin_dashboard');
        //Category
        Route::get('/category/delete/{id}', 'Category\CategoryController@delete')->name('category_delete');
        Route::resource('/category', 'Category\CategoryController', [
            'only' => ['index', 'edit','create','store','destroy']
        ]);
        //Product
        Route::get('/product/delete/{id}', 'Product\ProductController@delete')->name('product_delete');
        Route::resource('/product', 'Product\ProductController', [
            'only' => ['index', 'edit','create','store','show']
        ]);
        Route::get('/contact/list', 'Contact\ContactController@list')->name('contact_list');
        Route::get('/email/list', 'EmailSubscription\EmailSubscriptionController@list')->name('email_list');
        //Send email
        Route::get('/send-mail/delete/{id}', 'SendMail\SendMailController@delete')->name('send_email_delete');
        Route::resource('/send-mail', 'SendMail\SendMailController', [
            'only' => ['index','create','store']
        ]);
    });
});
//Access by guest user
Route::group(['middleware' => ['guest']], function () {
    Route::get('/admin/login', 'Admin\LoginController@signIn')->name('login');
    Route::post('/admin/login-save', 'Admin\LoginController@adminAuthentication')->name('admin_login');
});
