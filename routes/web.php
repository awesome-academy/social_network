<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', 'HomeController@initView');

Route::group(['middleware' => 'locale'], function () {
    Route::get('/home/{lang}', 'SwitchLanguage@setLocale')->name('home.lang');
    Route::get('/profile', 'HomeController@profile')->name('home.profile');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
