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
    });
    
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/support', function () {
        return view('support');
    })->name('support');
    Route::get('/syncPermissions', function () {
        //$role = \Spatie\Permission\Models\Role::create(['name' => 'super-admin', 'title' => 'ادمین']);
        $role = \Spatie\Permission\Models\Role::where('name', 'super-admin')->first();
        $role->givePermissionTo(\Spatie\Permission\Models\Permission::all());
    });

    Route::resource('/users', 'UsersController');
    Route::resource('/roles', 'RolesController');

    Route::resource('/students', 'StudentsController');
    Route::patch('/students/{student}/updateStatus', 'StudentsController@updateStatus')->name('students.updateStatus');
    
    Route::resource('/universities', 'UniversitiesController');
    Route::resource('/universities/{university}/departments', 'DepartmentsController');
});
