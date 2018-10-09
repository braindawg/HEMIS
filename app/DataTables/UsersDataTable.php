<?php

namespace App\DataTables;

use App\User;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {

        $datatables = datatables($query)
            ->editColumn('active', function ($user) {
                return $user->active ? "<i class='fa fa-check font-green'></i>" : "<i class='fa fa-remove font-red'></i>";
            })
            ->addColumn('action', function ($user) {
                $html = '';
                $html .= '<a href="'.route('users.edit', $user).'" class="btn btn-success btn-xs"><i class="icon-pencil"></i></a>';
                $html .= '<form action="'. route('users.destroy', $user) .'" method="post" style="display:inline">
                            <input type="hidden" name="_method" value="DELETE" />
                            <input type="hidden" name="_token" value="'.csrf_token().'" />
                            <button type="submit" class="btn btn-xs btn-danger" onClick="doConfirm()"><i class="icon-trash"></i></button>
                        </form>';

                return $html;
            })
            ->rawColumns([ 'action', 'active']);


        return $datatables;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        $users = $model->select('users.id', 'users.name', 'position', 'email', 'phone', 'universities.name as university', 'active')
            ->leftJoin('universities', 'universities.id', '=', 'university_id');

        if (!auth()->user()->allUniversities()) {
            $users->where('university_id', auth()->user()->university_id);
        }

        return $users;
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
        $columns = [            
            'name'     => ['title' => trans('general.name')],            
            'university' => ['name' => 'universities.name' ,'title' => trans('general.university')],
            'position' => ['title' => trans('general.position')],
            'email'    => ['title' => trans('general.email')], 
            'phone'    => ['title' => trans('general.phone')],
            'active'    => ['title' => trans('general.active')]
        ];

        return $columns;
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
