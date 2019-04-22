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
            ->addColumn('action', function ($course) {


                $html = '<div class="btn-group">
                        <a class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" href="javascript:;" aria-expanded="false">';     
                        $html .= trans('general.action').'
                            <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu pull-right">';
                        if(auth()->user()->can('edit-course')){
                            $html .= '<li><a href="'. route('courses.edit', $course) .'"  target="new"> <i class="fa fa-pencil"></i> '. trans("general.edit") .' </a></li>';

                        }   

                        if (auth()->user()->can('view-course')) {
                            $html .= '<li><a href="'. route('attendance.create', $course) .'"  target="new"> <i class="fa fa-list"></i> '. trans("general.list") .' </a></li>';    
                        }                       

                        if (auth()->user()->can('delete-course')) {
                            $html .= '<li><form action="'. route('courses.destroy', $course) .'" method="post" style="display:inline">
                                <input type="hidden" name="_method" value="DELETE" />
                                <input type="hidden" name="_token" value="'.csrf_token().'" />
                                <button type="submit" style ="color:red" class="btn btn-link" onClick="doConfirm()"><i class="fa fa-trash" style="color:red"></i> '.trans("general.delete").' </button>
                            </form></li>';
                        }

                        $html .= '</ul>
                        </div>';

                return $html;
            })
            ->rawColumns( ['action']);
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
                'courses.id',
                'courses.code',
                'year',
                'half_year',
                'courses.semester',
                'subjects.title as subject',
                'teachers.name as teacher',
                'groups.name as group',
                'universities.name as university',
                'departments.name as department'
            )
            ->leftJoin('subjects', 'subjects.id', '=', 'courses.subject_id')
            ->leftJoin('teachers', 'teachers.id', '=', 'courses.teacher_id')
            ->leftJoin('groups', 'groups.id', '=', 'group_id')
            ->leftJoin('universities', 'universities.id', '=', 'courses.university_id')
            ->leftJoin('departments', 'departments.id', '=', 'courses.department_id');
            //->withCount('students');



            if (isset($input['columns'][0]['search']['value']) and $input['columns'][0]['search']['value'] != '')
                $query->where('courses.code', 'like', "%".$input['columns'][0]['search']['value']."%");

            if (isset($input['columns'][1]['search']['value']) and $input['columns'][1]['search']['value'] != '')
                $query->where('courses.year', 'like', "%".$input['columns'][1]['search']['value']."%");

            if (isset($input['columns'][2]['search']['value']) and $input['columns'][2]['search']['value'] != '')
                $query->where('courses.half_year', 'like', "%".$input['columns'][2]['search']['value']."%");

            if (isset($input['columns'][3]['search']['value']) and $input['columns'][3]['search']['value'] != '')
                $query->where('courses.semester', 'like', "%".$input['columns'][3]['search']['value']."%");

            if (isset($input['columns'][4]['search']['value']) and $input['columns'][4]['search']['value'] != '')
                $query->where('subjects.subject', 'like', "%".$input['columns'][4]['search']['value']."%");

            if (isset($input['columns'][5]['search']['value']) and $input['columns'][5]['search']['value'] != '')
                $query->where('teachers.name', 'like', "%".$input['columns'][5]['search']['value']."%");

            if (isset($input['columns'][6]['search']['value']) and $input['columns'][6]['search']['value'] != '')
                $query->where('universities.name', 'like', "%".$input['columns'][6]['search']['value']."%");

            if (isset($input['columns'][7]['search']['value']) and $input['columns'][7]['search']['value'] != '')
                $query->where('departments.name', 'like', "%".$input['columns'][7]['search']['value']."%");

           
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
      //  'dom'          => 'Brtip',
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
            'code'     => ['title' => trans('general.code')],
            'year'     => ['title' => trans('general.year')],
            'half_year'     => ['title' => trans('general.half_year')],
            'semester'     => ['title' => trans('general.semester')],
            'subject'     => [ 'name' => 'subjects.title', 'title' => trans('general.subject')],
            'teacher'     => [ 'name' => 'teachers.name', 'title' => trans('general.teacher')],
            'group'     => [ 'name' => 'groups.name', 'title' => trans('general.group')],
            //'students_count' => ['name' => 'students_count', 'title' => trans('general.students_count'), 'searchable' => false, 'orderable' => false],
            'department'    => ['name' => 'departments.name', 'title' => trans('general.department')],
            'university' => ['name' => 'universities.name', 'title' => trans('general.university')],
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