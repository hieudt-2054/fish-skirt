<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Request;

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', 'Auth\LoginController@logout');

    Route::get('/user', 'Auth\UserController@current');

    Route::patch('settings/profile', 'Settings\ProfileController@update');
    Route::get('email', 'DashboardController@sendEMail');
    Route::patch('settings/password', 'Settings\PasswordController@update');
    Route::get('/prod-req', 'ThucPhamController@prodRequest');
    Route::get('/thucpham-request', 'ThucPhamController@thucphamRequest');
    Route::get('/approved/{id}', 'ThucPhamController@approved');
    Route::get('/getPoints', 'DiemThuongController@getRequestPoints');
    Route::post('/progressPoints', 'DiemThuongController@progressPoints');
});
Route::resource('thucpham', 'ThucPhamController');
Route::resource('eating', 'EatingController');
Route::resource('cannang', 'CanNangController');
Route::resource('spendcategory', 'SpendCategoryController');
Route::resource('spend', 'SpendDetailController');
Route::resource('post', 'PostController');
Route::resource('categories', 'CategoryController');
Route::resource('points', 'DiemThuongController');


Route::get('dashboard/', 'DashboardController@getData');
Route::get('dashboardspend', 'DashboardController@getDataSpend');
Route::get('xoatp/{id}', 'ThucPhamController@deletetp');

Route::post('fetch/', 'ThucPhamController@fetchData');
Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', 'Auth\LoginController@login');
    Route::post('register', 'Auth\RegisterController@register');

    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    Route::post('email/verify/{user}', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::post('email/resend', 'Auth\VerificationController@resend');

    Route::post('oauth/{driver}', 'Auth\OAuthController@redirectToProvider');
    Route::get('oauth/{driver}/callback', 'Auth\OAuthController@handleProviderCallback')->name('oauth.callback');
});
