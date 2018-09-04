<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\University;
use Illuminate\Http\Request;
use App\Models\StudentStatus;
use Illuminate\Validation\Rule;
use Maklad\Permission\Models\Role;
use App\DataTables\StudentsDataTable;
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
            'universities' => University::pluck('name', 'id')
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
        return view('students.edit', [
            'title' => trans('general.students'),
            'description' => trans('general.edit_student'),
            'student' => $student,
            'universities' => University::pluck('name', 'id'),
            'statuses' => StudentStatus::pluck('title', 'id')
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
            'status_id' => $request->status,

            'name_eng' => $request->name_eng,
            'last_name_eng' => $request->last_name_eng,
            'father_name_eng' => $request->father_name_eng,
            'grandfather_name_eng' => $request->grandfather_name_eng,
            'code' => $request->code,
            'department_eng' => $request->department_eng,
        ]);        

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
    public function destroy($user)
    {
        $user->delete();

        return redirect(route('students.index'));
    }
}
