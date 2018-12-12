@extends('layouts.app')

@section('content')
    <!-- BEGIN PAGE BASE CONTENT -->
    <div class ="row">
        <div class ="col-md-7">
            <div class="profile-content">
                <div class="portlet box">
                    <div class="portlet-body">
                    <!-- BEGIN FORM-->
                    {!! Form::model($course, ['route' => ['courses.update', $course], 'method' => 'patch', 'class' => 'form-horizontal', 'files' => true]) !!}
                            <div class="form-body" id="app">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group {{ $errors->has('code') ? ' has-error' : '' }}">
                                            {!! Form::label('code', trans('general.code'), ['class' => 'control-label col-sm-2']) !!}
                                            <div class="col-sm-8">
                                                {!! Form::text('code', null, ['class' => 'form-control']) !!}
                                                @if ($errors->has('code'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('code') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {!! Form::hidden('university', $course->university_id) !!}
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group {{ $errors->has('department') ? ' has-error' : '' }}">
                                            {!! Form::label('department', trans('general.department'), ['class' => 'control-label col-sm-2']) !!}
                                            <div class="col-sm-8">
                                                {!! Form::select('department',$department, null, ['class' => 'form-control select2-ajax' , 'remote-url' => route('api.departments'), 'remote-param' => '[name="university"]'])  !!}
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
                                    <div class="col-md-8">
                                        <div class="form-group {{ $errors->has('year') ? ' has-error' : '' }}">
                                            {!! Form::label('year', trans('general.year'), ['class' => 'control-label col-sm-2']) !!}
                                            <div class="col-sm-8">
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
                                    <div class="col-md-8">
                                        <div class="form-group {{ $errors->has('half_year') ? ' has-error' : '' }}">
                                            {!! Form::label('half_year', trans('general.half_year'), ['class' => 'control-label col-sm-2']) !!}
                                            <div class="col-sm-8">
                                                {!! Form::select('half_year', ['spring' => trans('general.spring'),  'fall' => trans('general.fall')], null, ['class' => 'form-control']) !!}
                                                @if ($errors->has('half_year'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('half_year') }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group {{ $errors->has('semester') ? ' has-error' : '' }}">
                                            {!! Form::label('semester', trans('general.semester'), ['class' => 'control-label col-sm-2']) !!}
                                            <div class="col-sm-8">
                                                {!! Form::number('semester', null, ['min' => '0','class' => 'form-control'])  !!}
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
                                    <div class="col-md-8">
                                        <div class="form-group {{ $errors->has('subject') ? ' has-error' : '' }}">
                                            {!! Form::label('subject', trans('general.subject'), ['class' => 'control-label col-sm-2']) !!}
                                            <div class="col-sm-8">
                                                {!! Form::select('subject', $subject, [], ['class' => 'form-control select2-subjects', 'remote-url' => route('api.subjects'), 'remote-param' => 'select[name="department"]']) !!}
                                                @if ($errors->has('subject'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('subject') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group {{ $errors->has('teacher') ? ' has-error' : '' }}">
                                            {!! Form::label('teacher', trans('general.teacher'), ['class' => 'control-label col-sm-2']) !!}
                                            <div class="col-sm-8">
                                                {!! Form::select('teacher',$teacher, null,  ['class' => 'form-control select2-teachers']) !!}
                                                @if ($errors->has('teacher'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('teacher') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group {{ $errors->has('group') ? ' has-error' : '' }}">
                                            {!! Form::label('group', trans('general.group'), ['class' => 'control-label col-sm-2']) !!}
                                            <div class="col-sm-8">
                                                {!! Form::select('group', $group , null, ['class' => 'form-control select2-groups','remote-param' => 'select[name="department"]']) !!}
                                                @if ($errors->has('group'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('group') }}</strong>
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
                                            <a href="{{ route('courses.index') }}"
                                                class="btn default">{{ trans('general.cancel') }}</a>
                                        </div>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- END PROFILE CONTENT -->

        <div class ="col-md-5">
            <div class="portlet">
                <div class="portlet-title">
                    <div class="caption" >
                        <h3 style ="margin-right:20px; text-align:center">{{trans('general.time')}}</h3>  
                    </div>              
                    <div class="portlet-body">
                        <div class="table-scrollable">
                            <table class="table table-striped table-bordered table-advance table-hover">
                                <thead>
                                    <tr>
                                        <th>{{trans('general.time')}} و {{trans('general.location')}}  </th>
                                        <th>{{trans('general.day')}} </th>
                                        <th>{{trans('general.action')}} </th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($course->courseTimes as $coursetime)
                                    <tr>
                                        <td> ساعت:  {{ $coursetime->time() }} اتاق {{ $coursetime->location }} </td>
                                        <td> {{ $coursetime->day->day }} </td>
                                        <td>
                                        <a href="{{URL::to('courses/'.$coursetime->id .'/'. 'delete-coursetime')}}"  onClick="doConfirm()"  class="btn red btn-sm btn-outline sbold uppercase">
                                                <i class="fa fa-trash"></i>  {{trans('general.delete')}} </a>
                                        <a href="{{URL::to('courses/'.$coursetime->id .'/'. 'edit-coursetime')}}"  class="btn blue btn-sm btn-outline sbold uppercase">
                                                <i class="fa fa-pencil"></i>  {{trans('general.edit')}} </a>
                                    </tr> 
                                @endforeach                                        
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
        <div class ="col-md-5">
            <div class="portlet">         
                <div class="portlet-title">  
                    <div class="" style ="margin-right:15px">
                        <h3>{{trans('general.new_time')}}</h3>  
                    </div>
                    <hr>
                    <div class="portlet-body form">
                    {!! Form::open(['route' => ['coursetime.store', $course], 'method' => 'post', 'class' => 'form-horizontal']) !!} 
                     <div class="form-body" id="app">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-1">
                                <div class="form-group {{ $errors->has('day') ? ' has-error' : '' }}">
                                    {!! Form::label('day', trans('general.day'), ['class' => 'control-label col-sm-3']) !!}                                
                                    <div class="col-sm-9">
                                        {!! Form::select('day', $days, null, ['class' => 'form-control select2']) !!}
                                        @if ($errors->has('day'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('day') }}</strong>
                                            </span>
                                        @endif                                                                                                   
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-md-offset-1">
                                <div class="form-group {{ $errors->has('time') ? ' has-error' : '' }}">
                                    {!! Form::label('time', trans('general.time'), ['class' => 'control-label col-sm-3']) !!}
                                    <div class="col-sm-9">
                                        {!! Form::time('time', null, ['class' => 'form-control']) !!}
                                        @if ($errors->has('time'))
                                            <span class="help-block">
                                                    <strong>{{ $errors->first('time') }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-md-offset-1">
                                <div class="form-group {{ $errors->has('location') ? ' has-error' : '' }}">
                                    {!! Form::label('location', trans('general.location'), ['class' => 'control-label col-sm-3']) !!}                                
                                    <div class="col-sm-9">
                                        {!! Form::text('location', null, ['class' => 'form-control', 'rows' => 3]) !!}
                                        @if ($errors->has('location'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('location') }}</strong>
                                            </span>
                                        @endif                                                                                                   
                                    </div>
                                </div>
                            </div>
                        </div>              
                    </div>
                    <div class="form-actions fluid">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-6">
                                <button type="submit" class="btn green">{{ trans('general.save') }}</button>
                                <a href="{{ route('courses.index') }}" class="btn default">{{ trans('general.cancel') }}</a>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                    </div>
                </div>  
            </div>
        </div>


        <!-- new time for course -->
    </div>

    <!-- END PAGE BASE CONTENT -->

@endsection('content')
