@extends('layouts.app')


@section('content')
    <div class="portlet box">        
        <div class="portlet-body">
            <!-- BEGIN FORM-->     
             {!! Form::model($leave, ['route' => ['leaves.update', $leave], 'method' => 'patch', 'class' => 'form-horizontal']) !!}                 
           
                <div class="form-body" id="app">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-1">
                            <div class="form-group {{ $errors->has('student_id') ? ' has-error' : '' }}">
                                {!! Form::label('student_id', trans('general.student'), ['class' => 'control-label col-sm-3']) !!}                                
                                <div class="col-sm-9">
                                    {!! Form::select('student_id', $student , null, ['class' => 'form-control select2-students']) !!}
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
                                {!! Form::label('last_name', trans('general.leave_year'), ['class' => 'control-label col-sm-3']) !!}
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
                            <div class="form-group {{ $errors->has('semester') ? ' has-error' : '' }}">
                                {!! Form::label('semester', trans('general.semester'), ['class' => 'control-label col-sm-3']) !!}
                                <div class="col-sm-9">
                                    {!! Form::number('semester', null, ['class' => 'form-control', 'min' => '1', 'max' => "8"]) !!}
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
                    <div class="col-md-6 col-md-offset-1">
                        <div class="form-group {{ $errors->has('end_leave') ? ' has-error' : '' }}">
                            {!! Form::label('end_leave', trans('general.end_leave'), ['class' => 'control-label col-sm-3']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('end_leave', null , ['class' => 'form-control']) !!}
                                @if ($errors->has('end_leave'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('end_leave') }}</strong>
                                        </span>
                                @endif
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


@push('scripts')
<script src="https://code.jquery.com/jquery-3.3.1.js" type="text/javascript"></script>
    
@endpush



