<?php

namespace App\DataTables;

use App\Models\Announcement;
use Yajra\DataTables\Services\DataTable;

class NoticeBoardDataTable extends DataTable
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
            ->addColumn('action', function ($announcement) {
                $html = '';

                    $html .= '<a href="'.route('announcements.show', $announcement).'" class="btn btn-success btn-xs" target="new"><i class="fa fa-eye"></i></a>';                   
                    
                    if (auth()->user()->can('edit-announcement')) {
                        $html .= '<a href="'.route('announcements.edit', $announcement).'" class="btn btn-success btn-xs" target="new"><i class="icon-pencil"></i></a>';
                    }
                    
                    if (auth()->user()->can('delete-announcement')) {
                        $html .= '<form action="'. route('announcements.destroy', $announcement) .'" method="post" style="display:inline">
                            <input type="hidden" name="_method" value="DELETE" />
                            <input type="hidden" name="_token" value="'.csrf_token().'" />
                            <button type="submit" class="btn btn-xs btn-danger" onClick="doConfirm()"><i class="fa fa-trash"></i></button>
                        </form>';
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
    public function query(Announcement $model)
    {
        $query = $model->select(
            'announcements.id',
            'announcements.title'
        );
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
            'title'         => ['name' => 'announcements.title','title' => trans('general.ntitle')],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Announcement_' . date('YmdHis');
    }
}