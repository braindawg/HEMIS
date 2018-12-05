@extends('layouts.app')

@section('content')   
    <div class="portlet light bordered">
        <div class="portlet-title" style="border: 0">            
           
            <a href="{{ route('groups.index') }}" class="btn btn-default"><i class="icon-arrow-right"></i> {{ trans('general.back') }}</a>            
          
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
                    @can('group-remove-student')
                    <th>{{ trans('general.delete') }}</th>
                    @endcan
                </tr>
                @foreach($group->students as $student)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $student->form_no }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->father_name }}</td>
                    <td>{{ $student->kankor_year }}</td>
                    @can('group-remove-student')
                    <td>
                        {!! Form::open(['route' => ['groups.student.remove', $group], 'method' => 'delete', 'class' => 'form-horizontal']) !!}
                            <input type="hidden" name="student_id" value="{{ $student->id }}">
                            <button type="submit" class="btn btn-xs btn-danger" onClick="doConfirm()"><i class="fa fa-remove"></i></button>
                        {!! Form::close() !!}
                    </td>
                    @endcan
                </tr>
                @endforeach
            </table>
        </div>
    </div>

    @can('group-add-student')
    <div class="row">
        <div class="col-md-6">
            <div class="portlet box">
                <div class="portlet-title" style="color: #000">
                   <h4>{{ trans('general.add_student_individually') }}</h4>
                </div>
                <div class="portlet-body">
                    <!-- BEGIN FORM-->            
                    {!! Form::open(['route' => ['groups.student.add', $group], 'method' => 'post', 'class' => 'form-horizontal']) !!}
                        <div class="form-body" id="app">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('student_id') ? ' has-error' : '' }}">
                                        {!! Form::label('student_id', trans('general.new_student'), ['class' => 'control-label col-sm-3']) !!}                                
                                        <div class="col-sm-7">
                                            {!! Form::select('student_id', [], null, ['class' => 'form-control select2-students', 'placeholder' => trans('general.select')]) !!}
                                            @if ($errors->has('student_id'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('student_id') }}</strong>
                                                </span>
                                            @endif                                                                                                   
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions fluid">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-6">
                                    <button type="submit" class="btn green">{{ trans('general.add') }}</button>
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
                    <!-- END FORM-->
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="portlet box">
                <div class="portlet-title" style="color: #000">
                   <h4>{{ trans('general.add_student_by_department') }}</h4>
                </div>
                <div class="portlet-body">
                    <!-- BEGIN FORM-->            
                    {!! Form::open(['route' => ['groups.student.add', $group], 'method' => 'post', 'class' => 'form-horizontal']) !!}
                        <div class="form-body" id="app">
                            {!! Form::hidden('university', $group->university_id) !!}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('department_id') ? ' has-error' : '' }}">
                                        {!! Form::label('department_id', trans('general.department'), ['class' => 'control-label col-sm-3']) !!}                                
                                        <div class="col-sm-7">
                                            {!! Form::select('department_id', $department, null, ['class' => 'form-control select2-ajax', 'remote-url' => route('api.departments'), 'remote-param' => '[name="university"]']) !!}
                                            @if ($errors->has('department_id'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('department_id') }}</strong>
                                                </span>
                                            @endif                                                                                                   
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('kankor_year') ? ' has-error' : '' }}">
                                        {!! Form::label('kankor_year', trans('general.kankor_year'), ['class' => 'control-label col-sm-3']) !!}
                                        <div class="col-sm-7">
                                            {!! Form::number('kankor_year', null, ['class' => 'form-control ltr']) !!}
                                            @if ($errors->has('kankor_year'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('kankor_year') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions fluid">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-7">
                                <button type="submit" class="btn green">{{ trans('general.add') }}</button>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                    <!-- END FORM-->
                </div>
            </div>

        </div>
    </div>
    @endcan

@endsection