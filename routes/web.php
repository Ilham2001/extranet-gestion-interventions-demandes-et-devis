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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::get('/home', 'HomeController@index')->name('home');


Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home', 'HomeController@index')->name('home');

//NAVS
Route::get('/demands','DemandController@index');
Route::get('/interventions','InterventionController@index');
Route::get('/quotes','QuoteController@index');
Route::get('/documents','DocumentController@index');



Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});


Route::resource('buildings','BuildingController');
Route::resource('demands','DemandController');
Route::resource('interventions','InterventionController');
Route::resource('quotes','QuoteController');
Route::resource('documents','DocumentController');
Route::resource('clients','ClientController');

/**
 * Demand Routes
 */
Route::post('/demands','DemandController@store');
Route::get('/home', 'HomeController@index')->name('home');