<?php

namespace App\Http\Controllers\Course;

use App\Models\Score;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ScoresController extends Controller
{
    public function __invoke(Request $request, $course)
    {
  

        /* $request->validate([            
            'scores.*.homework' => 'numeric|integer|min:0|max:100',
            'scores.*.classwork' => 'numeric|integer|min:0|max:100',
            'scores.*.midterm' => 'numeric|integer|min:0|max:100',
            'scores.*.final' => 'numeric|integer|min:0|max:100', 
        ]);*/

        if( is_array($request->scores )) {

            \DB::transaction(function () use ($request) {
                foreach($request->scores as $studentId => $score) {

                    Score::updateOrCreate(
                        array_merge($request->course, ['student_id' => $studentId]),
                        $score
                    );
                }
            });
        }

        return redirect()->back();
    }
}
