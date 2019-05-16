@extends('layouts.app')

@section('content')
    <div class="portlet box">
        <div class="portlet-body">
            <!-- BEGIN FORM-->
            {!! Form::open(['route' => 'courses.store', 'method' => 'post', 'class' => 'form-horizontal']) !!}
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
                                    {!! Form::select('department',$departments, null, ['class' => 'form-control select2']) !!}
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
                                    {!! Form::select('subject',$subject, null, ['class' => 'form-control select2-subjects', 'remote-url' => route('api.subjects'), 'remote-param' => 'select[name="department"]']) !!}
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
                            <div class="form-group {{ $errors->has('groups') ? ' has-error' : '' }}">
                                {!! Form::label('groups', trans('general.group'), ['class' => 'control-label col-sm-3']) !!}
                                <div class="col-sm-8">
                                    {!! Form::select('groups[]', $groups, null, ['class' => 'form-control select2-groups', 'multiple' => 'multiple']) !!}
                                    @if ($errors->has('groups'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('groups') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row ">
                        <div class="col-md-6 col-md-offset-2">
                            <div>
                                <label class="checkbox-inline" >
                                    <input type="checkbox" name="next" value="1" checked>{{ trans('general.next') }}
                                </label>
                            </div>
                        </div>
                    </div>                    
                </div>
                <br>
                <div class="form-actions fluid">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-8">
                            <button type="submit" class="btn green">{{ trans('general.save') }}</button>
                            <a href="{{ route('courses.index') }}"
                               class="btn default">{{ trans('general.cancel') }}</a>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection('content')
