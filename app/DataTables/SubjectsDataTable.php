<?php

namespace App\DataTables;

use App\Models\Subject;
use Yajra\DataTables\Services\DataTable;

class SubjectsDataTable extends DataTable
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
            ->editColumn('active', function ($subject) {
                return $subject->active ? trans('general.active') : trans('general.inactive');
            })
            ->editColumn('type', function ($subject) {
                return trans('general.'.$subject->type);
            })
            ->addColumn('action', function ($subject) {
                $html = '';
                $html .= '<a href="'.route('subjects.edit', [$subject->university_id, $subject->department_id, $subject->id]).'" class="btn btn-success btn-xs"><i class="icon-pencil"></i></a>';
                $html .= '<form action="'. route('subjects.destroy', [$subject->university_id, $subject->department_id, $subject->id]) .'" method="post" style="display:inline">
                            <input type="hidden" name="_method" value="DELETE" />
                            <input type="hidden" name="_token" value="'.csrf_token().'" />
                            <button type="submit" class="btn btn-xs btn-danger" onClick="doConfirm()"><i class="icon-trash"></i></button>
                        </form>';

                return $html;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Subject $model)
    {
        return $model->where(['university_id' => request()->segment(2), 'department_id' => request()->segment(3)]);
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
            'code'     => ['title' => trans('general.code')],            
            'title' => ['title' => trans('general.title')],
            'title_eng' => ['title' => trans('general.title_eng')],
            'credits'    => ['title' => trans('general.credits')], 
            'type'    => ['title' => trans('general.type')],
            'active'    => ['title' => trans('general.status')],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Users_' . date('YmdHis');
    }
}
