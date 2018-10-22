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

    Route::group(['namespace' => 'Noticeboard'], function() {
        Route::get('/noticeboard','NoticeBoardController@show')->name('noticeboard');
        Route::resource('/announcements', 'AnnouncementController');
    });
    Route::group(['namespace' => 'Issue'], function() {
        Route::get('/issue','CommentsController@index')->name('issue-list');
        Route::get('/issue-show/{issue}','CommentsController@show')->name('issue-show');
        Route::get('/store-comment','CommentsController@store')->name('store-comment');
        Route::get('/delete-comment','CommentsController@destroy')->name('delete-comment');

        Route::resource('/issues', 'IssueController');
    });


    Route::group(['namespace' => 'Curriculum'], function() {
        Route::get('/curriculum', 'UniversitiesController@index')->name('curriculum.universities');
        Route::get('/curriculum/{university}', 'DepartmentsController@index')->name('curriculum.departments');;
        Route::resource('/curriculum/{university}/{department}/subjects', 'SubjectsController');
    });

    Route::resource('/teachers', 'TeachersController');
    Route::post('/cityupdate', 'HomeController@updateData');
    Route::post('/universityupdate', 'HomeController@updateData');
    Route::get('/noticeboards/download/{file}/{recordID}/{folername}','SystemDownloadController@download')->name('noticeboards.download');
    Route::get('/deletefile/{file}/{recordID}','FilesDeleteController@deleteFiles')->name('deletefile');
    
    //advertisement document files link
    Route::get('getAttachment/{file_name}', function($filename){
        $path = storage_path('app').'/attachments/'.$filename;
        $image = \File::get($path);
        $mime = \File::mimeType($path);
        return \Response::make($image, 200)->header('Content-Type', $mime);
    });

});
