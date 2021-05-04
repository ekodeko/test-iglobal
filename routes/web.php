<?php

use App\Http\Controllers\CourseController;
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

Auth::routes();

Route::get('/', 'Auth\LoginController@showLoginForm');

// Route::get('dokter/getDataJson', 'DokterController@getData');
// Route::get('dokter/delete_dokter/{id}', 'DokterController@destroy');
// Route::resource('dokter', 'DokterController');
// Route::resource('certificate', 'CertificateController')->middleware('role');
// Route::get('/reservation', 'ReservationController@ajax_index')->middleware('role');
// Route::post('/reservation', 'ReservationController@store_reservation');
// Route::get('/reservation/create', 'ReservationController@create_reservation');

Route::middleware(['auth'])->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('reseller', 'UserController@reseller_list')->middleware('isadmin');
        Route::get('profile', 'UserController@profile');
        Route::post('change_picture', 'UserController@change_picture');
        Route::get('change_password', 'UserController@show_form_change_password');
        Route::post('change_password', 'UserController@change_password');
    });
});
Route::middleware(['auth'])->group(function () {
    Route::prefix('utility')->group(function () {
        Route::get('import_csv_order_online', 'UtilityController@show_form_import_csv_order_online')->middleware('isadmin');
        Route::post('do_import_csv_order_online', 'UtilityController@do_import_csv_order_online')->middleware('isadmin');
        Route::get('upload_testimoni', 'UtilityController@show_form_upload_testimoni');
        Route::post('do_upload_testimoni', 'UtilityController@do_upload_testimoni');
        Route::get('import_resi', 'UtilityController@show_form_import_resi')->middleware('isadmin');
        Route::post('do_import_resi', 'UtilityController@do_import_resi')->middleware('isadmin');
        // reseller marketing kit
        Route::prefix('reseller_marketing_kit')->group(function () {
            Route::post('', 'MarketingKitController@store');
            Route::get('', 'MarketingKitController@index');
            Route::get('create', 'MarketingKitController@create');
            Route::get('items/{id}', 'MarketingKitController@items');
            Route::get('foto_produk', 'MarketingKitController@foto_produk');
            Route::post('download_foto_produk', 'MarketingKitController@download_foto_produk');
            Route::get('video_produk', 'MarketingKitController@video_produk');
            Route::post('download_video_produk', 'MarketingKitController@download_video_produk');
            Route::get('foto_endorse', 'MarketingKitController@foto_endorse');
            Route::post('download_foto_endorse', 'MarketingKitController@download_foto_endorse');
            Route::get('video_endorse', 'MarketingKitController@video_endorse');
            Route::post('download_video_endorse', 'MarketingKitController@download_video_endorse');
            Route::get('booklet', 'MarketingKitController@booklet');
            Route::post('download_booklet', 'MarketingKitController@download_booklet');
            Route::get('template_pesan_wa', 'MarketingKitController@template_pesan_wa');
            Route::post('download_template_pesan_wa', 'MarketingKitController@download_template_pesan_wa');
        });
    });
});
Route::middleware('auth')->group(function () {
    Route::prefix('order')->group(function () {
        Route::get('add', 'OrderController@show_form_add_order');
        Route::get('receipt', 'OrderController@receipt_list');
    });
});
Route::middleware('auth')->group(function () {
    Route::prefix('sale')->group(function () {
        Route::get('input_sale', 'SaleController@show_form_input_sale');
        Route::post('input_sale', 'SaleController@store_input_sale');
        Route::get('set_sell_price', 'SaleController@show_form_set_sell_price');
        Route::post('set_sell_price', 'SaleController@update_set_sell_price');
    });
});
Route::middleware(['auth', 'isadmin'])->group(function () {
    Route::resource('category', 'CategoryController');
});
Route::middleware('auth')->group(function () {
    Route::resource('course', 'CourseController');
    Route::get('course/{id}/watch', 'CourseController@watch');
});

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', 'DashboardController@index')->name('home');
