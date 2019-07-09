<?php

namespace App\Http\Controllers\Students;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TranscriptController extends Controller
{


    public function create(){

        $student = Student::find(3305);
        $scores = $student->scores->groupBy('semester');
        return view('students.transcript', [
            'title' => trans('general.students'),
            'description' => trans('general.students_list'),
            'student' => $student,
            'scores' => $scores         
        ]);
    }
}
