<?php
Route::get('/', function () {
    return view('welcome');
});

Route::get('/notacess', function () {
    return view('notaccess');
});

Auth::routes();

Route::group(['middleware' => 'checkRole:seller'], function() {
    Route::get('/home', 'HomeController@index')->name('home');
});