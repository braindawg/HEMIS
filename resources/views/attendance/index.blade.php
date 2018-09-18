@extends('layouts.app')

@section('content')
    <div class="portlet box">        
        <div class="portlet-body">
            <!-- BEGIN FORM-->            
            {!! Form::open(['route' => 'attendance.show', 'method' => 'get', 'class' => 'form-horizontal', 'target' => 'new']) !!}            
                <div class="form-body" id="app">
                    <div class="row">
                        @if(auth()->user()->allUniversities())
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('university') ? ' has-error' : '' }}">
                                {!! Form::label('university', trans('general.university'), ['class' => 'control-label col-sm-3']) !!}                                
                                <div class="col-sm-9">
                                    {!! Form::select('university', $universities, null, ['class' => 'form-control select2']) !!}
                                    @if ($errors->has('university'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('university') }}</strong>
                                        </span>
                                    @endif                                                                                                   
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('department') ? ' has-error' : '' }}">
                                {!! Form::label('department', trans('general.department'), ['class' => 'control-label col-sm-3']) !!}                                
                                <div class="col-sm-9">
                                    {!! Form::select('department', [], null, ['class' => 'form-control select2-ajax', 'remote-url' => route('api.departments'), 'remote-param' => 'select[name="university"]']) !!}
                                    @if ($errors->has('department'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('department') }}</strong>
                                        </span>
                                    @endif                                                                                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">                        
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('hours') ? ' has-error' : '' }}">
                                {!! Form::label('hours', trans('general.hours'), ['class' => 'control-label col-sm-3']) !!}                                
                                <div class="col-sm-9">
                                    {!! Form::number('hours', 16, ['class' => 'form-control ltr', 'min' => 1, 'max' => '20']) !!}     
                                    @if ($errors->has('hours'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('hours') }}</strong>
                                        </span>
                                    @endif                                                                                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">                        
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('grade') ? ' has-error' : '' }}">
                                {!! Form::label('grade', trans('general.grade'), ['class' => 'control-label col-sm-3']) !!}                                
                                <div class="col-sm-9">
                                    {!! Form::text('grade', null, ['class' => 'form-control']) !!}     
                                    @if ($errors->has('grade'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('grade') }}</strong>
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
                                <div class="col-sm-9">
                                    {!! Form::text('semester', null, ['class' => 'form-control']) !!}     
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
                                <div class="col-sm-9">
                                    {!! Form::text('subject', null, ['class' => 'form-control']) !!}     
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
                                <div class="col-sm-9">
                                    {!! Form::text('teacher', null, ['class' => 'form-control']) !!}     
                                    @if ($errors->has('teacher'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('teacher') }}</strong>
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
                        <div class="col-md-offset-2 col-md-9">
                            <button type="submit" class="btn green">{{ trans('general.print') }}</button>
                            <a href="{{ route('students.index') }}" class="btn default">{{ trans('general.cancel') }}</a>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
            <!-- END FORM-->
        </div>
    </div>
@endsection('content')

@push('scripts')
<script>
    $(function () {
        $('.select2').change(function () {
            $('.select2-ajax').val(null).trigger('change');
        })
    })
</script>
@endpush