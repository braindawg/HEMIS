@extends('layouts.app')

@section('content')
    <div class="portlet box">        
        <div class="portlet-body">
            <!-- BEGIN FORM-->            
            {!! Form::open(['route' => 'users.store', 'method' => 'post', 'class' => 'form-horizontal']) !!}            
                <div class="form-body">
                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        {!! Form::label('name', trans('general.name'), ['class' => 'control-label col-sm-3']) !!}                                
                        <div class="col-sm-4">
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}     
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif                                                                                                   
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('position') ? ' has-error' : '' }}">
                        {!! Form::label('position', trans('general.position'), ['class' => 'control-label col-sm-3']) !!}                                
                        <div class="col-sm-4">
                            {!! Form::text('position', null, ['class' => 'form-control']) !!}     
                            @if ($errors->has('position'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('position') }}</strong>
                                </span>
                            @endif                                                                                                   
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                        {!! Form::label('phone', trans('general.phone'), ['class' => 'control-label col-sm-3']) !!}                                
                        <div class="col-sm-4">
                            {!! Form::text('phone', null, ['class' => 'form-control ltr']) !!}     
                            @if ($errors->has('phone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif                                                                                                   
                        </div>
                    </div>
                    <hr>
                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        {!! Form::label('email', trans('general.email'), ['class' => 'control-label col-sm-3']) !!}                                
                        <div class="col-sm-4">
                            {!! Form::email('email', null, ['class' => 'form-control ltr']) !!}     
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif                                                                                                   
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                        {!! Form::label('password', trans('general.password'), ['class' => 'control-label col-sm-3']) !!}                                
                        <div class="col-sm-4">
                            {!! Form::password('password', ['class' => 'form-control ltr']) !!}     
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif                                                                                                   
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        {!! Form::label('password_confirmation', trans('general.password_confirmation'), ['class' => 'control-label col-sm-3']) !!}                                
                        <div class="col-sm-4">
                            {!! Form::password('password_confirmation', ['class' => 'form-control ltr']) !!}     
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif                                                                                                   
                        </div>
                    </div>
                    <hr>
                    @if (auth()->user()->allUniversities())
                    <div class="form-group {{ $errors->has('university') ? ' has-error' : '' }}">
                        {!! Form::label('university', trans('general.university'), ['class' => 'control-label col-sm-3']) !!}                                
                        <div class="col-sm-4">
                            {!! Form::select('university_id', $universities, null, ['class' => 'form-control select2' ,'placeholder' => trans('general.select')]) !!}     
                            @if ($errors->has('university'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('university') }}</strong>
                                </span>
                            @endif                                                                                                   
                        </div>
                    </div>
                    @else
                    <input type="hidden" name="university_id" value="{{ auth()->user()->university_id }}">
                    @endif                    
                    <div class="form-group {{ $errors->has('department') ? ' has-error' : '' }}">
                        {!! Form::label('department', trans('general.department'), ['class' => 'control-label col-sm-3']) !!}                                
                        <div class="col-sm-4">
                            {!! Form::select('departments[]', $departments, null, ['class' => 'form-control select2-ajax', 'remote-url' => route('api.departments'), 'remote-param' => '[name="university_id"]', "multiple" =>"multiple"]) !!}
                            
                                <span class="help-block">
                                    <strong>در صورت خالی بودن دیپارتمنت, تمامی دیپارتمنت ها قابل دسترس می باشد.</strong>
                                </span>
                                                                                                                               
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('active') ? ' has-error' : '' }}">
                        {!! Form::label('active', trans('general.status'), ['class' => 'control-label col-sm-3']) !!}                                
                        <div class="col-sm-4">                 
                            <div >
                                <label class="checkbox-inline">
                                <input type="checkbox" name="active" value="1" checked> {{ trans('general.active') }}                               
                                </label>                                                       
                            </div>                                               
                        </div>
                    </div>

                    <hr>
                    <div class="form-group">
                        {!! Form::label('roles[]', trans('general.roles'), ['class' => 'control-label col-sm-4']) !!}
                        <div class="col-md-8">
                            @foreach($roles as $role)
                            <div class="checkbox-list">
                                <label>
                                    {!! Form::checkbox('roles[]', $role->id, null) !!}  {{ $role->title }}
                                </label>                            
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="form-actions fluid">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn green">{{ trans('general.save') }}</button>
                            <a href="{{ route('users.index') }}" class="btn default">{{ trans('general.cancel') }}</a>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
            <!-- END FORM-->
        </div>
    </div>
@endsection('content')