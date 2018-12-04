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

/**
 * Do not use the default welcome page. Instead let HomeController@index
 * control the / of this app.
 */

/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/* Remittance */
Route::get('/rmt/create', 'RemittanceController@create');
Route::post('/rmt/create/store', 'RemittanceController@storeRemittance');
Route::get('/rmt/create/success', 'RemittanceController@storeSuccess');
Route::get('/rmt/search', 'RemittanceController@search');
Route::post('/rmt/search/process', 'RemittanceController@searchProcess');
Route::get('/rmt/lot/start', 'RemittanceController@startLot');
Route::post('/rmt/lot/create', 'RemittanceController@createLot');
Route::get('/rmt/lot/exit', 'RemittanceController@exitLot');
Route::get('/rmt/lot/resume', 'RemittanceController@resumeLot');
Route::post('/rmt/lot/resume/process', 'RemittanceController@resumeLotProcess');
Route::get('/rmt/print/{remittance_id}', 'RemittanceController@printRemittance');



Route::get('/rmt/{remittance_id}', 'RemittanceController@showRmt');


/* Sangh */
Route::get('/sangh/family', 'SanghController@search');
