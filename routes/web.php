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

Route::get('/', 'HomeController@top');
Auth::routes();
Route::resource('inns', 'InnController');
Route::get('admin', function(){return view('home/admin');});
Route::get('admin/user_list', function(){return view('user/user_list');});
Route::get('admin/inn_request_list', function(){return view('inn/inn_request_list');});
Route::get('admin/inn_list', function(){return view('inn/inn_list');});
Route::get('admin/plan_list', function(){return view('plan/plan_list');});