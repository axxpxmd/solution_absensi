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

// Auth
Route::get('/login', 'AuthController@index')->name('auth.index')->middleware('guest');
Route::post('/login', 'AuthController@login')->name('login')->middleware('guest');

// Home
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::post('/logout', 'AuthController@logout')->name('logout');

    Route::get('/test-perangkat', 'HomeController@testPerangkat')->name('testPerangkat');

    Route::get('/data-user', 'UserController@index')->name('user.index');
    Route::post('/data-user/table', 'UserController@dataTable')->name('user.table');
    Route::get('/data-user/get-data-user-from-device', 'UserController@getDataUserFromDevice')->name('user.getDataUserFromDevice');
    Route::get('/data-user/create', 'UserController@create')->name('user.create');
    Route::post('/data-user/store', 'UserController@store')->name('user.store');
    Route::delete('/data-user/delete/{uid}', 'UserController@delete')->name('user.delete');

    // Absen
    Route::get('/data-absen', 'AbsenController@index')->name('absen.index');
    Route::post('/data-absen/table', 'AbsenController@dataTable')->name('absen.table');
    Route::get('/data-absen/get-data-absen-from-device', 'AbsenController@getDataAbsenFromDevice')->name('absen.getDataAbsenFromDevice');

    Route::get('/data-kegiatan', 'KegiatanController@index')->name('kegiatan.index');

    Route::resource('/perangkat', 'DeviceController');
    Route::post('/perangkat/table', 'DeviceController@dataTable')->name('perangkat.table');
});
