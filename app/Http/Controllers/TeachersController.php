<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Teacher;
use App\Models\Province;
use App\Models\University;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Maklad\Permission\Models\Role;
use App\Models\TeacherAcademicRank;
use App\DataTables\TeachersDataTable;
use Maklad\Permission\Models\Permission;

class TeachersController extends Controller
{
    public function __construct()
    {
         $this->middleware('permission:view-teacher', ['only' => ['index', 'show']]);
         $this->middleware('permission:create-teacher', ['only' => ['create','store']]);
         $this->middleware('permission:edit-teacher', ['only' => ['edit','update']]);
         $this->middleware('permission:delete-teacher', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TeachersDataTable $dataTable)
    {
        return $dataTable->render('teachers.index', [
            'title' => trans('general.teachers'),
            'description' => trans('general.teachers_list')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teachers.create', [
            'title' => trans('general.teachers'),
            'description' => trans('general.create_teacher'),
            'universities' => University::pluck('name', 'id'),
            'provinces' => Province::pluck('name','id'),
            'teacher_academic_rank' => TeacherAcademicRank::pluck('title', 'id'),
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
            'name' => 'required|min:3',
            'father_name' => 'required|min:3',
            'phone' => 'required',
            'email' => 'required|email|unique:teachers',
            'university' =>'required',
            'academic_rank_id' =>'required',
        ]);

        $teacher = Teacher::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'father_name' => $request->father_name,
            'grandfather_name' => $request->grandfather_name,
            'birthdate' => $request->birthdate,
            'marital_status' => $request->marital_status,
            'province' => $request->province,
            'phone' => $request->phone,
            'email' => $request->email,
            'degree' => $request->degree,
            'academic_rank_id' => $request->academic_rank_id,
            'department_id' => $request->department,
            'university_id' => $request->university,
            'password' => $request->password ?? null,
        ]);

        return redirect(route('teachers.index'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($teacher)
    {
        return view('teachers.edit', [
            'title' => trans('general.teachers'),
            'description' => trans('general.edit_teacher'),
            'teacher' => $teacher,
            'universities' => University::pluck('name', 'id'),
            'provinces' =>Province::pluck('name','id'),
            'teacher_academic_rank' => TeacherAcademicRank::pluck('title', 'id'),
            'department' => old('department') != '' ? Department::where('id', old('department'))->pluck('name', 'id') : $teacher->department()->pluck('name', 'id'),

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $teacher)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3',
            'father_name' => 'required|min:3',
            'phone' => 'required',
            'email' => 'required|email',
            'university' =>'required',
        ]);

        $teacher->update([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'father_name' => $request->father_name,
            'grandfather_name' => $request->grandfather_name,
            'birthdate' => $request->birthdate,
            'marital_status' => $request->marital_status,
            'province' => $request->province,
            'phone' => $request->phone,
            'email' => $request->email,
            'degree' => $request->degree,
            'academic_rank_id' => $request->academic_rank_id,
            'department_id' => $request->department,
            'university_id' => $request->university,
            'password' => $request->password ?? null,
        ]);

        return redirect(route('teachers.index'))->with('message', 'اطلاعات '.$teacher->name.' موفقانه آبدیت شد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($teacher)
    {
        \DB::transaction(function () use ($teacher){

            $teacher->delete();

        });

        return redirect(route('teachers.index'));
    }
}