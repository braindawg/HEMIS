<?php

namespace App\DataTables;

use App\Models\Student;
use Yajra\DataTables\Services\DataTable;

class StudentsDataTable extends DataTable
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
            ->editColumn('status', function ($student) {
                return '<span class="badge badge-'.$student->status_color.'">'.$student->status.'</span>';
            })
            ->addColumn('action', function ($student) {
                $html = '';
                $html .= '<a href="'.route('students.show', $student).'" class="btn btn-primary btn-xs" target="new"><i class="icon-printer"></i></a>';
                $html .= '<a href="'.route('students.edit', $student).'" class="btn btn-success btn-xs" target="new"><i class="icon-pencil"></i></a>';
                
                if ($student->status_id != 2) {
                    $html .= '<form action="'. route('students.updateStatus', $student) .'" method="post" style="display:inline">
                            <input type="hidden" name="_method" value="patch" />
                            <input type="hidden" name="_token" value="'.csrf_token().'" />
                            <button type="submit" class="btn btn-xs btn-default" onClick="doConfirm()" style="margin-top: 5px">شامل پوهنتون</button>
                        </form>';
                }                

                return $html;
            })
            ->rawColumns(['status', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Student $model)
    {
        $query = $model->select(
                'students.id', 
                'form_no',
                'students.name as name',
                'father_name',
                'grandfather_name',
                'province',
                'universities.name as university', 
                'departments.name as department',
                'student_statuses.title as status',
                'student_statuses.tag_color as status_color',
                'status_id'
            )            
            ->leftJoin('universities', 'universities.id', '=', 'university_id')
            ->leftJoin('departments', 'departments.id', '=', 'department_id')
            ->leftJoin('student_statuses', 'student_statuses.id', '=', 'status_id');

        return $query;
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
            'form_no'     => ['title' => trans('general.form_no')],
            'name'     => ['title' => trans('general.name')],
            'father_name'     => ['title' => trans('general.father_name')],
            'grandfather_name'     => ['title' => trans('general.grandfather_name')],
            'province'     => [ 'title' => trans('general.province')],
            'department'    => ['name' => 'departments.name', 'title' => trans('general.department')],
            'university' => ['name' => 'universities.name', 'title' => trans('general.university')],
            'status' => ['name' => 'student_statuses.title', 'title' => trans('general.status'), 'type' => 'html'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Students_' . date('YmdHis');
    }
}