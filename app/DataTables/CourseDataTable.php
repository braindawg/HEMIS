<?php

namespace App\DataTables;

use App\Models\Course;
use Yajra\DataTables\Services\DataTable;

class CourseDataTable extends DataTable
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
            ->editColumn('status', function ($course) {
                return '<span class="badge badge-'.$course->status_color.'">'.$course->status.'</span>';
            })
            ->addColumn('action', function ($course) {
                $html = '';

                if ($course->editable) {
                    $html .= '<a href="'.route('students.card', $course).'" class="btn btn-info btn-xs" target="new">کارت</a>';
                }
                
                $html .= '<a href="'.route('students.show', $course).'" class="btn btn-primary btn-xs" target="new"><i class="icon-printer"></i></a>';
                
                if (auth()->user()->can('edit-student') and $course->editable) {
                    $html .= '<a href="'.route('students.edit', $course).'" class="btn btn-success btn-xs" target="new"><i class="icon-pencil"></i></a>';
                    
                    if ($course->status_id < 2) {
                        $html .= '<form action="'. route('students.updateStatus', $course) .'" method="post" style="display:inline">
                                <input type="hidden" name="_method" value="patch" />
                                <input type="hidden" name="_token" value="'.csrf_token().'" />
                                <button type="submit" class="btn btn-xs btn-default" onClick="doConfirm()" style="margin-top: 5px">شامل پوهنتون</button>
                            </form>';
                    } 
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
    public function query(Course $model)
    {
        $input = request()->all();

        $query = $model->select(
                'students.id', 
                'form_no',
                'students.name as name',
                'father_name',
                'grandfather_name',
                'provinces.name as province_name',
                'universities.name as university', 
                'departments.name as department',
                'student_statuses.title as status',
                'student_statuses.tag_color as status_color',
                'status_id',
                'students.university_id',
                'kankor_year',
                'student_statuses.editable'
            )
            ->leftJoin('provinces', 'provinces.id', '=', 'students.province')
            ->leftJoin('universities', 'universities.id', '=', 'university_id')
            ->leftJoin('departments', 'departments.id', '=', 'department_id')
            ->leftJoin('student_statuses', 'student_statuses.id', '=', 'status_id');

            
            if (isset($input['columns'][0]['search']['value']) and $input['columns'][0]['search']['value'] != '')
                $query->where('students.status_id', 'like', "%".$input['columns'][0]['search']['value']."%");

            if (isset($input['columns'][1]['search']['value']) and $input['columns'][1]['search']['value'] != '')
                $query->where('students.form_no', 'like', "%".$input['columns'][1]['search']['value']."%");

            if (isset($input['columns'][2]['search']['value']) and $input['columns'][2]['search']['value'] != '')
                $query->where('students.name', 'like', "%".$input['columns'][2]['search']['value']."%");

            if (isset($input['columns'][3]['search']['value']) and $input['columns'][3]['search']['value'] != '')
                $query->where('students.father_name', 'like', "%".$input['columns'][3]['search']['value']."%");

            if (isset($input['columns'][4]['search']['value']) and $input['columns'][4]['search']['value'] != '')
                $query->where('students.grandfather_name', 'like', "%".$input['columns'][4]['search']['value']."%");

            if (isset($input['columns'][5]['search']['value']) and $input['columns'][5]['search']['value'] != '')
                $query->where('provinces.name', 'like', "%".$input['columns'][5]['search']['value']."%");

            if (isset($input['columns'][6]['search']['value']) and $input['columns'][6]['search']['value'] != '')
                $query->where('universities.name', 'like', "%".$input['columns'][6]['search']['value']."%");

            if (isset($input['columns'][7]['search']['value']) and $input['columns'][7]['search']['value'] != '')
                $query->where('universities.name', 'like', "%".$input['columns'][7]['search']['value']."%");

            if (isset($input['columns'][8]['search']['value']) and $input['columns'][8]['search']['value'] != '')
                $query->where('kankor_year', 'like', "%".$input['columns'][8]['search']['value']."%");
           
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
                    ->addAction(['title' => trans('general.action'), 'width' => '100px'])
                    ->parameters(array_merge($this->getBuilderParameters([]), [
                        'dom'          => 'Brtip',
                        'initComplete' => "function (settings, data) {   
                            emptyValue = '';                                     
                            table = this      
                            state = table.api().state.loaded()                        
                            
                            $('.dt-button.buttons-reset').click(function () {
                                $('.nav-tabs li').removeClass('active')
                                $('a[data-status-id=\"all\"]').parent().addClass('active')
                            })

                            if(!state || state.columns[0].search.search == '')        
                                $('a[data-status-id=\"all\"]').parent().addClass('active')
                            else
                                $('a[data-status-id=\"'+state.columns[0].search.search+'\"]').parent().addClass('active')

                            table.api().columns().every(function () {
                                var column = this;
                                var onEvent = 'change';
                                                                                                                    
                                if(this.index() >= 1 && this.index() <= 8) { 
                                    if (this.index() == 1 || this.index() == 8) {
                                        $('<input class=\"datatable-footer-input ltr \" placeholder=\"'+$(column.header()).text()+'\" name=\"'+ column.index() + '\" value=\"'+ (state ? state.columns[this.index()].search.search : emptyValue) +'\" />').appendTo($(column.footer()).empty())                                        
                                        .on(onEvent, function () {
                                            column.search($(this).val(), false, false, true).draw();
                                        });
                                    } else {
                                        $('<input class=\"datatable-footer-input \" placeholder=\"'+$(column.header()).text()+'\" name=\"'+ column.index() + '\" value=\"'+ (state ? state.columns[this.index()].search.search : emptyValue) +'\" />').appendTo($(column.footer()).empty())                                        
                                        .on(onEvent, function () {
                                            column.search($(this).val(), false, false, true).draw();
                                        });
                                    }
                                }
                            });

                            $('a.student-status').click(function () {
                                if ($(this).attr('data-status-id') == 'all')
                                    table.api().columns(0).search('', false, false, true).draw();
                                else
                                    table.api().columns(0).search($(this).attr('data-status-id'), false, false, true).draw();
                            });                            
                                
                            //$('#dataTableBuilder').wrap('<div class=\"table-responsive\"></div>');
                        }"

                    ]));
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'status_id' => ['name' => 'students.status_id', 'visible' => false, 'class' => 'hide', 'searchable' => false, 'orderable' => false],
            'form_no'     => ['title' => trans('general.form_no')],
            'name'     => ['title' => trans('general.name')],
            'father_name'     => ['title' => trans('general.father_name')],
            'grandfather_name'     => ['title' => trans('general.grandfather_name')],
            'province_name'     => [ 'name' => 'provinces.name', 'title' => trans('general.province')],
            'department'    => ['name' => 'departments.name', 'title' => trans('general.department')],
            'university' => ['name' => 'universities.name', 'title' => trans('general.university')],
            'kankor_year' => ['title' => trans('general.kankor_year')],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Courses_' . date('YmdHis');
    }
}