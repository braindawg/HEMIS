<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttendanceController extends Controller
{

    public function list(Course $course)
    {
        $course->loadStudentsAndScores();

        return view('course.attendance.list', [
            'title' => trans('general.attendance'),
            'description' => trans('general.list'),
            'course' => $course,
            'department' => old('department') != '' ? Department::where('id', old('department'))->pluck('name', 'id') : []
        ]);
    }

    public function print($course)
    {
        $pdf = \PDF::loadView('course.attendance.print', compact('course'), [], [
            'format' => 'A4-L'
        ]);

        return $pdf->stream($course->code.'.pdf');
    }
}
