<?php

namespace App\Http\Controllers\Course;

use App\Models\Score;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ScoresController extends Controller
{
    public function __invoke(Request $request, $course)
    {               
        if ( (auth('user')->check() and ! auth()->user()->can('edit-course')) OR (auth('teacher')->check() and auth('teacher')->user()->id != $course->teacher_id)) {
            return response()->json([
                'success' => false, 
                'id' => $request->id, 
                'total' => " ",
                'message' => trans('general.you_do_not_have_the_right_permissin_for_doing_this_action')
            ], 400);
        }

        $validator = \Validator::make($request->all(), [            
            'homework' => 'nullable|numeric|integer|min:0|max:20|required_without_all:classwork,midterm,final,chance_two,chance_three',
            'classwork' => 'nullable|numeric|integer|min:0|max:20',
            'midterm' => 'nullable|numeric|integer|min:0|max:30',
            'final' => 'nullable|numeric|integer|min:0|max:100', 
            'chance_two' => 'nullable|numeric|integer|min:0|max:100', 
            'chance_three' => 'nullable|numeric|integer|min:0|max:100', 
        ]);

        if ($validator->fails()) {
            $errors = "";
            foreach ($validator->errors()->messages() as $message) {
                $errors .= $message[0];
            }
            
            return response()->json([
                'success' => false, 
                'id' => $request->id, 
                'total' => " ",
                'message' => $errors
            ], 400);
        }
        
        $score = Score::find($request->id);

        $data = [
            'student_id' => $request->get('student_id'), 
            'course_id' => $request->get('course_id'),       
            'subject_id' => $request->get('subject_id'),
            'semester' => $request->get('semester'),            
            'homework' => $request->get('homework') != '' ? $request->get('homework') : null,
            'classwork' => $request->get('classwork') != '' ? $request->get('classwork') : null,
            'midterm' => $request->get('midterm') != '' ? $request->get('midterm') : null,
            'final' => $request->get('final') != '' ? $request->get('final') : null,
            'chance_two' => ($request->has('chance_two') and $request->get('chance_two') != '') ? $request->get('chance_two') : null,
            'chance_three' => ($request->has('chance_three') and $request->get('chance_three') != '') ? $request->get('chance_three') : null,
        ];

        $score = \DB::transaction(function () use ($request, $data, $score) {            
            if ($score) {
                if ($data['homework'] == '' and $data['classwork'] == '' and $data['midterm'] == '' and $data['final'] == '' and $data['chance_two'] == '' and $data['chance_three'] == '') {
                    $score->delete();
                } else {
                    $score->update($data);
                }                                
            } else {
                $score = Score::create($data);                
            } 
        
            return $score;
        });

        return response()->json([
            'success' => true, 
            'id' => ($score and $score->deleted_at == NULL) ? $score->id : NULL,
            'total' => ($score and $score->deleted_at == NULL) ? $score->total : NULL,
        ], 200);
    }
}