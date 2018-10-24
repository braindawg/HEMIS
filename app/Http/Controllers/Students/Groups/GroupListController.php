<?php

namespace App\Http\Controllers\Students\Groups;

use App\Models\Student;
use App\Models\University;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupListController extends Controller
{
    public function __construct()
    {        
        // $this->middleware('permission:group-view-list', ['only' => ['index', 'show']]);        
        // $this->middleware('permission:group-add-student', ['only' => ['create','store']]);
        // $this->middleware('permission:group-remove-student', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($group)
    {        
        return view('students.groups.list', [
            'title' => $group->name,
            'description' => trans('general.students_list'),
            'group' => $group,
            'universities' => University::pluck('name', 'id'),
            'department' => old('department') != '' ? Department::where('id', old('department'))->pluck('name', 'id') : []
        ]);
    }


    public function addStudent(Request $request, $group)
    {
      
        if ($request->has('student_id')) {

            $request->validate([            
                'student_id' => 'required'
            ]);
    
            Student::where('id', $request->student_id)
            ->update([
                'group_id' => $group->id
            ]);

        } elseif ($request->has('department_id')) {

            $request->validate([            
                'department_id' => 'required',
                'kankor_year' => 'required',
            ]);
    
            Student::where([
                'department_id' => $request->department_id,
                'kankor_year' => $request->kankor_year,
            ])->update([
                'group_id' => $group->id
            ]);

        }

        return redirect(route('groups.list', $group));
    }


    public function removeStudent(Request $request, $group)
    {
        Student::where('id', $request->student_id)
            ->update([
                'group_id' => null
            ]);

        return redirect(route('groups.list', $group));
    }
}