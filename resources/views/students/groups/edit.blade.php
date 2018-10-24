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
                            {!! Form::model($group, ['route' => ['groups.update', $group], 'method' => 'patch', 'class' => 'form-horizontal']) !!}            
                                <div class="form-body" id="app">
                                    <div class="row">
                                        @if(auth()->user()->allUniversities())
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('university') ? ' has-error' : '' }}">
                                                {!! Form::label('university', trans('general.university'), ['class' => 'control-label col-sm-3']) !!}                                
                                                <div class="col-sm-8">
                                                    {!! Form::select('university', $universities, $group->university_id, ['class' => 'form-control select2', 'placeholder' => trans('general.select')]) !!}
                                                    @if ($errors->has('university'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('university') }}</strong>
                                                        </span>
                                                    @endif                                                                                                   
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                            {!! Form::hidden('university', $group->university_id) !!}
                                        @endif
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('department') ? ' has-error' : '' }}">
                                                {!! Form::label('department', trans('general.department'), ['class' => 'control-label col-sm-3']) !!}                                
                                                <div class="col-sm-8">
                                                    {!! Form::select('department', $department, null, ['class' => 'form-control select2-ajax', 'remote-url' => route('api.departments'), 'remote-param' => '[name="university"]']) !!}
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
                                    </div>
                                    <div class="row">                                       
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                                                {!! Form::label('description', trans('general.description'), ['class' => 'control-label col-sm-3']) !!}
                                                <div class="col-sm-8">
                                                    {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 3]) !!}
                                                    @if ($errors->has('description'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('description') }}</strong>
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
                                        <div class="col-md-offset-2 col-md-8">
                                            <button type="submit" class="btn green">{{ trans('general.save') }}</button>
                                            <a href="{{ route('groups.index') }}" class="btn default">{{ trans('general.cancel') }}</a>
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