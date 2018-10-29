@extends('layouts.app')

@section('content')
<!-- BEGIN PAGE BASE CONTENT -->
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PROFILE CONTENT -->
        <div class="profile-content">
            <div class="portlet box">        
                <div class="portlet-body">
                            <!-- BEGIN FORM-->            
                            {!! Form::model($issue, ['route' => ['issues.update', $issue], 'method' => 'patch', 'class' => 'form-horizontal', 'files' => true]) !!}
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
                                                    {!! Form::textarea('body', null, ['class' => 'form-control', 'id'=>"summernote", 'cols' =>40]) !!}
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
                                                     {!! Form::file('file[]', ['multiple' => 'true'], ['class' => 'form-control' ]) !!}
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
                                        <div class="col-md-offset-2 col-md-8">
                                            <button type="submit" class="btn green">{{ trans('general.save') }}</button>
                                                 <a href="{{ route('issues.index') }}" class="btn default">{{ trans('general.cancel') }}</a>
                                        </div>
                                    </div>
                                </div>                            
                                {!! Form::close() !!}
                                     <!-- END FORM-->
                            </div>
                        </div>
                    </div>
        <!-- END PROFILE CONTENT -->
        <!-- should only acceble for Admin users -->
        <div class="row">
            <div class="col-md-12" style="margin-top:20px">
                            <!-- BEGIN SAMPLE TABLE PORTLET-->
                <div class="portlet">
                    <div class="portlet-title">
                        <div class="caption" >
                            <h3 style ="margin-right:20px; text-align:center">{{trans('general.attached_files')}}</h3>  
                        </div> 
                        <div class="portlet-body">
                    <div class="table-scrollable">
                        <table class="table table-striped table-bordered table-advance table-hover">
                            <thead>
                                <tr>
                                    <th>
                                            نام فایل </th>
                                    <th >
                                                سوال مربوطه </th>
                                    <th>
                                            عملیه 
                                    </th>
                                </tr>
                            </thead>
                                <tbody>
                                    @if($issue->attachments()->count() > 0)
                                    @foreach($issue->attachments as $attachment)
                                        <tr>
                                            <td>
                                                {{$attachment->extension}}
                                            </td>
                                            <td> 
                                                {{$issue->title}} 
                                            </td>
                                            <td>
                                                <a href="{{URL::to('/deletefile/'.$attachment->id)}}"  onClick="doConfirm()"  class="btn dark btn-sm btn-outline sbold uppercase">
                                                <i class="fa fa-trash"></i>  {{trans('general.delete')}} </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @else
                                        <td>
                                            {{trans('general.file_not_attached')}}
                                        </td>
                                    @endif                                            
                            </tbody>
                        </table>
                    </div>
                </div>           
            </div>
        </div>
    </div>
</div>

<!-- END PAGE BASE CONTENT -->
    
@endsection('content')
