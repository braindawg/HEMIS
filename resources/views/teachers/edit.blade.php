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
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('university') ? ' has-error' : '' }}">
                                                {!! Form::label('university', trans('general.university'), ['class' => 'control-label col-sm-3']) !!}                                
                                                <div class="col-sm-9">
                                                    {!! Form::select('university', $universities, $teacher->university_id, ['class' => 'form-control select2 editable']) !!}
                                                    @if ($errors->has('university'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('university') }}</strong>
                                                        </span>
                                                    @endif                                                                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('department') ? ' has-error' : '' }}">
                                                {!! Form::label('department', trans('general.department'), ['class' => 'control-label col-sm-3']) !!}                                
                                                <div class="col-sm-9">
                                                    {!! Form::select('department', $teacher->department()->pluck('name', 'id'), null, ['class' => 'form-control select2-ajax editable', 'remote-url' => route('api.departments'), 'remote-param' => 'select[name="university"]']) !!}
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
                            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                {!! Form::label('name', trans('general.name'), ['class' => 'control-label col-sm-3']) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('first_name', null, ['class' => 'form-control editable']) !!}
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
                                <div class="col-sm-9">
                                    {!! Form::text('last_name', null, ['class' => 'form-control editable']) !!}
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
                                <div class="col-sm-9">
                                    {!! Form::text('father_name', null, ['class' => 'form-control editable']) !!}
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
                                <div class="col-sm-9">
                                    {!! Form::text('grandfather_name', null, ['class' => 'form-control editable']) !!}
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
                                <div class="col-sm-9">
                                    {!! Form::select('degree', ['bachelor' => trans('general.bachelor'),  'master' => trans('general.master'), 'doctor' => trans('general.doctor')], null, ['class' => 'form-control editable', 'placeholder' => trans('general.select')]) !!}
                                    @if ($errors->has('degree'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('degree') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('province') ? ' has-error' : '' }}">
                                {!! Form::label('province', trans('general.province'), ['class' => 'control-label col-sm-3']) !!}
                                <div class="col-sm-9">
                                    {!! Form::select('province', $provinces, null, ['class' => 'form-control editable']) !!}
                                    @if ($errors->has('province'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('province') }}</strong>
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
                                <div class="col-sm-9">
                                    {!! Form::text('birthdate', null, ['class' => 'form-control editable']) !!}
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
                                <div class="col-sm-9">
                                    {!! Form::select('marital_status', ['married' => trans('general.married'),  'single' => trans('general.single')], null, ['class' => 'form-control editable', 'placeholder' => trans('general.select')]) !!}
                                    @if ($errors->has('marital_status'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('marital_status') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">                        
                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                                {!! Form::label('phone', trans('general.phone'), ['class' => 'control-label col-sm-4']) !!}
                                <div class="col-sm-8">
                                    {!! Form::text('phone', null, ['class' => 'form-control editable']) !!}
                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif                                                                                                   
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                {!! Form::label('email', trans('general.email'), ['class' => 'control-label col-sm-4']) !!}
                                <div class="col-sm-8">
                                    {!! Form::text('email', null, ['class' => 'form-control editable']) !!}
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif                                                                                                   
                                </div>
                            </div>
                        </div>
                    </div>
                <hr>
                <div class="form-actions fluid">
                    <div class="row">
                    <div class="col-md-offset-1 col-md-9">
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
        $("input:not(.editable), select, .select2").each(function(){ 
            if ($(this).val() != '') {
                $(this).attr('readonly', 'readonly')
            }
        });
        $('.select2').change(function () {
            $('.select2-ajax').val(null).trigger('change');
        })
    })
</script>
@endpush