@extends('layouts.app')

@section('content')
    <!-- BEGIN PAGE BASE CONTENT -->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN PROFILE SIDEBAR -->
            <div class="profile-sidebar">
            </div>
            <!-- END BEGIN PROFILE SIDEBAR -->
            <!-- BEGIN PROFILE CONTENT -->
            <div class="profile-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet box">
                            <div class="portlet-body">
                                <!-- BEGIN FORM-->
                                {!! Form::model($course, ['route' => ['courses.update', $course], 'method' => 'patch', 'class' => 'form-horizontal']) !!}
                                <div class="form-body" id="app">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('code') ? ' has-error' : '' }}">
                                                {!! Form::label('code', trans('general.code'), ['class' => 'control-label col-sm-3']) !!}
                                                <div class="col-sm-8">
                                                    {!! Form::text('code', null, ['class' => 'form-control']) !!}
                                                    @if ($errors->has('code'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('code') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('department') ? ' has-error' : '' }}">
                                                {!! Form::label('department', trans('general.department'), ['class' => 'control-label col-sm-3']) !!}
                                                <div class="col-sm-8">
                                                    {!! Form::select('department',$department, null, ['class' => 'form-control select2-ajax', 'remote-url' => route('api.departments')]) !!}
                                                    @if ($errors->has('department'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('department') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('year') ? ' has-error' : '' }}">
                                                {!! Form::label('year', trans('general.year'), ['class' => 'control-label col-sm-3']) !!}
                                                <div class="col-sm-8">
                                                    {!! Form::text('year', null, ['class' => 'form-control']) !!}
                                                    @if ($errors->has('year'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('year') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('half_year') ? ' has-error' : '' }}">
                                                {!! Form::label('half_year', trans('general.half_year'), ['class' => 'control-label col-sm-3']) !!}
                                                <div class="col-sm-8">
                                                    {!! Form::select('half_year', ['spring' => trans('general.spring'),  'fall' => trans('general.fall')], null, ['class' => 'form-control']) !!}
                                                    @if ($errors->has('half_year'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('half_year') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('semester') ? ' has-error' : '' }}">
                                                {!! Form::label('semester', trans('general.semester'), ['class' => 'control-label col-sm-3']) !!}
                                                <div class="col-sm-8">
                                                    {!! Form::number('semester', null, ['min' => '0','class' => 'form-control'])  !!}
                                                    @if ($errors->has('semester'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('semester') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('subject') ? ' has-error' : '' }}">
                                                {!! Form::label('subject', trans('general.subject'), ['class' => 'control-label col-sm-3']) !!}
                                                <div class="col-sm-8">
                                                    {!! Form::select('subject', $subjects, null, ['class' => 'form-control select2']) !!}
                                                    @if ($errors->has('subject'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('subject') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('teacher') ? ' has-error' : '' }}">
                                                {!! Form::label('teacher', trans('general.teacher'), ['class' => 'control-label col-sm-3']) !!}
                                                <div class="col-sm-8">
                                                    {!! Form::select('teacher', $teachers, null, ['class' => 'form-control select2 ']) !!}
                                                    @if ($errors->has('teacher'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('teacher') }}</strong>
                                                         </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('group') ? ' has-error' : '' }}">
                                                {!! Form::label('group', trans('general.group'), ['class' => 'control-label col-sm-3']) !!}
                                                <div class="col-sm-8">
                                                    {!! Form::select('group', $groups, null, ['class' => 'form-control select2']) !!}
                                                    @if ($errors->has('group'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('group') }}</strong>
                                                         </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-actions fluid">
                                        <div class="row">
                                            <div class="col-md-offset-2 col-md-8">
                                                <button type="submit"
                                                        class="btn green">{{ trans('general.save') }}</button>
                                                <a href="{{ route('courses.index') }}"
                                                   class="btn default">{{ trans('general.cancel') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END PROFILE CONTENT -->
            </div>
        </div>
    </div>
    <!-- END PAGE BASE CONTENT -->

@endsection('content')