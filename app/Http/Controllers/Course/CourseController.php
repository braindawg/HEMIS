<?php

namespace App\Http\Controllers\Course;

use App\Models\Course;
use App\Models\University;
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
            'universities' => University::pluck('name', 'id'),
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
                Rule::unique('students')->whereNull('deleted_at')
            ],
            'name' => 'required',
            'position' => 'required',            
            'email' => 'required|email|unique:students',
            'phone' => 'nullable',
            'password' => 'required|confirmed'            
        ]);
        
        $user = User::create($validatedData);

        return redirect(route('course.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($course)
    {        
        return view('course.print', compact('student'));
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
            'description' => trans('general.edit_student'),
            'student' => $course,
            'universities' => University::pluck('name', 'id'),
            'statuses' => StudentStatus::whereIn('id', [1, 2])->pluck('title', 'id')
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
            'status' => 'required'            
        ]);

        $course->update([
            'last_name' => $request->last_name,
            'marital_status' => $request->marital_status,
            'school_name' => $request->school_name,
            'school_graduation_year' => $request->school_graduation_year,
            'birthdate' => $request->birthdate,
            'language' => $request->language,
            'phone' => $request->phone,
            'tazkira' => implode('!@#', [ $request->tazkira['volume'],$request->tazkira['registration_number'], $request->tazkira['page'], $request->tazkira['general_number']]),
            'province' => $request->province,
            'district' => $request->district,
            'village' => $request->village,
            'address' => $request->address,

            'province_current' => $request->province_current,
            'district_current' => $request->district_current,
            'village_current' => $request->village_current,
            'address_current' => $request->address_current,
            'status_id' => $request->has('status') ? $request->status : $course->status_id,

            'name_eng' => $request->name_eng,
            'last_name_eng' => $request->last_name_eng,
            'father_name_eng' => $request->father_name_eng,
            'grandfather_name_eng' => $request->grandfather_name_eng,
            'department_eng' => $request->department_eng,
        ]);        

        if ($request->has('print')) {
            return redirect(route('course.show', $course));
        }

        return redirect(route('course.index'))->with('message', 'اطلاعات '.$course->name.' موفقانه آبدیت شد.');
    }

    public function updateStatus($course)
    {        
        $course->update([
            'status_id' => 2
        ]);

        return redirect(route('course.index'))->with('message', $course->name.' موفقانه شامل پوهنتون شد.');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user)
    {
        $user->delete();

        return redirect(route('course.index'));
    }
}
