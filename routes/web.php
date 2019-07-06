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
    return redirect('/login');;
});

Auth::routes();

Route::get('home', 'PcInfoController@getComputer')->name('home');
Route::get('home/getComputerDownload', 'PcInfoController@getComputerDownload')->name('home');

Route::get('OS/{name}','PcInfoController@getOS');

Route::get('SoftwareList/{id}','PcInfoController@getSoftwareList');
Route::get('SoftwareList/getSoftwareListDownload/{id}','PcInfoController@getSoftwareListDownload');

Route::get('AllSoftware','PcInfoController@getAllSoftware');
Route::get('AllSoftware/getAllSoftwareDownload','PcInfoController@getAllSoftwareDownload');
Route::post('AllSoftware/getApply','PcInfoController@getApply');


Route::get('software/{id}','PcInfoController@getSoftware');
Route::get('software/getSoftwareDownload/{id}','PcInfoController@getSoftwareDownload');

Route::get('/a','TestController@index');
Route::post('/a','TestController@a');

Auth::routes();

