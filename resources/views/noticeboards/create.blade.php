@extends('layouts.app')

@section('content')
    <div class="portlet box">        
        <div class="portlet-body">
            <!-- BEGIN FORM-->            
            {!! Form::open(['route' => 'noticeboards.store', 'method' => 'post', 'class' => 'form-horizontal', 'files' => 'true']) !!}
                <div class="form-body" id="app">
                <div class="row">
                    <div class="col-md-12">
                            <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                {!! Form::label('title', trans('general.ntitle'), ['class' => 'control-label col-sm-2']) !!}
                                <div class="col-sm-8">
                                    {!! Form::text('title', null, ['class' => 'form-control']) !!}
                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group {{ $errors->has('body') ? ' has-error' : '' }}">
                            {!! Form::label('body', trans('general.body'), ['class' => 'control-label col-sm-2']) !!}                                
                            <div class="col-sm-8">
                                {!! Form::textarea('body', null, ['class' => 'form-control', 'id'=>"summernote",'cols' =>40]) !!}
                                @if ($errors->has('bdoy'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                @endif                                                                                                   
                            </div>
                        </div>
                    </div>  
                </div>
                <div class="row ">
                    <div class="col-md-12">
                            <div class="form-group {{ $errors->has('file') ? ' has-error' : '' }}">
                                {!! Form::label('file', trans('general.file'), ['class' => 'control-label col-sm-2']) !!}
                                <div class="col-sm-8">
                                    {!! Form::file('file[]', ['multiple' => 'true'] ,['class' => 'form-control' ]) !!}
                                    @if ($errors->has('file'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('file') }}</strong>
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
