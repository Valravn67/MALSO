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
Route::get('/register', 'LoginController@register');
Route::post('/register', 'LoginController@register_save');

Route::get('/login', 'LoginController@login')->name('login');
Route::post('/login', 'LoginController@simpan_login');

Route::group(['middleware' => 'login'], function () { 
    Route::get('/', function () {
        return view('layouts.master');
    });

    Route::get('/logistics/stock_material', 'LogisticsController@stock_material');
    Route::post('/logistics/stock_material', 'LogisticsController@save_stock_material');
    Route::get('/logistics/out_material', 'LogisticsController@out_material');
});

Route::get('/welcome', function () {
    return view('welcome');
});

