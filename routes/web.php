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
    Route::prefix('bidang')->name('bidang.')->group(function(){
        Route::get('', 'BidangController@get')->name('get');
        Route::get('{uuid}', 'BidangController@find')->name('find');
        Route::post('', 'BidangController@create')->name('create');
        Route::put('{uuid}', 'BidangController@update')->name('update');
        Route::delete('{uuid}', 'BidangController@delete')->name('delete');
        });
    Route::prefix('seksi')->name('seksi.')->group(function(){
        Route::get('', 'SeksiController@get')->name('get');
        Route::get('{uuid}', 'SeksiController@find')->name('find');
        Route::post('', 'SeksiController@create')->name('create');
        Route::put('{uuid}', 'SeksiController@update')->name('update');
        Route::delete('{uuid}', 'SeksiController@delete')->name('delete');
        });
    Route::prefix('karyawan')->name('karyawan.')->group(function(){
        Route::get('', 'KaryawanController@get')->name('get');
        Route::get('{uuid}', 'KaryawanController@find')->name('find');
        Route::post('', 'KaryawanController@create')->name('create');
        Route::put('{uuid}', 'KaryawanController@update')->name('update');
        Route::delete('{uuid}', 'KaryawanController@delete')->name('delete');
    });

    Route::prefix('kendaraan')->name('kendaraan.')->group(function(){
        Route::get('', 'KendaraanController@get')->name('get');
        Route::get('{uuid}', 'KendaraanController@find')->name('find');
        Route::post('', 'KendaraanController@create')->name('create');
        Route::put('{uuid}', 'KendaraanController@update')->name('update');
        Route::delete('{uuid}', 'KendaraanController@delete')->name('delete');
     });

});
/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/', 'adminController@index')
        ->name('adminIndex');

// Route Bidang
Route::get('/bidang/index', 'adminController@bidangIndex')
        ->name('bidangIndex');

//Route Seksi Bidang
Route::get('/seksi/index', 'adminController@seksiIndex')
        ->name('seksiIndex');


//Route Seksi Bidang
Route::get('/karyawan/index', 'adminController@karyawanIndex')
        ->name('karyawanIndex');


//item kendaraan
Route::get('/itemKendaraan/index', 'adminController@itemKendaraanIndex')
        ->name('itemKendaraanIndex');

//kelengkapan kendaraan
Route::get('/kelengkapanKendaraan/index', 'adminController@kelengkapanKendaraanIndex')
        ->name('kelengkapanKendaraanIndex');

//Objek Transmisi
Route::get('/objektransmisi/index', 'adminController@objekTransmisiIndex')
        ->name('objekTransmisiIndex');
//Objek Transmisi
Route::get('/statusTransmisi/index', 'adminController@statusTransmisiIndex')
        ->name('statusTransmisiIndex');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
