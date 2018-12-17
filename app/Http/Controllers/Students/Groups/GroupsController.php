<?php

namespace App\Http\Controllers\Students\Groups;

use App\Models\Group;
use App\Models\Subject;
use App\Models\University;
use App\Models\Department;
use Illuminate\Http\Request;
use App\DataTables\GroupsDataTable;
use App\Http\Controllers\Controller;

class GroupsController extends Controller
{
    public function __construct()
    {        
        $this->middleware('permission:view-group', ['only' => ['index', 'show']]);        
        $this->middleware('permission:create-group', ['only' => ['create','store']]);
        $this->middleware('permission:edit-group', ['only' => ['create','store']]);
        $this->middleware('permission:delete-group', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GroupsDataTable $dataTable)
    {        
        return $dataTable->render('students.groups.index', [
            'title' => trans('general.groups'),
            'description' => trans('general.groups_list')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('students.groups.create', [
            'title' => trans('general.groups'),
            'description' => trans('general.new_group'),
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
        $request->validate([            
            'name' => 'required'
        ]);

        $group = Group::create([
            'name' => $request->name,
            'description' => $request->description,
            'department_id' => $request->department,
            'university_id' => $request->university
        ]);

        return redirect(route('groups.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($group)
    {
        return view('students.groups.edit', [
            'title' => trans('general.groups'),
            'description' => trans('general.edit_group'),
            'group' => $group,
            'universities' => University::pluck('name', 'id'),
            'department' => old('department') != '' ? Department::where('id', old('department'))->pluck('name', 'id') : $group->department()->pluck('name', 'id')
        ]);
    }

    /**
     * Update a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $group)
    {
        $request->validate([            
            'name' => 'required'
        ]);

        $group->update([
            'name' => $request->name,
            'description' => $request->description,
            'department_id' => $request->department,
            'university_id' => $request->university
        ]);

        return redirect(route('groups.index'));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($group)
    {
      
        $group->delete();

        return redirect(route('groups.index'));
    }
}