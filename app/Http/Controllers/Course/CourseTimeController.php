<?php

namespace App\Http\Controllers\Course;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseTime;
use App\Models\Day;

use Illuminate\Http\Request;

class CourseTimeController extends Controller
{
    public function store(Request $request, $course){
        
       
        $validatedData = $request->validate([
        
            'day' => 'required',
            'time' => 'required',
        ]);

        
        $coursetime = CourseTime::create([
            'time' => $request->time,
            'location' => $request->location,
            'day_id' => $request->day,
            'course_id' => $course->id,
        ]);
        
        if( $coursetime) {

            return redirect()->back();

        }

    }

    public function delete($courseTime){

        $coursetime = CourseTime::find($courseTime)->delete();

        if($courseTime){

            return redirect()->back();
        }
    }

    public function edit($courseTime){
        
        $coursetime = CourseTime::find($courseTime);

        return view('course.course-time.edit', [
            'title' => trans('general.coursetime'),
            'description' => trans('general.edit_coursetime'),
            'coursetime' => $coursetime,
            'days' => Day::pluck('day','id'),   
        ]);
    }

    public function update(Request $request, $courseTime){

        $validatedData = $request->validate([
        
            'day' => 'required',
            'time' => 'required',
        ]);

            
        $coursetime = CourseTime::find($courseTime);

        $coursetime->update([
            'time' => $request->time,
            'location' => $request->location,
            'day_id' => $request->day,
        ]);

        return redirect(route('courses.edit', $coursetime->course));
    }
}
