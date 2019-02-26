<?php

namespace App\DataTables;

use App\Models\Group;
use Yajra\DataTables\Services\DataTable;

class GroupsDataTable extends DataTable
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
            ->addColumn('action', function ($group) {
                $html = '';

                if (auth()->user()->can('group-view-list')) {
                    $html .= '<a href="'.route('groups.list', $group).'" class="btn btn-primary btn-xs" title="'.trans('general.list').'"><i class="icon-list"></i></a>';
                }
                
                if (auth()->user()->can('edit-group')) {
                    $html .= '<a href="'.route('groups.edit', $group).'" class="btn btn-success btn-xs"><i class="icon-pencil"></i></a>';
                }
                
                if (auth()->user()->can('delete-group') and ! $group->students()->exists()) {
                    $html .= '<form action="'. route('groups.destroy', $group) .'" method="post" style="display:inline">
                            <input type="hidden" name="_method" value="DELETE" />
                            <input type="hidden" name="_token" value="'.csrf_token().'" />
                            <button type="submit" class="btn btn-xs btn-danger" onClick="doConfirm()"><i class="icon-trash"></i></button>
                        </form>';
                } 
                
                return $html;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Group $model)
    {
        return $model->select('groups.*', 'universities.name as university', 'departments.name as deparmtent')
            ->leftJoin('departments', 'departments.id', '=', 'department_id')
            ->leftJoin('universities', 'universities.id', '=', 'groups.university_id')
            ->withCount('students');
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
                    ->addAction(['title' => trans('general.action'), 'width' => '80px'])
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        $columns = [            
            'name'     => ['name' => 'groups.name', 'title' => trans('general.name')],            
            'description' => ['title' => trans('general.description')],
            'department' => ['name' => 'departments.name', 'title' => trans('general.department')]
        ];

        if (auth()->user()->allUniversities()) {
            $columns['university'] = ['name' => 'universities.name', 'title' => trans('general.university')];
        }

        $columns['students_count'] = ['name' => 'students_count', 'title' => trans('general.students_count'), 'searchable' => false, 'orderable' => false];


        return $columns;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Group_' . date('YmdHis');
    }
}
