<?php

namespace App\Exports;

use App\Models\Student;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class StudentExports implements FromView 
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {

        $students = Student::select( 
            'students.id',
            'students.form_no',
            'students.name',
            'students.last_name',
            'students.father_name',
            'students.grandfather_name',
            'students.gender',
            'provinces.name as province',
            'students.kankor_year',
            'students.kankor_score',
            'students.school_name',
            'students.school_graduation_year',
            'departments.name as department',
            'universities.name as university',
            'grades.name as grade',
            'student_statuses.title as status'
            )
            ->leftJoin('provinces', 'students.province', '=', 'provinces.id')
            ->leftJoin('student_statuses', 'students.status_id', '=', 'student_statuses.id')
            ->leftJoin('grades', 'students.grade_id', '=', 'grades.id')
            ->leftJoin('departments', 'students.department_id', '=', 'departments.id')
            ->leftJoin('universities', 'students.university_id', '=', 'universities.id')
            ->orderBy('id', 'desc');
            

        if (request()->university != null) {
            $students->where('students.university_id', '=',  request()->university);
        }

        if (request()->department != null) {
            $students->where('students.department_id', '=',  request()->department);
        }
       

        if (request()->kankor_year != null) {
            $students->where('students.kankor_year', '=',  request()->kankor_year);
        }  
       

        if (request()->status != null) {
            $students->where('students.status_id', '=', request()->status);
        }     

        if (request()->province != null) {
            $students->where('students.province', '=', request()->province);
        }

        if (request()->grade != null) {
            $students->where('students.grade_id', '=', request()->grade);
        }

        $students = $students->get();

        return view('reports.students.create', [
            'students' => $students
        ]);
    }
}
