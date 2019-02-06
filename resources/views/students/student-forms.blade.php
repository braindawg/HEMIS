@extends('layouts.app')

@section('content')
    <div class="portlet box">        
        <div class="portlet-body">
            <!-- BEGIN FORM-->            
             {!! Form::model($student, ['route' => ['student.generate_form', $student], 'method' => 'POST', 'class' => 'form-horizontal']) !!}                 
            
                <div class="form-body" id="app">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-1">
                            <div class="form-group {{ $errors->has('year') ? ' has-error' : '' }}">
                                {!! Form::label('year', trans('general.year'), ['class' => 'control-label col-sm-3']) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('year', null, ['class' => 'form-control']) !!}
                                    @if ($errors->has('year'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('year') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-1">
                            <div class="form-group {{ $errors->has('semister') ? ' has-error' : '' }}">
                                {!! Form::label('semister', trans('general.semister'), ['class' => 'control-label col-sm-3']) !!}
                                <div class="col-sm-9">
                                    {!! Form::number('semister', null, ['class' => 'form-control', 'min' => '1', 'max' => "8"]) !!}
                                    @if ($errors->has('semister'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('semister') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                    <div class="col-md-6 col-md-offset-1">
                        <div class="form-group {{ $errors->has('file') ? ' has-error' : '' }}">
                            {!! Form::label('file', trans('general.file'), ['class' => 'control-label col-sm-3']) !!}
                            <div class="col-sm-8 ">
                                <select class="form-control input-xlarge" name = "file">
                                @foreach($files as $file)
                                    <option>{{ substr($file->getFileName(), 0, -10) }} </option>
                                @endforeach
                                </select>
                                @if ($errors->has('file'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('file') }}</strong>
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
                            <button type="submit" class="btn green">{{ trans('general.generate_form') }}</button>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
            <!-- END FORM-->
        </div>
    </div>
@endsection('content')