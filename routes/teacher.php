<?php



// Route::get('/', function () {
//     return redirect(route('teacher.noticeboard.index'));
// });

Route::get('login', 'Auth\LoginController@showLoginForm');
Route::post('login', 'Auth\LoginController@login')->name('teacher.login');

Route::group(['middleware' => 'auth:teacher', 'as' => 'teacher.'], function() { 
    Route::resource('/noticeboard', 'NoticeboardController')
        ->only('index', 'show')
        ->parameters(['noticeboard' => 'announcement']);        

    Route::get('timetable/course', 'Timetable\CourseController')->name('timetable.course');
        
    Route::get('support', function () {
        return view('support', [
            'title' => trans('general.support')
        ]);
    })->name('support');

});