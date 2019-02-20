<?php

namespace App\Http\Controllers\Course;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ScoreSheetController extends Controller
{
    public function print($course)
    {
        $pdf = \PDF::loadView('course.score-sheet.print', compact('course'), [], [
                'format' => 'A4-L',
                'direction' => 'rlt'
            ]);

        return $pdf->stream($course->code.'.pdf');
    }
}
