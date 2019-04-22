@extends('layouts.app')

@section('content')
    <div class="portlet box">        
        <div class="portlet-body">
            <!-- BEGIN FORM-->            
            {!! Form::open(['route' => 'report.student.create', 'method' => 'post', 'class' => 'form-horizontal' , 'target' => 'new']) !!}
                <div class="form-body" id="app">
                    <div class="row">
                        @if(auth()->user()->allUniversities())
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('university') ? ' has-error' : '' }}">
                                    {!! Form::label('university', trans('general.university'), ['class' => 'control-label col-sm-3']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::select('university', $universities, null, ['class' => 'form-control select2', 'placeholder' => trans('general.select')]) !!}
                                        @if ($errors->has('university'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('university') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @else
                            {!! Form::hidden('university', auth()->user()->university_id) !!}
                        @endif
                    </div>
                    <div class="row">
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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('province') ? ' has-error' : '' }}">
                                {!! Form::label('province', trans('general.province'), ['class' => 'control-label col-sm-3']) !!}
                                <div class="col-sm-8">
                                    {!! Form::select('province', $provinces, null, ['class' => 'form-control select2 ' ,'placeholder' => trans('general.select')]) !!}
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
                            <div class="form-group {{ $errors->has('kankor_year') ? ' has-error' : '' }}">
                                {!! Form::label('kankor_year', trans('general.kankor_year'), ['class' => 'control-label col-sm-3']) !!}
                                <div class="col-sm-8">
                                    {!! Form::select('kankor_year', $kankor_years, null, ['class' => 'form-control select2 ', 'placeholder' => trans('general.select')]) !!}
                                    @if ($errors->has('kankor_year'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('kankor_year') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                                {!! Form::label('status', trans('general.status'), ['class' => 'control-label col-sm-3']) !!}
                                <div class="col-sm-8">
                                    {!! Form::select('status', $statuses, null, ['class' => 'form-control select2 ', 'placeholder' => trans('general.select')]) !!}
                                    @if ($errors->has('status'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('status') }}</strong>
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
                                <div class="col-sm-8">
                                    {!! Form::select('grade', $grades, null, ['class' => 'form-control select2 ', 'placeholder' => trans('general.select')]) !!}
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
                                <div class="form-group {{ $errors->has('gender') ? ' has-error' : '' }}">
                                    {!! Form::label('gender', trans('general.gender'), ['class' => 'control-label col-sm-3']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::select('gender', ['male' => trans('general.Male'),  'female' => trans('general.Female')], null, ['class' => 'form-control select2', 'placeholder' => trans('general.select')]) !!}
                                        @if ($errors->has('gender'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('gender') }}</strong>
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
                            <button type="submit" class="btn green" >{{ trans('general.generate_report') }}</button>
                            <a href="{{ route('noticeboard') }}" class="btn default">{{ trans('general.cancel') }}</a>
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