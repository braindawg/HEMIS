<?php

namespace App\Http\Controllers\Course;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ScoreSheetController extends Controller
{
    public function print(Request $request, $course)
    {       
        $course->loadStudentsAndScores();
       
        $pdf = \PDF::loadView('course.score-sheet.print', compact('course', 'request'), [], [
            //'format' => 'A4-L',
            'direction' => 'rlt'
        ]);

        return $pdf->stream($course->code.'.pdf');
    }    
}
