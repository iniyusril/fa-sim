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
    return view('welcome');
});
Route::get('/matakuliah', 'matakuliahController@index')->name('matakuliah');
Route::get('/jurusan', 'jurusanController@index')->name('jurusan');
Route::get('/asisten', 'asistenController@index')->name('asisten');
Route::get('/dashboard', 'dashboardController@index')->name('dashboard_');
Route::post('/dashboard', 'dashboardController@store')->name('dashboard');
Route::get('/presensi', 'presensiController@index')->name('presensi');

Route::get('/tes', 'dashboardController@tes')->name('tes');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');