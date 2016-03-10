<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\Glucotest;

// Glucotest Routes
Route::get('/tests', 'GlucotestController@index');
Route::get('/generalreporttests', 'GlucotestController@generalReportTests');
Route::post('/test', 'GlucotestController@store');
Route::get('test/{test}', 'GlucotestController@destroy');
//Route::delete('/test/{test}', 'GlucotestController@destroy');
Route::post('/edittest/{test}', 'GlucotestController@edit');
Route::get('/chart', 'GlucotestController@chart');
Route::get('/getchartdata', 'GlucotestController@getChartData');
Route::get('/getglucochartdatalasttwoweeks', 'GlucotestController@getChartDataByDayLastTwoWeeks');
Route::get('/getreportall/', 'GlucotestController@getReportAll');
Route::get('/reportall', 'GlucotestController@reportAll');

Route::get('/getreportbyinterval', 'GlucotestController@getReportByInterval');
Route::post('/reportbyinterval', 'GlucotestController@reportByInterval');
// Task Routes

Route::get('/tasks', 'TaskController@index');
Route::post('/task', 'TaskController@store');
Route::delete('/task/{task}', 'TaskController@destroy');

// Authentication Routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration Routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('home', 'HomeController@home');

Route::get('welcome/{locale}',  function ($locale) {
    App::setLocale('it');
 return redirect('/home');
    //
});
//Route::get('logout', 'AuthController@logout');
/**
 * Display All Tasks
 */
Route::get('/', function () {

  return view('welcome');

});
  
///Manage bug in navigation

Route::get('/auth/auth/login', function () {
    

    return redirect('auth/login');
});

Route::get('/auth/auth/register', function () {
    

    return redirect('auth/register');
});
Route::post('/testupdate/{id}', 'GlucotestController@update');

/*
 * Report routes
 */
//generic pie

Route::get('/piechartbyperiodtype/{before}/{type}', 'GlucotestController@getPieChartDataByPeriodType');

/*
 * pie basal and others this in periods (week, month, year)
 */
Route::get('/piechartsbytesttype', 'GlucotestController@pieChartsByTestType');
//Route::get('/getchartdatabytesttype100month', 'GlucotestController@getPieChartDataForTestTypes100LastMonth');
//Route::get('/getchartdatabytesttype100week', 'GlucotestController@getPieChartDataForTestTypes100LastWeek');
//Route::get('/getchartdatabytesttype100year', 'GlucotestController@getPieChartDataForTestTypes100LastYear');
//
//Route::get('/getchartdatabytesttype200month', 'GlucotestController@getPieChartDataForTestTypes200LastMonth');
//Route::get('/getchartdatabytesttype200week', 'GlucotestController@getPieChartDataForTestTypes200LastWeek');
//Route::get('/getchartdatabytesttype200year', 'GlucotestController@getPieChartDataForTestTypes200LastYear');
//
//Route::get('/getchartdatabytesttype300month', 'GlucotestController@getPieChartDataForTestTypes300LastMonth');
//Route::get('/getchartdatabytesttype300week', 'GlucotestController@getPieChartDataForTestTypes300LastWeek');
//Route::get('/getchartdatabytesttype300year', 'GlucotestController@getPieChartDataForTestTypes300LastYear');
//
//Route::get('/getchartdatabytesttype400month', 'GlucotestController@getPieChartDataForTestTypes400LastMonth');
//Route::get('/getchartdatabytesttype400week', 'GlucotestController@getPieChartDataForTestTypes400LastWeek');
//Route::get('/getchartdatabytesttype400year', 'GlucotestController@getPieChartDataForTestTypes400LastYear');
//
//
//Route::get('/getchartdatabytesttype500month', 'GlucotestController@getPieChartDataForTestTypes500LastMonth');
//Route::get('/getchartdatabytesttype500week', 'GlucotestController@getPieChartDataForTestTypes500LastWeek');
//Route::get('/getchartdatabytesttype500year', 'GlucotestController@getPieChartDataForTestTypes500LastYear');


Route::get('/gettestsforchartdatatwoweeks', 'GlucotestController@getPieChartDataTestsLastTwoWeeks');
Route::get('/gettestsforchartdatainterval/{start}/{end}', 'GlucotestController@getPieChartDataTestsInterval');
Route::get('/gettestsforchartdatainterval', 'GlucotestController@getPieChartDataTestsInterval');


//user settings
Route::get('/usersettings',  'UserSettingsController@index');

Route::post('/usersettings/update/','UserSettingsController@update');