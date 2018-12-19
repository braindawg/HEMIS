<?php

namespace App\DataTables;

use App\Models\Teacher;
use Yajra\DataTables\Services\DataTable;

class TeachersDataTable extends DataTable
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
            ->addColumn('action', function ($teachers) {
                $html = '';

                if (auth()->user()->can('edit-teacher'))
                    $html .= '<a href="'.route('teachers.edit', $teachers).'" class="btn btn-success btn-xs" target="new"><i class="icon-pencil"></i></a>';
               

                if (auth()->user()->can('delete-teacher'))
                    $html .= '<form action="'. route('teachers.destroy', $teachers) .'" method="post" style="display:inline">
                            <input type="hidden" name="_method" value="DELETE" />
                            <input type="hidden" name="_token" value="'.csrf_token().'" />
                            <button type="submit" class="btn btn-xs btn-danger" onClick="doConfirm()" ><i class="fa fa-trash"></i></button>
                        </form>';


             return $html;
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Teacher $model)
    {
        $query = $model->select(
                'teachers.id',
                'teachers.name',
                'teachers.father_name',
                'teachers.phone',
                'universities.name as university',
                'teachers.last_name',
                'teachers.university_id'
            )
            ->leftJoin('provinces', 'provinces.id', '=', 'teachers.province')
            ->leftJoin('universities', 'universities.id', '=', 'university_id');

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
                    ->addAction(['title' => trans('general.action'), 'width' => '70px'])
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
            'name'       => ['name' => 'teachers.name','title' => trans('general.name')],
            'last_name' => ['title' => trans('general.last_name')],
            'father_name'      => ['title' => trans('general.father_name')],
            'phone'            => [ 'title' => trans('general.phone')],
            'university'       => ['name' => 'universities.name','title' => trans('general.university')],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Teachers_' . date('YmdHis');
    }
}