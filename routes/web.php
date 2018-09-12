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

Route::get('/', function () {    
    return redirect('/login');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function() { 
    Route::group(['namespace' => 'Api'], function() { 
        Route::get('api/departments/{universityId?}', "DepartmentsController@index")->name('api.departments');
        Route::get('api/students', "StudentsController@index")->name('api.students');
    });
    
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/support', function () {
        return view('support');
    })->name('support');

    Route::resource('/users', 'UsersController');
    Route::resource('/roles', 'RolesController');

    Route::resource('/students', 'StudentsController');
    Route::patch('/students/{student}/updateStatus', 'StudentsController@updateStatus')->name('students.updateStatus');
    Route::get('/students/{student}/card', 'StudentCardController@index')->name('students.card');

    Route::resource('/transfers', 'TransfersController');
    
    Route::resource('/universities', 'UniversitiesController');
    Route::resource('/universities/{university}/departments', 'DepartmentsController');
});
