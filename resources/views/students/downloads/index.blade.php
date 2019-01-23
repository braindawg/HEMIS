@extends('layouts.app')

@section('content')    
<div class="row">            
    <div class="col-md-12">
        @include('students.sidebar')
        <div class="profile-content">
            <div class="row">            
                <div class="col-md-12">
                     <div class="panel panel-default">
                        <div class="panel-heading clearfix">
                            {{ trans('general.downloads') }} 
                            <a class="pull-right btn btn-default btn-xs" href="{{route('students.index')}}" >
                                <i class="fa fa-arrow-left"></i> {{ trans('general.back') }}
                            </a>                                           
                        </div>
                        <div class="panel-body">
                            @include('layouts.message')
                          
                            <table class="table">
                                @foreach($files as $file)
                                <tr>
                                    <td style="border-top:0">
                                        <a href="{{ route('students.downloads.download', ['student' => $student, 'file' => substr($file->getFileName(), 0, -10)]) }}"  target="new" >
                                        {{ implode(explode('-', substr($file->getFileName(), 0, -10)), ' ') }}
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>                 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection