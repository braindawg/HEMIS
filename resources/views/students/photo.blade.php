@extends('students.sidebar')

@section('page')
<div class="panel panel-default"> 
    <div class="panel-body">        
        {!! Form::open(['route' => ['students.photo.update', $student],'files' => true, 'method' => 'put',  'class' => 'form-horizontal']) !!}                    
            <div class="form-group {{ $errors->has('photo') ? ' has-error' : '' }}">
                {!! Form::label('photo', trans('general.photo'), ['class' => 'control-label col-sm-3']) !!}                                
                <div class="col-sm-5">
                    {!! Form::file('photo', ['class' => 'form-control']) !!}     
                    @if ($errors->has('photo'))
                        <span class="help-block">
                            <strong>{{ $errors->first('photo') }}</strong>
                        </span>
                    @endif                                                                                                   
                </div>
            </div>                         
            <div class="form-group"> 
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-primary">{{ trans('general.save') }}</button>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection