@extends('layouts.app')

@section('content')
    <div class="portlet light bordered">
        <div class="portlet-title" style="border: 0">

            <a href="{{ route('courses.index') }}" class="btn btn-default"><i class="icon-arrow-right"></i> {{ trans('general.back') }}</a>
            <a href="{{ route('course.attendance.print', $course ) }}" class="btn btn-default" target="new"><i class="fa fa-print"></i> {{ trans('general.print_attendance') }}</a>
            <a href="{{ route('course.scoresSheet.print', $course ) }}" class="btn btn-default" target="new"><i class="fa fa-print"></i> {{ trans('general.print_scores_sheet') }}</a>

            <div class="tools"> </div>
        </div>
        <div class="portlet-body">
            <table class="table">
                <tr>
                    <th style="width: 60px">شماره</th>
                    <th>{{ trans('general.kankor_id') }}</th>
                    <th>{{ trans('general.name') }}</th>
                    <th>{{ trans('general.father_name') }}</th>
                    <th>{{ trans('general.kankor_year') }}</th>
                    <th>{{ trans('general.delete') }}</th>
                </tr>
                @foreach($course->students as $student)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $student->form_no }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->father_name }}</td>
                        <td>{{ $student->kankor_year }}</td>
                        <td>
                            {!! Form::open(['route' => ['attendance.student.remove', $course], 'method' => 'delete', 'class' => 'form-horizontal']) !!}
                            <input type="hidden" name="student_id" value="{{ $student->id }}">
                            <button type="submit" class="btn btn-xs btn-danger" onClick="doConfirm()"><i class="fa fa-remove"></i></button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection