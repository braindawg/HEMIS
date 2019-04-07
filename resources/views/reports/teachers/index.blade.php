@extends('layouts.app')

@section('content')
    <div class="portlet box">        
        <div class="portlet-body">
            <!-- BEGIN FORM-->            
            {!! Form::open(['route' => 'report.teacher.create', 'method' => 'post', 'class' => 'form-horizontal' , 'target' => 'new']) !!}
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
                                    {!! Form::select('department', $department, null, ['class' => 'form-control select2-ajax',  'placeholder' => trans('general.select'), 'remote-url' => route('api.departments')]) !!}
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
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                                <div class="form-group {{ $errors->has('gender') ? ' has-error' : '' }}">
                                    {!! Form::label('gender', trans('general.gender'), ['class' => 'control-label col-sm-3']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::select('gender', ['Male' => trans('general.Male'),  'Female' => trans('general.Female')], null, ['class' => 'form-control select2', 'placeholder' => trans('general.select')]) !!}
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

                    <div class = "row">
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('academic_rank_id') ? ' has-error' : '' }}">
                                {!! Form::label('academic_rank_id', trans('general.academic_rank'), ['class' => 'control-label col-sm-3']) !!}
                                <div class="col-sm-8">
                                    {!! Form::select('academic_rank_id', $teacher_academic_rank, null, ['class' => 'form-control ', 'placeholder' => trans('general.select')]) !!}
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
                            <div class="form-group {{ $errors->has('type') ? ' has-error' : '' }}">
                                {!! Form::label('type', trans('general.type'), ['class' => 'control-label col-sm-3']) !!}
                                <div class="col-sm-8">
                                    {!! Form::select('type', ['permanent' => trans('general.permanent'),  'temporary' => trans('general.temporary') , 'honorary' => trans('general.honorary')], null, ['class' => 'form-control', 'placeholder' => trans('general.select')]) !!}
                                    @if ($errors->has('type'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('type') }}</strong>
                                        </span>
                                    @endif
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