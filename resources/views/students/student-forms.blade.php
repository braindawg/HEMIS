@extends('students.sidebar')

@section('page')
    <div class="portlet box">        
        <div class="portlet-body">
            <!-- BEGIN FORM-->            
             {!! Form::model($student, ['route' => ['student.generate-form', $student], 'method' => 'POST', 'class' => 'form-horizontal']) !!}                 
            
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
                            <div class="form-group {{ $errors->has('file') ? ' has-error' : '' }}">
                                {!! Form::label('file', trans('general.file'), ['class' => 'control-label col-sm-3']) !!}
                                <div class="col-sm-9">
                                    <select class="form-control" name = "file">
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
                        <div class="col-md-6 col-md-offset-3">
                            <button type="submit" class="btn green">{{ trans('general.generate_form') }}</button>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
            <!-- END FORM-->
        </div>
    </div>
@endsection('content')