<?php

namespace App\Http\Controllers\Universities;

use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Maklad\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Maklad\Permission\Models\Permission;
use App\DataTables\DepartmentsDataTable;

class DepartmentsController extends Controller
{
    public function __construct()
    {        
         $this->middleware('permission:view-department', ['only' => ['index', 'show']]);        
         $this->middleware('permission:create-department', ['only' => ['create','store']]);
         $this->middleware('permission:edit-department', ['only' => ['edit','update']]);
         $this->middleware('permission:delete-department', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DepartmentsDataTable $dataTable, $university)
    {        
        return $dataTable->render('departments.index', [
            'title' => $university->name,
            'description' => trans('general.departments_list'),
            'university' => $university
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($university)
    {
        return view('departments.create', [
            'title' => $university->name,
            'description' => trans('general.create_department'),
            'university' => $university,
            'grades' => Grade::pluck('name', 'id')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $university)
    {

        $validatedData = $request->validate([            
            'name' => 'required',
            'chairman' => '',
            'department_student_affairs' => '',
            'faculty' => '',
            'grade_id' => 'required',

        ]);
        
        $university->departments()->create($validatedData);

        return redirect(route('departments.index', $university));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($department)
    {
        exit();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($university, $department)
    {
        return view('departments.edit', [
            'title' => $university->name,
            'description' => trans('general.edit_department'),
            'university' => $university,
            'department' => $department,
            'grades' => Grade::pluck('name', 'id')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $university, $department)
    {          
        $validatedData = $request->validate([

            'name' => 'required',
            'chairman' => '',
            'department_student_affairs' => '',
            'faculty' => '',
            'grade_id' => 'required',


        ]);
        
        $department->update($validatedData);        

        return redirect(route('departments.index', $university));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($university, $department)
    {
        $department->delete();

        return redirect(route('departments.index', $university));
    }
}
