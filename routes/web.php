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
    return view('show_all_dishes');
});

Route::resource('dishes','App\Http\Controllers\dishController');

Route::get('dishes\create','App\Http\Controllers\dishController@create');

