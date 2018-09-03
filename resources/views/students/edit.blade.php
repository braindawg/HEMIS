@extends('layouts.app')

@section('content')
<!-- BEGIN PAGE BASE CONTENT -->
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PROFILE SIDEBAR -->
        <div class="profile-sidebar">
            <!-- PORTLET MAIN -->
            <div class="portlet light profile-sidebar-portlet bordered">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic">
                    <img src="{{ asset($student->photo_url) }}" class="img-responsive" alt=""> 
                </div>
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name"> {{ $student->name }} </div>
                    <div class="profile-usertitle-job"> {{ $student->form_no }}</div>
                    <div class="profile-usertitle-job"> {{ $student->department->name }}</div>
                    <div class="profile-usertitle-job"> {{ $student->university->name }}</div>
                </div>
                <!-- END SIDEBAR USER TITLE -->
                <!-- SIDEBAR BUTTONS -->               
                <!-- END SIDEBAR BUTTONS -->
                <!-- SIDEBAR MENU -->
                <div class="profile-usermenu">
                    <ul class="nav">
                        <li class="active">
                            <a href="javascript:;">
                                {{ trans('general.student_information') }} 
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- END MENU -->
            </div>
            <!-- END PORTLET MAIN -->
        </div>
        <!-- END BEGIN PROFILE SIDEBAR -->
        <!-- BEGIN PROFILE CONTENT -->
        <div class="profile-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet box">        
                        <div class="portlet-body">
                            <!-- BEGIN FORM-->            
                            {!! Form::model($student, ['route' => ['students.update', $student], 'method' => 'patch', 'class' => 'form-horizontal']) !!}            
                                <div class="form-body" id="app">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('university') ? ' has-error' : '' }}">
                                                {!! Form::label('university', trans('general.university'), ['class' => 'control-label col-sm-3']) !!}                                
                                                <div class="col-sm-9">
                                                    {!! Form::select('university', $universities, $student->university_id, ['class' => 'form-control select2', 'disabled']) !!}
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
                                                    {!! Form::select('department', $student->department()->pluck('name', 'id'), null, ['class' => 'form-control select2-ajax', 'remote-url' => route('api.departments'), 'remote-param' => 'select[name="university"]', 'disabled']) !!}
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
                                                    {!! Form::text('name', null, ['class' => 'form-control']) !!}     
                                                    @if ($errors->has('name'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                    @endif                                                                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('father_name') ? ' has-error' : '' }}">
                                                {!! Form::label('father_name', trans('general.father_name'), ['class' => 'control-label col-sm-3']) !!}                                
                                                <div class="col-sm-9">
                                                    {!! Form::text('father_name', null, ['class' => 'form-control']) !!}     
                                                    @if ($errors->has('father_name'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('father_name') }}</strong>
                                                        </span>
                                                    @endif                                                                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('grandfather_name') ? ' has-error' : '' }}">
                                                {!! Form::label('grandfather_name', trans('general.grandfather_name'), ['class' => 'control-label col-sm-3']) !!}                                
                                                <div class="col-sm-9">
                                                    {!! Form::text('grandfather_name', null, ['class' => 'form-control']) !!}     
                                                    @if ($errors->has('grandfather_name'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('grandfather_name') }}</strong>
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
                                            <div class="form-group {{ $errors->has('nationality') ? ' has-error' : '' }}">
                                                {!! Form::label('nationality', trans('general.nationality'), ['class' => 'control-label col-sm-3']) !!}                                
                                                <div class="col-sm-9">
                                                    {!! Form::text('nationality', null, ['class' => 'form-control']) !!}     
                                                    @if ($errors->has('nationality'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('nationality') }}</strong>
                                                        </span>
                                                    @endif                                                                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('language') ? ' has-error' : '' }}">
                                                {!! Form::label('language', trans('general.language'), ['class' => 'control-label col-sm-3']) !!}                                
                                                <div class="col-sm-9">
                                                    {!! Form::text('language', null, ['class' => 'form-control editable']) !!}     
                                                    @if ($errors->has('language'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('language') }}</strong>
                                                        </span>
                                                    @endif                                                                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    
                                    <hr>

                                    @php
                                        $tazkira = explode('!@#', $student->tazkira);                                        
                                    @endphp
                                    <div class="row">                        
                                        <div class="col-md-4">
                                            <div class="form-group {{ $errors->has('general_number') ? ' has-error' : '' }}">
                                                {!! Form::label('general_number', trans('general.general_number'), ['class' => 'control-label col-sm-4']) !!}                                
                                                <div class="col-sm-8">
                                                    {!! Form::text('tazkira[general_number]', $tazkira[3] ?? null, ['class' => 'form-control editable']) !!}     
                                                    @if ($errors->has('general_number'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('general_number') }}</strong>
                                                        </span>
                                                    @endif                                                                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group {{ $errors->has('page') ? ' has-error' : '' }}">
                                                {!! Form::label('page', trans('general.page'), ['class' => 'control-label col-sm-4']) !!}                                
                                                <div class="col-sm-8">
                                                    {!! Form::text('tazkira[page]', $tazkira[2] ?? null, ['class' => 'form-control editable']) !!}     
                                                    @if ($errors->has('page'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('page') }}</strong>
                                                        </span>
                                                    @endif                                                                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group {{ $errors->has('volume') ? ' has-error' : '' }}">
                                                {!! Form::label('volume', trans('general.volume'), ['class' => 'control-label col-sm-4']) !!}                                
                                                <div class="col-sm-8">
                                                    {!! Form::text('tazkira[volume]', $tazkira[0] ?? null, ['class' => 'form-control editable']) !!}     
                                                    @if ($errors->has('volume'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('volume') }}</strong>
                                                        </span>
                                                    @endif                                                                                                   
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row">                        
                                        <div class="col-md-4">
                                            <div class="form-group {{ $errors->has('registration_number') ? ' has-error' : '' }}">
                                                {!! Form::label('registration_number', trans('general.registration_number'), ['class' => 'control-label col-sm-4']) !!}                                
                                                <div class="col-sm-8">
                                                    {!! Form::text('tazkira[registration_number]', $tazkira[1] ?? null, ['class' => 'form-control editable']) !!}     
                                                    @if ($errors->has('registration_number'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('registration_number') }}</strong>
                                                        </span>
                                                    @endif                                                                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group {{ $errors->has('birthdate') ? ' has-error' : '' }}">
                                                {!! Form::label('birthdate', trans('general.birthdate'), ['class' => 'control-label col-sm-4']) !!}                                
                                                <div class="col-sm-8">
                                                    {!! Form::text('birthdate', null, ['class' => 'form-control ltr editable']) !!}     
                                                    @if ($errors->has('birthdate'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('birthdate') }}</strong>
                                                        </span>
                                                    @endif                                                                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group {{ $errors->has('marital_status') ? ' has-error' : '' }}">
                                                {!! Form::label('marital_status', trans('general.marital_status'), ['class' => 'control-label col-sm-4']) !!}                                
                                                <div class="col-sm-8">
                                                    {!! Form::select('marital_status', ['married' => trans('general.married'),  'single' => trans('general.single'),  'widow' => trans('general.divorced')], null, ['class' => 'form-control select2', 'placeholder' => trans('general.select')]) !!}     
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
                                            <div class="form-group {{ $errors->has('school_name') ? ' has-error' : '' }}">
                                                {!! Form::label('school_name', trans('general.school_name'), ['class' => 'control-label col-sm-4']) !!}                                
                                                <div class="col-sm-8">
                                                    {!! Form::text('school_name', null, ['class' => 'form-control editable']) !!}     
                                                    @if ($errors->has('school_name'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('school_name') }}</strong>
                                                        </span>
                                                    @endif                                                                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group {{ $errors->has('school_graduation_year') ? ' has-error' : '' }}">
                                                {!! Form::label('school_graduation_year', trans('general.school_graduation_year'), ['class' => 'control-label col-sm-4']) !!}                                
                                                <div class="col-sm-8">
                                                    {!! Form::text('school_graduation_year', null, ['class' => 'form-control ltr editable']) !!}     
                                                    @if ($errors->has('school_graduation_year'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('school_graduation_year') }}</strong>
                                                        </span>
                                                    @endif                                                                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group {{ $errors->has('kankor_year') ? ' has-error' : '' }}">
                                                {!! Form::label('kankor_year', trans('general.kankor_year'), ['class' => 'control-label col-sm-4']) !!}                                
                                                <div class="col-sm-8">
                                                    {!! Form::text('kankor_year', null, ['class' => 'form-control ltr']) !!}     
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
                                        <div class="col-md-4">
                                            <div class="form-group {{ $errors->has('kankor_score') ? ' has-error' : '' }}">
                                                {!! Form::label('kankor_score', trans('general.kankor_score'), ['class' => 'control-label col-sm-4']) !!}                                
                                                <div class="col-sm-8">
                                                    {!! Form::text('kankor_score', null, ['class' => 'form-control ltr']) !!}     
                                                    @if ($errors->has('kankor_score'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('kankor_score') }}</strong>
                                                        </span>
                                                    @endif                                                                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group {{ $errors->has('form_no') ? ' has-error' : '' }}">
                                                {!! Form::label('form_no', trans('general.form_no'), ['class' => 'control-label col-sm-4']) !!}                                
                                                <div class="col-sm-8">
                                                    {!! Form::text('form_no', null, ['class' => 'form-control ltr']) !!}     
                                                    @if ($errors->has('form_no'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('form_no') }}</strong>
                                                        </span>
                                                    @endif                                                                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                                                {!! Form::label('phone', trans('general.phone'), ['class' => 'control-label col-sm-4']) !!}                                
                                                <div class="col-sm-8">
                                                    {!! Form::text('phone', null, ['class' => 'form-control ltr editable']) !!}     
                                                    @if ($errors->has('phone'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('phone') }}</strong>
                                                        </span>
                                                    @endif                                                                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    
                                    <hr>
                                    
                                    <div class="row">                        
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                {!! Form::label('address', trans('general.address'), ['class' => 'control-label col-sm-4']) !!}                                
                                                <div class="col-sm-8">
                                                    <p class="form-control-static"> {{ trans('general.province') }} </p>                                                                                                
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">                                
                                                <div class="col-sm-12">
                                                    <p class="form-control-static"> {{ trans('general.city') }} </p>                                                                                                  
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">                                
                                                <div class="col-sm-12">
                                                    <p class="form-control-static"> {{ trans('general.town') }} </p>                                                                                                  
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">                                
                                                <div class="col-sm-12">
                                                    <p class="form-control-static"> {{ trans('general.address_2') }} </p>                                                                                                  
                                                </div>
                                            </div>
                                        </div>
                                    </div>   
                                    <div class="row">                        
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                {!! Form::label('', trans('general.original'), ['class' => 'control-label col-sm-4']) !!}                                
                                                <div class="col-sm-8">
                                                {!! Form::text('province', null, ['class' => 'form-control editable']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">                                
                                                <div class="col-sm-12">
                                                {!! Form::text('district', null, ['class' => 'form-control editable']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">                                
                                                <div class="col-sm-12">
                                                {!! Form::text('village', null, ['class' => 'form-control editable']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">                                
                                                <div class="col-sm-12">
                                                {!! Form::text('address', null, ['class' => 'form-control editable']) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>                   
                                    <div class="row">                        
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                {!! Form::label('', trans('general.current'), ['class' => 'control-label col-sm-4']) !!}                                
                                                <div class="col-sm-8">
                                                    {!! Form::select('province_current', \App\Models\Province::pluck('name', 'id'),null, ['class' => 'form-control select2', 'placeholder' => trans('general.select')]) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">                                
                                                <div class="col-sm-12">
                                                {!! Form::text('district_current', null, ['class' => 'form-control editable']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">                                
                                                <div class="col-sm-12">
                                                {!! Form::text('village_current', null, ['class' => 'form-control editable']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">                                
                                                <div class="col-sm-12">
                                                {!! Form::text('address_current', null, ['class' => 'form-control editable']) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>                    
    
                                    
                                    <hr>
                                    
                                    <div class="row">                        
                                        <div class="col-md-3">
                                            <div class="form-group">                                                
                                                <div class="col-sm-8">
                                                    <p class="form-control-static"> {{ trans('general.relation') }} </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">                                                
                                                <div class="col-sm-8">
                                                    <p class="form-control-static"> {{ trans('general.fame') }} </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">                                
                                                <div class="col-sm-12">
                                                    <p class="form-control-static"> {{ trans('general.job_address') }} </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group}">                                
                                                <div class="col-sm-12">
                                                    <p class="form-control-static"> {{ trans('general.phone') }} </p>
                                                </div>
                                            </div>
                                        </div>                        
                                    </div>
                                    @foreach($student->relatives as $relative)
                                    <div class="row">                        
                                        <div class="col-md-3">
                                            <div class="form-group">                                        
                                                <div class="col-sm-12">
                                                    {!! Form::text('relatives[]["relation"]', $relative->relation, ['class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">                                        
                                                <div class="col-sm-12">
                                                    {!! Form::text('relatives[]["name"]', $relative->name, ['class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">                                
                                                <div class="col-sm-12">
                                                    {!! Form::text('relatives[]["job"]', $relative->job, ['class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">                                
                                                <div class="col-sm-12">
                                                    {!! Form::text('relatives[]["phone"]', $relative->phone, ['class' => 'form-control ltr']) !!}
                                                </div>
                                            </div>
                                        </div>                        
                                    </div> 
                                    @endforeach                                                                          
                                </div>

                                    <hr>

                                <div class="row">                        
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('name_eng') ? ' has-error' : '' }}">
                                            {!! Form::label('name_eng', trans('general.name_eng'), ['class' => 'control-label col-sm-3']) !!}                                
                                            <div class="col-sm-9">
                                                {!! Form::text('name_eng', null, ['class' => 'form-control editable']) !!}     
                                                @if ($errors->has('name_eng'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('name_eng') }}</strong>
                                                    </span>
                                                @endif                                                                                                   
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('father_name_eng') ? ' has-error' : '' }}">
                                            {!! Form::label('father_name_eng', trans('general.father_name_eng'), ['class' => 'control-label col-sm-3']) !!}                                
                                            <div class="col-sm-9">
                                                {!! Form::text('father_name_eng', null, ['class' => 'form-control editable']) !!}     
                                                @if ($errors->has('father_name_eng'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('father_name_eng') }}</strong>
                                                    </span>
                                                @endif                                                                                                   
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">                        
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('last_name_eng') ? ' has-error' : '' }}">
                                            {!! Form::label('last_name_eng', trans('general.last_name_eng'), ['class' => 'control-label col-sm-3']) !!}                                
                                            <div class="col-sm-9">
                                                {!! Form::text('last_name_eng', null, ['class' => 'form-control editable']) !!}     
                                                @if ($errors->has('last_name_eng'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('last_name_eng') }}</strong>
                                                    </span>
                                                @endif                                                                                                   
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('grandfather_name_eng') ? ' has-error' : '' }}">
                                            {!! Form::label('grandfather_name_eng', trans('general.grandfather_name_eng'), ['class' => 'control-label col-sm-3']) !!}                                
                                            <div class="col-sm-9">
                                                {!! Form::text('grandfather_name_eng', null, ['class' => 'form-control editable']) !!}     
                                                @if ($errors->has('grandfather_name_eng'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('grandfather_name_eng') }}</strong>
                                                    </span>
                                                @endif                                                                                                   
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">                        
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('student_code') ? ' has-error' : '' }}">
                                            {!! Form::label('student_code', trans('general.student_code'), ['class' => 'control-label col-sm-3']) !!}                                
                                            <div class="col-sm-9">
                                                {!! Form::text('code', null, ['class' => 'form-control editable']) !!}     
                                                    <span class="help-block">
                                                        <strong>اطلاعات این فیلد اختیاری بوده و برای کارت محصلین است.</strong>
                                                    </span>                                                                                                  
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('department_eng') ? ' has-error' : '' }}">
                                            {!! Form::label('department_eng', trans('general.department_eng'), ['class' => 'control-label col-sm-3']) !!}                                
                                            <div class="col-sm-9">
                                                {!! Form::text('department_eng', null, ['class' => 'form-control editable']) !!}     
                                                @if ($errors->has('department_eng'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('department_eng') }}</strong>
                                                    </span>
                                                @endif                                                                                                   
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                                            {!! Form::label('status', trans('general.status'), ['class' => 'control-label col-sm-3']) !!}                                
                                            <div class="col-sm-9">
                                                {!! Form::select('status', $statuses, $student->status_id, ['class' => 'form-control select2']) !!}
                                                @if ($errors->has('status'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('status') }}</strong>
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
                                            <label for="">
                                                
                                                <input type="checkbox" name="print" value="true" checked>
                                                {{ trans('general.print') }}
                                            </label>
                                        </div>
                                        <div class="col-md-offset-1 col-md-9">
                                            <button type="submit" class="btn green">{{ trans('general.save') }}</button>
                                            <a href="{{ route('students.index') }}" class="btn default">{{ trans('general.cancel') }}</a>
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