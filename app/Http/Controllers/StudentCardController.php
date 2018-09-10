<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;

class StudentCardController extends Controller
{
    public function index($student)
    {
        $pdf = PDF::loadView('students.card', compact('student'), [], [
            'format' => ['85.60', 53]
          ]);

        return $pdf->stream($student->form_no.'.pdf');
    }
}
