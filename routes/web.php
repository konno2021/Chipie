<?php

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

use App\Http\Controllers\InnController;

Route::get('/', 'HomeController@top');
Auth::routes();
Route::get('mypage', 'HomeController@mypage')->name('mypage');
Route::resource('inns', 'InnController');
Route::resource('users','UserController');
Route::resource('plans', 'PlanController');
Route::resource('posts', 'PostController');
Route::resource('reservations', 'ReservationController', ['except' => ['create']]);
Route::get('reservations/{plan}/create', 'ReservationController@create')->name('reservations.create');
Route::post('reservations/{plan}/create/register', 'ReservationController@create_register')->name('reservations.create_register');
Route::get('inn/request_list', 'InnController@index_request_list')->name('inn.request_list');
Route::get('inn/list', 'InnController@index_list')->name('inn.list');
Route::get('inn_admin', 'PlanController@index')->name('inn.admin');
// 仮

Route::get('admin', function(){return view('home/admin');});
Route::get('admin/user_list', function(){return view('user/user_list');});
// Route::get('inn/inn_request_list', function(){return view('inn/inn_request_list');})->name('inn.request_list');
// Route::get('admin/inn_list', function(){return view('inn/inn_list');});
Route::get('admin/plan_list', function(){return view('plan/plan_list');});
Route::get('reserve', function(){return view('reservation/reservation_confirm');});

Route::get('inn/inn_index', function(){return view('inn/inn_index');});
Route::get('inn/inn_show', function(){return view('inn/inn_show');});