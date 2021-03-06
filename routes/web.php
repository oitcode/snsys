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
Route::post('/rmt/print/lot/process', 'RemittanceController@printLotFormProcess');
Route::get('/rmt/print/lot/prep', 'RemittanceController@printLotPrep');
Route::get('/rmt/print/ind/{remittance_id}', 'RemittanceController@printRemittanceIndNew');

/* Delete remittance */
Route::get('/rmt/delete/{rmtId}', 'RemittanceController@deleteRemittance');

/* Remittance create ajax */
Route::post('/rmt/create/fcajax', 'RemittanceController@ajaxCreateFcServe');
Route::get('/rmt/create/prevajax', 'RemittanceController@ajaxCreatePrevServe');
Route::get('/rmt/create/nextajax', 'RemittanceController@ajaxCreateNextServe');


// Print to PDF
Route::get('/rmt/print/pdf/lot/form', 'PrintController@printLotForm');
Route::get('/rmt/print/pdf/single/form', 'PrintController@printSingleForm');
Route::get('/rmt/print/pdf/pdf/{rmtId}', 'PrintController@printToPdf');
//Route::get('/rmt/print/pdf/lot/pdf/show/{lotCode}', 'PrintController@printToPdfLotNew');
Route::get('/rmt/print/pdf/lot/pdf/prep', 'PrintController@printToPdfLotPrep');
Route::get('/rmt/print/pdf/single/pdf/prep', 'PrintController@printToPdfSinglePrep');
Route::get('/rmt/print/pdf/s/p/{rmtId}', 'PrintController@printToPdfSingleParam');
Route::get('/rmt/print/pdf/l/{lotNum}', 'PrintController@displayLotPdf');


Route::get('/rmt/{remittance_id}', 'RemittanceController@showRmt');

/* Change password */
Route::get('/ol/changepw', 'Auth\ChangePasswordController@olChangePassword');
Route::post('/ol/changepw/process', 'Auth\ChangePasswordController@olChangePasswordProcess');

/* Create remittance with old family inp */
Route::get('/rmt/r/familyinp', 'RemittanceController@familyInp');
Route::post('/rmt/r/create', 'RemittanceController@getlastFamilyRemittance');


/* Sangh */
Route::get('/sangh/family', 'SanghController@search');

/* Info */
Route::get('/info/latest', 'InfoController@getLatestInfo');

/* Sdeo */
Route::get('/sdeo/faminp', 'SdeoController@famInp');
Route::post('/sdeo/faminp/process', 'SdeoController@processFamInp');

/* DB */
Route::get('/db/family/search', 'FamilyController@famInp');
Route::post('/db/family/search/process', 'FamilyController@famInpProcess');
Route::post('/db/family/search/result', 'FamilyController@famInpResult');

Route::get('/db/family/{famCode}', 'FamilyController@displayFamily');
Route::get('/db/edit/person/{perosnId}', 'FamilyController@editPerson');
Route::post('/db/edit/person/p/process', 'FamilyController@editPersonProcess');
Route::get('/db/worker/msearch', 'WorkerController@mSearch');
Route::post('/db/worker/msearch/process', 'WorkerController@mSearchProcess');
Route::get('/db/worker/msearch/result', 'WorkerController@mSearchResult');
Route::get('/db/remittance/search', 'RemittanceController@rmtInp');
Route::post('/db/remittance/search/process', 'RemittanceController@rmtInpProcess');

/* Ajax */
Route::get('/ajax/page', 'AjaxController@ajaxPage');
Route::post('/ajax/page/process', 'AjaxController@ajaFoo');


/* Reporting */
Route::get('/report/familyinp', 'ReportController@familyInput');
Route::post('/report/familyinp/process', 'ReportController@familyInputProcess');
Route::get('/report/workerlist', 'ReportController@displayWorkerList');
Route::get('/report/worker/{workerId}', 'ReportController@getWorkerRecord');
Route::get('/report/nonworker/{oblateId}', 'ReportController@getNonWorkerRecord');
