<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('survivors')->group(function () {
    Route::get('', 'SurvivorController@index');
    Route::get('{survivor}', 'SurvivorController@show')->name('survivor.show');
    Route::post('', 'SurvivorController@store');
    Route::put('{survivor}', 'SurvivorController@update');
    Route::delete('{survivor}', 'SurvivorController@delete');
    Route::get('{survivor}/update-location', 'SurvivorController@update_location');
    Route::put('{report}/report-contamination/{reported}', 'SurvivorController@report_contamination')->name('suvivor.report');
});

Route::prefix('recourses')->group(function () {
    Route::get('', 'RecourseController@index');
    Route::get('{recourse}', 'RecourseController@show')->name('recourse.show');
    Route::post('', 'RecourseController@store');
    Route::put('{recourse}', 'RecourseController@update');
    Route::delete('{recourse}', 'RecourseController@delete');
});

Route::prefix('items')->group(function () {
    Route::get('', 'ItemController@index');
    Route::get('{item}', 'ItemController@show')->name('item.show');
    Route::post('', 'ItemController@store');
    Route::put('{item}', 'ItemController@update');
    Route::delete('{item}', 'ItemController@delete');
});

Route::prefix('trades')->group(function () {
    Route::put('{survivor1}/swap/{survivor2}', 'TradeController@store');
});
Route::prefix('reports')->group(function () {
    Route::get('infecteds', 'ReportController@infected_suvivors');
    Route::get('non-infecteds', 'ReportController@non_infected_suvivors');
    Route::get('avg-recourses', 'ReportController@avg_recourses');
    Route::get('lost-point', 'ReportController@lost_point');
});