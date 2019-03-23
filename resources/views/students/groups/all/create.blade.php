@extends('layouts.app')

@section('content')
    <div class="portlet box">        
        <div class="portlet-body">
            <!-- BEGIN FORM-->     
            
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @else
                <div class="alert alert-info">
                    <p >نوت : {{trans('general.groups_automation_message')}}</p>
                </div>
            @endif
            {!! Form::open(['route' => 'student.groups.all.create', 'method' => 'post', 'class' => 'form-horizontal']) !!}
                <div class="form-body" id="app">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-1">
                            <div class="form-group {{ $errors->has('kankor_year') ? ' has-error' : '' }}">
                                {!! Form::label('kankor_year', trans('general.kankor_year'), ['class' => 'control-label col-sm-3']) !!}                                
                                <div class="col-sm-9">
                                    {!! Form::number('kankor_year', null, ['class' => 'form-control ltr', 'min' => 1390]) !!}
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
                <hr>
                <div class="form-actions fluid">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-6">
                            <button type="submit" class="btn green">{{ trans('general.save') }}</button>
                            <a href="{{ route('dropouts.index') }}" class="btn default">{{ trans('general.cancel') }}</a>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
            <!-- END FORM-->
        </div>
    </div>
@endsection('content')
