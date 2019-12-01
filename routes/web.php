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

Route::namespace('API')->prefix('api')->name('API.')->group(function(){
    Route::prefix('karyawan')->name('karyawan.')->group(function(){
            Route::get('', 'KaryawanController@get')->name('get');
    });

});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/index', 'adminController@index')
        ->name('adminIndex');

// Route Bidang
Route::get('/bidang/index', 'adminController@bidangIndex')
        ->name('bidangIndex');

//Route Seksi Bidang
Route::get('/seksi/index', 'adminController@seksiIndex')
        ->name('seksiIndex');
//
Route::get('/kelengkapanKendaraan/index', 'adminController@kelengkapanKendaraanIndex')
        ->name('kelengkapanKendaraanIndex');

Route::get('/itemKendaraan/index', 'adminController@itemKendaraanIndex')
        ->name('itemKendaraanIndex');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
