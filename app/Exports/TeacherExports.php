<?php

namespace App\Exports;

use App\Models\Teacher;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class TeacherExports implements FromView
{
    
    public function view(): View
    {

        $teachers = Teacher::select( 
            'teachers.id',
            'teachers.name',
            'teachers.last_name',
            'teachers.father_name',
            'teachers.grandfather_name',
            'teachers.email',
            'teachers.gender',
            'provinces.name as province',
            'teacher_academic_ranks.title as teacher_acadaemic_rank',
            'departments.name as department',
            'universities.name as university',
            'teachers.degree',
            'teachers.type'
            )
            ->leftJoin('provinces', 'teachers.province', '=', 'provinces.id')
            ->leftJoin('teacher_academic_ranks', 'teachers.academic_rank_id', '=', 'teacher_academic_ranks.id')
            ->leftJoin('departments', 'teachers.department_id', '=', 'departments.id')
            ->leftJoin('universities', 'teachers.university_id', '=', 'universities.id')
            ->orderBy('id', 'desc');
            

        if (request()->university != null) {
            $teachers->where('teachers.university_id', '=',  request()->university);
        }

        if (request()->department != null) {
            $teachers->where('teachers.department_id', '=',  request()->department);
        }
         

        if (request()->province != null) {
            $teachers->where('teachers.province', '=', request()->province);
        }

        if (request()->academic_rank_id != null) {
            $teachers->where('teachers.academic_rank_id', '=', request()->academic_rank_id);
        }

        if (request()->marital_status != null) {
            $teachers->where('teachers.marital_status', '=', request()->marital_status);
        }

        if (request()->degree != null) {
            $teachers->where('teachers.degree', '=', request()->degree);
        }

        if (request()->gender != null) {
            $teachers->where('teachers.gender', '=', request()->gender);
        }

        if (request()->type != null) {
            $teachers->where('teachers.type', '=', request()->type);
        }

        $teachers = $teachers->get();

        return view('reports.teachers.create', [
            'teachers' => $teachers
        ]);
    }
}
