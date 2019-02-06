@extends('layouts.app')

@section('content')
    <div class="portlet box">        
        <div class="portlet-body">
            <!-- BEGIN FORM-->            
            {!! Form::open(['route' => 'leaves.store', 'method' => 'post', 'class' => 'form-horizontal']) !!}
                <div class="form-body" id="app">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-1">
                            <div class="form-group {{ $errors->has('student_id') ? ' has-error' : '' }}">
                                {!! Form::label('student_id', trans('general.student'), ['class' => 'control-label col-sm-3']) !!}                                
                                <div class="col-sm-9">
                                    {!! Form::select('student_id',[], null, ['class' => 'form-control select2-students']) !!}
                                    @if ($errors->has('student_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('student_id') }}</strong>
                                        </span>
                                    @endif                                                                                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-1">
                            <div class="form-group {{ $errors->has('leave_year') ? ' has-error' : '' }}">
                                {!! Form::label('year', trans('general.leave_year'), ['class' => 'control-label col-sm-3']) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('leave_year', null, ['class' => 'form-control']) !!}
                                    @if ($errors->has('leave_year'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('leave_year') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-1">
                            <div class="form-group {{ $errors->has('semister') ? ' has-error' : '' }}">
                                {!! Form::label('semister', trans('general.semister'), ['class' => 'control-label col-sm-3']) !!}
                                <div class="col-sm-9">
                                    {!! Form::number('semister', null, ['class' => 'form-control', 'min' => '1', 'max' => "8"]) !!}
                                    @if ($errors->has('semister'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('semister') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-1">
                            <div class="form-group {{ $errors->has('note') ? ' has-error' : '' }}">
                                {!! Form::label('note', trans('general.note'), ['class' => 'control-label col-sm-3']) !!}                                
                                <div class="col-sm-9">
                                    {!! Form::textarea('note', null, ['class' => 'form-control', 'rows' => 3]) !!}
                                    @if ($errors->has('note'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('note') }}</strong>
                                        </span>
                                    @endif                                                                                                   
                                </div>
                            </div>
                        </div>
                    </div>              
                </div>
                <hr>
                <div class="form-actions fluid">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-6">
                            <button type="submit" class="btn green">{{ trans('general.save') }}</button>
                            <a href="{{ route('leaves.index') }}" class="btn default">{{ trans('general.cancel') }}</a>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
            <!-- END FORM-->
        </div>
    </div>
@endsection('content')