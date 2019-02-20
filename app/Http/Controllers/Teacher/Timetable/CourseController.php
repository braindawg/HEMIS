<?php

namespace App\Http\Controllers\Teacher\Timetable;

use App\Models\Semester;
use App\Models\Curriculum;
use App\Models\CourseTime;
use App\Models\ScheduleItem;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    public function __invoke(Request $request)
    {
    	$teacher = auth()->user();
		
        $courses = $teacher->courses()->withoutGlobalScope('department')->get();
		
		$unscheduledCourses = $courses->filter(function($item) {
        	return $item->times->count() == 0;
        });
        
	    $courseTimes = CourseTime::with('course')->whereIn('course_id', $courses->pluck('id'))->get(); 	    
		
        return view('teacher.timetable.course', [
        	'teacher' => $teacher,        	
        	'unscheduledCourses' => $unscheduledCourses,
			'courseTimes' => $courseTimes,
			'title' => trans('general.timetable'),
			'description' => trans('general.courses'),
        ]);    
    }

    function exams(Request $request)
	{	
		$teacher = auth()->user();

		$semesterId = $request->has('semester') ? $request->get('semester') : defaultSemesterId();		

		$courses = $teacher->courses()->withoutGlobalScope('department')->where('semester_id', $semesterId)->get();
        
		return view('teacher.examTimetable', [	
			'semesters' => Semester::orderBy('id', 'desc')->take(5)->get(),
			'courses' => $courses,			
        	'semesterId' => $semesterId
		]);	
	}
}