<?php

namespace App\DataTables;

use App\Models\Department;
use Yajra\DataTables\Services\DataTable;

class DepartmentsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('action', function ($department) {
                $html = '';

                if (request()->is('universities*')) {
                    $html .= '<a href="'.route('departments.edit', [request()->segment(2), $department]).'" class="btn btn-success btn-xs"><i class="icon-pencil"></i></a>';
                    $html .= '<form action="'. route('departments.destroy', [request()->segment(2), $department]) .'" method="post" style="display:inline">
                                <input type="hidden" name="_method" value="DELETE" />
                                <input type="hidden" name="_token" value="'.csrf_token().'" />
                                <button type="submit" class="btn btn-xs btn-danger" onClick="doConfirm()"><i class="icon-trash"></i></button>
                            </form>';
                } elseif (request()->is('curriculum*')) {
                    $html .= '<a href="'.route('subjects.index', [request()->segment(2), $department]).'" class="btn btn-default btn-xs">'.trans('general.subjects').'</a>';

                    if ($department->subjects_count) {
                        $html .= '<span class="badge badge-success">'.$department->subjects_count.'</span>';
                    }
                }

                return $html;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\University $department
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Department $department)
    {
        $model = $model->where('departments.university_id', request()->segment(2))->select('name', 'faculty', 'id','chairman','department_student_affairs');


        $department = $department->where('departments.university_id', request()->segment(2))
            ->leftJoin('grades', 'grades.id', '=', 'grade_id')
            ->select('departments.name as name', 'departments.id', 'grades.name as grade', 'chairman', 'department_student_affairs','faculty');


        if (request()->is('curriculum*')) {
            $department->withCount('subjects');
        }

        return $department;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->addAction(['title' => trans('general.action'), 'width' => '60px'])
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'name'    => ['name' => 'departments.name','title' => trans('general.name')],                   
            'faculty'    => ['name' => 'departments.faculty','title' => trans('general.faculty')],                   
            'chairman'     => ['title' => trans('general.faculty_chairman')],                   
            'department_student_affairs'     => ['title' => trans('general.department_student_affairs')],                                                      
            'grade'     => [ 'title' => trans('general.grade'), 'searchable' => false]                    
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Departments_' . date('YmdHis');
    }
}
