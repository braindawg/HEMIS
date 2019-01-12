<?php

namespace App\Http\Controllers\Course;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttendanceController extends Controller
{
    public function __construct()
    {        
        $this->middleware('permission:edit-course', ['only' => ['removeStudent']]);
        $this->middleware('permission:view-course', ['only' => ['list', 'print']]);
    }

    public function list(Course $course)
    {
        $course = $course->with(['students' => function ($students) use ($course) {
            $students->with(['score' => function ($scores) use ($course){
                $scores->where('course_id', $course->id);            
            }]);
        }])->where('courses.id' , $course->id)->first();


        return view('course.attendance.list', [
            'title' => trans('general.attendance'),
            'description' => trans('general.create_attendance'),
            'course' => $course
        ]);
    }

    public function print($course)
    {
        $pdf = \PDF::loadView('course.attendance.print', compact('course'), [], [
            'format' => 'A4-L'
        ]);

        return $pdf->stream($course->code.'.pdf');
    }

    public function removeStudent(Request $request, $course)
    {
        \DB::transaction(function () use ($request, $course) {
            $course->students()->detach($request->student_id);
            $course->scores()->where('student_id', $request->student_id)->delete();     
        });

        return redirect()->back();
    }
}
