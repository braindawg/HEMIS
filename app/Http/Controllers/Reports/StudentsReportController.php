<?php

namespace App\Http\Controllers\Reports;

use Illuminate\Http\Request;

use App\Models\Province;
use App\Models\University;
use App\Models\Department;
use App\Models\Student;
use App\Models\StudentStatus;
use App\Models\Grade;
use DB;
use Excel;
use App\Exports\StudentExports;
use App\Http\Controllers\Controller;

class StudentsReportController extends Controller
{

    public function index()
    {   
        
        return view('reports.students.index', [
            'title' => trans('general.report'),
            'description' => trans('general.student_report'),
            'universities' => University::pluck('name', 'id'),
            'provinces' => Province::pluck('name','id'),
            'kankor_years' =>  Student::select('kankor_year')->distinct()->orderBy('kankor_year', 'desc')->pluck('kankor_year','kankor_year'),
            'statuses' => StudentStatus::pluck('title', 'id'),
            'grades' => Grade::pluck('name', 'id'),
            'department' => old('department') != '' ? Department::where('id', old('department'))->pluck('name', 'id') : []
        ]);
    }


    public function create(Request $request){ 
      
        return Excel::download(new StudentExports() , 'students.xlsx');
    }
    
}
