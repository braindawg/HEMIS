<?php

namespace App\Http\Controllers\Course;

use PDF;
use App\Models\University;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StudentAttendanceGroup;

class AttendanceController extends Controller
{
    public function __construct()
    {        
         $this->middleware('permission:view-student', ['only' => ['index', 'show']]);
    }

    public function index($course)
    {

        return view('course.attendance.index', [
            'title' => trans('general.attendance'),
            'description' => trans('general.create_attendance'),
            'course' => $course
        ]);
    }

    public function printAttendance($course)
    {
        $pdf = PDF::loadView('course.attendance.show', compact('course'), [], [
            'format' => 'A4-L'
          ]);

        return $pdf->stream($course->year.'pdf');

            $pdf = PDF::LoadView('course.attendance.test');
            return $pdf->stream('asdfs.pdf');

    }


    public function removeStudent(Request $request, $course){

        $course->students()->detach($request->student_id);

        return redirect()->back();
    }
}
