<?php

namespace App\Http\Controllers\Course;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttendanceController extends Controller
{
    public function list($course)
    {
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

    public function removeStudent(Request $request, $course){

        $course->students()->detach($request->student_id);

        return redirect()->back();
    }
}
