<?php

use Illuminate\Support\Facades\Route;










Route::get('imageupload', ['as'=>'image.form', 'uses'=>'ImageController@showForm']);
Route::post('imageupload', ['as'=>'image.upload', 'uses'=>'ImageController@upLoad']);



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
