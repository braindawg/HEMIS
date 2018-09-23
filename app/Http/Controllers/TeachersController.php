<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Models\Teacher;
use App\User;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Maklad\Permission\Models\Role;
use App\DataTables\TeachersDataTable;
use Maklad\Permission\Models\Permission;

class TeachersController extends Controller
{
    public function __construct()
    {        
//         $this->middleware('permission:view-student', ['only' => ['index', 'show']]);
//         $this->middleware('permission:create-student', ['only' => ['create','store']]);
//         $this->middleware('permission:edit-student', ['only' => ['edit','update', 'updateStatus']]);
//         $this->middleware('permission:delete-student', ['only' => ['destroy']]);
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
            'provinces' =>Province::pluck('name','id')
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
            'department' =>'required',
        ]);

        $teacher = Teacher::create([
            'first_name' => $request->name,
            'last_name' => $request->last_name,
            'father_name' => $request->father_name,
            'grandfather_name' => $request->grandfather_name,
            'birthdate' => $request->birthdate,
            'marital_status' => $request->marital_status,
            'province' => $request->province,
            'phone' => $request->phone,
            'email' => $request->email,
            'degree' => $request->degree,
            'university_id' => $request->university,
            'department_id' => $request->department,
        ]);

        return redirect(route('teachers.index'));
    }


     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($teacher)
    {        
    //   dd('yea');
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
            'provinces' =>Province::pluck('name','id')

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
        //  dd($request->all());
        $validatedData = $request->validate([
            'first_name' => 'required|min:3',
            'father_name' => 'required|min:3',
            'phone' => 'required',
            'email' => 'required|email',
            'university' =>'required',
            'department' =>'required',
        ]);
        
        $teacher->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'father_name' => $request->father_name,
            'grandfather_name' => $request->grandfather_name,
            'birthdate' => $request->birthdate,
            'marital_status' => $request->marital_status,
            'province' => $request->province,
            'phone' => $request->phone,
            'email' => $request->email,
            'degree' => $request->degree,
            'university_id' => $request->university,
            'department_id' => $request->department,
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
