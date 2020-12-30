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

Auth::routes();

Route::get('/', 'Auth\LoginController@showLoginForm');
// Route::get('/create_booking', 'BookController@index');
// Route::post('/book/create_booking', 'BookController@create_booking');
// Route::get('/book', 'BookController@booking_list');
// Route::get('/admin', 'DashboardController@index');

// Route::get('/user', 'UserController@index');

Route::get('dokter/getDataJson', 'DokterController@getData');
Route::get('dokter/delete_dokter/{id}', 'DokterController@destroy');
Route::resource('dokter', 'DokterController');
Route::resource('certificate', 'CertificateController')->middleware('role');

// Route::get('/reservation', 'ReservationController@index')->middleware('role');
Route::get('/reservation', 'ReservationController@ajax_index')->middleware('role');
Route::post('/reservation', 'ReservationController@store_reservation');
Route::get('/reservation/create', 'ReservationController@create_reservation');


// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', 'DashboardController@index')->name('home');

// ajax datatables
