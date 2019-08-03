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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/home/nasabah', 'NasabahController');
Route::resource('/home/asset', 'AssetController');
Route::resource('/home/pengajuan', 'PengajuanController');
Route::resource('/home/setting', 'SettingController');
Route::get('/ajax/datatables/nasabah', 'NasabahController@json')->name('tableNasabah');
Route::get('/ajax/datatables/asset/{id}', 'AssetController@json')->name('tableAsset');
Route::get('/ajax/datatables/pengajuan/{id}', 'PengajuanController@json')->name('tablePengajuan');
Route::get('/ajax/datatables/setting/{id}', 'SettingController@json')->name('tableSetting');
Route::get('/nasabah/delete/{id}', 'NasabahController@destroy')->name('deleteNasabah');
Route::get('/asset/delete/{id}', 'AssetController@destroy')->name('deleteAsset ');
Route::get('/pengajuan/delete/{id}', 'PengajuanController@destroy')->name('deletePengajuan');
Route::get('/setting/delete/{id}', 'SettingController@destroy')->name('deletePengajuan');
