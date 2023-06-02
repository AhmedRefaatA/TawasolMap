<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', 'Wialon\AuthController@redirectWialon')->name('login');

Route::get('dashboard', 'Wialon\DashboardController@index')->name('dashboard');
Route::middleware('auth')->group(function () {

    Route::get('items', 'Wialon\DashboardController@items');
    Route::get('tracking', 'Wialon\VehicleTrackingController@index');
    Route::get('tracking/{id}', 'Wialon\VehicleTrackingController@tracking');
});