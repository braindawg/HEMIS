<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Semester;
use App\Models\Curriculum;
use App\Models\CourseTime;
use App\Models\ScheduleItem;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class CoursesTimetableController extends Controller
{
    public function __invoke(Request $request)
    {
    	$teacher = auth()->user();

        $courses = $teacher->courses()->withoutGlobalScope('department')->where('semester_id', $semesterId)->get();
		
		$unscheduledCourses = $courses->filter(function($item) {
        	return $item->times->count() == 0;
        });

        $directCourses = ScheduleItem::select('schedule_items.*')->join('schedules', 'schedules.id', '=', 'schedule_items.schedule_id')
            ->where('schedules.semester_id', $semesterId)
            ->where('teacher_id', $teacher->id)
            ->get();            

	    $courseTimes = CourseTime::with('course')->whereIn('course_id', $courses->pluck('id'))->get(); 	    

        return view('teacher.timetable', [
        	'teacher' => $teacher,
        	'semesters' => Semester::orderBy('created_at', 'desc')->take(10)->get(),
        	'unscheduledCourses' => $unscheduledCourses,
        	'courseTimes' => $courseTimes,        
            'directCourses' => $directCourses,
        	'semesterId' => $semesterId
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