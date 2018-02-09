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

Route::group(['middleware' => ['web']], function () {
	//Test Query
	//Route::get('/testQuery', 'HomeController@testQuery');
 	//HomeController
    Route::get('/', 'HomeController@index');
    Route::get('/calTime', 'HomeController@calTime');
    Route::get('/home', 'HomeController@home');
    //AlertController
    Route::get('/alert/wait', 'AlertController@wait');
    //LinkmonitorController
	Route::get('/linkHome', 'LinkCityController@home');
	Route::get('/linkmonitor', 'LinkmonitorController@linkmonitor');
	Route::get('/linkmonitorAmp', 'LinkmonitorController@linkmonitorAmp');
	//LinkCity
	Route::get('/linkCity/{city_id}', 'LinkCityController@index');
	Route::get('/linkCity/activeMobileView/{city_id}', 'LinkCityController@mobileIndex');
	Route::get('/updateSpace', 'LinkCityController@updateSpace');
	Route::get('/updateNewCityTel', 'LinkCityController@updateNewCityTel');
	Route::get('/linkHome/search', 'LinkCityController@searchProvince');
	//cityAdmin
	Route::get('/cityAdmin/edit/{city_id}', 'CityAdminController@edit');
	Route::post('/cityAdmin/update', 'CityAdminController@update');
	//CityAuthor
	Route::get('/linkdata/author/{linkdata_id}', 'CityAuthorController@index');
	Route::post('/linkdata/author/add', 'CityAuthorController@store');
	Route::get('/linkdata/author/edit/{author_id}','CityAuthorController@edit');
	Route::post('/linkdata/author/update', 'CityAuthorController@update');
	Route::get('/linkdata/author/remove/{linkdata_id}/{author_id}', 'CityAuthorController@destroy');
	//Register and Login
	Auth::routes();
	//newCityAmdin
	Route::post('/newCityAdmin/store','newCityAdminController@store');
});