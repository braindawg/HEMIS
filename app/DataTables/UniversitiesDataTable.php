<?php

namespace App\DataTables;

use App\Models\University;
use Yajra\DataTables\Services\DataTable;

class UniversitiesDataTable extends DataTable
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
            ->addColumn('action', function ($university) {
                $html = '';

                if (request()->is('universities*')) {
                    $html .= '<a href="'.route('departments.index', $university).'" class="btn btn-default btn-xs">'.trans('general.departments').'</a>';
                    $html .= '<a href="'.route('universities.edit', $university).'" class="btn btn-success btn-xs"><i class="icon-pencil"></i></a>';
                    $html .= '<form action="'. route('universities.destroy', $university) .'" method="post" style="display:inline">
                                <input type="hidden" name="_method" value="DELETE" />
                                <input type="hidden" name="_token" value="'.csrf_token().'" />
                                <button type="submit" class="btn btn-xs btn-danger" onClick="doConfirm()"><i class="icon-trash"></i></button>
                            </form>';
                } elseif (request()->is('curriculum*')) {
                    $html .= '<a href="'.route('curriculum.departments', $university).'" class="btn btn-default btn-xs">'.trans('general.departments').'</a>';
                }

                return $html;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\University $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(University $model)
    {
        return $model->newQuery()->select('id', 'name','chairman','student_affairs');
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
                    ->addAction(['title' => trans('general.action'), 'width' => '120px'])
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
            'name'     => ['title' => trans('general.name')],                              
            'chairman'     => ['title' => trans('general.university_chairman')],                              
            'student_affairs'     => ['title' => trans('general.university_student_affairs')],                              
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Universities_' . date('YmdHis');
    }
}
