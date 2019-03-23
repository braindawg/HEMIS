@extends('layouts.app')

@section('content')
    <div class="portlet box">        
        <div class="portlet-body">
            <!-- BEGIN FORM-->            
            {!! Form::model($department, ['route' => ['departments.update', $university, $department], 'method' => 'patch', 'class' => 'form-horizontal']) !!}            
                <div class="form-body">
                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        {!! Form::label('name', trans('general.name'), ['class' => 'control-label col-sm-3']) !!}                                
                        <div class="col-sm-4">
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}     
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif                                                                                                   
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('chairman') ? ' has-error' : '' }}">
                        {!! Form::label('chairman', trans('general.faculty_chairman'), ['class' => 'control-label col-sm-3']) !!}                                
                        <div class="col-sm-4">
                            {!! Form::text('chairman', null, ['class' => 'form-control']) !!}     
                            @if ($errors->has('chairman'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('chairman') }}</strong>
                                </span>
                            @endif                                                                                                   
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('department_student_affairs') ? ' has-error' : '' }}">
                        {!! Form::label('department_student_affairs', trans('general.department_student_affairs'), ['class' => 'control-label col-sm-3']) !!}                                
                        <div class="col-sm-4">
                            {!! Form::text('department_student_affairs', null, ['class' => 'form-control']) !!}     
                            @if ($errors->has('department_student_affairs'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('department_student_affairs') }}</strong>
                                </span>
                            @endif                                                                                                   
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('faculty') ? ' has-error' : '' }}">
                        {!! Form::label('faculty', trans('general.faculty'), ['class' => 'control-label col-sm-3']) !!}                                
                        <div class="col-sm-4">
                            {!! Form::text('faculty', null, ['class' => 'form-control']) !!}     
                            @if ($errors->has('faculty'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('faculty') }}</strong>
                                </span>
                            @endif                                                                                                   
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('grade_id') ? ' has-error' : '' }}">
                        {!! Form::label('grade_id', trans('general.grade'), ['class' => 'control-label col-sm-3']) !!}                                
                        <div class="col-sm-4">
                            {!! Form::select('grade_id', $grades, null, ['class' => 'form-control select2', 'placeholder' => trans('general.select')]) !!}
                            @if ($errors->has('grade_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('grade_id') }}</strong>
                                </span>
                            @endif                                                                                                   
                        </div>
                    </div>
                </div>
                <div class="form-actions fluid">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn green">{{ trans('general.save') }}</button>
                            <a href="{{ route('departments.index', $university) }}" class="btn default">{{ trans('general.cancel') }}</a>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
            <!-- END FORM-->
        </div>
    </div>
@endsection('content')