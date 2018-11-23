<?php

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();
// Authentication Routes
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
// $this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// $this->post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
// $this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
// $this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
// $this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
// $this->post('password/reset', 'Auth\ResetPasswordController@reset');


Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/clients', 'ClientController');

Route::get('/pacing', 'Pacing\pacingController@index');
// Route::get('/pacing/{id}', 'Pacing\pacingController@show');
// Route::get('/pacing/flight', 'Pacing\pacingController@flight');




Route::get('/refresh', 'Pacing\dbmController@refresh');
Route::get('/create', 'Pacing\dbmController@create');
Route::get('/results', 'Pacing\dbmController@results');
Route::get('/cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return redirect('/pacing');
});
Route::get('/seed', function() {
    $exitCode = Artisan::call('db:seed');
    return redirect('/pacing');
});