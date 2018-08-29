@extends('layouts.app')

@section('content')
    <div class="portlet box">        
        <div class="portlet-body">
            <!-- BEGIN FORM-->            
            {!! Form::model($department, ['route' => ['departments.update', $university, $department], 'method' => 'patch', 'class' => 'form-horizontal']) !!}            
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