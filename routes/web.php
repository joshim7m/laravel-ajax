<?php

use Illuminate\Support\Facades\Route;





Route::get('student', ['as'=>'student.all', 'uses'=>'StudentController@index']);
Route::post('student', ['as'=>'student.store', 'uses'=>'StudentController@store']);
Route::get('student/{id}', ['as'=>'student.show', 'uses'=>'StudentController@show']);
Route::put('student/{id}', ['as'=>'student.update', 'uses'=>'StudentController@update']);
Route::delete('student/{id}', ['as'=>'student.delete', 'uses'=>'StudentController@destroy']);

Route::resource('task', 'TaskController');
Route::get('ajax/task', ['as'=>'ajax.task', 'uses'=>'TaskController@getData']);
Route::get('imageupload', ['as'=>'image.form', 'uses'=>'ImageController@showForm']);
Route::post('imageupload', ['as'=>'image.upload', 'uses'=>'ImageController@upLoad']);



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
