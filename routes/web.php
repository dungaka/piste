<?php

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| General
|--------------------------------------------------------------------------
| General routes for overarching resources.
*/
Route::resource('clients', 'ClientController');

/*
|--------------------------------------------------------------------------
| Planning
|--------------------------------------------------------------------------
| Collection of routes for sections relevant to media planning.
*/
Route::resources([
    'campaigns' => 'CampaignController',
    'media-plans' => 'MediaPlanController',
    'insertion-orders' => 'InsertionOrderController',
    'creatives' => 'CreativeController'
]);

/*
|--------------------------------------------------------------------------
| Reporting
|--------------------------------------------------------------------------
| Collection of routes for sections relevant to reporting, broken up
| based on the platform being reported from.
*/

Route::get('/reports/programmatic', 'Reports\ProgrammaticController@index');


// Download a specific file
Route::get('/reports/ad-server/{report_id}/{file_id}/download', 'Reports\AdServerController@download');
// Delete an entire report
Route::get('reports/ad-server/{report_id}/delete', 'Reports\AdServerController@destroy');
// Create a report
Route::get('/reports/ad-server/create/{report_type}', 'Reports\AdServerController@create');

Route::resource('/reports/ad-server', 'Reports\AdServerController', [
    'include' => [
        'index', 'destroy', 'create', 'edit'
    ]
]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::post('/create-campaign', 'Trafficking\CampaignController@createCampaign');
Route::get('/create-placement', 'Trafficking\PlacementController@createPlacement');
Route::get('/create-ad', 'Trafficking\AdController@createAd');
Route::post('/create-creative', 'Trafficking\CreativeController@createCreative');
