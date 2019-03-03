@extends('layouts.app')

@section('content')
<div class="row">
    <div class ="col-md-12">
        <div class="portlet">         
            <div class="portlet-title">  
                <div class="" style ="margin-right:15px">
                    <h3>{{trans('general.new_time')}}</h3>  
                </div>
                <hr>
                <div class="portlet-body form">
                {!! Form::model($coursetime, ['route' => ['course.time.update', $course, $coursetime], 'method' => 'post', 'class' => 'form-horizontal', 'files' => true]) !!}                   
                    <div class="form-body" id="app">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-1">
                            <div class="form-group {{ $errors->has('day') ? ' has-error' : '' }}">
                                {!! Form::label('day', trans('general.day'), ['class' => 'control-label col-sm-3']) !!}                                
                                <div class="col-sm-9">
                                    {!! Form::select('day', $days, $coursetime->day_id, ['class' => 'form-control select2']) !!}
                                    @if ($errors->has('day'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('day') }}</strong>
                                        </span>
                                    @endif                                                                                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-1">
                            <div class="form-group {{ $errors->has('time') ? ' has-error' : '' }}">
                                {!! Form::label('time', trans('general.time'), ['class' => 'control-label col-sm-3']) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('time', null, ['class' => 'form-control ltr']) !!}
                                    @if ($errors->has('time'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('time') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-1">
                            <div class="form-group {{ $errors->has('location') ? ' has-error' : '' }}">
                                {!! Form::label('location', trans('general.location'), ['class' => 'control-label col-sm-3']) !!}                                
                                <div class="col-sm-9">
                                    {!! Form::text('location', null, ['class' => 'form-control', 'rows' => 3]) !!}
                                    @if ($errors->has('location'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('location') }}</strong>
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
                            <button type="submit" class="btn green">{{ trans('general.save') }}</button>
                            <a href="{{ route('courses.index') }}" class="btn default">{{ trans('general.cancel') }}</a>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
                </div>
            </div>  
        </div>
    </div>
</div>
@endsection