<?php

namespace App\Http\Controllers\Course;

use App\Models\Day;
use App\Models\Course;
use App\Models\CourseTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseTimeController extends Controller
{
    
    public function store(Request $request, $course)
    {
        $validatedData = $request->validate([
            'day' => 'required',
            'time' => 'required',
        ]);

        $time = $course->times()->create([
            'time' => $request->time,
            'location' => $request->location,
            'day_id' => $request->day
        ]);
        
        return redirect()->back();
    }

    public function edit($course, $time)
    {
        return view('course.course-time.edit', [
            'title' => trans('general.coursetime'),
            'description' => trans('general.edit_coursetime'),
            'coursetime' => $time,
            'course' => $course,
            'days' => Day::pluck('day','id'),   
        ]);
    }

    public function update(Request $request, $course, $time)
    {
        $validatedData = $request->validate([
            'day' => 'required',
            'time' => 'required',
        ]);
       
        $time->update([
            'time' => $request->time,
            'day_id' => $request->day,
            'location' => $request->location,
        ]);

        return redirect(route('courses.edit', $course));
    }

    public function delete(Course $course, CourseTime $time)
    {
        $time->delete();

        return redirect()->back();
    }
}
