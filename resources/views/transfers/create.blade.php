@extends('layouts.app')

@section('content')
    <div class="portlet box">        
        <div class="portlet-body">
            <!-- BEGIN FORM-->            
            {!! Form::open(['route' => 'transfers.store', 'method' => 'post', 'class' => 'form-horizontal', 'target' => 'new']) !!}            
                <div class="form-body" id="app">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-1">
                            <div class="form-group {{ $errors->has('student_id') ? ' has-error' : '' }}">
                                {!! Form::label('student_id', trans('general.student'), ['class' => 'control-label col-sm-3']) !!}                                
                                <div class="col-sm-9">
                                    {!! Form::select('student_id', [], null, ['class' => 'form-control select2-students']) !!}
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
                            <div class="form-group {{ $errors->has('university_id') ? ' has-error' : '' }}">
                                {!! Form::label('university_id', trans('general.university'), ['class' => 'control-label col-sm-3']) !!}                                
                                <div class="col-sm-9">
                                    {!! Form::select('university_id', $universities, null, ['class' => 'form-control select2', 'placeholder' => trans('general.select')]) !!}
                                    @if ($errors->has('university_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('university_id') }}</strong>
                                        </span>
                                    @endif                                                                                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">                       
                        <div class="col-md-6 col-md-offset-1">
                            <div class="form-group {{ $errors->has('department_id') ? ' has-error' : '' }}">
                                {!! Form::label('department_id', trans('general.department'), ['class' => 'control-label col-sm-3']) !!}                                
                                <div class="col-sm-9">
                                    {!! Form::select('department_id', [], null, ['class' => 'form-control select2-ajax', 'remote-url' => route('api.departments'), 'remote-param' => 'select[name="university_id"]']) !!}
                                    @if ($errors->has('department_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('department_id') }}</strong>
                                        </span>
                                    @endif                                                                                                   
                                </div>
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
                            <button type="submit" class="btn green" >{{ trans('general.save') }}</button>
                            <a href="{{ route('transfers.index') }}" class="btn default">{{ trans('general.cancel') }}</a>
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
            $('.select2-ajax').val(null)
            $('.select2-ajax').trigger('change');
        })
    })
</script>
@endpush