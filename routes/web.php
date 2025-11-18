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
    return view('auth/login');
});

Route::get('/confirm_mail', function () {
    return view('auth/confirm_mail');
});

Route::get('/login', function () {
    return view('auth/login');
});

Route::get('/personal', function () {
    return view('app_personal/layouts/app_personal');
});
Route::get('/home', function () {
    return view('app_home/layouts/app_home');
});
Route::get('/chat', function () {
    return view('app_chat/layouts/app_chat');
});