<?php

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

    Route::prefix('item-kendaraan')->name('item-kendaraan.')->group(function(){
        Route::get('', 'ItemkendaraanController@get')->name('get');
        Route::get('{uuid}', 'ItemkendaraanController@find')->name('find');
        Route::post('', 'ItemkendaraanController@create')->name('create');
        Route::put('{uuid}', 'ItemkendaraanController@update')->name('update');
        Route::delete('{uuid}', 'ItemkendaraanController@delete')->name('delete');
     });

    Route::prefix('kelengkapan')->name('kelengkapan.')->group(function(){
        Route::get('', 'KelengkapanController@get')->name('get');
        Route::get('{uuid}', 'KelengkapanController@find')->name('find');
        Route::post('', 'KelengkapanController@create')->name('create');
        Route::put('{uuid}', 'KelengkapanController@update')->name('update');
        Route::delete('{uuid}', 'KelengkapanController@delete')->name('delete');
     });

    Route::prefix('objek')->name('objek.')->group(function(){
        Route::get('', 'ObjekController@get')->name('get');
        Route::get('{uuid}', 'ObjekController@find')->name('find');
        Route::post('', 'ObjekController@create')->name('create');
        Route::put('{uuid}', 'ObjekController@update')->name('update');
        Route::delete('{uuid}', 'ObjekController@delete')->name('delete');
     });
    Route::prefix('status')->name('status.')->group(function(){
        Route::get('', 'StatusController@get')->name('get');
        Route::get('{uuid}', 'StatusController@find')->name('find');
        Route::post('', 'StatusController@create')->name('create');
        Route::put('{uuid}', 'StatusController@update')->name('update');
        Route::delete('{uuid}', 'StatusController@delete')->name('delete');
     });
     Route::prefix('pencairan')->name('pencairan.')->group(function(){
        Route::get('', 'PencairanController@get')->name('get');
        Route::get('{uuid}', 'PencairanController@find')->name('find');
        Route::post('', 'PencairanController@create')->name('create');
        Route::put('{uuid}', 'PencairanController@update')->name('update');
        Route::delete('{uuid}', 'PencairanController@delete')->name('delete');
        });
     Route::prefix('rincian')->name('rincian.')->group(function(){
        Route::get('get/{id}', 'RincianController@get')->name('get');
        Route::get('{uuid}', 'RincianController@find')->name('find');
        Route::post('', 'RincianController@create')->name('create');
        Route::put('{uuid}', 'RincianController@update')->name('update');
        Route::delete('{uuid}', 'RincianController@delete')->name('delete');
     });

});

Route::get('/', function () {
    return view('auth/login');
});
Route::get('/admin/index', 'adminController@index')
        ->name('adminIndex');

// Route Bidang
Route::get('/bidang/index', 'adminController@bidangIndex')
        ->name('bidangIndex');
Route::get('/bidang/cetak', 'adminController@bidangCetak')
        ->name('bidangCetak');

//Route Seksi Bidang
Route::get('/seksi/index', 'adminController@seksiIndex')
        ->name('seksiIndex');
Route::get('/seksi/cetak', 'adminController@seksiCetak')
        ->name('seksiCetak');


//Route Karyawan
Route::get('/karyawan/index', 'adminController@karyawanIndex')
        ->name('karyawanIndex');
Route::get('/karyawan/cetak', 'adminController@karyawanCetak')
        ->name('karyawanCetak');

// kendaraan
Route::get('/kendaraan/index', 'adminController@kendaraanIndex')
        ->name('kendaraanIndex');
Route::get('/kendaraan/cetak', 'adminController@kendaraanCetak')
        ->name('kendaraanCetak');

//item kendaraan
Route::get('/itemKendaraan/index', 'adminController@itemKendaraanIndex')
        ->name('itemKendaraanIndex');
Route::get('/itemKendaraan/cetak', 'adminController@itemKendaraanCetak')
        ->name('itemKendaraanCetak');

//kelengkapan kendaraan
Route::get('/kelengkapanKendaraan/index', 'adminController@kelengkapanKendaraanIndex')
        ->name('kelengkapanKendaraanIndex');
Route::get('/kelengkapanKendaraan/cetak', 'adminController@kelengkapanKendaraanCetak')
        ->name('kelengkapanKendaraanCetak');

//Objek Transmisi
Route::get('/objektransmisi/index', 'adminController@objekTransmisiIndex')
        ->name('objekTransmisiIndex');
//Objek Transmisi
Route::get('/statusTransmisi/index', 'adminController@statusTransmisiIndex')
        ->name('statusTransmisiIndex');
Route::get('/statusTransmisi/cetak', 'adminController@statusTransmisiCetak')
        ->name('statusTransmisiCetak');

//Pencairan
Route::get('/pencairan/index', 'adminController@pencairanIndex')
        ->name('pencairanIndex');
Route::post('/pencairan/index', 'adminController@pencairanAdd')
        ->name('pencairanAdd');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
