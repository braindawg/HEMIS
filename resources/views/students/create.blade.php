@extends('layouts.app')

@section('content')
    <div class="portlet box">        
        <div class="portlet-body">
            <!-- BEGIN FORM-->            
            {!! Form::open(['route' => 'students.store', 'method' => 'post', 'class' => 'form-horizontal']) !!}            
                <div class="form-body" id="app">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('university') ? ' has-error' : '' }}">
                                {!! Form::label('university', trans('general.university'), ['class' => 'control-label col-sm-3']) !!}                                
                                <div class="col-sm-9">
                                    {!! Form::select('university', $universities, null, ['class' => 'form-control select2']) !!}
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
                                    {!! Form::select('department', [], null, ['class' => 'form-control select2-ajax', 'remote-url' => route('api.departments'), 'remote-param' => 'select[name="university"]']) !!}
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
                                    {!! Form::text('last_name', null, ['class' => 'form-control']) !!}     
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
                            <div class="form-group {{ $errors->has('native_language') ? ' has-error' : '' }}">
                                {!! Form::label('native_language', trans('general.native_language'), ['class' => 'control-label col-sm-3']) !!}                                
                                <div class="col-sm-9">
                                    {!! Form::text('native_language', null, ['class' => 'form-control']) !!}     
                                    @if ($errors->has('native_language'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('native_language') }}</strong>
                                        </span>
                                    @endif                                                                                                   
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <hr>

                    <div class="row">                        
                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('general_number') ? ' has-error' : '' }}">
                                {!! Form::label('general_number', trans('general.general_number'), ['class' => 'control-label col-sm-4']) !!}                                
                                <div class="col-sm-8">
                                    {!! Form::text('general_number', null, ['class' => 'form-control']) !!}     
                                    @if ($errors->has('general_number'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('general_number') }}</strong>
                                        </span>
                                    @endif                                                                                                   
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('volume') ? ' has-error' : '' }}">
                                {!! Form::label('volume', trans('general.volume'), ['class' => 'control-label col-sm-4']) !!}                                
                                <div class="col-sm-8">
                                    {!! Form::text('volume', null, ['class' => 'form-control']) !!}     
                                    @if ($errors->has('volume'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('volume') }}</strong>
                                        </span>
                                    @endif                                                                                                   
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('page') ? ' has-error' : '' }}">
                                {!! Form::label('page', trans('general.page'), ['class' => 'control-label col-sm-4']) !!}                                
                                <div class="col-sm-8">
                                    {!! Form::text('page', null, ['class' => 'form-control']) !!}     
                                    @if ($errors->has('page'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('page') }}</strong>
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
                                    {!! Form::text('registration_number', null, ['class' => 'form-control']) !!}     
                                    @if ($errors->has('registration_number'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('registration_number') }}</strong>
                                        </span>
                                    @endif                                                                                                   
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('birth_year') ? ' has-error' : '' }}">
                                {!! Form::label('birth_year', trans('general.birth_year'), ['class' => 'control-label col-sm-4']) !!}                                
                                <div class="col-sm-8">
                                    {!! Form::text('birth_year', null, ['class' => 'form-control']) !!}     
                                    @if ($errors->has('birth_year'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('birth_year') }}</strong>
                                        </span>
                                    @endif                                                                                                   
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('marital_status') ? ' has-error' : '' }}">
                                {!! Form::label('marital_status', trans('general.marital_status'), ['class' => 'control-label col-sm-4']) !!}                                
                                <div class="col-sm-8">
                                    {!! Form::select('marital_status', ['married' => trans('general.married'),  'single' => trans('general.single')], null, ['class' => 'form-control select2', 'placeholder' => trans('general.select')]) !!}     
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
                                    {!! Form::text('school_name', null, ['class' => 'form-control']) !!}     
                                    @if ($errors->has('school_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('school_name') }}</strong>
                                        </span>
                                    @endif                                                                                                   
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('graduation_year') ? ' has-error' : '' }}">
                                {!! Form::label('graduation_year', trans('general.graduation_year'), ['class' => 'control-label col-sm-4']) !!}                                
                                <div class="col-sm-8">
                                    {!! Form::text('graduation_year', null, ['class' => 'form-control']) !!}     
                                    @if ($errors->has('graduation_year'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('graduation_year') }}</strong>
                                        </span>
                                    @endif                                                                                                   
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('kankor_year') ? ' has-error' : '' }}">
                                {!! Form::label('kankor_year', trans('general.kankor_year'), ['class' => 'control-label col-sm-4']) !!}                                
                                <div class="col-sm-8">
                                    {!! Form::text('kankor_year', null, ['class' => 'form-control']) !!}     
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
                                    {!! Form::text('kankor_score', null, ['class' => 'form-control']) !!}     
                                    @if ($errors->has('kankor_score'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('kankor_score') }}</strong>
                                        </span>
                                    @endif                                                                                                   
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('kankor_id') ? ' has-error' : '' }}">
                                {!! Form::label('kankor_id', trans('general.kankor_id'), ['class' => 'control-label col-sm-4']) !!}                                
                                <div class="col-sm-8">
                                    {!! Form::text('kankor_id', null, ['class' => 'form-control']) !!}     
                                    @if ($errors->has('kankor_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('kankor_id') }}</strong>
                                        </span>
                                    @endif                                                                                                   
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                                {!! Form::label('phone', trans('general.phone'), ['class' => 'control-label col-sm-4']) !!}                                
                                <div class="col-sm-8">
                                    {!! Form::text('phone', null, ['class' => 'form-control']) !!}     
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
                                    {!! Form::text('address["original"]["province"]', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">                                
                                <div class="col-sm-12">
                                {!! Form::text('address["original"]["city"]', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">                                
                                <div class="col-sm-12">
                                {!! Form::text('address["original"]["town"]', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">                                
                                <div class="col-sm-12">
                                {!! Form::text('address["original"]["address"]', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                    </div>                    
                    <div class="row">                        
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::label('', trans('general.current'), ['class' => 'control-label col-sm-4']) !!}                                
                                <div class="col-sm-8">
                                {!! Form::text('address["current"]["province"]', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">                                
                                <div class="col-sm-12">
                                {!! Form::text('address["current"]["city"]', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">                                
                                <div class="col-sm-12">
                                {!! Form::text('address["current"]["town"]', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">                                
                                <div class="col-sm-12">
                                {!! Form::text('address["current"]["address"]', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                    </div>      
                    
                    <hr>
                    
                    <div class="row">                        
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('', trans('general.relatives'), ['class' => 'control-label col-sm-4']) !!}                                
                                <div class="col-sm-8">
                                    <p class="form-control-static"> {{ trans('general.fame') }} </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">                                
                                <div class="col-sm-12">
                                    <p class="form-control-static"> {{ trans('general.job_address') }} </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group}">                                
                                <div class="col-sm-12">
                                    <p class="form-control-static"> {{ trans('general.phone') }} </p>
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <div class="row">                        
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('', trans('general.father'), ['class' => 'control-label col-sm-4']) !!}                                
                                <div class="col-sm-8">
                                    {!! Form::text('relatives["father"]["name"]', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">                                
                                <div class="col-sm-12">
                                    {!! Form::text('relatives["father"]["job"]', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">                                
                                <div class="col-sm-12">
                                    {!! Form::text('relatives["father"]["phone"]', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>                        
                    </div>                    
                    <div class="row">                        
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('', trans('general.brother'), ['class' => 'control-label col-sm-4']) !!}                                
                                <div class="col-sm-8">
                                    {!! Form::text('relatives["brother"]["name"]', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">                                
                                <div class="col-sm-12">
                                    {!! Form::text('relatives["brother"]["job"]', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">                                
                                <div class="col-sm-12">
                                    {!! Form::text('relatives["brother"]["phone"]', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>                        
                    </div>                    
                    <div class="row">                        
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('', trans('general.kaka'), ['class' => 'control-label col-sm-4']) !!}                                
                                <div class="col-sm-8">
                                    {!! Form::text('relatives["kaka"]["name"]', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">                                
                                <div class="col-sm-12">
                                    {!! Form::text('relatives["kaka"]["job"]', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">                                
                                <div class="col-sm-12">
                                    {!! Form::text('relatives["kaka"]["phone"]', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>                        
                    </div>                    
                    <div class="row">                        
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('', trans('general.mama'), ['class' => 'control-label col-sm-4']) !!}                                
                                <div class="col-sm-8">
                                    {!! Form::text('relatives["mama"]["name"]', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">                                
                                <div class="col-sm-12">
                                    {!! Form::text('relatives["mama"]["job"]', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">                                
                                <div class="col-sm-12">
                                    {!! Form::text('relatives["mama"]["phone"]', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>                        
                    </div>                    
                </div>
                <hr>
                <div class="form-actions fluid">
                    <div class="row">
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