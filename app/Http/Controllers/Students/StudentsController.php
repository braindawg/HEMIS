<?php

namespace App\Http\Controllers\Students;

use App\User;
use App\Models\Grade;
use App\Models\Student;
use App\Models\University;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\StudentStatus;
use Illuminate\Validation\Rule;
use Maklad\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\DataTables\StudentsDataTable;
use Illuminate\Support\Facades\File;
use Maklad\Permission\Models\Permission;

class StudentsController extends Controller
{
    public function __construct()
    {        
         $this->middleware('permission:view-student', ['only' => ['index', 'show']]);        
         $this->middleware('permission:create-student', ['only' => ['create','store']]);
         $this->middleware('permission:edit-student', ['only' => ['edit','update', 'updateStatus']]);
         $this->middleware('permission:delete-student', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StudentsDataTable $dataTable)
    {        
        return $dataTable->render('students.index', [
            'title' => trans('general.students'),
            'description' => trans('general.students_list')            
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('students.create', [
            'title' => trans('general.students'),
            'description' => trans('general.create_student'),
            'universities' => University::pluck('name', 'id'),
            'department' => old('department') != '' ? Department::where('id', old('department'))->pluck('name', 'id') : [],
            'grades' => Grade::where('id', '!=',  2)->pluck('name', 'id'),
            'statuses' => StudentStatus::pluck('title', 'id'),
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
            'grade' => 'required',
            'department' => 'required',
            'form_no' => [
                'required', 
                Rule::unique('students')->whereNull('deleted_at')
            ],
            'name' => 'required',
            'father_name' => 'required',
            'grandfather_name' => 'required',
            'kankor_score' => 'required',
            'nationality' => 'required',
            'language' => 'required',
            'status' => 'required',                        
        ]);
        
        
        \DB::transaction(function () use ($request) {
            $student = Student::create([
                'grade_id' => $request->grade,
                'university_id' => $request->university,
                'department_id' => $request->department,

                'name' => $request->name,
                'father_name' => $request->father_name,
                'grandfather_name' => $request->grandfather_name,
                'last_name' => $request->last_name,

                'nationality' => $request->nationality,
                'language' => $request->language,

                'tazkira' => implode('!@#', [ $request->tazkira['volume'],$request->tazkira['registration_number'], $request->tazkira['page'], $request->tazkira['general_number']]),

                'birthdate' => $request->birthdate,
                'marital_status' => $request->marital_status,
                'school_name' => $request->school_name,
                'school_graduation_year' => $request->school_graduation_year,
                
                'kankor_year' => $request->kankor_year,
                'kankor_score' => $request->kankor_score,
                'form_no' => $request->form_no,
                            
                'phone' => $request->phone,
                
                'province' => $request->province,
                'district' => $request->district,
                'village' => $request->village,
                'address' => $request->address,

                'province_current' => $request->province_current,
                'district_current' => $request->district_current,
                'village_current' => $request->village_current,
                'address_current' => $request->address_current,

                'status_id' => $request->status,
                'gender' => $request->gender,

                'name_eng' => $request->name_eng,
                'last_name_eng' => $request->last_name_eng,
                'father_name_eng' => $request->father_name_eng,
                'grandfather_name_eng' => $request->grandfather_name_eng,
                'department_eng' => $request->department_eng            
            ]);

            foreach ($request->relatives as $relative) {
                $student->relatives()->create([
                    'relation' => $relative['relation'],
                    'name' => $relative['name'],
                    'job' => $relative['job'],
                    'phone' => $relative['phone'],
                ]);
            }
        });
        
        return redirect(route('students.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($student)
    {        
        return view('students.print', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($student)
    {
        if (! $student->status->editable) {
            abort(404);
        }

        return view('students.edit', [
            'title' => trans('general.students'),
            'description' => trans('general.edit_student'),
            'student' => $student,
            'universities' => University::pluck('name', 'id'),
            'statuses' => StudentStatus::whereIn('id', [1, 2])->pluck('title', 'id'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $student)
    {

        $validatedData = $request->validate([
            'status' => 'required'            
        ]);

        $student->update([
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
            'status_id' => $request->has('status') ? $request->status : $student->status_id,
            'gender' => $request->gender,

            'name_eng' => $request->name_eng,
            'last_name_eng' => $request->last_name_eng,
            'father_name_eng' => $request->father_name_eng,
            'grandfather_name_eng' => $request->grandfather_name_eng,
            'department_eng' => $request->department_eng,

            'department_id' => $request->department,
        ]);        

        $index = 0;

        foreach ($student->relatives as $relative) {
            $relative->update([
                'relation' => $request->relatives[$index]['relation'],
                'name' => $request->relatives[$index]['name'],
                'job' => $request->relatives[$index]['job'],
                'phone' => $request->relatives[$index]['phone'],
            ]);

            $index ++;
        }

        if ($request->has('print')) {
            return redirect(route('students.show', $student));
        }

        return redirect(route('students.index'))->with('message', 'اطلاعات '.$student->name.' موفقانه آبدیت شد.');
    }

    public function updateStatus($student)
    {        
        $student->update([
            'status_id' => 2
        ]);

        return redirect(route('students.index'))->with('message', $student->name.' موفقانه شامل پوهنتون شد.');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($student)
    {
        $student->delete();

        return redirect(route('students.index'));
    }
}
