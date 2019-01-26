<?php

Route::get('/', function () {  
    dd(auth()->user());  
    return redirect('/login');
});

Auth::routes();

Route::get('teacher/login', 'Auth\TeacherLoginController@showLoginForm');
Route::post('teacher/login', 'Auth\TeacherLoginController@login')->name('teacher.login');

Route::group(['middleware' => 'auth'], function() { 

    Route::impersonate();

    Route::group(['namespace' => 'Api'], function() { 
        Route::get('api/students', "StudentsController")->name('api.students');// Filter is on Model
        Route::get('api/provinces', "ProvinceController")->name('api.provinces');
        Route::get('api/subjects/{department?}', "SubjectsController")->name('api.subjects');// Filter is on Model
        Route::get('api/groups/{department?}', "GroupsController")->name('api.groups');// Filter is on Model
        Route::get('api/teachers{university?}', "TeachersController")->name('api.teachers');// Filter is on Model
        Route::get('api/departments/{university?}', "DepartmentsController")->name('api.departments');
    });
    
    Route::get('home/{kankor_year?}', 'HomeController@index')->name('home');
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
        Route::resource('/students/groups', 'Groups\GroupsController');

        Route::get('/students/groups/{group}/list', 'Groups\GroupListController@index')->name('groups.list');
        Route::post('/students/groups/{group}/list', 'Groups\GroupListController@addStudent')->name('groups.student.add');
        Route::delete('/students/groups/{group}/list', 'Groups\GroupListController@removeStudent')->name('groups.student.remove');
        

        Route::resource('/students', 'StudentsController');
        Route::patch('/students/{student}/updateStatus', 'StudentsController@updateStatus')->name('students.updateStatus');
        Route::get('/students/{student}/card', 'StudentCardController@index')->name('students.card');


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
        Route::get('/issue-show/{issue}','CommentsController@show')->name('issue-show');
        Route::get('/store-comment','CommentsController@store')->name('store-comment');
        Route::get('/delete-comment','CommentsController@destroy')->name('delete-comment');

        Route::resource('/issues', 'IssueController');
    });


    Route::group(['namespace' => 'Curriculum'], function() {
        Route::get('/curriculum', 'UniversitiesController@index')->name('curriculum.universities');
        Route::get('/curriculum/{university}', 'DepartmentsController@index')->name('curriculum.departments');
        Route::resource('/curriculum/{university}/{department}/subjects', 'SubjectsController');
    });

    Route::group(['namespace' => 'Course'], function() {
       
        Route::get('courses/{course}/list', 'AttendanceController@list')->name('attendance.create');        
        Route::get('courses/{course}/attendance', 'AttendanceController@print')->name('course.attendance.print');
        Route::get('courses/{course}/scores-sheet', 'ScoreSheetController@print')->name('course.scoresSheet.print');
        Route::post('courses/{course}/add-student', 'AttendanceController@addStudent')->name('attendance.student.add');
        Route::delete('courses/{course}/remove-student', 'AttendanceController@removeStudent')->name('attendance.student.remove'); 
        
        Route::post('courses/{course}/store-scores', 'ScoresController')->name('scores.store');
        Route::post('courses/{course}/store-coursetime','CourseTimeController@store')->name('coursetime.store');
        Route::get('courses/{coursetime}/delete-coursetime', 'CourseTimeController@delete');
        Route::get('courses/{coursetime}/edit-coursetime', 'CourseTimeController@edit');
        Route::post('courses/{coursetime}/update-coursetime', 'CourseTimeController@update')->name('coursetime.update');

        Route::resource('courses', 'CourseController');

    });

    Route::resource('/teachers', 'TeachersController');
    Route::post('/cityupdate', 'HomeController@updateData');
    Route::post('/universityupdate', 'HomeController@updateData');
    Route::get('/download/{file}','SystemDownloadController@download')->name('noticeboards.download');
    Route::get('/deletefile/{file}','FilesDeleteController@deleteFiles')->name('deletefile');

    Route::get('/activity/{university_id?}/{startdate?}/{enddate?}','ActivityController@index')->name('activity');
    
    //attachments link
    Route::get('getAttachment/{file_name}', function($filename){
        $path = storage_path('app').'/attachments/'.$filename;
        $image = \File::get($path);
        $mime = \File::mimeType($path);
        return \Response::make($image, 200)->header('Content-Type', $mime);
    });

    Route::get('makeNotificationAsRead', function () {    
        auth()->user()->unreadNotifications->markAsRead();
    });
});
 