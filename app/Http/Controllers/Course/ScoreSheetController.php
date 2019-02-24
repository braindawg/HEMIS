<?php

namespace App\Http\Controllers\Course;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ScoreSheetController extends Controller
{
    public function print($course, $withScores = false)
    {
        if ($withScores) {
            $course->loadStudentsAndScores();
        } else {
            $course->loadStudents();
        }

        $pdf = \PDF::loadView('course.score-sheet.print', compact('course', $withScores), [], [
                'format' => 'A4-L',
                'direction' => 'rlt'
            ]);

        return $pdf->stream($course->code.'.pdf');
    }    
}
