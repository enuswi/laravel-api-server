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

Route::get('/', function () {
    return view('welcome');
});

/** TODO info, xdebugは確認用の為、削除する必要あり */
Route::get('info', function () {
    phpinfo();
});

Route::get('xdebug', function () {
    xdebug_info();
});