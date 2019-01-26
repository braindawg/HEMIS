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
                            {!! Form::model($teacher, ['route' => ['teachers.update', $teacher], 'method' => 'patch', 'class' => 'form-horizontal']) !!}            
                                <div class="form-body" id="app">
                                    <div class="row">
                                        @if(auth()->user()->allUniversities())
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('university') ? ' has-error' : '' }}">
                                                {!! Form::label('university', trans('general.university'), ['class' => 'control-label col-sm-3']) !!}                                
                                                <div class="col-sm-8">
                                                    {!! Form::select('university', $universities, $teacher->university_id, ['class' => 'form-control select2', 'placeholder' => trans('general.select')]) !!}
                                                    @if ($errors->has('university'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('university') }}</strong>
                                                        </span>
                                                    @endif                                                                                                   
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                            {!! Form::hidden('university', $teacher->university_id) !!}
                                        @endif
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('department') ? ' has-error' : '' }}">
                                                {!! Form::label('department', trans('general.department'), ['class' => 'control-label col-sm-3']) !!}
                                                <div class="col-sm-8">
                                                    {!! Form::select('department', $department, null, ['class' => 'form-control select2-ajax', 'remote-url' => route('api.departments')]) !!}
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
                                            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                                {!! Form::label('name', trans('general.name'), ['class' => 'control-label col-sm-3']) !!}
                                                <div class="col-sm-8">
                                                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                                                    @if ($errors->has('name'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('last_name') ? ' has-error' : '' }}">
                                                {!! Form::label('last_name', trans('general.last_name'), ['class' => 'control-label col-sm-3']) !!}
                                                <div class="col-sm-8">
                                                    {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
                                                    @if ($errors->has('last_name'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('last_name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('father_name') ? ' has-error' : '' }}">
                                                {!! Form::label('father_name', trans('general.father_name'), ['class' => 'control-label col-sm-3']) !!}
                                                <div class="col-sm-8">
                                                    {!! Form::text('father_name', null, ['class' => 'form-control']) !!}
                                                    @if ($errors->has('father_name'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('father_name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('grandfather_name') ? ' has-error' : '' }}">
                                                {!! Form::label('grandfather_name', trans('general.grandfather_name'), ['class' => 'control-label col-sm-3']) !!}
                                                <div class="col-sm-8">
                                                    {!! Form::text('grandfather_name', null, ['class' => 'form-control']) !!}
                                                    @if ($errors->has('grandfather_name'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('grandfather_name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('degree') ? ' has-error' : '' }}">
                                                {!! Form::label('degree', trans('general.degree'), ['class' => 'control-label col-sm-3']) !!}
                                                <div class="col-sm-8">
                                                    {!! Form::select('degree', ['bachelor' => trans('general.bachelor'),  'master' => trans('general.master'), 'doctor' => trans('general.doctor')], null, ['class' => 'form-control', 'placeholder' => trans('general.select')]) !!}
                                                    @if ($errors->has('degree'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('degree') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('academic_rank_id') ? ' has-error' : '' }}">
                                                {!! Form::label('academic_rank', trans('general.academic_rank'), ['class' => 'control-label col-sm-3']) !!}
                                                <div class="col-sm-8">
                                                    {!! Form::select('academic_rank_id', $teacher_academic_rank,$teacher->academic_rank_id, ['class' => 'form-control select2']) !!}
                                                    @if ($errors->has('academic_rank_id'))
                                                        <span class="help-block">
                                            <strong>{{ $errors->first('academic_rank_id') }}</strong>
                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('birthdate') ? ' has-error' : '' }}">
                                                {!! Form::label('birthdate', trans('general.birthdate'), ['class' => 'control-label col-sm-3']) !!}
                                                <div class="col-sm-8">
                                                    {!! Form::text('birthdate', null, ['class' => 'form-control ltr']) !!}
                                                    @if ($errors->has('birthdate'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('birthdate') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('marital_status') ? ' has-error' : '' }}">
                                                {!! Form::label('marital_status', trans('general.marital_status'), ['class' => 'control-label col-sm-3']) !!}
                                                <div class="col-sm-8">
                                                    {!! Form::select('marital_status', ['married' => trans('general.married'),  'single' => trans('general.single')], null, ['class' => 'form-control', 'placeholder' => trans('general.select')]) !!}
                                                    @if ($errors->has('marital_status'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('marital_status') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('province') ? ' has-error' : '' }}">
                                                {!! Form::label('province', trans('general.province'), ['class' => 'control-label col-sm-3']) !!}
                                                <div class="col-sm-8">
                                                    {!! Form::select('province', $provinces, null, ['class' => 'form-control']) !!}
                                                    @if ($errors->has('province'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('province') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">                        
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                                                {!! Form::label('phone', trans('general.phone'), ['class' => 'control-label col-sm-3']) !!}
                                                <div class="col-sm-8">
                                                    {!! Form::text('phone', null, ['class' => 'form-control ltr']) !!}
                                                    @if ($errors->has('phone'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('phone') }}</strong>
                                                        </span>
                                                    @endif                                                                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                                {!! Form::label('email', trans('general.email'), ['class' => 'control-label col-sm-3']) !!}
                                                <div class="col-sm-8">
                                                    {!! Form::text('email', null, ['class' => 'form-control ltr']) !!}
                                                    @if ($errors->has('email'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif                                                                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">                        
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                                {!! Form::label('password', trans('general.password'), ['class' => 'control-label col-sm-3']) !!}
                                                <div class="col-sm-8">
                                                    {!! Form::text('password', null, ['class' => 'form-control ltr']) !!}
                                                    @if ($errors->has('password'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('password') }}</strong>
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
                                            <button type="submit" class="btn green">{{ trans('general.save') }}</button>
                                            <a href="{{ route('teachers.index') }}" class="btn default">{{ trans('general.cancel') }}</a>
                                        </div>
                                    </div>
                                </div>                            
                                {!! Form::close() !!}
                            <!-- END FORM-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PROFILE CONTENT -->
    </div>
</div>
<!-- END PAGE BASE CONTENT -->
    
@endsection('content')

@push('styles')
    <link href="{{ asset('css/profile-rtl.min.css') }}" rel="stylesheet">     
@endpush

@push('scripts')
<script>
    $(function () {
        $('.select2').change(function () {
            $('.select2-ajax').val(null).trigger('change');
        })
    })
</script>
@endpush