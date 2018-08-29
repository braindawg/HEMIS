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
         $this->middleware('permission:edit-student', ['only' => ['edit','update']]);
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
    public function update(Request $request, $user)
    {
        $validatedData = $request->validate([
            // 'code' => [
            //     'required', 
            //     Rule::unique('students')->ignore($user->id, 'id')->whereNull('deleted_at')
            // ],
            // 'name' => 'required',
            // 'position' => 'required',            
            // 'email' => [
            //     'required', 
            //     Rule::unique('students')->ignore($user->id, 'id')->whereNull('deleted_at')
            // ],
            // 'phone' => 'nullable',
            'status' => 'required'            
        ]);
        
        $user->update([
            'status_id' => $request->status
        ]);        

        return redirect(route('students.index'));
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
