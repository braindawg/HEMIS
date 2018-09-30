<?php

namespace App\Http\Controllers\Curriculum;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\DataTables\SubjectsDataTable;

class SubjectsController extends Controller
{

    public function __construct()
    {        
        //  $this->middleware('permission:view-department', ['only' => ['index', 'show']]);        
        //  $this->middleware('permission:create-department', ['only' => ['create','store']]);
        //  $this->middleware('permission:edit-department', ['only' => ['edit','update']]);
        //  $this->middleware('permission:delete-department', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SubjectsDataTable $dataTable, $university, $department)
    {        
        return $dataTable->render('curriculum.subjects.index', [
            'title' => $university->name." - ".$department->short_name,
            'description' => trans('general.subjects_list'),
            'department' => $department,
            'university' => $university
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($university, $department)
    {
        return view('curriculum.subjects.create', [
            'title' => $university->name." - ".$department->short_name,
            'description' => trans('general.create_subject'),
            'department' => $department,
            'university' => $university
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $university, $department)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'title_eng' => 'required',
            'credits' => 'required',
            'type' => 'required',
        ]);
        
        $subject = Subject::create([
            'university_id' => $university->id, 
            'department_id' => $department->id,
            'code' => $request->code, 
            'title' => $request->title, 
            'title_eng' => $request->title_eng,
            'credits' => $request->credits,
            'type' => $request->type,
            'active' => $request->has('active'),
        ]);

        return redirect(route('subjects.index', [$university, $department]));
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
    public function edit($university, $department, $subject)
    {
        return view('curriculum.subjects.edit', [
            'title' => $university->name." - ".$department->short_name,
            'description' => trans('general.edit_subject'),
            'subject' => $subject,
            'university' => $university,
            'department' => $department,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $university, $department, $subject)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'title_eng' => 'required',
            'credits' => 'required',
            'type' => 'required',
        ]);
        
        $subject->update([
            'code' => $request->code, 
            'title' => $request->title, 
            'title_eng' => $request->title_eng,
            'credits' => $request->credits,
            'type' => $request->type,
            'active' => $request->has('active'),
        ]);       

        return redirect(route('subjects.index',[ $university, $department, $subject]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($university, $department, $subject)
    {
        $subject->delete();

        return redirect(route('subjects.index',[ $university, $department, $subject]));
    }
}
