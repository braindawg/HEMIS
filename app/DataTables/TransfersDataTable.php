<?php

namespace App\DataTables;

use App\Models\Transfer;
use Yajra\DataTables\Services\DataTable;

class TransfersDataTable extends DataTable
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
            ->addColumn('action', function ($transfer) {
                $html = '';
                
                if (auth()->user()->can('delete-transfer')) {
                    $html .= '<form action="'. route('transfers.destroy', $transfer) .'" method="post" style="display:inline">
                        <input type="hidden" name="_method" value="DELETE" />
                        <input type="hidden" name="_token" value="'.csrf_token().'" />
                        <button type="submit" class="btn btn-xs btn-danger" onClick="doConfirm()" style="margin-top: 5px"><i class="fa fa-trash"></i></button>
                    </form>';
                }
                if (auth()->user()->can('approve-transfer') and $transfer->approved == false ) {
                    $html .='<a href="'.route('transfers.edit', $transfer).'" class="btn btn-xs btn-success" onClick="doConfirm()" style="margin-top: 5px" title = "'. trans('general.approved_transfer').' "><i class="fa fa-spinner"></i></a>'; 
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
    public function query(Transfer $model)
    {
        $query = $model->select(
            'transfers.id',
            'transfers.approved',
            'students.form_no',
            'students.name',
            'students.father_name as father_name',
            \DB::raw('CONCAT(from_department.name, " ", from_university.name) as from_department'),
            \DB::raw('CONCAT(to_department.name, " ", to_university.name) as to_department'),
            'note'
            )
        ->join('students', 'students.id', '=', 'student_id')
        ->join('departments as from_department', 'from_department.id', '=', 'from_department_id')
        ->join('departments as to_department', 'to_department.id', '=', 'to_department_id')
        ->leftJoin('universities as from_university', 'from_university.id', '=', 'from_department.university_id')
        ->leftJoin('universities as to_university', 'to_university.id', '=', 'to_department.university_id');

        if (! auth()->user()->allUniversities()) {
                
            $query->leftJoin('departments as from', 'from.id', '=' , 'from_department_id')
                ->leftJoin('departments as to', 'from.id', '=' , 'to_department_id')
                ->where('from_department.university_id', auth()->user()->university_id);
                //->orWhere('to_department.university_id', auth()->user()->university_id);                    
        }

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
            'form_no'         => ['title' => trans('general.form_no')],
            'name'            => ['title' => trans('general.name')],
            'father_name'     => ['title' => trans('general.father_name')],
            'from_department' => ['name' => 'from_department.name', 'title' => trans('general.from_department')],
            'to_department'   => ['name' => 'to_department.name', 'title' => trans('general.to_department')],
            'note'            => ['name' => 'transfers.note', 'title' => trans('general.note'), 'sortable' => false, 'searchable' => false]
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Transfers_' . date('YmdHis');
    }
}