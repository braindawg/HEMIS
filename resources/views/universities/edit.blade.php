@extends('layouts.app')

@section('content')
    <div class="portlet box">        
        <div class="portlet-body">
            <!-- BEGIN FORM-->            
            {!! Form::model($university, ['route' => ['universities.update', $university], 'method' => 'patch', 'class' => 'form-horizontal']) !!}            
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
                    <div class="form-group {{ $errors->has('domain') ? ' has-error' : '' }}">
                        {!! Form::label('domain', trans('general.domain'), ['class' => 'control-label col-sm-3']) !!}                                
                        <div class="col-sm-4">
                            {!! Form::text('domain', null, ['class' => 'form-control ltr', 'disabled']) !!}     
                            @if ($errors->has('domain'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('domain') }}</strong>
                                </span>
                            @endif                                                                                                   
                        </div>
                    </div>
                </div>
                <div class="form-actions fluid">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn green">{{ trans('general.save') }}</button>
                            <a href="{{ route('universities.index') }}" class="btn default">{{ trans('general.cancel') }}</a>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
            <!-- END FORM-->
        </div>
    </div>
@endsection('content')