@extends('layouts.app')

@section('content')
    <div class="portlet box">        
        <div class="portlet-body">
            <!-- BEGIN FORM-->            
            {!! Form::model($subject, ['route' => ['subjects.update', $university, $department, $subject], 'method' => 'put', 'class' => 'form-horizontal']) !!}            
                <div class="form-body">
                    <div class="form-group {{ $errors->has('code') ? ' has-error' : '' }}">
                        {!! Form::label('code', trans('general.code'), ['class' => 'control-label col-sm-3']) !!}                                
                        <div class="col-sm-4">
                            {!! Form::text('code', null, ['class' => 'form-control ltr']) !!}     
                            @if ($errors->has('code'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('code') }}</strong>
                                </span>
                            @endif                                                                                                   
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                        {!! Form::label('title', trans('general.title'), ['class' => 'control-label col-sm-3']) !!}                                
                        <div class="col-sm-4">
                            {!! Form::text('title', null, ['class' => 'form-control']) !!}     
                            @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif                                                                                                   
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('title_eng') ? ' has-error' : '' }}">
                        {!! Form::label('title_eng', trans('general.title_eng'), ['class' => 'control-label col-sm-3']) !!}                                
                        <div class="col-sm-4">
                            {!! Form::text('title_eng', null, ['class' => 'form-control ltr']) !!}     
                            @if ($errors->has('title_eng'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title_eng') }}</strong>
                                </span>
                            @endif                                                                                                   
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('credits') ? ' has-error' : '' }}">
                        {!! Form::label('credits', trans('general.credits'), ['class' => 'control-label col-sm-3']) !!}                                
                        <div class="col-sm-4">
                            {!! Form::number('credits', null, ['class' => 'form-control ltr', 'step' => 'any', 'min' => 1, 'max' => 8]) !!}     
                            @if ($errors->has('credits'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('credits') }}</strong>
                                </span>
                            @endif                                                                                                   
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('semester') ? ' has-error' : '' }}">
                        {!! Form::label('semester', trans('general.semester'), ['class' => 'control-label col-sm-3']) !!}
                        <div class="col-sm-4">
                            {!! Form::number('semester', null, ['min' => '0','class' => 'form-control'])  !!}
                            @if ($errors->has('semester'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('semester') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('type') ? ' has-error' : '' }}">
                        {!! Form::label('type', trans('general.type'), ['class' => 'control-label col-sm-3']) !!}                                
                        <div class="col-sm-4">
                            {!! Form::select('type', [
                                'general' => trans('general.general'),
                                'core' => trans('general.core'),
                                'specialized' => trans('general.specialized'),
                                'profesional' => trans('general.profesional'),
                                'elective' => trans('general.elective'),
                            ], null, ['class' => 'form-control select2', 'placeholder' => trans('general.select')]) !!}     
                            @if ($errors->has('type'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('type') }}</strong>
                                </span>
                            @endif                                                                                                   
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                        {!! Form::label('status', trans('general.status'), ['class' => 'control-label col-sm-3']) !!}                                
                        <div class="col-sm-4">                 
                            <div >
                                <label class="checkbox-inline">
                                <input type="checkbox" name="active" value="1" {{ $subject->active ? 'checked' : '' }}> {{ trans('general.active') }}                               
                                </label>                                                       
                            </div>                                               
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-actions fluid">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn green">{{ trans('general.save') }}</button>
                            <a href="{{ route('subjects.index', [$university, $department]) }}" class="btn default">{{ trans('general.cancel') }}</a>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
            <!-- END FORM-->
        </div>
    </div>
@endsection