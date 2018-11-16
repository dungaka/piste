<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/clients', 'ClientController');

Route::get('/pacing', 'Pacing\pacingController@index');
Route::get('/pacing/show', 'Pacing\pacingController@show');
Route::get('/pacing/flight', 'Pacing\pacingController@flight');


Route::get('/pacing/create', 'Pacing\dbmController@create');
Route::get('/pacing/results', 'Pacing\dbmController@results');