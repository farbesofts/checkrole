<?php
Route::get('/', function () {
    return view('welcome');
});

Route::get('/notaccess', function () {
    return view('notaccess');
});

Auth::routes();

Route::group(['prefix' => 'support','middlewareGroups' => ['CheckRole:admin','web']], function() {
    Route::get('/home', 'HomeController@index')->name('home');
});