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
Route::resource('/home/datatraining', 'DataTrainingController');
Route::resource('/home/historitraining', 'HistoriTrainingController');
Route::get('/ajax/datatables/nasabah', 'NasabahController@json')->name('tableNasabah');
Route::get('/ajax/datatables/asset/{id}', 'AssetController@json')->name('tableAsset');
Route::get('/ajax/datatables/pengajuan/{id}', 'PengajuanController@json')->name('tablePengajuan');
Route::get('/ajax/datatables/setting/', 'SettingController@json')->name('tableSetting'); //Histori
Route::get('/ajax/datatables/trainingdata/', 'DataTrainingController@json')->name('tableTraining');
Route::get('/ajax/datatables/historidata/', 'HistoriTrainingController@json')->name('tableHistori');
Route::get('/ajax/datatables/historidatainput/{id}', 'HistoriTrainingController@jsonInput')->name('tableHistoriInput');
Route::get('/ajax/datatables/historidataoutput/{id}', 'HistoriTrainingController@jsonOutput')->name('tableHistoriOutput');
Route::get('/nasabah/delete/{id}', 'NasabahController@destroy')->name('deleteNasabah');
Route::get('/asset/delete/{id}', 'AssetController@destroy')->name('deleteAsset ');
Route::get('/pengajuan/delete/{id}', 'PengajuanController@destroy')->name('deletePengajuan');
Route::get('/setting/delete/{id}', 'SettingController@destroy')->name('deletePengajuan');
