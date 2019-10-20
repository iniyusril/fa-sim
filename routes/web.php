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

Route::get('/', function () {
    return redirect()->route('dashboard');
});
Route::group(['middleware' => 'auth'], function () {
    Route::get('/matakuliah', 'matakuliahController@index')->name('matakuliah');
    Route::get('/jurusan', 'jurusanController@index')->name('jurusan');
    Route::get('/asisten', 'asistenController@index')->name('asisten');
    Route::get('/dashboard', 'dashboardController@index')->name('dashboard_');
    Route::post('/dashboard', 'dashboardController@store')->name('dashboard');
    Route::get('/presensi', 'presensiController@index')->name('presensi');
    Route::get('/presensi/edit/{id}/{tanggal_mulai}/{tanggal_selesai}/{is_aktif}', 'presensiController@edit')->name('presensi.edit');
    Route::post('/presensi/update', 'presensiController@update')->name('presensi.updt');
    Route::get('/download/{kode_jurusan}/{jenis}', 'presensiController@downloadExcel')->name('download');
    Route::get('/download/matakuliah', 'matakuliahController@downloadExcel')->name('download.matakuliah');
    Route::get('/download/asisten', 'asistenController@downloadExcel')->name('download.asisten');
    Route::get('/download/jurusan', 'jurusanController@downloadExcel')->name('download.jurusan');
    Route::get('/update-presensi/{id}/{tgl_mulai}/{tgl_selesai}/{is_aktif}', 'presensiController@update')->name('presensi.update');
    Route::get('/insert-presensi', 'presensiController@create')->name('presensi.create');
    Route::post('/store-presensi', 'presensiController@store')->name('presensi.store');
    Route::get('/destroy-presensi/{id}', 'presensiController@destroy')->name('presensi.destroy');

//insert data asisten
    Route::get('/input-data', 'inputDataController@index')->name('input');
    Route::post('/input-single', 'inputDataController@input_single')->name('input.single');
    Route::post('/input-collection', 'inputDataController@csvfileupload')->name('input.collection');
//remove data asisten
    Route::get('/remove-data', 'removeDataController@index')->name('remove');
    Route::post('/remove-single', 'removeDataController@remove_single')->name('remove.single');
    Route::post('/remove-collection', 'removeDataController@csvfileupload')->name('remove.collection');
});
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Auth::routes();

Route::get('/home', function () {
    return redirect()->route('dashboard');
})->name('home');
