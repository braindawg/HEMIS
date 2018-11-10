<?php

namespace App\Http\Controllers\Course;

use App\Models\Course;
use App\Models\Group;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\DataTables\CourseDataTable;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    public function __construct()
    {        
        //  $this->middleware('permission:view-course', ['only' => ['index', 'show']]);        
        //  $this->middleware('permission:create-course', ['only' => ['create','store']]);
        //  $this->middleware('permission:edit-course', ['only' => ['edit','update', 'updateStatus']]);
        //  $this->middleware('permission:delete-course', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CourseDataTable $dataTable)
    {        
        return $dataTable->render('course.index', [
            'title' => trans('general.courses'),
            'description' => trans('general.courses_list')            
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('course.create', [
            'title' => trans('general.courses'),
            'description' => trans('general.create_course'),
            'departments' => Department::pluck('name', 'id'),
            'teachers' => Teacher::pluck('name', 'id'),
           'department' => old('department') != '' ? Department::where('id', old('department'))->pluck('name', 'id') : []
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([

            'code' => [
                'required',
                Rule::unique('courses')->whereNull('deleted_at')
            ],

            'year' => 'required',
            'semester' => 'required',
            'half_year' => 'required',
            'subject' => 'required',
            'teacher' => 'required',
            'group' => 'required'
        ]);

        $course = Course::create([
            'code' => $request->code,
            'year' => $request->year,
            'half_year' => $request->half_year,
            'semester' => $request->semester,
            'subject_id' => $request->subject,
            'teacher_id' => $request->teacher,
            'group_id' => $request->group,
            'university_id' => \Auth::user()->university_id,
            'department_id' => $request->department,
        ]);

        if($request->next == 1){

            return redirect()->back();

        }

        return redirect(route('courses.index'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($course)
    {
        return view('course.edit', [
            'title' => trans('general.courses'),
            'description' => trans('general.edit_course'),
            'course' => $course,
            'department' => Department::pluck('name', 'id'),
            'department' => old('department') != '' ? Department::where('id', old('department'))->pluck('name', 'id') : $course->department()->pluck('name', 'id'),
            'group' => old('group') != '' ? Group::where('id', old('group'))->pluck('name', 'id') : $course->group()->pluck('name', 'id'),
            'subject' => old('subject') != '' ? Subject::where('id', old('subject'))->pluck('title', 'id') : $course->subject()->pluck('title', 'id'),
            'teacher' => old('teacher') != '' ? Teacher::where('id', old('teacher'))->pluck('name', 'id') : $course->teacher()->pluck('name', 'id'),
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $course)
    {
        $validatedData = $request->validate([
            'code' => 'required',
            'year' => 'required',
            'semester' => 'required',
            'half_year' => 'required',
            'subject' => 'required',
            'teacher' => 'required',
            'group' => 'required'
        ]);

        $course->update([
            'code' => $request->code,
            'year' => $request->year,
            'half_year' => $request->half_year,
            'semester' => $request->semester,
            'subject_id' => $request->subject,
            'teacher_id' => $request->teacher,
            'group_id' => $request->group,
            'university_id' => \Auth::user()->university_id,
            'department_id' => $request->department,
        ]);

        return redirect(route('courses.index'));

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($course)
    {
        $course->delete();

        return redirect(route('courses.index'));
    }
}
