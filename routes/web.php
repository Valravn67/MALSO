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
        return view('layout');
    });

    Route::get('/', 'HomeController@home');

    // input data
    Route::get('/logistics/stock_material', 'LogisticsController@stock_material');
    Route::post('/logistics/stock_material', 'LogisticsController@save_stock_material');
    Route::get('/logistics/out_material', 'LogisticsController@out_material');
    Route::post('/logistics/out_material', 'LogisticsController@save_out_material');

    // report
    Route::get('/report/stock_material', 'LogisticsController@report_stock_material');
    Route::get('/report/out_material', 'LogisticsController@report_out_material');
    Route::get('/report/detail_material', 'LogisticsController@detail_material');

    // super admin
    Route::get('/admin/warehouse_staff_list', 'AdminController@warehouse_staff_list');
    Route::post('/admin/warehouse_staff_list', 'AdminController@save_staff');
    Route::get('/admin/technician_list', 'AdminController@technician_list');
    Route::post('/admin/technician_list', 'AdminController@save_technician');

    // ajax
    Route::get('/ajax/call_out_material', 'LogisticsController@call_out_material');
    Route::get('/ajax/get_teknisi', 'AdminController@get_teknisi');
    Route::get('/ajax/get_warehouse_staff', 'AdminController@get_warehouse_staff');
    
    Route::get('logout','LoginController@logout');
});