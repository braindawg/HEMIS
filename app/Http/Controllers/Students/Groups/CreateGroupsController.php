<?php

namespace App\Http\Controllers\Students\Groups;

use App\Models\Student;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CreateGroupsController extends Controller
{    
    public function __construct()
    {                     
        $this->middleware('permission:create-group', ['only' => ['create','store']]);
    }

    public function index()
    {    
        return view('students.groups.all.create', [
            'title' => trans('general.groups'),
            'description' => trans('general.create_groups_automatically'),
        ]);                
    }

    public function store(Request $request)
    {
        \DB::transaction(function () use ($request) {
            
            //This query creat groups for student if group with spedified kankor_year and department_id doesn't exists.
            \DB::statement(
                'INSERT INTO groups (name, kankor_year, description, department_id, university_id) 
                SELECT IFNULL(CONCAT("گروپ ", departments.name, " ", departments.faculty, " ", students.kankor_year ), "NULL") as name, 
                        students.kankor_year, 
                        "" as description, 
                        students.department_id, 
                        students.university_id 
                FROM students 
                JOIN departments ON departments.id = students.department_id
                WHERE students.kankor_year = ? 
                    and students.department_id is not null 
                    and students.university_id is not null
                    and students.department_id not in (SELECT department_id FROM groups WHERE kankor_year = ?)
                GROUP BY students.department_id', 
                [$request->kankor_year, $request->kankor_year]
            );

            //This query assignes students to groups if they group exists and students are not belongs to a group
            \DB::statement(
                'UPDATE students 
                JOIN groups ON groups.kankor_year = students.kankor_year 
                    and groups.department_id = students.department_id
                SET students.group_id = groups.id
                WHERE students.group_id = ""
                    and students.kankor_year = ?',
                [$request->kankor_year]
            );
        });          

        return redirect()->back()->with('message', trans('general.groups_had_been_created', $request->year));
    }
}
