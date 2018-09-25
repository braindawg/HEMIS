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
        return view('support', [
            'title' => trans('general.support')
        ]);
    })->name('support');

    Route::group(['namespace' => 'Users'], function() { 
        Route::resource('/users', 'UsersController');
        Route::resource('/roles', 'RolesController');
    });

    Route::group(['namespace' => 'Students'], function() { 
        Route::resource('/students', 'StudentsController');
        Route::patch('/students/{student}/updateStatus', 'StudentsController@updateStatus')->name('students.updateStatus');
        Route::get('/students/{student}/card', 'StudentCardController@index')->name('students.card');

        Route::get('/attendance', 'AttendanceController@index')->name('attendance.create');
        Route::get('/attendance/show', 'AttendanceController@show')->name('attendance.show');

        Route::resource('/transfers', 'TransfersController');
        Route::resource('/dropouts', 'DropoutsController');
        Route::resource('/leaves', 'LeavesController', ['parameters' => [
            'leaves' => 'leave'
        ]]);
    });

    Route::group(['namespace' => 'Universities'], function() { 
        
        Route::resource('/universities', 'UniversitiesController');
        Route::resource('/universities/{university}/departments', 'DepartmentsController');
    });

    Route::resource('/teachers', 'TeachersController');

    Route::post('/cityupdate', 'HomeController@updateData');
    Route::post('/universityupdate', 'HomeController@updateData');

});
