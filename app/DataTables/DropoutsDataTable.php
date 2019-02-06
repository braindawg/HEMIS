<?php

namespace App\DataTables;

use App\Models\Dropout;
use Yajra\DataTables\Services\DataTable;

class DropoutsDataTable extends DataTable
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
            ->addColumn('action', function ($dropouts) {
                $html = '';
                
                if (auth()->user()->can('delete-dropout')) {
                    $html .= '<form action="'. route('dropouts.destroy', $dropouts) .'" method="post" style="display:inline">
                            <input type="hidden" name="_method" value="DELETE" />
                            <input type="hidden" name="_token" value="'.csrf_token().'" />
                            <button type="submit" class="btn btn-xs btn-danger" onClick="doConfirm()" style="margin-top: 5px"><i class="fa fa-trash"></i></button>
                        </form>';
                }      
                if (auth()->user()->can('create-dropout') and $dropouts->approved == false ) {
                    $html .='<a href="'.route('dropouts.edit', $dropouts).'" class="btn btn-xs btn-success" onClick="doConfirm()" style="margin-top: 5px" title = "'. trans('general.approved_dropout').' "><i class="fa fa-spinner"></i></a>'; 
                }
                            
                return $html;
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Transfer $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Dropout $model)
    {
        $query = $model->select(
            'dropouts.id',
            'students.form_no',
            'students.name',
            'dropouts.approved',
            'students.father_name as father_name',
            'note'
            )
        ->join('students', 'students.id', '=', 'student_id');
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
                    ->addAction(['title' => trans('general.action'), 'width' => '۷0px'])
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
            'form_no'         => ['name' => 'students.form_no', 'title' => trans('general.form_no')],
            'name'            => ['name' => 'students.name', 'title' => trans('general.name')],
            'father_name'     => ['name' => 'students.father_name', 'title' => trans('general.father_name')],
            'note'            => ['name' => 'dropouts.note', 'title' => trans('general.note'), 'sortable' => false, 'searchable' => false]
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Dropouts_' . date('YmdHis');
    }
}